CREATE DATABASE gestionSalas;
use gestionSalas;

GRANT ALL PRIVILEGES ON gestion.* TO 'alejandro'@'%' IDENTIFIED BY '12345';
FLUSH PRIVILEGES;

CREATE TABLE administrador(
    dniAdmin varchar(9) PRIMARY KEY,
    correo varchar(50) NOT NULL,
    password varchar(40) NOT NULL
);

CREATE TABLE salas(
    idSala INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    capacidad int NOT NULL,
    disponibilidad boolean default true,
    horarios varchar(50) NOT NULL,
    precio INT NOT NULL,
    dniAdmin varchar(9)
);

CREATE TABLE cliente(
    dniCliente varchar(9) PRIMARY KEY,
    nombre varchar(30) NOT NULL,
    apellidos varchar(50) NOT NULL,
    contrasenya varchar(20) NOT NULL,
    correo varchar(50) NOT NULL,
    telefono int(9) NOT NULL,
    fechaNacimiento date NOT NULL
);

CREATE TABLE admin_salas(
    idSala INT UNSIGNED AUTO_INCREMENT,
    dniAdmin varchar(9),
    PRIMARY KEY(idSala, dniAdmin)
);

-- Creo directamente al administrador que voy a tener.

insert into administrador (dniAdmin, correo, password) values ("000", "admin@gmail.com", 12345);

ALTER TABLE salas add foreign key (dniAdmin) references administrador(dniAdmin);

ALTER TABLE admin_salas add foreign key (dniAdmin) references administrador(dniAdmin);
ALTER TABLE admin_salas add foreign key (idSala) references salas(idSala);

