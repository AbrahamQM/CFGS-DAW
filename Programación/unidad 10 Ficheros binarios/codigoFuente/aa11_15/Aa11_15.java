package com.mycompany.aa11_15;

import java.io.*;

public class Aa11_15 {

    public static void main(String[] args) {
        int[] enteros = new int[]{39, 47, 5, 99, 854, 34};
        int numero;
        try (ObjectOutputStream salidaNumeros = new ObjectOutputStream(new FileOutputStream(".\\numeros.dat")); 
                ObjectOutputStream salidaPares = new ObjectOutputStream(new FileOutputStream(".\\pares.dat")); 
                ObjectOutputStream salidaImpares = new ObjectOutputStream(new FileOutputStream( ".\\impares.dat"))) {
            for (int num : enteros) { //inserto los numeros 1 a 1 para que no sea una tabla.
                salidaNumeros.writeInt(num);
            }

            try (ObjectInputStream lector = new ObjectInputStream(new FileInputStream(".\\numeros.dat"))) {
                while (true) {
                    numero = lector.readInt();
                    if (numero % 2 == 0) {
                        salidaPares.writeInt(numero);
                    } else {
                        salidaImpares.writeInt(numero);
                    }
                }
            } catch (EOFException ex) {
                System.out.println("Fin del fichero");
            }
        } catch (IOException ex) {
            System.out.println("Excepción IOException: " + ex);
        }
    }
}
