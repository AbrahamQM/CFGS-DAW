package com.mycompany.aa6_17;

import java.util.Scanner;

public class Aa6_17 {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        System.out.println("Introduzca palabra a dividir: ");
        String palabra = sc.nextLine();
        System.out.println("Cada cuantas letras desea dividirlo: ");
        int letras = sc.nextInt();
        dividir(palabra, letras);
    }
    
    static void dividir(String palabra, int letras){
        String[] dividida = new String[(palabra.length() / letras) + 1];
        int longitud = palabra.length();
        int indice = 0;
        for(int i = 0; indice < longitud; i++){
            if(indice + letras < longitud -1){
                dividida[i] = palabra.substring(indice, indice + letras);
                indice += letras;
            }else{
                dividida[i] = palabra.substring(indice, longitud);
                indice += letras;
            }
            System.out.println(dividida[i]);
        }
    }
}
