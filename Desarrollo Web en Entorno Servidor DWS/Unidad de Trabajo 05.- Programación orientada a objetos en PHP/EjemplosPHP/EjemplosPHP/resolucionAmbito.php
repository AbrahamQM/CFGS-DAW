<?php
/*
	El operador resolución de ámbito (::)
	Fuente: https://www.php.net/manual/es/language.oop5.paamayim-nekudotayim.php
*/

//Ejemplo 1 :: fuera de la definición de la clase
class MyClass {
    const CONST_VALUE = 'Un valor constante';
}

// Creación de los objetos 
$classname = 'MyClass';
echo $classname::CONST_VALUE;			// Llamada por variable
echo MyClass::CONST_VALUE;				// Llamada por clase
?>

<?php
// Tres palabras clave especiales, self, parent, y static son utilizadas para acceder a las propiedades o a los métodos desde la definición de la clase.
// Ejemplo #2 :: desde la definición de la clase
class MyClass {
    const CONST_VALUE = 'Un valor constante';
}

class OtherClass extends MyClass {
    public static $my_static = 'variable estática';

    public static function doubleColon() {
        echo parent::CONST_VALUE . "\n";				// Llamada a la constante del PADRE y añadir a la contante el retorno de carro (\n)
        echo self::$my_static . "\n";					// 
    }
}

// Creación de los objetos
$classname = 'OtherClass';
$classname::doubleColon();			// Llamada por variable

OtherClass::doubleColon();			// Llamada por clase
?>