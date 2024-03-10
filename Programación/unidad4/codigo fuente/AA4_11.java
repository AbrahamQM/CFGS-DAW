package aa4_11;

public class AA4_11 {


    public static void main(String[] args) {
        calcula(10);
    }
    
    static void calcula(int radio){
        float cuatroPi = (float) (Math.PI * 4);
        System.out.println("Superficie: " +  cuatroPi * (radio * radio));
        System.out.println("Volumen: " + (cuatroPi / 3) * (radio * radio * radio));
    }
}
