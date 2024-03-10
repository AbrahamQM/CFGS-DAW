package com.mycompany.aa11_16;

import java.io.*;
import java.util.Arrays;
import java.util.Scanner;

public class Aa11_16 {

    public static void main(String[] args) {
        String[] nombres = new String[]{"Abraham", "Benearo", "Lucas", "Maria"};
        String[] aux;
        String nombre;
        Scanner sc = new Scanner(System.in);
        try (ObjectOutputStream escritor = new ObjectOutputStream(new FileOutputStream(".\\nombres.dat"));
             ObjectInputStream lector = new ObjectInputStream(new FileInputStream(".\\nombres.dat")) ) {
            escritor.writeObject(nombres); //primero creo el fichero para tenerlo
            nombres = (String[]) lector.readObject();
            do{
                System.out.println("Introduzca siguiente nombre o fin para terminar:");
                nombre = sc.nextLine();
                if(!nombre.equals("fin")){
                    aux = new String[nombres.length + 1];
                    System.arraycopy(nombres, 0, aux, 0, nombres.length);
                    aux[nombres.length] = nombre;
                    Arrays.sort(aux);
                    nombres = aux;
                }
            }while(!nombre.equals("fin"));
            escritor.writeObject(nombres);
            System.out.println("Resultado:\n" + Arrays.toString((String[])lector.readObject()));
        } catch (FileNotFoundException ex) {
            System.out.println("Excepción FileNotFoundException: " + ex);
        } catch (IOException ex) {
            System.out.println("Excepción IOException: " + ex);
        } catch (ClassNotFoundException ex) {
           System.out.println("Excepción ClassNotFoundException: " + ex);
        }
    }
}