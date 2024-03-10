package com.mycompany.aa6_18;

import java.util.Scanner;

public class Aa6_18 {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        System.out.println("Introduzca frase para crear la variable camelCase: ");
        String frase = sc.nextLine();
        String resultado = "";
        char[] caracteres = frase.toCharArray();
        for(int i=0; i<caracteres.length; i++){
            if(caracteres[i] == ' '){
                resultado += Character.toUpperCase(caracteres[i + 1]);
                i++;
            }else{
                resultado += Character.toLowerCase(caracteres[i]);
            }
        }
        System.out.println(resultado);
    }
}
