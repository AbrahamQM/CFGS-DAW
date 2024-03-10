package com.mycompany.aa11_13;

import java.io.*;
import java.util.Arrays;

public class Aa11_13 {

    public static void main(String[] args) {
        final double[] tabla = new double[]{12.3, 21.9, 89.74, 46.64, 22.15};
        //Como no tengo ese fichero primero lo voy a crear
        try (ObjectOutputStream salida = new ObjectOutputStream(
                new FileOutputStream(".\\numerosDouble.dat"))) {
            salida.writeObject(tabla);
        } catch (IOException ex) {
            System.out.println("Excepción IOException: " + ex.getMessage());
        }
        try (ObjectInputStream lector = new ObjectInputStream(
                new FileInputStream(".\\numerosDouble.dat"))) {
            System.out.println("En el archivo numerosDouble.dat pone:\n " 
                    + Arrays.toString( (double[])lector.readObject()));
        } catch (IOException ex) {
            System.out.println("Excepción IOException: " + ex.getMessage());
        } catch (ClassNotFoundException ex) {
           System.out.println("Excepción ClassNotFoundException: " + ex.getMessage());
        }
    }
}
