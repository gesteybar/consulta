/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.21-MariaDB : Database - consulta
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
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
  PRIMARY KEY (`idAgenda`),
  KEY `Agenda_FKIndex1` (`idProfesional`),
  KEY `Agenda_FKIndex2` (`idConsultorio`),
  KEY `Agenda_FKIndex3` (`idEspecialidad`),
  CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`idProfesional`) REFERENCES `profesionales` (`idProfesional`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`idConsultorio`) REFERENCES `consultorios` (`idConsultorio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `agenda_ibfk_3` FOREIGN KEY (`idEspecialidad`) REFERENCES `especialidades` (`idEspecialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `agenda` */

insert  into `agenda`(`idAgenda`,`idEspecialidad`,`idConsultorio`,`idProfesional`,`Turno`,`Fecha`,`Periodo`) values (5,2,1,2,1,'2017-11-15','11/2017'),(6,2,1,1,1,'2017-11-15','11/2017'),(7,2,1,1,1,'2017-11-15','11/2017'),(8,2,2,1,1,'2017-11-15','11/2017'),(9,2,2,1,1,'2017-11-23','11/2017'),(10,2,2,1,2,'2017-11-10','11/2017'),(11,2,2,1,1,'2017-11-10','11/2017'),(12,2,2,1,2,'2017-11-04','11/2017'),(13,2,2,1,2,'2017-11-20','11/2017'),(14,2,2,2,1,'2017-11-06','11/2017'),(15,2,2,2,2,'2017-11-13','11/2017'),(16,2,2,2,2,'2017-11-24','11/2017'),(17,2,2,2,2,'2017-11-23','11/2017'),(18,2,2,2,2,'2017-11-15','11/2017'),(19,2,2,2,1,'2017-11-04','11/2017'),(20,2,2,1,1,'2017-11-07','11/2017'),(21,2,1,1,2,'2017-11-15','11/2017'),(22,2,1,2,1,'2017-11-16','11/2017'),(23,2,1,2,2,'2017-11-16','11/2017'),(24,10,2,12,2,'2017-11-30','11/2017'),(25,10,2,10,1,'2017-11-30','11/2017');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `consultorios` */

insert  into `consultorios`(`idConsultorio`,`Nombre`,`m2`) values (1,'Consultorio_1',12),(2,'Cons 2',12);

/*Table structure for table `especialidades` */

DROP TABLE IF EXISTS `especialidades`;

CREATE TABLE `especialidades` (
  `idEspecialidad` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `CostoMod` float DEFAULT NULL,
  PRIMARY KEY (`idEspecialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `especialidades` */

insert  into `especialidades`(`idEspecialidad`,`Nombre`,`CostoMod`) values (2,'Psicología',1250),(3,'Dermatología',1250),(4,'Ginecología',1250),(5,'Traumatología',1250),(6,'Otorrino',1250),(7,'Homeopatía',800),(8,'Nutrición',0),(9,'Psiquiatría',0),(10,'Musicoterapia',0),(11,'Psicopedagogía',0),(12,'Pediatría',0),(13,'Kinesiología',0),(14,'Cirugía',0),(15,'Cardiología',0),(16,'Pología',0),(17,'Oftalmología',0);

/*Table structure for table `profesionales` */

DROP TABLE IF EXISTS `profesionales`;

CREATE TABLE `profesionales` (
  `idProfesional` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `Matricula` varchar(10) DEFAULT NULL,
  `FechaVenc` date DEFAULT NULL,
  `DocCompleta` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProfesional`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `profesionales` */

insert  into `profesionales`(`idProfesional`,`Nombre`,`Matricula`,`FechaVenc`,`DocCompleta`) values (1,'Mansur Maria Clara','25215','2010-01-01',1),(2,'Nusshold','46854','2020-11-30',0),(3,'Cuello','','1899-11-30',0),(4,'Longas','','1899-11-30',0),(5,'Pereira','','1899-11-30',0),(6,'Bucci','','1899-11-30',0),(7,'Cousido','','1899-11-30',0),(8,'Trimarco Laura','','1899-11-30',0),(9,'Barreiro Laura','','1899-11-30',0),(10,'Castigione Luciano','','1899-11-30',0),(11,'Zampedri','','1899-11-30',0),(12,'Nieto','','1899-11-30',0),(13,'Enjuto','','1899-11-30',0),(14,'Pecchia','','1899-11-30',0),(15,'Flitt','','1899-11-30',0),(16,'Troilo Martha','','1899-11-30',0),(17,'Wybert Augusto','','1899-11-30',0);

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

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
