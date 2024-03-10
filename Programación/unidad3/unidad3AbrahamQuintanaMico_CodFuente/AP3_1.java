package ap3_1;

import java.util.Scanner;

public class AP3_1 {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        int edadMaxima = 0;
        int edadMinima = 200;
        int num  = 0;
        do {
            System.out.println("Introduzca edad de alumn@:");
            num = scanner.nextInt();
            if(num < edadMinima && num != -1){
                edadMinima = num;
            }else if (num > edadMaxima){
                edadMaxima = num;
            }
        }while(num != -1); 
        System.out.println("Edad maxima: " + edadMaxima + "\nEdad minima" + edadMinima);
    }
}