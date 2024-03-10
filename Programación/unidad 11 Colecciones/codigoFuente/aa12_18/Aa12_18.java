package com.mycompany.aa12_18;


public class Aa12_18 {
        public static void main(String[] args) {
        Pila<Integer> p=new Pila<>();
        for (int i = 0; i < 10; i++) {
            p.apilar(i);
        }
        
        Integer num=p.desapilar();
        while(num!=null){
            System.out.println(num);
            num=p.desapilar();
        }
    }
}
