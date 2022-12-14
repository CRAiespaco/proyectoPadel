<?php

namespace App\Modelo\Personas;

use App\Modelo\Excepciones\PersonaNoEncontradaException;
use App\Personas\Persona;
use MongoDB\Client;
use App\Modelo\Excepciones\MongodbConexionIncorrectaException;
use MongoDB\Database;
use MongoDB\Collection;
use Ramsey\Uuid\Uuid;

class PersonaDAOMongoDB extends PersonaDAO implements InterfazPersonas{

    private Database $db;
    private Collection $coleccion;

    public function __construct(){
        if (!$this->setConexion(
            new Client("mongodb://root:example@mongo:27017/"))){
            throw new MongodbConexionIncorrectaException();
        }
        $this->db=$this->getConexion()->padel;
        $this->coleccion=$this->db->persona;
        $this->coleccion->createIndex(["correoelectronico"=>1],["unique"=>true]);
    }


    public function insertarPersona(Persona $persona):?Persona{
        $id=Uuid::uuid4();

        $this->coleccion->insertOne($persona->convertirPersonaAArrayParaMongoDB());
        return  $persona;
    }

    public function modificarPersona(Persona $persona):?Persona{
        $resultado=$this->coleccion->updateOne(["dni"=>$persona->getDNI()],
            ['$set'=>[
                "nombre"=>$persona->getNombre(),
                "apellidos"=>$persona->getApellidos(),
                "telefono"=>$persona->getTelefono(),
                "correoelectronico"=>$persona->getCorreoElectronico(),
                "contrasenya"=>$persona->getContrasenya()
            ]]
        );
        //var_dump($resultado);
        if($resultado->getModifiedCount()){
            return $persona;
        }else{
            return null;
        }

    }

    public function modificarTodasLasPersonas(array $elementosAModificar){
        $resultado=$this->coleccion->updateMany([],
            ['$set'=>$elementosAModificar]
        );
    }

    public function borrarPersona(Persona $persona):?Persona{

    }
    public function borrarPersonaPorDNI(string $dni):?Persona{

    }
    public function leerPersona(string $dni):?Persona{

    }
    public function leerPersonaPorCorreoElectronico(string $correoElectronico):?Persona{

    }

    public function leerTodasLasPersonas():array{
        $retorno=$this->coleccion->find();
        foreach($retorno as $documento){
            echo "<pre>";
            echo json_encode($documento->getArrayCopy(),JSON_PRETTY_PRINT);
            echo "</pre>";
            $arrayRetorno[]=$this->convertirArrayAPersona($documento->getArrayCopy());
        }
        return $arrayRetorno;
    }
    public function obtenerPersonasSinTelefono():?array{

    }
    public function obtenerPersonasPorNombre(string $nombre):?array{

    }
    public function obtenerPersonasPorApellidos(string $apellidos):?array{

    }
    public function obtenerRangoPersonas(int $inicio, int $numeroResultados=NUMERODERESULTADOSPORPAGINA):array{
        $consulta=$this->coleccion->find([],[
            'skip'=>$inicio,
            'limit'=>$numeroResultados
        ]);
        if($consulta->valid()){
            $consulta->toArray();
        }else{
            throw new PersonaNoEncontradaException("No se puede encontrar el rango");
        }

    }

    private function convertirArrayAPersona(array $datosPersona):?Persona
    {
        if (!isset($datosPersona[strtolower('TELEFONO')]) || $datosPersona[strtolower('TELEFONO')]==NULL ){
            $datosPersona[strtolower('TELEFONO')]='';
        }

        return new Persona($datosPersona[strtolower('DNI')],$datosPersona[strtolower('NOMBRE')],
            $datosPersona[strtolower('APELLIDOS')],$datosPersona[strtolower('CORREOELECTRONICO')],
            $datosPersona[strtolower('CONTRASENYA')],$datosPersona[strtolower('TELEFONO')]);
    }
}