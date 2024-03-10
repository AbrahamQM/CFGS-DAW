package com.mycompany.aa7_15;

public class Calendario {
    private int dia, mes, año;
    
    public Calendario(int dia, int mes, int año) {
//Entiendo que año<0 = A.C.----También obvio el nº de dias de cada mes concreto
        if (dia > 0 && dia < 32 && mes > 0 && mes < 13 && año != 0) {
            this.dia = dia;
            this.mes = mes;
            this.año = año;
        }//en caso contrario lanzaría una excepción pero no lo hemos visto aún
    }
   
    void mostrar() {
        System.out.println("Fecha: " + dia  + '/' + mes + '/' + año);
    }

    void incrementarDia() {
        if(dia == 31){
            incrementaMes();
            dia = 1;
        }else{
            dia ++;
        }
    }

    void incrementaMes() {
        if (mes == 12) {
            incrementaAño();
            mes = 1;
        } else {
            mes++;
        }
    }
    
    void incrementaAño() {
        año ++;
    }
    
    String iguales(Calendario otro){
        return (otro.año == año) && (otro.mes == mes) && (otro.dia == dia) ? "SI" : "NO";
    }
}
