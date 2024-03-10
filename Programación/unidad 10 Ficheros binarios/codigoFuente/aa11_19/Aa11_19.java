package com.mycompany.aa11_19;

import java.io.*;
import java.util.Scanner;

public class Aa11_19 {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        String dato;
        Registro registro;
        
        try (ObjectOutputStream escritor = new ObjectOutputStream(new FileOutputStream(".\\llamadas.dat"))) {
            do {
                System.out.println("Introduzca fecha(dd/mm/aaaa), pulse ver "
                        + "para mostrar el listado o fin para salir:");
                dato = sc.next();
                switch(dato) {
                    case ("fin") -> {
                    }
                    case ("ver") -> {
                        try (ObjectInputStream lector = new ObjectInputStream(new FileInputStream(".\\llamadas.dat"))) {
                            System.out.println("llamadas por día:\n");
                            while (true) {
                                System.out.println((Registro)lector.readObject());
                            }
                        } catch (EOFException e) {
                            System.out.println("***********Fin del fichero***********");
                        }
                    }
                    default -> {
                        registro = new Registro();
                        registro.día = dato;
                        System.out.println("Introduzca llamadas de hoy: ");                       
                        registro.llamadas = sc.nextInt();
                        escritor.writeObject(registro);
                        escritor.flush();
                    }
                }
            } while (!dato.equals("fin"));
        } catch (FileNotFoundException ex) {
            System.out.println("Excepción FileNotFoundException: " + ex);
        } catch (IOException ex) {
            System.out.println("Excepción IOException: " + ex);
        } catch (ClassNotFoundException ex) {
            System.out.println("Excepción ClassNotFoundException: " + ex);
        }
    }
    
    private static class Registro implements Serializable{
        String día; //podría haber utilizado Date, pero no creo que sea la finalidad del ejercicio
        int llamadas;

        @Override
        public String toString() {
            return "Registro{" + "d\u00eda=" + día + ", llamadas=" + llamadas + '}';
        }
        
    }
}
