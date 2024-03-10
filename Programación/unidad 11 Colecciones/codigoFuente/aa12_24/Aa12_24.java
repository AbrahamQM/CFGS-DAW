package com.mycompany.aa12_24;

import java.util.*;

public class Aa12_24 {
    public static void main(String[] args) {
        List<Integer> numeros1 = new ArrayList(List.of(1,5,6,8,9,43));
        List<Integer> numeros2 = new ArrayList(List.of(2,3,10,18,25,50));
        Set<Integer> fusion =  new TreeSet();
        fusion.addAll(numeros1);
        fusion.addAll(numeros2);
        System.out.println("---Primera lista:" + numeros1);
        System.out.println("---Segunda lista:" + numeros2);
        System.out.println("--Lista fusionada:" + fusion);
    }
}
