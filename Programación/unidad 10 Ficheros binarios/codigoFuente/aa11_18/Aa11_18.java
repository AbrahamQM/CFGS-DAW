package com.mycompany.aa11_18;

import java.io.*;
import java.util.Scanner;

public class Aa11_18 {

    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        String firma;

        try (ObjectOutputStream escritor = new ObjectOutputStream(new FileOutputStream(".\\firmas.dat"))) {
            do {
                System.out.println("Introduzca firma a guardar, pulse 1 "
                        + "para mostrar el contenido del libro y ENTER para salir:");
                firma = sc.nextLine();
                switch (firma) {
                    case ("") -> {
                    }
                    case ("1") -> {
                        try (ObjectInputStream lector = new ObjectInputStream(new FileInputStream(".\\firmas.dat"))) {
                            System.out.println("Resultado:\n");
                            while (true) {
                                System.out.println((String)lector.readObject());
                            }
                        } catch (EOFException e) {
                            System.out.println("***********Fin del fichero***********");
                        }
                    }
                    default -> {
                        escritor.writeObject(firma);
                        escritor.flush();
                    }
                }
            } while (!firma.equals(""));
        } catch (FileNotFoundException ex) {
            System.out.println("Excepción FileNotFoundException: " + ex);
        } catch (IOException ex) {
            System.out.println("Excepción IOException: " + ex);
        } catch (ClassNotFoundException ex) {
            System.out.println("Excepción ClassNotFoundException: " + ex);
        }
    }
}

