package com.mycompany.aa7_14;

import java.math.BigDecimal;

public class Cambio {
    private double importe;
    private final double[] BILLETES = new double[]{5, 10, 20, 50, 100, 200, 500};
    private final double[] MONEDAS = new double[]{0.01, 0.02, 0.05, 0.1, 0.2, 
        0.5, 1, 2};  
    
    //Constructor
    public Cambio(double importe) {
        this.importe = importe;
    }
    
    /*ESTE MÉTODO PRODUCE UN PROBLEMA DE PRESICION AL USAR UN DOUBLE
        PARA RESOLVERLO HAY QUE USAR LA CLASE BigDecimal.*/
     public void mostrarCambio() { 
        BigDecimal restante = BigDecimal.valueOf(importe);
        int i = 6;
        System.out.println("\nImporte a devolver: " + importe);
        System.out.println("------Cambio a entregar------");
        while (restante.compareTo(BigDecimal.valueOf(5)) >= 0 && i >= 0) {
            BigDecimal[] result = restante.divideAndRemainder( BigDecimal.valueOf(BILLETES[i]));
            int cantidad = result[0].intValue();
            if (cantidad > 0) {
                System.out.println("Billetes de " + BILLETES[i] + ": " + cantidad);
                restante = result[1];
            }
            i--;
        }
        i = 7;
        while (restante.compareTo(BigDecimal.ZERO) > 0 && i >= 0) {
            BigDecimal[] result = restante.divideAndRemainder( BigDecimal.valueOf(MONEDAS[i]));
            int cantidad = result[0].intValue();
            if (cantidad > 0) {
                System.out.println("Monedas de " + MONEDAS[i] + ": " + cantidad);
                restante = result[1];
            }
            i--;
        }
    }
     
    public void setImporte(double importe){
        this.importe = importe;
    };
}
