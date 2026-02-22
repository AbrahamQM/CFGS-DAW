/* Creación de Base de datos */

CREATE DATABASE ResidenciasEscolares;
USE ResidenciasEscolares;

/* Creación de Tablas */

CREATE TABLE universidades (codUniversidad Char(6) PRIMARY KEY, nomUniversidad varChar(30));

CREATE TABLE residencias (codResidencia Integer AUTO_INCREMENT PRIMARY KEY,nomResidencia varChar(30), codUniversidad Char(6), precioMensual SmallInt DEFAULT 900, Comedor tinyint(1) DEFAULT 0,
FOREIGN KEY (codUniversidad) REFERENCES universidades(codUniversidad));

CREATE TABLE estudiantes (codEstudiante Integer PRIMARY KEY,nomEstudiante varChar(50), dni Char(9) UNIQUE, telefonoEstudiante Char(9) UNIQUE);

CREATE TABLE estancias (codEstudiante Integer,codResidencia Integer,fechaInicio Date, fechaFin Date, preciopagado SmallInt, 
PRIMARY KEY(codEstudiante,codResidencia,fechaInicio), 
FOREIGN KEY (codEstudiante) REFERENCES estudiantes(codEstudiante), 
FOREIGN KEY (codResidencia) REFERENCES residencias(codResidencia));




/* 1º Procedimiento listaestancias */

delimiter $$

CREATE PROCEDURE listaestancias(IN dni Char(9))
BEGIN
SELECT residencias.nomResidencia,universidades.nomUniversidad,estancias.fechaInicio,estancias.fechaFin,estancias.preciopagado 
FROM residencias,universidades,estancias,estudiantes 
WHERE residencias.codUniversidad=universidades.codUniversidad AND 
residencias.codResidencia=estancias.codResidencia AND
estancias.codEstudiante=estudiantes.codEstudiante AND
estudiantes.dni = dni ORDER BY estancias.fechaInicio;
END
$$
delimiter ; 

/* 2º Procedimiento Insertarresidencia*/

delimiter $$


CREATE PROCEDURE Insertarresidencia(IN nomResidencia varChar(30),IN codUniversidad Char(6),
IN precioMensual SmallInt,IN Comedor tinyint(1),OUT UniversidadExiste Integer, OUT InsercionCorreta Integer) 
BEGIN
SET UniversidadExiste = 0;
SET InsercionCorreta = 0;

SET UniversidadExiste = (SELECT COUNT(*) FROM universidades WHERE universidades.codUniversidad=codUniversidad);

CASE UniversidadExiste
	WHEN 1 THEN 
		BEGIN
		SET @NumeroresidenciasAntes = (SELECT COUNT(*) FROM residencias);
		
	    INSERT INTO residencias VALUES (null,nomResidencia,codUniversidad,precioMensual,Comedor);
		
		SET @NumeroresidenciasDespues = (SELECT COUNT(*) FROM residencias);
		
		IF @NumeroresidenciasDespues>@NumeroresidenciasAntes THEN 
        SET InsercionCorreta = 1;
        ELSE
        SET InsercionCorreta = 0;
        END IF;
		        
		END;
ELSE
        BEGIN
	END;
    END CASE;
END
$$
delimiter ;

/*CALL Insertarresidencia('San José','Ulpgc',100,1,@e,@f);
SELECT @e;
SELECT @f;*/

/* 3º Procedimiento NumeroResidenciasPrecio*/

delimiter $$


CREATE PROCEDURE NumeroResidenciasPrecio(IN nomUniversidad varChar(30),IN precioMensual SmallInt,
OUT ResidenciasNumero Integer, OUT ResidenciasNumeroPrecioInferior Integer) 
BEGIN
SET ResidenciasNumero = 0;
SET ResidenciasNumeroPrecioInferior = 0;

SET ResidenciasNumero = (SELECT COUNT(*) FROM universidades INNER JOIN residencias ON universidades.codUniversidad=residencias.codUniversidad 
WHERE universidades.nomUniversidad=nomUniversidad);

