<?php

namespace App\Controlador\ParqueBolas;

use App\Modelo\ParqueBolas\ParqueBolasDAO;
use App\Modelo\ParqueBolas\ParqueBolasMySQL;
use App\ParqueBolas\ReservaParqueBolas;
use mysql_xdevapi\Exception;

class ParqueBolasControlador{
    private ParqueBolasDAO $modelo;

    public function __construct(){
        $this->modelo=new ParqueBolasMySQL();
    }

    public function  mostrar($dni){
        if(isset($dni)){
            try {
                $this->leerReserva($dni);
            }catch (Exception $e){
                echo "No existe la persona Buscada".$e->getMessage();
            }
        }else{
            $this->leerTodasLasReservas();
        }
    }

    public function guardar(){
        $reserva=new ReservaParqueBolas($_POST['fecha'],$_POST['numHoras'],$_POST['Clientes'],$_POST['costeHora']);
        $this->modelo->insertarReserva($reserva);
    }

    public function borrar($dni){
        if(isset($dni)){
            try {
                $this->modelo->borrarReservaPorCliente($dni);
            }catch(\MongoDB\Exception\Exception $e){
                header("Reserva no encontrada",true,500);
            }
        }else {
            $this->modelo->borrarTodasLasReservas();
        }
    }
}