package com.mycompany.aa12_19;

import java.util.*;

public class Aa12_19 {

    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        List<String> texto = new ArrayList<>();
        Set<String> sinRepeticion = new LinkedHashSet<>();
        Set<String> repetidas = new LinkedHashSet<>();
        Map<String, Boolean> mapa = new LinkedHashMap<>();
        System.out.println("Introduzca una frase:");
        String frase = sc.nextLine();
        texto.addAll(Arrays.asList(frase.split(" ")));

        for (String palabra: texto) {
            mapa.put(palabra, mapa.containsKey(palabra));
        }
        for(Map.Entry<String, Boolean> elemento: mapa.entrySet()){
            if(elemento.getValue()){
                repetidas.add(elemento.getKey());
            }else{
                sinRepeticion.add(elemento.getKey());
            }
        }

        System.out.println("Palabras repetidas:" + repetidas);
        System.out.println("Palabras que no se repiten:" + sinRepeticion);
    }
}
