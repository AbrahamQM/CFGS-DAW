package aa14_11;

import java.sql.*;

public class Aa14_11 {

 public static void main(String[] args) {
         try {
            Connection con = DriverManager.getConnection("jdbc:mysql://127.0.0.1/empresa", 
                    "Pepe", "12345");
            String consulta = "SELECT * FROM empleados";
            Statement sentencia = con.createStatement();
            ResultSet rs = sentencia.executeQuery(consulta);
            
            while(rs.next()){
                System.out.println("*********************************************");
                System.out.println("Num empleado: " + rs.getInt("numemp"));
                System.out.println("Nombre: " + rs.getString("nombre"));
                System.out.println("Edad: " + rs.getInt("edad"));
                System.out.println("Oficina: " + rs.getInt("oficina"));
                System.out.println("Puesto: " + rs.getString("puesto"));
                System.out.println("Contrato: " + rs.getDate("contrato"));
                System.out.println("*********************************************");
            }
            con.close();
        } catch (SQLException ex) {
             System.out.println(ex);
        }
    }
}
