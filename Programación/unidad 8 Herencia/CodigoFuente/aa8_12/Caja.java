package com.mycompany.aa8_12;

class Caja {
    final int alto, ancho, fondo;
    String etiqueta; // no puede ser privado porque en el main se accede a el 
    //atributo directamente sin el gettter    
    Caja(int ancho, int alto, int fondo, Unidad unidad) {
        this.alto = alto;
        this.ancho = ancho;        
        this.fondo = fondo;
    }

    double getVolumen(){
        return alto * ancho * fondo;
    }
   
    void setEtiqueta(String etiqueta) {
        if( etiqueta.length() <= 30){
            this.etiqueta = etiqueta;        
        }
        else {System.out.println("ERROR: Etiqueta demasiado larga!!");}
    }

    @Override
    public String toString() {
        return "\n--Caja: " + etiqueta +  " \nMedidas: alto=" + alto + ", ancho=" 
                + ancho + ", fondo=" + fondo;
    }    
}
