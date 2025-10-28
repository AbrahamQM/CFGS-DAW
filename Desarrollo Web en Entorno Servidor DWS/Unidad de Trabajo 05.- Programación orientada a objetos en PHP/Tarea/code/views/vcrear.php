<!-- vista del formulario para crear un jugador introduciendo los datos.
     Incluye los campos necesarios y permite generar un código de barras único.
     Si se llega desde generarCode.php, el campo barcode se precarga automáticamente.
-->

<?php $this->layout('plantillas/plantilla1', ['titulo' => 'Crear Jugador']) ?>

<?php $this->start('contenido') ?>
    <h2>Crear Jugador</h2>

    <form action="crearJugador.php" method="post">
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label>Apellidos:</label>
        <input type="text" name="apellidos" required><br>

        <label>Teléfono:</label>
        <input type="text" name="telefono"><br>

        <label>Nacionalidad:</label>
        <input type="text" name="nacionalidad" required><br>

        <label>Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento"><br>

        <label>Dorsal:</label>
        <input type="number" name="dorsal"><br>

        <label>Posición:</label>
        <select name="posicion">
            <option>Portero</option>
            <option>Defensa</option>
            <option>Lateral Izquierdo</option>
            <option>Lateral Derecho</option>
            <option>Central</option>
            <option>Delantero</option>
        </select><br>

        <!-- Campo de código de barras: se rellena automáticamente si llega por GET -->
        <label>Código de Barras:</label>
        <input type="text" name="barcode" readonly value="<?= htmlspecialchars($barcode ?? '') ?>">
        <a href="generarCode.php">Generar Barcode</a><br><br>

        <!-- Botones de acción: crear, limpiar y volver al listado -->
        <button type="submit">Crear</button>
        <button type="reset">Limpiar</button>
        <a href="jugadores.php">Volver</a>
    </form>
<?php $this->stop() ?>
