<?php

namespace Controlador\Personas;

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

    /**
     * @return personaDAO
     */
    public function getModelo(): personaDAO
    {
        return $this->modelo;
    }

    /**
     * @param personaDAO $modelo
     * @return PersonaControlador
     */
    public function setModelo(personaDAO $modelo): PersonaControlador
    {
        $this->modelo = $modelo;
        return $this;
    }

    /**
     * @return personaVista
     */
    public function getVista(): personaVista
    {
        return $this->vista;
    }

    /**
     * @param personaVista $vista
     * @return PersonaControlador
     */
    public function setVista(personaVista $vista): PersonaControlador
    {
        $this->vista = $vista;
        return $this;
    }




}