package com.mycompany.aa10_15;

import java.io.FileInputStream;
import java.util.Scanner;


public class Aa10_15 {

    public static void main(String[] args) {
        int numero, menor = 0, mayor = 0;
        try{
            FileInputStream flujo = new FileInputStream("numeros.txt");
            Scanner scanner = new Scanner(flujo);
            while (scanner.hasNextInt()){ 
                numero = scanner.nextInt();
                menor = (menor > numero) ? numero : menor;
                mayor = (mayor < numero) ? numero : mayor;
            }
            System.out.println("El numero menor del fichero es: " + menor);
            System.out.println("El numero mayor del fichero es: " + mayor);
        }catch(Exception  e){
            System.out.println(e);
        }
        
    }
}
