/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.21-MariaDB : Database - sbo_voting
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sbo_voting` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sbo_voting`;

/*Table structure for table `candidates` */

DROP TABLE IF EXISTS `candidates`;

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(22) DEFAULT NULL,
  `lastName` varchar(22) DEFAULT NULL,
  `runningFor` varchar(22) DEFAULT NULL,
  `category` varchar(22) DEFAULT NULL,
  `categoryId` varchar(22) DEFAULT NULL,
  `picturePath` varchar(500) DEFAULT NULL,
  `studentId` varchar(11) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `partylist` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `candidates` */

/*Table structure for table `partylist` */

DROP TABLE IF EXISTS `partylist`;

CREATE TABLE `partylist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partyListName` varchar(255) DEFAULT NULL,
  `logoPath` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  `createdBy` varchar(255) DEFAULT NULL,
  `UpdatedBy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `partylist` */

/*Table structure for table `positions` */

DROP TABLE IF EXISTS `positions`;

CREATE TABLE `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `positions` */

insert  into `positions`(`id`,`position`,`type`) values 
(1,'governor','provincial'),
(2,'vice-governor','provincial'),
(3,'secretary','provincial'),
(4,'treasurer','provincial'),
(5,'auditor','provincial'),
(6,'business manager','provincial'),
(7,'press relation officer','provincial'),
(8,'peace officer','provincial'),
(9,'mayor','municipal'),
(10,'secretary','municipal'),
(11,'business manager','municipal'),
(12,'press relation officer','municipal'),
(13,'peace officer','municipal');

/*Table structure for table `studentlist` */

DROP TABLE IF EXISTS `studentlist`;

CREATE TABLE `studentlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentId` varchar(111) DEFAULT NULL,
  `firstName` varchar(111) DEFAULT NULL,
  `lastName` varchar(111) DEFAULT NULL,
  `year` varchar(111) DEFAULT NULL,
  `email` varchar(111) DEFAULT NULL,
  `status` varchar(111) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

/*Data for the table `studentlist` */

