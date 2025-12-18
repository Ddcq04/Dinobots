--CREACION DE TABLAS--
CREATE TABLE Era (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE Periodo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    id_era INT NOT NULL,
    FOREIGN KEY (id_era) REFERENCES Era(id) ON DELETE RESTRICT
);

CREATE TABLE Dinosaurio (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    id_periodo INT NOT NULL,
    tiempo_vida VARCHAR(100) NOT NULL,
    ubicacion VARCHAR(100) NOT NULL,
    alimentacion VARCHAR(50) NOT NULL,
    agresividad INT NOT NULL,
    familia VARCHAR(50) NOT NULL,
    especie VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_periodo) REFERENCES Periodo(id) ON DELETE RESTRICT
);

CREATE TABLE Usuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    hash_contrasena VARCHAR(255) NOT NULL,
    correo VARCHAR(100) NOT NULL
);

CREATE TABLE Voto (
    id_usuario INT NOT NULL,
    id_dinosaurio INT NOT NULL,
    PRIMARY KEY (id_usuario, id_dinosaurio),
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id) ON DELETE CASCADE,
    FOREIGN KEY (id_dinosaurio) REFERENCES Dinosaurio(id) ON DELETE CASCADE
);


--INSERCION DE DATOS--