<?php
/**
 * Archivo: listado.php
 * Página principal de la aplicación tras el login.
 * Muestra una tabla con los productos disponibles, incluyendo su nombre y precio.
 * El usuario puede votar productos en tiempo real mediante fetch(), sin recargar la página.
 */

session_start(); // Se inicia la sesión para mantener el usuario logueado

// Se comprueba si el usuario ha iniciado sesión y si no lo redirige a login.php
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Se carga la conexión a la base de datos
require_once __DIR__ . '/../bbdd/conexion_bbdd.php';
global $pdo;
//consulta para bbdd productos con la media aritmética redodeada de voto y el número de votos
$query = "SELECT p.id,
                p.nombre,
                p.pvp,
                ROUND(AVG(v.cantidad), 0) AS valoracion,
                COUNT(v.idUs) AS votos
            FROM productos p
            LEFT JOIN votos v
                ON p.id = v.idPr
            GROUP BY p.id, p.nombre, p.pvp
            ORDER BY p.id ASC;
        ";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de productos</title>
    <!-- Se carga la hoja de estilos principal -->
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
    <main>
        <h2>Listado de productos disponibles</h2>
        <p>Usuario conectado: <?php echo htmlspecialchars($_SESSION['usuario']); ?></p>
        <a href="../src/proceso_logout.php">Cerrar sesión</a>
        <br><br>
        <!-- Tabla de productos -->
        <table border="1">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Valoración/Votos</th>
                    <th>Votar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Se obtiene el listado de productos y sus votos (la media de cantidad y número de votos)
                $stmt = $pdo->query($query);
                while ($producto = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>{$producto['nombre']}</td>";
                    echo "<td>{$producto['pvp']} €</td>";
                    // Celda para mostrar la valoración y número de votos
                    // Se añade un id único para actualizarlo tras votar
                    // si no hay valoracion, se muestra "Sin valorar"
                    echo "<td id='valoracion_{$producto['id']}'>"
                        . (isset($producto['valoracion']) ? $producto['valoracion'] . '/' . $producto['votos']
                        : 'Sin valorar')
                        . "</td>";
                    // Select para votar del 1 al 5
                    echo "<td>";
                    echo "<select onchange='votarProducto({$producto['id']}, this.value)'>";
                    echo "<option value=''>--</option>";
                    for ($i = 1; $i <= 5; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    echo "</select>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

    <script>
        // Función que envía el voto mediante fetch
        async function votarProducto(idProducto, puntuacion) {
            if (!puntuacion) return; // Se evita enviar si no se selecciona nada

            try {
                const response = await fetch('../src/proceso_voto.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'idProducto=' + encodeURIComponent(idProducto) +
                        '&puntuacion=' + encodeURIComponent(puntuacion)
                });

                const result = await response.json();

                if (result.success) {
                    // Se actualiza la celda de valoración con la media y cantidad de votos
                    document.getElementById('valoracion_' + idProducto).innerHTML =
                        result.media + '/' + result.votos ;
                } else {
                    // Se muestra un alert con el mensaje de error si el usuario ya votó
                    alert(result.message);
                }
            } catch (error) {
                alert("Error de conexión con el servidor:\n" + error);
            }
        }
    </script>
</body>

</html>