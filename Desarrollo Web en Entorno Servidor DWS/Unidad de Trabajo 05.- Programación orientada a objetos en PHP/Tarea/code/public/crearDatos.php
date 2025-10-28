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
            $faker->date('Y-m-d', '2005-12-31'),
            $faker->unique()->numberBetween(1, 99),
            $faker->randomElement(['Portero','Defensa','Lateral Izquierdo','Lateral Derecho','Central','Delantero']),
            $faker->unique()->ean13()
        );
        $jugador->insertar();
    }
    
} catch (Exception $e) {
    echo "Error al crear datos: " . $e->getMessage();
}
//redirigimos a la página de jugadores
header('Location: jugadores.php');