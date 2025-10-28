<!-- vista de el listado de jugadores -->

<?php $this->layout('plantillas/plantilla1', ['titulo' => 'Listado de Jugadores']) ?>

<?php $this->start('contenido') ?>
    <h2>Listado de Jugadores</h2>
    <a href="fcrear.php">+ Nuevo Jugador</a>

    <?php if (!empty($jugadores)): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>Teléfono</th>
                    <th>Nacionalidad</th>
                    <th>Fecha Nacimiento</th>
                    <th>Posición</th>
                    <th>Dorsal</th>
                    <th>Código de Barras</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jugadores as $j): ?>
                    <tr>
                        <td><?= htmlspecialchars($j['nombre'] . ' ' . $j['apellidos']) ?></td>
                        <td><?= htmlspecialchars($j['telefono'] ?? '') ?></td>
                        <td><?= htmlspecialchars($j['nacionalidad']) ?></td>
                        <td><?= htmlspecialchars($j['fecha_nacimiento']) ?></td>
                        <td><?= htmlspecialchars($j['posicion']) ?></td>
                        <td><?= $j['dorsal'] ?? 'Sin asignar' ?></td>
                        <td><?= htmlspecialchars($j['barcode']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay jugadores en la base de datos.</p>
    <?php endif; ?>
<?php $this->stop() ?>
