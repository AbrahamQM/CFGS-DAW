package com.mycompany.aa7_18;

import java.util.Arrays;

public class Cola {
    int[] cola = new int[0];

    public void encola(int num){
        cola = Arrays.copyOf(cola, cola.length + 1);
        cola[cola.length - 1] = num;
    }
    //Entiendo mirando el main que devuelve el array en String
    public String desencola(){
        cola = Arrays.copyOfRange(cola, 1, cola.length);
        return Arrays.toString(cola);
    }
    
    public int primero(){
        return cola[0];
    }
    //Entiendo (mirando el main) que este método indica si está vacía o no
    public boolean vacia(){
        return cola.length == 0;
    }
    
}
