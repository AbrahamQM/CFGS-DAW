package com.mycompany.aa8_16;

public class Pila extends Lista{

   public Pila() {
      super(); 
   }

   void apilar(Integer elemento) {
      super.insertarFinal(elemento);
   }

   Integer desapilar() {
      return super.eliminar(super.tabla.length - 1);
   }

   @Override
   public String toString() {
      return super.mostrar();
   }
}
