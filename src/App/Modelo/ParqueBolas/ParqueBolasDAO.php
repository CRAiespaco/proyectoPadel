<?php

namespace App\Modelo\ParqueBolas;
use App\Controlador\ParqueBolas\ParqueBolasControlador;
use App\ParqueBolas\ReservaParqueBolas;
use PDO;

abstract class ParqueBolasDAO implements InterfazParqueBolas{
    private $conexion;

    /**
     * @return
     */
    public function getConexion(){
        return $this->conexion;
    }

    /**
     * @param $conexion
     * @return ParqueBolasDAO
     */
    public function setConexion($conexion):ParqueBolasDAO{
        $this->conexion = $conexion;
        return $this;
    }

    public function insertarReserva(ReservaParqueBolas $reserva):?ReservaParqueBolas{
        // TODO: Implement borrarReserva() method.
    }

    public function borrarTodasLasReservas(){
        // TODO: Implement borrarReserva() method.
    }

    public function borrarReservaPorCliente(string $dni)
    {
        // TODO: Implement borrarReservaPorDNI() method.
    }

    public function leerReserva(string $dni):?ReservaParqueBolas
    {
        // TODO: Implement leerReserva() method.
    }

    public function leerTodasLasReservas(): array
    {
        // TODO: Implement leerTodasLasReservas() method.
    }

    public function calcularCostePorPersona(string $cliente1,string $cliente2,int $porcentaje1,int $porcentaje2,int $horas,float $precio):array{
        // TODO: Implement calcularCostePorPersona() method.
    }
    //ggggg
}