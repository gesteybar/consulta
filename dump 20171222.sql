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
  KEY `agenda_FKIndex1` (`idConsultorio`),
  KEY `agenda_FKIndex2` (`idEspecialidad`),
  KEY `agenda_FKIndex3` (`idProfesional`),
  CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`idProfesional`) REFERENCES `profesionales` (`idProfesional`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`idConsultorio`) REFERENCES `consultorios` (`idConsultorio`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `agenda_ibfk_3` FOREIGN KEY (`idEspecialidad`) REFERENCES `especialidades` (`idEspecialidad`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15220 DEFAULT CHARSET=latin1;

/*Data for the table `agenda` */

insert  into `agenda`(`idAgenda`,`idEspecialidad`,`idConsultorio`,`idProfesional`,`Turno`,`Fecha`,`Periodo`,`HoraInicio`,`HoraFin`) values (1,5,1,10,1,'2017-11-01','11/2017','08:00:00','13:00:00'),(2,5,1,7,1,'2017-11-02','11/2017','08:00:00','13:00:00'),(3,5,1,16,2,'2017-11-03','11/2017','16:00:00','20:00:00'),(4,5,1,8,1,'2017-11-04','11/2017','08:00:00','13:00:00'),(5,5,1,15,2,'2017-11-04','11/2017','16:00:00','20:00:00'),(16,5,1,5,2,'2018-01-01','01/2018','16:00:00','20:00:00'),(17,5,1,3,2,'2018-01-02','01/2018','16:00:00','20:00:00'),(18,5,1,16,1,'2018-01-03','01/2018','08:00:00','13:00:00'),(19,5,1,16,2,'2018-01-03','01/2018','16:00:00','20:00:00'),(20,5,1,3,1,'2018-01-04','01/2018','08:00:00','13:00:00'),(21,5,1,11,2,'2018-01-04','01/2018','16:00:00','20:00:00'),(22,5,1,10,1,'2018-01-05','01/2018','08:00:00','13:00:00'),(23,5,2,16,1,'2018-01-01','01/2018','08:00:00','13:00:00'),(24,5,2,16,2,'2018-01-01','01/2018','16:00:00','20:00:00'),(25,5,2,2,2,'2018-01-02','01/2018','16:00:00','20:00:00'),(26,5,2,18,2,'2018-01-03','01/2018','16:00:00','20:00:00'),(27,5,2,13,1,'2018-01-04','01/2018','08:00:00','13:00:00'),(28,5,2,6,2,'2018-01-04','01/2018','16:00:00','20:00:00'),(29,5,2,18,2,'2018-01-05','01/2018','16:00:00','20:00:00'),(30,5,3,12,2,'2018-01-02','01/2018','16:00:00','20:00:00'),(31,5,3,12,2,'2018-01-04','01/2018','16:00:00','20:00:00'),(32,2,4,1,2,'2018-01-01','01/2018','16:00:00','20:00:00'),(33,5,4,15,1,'2018-01-02','01/2018','08:00:00','13:00:00'),(34,5,4,15,2,'2018-01-02','01/2018','16:00:00','20:00:00'),(35,5,4,7,2,'2018-01-04','01/2018','16:00:00','20:00:00'),(36,5,4,8,1,'2018-01-05','01/2018','08:00:00','13:00:00'),(37,2,4,1,2,'2018-01-05','01/2018','08:00:00','20:00:00'),(39,5,5,6,1,'2018-01-03','01/2018','08:00:00','13:00:00'),(40,5,5,14,2,'2018-01-03','01/2018','16:00:00','20:00:00'),(41,5,5,12,2,'2018-01-04','01/2018','16:00:00','20:00:00'),(42,5,5,4,2,'2018-01-05','01/2018','16:00:00','20:00:00'),(13387,5,1,5,2,'2018-01-08','01/2018','16:00:00','20:00:00'),(13388,5,2,16,1,'2018-01-08','01/2018','08:00:00','13:00:00'),(13389,5,2,16,2,'2018-01-08','01/2018','16:00:00','20:00:00'),(13390,2,4,1,2,'2018-01-08','01/2018','16:00:00','20:00:00'),(13394,5,1,3,2,'2018-01-09','01/2018','16:00:00','20:00:00'),(13395,5,2,2,2,'2018-01-09','01/2018','16:00:00','20:00:00'),(13396,5,3,12,2,'2018-01-09','01/2018','16:00:00','20:00:00'),(13397,5,4,15,1,'2018-01-09','01/2018','08:00:00','13:00:00'),(13398,5,4,15,2,'2018-01-09','01/2018','16:00:00','20:00:00'),(13401,5,1,16,1,'2018-01-10','01/2018','08:00:00','13:00:00'),(13402,5,1,16,2,'2018-01-10','01/2018','16:00:00','20:00:00'),(13403,5,2,18,2,'2018-01-10','01/2018','16:00:00','20:00:00'),(13404,5,5,6,1,'2018-01-10','01/2018','08:00:00','13:00:00'),(13405,5,5,14,2,'2018-01-10','01/2018','16:00:00','20:00:00'),(13408,5,1,3,1,'2018-01-11','01/2018','08:00:00','13:00:00'),(13409,5,1,11,2,'2018-01-11','01/2018','16:00:00','20:00:00'),(13410,5,2,13,1,'2018-01-11','01/2018','08:00:00','13:00:00'),(13411,5,2,6,2,'2018-01-11','01/2018','16:00:00','20:00:00'),(13412,5,3,12,2,'2018-01-11','01/2018','16:00:00','20:00:00'),(13413,5,4,7,2,'2018-01-11','01/2018','16:00:00','20:00:00'),(13414,5,5,12,2,'2018-01-11','01/2018','16:00:00','20:00:00'),(13415,5,1,10,1,'2018-01-12','01/2018','08:00:00','13:00:00'),(13416,5,2,18,2,'2018-01-12','01/2018','16:00:00','20:00:00'),(13417,5,4,8,1,'2018-01-12','01/2018','08:00:00','13:00:00'),(13418,2,4,1,2,'2018-01-12','01/2018','16:00:00','20:00:00'),(13419,5,5,4,2,'2018-01-12','01/2018','16:00:00','20:00:00'),(13457,5,1,5,2,'2018-01-15','01/2018','16:00:00','20:00:00'),(13458,5,2,16,1,'2018-01-15','01/2018','08:00:00','13:00:00'),(13459,5,2,16,2,'2018-01-15','01/2018','16:00:00','20:00:00'),(13460,2,4,1,2,'2018-01-15','01/2018','16:00:00','20:00:00'),(13464,5,1,3,2,'2018-01-16','01/2018','16:00:00','20:00:00'),(13465,5,2,2,2,'2018-01-16','01/2018','16:00:00','20:00:00'),(13466,5,3,12,2,'2018-01-16','01/2018','16:00:00','20:00:00'),(13467,5,4,15,1,'2018-01-16','01/2018','08:00:00','13:00:00'),(13468,5,4,15,2,'2018-01-16','01/2018','16:00:00','20:00:00'),(13471,5,1,16,1,'2018-01-17','01/2018','08:00:00','13:00:00'),(13472,5,1,16,2,'2018-01-17','01/2018','16:00:00','20:00:00'),(13473,5,2,18,2,'2018-01-17','01/2018','16:00:00','20:00:00'),(13474,5,5,6,1,'2018-01-17','01/2018','08:00:00','13:00:00'),(13475,5,5,14,2,'2018-01-17','01/2018','16:00:00','20:00:00'),(13478,5,1,3,1,'2018-01-18','01/2018','08:00:00','13:00:00'),(13479,5,1,11,2,'2018-01-18','01/2018','16:00:00','20:00:00'),(13480,5,2,13,1,'2018-01-18','01/2018','08:00:00','13:00:00'),(13481,5,2,6,2,'2018-01-18','01/2018','16:00:00','20:00:00'),(13482,5,3,12,2,'2018-01-18','01/2018','16:00:00','20:00:00'),(13483,5,4,7,2,'2018-01-18','01/2018','16:00:00','20:00:00'),(13484,5,5,12,2,'2018-01-18','01/2018','16:00:00','20:00:00'),(13485,5,1,10,1,'2018-01-19','01/2018','08:00:00','13:00:00'),(13486,5,2,18,2,'2018-01-19','01/2018','16:00:00','20:00:00'),(13487,5,4,8,1,'2018-01-19','01/2018','08:00:00','13:00:00'),(13488,2,4,1,2,'2018-01-19','01/2018','16:00:00','20:00:00'),(13489,5,5,4,2,'2018-01-19','01/2018','16:00:00','20:00:00'),(13734,5,1,5,2,'2018-01-22','01/2018','16:00:00','20:00:00'),(13735,5,2,16,1,'2018-01-22','01/2018','08:00:00','13:00:00'),(13736,5,2,16,2,'2018-01-22','01/2018','16:00:00','20:00:00'),(13737,2,4,1,2,'2018-01-22','01/2018','16:00:00','20:00:00'),(13741,5,1,3,2,'2018-01-23','01/2018','16:00:00','20:00:00'),(13742,5,2,2,2,'2018-01-23','01/2018','16:00:00','20:00:00'),(13743,5,3,12,2,'2018-01-23','01/2018','16:00:00','20:00:00'),(13744,5,4,15,1,'2018-01-23','01/2018','08:00:00','13:00:00'),(13745,5,4,15,2,'2018-01-23','01/2018','16:00:00','20:00:00'),(13748,5,1,16,1,'2018-01-24','01/2018','08:00:00','13:00:00'),(13749,5,1,16,2,'2018-01-24','01/2018','16:00:00','20:00:00'),(13750,5,2,18,2,'2018-01-24','01/2018','16:00:00','20:00:00'),(13751,5,5,6,1,'2018-01-24','01/2018','08:00:00','13:00:00'),(13752,5,5,14,2,'2018-01-24','01/2018','16:00:00','20:00:00'),(13755,5,1,3,1,'2018-01-25','01/2018','08:00:00','13:00:00'),(13756,5,1,11,2,'2018-01-25','01/2018','16:00:00','20:00:00'),(13757,5,2,13,1,'2018-01-25','01/2018','08:00:00','13:00:00'),(13758,5,2,6,2,'2018-01-25','01/2018','16:00:00','20:00:00'),(13759,5,3,12,2,'2018-01-25','01/2018','16:00:00','20:00:00'),(13760,5,4,7,2,'2018-01-25','01/2018','16:00:00','20:00:00'),(13761,5,5,12,2,'2018-01-25','01/2018','16:00:00','20:00:00'),(13762,5,1,10,1,'2018-01-26','01/2018','08:00:00','13:00:00'),(13763,5,2,18,2,'2018-01-26','01/2018','16:00:00','20:00:00'),(13764,5,4,8,1,'2018-01-26','01/2018','08:00:00','13:00:00'),(13765,2,4,1,2,'2018-01-26','01/2018','16:00:00','20:00:00'),(13766,5,5,4,2,'2018-01-26','01/2018','16:00:00','20:00:00'),(14615,1,5,12,2,'2018-02-01','02/2018','16:00:00','20:00:00'),(14616,1,3,12,2,'2018-02-01','02/2018','16:00:00','20:00:00'),(14617,1,1,11,2,'2018-02-01','02/2018','16:00:00','20:00:00'),(14618,1,1,3,1,'2018-02-01','02/2018','08:00:00','12:00:00'),(14619,1,2,13,1,'2018-02-01','02/2018','08:00:00','12:00:00'),(14620,1,2,17,2,'2018-02-01','02/2018','16:00:00','20:00:00'),(14621,1,4,7,2,'2018-02-01','02/2018','16:00:00','20:00:00'),(14622,1,4,1,2,'2018-02-02','02/2018','16:00:00','20:00:00'),(14623,1,2,18,2,'2018-02-02','02/2018','16:00:00','20:00:00'),(14625,1,4,8,1,'2018-02-02','02/2018','08:00:00','12:00:00'),(14626,1,5,10,1,'2018-02-02','02/2018','08:00:00','12:00:00'),(14627,1,5,4,2,'2018-02-02','02/2018','16:00:00','20:00:00'),(14629,1,4,1,2,'2018-02-05','02/2018','16:00:00','20:00:00'),(14630,1,1,5,2,'2018-02-05','02/2018','16:00:00','20:00:00'),(14631,1,2,16,1,'2018-02-05','02/2018','08:00:00','12:00:00'),(14632,1,2,16,2,'2018-02-05','02/2018','16:00:00','20:00:00'),(14636,1,1,3,1,'2018-02-06','02/2018','08:00:00','12:00:00'),(14637,1,2,2,2,'2018-02-06','02/2018','16:00:00','20:00:00'),(14638,1,3,12,2,'2018-02-06','02/2018','16:00:00','20:00:00'),(14639,1,5,12,2,'2018-02-06','02/2018','16:00:00','20:00:00'),(14640,1,4,15,1,'2018-02-06','02/2018','08:00:00','12:00:00'),(14641,1,4,15,2,'2018-02-06','02/2018','16:00:00','20:00:00'),(14643,1,1,16,1,'2018-02-07','02/2018','08:00:00','12:00:00'),(14644,1,1,16,2,'2018-02-07','02/2018','16:00:00','20:00:00'),(14645,1,2,18,2,'2018-02-07','02/2018','16:00:00','20:00:00'),(14646,1,5,6,1,'2018-02-07','02/2018','08:00:00','12:00:00'),(14647,1,5,14,2,'2018-02-07','02/2018','16:00:00','20:00:00'),(14650,1,5,12,2,'2018-02-08','02/2018','16:00:00','20:00:00'),(14651,1,3,12,2,'2018-02-08','02/2018','16:00:00','20:00:00'),(14652,1,1,11,2,'2018-02-08','02/2018','16:00:00','20:00:00'),(14653,1,1,3,1,'2018-02-08','02/2018','08:00:00','12:00:00'),(14654,1,2,13,1,'2018-02-08','02/2018','08:00:00','12:00:00'),(14655,1,2,17,2,'2018-02-08','02/2018','16:00:00','20:00:00'),(14656,1,4,7,2,'2018-02-08','02/2018','16:00:00','20:00:00'),(14657,1,4,1,2,'2018-02-09','02/2018','16:00:00','20:00:00'),(14658,1,2,18,2,'2018-02-09','02/2018','16:00:00','20:00:00'),(14660,1,4,8,1,'2018-02-09','02/2018','08:00:00','12:00:00'),(14661,1,5,10,1,'2018-02-09','02/2018','08:00:00','12:00:00'),(14662,1,5,4,2,'2018-02-09','02/2018','16:00:00','20:00:00'),(14664,1,4,1,2,'2018-02-12','02/2018','16:00:00','20:00:00'),(14665,1,1,5,2,'2018-02-12','02/2018','16:00:00','20:00:00'),(14666,1,2,16,1,'2018-02-12','02/2018','08:00:00','12:00:00'),(14667,1,2,16,2,'2018-02-12','02/2018','16:00:00','20:00:00'),(14671,1,1,3,1,'2018-02-13','02/2018','08:00:00','12:00:00'),(14672,1,2,2,2,'2018-02-13','02/2018','16:00:00','20:00:00'),(14673,1,3,12,2,'2018-02-13','02/2018','16:00:00','20:00:00'),(14674,1,5,12,2,'2018-02-13','02/2018','16:00:00','20:00:00'),(14675,1,4,15,1,'2018-02-13','02/2018','08:00:00','12:00:00'),(14676,1,4,15,2,'2018-02-13','02/2018','16:00:00','20:00:00'),(14678,1,1,16,1,'2018-02-14','02/2018','08:00:00','12:00:00'),(14679,1,1,16,2,'2018-02-14','02/2018','16:00:00','20:00:00'),(14680,1,2,18,2,'2018-02-14','02/2018','16:00:00','20:00:00'),(14681,1,5,6,1,'2018-02-14','02/2018','08:00:00','12:00:00'),(14682,1,5,14,2,'2018-02-14','02/2018','16:00:00','20:00:00'),(14685,1,5,12,2,'2018-02-15','02/2018','16:00:00','20:00:00'),(14686,1,3,12,2,'2018-02-15','02/2018','16:00:00','20:00:00'),(14687,1,1,11,2,'2018-02-15','02/2018','16:00:00','20:00:00'),(14688,1,1,3,1,'2018-02-15','02/2018','08:00:00','12:00:00'),(14689,1,2,13,1,'2018-02-15','02/2018','08:00:00','12:00:00'),(14690,1,2,17,2,'2018-02-15','02/2018','16:00:00','20:00:00'),(14691,1,4,7,2,'2018-02-15','02/2018','16:00:00','20:00:00'),(14692,1,4,1,2,'2018-02-16','02/2018','16:00:00','20:00:00'),(14693,1,2,18,2,'2018-02-16','02/2018','16:00:00','20:00:00'),(14695,1,4,8,1,'2018-02-16','02/2018','08:00:00','12:00:00'),(14696,1,5,10,1,'2018-02-16','02/2018','08:00:00','12:00:00'),(14697,1,5,4,2,'2018-02-16','02/2018','16:00:00','20:00:00'),(14699,1,4,1,2,'2018-02-19','02/2018','16:00:00','20:00:00'),(14700,1,1,5,2,'2018-02-19','02/2018','16:00:00','20:00:00'),(14701,1,2,16,1,'2018-02-19','02/2018','08:00:00','12:00:00'),(14702,1,2,16,2,'2018-02-19','02/2018','16:00:00','20:00:00'),(14706,1,1,3,1,'2018-02-20','02/2018','08:00:00','12:00:00'),(14707,1,2,2,2,'2018-02-20','02/2018','16:00:00','18:00:00'),(14708,1,3,12,2,'2018-02-20','02/2018','16:00:00','20:00:00'),(14709,1,5,12,2,'2018-02-20','02/2018','16:00:00','20:00:00'),(14710,1,4,15,1,'2018-02-20','02/2018','08:00:00','12:00:00'),(14711,1,4,15,2,'2018-02-20','02/2018','16:00:00','20:00:00'),(14715,1,2,18,2,'2018-02-21','02/2018','16:00:00','20:00:00'),(14716,1,5,6,1,'2018-02-21','02/2018','08:00:00','12:00:00'),(14717,1,5,14,2,'2018-02-21','02/2018','16:00:00','20:00:00'),(14720,1,5,12,2,'2018-02-22','02/2018','16:00:00','20:00:00'),(14721,1,3,12,2,'2018-02-22','02/2018','16:00:00','20:00:00'),(14722,1,1,11,2,'2018-02-22','02/2018','16:00:00','20:00:00'),(14723,1,1,3,1,'2018-02-22','02/2018','08:00:00','12:00:00'),(14724,1,2,13,1,'2018-02-22','02/2018','08:00:00','12:00:00'),(14725,1,2,17,2,'2018-02-22','02/2018','16:00:00','20:00:00'),(14726,1,4,7,2,'2018-02-22','02/2018','16:00:00','20:00:00'),(14727,1,4,1,2,'2018-02-23','02/2018','16:00:00','20:00:00'),(14728,1,2,18,2,'2018-02-23','02/2018','16:00:00','20:00:00'),(14730,1,4,8,1,'2018-02-23','02/2018','08:00:00','12:00:00'),(14731,1,5,10,1,'2018-02-23','02/2018','08:00:00','12:00:00'),(14732,1,5,4,2,'2018-02-23','02/2018','16:00:00','20:00:00'),(14734,1,4,1,2,'2018-02-26','02/2018','16:00:00','20:00:00'),(14735,1,1,5,2,'2018-02-26','02/2018','16:00:00','20:00:00'),(14736,1,2,16,1,'2018-02-26','02/2018','08:00:00','12:00:00'),(14737,1,2,16,2,'2018-02-26','02/2018','16:00:00','20:00:00'),(14741,1,1,3,1,'2018-02-27','02/2018','08:00:00','12:00:00'),(14742,1,2,2,2,'2018-02-27','02/2018','16:00:00','20:00:00'),(14743,1,3,12,2,'2018-02-27','02/2018','16:00:00','20:00:00'),(14744,1,5,12,2,'2018-02-27','02/2018','16:00:00','20:00:00'),(14745,1,4,15,1,'2018-02-27','02/2018','08:00:00','12:00:00'),(14746,1,4,15,2,'2018-02-27','02/2018','16:00:00','20:00:00'),(14748,1,1,16,1,'2018-02-28','02/2018','08:00:00','12:00:00'),(14749,1,1,16,2,'2018-02-28','02/2018','16:00:00','20:00:00'),(14750,1,2,18,2,'2018-02-28','02/2018','16:00:00','20:00:00'),(14751,1,5,6,1,'2018-02-28','02/2018','08:00:00','12:00:00'),(14752,1,5,14,2,'2018-02-28','02/2018','16:00:00','20:00:00'),(14759,2,1,16,3,'2018-02-21','02/2018','10:00','20:00'),(15067,1,5,12,2,'2018-03-01','03/2018','16:00:00','20:00:00'),(15068,1,3,12,2,'2018-03-01','03/2018','16:00:00','20:00:00'),(15069,1,1,11,2,'2018-03-01','03/2018','16:00:00','20:00:00'),(15070,1,1,3,1,'2018-03-01','03/2018','08:00:00','12:00:00'),(15071,1,2,13,1,'2018-03-01','03/2018','08:00:00','12:00:00'),(15072,1,2,17,2,'2018-03-01','03/2018','16:00:00','20:00:00'),(15073,1,4,7,2,'2018-03-01','03/2018','16:00:00','20:00:00'),(15074,1,4,1,2,'2018-03-02','03/2018','16:00:00','20:00:00'),(15075,1,2,18,2,'2018-03-02','03/2018','16:00:00','20:00:00'),(15077,1,4,8,1,'2018-03-02','03/2018','08:00:00','12:00:00'),(15078,1,5,10,1,'2018-03-02','03/2018','08:00:00','12:00:00'),(15079,1,5,4,2,'2018-03-02','03/2018','16:00:00','20:00:00'),(15081,1,4,1,2,'2018-03-05','03/2018','16:00:00','20:00:00'),(15082,1,1,5,2,'2018-03-05','03/2018','16:00:00','20:00:00'),(15083,1,2,16,3,'2018-03-05','03/2018','10:00:00','20:00:00'),(15088,1,1,3,1,'2018-03-06','03/2018','08:00:00','12:00:00'),(15089,1,2,2,2,'2018-03-06','03/2018','16:00:00','20:00:00'),(15090,1,3,12,2,'2018-03-06','03/2018','16:00:00','20:00:00'),(15091,1,5,12,2,'2018-03-06','03/2018','16:00:00','20:00:00'),(15092,1,4,15,1,'2018-03-06','03/2018','08:00:00','12:00:00'),(15093,1,4,15,2,'2018-03-06','03/2018','16:00:00','20:00:00'),(15095,1,1,16,3,'2018-03-07','03/2018','10:00','20:00'),(15096,1,2,18,2,'2018-03-07','03/2018','16:00:00','20:00:00'),(15097,1,5,6,1,'2018-03-07','03/2018','08:00:00','12:00:00'),(15098,1,5,14,2,'2018-03-07','03/2018','16:00:00','20:00:00'),(15102,1,5,12,2,'2018-03-08','03/2018','16:00:00','20:00:00'),(15103,1,3,12,2,'2018-03-08','03/2018','16:00:00','20:00:00'),(15104,1,1,11,2,'2018-03-08','03/2018','16:00:00','20:00:00'),(15105,1,1,3,1,'2018-03-08','03/2018','08:00:00','12:00:00'),(15106,1,2,13,1,'2018-03-08','03/2018','08:00:00','12:00:00'),(15107,1,2,17,2,'2018-03-08','03/2018','16:00:00','20:00:00'),(15108,1,4,7,2,'2018-03-08','03/2018','16:00:00','20:00:00'),(15109,1,4,1,2,'2018-03-09','03/2018','16:00:00','20:00:00'),(15110,1,2,18,2,'2018-03-09','03/2018','16:00:00','20:00:00'),(15112,1,4,8,1,'2018-03-09','03/2018','08:00:00','12:00:00'),(15113,1,5,10,1,'2018-03-09','03/2018','08:00:00','12:00:00'),(15114,1,5,4,2,'2018-03-09','03/2018','16:00:00','20:00:00'),(15116,1,4,1,2,'2018-03-12','03/2018','16:00:00','20:00:00'),(15117,1,1,5,2,'2018-03-12','03/2018','16:00:00','20:00:00'),(15118,1,2,16,3,'2018-03-12','03/2018','10:00','20:00'),(15123,1,1,3,1,'2018-03-13','03/2018','08:00:00','12:00:00'),(15124,1,2,2,2,'2018-03-13','03/2018','16:00:00','20:00:00'),(15125,1,3,12,2,'2018-03-13','03/2018','16:00:00','20:00:00'),(15126,1,5,12,2,'2018-03-13','03/2018','16:00:00','20:00:00'),(15127,1,4,15,1,'2018-03-13','03/2018','08:00:00','12:00:00'),(15128,1,4,15,2,'2018-03-13','03/2018','16:00:00','20:00:00'),(15130,1,1,16,3,'2018-03-14','03/2018','10:00','20:00'),(15131,1,2,18,2,'2018-03-14','03/2018','16:00:00','20:00:00'),(15132,1,5,6,1,'2018-03-14','03/2018','08:00:00','12:00:00'),(15133,1,5,14,2,'2018-03-14','03/2018','16:00:00','20:00:00'),(15137,1,5,12,2,'2018-03-15','03/2018','16:00:00','20:00:00'),(15138,1,3,12,2,'2018-03-15','03/2018','16:00:00','20:00:00'),(15139,1,1,11,2,'2018-03-15','03/2018','16:00:00','20:00:00'),(15140,1,1,3,1,'2018-03-15','03/2018','08:00:00','12:00:00'),(15141,1,2,13,1,'2018-03-15','03/2018','08:00:00','12:00:00'),(15142,1,2,17,2,'2018-03-15','03/2018','16:00:00','20:00:00'),(15143,1,4,7,2,'2018-03-15','03/2018','16:00:00','20:00:00'),(15144,1,4,1,2,'2018-03-16','03/2018','16:00:00','20:00:00'),(15145,1,2,18,2,'2018-03-16','03/2018','16:00:00','20:00:00'),(15147,1,4,8,1,'2018-03-16','03/2018','08:00:00','12:00:00'),(15148,1,5,10,1,'2018-03-16','03/2018','08:00:00','12:00:00'),(15149,1,5,4,2,'2018-03-16','03/2018','16:00:00','20:00:00'),(15151,1,4,1,2,'2018-03-19','03/2018','16:00:00','20:00:00'),(15152,1,1,5,2,'2018-03-19','03/2018','16:00:00','20:00:00'),(15153,1,2,16,3,'2018-03-19','03/2018','10:00','20:00'),(15158,1,1,3,1,'2018-03-20','03/2018','08:00:00','12:00:00'),(15159,1,2,2,2,'2018-03-20','03/2018','16:00:00','20:00:00'),(15160,1,3,12,2,'2018-03-20','03/2018','16:00:00','20:00:00'),(15161,1,5,12,2,'2018-03-20','03/2018','16:00:00','20:00:00'),(15162,1,4,15,1,'2018-03-20','03/2018','08:00:00','12:00:00'),(15163,1,4,15,2,'2018-03-20','03/2018','16:00:00','20:00:00'),(15165,1,1,16,3,'2018-03-21','03/2018','10:00','20:00'),(15166,1,2,18,2,'2018-03-21','03/2018','16:00:00','20:00:00'),(15167,1,5,6,1,'2018-03-21','03/2018','08:00:00','12:00:00'),(15168,1,5,14,2,'2018-03-21','03/2018','16:00:00','20:00:00'),(15172,1,5,12,2,'2018-03-22','03/2018','16:00:00','20:00:00'),(15173,1,3,12,2,'2018-03-22','03/2018','16:00:00','20:00:00'),(15174,1,1,11,2,'2018-03-22','03/2018','16:00:00','20:00:00'),(15175,1,1,3,1,'2018-03-22','03/2018','08:00:00','12:00:00'),(15176,1,2,13,1,'2018-03-22','03/2018','08:00:00','12:00:00'),(15177,1,2,17,2,'2018-03-22','03/2018','16:00:00','20:00:00'),(15178,1,4,7,2,'2018-03-22','03/2018','16:00:00','20:00:00'),(15179,1,4,1,2,'2018-03-23','03/2018','16:00:00','20:00:00'),(15180,1,2,18,2,'2018-03-23','03/2018','16:00:00','20:00:00'),(15182,1,4,8,1,'2018-03-23','03/2018','08:00:00','12:00:00'),(15183,1,5,10,1,'2018-03-23','03/2018','08:00:00','12:00:00'),(15184,1,5,4,2,'2018-03-23','03/2018','16:00:00','20:00:00'),(15186,1,4,1,2,'2018-03-26','03/2018','16:00:00','20:00:00'),(15187,1,1,5,2,'2018-03-26','03/2018','16:00:00','20:00:00'),(15188,1,2,16,3,'2018-03-26','03/2018','10:00','20:00'),(15193,1,1,3,1,'2018-03-27','03/2018','08:00:00','12:00:00'),(15194,1,2,2,2,'2018-03-27','03/2018','16:00:00','20:00:00'),(15195,1,3,12,2,'2018-03-27','03/2018','16:00:00','20:00:00'),(15196,1,5,12,2,'2018-03-27','03/2018','16:00:00','20:00:00'),(15197,1,4,15,1,'2018-03-27','03/2018','08:00:00','12:00:00'),(15198,1,4,15,2,'2018-03-27','03/2018','16:00:00','20:00:00'),(15200,1,1,16,3,'2018-03-28','03/2018','10:00','20:00'),(15201,1,2,18,2,'2018-03-28','03/2018','16:00:00','20:00:00'),(15202,1,5,6,1,'2018-03-28','03/2018','08:00:00','12:00:00'),(15203,1,5,14,2,'2018-03-28','03/2018','16:00:00','20:00:00'),(15207,1,5,12,2,'2018-03-29','03/2018','16:00:00','20:00:00'),(15208,1,3,12,2,'2018-03-29','03/2018','16:00:00','20:00:00'),(15209,1,1,11,2,'2018-03-29','03/2018','16:00:00','20:00:00'),(15210,1,1,3,1,'2018-03-29','03/2018','08:00:00','12:00:00'),(15211,1,2,13,1,'2018-03-29','03/2018','08:00:00','12:00:00'),(15212,1,2,17,2,'2018-03-29','03/2018','16:00:00','20:00:00'),(15213,1,4,7,2,'2018-03-29','03/2018','16:00:00','20:00:00'),(15214,1,4,1,2,'2018-03-30','03/2018','16:00:00','20:00:00'),(15215,1,2,18,2,'2018-03-30','03/2018','16:00:00','20:00:00'),(15217,1,4,8,1,'2018-03-30','03/2018','08:00:00','12:00:00'),(15218,1,5,10,1,'2018-03-30','03/2018','08:00:00','12:00:00'),(15219,1,5,4,2,'2018-03-30','03/2018','16:00:00','20:00:00');

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

/*Table structure for table `caja` */

DROP TABLE IF EXISTS `caja`;

CREATE TABLE `caja` (
  `idCaja` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idConcepto` int(10) unsigned NOT NULL,
  `idMediosPago` int(10) unsigned NOT NULL,
  `idUsuario` int(10) unsigned NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Concepto` varchar(300) DEFAULT NULL,
  `Importe` float DEFAULT NULL,
  `Periodo` varchar(10) DEFAULT NULL,
  `FechaCarga` datetime DEFAULT NULL,
  `Tipo` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`idCaja`),
  KEY `Caja_FKIndex1` (`idUsuario`),
  KEY `Caja_FKIndex2` (`idMediosPago`),
  KEY `Caja_FKIndex3` (`idConcepto`),
  CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `caja_ibfk_2` FOREIGN KEY (`idMediosPago`) REFERENCES `mediospago` (`idMediosPago`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `caja` */

insert  into `caja`(`idCaja`,`idConcepto`,`idMediosPago`,`idUsuario`,`Fecha`,`Concepto`,`Importe`,`Periodo`,`FechaCarga`,`Tipo`) values (1,4,1,2,'2018-01-24','10',3,'01/2018','2018-01-24 11:07:00','S'),(2,5,1,2,'2018-01-24','1',3000,'01/2018','2018-01-24 11:08:25','E'),(3,1,1,2,'2018-01-24','10',9500,'01/2018','2018-01-24 11:15:20','S'),(4,2,1,2,'2018-01-23','10',300,'01/2018','2018-01-24 12:04:07','S'),(5,5,1,2,'2018-01-23','11',1500,'01/2018','2018-01-24 12:12:21','E'),(6,5,1,2,'2018-01-23','3',1600,'01/2018','2018-01-24 12:12:27','E'),(7,5,1,2,'2018-01-23','12',6500,'01/2018','2018-01-24 12:12:36','E'),(8,5,1,2,'2018-01-23','2',1400,'01/2018','2018-01-24 12:12:42','E'),(9,5,1,2,'2018-02-15','3',1600,'02/2018','2018-02-15 13:20:51','E');

/*Table structure for table `conceptos` */

DROP TABLE IF EXISTS `conceptos`;

CREATE TABLE `conceptos` (
  `idConcepto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) DEFAULT NULL,
  `Tipo` varchar(1) DEFAULT NULL,
  `Adicional` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`idConcepto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `conceptos` */

insert  into `conceptos`(`idConcepto`,`Nombre`,`Tipo`,`Adicional`) values (1,'Gastos varios','S','S'),(2,'Librería','S','N'),(3,'Limpieza','S','N'),(4,'Almacén','S','N'),(5,'Cobranza alquiler','E','P'),(6,'Retiro de caja','S','N'),(7,'Otros conceptos ingresos','E','P');

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

insert  into `especialidades`(`idEspecialidad`,`Nombre`,`CostoMod`) values (1,'General',NULL),(2,'Psicología',1250),(3,'Pediatría',NULL),(4,'Ginecolgía',NULL),(5,'Cardiología',NULL),(6,'Oftalmología',NULL),(7,'Otorrinolaringología',NULL),(8,'Musicoterapia',NULL),(9,'Psiquiatría',NULL),(10,'Kinesiología',NULL),(11,'Podología',NULL),(12,'Nutrición',NULL),(13,'Psicopedagogía',NULL),(14,'Cirugía',NULL);

/*Table structure for table `mediospago` */

DROP TABLE IF EXISTS `mediospago`;

CREATE TABLE `mediospago` (
  `idMediosPago` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idMediosPago`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `mediospago` */

insert  into `mediospago`(`idMediosPago`,`Nombre`) values (1,'EFECTIVO'),(2,'DEBITO'),(3,'CREDITO'),(4,'PREPAGA'),(5,'CHEQUE');

/*Table structure for table `modulos` */

DROP TABLE IF EXISTS `modulos`;

CREATE TABLE `modulos` (
  `idModulo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) DEFAULT NULL,
  `Pagina` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idModulo`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `modulos` */

insert  into `modulos`(`idModulo`,`Nombre`,`Pagina`) values (1,'Pacientes','pacientes.php'),(2,'Profesionales','profesionales.php'),(3,'Especialidades','especialidades.php'),(4,'Consultorios','consultorios.php'),(5,'Param Agenda','agenda.php'),(6,'Agenda diaria','diaria.php'),(7,'Proyecciones','proyeccion.php'),(8,'Reportes','reportes.php'),(9,'Prepagas','prepagas.php'),(10,'Usuarios','usuarios.php'),(11,'Caja','caja.php'),(12,'Reporte agenda diaria','#'),(13,'Reporte agenda profesional','reportes.php');

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
  PRIMARY KEY (`idPaciente`),
  KEY `pacientes_FKIndex1` (`idPrepaga`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `pacientes` */

insert  into `pacientes`(`idPaciente`,`idPrepaga`,`Apellido`,`Nombre`,`FechaNac`,`Celular`,`Mail`,`FechaAlta`,`NroSocio`,`DNI`) values (1,2,'ESTEYBAR','GUSTAVO','1976-08-25','1138986069','gesteybar@arimex.com','2017-12-29','12345678/9',25356574),(3,1,'mansur','maria clara','1899-11-30','654654','','2018-01-03','24027210',24027210),(5,0,'Esteybar','Santiago','0000-00-00','','','2018-01-04','',50525794),(6,0,'Delgado','Marcelo','0000-00-00','1166546655','','2018-01-04','',0),(7,0,'rocchi','gaby','0000-00-00','','','2018-01-05','',0),(8,0,'novak','claudio','0000-00-00','6584621','','2018-01-12','',33333333),(9,0,'pereira','elias','0000-00-00','654321351','','2018-02-20','',16466614);

/*Table structure for table `paramagenda` */

DROP TABLE IF EXISTS `paramagenda`;

CREATE TABLE `paramagenda` (
  `idParamAgenda` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idProfesional` int(10) unsigned NOT NULL,
  `idEspecialidad` int(10) unsigned NOT NULL,
  `Modulo` int(10) unsigned DEFAULT NULL,
  `Sobreturnos` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idParamAgenda`),
  KEY `ParamAgenda_FKIndex1` (`idEspecialidad`),
  KEY `ParamAgenda_FKIndex2` (`idProfesional`),
  CONSTRAINT `paramagenda_ibfk_1` FOREIGN KEY (`idEspecialidad`) REFERENCES `especialidades` (`idEspecialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `paramagenda_ibfk_2` FOREIGN KEY (`idProfesional`) REFERENCES `profesionales` (`idProfesional`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `paramagenda` */

insert  into `paramagenda`(`idParamAgenda`,`idProfesional`,`idEspecialidad`,`Modulo`,`Sobreturnos`) values (1,1,2,60,0),(3,3,4,30,2),(5,10,5,35,1),(6,7,5,15,1),(8,8,5,20,1),(9,15,5,12,1),(10,13,5,10,1),(11,5,5,25,1),(12,4,5,20,1),(14,17,5,40,1),(15,12,5,50,1),(16,18,5,25,1),(17,11,5,30,1),(18,2,5,12,1),(19,6,5,15,1),(20,14,5,10,1),(24,16,2,60,0);

/*Table structure for table `permisos` */

DROP TABLE IF EXISTS `permisos`;

CREATE TABLE `permisos` (
  `idPermiso` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUsuario` int(10) unsigned NOT NULL,
  `idModulo` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idPermiso`),
  KEY `Permisos_FKIndex1` (`idModulo`),
  KEY `Permisos_FKIndex2` (`idUsuario`),
  CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`idModulo`) REFERENCES `modulos` (`idModulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

/*Data for the table `permisos` */

insert  into `permisos`(`idPermiso`,`idUsuario`,`idModulo`) values (1,1,1),(2,1,8),(3,1,5),(4,1,2),(5,1,3),(6,1,4),(7,1,6),(8,1,7),(10,1,10),(11,2,1),(12,2,6),(13,2,5),(14,2,7),(15,2,3),(16,2,2),(17,2,4),(18,2,8),(19,2,9),(20,2,10),(34,3,1),(35,3,2),(38,3,5),(39,3,6),(40,3,7),(42,3,8),(43,3,4),(44,3,3),(45,2,11),(46,1,11),(47,4,1),(49,4,6),(50,4,8),(51,4,9),(52,4,11),(53,2,12),(54,5,13);

/*Table structure for table `prepagas` */

DROP TABLE IF EXISTS `prepagas`;

CREATE TABLE `prepagas` (
  `idPrepaga` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idPrepaga`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `prepagas` */

insert  into `prepagas`(`idPrepaga`,`Nombre`) values (1,'PARTICULAR'),(2,'OSDE'),(3,'PAMI');

/*Table structure for table `profatiende` */

DROP TABLE IF EXISTS `profatiende`;

CREATE TABLE `profatiende` (
  `idProfAtiende` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idProfesional` int(10) unsigned NOT NULL,
  `idConsultorio` int(10) unsigned NOT NULL,
  `Dia` int(10) unsigned DEFAULT NULL,
  `Modulo` int(10) unsigned DEFAULT NULL,
  `Desde` varchar(12) DEFAULT NULL,
  `Hasta` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`idProfAtiende`),
  KEY `profatiende_FKIndex1` (`idProfesional`),
  KEY `profatiende_FKIndex2` (`idConsultorio`),
  CONSTRAINT `profatiende_ibfk_1` FOREIGN KEY (`idProfesional`) REFERENCES `profesionales` (`idProfesional`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `profatiende_ibfk_2` FOREIGN KEY (`idConsultorio`) REFERENCES `consultorios` (`idConsultorio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

/*Data for the table `profatiende` */

insert  into `profatiende`(`idProfAtiende`,`idProfesional`,`idConsultorio`,`Dia`,`Modulo`,`Desde`,`Hasta`) values (1,1,4,1,2,NULL,NULL),(3,1,4,5,2,NULL,NULL),(8,3,1,2,1,NULL,NULL),(10,5,1,1,2,NULL,NULL),(12,16,2,1,3,'10:00','20:00'),(14,16,1,3,3,'10:00','20:00'),(16,2,2,2,2,NULL,NULL),(17,12,3,2,2,NULL,NULL),(18,12,5,2,2,NULL,NULL),(19,12,5,4,2,NULL,NULL),(20,12,3,4,2,NULL,NULL),(21,15,4,2,1,NULL,NULL),(22,15,4,2,2,NULL,NULL),(23,18,2,3,2,NULL,NULL),(24,18,2,5,2,NULL,NULL),(25,6,5,3,1,NULL,NULL),(26,14,5,3,2,NULL,NULL),(28,11,1,4,2,NULL,NULL),(29,3,1,4,1,NULL,NULL),(30,13,2,4,1,NULL,NULL),(31,17,2,4,2,NULL,NULL),(32,7,4,4,2,NULL,NULL),(34,8,4,5,1,NULL,NULL),(35,10,5,5,1,NULL,NULL),(36,4,5,5,2,NULL,NULL);

/*Table structure for table `profesionales` */

DROP TABLE IF EXISTS `profesionales`;

CREATE TABLE `profesionales` (
  `idProfesional` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `Matricula` varchar(10) DEFAULT NULL,
  `FechaVenc` date DEFAULT NULL,
  `DocCompleta` int(11) DEFAULT NULL,
  `Estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idProfesional`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `profesionales` */

insert  into `profesionales`(`idProfesional`,`Nombre`,`Matricula`,`FechaVenc`,`DocCompleta`,`Estado`) values (1,'maria clara mansur','16513','2010-01-01',1,'ACTIVO'),(2,'Nusshold',NULL,NULL,NULL,'ACTIVO'),(3,'Cuello',NULL,NULL,NULL,'ACTIVO'),(4,'Torres',NULL,NULL,NULL,'ACTIVO'),(5,'Longas',NULL,NULL,NULL,'ACTIVO'),(6,'Pereira',NULL,NULL,NULL,'ACTIVO'),(7,'Bucci',NULL,NULL,NULL,'ACTIVO'),(8,'Cousido',NULL,NULL,NULL,'ACTIVO'),(10,'Barreiro',NULL,NULL,NULL,'ACTIVO'),(11,'Castiglione',NULL,NULL,NULL,'ACTIVO'),(12,'Zampedri',NULL,NULL,NULL,'ACTIVO'),(13,'Nieto',NULL,NULL,NULL,'ACTIVO'),(14,'Enjuto',NULL,NULL,NULL,'ACTIVO'),(15,'Pecchia',NULL,NULL,NULL,'ACTIVO'),(16,'Flitt',NULL,NULL,NULL,'ACTIVO'),(17,'Troilo',NULL,NULL,NULL,'ACTIVO'),(18,'Wybert',NULL,NULL,NULL,'ACTIVO');

/*Table structure for table `reportes` */

DROP TABLE IF EXISTS `reportes`;

CREATE TABLE `reportes` (
  `idReporte` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idModulo` int(10) unsigned NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Leyenda` varchar(1000) DEFAULT NULL,
  `Ruta` varchar(400) DEFAULT NULL,
  `Grupo` varchar(50) DEFAULT NULL,
  `Script` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idReporte`),
  KEY `Reportes_FKIndex1` (`idModulo`),
  CONSTRAINT `reportes_ibfk_1` FOREIGN KEY (`idModulo`) REFERENCES `modulos` (`idModulo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `reportes` */

insert  into `reportes`(`idReporte`,`idModulo`,`Nombre`,`Leyenda`,`Ruta`,`Grupo`,`Script`) values (1,8,'Agendas diarias','Listado de agendas por consultorio y fecha','./reportes/agendaDiaria.php','AGENDAS',NULL),(2,13,'Agenda de profesionales','Reporte de turnos otorgados por profesional','./reportes/agendaProf.php','AGENDAS',NULL);

/*Table structure for table `tmpbuffer` */

DROP TABLE IF EXISTS `tmpbuffer`;

CREATE TABLE `tmpbuffer` (
  `idTurno` int(11) DEFAULT NULL,
  `Hora` varchar(10) DEFAULT NULL,
  `idPaciente` int(11) DEFAULT NULL,
  `Paciente` varchar(100) DEFAULT NULL,
  `idEspecialidad` int(11) DEFAULT NULL,
  `Especialidad` varchar(50) DEFAULT NULL,
  `DNI` int(11) DEFAULT NULL,
  `Celular` varchar(50) DEFAULT NULL,
  `Estado` varchar(40) DEFAULT NULL,
  `Fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tmpbuffer` */

insert  into `tmpbuffer`(`idTurno`,`Hora`,`idPaciente`,`Paciente`,`idEspecialidad`,`Especialidad`,`DNI`,`Celular`,`Estado`,`Fecha`) values (42,'16:00:00',3,'maria clara mansur',1,'',24027210,'654654','PENDIENTE','2018-03-14'),(NULL,'16:25:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-14'),(NULL,'16:50:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-14'),(NULL,'17:15:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-14'),(NULL,'17:40:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-14'),(NULL,'18:05:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-14'),(NULL,'18:30:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-14'),(NULL,'18:55:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-14'),(NULL,'19:20:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-14'),(NULL,'19:45:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-14'),(NULL,'16:00:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-16'),(NULL,'16:25:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-16'),(NULL,'16:50:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-16'),(NULL,'17:15:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-16'),(NULL,'17:40:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-16'),(NULL,'18:05:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-16'),(NULL,'18:30:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-16'),(NULL,'18:55:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-16'),(NULL,'19:20:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-16'),(NULL,'19:45:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-16'),(NULL,'16:00:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-21'),(NULL,'16:25:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-21'),(NULL,'16:50:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-21'),(NULL,'17:15:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-21'),(NULL,'17:40:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-21'),(NULL,'18:05:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-21'),(NULL,'18:30:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-21'),(NULL,'18:55:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-21'),(NULL,'19:20:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-21'),(NULL,'19:45:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-21'),(NULL,'16:00:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-23'),(NULL,'16:25:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-23'),(NULL,'16:50:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-23'),(NULL,'17:15:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-23'),(NULL,'17:40:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-23'),(NULL,'18:05:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-23'),(NULL,'18:30:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-23'),(NULL,'18:55:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-23'),(NULL,'19:20:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-23'),(NULL,'19:45:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-23'),(NULL,'16:00:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-28'),(NULL,'16:25:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-28'),(NULL,'16:50:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-28'),(NULL,'17:15:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-28'),(NULL,'17:40:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-28'),(NULL,'18:05:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-28'),(NULL,'18:30:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-28'),(NULL,'18:55:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-28'),(NULL,'19:20:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-28'),(NULL,'19:45:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-28'),(NULL,'16:00:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-30'),(NULL,'16:25:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-30'),(NULL,'16:50:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-30'),(NULL,'17:15:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-30'),(NULL,'17:40:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-30'),(NULL,'18:05:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-30'),(NULL,'18:30:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-30'),(NULL,'18:55:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-30'),(NULL,'19:20:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-30'),(NULL,'19:45:00',NULL,NULL,NULL,NULL,NULL,NULL,'DISPONIBLE','2018-03-30');

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
  KEY `Turnos_FKIndex1` (`idProfesional`),
  KEY `Turnos_FKIndex2` (`idEspecialidad`),
  CONSTRAINT `turnos_ibfk_1` FOREIGN KEY (`idProfesional`) REFERENCES `profesionales` (`idProfesional`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `turnos_ibfk_2` FOREIGN KEY (`idEspecialidad`) REFERENCES `especialidades` (`idEspecialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

/*Data for the table `turnos` */

insert  into `turnos`(`idTurno`,`idPaciente`,`idEspecialidad`,`idProfesional`,`Fecha`,`Hora`,`Paciente`,`DNI`,`NroSocio`,`Celular`,`ApellidoPac`,`Estado`) values (5,0,5,18,'2018-01-03','16:00:00','gustavo a','','','1150051111','','PENDIENTE'),(6,0,5,6,'2018-01-03','10:00:00','Clara','24027210','','561651663','Mansur','PENDIENTE'),(7,0,5,6,'2018-01-03','11:00:00','Pilar','35142136','','651698466','happn','PENDIENTE'),(8,0,5,6,'2018-01-03','09:00:00','Claudio','21358165','','165165433','Novak','PENDIENTE'),(10,2,5,14,'2018-01-03','17:40:00','gus','25356574','','1138986069','esteybar','PENDIENTE'),(11,3,5,14,'2018-01-03','16:50:00','maria clara','16165','','654654','mansur','PENDIENTE'),(12,3,5,6,'2018-01-03','08:30:00','maria clara','16165','','654654','mansur','PENDIENTE'),(13,1,5,6,'2018-01-04','17:30:00','GUSTAVO','25356574','12345678/9','1138986069','ESTEYBAR','PENDIENTE'),(16,1,2,1,'2018-01-05','10:00:00','GUSTAVO','25356574','12345678/9','1138986069','ESTEYBAR','TOMADO'),(18,7,5,10,'2018-01-05','08:00:00','gaby','0','','','rocchi','PENDIENTE'),(19,3,5,2,'2018-01-09','16:00:00','maria clara','24027210','24027210','654654','mansur','PENDIENTE'),(20,1,5,2,'2018-01-09','16:36:00','GUSTAVO','25356574','12345678/9','1138986069','ESTEYBAR','PENDIENTE'),(21,6,5,2,'2018-01-09','17:12:00','Marcelo','0','','1166546655','Delgado','PENDIENTE'),(22,7,5,2,'2018-01-09','17:48:00','gaby','0','','','rocchi','PENDIENTE'),(23,5,5,2,'2018-01-09','18:12:00','Santiago','50525794','','','Esteybar','PENDIENTE'),(24,1,5,3,'2018-01-09','16:00:00','GUSTAVO','25356574','12345678/9','1138986069','ESTEYBAR','PENDIENTE'),(25,5,5,3,'2018-01-09','19:00:00','Santiago','50525794','','','Esteybar','PENDIENTE'),(26,3,5,12,'2018-01-09','16:00:00','maria clara','24027210','24027210','654654','mansur','PENDIENTE'),(27,6,5,12,'2018-01-09','17:40:00','Marcelo','0','','1166546655','Delgado','PENDIENTE'),(28,0,2,1,'2018-01-12','16:00:00','claudio','33333333','','6584621','novak','PENDIENTE'),(29,6,5,4,'2018-01-19','16:00:00','Marcelo','0','','1166546655','Delgado','AUSENTE'),(30,1,5,7,'2018-01-25','16:00:00','GUSTAVO','25356574','12345678/9','1138986069','ESTEYBAR','PENDIENTE'),(31,3,1,7,'2018-02-01','17:45:00','maria clara','24027210','24027210','654654','mansur','PENDIENTE'),(32,5,1,7,'2018-02-01','18:30:00','Santiago','50525794','','','Esteybar','PENDIENTE'),(33,1,1,16,'2018-03-05','12:00:00','GUSTAVO','25356574','12345678/9','1138986069','ESTEYBAR','PENDIENTE'),(34,1,1,1,'2018-03-02','16:00:00','GUSTAVO','25356574','12345678/9','1138986069','ESTEYBAR','PENDIENTE'),(36,5,1,1,'2018-03-02','17:00:00','Santiago','50525794','','','Esteybar','PENDIENTE'),(37,7,1,1,'2018-03-02','18:00:00','gaby','0','','','rocchi','PENDIENTE'),(38,8,1,1,'2018-03-02','19:00:00','claudio','33333333','','6584621','novak','PENDIENTE'),(39,5,1,1,'2018-03-05','16:00:00','Santiago','50525794','','','Esteybar','PENDIENTE'),(40,7,1,1,'2018-03-05','17:00:00','gaby','0','','','rocchi','PENDIENTE'),(41,1,1,1,'2018-03-12','17:00:00','GUSTAVO','25356574','12345678/9','1138986069','ESTEYBAR','PENDIENTE'),(42,3,1,18,'2018-03-14','16:00:00','maria clara','24027210','24027210','654654','mansur','PENDIENTE');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idUsuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `Login` varchar(30) DEFAULT NULL,
  `Pass` varchar(32) DEFAULT NULL,
  `Perfil` varchar(1) DEFAULT NULL,
  `ProfAsoc` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idUsuario`,`Nombre`,`Login`,`Pass`,`Perfil`,`ProfAsoc`) values (1,'administrador','admin','e10adc3949ba59abbe56e057f20f883e','A',NULL),(2,'gustavo','gus','1e925d4aff5d5be4beeb9e07741a23bc','A',NULL),(3,'clara','clara','e10adc3949ba59abbe56e057f20f883e','A',NULL),(4,'Mayra','mayra','e10adc3949ba59abbe56e057f20f883e','R',NULL),(5,'Laura Bucci','lbucci','e10adc3949ba59abbe56e057f20f883e','P',7);

/* Procedure structure for procedure `SP_AbrirPeriodo` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_AbrirPeriodo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AbrirPeriodo`(pPeriodo varchar(10))
BEGIN
	declare vInicio date;
	declare vFin date;
	declare vFecha date;
	declare vDia int;
	
	set vInicio=STR_TO_DATE(CONCAT('01/',pPeriodo), '%d/%m/%Y');
	set vFin=last_day(vInicio);
	set vFecha=vInicio;
	while (vFecha<=vFin) do
		set vDia=dayofweek(vFecha)-1;
		if vDia=0 then set vDia=7; end if;
		
		insert into agenda (idEspecialidad, idConsultorio, idProfesional, Turno, Fecha, Periodo, HoraInicio, HoraFin) 
		(SELECT 1, pa.idConsultorio, pa.idProfesional, pa.Modulo, vFecha, pPeriodo, 
		case pa.Modulo when 1 then '08:00:00' when 2 then '16:00:00' when 3 then pa.Desde end Inicio, 
		CASE pa.Modulo WHEN 1 THEN '12:00:00' WHEN 2 THEN '20:00:00' WHEN 3 THEN pa.Hasta END Fin 
		FROM profatiende pa
		WHERE pa.Dia=vDia);
		
		set vFecha=date_add(vFecha, interval 1 day);
	end while;
    END */$$
DELIMITER ;

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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertAgenda`(pEsp int, pProf int, pCons int, pMod int, pFecha varchar(20), pPeriodo varchar(7), pDesde varchar(12), pHasta varchar(12))
BEGIN
	if exists(select 1 from agenda where Fecha=pFecha and Turno=pMod and idConsultorio=pCons) then
		delete FROM agenda WHERE Fecha=pFecha AND Turno=pMod AND idConsultorio=pCons;
	end if;
	
	if pMod=1 then
		set pDesde='08:00';
		set pHasta='12:00';
	end if;
	IF pMod=2 THEN
		set pDesde='16:00';
		set pHasta='20:00';
	END IF;
	
	insert into agenda (idEspecialidad, idConsultorio, idProfesional, Turno, Fecha, Periodo, HoraInicio, HoraFin) values (
		pEsp, pCons, pProf, pMod, str_to_date(pFecha,'%d/%m/%Y'),pPeriodo, pDesde, pHasta);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_InsertAtencion` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_InsertAtencion` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertAtencion`(pidProf int, pDia int, pidCons int, pMod int)
BEGIN
	if not exists(select 1 from profatiende where idProfesional=pidProf and Dia=pDia and idConsultorio=pidCons and Modulo=pMod) then
		insert into profatiende (idProfesional, idConsultorio, Dia, Modulo) values (
		pidProf, pidCons, pDia, pMod);
	end if;
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

/* Procedure structure for procedure `SP_InsertUser` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_InsertUser` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertUser`(pid integer, pNombre varchar(100), pLogin varchar(30), pPass varchar(34), pPerfil varchar(1), pProf int)
BEGIN
	if pPerfil<>'P' then set pProf=null; end if;
	if exists(select 1 from usuarios where idUsuario=pid) then
		update usuarios set Nombre=pNombre, Login=pLogin, Perfil=pPerfil, ProfAsoc=pProf where idUsuario=pid;
		if ifnull(pPass, '******')<>'******' then
			update Usuarios set Pass=md5(pPass) where idUsuario=pid;
		end if;
	else
		insert into Usuarios (Nombre, Login, Pass, Perfil, ProfAsoc) values (pNombre, pLogin, md5(pPass), pPerfil, pProf);
	end if;
		
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

/* Procedure structure for procedure `SP_LeerTurnos` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_LeerTurnos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LeerTurnos`(pFecha varchar(15), pProf int, pResult int)
BEGIN
	declare vHoraI varchar(10);
	declare vHoraF varchar(10);
	declare vFechaI datetime;
	declare vFechaF datetime;
	declare vModulo int;
	declare vI1 int;
	declare vI2 int;
	
	drop table if exists tmpturnos;
	create temporary table tmpturnos (idTurno int, Hora varchar(10), idPaciente int, Paciente varchar(100), idEspecialidad int, Especialidad varchar(50), DNI int, Celular varchar(50), Estado varchar(40), Fecha date);
	
	select min(Turno), max(Turno) into vI1, vI2 from agenda  WHERE idProfesional=pProf AND Fecha=pFecha;
	
	while (vI1<=vI2) do
	
		select HoraInicio, HoraFin into vHoraI, vHoraF from agenda where idProfesional=pProf and Fecha=pFecha and Turno=vI1 limit 1;
		
		set vFechaI=convert(concat(pFecha, ' ', vHoraI), datetime);
		set vFechaF=convert(concat(pFecha, ' ', vHoraF), datetime);
		select Modulo into vModulo from paramagenda where idProfesional=pProf limit 1;
		
		/*select vFechaI, vFechaF;*/
		while (vFechaI<vFechaF) do
			set vHoraF=DATE_FORMAT(DATE_ADD(vFechaI, INTERVAL vModulo MINUTE), '%H:%i:%s');
			
			if exists(select 1 from turnos where Fecha=pFecha and idProfesional=pProf AND Hora >= vHoraI AND Hora < vHoraF) then
				insert into tmpturnos (
				select idTurno, Hora, idPaciente, concat(Paciente,' ', ApellidoPac) Paciente, idEspecialidad, '', DNI, Celular, Estado, Fecha from Turnos 
				where idProfesional=pProf and Fecha=pFecha 
				and Hora >= vHoraI and Hora< vHoraF);
			else 
				insert into tmpTurnos values (null,vHoraI, null,null,null,null,null,null, 'DISPONIBLE',pFecha);
			end if;
			
			set vFechaI=date_add(vFechaI, interval vModulo minute);
			set vHoraI=DATE_FORMAT(vFechaI, '%H:%i:%s');
		end while;
		
		set vI1=vI1+1;
		
	end while;
	if ifnull(pResult,0)>0 then
		select * from tmpturnos order by Hora asc;
	end if;
	
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
			insert into agenda (idEspecialidad, idConsultorio, idProfesional, Turno, Fecha, Periodo, HoraInicio, HoraFin) 
			(select idEspecialidad, idConsultorio, idProfesional, Turno, vNextDate, DATE_FORMAT(vNextDate, '%m/%Y'), HoraInicio, HoraFin  
			from agenda where Fecha=date_add(vNextDate, interval -7 day));
			
			select date_add(vNextDate, interval 1 day) into vNextDate;
		end while;
		commit;
	end if;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_TurnosLibres` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_TurnosLibres` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TurnosLibres`(pProf int, pFechaInicio date)
BEGIN
	DECLARE vFrecuencia FLOAT;
	DECLARE vHoras FLOAT;
	DECLARE vHora FLOAT;
	DECLARE vHoraI VARCHAR(10);
	DECLARE vHoraF VARCHAR(10);
	DECLARE vTurnos FLOAT;
	DECLARE vFecha DATE; 
	
	DECLARE cur CURSOR FOR SELECT Fecha FROM agenda WHERE idProfesional=pProf AND Fecha>=pFechaInicio;
	declare continue handler for not found set vFecha=null;
	DROP TABLE IF EXISTS tmpAgenda;
	CREATE TEMPORARY TABLE tmpAgenda (idTurno INT, Hora VARCHAR(10), idPaciente INT, Paciente VARCHAR(100), idEspecialidad INT, Especialidad VARCHAR(50), DNI INT, Celular VARCHAR(50), Estado VARCHAR(40),Fecha date);
		
	OPEN cur;
	FETCH cur INTO vFecha;
	while iFnull(vFecha,'')<>'' do
			call SP_LeerTurnos(vFecha, pProf,0);
			insert into tmpAgenda (select * from tmpturnos);
		
		FETCH cur INTO vFecha;
	END while;
	CLOSE cur;
		
	truncate tmpbuffer;
	insert into tmpbuffer (SELECT * FROM tmpagenda);
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
