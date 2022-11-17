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

    public function login(){
        echo "Esta es la página del login";
    }

    public function mostrar($dni){
        echo $dni;
        //echo json_encode($this->modelo->leerTodasLasPersonas(),JSON_PRETTY_PRINT);
    }

    public function guardar(){
        echo "Esta intentando guardar";
    }

    public function borrar(){
        echo "Esta intentando borrar";
    }

    public function modificar(){
        echo "Esta intentando modificar";
    }

}