insert  into `studentlist`(`id`,`studentId`,`firstName`,`lastName`,`year`,`email`,`status`) values 
(5,'5','Fay','Stagge','2nd','fstagge4@cbc.ca','notRegistered'),
(6,'6','Barbaraanne','MacCafferty','2nd','bmaccafferty5@cbsnews.com','notRegistered'),
(7,'7','Kalli','Holttom','2nd','kholttom6@wiley.com','notRegistered'),
(8,'8','Rafa','Kendred','2nd','rkendred7@zdnet.com','notRegistered'),
(9,'9','Belita','Minot','2nd','bminot8@people.com.cn','notRegistered'),
(10,'10','Carver','Antrum','2nd','cantrum9@toplist.cz','notRegistered'),
(11,'11','Debbie','Lissandri','2nd','dlissandria@barnesandnoble.com','notRegistered'),
(12,'12','Reena','Murkus','2nd','rmurkusb@simplemachines.org','notRegistered'),
(13,'13','Hortense','Newburn','2nd','hnewburnc@vimeo.com','notRegistered'),
(14,'14','Ethelyn','Koba','2nd','ekobad@dailymail.co.uk','notRegistered'),
(15,'15','Patton','Stiller','2nd','pstillere@youtu.be','notRegistered'),
(16,'16','Fancie','Scambler','2nd','fscamblerf@skype.com','notRegistered'),
(17,'17','Dal','Cancellor','2nd','dcancellorg@odnoklassniki.ru','notRegistered'),
(18,'18','Devinne','Meardon','2nd','dmeardonh@edublogs.org','notRegistered'),
(19,'19','Milzie','Leagas','2nd','mleagasi@51.la','notRegistered'),
(20,'20','Bent','Eason','2nd','beasonj@com.com','notRegistered'),
(21,'21','Valle','Skatcher','2nd','vskatcherk@stanford.edu','notRegistered'),
(22,'22','Francisco','Aldren','2nd','faldrenl@yellowpages.com','notRegistered'),
(23,'23','Myrwyn','Fellgate','2nd','mfellgatem@ifeng.com','notRegistered'),
(24,'24','Suzette','MacKaig','2nd','smackaign@vinaora.com','notRegistered'),
(25,'25','Alvie','Abramof','2nd','aabramofo@1und1.de','notRegistered'),
(26,'26','Olenka','Pylkynyton','2nd','opylkynytonp@cbc.ca','notRegistered'),
(27,'27','Gustave','Jacqueminot','2nd','gjacqueminotq@blog.com','notRegistered'),
(28,'28','Jdavie','Heathorn','2nd','jheathornr@cnbc.com','notRegistered'),
(29,'29','Rad','Noblet','2nd','rnoblets@mlb.com','notRegistered'),
(30,'30','Clayton','Kleszinski','2nd','ckleszinskit@npr.org','notRegistered'),
(31,'31','Kynthia','Commander','2nd','kcommanderu@github.com','notRegistered'),
(32,'32','Lydon','Swinnard','2nd','lswinnardv@google.pl','notRegistered'),
(33,'33','Hedwig','Cicerone','2nd','hciceronew@sourceforge.net','notRegistered'),
(34,'34','Trixie','Christopher','2nd','tchristopherx@seattletimes.com','notRegistered'),
(35,'35','Benjy','Kleiner','2nd','bkleinery@google.pl','notRegistered'),
(36,'36','Maure','Lisciardelli','2nd','mlisciardelliz@webs.com','notRegistered'),
(37,'37','Eulalie','Champney','2nd','echampney10@comsenz.com','notRegistered'),
(38,'38','Honoria','Sproston','2nd','hsproston11@nytimes.com','notRegistered'),
(39,'39','Benedikta','Lyles','2nd','blyles12@apple.com','notRegistered'),
(40,'40','Currey','Kaszper','2nd','ckaszper13@theatlantic.com','notRegistered'),
(41,'41','Jack','Twells','2nd','jtwells14@yelp.com','notRegistered'),
(42,'42','Witty','Bilby','2nd','wbilby15@ucoz.ru','notRegistered'),
(43,'43','Dexter','Peverell','2nd','dpeverell16@1688.com','notRegistered'),
(44,'44','Jacintha','Staden','2nd','jstaden17@pbs.org','notRegistered'),
(45,'45','Roberta','Cosslett','2nd','rcosslett18@sogou.com','notRegistered'),
(46,'46','Marnia','Kleis','2nd','mkleis19@ebay.co.uk','notRegistered'),
(47,'47','Roberta','Martinet','2nd','rmartinet1a@amazon.de','notRegistered'),
(48,'48','Giraud','Roja','2nd','groja1b@cafepress.com','notRegistered'),
(49,'49','Stephenie','Lidden','2nd','slidden1c@wikia.com','notRegistered'),
(50,'50','Tabina','Bygott','2nd','tbygott1d@washingtonpost.com','notRegistered'),
(51,'51','Darrelle','Faltin','2nd','dfaltin1e@earthlink.net','notRegistered'),
(52,'52','Cecelia','Kubek','2nd','ckubek1f@china.com.cn','notRegistered'),
(53,'53','Alon','Jankin','2nd','ajankin1g@go.com','notRegistered'),
(54,'54','Mord','Sellner','2nd','msellner1h@google.co.uk','notRegistered'),
(55,'55','Lennie','Haggie','2nd','lhaggie1i@walmart.com','notRegistered'),
(56,'56','Timotheus','Ousley','2nd','tousley1j@ucoz.ru','notRegistered'),
(57,'57','Delmore','Marston','2nd','dmarston1k@ihg.com','notRegistered'),
(58,'58','Ysabel','Braddick','2nd','ybraddick1l@who.int','notRegistered'),
(59,'59','Purcell','Caldecutt','2nd','pcaldecutt1m@unc.edu','notRegistered'),
(60,'60','Nappie','Andrassy','2nd','nandrassy1n@cnet.com','notRegistered'),
(61,'61','Quintus','Dafforne','2nd','qdafforne1o@smugmug.com','notRegistered'),
(62,'62','Maible','Peeke','2nd','mpeeke1p@patch.com','notRegistered'),
(63,'63','Magnum','Cradoc','2nd','mcradoc1q@amazonaws.com','notRegistered'),
(64,'64','Ryann','Chyuerton','2nd','rchyuerton1r@bluehost.com','notRegistered'),
(65,'65','Valentine','Cremer','2nd','vcremer1s@about.me','notRegistered'),
(66,'66','Taffy','Bienvenu','2nd','tbienvenu1t@reuters.com','notRegistered'),
(67,'67','Violette','Danat','2nd','vdanat1u@home.pl','notRegistered'),
(68,'68','Ginger','Sole','2nd','gsole1v@answers.com','notRegistered'),
(69,'69','Guillemette','Linwood','2nd','glinwood1w@i2i.jp','registered'),
(70,'70','Marlow','Bartens','2nd','mbartens1x@noaa.gov','notRegistered'),
(71,'71','Christabel','Biever','2nd','cbiever1y@spiegel.de','notRegistered'),
(72,'72','Aldrich','Cottam','2nd','acottam1z@rediff.com','notRegistered'),
(73,'73','Brew','Etienne','2nd','betienne20@hc360.com','notRegistered'),
(74,'74','Ferne','Worboys','2nd','fworboys21@google.ru','notRegistered'),
(75,'75','Allene','Sennett','2nd','asennett22@google.es','notRegistered'),
(76,'76','Fredericka','Van Rembrandt','2nd','fvanrembrandt23@nifty.com','notRegistered'),
(77,'77','Jamesy','Rippen','2nd','jrippen24@spotify.com','notRegistered'),
(78,'78','Haskel','Fockes','2nd','hfockes25@tiny.cc','notRegistered'),
(79,'79','Rachele','Bromehead','2nd','rbromehead26@unc.edu','notRegistered'),
(80,'80','Emylee','Ogdahl','2nd','eogdahl27@sohu.com','notRegistered'),
(81,'81','Richart','Pozzo','2nd','rpozzo28@ask.com','notRegistered'),
(82,'82','Mariele','Devanny','2nd','mdevanny29@homestead.com','notRegistered'),
(83,'83','Hewet','Waldram','2nd','hwaldram2a@jimdo.com','notRegistered'),
(84,'84','Gerry','Whaley','2nd','gwhaley2b@themeforest.net','notRegistered'),
(85,'85','Stillman','Lacroutz','2nd','slacroutz2c@wikia.com','notRegistered'),
(86,'86','Franky','Grain','2nd','fgrain2d@businessweek.com','notRegistered'),
(87,'87','Celisse','Sloss','2nd','csloss2e@sphinn.com','notRegistered'),
(88,'88','Babette','Tadlow','2nd','btadlow2f@google.com','notRegistered'),
(89,'89','Artair','Channing','2nd','achanning2g@walmart.com','notRegistered'),
(90,'90','Abbie','covino','2nd','acovino2h@unesco.org','notRegistered'),
(91,'91','Ramon','Forsdike','2nd','rforsdike2i@psu.edu','notRegistered'),
(92,'92','Quinlan','Pritchitt','2nd','qpritchitt2j@yelp.com','notRegistered'),
(93,'93','Ricki','Boscott','2nd','rboscott2k@shop-pro.jp','notRegistered'),
(94,'94','Briny','Mcettrick','2nd','bmcettrick2l@webmd.com','notRegistered'),
(95,'95','Georges','Learmonth','2nd','glearmonth2m@deliciousdays.com','notRegistered'),
(96,'96','Corissa','Woodrow','2nd','cwoodrow2n@cnn.com','notRegistered'),
(97,'97','Corey','Witherup','2nd','cwitherup2o@mayoclinic.com','notRegistered'),
(98,'98','Jameson','Fieldgate','2nd','jfieldgate2p@independent.co.uk','notRegistered'),
(99,'99','Schuyler','Shadfourth','2nd','sshadfourth2q@comsenz.com','notRegistered'),
(100,'100','Kevon','Seymour','2nd','kseymour2r@vk.com','notRegistered');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `accountType` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contactNo` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `createdBy` varchar(100) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `Code` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`firstName`,`lastName`,`accountType`,`email`,`contactNo`,`password`,`createdBy`,`dateCreated`,`Code`,`status`) values 
(1,'admin','admin','supervisor','admin@voting.com','09121202346','cdbcf01f510acc95b076b2e09500f3e9',NULL,NULL,NULL,NULL);

/*Table structure for table `votes` */

DROP TABLE IF EXISTS `votes`;

CREATE TABLE `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voterId` varchar(255) DEFAULT NULL,
  `candidateId` varchar(255) DEFAULT NULL,
  `votedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `votes` */

/*Table structure for table `votingdate` */

DROP TABLE IF EXISTS `votingdate`;

CREATE TABLE `votingdate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `votingdate` */

insert  into `votingdate`(`id`,`startDate`,`endDate`) values 
(1,'2021-12-03 08:00:00','2021-12-03 19:19:32');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
