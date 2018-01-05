/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.28-MariaDB : Database - consulta
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`consulta` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `agenda` */

DROP TABLE IF EXISTS `agenda`;

CREATE TABLE `agenda` (
  `idAgenda` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEspecialidad` int(10) unsigned NOT NULL,
  `idConsultorio` int(10) unsigned NOT NULL,
  `idProfesional` int(10) unsigned NOT NULL,
  `Turno` int(11) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Periodo` varchar(10) DEFAULT NULL,
  `HoraInicio` varchar(10) DEFAULT NULL,
  `HoraFin` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idAgenda`),
  KEY `Agenda_FKIndex1` (`idProfesional`),
  KEY `Agenda_FKIndex2` (`idConsultorio`),
  KEY `Agenda_FKIndex3` (`idEspecialidad`),
  CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`idProfesional`) REFERENCES `profesionales` (`idProfesional`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`idConsultorio`) REFERENCES `consultorios` (`idConsultorio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `agenda_ibfk_3` FOREIGN KEY (`idEspecialidad`) REFERENCES `especialidades` (`idEspecialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13493 DEFAULT CHARSET=latin1;

/*Data for the table `agenda` */

insert  into `agenda`(`idAgenda`,`idEspecialidad`,`idConsultorio`,`idProfesional`,`Turno`,`Fecha`,`Periodo`,`HoraInicio`,`HoraFin`) values (1,5,1,10,1,'2017-11-01','11/2017','08:00:00','13:00:00'),(2,5,1,7,1,'2017-11-02','11/2017','08:00:00','13:00:00'),(3,5,1,16,2,'2017-11-03','11/2017','16:00:00','20:00:00'),(4,5,1,8,1,'2017-11-04','11/2017','08:00:00','13:00:00'),(5,5,1,15,2,'2017-11-04','11/2017','16:00:00','20:00:00'),(6,5,1,13,1,'2017-11-06','11/2017','08:00:00','13:00:00'),(7,5,1,13,2,'2017-11-06','11/2017','16:00:00','20:00:00'),(8,5,1,5,1,'2017-11-07','11/2017','08:00:00','13:00:00'),(9,5,1,4,2,'2017-11-07','11/2017','16:00:00','20:00:00'),(10,5,1,13,1,'2017-11-08','11/2017','08:00:00','13:00:00'),(11,5,1,9,2,'2017-11-08','11/2017','16:00:00','20:00:00'),(12,5,1,17,1,'2017-11-09','11/2017','08:00:00','13:00:00'),(13,5,1,12,2,'2017-11-09','11/2017','16:00:00','20:00:00'),(14,5,1,18,1,'2017-11-10','11/2017','08:00:00','13:00:00'),(15,5,1,18,2,'2017-11-10','11/2017','16:00:00','20:00:00'),(16,5,1,5,2,'2018-01-01','01/2018','16:00:00','20:00:00'),(17,5,1,3,2,'2018-01-02','01/2018','16:00:00','20:00:00'),(18,5,1,16,1,'2018-01-03','01/2018','08:00:00','13:00:00'),(19,5,1,16,2,'2018-01-03','01/2018','16:00:00','20:00:00'),(20,5,1,3,1,'2018-01-04','01/2018','08:00:00','13:00:00'),(21,5,1,11,2,'2018-01-04','01/2018','16:00:00','20:00:00'),(22,5,1,10,1,'2018-01-05','01/2018','08:00:00','13:00:00'),(23,5,2,16,1,'2018-01-01','01/2018','08:00:00','13:00:00'),(24,5,2,16,2,'2018-01-01','01/2018','16:00:00','20:00:00'),(25,5,2,2,2,'2018-01-02','01/2018','16:00:00','20:00:00'),(26,5,2,18,2,'2018-01-03','01/2018','16:00:00','20:00:00'),(27,5,2,13,1,'2018-01-04','01/2018','08:00:00','13:00:00'),(28,5,2,6,2,'2018-01-04','01/2018','16:00:00','20:00:00'),(29,5,2,18,2,'2018-01-05','01/2018','16:00:00','20:00:00'),(30,5,3,12,2,'2018-01-02','01/2018','16:00:00','20:00:00'),(31,5,3,12,2,'2018-01-04','01/2018','16:00:00','20:00:00'),(32,2,4,1,2,'2018-01-01','01/2018','16:00:00','20:00:00'),(33,5,4,15,1,'2018-01-02','01/2018','08:00:00','13:00:00'),(34,5,4,15,2,'2018-01-02','01/2018','16:00:00','20:00:00'),(35,5,4,7,2,'2018-01-04','01/2018','16:00:00','20:00:00'),(36,5,4,8,1,'2018-01-05','01/2018','08:00:00','13:00:00'),(37,2,4,1,2,'2018-01-05','01/2018','08:00:00','20:00:00'),(38,5,5,12,2,'2018-01-02','01/2018','16:00:00','20:00:00'),(39,5,5,6,1,'2018-01-03','01/2018','08:00:00','13:00:00'),(40,5,5,14,2,'2018-01-03','01/2018','16:00:00','20:00:00'),(41,5,5,12,2,'2018-01-04','01/2018','16:00:00','20:00:00'),(42,5,5,4,2,'2018-01-05','01/2018','16:00:00','20:00:00'),(43,5,5,19,1,'2018-01-01','01/2018','08:00:00','13:00:00'),(44,5,5,20,1,'2018-01-05','01/2018','08:00:00','13:00:00'),(13387,5,1,5,2,'2018-01-08','01/2018','16:00:00','20:00:00'),(13388,5,2,16,1,'2018-01-08','01/2018','08:00:00','13:00:00'),(13389,5,2,16,2,'2018-01-08','01/2018','16:00:00','20:00:00'),(13390,2,4,1,2,'2018-01-08','01/2018','16:00:00','20:00:00'),(13391,5,5,19,1,'2018-01-08','01/2018','08:00:00','13:00:00'),(13394,5,1,3,2,'2018-01-09','01/2018','16:00:00','20:00:00'),(13395,5,2,2,2,'2018-01-09','01/2018','16:00:00','20:00:00'),(13396,5,3,12,2,'2018-01-09','01/2018','16:00:00','20:00:00'),(13397,5,4,15,1,'2018-01-09','01/2018','08:00:00','13:00:00'),(13398,5,4,15,2,'2018-01-09','01/2018','16:00:00','20:00:00'),(13399,5,5,12,2,'2018-01-09','01/2018','16:00:00','20:00:00'),(13401,5,1,16,1,'2018-01-10','01/2018','08:00:00','13:00:00'),(13402,5,1,16,2,'2018-01-10','01/2018','16:00:00','20:00:00'),(13403,5,2,18,2,'2018-01-10','01/2018','16:00:00','20:00:00'),(13404,5,5,6,1,'2018-01-10','01/2018','08:00:00','13:00:00'),(13405,5,5,14,2,'2018-01-10','01/2018','16:00:00','20:00:00'),(13408,5,1,3,1,'2018-01-11','01/2018','08:00:00','13:00:00'),(13409,5,1,11,2,'2018-01-11','01/2018','16:00:00','20:00:00'),(13410,5,2,13,1,'2018-01-11','01/2018','08:00:00','13:00:00'),(13411,5,2,6,2,'2018-01-11','01/2018','16:00:00','20:00:00'),(13412,5,3,12,2,'2018-01-11','01/2018','16:00:00','20:00:00'),(13413,5,4,7,2,'2018-01-11','01/2018','16:00:00','20:00:00'),(13414,5,5,12,2,'2018-01-11','01/2018','16:00:00','20:00:00'),(13415,5,1,10,1,'2018-01-12','01/2018','08:00:00','13:00:00'),(13416,5,2,18,2,'2018-01-12','01/2018','16:00:00','20:00:00'),(13417,5,4,8,1,'2018-01-12','01/2018','08:00:00','13:00:00'),(13418,2,4,1,2,'2018-01-12','01/2018','16:00:00','20:00:00'),(13419,5,5,4,2,'2018-01-12','01/2018','16:00:00','20:00:00'),(13420,5,5,20,1,'2018-01-12','01/2018','08:00:00','13:00:00'),(13457,5,1,5,2,'2018-01-15','01/2018','16:00:00','20:00:00'),(13458,5,2,16,1,'2018-01-15','01/2018','08:00:00','13:00:00'),(13459,5,2,16,2,'2018-01-15','01/2018','16:00:00','20:00:00'),(13460,2,4,1,2,'2018-01-15','01/2018','16:00:00','20:00:00'),(13461,5,5,19,1,'2018-01-15','01/2018','08:00:00','13:00:00'),(13464,5,1,3,2,'2018-01-16','01/2018','16:00:00','20:00:00'),(13465,5,2,2,2,'2018-01-16','01/2018','16:00:00','20:00:00'),(13466,5,3,12,2,'2018-01-16','01/2018','16:00:00','20:00:00'),(13467,5,4,15,1,'2018-01-16','01/2018','08:00:00','13:00:00'),(13468,5,4,15,2,'2018-01-16','01/2018','16:00:00','20:00:00'),(13469,5,5,12,2,'2018-01-16','01/2018','16:00:00','20:00:00'),(13471,5,1,16,1,'2018-01-17','01/2018','08:00:00','13:00:00'),(13472,5,1,16,2,'2018-01-17','01/2018','16:00:00','20:00:00'),(13473,5,2,18,2,'2018-01-17','01/2018','16:00:00','20:00:00'),(13474,5,5,6,1,'2018-01-17','01/2018','08:00:00','13:00:00'),(13475,5,5,14,2,'2018-01-17','01/2018','16:00:00','20:00:00'),(13478,5,1,3,1,'2018-01-18','01/2018','08:00:00','13:00:00'),(13479,5,1,11,2,'2018-01-18','01/2018','16:00:00','20:00:00'),(13480,5,2,13,1,'2018-01-18','01/2018','08:00:00','13:00:00'),(13481,5,2,6,2,'2018-01-18','01/2018','16:00:00','20:00:00'),(13482,5,3,12,2,'2018-01-18','01/2018','16:00:00','20:00:00'),(13483,5,4,7,2,'2018-01-18','01/2018','16:00:00','20:00:00'),(13484,5,5,12,2,'2018-01-18','01/2018','16:00:00','20:00:00'),(13485,5,1,10,1,'2018-01-19','01/2018','08:00:00','13:00:00'),(13486,5,2,18,2,'2018-01-19','01/2018','16:00:00','20:00:00'),(13487,5,4,8,1,'2018-01-19','01/2018','08:00:00','13:00:00'),(13488,2,4,1,2,'2018-01-19','01/2018','16:00:00','20:00:00'),(13489,5,5,4,2,'2018-01-19','01/2018','16:00:00','20:00:00'),(13490,5,5,20,1,'2018-01-19','01/2018','08:00:00','13:00:00'),(13492,2,4,1,2,'2018-02-02','02/2018','16:00:00','20:00:00');

/*Table structure for table `alquiler` */

DROP TABLE IF EXISTS `alquiler`;

CREATE TABLE `alquiler` (
  `idAlquiler` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idProfesional` int(10) unsigned NOT NULL,
  `idConsultorio` int(10) unsigned NOT NULL,
  `Mes` int(11) DEFAULT NULL,
  `Anio` int(11) DEFAULT NULL,
  `Estado` varchar(30) DEFAULT NULL,
  `Importe` float DEFAULT NULL,
  `Descuento` float DEFAULT NULL,
  `Total` float DEFAULT NULL,
  `Recibo` varchar(30) DEFAULT NULL,
  `Periodo` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idAlquiler`),
  KEY `Alquiler_FKIndex1` (`idConsultorio`),
  KEY `Alquiler_FKIndex2` (`idProfesional`),
  CONSTRAINT `alquiler_ibfk_1` FOREIGN KEY (`idConsultorio`) REFERENCES `consultorios` (`idConsultorio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `alquiler_ibfk_2` FOREIGN KEY (`idProfesional`) REFERENCES `profesionales` (`idProfesional`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `alquiler` */

/*Table structure for table `consultorios` */

DROP TABLE IF EXISTS `consultorios`;

CREATE TABLE `consultorios` (
  `idConsultorio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `m2` float DEFAULT NULL,
  PRIMARY KEY (`idConsultorio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `consultorios` */

insert  into `consultorios`(`idConsultorio`,`Nombre`,`m2`) values (1,'Cons 1',12),(2,'Cons 2',12),(3,'Cons 3',12),(4,'Cons 4',12),(5,'Cons 5',12);

/*Table structure for table `especialidades` */

DROP TABLE IF EXISTS `especialidades`;

CREATE TABLE `especialidades` (
  `idEspecialidad` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `CostoMod` float DEFAULT NULL,
  PRIMARY KEY (`idEspecialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `especialidades` */

insert  into `especialidades`(`idEspecialidad`,`Nombre`,`CostoMod`) values (2,'Psicología',1250),(3,'Pediatría',NULL),(4,'Ginecolgía',NULL),(5,'Cardiología',NULL),(6,'Oftalmología',NULL),(7,'Otorrinolaringología',NULL),(8,'Musicoterapia',NULL),(9,'Psiquiatría',NULL),(10,'Kinesiología',NULL),(11,'Podología',NULL),(12,'Nutrición',NULL),(13,'Psicopedagogía',NULL),(14,'Cirugía',NULL);

/*Table structure for table `pacientes` */

DROP TABLE IF EXISTS `pacientes`;

CREATE TABLE `pacientes` (
  `idPaciente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idPrepaga` int(10) unsigned NOT NULL,
  `Apellido` varchar(100) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `FechaNac` date DEFAULT NULL,
  `Celular` varchar(50) DEFAULT NULL,
  `Mail` varchar(100) DEFAULT NULL,
  `FechaAlta` date DEFAULT NULL,
  `NroSocio` varchar(50) DEFAULT NULL,
  `DNI` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idPaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `pacientes` */

insert  into `pacientes`(`idPaciente`,`idPrepaga`,`Apellido`,`Nombre`,`FechaNac`,`Celular`,`Mail`,`FechaAlta`,`NroSocio`,`DNI`) values (1,2,'ESTEYBAR','GUSTAVO','1976-08-25','1138986069','gesteybar@arimex.com','2017-12-29','12345678/9',25356574),(3,1,'mansur','maria clara','1899-11-30','654654','','2018-01-03','24027210',24027210),(5,0,'Esteybar','Santiago','0000-00-00','','','2018-01-04','',50525794),(6,0,'Delgado','Marcelo','0000-00-00','1166546655','','2018-01-04','',0),(7,0,'rocchi','gaby','0000-00-00','','','2018-01-05','',0);

/*Table structure for table `paramagenda` */

DROP TABLE IF EXISTS `paramagenda`;

CREATE TABLE `paramagenda` (
  `idParamAgenda` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idProfesional` int(10) unsigned NOT NULL,
  `idEspecialidad` int(10) unsigned NOT NULL,
  `Modulo` int(10) unsigned DEFAULT NULL,
  `Sobreturnos` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idParamAgenda`),
  KEY `ParamAgenda_index3317` (`idProfesional`),
  KEY `ParamAgenda_index3318` (`idEspecialidad`),
  CONSTRAINT `paramagenda_ibfk_1` FOREIGN KEY (`idEspecialidad`) REFERENCES `especialidades` (`idEspecialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `paramagenda_ibfk_2` FOREIGN KEY (`idProfesional`) REFERENCES `profesionales` (`idProfesional`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `paramagenda` */

insert  into `paramagenda`(`idParamAgenda`,`idProfesional`,`idEspecialidad`,`Modulo`,`Sobreturnos`) values (1,1,2,20,0),(3,3,4,30,2),(5,10,5,35,1),(6,7,5,15,1),(7,16,5,10,1),(8,8,5,20,1),(9,15,5,12,1),(10,13,5,10,1),(11,5,5,25,1),(12,4,5,20,1),(13,9,5,30,1),(14,17,5,40,1),(15,12,5,50,1),(16,18,5,25,1),(17,11,5,30,1),(18,2,5,12,1),(19,6,5,15,1),(20,14,5,10,1),(21,19,5,5,1),(22,20,5,35,1);

/*Table structure for table `prepagas` */

DROP TABLE IF EXISTS `prepagas`;

CREATE TABLE `prepagas` (
  `idPrepaga` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idPrepaga`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `prepagas` */

insert  into `prepagas`(`idPrepaga`,`Nombre`) values (1,'PARTICULAR'),(2,'OSDE'),(3,'PAMI');

/*Table structure for table `profesionales` */

DROP TABLE IF EXISTS `profesionales`;

CREATE TABLE `profesionales` (
  `idProfesional` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `Matricula` varchar(10) DEFAULT NULL,
  `FechaVenc` date DEFAULT NULL,
  `DocCompleta` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProfesional`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `profesionales` */

insert  into `profesionales`(`idProfesional`,`Nombre`,`Matricula`,`FechaVenc`,`DocCompleta`) values (1,'maria clara mansur','16513','2010-01-01',1),(2,'Nusshold',NULL,NULL,NULL),(3,'Cuello',NULL,NULL,NULL),(4,'Torres',NULL,NULL,NULL),(5,'Longas',NULL,NULL,NULL),(6,'Pereira',NULL,NULL,NULL),(7,'Bucci',NULL,NULL,NULL),(8,'Cousido',NULL,NULL,NULL),(9,'Trimarco',NULL,NULL,NULL),(10,'Barreiro',NULL,NULL,NULL),(11,'Castiglione',NULL,NULL,NULL),(12,'Zampedri',NULL,NULL,NULL),(13,'Nieto',NULL,NULL,NULL),(14,'Enjuto',NULL,NULL,NULL),(15,'Pecchia',NULL,NULL,NULL),(16,'Flitt',NULL,NULL,NULL),(17,'Troilo',NULL,NULL,NULL),(18,'Wybert',NULL,NULL,NULL),(19,'Ramos','','1899-11-30',0),(20,'Ocupacional','','1899-11-30',0);

/*Table structure for table `turnos` */

DROP TABLE IF EXISTS `turnos`;

CREATE TABLE `turnos` (
  `idTurno` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idPaciente` int(10) unsigned NOT NULL,
  `idEspecialidad` int(10) unsigned NOT NULL,
  `idProfesional` int(10) unsigned NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` varchar(12) DEFAULT NULL,
  `Paciente` varchar(100) DEFAULT NULL,
  `DNI` varchar(15) DEFAULT NULL,
  `NroSocio` varchar(50) DEFAULT NULL,
  `Celular` varchar(50) DEFAULT NULL,
  `ApellidoPac` varchar(50) DEFAULT NULL,
  `Estado` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`idTurno`),
  KEY `Turnos_index3320` (`idEspecialidad`),
  KEY `Turnos_index3321` (`idProfesional`),
  CONSTRAINT `turnos_ibfk_1` FOREIGN KEY (`idProfesional`) REFERENCES `profesionales` (`idProfesional`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `turnos_ibfk_2` FOREIGN KEY (`idEspecialidad`) REFERENCES `especialidades` (`idEspecialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `turnos` */

insert  into `turnos`(`idTurno`,`idPaciente`,`idEspecialidad`,`idProfesional`,`Fecha`,`Hora`,`Paciente`,`DNI`,`NroSocio`,`Celular`,`ApellidoPac`,`Estado`) values (5,0,5,18,'2018-01-03','16:00:00','gustavo a','','','1150051111','','PENDIENTE'),(6,0,5,6,'2018-01-03','10:00:00','Clara','24027210','','561651663','Mansur','PENDIENTE'),(7,0,5,6,'2018-01-03','11:00:00','Pilar','35142136','','651698466','happn','PENDIENTE'),(8,0,5,6,'2018-01-03','09:00:00','Claudio','21358165','','165165433','Novak','PENDIENTE'),(10,2,5,14,'2018-01-03','17:40:00','gus','25356574','','1138986069','esteybar','PENDIENTE'),(11,3,5,14,'2018-01-03','16:50:00','maria clara','16165','','654654','mansur','PENDIENTE'),(12,3,5,6,'2018-01-03','08:30:00','maria clara','16165','','654654','mansur','PENDIENTE'),(13,1,5,6,'2018-01-04','17:30:00','GUSTAVO','25356574','12345678/9','1138986069','ESTEYBAR','PENDIENTE'),(16,1,2,1,'2018-01-05','10:00:00','GUSTAVO','25356574','12345678/9','1138986069','ESTEYBAR','TOMADO'),(18,7,5,10,'2018-01-05','08:00:00','gaby','0','','','rocchi','PENDIENTE');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idUsuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `Login` varchar(30) DEFAULT NULL,
  `Pass` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idUsuario`,`Nombre`,`Login`,`Pass`) values (1,'administrador','admin','e10adc3949ba59abbe56e057f20f883e');

/* Procedure structure for procedure `SP_BuscarPaciente` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_BuscarPaciente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BuscarPaciente`(pTipo varchar(1), pNro varchar(60), pNombre varchar(60))
BEGIN
	IF pTipo='H' THEN
		SELECT pa.idPaciente, pa.Apellido, pa.Nombre, pr.Nombre Prepaga, pa.NroSocio, pa.Celular, pa.Mail 
		FROM pacientes pa LEFT JOIN prepagas pr ON pa.idPrepaga=pr.idPrepaga WHERE idPaciente=pNro;
	END IF;
	
	if pTipo='D' then
		SELECT pa.idPaciente, pa.Apellido, pa.Nombre, pr.Nombre Prepaga, pa.NroSocio, pa.Celular, pa.Mail 
		FROM pacientes pa left join prepagas pr on pa.idPrepaga=pr.idPrepaga WHERE DNI=pNro;
	end if;
	if pTipo='S' then
		SELECT pa.idPaciente, pa.Apellido, pa.Nombre, pr.Nombre Prepaga, pa.NroSocio, pa.Celular, pa.Mail 
		FROM pacientes pa LEFT JOIN prepagas pr ON pa.idPrepaga=pr.idPrepaga
		WHERE NroSocio=pNro and pa.idPrepaga=pNombre;
	end if;
	if pTipo='N' then
		if ifnull(pNombre, '')='' then
			SELECT pa.idPaciente, pa.Apellido, pa.Nombre, pr.Nombre Prepaga, pa.NroSocio, pa.Celular, pa.Mail 
			FROM pacientes pa LEFT JOIN prepagas pr ON pa.idPrepaga=pr.idPrepaga
			WHERE Apellido LIKE CONCAT('%', pNro, '%');		
		else
			SELECT pa.idPaciente, pa.Apellido, pa.Nombre, pr.Nombre Prepaga, pa.NroSocio, pa.Celular, pa.Mail 
			FROM pacientes pa LEFT JOIN prepagas pr ON pa.idPrepaga=pr.idPrepaga
			where Apellido like concat('%', pNro, '%') and pa.Nombre LIKE CONCAT('%', pNombre, '%');
		end if;
	end if;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_InsertAgenda` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_InsertAgenda` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertAgenda`(pEsp int, pProf int, pCons int, pMod int, pFecha varchar(20), pPeriodo varchar(7))
BEGIN
	if exists(select 1 from agenda where Fecha=pFecha and Turno=pMod and idConsultorio=pCons) then
		delete FROM agenda WHERE Fecha=pFecha AND Turno=pMod AND idConsultorio=pCons;
	end if;
	
	insert into agenda (idEspecialidad, idConsultorio, idProfesional, Turno, Fecha, Periodo) values (
		pEsp, pCons, pProf, pMod, str_to_date(pFecha,'%d/%m/%Y'),pPeriodo);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_InsertConsultorio` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_InsertConsultorio` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertConsultorio`(pid integer, pNombre varchar(100), pSup float)
BEGIN
	if exists(select 1 from consultorios where idConsultorio=pid) then
		update consultorios set Nombre=pNombre, m2=pSup where idConsultorio=pid;
	else
		insert into consultorios (Nombre, m2) values (pNombre, pSup);
	end if;
		
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_InsertEspec` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_InsertEspec` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertEspec`(pid INTEGER, pNombre VARCHAR(100), pCostoMod float)
BEGIN
	IF EXISTS(SELECT 1 FROM especialidades WHERE idEspecialidad=pid) THEN
		UPDATE especialidades SET Nombre=pNombre, CostoMod=pCostoMod WHERE idEspecialidad=pid;
	ELSE
		INSERT INTO especialidades (Nombre, CostoMod) VALUES (pNombre, pCostoMod);
	END IF;
		
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_InsertPaciente` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_InsertPaciente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertPaciente`(pidPaciente int, pidPrepaga int, pApellido varchar(50), pNombre varchar(50), pFechaNac varchar(12), pCelular varchar(50), pMail varchar(100), pNroSocio varchar(30), pDNI varchar(20))
BEGIN
	if exists(select 1 from pacientes where idPaciente=pidPaciente) then
		update pacientes set Apellido=pApellido, Nombre=pNombre, idPrepaga=pidPrepaga,FechaNac= pFechaNac, Celular=pCelular, Mail=pMail, NroSocio=pNroSocio, DNI=pDNI
		where idPaciente=pidPaciente;
	else
		insert into pacientes (idPrepaga, Apellido, Nombre, FechaNac, Celular, Mail, FechaAlta, NroSocio, DNI) values (
		pidPrepaga, pApellido, pNombre, pFechaNac, pCelular, pMail, now(), pNroSocio, pDNI);
	end if;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_InsertProf` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_InsertProf` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertProf`(pid INTEGER, pNombre VARCHAR(100), pMatricula varchar(10), pFechaVenc date, pDocComp int)
BEGIN
	IF EXISTS(SELECT 1 FROM profesionales WHERE idProfesional=pid) THEN
		UPDATE profesionales SET Nombre=pNombre, Matricula=pMatricula, FechaVenc=pFechaVenc, DocCompleta=pDocComp WHERE idProfesional=pid;
	ELSE
		INSERT INTO profesionales (Nombre, Matricula, FechaVenc, DocCompleta) VALUES (pNombre, pMatricula, pFechaVenc, pDocComp);
	END IF;
		
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_InsertTurno` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_InsertTurno` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertTurno`(pTurno int, pidPaciente int, pidEspec int, pidProf int, pFecha varchar(12), pHora varchar(10), 
					pNombre varchar(100), pApellido varchar(100), pDNI varchar(20), pSocio varchar(30), pCelular varchar(50), pEstado varchar(40))
BEGIN
	declare vEspec int;
	
	if pidEspec=0 then
		select idEspecialidad into vEspec from agenda where Fecha=pFecha and idProfesional=pidProf limit 1;
	else
		set vEspec=pidEspec;
	end if;
	
	if exists(select 1 from pacientes where idPaciente=pidPaciente) then
		select Nombre, Apellido, DNI, NroSocio, Celular into pNombre, pApellido, pDNI, pSocio, pCelular from pacientes where idPaciente=pidPaciente;
	end if;
	
	if exists(select 1 from Turnos where idTurno=pTurno) then
		delete from turnos where idTurno=pTurno;
	end if;
	
	insert into turnos (idPaciente, idEspecialidad, idProfesional, Fecha, Hora, Paciente, ApellidoPac, DNI, NroSocio, Celular, Estado) values (
			pidPaciente, vEspec, pidProf, pFecha, pHora, pNombre, pApellido, pDNI, pSocio, pCelular, pEstado);
			
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_InsertUser` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_InsertUser` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertUser`(pid integer, pNombre varchar(100), pLogin varchar(30), pPass varchar(32))
BEGIN
	if exists(select 1 from usuarios where idUsuario=pid) then
		update usuarios set Nombre=pNombre, Login=pLogin where idUsuario=pid;
		if pPass is not null then
			update Usuarios set Pass=pPass where idUsuario=pid;
		end if;
	else
		insert into Usuarios (Nombre, Login, Pass) values (pNombre, pLogin, pPass);
	end if;
		
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_LeerTurnos` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_LeerTurnos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LeerTurnos`(pFecha varchar(15), pProf int)
BEGIN
	declare vHoraI varchar(10);
	declare vHoraF varchar(10);
	declare vFechaI datetime;
	declare vFechaF datetime;
	declare vModulo int;
	declare vI1 int;
	declare vI2 int;
	
	drop table if exists tmpturnos;
	create temporary table tmpturnos (idTurno int, Hora varchar(10), idPaciente int, Paciente varchar(100), idEspecialidad int, Especialidad varchar(50), DNI int, Celular varchar(50), Estado varchar(40));
	
	select min(Turno), max(Turno) into vI1, vI2 from agenda  WHERE idProfesional=pProf AND Fecha=pFecha;
	
	while (vI1<=vI2) do
	
		select HoraInicio, HoraFin into vHoraI, vHoraF from agenda where idProfesional=pProf and Fecha=pFecha and Turno=vI1 limit 1;
		
		set vFechaI=convert(concat(pFecha, ' ', vHoraI), datetime);
		set vFechaF=convert(concat(pFecha, ' ', vHoraF), datetime);
		select Modulo into vModulo from paramagenda where idProfesional=pProf limit 1;
		
		/*select vFechaI, vFechaF;*/
		while (vFechaI<vFechaF) do
			set vHoraF=DATE_FORMAT(DATE_ADD(vFechaI, INTERVAL vModulo MINUTE), '%H:%i:%s');
			
			if exists(select 1 from turnos where  idProfesional=pProf AND Hora >= vHoraI AND Hora < vHoraF) then
				insert into tmpturnos (
				select idTurno, Hora, idPaciente, concat(Paciente,' ', ApellidoPac) Paciente, idEspecialidad, '', DNI, Celular, Estado from Turnos where idProfesional=pProf
				and Hora between vHoraI and vHoraF);
			else 
				insert into tmpTurnos values (null,vHoraI, null,null,null,null,null,null, 'DISPONIBLE');
			end if;
			
			set vFechaI=date_add(vFechaI, interval vModulo minute);
			set vHoraI=DATE_FORMAT(vFechaI, '%H:%i:%s');
		end while;
		
		set vI1=vI1+1;
		
	end while;
	select * from tmpTurnos order by Hora asc;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_ReplicarAgenda` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_ReplicarAgenda` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ReplicarAgenda`(pDiaActual varchar(15), pTipo varchar(3))
BEGIN
	declare vFecha date;
	declare vHoy int;
	declare vDif int;
	declare vNextDate date;
	
	set vFecha=(select str_to_date(pDiaActual, '%Y-%m-%d'));
	select dayofweek(vFecha) into vHoy;
	if pTipo='SEM' then
		/*Se copia la semana siguiente a la fecha actual*/
		set vDif=8-vHoy;
		set vNextDate=date_add(vFecha, INTERVAL vDif+1 day);
		/*select vNextDate;*/
		start transaction;
		delete from agenda where Fecha between vNextDate and date_add(vNextDate, interval 7 day);
		while (weekday(vNextDate)<6) do
			insert into agenda (idEspecialidad, idConsultorio, idProfesional, Turno, Fecha, Periodo) 
			(select idEspecialidad, idConsultorio, idProfesional, Turno, vNextDate, DATE_FORMAT(vNextDate, '%m/%Y') 
			from agenda where Fecha=date_add(vNextDate, interval -7 day));
			
			select date_add(vNextDate, interval 1 day) into vNextDate;
		end while;
		commit;
	end if;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
