package com.mycompany.aa4_19;

import java.util.Random;
import java.util.Scanner;

public class Aa4_19 {

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        System.out.println("Introduzca cuantos numeros aleatorios quiere: ");
        int cantidad = scanner.nextInt();
        imprimirNumeros(cantidad);
    }

    static void imprimirNumeros(int cantidad) {
        for (int i = 0; i < cantidad; i++) {
            double numeroAleatorio = Math.random();
            System.out.println("Número aleatorio: " + numeroAleatorio);
        }
    }

    static void imprimirNumeros(int cantidad, int min, int max) {
        Random rand = new Random();
        for (int i = 0; i < cantidad; i++) {
            int numeroAleatorio = rand.nextInt((max - min) + 1) + min;
            System.out.println("Número aleatorio: " + numeroAleatorio);
        }
    }
}
