-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2023 a las 18:43:56
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `daw2_2022_02_establecimientos_hosteleros`
--

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
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(12) UNSIGNED NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `descripcion` text DEFAULT NULL COMMENT 'Texto adicional que describe la categoria o clasificación.',
  `icono` varchar(25) DEFAULT NULL COMMENT 'Nombre del icono relacionado de entre los disponibles en la aplicación (carpeta iconos posibles).',
  `categoria_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Categoria relacionada, para poder realizar la jerarquía de clasificaciones. Nodo padre de la jerarquía de categoría, o CERO si es nodo raiz (como si fuera NULL).',
  `revisada` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de categoria aceptada o no por los moderadores/administradores: 0=No, 1=Si.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `icono`, `categoria_id`, `revisada`) VALUES
(1, 'Española', 'Comida española', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE `configuraciones` (
  `variable` varchar(50) NOT NULL,
  `valor` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE `etiquetas` (
  `id` int(12) UNSIGNED NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `descripcion` text DEFAULT NULL COMMENT 'Texto adicional que describe la etiqueta o NULL si no es necesario.',
  `revisada` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de etiqueta aceptada o no por los moderadores/administradores: 0=No, 1=Si.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hosteleros`
--

CREATE TABLE `hosteleros` (
  `id` int(12) UNSIGNED NOT NULL,
  `usuario_id` int(12) UNSIGNED NOT NULL COMMENT 'Usuario relacionado con los datos principales.',
  `nif_cif` varchar(12) NOT NULL COMMENT 'Identificador del hostelero.',
  `razon_social` varchar(255) DEFAULT NULL COMMENT 'Razon social del comercio o NULL si con el "nombre y apellidos" del usuario es suficiente.',
  `telefono_comercio` varchar(25) NOT NULL,
  `telefono_contacto` varchar(25) NOT NULL,
  `url` text DEFAULT NULL COMMENT 'Dirección web del comercio o NULL si no hay o no se conoce.',
  `fecha_alta` datetime DEFAULT NULL COMMENT 'Fecha y Hora de alta como hostelero, no como usuario o NULL si no se conoce por algún motivo (que no debería ser).'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hosteleros`
--

INSERT INTO `hosteleros` (`id`, `usuario_id`, `nif_cif`, `razon_social`, `telefono_comercio`, `telefono_contacto`, `url`, `fecha_alta`) VALUES
(1, 7, '12345678T', 'Restaurante SA', '980764318', '654321987', 'https://restespana.es/', '2023-01-06 17:06:43'),
(3, 12, '12345675T', NULL, '980764318', '654321987', NULL, '2023-01-06 17:06:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locales`
--

CREATE TABLE `locales` (
  `id` int(12) UNSIGNED NOT NULL,
  `titulo` text NOT NULL COMMENT 'Titulo corto o slogan para el establecimiento/local.',
  `descripcion` text DEFAULT NULL COMMENT 'Descripción breve del establecimiento/local o NULL si no es necesaria.',
  `lugar` text DEFAULT NULL COMMENT 'Descripcion del lugar del establecimiento/local o NULL si no se conoce, aunque no debería estar vacío este dato.',
  `url` text DEFAULT NULL COMMENT 'Dirección web externa (opcional) que enlaza con la página "oficial" o directamente del establecimiento/local o NULL si no hay o no se conoce.',
  `zona_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Area/Zona de ubicación del establecimiento/local o CERO si no existe o aún no está indicada (como si fuera NULL).',
  `categoria_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Categoria de clasificación del establecimiento/local o CERO si no existe o aún no está indicada (como si fuera NULL).',
  `imagen_id` varchar(25) DEFAULT NULL COMMENT 'Nombre identificativo (fichero interno) con la imagen principal o "de presentación" del establecimiento/local, o NULL si no hay.',
  `sumaValores` int(9) NOT NULL DEFAULT 0 COMMENT 'Suma acumulada de las valoraciones para el establecimiento/local.',
  `totalVotos` int(9) NOT NULL DEFAULT 0 COMMENT 'Contador de votos (valoraciones) emitidas para el establecimiento/local.',
  `hostelero_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Hostelero/Propietario del establecimiento/local o CERO si no está patrocinado por nadie o no existe, o aún no está indicado (como si fuera NULL).',
  `prioridad` int(4) NOT NULL DEFAULT 0 COMMENT 'Indicador de importancia para el establecimiento/local en caso de tener hostelero.',
  `visible` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de establecimiento/local visible a los usuarios o invisible (se está manteniendo): 0=Invisible, 1=Visible.',
  `terminado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de establecimiento/local terminado o suspendido: 0=No, 1=Eliminado por usuario, 2=Suspendido, 3=Cancelado por inadecuado, ...',
  `fecha_terminacion` datetime DEFAULT NULL COMMENT 'Fecha y Hora de terminación del establecimiento/local. Debería estar a NULL si no está terminado.',
  `num_denuncias` int(9) NOT NULL DEFAULT 0 COMMENT 'Contador de denuncias del establecimiento/local o CERO si no ha tenido.',
  `fecha_denuncia1` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.',
  `bloqueado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de establecimiento/local bloqueada: 0=No, 1=Si(bloqueado por denuncias), 2=Si(bloqueado por administrador), ...',
  `fecha_bloqueo` datetime DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo del establecimiento/local. Debería estar a NULL si no está bloqueado o si se desbloquea.',
  `notas_bloqueo` text DEFAULT NULL COMMENT 'Notas visibles sobre el motivo del bloqueo del establecimiento/local o NULL si no hay -se muestra por defecto según indique "bloqueado"-.',
  `cerrado_comentar` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de establecimiento/local cerrado para comentarios: 0=No, 1=Si.',
  `cerrado_quedar` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de establecimiento/local cerrado para quedadas: 0=No, 1=Si.',
  `crea_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario que ha creado el establecimiento/local o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `crea_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de creación del establecimiento/local o NULL si no se conoce por algún motivo.',
  `modi_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario que ha modificado el establecimiento/local por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `modi_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la última modificación del establecimiento/local o NULL si no se conoce por algún motivo.',
  `notas_admin` text DEFAULT NULL COMMENT 'Notas adicionales para los moderadores/administradores sobre el establecimiento/local o NULL si no hay.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `locales`
--

INSERT INTO `locales` (`id`, `titulo`, `descripcion`, `lugar`, `url`, `zona_id`, `categoria_id`, `imagen_id`, `sumaValores`, `totalVotos`, `hostelero_id`, `prioridad`, `visible`, `terminado`, `fecha_terminacion`, `num_denuncias`, `fecha_denuncia1`, `bloqueado`, `fecha_bloqueo`, `notas_bloqueo`, `cerrado_comentar`, `cerrado_quedar`, `crea_usuario_id`, `crea_fecha`, `modi_usuario_id`, `modi_fecha`, `notas_admin`) VALUES
(1, 'Restaurante Prueba', 'Restaurante de prueba de comida española', 'Calle de Prueba, 12, Zamora, lugar amplio y luminoso', 'https://restespana.es/', 0, 1, '1', 350, 100, 1, 0, 1, 0, '2023-01-05 13:34:12', 0, NULL, 0, NULL, NULL, 0, 0, 0, NULL, 0, NULL, NULL),
(2, 'Restaurante Prueba 2', 'Restaurante de prueba de comida española 2', 'Calle de Prueba, 12, Zamora, lugar amplio y luminoso', NULL, 0, 0, NULL, 350, 100, 3, 0, 1, 0, '2023-01-05 13:34:12', 0, NULL, 0, NULL, NULL, 0, 0, 0, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locales_comentarios`
--

CREATE TABLE `locales_comentarios` (
  `id` int(12) UNSIGNED NOT NULL,
  `local_id` int(12) UNSIGNED NOT NULL COMMENT 'establecimiento/local relacionado',
  `valoracion` int(9) NOT NULL DEFAULT 0 COMMENT 'Valoración dada al establecimiento/local.',
  `texto` text NOT NULL COMMENT 'El texto del comentario.',
  `comentario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Comentario relacionado, si se permiten encadenar respuestas. Nodo padre de la jerarquia de comentarios, CERO si es nodo raiz.',
  `cerrado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de cierre de los comentarios: 0=No, 1=Si(No se puede responder al comentario)',
  `num_denuncias` int(9) NOT NULL DEFAULT 0 COMMENT 'Contador de denuncias del comentario o CERO si no ha tenido.',
  `fecha_denuncia1` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.',
  `bloqueado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de comentario bloqueado: 0=No, 1=Si(bloqueado por denuncias), 2=Si(bloqueado por administrador), ...',
  `fecha_bloqueo` datetime DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo del comentario. Debería estar a NULL si no está bloqueado o si se desbloquea.',
  `notas_bloqueo` text DEFAULT NULL COMMENT 'Notas visibles sobre el motivo del bloqueo del comentario o NULL si no hay -se muestra por defecto según indique "bloqueado"-.',
  `crea_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario que ha creado el comentario o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `crea_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de creación del comentario o NULL si no se conoce por algún motivo.',
  `modi_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario que ha modificado el comentario por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `modi_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la última modificación del comentario o NULL si no se conoce por algún motivo.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locales_convocatorias`
--

CREATE TABLE `locales_convocatorias` (
  `id` int(12) UNSIGNED NOT NULL,
  `local_id` int(12) UNSIGNED NOT NULL COMMENT 'establecimiento/local relacionado',
  `texto` text NOT NULL COMMENT 'El texto de la convocatoria.',
  `fecha_desde` datetime DEFAULT NULL COMMENT 'Fecha y Hora de inicio de la convocatoria o NULL si no se conoce (mostrar próximamente).',
  `fecha_hasta` datetime DEFAULT NULL COMMENT 'Fecha y Hora de finalización de la convocatoria o NULL si no se conoce (no caduca automáticamente).',
  `num_denuncias` int(9) NOT NULL DEFAULT 0 COMMENT 'Contador de denuncias de la convocatoria o CERO si no ha tenido.',
  `fecha_denuncia1` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.',
  `bloqueada` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de convocatoria bloqueada: 0=No, 1=Si(bloqueada por denuncias), 2=Si(bloqueada por administrador), ...',
  `fecha_bloqueo` datetime DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo de la convocatoria. Debería estar a NULL si no está bloqueada o si se desbloquea.',
  `notas_bloqueo` text DEFAULT NULL COMMENT 'Notas visibles sobre el motivo del bloqueo de la convocatoria o NULL si no hay -se muestra por defecto según indique "bloqueado"-.',
  `crea_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario que ha creado la convocatoria o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `crea_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de creación de la convocatoria o NULL si no se conoce por algún motivo.',
  `modi_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario que ha modificado la convocatoria por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `modi_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la última modificación de la convocatoria o NULL si no se conoce por algún motivo.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locales_convocatorias_asistentes`
--

CREATE TABLE `locales_convocatorias_asistentes` (
  `id` int(12) UNSIGNED NOT NULL,
  `local_id` int(12) UNSIGNED NOT NULL COMMENT 'establecimiento/local relacionado',
  `convocatoria_id` int(12) UNSIGNED NOT NULL COMMENT 'convocatoria relacionada',
  `usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'usuario relacionado que asistira a la convocatoria.',
  `fecha_alta` datetime DEFAULT NULL COMMENT 'Fecha y Hora de creación de la asistencia a la convocatoria o NULL si no se conoce por algún motivo.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locales_etiquetas`
--

CREATE TABLE `locales_etiquetas` (
  `id` int(12) UNSIGNED NOT NULL,
  `local_id` int(12) UNSIGNED NOT NULL COMMENT 'establecimiento/local relacionada',
  `etiqueta_id` int(12) UNSIGNED NOT NULL COMMENT 'Etiqueta relacionada.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locales_imagenes`
--

CREATE TABLE `locales_imagenes` (
  `id` int(12) UNSIGNED NOT NULL,
  `local_id` int(12) UNSIGNED NOT NULL COMMENT 'establecimiento/local relacionada',
  `orden` int(4) NOT NULL DEFAULT 0 COMMENT 'Orden de aparición de la imagen dentro del grupo de imagenes de la establecimiento. Opcional.',
  `imagen_id` varchar(25) DEFAULT NULL COMMENT 'Nombre identificativo (fichero interno) con la imagen del establecimiento/local.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `id` int(12) UNSIGNED NOT NULL,
  `fecha_registro` datetime NOT NULL COMMENT 'Fecha y Hora del registro de acceso.',
  `clase_log_id` char(1) NOT NULL COMMENT 'código de clase de log: E=Error, A=Aviso, S=Seguimiento, I=Información, D=Depuración, ...',
  `modulo` varchar(50) DEFAULT 'app' COMMENT 'Modulo o Sección de la aplicación que ha generado el mensaje de registro.',
  `texto` text DEFAULT NULL COMMENT 'Texto con el mensaje de registro.',
  `ip` varchar(40) DEFAULT NULL COMMENT 'Dirección IP desde donde accede el usuario (vale para IPv4 e IPv6.',
  `browser` text DEFAULT NULL COMMENT 'Texto con información del navegador utilizado en el acceso.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(12) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL COMMENT 'Correo Electronico y "login" del usuario.',
  `password` varchar(60) NOT NULL,
  `nick` varchar(25) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL COMMENT 'Fecha de nacimiento del usuario o NULL si no lo quiere informar.',
  `direccion` text DEFAULT NULL COMMENT 'Direccion del usuario o NULL si no quiere informar.',
  `rol` int(1) NOT NULL DEFAULT 0 COMMENT 'Rol del usuario: 0=Normal, 1=Moderador, 2=Patrocinador, 3=Admin',
  `zona_id` int(12) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Area/Zona de localización del usuario o CERO si no lo quiere informar (como si fuera NULL), aunque es recomendable.',
  `fecha_registro` datetime DEFAULT NULL COMMENT 'Fecha y Hora de registro del usuario o NULL si no se conoce por algún motivo (que no debería ser).',
  `confirmado` tinyint(1) NOT NULL COMMENT 'Indicador de usuario ha confirmado su registro o no.',
  `fecha_acceso` datetime DEFAULT NULL COMMENT 'Fecha y Hora del ultimo acceso del usuario. Debería estar a NULL si no ha accedido nunca.',
  `num_accesos` int(9) NOT NULL DEFAULT 0 COMMENT 'Contador de accesos fallidos del usuario o CERO si no ha tenido o se ha reiniciado por un acceso valido o por un administrador.',
  `bloqueado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indicador de usuario bloqueado: 0=No, 1=Si(bloqueada por accesos), 2=Si(bloqueada por administrador), ...',
  `fecha_bloqueo` datetime DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo del usuario. Debería estar a NULL si no está bloqueado o si se desbloquea.',
  `notas_bloqueo` text DEFAULT NULL COMMENT 'Notas visibles sobre el motivo del bloqueo del usuario o NULL si no hay -se muestra por defecto según indique "bloqueado"-.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `nick`, `nombre`, `apellidos`, `fecha_nacimiento`, `direccion`, `rol`, `zona_id`, `fecha_registro`, `confirmado`, `fecha_acceso`, `num_accesos`, `bloqueado`, `fecha_bloqueo`, `notas_bloqueo`) VALUES
(7, 'angel@usal.es', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'angel', 'Angel', 'Francisco', '1987-09-15', 'Calle Angel', 2, 2, '2023-01-06 13:37:06', 1, '2023-01-07 18:24:18', 0, 0, NULL, ''),
(11, 'admin@usal.es', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin', 'Admin', 'Admin', '1978-06-15', 'Calle Admin', 0, 0, '2023-01-06 13:49:30', 1, '2023-01-06 13:49:48', 0, 0, NULL, NULL),
(12, 'prueba@usal.es', '711383a59fda05336fd2ccf70c8059d1523eb41a', 'Prueba', 'Pedro', 'Prueba', '1988-05-13', 'Calle Prueba', 0, 2, '2023-01-06 18:17:28', 1, '2023-01-06 18:17:46', 0, 0, NULL, NULL),
(13, 'pepe@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Pepe', 'Pepe', 'Fernandez', NULL, 'Calle Pepe', 0, 2, '2023-01-07 17:29:12', 0, NULL, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_area_moderacion`
--

CREATE TABLE `usuarios_area_moderacion` (
  `id` int(12) UNSIGNED NOT NULL,
  `usuario_id` int(12) UNSIGNED NOT NULL COMMENT 'Usuario relacionado con un Area para su moderación.',
  `zona_id` int(12) UNSIGNED NOT NULL COMMENT 'Zona relacionada con el Usuario que puede moderarla.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_avisos`
--

CREATE TABLE `usuarios_avisos` (
  `id` int(12) UNSIGNED NOT NULL,
  `fecha_aviso` datetime NOT NULL COMMENT 'Fecha y Hora de creación del aviso.',
  `clase_aviso_id` char(1) NOT NULL DEFAULT 'M' COMMENT 'código de clase de aviso: A=Aviso, N=Notificación, D=Denuncia, C=Consulta, B=Bloqueo, M=Mensaje Genérico,...',
  `texto` text DEFAULT NULL COMMENT 'Texto con el mensaje de aviso.',
  `destino_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario relacionado, destinatario del aviso, o NULL si no es para administración y aún no está gestionado.',
  `origen_usuario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Usuario relacionado, origen del aviso, o NULL si es del sistema.',
  `local_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'establecimiento/local relacionado o NULL si no tiene que ver directamente.',
  `comentario_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Comentario relacionado o NULL si no tiene que ver directamente con un comentario.',
  `fecha_lectura` datetime DEFAULT NULL COMMENT 'Fecha y Hora de lectura del aviso o NULL si no se ha leido o se ha desmarcado como tal.',
  `fecha_aceptado` datetime DEFAULT NULL COMMENT 'Fecha y Hora de aceptación del aviso o NULL si no se ha aceptado para su gestión por un moderador o administrador. No se usa en otros usuarios.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_categorias`
--

CREATE TABLE `usuarios_categorias` (
  `id` int(12) UNSIGNED NOT NULL,
  `usuario_id` int(12) UNSIGNED NOT NULL COMMENT 'Usuario relacionado.',
  `categoria_id` int(12) UNSIGNED NOT NULL COMMENT 'Categoria relacionada.',
  `fecha_seguimiento` datetime NOT NULL COMMENT 'Fecha y Hora de activación del seguimiento de la categoria por parte del usuario.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_etiquetas`
--

CREATE TABLE `usuarios_etiquetas` (
  `id` int(12) UNSIGNED NOT NULL,
  `usuario_id` int(12) UNSIGNED NOT NULL COMMENT 'Usuario relacionado.',
  `etiqueta_id` int(12) UNSIGNED NOT NULL COMMENT 'Etiqueta relacionada.',
  `fecha_seguimiento` datetime NOT NULL COMMENT 'Fecha y Hora de activación del seguimiento de la etiqueta por parte del usuario.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_locales`
--

CREATE TABLE `usuarios_locales` (
  `id` int(12) UNSIGNED NOT NULL,
  `usuario_id` int(12) UNSIGNED NOT NULL COMMENT 'Usuario relacionado, seguidor del establecimiento/local.',
  `local_id` int(12) UNSIGNED NOT NULL COMMENT 'establecimiento/local relacionado.',
  `fecha_alta` datetime NOT NULL COMMENT 'Fecha y Hora de activación del seguimiento del establecimiento/local por parte del usuario.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id` int(12) UNSIGNED NOT NULL,
  `clase_zona_id` char(1) NOT NULL COMMENT 'Código de clase de la zona: 1=Continente, 2=Pais, 3=Estado, 4=Region, 5=Provincia, 6=Municipio, 7=Localidad, 8=Barrio, 9=Area, ...',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de la zona que la identifica.',
  `zona_id` int(12) UNSIGNED DEFAULT 0 COMMENT 'Zona relacionada. Nodo padre de la jerarquia o CERO si es nodo raiz.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`variable`);

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hosteleros`
--
ALTER TABLE `hosteleros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nif_cif_UNIQUE` (`nif_cif`);

--
-- Indices de la tabla `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `locales_comentarios`
--
ALTER TABLE `locales_comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `locales_convocatorias`
--
ALTER TABLE `locales_convocatorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `locales_convocatorias_asistentes`
--
ALTER TABLE `locales_convocatorias_asistentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `locales_etiquetas`
--
ALTER TABLE `locales_etiquetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `locales_imagenes`
--
ALTER TABLE `locales_imagenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `nick_UNIQUE` (`nick`);

--
-- Indices de la tabla `usuarios_area_moderacion`
--
ALTER TABLE `usuarios_area_moderacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_avisos`
--
ALTER TABLE `usuarios_avisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_categorias`
--
ALTER TABLE `usuarios_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_etiquetas`
--
ALTER TABLE `usuarios_etiquetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_locales`
--
ALTER TABLE `usuarios_locales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hosteleros`
--
ALTER TABLE `hosteleros`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `locales`
--
ALTER TABLE `locales`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `locales_comentarios`
--
ALTER TABLE `locales_comentarios`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `locales_convocatorias`
--
ALTER TABLE `locales_convocatorias`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `locales_convocatorias_asistentes`
--
ALTER TABLE `locales_convocatorias_asistentes`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `locales_etiquetas`
--
ALTER TABLE `locales_etiquetas`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `locales_imagenes`
--
ALTER TABLE `locales_imagenes`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios_area_moderacion`
--
ALTER TABLE `usuarios_area_moderacion`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_avisos`
--
ALTER TABLE `usuarios_avisos`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_categorias`
--
ALTER TABLE `usuarios_categorias`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_etiquetas`
--
ALTER TABLE `usuarios_etiquetas`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_locales`
--
ALTER TABLE `usuarios_locales`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
