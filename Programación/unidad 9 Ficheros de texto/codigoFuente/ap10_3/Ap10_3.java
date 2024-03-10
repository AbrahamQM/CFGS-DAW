package com.mycompany.ap10_3;

import java.io.BufferedReader;
import java.io.FileReader;
import java.util.Scanner;

public class Ap10_3 {

    public static void main(String[] args) {
        int cant = 0, edadTotal = 0;
        double estaturaTotal = 0;
        BufferedReader in = null;
        String linea = "";
        Scanner sc;
        try {
            in = new BufferedReader(new FileReader("jugadores.txt"));
            linea = in.readLine();
            System.out.println("Nombres:");
            while (linea != null) {
                sc = new Scanner(linea);
                System.out.println(sc.next());
                cant++;
                while (sc.hasNext()) {
                    edadTotal += sc.nextInt();
                    estaturaTotal += sc.nextDouble();
                }
                sc.close();
                linea = in.readLine();
            }
            in.close();
            System.out.println("Media de edad: " + edadTotal / cant);
            System.out.println("Media de estatura: " + String.format("%2f",
                    (estaturaTotal / cant)));
        } catch (Exception e) {
            System.out.println("Se ha producido una excepción: " + e.getMessage());
        }
    }
}
