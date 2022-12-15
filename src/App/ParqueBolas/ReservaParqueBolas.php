<?php

namespace App\ParqueBolas;

use App\Personas\Persona;

class ReservaParqueBolas{
    private \DateTime $fecha;
    private int $numHoras;
    private Persona $clientes;
    private float $costeHora;

    /**
     * @param \DateTime $fecha
     * @param int $numHoras
     * @param Persona $clientes
     * @param float $costeHora
     */
    public function __construct(\DateTime $fecha, int $numHoras, Persona $clientes, float $costeHora)
    {
        $this->fecha = $fecha;
        $this->numHoras = $numHoras;
        $this->clientes = $clientes;
        $this->costeHora = $costeHora;
    }


    /**
     * @return \DateTime
     */
    public function getFecha(): \DateTime
    {
        return $this->fecha;
    }

    /**
     * @param \DateTime $fecha
     */
    public function setFecha(\DateTime $fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return int
     */
    public function getNumHoras(): int
    {
        return $this->numHoras;
    }

    /**
     * @param int $numHoras
     */
    public function setNumHoras(int $numHoras): void
    {
        $this->numHoras = $numHoras;
    }

    /**
     * @return Persona
     */
    public function getClientes(): Persona
    {
        return $this->clientes;
    }

    /**
     * @param Persona $clientes
     */
    public function setClientes(Persona $clientes): void
    {
        $this->clientes = $clientes;
    }

    /**
     * @return float
     */
    public function getCosteHora(): float
    {
        return $this->costeHora;
    }

    /**
     * @param float $costeHora
     */
    public function setCosteHora(float $costeHora): void
    {
        $this->costeHora = $costeHora;
    }

}