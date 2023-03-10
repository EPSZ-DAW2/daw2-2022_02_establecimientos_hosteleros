-- MySQL Script generated by MySQL Workbench
-- 2022-12-19 01:35:06
-- Model: DAW2-Hosteleros    Version: 1.1

-- Proyecto en Grupo - Recomendación de Establecimientos Hosteleros.
-- Desarrollo de Aplicaciones Web II.
-- Escuela Politécnica Superior de Zamora.
-- Universidad de Salamanca.
-- 

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema daw2_2022_02_establecimientos_hosteleros
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `daw2_2022_02_establecimientos_hosteleros` ;

-- -----------------------------------------------------
-- Schema daw2_2022_02_establecimientos_hosteleros
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `daw2_2022_02_establecimientos_hosteleros` DEFAULT CHARACTER SET utf8 ;
USE `daw2_2022_02_establecimientos_hosteleros` ;

-- -----------------------------------------------------
-- Table `locales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `locales` ;

CREATE TABLE IF NOT EXISTS `locales` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` TEXT NOT NULL COMMENT 'Titulo corto o slogan para el establecimiento/local.',
  `descripcion` TEXT NULL DEFAULT NULL COMMENT 'Descripción breve del establecimiento/local o NULL si no es necesaria.',
  `lugar` TEXT NULL DEFAULT NULL COMMENT 'Descripcion del lugar del establecimiento/local o NULL si no se conoce, aunque no debería estar vacío este dato.',
  `url` TEXT NULL DEFAULT NULL COMMENT 'Dirección web externa (opcional) que enlaza con la página \"oficial\" o directamente del establecimiento/local o NULL si no hay o no se conoce.',
  `zona_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'Area/Zona de ubicación del establecimiento/local o CERO si no existe o aún no está indicada (como si fuera NULL).',
  `categoria_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'Categoria de clasificación del establecimiento/local o CERO si no existe o aún no está indicada (como si fuera NULL).',
  `imagen_id` VARCHAR(25) NULL DEFAULT NULL COMMENT 'Nombre identificativo (fichero interno) con la imagen principal o \"de presentación\" del establecimiento/local, o NULL si no hay.',
  `sumaValores` INT(9) NOT NULL DEFAULT '0' COMMENT 'Suma acumulada de las valoraciones para el establecimiento/local.',
  `totalVotos` INT(9) NOT NULL DEFAULT '0' COMMENT 'Contador de votos (valoraciones) emitidas para el establecimiento/local.',
  `hostelero_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'Hostelero/Propietario del establecimiento/local o CERO si no está patrocinado por nadie o no existe, o aún no está indicado (como si fuera NULL).',
  `prioridad` INT(4) NOT NULL DEFAULT '0' COMMENT 'Indicador de importancia para el establecimiento/local en caso de tener hostelero.',
  `visible` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de establecimiento/local visible a los usuarios o invisible (se está manteniendo): 0=Invisible, 1=Visible.',
  `terminado` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de establecimiento/local terminado o suspendido: 0=No, 1=Eliminado por usuario, 2=Suspendido, 3=Cancelado por inadecuado, ...',
  `fecha_terminacion` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de terminación del establecimiento/local. Debería estar a NULL si no está terminado.',
  `num_denuncias` INT(9) NOT NULL DEFAULT '0' COMMENT 'Contador de denuncias del establecimiento/local o CERO si no ha tenido.',
  `fecha_denuncia1` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.',
  `bloqueado` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de establecimiento/local bloqueada: 0=No, 1=Si(bloqueado por denuncias), 2=Si(bloqueado por administrador), ...',
  `fecha_bloqueo` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo del establecimiento/local. Debería estar a NULL si no está bloqueado o si se desbloquea.',
  `notas_bloqueo` TEXT NULL DEFAULT NULL COMMENT 'Notas visibles sobre el motivo del bloqueo del establecimiento/local o NULL si no hay -se muestra por defecto según indique \"bloqueado\"-.',
  `cerrado_comentar` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de establecimiento/local cerrado para comentarios: 0=No, 1=Si.',
  `cerrado_quedar` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de establecimiento/local cerrado para quedadas: 0=No, 1=Si.',
  `crea_usuario_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'Usuario que ha creado el establecimiento/local o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `crea_fecha` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de creación del establecimiento/local o NULL si no se conoce por algún motivo.',
  `modi_usuario_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'Usuario que ha modificado el establecimiento/local por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `modi_fecha` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de la última modificación del establecimiento/local o NULL si no se conoce por algún motivo.',
  `notas_admin` TEXT NULL DEFAULT NULL COMMENT 'Notas adicionales para los moderadores/administradores sobre el establecimiento/local o NULL si no hay.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `categorias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `categorias` ;

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(25) NULL DEFAULT NULL,
  `descripcion` TEXT NULL DEFAULT NULL COMMENT 'Texto adicional que describe la categoria o clasificación.',
  `icono` VARCHAR(25) NULL DEFAULT NULL COMMENT 'Nombre del icono relacionado de entre los disponibles en la aplicación (carpeta iconos posibles).',
  `categoria_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'Categoria relacionada, para poder realizar la jerarquía de clasificaciones. Nodo padre de la jerarquía de categoría, o CERO si es nodo raiz (como si fuera NULL).',
  `revisada` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de categoria aceptada o no por los moderadores/administradores: 0=No, 1=Si.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `etiquetas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `etiquetas` ;

