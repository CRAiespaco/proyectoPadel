<?php

namespace App\Modelo\Personas;

use App\Modelo\Excepciones\ActualizarPersonasException;
use App\Modelo\Excepciones\PersonaNoEncontradaException;
use App\Personas\Persona;
use PDO;
use PDOException;

require_once __DIR__."/../../datosConexionBD.php";
require_once __DIR__."/../../datosConfiguracion.php";



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

        if($fila = $sentencia->fetch()){
            if($fila['TELEFONO']==null){
                return new Persona(
                    $fila['DNI'],
                    $fila['NOMBRE'],
                    $fila['APELLIDOS'],
                    $fila['CORREOELECTRONICO'],
                    $fila['CONTRASENYA']
                );
            }else{
                return new Persona(
                    $fila['DNI'],
                    $fila['NOMBRE'],
                    $fila['APELLIDOS'],
                    $fila['CORREOELECTRONICO'],
                    $fila['CONTRASENYA'],
                    $fila['TELEFONO']
                );
            }

        }else{
            throw new PersonaNoEncontradaException("La persona no existe en la base de datos");
        }

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

        if ($resultado){
            return $persona;
        } else {
            return null;
        }
    }

    public function modificarTodasLasPersonas(array $elementosAModificar){
        $query="UPDATE persona SET ";

        if(isset($elementosAModificar['nombre'])){
            $query.="Nombre=:nombre,";
        }
        if(isset($elementosAModificar['apellidos'])){
            $query.="APELLIDOS=:apellidos,";
        }
        if(isset($elementosAModificar['telefono'])){
            $query.="TELEFONO=:telefono,";
        }
        if(isset($elementosAModificar['contrasenya'])){
            $query.="CONTRASENYA=:contrasenya,";
        }
        $query=substr($query,0,-1);
        $sentencia=$this->getConexion()->prepare($query);

        if(isset($elementosAModificar['nombre'])){
            $sentencia->bindParam("nombre",$elementosAModificar['nombre']);
        }
        if(isset($elementosAModificar['apellidos'])){
            $sentencia->bindParam("apellidos",$elementosAModificar['apellidos']);
        }
        if(isset($elementosAModificar['telefono'])){
            $sentencia->bindParam("telefono",$elementosAModificar['telefono']);
        }
        if(isset($elementosAModificar['contrasenya'])){
            $contrasenyaCifrada=password_hash($elementosAModificar['contrasenya'],PASSWORD_DEFAULT);
            $sentencia->bindParam("contrasenya",$contrasenyaCifrada);
        }

        try {
            $sentencia->execute();
        }catch (PDOException $e){
            throw new ActualizarPersonasException("No se ha podido actualizar a las personas");
        }
        var_dump($sentencia->errorCode());
    }

    public function borrarPersonaPorDNI(string $dni): ?Persona{
        try {
            $persona=$this->leerPersona($dni);
        }catch(PersonaNoEncontradaException $e){
            throw new PersonaNoEncontradaException("No se pudo borrar, la persona no existe");
        }
        $persona = $this->leerPersona($dni);
        $query = "DELETE FROM persona WHERE DNI=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1, $dni);
        $resultado = $sentencia->execute();

        if ($resultado) {
            return $persona;
        } else {
            return null;
        }
    }

    public function borrarPersona(Persona $persona): ?Persona
    {
        return $this->borrarPersonaPorDNI($persona->getDNI());
    }

    public function borrarTodasLasPersonas():bool{
        $sentencia=$this->getConexion()->query("TRUNCATE persona");
        return $sentencia->execute();

    }

    public function insertarPersona(Persona $persona): ?Persona
    {
        if ($persona->getTelefono()===''){
            $query = "INSERT INTO persona (DNI,NOMBRE,APELLIDOS,TELEFONO,CORREOELECTRONICO,CONTRASENYA) 
                    VALUES (:dni,:nombre,:apellidos,NULL,:correo,:pass)";
            $sentencia = $this->getConexion()->prepare($query);

            $sentencia->bindValue("dni", $persona->getDNI());
            $sentencia->bindValue("nombre", $persona->getNombre());
            $sentencia->bindValue("apellidos", $persona->getApellidos());
            $sentencia->bindValue("correo", $persona->getCorreoElectronico());
            $sentencia->bindValue("pass", $persona->getContrasenya());
        }else {
            $query = "INSERT INTO persona (DNI,NOMBRE,APELLIDOS,TELEFONO,CORREOELECTRONICO,CONTRASENYA) 
                    VALUES (:dni,:nombre,:apellidos,:telefono,:correo,:pass)";
            $sentencia = $this->getConexion()->prepare($query);

            $sentencia->bindValue("dni", $persona->getDNI());
            $sentencia->bindValue("nombre", $persona->getNombre());
            $sentencia->bindValue("apellidos", $persona->getApellidos());
            $sentencia->bindValue("telefono", $persona->getTelefono());
            $sentencia->bindValue("correo", $persona->getCorreoElectronico());
            $sentencia->bindValue("pass", $persona->getContrasenya());
        }

        $resultado = $sentencia->execute();

        if ($resultado) {
            return $persona;
        } else {
            return null;
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

    public function obtenerPersonasSinTelefono():?array{

        $query = "SELECT * FROM persona WHERE TELEFONO IS NULL";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->execute();
        $resultado = $sentencia;
        $arrayPersonasSinTelefono=false;
        if($resultado){

            foreach ($resultado as $informacionPersona) {
                $arrayPersonasSinTelefono[]=$this->convertirArrayAPersona($informacionPersona);
            }
        }
        return $arrayPersonasSinTelefono;


    }
    public function obtenerPersonasPorNombre(string $nombre):?array{
        $query = "SELECT * FROM persona WHERE NOMBRE= ?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->execute([$nombre]);
        $resultado = $sentencia;
        $arrayPersonasSinTelefono=false;
        if($resultado){

            foreach ($resultado as $informacionPersona) {
                $arrayPersonasSinTelefono[]=$this->convertirArrayAPersona($informacionPersona);
            }
        }
        return $arrayPersonasSinTelefono;
    }
    public function obtenerPersonasPorApellidos(string $apellidos):?array{
        $query = "SELECT * FROM persona WHERE APELLIDOS= ?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->execute([$apellidos]);
        $resultado = $sentencia;
        $arrayPersonasSinTelefono=false;
        if($resultado){

            foreach ($resultado as $informacionPersona) {
                $arrayPersonasSinTelefono[]=$this->convertirArrayAPersona($informacionPersona);
            }
        }
        return $arrayPersonasSinTelefono;
    }


    private function convertirArrayAPersona(array $datosPersona):?Persona
    {
        if ($datosPersona['TELEFONO']==NULL){
            $datosPersona['TELEFONO']='';
        }

        return new Persona($datosPersona['DNI'],$datosPersona['NOMBRE'],
            $datosPersona['APELLIDOS'],$datosPersona['CORREOELECTRONICO'],
            $datosPersona['CONTRASENYA'],$datosPersona['TELEFONO']);
    }

    public function leerPersonaPorCorreoElectronico(string $correoElectronico):?Persona{
        $query = "SELECT * FROM persona WHERE CORREOELECTRONICO=?";

        $sentencia= $this->getConexion()->prepare($query);
        $sentencia->bindParam(1,$correoElectronico);

        if($sentencia->execute()){
            $resultado = $sentencia->fetch();
            return $this->convertirArrayAPersona($resultado);
        }else{
            return null;
        }
    }

    public function existeDNI($dni){
        $query="SELECT * FROM persona Where dni=?";
        $sentencia=$this->getConexion()->prepare($query);
        $sentencia->bindParam(1,$dni);
        $sentencia->execute();

        if($sentencia->fetch()){
            return true;
        }else{
            return false;
        }
    }

    public function existeCorreoElectronico($correo){
        $query="SELECT * FROM persona Where CORREOELECTRONICO=?";
        $sentencia=$this->getConexion()->prepare($query);
        $sentencia->bindParam(1,$correo);
        $sentencia->execute();

        if($sentencia->fetch()){
            return true;
        }else{
            return false;
        }
    }










}