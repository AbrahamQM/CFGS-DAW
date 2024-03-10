package com.mycompany.aa6_20;

import java.util.Arrays;
import java.util.Scanner;

public class Aa6_20 {

    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        System.out.println("Introduzca texto: ");
        String texto = sc.nextLine();
        String[] palabras = texto.toLowerCase().split(" ");
        Arrays.sort(palabras);
        System.out.println("Resultado:");
        for(String palabra : palabras){
            System.out.println(palabra);
        }
    }
}
