package com.mycompany.aa4_16;

public class Aa4_16 {

    public static void main(String[] args) {
        divisoresPrimos(500);
    }

    static void divisoresPrimos(int num) {
        int divisor = 2;
        if (num < 2) {
            System.out.println("El numero " + num + "no tiene divisores primos");
        } else {
            while (divisor < num) {
                if (num % divisor == 0) {
                    if (esDivisorPrimo(divisor)) {
                        System.out.println("El número " + divisor + 
                                " es divisor de " + num + " y ademas es primo.");
                    }
                }
                divisor++;
            }
        }
    }
    static boolean esDivisorPrimo(int num){
        boolean primo = true;
        int i = 2;
        if(num < 2){
            primo = false;
        }
        while (i < num && primo == true) {
            if (num % i == 0){
                primo = false;
            }
            i++;
        }
        return primo;
    }
}
