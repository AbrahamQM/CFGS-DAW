package com.mycompany.ap12_3;

import java.util.*;

public class Ap12_3 {

    public static void main(String[] args) {
        Collection<Integer> lista = new ArrayList<>();

        int n;
        for (int i = 0; i < 100; i++) {
            lista.add((int) (Math.random() * 10 + 1));
        }
        System.out.println("Lista inicial:\n" + lista);
        Iterator<Integer> iterador = lista.iterator();
        while (iterador.hasNext()) {
            n = iterador.next();
            if (n == 5) {
                iterador.remove();
            }
        }
        System.out.println("Lista inicial:\n" + lista);
    }
}
