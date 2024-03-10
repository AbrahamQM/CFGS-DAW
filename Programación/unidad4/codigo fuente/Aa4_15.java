package aa4_15;

public class Aa4_15 {

    public static void main(String[] args) {
        System.out.println("Minutos de diferencia: " + diferenciaMin(15, 25, 11, 50));
    }
    
    static int diferenciaMin(int hora1, int min1, int hora2, int min2){
        int horas = (hora1 > hora2) ? (hora1 - hora2) * 60 : (hora2 - hora1) * 60;
        int minutos = 0;
        if(hora1 > hora2) {
            if(min1 > min2){
                minutos = min1 - min2;
            }else if(min1 < min2){
                minutos = 60 - min2 + min1;
            }
        }else{
            if (min2 > min1){
                minutos = min2 - min1;
            }else if(min2 < min1){
                minutos = 60 - min1 + min2;
            }
        }
        return horas + minutos;
    }
    
}
