package com.mycompany.aa10_17;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.Scanner;

public class Aa10_17 {
    
    public static void main(String[] args) {
        try {
            final String FICHERO = "texto.txt";
        
            BufferedReader in = new BufferedReader(new FileReader(FICHERO));
            Scanner sc = new Scanner(System.in);
            int contador = 1;
            String texto = in.readLine();
            while (texto != null) {
                if(contador < 25){
                    System.out.println(contador+ ": " + texto);
                    texto = in.readLine();
                    contador ++;
                }else{
                    contador = 1;
                    System.out.println("-->Fin del tramo. Introuzca un caracter "
                            + "y pulse enter para continuar");
                    sc.next();
                }
            }
        } catch (IOException ex){
            System.out.println(ex);
        }
    }
}
