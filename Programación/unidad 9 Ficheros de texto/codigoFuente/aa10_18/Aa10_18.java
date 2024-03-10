package com.mycompany.aa10_18;

import java.util.Arrays;
import java.util.Scanner;

public class Aa10_18 {

    public static void main(String[] args) {
        String cadena = "asd 15 asdlkas 24 aiowhqe 45 as,dmqoih 9 ñamsdk";
        System.out.println( Arrays.toString(leerEnteros(cadena)));
    }
    
    static Integer[] leerEnteros(String cadena){
        Scanner sc = new Scanner(cadena);
        Integer[] resultado = {};
        int contador = 0;
        while(sc.hasNext()){
            if(sc.hasNextInt()){
                Integer[] aux = new Integer[resultado.length + 1];
                System.arraycopy(resultado, 0, aux, 0, resultado.length );
                resultado = aux;
                resultado[contador] = sc.nextInt();
                contador ++;
            }else{
                sc.next();
            }
        }
        sc.close();
        return resultado;
    }
}
