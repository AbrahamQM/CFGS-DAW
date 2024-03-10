package com.mycompany.aa11_11;

import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.ObjectOutputStream;
import java.util.Scanner;

public class Aa11_11 {

    public static void main(String[] args) {       
        try (ObjectOutputStream salida = new ObjectOutputStream(
                new FileOutputStream(".\\binary.dat"))){
            Scanner sc = new Scanner(System.in);
            System.out.println("Inroduzca un valor de tipo double:");
            salida.writeDouble(sc.nextDouble());
        } catch (FileNotFoundException ex) {
            System.out.println("Excepción FileNotFoundException: " + ex.getMessage());
        } catch (IOException ex) {
            System.out.println("Excepción IOException: " + ex.getMessage());
        }
    }
}
