/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.1.13-MariaDB : Database - wishes
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tb_admin` */

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_admin` */

insert  into `tb_admin`(`id_admin`,`username`,`password`,`nama_lengkap`) values 
(1,'farik','farik','farik a');

/*Table structure for table `tb_berita` */

CREATE TABLE `tb_berita` (
  `id_berita` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(50) DEFAULT NULL,
  `deskripsi` text,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_berita` */

insert  into `tb_berita`(`id_berita`,`judul`,`deskripsi`,`gambar`) values 
(2,'berita 2','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum','logo'),
(3,'berita 3','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum','logo');

/*Table structure for table `tb_cart` */

CREATE TABLE `tb_cart` (
  `id_cart` int(11) NOT NULL AUTO_INCREMENT,
  `order_key` varchar(20) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cart`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tb_cart` */

insert  into `tb_cart`(`id_cart`,`order_key`,`id_produk`,`qty`,`harga`) values 
(1,'L093Ic',53,1,213),
(4,'cCQhJ3',50,1,123),
(5,'cCQhJ3',52,1,123),
(6,'cCQhJ3',45,1,250000),
(7,'RTeSgi',45,1,250000);

/*Table structure for table `tb_kategori` */

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `id_induk` int(11) DEFAULT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kategori` */

insert  into `tb_kategori`(`id_kategori`,`id_induk`,`nama_kategori`) values 
(3,0,'Kemeja'),
(4,0,'Celana'),
(5,0,'Kaos'),
(7,0,'hoodiess');

/*Table structure for table `tb_ongkir` */

CREATE TABLE `tb_ongkir` (
  `id_ongkir` int(11) NOT NULL AUTO_INCREMENT,
  `id_wilayah` int(11) DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ongkir`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_ongkir` */

insert  into `tb_ongkir`(`id_ongkir`,`id_wilayah`,`ongkir`) values 
(1,1,12000);

/*Table structure for table `tb_order` */

CREATE TABLE `tb_order` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `kode_order` varchar(20) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `tgl_order` date DEFAULT NULL,
  `nama_penerima` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text,
  `id_provinsi` int(11) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `kodepos` varchar(50) DEFAULT NULL,
  `no_telp` varchar(50) DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` enum('pending','transfer','dibayar','dikirim','selesai') DEFAULT 'pending',
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

/*Data for the table `tb_order` */

insert  into `tb_order`(`id_order`,`kode_order`,`id_pelanggan`,`tgl_order`,`nama_penerima`,`email`,`alamat`,`id_provinsi`,`kota`,`kodepos`,`no_telp`,`ongkir`,`subtotal`,`total`,`status`) values 
(38,'lw64WO',0,'2016-06-26','asd','asd@asd.a','as',1,'asd','asd','asd',10000,100000,110000,'dibayar'),
(39,'U6vz7E',0,'2016-06-26','asd','asd@asd.a','asd',1,'asd','asd','asd',10000,100000,110000,'pending'),
(41,'8AuVcQ',0,'2016-06-26','test','test@a.vom','asd',1,'asd','asd','asd',10000,123,10123,'pending'),
(42,'Gn5LUN',0,'2016-06-26','asd','a@a.vcoim','asd',1,'asd','asd','asd',10000,123,10123,'pending'),
(43,'zzGkgZ',0,'2016-06-26','asd','asd@a.s','asd',1,'asd','asd','asd',10000,123,10123,'pending'),
(44,'sSHeUA',0,'2016-08-25','test','test@a.co','test',1,'test','test','test',12000,100246,112246,'pending'),
(45,'pQVlIc',0,'2016-08-25','asd','asd@a.A','asd',1,'asd','asd','asd',12000,459,12459,'pending'),
(46,'bQhrjD',0,'2016-08-25','213','asd@asd.a','123',1,'asd','asd','asd',12000,250000,262000,'pending'),
(47,'I30RH8',0,'2016-08-25','asd','asd@a.a','asd',1,'asd','asd','as',12000,100246,112246,'pending'),
(48,'HO0O5X',0,'2016-09-21','asd','a@a.a','asd',1,'asd','aasd','asd',12000,336,12336,'pending'),
(49,'NZV34h',0,'2017-12-05','test','a@a.com','test',1,'es','test','test',12000,100000,112000,'pending'),
(50,'YcBllj',0,'2019-02-10','daaasd','asd@y.com','asd',1,'asd','asd','asd',12000,100000,112000,'pending'),
(51,'b6BUjH',0,'2019-02-10','asd','a@a.com','asd',1,'asd','asdw','asd',12000,250000,262000,'pending');

/*Table structure for table `tb_order_detail` */

CREATE TABLE `tb_order_detail` (
  `id_order_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_order_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `tb_order_detail` */

insert  into `tb_order_detail`(`id_order_detail`,`id_order`,`id_produk`,`harga`,`jumlah`,`subtotal`) values 
(12,38,42,100000,1,100000),
(13,39,43,100000,1,100000),
(15,41,51,123,1,123),
(16,42,51,123,1,123),
(17,43,51,123,1,123),
(18,44,52,123,2,246),
(19,44,41,100000,1,100000),
(20,45,53,213,1,213),
(21,45,52,123,1,123),
(22,45,50,123,1,123),
(23,46,45,250000,1,250000),
(24,47,52,123,1,123),
(25,47,43,100000,1,100000),
(26,47,50,123,1,123),
(27,48,52,123,1,123),
(28,48,53,213,1,213),
(29,49,41,100000,1,100000),
(30,50,33,100000,1,100000),
(31,51,45,250000,1,250000);

/*Table structure for table `tb_payment` */

CREATE TABLE `tb_payment` (
  `id_payment` int(11) NOT NULL AUTO_INCREMENT,
  `kode_order` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `bank_asal` varchar(50) DEFAULT NULL,
  `an_asal` varchar(100) DEFAULT NULL,
  `bank_tujuan` varchar(100) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `tgl_konfirmasi` date DEFAULT NULL,
  `status_payment` enum('pending','not_found','success') DEFAULT 'pending',
  PRIMARY KEY (`id_payment`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tb_payment` */

insert  into `tb_payment`(`id_payment`,`kode_order`,`email`,`bank_asal`,`an_asal`,`bank_tujuan`,`nominal`,`tgl_konfirmasi`,`status_payment`) values 
(1,'lw64WO','asd@a.com','asd','asd','asd',0,'2016-06-26','success'),
(2,'testmailconf','testmailconf@gmail.com','testmailconf','testmailconf','testmailconf',0,'2016-06-26','pending'),
(3,'testmailconf','testmailconf@gmail.com','testmailconf','testmailconf','testmailconf',0,'2016-06-26','pending'),
(4,'testmailconf','testmailconf@gmail.com','testmailconf','testmailconf','testmailconf',0,'2016-06-26','pending'),
(5,'testmail','roznack@gmail.com','bni','asd','asd',0,'2016-06-26','pending'),
(6,'testmail','rozunarokku@gmail.com','asd','asd','asd',0,'2016-06-26','pending'),
(7,'asd','rozunarokku@gmail.com','aasd','asd','asd',0,'2016-06-26','pending'),
(8,'asd','rozunarokku@gmail.com','aasd','asd','asd',0,'2016-06-26','pending'),
(9,'asd','rozunarokku@gmail.com','aasd','asd','asd',0,'2016-06-26','pending'),
(10,'asd','rozunarokku@gmail.com','aasd','asd','asd',0,'2016-06-26','pending');

/*Table structure for table `tb_produk` */

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `deskripsi` text,
  `gambar` varchar(50) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

/*Data for the table `tb_produk` */

insert  into `tb_produk`(`id_produk`,`nama_produk`,`stok`,`harga`,`berat`,`diskon`,`deskripsi`,`gambar`,`id_kategori`) values 
(3,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','a3',3),
(4,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(7,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(8,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(9,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(13,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(14,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(15,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(16,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(17,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(18,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(19,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(20,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(28,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(29,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(30,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(31,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(32,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(33,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(34,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(35,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(36,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(37,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(38,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(39,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(40,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(41,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(42,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',3),
(43,'kemeja 1',2,100000,500,0,'kemeja dewnagn dekrtsisi','image1',5),
(44,'Kemeja elek',5,500000,500,0,'elek','a3',3),
(45,'kemeja 2',232,250000,NULL,NULL,NULL,'image1',3),
(50,'asd',123,123,0,0,'elek','image1',4),
(52,'as',123,123,NULL,NULL,'test deskripsi 2','27',3),
(53,'test_ba',12,213,NULL,NULL,'teststestee','300px-XionAnimalBRX',5);

/*Table structure for table `tb_provinsi` */

CREATE TABLE `tb_provinsi` (
  `id_provinsi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_provinsi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_provinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_provinsi` */

insert  into `tb_provinsi`(`id_provinsi`,`nama_provinsi`) values 
(1,'Yogyakarta 1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
