-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-03-2017 a las 22:46:35
-- Versión del servidor: 5.6.30-log
-- Versión de PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `stratecsa%%`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `generar_fact` ()  BEGIN 
    DECLARE done INT DEFAULT FALSE;
   DECLARE done2 INT DEFAULT FALSE;
   DECLARE codigo int(10);
   DECLARE costo int(10);
   DECLARE cost INT(10);
   DECLARE empresa varchar(60);
   DECLARE nit varchar(12);
   DECLARE tiempo int(2);
   DECLARE contador int DEFAULT 0;
   DECLARE last_id_fact int(10);
   DECLARE id int(10);
   DECLARE cont INT(2);
   DECLARE total INT(10) DEFAULT 0;
   DECLARE cur CURSOR FOR 
        SELECT Id_contrat,Contra_costo,Empres_nomb,Empres_nit,Contra_time
        FROM contrato con
        INNER JOIN empresa_stra emp ON emp.Empres_nit = con.Contra_id_client
        WHERE DATE_FORMAT(Contra_time_ini,'%Y%m') <= DATE_FORMAT(now(),'%Y%m') 
        AND DATE_FORMAT(Contra_time_fin,'%Y%m') >= DATE_FORMAT(now(),'%Y%m')
        AND Contra_Form_pago = 2 
        AND Contra_stado = 1 
        AND Contra_time >= (SELECT COUNT(*) FROM pagos_str WHERE pago_id_contrat = Id_contrat);
        DECLARE pag CURSOR FOR 
              SELECT pagos_id,pago_costo,COUNT(*)
              FROM pagos_str
              WHERE DATE_FORMAT(pago_fecha_inic,'%Y%m') >= DATE_FORMAT(now(),'%Y%m') 
              AND DATE_FORMAT(pago_fecha_fin,'%Y%m') <= DATE_FORMAT(now(),'%Y%m') 
              AND pago_id_empre = nit;
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
        OPEN cur;
        LOOP1:loop 
            fetch cur into codigo,costo,empresa,nit,tiempo;
            IF done THEN 
              LEAVE LOOP1;
              close cur; 
            END IF;
            OPEN pag;
            LOOP2:loop 
              fetch pag into id,cost,cont;
              IF contador = 0 THEN 
                INSERT INTO factura_stra (Fact_id_client,Fact_id_contrat,Fact_fecha,fact_fecha_final,Fact_total,Fact_cancelado) VALUES(nit,codigo,NOW(),CONCAT(YEAR(NOW()),"-",MONTH(NOW()),"-",30),0,2);   
                SET contador = 1;
                SET last_id_fact = LAST_INSERT_ID();
              END IF;
              IF done THEN 
                LEAVE LOOP2;
                SET contador = 0;
                SET last_id_fact = 0;
                close pag; 
              END IF;
              SET total = cost + total;
              INSERT INTO detalles_fact(Deta_id_fact,Deta_id_pago) VALUES(last_id_fact,id);
            END loop LOOP2;
             UPDATE factura_stra SET Fact_total = total WHERE Fact_id = last_id_fact;
            SET contador = 0;   
        END loop LOOP1;
  END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo_stra`
--

CREATE TABLE `cargo_stra` (
  `Carg_id` int(10) NOT NULL,
  `Carg_nomb` varchar(50) NOT NULL,
  `Carg_depart` int(11) NOT NULL,
  `Cargo_tipo` enum('Jefe','Cordinador','empleado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargo_stra`
--

INSERT INTO `cargo_stra` (`Carg_id`, `Carg_nomb`, `Carg_depart`, `Cargo_tipo`) VALUES
(101, 'Gerencia', 1000, 'Jefe'),
(110, 'Soporte', 1008, 'empleado'),
(111, 'Corporativo', 1000, 'Cordinador'),
(112, '', 1007, 'Cordinador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `Ciudad_id` int(11) NOT NULL,
  `Ciudad_nomb` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Ciudad_depart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`Ciudad_id`, `Ciudad_nomb`, `Ciudad_depart`) VALUES
