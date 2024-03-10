package com.mycompany.aa8_12;

public class Aa8_12 {

    public static void main(String[] args) {
        // TODO code application logic here

        Unidad Unidades = Unidad.M;
        Caja cajaGrande = new Caja(1, 2, 3, Unidades);

        Unidades = Unidad.CM;
        Caja cajaPequeña = new Caja(3, 3, 5, Unidades);

        System.out.println((double) cajaGrande.getVolumen());

        System.out.println((double) cajaPequeña.getVolumen());

        cajaGrande.setEtiqueta("Monitor");
        cajaPequeña.etiqueta = "Raton";

        System.out.println(cajaGrande.etiqueta);
        System.out.println(cajaPequeña.etiqueta);

        System.out.println(cajaGrande);
        System.out.println(cajaPequeña);
    }

}
