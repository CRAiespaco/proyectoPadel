<?php

namespace App;

use App\Controlador\Personas\PersonaControlador;
use App\Controlador\Servicios\PistaControlador;
use App\Modelo\Personas\PersonaDAOMongoDB;
use App\Vistas\LandingVista;
use App\Vistas\Plantillas\Plantilla;
use App\Vistas\LoginVista;
use App\Personas\Persona;

include __DIR__."/vendor/autoload.php";

/*echo "<pre>";
var_dump($_SERVER);
echo "</pre>";
echo $_SERVER['REQUEST_URI']."<br>";
echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);*/

/*if(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)==='persona'){
    $persona=new PersonaControlador();
    $persona->crear();
}*/
/*$mongodb=new PersonaDAOMongoDB();

$persona = new Persona('44111222B','Carlos','Marinez',
    'carlos@gmail.com','1234',"987653421");
//$mongodb->insertarPersona($persona);

$mongodb->modificarPersona($persona);*/

//var_dump($mongodb->leerTodasLasPersonas());

$router=new Router();
$router->guardarRuta('get','/',function(){
    echo "Estoy en el index";
});

$router->guardarRuta('get','/',[LandingVista::class,"mostrarPagina"]);
$router->guardarRuta('get','/login',[LoginVista::class,"mostrarLogin"]);
$router->guardarRuta('get','/logear',[PersonaControlador::class,"mostrarLogin"]);
$router->guardarRuta('get','/api/personas',[PersonaControlador::class,"mostrar"]);
$router->guardarRuta('post','/api/personas',[PersonaControlador::class,"guardar"]);
$router->guardarRuta('delete','/api/personas',[PersonaControlador::class,"borrar"]);
$router->guardarRuta('put','/api/personas',[PersonaControlador::class,"modificar"]);

$router->guardarRuta('get','/pistas',[PistaControlador::class,"mostrar"]);
$router->guardarRuta('post','/api/pistas',[PistaControlador::class,"guardar"]);
$router->guardarRuta('delete','/api/pistas',[PistaControlador::class,"borrar"]);
$router->guardarRuta('put','/api/pistas',[PistaControlador::class,"modificar"]);

$router->resolverRuta($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);
/*
$plantilla = new Plantilla("Prueba");
echo $plantilla->generarTodaLaPagina();*/

