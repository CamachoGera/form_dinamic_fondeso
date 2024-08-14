CREATE DATABASE form_dinamico;
USE form_dinamico;

CREATE TABLE alumno (
    `idalumno` INT UNSIGNED NOT NULL,
    `nombre` VARCHAR (255) NOT NULL,
    `carrera` VARCHAR (255) NOT NULL,
    `grupo` VARCHAR (255) NOT NULL
);