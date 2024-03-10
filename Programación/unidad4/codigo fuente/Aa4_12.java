package aa4_12;

public class Aa4_12 {

    public static void main(String[] args) {
        System.out.println("Distancia: " + distancia(5.5d, 9.9d, 3.3d, 7.7d));
    }
    
    static double distancia(double x1, double y1, double x2, double y2){
        return Math.sqrt( Math.pow((x1 - x2), 2) + Math.pow((y1 - y2), 2)); 
    }
}
