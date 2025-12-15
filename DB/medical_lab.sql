/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.5.8-log : Database - medical_lab_mgnt1
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`medical_lab_mgnt1` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medical_lab_mgnt1`;

/*Table structure for table `attendance` */

DROP TABLE IF EXISTS `attendance`;

CREATE TABLE `attendance` (
  `aid` int(100) NOT NULL AUTO_INCREMENT,
  `sid` varchar(100) DEFAULT NULL,
  `attendance` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `attendance` */

insert  into `attendance`(`aid`,`sid`,`attendance`,`date`) values (1,'5','1','2024-04-20'),(2,'5','0','2024-04-19');

/*Table structure for table `inventory` */

DROP TABLE IF EXISTS `inventory`;

CREATE TABLE `inventory` (
  `inventory_id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `edate` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `notes` varchar(300) DEFAULT NULL,
  `i_image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`inventory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `inventory` */

insert  into `inventory`(`inventory_id`,`name`,`quantity`,`edate`,`category`,`price`,`notes`,`i_image`) values (2,'Nitrile Glovess','40','2026-11-01','Personal Protective Equipment','20','Latex-free, size medium','71GJx79GiFL._AC_UF894,1000_QL80_.jpg');

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `lid` int(100) NOT NULL AUTO_INCREMENT,
  `rid` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `login` */

insert  into `login`(`lid`,`rid`,`email`,`password`,`type`) values (8,'5','akhila@gmail.com','$2a$10$MjA1NDgwMjM2NjY1ZmE3YunK/jWP/kooiQtx5y6lTxkD9ZIwrzDii','Patient'),(9,'6','patient@gmail.com','$2a$10$MTMwNjQ5NzIzMjY2MjM2N.tznZHGrVIvhRnmZw8etQrgu0.XbbqK2','Patient'),(11,'5','staff@gmail.com','$2a$10$MTg4MzI0NDYxMDY2MjM2MO99UUhGnzu2nrtrChEVmOr/yqhlBMxBu','Staff'),(12,'0','admin@gmail.com','$2a$10$ODA1MDI2MTgwNjVmYWE4NuW6VxjxML0yPHi8raJqgVXAip6qli0ou','Admin');

/*Table structure for table `patient` */

DROP TABLE IF EXISTS `patient`;

CREATE TABLE `patient` (
  `pid` int(100) NOT NULL AUTO_INCREMENT,
  `pname` varchar(100) DEFAULT NULL,
  `pemail` varchar(100) DEFAULT NULL,
  `pphone` varchar(100) DEFAULT NULL,
  `p_address` varchar(100) DEFAULT NULL,
  `sid` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `patient` */

insert  into `patient`(`pid`,`pname`,`pemail`,`pphone`,`p_address`,`sid`) values (6,'Lab Patient','patient@gmail.com','9889687676','Ernakulam','5');

/*Table structure for table `staff` */

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `sid` int(100) NOT NULL AUTO_INCREMENT,
  `sname` varchar(100) DEFAULT NULL,
  `semail` varchar(100) DEFAULT NULL,
  `sphone` varchar(100) DEFAULT NULL,
  `saddress` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `staff` */

insert  into `staff`(`sid`,`sname`,`semail`,`sphone`,`saddress`) values (5,'Lab Staff','staff@gmail.com','8732678356','Ernakulam,Kerala');

/*Table structure for table `test` */

DROP TABLE IF EXISTS `test`;

CREATE TABLE `test` (
  `tid` int(100) NOT NULL AUTO_INCREMENT,
  `sid` varchar(100) DEFAULT NULL,
  `pid` varchar(100) DEFAULT NULL,
  `test` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `info` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `test_file` varchar(200) DEFAULT NULL,
  `fees` varchar(100) DEFAULT NULL,
  `fees_status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `test` */

insert  into `test`(`tid`,`sid`,`pid`,`test`,`date`,`info`,`status`,`test_file`,`fees`,`fees_status`) values (3,'5','6','bloodTest','2024-03-20','Mr Patient Has taken a blood test on March 20th 2024','Test Completed','download (1).pdf','1000','Payment Completed'),(4,'5','6','urineTest','2024-03-21','urine test','Test Completed','download.pdf','200','Payment Completed');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
