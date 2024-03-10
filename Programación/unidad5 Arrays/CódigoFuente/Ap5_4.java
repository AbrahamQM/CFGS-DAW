package com.mycompany.ap5_4;

public class Ap5_4 {

    public static void main(String[] args) {
        int pos = buscar(new int[] {10, 25, 9, 4, 547}, 7);
        if (pos  == -1){
            System.out.println("No se ha encontrado el resultado");
        }else{
            System.out.println("El resultado está en la posición: " + pos);
        }
    }
    
    static int buscar(int t[], int clave){
        int indice = 0;
        while(indice < t.length && t[indice] != clave){
            indice++;
        }
        if (indice >= t.length){
            indice = -1;
        }
        return indice;
    }
}
