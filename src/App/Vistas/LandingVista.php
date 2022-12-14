<?php

namespace App\Vistas;

use App\Vistas\Plantillas\Plantilla;

class LandingVista
{
    private Plantilla $html;

    public function __construct()
    {
        //session_start();
        if (isset($_SESSION['logeado'])){
            $this->html = new Plantilla("Cobra Padel",encabezadoPrincipal: "Cobra Pádel",
                descripcionPrincipal: "Si amas el pádel este es tu lugar, bienvenido",
                menu: ['Inicio'=>'/','Log-Out'=>'/logout','Pistas'=>'/pistas']);
        }else{
            $this->html = new Plantilla("Cobra Padel",encabezadoPrincipal: "Cobra Pádel",
                descripcionPrincipal: "Si amas el pádel este es tu lugar, bienvenido",
                menu: ['Inicio'=>'/','Log-In'=>'/login','Pistas'=>'/pistas']);
        }

        $this->html->generarTestimonio();
        $this->html->generarServicios();
        $this->html->generarPrecios();
        $this->html->generarEmpleados();
    }

    public function mostrarPagina():void{
        session_start();
        echo $this->html->generarWebCompleta();
    }


}