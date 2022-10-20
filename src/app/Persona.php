<?php

namespace App;

class Persona
{
    private string $dni;
    private string $nombre;
    private string $apellidos;
    private string $telefono;

    public function __construct(string $dni, string $nombre, string $apellidos){
        $this->dni=$dni;
        $this->nombre=$nombre;
        $this->apellidos=$apellidos;
    }

    public function setDNI(string $dni):Persona{
        $this->dni=$dni;
        return $this;
    }

    public function getDNI():string{
        return $this->dni;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Persona
     */
    public function setNombre(string $nombre): Persona
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     * @return Persona
     */
    public function setApellidos(string $apellidos): Persona
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefono():Persona
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     * @return Persona
     */
    public function setTelefono($telefono):Persona
    {
        $this->telefono = $telefono;
        return $this;
    }
}