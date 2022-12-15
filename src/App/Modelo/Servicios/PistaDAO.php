<?php

namespace App\Modelo\Servicios;

use App\Servicios\Pista;
use PDO;

abstract class PistaDAO implements InterfazPista
{
    private PDO $conexion;


    public function getConexion(): PDO
    {
        return $this->conexion;
    }


    public function setConexion(PDO $conexion): PistaDAO
    {
        $this->conexion = $conexion;
        return $this;
    }

    public function insertarPista(Pista $pista): ?Pista
    {
        // TODO: Implement insertarPista() method.
    }

    public function modificarPista(Pista $pista): ?Pista
    {
        // TODO: Implement modificarPista() method.
    }

    public function modificarTodasLasPistas(array $elementosAModificar)
    {
        // TODO: Implement modificarTodasLasPistas() method.
    }

    public function borrarPista(Pista $pista): ?Pista
    {
        // TODO: Implement borrarPista() method.
    }

    public function borrarPistaPorID(int $id): ?Pista
    {
        // TODO: Implement borrarPistaPorID() method.
    }

    public function leerPista(int $id): ?Pista
    {
        // TODO: Implement leerPista() method.
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