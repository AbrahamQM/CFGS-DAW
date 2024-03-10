package com.mycompany.ap12_4;

import java.util.*;

public class Ap12_4 {

    public static void main(String[] args) {
        int num, suma = 0;
        Scanner sc = new Scanner(System.in);
        List<Integer> positivos = new ArrayList<>();
        List<Integer> negativos = new ArrayList<>();
        do {
            System.out.println("Introduzca un numero, o 0 para terminar:");
            num = sc.nextInt();
            if (num > 0) {
                positivos.add(num);
            } else if (num != 0) {
                negativos.add(num);
            }

        } while (num != 0);
        System.out.println("--Positivos:\n" + positivos);
        System.out.println("--Negativos:\n" + negativos);
        for (int numero : positivos) {
            suma += numero;
        }
        System.out.println("---Suma de Positivos:\n" + suma);
        suma = 0;
        for (int numero : negativos) {
            suma += numero;
        }
        System.out.println("---Suma de Negativos:\n" + suma);
    }
}
