-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: url_shortener_db
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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2024_10_09_103912_create_short_urls_table',1),(6,'2024_10_09_103915_create_url_clicks_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `short_urls`
--

DROP TABLE IF EXISTS `short_urls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `short_urls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `long_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `short_urls_short_code_unique` (`short_code`),
  KEY `short_urls_user_id_foreign` (`user_id`),
  CONSTRAINT `short_urls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `short_urls`
--

LOCK TABLES `short_urls` WRITE;
/*!40000 ALTER TABLE `short_urls` DISABLE KEYS */;
INSERT INTO `short_urls` VALUES (20,1,' https://www.facebook.com/','L8I3Hz','2024-10-15 18:00:00','2024-10-11 05:20:29','2024-10-11 05:20:29'),(21,1,'https://www.instagram.com/','0WZVii',NULL,'2024-10-11 05:29:53','2024-10-11 05:29:53'),(22,1,'https://twitter.com/','eHtFje',NULL,'2024-10-11 05:30:09','2024-10-11 05:30:09'),(23,1,'https://www.tiktok.com/','eNVmSr','2024-10-30 18:00:00','2024-10-11 05:31:29','2024-10-11 05:31:29'),(24,1,'https://www.snapchat.com/','OR9yhY',NULL,'2024-10-11 06:02:16','2024-10-11 06:02:16'),(25,1,'https://www.linkedin.com/','hZq3nS',NULL,'2024-10-11 06:38:14','2024-10-11 06:38:14'),(26,1,'https://www.youtube.com/','62LRWQ','2024-10-24 18:00:00','2024-10-11 06:41:41','2024-10-11 06:41:41'),(27,1,'https://www.pinterest.com/','Bymqml',NULL,'2024-10-11 06:43:55','2024-10-11 06:43:55'),(35,1,'https://www.reddit.com/','Cw0JuQ',NULL,'2024-10-11 20:18:04','2024-10-11 20:18:04'),(36,1,'https://www.twitch.tv/','8N6A4S',NULL,'2024-10-11 20:19:17','2024-10-11 20:19:17'),(37,1,'https://www.whatismyip.com/..','l5rhYX',NULL,'2024-10-12 19:48:13','2024-10-12 19:48:13'),(38,2,'https://www.facebook.com/','Kd5VDl',NULL,'2024-10-12 20:13:47','2024-10-12 20:13:47');
/*!40000 ALTER TABLE `short_urls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `url_clicks`
--

DROP TABLE IF EXISTS `url_clicks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `url_clicks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `short_url_id` bigint unsigned NOT NULL,
  `clicked_at` timestamp NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `url_clicks_short_url_id_foreign` (`short_url_id`),
  CONSTRAINT `url_clicks_short_url_id_foreign` FOREIGN KEY (`short_url_id`) REFERENCES `short_urls` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `url_clicks`
--

LOCK TABLES `url_clicks` WRITE;
/*!40000 ALTER TABLE `url_clicks` DISABLE KEYS */;
INSERT INTO `url_clicks` VALUES (15,22,'2024-10-11 17:46:52','127.0.0.1','Bangladesh','2024-10-11 17:46:52','2024-10-11 17:46:52'),(16,22,'2024-10-11 17:56:33','127.0.0.1','Bangladesh','2024-10-11 17:56:33','2024-10-11 17:56:33'),(17,22,'2024-10-11 18:36:10','127.0.0.1','Bangladesh','2024-10-11 18:36:10','2024-10-11 18:36:10'),(18,22,'2024-10-11 18:36:38','127.0.0.1','Bangladesh','2024-10-11 18:36:38','2024-10-11 18:36:38'),(19,22,'2024-10-11 18:36:45','127.0.0.1','Bangladesh','2024-10-11 18:36:45','2024-10-11 18:36:45'),(23,36,'2024-10-11 20:19:26','127.0.0.1','Bangladesh','2024-10-11 20:19:26','2024-10-11 20:19:26'),(24,20,'2024-10-12 12:17:55','127.0.0.1','Bangladesh','2024-10-12 12:17:55','2024-10-12 12:17:55'),(25,20,'2024-10-12 12:18:35','127.0.0.1','Bangladesh','2024-10-12 12:18:35','2024-10-12 12:18:35'),(26,21,'2024-10-12 12:18:40','127.0.0.1','Bangladesh','2024-10-12 12:18:40','2024-10-12 12:18:40'),(27,36,'2024-10-12 18:16:00','127.0.0.1','Bangladesh','2024-10-12 18:16:00','2024-10-12 18:16:00'),(28,36,'2024-10-12 18:21:03','127.0.0.1','Bangladesh','2024-10-12 18:21:03','2024-10-12 18:21:03'),(29,22,'2024-10-12 18:51:52','127.0.0.1','Bangladesh','2024-10-12 18:51:52','2024-10-12 18:51:52'),(30,22,'2024-10-12 18:52:20','127.0.0.1','Bangladesh','2024-10-12 18:52:20','2024-10-12 18:52:20'),(31,22,'2024-10-12 18:54:04','127.0.0.1','Bangladesh','2024-10-12 18:54:04','2024-10-12 18:54:04'),(32,36,'2024-10-12 18:54:26','127.0.0.1','Bangladesh','2024-10-12 18:54:26','2024-10-12 18:54:26'),(33,36,'2024-10-12 18:54:41','127.0.0.1','Bangladesh','2024-10-12 18:54:41','2024-10-12 18:54:41'),(34,24,'2024-10-12 19:41:09','127.0.0.1','Bangladesh','2024-10-12 19:41:09','2024-10-12 19:41:09'),(35,38,'2024-10-12 20:14:37','127.0.0.1','Bangladesh','2024-10-12 20:14:37','2024-10-12 20:14:37');
/*!40000 ALTER TABLE `url_clicks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Farnan','user@dtl.com',NULL,'$2y$12$epsi.JVmhK4WMv4EoE7EQOPi9gsacUgrL8y/Vso79Qf0YPXi44Jzi',NULL,'2024-10-09 05:16:13','2024-10-09 05:16:13'),(2,'Dotlines','user@dotlines.com',NULL,'$2y$12$L36JR.P9X80oEXTHHS3Xm./0Xsnchgc..C0qWd88D2CdEjszEL86W',NULL,'2024-10-12 20:13:14','2024-10-12 20:13:14');
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

-- Dump completed on 2024-10-13  2:27:09
