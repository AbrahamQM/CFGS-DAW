package com.mycompany.aa10_23;

import java.io.*;
import java.util.Scanner;

public class Aa10_23 {

 public static void main(String[] args) {
        int edad = 0;
        double peso = 0, estatura = 0;
        BufferedReader in;
        BufferedWriter outEdad, outPeso, outEstatura;
        String linea, nombre;
        Scanner sc;
        final String cabeceraEdad = "Nombre                      Edad";
        final String cabeceraPeso = "Nombre                      Peso";
        final String cabeceraEstatuta = "Nombre                      Estatura";
        try {
            in = new BufferedReader(new FileReader("deportistas.txt"));
            outEdad = new BufferedWriter(new FileWriter("Edades.txt"));
            outPeso = new BufferedWriter(new FileWriter("Pesos.txt"));
            outEstatura = new BufferedWriter(new FileWriter("Estaturas.txt"));
            outEdad.write(cabeceraEdad);
            outPeso.write(cabeceraPeso);
            outEstatura.write(cabeceraEstatuta);
            linea = in.readLine();
            while (linea != null) {
                linea = in.readLine();
                if(linea != null){
                    nombre = "";
                    sc = new Scanner(linea);
                    while (!sc.hasNextInt()) {
                        nombre += " " +sc.next();
                    }
                    while (sc.hasNext()) {
                        edad = sc.nextInt();
                        peso = sc.nextDouble();
                        estatura = sc.nextDouble();
                    }
                    sc.close();
                    outEdad.newLine();
                    outEdad.append(nombre + "          " + edad);
                    outPeso.newLine();
                    outPeso.append(nombre + "          " + peso);
                    outEstatura.newLine();
                    outEstatura.append(nombre + "          " + estatura);
                }
            }
            outEdad.close();
            outEstatura.close();
            outPeso.close();
            in.close();
        } catch (Exception e) {
            System.out.println("Se ha producido una excepción: " + e.getMessage());
        }
    }
}
