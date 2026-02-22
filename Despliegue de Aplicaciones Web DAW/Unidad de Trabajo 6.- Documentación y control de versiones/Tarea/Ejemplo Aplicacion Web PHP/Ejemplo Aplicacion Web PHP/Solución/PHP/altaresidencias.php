<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<link href="styles.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>

<?php
/**
 * Procesa el alta de una residencia escolar.
 *
 * Recibe los datos enviados desde el formulario F_altaresidencias.php,
 * prepara los parámetros necesarios y ejecuta el procedimiento almacenado
 * Insertarresidencia. Finalmente redirige o muestra un mensaje de error.
 *
 * @author Abraham
 * @version 1.0
 * @since 2026
 */

try
    {
    include 'Conexion.php';
    
    /**
     * Conversión del checkbox "Comedor".
     *
     * @var int $Comedor 0 = comedor disponible, 1 = no disponible
     */
    switch($_POST['Comedor'])
        {case true:
        $Comedor = 0; 
        break;
        case null:
        $Comedor = 1;
        break;
        }
        
    /**
     * Datos enviados al procedimiento almacenado.
     *
     * @var array $datos
     */
    $datos= array($_POST['nomResidencia'],$_POST['codUniversidad'],$_POST['precioMensual'],$Comedor);

    /**
     * Llamada al procedimiento almacenado Insertarresidencia.
     *
     * @var PDOStatement $stmt
     */
    $stmt=$pdo->prepare("Call Insertarresidencia(?,?,?,?,@UniversidadExiste,@InsercionCorreta)");

    $stmt->execute($datos);
    
    /**
     * Comprobación del resultado de la inserción.
     */
    if ($stmt->rowcount() == 0) 
        {$pdo=null;
    
        echo "Error: inserción no realizada."; 
        echo "<meta http-equiv='refresh' content='2; url=http://localhost/PHP/ResidenciaEscolares.php'>";
        }
    else
        {$pdo=null;
    
        header('Location: http://localhost/PHP/ResidenciaEscolares.php');}
    }
catch(PDOException $err)
    {
    /**
     * Captura de errores SQL.
     *
     * @param PDOException $err
     */
    echo "Error: ejecutando SQL."; 
    echo $err->getMessage();
    }
?>

</body>
</html>
