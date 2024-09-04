-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.22-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para php_cajas_atc
DROP DATABASE IF EXISTS `php_cajas_atc`;
CREATE DATABASE IF NOT EXISTS `php_cajas_atc` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `php_cajas_atc`;

-- Volcando estructura para tabla php_cajas_atc.almacen
DROP TABLE IF EXISTS `almacen`;
CREATE TABLE IF NOT EXISTS `almacen` (
  `codigo` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `web` varchar(50) DEFAULT NULL,
  `num_huecos_pasillo` int(11) DEFAULT NULL,
  `pasillos` set('Value A','Value B') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla php_cajas_atc.almacen: ~1 rows (aproximadamente)
DELETE FROM `almacen`;
/*!40000 ALTER TABLE `almacen` DISABLE KEYS */;
INSERT INTO `almacen` (`codigo`, `nombre`, `direccion`, `telefono`, `email`, `web`, `num_huecos_pasillo`, `pasillos`) VALUES
	('72456', 'Almacen1701', 'Alguna de por ahí', '967802567', 'boxelSystems@gmail.com', 'www.BoXeLSystems.com', 15, 'Value A,Value B');
/*!40000 ALTER TABLE `almacen` ENABLE KEYS */;

-- Volcando estructura para tabla php_cajas_atc.caja
DROP TABLE IF EXISTS `caja`;
CREATE TABLE IF NOT EXISTS `caja` (
  `id_caja` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_caja` varchar(50) NOT NULL,
  `material_caja` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `alto` int(11) NOT NULL DEFAULT 0,
  `ancho` int(11) NOT NULL DEFAULT 0,
  `profundidad` int(11) NOT NULL DEFAULT 0,
  `contenido` varchar(50) NOT NULL,
  `fecha_alta_caja` date NOT NULL,
  PRIMARY KEY (`id_caja`),
  UNIQUE KEY `codigo` (`codigo_caja`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla php_cajas_atc.caja: ~0 rows (aproximadamente)
DELETE FROM `caja`;
/*!40000 ALTER TABLE `caja` DISABLE KEYS */;
/*!40000 ALTER TABLE `caja` ENABLE KEYS */;

-- Volcando estructura para tabla php_cajas_atc.cajabackup
DROP TABLE IF EXISTS `cajabackup`;
CREATE TABLE IF NOT EXISTS `cajabackup` (
  `id_cajabackup` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_cajabackup` varchar(50) NOT NULL,
  `material_cajabackup` varchar(50) NOT NULL,
  `color_cajabackup` varchar(50) NOT NULL,
  `alto_cajabackup` int(11) NOT NULL DEFAULT 0,
  `ancho_cajabackup` int(11) NOT NULL DEFAULT 0,
  `profuncidad_cajabackup` int(11) NOT NULL DEFAULT 0,
  `contenido_cajabackup` varchar(50) NOT NULL,
  `fecha_alta_cajabackup` date NOT NULL,
  `fecha_baja_cajabackup` date NOT NULL,
  `id_estanteria_cajabackup` int(11) NOT NULL DEFAULT 0,
  `leja_ocupada_cajabackup` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_cajabackup`),
  UNIQUE KEY `codigo_cajabackup` (`codigo_cajabackup`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla php_cajas_atc.cajabackup: ~0 rows (aproximadamente)
DELETE FROM `cajabackup`;
/*!40000 ALTER TABLE `cajabackup` DISABLE KEYS */;
/*!40000 ALTER TABLE `cajabackup` ENABLE KEYS */;

-- Volcando estructura para tabla php_cajas_atc.estanteria
DROP TABLE IF EXISTS `estanteria`;
CREATE TABLE IF NOT EXISTS `estanteria` (
  `id_estanteria` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_estanteria` varchar(50) NOT NULL,
  `material_estanteria` varchar(50) NOT NULL,
  `nlejas` int(11) NOT NULL DEFAULT 0,
  `lejas_ocupadas` int(11) DEFAULT 0,
  `fecha_alta_estanteria` date DEFAULT NULL,
  `id_pasillo` int(11) NOT NULL DEFAULT 0,
  `numero` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_estanteria`),
  UNIQUE KEY `codigo` (`codigo_estanteria`),
  UNIQUE KEY `pasillo_numero` (`id_pasillo`,`numero`) USING BTREE,
  CONSTRAINT `FK_estanteria_pasillo` FOREIGN KEY (`id_pasillo`) REFERENCES `pasillo` (`id_pasillo`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla php_cajas_atc.estanteria: ~0 rows (aproximadamente)
DELETE FROM `estanteria`;
/*!40000 ALTER TABLE `estanteria` DISABLE KEYS */;
/*!40000 ALTER TABLE `estanteria` ENABLE KEYS */;

-- Volcando estructura para tabla php_cajas_atc.ocupacion
DROP TABLE IF EXISTS `ocupacion`;
CREATE TABLE IF NOT EXISTS `ocupacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idestanteria` int(11) NOT NULL,
  `leja_ocupada` int(11) NOT NULL,
  `idcaja` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idestanteria_leja_ocupada` (`idestanteria`,`leja_ocupada`),
  UNIQUE KEY `idcaja` (`idcaja`),
  CONSTRAINT `FK_ocupacion_caja` FOREIGN KEY (`idcaja`) REFERENCES `caja` (`id_caja`),
  CONSTRAINT `FK_ocupacion_estanteria` FOREIGN KEY (`idestanteria`) REFERENCES `estanteria` (`id_estanteria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla php_cajas_atc.ocupacion: ~0 rows (aproximadamente)
DELETE FROM `ocupacion`;
/*!40000 ALTER TABLE `ocupacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `ocupacion` ENABLE KEYS */;

-- Volcando estructura para tabla php_cajas_atc.pasillo
DROP TABLE IF EXISTS `pasillo`;
CREATE TABLE IF NOT EXISTS `pasillo` (
  `id_pasillo` int(11) NOT NULL AUTO_INCREMENT,
  `letra` char(50) NOT NULL,
  `huecos_ocupados` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_pasillo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla php_cajas_atc.pasillo: ~4 rows (aproximadamente)
DELETE FROM `pasillo`;
/*!40000 ALTER TABLE `pasillo` DISABLE KEYS */;
INSERT INTO `pasillo` (`id_pasillo`, `letra`, `huecos_ocupados`) VALUES
	(1, 'A', 0),
	(2, 'B', 0),
	(3, 'C', 0),
	(4, 'D', 0);
/*!40000 ALTER TABLE `pasillo` ENABLE KEYS */;

-- Volcando estructura para tabla php_cajas_atc.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla php_cajas_atc.usuario: ~0 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Volcando estructura para disparador php_cajas_atc.backupcaja
DROP TRIGGER IF EXISTS `backupcaja`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `backupcaja` BEFORE DELETE ON `caja` FOR EACH ROW BEGIN
DECLARE idE integer;
DECLARE leja integer;
SELECT idestanteria,leja_ocupada INTO idE,leja FROM ocupacion WHERE idcaja=OLD.id_caja;
INSERT INTO cajabackup VALUES(NULL,OLD.codigo_caja,OLD.material_caja,OLD.color,OLD.alto,OLD.ancho,OLD.profundidad,OLD.contenido,OLD.fecha_alta_caja,CURRENT_DATE(),idE,leja);
DELETE FROM ocupacion WHERE idcaja=OLD.id_caja;
UPDATE estanteria SET lejas_ocupadas=lejas_ocupadas-1 WHERE id_estanteria=idE;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
