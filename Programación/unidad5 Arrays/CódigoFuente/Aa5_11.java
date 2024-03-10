package com.mycompany.aa5_11;

import java.util.Arrays;

public class Aa5_11 {

    public static void main(String[] args) {
        int[] t = new int[]{7, 16, 8, 7, 23, 6, 7};
        int num = 7;
        System.out.println("En la tabla: " + Arrays.toString(t) + 
                " \nel número " + num + " aparece en las posiciones: " + 
                Arrays.toString(buscarTodos(t, num)));
    }
    static int[] buscarTodos(int[] t, int clave){
        int[] indices =  new int[0];
        for(int i = 0; i < t.length ; i++){
            if (t[i] == clave){
                indices = insertarOrdenado(indices, i);
            }
        }
        
        
        return indices;
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
}
