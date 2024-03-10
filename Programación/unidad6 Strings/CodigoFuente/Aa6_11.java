package com.mycompany.aa6_11;

import java.util.Scanner;
public class Aa6_11 {
   public static void main(String[] args) {
      Scanner sc = new Scanner(System.in);
      final char conjunto1[] = {'e', 'i', 'k', 'm', 'p', 'q', 'r', 's', 't', 'u', 'v'};
      final char conjunto2[] = {'p', 'v', 'i', 'u', 'm', 't', 'e', 'r', 'k', 'q', 's'};
      char codificado[]; 
      char decodificado[];
      String texto;
      System.out.print("Introduzca un texto a codificar: ");
      texto = sc.nextLine();
      texto = texto.toLowerCase();  
      codificado = new char[texto.length()];
      decodificado = new char[texto.length()];
      for (int i = 0; i < texto.length(); i++) { 
         codificado[i] = codifica(conjunto1, conjunto2, texto.charAt(i));
      }
      texto = String.valueOf(codificado); 
      System.out.println("El texto CODIFICADO es:\n-" + texto);
      
      for (int i = 0; i < texto.length(); i++) { 
         decodificado[i] = decodifica(conjunto1, conjunto2, texto.charAt(i));
      }
      texto = String.valueOf(decodificado); 
      System.out.println("\n\n---El texto DECODIFICADO es:\n-" + texto);
   }

   static char decodifica(char conjunto1[], char conjunto2[], char c){
       return codifica(conjunto2, conjunto1, c);
   }
   
   
   static char codifica(char conjunto1[], char conjunto2[], char c) {
      final String conj1 = String.valueOf(conjunto1); 
      char codificado; 
      int pos = conj1.indexOf(c); 
      if (pos == -1) { 
         codificado = c; 
      } else {
         codificado = conjunto2[pos]; 
      }
      return codificado;
   }
}


