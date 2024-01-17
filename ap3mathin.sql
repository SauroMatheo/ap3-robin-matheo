CREATE DATABASE  IF NOT EXISTS `ap3mathin` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ap3mathin`;
-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ap3mathin
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `article_commande`
--

DROP TABLE IF EXISTS `article_commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `article_commande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fk_articles_id` int NOT NULL,
  `fk_commande_id` int NOT NULL,
  `quantite` smallint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3B025216774C5AF8` (`fk_articles_id`),
  KEY `IDX_3B025216EB1C8260` (`fk_commande_id`),
  CONSTRAINT `FK_3B025216774C5AF8` FOREIGN KEY (`fk_articles_id`) REFERENCES `articles` (`id`),
  CONSTRAINT `FK_3B025216EB1C8260` FOREIGN KEY (`fk_commande_id`) REFERENCES `commandes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_commande`
--

LOCK TABLES `article_commande` WRITE;
/*!40000 ALTER TABLE `article_commande` DISABLE KEYS */;
/*!40000 ALTER TABLE `article_commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fk_rayons_id` int DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `prixuniht` decimal(10,2) NOT NULL,
  `le_fournisseur_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BFDD316839E7A43` (`fk_rayons_id`),
  KEY `IDX_BFDD3168ACB564` (`le_fournisseur_id`),
  CONSTRAINT `FK_BFDD316839E7A43` FOREIGN KEY (`fk_rayons_id`) REFERENCES `rayons` (`id`),
  CONSTRAINT `FK_BFDD3168ACB564` FOREIGN KEY (`le_fournisseur_id`) REFERENCES `fournisseur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,1,'Baskets Sneakers','Des baskets qui courrent vite !',30.99,1),(2,2,'Ballon Blanc','Moins visible',19.87,2),(3,2,'But','Droit au but',120.50,2),(4,1,'Raquette','Et pas racket, le racket c\'est mal',42.69,1),(5,1,'Balle de Tennis Classique','Pour les chiens comme pour les humains',10.00,1),(6,1,'Filet de Tennis','Jouer sans filet c\'est difficile !',30.00,1),(7,2,'Chaussettes Montantes','Les Legwarmers c\'est à la mode',8.00,2);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commandes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fk_utilisateurs_id` int DEFAULT NULL,
  `fk_etat_id` int NOT NULL,
  `date_commande` datetime NOT NULL,
  `date_reception` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_35D4282CD84A3DF0` (`fk_utilisateurs_id`),
  KEY `IDX_35D4282CFD71BBD3` (`fk_etat_id`),
  CONSTRAINT `FK_35D4282CD84A3DF0` FOREIGN KEY (`fk_utilisateurs_id`) REFERENCES `utilisateurs` (`id`),
  CONSTRAINT `FK_35D4282CFD71BBD3` FOREIGN KEY (`fk_etat_id`) REFERENCES `etats` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commandes`
--

LOCK TABLES `commandes` WRITE;
/*!40000 ALTER TABLE `commandes` DISABLE KEYS */;
/*!40000 ALTER TABLE `commandes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20230919141541','2023-09-19 16:16:21',373),('DoctrineMigrations\\Version20231003115954','2023-10-03 14:05:00',294),('DoctrineMigrations\\Version20231003124421','2023-10-03 14:44:30',187),('DoctrineMigrations\\Version20231003134126','2023-10-03 15:41:32',149);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enfants`
--

