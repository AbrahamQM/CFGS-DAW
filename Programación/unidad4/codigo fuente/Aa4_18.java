package com.mycompany.aa4_18;

import java.util.Random;
import java.util.Scanner;

public class Aa4_18 {

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        System.out.println("Introduzca cuantos numeros aleatorios quiere: ");
        int cantidad = scanner.nextInt();
        System.out.println("Introduzca valor mínimo de los numeros aleatorios: ");
        int min = scanner.nextInt();
        System.out.println("Introduzca valor máximo de los numeros aleatorios: ");
        int max = scanner.nextInt();

        imprimirNumeros(cantidad, min, max);
    }

    static void imprimirNumeros(int cantidad, int min, int max) {
        Random rand = new Random();
        for (int i = 0; i < cantidad; i++) {
            int numeroAleatorio = rand.nextInt((max - min) + 1) + min;
            System.out.println("Número aleatorio: " + numeroAleatorio);
        }
    }
}
