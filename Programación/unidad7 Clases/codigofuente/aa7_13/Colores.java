package com.mycompany.aa7_13;

public class Colores {
    private String[] colores = new String[0];
    
    //Métodos
    public void addColor(String color){
        String[] aux  = new String[colores.length + 1];
        System.arraycopy(colores, 0, aux, 0, colores.length);
        aux[colores.length] = color;
        this.colores = aux;
        aux = null;
    }
    
    public String[] seleccionColores(int cantidad){
        String[] aux  = new String[cantidad];
        System.arraycopy(colores, 0, aux, 0, cantidad);
        return aux;
    }
}
