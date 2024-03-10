package com.mycompany.aa3_13;

import java.util.Scanner;

public class Aa3_13 {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        int hora;
        int min;
        int seg;
        int incrementaSeg;
        do{
            System.out.println("Introduzca hora: ");
            hora = scanner.nextInt();
            System.out.println("Intoduzca minuto: ");
            min = scanner.nextInt();
            System.out.println("Intoduzca segundo: ");
            seg = scanner.nextInt();
        }while(!esCorrecto(hora, min, seg)); //Compruebo que sean datos válidos
        System.out.println("Hora introducida: " + hora + ':' + min + ':' + seg);
        do{
            System.out.println("¿Cuantos segundos incrementamos?");
            incrementaSeg = scanner.nextInt();
        }while(!(incrementaSeg >= 0));
        
        while( incrementaSeg > 0){
            if(seg < 59){
                seg ++;
                incrementaSeg--;
            }else if(min < 59){
                seg = 0;
                min++;
                incrementaSeg--;
            }else if(hora < 23){
                min = 0;
                hora++;
                incrementaSeg--;
            }else{
                seg = 0;
                min = 0;
                hora = 0;
                incrementaSeg--;
                System.out.println("Hemos pasado al día siguiente!!");
            }
        }
        System.out.println("La hora final es:"  + hora + ':' + min + ':' + seg);
    }
    
    
    private static boolean esCorrecto(int hora, int min, int seg){
        boolean esCorrecto = hora >= 0 && hora<24 && min >= 0 && 
                min < 60 && seg >= 0 && seg < 60;
        if (!esCorrecto){
            System.out.println("La hora introducida no es correcta, introducir nuevos datos.");
        }
        return esCorrecto;
    }
}gg