-- Base de datos: 'comunidad'
-- el esquema que se muestra en la tarea no coincide con los registros de la descripción.
-- lo he adaptado para que tenga sentido. 
-- He puesto como principal el usuario.
-- los vecinos apuntan a usuarios, porque tosos son usuarios.
-- las viviendas apuntan a vecinos, porque un vecino puede tener varias viviendas(one to many), y no puede haber viviendas sin vecino.
-- cuotas apuntan a viviendas y, a vecinos para facilitar consultas.


-- inicio transacción
begin;

-- Crear la base de datos

CREATE DATABASE IF NOT EXISTS comunidad
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_spanish_ci;

USE comunidad;

-- Tabla de Usuarios
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    pass VARCHAR(50) NOT NULL,
    rol enum('vecino','presidente','administrador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Tabla de Vecinos
-- id_usuario UNIQUE porque no tiene sentido que hayan varios vecinos con el mismo usuario
-- fecha_alta por defecto la fecha actual
CREATE TABLE vecino (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT UNIQUE NOT NULL,    
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(150),
    dni VARCHAR(20) UNIQUE NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(150) UNIQUE NOT NULL,
    fecha_alta DATE NOT NULL DEFAULT CURRENT_DATE, 
    FOREIGN KEY (id_usuario) REFERENCES usuario(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Tabla de Vivienda
CREATE TABLE vivienda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_vecino INT NOT NULL,
    piso VARCHAR(10),
    bloque VARCHAR(10),
    letra VARCHAR(5),
    FOREIGN KEY (id_vecino) REFERENCES vecino(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Tabla de Cuotas
CREATE TABLE cuota (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_vivienda INT NOT NULL,
    id_vecino INT NOT NULL,
    cuotas_pagadas INT DEFAULT 0,
    cuotas_impagadas INT DEFAULT 0,
    fecha_ultima_cuota DATE,
    FOREIGN KEY (id_vivienda) REFERENCES vivienda(id) ON DELETE CASCADE,
    FOREIGN KEY (id_vecino) REFERENCES vecino(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



-- Insertar datos de ejemplo/iniciales
-- ***********Usar las credenciales de los usuarios para acceder al sistema***********
-- Usar la base de datos
USE comunidad;

-- Usuarios
INSERT INTO usuario (id, usuario, pass, rol) VALUES
(1, 'admin', 'admin123', 'administrador'),
(2, 'presi', 'presi123', 'presidente'),
(3, 'juanpg', 'clave123', 'vecino'),
(4, 'maria', 'maria123', 'vecino');

-- Vecinos (cada uno enlazado 1:1 con su usuario)
INSERT INTO vecino (id, id_usuario, nombre, apellidos, dni, telefono, email, fecha_alta) VALUES
(1, 1, 'Admin', 'Gestoría', '00000000A', NULL, 'admin@gestoria.com', '2021-09-01'),
(2, 2, 'Juan', 'González', '11111111B', NULL, 'presi@comunidad.com', '2021-09-01'),
(3, 3, 'Juan', 'Pérez García', '12345678C', '600123456', 'juan@example.com', '2023-01-15'),
(4, 4, 'María', 'López Díaz', '22222222D', '688888888', 'maria@vecinos.com', '2025-10-07');

-- Viviendas
-- Admin sin vivienda real
-- Presidente sin vivienda real
-- Juan Pérez: B1-2A
-- María: B2-2A
-- María: B2-2B (tiene dos viviendas)
INSERT INTO vivienda (id, id_vecino, piso, bloque, letra) VALUES
(1, 1, NULL, NULL, '---'), 
(2, 2, NULL, NULL, '---'), 
(3, 3, '2', 'B1', 'A'),    
(4, 4, '2', 'B2', 'A'),    
(5, 4, '2', 'B2', 'B');  

-- Cuotas
INSERT INTO cuota (id, id_vivienda, id_vecino, cuotas_pagadas, cuotas_impagadas, fecha_ultima_cuota) VALUES
(1, 1, 1, 22, 1, '2025-08-07'),
(2, 2, 2, 0, 0, NULL),
(3, 3, 3, 12, 9, '2024-12-03'),
(4, 4, 4, 0, 0, NULL),
(5, 5, 4, 0, 0, NULL);


-- Fin de la transacción
commit;