package com.mycompany.aa6_13;

import java.util.Scanner;

public class Aa6_13 {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        System.out.println("Introduzca texto en C:");
        String texto = sc.nextLine();
        if(texto.contains("/*")){
            System.out.println("Texto descomentado: \n" + descomentar(texto));
        }else{
            System.out.println("El texto: '" + texto + "' no estaba comentado" );
        }
    }
    
    static String descomentar(String texto){
        String resultado = "";
        String[] divididoInicio = texto.split("\\/\\*");
        for(int i=0; i<divididoInicio.length ;i++){
            if(!divididoInicio[i].contains("*/")){
                resultado += divididoInicio[i];
            }else{
                String[] divididoFin = divididoInicio[i].split("\\*\\/");
                resultado = divididoFin.length > 1 ? resultado + divididoFin[1] : resultado;
            }
        }
        return resultado;
    } 
}
