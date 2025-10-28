<?php
// Fuente: https://www.php.net/manual/es/language.oop5.serialization.php
// A.php :

  class A {
      public $one = 1;

      public function show_one() {
          echo $this->one;
      }
  }

// page1.php :

  include "A.php";

  $a = new A;
  $s = serialize($a);
  
  // guarda $s en algún lugar donde page2.php pueda encontrarlo
  file_put_contents('store', $s);


// page2.php :

  // se necesita la definición de la clase
  // para que unserialize() funcione
  include "A.php";

  $s = file_get_contents('store');
  $a = unserialize($s);

  // llamada a show_one() en el objeto $a, muestra 1
  $a->show_one();
?>