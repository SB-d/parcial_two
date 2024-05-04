CREATE DATABASE CineDB;
USE CineDB;

CREATE TABLE Administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL
);

INSERT INTO Administradores (nombre, username, password, correo) VALUES ('Admin', 'admin1', 'admin1234', 'admin@cine.com');

CREATE TABLE Salas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    codigo VARCHAR(255) UNIQUE NOT NULL,
    capacidad INT NOT NULL
);

CREATE TABLE Peliculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    codigo VARCHAR(255) NOT NULL,
    clasificacion ENUM('TP', '7', '12', '15', '18') NOT NULL
);

CREATE TABLE Funciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_funcion VARCHAR(255) NOT NULL,
    fecha_hora DATETIME NOT NULL,
    pelicula_id INT,
    sala_id INT,
    FOREIGN KEY (pelicula_id) REFERENCES Peliculas(id),
    FOREIGN KEY (sala_id) REFERENCES Salas(id)
);
