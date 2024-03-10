package com.mycompany.ap5_7;

import java.util.Arrays;
import java.util.Scanner;

public class Ap5_7 {

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        int num = 0;
        System.out.println("Intoduzca uno a uno sus numeros favoritos ");
        System.out.println("Pulsar -1 para dejar de introducir");
        int favoritos[] = new int[]{};
        while(num != -1){
            num = scanner.nextInt();
            favoritos = num != -1 ? insertarOrdenado(favoritos, num) 
                    : favoritos;
        }
        System.out.println("Tabla: " + Arrays.toString(favoritos));
        System.out.println("Su numero de la suerte es: " + 
                nSuerte(favoritos));
    }
    
    static int nSuerte(int[] favoritos){
        int media;
        int [] indices = new int[2];
        
        while (favoritos.length > 1){
            if(favoritos.length == 2){
                favoritos[0] = (favoritos[0] + favoritos[1])/2;
                favoritos = borrar(favoritos, favoritos[1]);
            }else{
                indices[0] = (int)Math.floor(Math.random()* (favoritos.length-1));
                indices[1] = (int)Math.floor(Math.random()* (favoritos.length-1));
                if(indices[0] == indices[1]) continue;
                Arrays.sort(indices);
                media = (favoritos[indices[0]] + favoritos[indices[1]])/2;                
                favoritos = borrar(favoritos, favoritos[indices[1]]);
                favoritos = borrar(favoritos, favoritos[indices[0]] );
                favoritos = insertarOrdenado(favoritos, media);
            }
        }
        return favoritos[0];
    }
    
    static int[] insertarOrdenado(int[] tabla,  int num){
        int indice = Arrays.binarySearch(tabla, num);
        int[] nTabla = new int[tabla.length + 1];
        if(indice < 0){
            indice = -indice - 1;
        }
        System.arraycopy(tabla, 0, nTabla, 0, indice);
        nTabla[indice] = num;
        System.arraycopy(tabla, indice, nTabla, indice+1, tabla.length - indice);
        return nTabla;
    }
    
    static int[] borrar(int[] tabla,  int num){
        int nueva[] = new int[tabla.length -1];
        int indice = Arrays.binarySearch(tabla, num);
        if(indice >= 0){
            System.arraycopy(tabla, 0, nueva, 0, indice);
            System.arraycopy(tabla, indice +1, nueva, indice, 
                    tabla.length - indice - 1);
        }else{
            nueva = tabla;
        }
        return nueva;
    }
    
}
