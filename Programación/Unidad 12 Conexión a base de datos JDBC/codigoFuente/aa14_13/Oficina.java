package aa14_13;

public class Oficina {
    int oficina;
    String ciudad;
    int superficia;
    double ventas;

    public Oficina(int oficina, String ciudad, int superficia, double ventas) {
        this.oficina = oficina;
        this.ciudad = ciudad;
        this.superficia = superficia;
        this.ventas = ventas;
    }

    @Override
    public String toString() {
        return "\nOficina{" + "oficina=" + oficina + ", ciudad=" + ciudad + ", "
                + "superficia=" + superficia + ", ventas=" + ventas + '}';
    }
    
    

}
