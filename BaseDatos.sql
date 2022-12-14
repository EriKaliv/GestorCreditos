CREATE DATABASE  IF NOT EXISTS `gestorcreditos` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `gestorcreditos`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: gestorcreditos
-- ------------------------------------------------------
-- Server version	5.7.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cajas`
--

DROP TABLE IF EXISTS `cajas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cajas` (
  `idCaja` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipoCuenta` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idCaja`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cajas`
--

LOCK TABLES `cajas` WRITE;
/*!40000 ALTER TABLE `cajas` DISABLE KEYS */;
INSERT INTO `cajas` VALUES (1,'Bancolombia','Ahorros','0000-0000-0000'),(2,'Davivienda','Ahorros','1111-111-1111');
/*!40000 ALTER TABLE `cajas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `creditos`
--

DROP TABLE IF EXISTS `creditos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `creditos` (
  `idcreditos` int(11) NOT NULL AUTO_INCREMENT,
  `idDeudor` int(11) NOT NULL,
  `valorProyectar` int(11) DEFAULT NULL,
  `tasa` double(10,2) DEFAULT NULL,
  `cupo` int(11) DEFAULT NULL,
  `cuotas` int(11) DEFAULT NULL,
  `valorCuota` int(11) DEFAULT NULL,
  `frecuencia` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `estadoCredito` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `transferencia` int(11) DEFAULT NULL,
  `ivaTransferencia` int(11) DEFAULT NULL,
  `cuatroxmil` int(11) DEFAULT NULL,
  `recaudo1` int(11) DEFAULT NULL,
  `ivaRecaudo1` int(11) DEFAULT NULL,
  `cobranza` int(11) DEFAULT NULL,
  `ivaCobranza` int(11) DEFAULT NULL,
  `recaudo2` int(11) DEFAULT NULL,
  `ivaRecaudo2` int(11) DEFAULT NULL,
  `software` int(11) DEFAULT NULL,
  `fechaAlta_Cr` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcreditos`),
  KEY `fk_creditos_prestatarios_idx` (`idDeudor`),
  CONSTRAINT `fk_creditos_deudores` FOREIGN KEY (`idDeudor`) REFERENCES `deudores` (`idDeudor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creditos`
--

LOCK TABLES `creditos` WRITE;
/*!40000 ALTER TABLE `creditos` DISABLE KEYS */;
/*!40000 ALTER TABLE `creditos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `desembolsos`
--

DROP TABLE IF EXISTS `desembolsos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `desembolsos` (
  `idDesembolso` int(11) NOT NULL AUTO_INCREMENT,
  `idCredito` int(11) DEFAULT NULL,
  `idCaja` int(11) DEFAULT NULL,
  `idDeudor` int(11) DEFAULT NULL,
  `fecha` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `monto` int(11) DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idDesembolso`),
  KEY `fk_desembolsos_creditos_idx` (`idCredito`),
  KEY `fk_desembolsos_cajas_idx` (`idCaja`),
  KEY `fk_desembolsos_deudores_idx` (`idDeudor`),
  CONSTRAINT `fk_desembolsos_cajas` FOREIGN KEY (`idCaja`) REFERENCES `cajas` (`idCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_desembolsos_creditos` FOREIGN KEY (`idCredito`) REFERENCES `creditos` (`idcreditos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_desembolsos_deudores` FOREIGN KEY (`idDeudor`) REFERENCES `deudores` (`idDeudor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `desembolsos`
--

LOCK TABLES `desembolsos` WRITE;
/*!40000 ALTER TABLE `desembolsos` DISABLE KEYS */;
/*!40000 ALTER TABLE `desembolsos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deudores`
--

DROP TABLE IF EXISTS `deudores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deudores` (
  `idDeudor` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) DEFAULT NULL,
  `nombres` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `apellidos` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `idTipoId` int(11) DEFAULT NULL,
  `numeroId` int(11) DEFAULT NULL,
  `idPais` int(4) DEFAULT NULL,
  `idDepartamento` int(11) DEFAULT NULL,
  `idCiudMuni` int(11) DEFAULT NULL,
  `numeroCel` int(11) DEFAULT NULL,
  `email` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `direccion` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `fechaAlta_Deud` timestamp NULL DEFAULT NULL,
  `fechaEdit_Deud` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idDeudor`),
  KEY `fk_prestatario_tipoid` (`idTipoId`),
  KEY `fk_prestatario_pais_idx` (`idPais`),
  KEY `fk_prestatario_departamento_idx` (`idDepartamento`),
  KEY `fk_prestatario_ciudmuni_idx` (`idCiudMuni`),
  KEY `fk_prestatario_usuarios_idx` (`idUsuario`),
  CONSTRAINT `fk_prestatario_ciudmuni` FOREIGN KEY (`idCiudMuni`) REFERENCES `ubicacion_ciudmuni` (`idCiudMuni`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_prestatario_departamento` FOREIGN KEY (`idDepartamento`) REFERENCES `ubicacion_departamento` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_prestatario_pais` FOREIGN KEY (`idPais`) REFERENCES `ubicacion_pais` (`idPais`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_prestatario_tipoid` FOREIGN KEY (`idTipoId`) REFERENCES `tipoid` (`idTipoId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_prestatario_usuarios` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deudores`
--

LOCK TABLES `deudores` WRITE;
/*!40000 ALTER TABLE `deudores` DISABLE KEYS */;
INSERT INTO `deudores` VALUES (1,2,'Laura','P??rez ',1,1037000000,1,2,12,2147483647,'laura@laura.com','Cra 52 # 00','2022-09-21 01:03:16','2022-09-21 01:03:16');
/*!40000 ALTER TABLE `deudores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `idEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `idTipoId` int(11) DEFAULT NULL,
  `numeroId` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idPais` int(11) DEFAULT NULL,
  `idDepartamento` int(11) DEFAULT NULL,
  `idCiudMuni` int(11) DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idEmpresa`),
  KEY `fk_empresa_tipid_idx` (`idTipoId`),
  KEY `fk_empresas_pais_idx` (`idPais`),
  KEY `fk_empresas_departamento_idx` (`idDepartamento`),
  KEY `fk_empresas_ciudmuni_idx` (`idCiudMuni`),
  CONSTRAINT `fk_empresas_ciudmuni` FOREIGN KEY (`idCiudMuni`) REFERENCES `ubicacion_ciudmuni` (`idCiudMuni`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresas_departamento` FOREIGN KEY (`idDepartamento`) REFERENCES `ubicacion_departamento` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresas_pais` FOREIGN KEY (`idPais`) REFERENCES `ubicacion_pais` (`idPais`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresas_tipid` FOREIGN KEY (`idTipoId`) REFERENCES `tipoid` (`idTipoId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,3,'900111111-2','ZZZ S.A.S',1,2,12,'Calle 44 # 11','3021111111','xyz@xyz.com'),(2,3,'900000000-0','XYZ S.A',1,2,14,'CRA 32','4444444','xyz@gmail.com');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entradas_caja`
--

DROP TABLE IF EXISTS `entradas_caja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entradas_caja` (
  `idEntradas` int(11) NOT NULL AUTO_INCREMENT,
  `idCaja` int(11) NOT NULL,
  `idcreditos` int(11) NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `fecha` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idEntradas`),
  KEY `fk_entradasCaja_cajas_idx` (`idCaja`),
  KEY `fk_entradasCaja_creditos_idx` (`idcreditos`),
  CONSTRAINT `fk_entradasCaja_cajas` FOREIGN KEY (`idCaja`) REFERENCES `cajas` (`idCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_entradasCaja_creditos` FOREIGN KEY (`idcreditos`) REFERENCES `creditos` (`idcreditos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entradas_caja`
--

LOCK TABLES `entradas_caja` WRITE;
/*!40000 ALTER TABLE `entradas_caja` DISABLE KEYS */;
/*!40000 ALTER TABLE `entradas_caja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_credito`
--

DROP TABLE IF EXISTS `historial_credito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial_credito` (
  `idHistorial` int(11) NOT NULL AUTO_INCREMENT,
  `idcreditos` int(11) NOT NULL,
  `idEntradas` int(11) DEFAULT NULL,
  `fecha` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `concepto` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor` double(10,0) DEFAULT NULL,
  `iva` int(11) DEFAULT NULL,
  `interes` double(10,0) DEFAULT NULL,
  `capital` int(11) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idHistorial`),
  KEY `fk_historialCredito_creditos` (`idcreditos`),
  KEY `fk_historialCredito_entradasCaja_idx` (`idEntradas`),
  CONSTRAINT `fk_historialCredito_creditos` FOREIGN KEY (`idcreditos`) REFERENCES `creditos` (`idcreditos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_historialCredito_entradasCaja` FOREIGN KEY (`idEntradas`) REFERENCES `entradas_caja` (`idEntradas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_credito`
--

LOCK TABLES `historial_credito` WRITE;
/*!40000 ALTER TABLE `historial_credito` DISABLE KEYS */;
/*!40000 ALTER TABLE `historial_credito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `idPermiso` int(11) NOT NULL AUTO_INCREMENT,
  `nombrePermiso` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idPermiso`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (1,'Informacion Personal'),(2,'Solicitar Cr??dito'),(3,'Mis Cr??ditos'),(4,'Usuarios'),(5,'Contabilidad'),(6,'Cr??ditos'),(7,'Administraci??n');
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos_roles`
--

DROP TABLE IF EXISTS `permisos_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos_roles` (
  `idPermiso` int(11) DEFAULT NULL,
  `idRol` int(11) DEFAULT NULL,
  KEY `permisosRoles_permisos_idx` (`idPermiso`),
  KEY `permisosRoles_roles_idx` (`idRol`),
  CONSTRAINT `permisosRoles_permisos` FOREIGN KEY (`idPermiso`) REFERENCES `permisos` (`idPermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `permisosRoles_roles` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos_roles`
--

LOCK TABLES `permisos_roles` WRITE;
/*!40000 ALTER TABLE `permisos_roles` DISABLE KEYS */;
INSERT INTO `permisos_roles` VALUES (1,1),(2,1),(3,1),(4,2),(5,2),(6,2),(7,2),(4,3),(5,3);
/*!40000 ALTER TABLE `permisos_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `nombreRol` varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
  `estadoRol` varchar(45) CHARACTER SET utf8 NOT NULL,
  `fechaAlta_Rol` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaEdit_Rol` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Deudor','Inactivo','2022-02-15 21:52:50',NULL),(2,'Admin','Activo','2022-02-15 21:52:50',NULL),(3,'otro','','2022-09-16 00:32:22','2022-09-16 00:32:22');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salidas_caja`
--

DROP TABLE IF EXISTS `salidas_caja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salidas_caja` (
  `idSalidasCaja` int(11) NOT NULL AUTO_INCREMENT,
  `idCaja` int(11) DEFAULT NULL,
  `idEmpresa` int(11) DEFAULT NULL,
  `idTipoSalida` int(11) DEFAULT NULL,
  `fecha` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idSalidasCaja`),
  KEY `fk_salidasCaja_cajas_idx` (`idCaja`),
  KEY `fk_salidasCaja_empresas_idx` (`idEmpresa`),
  KEY `fk_salidasCaja_tiposalidas_idx` (`idTipoSalida`),
  CONSTRAINT `fk_salidasCaja_cajas` FOREIGN KEY (`idCaja`) REFERENCES `cajas` (`idCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_salidasCaja_empresas` FOREIGN KEY (`idEmpresa`) REFERENCES `empresas` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_salidasCaja_tiposalidas` FOREIGN KEY (`idTipoSalida`) REFERENCES `tipo_salida` (`idTipoSalida`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salidas_caja`
--

LOCK TABLES `salidas_caja` WRITE;
/*!40000 ALTER TABLE `salidas_caja` DISABLE KEYS */;
/*!40000 ALTER TABLE `salidas_caja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_salida`
--

DROP TABLE IF EXISTS `tipo_salida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_salida` (
  `idTipoSalida` int(11) NOT NULL AUTO_INCREMENT,
  `nombreSalida` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`idTipoSalida`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_salida`
--

LOCK TABLES `tipo_salida` WRITE;
/*!40000 ALTER TABLE `tipo_salida` DISABLE KEYS */;
INSERT INTO `tipo_salida` VALUES (1,'Gasto Operativo'),(2,'Gasto Bancario');
/*!40000 ALTER TABLE `tipo_salida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoid`
--

DROP TABLE IF EXISTS `tipoid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipoid` (
  `idTipoId` int(11) NOT NULL AUTO_INCREMENT,
  `tipoId_nombre` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`idTipoId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoid`
--

LOCK TABLES `tipoid` WRITE;
/*!40000 ALTER TABLE `tipoid` DISABLE KEYS */;
INSERT INTO `tipoid` VALUES (1,'Cedula de Ciudadania'),(2,'Tarjeta de Identidad'),(3,'NIT');
/*!40000 ALTER TABLE `tipoid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ubicacion_ciudmuni`
--

DROP TABLE IF EXISTS `ubicacion_ciudmuni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ubicacion_ciudmuni` (
  `idCiudMuni` int(11) NOT NULL,
  `idDepartamento` int(11) DEFAULT NULL,
  `nombreCiudMuni` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idCiudMuni`),
  KEY `fk_CiudMuni_departamento_idx` (`idDepartamento`),
  CONSTRAINT `fk_CiudMuni_departamento` FOREIGN KEY (`idDepartamento`) REFERENCES `ubicacion_departamento` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ubicacion_ciudmuni`
--

LOCK TABLES `ubicacion_ciudmuni` WRITE;
/*!40000 ALTER TABLE `ubicacion_ciudmuni` DISABLE KEYS */;
INSERT INTO `ubicacion_ciudmuni` VALUES (1,1,'Leticia'),(2,1,'El Encanto'),(3,1,'La Chorrera'),(4,1,'La Pedrera'),(5,1,'La Victoria'),(6,1,'Puerto Arica'),(7,1,'Puerto Nari??o'),(8,1,'Puerto Santander'),(9,1,'Tarapac??'),(10,1,'Puerto Alegr??a'),(11,1,'Miriti Paran??'),(12,2,'Medell??n'),(13,2,'Abejorral'),(14,2,'Abriaqu??'),(15,2,'Alejandr??a'),(16,2,'Amag??'),(17,2,'Amalfi'),(18,2,'Andes'),(19,2,'Angel??polis'),(20,2,'Angostura'),(21,2,'Anor??'),(22,2,'Anza'),(23,2,'Apartad??'),(24,2,'Arboletes'),(25,2,'Argelia'),(26,2,'Armenia'),(27,2,'Barbosa'),(28,2,'Bello'),(29,2,'Betania'),(30,2,'Betulia'),(31,2,'Ciudad Bol??var'),(32,2,'Brice??o'),(33,2,'Buritic??'),(34,2,'C??ceres'),(35,2,'Caicedo'),(36,2,'Caldas'),(37,2,'Campamento'),(38,2,'Ca??asgordas'),(39,2,'Caracol??'),(40,2,'Caramanta'),(41,2,'Carepa'),(42,2,'Carolina'),(43,2,'Caucasia'),(44,2,'Chigorod??'),(45,2,'Cisneros'),(46,2,'Cocorn??'),(47,2,'Concepci??n'),(48,2,'Concordia'),(49,2,'Copacabana'),(50,2,'Dabeiba'),(51,2,'Don Mat??as'),(52,2,'Eb??jico'),(53,2,'El Bagre'),(54,2,'Entrerrios'),(55,2,'Envigado'),(56,2,'Fredonia'),(57,2,'Giraldo'),(58,2,'Girardota'),(59,2,'G??mez Plata'),(60,2,'Guadalupe'),(61,2,'Guarne'),(62,2,'Guatap??'),(63,2,'Heliconia'),(64,2,'Hispania'),(65,2,'Itagui'),(66,2,'Ituango'),(67,2,'Belmira'),(68,2,'Jeric??'),(69,2,'La Ceja'),(70,2,'La Estrella'),(71,2,'La Pintada'),(72,2,'La Uni??n'),(73,2,'Liborina'),(74,2,'Maceo'),(75,2,'Marinilla'),(76,2,'Montebello'),(77,2,'Murind??'),(78,2,'Mutat??'),(79,2,'Nari??o'),(80,2,'Necocl??'),(81,2,'Nech??'),(82,2,'Olaya'),(83,2,'Pe??ol'),(84,2,'Peque'),(85,2,'Pueblorrico'),(86,2,'Puerto Berr??o'),(87,2,'Puerto Nare'),(88,2,'Puerto Triunfo'),(89,2,'Remedios'),(90,2,'Retiro'),(91,2,'Rionegro'),(92,2,'Sabanalarga'),(93,2,'Sabaneta'),(94,2,'Salgar'),(95,2,'San Francisco'),(96,2,'San Jer??nimo'),(97,2,'San Luis'),(98,2,'San Pedro'),(99,2,'San Rafael'),(100,2,'San Roque'),(101,2,'San Vicente'),(102,2,'Santa B??rbara'),(103,2,'Santo Domingo'),(104,2,'El Santuario'),(105,2,'Segovia'),(106,2,'Sopetr??n'),(107,2,'T??mesis'),(108,2,'Taraz??'),(109,2,'Tarso'),(110,2,'Titirib??'),(111,2,'Toledo'),(112,2,'Turbo'),(113,2,'Uramita'),(114,2,'Urrao'),(115,2,'Valdivia'),(116,2,'Valpara??so'),(117,2,'Vegach??'),(118,2,'Venecia'),(119,2,'Yal??'),(120,2,'Yarumal'),(121,2,'Yolomb??'),(122,2,'Yond??'),(123,2,'Zaragoza'),(124,2,'San Pedro de Uraba'),(125,2,'Santaf?? de Antioquia'),(126,2,'Santa Rosa de Osos'),(127,2,'San Andr??s de Cuerqu??a'),(128,2,'Vig??a del Fuerte'),(129,2,'San Jos?? de La Monta??a'),(130,2,'San Juan de Urab??'),(131,2,'El Carmen de Viboral'),(132,2,'San Carlos'),(133,2,'Frontino'),(134,2,'Granada'),(135,2,'Jard??n'),(136,2,'Sons??n'),(137,3,'Arauquita'),(138,3,'Cravo Norte'),(139,3,'Fortul'),(140,3,'Puerto Rond??n'),(141,3,'Saravena'),(142,3,'Tame'),(143,3,'Arauca'),(144,4,'Providencia'),(145,4,'San Andr??s'),(146,5,'Barranquilla'),(147,5,'Baranoa'),(148,5,'Candelaria'),(149,5,'Galapa'),(150,5,'Luruaco'),(151,5,'Malambo'),(152,5,'Manat??'),(153,5,'Pioj??'),(154,5,'Polonuevo'),(155,5,'Sabanagrande'),(156,5,'Sabanalarga'),(157,5,'Santa Luc??a'),(158,5,'Santo Tom??s'),(159,5,'Soledad'),(160,5,'Suan'),(161,5,'Tubar??'),(162,5,'Usiacur??'),(163,5,'Juan de Acosta'),(164,5,'Palmar de Varela'),(165,5,'Campo de La Cruz'),(166,5,'Repel??n'),(167,5,'Puerto Colombia'),(168,5,'Ponedera'),(169,6,'Bogot?? D.C.'),(170,7,'Ach??'),(171,7,'Arenal'),(172,7,'Arjona'),(173,7,'Arroyohondo'),(174,7,'Calamar'),(175,7,'Cantagallo'),(176,7,'Cicuco'),(177,7,'C??rdoba'),(178,7,'Clemencia'),(179,7,'El Guamo'),(180,7,'Magangu??'),(181,7,'Mahates'),(182,7,'Margarita'),(183,7,'Montecristo'),(184,7,'Momp??s'),(185,7,'Morales'),(186,7,'Noros??'),(187,7,'Pinillos'),(188,7,'Regidor'),(189,7,'R??o Viejo'),(190,7,'San Estanislao'),(191,7,'San Fernando'),(192,7,'San Juan Nepomuceno'),(193,7,'Santa Catalina'),(194,7,'Santa Rosa'),(195,7,'Simit??'),(196,7,'Soplaviento'),(197,7,'Talaigua Nuevo'),(198,7,'Tiquisio'),(199,7,'Turbaco'),(200,7,'Turban??'),(201,7,'Villanueva'),(202,7,'Barranco de Loba'),(203,7,'Santa Rosa del Sur'),(204,7,'Hatillo de Loba'),(205,7,'El Carmen de Bol??var'),(206,7,'San Mart??n de Loba'),(207,7,'Altos del Rosario'),(208,7,'San Jacinto del Cauca'),(209,7,'San Pablo de Borbur'),(210,7,'San Jacinto'),(211,7,'El Pe????n'),(212,7,'Cartagena'),(213,7,'Mar??a la Baja'),(214,7,'San Crist??bal'),(215,7,'Zambrano'),(216,8,'Tunungu??'),(217,8,'Motavita'),(218,8,'Ci??nega'),(219,8,'Tunja'),(220,8,'Almeida'),(221,8,'Aquitania'),(222,8,'Arcabuco'),(223,8,'Berbeo'),(224,8,'Bet??itiva'),(225,8,'Boavita'),(226,8,'Boyac??'),(227,8,'Brice??o'),(228,8,'Buena Vista'),(229,8,'Busbanz??'),(230,8,'Caldas'),(231,8,'Campohermoso'),(232,8,'Cerinza'),(233,8,'Chinavita'),(234,8,'Chiquinquir??'),(235,8,'Chiscas'),(236,8,'Chita'),(237,8,'Chitaraque'),(238,8,'Chivat??'),(239,8,'C??mbita'),(240,8,'Coper'),(241,8,'Corrales'),(242,8,'Covarach??a'),(243,8,'Cubar??'),(244,8,'Cucaita'),(245,8,'Cu??tiva'),(246,8,'Ch??quiza'),(247,8,'Chivor'),(248,8,'Duitama'),(249,8,'El Cocuy'),(250,8,'El Espino'),(251,8,'Firavitoba'),(252,8,'Floresta'),(253,8,'Gachantiv??'),(254,8,'Gameza'),(255,8,'Garagoa'),(256,8,'Guacamayas'),(257,8,'Guateque'),(258,8,'Guayat??'),(259,8,'G??ic??n'),(260,8,'Iza'),(261,8,'Jenesano'),(262,8,'Jeric??'),(263,8,'Labranzagrande'),(264,8,'La Capilla'),(265,8,'La Victoria'),(266,8,'Macanal'),(267,8,'Marip??'),(268,8,'Miraflores'),(269,8,'Mongua'),(270,8,'Mongu??'),(271,8,'Moniquir??'),(272,8,'Muzo'),(273,8,'Nobsa'),(274,8,'Nuevo Col??n'),(275,8,'Oicat??'),(276,8,'Otanche'),(277,8,'Pachavita'),(278,8,'P??ez'),(279,8,'Paipa'),(280,8,'Pajarito'),(281,8,'Panqueba'),(282,8,'Pauna'),(283,8,'Paya'),(284,8,'Pesca'),(285,8,'Pisba'),(286,8,'Puerto Boyac??'),(287,8,'Qu??pama'),(288,8,'Ramiriqu??'),(289,8,'R??quira'),(290,8,'Rond??n'),(291,8,'Saboy??'),(292,8,'S??chica'),(293,8,'Samac??'),(294,8,'San Eduardo'),(295,8,'San Mateo'),(296,8,'Santana'),(297,8,'Santa Mar??a'),(298,8,'Santa Sof??a'),(299,8,'Sativanorte'),(300,8,'Sativasur'),(301,8,'Siachoque'),(302,8,'Soat??'),(303,8,'Socot??'),(304,8,'Socha'),(305,8,'Sogamoso'),(306,8,'Somondoco'),(307,8,'Sora'),(308,8,'Sotaquir??'),(309,8,'Sorac??'),(310,8,'Susac??n'),(311,8,'Sutamarch??n'),(312,8,'Sutatenza'),(313,8,'Tasco'),(314,8,'Tenza'),(315,8,'Tiban??'),(316,8,'Tinjac??'),(317,8,'Tipacoque'),(318,8,'Toca'),(319,8,'T??paga'),(320,8,'Tota'),(321,8,'Turmequ??'),(322,8,'Tutaz??'),(323,8,'Umbita'),(324,8,'Ventaquemada'),(325,8,'Viracach??'),(326,8,'Zetaquira'),(327,8,'Tog????'),(328,8,'Villa de Leyva'),(329,8,'Paz de R??o'),(330,8,'Santa Rosa de Viterbo'),(331,8,'San Pablo de Borbur'),(332,8,'San Luis de Gaceno'),(333,8,'San Jos?? de Pare'),(334,8,'San Miguel de Sema'),(335,8,'Tuta'),(336,8,'Tibasosa'),(337,8,'La Uvita'),(338,8,'Bel??n'),(339,9,'Manizales'),(340,9,'Aguadas'),(341,9,'Anserma'),(342,9,'Aranzazu'),(343,9,'Belalc??zar'),(344,9,'Chinchin??'),(345,9,'Filadelfia'),(346,9,'La Dorada'),(347,9,'La Merced'),(348,9,'Manzanares'),(349,9,'Marmato'),(350,9,'Marulanda'),(351,9,'Neira'),(352,9,'Norcasia'),(353,9,'P??cora'),(354,9,'Palestina'),(355,9,'Pensilvania'),(356,9,'Riosucio'),(357,9,'Risaralda'),(358,9,'Salamina'),(359,9,'Saman??'),(360,9,'San Jos??'),(361,9,'Sup??a'),(362,9,'Victoria'),(363,9,'Villamar??a'),(364,9,'Viterbo'),(365,9,'Marquetalia'),(366,10,'Florencia'),(367,10,'Albania'),(368,10,'Curillo'),(369,10,'El Doncello'),(370,10,'El Paujil'),(371,10,'Morelia'),(372,10,'Puerto Rico'),(373,10,'Solano'),(374,10,'Solita'),(375,10,'Valpara??so'),(376,10,'San Jos?? del Fragua'),(377,10,'Bel??n de Los Andaquies'),(378,10,'Cartagena del Chair??'),(379,10,'Mil??n'),(380,10,'La Monta??ita'),(381,10,'San Vicente del Cagu??n'),(382,11,'Yopal'),(383,11,'Aguazul'),(384,11,'Ch??meza'),(385,11,'Hato Corozal'),(386,11,'La Salina'),(387,11,'Monterrey'),(388,11,'Pore'),(389,11,'Recetor'),(390,11,'Sabanalarga'),(391,11,'S??cama'),(392,11,'Tauramena'),(393,11,'Trinidad'),(394,11,'Villanueva'),(395,11,'San Luis de Gaceno'),(396,11,'Paz de Ariporo'),(397,11,'Nunch??a'),(398,11,'Man??'),(399,11,'T??mara'),(400,11,'Orocu??'),(401,12,'Popay??n'),(402,12,'Almaguer'),(403,12,'Argelia'),(404,12,'Balboa'),(405,12,'Bol??var'),(406,12,'Buenos Aires'),(407,12,'Cajib??o'),(408,12,'Caldono'),(409,12,'Caloto'),(410,12,'Corinto'),(411,12,'El Tambo'),(412,12,'Florencia'),(413,12,'Guachen??'),(414,12,'Guapi'),(415,12,'Inz??'),(416,12,'Jambal??'),(417,12,'La Sierra'),(418,12,'La Vega'),(419,12,'L??pez'),(420,12,'Mercaderes'),(421,12,'Miranda'),(422,12,'Morales'),(423,12,'Padilla'),(424,12,'Pat??a'),(425,12,'Piamonte'),(426,12,'Piendam??'),(427,12,'Puerto Tejada'),(428,12,'Purac??'),(429,12,'Rosas'),(430,12,'Santa Rosa'),(431,12,'Silvia'),(432,12,'Sotara'),(433,12,'Su??rez'),(434,12,'Sucre'),(435,12,'Timb??o'),(436,12,'Timbiqu??'),(437,12,'Toribio'),(438,12,'Totor??'),(439,12,'Villa Rica'),(440,12,'Santander de Quilichao'),(441,12,'San Sebasti??n'),(442,12,'P??ez'),(443,13,'Valledupar'),(444,13,'Aguachica'),(445,13,'Agust??n Codazzi'),(446,13,'Astrea'),(447,13,'Becerril'),(448,13,'Bosconia'),(449,13,'Chimichagua'),(450,13,'Chiriguan??'),(451,13,'Curuman??'),(452,13,'El Copey'),(453,13,'El Paso'),(454,13,'Gamarra'),(455,13,'Gonz??lez'),(456,13,'La Gloria'),(457,13,'Manaure'),(458,13,'Pailitas'),(459,13,'Pelaya'),(460,13,'Pueblo Bello'),(461,13,'La Paz'),(462,13,'San Alberto'),(463,13,'San Diego'),(464,13,'San Mart??n'),(465,13,'Tamalameque'),(466,13,'R??o de Oro'),(467,13,'La Jagua de Ibirico'),(468,14,'Istmina'),(469,14,'Quibd??'),(470,14,'Acand??'),(471,14,'Alto Baudo'),(472,14,'Atrato'),(473,14,'Bagad??'),(474,14,'Bah??a Solano'),(475,14,'Bajo Baud??'),(476,14,'Bojaya'),(477,14,'C??rtegui'),(478,14,'Condoto'),(479,14,'Jurad??'),(480,14,'Llor??'),(481,14,'Medio Atrato'),(482,14,'Medio Baud??'),(483,14,'Medio San Juan'),(484,14,'N??vita'),(485,14,'Nuqu??'),(486,14,'R??o Iro'),(487,14,'R??o Quito'),(488,14,'Riosucio'),(489,14,'Sip??'),(490,14,'Ungu??a'),(491,14,'El Litoral del San Juan'),(492,14,'El Cant??n del San Pablo'),(493,14,'El Carmen de Atrato'),(494,14,'San Jos?? del Palmar'),(495,14,'Bel??n de Bajira'),(496,14,'Carmen del Darien'),(497,14,'Tad??'),(498,14,'Uni??n Panamericana'),(499,15,'San Bernardo del Viento'),(500,15,'Monter??a'),(501,15,'Ayapel'),(502,15,'Buenavista'),(503,15,'Canalete'),(504,15,'Ceret??'),(505,15,'Chim??'),(506,15,'Chin??'),(507,15,'Cotorra'),(508,15,'Lorica'),(509,15,'Los C??rdobas'),(510,15,'Momil'),(511,15,'Mo??itos'),(512,15,'Planeta Rica'),(513,15,'Pueblo Nuevo'),(514,15,'Puerto Escondido'),(515,15,'Pur??sima'),(516,15,'Sahag??n'),(517,15,'San Andr??s Sotavento'),(518,15,'San Antero'),(519,15,'San Pelayo'),(520,15,'Tierralta'),(521,15,'Tuch??n'),(522,15,'Valencia'),(523,15,'San Jos?? de Ur??'),(524,15,'Ci??naga de Oro'),(525,15,'San Carlos'),(526,15,'Montel??bano'),(527,15,'La Apartada'),(528,15,'Puerto Libertador'),(529,16,'Anapoima'),(530,16,'Arbel??ez'),(531,16,'Beltr??n'),(532,16,'Bituima'),(533,16,'Bojac??'),(534,16,'Cabrera'),(535,16,'Cachipay'),(536,16,'Cajic??'),(537,16,'Caparrap??'),(538,16,'Caqueza'),(539,16,'Chaguan??'),(540,16,'Chipaque'),(541,16,'Choach??'),(542,16,'Chocont??'),(543,16,'Cogua'),(544,16,'Cota'),(545,16,'Cucunub??'),(546,16,'El Colegio'),(547,16,'El Rosal'),(548,16,'Fomeque'),(549,16,'Fosca'),(550,16,'Funza'),(551,16,'F??quene'),(552,16,'Gachala'),(553,16,'Gachancip??'),(554,16,'Gachet??'),(555,16,'Girardot'),(556,16,'Granada'),(557,16,'Guachet??'),(558,16,'Guaduas'),(559,16,'Guasca'),(560,16,'Guataqu??'),(561,16,'Guatavita'),(562,16,'Guayabetal'),(563,16,'Guti??rrez'),(564,16,'Jerusal??n'),(565,16,'Jun??n'),(566,16,'La Calera'),(567,16,'La Mesa'),(568,16,'La Palma'),(569,16,'La Pe??a'),(570,16,'La Vega'),(571,16,'Lenguazaque'),(572,16,'Macheta'),(573,16,'Madrid'),(574,16,'Manta'),(575,16,'Medina'),(576,16,'Mosquera'),(577,16,'Nari??o'),(578,16,'Nemoc??n'),(579,16,'Nilo'),(580,16,'Nimaima'),(581,16,'Nocaima'),(582,16,'Venecia'),(583,16,'Pacho'),(584,16,'Paime'),(585,16,'Pandi'),(586,16,'Paratebueno'),(587,16,'Pasca'),(588,16,'Puerto Salgar'),(589,16,'Pul??'),(590,16,'Quebradanegra'),(591,16,'Quetame'),(592,16,'Quipile'),(593,16,'Apulo'),(594,16,'Ricaurte'),(595,16,'San Bernardo'),(596,16,'San Cayetano'),(597,16,'San Francisco'),(598,16,'Sesquil??'),(599,16,'Sibat??'),(600,16,'Silvania'),(601,16,'Simijaca'),(602,16,'Soacha'),(603,16,'Subachoque'),(604,16,'Suesca'),(605,16,'Supat??'),(606,16,'Susa'),(607,16,'Sutatausa'),(608,16,'Tabio'),(609,16,'Tausa'),(610,16,'Tena'),(611,16,'Tenjo'),(612,16,'Tibacuy'),(613,16,'Tibirita'),(614,16,'Tocaima'),(615,16,'Tocancip??'),(616,16,'Topaip??'),(617,16,'Ubal??'),(618,16,'Ubaque'),(619,16,'Une'),(620,16,'??tica'),(621,16,'Vian??'),(622,16,'Villag??mez'),(623,16,'Villapinz??n'),(624,16,'Villeta'),(625,16,'Viot??'),(626,16,'Zipac??n'),(627,16,'San Juan de R??o Seco'),(628,16,'Villa de San Diego de Ubate'),(629,16,'Guayabal de Siquima'),(630,16,'San Antonio del Tequendama'),(631,16,'Agua de Dios'),(632,16,'Carmen de Carupa'),(633,16,'Vergara'),(634,16,'Alb??n'),(635,16,'Anolaima'),(636,16,'Ch??a'),(637,16,'El Pe????n'),(638,16,'Sop??'),(639,16,'Gama'),(640,16,'Sasaima'),(641,16,'Yacop??'),(642,16,'Fusagasug??'),(643,16,'Zipaquir??'),(644,16,'Facatativ??'),(645,17,'In??rida'),(646,17,'Barranco Minas'),(647,17,'Mapiripana'),(648,17,'San Felipe'),(649,17,'Puerto Colombia'),(650,17,'La Guadalupe'),(651,17,'Cacahual'),(652,17,'Pana Pana'),(653,17,'Morichal'),(654,18,'Calamar'),(655,18,'San Jos?? del Guaviare'),(656,18,'Miraflores'),(657,18,'El Retorno'),(658,19,'Neiva'),(659,19,'Acevedo'),(660,19,'Agrado'),(661,19,'Aipe'),(662,19,'Algeciras'),(663,19,'Altamira'),(664,19,'Baraya'),(665,19,'Campoalegre'),(666,19,'Colombia'),(667,19,'El??as'),(668,19,'Garz??n'),(669,19,'Gigante'),(670,19,'Guadalupe'),(671,19,'Hobo'),(672,19,'Iquira'),(673,19,'Isnos'),(674,19,'La Argentina'),(675,19,'La Plata'),(676,19,'N??taga'),(677,19,'Oporapa'),(678,19,'Paicol'),(679,19,'Palermo'),(680,19,'Palestina'),(681,19,'Pital'),(682,19,'Pitalito'),(683,19,'Rivera'),(684,19,'Saladoblanco'),(685,19,'Santa Mar??a'),(686,19,'Suaza'),(687,19,'Tarqui'),(688,19,'Tesalia'),(689,19,'Tello'),(690,19,'Teruel'),(691,19,'Timan??'),(692,19,'Villavieja'),(693,19,'Yaguar??'),(694,19,'San Agust??n'),(695,20,'Riohacha'),(696,20,'Albania'),(697,20,'Barrancas'),(698,20,'Dibula'),(699,20,'Distracci??n'),(700,20,'El Molino'),(701,20,'Fonseca'),(702,20,'Hatonuevo'),(703,20,'Maicao'),(704,20,'Manaure'),(705,20,'Uribia'),(706,20,'Urumita'),(707,20,'Villanueva'),(708,20,'La Jagua del Pilar'),(709,20,'San Juan del Cesar'),(710,21,'Santa Marta'),(711,21,'Algarrobo'),(712,21,'Aracataca'),(713,21,'Ariguan??'),(714,21,'Cerro San Antonio'),(715,21,'Chivolo'),(716,21,'Concordia'),(717,21,'El Banco'),(718,21,'El Pi??on'),(719,21,'El Ret??n'),(720,21,'Fundaci??n'),(721,21,'Guamal'),(722,21,'Nueva Granada'),(723,21,'Pedraza'),(724,21,'Pivijay'),(725,21,'Plato'),(726,21,'Remolino'),(727,21,'Salamina'),(728,21,'San Zen??n'),(729,21,'Santa Ana'),(730,21,'Sitionuevo'),(731,21,'Tenerife'),(732,21,'Zapay??n'),(733,21,'Zona Bananera'),(734,21,'San Sebasti??n de Buenavista'),(735,21,'Sabanas de San Angel'),(736,21,'Piji??o del Carmen'),(737,21,'Santa B??rbara de Pinto'),(738,21,'Pueblo Viejo'),(739,21,'Ci??naga'),(740,22,'Uribe'),(741,22,'Villavicencio'),(742,22,'Acacias'),(743,22,'Cabuyaro'),(744,22,'Cubarral'),(745,22,'Cumaral'),(746,22,'El Calvario'),(747,22,'El Castillo'),(748,22,'El Dorado'),(749,22,'Granada'),(750,22,'Guamal'),(751,22,'Mapirip??n'),(752,22,'Mesetas'),(753,22,'La Macarena'),(754,22,'Lejan??as'),(755,22,'Puerto Concordia'),(756,22,'Puerto Gait??n'),(757,22,'Puerto L??pez'),(758,22,'Puerto Lleras'),(759,22,'Puerto Rico'),(760,22,'Restrepo'),(761,22,'San Juanito'),(762,22,'San Mart??n'),(763,22,'Vista Hermosa'),(764,22,'Barranca de Up??a'),(765,22,'Fuente de Oro'),(766,22,'San Carlos de Guaroa'),(767,22,'San Juan de Arama'),(768,22,'Castilla la Nueva'),(769,23,'Santacruz'),(770,23,'Pasto'),(771,23,'Alb??n'),(772,23,'Aldana'),(773,23,'Ancuy??'),(774,23,'Barbacoas'),(775,23,'Col??n'),(776,23,'Consaca'),(777,23,'Contadero'),(778,23,'C??rdoba'),(779,23,'Cuaspud'),(780,23,'Cumbal'),(781,23,'Cumbitara'),(782,23,'El Charco'),(783,23,'El Pe??ol'),(784,23,'El Rosario'),(785,23,'El Tambo'),(786,23,'Funes'),(787,23,'Guachucal'),(788,23,'Guaitarilla'),(789,23,'Gualmat??n'),(790,23,'Iles'),(791,23,'Imu??s'),(792,23,'Ipiales'),(793,23,'La Cruz'),(794,23,'La Florida'),(795,23,'La Llanada'),(796,23,'La Tola'),(797,23,'La Uni??n'),(798,23,'Leiva'),(799,23,'Linares'),(800,23,'Los Andes'),(801,23,'Mag????'),(802,23,'Mallama'),(803,23,'Mosquera'),(804,23,'Nari??o'),(805,23,'Olaya Herrera'),(806,23,'Ospina'),(807,23,'Francisco Pizarro'),(808,23,'Policarpa'),(809,23,'Potos??'),(810,23,'Providencia'),(811,23,'Puerres'),(812,23,'Pupiales'),(813,23,'Ricaurte'),(814,23,'Roberto Pay??n'),(815,23,'Samaniego'),(816,23,'Sandon??'),(817,23,'San Bernardo'),(818,23,'San Lorenzo'),(819,23,'San Pablo'),(820,23,'Santa B??rbara'),(821,23,'Sapuyes'),(822,23,'Taminango'),(823,23,'Tangua'),(824,23,'T??querres'),(825,23,'Yacuanquer'),(826,23,'San Pedro de Cartago'),(827,23,'El Tabl??n de G??mez'),(828,23,'Buesaco'),(829,23,'San Andr??s de Tumaco'),(830,23,'Bel??n'),(831,23,'Chachag????'),(832,23,'Arboleda'),(833,24,'Silos'),(834,24,'C??cota'),(835,24,'Toledo'),(836,24,'Mutiscua'),(837,24,'El Zulia'),(838,24,'Salazar'),(839,24,'Cucutilla'),(840,24,'Puerto Santander'),(841,24,'Gramalote'),(842,24,'El Tarra'),(843,24,'Teorama'),(844,24,'Arboledas'),(845,24,'Lourdes'),(846,24,'Bochalema'),(847,24,'Convenci??n'),(848,24,'Hacar??'),(849,24,'Herr??n'),(850,24,'Tib??'),(851,24,'San Cayetano'),(852,24,'San Calixto'),(853,24,'La Playa'),(854,24,'Chin??cota'),(855,24,'Ragonvalia'),(856,24,'La Esperanza'),(857,24,'Villa del Rosario'),(858,24,'Chitag??'),(859,24,'Sardinata'),(860,24,'Abrego'),(861,24,'Los Patios'),(862,24,'Oca??a'),(863,24,'Bucarasica'),(864,24,'Santiago'),(865,24,'Labateca'),(866,24,'Cachir??'),(867,24,'Villa Caro'),(868,24,'Durania'),(869,24,'Pamplona'),(870,24,'Pamplonita'),(871,24,'C??cuta'),(872,24,'El Carmen'),(873,25,'Mocoa'),(874,25,'Col??n'),(875,25,'Orito'),(876,25,'Puerto Caicedo'),(877,25,'Puerto Guzm??n'),(878,25,'Legu??zamo'),(879,25,'Sibundoy'),(880,25,'San Francisco'),(881,25,'San Miguel'),(882,25,'Santiago'),(883,25,'Valle de Guamez'),(884,25,'Puerto As??s'),(885,25,'Villagarz??n'),(886,26,'Armenia'),(887,26,'Buenavista'),(888,26,'Circasia'),(889,26,'C??rdoba'),(890,26,'Filandia'),(891,26,'La Tebaida'),(892,26,'Montenegro'),(893,26,'Pijao'),(894,26,'Quimbaya'),(895,26,'Salento'),(896,26,'Calarc??'),(897,26,'G??nova'),(898,27,'Pereira'),(899,27,'Ap??a'),(900,27,'Balboa'),(901,27,'Dosquebradas'),(902,27,'Gu??tica'),(903,27,'La Celia'),(904,27,'La Virginia'),(905,27,'Marsella'),(906,27,'Mistrat??'),(907,27,'Pueblo Rico'),(908,27,'Quinch??a'),(909,27,'Santuario'),(910,27,'Santa Rosa de Cabal'),(911,27,'Bel??n de Umbr??a'),(912,28,'Puerto Wilches'),(913,28,'Puerto Parra'),(914,28,'Bucaramanga'),(915,28,'Aguada'),(916,28,'Albania'),(917,28,'Aratoca'),(918,28,'Barbosa'),(919,28,'Barichara'),(920,28,'Barrancabermeja'),(921,28,'Betulia'),(922,28,'Bol??var'),(923,28,'Cabrera'),(924,28,'California'),(925,28,'Carcas??'),(926,28,'Cepit??'),(927,28,'Cerrito'),(928,28,'Charal??'),(929,28,'Charta'),(930,28,'Chipat??'),(931,28,'Cimitarra'),(932,28,'Concepci??n'),(933,28,'Confines'),(934,28,'Contrataci??n'),(935,28,'Coromoro'),(936,28,'Curit??'),(937,28,'El Guacamayo'),(938,28,'El Play??n'),(939,28,'Encino'),(940,28,'Enciso'),(941,28,'Flori??n'),(942,28,'Floridablanca'),(943,28,'Gal??n'),(944,28,'Gambita'),(945,28,'Gir??n'),(946,28,'Guaca'),(947,28,'Guadalupe'),(948,28,'Guapot??'),(949,28,'Guavat??'),(950,28,'G??epsa'),(951,28,'Jes??s Mar??a'),(952,28,'Jord??n'),(953,28,'La Belleza'),(954,28,'Land??zuri'),(955,28,'La Paz'),(956,28,'Lebr??ja'),(957,28,'Los Santos'),(958,28,'Macaravita'),(959,28,'M??laga'),(960,28,'Matanza'),(961,28,'Mogotes'),(962,28,'Molagavita'),(963,28,'Ocamonte'),(964,28,'Oiba'),(965,28,'Onzaga'),(966,28,'Palmar'),(967,28,'P??ramo'),(968,28,'Piedecuesta'),(969,28,'Pinchote'),(970,28,'Puente Nacional'),(971,28,'Rionegro'),(972,28,'San Andr??s'),(973,28,'San Gil'),(974,28,'San Joaqu??n'),(975,28,'San Miguel'),(976,28,'Santa B??rbara'),(977,28,'Simacota'),(978,28,'Socorro'),(979,28,'Suaita'),(980,28,'Sucre'),(981,28,'Surat??'),(982,28,'Tona'),(983,28,'V??lez'),(984,28,'Vetas'),(985,28,'Villanueva'),(986,28,'Zapatoca'),(987,28,'Palmas del Socorro'),(988,28,'San Vicente de Chucur??'),(989,28,'San Jos?? de Miranda'),(990,28,'Santa Helena del Op??n'),(991,28,'Sabana de Torres'),(992,28,'El Carmen de Chucur??'),(993,28,'Valle de San Jos??'),(994,28,'San Benito'),(995,28,'Hato'),(996,28,'Chim??'),(997,28,'Capitanejo'),(998,28,'El Pe????n'),(999,29,'Sincelejo'),(1000,29,'Buenavista'),(1001,29,'Caimito'),(1002,29,'Coloso'),(1003,29,'Cove??as'),(1004,29,'Chal??n'),(1005,29,'El Roble'),(1006,29,'Galeras'),(1007,29,'Guaranda'),(1008,29,'La Uni??n'),(1009,29,'Los Palmitos'),(1010,29,'Majagual'),(1011,29,'Morroa'),(1012,29,'Ovejas'),(1013,29,'Palmito'),(1014,29,'San Benito Abad'),(1015,29,'San Marcos'),(1016,29,'San Onofre'),(1017,29,'San Pedro'),(1018,29,'Sucre'),(1019,29,'Tol?? Viejo'),(1020,29,'San Luis de Sinc??'),(1021,29,'San Juan de Betulia'),(1022,29,'Santiago de Tol??'),(1023,29,'Sampu??s'),(1024,29,'Corozal'),(1025,30,'Alpujarra'),(1026,30,'Alvarado'),(1027,30,'Ambalema'),(1028,30,'Armero'),(1029,30,'Ataco'),(1030,30,'Cajamarca'),(1031,30,'Chaparral'),(1032,30,'Coello'),(1033,30,'Coyaima'),(1034,30,'Cunday'),(1035,30,'Dolores'),(1036,30,'Espinal'),(1037,30,'Falan'),(1038,30,'Flandes'),(1039,30,'Fresno'),(1040,30,'Guamo'),(1041,30,'Herveo'),(1042,30,'Honda'),(1043,30,'Icononzo'),(1044,30,'Mariquita'),(1045,30,'Melgar'),(1046,30,'Murillo'),(1047,30,'Natagaima'),(1048,30,'Ortega'),(1049,30,'Palocabildo'),(1050,30,'Piedras'),(1051,30,'Planadas'),(1052,30,'Prado'),(1053,30,'Purificaci??n'),(1054,30,'Rio Blanco'),(1055,30,'Roncesvalles'),(1056,30,'Rovira'),(1057,30,'Salda??a'),(1058,30,'Santa Isabel'),(1059,30,'Venadillo'),(1060,30,'Villahermosa'),(1061,30,'Villarrica'),(1062,30,'Valle de San Juan'),(1063,30,'Carmen de Apicala'),(1064,30,'San Luis'),(1065,30,'San Antonio'),(1066,30,'Casabianca'),(1067,30,'Anzo??tegui'),(1068,30,'Ibagu??'),(1069,30,'L??bano'),(1070,30,'L??rida'),(1071,30,'Su??rez'),(1072,31,'El Dovio'),(1073,31,'Roldanillo'),(1074,31,'Argelia'),(1075,31,'Sevilla'),(1076,31,'Zarzal'),(1077,31,'El Cerrito'),(1078,31,'Cartago'),(1079,31,'Caicedonia'),(1080,31,'El Cairo'),(1081,31,'La Uni??n'),(1082,31,'Restrepo'),(1083,31,'Dagua'),(1084,31,'Guacar??'),(1085,31,'Ansermanuevo'),(1086,31,'Bugalagrande'),(1087,31,'La Victoria'),(1088,31,'Ginebra'),(1089,31,'Yumbo'),(1090,31,'Obando'),(1091,31,'Bol??var'),(1092,31,'Cali'),(1093,31,'San Pedro'),(1094,31,'Guadalajara de Buga'),(1095,31,'Calima'),(1096,31,'Andaluc??a'),(1097,31,'Pradera'),(1098,31,'Yotoco'),(1099,31,'Palmira'),(1100,31,'Riofr??o'),(1101,31,'Alcal??'),(1102,31,'Versalles'),(1103,31,'El ??guila'),(1104,31,'Toro'),(1105,31,'Candelaria'),(1106,31,'La Cumbre'),(1107,31,'Ulloa'),(1108,31,'Trujillo'),(1109,31,'Vijes'),(1110,31,'Tulu??'),(1111,31,'Florida'),(1112,31,'Jamund??'),(1113,31,'Buenaventura'),(1114,32,'Puerto Carre??o'),(1115,32,'La Primavera'),(1116,32,'Santa Rosal??a'),(1117,32,'Cumaribo');
/*!40000 ALTER TABLE `ubicacion_ciudmuni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ubicacion_departamento`
--

DROP TABLE IF EXISTS `ubicacion_departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ubicacion_departamento` (
  `idDepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `idPais` int(4) DEFAULT NULL,
  `nombreDepartamento` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idDepartamento`),
  UNIQUE KEY `idDepartamento_UNIQUE` (`idDepartamento`),
  UNIQUE KEY `nombreDepartamento_UNIQUE` (`nombreDepartamento`),
  KEY `fk_departamento_pais_idx` (`idPais`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ubicacion_departamento`
--

LOCK TABLES `ubicacion_departamento` WRITE;
/*!40000 ALTER TABLE `ubicacion_departamento` DISABLE KEYS */;
INSERT INTO `ubicacion_departamento` VALUES (1,1,'Amazonas'),(2,1,'Antioquia'),(3,1,'Arauca'),(4,1,'Archipi??lago de San Andr??s'),(5,1,'Atl??ntico'),(6,1,'Bogot?? D.C.'),(7,1,'Bol??var'),(8,1,'Boyac??'),(9,1,'Caldas'),(10,1,'Caquet??'),(11,1,'Casanare'),(12,1,'Cauca'),(13,1,'Cesar'),(14,1,'Choc??'),(15,1,'C??rdoba'),(16,1,'Cundinamarca'),(17,1,'Guain??a'),(18,1,'Guaviare'),(19,1,'Huila'),(20,1,'La Guajira'),(21,1,'Magdalena'),(22,1,'Meta'),(23,1,'Nari??o'),(24,1,'Norte de Santander'),(25,1,'Putumayo'),(26,1,'Quind??o'),(27,1,'Risaralda'),(28,1,'Santander'),(29,1,'Sucre'),(30,1,'Tolima'),(31,1,'Valle del Cauca'),(32,1,'Vichada');
/*!40000 ALTER TABLE `ubicacion_departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ubicacion_pais`
--

DROP TABLE IF EXISTS `ubicacion_pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ubicacion_pais` (
  `idPais` int(4) NOT NULL,
  `nombrePais` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idPais`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ubicacion_pais`
--

LOCK TABLES `ubicacion_pais` WRITE;
/*!40000 ALTER TABLE `ubicacion_pais` DISABLE KEYS */;
INSERT INTO `ubicacion_pais` VALUES (1,'Colombia');
/*!40000 ALTER TABLE `ubicacion_pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `idRol` int(11) NOT NULL,
  `estadoUsuario` varchar(11) CHARACTER SET utf8mb4 NOT NULL,
  `fechaAlta_Us` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaEdit_Us` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `nombreUsuario_UNIQUE` (`nombreUsuario`),
  KEY `fk_usuarios_roles_idx` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Erika','$2y$10$nyhWhOUmo8tZY178fYf3dONKX43LQUcwL8GNgQGiSeq6CFIGezWoK',2,'Activo','2022-08-12 03:52:08','2022-08-29 16:56:48'),(2,'Laura','$2y$10$4b.aLebd05yoVb.CTdmhfO0bxUgb2HadEr8od4J4.JJWpsSV.CdoW',1,'Activo','2022-09-21 01:03:16',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'gestorcreditos'
--

--
-- Dumping routines for database 'gestorcreditos'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-20 23:53:54
