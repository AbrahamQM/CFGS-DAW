package com.mycompany.aa10_22;

import java.io.BufferedReader;
import java.io.FileReader;
import java.util.Scanner;

public class Aa10_22 {

    public static void main(String[] args) {
        int cant = 0, edadTotal = 0;
        double pesoTotal = 0, estaturaTotal = 0;
        BufferedReader in = null;
        String linea = "";
        Scanner sc;
        try {
            in = new BufferedReader(new FileReader("deportistas.txt"));
            linea = in.readLine();
            System.out.println(linea);
            while (linea != null) {
                linea = in.readLine();
                if(linea != null){
                    System.out.println(linea);
                    sc = new Scanner(linea);
                    cant++;
                    while (!sc.hasNextInt()) {
                        sc.next();
                    }
                    while (sc.hasNext()) {
                        edadTotal += sc.nextInt();
                        pesoTotal += sc.nextDouble();
                        estaturaTotal += sc.nextDouble();
                    }
                    sc.close();
                }
            }
            in.close();
            System.out.println("Media de edad: " + edadTotal / cant);
            System.out.println("Media de peso: " +  
                    Math.round(pesoTotal / cant * 100) / 100);
            System.out.println("Media de estatura: " + 
                    Math.round(estaturaTotal / cant* 100) / 100);
        } catch (Exception e) {
            System.out.println("Se ha producido una excepción: " + e.getMessage());
        }
    }
}
