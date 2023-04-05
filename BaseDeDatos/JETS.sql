CREATE DATABASE JETS;


CREATE TABLE PERSONA(
    codigo INT NOT NULL AUTO_INCREMENT,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    nro_registro VARCHAR(10) NOT NULL UNIQUE,
    PRIMARY KEY (codigo)
);

CREATE TABLE USUARIO(
    id INT NOT NULL AUTO_INCREMENT,
    usuario VARCHAR(50) NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE INSCRIPCION(
    id INT NOT NULL AUTO_INCREMENT,
    nro_celular INT,
    talla_polera CHAR(5),
    carnet_identidad INT,
    estado_incripcion BOOLEAN NOT NULL DEFAULT FALSE,
    foto_estudiante VARCHAR(1000),
    cdg_persona INT NOT NULL,
    cdg_registro INT NOT NULL,
    FOREIGN KEY (cdg_persona) REFERENCES PERSONA(codigo),
    FOREIGN KEY (cdg_registro) REFERENCES USUARIO(id),
    PRIMARY KEY (id)
);


CREATE PROCEDURE registrar_estudiante(IN nombres_IN VARCHAR(250), IN apellidos_IN VARCHAR(250),IN nroDeRegistro_IN VARCHAR(10),IN nro_celular INT,IN talla_polera_IN CHAR(5),IN carnet_identidad_IN INT,IN url_foto_estudiante VARCHAR(1000),IN cdg_persona_IN INT,IN cdg_registroUsuario_IN INT)

BEGIN

    



END //