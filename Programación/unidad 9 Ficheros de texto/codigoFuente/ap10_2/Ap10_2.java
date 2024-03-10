package com.mycompany.ap10_2;

import java.util.Scanner;

public class Ap10_2 {
    public static void main(String[] args) {
        Scanner sc;
        String linea;
        try {
            sc = new Scanner(System.in);
            System.out.println("Introduzca nombre: ");
            linea = sc.nextLine();
            System.out.println("Introduzca edad: ");
            linea += " " + sc.nextInt();
            System.out.println("Introduzca estatura en metros: ");
            linea += " " + sc.nextDouble();
            sc.close();
            sc = new Scanner(linea);
            System.out.println("Nombre: ");
            while (!sc.hasNextInt()) {
                System.out.print( sc.next() + " ");
            }
            System.out.print("\nEdad: ");
            System.out.println(sc.next());
            System.out.print("Estatura: ");
            System.out.println( sc.next());
            sc.close();
        } catch (Exception e) {
            System.out.println("Se ha producido una excepción: " + e);
        }
    }
}
