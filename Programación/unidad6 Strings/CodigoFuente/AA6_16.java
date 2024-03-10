package com.mycompany.aa6_16;

import java.util.Scanner;

public class AA6_16 {

   public static void main(String[] args) {
      Scanner sc = new Scanner(System.in);
      final char conjunto1[] = {'A', 'E', 'I', 'O', 'U', 'a', 'e', 'i', 'o', 'u'};
      final char conjunto2[] = {'@', '€', '1', '0', '^', '@', '€', '1', '0', '^'};
      char codificado[]; 
      char decodificado[];
      String texto;
      System.out.print("Introduzca un texto a modificar: ");
      texto = sc.nextLine();
      codificado = new char[texto.length()];
      for (int i = 0; i < texto.length(); i++) { 
         codificado[i] = codifica(conjunto1, conjunto2, texto.charAt(i));
      }
      texto = String.valueOf(codificado); 
      System.out.println("El texto MODIFICADO es:\n-" + texto);      
   }
   
   static char codifica(char conjunto1[], char conjunto2[], char c) {
      final String conj1 = String.valueOf(conjunto1); 
      char codificado; 
      int pos = conj1.indexOf(c); 
      if (pos == -1) { 
          
         codificado = c; 
      } else {
        System.out.println("El caracter '" + c + "' de la posicion " + pos + 
                  " será cambiado por el caracter '" + conjunto2[pos] + "'"); 
        codificado = conjunto2[pos]; 
      }
      return codificado;
   }
}
