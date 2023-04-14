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
    correo VARCHAR(255),
    PRIMARY KEY (id)
)engine = innodb;

CREATE TABLE USUARIO(
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    nombreCompleto VARCHAR(50),
    estado VARCHAR(50),
    PRIMARY KEY (id)
)engine = innodb;


CREATE TABLE TALLAS_POLERA(
    id INT NOT NULL AUTO_INCREMENT,
    talla VARCHAR(10),
    PRIMARY KEY (id)
)engine = innodb; 

CREATE TABLE INSCRIPCION(
    id INT NOT NULL AUTO_INCREMENT,
    estado_inscripcion BOOLEAN NOT NULL DEFAULT FALSE,
    foto_estudiante VARCHAR(1000),
    id_persona INT NOT NULL,
    id_UsuarioInscriptor INT NOT NULL,
    id_tallaPolera INT,
    FOREIGN KEY (id_persona) REFERENCES PERSONA(id),
    FOREIGN KEY (id_UsuarioInscriptor) REFERENCES USUARIO(id),
    FOREIGN KEY (id_tallaPolera) REFERENCES TALLAS_POLERA(id),
    PRIMARY KEY (id)
)engine = innodb;
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
    IN cdg_tallaPolera_IN INT,
    IN urlFotoEstudiante_IN VARCHAR(1000),
    IN correo_IN VARCHAR(255),
    IN id_UsuarioInscriptor_IN INT)

BEGIN
DECLARE existe BOOLEAN;
DECLARE id_Persona INT;

CALL VerificarExistenciaPersona(nroDeRegistro_IN, @existe);
    IF @existe = TRUE THEN
        -- Inscripcion Automatica
        -- Obtener codigo de persona
        SELECT id INTO id_Persona FROM PERSONA WHERE nro_registro = nro_registro;
        -- Registrar inscripcion
        INSERT INTO INSCRIPCION(estado_inscripcion,foto_estudiante,id_Persona,id_UsuarioInscriptor,id_tallaPolera) values(TRUE,urlFotoEstudiante_IN,id_Persona,id_UsuarioInscriptor_IN,cdg_tallaPolera_IN);
        UPDATE PERSONA SET carnet_identidad = carnetDeIdentidad_IN, nro_celular = nroDeCelular_IN, correo = correo_IN WHERE nro_registro = nroDeRegistro_IN;

    ELSE
        -- Inscripcion Manual
        -- Registrar persona
        INSERT INTO PERSONA(nombreCompleto,nro_registro,carrera,facultad,carnet_identidad,nro_celular,correo) values(nombreCompleto_IN,nroDeRegistro_IN,carrera_IN,facultad_IN,carnetDeIdentidad_IN,nroDeCelular_IN,correo_IN);
        -- Obtener codigo de persona
        INSERT INTO INSCRIPCION(estado_inscripcion,foto_estudiante,id_Persona,id_UsuarioInscriptor,id_tallaPolera) values(TRUE,urlFotoEstudiante_IN,LAST_INSERT_ID(),id_UsuarioInscriptor_IN,cdg_tallaPolera_IN);
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


CREATE PROCEDURE ExtraerDatos_Del_Usuario(IN nombre_usuario VARCHAR(250))
BEGIN
    SELECT * FROM USUARIO WHERE nombre = nombre_usuario;
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

CREATE PROCEDURE verificar_Inscripcion(IN nroRegistro_IN VARCHAR(10), OUT mensaje VARCHAR(255))
BEGIN
    DECLARE contador INT;
    SELECT COUNT(*) INTO contador FROM INSCRIPCION ins
    INNER JOIN
    PERSONA per ON ins.id_persona = per.id
    WHERE per.nro_registro = nroRegistro_IN;
    
    IF contador > 0 THEN
        SET mensaje = 'El estudiante ya está inscrito';
    ELSE
        SET mensaje = 'El estudiante no está inscrito';
    END IF;
END//


CREATE PROCEDURE registrar_usuario(IN NombreDeUsuario_IN VARCHAR(150),IN contrasena_IN VARCHAR(255),IN NombreCompleto_IN VARCHAR(255), OUT mensaje VARCHAR(255))
BEGIN

    INSERT INTO USUARIO (nombre,contraseña,nombreCompleto,estado) VALUES (NombreDeUsuario_IN,contrasena_IN,NombreCompleto_IN,'Deshabilitado');
    SET mensaje = 'Se ha registrado el usuario correctamente. Esperar aprobación del administrador.';


END//

CREATE PROCEDURE extraer_Datos_del_Usuario(IN nombre_usuario VARCHAR(50))
BEGIN
    SELECT * FROM USUARIO WHERE nombre = nombre_usuario;
END//


create view cant_por_tallas_polera_inscritas
as
SELECT
    tpol.id As idTallaPolera,
    tpol.talla As TallaPolera,
    contarTallaPorInscripciones(tpol.id) As CantDeTallasIncritas
    from tallas_polera tpol

//


CREATE FUNCTION contarTallaPorInscripciones(id_talla_IN INT)
RETURNS INT
BEGIN
    DECLARE contador INT;
    SELECT COUNT(*) INTO contador FROM INSCRIPCION WHERE id_tallaPolera = id_talla_IN AND estado_inscripcion = TRUE;
    RETURN contador;
END;
