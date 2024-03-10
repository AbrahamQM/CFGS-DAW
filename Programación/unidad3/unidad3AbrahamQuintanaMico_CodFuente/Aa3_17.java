package com.mycompany.aa3_17;

import java.util.Scanner;

public class Aa3_17 {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        System.out.print("Ingresa el primer número: ");
        int numero1 = scanner.nextInt();
        System.out.print("Ingresa el segundo número: ");
        int numero2 = scanner.nextInt();
        // Calcular y mostrar el MCD
        int mcd = calcularMCD(numero1, numero2);
        System.out.println("El MaximoComunDivisor de " + numero1 + " y " 
                + numero2 + " es: " + mcd);
    
    }
    static int calcularMCD(int a, int b) {
        while (b != 0) {
            int temp = b;
            b = a % b;
            a = temp;
        }
        return a;
    }
}