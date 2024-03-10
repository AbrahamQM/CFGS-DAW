package com.mycompany.aa7_11;

public class Aa7_11 {
   public static void main(String[] args) {
      Marcapagina marca;
      marca = new Marcapagina();
      marca.siguientePag();
      marca.siguientePag();
      marca.siguientePag();
      System.out.println("Última página: " + marca.ultimaPaginaLeida());
      marca.comenzar();
      System.out.println("Última página: " + marca.ultimaPaginaLeida());
   }
}