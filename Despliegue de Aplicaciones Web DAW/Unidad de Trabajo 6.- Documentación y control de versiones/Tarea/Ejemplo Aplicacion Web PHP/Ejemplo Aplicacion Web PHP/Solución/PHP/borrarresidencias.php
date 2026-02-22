
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<link href="styles.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>

<?php
/**
 * Script encargado de ejecutar el borrado de una residencia escolar.
 *
 * Recibe el código de residencia mediante POST desde F_borrarresidencias.php,
 * ejecuta la sentencia DELETE correspondiente y redirige al listado principal.
 * Si la eliminación no se realiza, muestra un mensaje de error.
 *
 * @author Abraham
 * @version 1.0
 * @since 2026
 */

try
    {
    /** Conexión a la base de datos */
    include 'Conexion.php';

    /** 
     * Muestra el código de residencia recibido (debug/confirmación).
     *
     * @var string $_POST['codResidencia']
     */
    echo $_POST['codResidencia'];

    /**
     * Datos enviados al DELETE.
     *
     * @var array $datos Contiene el código de residencia a eliminar
     */
    $datos= array($_POST['codResidencia']);

    /**
     * Sentencia SQL para eliminar la residencia seleccionada.
     *
     * @var PDOStatement $stmt
     */
    $stmt=$pdo->prepare('DELETE FROM residencias WHERE codResidencia=?');
    $stmt->execute($datos);

    /**
     * Comprobación del resultado del borrado.
     */
    if ($stmt->rowcount() == 0) 
        {$pdo=null;
    
        echo "Error: borrado no realizada."; 
        echo "<meta http-equiv='refresh' content='2; url=http://localhost/PHP/ResidenciaEscolares.php'>";
        }
    else
        {$pdo=null;
    
        header('Location: http://localhost/PHP/ResidenciaEscolares.php');}
    }
catch(PDOException $err)
    {
    /**
     * Captura de errores SQL o de conexión.
     *
     * @param PDOException $err
     */
    echo "Error: ejecutando SQL."; 
    echo $err->getMessage();
    }

?>

</body>
</html>
