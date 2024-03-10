package com.mycompany.aa6_12;

import java.util.Scanner;
public class Aa6_12 {

    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        int intentos = 7;
        System.out.println("***********El juego del ahorcado***********");
        System.out.println("**Introduzca palabra secreta:\n");
        String secreta = sc.nextLine();
        char resultado[] = new char[secreta.length()];
        for(int i=0; i< secreta.length(); i++){ //inicializo el array secreto
            resultado[i] = '_'; 
        }
       
        while(!secreta.equals(String.valueOf(resultado)) && intentos > 0){
            System.out.println("La  secreta es:  <<" +
                    String.valueOf(resultado) + ">>");
            System.out.println("Intentos restantes: " + intentos + "\nIntroduzca una letra: ");
            char letra = sc.nextLine().charAt(0);
            boolean acierto = false;
            for(int i=0; i< secreta.length(); i++){
                if(secreta.charAt(i) == letra){
                    resultado[i] = letra ; 
                    acierto = true;
                }
            }
            if(!acierto){
                intentos --;
            }
        }
        System.out.println("----Fin del juego, la palabra secreta era: " + secreta);
        if(intentos == 0){
            System.out.println("*** GANA EL JUGADOR A ***");
        }else{
            System.out.println("*** GANA EL JUGADOR B ***");
        }
    }
}
