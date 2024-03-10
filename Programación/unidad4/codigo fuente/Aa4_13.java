package aa4_13;

public class Aa4_13 {

    public static void main(String[] args) {
        muestraPares(5);
    }
    
    static void muestraPares(int n){
        System.out.println("Primeros " + n + " numeros pares:");
        int contador = 0;
        for (int i=0; contador < n ; i++){
            if( i % 2 == 0){
                 System.out.println((contador + 1) + "# numero par: " + i);
                 contador++;
            }
           
        }
    }
    
}
