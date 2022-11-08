<?php

namespace Modelo;

use App\Personas\Persona;
use \PDO;
require_once __DIR__."/../datosConexionBD.php";
require_once __DIR__."/../datosConfiguracion.php";



class PersonaDAOMySQL extends PersonaDAO
{
    public function __construct()
    {
        $this->setConexion(
            new PDO(
                "mysql:host=" . HOSTBD .
                ";dbname=" . NOMBREBD, USUARIOBD, PASSBD
            )
        );

        $this->getConexion()->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );
    }

    public function leerPersona(string $dni): ?Persona
    {
        $query = "SELECT * FROM persona WHERE DNI=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1, $dni);
        $sentencia->execute();
        $fila = $sentencia->fetch();
        return new Persona(
            $fila['DNI'],
            $fila['NOMBRE'],
            $fila['APELLIDOS'],
            $fila['CORREOELECTRONICO'],
            $fila['CONTRASENYA'],
            $fila['TELEFONO']
        );
    }

    public function modificarPersona(Persona $persona): ?Persona
    {
        $query = "UPDATE persona SET NOMBRE=:nombre,APELLIDOS=:apellidos,
                   TELEFONO=:telefono,CORREOELECTRONICO=:correo, CONTRASENYA=:pass
                   WHERE DNI=:dni";

        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindValue("nombre", $persona->getNombre());
        $sentencia->bindValue("apellidos", $persona->getApellidos());
        $sentencia->bindValue("telefono", $persona->getTelefono());
        $sentencia->bindValue("correo", $persona->getCorreoElectronico());
        $sentencia->bindValue("pass", $persona->getContrasenya());
        $sentencia->bindValue("dni", $persona->getDNI());

        $resultado = $sentencia->execute();

        if ($resultado) {
            return $persona;
        } else {
            return null;
        }
    }

    public function borrarPersonaPorDNI(string $dni): ?Persona
    {
        $persona = $this->leerPersona($dni);
        $query = "DELETE FROM persona WHERE DNI=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1, $dni);
        $resultado = $sentencia->execute();

        if ($resultado) {
            return $persona;
        } else {
            return $resultado;
        }
    }

    public function borrarPersona(Persona $persona): ?Persona
    {
        $resultado = $this->borrarPersonaPorDNI($persona->getDNI());

        return $resultado;
    }

    public function insertarPersona(Persona $persona): ?Persona
    {
        $query = "INSERT INTO persona (DNI,NOMBRE,APELLIDOS,TELEFONO,CORREOELECTRONICO,CONTRASENYA) 
                    VALUES (:dni,:nombre,:apellidos,:telefono,:correo,:pass)";

        $sentencia = $this->getConexion()->prepare($query);

        $sentencia->bindValue("dni", $persona->getDNI());
        $sentencia->bindValue("nombre", $persona->getNombre());
        $sentencia->bindValue("apellidos", $persona->getApellidos());
        $sentencia->bindValue("telefono", $persona->getTelefono());
        $sentencia->bindValue("correo", $persona->getCorreoElectronico());
        $sentencia->bindValue("pass", $persona->getContrasenya());

        $resultado = $sentencia->execute();

        if ($resultado) {
            return $persona;
        } else {
            return 0;
        }
    }

    public function leerTodasLasPersonas():array
    {
        $resultado = $this->getConexion()->query("SELECT * FROM persona");

        $resultado->execute();

        $arrayResultados = $resultado->fetchAll();

        $arrayObjetos=[];

        foreach ($arrayResultados as $filaPersona){
            $arrayObjetos[]=$this->convertirArrayAPersona($filaPersona);
        }

        return $arrayObjetos;
    }

    public function obtenerRangoPersonas(int $inicio, int $numeroResultados=NUMERODERESULTADOSPORPAGINA):array{
        $resultado = $this->getConexion()->query("SELECT * FROM persona LIMIT $inicio,$numeroResultados");

        $resultado->execute();

        $arrayResultados = $resultado->fetchAll();

        $arrayObjetos=[];

        foreach ($arrayResultados as $filaPersona){
            $arrayObjetos[]=$this->convertirArrayAPersona($filaPersona);
        }

        return $arrayObjetos;
    }


    private function convertirArrayAPersona(array $datosPersona):?Persona
    {
        return new Persona($datosPersona['DNI'],$datosPersona['NOMBRE'],
            $datosPersona['APELLIDOS'],$datosPersona['CORREOELECTRONICO'],
            $datosPersona['CONTRASENYA'],$datosPersona['TELEFONO']);
    }











}