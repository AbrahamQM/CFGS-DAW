package com.mycompany.aa12_16;

import java.util.*;

public class Aa12_16 {

    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        int opcion;
        String dni, nombre, fecha;
        Socio socio;
        Set<Socio> socios = new TreeSet<>();
        do {
            menu();
            opcion = sc.nextInt();
            sc.skip("\n");
            switch (opcion) {
                case (1) -> { //Alta
                    System.out.println("Introduzca dni (no se podrá modificar):");
                    dni = sc.nextLine();
                    System.out.println("Nombre:");
                    nombre = sc.nextLine();
                    System.out.println("Fecha alta(dd/MM/yyyy):");
                    fecha = sc.nextLine();
                    socios.add(new Socio(dni, nombre, fecha));
                }
                case (2) -> { //modificar
                    System.out.println("Introduzca dni socio a modificar;");
                    dni = sc.next();
                    for (Socio c : socios) {
                        if (c.dni.equals(dni)) {
                            sc.skip("\n");
                            System.out.println("Socio encontrado\n"
                                    + "Introduzca nuevo nombre:");
                            c.nombre = sc.nextLine();
                            System.out.println("Fecha alta(dd/MM/yyyy):");
                            c.setfechaAlta(sc.nextLine());
                        }
                    }
                }
                case (3) -> { //dar de baja
                    System.out.println("Introduzca id socio a dar de baja;");
                    dni = sc.next();
                    Iterator<Socio> iterador = socios.iterator();
                    while (iterador.hasNext()) {
                        socio = iterador.next();
                        if (socio.equals(new Socio(dni, "", "01/01/1000"))) {
                            iterador.remove();
                        }
                    }
                    System.out.println("\nSocio eliminado\n");
                }
                case (4) -> { //Listar por nombre                 
                    Comparator<Socio> porNombre = new Comparator<Socio>() {
                        @Override
                        public int compare(Socio uno, Socio otro) {
                            return uno.nombre.compareTo(otro.nombre);
                        }
                    };
                    Set<Socio> sociosPorNombre = new TreeSet<>(porNombre);
                    sociosPorNombre.addAll(socios);
                    System.out.println("--Socios ordenados por nombre:" + sociosPorNombre);
                }
                case (5) -> { //Listar por antigüedad
                    Comparator<Socio> porAntiguedad = new Comparator<Socio>() {
                        @Override
                        public int compare(Socio uno, Socio otro) {
                            return uno.fechaAlta.compareTo(otro.fechaAlta);
                        }
                    };
                    Set<Socio> sociosPorAntiguedad = new TreeSet<>(porAntiguedad);
                    sociosPorAntiguedad.addAll(socios);
                    System.out.println("--Socios ordenados por antiguedad:" + sociosPorAntiguedad);
                }
                case (0) -> {
                }
                default -> {
                    System.out.println("Opción errónea");
                }
            }
        } while (opcion != 0);
    } 

    private static void menu() {
        System.out.println("""
                                   ********Men\u00fa Socios********
                                   1 Alta socio
                                   2 Modificar socio
                                   3 Dar de baja socio
                                   4 Listar socios por nombre
                                   5 Listar socios por antigüedad
                                   0 Salir:""");
    }
}
