package com.mycompany.aa7_16;

public class Punto {
    private double x, y;
    
    //constructor
    public Punto(double x, double y) {
        this.x = x;
        this.y = y;
    }
    
    //Métodos
    public void desplazaX(double dX){
        x += dX;
    }

    public void desplazaY(double dY){
        y += dY;
    }
    
    public void desplaza(double dX, double dY){
        x += dX;
        y += dY;
    }

    public double distanciaEuclidea(Punto p2){
        return Math.sqrt( Math.pow(p2.getX() - x, 2) 
                + Math.pow(p2.getY() - y, 2));
    }
    
    public void muestra(){
        System.out.println("El punto se encuentra en las coordenadas X:" + x + 
                " Y:" + y);
    }
    
    //getter
    public double getX() {return x;}
    public double getY() {return y;}
}
