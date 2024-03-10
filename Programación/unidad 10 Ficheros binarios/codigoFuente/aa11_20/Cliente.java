package com.mycompany.aa11_20;

import java.io.*;

public class Cliente implements Serializable {
    private String id, nombre, telefono;

    public Cliente(String id, String nombre, String telefono) {
        this.id = id;
        this.nombre = nombre;
        this.telefono = telefono;
    }
   
    
    public String getId() {
        return id;
    }

    //Protejo el id para que no se pueda modificar una vez creado
    private void setId(String id) {
        this.id = id;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getTelefono() {
        return telefono;
    }

    public void setTelefono(String telefono) {
        this.telefono = telefono;
    }

    @Override
    public String toString() {
        return "\n***Cliente***:" + "\n-id=" + id + "\n-nombre=" + nombre 
                + "\n-telefono=" + telefono + "\n";
    }   
}
