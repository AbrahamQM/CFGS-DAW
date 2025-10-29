<!--
    vista de la página para crear/insertar datos de ejemplo
    solo necesita un botón para llamar a crearDatos y el título de la página
 -->

<?php $this->layout('plantillas/plantilla1', ['titulo' => $titulo]) ?>

<?php $this->start('contenido') ?>
    <h2>Página de instalación</h2>
    <a href="crearDatos.php">Instalar Datos de Ejemplo</a>
<?php $this->stop() ?>
