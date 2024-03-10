package com.mycompany.aa7_17;

public class Cifrado {

    public static String cesar(String input, int paso){
        char[] array = input.toCharArray();
        int i= 0;
        for(char letra: array){
            array[i] = Character.isLetter(letra + paso) ?  (char)(letra + paso) 
                    : asignador(letra, paso);
            i++;
        }
        
        return new String(array);
    }
    
    private static char asignador(char letra, int paso){
        if(!Character.isLetter(letra)){
            return letra;
        }else if ( Character.isLowerCase(letra)){
            while( letra <= 'z' && paso > 0){
                letra++;
                paso--;
            }
            if( paso > 0){
                return (char)('a' + paso);
            }
            return 'a';
        }else{
             while( letra <= 'Z' && paso > 0){
                letra++;
                paso--;
            }
            if( paso > 0){
                return (char)('A' + paso);
            }
            return 'A';
        }
    }
}