CREATE TABLE IF NOT EXISTS `etiquetas` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(25) NULL DEFAULT NULL,
  `descripcion` TEXT NULL DEFAULT NULL COMMENT 'Texto adicional que describe la etiqueta o NULL si no es necesario.',
  `revisada` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de etiqueta aceptada o no por los moderadores/administradores: 0=No, 1=Si.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `locales_etiquetas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `locales_etiquetas` ;

CREATE TABLE IF NOT EXISTS `locales_etiquetas` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `local_id` INT(12) UNSIGNED NOT NULL COMMENT 'establecimiento/local relacionada',
  `etiqueta_id` INT(12) UNSIGNED NOT NULL COMMENT 'Etiqueta relacionada.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `zonas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zonas` ;

CREATE TABLE IF NOT EXISTS `zonas` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `clase_zona_id` CHAR(1) NOT NULL COMMENT 'Código de clase de la zona: 1=Continente, 2=Pais, 3=Estado, 4=Region, 5=Provincia, 6=Municipio, 7=Localidad, 8=Barrio, 9=Area, ...',
  `nombre` VARCHAR(50) NOT NULL COMMENT 'Nombre de la zona que la identifica.',
  `zona_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'Zona relacionada. Nodo padre de la jerarquia o CERO si es nodo raiz.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `locales_imagenes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `locales_imagenes` ;

CREATE TABLE IF NOT EXISTS `locales_imagenes` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `local_id` INT(12) UNSIGNED NOT NULL COMMENT 'establecimiento/local relacionada',
  `orden` INT(4) NOT NULL DEFAULT '0' COMMENT 'Orden de aparición de la imagen dentro del grupo de imagenes de la establecimiento. Opcional.',
  `imagen_id` VARCHAR(25) NULL DEFAULT NULL COMMENT 'Nombre identificativo (fichero interno) con la imagen del establecimiento/local.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `locales_comentarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `locales_comentarios` ;

CREATE TABLE IF NOT EXISTS `locales_comentarios` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `local_id` INT(12) UNSIGNED NOT NULL COMMENT 'establecimiento/local relacionado',
  `valoracion` INT(9) NOT NULL DEFAULT '0' COMMENT 'Valoración dada al establecimiento/local.',
  `texto` TEXT NOT NULL COMMENT 'El texto del comentario.',
  `comentario_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'Comentario relacionado, si se permiten encadenar respuestas. Nodo padre de la jerarquia de comentarios, CERO si es nodo raiz.',
  `cerrado` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de cierre de los comentarios: 0=No, 1=Si(No se puede responder al comentario)',
  `num_denuncias` INT(9) NOT NULL DEFAULT '0' COMMENT 'Contador de denuncias del comentario o CERO si no ha tenido.',
  `fecha_denuncia1` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.',
  `bloqueado` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de comentario bloqueado: 0=No, 1=Si(bloqueado por denuncias), 2=Si(bloqueado por administrador), ...',
  `fecha_bloqueo` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo del comentario. Debería estar a NULL si no está bloqueado o si se desbloquea.',
  `notas_bloqueo` TEXT NULL DEFAULT NULL COMMENT 'Notas visibles sobre el motivo del bloqueo del comentario o NULL si no hay -se muestra por defecto según indique \"bloqueado\"-.',
  `crea_usuario_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'Usuario que ha creado el comentario o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `crea_fecha` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de creación del comentario o NULL si no se conoce por algún motivo.',
  `modi_usuario_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'Usuario que ha modificado el comentario por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `modi_fecha` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de la última modificación del comentario o NULL si no se conoce por algún motivo.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `locales_convocatorias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `locales_convocatorias` ;

