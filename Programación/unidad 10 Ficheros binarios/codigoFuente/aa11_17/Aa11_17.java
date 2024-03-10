package com.mycompany.aa11_17;

import java.io.*;
import java.util.Scanner;

public class Aa11_17 {

    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        String linea;
        try (ObjectOutputStream escritor = new ObjectOutputStream(new FileOutputStream(".\\texto.dat"));
             ObjectInputStream lector = new ObjectInputStream(new FileInputStream(".\\texto.dat")) ) {
            System.out.println("Introduzca texto a guardar o pulse ENTER para salir:");
            do{
                linea = sc.nextLine();
                if(!linea.equals("")){
                    escritor.writeObject(linea);
                }
            }while(!linea.equals(""));
            
            System.out.println("Resultado:\n");
            while(true){
                System.out.println((String)lector.readObject());
            }
        }catch (EOFException e){
            System.out.println("***********Fin del fichero***********");
        } catch (FileNotFoundException ex) {
            System.out.println("Excepción FileNotFoundException: " + ex);
        } catch (IOException ex) {
            System.out.println("Excepción IOException: " + ex);
        } catch (ClassNotFoundException ex) {
           System.out.println("Excepción ClassNotFoundException: " + ex);
        } 
    }
}
