package com.mycompany.aa4_17;

public class Aa4_17 {

    public static void main(String[] args) {
        int a = 220;
        int b = 284;
        String respuesta = sonAmigos(a, b) ? " SI" : " NO";
        System.out.println("Los numeros " + a + " y " + b
                + respuesta + " son amigos");
    }

    static boolean sonAmigos(int a, int b) {
        int sumaDivisores = 0;
        int divisor = 1;

        while (divisor < a) {
            if (a % divisor == 0) {
                sumaDivisores += divisor;
            }
            divisor++;
        }
        return sumaDivisores == b;
    }
}