CREATE TABLE IF NOT EXISTS `locales_convocatorias` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `local_id` INT(12) UNSIGNED NOT NULL COMMENT 'establecimiento/local relacionado',
  `texto` TEXT NOT NULL COMMENT 'El texto de la convocatoria.',
  `fecha_desde` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de inicio de la convocatoria o NULL si no se conoce (mostrar próximamente).',
  `fecha_hasta` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de finalización de la convocatoria o NULL si no se conoce (no caduca automáticamente).',
  `num_denuncias` INT(9) NOT NULL DEFAULT '0' COMMENT 'Contador de denuncias de la convocatoria o CERO si no ha tenido.',
  `fecha_denuncia1` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.',
  `bloqueada` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de convocatoria bloqueada: 0=No, 1=Si(bloqueada por denuncias), 2=Si(bloqueada por administrador), ...',
  `fecha_bloqueo` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo de la convocatoria. Debería estar a NULL si no está bloqueada o si se desbloquea.',
  `notas_bloqueo` TEXT NULL DEFAULT NULL COMMENT 'Notas visibles sobre el motivo del bloqueo de la convocatoria o NULL si no hay -se muestra por defecto según indique \"bloqueado\"-.',
  `crea_usuario_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'Usuario que ha creado la convocatoria o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `crea_fecha` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de creación de la convocatoria o NULL si no se conoce por algún motivo.',
  `modi_usuario_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'Usuario que ha modificado la convocatoria por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `modi_fecha` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de la última modificación de la convocatoria o NULL si no se conoce por algún motivo.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `locales_convocatorias_asistentes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `locales_convocatorias_asistentes` ;

