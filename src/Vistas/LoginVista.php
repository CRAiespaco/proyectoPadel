<?php

namespace Vistas;

use Vistas\Plantillas\Plantilla;

class LoginVista{
    private Plantilla $html;

    public function __construct(){
        $this->html=new Plantilla("Login de usuarios",encabezadoPrincipal:"cobra padel", descripcionPrincipal:Login"Inicia sesón para acceder a tu cuenta");
        $this->html->generarDosColumnasConFondoBlnco("Introduce tus datos",$this->generarFormularioLogin(),$this->generarFormulariosRegistro());
    }

    public function generarFormulariosRegistro():string{
        $salida="
            <form action='/api/persona' metho='post'>
                <label for='inputDNI'>Introduce tu DNI</label>
                <input type='text' name='dni' id='inputDNI'>
                <label for='inputNombre'>Introduce tu nombre</label>
                <input type='text' name='nombre' id='inputNombre'>
                <label for='inputApellidos'>Introduce tus apellidos</label>
                <input type='text' name='apellidos' id='inputApellidos'>
                <label for='inputCorreo'>Introduce tu correo</label>
                <input type='email' name='correo' id='inputCorreo'>
                <label for='inputTelefono'>Introduce tu telefono</label>
                <input type='tel' name='telefono' id='inputTelefono'>
                <label for='inputCorreo'>Introduce tu correo</label>
                <input type='email' name='correo' id='inputCorreo'>
                <label for='inputContrasenya'>Introduce tu contraseña</label>
                <input type='password' name='contrasenya' id='inputContrasenya'>
                <button type='submit'>Enviar</button>
            </form>
        ";
        return  $salida;
    }

    public function generarFormularioLogin():string{
        $salida="
            <form action='/logear' metho='post'>
                <label for='inputCorreo'>Introduce tu correo</label>
                <input type='email' name='correoelectronico' id='inputCorreo'>
                <label for='inputContrasenya'>Introduce tu contraseña</label>
                <input type='password' name='contrasenya' id='inputContrasenya'>
                <button type='submit'>Enviar</button>
            </form>
        ";
    }

    public function mostarLogin():void{
        echo $this->html->generarTodaLaPagina();
    }

}