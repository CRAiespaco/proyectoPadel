<?php

namespace Controlador\Personas;

use App\Personas\Persona;
use Modelo\Personas\PersonaDAO;
use Modelo\Personas\PersonaDAOMySQL;



class PersonaControlador
{
    private personaDAO $modelo;
    private personaVista $vista;

    /**
     * @param personaDAO $modelo
     * @param personaVista $vista
     */
    public function __construct()
    {
        $this->modelo = new personaDAOMySQL();
        //$this->vista = new personaVista();
    }
    public function comprobarUsuarioWeb($correoUsuario, $pass){
        $persona=$this->modelo->leerPersonaPorCorreoElectronico($correoUsuario);
        password_verify($pass,$persona->getContrasenya());
    }

    public function crear(){
        $passCifrado = password_hash("1234",PASSWORD_DEFAULT);
        $persona = new Persona('12345378R','Maria','Pepa','javierraz@gmail.com',$passCifrado,'654789321');
        $this->modelo->insertarPersona($persona);
    }

}