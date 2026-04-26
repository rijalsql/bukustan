-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bukustan
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
-- Table structure for table `buku`
--

DROP TABLE IF EXISTS `buku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `denda_per_hari` int(11) DEFAULT 2000,
  `penulis` varchar(45) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `kategori` enum('Kitab','Novel','Cerita','Ilmu','Teknik') DEFAULT 'Cerita',
  `harga` int(11) DEFAULT 0,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku`
--

LOCK TABLES `buku` WRITE;
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
INSERT INTO `buku` VALUES (12,'Selalu Ada Ruang Untuk Pulang',41,20000,'Karima Ifha','1776449896_8d27842442f25d486c3c.jpg',NULL,0),(13,'Sanusi',12,20000,'Imam Nawawi Al Bantani','1776449413_23bc83af0073d67d1652.jpg','Kitab',0),(14,'riyadul badiah',22,20000,'Syekh Muhammad bin Sulaiman Hasbullah','1776449550_a4c003b49f45cd95c1a2.jpg','Kitab',0),(15,'Safinatun Najah',23,20000,'Syekh Salim bin Abdullah bin Sa\'ad bin Sumair','1776449674_e50542b73817c613a2d7.jpg','Kitab',0),(16,'Laut Bercerita',22,20000,'Leila S. Chudori','1776449794_70a352ecbfdcfee93c76.jpg','Novel',0),(18,'Malin Kundang',23,20000,'Dian K','1776450181_acf76867c0f64fa04758.jpeg','Cerita',0),(19,'Timun Mas',34,2000,'Genderwo','1776450224_7a730e1416be45e582ff.jpg','Cerita',0),(20,'Joko kendil',42,20000,'Jokowii','1776450277_27772e97294b8553c561.jpg','Cerita',0),(21,'Filsafat Ilmu Pengetahuan',34,20000,'Amaliah Kadir M.pd','1776450382_5e475c6b8a5d5bd27bdd.jpg','Ilmu',0),(22,'Ilmu Debat',24,20000,'Muhammad Nuruddin','1776450422_7b04ebc68e146c1e598b.jpg','Ilmu',0),(23,'Ilmu Maqulat',44,20000,'Muhammad Nuruddin','1776450480_192c56fe045cc18bcf4d.jpg','Ilmu',0),(24,'Buya Hamka',44,20000,'A Fuadi','1776450543_3e9a1b888cbf229ef1cd.jpg','Novel',0),(25,'Rinjani',43,20000,'Nabila N Harris','1776450622_88d68374d003790c777f.jpg','Novel',0),(26,'Manajemen Teknik',47,2000,'Sriyono D Siswoyo ','1776450736_9f0216f67439a5019801.jpg','Teknik',0),(27,'Dasar Teknik Digital',41,20000,'Ahmad Yanie S.T.M.T','1776450792_46fec1348b5efebbaa72.jpg','Teknik',0),(28,'Gambar Teknik',12,20000,'Istiana Adianti S.T.,M.Sc','1776450861_ff9c4e5f544e52bd2a59.jpg','Teknik',0),(34,'Bumi Manusia',16,20000,'Pramoedya Ananta Toer','1776699815_19a185a6c8e517340b13.jpg','Novel',0),(35,'Ta\'lim al-Muta\'allim Tariq al-Ta\'allum',19,20000,'Syekh Burhanuddin Ibrahim bin Ismail az-Zarnu','1776700022_348e1e702a97851fc427.jpg','Kitab',0),(36,'Malin Kundang',21,20000,'Dian Aprilia Dewi','1776700146_685715bb034224630b7c.jpg','Cerita',0),(37,'Ilmu Negara',21,20000,'Dr.Mohammad Syaiful Aris S.H.,M.H.,LLM.','1776700281_cb89a1415ab8fb4ca1f5.jpg','Ilmu',0),(38,'Teknik Sepeda Motor',22,20000,'Drs Daryanto','1776700392_3270b66d65c048929598.jpg','Teknik',0);
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inbox`
--

DROP TABLE IF EXISTS `inbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inbox` (
  `id_inbox` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `subjek` varchar(255) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `is_read` enum('0','1') DEFAULT '0',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_inbox`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inbox`
--

LOCK TABLES `inbox` WRITE;
/*!40000 ALTER TABLE `inbox` DISABLE KEYS */;
INSERT INTO `inbox` VALUES (1,6,'⚠️ PERINGATAN KETERLAMBATAN','Halo, buku dengan judul \'Bumi Manusia\' sudah melewati batas waktu. Mohon segera dikembalikan ke perpustakaan. Terima kasih.','0','2026-04-24 03:17:51'),(2,6,'⚠️ PERINGATAN KETERLAMBATAN','Halo, buku dengan judul \'Bumi Manusia\' sudah melewati batas waktu. Mohon segera dikembalikan ke perpustakaan. Terima kasih.','0','2026-04-24 03:18:16'),(3,6,'⚠️ PERINGATAN KETERLAMBATAN','Halo, buku dengan judul \'Bumi Manusia\' sudah melewati batas waktu. Mohon segera dikembalikan ke perpustakaan. Terima kasih.','0','2026-04-24 03:18:33'),(4,6,'⚠️ PERINGATAN KETERLAMBATAN','Halo, buku dengan judul \'Bumi Manusia\' sudah melewati batas waktu. Mohon segera dikembalikan ke perpustakaan. Terima kasih.','0','2026-04-24 03:21:55'),(7,6,'⚠️ PERINGATAN KETERLAMBATAN','Halo, buku dengan judul \'Bumi Manusia\' sudah melewati batas waktu. Mohon segera dikembalikan ke perpustakaan. Terima kasih.','0','2026-04-24 22:49:27');
/*!40000 ALTER TABLE `inbox` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `tgl_dikembalikan` date DEFAULT NULL,
  `total_denda` int(11) DEFAULT 0,
  `status` enum('pending_pinjam','dipinjam','pending_kembali','kembali','hilang') DEFAULT 'pending_pinjam',
  `rating` enum('1','2','3','4','5') DEFAULT NULL,
  `ulasan` text DEFAULT NULL,
  `denda` int(11) DEFAULT 0,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status_bayar` enum('belum','proses','lunas') DEFAULT 'belum',
  PRIMARY KEY (`id_pinjam`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjaman`
--

LOCK TABLES `peminjaman` WRITE;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` VALUES (19,6,2,'2026-04-16','2026-04-23','2026-04-16',0,'kembali','',NULL,0,NULL,'belum'),(20,6,2,'2026-04-17','2026-04-24','2026-04-17',0,'kembali','',NULL,0,NULL,'belum'),(28,5,2,'2026-04-17','2026-04-24',NULL,0,'dipinjam',NULL,NULL,0,NULL,'belum'),(57,6,24,'2026-04-20','2026-04-27',NULL,0,'',NULL,NULL,0,NULL,'belum'),(58,6,27,'2026-04-20','2026-04-27',NULL,0,'',NULL,NULL,0,NULL,'belum'),(64,7,38,'2026-04-06','2026-04-07',NULL,0,'',NULL,NULL,0,NULL,'belum'),(65,7,48,'2026-04-20','2026-04-27',NULL,0,'dipinjam',NULL,NULL,0,NULL,'belum'),(68,7,37,'2026-04-20','2026-04-27',NULL,0,'',NULL,NULL,0,NULL,'belum'),(74,7,37,'2026-04-21','2026-04-28','2026-04-21',0,'kembali','5','keren',0,NULL,'belum'),(75,7,38,'2026-04-01','2026-04-06','2026-04-21',30000,'kembali','5','',0,NULL,'belum'),(76,7,35,'2026-04-07','2026-04-09',NULL,24000,'kembali','5','gagah',0,'1776755428_da5793086831aab754d9.jpg','lunas'),(77,7,36,'2026-04-07','2026-04-09',NULL,24000,'kembali','5','maap telat',0,'1776755509_497da04a8170178e6376.jpg','lunas'),(78,6,37,'2026-04-21','2026-04-28',NULL,0,'kembali','5','',0,NULL,'belum'),(79,6,35,'2026-04-21','2026-04-28',NULL,0,'kembali','5','gagah',0,NULL,'belum'),(80,6,34,'2026-04-01','2026-04-08',NULL,26000,'kembali','5','',0,'1776782817_71340a232ee028f5379b.jpg','lunas'),(81,6,27,'2026-04-08','2026-04-13',NULL,0,'hilang',NULL,NULL,0,'1776783061_279bf0ede8d03dd29a22.jpg','belum'),(82,6,20,'2026-04-01','2026-04-07',NULL,0,'',NULL,NULL,0,'1776783199_bda5ec39bb363c712522.jpg','lunas'),(83,6,37,'2026-04-21','2026-04-28',NULL,0,'',NULL,NULL,0,NULL,'belum'),(84,6,36,'2026-04-01','2026-04-07',NULL,32000,'kembali','5','lucuu cenah',0,'1776783199_bda5ec39bb363c712522.jpg','lunas'),(85,6,38,'2026-04-01','2026-04-06',NULL,34000,'kembali','5','mantap saya jadi bisa sepedah motor',0,'1776958779_b4827f80697a294e94b9.jpg','lunas'),(86,6,18,'2026-04-01','2026-04-07',NULL,32000,'kembali','5','si malinnya lieur',0,'1776971221_42b02fb0a5ffd56a9dc5.jpg','lunas'),(87,6,34,'2026-04-01','2026-04-07',NULL,0,'dipinjam',NULL,NULL,0,NULL,'belum');
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','petugas','anggota') DEFAULT 'anggota',
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif','banned') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5,'ijall','rijalatantowi@gmail.com','ijall','$2y$10$JEOcCYwavqfWwSNdIoHvUelnLPUH4UfpSruvn9tw9TmDrdc2GoIO.','admin','1775966822_394d3145720c2c5a9fb9.jpg','aktif','2026-04-12 04:07:02'),(6,'ganjar','ganjarkejer@gmail.com','ganjar','$2y$10$lj0MabwURt06N2sNrlB7Wex9KSzVazNbhv.MwhkLdllrceHWh39xK','anggota','1776414362_0a2acc690650ae4f3aca.jpg','banned','2026-04-16 01:52:47'),(7,'Lisa Black Pink','Lisssaaaaa@gmail.com','Lisa','$2y$10$kI7VmizxOF1ivhOO8IZyKevqBZD6I2DU4vYuqNNmG.AS7QTnxhrrO','anggota','1776414472_6ddda2e6caf5b5aafa77.jpg','aktif','2026-04-17 06:31:46');
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

-- Dump completed on 2026-04-24 23:13:44
