package com.mycompany.aa11_14;

import java.io.*;
import java.util.Scanner;

public class Aa11_14 {

    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        try (ObjectOutputStream salida = new ObjectOutputStream(
                new FileOutputStream(".\\frase.dat"))) {
            System.out.println("Introduzca frase a almacenar en binario:");
            salida.writeObject(sc.nextLine());
        } catch (IOException ex) {
            System.out.println("Excepción IOException: " + ex.getMessage());
        }
        try (ObjectInputStream lector = new ObjectInputStream(
                new FileInputStream(".\\frase.dat"))) {
            System.out.println("En el archivo frase.dat pone:\n "
                    + (String) lector.readObject());
        } catch (IOException ex) {
            System.out.println("Excepción IOException: " + ex.getMessage());
        } catch (ClassNotFoundException ex) {
            System.out.println("Excepción ClassNotFoundException: " + ex.getMessage());
        }
    }
}
