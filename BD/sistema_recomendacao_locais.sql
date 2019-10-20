-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: 0.0.0.0    Database: sistema_recomendacao
-- ------------------------------------------------------
-- Server version	5.7.27

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
-- Table structure for table `locais`
--

DROP TABLE IF EXISTS `locais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` varchar(45) NOT NULL,
  `longitude` varchar(45) NOT NULL,
  `amenity` varchar(100) NOT NULL,
  `local` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locais`
--

LOCK TABLES `locais` WRITE;
/*!40000 ALTER TABLE `locais` DISABLE KEYS */;
INSERT INTO `locais` VALUES (1,'-23.5609716','-46.7272797','(tourism)(museum)','Museu de Geociencias'),(2,'-23.5611486','-46.7318991','(tourism)(museum)','Museu de Oceanografia'),(3,'-23.5663299','-46.7128356','(tourism)(museum)','Museu do Crime'),(4,'-23.5569597','-46.750093','(amenity)(restaurant)','ches'),(5,'-23.5656807','-46.7395947','(tourism)(museum)','Museu de Anatomia'),(6,'-23.5594339','-46.7419293','(tourism)(museum)','MAE - Museu de Arqueologia e Etnologia'),(7,'-23.5994881','-46.6369605','(shop)(mall)','Shopping Metro Santa Cruz'),(8,'-23.4949506','-46.8492427','(amenity)(restaurant)','Alpha Point'),(9,'-23.4924171','-46.8527977','(amenity)(police)','Policia Militar'),(10,'-23.4930789','-46.8539654','-','Alphaville 2'),(11,'-23.49289','-46.8515879','(amenity)(restaurant)','America'),(12,'-23.49289','-46.8512532','(amenity)(restaurant)','Novilho de Prata'),(13,'-23.4924177','-46.8501631','(shop)(books)','Banca Graciosa'),(14,'-23.4934489','-46.8492619','(amenity)(pharmacy)','Farma Life'),(15,'-23.4940563','-46.8484188','(amenity)(restaurant)','La Ville'),(16,'-23.4956214','-46.8489958','(amenity)(pharmacy)','Droga Rani'),(17,'-23.4957237','-46.8489786','(amenity)(restaurant)','Kyoto Temakeria'),(18,'-23.5006097','-46.8490159','(amenity)(restaurant)','Spoleto'),(19,'-23.5005771','-46.8492191','(amenity)(restaurant)','Fridays'),(20,'-23.5173091','-46.7259143','(amenity)(fuel)','Posto Extra'),(21,'-23.5247347','-46.7052466','-','Escola Estadual'),(22,'-23.5250715','-46.6941928','(amenity)(fuel)','Ipiranga'),(23,'-23.5281074','-46.6709551','(amenity)(pharmacy)','Droga Verde'),(24,'-23.5292484','-46.6693157','-','Parque da Agua Branco'),(25,'-23.5583977','-46.5227261','(amenity)(bus_station)','Terminal Vila Carrao'),(26,'-23.5373131 ','-46.6843487','(amenity)(restaurant)','choperia siri bar'),(27,'-23.5343502','-46.6881788','(amenity)(hospital)','Hospital Sao Camilo'),(28,'-23.5434916 ','-46.5615758','(amenity)(pharmacy)','Farma & Cia'),(29,'-23.5469898','-46.5631021','(amenity)(pharmacy)','Drogaria Sao Paulo'),(30,'-23.4965037','-46.8516','(amenity)(restaurant)','Malagueta'),(31,'-23.4858263','-46.856579','(amenity)(restaurant)','Galeteria Gaucha'),(32,'-23.485354','-46.8563559','(amenity)(pub)','Black Horse'),(33,'-23.4855114','-46.8563215','(amenity)(restaurant)','Kyoto'),(34,'-23.4854563','-46.8561241','(amenity)(pub)','Maria Joao'),(35,'-23.4847006','-46.8550169','(amenity)(school)','Cel Lep'),(36,'-23.4849368','-46.8538668','-','Pele Academia'),(37,'-23.4852728','-46.8704659','(amenity)(restaurant)','Quality Food'),(38,'-23.4873732','-46.8559719','(amenity)(atm)','Bradesco'),(39,'-23.4987571','-46.8482639','-','Alphaville'),(40,'-23.4982533','-46.8475258','(amenity)(fast_food)','McDonalds'),(41,'-23.4982458','-46.847249','(shop)(alcohol)','Gran Cru'),(42,'-23.4905471','-46.8437063','(amenity)(restaurant)','Tenis Club'),(43,'-23.4958431','-46.8482558','(amenity)(atm) ','Itau'),(44,'-23.4927732','-46.8486763','(amenity)(restaurant) ','Almanara'),(45,'-23.4926551','-46.8480326','(amenity)(restaurant) ','Alpha Grill'),(46,'-23.5010127','-46.8365328','(shop)(supermarket)','Sams Club'),(47,'-23.5012252','-46.8354599','(shop)(supermarket)','Wal Mart'),(48,'-23.5024896','-46.8316594','(amenity)(fuel)','Shell'),(49,'-23.5070827','-46.8450883','-','Cafe Pele'),(50,'-23.4712395','-46.3469169','(amenity)(fast_food)','Habibs '),(51,'-23.4630247','-46.3314375','(shop)(supermarket)','Supermercado Docelar'),(52,'-23.5438727','-46.5632958','(amenity)(gym)','Academia Forma Ativa'),(53,'-23.5440772','-46.5632701','(amenity)(bank)','Caixa'),(54,'-23.4725146','-46.3455274','(amenity)(hospital)','Hospital Santa Marcelina'),(55,'-23.5237703','-46.7335559','(amenity)(pharmacy)','Farmacia Sigma'),(56,'-23.5347977','-46.6884866','(amenity)(place_of_worship)','Igreja da Pompeia'),(57,'-23.535426','-46.6880416','(shop)(supermarket)','Pao de Açucar'),(58,'-23.5505602','-46.6499314','(amenity)(police)','4 Delegacia de Policia'),(59,'-23.5404151','-46.6511328','(shop)(hobby)','Horiginal Modelismo'),(60,'-23.5392763','-46.6498294','(amenity)(place_of_worship)','Paroquia Santa Cecilia'),(61,'-23.5454066','-46.6518399','(shop)(supermarket)','Pao de Acucar'),(62,'-23.5465065','-46.5646782','(shop)(toys)','Speed Fly Modelismo'),(63,'-23.5528955','-46.5647469','(amenity)(restaurant)','Santa Panela espetinhos'),(64,'-23.9671453','-46.3344149','(amenity)(shop)','Espaco Unibanco - shopping Miramar'),(65,'-23.9639923','-46.3322606','(amenity)(cinema)','Cine Roxy'),(66,'-23.9706432','-46.330192','(amenity)(cinema)','Posto 4 Cine Arte'),(67,'-23.5421067','-46.5607947','(amenity)(fuel)','Ipiranga'),(68,'-23.5424809','-46.561799','(amenity)(place_of_worship)','Igreja Presbiteriana do Tatuape'),(69,'-23.543287','-46.559018','(shop)(bakery)','Padaria Marengo'),(70,'-23.5508642','-46.6967618','(amenity)(restaurant)','Sachinha'),(71,'-23.5101097','-46.4983227','(amenity)(police)','24 Distrito Policial'),(72,'-23.5270296','-46.6806689','-','Hipermercado Zaffari'),(73,'-23.5072549','-46.7042058','(amenity)(car_rental)','Localiza'),(74,'-23.5072782','-46.7036196','(shop)(car)','Volvo Vocal'),(75,'-23.5167624','-46.7341437','-','Razzo'),(76,'-23.5166571','-46.7322312','-','VW Caminhoes'),(77,'-23.4982609','-46.8544976','(amenity)(bank)','Itau'),(78,'-23.50761','-46.847169','(shop)(car)','Mercedes-benz'),(79,'-23.5071487','-46.8475104','(shop)(car)','Toyota'),(80,'-23.5453456','-46.5714419','(amenity)(fast_food)','McDonalds'),(81,'-23.5496023','-46.6046155','(amenity)(fast_food)','McDonalds'),(82,'-23.5255918','-46.6814193','(amenity)(fast_food)','McDonalds'),(83,'-24.1804858','-46.7853338','(tourism)(hotel)','Rial'),(84,'-23.5450933','-46.65626','(tourism)(hotel)','Tryp Hygienopolis'),(85,'-23.6525319','-46.7337329','(shop)(supermarket)','Supermercado Riviera'),(86,'-23.6524688','-46.7341461','(amenity)(pharmacy)','Drogaria Sao Paulo'),(87,'-23.654895','-46.7339384','(amenity)(place_of_worship)','Paroquia Sao Luiz Gonzaga'),(88,'-23.6602371','-46.7390361','(amenity)(school)','EMEI Julita'),(89,'-23.6585144','-46.7363114','(shop)(supermarket)','Supermercado Todo Dia'),(90,'-23.6465724','-46.7292096','(shop)(supermarket)','Hipermercado Extra Joao Dias'),(91,'-23.9683006','-46.326265','(amenity)(restaurant)','Picolla Forneria'),(92,'-23.9702985','-46.3277997','(amenity)(restaurant)','Okumura Temakeria'),(93,'-23.9682494','-46.3266759','(amenity)(restaurant)','Kokimbos'),(94,'-23.6462939','-46.5410888','(amenity)(restaurant)','Burger Map'),(95,'-23.6848055','-46.594018','(amenity)(fast_food)','Lanches Vila Nogueira'),(96,'-23.6857087','-46.6261276','(shop)(clothes)','Mundo do Bebe'),(97,'-23.6865536','-46.6223015','(shop)(null)','Tropical Sorvetes'),(98,'-23.6866028','-46.6252237','(shop)(clothes)','Bunnys'),(99,'-23.6781493','-46.6276645','(amenity)(bar)','Love Apple American Bar e Night Club');
/*!40000 ALTER TABLE `locais` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-20 20:11:21