SET ResidenciasNumeroPrecioInferior = (SELECT COUNT(*) FROM universidades INNER JOIN residencias ON universidades.codUniversidad=residencias.codUniversidad 
WHERE universidades.nomUniversidad=nomUniversidad and residencias.precioMensual<precioMensual);

END
$$
delimiter ;

/*CALL NumeroResidenciasPrecio('La Palmas',105,@e,@f);
SELECT @e;

SELECT @f;*/

/* 4º Función Numerodemeses*/

delimiter $$


CREATE FUNCTION Numerodemeses(dni varChar(9)) RETURNS Integer
 DETERMINISTIC
 CONTAINS SQL
BEGIN
DECLARE Numero Integer DEFAULT 0;
SET Numero = (SELECT sum(TIMESTAMPDIFF(MONTH,estancias.fechaInicio,estancias.fechaFin)) AS meses_transcurridos 
FROM estudiantes INNER JOIN estancias ON estudiantes.codEstudiante=estancias.codEstudiante WHERE estudiantes.dni=dni);
RETURN Numero;
END
$$
delimiter ;

/*SELECT Numerodemeses('45');
*/
/*

/* 1º TRIGGER Fechas*/

delimiter $$
CREATE TRIGGER Fechas_Update BEFORE UPDATE
ON estancias FOR EACH ROW
Begin
DECLARE Fecha1 DATE;
DECLARE Fecha2 DATE;
IF NEW.fechaInicio>NEW.fechaFin THEN
	SET Fecha1 = NEW.fechaInicio;
	SET Fecha2 = NEW.fechaFin;
	SET NEW.fechaInicio = Fecha2;
	SET NEW.fechaFin = Fecha1;
END IF;

End
$$
delimiter ;

delimiter $$
CREATE TRIGGER Fechas_Insert BEFORE INSERT
ON estancias FOR EACH ROW
Begin
DECLARE Fecha1 DATE;
DECLARE Fecha2 DATE;
IF NEW.fechaInicio>NEW.fechaFin THEN
	SET Fecha1 = NEW.fechaInicio;
	SET Fecha2 = NEW.fechaFin;
	SET NEW.fechaInicio = Fecha2;
	SET NEW.fechaFin = Fecha1;
END IF;

End
$$
delimiter ;

/* 2º TRIGGER PrecioMensual*/

delimiter $$
CREATE TRIGGER PrecioMensual_Update BEFORE UPDATE
ON residencias FOR EACH ROW
Begin

IF NEW.precioMensual>900 THEN
	signal sqlstate '45000' set message_text='El precio no puede ser superior a 900';
END IF;

End
$$
delimiter ;

delimiter $$
CREATE TRIGGER PrecioMensual_Insert BEFORE INSERT
ON residencias FOR EACH ROW
Begin

IF NEW.precioMensual>900 THEN
	signal sqlstate '45000' set message_text='El precio no puede ser superior a 900';
END IF;

End
$$
delimiter ;

/* 3º TRIGGER NoBorrarUniversidad*/

delimiter $$
CREATE TRIGGER NoBorrar_Uni BEFORE DELETE
ON universidades FOR EACH ROW
Begin

signal sqlstate '45000' set message_text='No se puede borrar Universidades';

End
$$
delimiter ;

INSERT INTO universidades (codUniversidad,nomUniversidad) VALUES ("Ull","La Laguna"),("Ulpgc","Gran Canaria"),("Upm","Madrid");
INSERT INTO estudiantes VALUES (1,"David",45,922),(2,"Jose",46,923),(3,"Ana",47,924);
INSERT INTO residencias VALUES (null,"San Pedro","Ull",200,0),(null,"San Matias","Ull",300,1),(null,"San Luis","Upm",250,0);
INSERT INTO estancias VALUES (1,1,"2019-02-14","2019-06-14",200),(1,1,"2018-01-14","2018-07-14",300),(2,2,"2016-02-14","2017-06-14",400);

