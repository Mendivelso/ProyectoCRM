/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.1.10-MariaDB : Database - admin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`admin` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `admin`;

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `Nombre` varchar(90) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre',
  `Cedula` bigint(20) NOT NULL COMMENT 'Cedula',
  `Telefono` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Telefono',
  `Direccion` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Direccion',
  `Email` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Email',
  `Perfil` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Perfil',
  `Usuario` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre de usuario',
  `Password` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'COntraena',
  `Foto` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Foto',
  `Status` int(5) NOT NULL COMMENT 'Estado',
  `Created_at` datetime NOT NULL COMMENT 'Fecha',
  `Created_by` int(11) NOT NULL COMMENT 'QUien regsitra',
  `Updated_at` datetime DEFAULT NULL COMMENT 'fecha actuializa',
  `Updated_by` int(11) DEFAULT NULL COMMENT 'Quien actualiza',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`Id`,`Nombre`,`Cedula`,`Telefono`,`Direccion`,`Email`,`Perfil`,`Usuario`,`Password`,`Foto`,`Status`,`Created_at`,`Created_by`,`Updated_at`,`Updated_by`) values 
(5,'Ronaldo',1022422710,'5726542','Kra 100','cr@gmail.com','1','ronaldo','202cb962ac59075b964b07152d234b70','public/usuarios/5/perfil2.png',1,'2019-07-30 10:43:35',0,'2019-07-31 11:08:40',0),
(6,'Cristian Mendivelso',1022422720,'5726542 ext 166','Kra 100 # 41-50','cr7@gmail.com','2','cc','d41d8cd98f00b204e9800998ecf8427e','public/usuarios/6/perfil2.png',1,'2019-07-31 15:45:57',0,NULL,NULL),
(7,'Carlos Gomez',1022422730,'5726542 ext 166','Kra 100 # 41-50','cr7@gmail.com','2','carlos','d41d8cd98f00b204e9800998ecf8427e','public/usuarios/7/perfil2.png',1,'2019-07-31 16:04:08',0,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
