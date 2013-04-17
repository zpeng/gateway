/*
SQLyog Enterprise - MySQL GUI v6.5
MySQL - 5.0.51b-community-nt-log : Database - rose_shoppingcart
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `tb_address` */

CREATE TABLE `tb_address` (
  `customer_id` int(11) NOT NULL,
  `address_type` varchar(10) NOT NULL,
  `recipients` varchar(100) NOT NULL default '',
  `street` varchar(200) NOT NULL default '',
  `city` varchar(50) NOT NULL default '',
  `postcode` varchar(50) NOT NULL default '',
  `state` varchar(50) default NULL,
  `country` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`customer_id`,`address_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tb_address` */

insert  into `tb_address`(`customer_id`,`address_type`,`recipients`,`street`,`city`,`postcode`,`state`,`country`) values (1,'billing','Ziyang Peng','Cannochy House,North Street','St Andrews','E198 56','Fife','UK'),(1,'delivery','Ziyang Peng','Cannochy House,North Street','St Andrews','E198 56','Fife','UK');

/*Table structure for table `tb_administrator` */

CREATE TABLE `tb_administrator` (
  `admin_id` int(11) NOT NULL auto_increment,
  `admin_name` varchar(50) NOT NULL default '',
  `admin_password` varchar(50) NOT NULL default '',
  `admin_archived` char(1) NOT NULL default 'Y',
  PRIMARY KEY  (`admin_id`,`admin_name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tb_administrator` */

insert  into `tb_administrator`(`admin_id`,`admin_name`,`admin_password`,`admin_archived`) values (1,'pengziyang@gmail.com','ae38f3e59310c930f2f9ebcfc9497499','N');

/*Table structure for table `tb_attribute` */

CREATE TABLE `tb_attribute` (
  `attribute_id` int(11) NOT NULL auto_increment,
  `attribute_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`attribute_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tb_attribute` */

insert  into `tb_attribute`(`attribute_id`,`attribute_name`) values (1,'Color');

/*Table structure for table `tb_attribute_value` */

CREATE TABLE `tb_attribute_value` (
  `attribute_value_id` int(11) NOT NULL auto_increment,
  `attribute_id` int(11) NOT NULL,
  `attribute_value` varchar(50) NOT NULL,
  PRIMARY KEY  (`attribute_value_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `tb_attribute_value` */

insert  into `tb_attribute_value`(`attribute_value_id`,`attribute_id`,`attribute_value`) values (1,1,'Amber'),(2,1,'Blue'),(3,1,'Green'),(4,1,'Red'),(5,1,'RGB'),(6,1,'White');

/*Table structure for table `tb_category` */

CREATE TABLE `tb_category` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  `category_description` varchar(500) default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tb_category` */

/*Table structure for table `tb_configuration` */

CREATE TABLE `tb_configuration` (
  `configuration_id` int(11) NOT NULL auto_increment,
  `configuration_group_id` int(11) NOT NULL default '0',
  `configuration_title` varchar(64) NOT NULL default '',
  `configuration_key` varchar(64) NOT NULL default '',
  `configuration_value` varchar(255) NOT NULL default '',
  `configuration_description` varchar(255) NOT NULL default '',
  `configuration_datatype` varchar(10) NOT NULL,
  PRIMARY KEY  (`configuration_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `tb_configuration` */

insert  into `tb_configuration`(`configuration_id`,`configuration_group_id`,`configuration_title`,`configuration_key`,`configuration_value`,`configuration_description`,`configuration_datatype`) values (1,1,'Shop Name','shop_name','ROSE VOIP','Name of the shop','string'),(2,1,'Owner Name','owner_name','Ziyang Peng','Owner of the shop','string'),(3,1,'Meta Keywords','meta_keywords','ROSE VOIP','META keywords for SEO','text'),(4,1,'Meta Description','meta_description','ROSE VOIP','META Descriptions for SEO','text'),(5,2,'Admin Email','admin_email','pengziyang@gmail.com','Administractor Email Address','string'),(6,2,'Email Host','email_host','mail.mydreamland.co.uk','Host Address for email','string'),(7,3,'Currency Name','currency_Name','GBP','Currency Name','string'),(8,3,'Currency Sign','currency_sign','£','Currency Sign','string'),(9,3,'Product Image Path','product_image_path','images/products/','Product Image Path','string'),(10,3,'Show Banner','show_banner','Y','Whether display the banner (Y - Yes, N - No)','boolean'),(11,3,'No. of item display on index page','num_item_on_index_page','8','The number of products will be displayed on the index page','number'),(12,3,'Show Product Review','show_review','Y','Whether display the Product review (Y - Yes, N - No)','boolean'),(13,2,'Email Server Port','email_port','2626','Email Server Port','string'),(14,2,'Email User Account','email_user','test+mydreamland.co.uk','Email Server User Account','string'),(15,2,'Email User Password','email_password','19840617','Email Server User Account Password','string'),(16,2,'Email Send From','email_sender','test@mydreamland.co.uk','Email Account that sends email','string'),(17,1,'Domain','domain_name','http://localhost:2048/rose_voip','Domain Name','string'),(18,3,'Stock Level Warning ','stock_level_warning','5','Stock level warning','number');

/*Table structure for table `tb_configuration_group` */

CREATE TABLE `tb_configuration_group` (
  `configuration_group_id` int(11) NOT NULL auto_increment,
  `configuration_group_title` varchar(64) NOT NULL default '',
  `configuration_group_description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`configuration_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tb_configuration_group` */

insert  into `tb_configuration_group`(`configuration_group_id`,`configuration_group_title`,`configuration_group_description`) values (1,'E-Shop Config','Configuration of the e-shop'),(2,'Communication','Configuration for emails'),(3,'General Config','');

/*Table structure for table `tb_content` */

CREATE TABLE `tb_content` (
  `content_id` int(11) NOT NULL auto_increment,
  `content_author_id` int(11) NOT NULL,
  `content_archived` char(1) NOT NULL default 'Y',
  PRIMARY KEY  (`content_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_content` */

insert  into `tb_content`(`content_id`,`content_author_id`,`content_archived`) values (1,1,'N'),(2,1,'N');

/*Table structure for table `tb_content_description` */

CREATE TABLE `tb_content_description` (
  `content_description_id` int(11) NOT NULL auto_increment,
  `content_id` int(11) NOT NULL,
  `content_language_id` int(11) NOT NULL,
  `content_title` varchar(100) character set utf8 collate utf8_unicode_ci default NULL,
  `content_abstract` varchar(500) character set utf8 collate utf8_unicode_ci default NULL,
  `content_article` text character set utf8 collate utf8_unicode_ci,
  `content_create_date` datetime default NULL,
  `content_last_modify_by` int(11) default NULL,
  `content_last_modify_date` datetime default NULL,
  `content_description_archived` char(1) default 'Y',
  PRIMARY KEY  (`content_description_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_content_description` */

insert  into `tb_content_description`(`content_description_id`,`content_id`,`content_language_id`,`content_title`,`content_abstract`,`content_article`,`content_create_date`,`content_last_modify_by`,`content_last_modify_date`,`content_description_archived`) values (1,1,1,'Delivery Policy','Delivery Policy','','2010-08-13 20:59:17',1,'2010-08-13 20:59:17','N'),(2,2,1,'Contact Us','Contact Us','<p>&nbsp;Contact Us</p>','2010-09-13 16:46:27',1,'2010-09-13 16:47:46','N');

/*Table structure for table `tb_customer` */

CREATE TABLE `tb_customer` (
  `customer_id` int(11) NOT NULL auto_increment,
  `customer_password` varchar(50) NOT NULL default '',
  `customer_email` varchar(100) NOT NULL default '',
  `customer_firstname` varchar(50) NOT NULL default '',
  `customer_lastname` varchar(50) NOT NULL default '',
  `customer_telephone` varchar(50) default '',
  `customer_mobile` varchar(50) default NULL,
  `customer_newsletter` char(1) default 'Y',
  `customer_last_edit` timestamp NOT NULL default '0000-00-00 00:00:00',
  `customer_last_visit` timestamp NOT NULL default '0000-00-00 00:00:00',
  `customer_register_date` datetime NOT NULL,
  `customer_archived` char(1) NOT NULL default 'Y',
  PRIMARY KEY  (`customer_id`,`customer_email`),
  UNIQUE KEY `customer_email` (`customer_email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tb_customer` */

insert  into `tb_customer`(`customer_id`,`customer_password`,`customer_email`,`customer_firstname`,`customer_lastname`,`customer_telephone`,`customer_mobile`,`customer_newsletter`,`customer_last_edit`,`customer_last_visit`,`customer_register_date`,`customer_archived`) values (1,'ae38f3e59310c930f2f9ebcfc9497499','pengziyang@gmail.com','Ziyang','Peng','1234567890','1234567890','Y','2011-01-01 16:22:06','2010-09-11 14:56:07','2010-09-11 14:56:07','N');

/*Table structure for table `tb_email_tag` */

CREATE TABLE `tb_email_tag` (
  `email_tag_id` int(11) NOT NULL auto_increment,
  `email_tag_group_id` int(11) NOT NULL,
  `email_tag_name` varchar(200) NOT NULL,
  `email_tag` varchar(200) NOT NULL,
  `email_tag_descirption` varchar(300) default NULL,
  PRIMARY KEY  (`email_tag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tb_email_tag` */

insert  into `tb_email_tag`(`email_tag_id`,`email_tag_group_id`,`email_tag_name`,`email_tag`,`email_tag_descirption`) values (1,1,'Customer ID','{{$customer++get_customer_id()}}','Return customer id'),(2,1,'Customer Fullname','{{$customer++get_full_name()}}','Return customer fullname'),(3,2,'Product ID','{{$product++get_product_id()}}','Return product ID'),(4,4,'New Password','{{$new_password}}','Return newly generated password'),(5,3,'Order Code','{{$order++get_order_code()}}','Return order code');

/*Table structure for table `tb_email_tag_group` */

CREATE TABLE `tb_email_tag_group` (
  `email_tag_group_id` int(11) NOT NULL auto_increment,
  `email_tag_group` varchar(100) NOT NULL,
  PRIMARY KEY  (`email_tag_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tb_email_tag_group` */

insert  into `tb_email_tag_group`(`email_tag_group_id`,`email_tag_group`) values (1,'Customer Tag'),(2,'Product Tag'),(3,'Order'),(4,'Misc');

/*Table structure for table `tb_email_tamplate_to_tag_group` */

CREATE TABLE `tb_email_tamplate_to_tag_group` (
  `email_template_id` int(11) NOT NULL,
  `email_tag_group_id` int(11) NOT NULL,
  PRIMARY KEY  (`email_template_id`,`email_tag_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tb_email_tamplate_to_tag_group` */

insert  into `tb_email_tamplate_to_tag_group`(`email_template_id`,`email_tag_group_id`) values (1,1),(2,1),(3,1),(3,3);

/*Table structure for table `tb_email_template` */

CREATE TABLE `tb_email_template` (
  `email_template_id` int(11) NOT NULL auto_increment,
  `email_template_key` varchar(100) NOT NULL,
  `email_template_title` varchar(100) NOT NULL,
  `email_template` text,
  `email_template_comment` varchar(500) NOT NULL,
  PRIMARY KEY  (`email_template_id`,`email_template_key`),
  UNIQUE KEY `email_template_id` (`email_template_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tb_email_template` */

insert  into `tb_email_template`(`email_template_id`,`email_template_key`,`email_template_title`,`email_template`,`email_template_comment`) values (1,'register_succeed','Welcome to LightZone!','<table width=\"600\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\r\n    <tbody>\r\n        <tr>\r\n            <td style=\"text-align: center; \" colspan=\"2\"><img width=\"200\" height=\"80\" alt=\"\" src=\"http://www.shoppingcart.rosetelecom.co.uk/images/site/logo.png\" /></td>\r\n        </tr>\r\n        <tr height=\"30\">\r\n            <td colspan=\"2\">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td style=\"text-align: left; \" colspan=\"2\">\r\n            <p>Dear&nbsp;{{$customer++get_full_name()}} ,</p>\r\n            <p>Welcome to LightZone!</p>\r\n            </td>\r\n        </tr>\r\n        <tr height=\"30\">\r\n            <td colspan=\"2\">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td style=\"text-align: center;\" width=\"300\"><br />\r\n            Address: TopConstruct - Militari Stand F9             <br />\r\n            Str. Valea Cascadelor Nr.23             <br />\r\n            Buscuresti             <br />\r\n            Romania</td>\r\n            <td style=\"text-align: center; \"><br />\r\n            Tel: 0723543577              <br />\r\n            &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;0722736677              <br />\r\n            Fax: 021-224-0568</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p>&nbsp;</p>','A notification sent to client when the registration process succeed.'),(2,'customer_password_reset','Your password at Rose VOIP has been reset!','<table width=\\\"600\\\" border=\\\"0\\\" cellpadding=\\\"1\\\" cellspacing=\\\"1\\\">\r\n    <tbody>\r\n        <tr>\r\n            <td style=\\\"text-align: center; \\\" colspan=\\\"2\\\"><img width=\\\"200\\\" height=\\\"80\\\" alt=\\\"\\\" src=\\\"http://www.shoppingcart.rosetelecom.co.uk/images/site/logo.png\\\" /></td>\r\n        </tr>\r\n        <tr height=\\\"30\\\">\r\n            <td colspan=\\\"2\\\">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td style=\\\"text-align: left; \\\" colspan=\\\"2\\\">\r\n            <p>Dear &nbsp;{{$customer++get_full_name()}}</p>\r\n            <p>You new password has been reset to&nbsp;<b>{{$new_password}} </b>.</p>\r\n            <p>Thank you. &nbsp;</p>\r\n            </td>\r\n        </tr>\r\n        <tr height=\\\"30\\\">\r\n            <td colspan=\\\"2\\\">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td style=\\\"text-align: center;\\\" width=\\\"300\\\"><br />\r\n            Address: TopConstruct - Militari Stand F9             <br />\r\n            Str. Valea Cascadelor Nr.23             <br />\r\n            Buscuresti             <br />\r\n            Romania</td>\r\n            <td style=\\\"text-align: center; \\\"><br />\r\n            Tel: 0723543577              <br />\r\n            &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;0722736677              <br />\r\n            Fax: 021-224-0568</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p>&nbsp;</p>','A notification sent to client when the password has been reset.'),(3,'payment_successful','Thank you for your payment.','<table width=\\\"600\\\" border=\\\"0\\\" cellpadding=\\\"1\\\" cellspacing=\\\"1\\\">\r\n    <tbody>\r\n        <tr>\r\n            <td style=\\\"text-align: center; \\\" colspan=\\\"2\\\"><img width=\\\"200\\\" height=\\\"80\\\" alt=\\\"\\\" src=\\\"http://www.shoppingcart.rosetelecom.co.uk/images/site/logo.png\\\" /></td>\r\n        </tr>\r\n        <tr height=\\\"30\\\">\r\n            <td colspan=\\\"2\\\">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td style=\\\"text-align: left; \\\" colspan=\\\"2\\\">\r\n            <p>Dear&nbsp;{{$customer++get_full_name()}} ,</p>\r\n            <p>Thank you for your payment. Your transaction has been completed.&nbsp;</p>\r\n            <p>Please use this code <b>{{$order++get_order_code()}}</b>&nbsp;to track your order.&nbsp;</p>\r\n            <p>Thank you very much!</p>\r\n            </td>\r\n        </tr>\r\n        <tr height=\\\"30\\\">\r\n            <td colspan=\\\"2\\\">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td style=\\\"text-align: center;\\\" width=\\\"300\\\"><br />\r\n            Address: TopConstruct - Militari Stand F9             <br />\r\n            Str. Valea Cascadelor Nr.23             <br />\r\n            Buscuresti             <br />\r\n            Romania</td>\r\n            <td style=\\\"text-align: center; \\\"><br />\r\n            Tel: 0723543577              <br />\r\n            &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;0722736677              <br />\r\n            Fax: 021-224-0568</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p>&nbsp;</p>','A notification sent to client when the payment has been processed.');

/*Table structure for table `tb_language` */

CREATE TABLE `tb_language` (
  `language_id` int(11) NOT NULL auto_increment,
  `language_name` varchar(30) default NULL,
  `language_initial` varchar(10) default NULL,
  `language_icon` varchar(100) default NULL,
  `language_archived` varchar(1) default 'Y',
  PRIMARY KEY  (`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tb_language` */

insert  into `tb_language`(`language_id`,`language_name`,`language_initial`,`language_icon`,`language_archived`) values (1,'English','en','en.png','N');

/*Table structure for table `tb_language_default` */

CREATE TABLE `tb_language_default` (
  `language_default_id` int(11) NOT NULL auto_increment,
  `language_default_name` varchar(30) default NULL,
  `language_default_initial` varchar(10) default NULL,
  `language_default_icon` varchar(100) default NULL,
  `language_default_archived` varchar(1) default 'Y',
  PRIMARY KEY  (`language_default_id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

/*Data for the table `tb_language_default` */

insert  into `tb_language_default`(`language_default_id`,`language_default_name`,`language_default_initial`,`language_default_icon`,`language_default_archived`) values (1,'English','en','en.png','N'),(2,'français','fr','fr.png','N'),(3,'简体中文','zh-hans','zh-hans.png','N'),(4,'繁體中文','zh-hant','zh-hant.png','N'),(5,'Deutsch','de','de.png','N'),(6,'Español','es','es.png','N'),(7,'Italiano','it','it.png','N'),(8,'العربية','ar','ar.png','N'),(9,'','bg','bg.png','N'),(10,'','ca','ca.png','N'),(11,'','cs','cs.png','N'),(12,'','da','da.png','N'),(13,'','el','el.png','N'),(14,'','eo','eo.png','N'),(15,'','et','et.png','N'),(16,'','eu','eu.png','N'),(17,'','fa','fa.png','N'),(18,'','fi','fi.png','N'),(19,'','fo','fo.png','N'),(20,'','ga','ga.png','N'),(21,'','gl','gl.png','N'),(22,'','he','he.png','N'),(23,'','hr','hr.png','N'),(24,'','hu','hu.png','N'),(25,'','id','id.png','N'),(26,'','is','is.png','N'),(27,'','ja','ja.png','N'),(28,'','km','km.png','N'),(29,'','lb','lb.png','N'),(30,'','lt','lt.png','N'),(31,'','lv','lv.png','N'),(32,'','nb','nb.png','N'),(33,'','nl','nl.png','N'),(34,'','nn','nn.png','N'),(35,'','pl','pl.png','N'),(36,'','pt-br','pt-br.png','N'),(37,'','pt-pt','pt-pt.png','N'),(38,'','ro','ro.png','N'),(39,'','ru','ru.png','N'),(40,'','sco','sco.png','N'),(41,'','sk','sk.png','N'),(42,'','sl','sl.png','N'),(43,'','sv','sv.png','N'),(44,'','tg','tg.png','N'),(45,'','th','th.png','N'),(46,'','tl','tl.png','N'),(47,'','tr','tr.png','N'),(48,'','uk','uk.png','N'),(49,'','vi','vi.png','N');

/*Table structure for table `tb_manufacturer` */

CREATE TABLE `tb_manufacturer` (
  `manufacturer_id` int(11) NOT NULL auto_increment,
  `manufacturer_name` varchar(50) NOT NULL default '',
  `manufacturer_desc` text,
  `manufacturer_image` varchar(100) default NULL,
  `manufacturer_url` varchar(255) default NULL,
  `manufacturer_archived` char(1) NOT NULL default 'Y',
  PRIMARY KEY  (`manufacturer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tb_manufacturer` */

/*Table structure for table `tb_menu` */

CREATE TABLE `tb_menu` (
  `menu_id` int(11) NOT NULL auto_increment,
  `menu_parent_id` int(11) NOT NULL default '0',
  `menu_type_id` int(11) NOT NULL,
  `menu_order` int(11) NOT NULL default '1',
  `menu_link` text,
  `menu_archived` char(1) NOT NULL default 'N',
  PRIMARY KEY  (`menu_id`),
  KEY `menu_type_id` (`menu_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tb_menu` */

insert  into `tb_menu`(`menu_id`,`menu_parent_id`,`menu_type_id`,`menu_order`,`menu_link`,`menu_archived`) values (1,0,1,1,'index.php','N'),(2,0,1,2,'index.php?view=product_onsale','N'),(3,0,1,3,'customer.php?view=order_history','N'),(4,0,1,4,'index.php?content_id=1&view=content&title=Delivery-Policy','N'),(5,0,1,5,'index.php?content_id=2&view=content&title=Contact-Us','N');

/*Table structure for table `tb_menu_description` */

CREATE TABLE `tb_menu_description` (
  `menu_description_id` int(11) NOT NULL auto_increment,
  `menu_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `menu_description_archived` char(1) NOT NULL default 'Y',
  PRIMARY KEY  (`menu_description_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tb_menu_description` */

insert  into `tb_menu_description`(`menu_description_id`,`menu_id`,`language_id`,`menu_name`,`menu_description_archived`) values (1,1,1,'Home Page','N'),(2,2,1,'Onsale','N'),(3,3,1,'My Account','N'),(4,4,1,'Delivery Policy','N'),(5,5,1,'Contact Us','N');

/*Table structure for table `tb_menu_type` */

CREATE TABLE `tb_menu_type` (
  `menu_type_id` int(11) NOT NULL auto_increment,
  `menu_type_name` varchar(50) NOT NULL,
  `menu_type_description` varchar(200) default NULL,
  `menu_type_archived` char(1) NOT NULL,
  PRIMARY KEY  (`menu_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_menu_type` */

insert  into `tb_menu_type`(`menu_type_id`,`menu_type_name`,`menu_type_description`,`menu_type_archived`) values (1,'Primary Menu','Primary Menu','N'),(2,'Secondary Menu','Secondary Menu','N');

/*Table structure for table `tb_order` */

CREATE TABLE `tb_order` (
  `order_id` int(11) NOT NULL auto_increment,
  `order_code` varchar(30) NOT NULL default '',
  `order_create_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `order_status_id` int(11) NOT NULL default '0',
  `payment_status_id` int(11) NOT NULL,
  `payment_method_id` int(11) default NULL,
  `order_total_amount` decimal(10,2) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `shipping_cost` decimal(10,2) default NULL,
  `shipping_date` date default NULL,
  `customer_id` int(11) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `order_shipping_address` text,
  `order_customer_comment` text,
  `order_administrator_comment` text,
  PRIMARY KEY  (`order_id`),
  UNIQUE KEY `order_code` (`order_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tb_order` */

/*Table structure for table `tb_order_product` */

CREATE TABLE `tb_order_product` (
  `order_product_id` int(11) NOT NULL auto_increment,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`order_product_id`,`order_id`,`product_id`),
  UNIQUE KEY `order_product_id` (`order_product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tb_order_product` */

/*Table structure for table `tb_payment_method` */

CREATE TABLE `tb_payment_method` (
  `payment_method_id` int(11) NOT NULL auto_increment,
  `payment_method_name` varchar(200) NOT NULL,
  `payment_method_include_path` varchar(255) NOT NULL,
  `payment_method_logo` varchar(255) default NULL,
  `payment_method_desc` text,
  PRIMARY KEY  (`payment_method_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tb_payment_method` */

insert  into `tb_payment_method`(`payment_method_id`,`payment_method_name`,`payment_method_include_path`,`payment_method_logo`,`payment_method_desc`) values (1,'Paypal','/included/payment/paypal/paypal_local_test.php','1280476135.gif','');

/*Table structure for table `tb_product` */

CREATE TABLE `tb_product` (
  `product_id` int(11) unsigned zerofill NOT NULL auto_increment,
  `manufacturer_id` int(11) NOT NULL,
  `product_sku` varchar(255) NOT NULL COMMENT 'Stock-keeping unit ',
  `product_weigth` decimal(10,3) NOT NULL default '0.000',
  `product_cost` decimal(10,2) NOT NULL default '0.00',
  `product_price` decimal(10,2) NOT NULL default '0.00',
  `product_onsale` char(1) NOT NULL default 'N',
  `product_price_presale` decimal(10,2) default '0.00',
  `product_url` varchar(255) default NULL,
  `product_date_added` date NOT NULL,
  `product_date_available` date NOT NULL,
  `product_stock_level` int(11) NOT NULL default '0',
  `product_viewed_count` int(11) NOT NULL default '0',
  `product_ordered_count` int(11) NOT NULL default '0',
  `product_archived` varchar(1) NOT NULL default 'N',
  PRIMARY KEY  (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tb_product` */

/*Table structure for table `tb_product_description` */

CREATE TABLE `tb_product_description` (
  `product_description_id` int(11) NOT NULL auto_increment,
  `product_id` int(11) unsigned zerofill NOT NULL,
  `language_id` int(11) NOT NULL default '1',
  `product_name` varchar(100) NOT NULL default '',
  `product_description` text,
  PRIMARY KEY  (`product_description_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tb_product_description` */

/*Table structure for table `tb_product_image` */

CREATE TABLE `tb_product_image` (
  `product_image_id` int(11) NOT NULL auto_increment,
  `product_id` int(11) NOT NULL,
  `product_image_url` varchar(200) NOT NULL,
  `product_image_default` char(1) NOT NULL default 'N',
  PRIMARY KEY  (`product_image_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tb_product_image` */

/*Table structure for table `tb_product_to_attribute_value` */

CREATE TABLE `tb_product_to_attribute_value` (
  `product_id` int(11) unsigned zerofill NOT NULL,
  `attribute_value_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tb_product_to_attribute_value` */

/*Table structure for table `tb_product_to_category` */

CREATE TABLE `tb_product_to_category` (
  `product_id` int(11) unsigned zerofill NOT NULL default '00000000000',
  `id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`product_id`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tb_product_to_category` */

/*Table structure for table `tb_review` */

CREATE TABLE `tb_review` (
  `review_id` int(11) NOT NULL auto_increment,
  `customer_id` int(11) NOT NULL,
  `product_id` int(10) unsigned zerofill NOT NULL,
  `review_rate` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `review_date` datetime NOT NULL,
  PRIMARY KEY  (`customer_id`,`product_id`),
  UNIQUE KEY `review_id` (`review_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tb_review` */

/*Table structure for table `tb_shipping` */

CREATE TABLE `tb_shipping` (
  `shipping_id` int(11) NOT NULL auto_increment,
  `shipping_region_id` int(11) NOT NULL,
  `shipping_type` varchar(100) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `shipping_details` text,
  PRIMARY KEY  (`shipping_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_shipping` */

insert  into `tb_shipping`(`shipping_id`,`shipping_region_id`,`shipping_type`,`shipping_cost`,`shipping_details`) values (1,2,'Digital Transfer','0.00','Digital Transfer'),(2,2,'Express','0.19','Goods send out in 3 days.');

/*Table structure for table `tb_shipping_region` */

CREATE TABLE `tb_shipping_region` (
  `shipping_region_id` int(11) NOT NULL auto_increment,
  `shipping_region` varchar(100) NOT NULL,
  PRIMARY KEY  (`shipping_region_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tb_shipping_region` */

insert  into `tb_shipping_region`(`shipping_region_id`,`shipping_region`) values (1,'Local'),(2,'Worldwide');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