DROP TABLE IF EXISTS `enfants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enfants` (
  `id` int NOT NULL AUTO_INCREMENT,
  `age` int NOT NULL,
  `responsable_legal_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_23E2BAC346135043` (`responsable_legal_id`),
  CONSTRAINT `FK_23E2BAC346135043` FOREIGN KEY (`responsable_legal_id`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enfants`
--

LOCK TABLES `enfants` WRITE;
/*!40000 ALTER TABLE `enfants` DISABLE KEYS */;
INSERT INTO `enfants` VALUES (1,12,1);
/*!40000 ALTER TABLE `enfants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etats`
--

DROP TABLE IF EXISTS `etats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etats`
--

LOCK TABLES `etats` WRITE;
/*!40000 ALTER TABLE `etats` DISABLE KEYS */;
INSERT INTO `etats` VALUES (1,'Transmise'),(2,'Validée'),(3,'En préparation'),(4,'Expédiée'),(5,'Livrée'),(6,'Retirée');
/*!40000 ALTER TABLE `etats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fournisseur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fournisseur`
--

LOCK TABLES `fournisseur` WRITE;
/*!40000 ALTER TABLE `fournisseur` DISABLE KEYS */;
INSERT INTO `fournisseur` VALUES (1,'Le Fourneau'),(2,'Ballot-Piets');
/*!40000 ALTER TABLE `fournisseur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_article`
--

DROP TABLE IF EXISTS `image_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `image_article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `l_article_id` int NOT NULL,
  `lien_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_972A59BA2CD520EE` (`l_article_id`),
  CONSTRAINT `FK_972A59BA2CD520EE` FOREIGN KEY (`l_article_id`) REFERENCES `articles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_article`
--

LOCK TABLES `image_article` WRITE;
/*!40000 ALTER TABLE `image_article` DISABLE KEYS */;
INSERT INTO `image_article` VALUES (1,1,'sneakers1.png'),(2,1,'sneakers2.png'),(3,1,'sneakers3.png'),(4,1,'sneakers4.png'),(6,2,'ballon1.png');
/*!40000 ALTER TABLE `image_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `magasins`
--

DROP TABLE IF EXISTS `magasins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `magasins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magasins`
--

LOCK TABLES `magasins` WRITE;
/*!40000 ALTER TABLE `magasins` DISABLE KEYS */;
INSERT INTO `magasins` VALUES (0,'Internet','Internet'),(1,'All4Sport Villanciennes','496 Rue des potiers, Villanciennes');
/*!40000 ALTER TABLE `magasins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rayons`
--

DROP TABLE IF EXISTS `rayons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rayons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rayons`
--

LOCK TABLES `rayons` WRITE;
/*!40000 ALTER TABLE `rayons` DISABLE KEYS */;
INSERT INTO `rayons` VALUES (1,'Tennis'),(2,'Football'),(3,'Natation');
/*!40000 ALTER TABLE `rayons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sport`
--

DROP TABLE IF EXISTS `sport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sport` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sport`
--

LOCK TABLES `sport` WRITE;
/*!40000 ALTER TABLE `sport` DISABLE KEYS */;
INSERT INTO `sport` VALUES (1,'Tennis','Balle et raquette jeu set et match'),(2,'Footaball','Piedballon'),(3,'Natation','Splish Splosh');
/*!40000 ALTER TABLE `sport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sport_articles`
--

DROP TABLE IF EXISTS `sport_articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sport_articles` (
  `sport_id` int NOT NULL,
  `articles_id` int NOT NULL,
  PRIMARY KEY (`sport_id`,`articles_id`),
  KEY `IDX_897FCED2AC78BCF8` (`sport_id`),
  KEY `IDX_897FCED21EBAF6CC` (`articles_id`),
  CONSTRAINT `FK_897FCED21EBAF6CC` FOREIGN KEY (`articles_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_897FCED2AC78BCF8` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sport_articles`
--

LOCK TABLES `sport_articles` WRITE;
/*!40000 ALTER TABLE `sport_articles` DISABLE KEYS */;
INSERT INTO `sport_articles` VALUES (1,1);
/*!40000 ALTER TABLE `sport_articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sport_utilisateurs`
--

DROP TABLE IF EXISTS `sport_utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sport_utilisateurs` (
  `sport_id` int NOT NULL,
  `utilisateurs_id` int NOT NULL,
  PRIMARY KEY (`sport_id`,`utilisateurs_id`),
  KEY `IDX_D6A7E0BFAC78BCF8` (`sport_id`),
  KEY `IDX_D6A7E0BF1E969C5` (`utilisateurs_id`),
  CONSTRAINT `FK_D6A7E0BF1E969C5` FOREIGN KEY (`utilisateurs_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D6A7E0BFAC78BCF8` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sport_utilisateurs`
--

LOCK TABLES `sport_utilisateurs` WRITE;
/*!40000 ALTER TABLE `sport_utilisateurs` DISABLE KEYS */;
INSERT INTO `sport_utilisateurs` VALUES (3,1);
/*!40000 ALTER TABLE `sport_utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stockage`
--

DROP TABLE IF EXISTS `stockage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stockage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fk_articles_id` int NOT NULL,
  `fk_magasins_id` int NOT NULL,
  `quantite` smallint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CABCB492774C5AF8` (`fk_articles_id`),
  KEY `IDX_CABCB492B7A4ABB9` (`fk_magasins_id`),
  CONSTRAINT `FK_CABCB492774C5AF8` FOREIGN KEY (`fk_articles_id`) REFERENCES `articles` (`id`),
  CONSTRAINT `FK_CABCB492B7A4ABB9` FOREIGN KEY (`fk_magasins_id`) REFERENCES `magasins` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stockage`
--

LOCK TABLES `stockage` WRITE;
/*!40000 ALTER TABLE `stockage` DISABLE KEYS */;
INSERT INTO `stockage` VALUES (1,1,1,42),(2,1,0,100),(3,2,1,50),(4,4,0,3);
/*!40000 ALTER TABLE `stockage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_de_naissance` date NOT NULL,
  `date_inscription` date NOT NULL,
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES (1,'sauromatheo@gmail.com','Sauro','Mathéo','533 Avenue Marcel Caby, Vieux-Condé 59690','2003-09-14','2023-10-03','0767636545');
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ap3mathin'
--

--
-- Dumping routines for database 'ap3mathin'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-17 23:41:07
