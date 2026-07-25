/*============================================================
  BASE DE DATOS: AGENCIA

  Sistema de gestión para una agencia de viajes que permite
  administrar clientes, vuelos, hoteles y reservas.
============================================================*/


/*============================================================
  CREACIÓN DE LA BASE DE DATOS
============================================================*/

DROP DATABASE IF EXISTS agencia;

CREATE DATABASE agencia
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE agencia;


/*============================================================
  TABLA CLIENTE
============================================================*/

CREATE TABLE cliente (

    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(20)

);


/*============================================================
  TABLA VUELO
============================================================*/

CREATE TABLE vuelo (

    id_vuelo INT AUTO_INCREMENT PRIMARY KEY,
    origen VARCHAR(100) NOT NULL,
    destino VARCHAR(100) NOT NULL,
    fecha DATE NOT NULL,
    plazas_disponibles INT NOT NULL,
    precio DECIMAL(10,2) NOT NULL

);


/*============================================================
  TABLA HOTEL
============================================================*/

CREATE TABLE hotel (

    id_hotel INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    ubicacion VARCHAR(100) NOT NULL,
    habitaciones_disponibles INT NOT NULL,
    tarifa_noche DECIMAL(10,2) NOT NULL

);


/*============================================================
  TABLA RESERVA
============================================================*/

CREATE TABLE reserva (

    id_reserva INT AUTO_INCREMENT PRIMARY KEY,

    id_cliente INT NOT NULL,

    fecha_reserva DATE NOT NULL,

    id_vuelo INT NOT NULL,

    id_hotel INT NOT NULL,

    CONSTRAINT fk_reserva_cliente
        FOREIGN KEY (id_cliente)
        REFERENCES cliente(id_cliente),

    CONSTRAINT fk_reserva_vuelo
        FOREIGN KEY (id_vuelo)
        REFERENCES vuelo(id_vuelo),

    CONSTRAINT fk_reserva_hotel
        FOREIGN KEY (id_hotel)
        REFERENCES hotel(id_hotel)

);


/*============================================================
  DATOS DE PRUEBA - CLIENTES
============================================================*/

INSERT INTO cliente (nombre, correo, telefono) VALUES
('María González','maria.gonzalez@email.com','912345678'),
('Juan Pérez','juan.perez@email.com','923456789'),
('Camila Rojas','camila.rojas@email.com','934567890');


/*============================================================
  DATOS DE PRUEBA - VUELOS
============================================================*/

INSERT INTO vuelo
(origen,destino,fecha,plazas_disponibles,precio)
VALUES

('Santiago','Buenos Aires','2026-08-15',25,320000),

('Santiago','Lima','2026-09-02',18,280000),

('Santiago','Río de Janeiro','2026-10-10',30,450000);


/*============================================================
  DATOS DE PRUEBA - HOTELES
============================================================*/

INSERT INTO hotel
(nombre,ubicacion,habitaciones_disponibles,tarifa_noche)
VALUES

('Hotel Andes','Buenos Aires',20,95000),

('Hotel Pacífico','Lima',15,80000),

('Hotel Central','Río de Janeiro',18,120000);


/*============================================================
  DATOS DE PRUEBA - RESERVAS
============================================================*/

INSERT INTO reserva
(id_cliente,fecha_reserva,id_vuelo,id_hotel)
VALUES

(1,'2026-07-01',1,1),
(2,'2026-07-02',1,1),
(3,'2026-07-03',1,1),
(1,'2026-07-04',2,1),

(2,'2026-07-05',2,2),
(3,'2026-07-06',2,2),
(1,'2026-07-07',2,2),

(2,'2026-07-08',3,3),
(3,'2026-07-09',3,3),
(1,'2026-07-10',3,3);


/*============================================================
  FIN DEL SCRIPT
============================================================*/