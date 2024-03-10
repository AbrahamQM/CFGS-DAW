package com.mycompany.aa7_19;

import java.util.Arrays;

public class Pila {
    int[] pila = new int[0];

    public void apila(int num){
        int[] aux = new int[pila.length + 1];
        System.arraycopy(pila, 0, aux, 1, pila.length);
        aux[0] = num;
        pila = aux;
    }
    //Entiendo mirando el main que devuelve el array en String
    public String desapila(){
        if (pila.length > 0) {
            pila = Arrays.copyOf(pila, pila.length - 1);
        }
        return Arrays.toString(pila);
    }
    
    public int cima(){
        return pila[pila.length - 1];
    }
    //Entiendo (mirando el main) que este método indica si está vacía o no
    public boolean vacia(){
        return pila.length == 0;
    }
}
