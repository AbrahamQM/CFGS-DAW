package aa14_12;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class Aa14_12 {

    public static void main(String[] args) {
        List<Oficina> oficinas = new ArrayList();
        try {
            Connection con = DriverManager.getConnection("jdbc:mysql://127.0.0.1/empresa",
                    "Pepe", "12345");
            String consulta = "SELECT * FROM oficinas";
            Statement sentencia = con.createStatement();
            ResultSet rs = sentencia.executeQuery(consulta);

            while (rs.next()) {
                oficinas.add(new Oficina(rs.getInt("oficina"),
                        rs.getString("ciudad"),
                        rs.getInt("superficie"),
                        rs.getDouble("ventas")));
            }
            con.close();
            for (Oficina ofi : oficinas) {
                System.out.println(ofi);
            }
        } catch (SQLException ex) {
            System.out.println(ex);
        }

    }

}
