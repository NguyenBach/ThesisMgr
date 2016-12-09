-- MySQL dump 10.13  Distrib 5.7.15, for Linux (x86_64)
--
-- Host: localhost    Database: thesismgr
-- ------------------------------------------------------
-- Server version	5.7.13-0ubuntu0.16.04.2

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
-- Table structure for table `bomon`
--

DROP TABLE IF EXISTS `bomon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bomon` (
  `id` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `facultyid` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_faculty_subjects` (`facultyid`),
  CONSTRAINT `fk_faculty_subjects` FOREIGN KEY (`facultyid`) REFERENCES `khoa` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bomon`
--

LOCK TABLES `bomon` WRITE;
/*!40000 ALTER TABLE `bomon` DISABLE KEYS */;
/*!40000 ALTER TABLE `bomon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chuongtrinhdaotao`
--

DROP TABLE IF EXISTS `chuongtrinhdaotao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chuongtrinhdaotao` (
  `code` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chuongtrinhdaotao`
--

LOCK TABLES `chuongtrinhdaotao` WRITE;
/*!40000 ALTER TABLE `chuongtrinhdaotao` DISABLE KEYS */;
/*!40000 ALTER TABLE `chuongtrinhdaotao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detai`
--

DROP TABLE IF EXISTS `detai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `student` varchar(8) NOT NULL,
  `teacher` varchar(8) NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_detai_sinhvien_idx` (`student`),
  KEY `fk_detai_giangvien_idx` (`teacher`),
  CONSTRAINT `fk_detai_giangvien` FOREIGN KEY (`teacher`) REFERENCES `giangvien` (`teacherCode`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detai_sinhvien` FOREIGN KEY (`student`) REFERENCES `hocvien` (`studentCode`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detai`
--

LOCK TABLES `detai` WRITE;
/*!40000 ALTER TABLE `detai` DISABLE KEYS */;
/*!40000 ALTER TABLE `detai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donvi`
--

DROP TABLE IF EXISTS `donvi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donvi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacherCode` varchar(8) NOT NULL,
  `faculty` varchar(8) NOT NULL,
  `subjects` varchar(8) DEFAULT NULL,
  `ptn` varchar(8) DEFAULT NULL,
  `vpk` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_donvi_teacher_idx` (`teacherCode`),
  KEY `fk_donvi_faculty_idx` (`faculty`),
  KEY `fk_donvi_subject_idx` (`subjects`),
  KEY `fk_donvi_ptn_idx` (`ptn`),
  KEY `fk_donvi_vpk_idx` (`vpk`),
  CONSTRAINT `fk_donvi_faculty` FOREIGN KEY (`faculty`) REFERENCES `khoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_donvi_ptn` FOREIGN KEY (`ptn`) REFERENCES `ptn` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_donvi_subject` FOREIGN KEY (`subjects`) REFERENCES `bomon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_donvi_teacher` FOREIGN KEY (`teacherCode`) REFERENCES `giangvien` (`teacherCode`) ON DELETE CASCADE,
  CONSTRAINT `fk_donvi_vpk` FOREIGN KEY (`vpk`) REFERENCES `vpk` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donvi`
--

LOCK TABLES `donvi` WRITE;
/*!40000 ALTER TABLE `donvi` DISABLE KEYS */;
/*!40000 ALTER TABLE `donvi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `giangvien`
--

DROP TABLE IF EXISTS `giangvien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `giangvien` (
  `teacherCode` varchar(8) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `vnuMail` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`teacherCode`),
  KEY `fk_giangvien_user_idx` (`userid`),
  CONSTRAINT `fk_giangvien_user` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `giangvien`
--

LOCK TABLES `giangvien` WRITE;
/*!40000 ALTER TABLE `giangvien` DISABLE KEYS */;
/*!40000 ALTER TABLE `giangvien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `giangvien_linhvuc`
--

DROP TABLE IF EXISTS `giangvien_linhvuc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `giangvien_linhvuc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacherCode` varchar(8) NOT NULL,
  `linhvuc` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_teacher_linhvuc_idx` (`teacherCode`),
  KEY `fk_teacher_linhvuc_2_idx` (`linhvuc`),
  CONSTRAINT `fk_teacher_linhvuc` FOREIGN KEY (`teacherCode`) REFERENCES `giangvien` (`teacherCode`) ON UPDATE CASCADE,
  CONSTRAINT `fk_teacher_linhvuc_2` FOREIGN KEY (`linhvuc`) REFERENCES `linhvuc` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `giangvien_linhvuc`
--

LOCK TABLES `giangvien_linhvuc` WRITE;
/*!40000 ALTER TABLE `giangvien_linhvuc` DISABLE KEYS */;
/*!40000 ALTER TABLE `giangvien_linhvuc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hocvien`
--

DROP TABLE IF EXISTS `hocvien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hocvien` (
  `studentCode` varchar(8) NOT NULL,
  `fullname` varchar(45) NOT NULL,
  `khoahoc` varchar(8) NOT NULL,
  `ctdt` varchar(8) NOT NULL,
  `vnuMail` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`studentCode`),
  KEY `fk_hocvien_khoahoc_idx` (`khoahoc`),
  KEY `fk_hocvien_ctdt_idx` (`ctdt`),
  KEY `fk_hocvien_user_idx` (`userid`),
  CONSTRAINT `fk_hocvien_ctdt` FOREIGN KEY (`ctdt`) REFERENCES `chuongtrinhdaotao` (`code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_hocvien_khoahoc` FOREIGN KEY (`khoahoc`) REFERENCES `khoahoc` (`code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_hocvien_user` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hocvien`
--

LOCK TABLES `hocvien` WRITE;
/*!40000 ALTER TABLE `hocvien` DISABLE KEYS */;
/*!40000 ALTER TABLE `hocvien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hoso`
--

DROP TABLE IF EXISTS `hoso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hoso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student` varchar(8) NOT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hoso_sinhvien_idx` (`student`),
  CONSTRAINT `fk_hoso_sinhvien` FOREIGN KEY (`student`) REFERENCES `hocvien` (`studentCode`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hoso`
--

LOCK TABLES `hoso` WRITE;
/*!40000 ALTER TABLE `hoso` DISABLE KEYS */;
/*!40000 ALTER TABLE `hoso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `huongnghiencuu`
--

DROP TABLE IF EXISTS `huongnghiencuu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `huongnghiencuu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teachercode` varchar(8) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_huongnghiencuu_teacher_idx` (`teachercode`),
  CONSTRAINT `fk_huongnghiencuu_teacher` FOREIGN KEY (`teachercode`) REFERENCES `giangvien` (`teacherCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `huongnghiencuu`
--

LOCK TABLES `huongnghiencuu` WRITE;
/*!40000 ALTER TABLE `huongnghiencuu` DISABLE KEYS */;
/*!40000 ALTER TABLE `huongnghiencuu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `khoa`
--

DROP TABLE IF EXISTS `khoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `khoa` (
  `id` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `khoa`
--

LOCK TABLES `khoa` WRITE;
/*!40000 ALTER TABLE `khoa` DISABLE KEYS */;
INSERT INTO `khoa` VALUES ('CNTT','asdasd ','aá '),('DTVT','Địa tử viễn thông','asdfasdfas ');
/*!40000 ALTER TABLE `khoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `khoahoc`
--

DROP TABLE IF EXISTS `khoahoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `khoahoc` (
  `code` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `khoahoc`
--

LOCK TABLES `khoahoc` WRITE;
/*!40000 ALTER TABLE `khoahoc` DISABLE KEYS */;
/*!40000 ALTER TABLE `khoahoc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linhvuc`
--

DROP TABLE IF EXISTS `linhvuc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `linhvuc` (
  `id` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linhvuc`
--

LOCK TABLES `linhvuc` WRITE;
/*!40000 ALTER TABLE `linhvuc` DISABLE KEYS */;
/*!40000 ALTER TABLE `linhvuc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phanbien`
--

DROP TABLE IF EXISTS `phanbien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phanbien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detaiCode` int(11) NOT NULL,
  `teacher` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_phanbien_giangvien_idx` (`teacher`),
  CONSTRAINT `fk_phanbien_giangvien` FOREIGN KEY (`teacher`) REFERENCES `giangvien` (`teacherCode`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phanbien`
--

LOCK TABLES `phanbien` WRITE;
/*!40000 ALTER TABLE `phanbien` DISABLE KEYS */;
/*!40000 ALTER TABLE `phanbien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ptn`
--

DROP TABLE IF EXISTS `ptn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ptn` (
  `id` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `facultyid` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_faculty_ptn` (`facultyid`),
  CONSTRAINT `fk_faculty_ptn` FOREIGN KEY (`facultyid`) REFERENCES `khoa` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ptn`
--

LOCK TABLES `ptn` WRITE;
/*!40000 ALTER TABLE `ptn` DISABLE KEYS */;
/*!40000 ALTER TABLE `ptn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `permission` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vpk`
--

DROP TABLE IF EXISTS `vpk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vpk` (
  `id` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `facultyid` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_faculty_vpk` (`facultyid`),
  CONSTRAINT `fk_faculty_vpk` FOREIGN KEY (`facultyid`) REFERENCES `khoa` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vpk`
--

LOCK TABLES `vpk` WRITE;
/*!40000 ALTER TABLE `vpk` DISABLE KEYS */;
/*!40000 ALTER TABLE `vpk` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-14 20:24:23
