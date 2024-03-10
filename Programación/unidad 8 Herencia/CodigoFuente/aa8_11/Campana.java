package com.mycompany.aa8_11;

class Campana extends Instrumento{

    public Campana() {
        super(); 
    }

    @Override 
    public void interpretar() {
        for (Nota nota : melodia) {
            switch (nota) {
                case DO:
                    System.out.print("plin-do ");
                    break;
                case RE:
                    System.out.print("plin-re ");
                    break;
                case MI:
                    System.out.print("plin-mi ");
                    break;
                case FA:
                    System.out.print("plin-fa ");
                    break;
                case SOL:
                    System.out.print("plin-sol ");
                    break;
                case LA:
                    System.out.print("plin-la ");
                    break;
                case SI:
                    System.out.print("plin-si ");
                    break;
            }
        }
        System.out.println("");
    }
}

