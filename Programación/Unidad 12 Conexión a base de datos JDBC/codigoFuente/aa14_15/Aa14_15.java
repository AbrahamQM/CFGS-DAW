
package aa14_15;
import java.sql.*;
import java.util.*;

public class Aa14_15 {

    public static void main(String[] args) {
      Scanner sc = new Scanner(System.in);
        int max, min;
        try {
            Connection con = DriverManager.getConnection("jdbc:mysql://127.0.0.1/empresa",
                    "Pepe", "12345");
    
            String consulta = "UPDATE empleados SET contrato = CURRENT_DATE() "
                    + "WHERE numemp = 101";
            Statement sentencia = con.createStatement();

            int modificados = sentencia.executeUpdate(consulta);
            System.out.println("Se han modificado " + modificados + " elementos.");
            con.close();
        } catch (SQLException ex) {
            System.out.println(ex);
        }

    }

}
