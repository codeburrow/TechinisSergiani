CREATE DATABASE  IF NOT EXISTS `kourtis` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `kourtis`;
-- MySQL dump 10.13  Distrib 5.7.13, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: kourtis
-- ------------------------------------------------------
-- Server version	5.7.12

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
-- Table structure for table `carouselPosts`
--

DROP TABLE IF EXISTS `carouselPosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carouselPosts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `included` int(11) NOT NULL DEFAULT '0',
  `position` int(11) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carouselPosts`
--

LOCK TABLES `carouselPosts` WRITE;
/*!40000 ALTER TABLE `carouselPosts` DISABLE KEYS */;
INSERT INTO `carouselPosts` VALUES (17,'y6r0wSc.png',0,NULL,NULL,NULL),(18,'carousel5.jpg',1,1,'lalala','http://kourtis.app/theatre/A-subject-that-is-beautiful-in-itself'),(19,'carousel6.jpg',1,2,NULL,'/');
/*!40000 ALTER TABLE `carouselPosts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cinemaPosts`
--

DROP TABLE IF EXISTS `cinemaPosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cinemaPosts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `urlName` varchar(200) NOT NULL,
  `summary` varchar(150) DEFAULT 'null',
  `body` varchar(10000) NOT NULL,
  `nameOfPhoto` varchar(45) DEFAULT 'null',
  `inCarousel` int(11) NOT NULL DEFAULT '0',
  `showDate` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `urlName_UNIQUE` (`urlName`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cinemaPosts`
--

LOCK TABLES `cinemaPosts` WRITE;
/*!40000 ALTER TABLE `cinemaPosts` DISABLE KEYS */;
INSERT INTO `cinemaPosts` VALUES (3,'TestPost','TestPost','asdf','asdf','headshot3.jpg',0,'0000-00-00');
/*!40000 ALTER TABLE `cinemaPosts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `musicPosts`
--

DROP TABLE IF EXISTS `musicPosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `musicPosts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `urlName` varchar(200) NOT NULL,
  `summary` varchar(150) DEFAULT 'null',
  `body` varchar(10000) NOT NULL,
  `nameOfPhoto` varchar(45) DEFAULT 'null',
  `inCarousel` int(11) NOT NULL DEFAULT '0',
  `showDate` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `urlName_UNIQUE` (`urlName`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `musicPosts`
--

LOCK TABLES `musicPosts` WRITE;
/*!40000 ALTER TABLE `musicPosts` DISABLE KEYS */;
INSERT INTO `musicPosts` VALUES (3,'TestPost','TestPost','asdf','asdf','headshot3.jpg',0,'0000-00-00');
/*!40000 ALTER TABLE `musicPosts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photosPosts`
--

DROP TABLE IF EXISTS `photosPosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photosPosts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `urlName` varchar(200) NOT NULL,
  `summary` varchar(150) DEFAULT 'null',
  `body` varchar(10000) NOT NULL,
  `nameOfPhoto` varchar(45) DEFAULT 'null',
  `inCarousel` int(11) NOT NULL DEFAULT '0',
  `showDate` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `urlName_UNIQUE` (`urlName`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photosPosts`
--

LOCK TABLES `photosPosts` WRITE;
/*!40000 ALTER TABLE `photosPosts` DISABLE KEYS */;
INSERT INTO `photosPosts` VALUES (3,'TestPost','TestPost','asdfa a f','safdafsd af ','headshot3.jpg',0,'0000-00-00');
/*!40000 ALTER TABLE `photosPosts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `podcastsPosts`
--

DROP TABLE IF EXISTS `podcastsPosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `podcastsPosts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `urlName` varchar(200) NOT NULL,
  `summary` varchar(150) DEFAULT 'null',
  `body` varchar(10000) NOT NULL,
  `nameOfPhoto` varchar(45) DEFAULT 'null',
  `inCarousel` int(11) NOT NULL DEFAULT '0',
  `showDate` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `urlName_UNIQUE` (`urlName`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `podcastsPosts`
--

LOCK TABLES `podcastsPosts` WRITE;
/*!40000 ALTER TABLE `podcastsPosts` DISABLE KEYS */;
INSERT INTO `podcastsPosts` VALUES (3,'TestPost','TestPost','asdf','asdf','headshot3.jpg',0,'0000-00-00');
/*!40000 ALTER TABLE `podcastsPosts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theatrePosts`
--

DROP TABLE IF EXISTS `theatrePosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theatrePosts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `urlName` varchar(200) NOT NULL,
  `summary` varchar(150) DEFAULT NULL,
  `body` varchar(10000) NOT NULL,
  `nameOfPhoto` varchar(45) DEFAULT NULL,
  `inCarousel` int(11) NOT NULL DEFAULT '0',
  `theatreType` int(11) NOT NULL DEFAULT '3',
  `showDate` date NOT NULL,
  `video` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `urlName_UNIQUE` (`urlName`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theatrePosts`
--

LOCK TABLES `theatrePosts` WRITE;
/*!40000 ALTER TABLE `theatrePosts` DISABLE KEYS */;
INSERT INTO `theatrePosts` VALUES (1,'Is art everything to anybody?','Is-art-everything-to-anybody','And this is a nice summary of what I am going to describe in the full article for you guys. Don\'t worry about it, just dive in.','','asd4.png',0,2,'2016-09-08','https://player.vimeo.com/video/24496773'),(2,'A subject that is beautiful in itself','A-subject-that-is-beautiful-in-itself','And this is a nice summary of what I am going to describe in the full article for you guys. Don\'t worry about it, just dive in.','','asd2.jpg',0,1,'2016-09-08','https://player.vimeo.com/video/24496773'),(3,'A great artist is always before his time','A-great-artist-is-always-before-his-time','And this is a nice summary of what I am going to describe in the full article for you guys. Don\'t worry about it, just dive in.','','asd5.jpg',0,3,'2016-09-08','https://www.youtube.com/embed/sBzRwzY7G-k'),(4,'A subject that is beautiful in itself2','a','And this is a nice summary of what I am going to describe in the full article for you guys. Don\'t worry about it, just dive in.','','asd7.jpg',1,1,'2016-09-07','https://player.vimeo.com/video/24496773'),(5,'A great artist is always before his timee','Is-art-everything-to-anybody.','And this is a nice summary of what I am going to describe in the full article for you guys. Don\'t worry about it, just dive in.','','asd6.png',0,3,'2016-09-07','https://player.vimeo.com/video/24496773'),(6,'A subject that is beautiful in itself3','c','And this is a nice summary of what I am going to describe in the full article for you guys. Don\'t worry about it, just dive in.','','asd1.jpg',0,4,'2016-09-08','https://player.vimeo.com/video/24496773'),(7,'Is art everything to anybody!','Is-art-everything-to-anybody!','And this is a nice summary of what I am going to describe in the full article for you guys. Don\'t worry about it, just dive in.','','asd4.png',1,3,'2016-09-06','https://www.youtube.com/embed/sBzRwzY7G-k'),(8,'A great artist is always before his timeee','e','And this is a nice summary of what I am going to describe in the full article for you guys. Don\'t worry about it, just dive in.','','asd3.png',0,1,'2016-09-06','https://player.vimeo.com/video/24496773'),(9,'A subject that is beautiful in itself4','f','And this is a nice summary of what I am going to describe in the full article for you guys. Don\'t worry about it, just dive in.','','asd2.jpg',0,2,'2016-09-07','https://player.vimeo.com/video/24496773'),(10,'A great artist is always before his timeeeee','g','And this is a nice summary of what I am going to describe in the full article for you guys. Don\'t worry about it, just dive in.','','asd5.jpg',1,4,'2016-09-07','https://www.youtube.com/embed/sBzRwzY7G-k'),(11,'asdf','asdf','asdf','','asd5.jpg',0,3,'2016-10-06','https://www.youtube.com/embed/sBzRwzY7G-k'),(12,'asdf_asdf','asdf_asdf','asdf asdf','','asd5.jpg',0,4,'2016-09-05','https://www.youtube.com/embed/sBzRwzY7G-k'),(13,'qwer','qwer','qwer','qwer','asd5.jpg',0,5,'2016-09-08','https://player.vimeo.com/video/24496773'),(14,'rty','rty','rty','rty','asd4.png',0,5,'2016-09-07','https://www.youtube.com/embed/sBzRwzY7G-k'),(15,'vb','vb','vb','vb','asd2.jpg',0,6,'2016-09-08',NULL),(16,'testttest','testttest','testttest','testttest','asd5.jpg',0,6,'2016-09-15','https://www.youtube.com/embed/sBzRwzY7G-k'),(21,'wre wert #$@@@$%?! ','sdf-s-d-!!----.','sdf','dsf','asd4.png',0,6,'2016-08-03','https://player.vimeo.com/video/24496773'),(27,'ρτη','α','γηξφγξ','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p><span style=\"background-color: #008000;\">φγξφγξ</span></p>\r\n</body>\r\n</html>','asd2.jpg',0,1,'2016-08-20',NULL);
/*!40000 ALTER TABLE `theatrePosts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theatreTypes`
--

DROP TABLE IF EXISTS `theatreTypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theatreTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theatreTypes`
--

LOCK TABLES `theatreTypes` WRITE;
/*!40000 ALTER TABLE `theatreTypes` DISABLE KEYS */;
INSERT INTO `theatreTypes` VALUES (1,'critic'),(2,'interview'),(3,'play'),(4,'competition'),(5,'news'),(6,'hearing');
/*!40000 ALTER TABLE `theatreTypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'alex','alex1357',1),(2,'antony','antony',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-21 13:37:48
