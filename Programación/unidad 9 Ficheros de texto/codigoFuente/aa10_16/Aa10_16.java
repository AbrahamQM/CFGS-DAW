package com.mycompany.aa10_16;

import java.io.*;
import java.util.Scanner;

public class Aa10_16 {
    final static String FICHERO = "firmas.txt";

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        String nombre = "";

        try {
            System.out.println("Estado actual del libro de firmas:\n" 
                    + leeLibro());
            System.out.println("Introduza nuevo nombre a introducir");
            nombre = scanner.nextLine();
            inserta(nombre);
            System.out.println("Estado final del libro de firmas:\n" 
                    + leeLibro());
        } catch (Exception e) {
            System.out.println(e);
        }
    }

    static String leeLibro() throws FileNotFoundException, IOException {
        BufferedReader in = new BufferedReader(new FileReader(FICHERO));
        String firmas = "";
        String linea = in.readLine();
        while (linea != null) {
            firmas += linea + "\n";
            linea = in.readLine();
        }
        in.close();
        return firmas;
    }
    
    static void inserta(String nombre) throws IOException{
        BufferedWriter out = new BufferedWriter(new FileWriter(FICHERO, true));
        if(leeLibro().contains(nombre)){
            System.out.println("Error, el nombre ya existe en el fichero\n");
        }else{
            out.newLine();
            out.write(nombre);
        }
        out.close();
    }
}
