/*
SQLyog Ultimate v10.2 
MySQL - 5.5.24-log : Database - olly
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `_address` */

CREATE TABLE `_address` (
  `add_id` int(11) NOT NULL AUTO_INCREMENT,
  `add_1` varchar(50) NOT NULL,
  `add_2` varchar(50) DEFAULT NULL,
  `add_3` varchar(50) DEFAULT NULL,
  `town` varchar(50) NOT NULL,
  `county` varchar(50) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `postcode` varchar(15) NOT NULL,
  PRIMARY KEY (`add_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_address` */

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

insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (1,'English','en','en.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (2,'français','fr','fr.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (3,'简体中文','zh-hans','zh-hans.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (4,'繁體中文','zh-hant','zh-hant.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (5,'Deutsch','de','de.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (6,'Español','es','es.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (7,'Italiano','it','it.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (8,'العربية','ar','ar.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (9,'','bg','bg.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (10,'','ca','ca.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (11,'','cs','cs.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (12,'','da','da.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (13,'','el','el.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (14,'','eo','eo.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (15,'','et','et.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (16,'','eu','eu.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (17,'','fa','fa.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (18,'','fi','fi.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (19,'','fo','fo.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (20,'','ga','ga.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (21,'','gl','gl.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (22,'','he','he.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (23,'','hr','hr.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (24,'','hu','hu.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (25,'','id','id.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (26,'','is','is.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (27,'','ja','ja.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (28,'','km','km.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (29,'','lb','lb.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (30,'','lt','lt.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (31,'','lv','lv.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (32,'','nb','nb.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (33,'','nl','nl.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (34,'','nn','nn.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (35,'','pl','pl.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (36,'','pt-br','pt-br.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (37,'','pt-pt','pt-pt.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (38,'','ro','ro.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (39,'','ru','ru.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (40,'','sco','sco.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (41,'','sk','sk.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (42,'','sl','sl.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (43,'','sv','sv.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (44,'','tg','tg.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (45,'','th','th.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (46,'','tl','tl.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (47,'','tr','tr.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (48,'','uk','uk.png','N');
insert  into `_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (49,'','vi','vi.png','N');

/*Table structure for table `cms_content` */

CREATE TABLE `cms_content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_author_id` int(11) NOT NULL,
  `content_title` varchar(100) NOT NULL,
  `content_article` text,
  `content_create_date` datetime NOT NULL,
  `content_last_modify_by` int(11) NOT NULL,
  `content_last_modify_date` datetime NOT NULL,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `cms_content` */

insert  into `cms_content`(`content_id`,`content_author_id`,`content_title`,`content_article`,`content_create_date`,`content_last_modify_by`,`content_last_modify_date`,`active`) values (1,1,'About Us','<p>this is testing content hello</p>','2010-08-13 20:59:17',1,'2013-11-01 21:46:04','Y');
insert  into `cms_content`(`content_id`,`content_author_id`,`content_title`,`content_article`,`content_create_date`,`content_last_modify_by`,`content_last_modify_date`,`active`) values (2,1,'FAQs','<p><span style=\"color: #444444; font-family: Calibri, Arial, Helvetica, sans-serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 19.1875px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #be8f46; display: inline !important; float: none;\">FAQs</span></p>','2010-08-13 20:59:17',1,'2013-10-31 13:16:51','Y');
insert  into `cms_content`(`content_id`,`content_author_id`,`content_title`,`content_article`,`content_create_date`,`content_last_modify_by`,`content_last_modify_date`,`active`) values (3,1,'Terms & Conditions','<p>wwwwww3333</p>','2013-04-08 15:04:06',1,'2013-10-31 13:17:41','Y');
insert  into `cms_content`(`content_id`,`content_author_id`,`content_title`,`content_article`,`content_create_date`,`content_last_modify_by`,`content_last_modify_date`,`active`) values (4,1,'Privacy Policy','<h2><strong>heheheosdis e</strong></h2>\n<h2>&nbsp;</h2>\n<h2><strong>deded</strong></h2>\n<h2>&nbsp;</h2>\n<h2>&nbsp;</h2>\n<h2><strong>dede</strong></h2>','2013-04-21 13:19:44',1,'2013-10-31 13:17:52','Y');

/*Table structure for table `cms_menu` */

CREATE TABLE `cms_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_parent_id` int(11) NOT NULL DEFAULT '0',
  `menu_type_id` int(11) NOT NULL,
  `menu_order` int(11) NOT NULL DEFAULT '1',
  `menu_link` text,
  `menu_name` varchar(100) NOT NULL,
  `menu_desc` varchar(100) DEFAULT NULL,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`menu_id`),
  KEY `menu_type_id` (`menu_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `cms_menu` */

insert  into `cms_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_name`,`menu_desc`,`active`) values (1,0,1,3,'www.google.com','Google','test','Y');
insert  into `cms_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_name`,`menu_desc`,`active`) values (2,1,1,3,'index.php?view=product_onsale','test1','this is a testingeeee','Y');
insert  into `cms_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_name`,`menu_desc`,`active`) values (3,1,1,3,'customer.php?view=order_history','test2',NULL,'Y');
insert  into `cms_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_name`,`menu_desc`,`active`) values (4,3,1,4,'index.php?content_id=1&view=content&title=Delivery-Policy','test3',NULL,'Y');
insert  into `cms_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_name`,`menu_desc`,`active`) values (5,0,1,5,'index.php?content_id=2&view=content&title=Contact-Us','test4',NULL,'Y');
insert  into `cms_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_name`,`menu_desc`,`active`) values (6,5,1,3,'http://www.ziyangluyao.com','Google Testing','','Y');
insert  into `cms_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_name`,`menu_desc`,`active`) values (7,0,1,10,'','Content link testing','','Y');
insert  into `cms_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_name`,`menu_desc`,`active`) values (8,0,1,10,'index.php?view=cms&article_id=2','My yes','','Y');
insert  into `cms_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_name`,`menu_desc`,`active`) values (9,1,1,1,'index.php?view=cms&article_id=2','treeee','','Y');
insert  into `cms_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_name`,`menu_desc`,`active`) values (10,9,1,1,'index.php?view=cms&article_id=4','real madird','','Y');
insert  into `cms_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_name`,`menu_desc`,`active`) values (11,4,1,3,'index.php?view=cms&article_id=','ok it is','','Y');
insert  into `cms_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_name`,`menu_desc`,`active`) values (12,1,1,11,'http://','dede','','Y');
insert  into `cms_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_name`,`menu_desc`,`active`) values (13,0,1,22,'http://','dede222','','Y');
insert  into `cms_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_name`,`menu_desc`,`active`) values (14,0,1,14,'http://test','test test test','','Y');
insert  into `cms_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_name`,`menu_desc`,`active`) values (15,0,2,1,'http://google.com','bottom','','Y');

/*Table structure for table `cms_menu_type` */

CREATE TABLE `cms_menu_type` (
  `menu_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_type_name` varchar(50) NOT NULL,
  `menu_type_description` varchar(200) DEFAULT NULL,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`menu_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `cms_menu_type` */

insert  into `cms_menu_type`(`menu_type_id`,`menu_type_name`,`menu_type_description`,`active`) values (1,'Top Menu','Top Menu','Y');
insert  into `cms_menu_type`(`menu_type_id`,`menu_type_name`,`menu_type_description`,`active`) values (2,'Bottom Menu','Bottom Menu','Y');

/*Table structure for table `core_module` */

CREATE TABLE `core_module` (
  `module_code` varchar(50) NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `module_desc` text,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`module_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `core_module` */

insert  into `core_module`(`module_code`,`module_name`,`module_desc`,`active`) values ('390fc605ba6c4010cb26794169636add','Content Manager','The Content Management System','Y');
insert  into `core_module`(`module_code`,`module_name`,`module_desc`,`active`) values ('a74ad8dfacd4f985eb3977517615ce25','System Core','The Core Module','Y');
insert  into `core_module`(`module_code`,`module_name`,`module_desc`,`active`) values ('b3a92844510a267ca17eef7e5ba703c9','Deal Steal','The Deal Steal Module','Y');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `core_module_configuration` */

insert  into `core_module_configuration`(`module_config_id`,`module_code`,`module_config_title`,`module_config_key`,`module_config_value`,`module_config_desc`,`module_config_type`) values (1,'b3a92844510a267ca17eef7e5ba703c9','Site Name','site_title','Deal Steal','Name of the shop','string');
insert  into `core_module_configuration`(`module_config_id`,`module_code`,`module_config_title`,`module_config_key`,`module_config_value`,`module_config_desc`,`module_config_type`) values (2,'b3a92844510a267ca17eef7e5ba703c9','Owner Name','owner_name','Ziyang Peng','Owner of the shop','string');
insert  into `core_module_configuration`(`module_config_id`,`module_code`,`module_config_title`,`module_config_key`,`module_config_value`,`module_config_desc`,`module_config_type`) values (3,'b3a92844510a267ca17eef7e5ba703c9','Meta Keywords','meta_keywords','Deal Steal','META keywords for SEO','text');
insert  into `core_module_configuration`(`module_config_id`,`module_code`,`module_config_title`,`module_config_key`,`module_config_value`,`module_config_desc`,`module_config_type`) values (4,'b3a92844510a267ca17eef7e5ba703c9','Meta Description','meta_description','Deal Steal','META Descriptions for SEO','text');

/*Table structure for table `core_user` */

CREATE TABLE `core_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL DEFAULT '',
  `user_password` varchar(50) NOT NULL DEFAULT '',
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`user_id`,`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `core_user` */

insert  into `core_user`(`user_id`,`user_name`,`user_password`,`active`) values (1,'pengziyang@gmail.com','3194c2235d8b9103283e4bb8dcfbc14482e83109','Y');
insert  into `core_user`(`user_id`,`user_name`,`user_password`,`active`) values (2,'zpeng@gmail.com','3194c2235d8b9103283e4bb8dcfbc14482e83109','Y');
insert  into `core_user`(`user_id`,`user_name`,`user_password`,`active`) values (5,'lyla.holy@gmail.com','3194c2235d8b9103283e4bb8dcfbc14482e83109','Y');
insert  into `core_user`(`user_id`,`user_name`,`user_password`,`active`) values (7,'pengshiqun@gmail.com','3194c2235d8b9103283e4bb8dcfbc14482e83109','Y');
insert  into `core_user`(`user_id`,`user_name`,`user_password`,`active`) values (8,'ziyangpeng@gmail.com','3194c2235d8b9103283e4bb8dcfbc14482e83109','Y');

/*Table structure for table `core_user_subscribe_module` */

CREATE TABLE `core_user_subscribe_module` (
  `user_id` int(11) NOT NULL,
  `module_code` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`,`module_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `core_user_subscribe_module` */

insert  into `core_user_subscribe_module`(`user_id`,`module_code`) values (1,'390fc605ba6c4010cb26794169636add');
insert  into `core_user_subscribe_module`(`user_id`,`module_code`) values (1,'a74ad8dfacd4f985eb3977517615ce25');
insert  into `core_user_subscribe_module`(`user_id`,`module_code`) values (1,'b3a92844510a267ca17eef7e5ba703c9');
insert  into `core_user_subscribe_module`(`user_id`,`module_code`) values (2,'390fc605ba6c4010cb26794169636add');
insert  into `core_user_subscribe_module`(`user_id`,`module_code`) values (2,'b3a92844510a267ca17eef7e5ba703c9');
insert  into `core_user_subscribe_module`(`user_id`,`module_code`) values (5,'390fc605ba6c4010cb26794169636add');
insert  into `core_user_subscribe_module`(`user_id`,`module_code`) values (5,'a74ad8dfacd4f985eb3977517615ce25');
insert  into `core_user_subscribe_module`(`user_id`,`module_code`) values (6,'a74ad8dfacd4f985eb3977517615ce25');
insert  into `core_user_subscribe_module`(`user_id`,`module_code`) values (7,'390fc605ba6c4010cb26794169636add');
insert  into `core_user_subscribe_module`(`user_id`,`module_code`) values (8,'a74ad8dfacd4f985eb3977517615ce25');
insert  into `core_user_subscribe_module`(`user_id`,`module_code`) values (8,'b3a92844510a267ca17eef7e5ba703c9');

/*Table structure for table `ds_category` */

CREATE TABLE `ds_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_parent_id` int(11) NOT NULL DEFAULT '0',
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `ds_category` */

insert  into `ds_category`(`category_id`,`category_parent_id`,`category_name`) values (1,0,'All Categories');
insert  into `ds_category`(`category_id`,`category_parent_id`,`category_name`) values (2,1,'Sports');
insert  into `ds_category`(`category_id`,`category_parent_id`,`category_name`) values (3,1,'Beauty');
insert  into `ds_category`(`category_id`,`category_parent_id`,`category_name`) values (4,1,'Foodies');

/*Table structure for table `ds_city` */

CREATE TABLE `ds_city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(50) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ds_city` */

insert  into `ds_city`(`city_id`,`city_name`) values (1,'National');
insert  into `ds_city`(`city_id`,`city_name`) values (2,'London');

/*Table structure for table `ds_client` */

CREATE TABLE `ds_client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_email` varchar(50) NOT NULL,
  `client_password` varchar(50) NOT NULL,
  `client_title` varchar(10) NOT NULL,
  `client_firstname` varchar(50) NOT NULL,
  `client_surname` varchar(50) NOT NULL,
  `client_dob` date NOT NULL,
  `client_tel` varchar(50) DEFAULT NULL,
  `client_mobile` varchar(50) DEFAULT NULL,
  `subscribed` char(1) NOT NULL DEFAULT 'Y',
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`client_id`,`client_email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `ds_client` */

insert  into `ds_client`(`client_id`,`client_email`,`client_password`,`client_title`,`client_firstname`,`client_surname`,`client_dob`,`client_tel`,`client_mobile`,`subscribed`,`active`) values (1,'pengziyang@gmail.com','3194c2235d8b9103283e4bb8dcfbc14482e83109','Mr.','Ziyang','Peng','2013-10-01','07598030391','07598030391','Y','Y');
insert  into `ds_client`(`client_id`,`client_email`,`client_password`,`client_title`,`client_firstname`,`client_surname`,`client_dob`,`client_tel`,`client_mobile`,`subscribed`,`active`) values (2,'lyla.holy@gmail.com','3194c2235d8b9103283e4bb8dcfbc14482e83109','Mrs.','Lyla','He','2013-11-04','07598030391','07598030391','Y','Y');
insert  into `ds_client`(`client_id`,`client_email`,`client_password`,`client_title`,`client_firstname`,`client_surname`,`client_dob`,`client_tel`,`client_mobile`,`subscribed`,`active`) values (3,'asif@gmail.com','3194c2235d8b9103283e4bb8dcfbc14482e83109','Mr.','Asif','Awan','2013-11-03','','','Y','Y');
insert  into `ds_client`(`client_id`,`client_email`,`client_password`,`client_title`,`client_firstname`,`client_surname`,`client_dob`,`client_tel`,`client_mobile`,`subscribed`,`active`) values (4,'pengziyang@hotmail.com','3194c2235d8b9103283e4bb8dcfbc14482e83109','Mr.','Ziyang','Peng','2013-11-03','','','Y','Y');
insert  into `ds_client`(`client_id`,`client_email`,`client_password`,`client_title`,`client_firstname`,`client_surname`,`client_dob`,`client_tel`,`client_mobile`,`subscribed`,`active`) values (5,'liqunmeng@gmail.com','3194c2235d8b9103283e4bb8dcfbc14482e83109','Mr.','Liqun','Meng','2013-11-04','','','Y','Y');
insert  into `ds_client`(`client_id`,`client_email`,`client_password`,`client_title`,`client_firstname`,`client_surname`,`client_dob`,`client_tel`,`client_mobile`,`subscribed`,`active`) values (6,'pengshiqun@gmail.com','3194c2235d8b9103283e4bb8dcfbc14482e83109','Mr.','dwed','dwe','2013-11-10','','','Y','Y');

/*Table structure for table `ds_concierge` */

CREATE TABLE `ds_concierge` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `request_detail` text NOT NULL,
  `request_date` text NOT NULL,
  `request_budget` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` char(15) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `ds_concierge` */

insert  into `ds_concierge`(`con_id`,`client_id`,`supplier_id`,`request_detail`,`request_date`,`request_budget`,`timestamp`,`status`) values (1,1,1,'I want a iphone 5','not later than 1st of Sep 2003','less than 400GBP','2013-08-07 20:03:07','Pending');

/*Table structure for table `ds_deal` */

CREATE TABLE `ds_deal` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `deal_title` varchar(50) NOT NULL,
  `deal_type` char(1) NOT NULL DEFAULT 'D' COMMENT 'Deal/Voucher',
  `original_quantity` int(11) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `original_price` double(10,2) NOT NULL DEFAULT '0.00',
  `offer_price` double(10,2) NOT NULL DEFAULT '0.00',
  `online_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `offline_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fine_print` text NOT NULL,
  `thumbnail` varchar(100) DEFAULT 'default_t.jpg',
  `image` varchar(100) DEFAULT 'default.jpg',
  `deal_desc` text,
  `voucher_template` text,
  `has_geo_data` char(1) NOT NULL DEFAULT 'N',
  `google_map` text,
  `rate_average` double DEFAULT '0' COMMENT 'running average',
  `rate_total` int(11) DEFAULT '0' COMMENT 'total number of vote',
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`deal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `ds_deal` */

insert  into `ds_deal`(`deal_id`,`supplier_id`,`category_id`,`city_id`,`deal_title`,`deal_type`,`original_quantity`,`quantity`,`original_price`,`offer_price`,`online_date`,`offline_date`,`fine_print`,`thumbnail`,`image`,`deal_desc`,`voucher_template`,`has_geo_data`,`google_map`,`rate_average`,`rate_total`,`active`) values (2,3,3,1,'Buy 1 get 1 free','V',100,99,20.00,8.00,'2013-05-07 04:29:04','2014-08-31 12:17:00','<ul>\n<li>Ticket valid until Nov 30, 2013.</li>\n<li>Ticket collection period: Oct 17, 2013 &pound; Nov 29, 2013.</li>\n<li>No bookings required. First-come, first-served basis.</li>\n<li>Valid for collection from Mon &pound; Sat: 10am &pound; 7pm (not including Sundays, eve of public holidays, and public holidays).</li>\n</ul>','21383147036.jpg','21383082608.jpg','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ante ante, dictum in pharetra eu, dapibus sit amet sem. Sed at molestie ipsum. Aliquam erat volutpat. Pellentesque tincidunt tristique lectus quis feugiat. Duis auctor sollicitudin gravida. Nulla gravida sapien ac sagittis volutpat.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ante ante, dictum in pharetra eu, dapibus sit amet sem. Sed at molestie ipsum. Aliquam erat volutpat. Pellentesque tincidunt tristique lectus quis feugiat. Duis auctor sollicitudin gravida. Nulla gravida sapien ac sagittis volutpat.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ante ante, dictum in pharetra eu, dapibus sit amet sem. Sed at molestie ipsum. Aliquam erat volutpat. Pellentesque tincidunt tristique lectus quis feugiat. Duis auctor sollicitudin gravida. Nulla gravida sapien ac sagittis volutpat.</p>','<p><em><strong><img src=\"http://staging.dealsteal.co/images/site/dealsteal.png\" alt=\"\" width=\"306\" height=\"98\" /></strong></em></p>\n<p><em><strong>This is a Fine Print to test if this functionality will work</strong></em></p>','Y','<div style=\"width:680px;height:350px\"><iframe width=\"680\" height=\"350\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=EC2A%2B1HD(Testing+Address)&ie=UTF8&z=16&t=m&iwloc=near&output=embed\"></iframe><br><table width=\"680\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td align=\"left\"><small><a href=\"http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=EC2A%2B1HD(Testing+Address)&ie=UTF8&z=16&t=m&iwloc=near\">View Larger Map</a></small></td><td align=\"right\"><small><a href=\"http://www.embedgooglemap.com\">embed google map</a></small></td></tr></table></div>',3.5,3,'Y');
insert  into `ds_deal`(`deal_id`,`supplier_id`,`category_id`,`city_id`,`deal_title`,`deal_type`,`original_quantity`,`quantity`,`original_price`,`offer_price`,`online_date`,`offline_date`,`fine_print`,`thumbnail`,`image`,`deal_desc`,`voucher_template`,`has_geo_data`,`google_map`,`rate_average`,`rate_total`,`active`) values (3,2,4,2,'Half Price Promotion','D',100,100,30.00,14.99,'2013-05-07 16:29:04','2014-06-01 12:00:00','<ul>\n<li>term 1</li>\n<li>term 2</li>\n</ul>','31383147467.jpg','31383147475.jpg','<p>descxxxx</p>',NULL,'N',NULL,4.5,1,'Y');
insert  into `ds_deal`(`deal_id`,`supplier_id`,`category_id`,`city_id`,`deal_title`,`deal_type`,`original_quantity`,`quantity`,`original_price`,`offer_price`,`online_date`,`offline_date`,`fine_print`,`thumbnail`,`image`,`deal_desc`,`voucher_template`,`has_geo_data`,`google_map`,`rate_average`,`rate_total`,`active`) values (4,4,1,2,'50% off trip to London','D',200,200,500.00,350.00,'2013-10-29 12:00:00','2014-01-31 12:00:00','','41383148260.jpg','41383148243.jpg','','','N',NULL,0,0,'Y');
insert  into `ds_deal`(`deal_id`,`supplier_id`,`category_id`,`city_id`,`deal_title`,`deal_type`,`original_quantity`,`quantity`,`original_price`,`offer_price`,`online_date`,`offline_date`,`fine_print`,`thumbnail`,`image`,`deal_desc`,`voucher_template`,`has_geo_data`,`google_map`,`rate_average`,`rate_total`,`active`) values (5,3,1,1,'15% Super Car Drving','D',100,100,300.00,270.00,'2013-10-22 12:00:00','2014-01-09 12:00:00','','51383148402.jpg','51383148418.jpg','','','N',NULL,3.5,1,'Y');

/*Table structure for table `ds_deal_image` */

CREATE TABLE `ds_deal_image` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_id` int(11) NOT NULL,
  `img_title` varchar(100) DEFAULT NULL,
  `img_url` varchar(100) NOT NULL,
  `img_is_default` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ds_deal_image` */

/*Table structure for table `ds_deal_of_day` */

CREATE TABLE `ds_deal_of_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`,`deal_id`,`date`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

/*Data for the table `ds_deal_of_day` */

insert  into `ds_deal_of_day`(`id`,`deal_id`,`date`) values (23,2,'2013-05-31');
insert  into `ds_deal_of_day`(`id`,`deal_id`,`date`) values (28,2,'2013-05-28');
insert  into `ds_deal_of_day`(`id`,`deal_id`,`date`) values (38,3,'2013-06-06');
insert  into `ds_deal_of_day`(`id`,`deal_id`,`date`) values (40,2,'2013-06-11');
insert  into `ds_deal_of_day`(`id`,`deal_id`,`date`) values (41,2,'2013-06-13');
insert  into `ds_deal_of_day`(`id`,`deal_id`,`date`) values (42,2,'2013-07-28');
insert  into `ds_deal_of_day`(`id`,`deal_id`,`date`) values (43,3,'2013-07-31');
insert  into `ds_deal_of_day`(`id`,`deal_id`,`date`) values (47,2,'2013-08-14');
insert  into `ds_deal_of_day`(`id`,`deal_id`,`date`) values (48,2,'2013-08-05');
insert  into `ds_deal_of_day`(`id`,`deal_id`,`date`) values (49,2,'2013-07-30');
insert  into `ds_deal_of_day`(`id`,`deal_id`,`date`) values (50,2,'2013-08-01');
insert  into `ds_deal_of_day`(`id`,`deal_id`,`date`) values (51,3,'2013-08-02');

/*Table structure for table `ds_deal_tag` */

CREATE TABLE `ds_deal_tag` (
  `tag_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  PRIMARY KEY (`tag_id`,`deal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ds_deal_tag` */

insert  into `ds_deal_tag`(`tag_id`,`deal_id`) values (1,2);
insert  into `ds_deal_tag`(`tag_id`,`deal_id`) values (2,2);
insert  into `ds_deal_tag`(`tag_id`,`deal_id`) values (3,2);
insert  into `ds_deal_tag`(`tag_id`,`deal_id`) values (3,3);
insert  into `ds_deal_tag`(`tag_id`,`deal_id`) values (5,2);
insert  into `ds_deal_tag`(`tag_id`,`deal_id`) values (5,3);

/*Table structure for table `ds_order` */

CREATE TABLE `ds_order` (
  `order_id` int(11) NOT NULL,
  `order_code` varchar(30) NOT NULL,
  `client_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `unit_price` double(10,2) NOT NULL DEFAULT '0.00',
  `total_price` double(10,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `payment_method` varchar(20) NOT NULL,
  `del_postcode` varchar(10) DEFAULT NULL,
  `del_add_1` varchar(50) DEFAULT NULL,
  `del_add_2` varchar(50) DEFAULT NULL,
  `del_county` varchar(20) DEFAULT NULL,
  `order_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ds_order` */

insert  into `ds_order`(`order_id`,`order_code`,`client_id`,`deal_id`,`unit_price`,`total_price`,`quantity`,`payment_method`,`del_postcode`,`del_add_1`,`del_add_2`,`del_county`,`order_timestamp`,`order_status`) values (1,'wsfdwqfrwferfrfrf',1,2,0.00,0.00,0,'',NULL,NULL,NULL,NULL,'2013-08-17 20:24:00','D');

/*Table structure for table `ds_rate_it` */

CREATE TABLE `ds_rate_it` (
  `deal_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`deal_id`,`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ds_rate_it` */

insert  into `ds_rate_it`(`deal_id`,`client_id`) values (2,1);
insert  into `ds_rate_it`(`deal_id`,`client_id`) values (3,1);
insert  into `ds_rate_it`(`deal_id`,`client_id`) values (5,1);

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
  `supplier_logo` varchar(100) DEFAULT 'default.png',
  `supplier_email` varchar(50) DEFAULT NULL,
  `supplier_address` text,
  `supplier_tel` varchar(50) DEFAULT NULL,
  `supplier_desc` text,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `ds_supplier` */

insert  into `ds_supplier`(`supplier_id`,`supplier_name`,`supplier_url`,`supplier_logo`,`supplier_email`,`supplier_address`,`supplier_tel`,`supplier_desc`,`active`) values (1,'Argos','www.argos.co.uk','11383479966.png','argos email','Argos UK','12345678','<p>Argos&nbsp;</p>','Y');
insert  into `ds_supplier`(`supplier_id`,`supplier_name`,`supplier_url`,`supplier_logo`,`supplier_email`,`supplier_address`,`supplier_tel`,`supplier_desc`,`active`) values (2,'Boots','','21383479999.png','','','','','Y');
insert  into `ds_supplier`(`supplier_id`,`supplier_name`,`supplier_url`,`supplier_logo`,`supplier_email`,`supplier_address`,`supplier_tel`,`supplier_desc`,`active`) values (3,'HMV','http://www.hmv.co.uk/','31383480008.png','hmv email','address','1234455','<p>hmv shop</p>','Y');
insert  into `ds_supplier`(`supplier_id`,`supplier_name`,`supplier_url`,`supplier_logo`,`supplier_email`,`supplier_address`,`supplier_tel`,`supplier_desc`,`active`) values (4,'Pizza Hut','','41383480023.png','','','','','Y');

/*Table structure for table `ds_tag` */

CREATE TABLE `ds_tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_value` varchar(50) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `ds_tag` */

insert  into `ds_tag`(`tag_id`,`tag_value`) values (1,'php');
insert  into `ds_tag`(`tag_id`,`tag_value`) values (2,'c++');
insert  into `ds_tag`(`tag_id`,`tag_value`) values (3,'java');
insert  into `ds_tag`(`tag_id`,`tag_value`) values (5,'Python');

/*Table structure for table `ds_template` */

CREATE TABLE `ds_template` (
  `temp_id` int(11) NOT NULL AUTO_INCREMENT,
  `temp_key` varchar(100) NOT NULL,
  `temp_title` varchar(100) NOT NULL,
  `temp_content` text,
  `temp_desc` varchar(500) NOT NULL,
  PRIMARY KEY (`temp_id`,`temp_key`),
  UNIQUE KEY `email_template_id` (`temp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `ds_template` */

insert  into `ds_template`(`temp_id`,`temp_key`,`temp_title`,`temp_content`,`temp_desc`) values (1,'register_succeed','Welcome to DealSteal','<table style=\"width: 600px;\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\n<tbody>\n<tr>\n<td style=\"text-align: center;\" colspan=\"2\"><img src=\"http://staging.dealsteal.co/images/site/dealsteal.png\" alt=\"\" width=\"200\" /></td>\n</tr>\n<tr>\n<td colspan=\"2\">&nbsp;</td>\n</tr>\n<tr>\n<td style=\"text-align: left;\" colspan=\"2\">\n<p>Dear {{$data[\"client_name\"]}},</p>\n<p>Welcome to Deal Steal!</p>\n</td>\n</tr>\n<tr>\n<td colspan=\"2\">\n<p>&nbsp;</p>\n<p>This is a place to make your dream come ture!</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td style=\"text-align: center;\" width=\"300\">Address: Edinburgh&nbsp;, UK</td>\n<td style=\"text-align: center;\"><br /> Tel: 0723543577 <br /><br /></td>\n</tr>\n</tbody>\n</table>','A notification sent to client when the registration process succeed.');
insert  into `ds_template`(`temp_id`,`temp_key`,`temp_title`,`temp_content`,`temp_desc`) values (2,'customer_password_reset','Your password at DealSteal has been reset!','<table style=\"width: 600px;\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\n<tbody>\n<tr>\n<td style=\"text-align: center;\" colspan=\"2\"><img src=\"http://staging.dealsteal.co/images/site/dealsteal.png\" alt=\"\" width=\"200\" /></td>\n</tr>\n<tr>\n<td colspan=\"2\">&nbsp;</td>\n</tr>\n<tr>\n<td style=\"text-align: left;\" colspan=\"2\">\n<p>Dear {{$data[\"client_name\"]}},</p>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td colspan=\"2\">\n<p>&nbsp;</p>\n<p>You password has been set to {{$data[\"new_password\"]}}</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td style=\"text-align: center;\" width=\"300\"><br /> Address: Edinburgh&nbsp;, UK</td>\n<td style=\"text-align: center;\"><br /> Tel: 0723543577 <br /><br /></td>\n</tr>\n</tbody>\n</table>','A notification sent to client when the password has been reset.');
insert  into `ds_template`(`temp_id`,`temp_key`,`temp_title`,`temp_content`,`temp_desc`) values (3,'payment_successful','Thank you for your payment.','<table style=\"width: 600px;\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\n<tbody>\n<tr>\n<td style=\"text-align: center;\" colspan=\"2\"><img src=\"http://staging.dealsteal.co/images/site/dealsteal.png\" alt=\"\" width=\"200\" /></td>\n</tr>\n<tr>\n<td colspan=\"2\">&nbsp;</td>\n</tr>\n<tr>\n<td style=\"text-align: left;\" colspan=\"2\">\n<p>Dear {{$data[\"client_name\"]}},</p>\n<p>Thanks for your payment</p>\n</td>\n</tr>\n<tr>\n<td colspan=\"2\">\n<p>&nbsp;</p>\n<p>This is a place to make your dream come ture!</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td style=\"text-align: center;\" width=\"300\"><br /> Address: Edinburgh&nbsp;, UK</td>\n<td style=\"text-align: center;\"><br /> Tel: 0723543577 <br /><br /></td>\n</tr>\n</tbody>\n</table>','A notification sent to client when the payment has been processed.');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
