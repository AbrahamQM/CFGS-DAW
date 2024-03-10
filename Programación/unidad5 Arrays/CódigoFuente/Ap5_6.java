package ap5_6;

import java.util.Arrays;

public class Ap5_6 {

    public static void main(String[] args) {
        int tabla[] = new int[]{ 2, 3, 5, 6, 9, 10, 10};
        System.out.println("Tabla inicial\n" +Arrays.toString(tabla));
        tabla = borrar(tabla, 5);
        System.out.println("Tabla tras borrar el 5\n" + Arrays.toString(tabla));
        tabla = borrar(tabla, 2);
        System.out.println("Tabla tras borrar el 2\n" + Arrays.toString(tabla));
        tabla = borrar(tabla, 10);
        System.out.println("Tabla tras borrar el 10\n" + Arrays.toString(tabla));

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
