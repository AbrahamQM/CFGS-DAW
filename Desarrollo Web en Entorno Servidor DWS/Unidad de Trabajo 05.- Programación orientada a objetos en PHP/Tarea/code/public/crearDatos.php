<!--
    Código para crear datos de ejemplo (5 Jugadorees cada vez) usando faker
    y lo inserta en bbdd directamente usando el método insertar de la clase Jugador
    tambien maneja errores si los hay
    finalmente redirige a la página de listado de jugadores
 -->

<?php
require __DIR__ . '/../vendor/autoload.php';

use Faker\Factory as Faker;
use Abraham\Code\Jugador;

// Crear datos de ejemplo con faker
try {
    $faker = Faker::create();

    for ($i = 0; $i < 5; $i++) {
        $jugador = new Jugador(
            $faker->firstName,
            $faker->lastName,
            $faker->numerify('#########'),
            $faker->country,
            $faker->date('Y-m-d', '2007-10-30'), //suponemos que no son menores de 18 años
            $faker->unique()->numberBetween(1, 99),
            $faker->randomElement(['Portero','Defensa','Lateral Izquierdo','Lateral Derecho','Central','Delantero']),
            $faker->unique()->ean13() //código de barras único
        );
        $jugador->insertar();
    }
//errores
} catch (Exception $e) { 
    echo "Error al crear datos: " . $e->getMessage();
}
//redirigimos a la página de jugadores
header('Location: jugadores.php');
