package com.mycompany.aa11_12;

import java.io.FileInputStream;
import java.io.IOException;
import java.io.ObjectInputStream;

public class Aa11_12 {

    public static void main(String[] args) {
        try(ObjectInputStream lector = new ObjectInputStream(
                new FileInputStream(".\\binary.dat"))){
            System.out.println("Valor guardado:" + lector.readDouble());
        } catch (IOException ex) {
           System.out.println("Excepción IOException: " + ex.getMessage());
        }
    }
}
