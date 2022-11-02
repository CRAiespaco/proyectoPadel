<?php

namespace App\Personas;


class Persona
{
    private string $dni;
    private string $nombre;
    private string $apellidos;
    private string $telefono;
    private string $correoElectronico;
    private string $contrasenya;



    public function __construct(string $dni, string $nombre, string $apellidos,
        string $correoElectronico, string $contrasenya, string $telefono=null){
        $this->dni=$dni;
        $this->nombre=$nombre;
        $this->apellidos=$apellidos;
        $this->correoElectronico=$correoElectronico;
        $this->contrasenya=$contrasenya;
        $this->telefono=$telefono;
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

    /**
     * @return string
     */
    public function getCorreoElectronico(): string
    {
        return $this->correoElectronico;
    }

    /**
     * @param string $correoElectronico
     * @return Persona
     */
    public function setCorreoElectronico(string $correoElectronico): Persona
    {
        $this->correoElectronico = $correoElectronico;
        return $this;
    }

    /**
     * @return string
     */
    public function getContrasenya(): string
    {
        return $this->contrasenya;
    }

    /**
     * @param string $contrasenya
     * @return Persona
     */
    public function setContrasenya(string $contrasenya): Persona
    {
        $this->contrasenya = $contrasenya;
        return $this;
    }
}