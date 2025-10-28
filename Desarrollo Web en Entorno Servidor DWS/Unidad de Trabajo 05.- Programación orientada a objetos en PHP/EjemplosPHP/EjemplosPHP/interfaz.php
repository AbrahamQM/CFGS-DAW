<?php
/*
  Ejemplo de interfaz
  Fuente: https://www.php.net/manual/es/language.oop5.interfaces.php
*/

// Ejemplo de propiedades de interfaz
interface Template {
    public function setVariable($name, $var);
    public function getHtml($template);
}

// Implementación de la interfaz
// Esto funcionará
class WorkingTemplate implements Template {
	// Propiedad propia de WorkingTemplate
    private $vars = [];

	// Métodos que se deben implementar de Template
    public function setVariable($name, $var) {
        $this->vars[$name] = $var;
    }

    public function getHtml($template) {
        foreach($this->vars as $name => $value) {
            $template = str_replace('{' . $name . '}', $value, $template);
        }
        return $template;
    }
}

// Esto no funcionará
// Fatal error: el método getHTML no se encuentra definido
class BadTemplate implements Template
{	// Propiedad propia de BadTemplate
    private $vars = [];

	// Métodos que se deben implementar de Template
    public function setVariable($name, $var) {
        $this->vars[$name] = $var;
    }
	
	// Falta el getHTML($template)
}

?>

<?php

// Interfaces extendidas

// Se declara una interfaz A con un método foo
interface A {
    public function foo();
}

// Se declara una interfaz B que extiende la interfaz A con un método baz
interface B extends A {
    public function baz(Baz $baz);
}

// La clase C implementa la interfaz B (A + B)

class C implements B {
	// Método de la clase A
    public function foo() {
    }

	// Método de la clase B
    public function baz(Baz $baz) {
    }
}

// La clase D también implementa la interfaz B (A + B)
class D implements B {
    // Método de la clase A
	public function foo() {
    }

	// Nuevo método de la clase D
    public function baz(Foo $foo) {
    }
	
	// No se ha declarado el método de la clase B
}
?>