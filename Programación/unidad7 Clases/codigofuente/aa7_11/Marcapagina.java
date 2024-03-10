package com.mycompany.aa7_11;

public class Marcapagina {
    private int pag = 0;

    public int ultimaPaginaLeida() {
        return pag;
    }

    public void setPag(int pag) {
        this.pag = pag;
    }
    
    void siguientePag(){
        pag++;
    }    
    
    void comenzar() {
        pag = 0;
    }
}
