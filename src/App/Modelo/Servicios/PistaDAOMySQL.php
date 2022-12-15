<?php

namespace App\Modelo\Servicios;

//use App\Modelo\Excepciones\PistaNoEncontradaExeption;
use App\servicios\Enums\TipoPista;
use App\Servicios\Pista;
use PDO;

require_once __DIR__ . "/../../../datosConexionBD.php";
require_once __DIR__ . "/../../../datosConfiguracion.php";

class PistaDAOMySQL extends PistaDAO
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
    public function insertarPista(Pista $pista): ?Pista
    {
        $query = "INSERT INTO pistas (precio,luz,precioLuz,tipoPista,cubierta,disponible,reservarPistaMensual) 
                    VALUES (:precio,:luz,:precioLuz,:tipoPista,:cubierta,:disponible,:reservarPistaMensual)";
        $sentencia = $this->getConexion()->prepare($query);

        $sentencia->bindValue("precio", $pista->getPrecio());
        $sentencia->bindValue("luz", $pista->getLuz());
        $sentencia->bindValue("precioLuz", $pista->getPrecioLuz());
        $sentencia->bindValue("tipoPista", $pista->getTipoPista()->pasarString());
        $sentencia->bindValue("cubierta", $pista->isCubierta());
        $sentencia->bindValue("disponible", $pista->isDisponible());
        $sentencia->bindValue("reservarPistaMensual", $pista->getReservaPistaMensual());

        $resultado = $sentencia->execute();
        return $resultado ? $pista : null;
    }

    public function modificarPista(Pista $pista): ?Pista
    {
        $query = "UPDATE pistas SET precio=:pito,luz=:luz,precioLuz=:precioLuz,tipoPista=:tipoPista,
                  cubierta=:cubierta,reservarPistaMensual=:reservarPistaMensual WHERE idPista=:id";

        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindValue("pito",$pista->getPrecio());
        $sentencia->bindValue("luz",$pista->getLuz());
        $sentencia->bindValue("precioLuz",$pista->getPrecioLuz());
        $sentencia->bindValue("tipoPista",$pista->getTipoPista()->pasarString());
        $sentencia->bindValue("cubierta",$pista->isCubierta());
        $sentencia->bindValue("reservarPistaMensual",$pista->getReservaPistaMensual());
        $sentencia->bindValue("id",$pista->getIdPista());

        $resultado = $sentencia->execute();
        return $resultado ? $pista : null;
    }

    public function modificarTodasLasPistas(array $elementosAModificar)
    {
        // TODO: Implement modificarTodasLasPistas() method.
    }

    public function borrarPista(Pista $pista): ?Pista
    {
        return $this->borrarPistaPorID($pista->getIdPista());
    }

    public function borrarPistaPorID(int $id): ?Pista
    {
        $pista = $this->leerPista($id);

        $query = "DELETE FROM pistas WHERE idPista=?";

        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1,$id);
        $resultado = $sentencia->execute();
        return $resultado ? $pista : null;
    }

    public function leerPista(int $id): ?Pista
    {
        $query = "SELECT * FROM pistas WHERE idPista=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1,$id);
        $resultado = $sentencia->execute();
        if($resultado){
            if($fila = $sentencia->fetch()){
                if($fila['tipoPista']=='individual'){
                    $tipoPista = TipoPista::Individual;
                }else{
                    $tipoPista = TipoPista::Dobles;
                }
               return Pista::crear(
                   $fila['idPista'],
                   $fila['precio'],
                   $fila['luz'],
                   $fila['precioLuz'],
                   $tipoPista,
                   $fila['cubierta'],
                   $fila['disponible'],
                   $fila['reservarPistaMensual'],
               );
            }else{
                throw new PistaNoEncontradaExeption();
            }
        }else{
            throw new PistaNoEncontradaExeption();
        }

    }

    public function leerTodasLasPistas(): array
    {
        // TODO: Implement leerTodasLasPistas() method.
    }

    public function obtenerPistasSinCubierta(): ?array
    {
        // TODO: Implement obtenerPistasSinCubierta() method.
    }

    public function obtenerPistasDisponibles(): ?array
    {
        // TODO: Implement obtenerPistasDisponibles() method.
    }
}