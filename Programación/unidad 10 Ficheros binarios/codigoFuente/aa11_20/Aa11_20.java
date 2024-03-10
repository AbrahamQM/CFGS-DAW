package com.mycompany.aa11_20;

import java.io.*;
import java.util.Arrays;
import java.util.Scanner;

public class Aa11_20 {

    public static void main(String[] args) {
        Cliente[] clientes = new Cliente[0];
        Cliente[] aux;
        Cliente cliente;
        String id, nombre, telefono;
        int opcion;
        Scanner sc = new Scanner(System.in);
        try (ObjectInputStream lector = new ObjectInputStream(
                new FileInputStream(".\\clientes.dat"))) {
            while (true) {
                clientes = (Cliente[]) lector.readObject();
            }
        } catch (EOFException e) {
        } catch (Exception e) {
            System.out.println("Ha ocurrido una excepción: " + e);
        }
        do {
            System.out.println("""
                                   ********Men\u00fa Clientes********
                                   1 A\u00f1adir cliente
                                   2 Modificar datos
                                   3 Dar de baja cliente
                                   4 Listar clientes
                                   0 Salir:""");
            opcion = sc.nextInt();
            sc.skip("\n");
            switch (opcion) {
                case (1) -> { //Añadir
                    System.out.println("Introduzca id (no se podrá modificar):");
                    id = sc.nextLine();
                    System.out.println("Nombre:");
                    nombre = sc.nextLine();
                    System.out.println("Teléfono:");
                    telefono = sc.nextLine();
                    cliente = new Cliente(id, nombre, telefono);
                    aux = new Cliente[clientes.length + 1];
                    System.arraycopy(clientes, 0, aux, 0, clientes.length);
                    aux[clientes.length] = cliente;
                    clientes = aux;
                    aux = null;
                    try (ObjectOutputStream escritor = new ObjectOutputStream(
                            new FileOutputStream(".\\clientes.dat"))) {
                        escritor.writeObject(clientes);
                        escritor.flush();
                    } catch (Exception e) {
                        System.out.println("Ha ocurrido una excepción: " + e);
                    }
                }
                case (2) -> { //modificar
                    System.out.println("Introduzca id cliente a modificar;");
                    id = sc.next();
                    for (Cliente c : clientes) {
                        if (c.getId().equals(id)) {
                            sc.skip("\n");
                            System.out.println("Cliente encontrado\n"
                                    + "Introduzca nuevo nombre:");
                            c.setNombre(sc.nextLine());
                            System.out.println("Introduzca nuevo teléfono:");
                            c.setTelefono(sc.nextLine());
                            try (ObjectOutputStream escritor = new ObjectOutputStream(
                                    new FileOutputStream(".\\clientes.dat"))) {
                                escritor.writeObject(clientes);
                                escritor.flush();
                            } catch (Exception e) {
                                System.out.println("Ha ocurrido una excepción: " + e);
                            }
                            break;
                        }
                    }
                }
                case (3) -> { //dar de baja
                    System.out.println("Introduzca id cliente a dar de baja;");
                    id = sc.next();
                    for (int i = 0; i < clientes.length; i++) {
                        if (clientes[i].getId().equals(id)) {
                            aux = new Cliente[clientes.length - 1];
                            System.arraycopy(clientes, 0, aux,
                                    0, i);
                            System.arraycopy(clientes, i + 1, aux,
                                    i, clientes.length - 2);
                            clientes = aux;
                            aux = null;
                            try (ObjectOutputStream escritor = new ObjectOutputStream(
                                    new FileOutputStream(".\\clientes.dat"))) {
                                escritor.writeObject(clientes);
                                escritor.flush();
                            } catch (Exception e) {
                                System.out.println("Ha ocurrido una excepción: " + e);
                            }
                            System.out.println("\nCliente eliminado\n");
                            break;
                        }
                    }
                }
                case (4) -> { //Listar
                    try (ObjectInputStream lector = new ObjectInputStream(
                            new FileInputStream(".\\clientes.dat"))) {
                        while (true) {
                            System.out.println(Arrays.toString(
                                    (Cliente[]) lector.readObject()));
                        }
                    } catch (EOFException e) {
                        System.out.println("***********Fin del directorio"
                                + "***********");
                    } catch (Exception e) {
                        System.out.println("Ha ocurrido una excepción: " + e);
                    }
                }
                case (0) -> {
                }
                default -> {
                    System.out.println("Opción errónea");
                }
            }
        } while (opcion != 0);
    }
}
