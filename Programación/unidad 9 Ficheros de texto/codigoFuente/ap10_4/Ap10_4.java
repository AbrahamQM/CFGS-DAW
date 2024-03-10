package com.mycompany.ap10_4;

import java.io.*;
import java.util.Scanner;

public class Ap10_4 {

    public static void main(String[] args) {
        File file = new File("texto.txt");
        final String FIN = "fin";
        String linea;
        boolean seguir;
        BufferedWriter flujo;
        Scanner sc;
        try {
            if (!file.exists()){
                file.createNewFile();
            }
            flujo = new BufferedWriter(new FileWriter(file.getPath(), true));
            sc = new Scanner(System.in);
            do{
                System.out.println("Introduzca texto a añadir, "
                        + "para terminar infroduzca fin:");
                linea = sc.nextLine();
                seguir = !linea.equals(FIN);
                if(seguir){ 
                    flujo.write(  linea);
                    flujo.newLine();
                }
            }while(seguir);
            sc.close();
            flujo.close();
        } catch (IOException ex) {
            System.out.println(ex.getMessage());
        }
    }
}