(1, 'CALI', 76),
(20, 'ALCALA', 76),
(36, 'ANDALUCIA', 76),
(41, 'ANSERMANUEVO', 76),
(54, 'ARGELIA', 76),
(100, 'BOLIVAR', 76),
(109, 'BUENAVENTURA', 76),
(111, 'GUADALAJARA DE BUGA', 76),
(113, 'BUGALAGRANDE', 76),
(122, 'CAICEDONIA', 76),
(126, 'CALIMA', 76),
(130, 'CANDELARIA', 76),
(147, 'CARTAGO', 76),
(233, 'DAGUA', 76),
(243, 'EL AGUILA', 76),
(246, 'EL CAIRO', 76),
(248, 'EL CERRITO', 76),
(250, 'EL DOVIO', 76),
(275, 'FLORIDA', 76),
(306, 'GINEBRA', 76),
(318, 'GUACARI', 76),
(364, 'JAMUNDI', 76),
(377, 'LA CUMBRE', 76),
(400, 'LA UNION', 76),
(403, 'LA VICTORIA', 76),
(497, 'OBANDO', 76),
(520, 'PALMIRA', 76),
(563, 'PRADERA', 76),
(606, 'RESTREPO', 76),
(616, 'RIOFRIO', 76),
(622, 'ROLDANILLO', 76),
(670, 'SAN PEDRO', 76),
(736, 'SEVILLA', 76),
(823, 'TORO', 76),
(828, 'TRUJILLO', 76),
(834, 'TULUA', 76),
(845, 'ULLOA', 76),
(863, 'VERSALLES', 76),
(869, 'VIJES', 76),
(890, 'YOTOCO', 76),
(892, 'YUMBO', 76),
(895, 'ZARZAL', 76);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_stra`
--

CREATE TABLE `clientes_stra` (
  `Client_id` int(10) NOT NULL,
  `Client_nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Client_apell` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Client_sex` enum('Hombre','Mujer','Null') COLLATE utf8_unicode_ci NOT NULL,
  `Client_tel` int(10) NOT NULL,
  `Client_ext` int(3) NOT NULL,
  `Client_dire` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Client_ciud` int(5) NOT NULL,
  `Client_fax` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Client_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Client_tipo` enum('Natural','Empresa') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes_stra`
--

INSERT INTO `clientes_stra` (`Client_id`, `Client_nom`, `Client_apell`, `Client_sex`, `Client_tel`, `Client_ext`, `Client_dire`, `Client_ciud`, `Client_fax`, `Client_email`, `Client_tipo`) VALUES
(5555, 'enrique', 'bueno', 'Hombre', 45555, 23, 'kra 8 c', 1, '2342', 'andres18281@hotmail.com', 'Natural'),
(9999, 'pepe', 'pelaes', 'Hombre', 12312, 54, 'kra 8 cccc', 1, '654', 'minagricultura@gg.com', 'Natural'),
(123456, 'Carlos', 'Magno', 'Hombre', 667, 45, 'Kra 8 c', 1, '23', 'andres18281@hotmail', 'Natural'),
(555566, 'enrique', 'buenaventura', 'Hombre', 3545, 56, 'kra 8 c', 1, '23423', 'minagricultura@hotmail.com', 'Natural'),
(788877, 'joselito', 'vargas', 'Hombre', 3444, 4, 'kra 8 ccc', 1, '6567', 'andres18281@hotmail.com82', ''),
(1144125068, 'Jose Fernando', 'Aguilar', 'Hombre', 3705104, 5, 'Kra 8 c', 50, '54', 'andres18281@gmail.com', 'Natural');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `Coment_auto` int(11) NOT NULL,
  `Coment_id` int(10) NOT NULL,
  `Coment_tipo` enum('Contrato','Servicio') NOT NULL,
  `Coment_text` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Definir algun comentario de algo';

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`Coment_auto`, `Coment_id`, `Coment_tipo`, `Coment_text`) VALUES
(9, 108081, 'Servicio', 'Hola andres, como estas ? necesito que me colabores con esta gestin, la empresa queda en mdellin el contacto es jorge ivan ospina y el te recibira para que puedas hacer la gestion'),
(10, 3, 'Servicio', 'Se hizo la instalacion y todo estuvo bien sin falla alguna'),
(11, 3, 'Servicio', 'se hizo lo que tenia que hacer'),
(12, 161130, 'Servicio', 'Andres, por favor colaborame con este caso'),
(13, 108083, 'Servicio', 'alex, por favor llevar esta instalacion'),
(14, 108083, 'Servicio', 'se lo canalizo'),
(15, 3, 'Servicio', 'se realizo la respectiva instalacion'),
(16, 3, 'Servicio', 'fffffffffffffffffffffffffffff'),
(17, 3, 'Servicio', 'fffffffffffffffffffffffffffff'),
(18, 3, 'Servicio', 'fffffffffffffffffffffffffffff'),
(19, 3, 'Servicio', 'gestin'),
(20, 3, 'Servicio', 'ccccccccccccc sa a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `Id_contrat` int(11) NOT NULL,
  `Contra_id_no` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'fecha de contrato',
  `Contra_id_client` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Contra_id_contr` int(11) NOT NULL,
  `Contra_descrip` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Contra_time` int(2) NOT NULL,
  `Contra_time_contrat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Contra_time_ini` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Contra_time_fin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Contra_Form_pago` enum('Un solo pago','Mensual','Trimestral','Semestral','Anual') COLLATE utf8_unicode_ci NOT NULL,
  `Contra_id_vended` int(10) NOT NULL,
  `Contra_servi_tecni` enum('SI','NO') COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contra_servi_tec_pri` enum('Bajo','Medio','Alto') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Establece prioridad de servi tecni',
  `Contra_costo` int(10) NOT NULL,
  `Contra_cost_abona` int(10) DEFAULT NULL,
  `Contra_Form_cuota` int(3) NOT NULL,
  `Contra_ciud` int(11) NOT NULL,
  `Contra_stado` enum('Activo','Inactivo','Gestion','Terminado','Finalizado') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departament`
--

