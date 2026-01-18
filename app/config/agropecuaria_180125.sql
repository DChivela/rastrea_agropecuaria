-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: agropecuaria
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `eventos_rastreio`
--

DROP TABLE IF EXISTS `eventos_rastreio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventos_rastreio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lote_id` int(11) NOT NULL,
  `tipo_evento` enum('producao','colheita','abate','processamento','armazenamento','transporte','venda') NOT NULL,
  `descricao` text DEFAULT NULL,
  `localizacao` varchar(255) DEFAULT NULL,
  `temperatura` decimal(5,2) DEFAULT NULL,
  `umidade` decimal(5,2) DEFAULT NULL,
  `responsavel` varchar(255) DEFAULT NULL,
  `data_evento` timestamp NOT NULL DEFAULT current_timestamp(),
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `lote_id` (`lote_id`),
  CONSTRAINT `eventos_rastreio_ibfk_1` FOREIGN KEY (`lote_id`) REFERENCES `lotes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos_rastreio`
--

LOCK TABLES `eventos_rastreio` WRITE;
/*!40000 ALTER TABLE `eventos_rastreio` DISABLE KEYS */;
INSERT INTO `eventos_rastreio` VALUES (1,1,'producao','Produção de Fuba','Moageira Lubango ANG',26.00,1.30,'Emanuel','2026-01-17 15:10:06','2026-01-17 15:10:06');
/*!40000 ALTER TABLE `eventos_rastreio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lotes`
--

DROP TABLE IF EXISTS `lotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `codigo_lote` varchar(100) NOT NULL,
  `quantidade` decimal(10,2) NOT NULL,
  `data_producao` date NOT NULL,
  `data_validade` date DEFAULT NULL,
  `status` enum('em_producao','em_transito','armazenado','vendido','expirado') DEFAULT 'em_producao',
  `local_origem` varchar(255) DEFAULT NULL,
  `local_atual` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qr_codigo` varchar(255) DEFAULT NULL,
  `qr_ativo` tinyint(1) DEFAULT 1,
  `qr_scans` int(11) DEFAULT 0,
  `qr_ultimo_scan` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_lote` (`codigo_lote`),
  UNIQUE KEY `qr_codigo` (`qr_codigo`),
  KEY `produto_id` (`produto_id`),
  CONSTRAINT `lotes_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lotes`
--

LOCK TABLES `lotes` WRITE;
/*!40000 ALTER TABLE `lotes` DISABLE KEYS */;
INSERT INTO `lotes` VALUES (1,1,'L0001',200.00,'2026-01-17','2026-02-07','em_producao','Campos Matala',NULL,'2026-01-17 15:07:31','2026-01-17 15:07:31',NULL,1,0,NULL),(2,2,'L0002',150.00,'2026-01-09','2026-02-01','em_producao','Campos Chibia','Campos Chibia','2026-01-17 22:28:29','2026-01-17 22:28:29','1e71de63f698d71190bc',1,0,NULL),(4,2,'L0003',150.00,'2026-01-01','2026-02-01','em_producao','Campos Chibia','Campos Chibia','2026-01-17 23:06:37','2026-01-17 23:06:37','6e809a18c55603ad38aa',1,0,NULL);
/*!40000 ALTER TABLE `lotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtores`
--

DROP TABLE IF EXISTS `produtores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `bi` varchar(18) DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `certificacao` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `cnpj` (`bi`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `produtores_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtores`
--

LOCK TABLES `produtores` WRITE;
/*!40000 ALTER TABLE `produtores` DISABLE KEYS */;
INSERT INTO `produtores` VALUES (1,1,'António Ribeiro','0020030020HA085','Bairro Arco-Íris','Lubango','Huíla',10.00025000,999.99999999,'2023','2026-01-17 14:37:25','2026-01-17 14:38:51');
/*!40000 ALTER TABLE `produtores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produtor_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo` enum('carne','leite','graos','outros') NOT NULL,
  `descricao` text DEFAULT NULL,
  `unidade` varchar(20) DEFAULT 'kg',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `produtor_id` (`produtor_id`),
  CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`produtor_id`) REFERENCES `produtores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,1,'Milho','graos','Milheiro','kg','2026-01-17 14:41:02','2026-01-17 14:41:02'),(2,1,'Suíno','carne','Carne','kg','2026-01-17 21:53:13','2026-01-17 21:55:40'),(3,1,'Feijão','graos','','kg','2026-01-17 21:55:28','2026-01-17 21:55:28');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qr_codes`
--

DROP TABLE IF EXISTS `qr_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qr_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lote_id` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `contador_escaneamentos` int(11) DEFAULT 0,
  `ultimo_escaneamento` timestamp NULL DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `lote_id` (`lote_id`),
  CONSTRAINT `qr_codes_ibfk_1` FOREIGN KEY (`lote_id`) REFERENCES `lotes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qr_codes`
--

LOCK TABLES `qr_codes` WRITE;
/*!40000 ALTER TABLE `qr_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `qr_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'António Ribeiro','antonio.ribeiro@gmail.com','$2y$10$yz1uvtOQmzCkcLPANeuiLeJAKeofZN7KUy/SELqEbrDEX88PC2tWi','999-999-999','2026-01-17 14:34:27','2026-01-17 14:34:54'),(2,'Albertina Satipamba','albertina.satipamba@gmail.com','$2y$10$ORMk33qtrAGdm58FYWf9sOZEjFuW9UANSUthI9WDCYrln8nPGX0lW','244 999-999-999','2026-01-17 22:22:31','2026-01-17 22:22:31');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-18  2:32:50
