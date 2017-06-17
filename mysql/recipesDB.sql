-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: recipesdb
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'desertai'),(2,'gėrimai'),(3,'pagrindiniai patiekalai'),(4,'salotos'),(5,'sriubos'),(6,'užkandžiai');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredients` (
  `ingredients_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`ingredients_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (1,'salotos'),(2,'avokadai'),(3,'mocarelos sūris'),(4,'agurkai'),(5,'sojos padažas'),(6,'alyvuogių aliejus'),(7,''),(8,'Šokoladas'),(9,'Vištienos krūtinėlė'),(10,'Prieskoniai'),(11,'Moliūgai'),(12,'Bulvės'),(13,'Pienas'),(14,'Muskato riešutai'),(15,'Druska'),(16,'Pipirai'),(17,'Juodasis šokoladas'),(18,'Cinamonas'),(19,'Imbiero milteliai');
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pinned_recipes`
--

DROP TABLE IF EXISTS `pinned_recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pinned_recipes` (
  `pinned_recipes_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  PRIMARY KEY (`pinned_recipes_id`),
  KEY `user_id` (`user_id`),
  KEY `recipe_id` (`recipe_id`),
  CONSTRAINT `pinned_recipes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `pinned_recipes_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pinned_recipes`
--

LOCK TABLES `pinned_recipes` WRITE;
/*!40000 ALTER TABLE `pinned_recipes` DISABLE KEYS */;
INSERT INTO `pinned_recipes` VALUES (2,8,5),(74,12,8),(75,12,4),(77,7,9),(78,23,9),(80,7,10);
/*!40000 ALTER TABLE `pinned_recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rate`
--

DROP TABLE IF EXISTS `rate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rate` (
  `rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `rating` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`rate_id`),
  KEY `recipe_id` (`recipe_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`),
  CONSTRAINT `rate_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rate`
--

LOCK TABLES `rate` WRITE;
/*!40000 ALTER TABLE `rate` DISABLE KEYS */;
INSERT INTO `rate` VALUES (1,3,4,7),(2,5,4,8),(4,5,4,12),(5,5,4,13),(6,5,10,13),(7,3,9,7),(8,2,5,8);
/*!40000 ALTER TABLE `rate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe` (
  `recipe_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `portion` int(11) NOT NULL,
  `cooking_time` varchar(10) DEFAULT NULL,
  `picture` varchar(300) NOT NULL,
  `description` varchar(120) NOT NULL,
  PRIMARY KEY (`recipe_id`),
  KEY `user_id` (`user_id`),
  KEY `subcategory_id` (`subcategory_id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `recipe_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `recipe_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`subcategory_id`),
  CONSTRAINT `recipe_ibfk_4` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe`
--

LOCK TABLES `recipe` WRITE;
/*!40000 ALTER TABLE `recipe` DISABLE KEYS */;
INSERT INTO `recipe` VALUES (4,1,21,7,'Avokadų salotos',2,'15','http://g1.dcdn.lt/images/pix/728x360/UPzypK7NEwE/tobulos-avokadu-salotos-lieknejantiems-73363050.jpg','Labai gardžios avokadų salotos turinčios daug vitaminų'),(5,1,21,7,'Salotos su baklažanais',2,'25','http://g4.dcdn.lt/images/pix/728x360/5LtBzqifFWs/karsto-skptu-baklazanu-ir-avokadu-salotos-73351772.jpg','Dar vienos labai gardžios avokadų salotos turinčios daug vitaminų'),(6,3,1,7,'Šokoladinis keksas',4,'45 min.','http://g3.dcdn.lt/images/pix/728x360/BjYUHDCSiUA/minkstutelis-sokoladinis-keksas-73362538.jpg','Minkštutėlis šokoladinis keksas'),(7,3,1,7,'Obuolių pyragas',4,'30 min.','http://g3.dcdn.lt/images/pix/728x360/nbAPEa6vMps/obuoliu-pyragas-73354064.jpg','Minkštutėlis šokoladinis keksas'),(8,3,14,7,'Vištienos kepsnys',2,'30 min.','http://g2.dcdn.lt/images/pix/728x360/nOotxivxvMU/traski-vistiena-japoniskai-70368244.jpg','Labai skanus kepsnys iš vištienos'),(9,1,23,12,'Moliūgų sriuba',2,'1 h.','http://g3.dcdn.lt/images/pix/728x360/OMJalgIFkJc/moliugu-sriuba-72419578.jpg','Labai gardi trinta moliūgų sriuba'),(10,3,10,12,'Karštas šokoladas',2,'15 min.','http://g3.dcdn.lt/images/pix/728x360/XqNUNcMKKIc/liezuvi-kutenantis-karstas-sokoladas-73049372.jpg','Labai gardus karštas šokoladas'),(11,3,12,23,'Vengriškas troškinys',2,'1 h.','http://g2.dcdn.lt/images/pix/728x360/ka7DAvHqfjc/sotusis-vistienos-bulviu-ir-pievagrybiu-troskinys-73363868.jpg','Puikus puikus troškinys');
/*!40000 ALTER TABLE `recipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_ingredients`
--

DROP TABLE IF EXISTS `recipe_ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe_ingredients` (
  `recipe_ingredients_id` int(11) NOT NULL AUTO_INCREMENT,
  `ingredients_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `measurment_unit` varchar(10) NOT NULL,
  PRIMARY KEY (`recipe_ingredients_id`),
  KEY `ingredients_id` (`ingredients_id`),
  KEY `recipe_id` (`recipe_id`),
  CONSTRAINT `recipe_ingredients_ibfk_1` FOREIGN KEY (`ingredients_id`) REFERENCES `ingredients` (`ingredients_id`),
  CONSTRAINT `recipe_ingredients_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_ingredients`
--

LOCK TABLES `recipe_ingredients` WRITE;
/*!40000 ALTER TABLE `recipe_ingredients` DISABLE KEYS */;
INSERT INTO `recipe_ingredients` VALUES (1,1,4,200,'g'),(2,2,4,1,'vnt'),(3,3,4,100,'g'),(4,4,4,2,'vnt'),(5,5,4,2,'v.š'),(6,6,4,1,'v.š'),(7,7,6,100,'g'),(8,8,7,100,'g'),(9,9,8,500,''),(10,10,8,1,'stiklinė'),(11,11,9,1,'kg'),(12,12,9,0.5,'kg'),(13,13,9,1,'l'),(14,14,9,1,'žiupsnelis'),(15,15,9,1,'žiupsnelis'),(16,16,9,1,'žiupsnelis'),(17,13,10,500,'ml'),(18,17,10,100,'g'),(19,18,10,0.5,'a.š'),(20,19,10,0.5,'a.š'),(21,14,10,1,'žiupsnelis'),(22,12,11,0,'kg'),(23,3,11,0,'g'),(24,9,11,0,'g');
/*!40000 ALTER TABLE `recipe_ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'user'),(2,'admin');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `step`
--

DROP TABLE IF EXISTS `step`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `step` (
  `step_id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `description` mediumtext,
  `recipe_id` int(11) NOT NULL,
  PRIMARY KEY (`step_id`),
  KEY `recipe_id` (`recipe_id`),
  CONSTRAINT `step_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `step`
--

LOCK TABLES `step` WRITE;
/*!40000 ALTER TABLE `step` DISABLE KEYS */;
INSERT INTO `step` VALUES (1,1,'Salotų lapus švariai nuplaukite, gerai nuvarvinkite ir susmulkinkite',4),(2,2,'Avokadus, agurkus ir mocarelą supjaustykite nedideliais gabaliukais',4),(3,3,'Viską sumaišykite ir pagardinkite sojų padažu, alyvuogių aliejumi',4),(4,1,'Švelniai išplakite kiaušinius su druska ir aliejumi.',6),(5,1,'Švelniai išplakite kiaušinius su druska ir aliejumi.',7),(6,1,'Ištrinti prieskoniais',8),(7,2,'Padaužyti',8),(8,3,'Pakepti',8),(9,1,'Moliūgą ir bulves nulupkite ir supjaustykite nedideliais kubeliais.',9),(10,2,'Virkite pasūdytame vandenyje apie 40 minučių.',9),(11,3,'Vandenį nupilkite, užpilkite karšto pieno ir sutrinkite.',9),(12,4,'Užvirkite, įberkite druskos, pipirų ir malto muskato. Gerai išmaišykite.',9),(13,5,'Patiekite su balta skrudinta duona.',9),(14,1,'Į pieną sutrupinkite šokoladą.',10),(15,2,'Įberkite cinamono, tarkuoto muskato riešuto, imbiero.',10),(16,3,'Maišant užvirkite ir virkite apie 2 minutes (patikrinkite ar šokoladas visiškai ištirpęs).',10),(17,4,'Supilstykite į nedidelius puodelius.',10),(18,1,'Bulves nuskuskite ir supjaustykite nedideliais-vieno kąsnio gabaliukais.',11),(19,2,'Vištieną supjaustykite panašaus dydžio gabaliukais. Pabarstykite druska ir pipirais.',11),(20,3,'Šoninę smulkiai supjaustykite. Apkepkite keptuvėje kartu su vištienos gabaliukais. Suberkite pjaustytus pievagrybius ir dar kelias minutes kepkite.',11);
/*!40000 ALTER TABLE `step` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategory` (
  `subcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`subcategory_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategory`
--

LOCK TABLES `subcategory` WRITE;
/*!40000 ALTER TABLE `subcategory` DISABLE KEYS */;
INSERT INTO `subcategory` VALUES (1,1,'kepiniai'),(2,1,'ledai'),(3,1,'žėlė'),(4,1,'pudingai'),(5,1,'saldainiai'),(6,2,'alkoholiniai gėrimai'),(7,2,'gaivieji gėrimai'),(8,2,'arbatos'),(9,2,'kavos'),(10,2,'kiti'),(11,3,'apkepai'),(12,3,'troškiniai'),(13,3,'blynai'),(14,3,'kepsniai'),(15,3,'košės'),(16,3,'makaronai'),(17,3,'picos'),(18,3,'mėsainiai'),(19,3,'tradiciniai'),(20,4,'karštos salotos'),(21,4,'šaltos salotos'),(22,4,'vaisių salotos'),(23,5,'karštos sriubos'),(24,5,'šaltos sriubos'),(25,5,'saldžios sriubos'),(26,5,'trintos sriubos'),(27,6,'karšti užkandžiai'),(28,6,'šalti užkandžiai'),(29,6,'sumuštiniai');
/*!40000 ALTER TABLE `subcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` VALUES (1,'vegetariškas'),(2,'veganiškas'),(3,'standartinis');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `last_name` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(30) CHARACTER SET latin1 NOT NULL,
  `password` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (7,'Ieva','Misk',1,'ieva.misk@gmail.com','123123'),(8,'Ievaš','Mkinyte',1,'ieva.miskinytee@gmail.com','popa'),(12,'Kristijonas','Zykas',1,'zykas1@gmail.com','zykelis'),(13,'Saulius','Šaulietis',1,'s.saulietis@gmail.com','saulius'),(14,'Babausis','Babaušiauskas',1,'babausis@gmail.com','babausis1'),(15,'Babausis','Babaušiauskas',1,'babausis@gmail.com','babas'),(16,'Ieva','Misk',1,'ieva.misk@gmail.com','123896'),(17,'Ieva','Misk',1,'ieva.misk@gmail.com','123896'),(18,'Ieva','Miskin',1,'ieva.misk@gmail.com','kmjnhbbhkonk'),(19,'sdfsdf','sdfsdf',1,'sdfsdfsdfsdf@wefsd','sdfsdfsdf'),(20,'ČĘĖĮŠčęėįšų','čęėįšųČĘĖĮŠ',1,'aksdasdasd@sjdnfdkjs','ksjdfkjsdfs'),(21,'sdhfhjsdg','sjhdgfjhsdgjhf',1,'shdghjsdg@jkshdkjfh','rkjrhfkjsdfhs'),(22,'sdfsdf','sdfsdfs',1,'sdsdfs@sdfsdf','sdfsdfd'),(23,'Dainius','Savulionis',1,'d.savulionis@gmail.com','123abc');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-05 12:00:46
