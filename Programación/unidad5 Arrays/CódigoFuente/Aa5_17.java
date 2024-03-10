package com.mycompany.aa5_17;

import java.util.Arrays;

public class Aa5_17 {

    public static void main(String[] args) {
        int[] t = new int[]{7, 16, 8, 7, 23, 6, 7};
        int num = 3;
        System.out.println("En la tabla: " + Arrays.toString(t) + 
                " \nel resultado de la suma en grupos de " + num + " es: " + 
                Arrays.toString(suma(t, num)));
    }
     static int[] suma(int[] t, int num){
        int[] sumas =  new int[0];
        int suma = 0;
        for(int i = 0; i + num < t.length +1; i++){
            for(int j= i; (j <  (i + num)); j++){
                suma += t[j]; 
            }
            sumas = Arrays.copyOf(sumas, sumas.length + 1);
            sumas[i] = suma;
            suma = 0;
        }
        return sumas;
    }
}
