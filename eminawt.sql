-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: eminawt
-- ------------------------------------------------------
-- Server version	5.7.12-log

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
-- Table structure for table `komentar`
--

DROP TABLE IF EXISTS `komentar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Tekst` text,
  `Autor_id` int(11) DEFAULT NULL,
  `Vijest_id` int(11) DEFAULT NULL,
  `Vrijeme` datetime DEFAULT NULL,
  `AnonimniKorisnik` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komentar`
--

LOCK TABLES `komentar` WRITE;
/*!40000 ALTER TABLE `komentar` DISABLE KEYS */;
INSERT INTO `komentar` VALUES (1,'Komentarcic',1,8,'2016-05-30 15:44:00',NULL),(2,'Ekstra',1,8,'2016-05-30 15:46:00',NULL),(3,' Novi komentar',1,8,'2016-05-30 08:00:50',NULL),(4,' i ja komentarisem',0,8,'2016-05-30 08:04:40','Neko nekovic'),(5,' i ja komentarisem',0,8,'2016-05-30 08:05:24','Neko nekovic'),(6,' Komentar',1,9,'2016-05-30 09:02:48',NULL),(7,' tuuuu',1,16,'2016-05-31 12:12:39',NULL),(8,' k',1,16,'2016-05-31 12:45:32',NULL),(9,' k',1,16,'2016-05-31 01:49:32',NULL),(11,'bla',2,4,'2016-05-31 05:26:20',NULL);
/*!40000 ALTER TABLE `komentar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `komentarodgovor`
--

DROP TABLE IF EXISTS `komentarodgovor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komentarodgovor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Tekst` text,
  `Autor_id` int(11) DEFAULT NULL,
  `Komentar_id` int(11) DEFAULT NULL,
  `Vrijeme` datetime DEFAULT NULL,
  `AnonimniKorisnik` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komentarodgovor`
--

LOCK TABLES `komentarodgovor` WRITE;
/*!40000 ALTER TABLE `komentarodgovor` DISABLE KEYS */;
INSERT INTO `komentarodgovor` VALUES (1,'ODgovor na komentar',1,1,'2016-05-30 05:30:00',NULL),(2,'',0,1,'2016-05-30 08:49:27','Neko'),(3,' Novi komentar',0,1,'2016-05-30 08:50:37','Novi'),(4,' Novi odgovor',0,1,'2016-05-30 08:54:42','Neko nekovic'),(5,' Odgovor',1,6,'2016-05-30 09:02:58',NULL),(6,' ooo',1,7,'2016-05-31 12:12:56',NULL),(8,' replika',2,6,'2016-05-31 03:04:31',NULL);
/*!40000 ALTER TABLE `komentarodgovor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Ime` varchar(20) DEFAULT NULL,
  `Prezime` varchar(20) DEFAULT NULL,
  `BrojTelefona` varchar(20) DEFAULT NULL,
  `Username` varchar(20) DEFAULT NULL,
  `Password` varchar(300) DEFAULT NULL,
  `Admin` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik`
--

LOCK TABLES `korisnik` WRITE;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
INSERT INTO `korisnik` VALUES (2,'Admin','Admin','062257026','admin','21232f297a57a5a743894a0e4a801fc3',''),(3,'Emina  ','Huskic  ','062789456  ','emina  ','5b983b8afef880513bf81c490129c997',NULL);
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obavijest`
--

DROP TABLE IF EXISTS `obavijest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obavijest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Naslov` varchar(200) DEFAULT NULL,
  `Tekst` text,
  `Vrijeme` datetime DEFAULT NULL,
  `Autor_id` int(11) DEFAULT NULL,
  `Slika` varchar(300) DEFAULT NULL,
  `Komentari` bit(1) DEFAULT NULL,
  `Drzava` varchar(20) DEFAULT NULL,
  `Telefon` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obavijest`
--

LOCK TABLES `obavijest` WRITE;
/*!40000 ALTER TABLE `obavijest` DISABLE KEYS */;
INSERT INTO `obavijest` VALUES (1,'New types of massages','Enjoy a nurturing soothing massage to ease muscle tension','2016-05-28 13:12:15',1,'https://33.media.tumblr.com/avatar_23c7641f5d75_128.png','','BA',NULL),(2,'Why visit us?','Experience the therapeutic benefits of water at Kohler Waters Spa where remineralizing experiences recreate the healing properties of earth\'s mineral-rich waters. Each one of our unique spa ser','2016-05-21 13:12:15',1,'https://33.media.tumblr.com/avatar_4e7d66aa2bfb_128.png','\0',NULL,NULL),(3,'Hidrotherapy treatment','Drift away to relaxation with a full-body exfoliation remineralizing magnesium bathing experience and your choice of a seaweed or mud body wrap.','2016-06-06 13:12:15',1,'https://38.media.tumblr.com/avatar_85f9fbc14fb7_128.png','',NULL,NULL),(4,'Spa Packages','Choose your own ideal getaway from reality from our wide range of services.','2016-06-03 13:12:15',2,'https://33.media.tumblr.com/avatar_fd6ad724aec4_128.png','',NULL,NULL),(5,'Mark your Calendars for our Retail Offer','Enjoy 15% off all retail on Tuesday March 15 2016. Cannot be combined with any other retail promotions','2016-04-21 13:12:15',1,'http://s2.evcdn.com/images/block/I0-001/019/621/889-3.png_/womens-empowerment-spa-day-89.png','',NULL,NULL),(6,'New types of massages','Enjoy a nurturing soothing massage to ease fatigue and muscle tension during this special time.','2016-05-28 13:12:15',1,'https://33.media.tumblr.com/avatar_23c7641f5d75_128.png','','BA',NULL);
/*!40000 ALTER TABLE `obavijest` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-06 23:50:20
