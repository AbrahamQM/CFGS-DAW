package aa14_14;

import java.sql.*;
import java.util.*;

public class Aa14_14 {

 public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        int max, min;
        try {
            Connection con = DriverManager.getConnection("jdbc:mysql://127.0.0.1/empresa",
                    "Pepe", "12345");
            System.out.println("Introduzca edad minima: ");
            min = sc.nextInt();           
            System.out.println("Introduzca edad maxima: ");
            max = sc.nextInt();           
            String consulta = "SELECT nombre, edad FROM empleados "
                    + "WHERE  ? < edad AND ? > edad";
            PreparedStatement sentencia = con.prepareStatement(consulta);
            sentencia.setInt(1, min);
            sentencia.setInt(2, max);
            ResultSet rs = sentencia.executeQuery();

            while(rs.next()){
                System.out.println("*********************************************");
                System.out.println("Nombre: " + rs.getString("nombre"));
                System.out.println("Edad: " + rs.getInt("edad"));
                System.out.println("*********************************************");
            }
            
            con.close();
        } catch (SQLException ex) {
            System.out.println(ex);
        }
    }
}
