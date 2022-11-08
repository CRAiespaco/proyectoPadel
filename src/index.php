<?php


//    use \App\Persona;

    namespace App;

    use App\Horarios\Intervalo;
    use App\Personas\Enums\LadoPreferido;
    use App\Personas\Enums\ManoHabil;
    use App\Personas\Jugador;
    use App\Personas\Persona;
    use Modelo\PersonaDAOMySQL;

    include "autoload.php";

//    include_once("App/Personas/Persona.php");
//    include_once("App/Personas/Jugador.php");
//    include_once("App/Personas/Enums/ManoHabil.php");
//    include_once("App/Personas/Enums/LadoPreferido.php");
//    include_once("App/Horarios/Intervalo.php");

    /*$persona = new Persona('12345678A','Javier','Gonzalez');

//    var_dump($persona);
    echo "<br>";
    echo "<br>";

    $jugador = new Jugador("87654321A",
        "Rocio",
        "Carratala",
        1,
        ManoHabil::Izquierda,
        LadoPreferido::Izquierdo);

//    var_dump($jugador);

    $intervalo1 = new Intervalo(8.00,9.00);
    $intervalo2 = new Intervalo(9.00,10.00);
    $intervalo3 = new Intervalo(10.00,11.00);

    var_dump($intervalo1);

    echo "<br>";

    var_dump($intervalo2);

    echo "<br>";

    var_dump($intervalo3);

    echo "<br>";

    $array = [$intervalo1,$intervalo2,$intervalo2];

    print_r($array);

    foreach ($array as $intervalo){

        echo "El intervalo comienza a las ".
            $intervalo->getHoraInicio()." y termina a las ".$intervalo->getHoraFin()."<br>";


    }

    echo "<br> Resultado de la búsqueda: ". array_search($intervalo2,$array);*/

    $personaDAO = new PersonaDAOMySQL();

    $personaAModificar = new Persona('44111222A','Javier','Azpeleta',
    'javieraz@gmail.com','1234',"987653421");

    $resultado = $personaDAO->borrarPersona($personaAModificar);

    var_dump($resultado);