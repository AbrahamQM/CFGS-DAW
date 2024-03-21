
package aa14_13;

import java.sql.*;
import java.util.*;

public class Aa14_13 {

      public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        String city;
        try {
            Connection con = DriverManager.getConnection("jdbc:mysql://127.0.0.1/empresa",
                    "Pepe", "12345");
            System.out.println("Introduzca ciudad para mostrar sus oficinas: ");
            city = sc.next();           
            String consulta = "SELECT * FROM oficinas WHERE ciudad LIKE ?";
            PreparedStatement sentencia = con.prepareStatement(consulta);
            sentencia.setString(1, city);
            ResultSet rs = sentencia.executeQuery();

            while (rs.next()) {
                System.out.println(new Oficina(rs.getInt("oficina"),
                        rs.getString("ciudad"),
                        rs.getInt("superficie"),
                        rs.getDouble("ventas")));
            }
            con.close();
        } catch (SQLException ex) {
            System.out.println(ex);
        }
    }
}
