package com.mycompany.aa10_20;
import java.io.BufferedReader;
import java.io.FileReader;

public class Aa10_20 {

    public static void main(String[] args) {
        BufferedReader in1 = null, in2 = null;
        boolean iguales = true;
        String txt1, txt2;
        int linea = 0;
        try {
            in1 = new BufferedReader(new FileReader("texto1.txt"));
            in2 = new BufferedReader(new FileReader("texto2.txt"));
            do {
                txt1 = in1.readLine();
                txt2 = in2.readLine();
                if (txt1 != null && txt2 != null) {
                    iguales = txt1.equals(txt2) ? true : false;
                    linea++;
                } else {
                    break;
                }
            } while (iguales);
            if (!iguales) {
                encontrarPrimerCaracterDiferente(txt1, txt2, linea);
            } else {
                System.out.println("Los dos ficheros son iguales");
            }

            in1.close();
            in2.close();
        } catch (Exception e) {
            System.out.println("Se ha producido una excepción: " + e.getMessage());
        }
    }

    public static void encontrarPrimerCaracterDiferente(String cadena1,
            String cadena2, int linea) {
        for (int i = 0; i < Math.min(cadena1.length(), cadena2.length()); i++) {
            if (cadena1.charAt(i) != cadena2.charAt(i)) {
                System.out.println("Los dos ficheros no son iguales en la línea: "
                        + linea + " caracter: " + i);
                break;
            }
        }
    }
}
