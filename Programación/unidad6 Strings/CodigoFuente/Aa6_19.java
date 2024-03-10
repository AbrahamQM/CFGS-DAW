package com.mycompany.aa6_19;

import java.util.Scanner;

public class Aa6_19 {

    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        System.out.println("Introduzca texto: ");
        String texto = sc.nextLine();
        System.out.println("Introduzca palabra a sustituir: ");
        String sustituida = sc.nextLine();
        System.out.println("Introduzca palabra sustituta: ");
        String sustituta = sc.nextLine();
        texto = texto.replaceAll(sustituida, sustituta);
        System.out.println("Resultado:\n" + texto);
    }
}
