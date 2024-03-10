package aa4_14;

public class Aa4_14 {

    public static void main(String[] args) {
           System.out.println("Segundos totales: " + segundos(5, 10, 12));
    }
    
    static double segundos(int dias, int horas, int min){
        return (dias * 24 * 60 * 60) + (horas * 60 * 60) + (min * 60);
    }
    
}