CREATE TABLE `departament` (
  `Id_depart` int(10) NOT NULL,
  `Depart_nomb` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Cod_depart` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departament`
--

INSERT INTO `departament` (`Id_depart`, `Depart_nomb`, `Cod_depart`) VALUES
(1000, 'Administrativo', '313fff24a868186d47f9a86daed4c56c0179c5de'),
(1007, 'Nomina', 'dfe316149e563a46d19ded789cae407f1fc059ad'),
(1008, 'Servicio Tecnico', '3c40f18e470fd418aa069fc5f53bd1667697d3b7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departament_pais`
--

CREATE TABLE `departament_pais` (
  `id_depart` int(11) NOT NULL,
  `Nomb_depart` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departament_pais`
--

INSERT INTO `departament_pais` (`id_depart`, `Nomb_depart`) VALUES
(5, 'Antioquia'),
(25, 'Tolima'),
(63, 'Armenia'),
(76, 'Valle del cauca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripcion_de_evento`
--

CREATE TABLE `descripcion_de_evento` (
  `id` int(11) NOT NULL,
  `descrip` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `descripcion_de_evento`
--

INSERT INTO `descripcion_de_evento` (`id`, `descrip`) VALUES
(1043, 'Red caida cuando dos nodos '),
(1056, 'bla blallblblb '),
(23123, 'no funciona correctamente'),
(231232, 'no funciona correctamente'),
(231232, 'no funciona correctamente'),
(21321312, 'Para fallas tecniocas'),
(213213123, 'Para fallas tecniocasggggggggg'),
(123123, 'fgdfgdfgdfg'),
(1004, 'caida de red fallando'),
(344444, 'este evento se relaciona a las caidas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_fact`
--

CREATE TABLE `detalles_fact` (
  `Deta_id` int(11) NOT NULL,
  `Deta_id_fact` int(10) NOT NULL,
  `Deta_id_pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalles_fact`
--

INSERT INTO `detalles_fact` (`Deta_id`, `Deta_id_fact`, `Deta_id_pago`) VALUES
(6, 6, 79);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_stra`
--

CREATE TABLE `detalle_stra` (
  `detall_id` int(11) NOT NULL,
  `detall_id_pago` int(11) NOT NULL,
  `detall_id_fact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document_client`
--

CREATE TABLE `document_client` (
  `Document_id` varchar(15) NOT NULL,
  `Document_cam_comer` varchar(500) NOT NULL,
  `Document_fot_ced` varchar(500) NOT NULL,
  `Document_rut` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `document_client`
--

INSERT INTO `document_client` (`Document_id`, `Document_cam_comer`, `Document_fot_ced`, `Document_rut`) VALUES
('90909', '053310_fotocopia.jpg', '053310_rut.jpg', '053310_camaraycomercio.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `emple_id` int(10) NOT NULL,
  `emple_nomb` varchar(50) NOT NULL,
  `emple_apell` varchar(50) NOT NULL,
  `emple_tel` int(10) NOT NULL,
  `emple_cel` int(10) NOT NULL,
  `emple_dir` varchar(50) NOT NULL,
  `emple_email` varchar(50) NOT NULL,
  `emple_ciudad` int(10) NOT NULL,
  `emple_carg` int(10) NOT NULL,
  `emple_tipo` enum('Jefe','Cordinador','empleado') NOT NULL,
  `emple_activo` enum('SI','NO') NOT NULL,
  `emple_foto` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`emple_id`, `emple_nomb`, `emple_apell`, `emple_tel`, `emple_cel`, `emple_dir`, `emple_email`, `emple_ciudad`, `emple_carg`, `emple_tipo`, `emple_activo`, `emple_foto`) VALUES
(22344, 'Alex', 'Sepulpe', 37056, 311795, 'kra 8 c', 'andres18281@hotmail_', 50, 110, 'empleado', 'SI', '1467738032sP8BE.jpg.jpeg'),
(114456, 'Jose', 'Benavides', 31145, 24234, 'Kra 8 c', 'andres18281@', 50, 101, 'Jefe', 'SI', '1465595105empleado.jpg.jpeg'),
(1234556, 'andres', 'varreto', 317859, 318575, 'kra 8 c', 'andres18281@hotmail.com', 50, 110, 'Jefe', 'SI', '1477602382logo_velasquez.jpg.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_stra`
--

CREATE TABLE `empresa_stra` (
  `Empres_nit` varchar(12) NOT NULL,
  `Empres_nomb` varchar(50) NOT NULL,
  `Empres_tel` int(10) NOT NULL,
  `Empres_dir` varchar(70) NOT NULL,
  `Empres_ciud` int(11) NOT NULL,
  `Empres_id_client` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa_stra`
--

INSERT INTO `empresa_stra` (`Empres_nit`, `Empres_nomb`, `Empres_tel`, `Empres_dir`, `Empres_ciud`, `Empres_id_client`) VALUES
('10000', 'Panamericana', 34000, 'Kra 8 c 70', 50, 1144125068),
('890509-1', 'Carvajal', 370, 'kra 8 c', 1, 123456),
('90909', 'velasquez', 34888, 'kra 8 c', 50, 5555);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_stra`
--

CREATE TABLE `factura_stra` (
  `Fact_id` int(11) NOT NULL,
  `Fact_id_client` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Fact_id_contrat` int(11) NOT NULL,
  `Fact_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fact_fecha_final` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Fact_total` int(10) NOT NULL,
  `Fact_cancelado` enum('SI','NO') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto_servi_tecn`
--

CREATE TABLE `foto_servi_tecn` (
  `Foto_servi_id` int(11) NOT NULL,
  `Foto_url` varchar(100) NOT NULL,
  `Foto_id_servi` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Fotos de servicio realizado';

--
-- Volcado de datos para la tabla `foto_servi_tecn`
--

INSERT INTO `foto_servi_tecn` (`Foto_servi_id`, `Foto_url`, `Foto_id_servi`) VALUES
(76, 'plus.jpg', 3),
(77, 'premium.jpg', 3),
(78, 'rut.jpg', 3),
(79, 'sP8BE.jpg', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion_stra`
--

CREATE TABLE `gestion_stra` (
  `Gestion_id_auto` int(11) NOT NULL,
  `Gestion_id_tip` int(10) NOT NULL,
  `Gestion_estado` enum('Canalizado','Pendiente','Autorizado','Gestion','Terminado') NOT NULL,
  `Gestion_id_empresa` varchar(12) NOT NULL,
  `Gestion_id_emplead` int(10) NOT NULL,
  `Gestion_id_coment` int(10) NOT NULL,
  `Gestion_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Gestion_fecha_pend` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Gestion_fecha_autor` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Gestion_fecha_inicio` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Gestion_fecha_termi` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Gestion de trabajos asignados a empleados';

--
-- Volcado de datos para la tabla `gestion_stra`
--

INSERT INTO `gestion_stra` (`Gestion_id_auto`, `Gestion_id_tip`, `Gestion_estado`, `Gestion_id_empresa`, `Gestion_id_emplead`, `Gestion_id_coment`, `Gestion_fecha`, `Gestion_fecha_pend`, `Gestion_fecha_autor`, `Gestion_fecha_inicio`, `Gestion_fecha_termi`) VALUES
(3, 108081, 'Terminado', '10000', 1234556, 9, '2017-02-06 14:13:22', '2016-12-16 08:51:10', '0000-00-00 00:00:00', '2017-01-23 08:01:21', '0000-00-00 00:00:00'),
(4, 108082, 'Terminado', '890509-1', 1234556, 12, '2017-02-06 14:11:53', '2016-11-30 13:18:40', '0000-00-00 00:00:00', '2016-11-30 14:02:12', '0000-00-00 00:00:00'),
(5, 108083, 'Gestion', '10000', 1234556, 14, '2017-02-06 14:13:28', '2017-01-20 14:11:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_str`
--

CREATE TABLE `pagos_str` (
  `pagos_id` int(11) NOT NULL,
  `pago_fecha_inic` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pago_fecha_fin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pago_fecha_pago` datetime DEFAULT NULL,
  `pago_id_contrat` int(10) NOT NULL,
  `pago_id_empre` varchar(12) NOT NULL,
  `pago_costo` int(10) NOT NULL,
  `pago_confir` enum('SI','NO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_ticket`
--

CREATE TABLE `registro_ticket` (
  `Ticket_id` int(11) NOT NULL,
  `id_client` int(10) DEFAULT NULL,
  `Nit_empresa` varchar(15) NOT NULL,
  `Ticket_tel` varchar(12) NOT NULL,
  `Ticket_cel` int(10) NOT NULL,
  `Ticket_Descrip` varchar(1000) NOT NULL,
  `Ticket_event` int(11) NOT NULL,
  `Ticket_ciudad` int(11) NOT NULL,
  `Ticket_id_recibe` int(10) NOT NULL,
  `Ticket_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Ticket_area` int(11) DEFAULT NULL,
  `Ticket_ced_asign` int(10) DEFAULT NULL COMMENT 'cedula del empleado asignado',
  `Ticket_estado` enum('Nuevo','Canalizado','Finalizado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta_ticket`
--

CREATE TABLE `respuesta_ticket` (
  `Respon_id` int(11) NOT NULL,
  `Respon_text` varchar(1000) NOT NULL,
  `Respon_id_ticket` int(10) NOT NULL,
  `Respon_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Respon_recibe_id` int(10) NOT NULL,
  `Respon_estad` enum('Canalizado','Finalizado') NOT NULL,
  `Respon_departa_resp` int(11) DEFAULT NULL,
  `Respon_id_emplo_asig` int(10) DEFAULT NULL COMMENT 'id de cliente asignado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_prestado`
--

CREATE TABLE `servicios_prestado` (
  `Servi_id` int(11) NOT NULL,
  `Servi_id_tip` int(11) NOT NULL,
  `Servi_nomb` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Servi_cost` decimal(10,0) NOT NULL,
  `Servi_tiem` enum('dia','mes','trimestre','semestre','año') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `servicios_prestado`
--

INSERT INTO `servicios_prestado` (`Servi_id`, `Servi_id_tip`, `Servi_nomb`, `Servi_cost`, `Servi_tiem`) VALUES
(121, 121, 'Internet Banda Ancha', '30000', 'mes'),
(1004, 1021, 'Internet', '24000', 'mes'),
(1005, 1021, 'Internet', '64000', 'mes'),
(123123, 1021, 'Servicio instalancion', '34444', 'dia'),
(213123, 1020, 'Mantenimiento', '2344', 'mes'),
(223322, 1020, 'Cableado estructurado', '150000', 'dia'),
(324234, 1020, 'Cableado', '50000', 'mes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_instalacion`
--

CREATE TABLE `solicitud_instalacion` (
  `solic_id` int(11) NOT NULL,
  `solic_nit_empre` varchar(15) NOT NULL,
  `solic_fecha_solici` datetime NOT NULL,
  `solic_stado` enum('solicitud','contestado','no contestado') NOT NULL,
  `solic_id_emplo` int(10) NOT NULL,
  `solic_id_tecnico` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solici_material_servi_tect`
--

CREATE TABLE `solici_material_servi_tect` (
  `Solici_mat_id` int(11) NOT NULL,
  `Solici_mat_nomb` varchar(100) NOT NULL,
  `Solici_mat_cant` varchar(50) NOT NULL,
  `Solici_mat_cost` int(10) DEFAULT NULL,
  `Solici_id_servi_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solici_material_servi_tect`
--

INSERT INTO `solici_material_servi_tect` (`Solici_mat_id`, `Solici_mat_nomb`, `Solici_mat_cant`, `Solici_mat_cost`, `Solici_id_servi_id`) VALUES
(6, 'martillo', '1', 23000, 3),
(7, 'cable utp', '23 metros', 344449, 3),
(8, 'salida utp', '2 unidades', 4555, 3),
(9, 'cable utp', '12 metros', NULL, 4),
(10, 'linterna', '1', NULL, 4),
(11, 'cable utp', '12 metros', 3434, 3),
(12, 'microtic ', '1', 566666, 3),
(13, 'cable utp', '3', NULL, 5),
(14, 'microusb', '3', NULL, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stra_modulo`
--

CREATE TABLE `stra_modulo` (
  `modu_id` int(11) NOT NULL,
  `modu_name` enum('ticket','contratos','empleados','clientes','proveedores','soporte') NOT NULL,
  `modu_item` varchar(10) NOT NULL,
  `modu_id_emplo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `stra_modulo`
--

INSERT INTO `stra_modulo` (`modu_id`, `modu_name`, `modu_item`, `modu_id_emplo`) VALUES
(1, 'contratos', '1,1,1', 22344),
(2, 'empleados', '1,1,1', 22344),
(3, 'clientes', '1,1,1', 22344),
(4, 'proveedores', '1,1,1', 22344),
(5, 'soporte', '1,1,1', 22344);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `str_user_coun`
--

CREATE TABLE `str_user_coun` (
  `str_id_user` int(10) NOT NULL,
  `str_pass` varchar(50) NOT NULL,
  `str_tipe` enum('Empleado','Cliente') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `str_user_coun`
--

INSERT INTO `str_user_coun` (`str_id_user`, `str_pass`, `str_tipe`) VALUES
(1442525, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Empleado'),
(114456, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Empleado'),
(890509, 'b64e9a82c7b638b89ca398306d0854f887cebac9', 'Empleado'),
(1155, 'b64e9a82c7b638b89ca398306d0854f887cebac9', 'Empleado'),
(22344, 'b64e9a82c7b638b89ca398306d0854f887cebac9', 'Empleado'),
(22344, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Empleado'),
(1234556, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Empleado'),
(1144125068, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `timeline_ticket`
--

CREATE TABLE `timeline_ticket` (
  `Time_id` int(11) NOT NULL,
  `Time_id_ticket` int(11) NOT NULL,
  `Time_id_respon` int(11) NOT NULL,
  `Time_area` int(10) NOT NULL,
  `Time_estado` enum('Canalizado','Finalizado','Pendiente') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `timeline_ticket`
--

INSERT INTO `timeline_ticket` (`Time_id`, `Time_id_ticket`, `Time_id_respon`, `Time_area`, `Time_estado`) VALUES
(0, 0, 123123, 0, 'Canalizado'),
(0, 0, 123123, 1007, 'Canalizado'),
(0, 0, 123123, 1007, 'Canalizado'),
(0, 0, 123123, 1007, 'Canalizado'),
(0, 0, 123123, 1007, 'Canalizado'),
(0, 0, 123123, 1008, 'Canalizado'),
(0, 0, 123123, 1007, 'Canalizado'),
(0, 5, 123123, 1007, 'Canalizado'),
(0, 6, 123123, 0, 'Canalizado'),
(0, 7, 123123, 1000, 'Canalizado'),
(0, 8, 123123, 1007, 'Canalizado'),
(0, 9, 114456, 1007, 'Canalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_evento`
--

CREATE TABLE `tipo_evento` (
  `Tip_eve_id` int(11) NOT NULL,
  `Tip_eve_nomb` varchar(50) NOT NULL,
  `Tip_serv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_evento`
--

INSERT INTO `tipo_evento` (`Tip_eve_id`, `Tip_eve_nomb`, `Tip_serv_id`) VALUES
(1004, 'servidor caido', 1020),
(1043, 'Red Caida', 1020),
(1056, 'Servicio no sirve', 1021),
(23123, 'Caida de hosting', 1021),
(123123, 'erwerer', 121),
(231232, 'Caida de hosting ff', 1021),
(344444, 'noriega', 457777),
(21321312, 'Prueba', 121),
(213213123, 'Pruebarrrr', 1020);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_servicio`
--

CREATE TABLE `tipo_servicio` (
  `Tipo_id` int(11) NOT NULL,
  `Tipo_nomb` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_servicio`
--

INSERT INTO `tipo_servicio` (`Tipo_id`, `Tipo_nomb`) VALUES
(121, 'fdsfdsf'),
(1020, 'Redes'),
(1021, 'Hosting'),
(23434, 'Redes'),
(32551, 'Hosting |123'),
(45345, 'gfhfghfgh'),
(324324, 'Internet'),
(364568, 'hosting _ '),
(457777, 'vv_'),
(3123123, 'Internet'),
(4324234, 'hfghfgh'),
(56456454, 'internet');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viabilidad_ubicacion`
--

CREATE TABLE `viabilidad_ubicacion` (
  `viabili_id` int(11) NOT NULL,
  `viabili_busqueda` varchar(50) NOT NULL,
  `viabili_direcc` varchar(50) NOT NULL,
  `viabili_latitud` varchar(20) NOT NULL,
  `viabili_longitud` varchar(20) NOT NULL,
  `viabili_config` enum('IPV4','IPV6') NOT NULL,
  `viabili_acceso` enum('kilobyte','megabyte') NOT NULL,
  `viabili_velocid` enum('1mg','2mg','4mg','5mg','10mg','20mg','128kb','256kb','512kb') NOT NULL,
  `viabili_tipo_enlace` enum('Radio laser','Fibra','Cobre') NOT NULL,
  `viabili_slas` enum('29','30') NOT NULL,
  `viabili_stado1` enum('Solicitud','Aprobado','No aprobado') NOT NULL,
  `viabili_stado2` enum('Cotizado','No cotizado') DEFAULT NULL,
  `viabili_id_solici` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo_stra`
--
ALTER TABLE `cargo_stra`
  ADD PRIMARY KEY (`Carg_id`),
  ADD KEY `Carg_depart` (`Carg_depart`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`Ciudad_id`),
  ADD KEY `Ciudad_depart` (`Ciudad_depart`),
  ADD KEY `Ciudad_depart_2` (`Ciudad_depart`);

--
-- Indices de la tabla `clientes_stra`
--
ALTER TABLE `clientes_stra`
  ADD PRIMARY KEY (`Client_id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`Coment_auto`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`Id_contrat`),
  ADD KEY `Contra_id_client` (`Contra_id_client`),
  ADD KEY `Contra_id_contr` (`Contra_id_contr`),
  ADD KEY `Contra_id_client_2` (`Contra_id_client`),
  ADD KEY `Contra_id_contr_2` (`Contra_id_contr`),
  ADD KEY `Contra_id_contr_3` (`Contra_id_contr`),
  ADD KEY `Contra_id_contr_4` (`Contra_id_contr`);

--
-- Indices de la tabla `departament`
--
ALTER TABLE `departament`
  ADD PRIMARY KEY (`Id_depart`);

--
-- Indices de la tabla `departament_pais`
--
ALTER TABLE `departament_pais`
  ADD PRIMARY KEY (`id_depart`);

--
-- Indices de la tabla `detalles_fact`
--
ALTER TABLE `detalles_fact`
  ADD PRIMARY KEY (`Deta_id`),
  ADD KEY `Deta_id_serv` (`Deta_id_pago`),
  ADD KEY `Deta_id_fact` (`Deta_id_fact`),
  ADD KEY `Deta_id_serv_2` (`Deta_id_pago`);

--
-- Indices de la tabla `detalle_stra`
--
ALTER TABLE `detalle_stra`
  ADD PRIMARY KEY (`detall_id`);

--
-- Indices de la tabla `document_client`
--
ALTER TABLE `document_client`
  ADD PRIMARY KEY (`Document_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`emple_id`),
  ADD KEY `emple_carg` (`emple_carg`),
  ADD KEY `emple_carg_2` (`emple_carg`),
  ADD KEY `emple_ciudad` (`emple_ciudad`);

--
-- Indices de la tabla `empresa_stra`
--
ALTER TABLE `empresa_stra`
  ADD PRIMARY KEY (`Empres_nit`);

--
-- Indices de la tabla `factura_stra`
--
ALTER TABLE `factura_stra`
  ADD PRIMARY KEY (`Fact_id`),
  ADD UNIQUE KEY `Fact_id_contrat` (`Fact_id_contrat`),
  ADD KEY `Fact_id_client` (`Fact_id_client`),
  ADD KEY `Fact_id_contrat_2` (`Fact_id_contrat`);

--
-- Indices de la tabla `foto_servi_tecn`
--
ALTER TABLE `foto_servi_tecn`
  ADD PRIMARY KEY (`Foto_servi_id`),
  ADD KEY `Foto_id_servi` (`Foto_id_servi`);

--
-- Indices de la tabla `gestion_stra`
--
ALTER TABLE `gestion_stra`
  ADD PRIMARY KEY (`Gestion_id_auto`),
  ADD UNIQUE KEY `Gestion_id_tip` (`Gestion_id_tip`),
  ADD UNIQUE KEY `Gestion_id_coment` (`Gestion_id_coment`),
  ADD KEY `Gestion_id_emplead` (`Gestion_id_emplead`),
  ADD KEY `Gestion_id_empresa` (`Gestion_id_empresa`);

--
-- Indices de la tabla `pagos_str`
--
ALTER TABLE `pagos_str`
  ADD PRIMARY KEY (`pagos_id`),
  ADD KEY `pago_id_fact` (`pago_id_contrat`),
  ADD KEY `pago_id_empre` (`pago_id_empre`);

--
-- Indices de la tabla `registro_ticket`
--
ALTER TABLE `registro_ticket`
  ADD PRIMARY KEY (`Ticket_id`),
  ADD KEY `Ticket_event` (`Ticket_event`),
  ADD KEY `Ticket_id_recibe` (`Ticket_id_recibe`),
  ADD KEY `Nit_empresa` (`Nit_empresa`),
  ADD KEY `Ticket_ced_asign` (`Ticket_ced_asign`),
  ADD KEY `Ticket_ciudad` (`Ticket_ciudad`);

--
-- Indices de la tabla `respuesta_ticket`
--
ALTER TABLE `respuesta_ticket`
  ADD PRIMARY KEY (`Respon_id`),
  ADD KEY `Respon_recibe_id` (`Respon_recibe_id`),
  ADD KEY `Respon_id_emplo_asig` (`Respon_id_emplo_asig`);

--
-- Indices de la tabla `servicios_prestado`
--
ALTER TABLE `servicios_prestado`
  ADD PRIMARY KEY (`Servi_id`),
  ADD KEY `Servi_id_tip` (`Servi_id_tip`);

--
-- Indices de la tabla `solicitud_instalacion`
--
ALTER TABLE `solicitud_instalacion`
  ADD PRIMARY KEY (`solic_id`);

--
-- Indices de la tabla `solici_material_servi_tect`
--
ALTER TABLE `solici_material_servi_tect`
  ADD PRIMARY KEY (`Solici_mat_id`),
  ADD KEY `Solici_id_servi_id` (`Solici_id_servi_id`);

--
-- Indices de la tabla `stra_modulo`
--
ALTER TABLE `stra_modulo`
  ADD PRIMARY KEY (`modu_id`);

--
-- Indices de la tabla `tipo_evento`
--
ALTER TABLE `tipo_evento`
  ADD PRIMARY KEY (`Tip_eve_id`),
  ADD KEY `Tip_serv_id` (`Tip_serv_id`),
  ADD KEY `Tip_serv_id_2` (`Tip_serv_id`);

--
-- Indices de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  ADD PRIMARY KEY (`Tipo_id`);

--
-- Indices de la tabla `viabilidad_ubicacion`
--
ALTER TABLE `viabilidad_ubicacion`
  ADD PRIMARY KEY (`viabili_id`),
  ADD KEY `viabili_id_solici` (`viabili_id_solici`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo_stra`
--
ALTER TABLE `cargo_stra`
  MODIFY `Carg_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `Ciudad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=896;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `Coment_auto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `Id_contrat` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `departament`
--
ALTER TABLE `departament`
  MODIFY `Id_depart` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;
--
-- AUTO_INCREMENT de la tabla `departament_pais`
--
ALTER TABLE `departament_pais`
  MODIFY `id_depart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT de la tabla `detalles_fact`
--
ALTER TABLE `detalles_fact`
  MODIFY `Deta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `detalle_stra`
--
ALTER TABLE `detalle_stra`
  MODIFY `detall_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `factura_stra`
--
ALTER TABLE `factura_stra`
  MODIFY `Fact_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `foto_servi_tecn`
--
ALTER TABLE `foto_servi_tecn`
  MODIFY `Foto_servi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT de la tabla `gestion_stra`
--
ALTER TABLE `gestion_stra`
  MODIFY `Gestion_id_auto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `pagos_str`
--
ALTER TABLE `pagos_str`
  MODIFY `pagos_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `registro_ticket`
--
ALTER TABLE `registro_ticket`
  MODIFY `Ticket_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `respuesta_ticket`
--
ALTER TABLE `respuesta_ticket`
  MODIFY `Respon_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `servicios_prestado`
--
ALTER TABLE `servicios_prestado`
  MODIFY `Servi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324235;
--
-- AUTO_INCREMENT de la tabla `solicitud_instalacion`
--
ALTER TABLE `solicitud_instalacion`
  MODIFY `solic_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `solici_material_servi_tect`
--
ALTER TABLE `solici_material_servi_tect`
  MODIFY `Solici_mat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `stra_modulo`
--
ALTER TABLE `stra_modulo`
  MODIFY `modu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tipo_evento`
--
ALTER TABLE `tipo_evento`
  MODIFY `Tip_eve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213213124;
--
-- AUTO_INCREMENT de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  MODIFY `Tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56456455;
--
-- AUTO_INCREMENT de la tabla `viabilidad_ubicacion`
--
ALTER TABLE `viabilidad_ubicacion`
  MODIFY `viabili_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `contrato_ibfk_1` FOREIGN KEY (`Contra_id_contr`) REFERENCES `servicios_prestado` (`Servi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`emple_carg`) REFERENCES `cargo_stra` (`Carg_id`);

--
-- Filtros para la tabla `pagos_str`
--
ALTER TABLE `pagos_str`
  ADD CONSTRAINT `pagos_str_ibfk_1` FOREIGN KEY (`pago_id_contrat`) REFERENCES `contrato` (`Id_contrat`);

--
-- Filtros para la tabla `registro_ticket`
--
ALTER TABLE `registro_ticket`
  ADD CONSTRAINT `registro_ticket_ibfk_1` FOREIGN KEY (`Ticket_ciudad`) REFERENCES `ciudad` (`Ciudad_id`);

--
-- Filtros para la tabla `servicios_prestado`
--
ALTER TABLE `servicios_prestado`
  ADD CONSTRAINT `servicios_prestado_ibfk_1` FOREIGN KEY (`Servi_id_tip`) REFERENCES `tipo_servicio` (`Tipo_id`);

--
-- Filtros para la tabla `solici_material_servi_tect`
--
ALTER TABLE `solici_material_servi_tect`
  ADD CONSTRAINT `solici_material_servi_tect_ibfk_1` FOREIGN KEY (`Solici_id_servi_id`) REFERENCES `gestion_stra` (`Gestion_id_auto`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `trimestre_facture` ON SCHEDULE EVERY 3 MONTH STARTS '2016-06-17 09:16:45' ON COMPLETION PRESERVE ENABLE DO BEGIN 
   DECLARE done INT DEFAULT FALSE;
   DECLARE codigo int(10);
   DECLARE costo int(10);
   DECLARE empresa varchar(60);
   DECLARE nit varchar(12);
   DECLARE tiempo int(2);
   DECLARE cur CURSOR FOR 
        SELECT Id_contrat,Servi_cost,Empres_nomb,Empres_nit,Contra_time
        FROM contrato con
        INNER JOIN servicios_prestado sp ON con.Contra_id_contr = sp.Servi_id
        INNER JOIN empresa_stra emp ON emp.Empres_nit = con.Contra_id_client
        WHERE DATE_FORMAT(Contra_time_ini,'%Y%m') >= DATE_FORMAT(now(),'%Y%m') 
        AND DATE_FORMAT(Contra_time_fin,'%Y%m') <= DATE_FORMAT(now(),'%Y%m')
        AND Contra_Form_pago = 3 
        AND Contra_stado = 1 
        AND Contra_time >= (SELECT COUNT(*) FROM pagos_str WHERE pago_id_fact = Id_contrat); 
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
        OPEN cur;
        start_loop:loop 
          fetch cur into codigo,costo,empresa,nit,tiempo;
            IF done THEN 
              LEAVE start_loop; 
            END if;
            INSERT INTO `pagos_str`(`pagos_id`,`pago_fecha`,`pago_fecha_fin`,`pago_fecha_pago`,`pago_id_fact`,`pago_id_empre`,`pago_costo`,`pago_confir`) VALUES(null,now(),LAST_DAY(now()),null,codigo,nit,(costo/tiempo),2);
          END loop start_loop;
        close cur;
  END$$

CREATE DEFINER=`root`@`localhost` EVENT `mount_facture` ON SCHEDULE EVERY 1 MONTH STARTS '2016-06-20 11:15:00' ON COMPLETION PRESERVE ENABLE DO BEGIN 
   DECLARE done INT DEFAULT FALSE;
   DECLARE codigo int(10);
   DECLARE costo int(10);
   DECLARE empresa varchar(60);
   DECLARE nit varchar(12);
   DECLARE tiempo int(2);
   DECLARE cur CURSOR FOR 
        SELECT  Id_contrat ,Servi_cost,Empres_nomb,Empres_nit,Contra_time
        FROM contrato con
        INNER JOIN servicios_prestado sp ON con.Contra_id_contr = sp.Servi_id
        INNER JOIN empresa_stra emp ON emp.Empres_nit = con.Contra_id_client
        WHERE DATE_FORMAT(Contra_time_ini,'%Y%m') >= DATE_FORMAT(now(),'%Y%m') 
        AND DATE_FORMAT(Contra_time_fin,'%Y%m') <= DATE_FORMAT(now(),'%Y%m')
        AND Contra_Form_pago = 2 
        AND Contra_stado = 1 
        AND Contra_time >= (SELECT COUNT(*) FROM pagos_str WHERE pago_id_fact = Id_contrat); 
	      DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
        OPEN cur;
        start_loop:loop 
          fetch cur into codigo,costo,empresa,nit,tiempo;
            IF done THEN 
		          LEAVE start_loop; 
	          END if;
            INSERT INTO `pagos_str`(`pagos_id`,`pago_fecha`,`pago_fecha_fin`,`pago_id_fact`,`pago_id_empre`,`pago_costo`,`pago_confir`) VALUES(null,now(),LAST_DAY(now()),codigo,nit,(costo/tiempo),2);
          END loop start_loop;
        close cur;
  END$$

CREATE DEFINER=`root`@`localhost` EVENT `semestre_facture` ON SCHEDULE EVERY 6 MONTH STARTS '2016-06-17 09:16:45' ON COMPLETION PRESERVE ENABLE DO BEGIN 
   DECLARE done INT DEFAULT FALSE;
   DECLARE codigo int(10);
   DECLARE costo int(10);
   DECLARE empresa varchar(60);
   DECLARE nit varchar(12);
   DECLARE tiempo int(2);
   DECLARE cur CURSOR FOR 
        SELECT Id_contrat,Servi_cost,Empres_nomb,Empres_nit,Contra_time
        FROM contrato con
        INNER JOIN servicios_prestado sp ON con.Contra_id_contr = sp.Servi_id
        INNER JOIN empresa_stra emp ON emp.Empres_nit = con.Contra_id_client
        WHERE DATE_FORMAT(Contra_time_ini,'%Y%m') >= DATE_FORMAT(now(),'%Y%m') 
        AND DATE_FORMAT(Contra_time_fin,'%Y%m') <= DATE_FORMAT(now(),'%Y%m')
        AND Contra_Form_pago = 4 
        AND Contra_stado = 1 
        AND Contra_time >= (SELECT COUNT(*) FROM pagos_str WHERE pago_id_fact = Id_contrat); 
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
        OPEN cur;
        start_loop:loop 
          fetch cur into codigo,costo,empresa,nit,tiempo;
            IF done THEN 
              LEAVE start_loop; 
            END if;
            INSERT INTO `pagos_str`(`pagos_id`,`pago_fecha`,`pago_fecha_fin`,`pago_fecha_pago`,`pago_id_fact`,`pago_id_empre`,`pago_costo`,`pago_confir`) VALUES(null,now(),LAST_DAY(now()),null,codigo,nit,(costo/tiempo),2);
          END loop start_loop;
        close cur;
  END$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
