package com.mycompany.aa3_15;

import java.util.Scanner;

public class Aa3_15 {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        System.out.print("Ingresa el número de filas para el Triángulo de Pascal: ");
        int numRows = scanner.nextInt();

        for (int i = 0; i < numRows+1; i++) {
            // Calcular y mostrar los números en la fila
            int coeficiente = 1;
            for (int j = 0; j <= i; j++) {
                System.out.print(coeficiente + " ");
                coeficiente = coeficiente * (i - j) / (j + 1);
            }
            // Cambiar de línea para la siguiente fila
            System.out.println();
        }
    }
}
