<!-- vista de el listado de jugadores -->
<!-- Importamos para mostrar el código de barras -->
<?php
use Milon\Barcode\DNS1D;
?>

<?php $this->layout('plantillas/plantilla1', ['titulo' => 'Listado de Jugadores']) ?>

<?php $this->start('contenido') ?>
<h2>Listado de Jugadores</h2>
<a href="fcrear.php">+ Nuevo Jugador</a>

<?php if (!empty($jugadores)): ?>
    <div class="tabla-contenedor">
        <table border="2">
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
                        <!-- el código de barras con control de errores para controlar problemas -->
                        <td>
                            <?php
                            try {
                                $dns1d = new DNS1D();
                                $dns1d->setStorPath(__DIR__ . '/../../cache'); // ruta a la carpeta cache
                                $barcodeImg = $dns1d->getBarcodePNG($j['barcode'], 'EAN13');
                                echo '<img src="data:image/png;base64,' . $barcodeImg . '" alt="barcode" />';
                            } catch (Throwable $e) {
                                echo htmlspecialchars($j['barcode']); // fallback: mostrar el número
                            }
                            ?>
                            <br>
                            <?= htmlspecialchars($j['barcode']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>No hay jugadores en la base de datos.</p>
<?php endif; ?>
<?php $this->stop() ?>