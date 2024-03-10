package com.mycompany.ap12_5;

import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.time.temporal.ChronoUnit;

public class Cliente implements Comparable<Cliente>{
    String dni, nombre;
    LocalDate fechaNacimiento;

    public Cliente(String dni, String nombre, String fechaNacimiento) {
        this.dni = dni;
        this.nombre = nombre;
        DateTimeFormatter formatter = DateTimeFormatter.ofPattern("dd/MM/yyyy");
        this.fechaNacimiento = LocalDate.parse(fechaNacimiento, formatter);
    }

    int edad(){
        return (int)fechaNacimiento.until(LocalDate.now(), ChronoUnit.YEARS);
    }
    @Override
    public boolean equals(Object obj) {
        return dni.equals(((Cliente) obj).dni); 
    }
    
    @Override
    public int compareTo(Cliente otro){
        return dni.compareTo(otro.dni);
    }   

    @Override
    public String toString() {
        return "\n***Cliente***:" + "\n-dni=" + dni + "\n-nombre=" + nombre 
                + "\n-edad=" + edad() + "\n";
    }   
}
