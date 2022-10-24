<?php

namespace App\Personas;

use App\Personas\Empleado;
use App\Personas\Jugador;

class Fisioterapeuta extends Empleado
{
    private int $numColegiado;
    private Jugador $clienteVIP;

    /**
     * @param string $dni
     * @param string $nombre
     * @param string $apellidos
     * @param string $direccion
     * @param string $cuentaCorriente
     * @param string $numSeguridadSocial
     * @param int $numColegiado
     */
    public function __construct(string $dni,string $nombre,string $apellidos,string $direccion, string$cuentaCorriente,string $numSeguridadSocial, int $numColegiado)
    {
        parent::__construct($dni,$nombre,$apellidos,$direccion,$cuentaCorriente,$numSeguridadSocial);
        $this->numColegiado = $numColegiado;
    }

    /**
     * @return int
     */
    public function getNumColegiado(): int
    {
        return $this->numColegiado;
    }

    /**
     * @param int $numColegiado
     * @return Fisioterapeuta
     */
    public function setNumColegiado(int $numColegiado): Fisioterapeuta
    {
        $this->numColegiado = $numColegiado;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClienteVIP()
    {
        return $this->clienteVIP;
    }

    /**
     * @param mixed $clienteVIP
     * @return Fisioterapeuta
     */
    public function setClienteVIP($clienteVIP)
    {
        $this->clienteVIP = $clienteVIP;
        return $this;
    }



}