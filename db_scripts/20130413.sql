/*
SQLyog Ultimate v10.2 
MySQL - 5.5.24-log : Database - olly
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`olly` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `_language` */

CREATE TABLE `_language` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_name` varchar(30) DEFAULT NULL,
  `language_initial` varchar(10) DEFAULT NULL,
  `language_icon` varchar(100) DEFAULT NULL,
  `language_archived` varchar(1) DEFAULT 'Y',
  PRIMARY KEY (`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `_language` */

insert  into `_language`(`language_id`,`language_name`,`language_initial`,`language_icon`,`language_archived`) values (1,'English','en','en.png','N');

/*Table structure for table `_language_default` */

CREATE TABLE `_language_default` (
  `language_default_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_default_name` varchar(30) DEFAULT NULL,
  `language_default_initial` varchar(10) DEFAULT NULL,
  `language_default_icon` varchar(100) DEFAULT NULL,
  `language_default_archived` varchar(1) DEFAULT 'Y',
  PRIMARY KEY (`language_default_id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

/*Data for the table `_language_default` */

insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (1,'English','en','en.png','N'),(2,'français','fr','fr.png','N'),(3,'简体中文','zh-hans','zh-hans.png','N'),(4,'繁體中文','zh-hant','zh-hant.png','N'),(5,'Deutsch','de','de.png','N'),(6,'Español','es','es.png','N'),(7,'Italiano','it','it.png','N'),(8,'العربية','ar','ar.png','N'),(9,'','bg','bg.png','N'),(10,'','ca','ca.png','N'),(11,'','cs','cs.png','N'),(12,'','da','da.png','N'),(13,'','el','el.png','N'),(14,'','eo','eo.png','N'),(15,'','et','et.png','N'),(16,'','eu','eu.png','N'),(17,'','fa','fa.png','N'),(18,'','fi','fi.png','N'),(19,'','fo','fo.png','N'),(20,'','ga','ga.png','N'),(21,'','gl','gl.png','N'),(22,'','he','he.png','N'),(23,'','hr','hr.png','N'),(24,'','hu','hu.png','N'),(25,'','id','id.png','N'),(26,'','is','is.png','N'),(27,'','ja','ja.png','N'),(28,'','km','km.png','N'),(29,'','lb','lb.png','N'),(30,'','lt','lt.png','N'),(31,'','lv','lv.png','N'),(32,'','nb','nb.png','N'),(33,'','nl','nl.png','N'),(34,'','nn','nn.png','N'),(35,'','pl','pl.png','N'),(36,'','pt-br','pt-br.png','N'),(37,'','pt-pt','pt-pt.png','N'),(38,'','ro','ro.png','N'),(39,'','ru','ru.png','N'),(40,'','sco','sco.png','N'),(41,'','sk','sk.png','N'),(42,'','sl','sl.png','N'),(43,'','sv','sv.png','N'),(44,'','tg','tg.png','N'),(45,'','th','th.png','N'),(46,'','tl','tl.png','N'),(47,'','tr','tr.png','N'),(48,'','uk','uk.png','N'),(49,'','vi','vi.png','N');

/*Table structure for table `cms_content` */

CREATE TABLE `cms_content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_author_id` int(11) NOT NULL,
  `content_title` varchar(100) NOT NULL,
  `content_article` text,
  `content_create_date` datetime NOT NULL,
  `content_last_modify_by` int(11) NOT NULL,
  `content_last_modify_date` datetime NOT NULL,
  `content_archived` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `cms_content` */

insert  into `cms_content`(`content_id`,`content_author_id`,`content_title`,`content_article`,`content_create_date`,`content_last_modify_by`,`content_last_modify_date`,`content_archived`) values (1,1,'Test content','<p>this is testing content</p>','2010-08-13 20:59:17',1,'2013-04-08 15:16:54','N'),(2,1,'test article 2','<p>test article 2</p>','2010-08-13 20:59:17',1,'2013-04-08 15:20:19','N'),(3,1,'Hello world','<p><em><strong>The world is a&nbsp;beautiful&nbsp;mess!</strong></em></p>','2013-04-08 15:04:06',1,'2013-04-08 15:16:12','N');

/*Table structure for table `cms_menu` */

CREATE TABLE `cms_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_parent_id` int(11) NOT NULL DEFAULT '0',
  `menu_type_id` int(11) NOT NULL,
  `menu_order` int(11) NOT NULL DEFAULT '1',
  `menu_link` text,
  `menu_name` varchar(100) NOT NULL,
  `menu_desc` varchar(100) DEFAULT NULL,
  `menu_archived` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`menu_id`),
  KEY `menu_type_id` (`menu_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `cms_menu` */

insert  into `cms_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_name`,`menu_desc`,`menu_archived`) values (1,0,1,3,'www.google.com','Google','test','N'),(2,1,1,3,'index.php?view=product_onsale','test1','this is a testing','N'),(3,1,1,3,'customer.php?view=order_history','test2',NULL,'N'),(4,3,1,4,'index.php?content_id=1&view=content&title=Delivery-Policy','test3',NULL,'N'),(5,0,1,5,'index.php?content_id=2&view=content&title=Contact-Us','test4',NULL,'N'),(6,5,1,3,'http://www.ziyangluyao.com','Google Testing','','N'),(7,0,1,10,'','Content link testing','','N'),(8,0,1,10,'index.php?view=cms&article_id=2','My yes','','N');

/*Table structure for table `cms_menu_type` */

CREATE TABLE `cms_menu_type` (
  `menu_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_type_name` varchar(50) NOT NULL,
  `menu_type_description` varchar(200) DEFAULT NULL,
  `menu_type_archived` char(1) NOT NULL,
  PRIMARY KEY (`menu_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `cms_menu_type` */

insert  into `cms_menu_type`(`menu_type_id`,`menu_type_name`,`menu_type_description`,`menu_type_archived`) values (1,'Top Menu','Top Menu','N'),(2,'Bottom Menu','Bottom Menu','N');

/*Table structure for table `core_module` */

CREATE TABLE `core_module` (
  `module_code` varchar(50) NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `module_desc` text,
  `module_archived` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`module_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `core_module` */

insert  into `core_module`(`module_code`,`module_name`,`module_desc`,`module_archived`) values ('390fc605ba6c4010cb26794169636add','Content Manager','The Content Management System','N'),('a74ad8dfacd4f985eb3977517615ce25','System Core','The Core Module','N');

/*Table structure for table `core_module_configuration` */

CREATE TABLE `core_module_configuration` (
  `module_config_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_code` varchar(50) NOT NULL,
  `module_config_title` varchar(64) NOT NULL DEFAULT '',
  `module_config_key` varchar(64) NOT NULL DEFAULT '',
  `module_config_value` varchar(255) NOT NULL DEFAULT '',
  `module_config_desc` varchar(255) NOT NULL DEFAULT '',
  `module_config_type` varchar(10) NOT NULL,
  PRIMARY KEY (`module_config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `core_module_configuration` */

insert  into `core_module_configuration`(`module_config_id`,`module_code`,`module_config_title`,`module_config_key`,`module_config_value`,`module_config_desc`,`module_config_type`) values (1,'a74ad8dfacd4f985eb3977517615ce25','Site Name','shop_name','Deal Steal','Name of the shop','string'),(2,'a74ad8dfacd4f985eb3977517615ce25','Owner Name','owner_name','Ziyang Peng','Owner of the shop','string'),(3,'a74ad8dfacd4f985eb3977517615ce25','Meta Keywords','meta_keywords','Deal Steal','META keywords for SEO','text'),(4,'a74ad8dfacd4f985eb3977517615ce25','Meta Description','meta_description','Deal Steal','META Descriptions for SEO','text'),(5,'390fc605ba6c4010cb26794169636add','Admin Email','admin_email','pengziyang@gmail.com','Administractor Email Address','string'),(6,'390fc605ba6c4010cb26794169636add','Email Host','email_host','mail.mydreamland.co.uk','Host Address for email','string'),(7,'390fc605ba6c4010cb26794169636add','Currency Name','currency_Name','GBP','Currency Name','string'),(8,'390fc605ba6c4010cb26794169636add','Currency Sign','currency_sign','£','Currency Sign','string'),(9,'390fc605ba6c4010cb26794169636add','Product Image Path','product_image_path','images/products/','Product Image Path','string'),(10,'390fc605ba6c4010cb26794169636add','Show Banner','show_banner','Y','Whether display the banner (Y - Yes, N - No)','boolean'),(11,'390fc605ba6c4010cb26794169636add','No. of item display on index page','num_item_on_index_page','8','The number of products will be displayed on the index page','number'),(12,'390fc605ba6c4010cb26794169636add','Show Product Review','show_review','Y','Whether display the Product review (Y - Yes, N - No)','boolean'),(13,'390fc605ba6c4010cb26794169636add','Email Server Port','email_port','2626','Email Server Port','string'),(14,'390fc605ba6c4010cb26794169636add','Email User Account','email_user','test+mydreamland.co.uk','Email Server User Account','string'),(15,'390fc605ba6c4010cb26794169636add','Email User Password','email_password','11111111','Email Server User Account Password','string'),(16,'390fc605ba6c4010cb26794169636add','Email Send From','email_sender','test@mydreamland.co.uk','Email Account that sends email','string'),(17,'a74ad8dfacd4f985eb3977517615ce25','Domain','domain_name','http://localhost:2048/rose_voip','Domain Name','string'),(18,'390fc605ba6c4010cb26794169636add','Stock Level Warning ','stock_level_warning','5','Stock level warning','number');

/*Table structure for table `core_user` */

CREATE TABLE `core_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL DEFAULT '',
  `user_password` varchar(50) NOT NULL DEFAULT '',
  `user_archived` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`user_id`,`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `core_user` */

insert  into `core_user`(`user_id`,`user_name`,`user_password`,`user_archived`) values (1,'pengziyang@gmail.com','ae38f3e59310c930f2f9ebcfc9497499','N'),(2,'zpeng@gmail.com','ae38f3e59310c930f2f9ebcfc9497499','N'),(5,'lyla.holy@gmail.com','ae38f3e59310c930f2f9ebcfc9497499','N'),(7,'pengshiqun@gmail.com','ae38f3e59310c930f2f9ebcfc9497499','N');

/*Table structure for table `core_user_subscribe_module` */

CREATE TABLE `core_user_subscribe_module` (
  `user_id` int(11) NOT NULL,
  `module_code` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`,`module_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `core_user_subscribe_module` */

insert  into `core_user_subscribe_module`(`user_id`,`module_code`) values (1,'390fc605ba6c4010cb26794169636add'),(1,'a74ad8dfacd4f985eb3977517615ce25'),(2,'390fc605ba6c4010cb26794169636add'),(5,'390fc605ba6c4010cb26794169636add'),(5,'a74ad8dfacd4f985eb3977517615ce25'),(6,'a74ad8dfacd4f985eb3977517615ce25'),(7,'390fc605ba6c4010cb26794169636add');

/*Table structure for table `ds_category` */

CREATE TABLE `ds_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ds_category` */

/*Table structure for table `ds_client` */

CREATE TABLE `ds_client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_email` varchar(50) NOT NULL,
  `client_firstname` varchar(50) NOT NULL,
  `client_surname` varchar(50) NOT NULL,
  `client_title` varchar(10) NOT NULL,
  `client_tel` varchar(50) DEFAULT NULL,
  `client_mobile` varchar(50) DEFAULT NULL,
  `client_address` text,
  PRIMARY KEY (`client_id`,`client_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ds_client` */

/*Table structure for table `ds_deal` */

CREATE TABLE `ds_deal` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `deal_title` varchar(50) NOT NULL,
  `deal_type` char(1) NOT NULL DEFAULT 'S' COMMENT 'Single/Multiple',
  `deal_desc` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `original_price` double NOT NULL,
  `offer_price` double NOT NULL,
  `online_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `offline_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fine_print` text NOT NULL,
  `deal_archived` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`deal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ds_deal` */

/*Table structure for table `ds_deal_image` */

CREATE TABLE `ds_deal_image` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_id` int(11) NOT NULL,
  `img_title` varchar(100) DEFAULT NULL,
  `img_url` varchar(100) NOT NULL,
  `img_default` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ds_deal_image` */

/*Table structure for table `ds_deal_tag` */

CREATE TABLE `ds_deal_tag` (
  `deal_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`deal_id`,`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ds_deal_tag` */

/*Table structure for table `ds_location` */

CREATE TABLE `ds_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_parent_id` int(11) NOT NULL DEFAULT '0',
  `location_name` varchar(50) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ds_location` */

/*Table structure for table `ds_love_hate` */

CREATE TABLE `ds_love_hate` (
  `deal_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `love_it` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`deal_id`,`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ds_love_hate` */

/*Table structure for table `ds_rating_review` */

CREATE TABLE `ds_rating_review` (
  `deal_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `rating_value` int(11) NOT NULL,
  `review` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`deal_id`,`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ds_rating_review` */

/*Table structure for table `ds_supplier` */

CREATE TABLE `ds_supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_url` varchar(100) DEFAULT NULL,
  `supplier_logo` varchar(100) DEFAULT NULL,
  `supplier_email` varchar(50) DEFAULT NULL,
  `supplier_address` text,
  `supplier_tel` varchar(50) DEFAULT NULL,
  `supplier_desc` text,
  `supplier_archived` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ds_supplier` */

/*Table structure for table `ds_tag` */

CREATE TABLE `ds_tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(50) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ds_tag` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
