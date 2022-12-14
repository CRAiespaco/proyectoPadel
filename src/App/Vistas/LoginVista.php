<?php

namespace App\Vistas;

use App\Vistas\Plantillas\Plantilla;

class LoginVista
{
    private Plantilla $html;

    public function __construct()
    {
        $this->html= new Plantilla("Login de usuarios",encabezadoPrincipal: "Cobra Padel",
            descripcionPrincipal:"Inicia sesión para acceder a tu cuenta");
        $this->html->generarDosColumnasConFondoBlanco
        ("Introduce tus datos",
            $this->generarFormularioLogin(),
            $this->generarFormularioRegistro());
    }

    public function generarFormularioLogin():string{

        $salida="
            <form action='/logear' method='post'>
            <label for='inputCorreo'>Introduce tu correo</label>
            <input type='email' name='correoelectronico' id='inputCorreo'>
            <label for='inputContrasenya'>Introduce tu contraseña</label>
            <input type='password' name='contrasenya' id='inputContrasenya'>
            <button type='submit'>Enviar</button>
            </form>
        ";
        return $salida;
    }

    public function generarFormularioRegistro():string{
        $salida="
            <form action='/api/persona' method='post'>
            <label for='inputDNI'>Introduce tu dni</label>
            <input type='text' name='dni' id='inputDNI'>
             <label for='inputNombre'>Introduce tu nombre</label>
            <input type='text' name='nombre' id='inputNombre'>
             <label for='inputApellidos'>Introduce tus apellidos</label>
            <input type='text' name='apellidos' id='inputApellidos'>
            <label for='inputTelefono'>Introduce tu telefono</label>
            <input type='tel' name='telefono' id='inputTelefono'>
            <label for='inputCorreo'>Introduce tu correo</label>
            <input type='email' name='correoelectronico' id='inputCorreo'>
            <label for='inputContrasenya'>Introduce tu contraseña</label>
            <input type='password' name='contrasenya' id='inputContrasenya'>
            <button type='submit'>Registro</button>
            
            </form>
        ";
        return $salida;

    }
    public function mostrarLogin():void{
        echo $this->html->generarWebCompleta();
    }


}