<?php

namespace Modelo;

use App\Personas\Persona;
use \PDO;
require_once __DIR__."/../datosConexionBD.php";


class PersonaDAOMySQL extends PersonaDAO
{
    public function __construct(){
        $this->setConexion(new PDO("mysql:host=".HOSTBD.
            ";dbname=".NOMBREBD,USUARIOBD,PASSBD));

        $this->getConexion()->setAttribute(\PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION);
    }

    public function leerPersona(string $dni):?Persona{

        $query = "SELECT * FROM persona WHERE DNI=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1,$dni);
        $sentencia->execute();
        $fila =$sentencia->fetch();
        return new Persona($fila['DNI'],
            $fila['NOMBRE'],
            $fila['APELLIDOS'],
            $fila['CORREOELECTRONICO'],
            $fila['CONTRASENYA'],
            $fila['TELEFONO']
        );

    }
    public function modificarPersona(Persona $persona):?Persona{
        $query = "UPDATE persona SET NOMBRE=:nombre,APELLIDOS=:apellidos,
                   TELEFONO=:telefono,CORREOELECTRONICO=:correo, CONTRASENYA=:pass
                   WHERE DNI=:dni";

        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindValue("nombre",$persona->getNombre());
        $sentencia->bindValue("apellidos",$persona->getApellidos());
        $sentencia->bindValue("telefono",$persona->getTelefono());
        $sentencia->bindValue("correo", $persona->getCorreoElectronico());
        $sentencia->bindValue("pass",$persona->getContrasenya());
        $sentencia->bindValue("dni",$persona->getDNI());

        $resultado=$sentencia->execute();

        if($resultado){
            return $persona;
        }else{
            return null;
        }




    }
    public function borrarPersonaPorDNI(string $dni):?Persona{

        $persona=$this->leerPersona($dni);
        $query = "DELETE FROM persona WHERE DNI=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1,$dni);
        $resultado = $sentencia->execute();

        if($resultado){
            return $persona;
        }else{
            return $resultado;
        }

    }
    public function borrarPersona(Persona $persona):?Persona{

        $resultado = $this->borrarPersonaPorDNI($persona->getDNI());

        return $resultado;
    }

}