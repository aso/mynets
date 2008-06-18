ALTER TABLE `c_access_log` ADD `ip_address` varchar(16) NOT NULL DEFAULT '';
ALTER TABLE `c_diary` MODIFY COLUMN public_flag enum('public','friend','private','open') NOT NULL default 'public';
ALTER TABLE `c_member_secure` ADD COLUMN `pc_address_aes` text NOT NULL DEFAULT '';
ALTER TABLE `c_member_secure` ADD COLUMN `ktai_address_aes` text NOT NULL DEFAULT '';
ALTER TABLE `c_member_secure` ADD COLUMN `regist_address_aes` text NOT NULL DEFAULT '';
ALTER TABLE `c_member_secure` ADD COLUMN `easy_access_id_aes` text NOT NULL DEFAULT '';

CREATE TABLE IF NOT EXISTS `c_display_view` (
    `c_display_view_id` int(11) NOT NULL auto_increment,
    `c_display_name` varchar(60) NOT NULL,
    `is_pc` tinyint(1) NOT NULL default '0',
    `is_money_flag` int(11) NOT NULL default '0',
    `template_foldername` text NOT NULL,
    PRIMARY KEY (`c_display_view_id`),
    KEY `is_money_flag` (`is_money_flag`)
) TYPE=MyISAM ;
INSERT INTO `c_display_view` (`c_display_name`,`is_pc`,`is_money_flag`,`template_foldername`) values (
    'ノーマル画面','0','0','') ;
INSERT INTO `c_display_view` (`c_display_name`,`is_pc`,`is_money_flag`,`template_foldername`) values (
    'サムネイル付き画面','0','0','new_templates') ;
INSERT INTO `c_display_view` (`c_display_name`,`is_pc`,`is_money_flag`,`template_foldername`) values (
    'Mixi風画面','1','0','new_templates') ;
INSERT INTO `c_display_view` (`c_display_name`,`is_pc`,`is_money_flag`,`template_foldername`) values (
    '携帯用ライトページ','0','0','light_templates') ;

INSERT INTO `c_admin_config` (`c_admin_config_id`, `name`, `value`) VALUES ( null, 'SKIN_FOLDER', 'default');

CREATE TABLE IF NOT EXISTS `c_tags` (
  `c_tags_id` int(11) NOT NULL auto_increment,
  `c_tags_name` varchar(36) NOT NULL ,
  `c_member_id` int(11) NOT NULL default '0',
  `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (`c_tags_id`),
  KEY `c_tags_name` (`c_tags_name`),
  KEY `c_member_id` (`c_member_id`)
) TYPE=MyISAM AUTO_INCREMENT=1;
INSERT INTO `c_tags` (`c_tags_name`,`c_member_id`) VALUES ('その他','1');
CREATE TABLE IF NOT EXISTS `c_entry_tag` (
  `c_entry_tag_id` int(11) NOT NULL auto_increment,
  `c_entry_id` int(11) NOT NULL default '0',
  `c_entry_flag` tinyint(1) NOT NULL default '0',
  `c_tags_id` int(11) NOT NULL default '0',
  `c_member_id` int(11) NOT NULL default '0',
  `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (`c_entry_tag_id`),
  KEY `c_entry_id` (`c_entry_id`),
  KEY `c_entry_id_flag` (`c_entry_id`,`c_entry_flag`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `c_admin_information` (
    `c_admin_information_id` int(11) NOT NULL auto_increment,
    `subject` text NOT NULL,
    `body` text NOT NULL,
    `category` varchar(64) NOT NULL,
    `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
    `c_view_flag` tinyint(1) NOT NULL default '0',
    `public_flag` tinyint(1) NOT NULL default '0',
    PRIMARY KEY (`c_admin_information_id`),
    KEY `category` (`category`)
) TYPE=MyISAM ;
CREATE TABLE IF NOT EXISTS `c_delete_member_data` (
 `c_delete_member_data_id` int(11) NOT NULL auto_increment,
 `c_member_id` int(11) NOT NULL ,
 `nickname` text NOT NULL,
 `pc_address` text NOT NULL,
 `ktai_address` text NOT NULL,
 `regist_address` text NOT NULL,
 `easy_access_id` text NOT NULL,
 `ip_address` text NOT NULL,
 `user_agent` text NOT NULL,
 `delete_comment` text NOT NULL,
 `delete_flag` tinyint(1) NOT NULL default '0',
 `regist_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
 `delete_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `c_member_id_invite` int(11) NOT NULL,
 PRIMARY KEY  (`c_delete_member_data_id`),
 KEY `ktai_address` (`ktai_address`(100)),
 KEY `pc_address` (`pc_address`(100)),
 KEY `regist_address` (`regist_address`(100)),
 KEY `easy_access_id` (`easy_access_id`(50)),
 KEY `delete_datetime` (`delete_datetime`),
 KEY `regist_datetime` (`regist_datetime`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `c_diary_tag`;

CREATE TABLE IF NOT EXISTS `c_version` (
 c_version_id int(11) NOT NULL auto_increment,
 old_version_name text NOT NULL ,
 new_version_name text NOT NULL ,
 r_datetime datetime NOT NULL default '0000-00-00 00:00:00',
 PRIMARY KEY (`c_version_id`)
) TYPE=MyISAM;

ALTER TABLE `c_commu_topic` ADD COLUMN `e_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00';
ALTER TABLE `c_commu_topic` ADD INDEX `e_datetime` (`e_datetime`);
CREATE TABLE IF NOT EXISTS `c_inquiry` (
    `c_inquiry_id` int(11) NOT NULL auto_increment,
    `c_member_id` int(11) NOT NULL ,
    `category_flag` tinyint NOT NULL default '0',
    `body` text NOT NULL,
    `data_id` int(11) NOT NULL default '0',
    `data_flag` int(2) NOT NULL default '0',
    `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
    PRIMARY KEY  (`c_inquiry_id`),
    KEY `c_member_id_r_datetime` (`c_member_id`,`r_datetime`),
    KEY `category_flag` (`category_flag`)
) TYPE=MyISAM;

ALTER TABLE `c_image` ADD INDEX `r_datetime` (`r_datetime`);
