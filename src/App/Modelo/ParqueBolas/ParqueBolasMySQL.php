<?php

namespace App\Modelo\ParqueBolas;

use App\Controlador\ParqueBolas\ParqueBolasControlador;
use App\ParqueBolas\ReservaParqueBolas;
use mysql_xdevapi\Exception;
use PDO;



/**
 * @method getConexion()
 */
class ParqueBolasMySQL extends ParqueBolasDAO{

    public function __construct(){
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

    public function calcularCostePorPersona(string $cliente1,string $cliente2,int $porcentaje1,int $porcentaje2,int $horas,float $precio):array{
        $costeTotal=$horas*$precio;
        return $this->Clientes=[
            [$cliente1,($porcentaje1*0.1)*$costeTotal],
            [$cliente2,($porcentaje2*0.1)*$costeTotal],
        ];
    }


    public function leerReserva(string $dni): ReservaParqueBolas
    {
        $query = "SELECT * FROM ReservaParqueBolas WHERE Cliente=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1, $dni);
        $sentencia->execute();

        if($fila = $sentencia->fetch()){
            return new ReservaParqueBolas(
                $fila['fecha'],
                $fila['numHoras'],
                $fila['Clientes'],
                $fila['costeHoras'],
            );

        }else{
            throw new \Exception("La Reserva no existe en la base de datos");
        }
    }

    public function leerTodasLasReservas(): array{
        $resultado = $this->getConexion()->query("SELECT * FROM ReservaParqueBolas");

        $resultado->execute();

        $arrayResultados = $resultado->fetchAll();

        $arrayObjetos=[];

        return $arrayObjetos;
    }

    public function insertarReserva(ReservaParqueBolas $reserva):?ReservaParqueBolas{
        $query = "INSERT INTO ReservaParqueBolas (fecha,numHoras,Clientes,costeHoras) 
                VALUES (:fecha,:numHoras,:Clientes,:costeHoras)";
        $sentencia = $this->getConexion()->prepare($query);

        $sentencia->bindValue("fecha", $reserva->getFecha());
        $sentencia->bindValue("numHoras", $reserva->getNumHoras());
        $sentencia->bindValue("Clientes", $reserva->getClientes());
        $sentencia->bindValue("costeHoras", $reserva->getCosteHora());

        $resultado = $sentencia->execute();

        if ($resultado) {
            return $reserva;
        } else {
            return null;
        }
    }

    public function borrarReservaPorCliente(string $dni)
    {
        try {
            $reserva=$this->leerReserva($dni);
        }catch(Exception $e){
            throw new Exception("No se pudo borrar, la reserva no existe");
        }
        $reserva = $this->leerReserva($dni);
        $query = "DELETE FROM ReservaParqueBolas WHERE DNI=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1, $dni);
        $resultado = $sentencia->execute();

        if ($resultado) {
            return $reserva;
        } else {
            return null;
        }
    }

    public function borrarTodasLasReservas(){
        $sentencia=$this->getConexion()->query("TRUNCATE ReservaParqueBolas");
        return $sentencia->execute();
    }
}