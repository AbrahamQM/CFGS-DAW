package com.mycompany.aa8_17;

import java.util.Arrays;

public class Cola extends Lista{
    
    public void encolar(int num){
        super.insertar(0, num);
    }

    public Integer desencolar(){
        Integer aEliminar = null;
    
        if( super.tabla.length > 0){
            aEliminar = super.tabla[0];
            super.eliminar(0);
        }
        return aEliminar;
    }
    

    @Override
    public String toString() {
        return "Cola: " + super.mostrar();
    }
}
