package com.mycompany.aa12_18;

import java.util.ArrayList;
import java.util.List;

public class Pila<T> {
   private List<T> pila = new ArrayList<T>();

    public void apilar(T cosa) {
        pila.addFirst(cosa);
    }

    public T desapilar() {
        if (pila.size() > 0) {
            return pila.removeFirst();
        }
        return null;
    }

}
