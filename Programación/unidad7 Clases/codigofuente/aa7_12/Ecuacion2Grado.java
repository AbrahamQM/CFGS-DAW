package com.mycompany.aa7_12;

public class Ecuacion2Grado {
    private double a, b, c, discriminante;


    //Constructor
    public Ecuacion2Grado(double a, double b, double c) {
        this.a = a;
        this.b = b;
        this.c = c;
        discriminante =  b * b - 4 * a * c;
    }

    //getter & setter
    public double getA() {
        return a;
    }

    public void setA(int a) {
        this.a = a;
        discriminante = b * b - 4 * a * c;
    }
    
    public double getB() {
        return b;
    }

    public void setB(int b) {
        this.b = b;
        discriminante = b * b - 4 * a * c;
    }

    public double getC() {
        return c;
    }

    public void setC(int c) {
        this.c = c;
        discriminante = b * b - 4 * a * c;
    }
    
    //Métodos
    String esPositivoDiscriminante() {
        return "El discriminante es: " + (discriminante >= 0 ? "positivo" : "negativo");
    }

    double[] solucion() { //x = [-b ± sqrt(b^2 - 4ac)] / (2a)
        double soluciones[] =  new double[2];
        if (discriminante >= 0) {
            soluciones[0] = (-b + Math.sqrt(discriminante)) / (2 * a);
            soluciones[1] = (-b - Math.sqrt(discriminante)) / (2 * a);
        }else {
             soluciones[0] = -b / (2 * a);
             soluciones[1] =  Math.sqrt(-discriminante) / (2 * a);
        }
        return soluciones;
    }


}
