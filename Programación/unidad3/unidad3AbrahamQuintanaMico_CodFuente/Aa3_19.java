package com.mycompany.aa3_19;

import java.util.Scanner;

public class Aa3_19 {

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        int resto = 0;
        int raiz = 0;
        int numero;
        boolean continuar = true;
        System.out.print("Ingresa un número para calcular su raíz cuadrada: ");
        numero = scanner.nextInt();
        scanner.close();

        if (numero < 0) {
            System.out.println("No se puede calcular la raíz cuadrada de "
                    + "un número negativo.");
        }

        for (int i = 1; continuar; i++) {
            int result = i * i;
            if (result < numero) {
                raiz = i;
                resto = numero - result;
            } else {
                continuar = false;
            }
        }
        System.out.println("La raíz cuadrada aproximada de " + numero
                + " es: " + raiz + " el resto es " + resto);
    }
}
