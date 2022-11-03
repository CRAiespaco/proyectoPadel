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
        $sentencia = $this->getConexion()->prepare();
        $sentencia->bindParam(1,$dni);
        $sentencia->execute();
        $fila =$sentencia->fetch();
        return new Persona($fila['DNI'],
            $fila['nombre'],
            $fila['appellidos'],
            $fila['correo_electronico'],
            $fila['contrasenya']);

    }


    //"mysql:host='".HOSTBD."';
    //            dbname='".NOMBREBD."',
    //            '".USUARIOBD."',
    //            '".PASSBD."'")
}