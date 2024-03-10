package com.mycompany.ap5_3;

import java.util.Scanner;

public class Ap5_3 {

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        System.out.println("Intoduzca la cantidad de numeros deseada:");
        int n = scanner.nextInt();
        int ceros = 0;
        int pos = 0;
        int positivos = 0;
        int neg = 0;
        int negativos = 0;
        int []numeros = new int[n];
        for (int i=0;i<n;i++){
            System.out.println("Introduzca el " + (i+1) + "º numero");
            numeros[i] = scanner.nextInt();
            if(numeros[i] == 0){
                ceros++ ;
            }else if(numeros[i] > 0){
                 pos += numeros[i];
                 positivos++;
            }else{
                neg += numeros[i];
                negativos++;
            }
        }
        if(positivos >0){
            System.out.println("Media de los numeros positivos: " + (double)pos/positivos);
        }else{
            System.out.println("No hay numeros positivos introducidos para la media");
        }
        if(negativos > 0){
            System.out.println("Media de los numeros negativos: " + neg/negativos);
        }else{
            System.out.println("No hay numeros  introducidos para la media");
        }
        System.out.println("Cantidad de 0 introducidos: " + ceros);

    }
}
