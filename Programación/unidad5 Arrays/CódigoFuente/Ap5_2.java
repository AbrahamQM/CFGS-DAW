package com.mycompany.ap5_2;
 
public class Ap5_2 {

    public static void main(String[] args) {
        int[] a = new int[10];
        int[] b = a;
        int[] c = a;
        
        System.out.println(a);
        System.out.println(b);
        System.out.println(c);
    }
}
