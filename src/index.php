<?php

namespace App;

use App\Personas\Persona;
use Controlador\Personas\PersonaControlador;
use Modelo\Personas\PersonaDAOMySQL;
use Vistas\Personas\PersonaVista;
use Vistas\Plantillas\Plantilla;

include __DIR__."/autoload.php";

/*echo "<pre>";
var_dump($_SERVER);
echo "</pre>";
echo $_SERVER['REQUEST_URI']."<br>";
echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);*/

/*if(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)==='persona'){
    $persona=new PersonaControlador();
    $persona->crear();
}*/

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

$router->resolverRuta($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);

$plantilla = new Plantilla("Prueba");
echo $plantilla->generarTodaLaPagina();

