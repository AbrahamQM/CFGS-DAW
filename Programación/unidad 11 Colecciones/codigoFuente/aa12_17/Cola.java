package com.mycompany.aa12_17;

import java.util.*;

public class Cola<T> {

    private List<T> cola = new ArrayList<T>();

    public void encolar(T cosa) {
        cola.add(cosa);
    }

    public T desencolar() {
        if (cola.size() > 0) {
            T elemento = cola.get(0);
            cola.remove(0);
            return elemento;
        }
        return null;
    }

}
