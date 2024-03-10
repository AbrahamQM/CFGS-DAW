package com.mycompany.ap12_5;

import java.util.*;

public class Ap12_5 {

    public static void main(String[] args) {
        Set<Cliente> clientes = new TreeSet<>();
        Comparator<Cliente> porEdad = new Comparator<Cliente>() {
            @Override
            public int compare(Cliente uno, Cliente otro) {
                return Integer.compare(uno.edad(), otro.edad());
            }
        };
        Comparator<Cliente> porNombre = new Comparator<Cliente>() {
            @Override
            public int compare(Cliente uno, Cliente otro) {
                return uno.nombre.compareTo(otro.nombre);
            }
        };
        clientes.add(new Cliente("111", "Marta", "12/02/2000"));
        clientes.add(new Cliente("115", "Jorge", "16/03/1995"));
        clientes.add(new Cliente("112", "Carlos", "01/10/2002"));
        System.out.println("--Clientes ordenados por DNI:" + clientes);
        Set<Cliente> clientesPorEdad = new TreeSet<>(porEdad);
        clientesPorEdad.addAll(clientes);
        System.out.println("--Clientes ordenados por edad:" + clientesPorEdad);
        Set<Cliente> clientesPorNombre = new TreeSet<>(porNombre);
        clientesPorNombre.addAll(clientes);
        System.out.println("--Clientes ordenados por nombre:" + clientesPorNombre);
    }
}
