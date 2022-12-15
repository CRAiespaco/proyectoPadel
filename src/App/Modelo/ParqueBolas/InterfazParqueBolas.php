<?php

namespace App\Modelo\ParqueBolas;
use App\Controlador\ParqueBolas\ParqueBolasControlador;
use App\ParqueBolas\ReservaParqueBolas;

interface InterfazParqueBolas{

    public function calcularCostePorPersona(string $cliente1,string $cliente2,int $porcentaje1,int $porcentaje2,int $horas,float $precio):array;
    public function leerReserva(string $dni):?ReservaParqueBolas;
    public function leerTodasLasReservas():array;
    public function borrarReservaPorCliente(string $dni);
    public function borrarTodasLasReservas();
}