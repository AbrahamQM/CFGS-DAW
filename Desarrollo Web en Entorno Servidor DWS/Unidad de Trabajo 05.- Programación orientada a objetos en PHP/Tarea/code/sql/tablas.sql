-- Creamos la base de datos
create database practicaUnidad5;
-- La seleccionamos
use practicaUnidad5;
-- Crearemos un usuario para trabajar con la base de datos creada (podemos crear otro)
create user gestor@'localhost' identified by '12345';
-- Le asignariamos los permisos necesarios 
grant all on practicaUnidad5.* to gestor@'localhost';
 -- Creamos las Tablas --
 create table jugadores(
    id int auto_increment primary key,
    nombre varchar(40) not null,
    apellidos varchar(60) not null,
    telefono varchar(9),
    nacionalidad varchar(50) not null,
    fecha_nacimiento date,
    dorsal int unique,
    posicion enum('Portero', 'Defensa', 'Lateral Izquierdo', 'Lateral Derecho', 'Central', 'Delantero'),
    barcode varchar(13) unique not null
 );

-- ## Se deben insertar algunos datos en la tabla
-- Para ello usar setencia SQL: insert into <nombreTabla> (<campo1>, <campo2>, ... <campoN>) values (<valor1>, <valor2>, ... <valorN>);
-- Por ejemplo:

-- Nombre: 'Antonio' Apellidos: 'Perez Suarez', telefono: '922222222', nacionalidad: 'España', fecha_nacimiento: '1987-06-24', dorsal:10, posicion: 'delantero', barcode: '0952945303398'
-- Nombre: 'Mohamed' Apellidos: 'Salah', telefono: '', nacionalidad: 'Egipto', fecha_nacimiento: '1992-06-15', dorsal:9, posicion: 'central', barcode: '2406603743234'
-- Nombre: 'Maria' Apellidos: 'Ruano Perez', telefono: '622323232', nacionalidad: 'España', fecha_nacimiento: '2000-08-15', dorsal:1, posicion: 'portera', barcode: '2829114057100'
-- Nombre: 'Ana' Apellidos: 'Sanchez Hernandez', telefono: '', nacionalidad: 'Argentina', fecha_nacimiento: '2005-10-25', dorsal:4, posicion: 'defensa', barcode: '9745708466710'

