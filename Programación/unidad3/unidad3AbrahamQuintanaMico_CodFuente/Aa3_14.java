package com.mycompany.aa3_14;

import java.util.Scanner;

public class Aa3_14 {

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        System.out.print("Ingrese un número: ");
        int numeroIngresado = scanner.nextInt();
        int cantidadPrimos = contarPrimos(numeroIngresado);

        System.out.println("Cantidad de números primos entre 1 y " + numeroIngresado + ": " + cantidadPrimos);
        scanner.close();
    }

    private static int contarPrimos(int n) {
        int contadorPrimos = 1;

        for (int i = 1; i <= n; i++) {
            if (esPrimo(i)) {
                contadorPrimos++;
            }
        }
        return contadorPrimos;
    }

    static boolean esPrimo(int num) {
        if (num <= 1) {
            return false;
        }

        for (int i = 2; i <= Math.sqrt(num); i++) {
            if (num % i == 0) {
                return false;
            }
        }
        return true;
    }
}
