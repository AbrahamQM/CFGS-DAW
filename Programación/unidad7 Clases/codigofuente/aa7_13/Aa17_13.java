package com.mycompany.aa7_13;

import java.util.Arrays;

public class Aa7_13 {
   public static void main(String[] args) {
      Colores colores = new Colores();
      colores.addColor("Marrón");
      colores.addColor("Azul");
      colores.addColor("Amarillo");
      colores.addColor("Celeste");
      colores.addColor("Rosa");
      
      System.out.println(Arrays.toString(colores.seleccionColores(3)));
   }
}
