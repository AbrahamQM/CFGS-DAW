package com.mycompany.aa12_17;

public class Aa12_17 {

     public static void main(String[] args) {
        Cola<Integer> c = new Cola<>();
        for (int i = 0; i < 10; i++) {
            c.encolar(i);
        }

        Integer num = c.desencolar();
        while (num != null) {
            System.out.println(num);
            num = c.desencolar();
        }
    }

}
