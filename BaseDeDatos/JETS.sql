CREATE DATABASE jets;

USE jets;

CREATE TABLE PERSONA(
    id INT NOT NULL AUTO_INCREMENT,
    nombreCompleto VARCHAR(250),
    nro_registro VARCHAR(10) NOT NULL UNIQUE,
    carrera VARCHAR(100),
    facultad VARCHAR(100),
    carnet_identidad VARCHAR(25),
    nro_celular VARCHAR(25),
    PRIMARY KEY (id)
)engine = innodb;

CREATE TABLE USUARIO(
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
)engine = innodb;

CREATE TABLE INSCRIPCION(
    id INT NOT NULL AUTO_INCREMENT,
    talla_polera CHAR(5),
    estado_inscripcion BOOLEAN NOT NULL DEFAULT FALSE,
    foto_estudiante VARCHAR(1000),
    id_persona INT NOT NULL,
    id_UsuarioInscriptor INT NOT NULL,
    FOREIGN KEY (id_persona) REFERENCES PERSONA(id),
    FOREIGN KEY (id_UsuarioInscriptor) REFERENCES USUARIO(id),
    PRIMARY KEY (id)
)engine = innodb;


DELIMITER //

CREATE PROCEDURE MostrarDatosPersona(IN nro_registro VARCHAR(10))
BEGIN
SELECT * FROM PERSONA WHERE nro_registro = nro_registro;
END //


CREATE PROCEDURE VerificarExistenciaPersona(IN nro_registro VARCHAR(10), OUT existe BOOLEAN)
BEGIN
DECLARE contador INT;
SELECT COUNT(*) INTO contador FROM PERSONA WHERE nro_registro = nro_registro;
    IF contador > 0 THEN
        SET existe = TRUE;
    ELSE
        SET existe = FALSE;
    END IF;
END //

CREATE PROCEDURE RegistrarInscripcion(
    IN nombreCompleto_IN VARCHAR(250),
    IN nroDeRegistro_IN VARCHAR(10),
    IN carrera_IN VARCHAR(100),
    IN facultad_IN VARCHAR(100),
    IN carnetDeIdentidad_IN VARCHAR(15),
    IN nroDeCelular_IN VARCHAR(20),
    IN tallaPolera_IN CHAR(5),
    IN urlFotoEstudiante_IN VARCHAR(1000),
    IN id_UsuarioInscriptor_IN INT,
    OUT mensaje VARCHAR(200))

BEGIN

DECLARE existe BOOLEAN;
DECLARE id_Persona INT;

CALL VerificarExistenciaPersona(nroDeRegistro_IN, @existe);
    IF @existe = TRUE THEN
        -- Inscripcion Automatica
        -- Obtener codigo de persona
        SELECT id INTO id_Persona FROM PERSONA WHERE nro_registro = nro_registro;
        -- Registrar inscripcion
        INSERT INTO Inscripcion(talla_polera,estado_inscripcion,foto_estudiante,id_persona,id_UsuarioInscriptor) values(tallaPolera_IN,TRUE,urlFotoEstudiante_IN,id_Persona,id_UsuarioInscriptor_IN);
        UPDATE PERSONA SET carnet_identidad = carnetDeIdentidad_IN, nro_celular = nroDeCelular_IN WHERE nro_registro = nroDeRegistro_IN;
        SET mensaje = 'Inscripción registrada correctamente.';

    ELSE
        -- Inscripcion Manual
        -- Registrar persona
        INSERT INTO persona(nombreCompleto,nro_registro,carrera,facultad,carnet_identidad,nro_celular) values(nombreCompleto_IN,nroDeRegistro_IN,carrera_IN,facultad_IN,carnetDeIdentidad_IN,nroDeCelular_IN);
        -- Obtener codigo de persona
        INSERT INTO inscripcion(talla_polera,estado_inscripcion,foto_estudiante,id_persona,id_UsuarioInscriptor) values(tallaPolera_IN,TRUE,urlFotoEstudiante_IN,LAST_INSERT_ID(),id_UsuarioInscriptor_IN);
        SET mensaje = 'Inscripción registrada correctamente.';
    END IF;
END //

CREATE PROCEDURE MostrarDatosEstudianteInscripcion(IN nro_registro VARCHAR(10))
BEGIN
    SELECT p.id, p.nombreCompleto, p.nro_registro, p.carrera, p.facultad, p.carnet_identidad, p.nro_celular, i.talla_polera, i.estado_inscripcion, i.foto_estudiante
    FROM PERSONA p
    JOIN INSCRIPCION i ON p.codigo = i.codigo_persona
    WHERE p.nro_registro = nro_registro;
END //


CREATE PROCEDURE ActualizarInscripcionPorRegistro(
    IN nroDeRegistro_IN VARCHAR(10),
    IN estadoInscripcion_IN BOOLEAN,
    OUT mensaje VARCHAR(200)
)
BEGIN
    UPDATE INSCRIPCION SET estado_inscripcion = estadoInscripcion_IN WHERE id_persona = (SELECT id FROM PERSONA WHERE nro_registro = nroDeRegistro_IN);
    SET mensaje = 'Inscripción actualizada correctamente.';
END //

CREATE PROCEDURE VerificarLogin(IN nombre_usuario VARCHAR(50), IN contrasena VARCHAR(255), OUT mensaje VARCHAR(200))
BEGIN
DECLARE usuario_encontrado INT;
SELECT COUNT(*) INTO usuario_encontrado FROM USUARIO WHERE nombre = nombre_usuario AND contraseña = contrasena;
    IF usuario_encontrado = 1 THEN
        SET mensaje = 'Usuario y contraseña correctos.';
    ELSE
        SET mensaje = 'Usuario o contraseña incorrectos.';
    END IF;
END //


CREATE PROCEDURE MostrarDatosInscripciones(IN nroDeRegistro_IN VARCHAR(10),OUT mensaje VARCHAR(200))
BEGIN
        
    DECLARE estado_inscripcion INT;
    SELECT COUNT(*) INTO estado_inscripcion FROM INSCRIPCION WHERE id_persona = (SELECT id FROM PERSONA WHERE nro_registro = nroDeRegistro_IN) LIMIT 1;

    IF estado_inscripcion = 1 THEN
        SELECT p.nro_registro, p.nombreCompleto, p.carrera WHERE p.nro_registro = nroDeRegistro_IN;
        SET mensaje = 'Inscripción registrada correctamente.';
    ELSE

        SET mensaje = 'Inscripción no registrada.';

    END IF;

    
END //




DELIMITER ;