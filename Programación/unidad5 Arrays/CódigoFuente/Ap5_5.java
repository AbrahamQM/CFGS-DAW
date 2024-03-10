package ap5_5;

import java.util.Arrays;


public class Ap5_5 {

    public static void main(String[] args) {
        int tabla[] = insertarOrdenado(new int[]{ 2, 3, 3, 6}, 4);
        System.out.println("Insertamos el 4, ahora la tabla es" + Arrays.toString(tabla));
        tabla = insertarOrdenado(tabla, 1);
        System.out.println("Insertamos el 1, ahora la tabla es" + Arrays.toString(tabla));
        tabla = insertarOrdenado(tabla, 4);
        System.out.println("Insertamos el 4, ahora la tabla es" + Arrays.toString(tabla));
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
