package ap3_2;

import java.util.Scanner;

public class AP3_2 {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        int num;
        System.out.println("Introduzca un numero: ");
        num = scanner.nextInt();
        
        for(int i=0; i<num; i++){
            System.out.println("Eco...");
        }
    }
}