CREATE TABLE IF NOT EXISTS `locales_convocatorias_asistentes` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `local_id` INT(12) UNSIGNED NOT NULL COMMENT 'establecimiento/local relacionado',
  `convocatoria_id` INT(12) UNSIGNED NOT NULL COMMENT 'convocatoria relacionada',
  `usuario_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'usuario relacionado que asistira a la convocatoria.',
  `fecha_alta` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de creación de la asistencia a la convocatoria o NULL si no se conoce por algún motivo.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuarios` ;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL COMMENT 'Correo Electronico y \"login\" del usuario.',
  `password` VARCHAR(60) NOT NULL,
  `nick` VARCHAR(25) NOT NULL,
  `nombre` VARCHAR(50) NOT NULL,
  `apellidos` VARCHAR(100) NOT NULL,
  `fecha_nacimiento` DATE NULL DEFAULT NULL COMMENT 'Fecha de nacimiento del usuario o NULL si no lo quiere informar.',
  `direccion` TEXT NULL DEFAULT NULL COMMENT 'Direccion del usuario o NULL si no quiere informar.',
  `zona_id` INT(12) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Area/Zona de localización del usuario o CERO si no lo quiere informar (como si fuera NULL), aunque es recomendable.',
  `fecha_registro` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de registro del usuario o NULL si no se conoce por algún motivo (que no debería ser).',
  `confirmado` TINYINT(1) NOT NULL COMMENT 'Indicador de usuario ha confirmado su registro o no.',
  `fecha_acceso` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora del ultimo acceso del usuario. Debería estar a NULL si no ha accedido nunca.',
  `num_accesos` INT(9) NOT NULL DEFAULT '0' COMMENT 'Contador de accesos fallidos del usuario o CERO si no ha tenido o se ha reiniciado por un acceso valido o por un administrador.',
  `bloqueado` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de usuario bloqueado: 0=No, 1=Si(bloqueada por accesos), 2=Si(bloqueada por administrador), ...',
  `fecha_bloqueo` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo del usuario. Debería estar a NULL si no está bloqueado o si se desbloquea.',
  `notas_bloqueo` TEXT NULL DEFAULT NULL COMMENT 'Notas visibles sobre el motivo del bloqueo del usuario o NULL si no hay -se muestra por defecto según indique \"bloqueado\"-.',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `nick_UNIQUE` (`nick` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hosteleros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hosteleros` ;

CREATE TABLE IF NOT EXISTS `hosteleros` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(12) UNSIGNED NOT NULL COMMENT 'Usuario relacionado con los datos principales.',
  `nif_cif` VARCHAR(12) NOT NULL COMMENT 'Identificador del hostelero.',
  `razon_social` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Razon social del comercio o NULL si con el \"nombre y apellidos\" del usuario es suficiente.',
  `telefono_comercio` VARCHAR(25) NOT NULL,
  `telefono_contacto` VARCHAR(25) NOT NULL,
  `url` TEXT NULL DEFAULT NULL COMMENT 'Dirección web del comercio o NULL si no hay o no se conoce.',
  `fecha_alta` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de alta como hostelero, no como usuario o NULL si no se conoce por algún motivo (que no debería ser).',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nif_cif_UNIQUE` (`nif_cif` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `configuraciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `configuraciones` ;

CREATE TABLE IF NOT EXISTS `configuraciones` (
  `variable` VARCHAR(50) NOT NULL,
  `valor` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`variable`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `registros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `registros` ;

CREATE TABLE IF NOT EXISTS `registros` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha_registro` DATETIME NOT NULL COMMENT 'Fecha y Hora del registro de acceso.',
  `clase_log_id` CHAR(1) NOT NULL COMMENT 'código de clase de log: E=Error, A=Aviso, S=Seguimiento, I=Información, D=Depuración, ...',
  `modulo` VARCHAR(50) NULL DEFAULT 'app' COMMENT 'Modulo o Sección de la aplicación que ha generado el mensaje de registro.',
  `texto` TEXT NULL DEFAULT NULL COMMENT 'Texto con el mensaje de registro.',
  `ip` VARCHAR(40) NULL DEFAULT NULL COMMENT 'Dirección IP desde donde accede el usuario (vale para IPv4 e IPv6.',
  `browser` TEXT NULL DEFAULT NULL COMMENT 'Texto con información del navegador utilizado en el acceso.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `usuarios_locales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuarios_locales` ;

CREATE TABLE IF NOT EXISTS `usuarios_locales` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(12) UNSIGNED NOT NULL COMMENT 'Usuario relacionado, seguidor del establecimiento/local.',
  `local_id` INT(12) UNSIGNED NOT NULL COMMENT 'establecimiento/local relacionado.',
  `fecha_alta` DATETIME NOT NULL COMMENT 'Fecha y Hora de activación del seguimiento del establecimiento/local por parte del usuario.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `usuarios_categorias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuarios_categorias` ;

CREATE TABLE IF NOT EXISTS `usuarios_categorias` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(12) UNSIGNED NOT NULL COMMENT 'Usuario relacionado.',
  `categoria_id` INT(12) UNSIGNED NOT NULL COMMENT 'Categoria relacionada.',
  `fecha_seguimiento` DATETIME NOT NULL COMMENT 'Fecha y Hora de activación del seguimiento de la categoria por parte del usuario.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `usuarios_etiquetas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuarios_etiquetas` ;

CREATE TABLE IF NOT EXISTS `usuarios_etiquetas` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(12) UNSIGNED NOT NULL COMMENT 'Usuario relacionado.',
  `etiqueta_id` INT(12) UNSIGNED NOT NULL COMMENT 'Etiqueta relacionada.',
  `fecha_seguimiento` DATETIME NOT NULL COMMENT 'Fecha y Hora de activación del seguimiento de la etiqueta por parte del usuario.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `usuarios_area_moderacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuarios_area_moderacion` ;

CREATE TABLE IF NOT EXISTS `usuarios_area_moderacion` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(12) UNSIGNED NOT NULL COMMENT 'Usuario relacionado con un Area para su moderación.',
  `zona_id` INT(12) UNSIGNED NOT NULL COMMENT 'Zona relacionada con el Usuario que puede moderarla.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `usuarios_avisos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuarios_avisos` ;

CREATE TABLE IF NOT EXISTS `usuarios_avisos` (
  `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha_aviso` DATETIME NOT NULL COMMENT 'Fecha y Hora de creación del aviso.',
  `clase_aviso_id` CHAR(1) NOT NULL DEFAULT 'M' COMMENT 'código de clase de aviso: A=Aviso, N=Notificación, D=Denuncia, C=Consulta, B=Bloqueo, M=Mensaje Genérico,...',
  `texto` TEXT NULL COMMENT 'Texto con el mensaje de aviso.',
  `destino_usuario_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'Usuario relacionado, destinatario del aviso, o NULL si no es para administración y aún no está gestionado.',
  `origen_usuario_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'Usuario relacionado, origen del aviso, o NULL si es del sistema.',
  `local_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'establecimiento/local relacionado o NULL si no tiene que ver directamente.',
  `comentario_id` INT(12) UNSIGNED NULL DEFAULT '0' COMMENT 'Comentario relacionado o NULL si no tiene que ver directamente con un comentario.',
  `fecha_lectura` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de lectura del aviso o NULL si no se ha leido o se ha desmarcado como tal.',
  `fecha_aceptado` DATETIME NULL DEFAULT NULL COMMENT 'Fecha y Hora de aceptación del aviso o NULL si no se ha aceptado para su gestión por un moderador o administrador. No se usa en otros usuarios.',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
