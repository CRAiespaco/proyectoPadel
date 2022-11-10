<?php

namespace Vistas\Personas;

use Vistas\Plantilla\Plantilla;

class personaVista
{
    private Plantilla $html;

    public function __construct(string $titulo)
    {
        $html=new Plantilla("Datos Personales");

    }

    public function imprimirDatosPersona(Persona $persona):string{

        $salida=$this->html->generarTodaLaPagina();
        return $salida;
    }

}