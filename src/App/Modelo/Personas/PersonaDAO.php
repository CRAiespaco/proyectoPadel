<?php

namespace App\Modelo\Personas;

use App\Personas\Persona;
use PDO;

abstract class PersonaDAO implements InterfazPersonas
{
    private $conexion;

    /**
     * @return
     */
    public function getConexion(){
        return $this->conexion;
    }

    /**
     * @param $conexion
     * @return PersonaDAO
     */
    public function setConexion($conexion): PersonaDAO{
        $this->conexion = $conexion;
        return $this;
    }



    public function insertarPersona(Persona $persona): ?Persona
    {
        // TODO: Implement insertarPersona() method.
    }

    public function modificarPersona(Persona $persona): ?Persona
    {
        // TODO: Implement modificarPersona() method.
    }

    public function borrarPersona(Persona $persona): ?Persona
    {
        // TODO: Implement borrarPersona() method.
    }

    public function borrarPersonaPorDNI(string $dni): ?Persona
    {
        // TODO: Implement borrarPersonaPorDNI() method.
    }

    public function leerPersona(string $dni): ?Persona
    {
        // TODO: Implement leerPersona() method.
    }

    public function leerTodasLasPersonas(): array
    {
        // TODO: Implement leerTodasLasPersonas() method.
    }

    public function obtenerPersonasSinTelefono(): ?array
    {
        // TODO: Implement obtenerPersonasSinTelefono() method.
    }

    public function obtenerPersonasPorNombre(string $nombre): ?array
    {
        // TODO: Implement obtenerPersonasPorNombre() method.
    }

    public function obtenerPersonasPorApellidos(string $apellidos): ?array
    {
        // TODO: Implement obtenerPersonasPorApellidos() method.
    }

    public function obtenerRangoPersonas(int $inicio, int $numeroResultados=NUMERODERESULTADOSPORPAGINA): array
    {
        // TODO: Implement obtenerRangoPersonas() method.
    }
    public function leerPersonaPorCorreoElectronico(string $correoElectronico):?Persona{

    }

}