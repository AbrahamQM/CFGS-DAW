<?php
/**
 * Definición de MyClass
 * Fuente: https://www.php.net/manual/es/language.oop5.visibility.php
 */
class MyClass {
	
	// Definimos las propiedades public, proteted y private
    public $public = 'Public';
    protected $protected = 'Protected';
    private $private = 'Private';

    function printHello() {
        echo $this->public;
        echo $this->protected;
        echo $this->private;
    }
}

// Generamos un objeto de la clase MyClass
$obj = new MyClass();

echo $obj->public; // Funciona

// No se pueden acceder a las propiedades proteted (solo pueden ser accesibles desde la misma clase o las clases que heredan
// y private esta restringido para la clase que los ha declarado
echo $obj->protected; // Error fatal
echo $obj->private; // Error fatal

$obj->printHello(); // Muestra Public, Protected y Private


/**
 * Definición de MyClass2
 * Fuente: https://www.php.net/manual/es/language.oop5.visibility.php
 */
class MyClass2 extends MyClass
{
    // Se pueden redeclarar las propiedades públicas o protegidas, pero no las privadas
    public $public = 'Public2';
    protected $protected = 'Protected2';

    function printHello() {
      echo $this->public;
      echo $this->protected;
      echo $this->private;			// Private de la clase MyClass
   }
}

// Generamos un objeto de la clase MyClass2
$obj2 = new MyClass2();

echo $obj2->public; // Funciona

echo $obj2->protected; // Error fatal
echo $obj2->private; // Indefinido

$obj2->printHello(); // Muestra Public2, Protected2 y Undefined (Indefinido)
?>