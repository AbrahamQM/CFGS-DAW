
package ap3_3;

import java.util.Scanner;

public class AP3_3 {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        int num;
        System.out.println("Introduzca un numero positivo");
        num = scanner.nextInt();
        String numero = String.valueOf(num); 
        int digitos = numero.length() - 1;
        do{
            System.out.println(numero.charAt(digitos));
            digitos --;
        }while (digitos >= 0);
    }
}
