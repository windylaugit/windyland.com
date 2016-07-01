#
# TABLE STRUCTURE FOR: wl_column
#

DROP TABLE IF EXISTS `wl_column`;

CREATE TABLE `wl_column` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `c_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `alias` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `ctype_id` int(10) unsigned NOT NULL DEFAULT '1',
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `if_show` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=gbk;

INSERT INTO `wl_column` (`c_id`, `c_name`, `alias`, `parent_id`, `ctype_id`, `sort_order`, `if_show`) VALUES ('2', '编程技术', 'programe', '0', '1', '1', '1');
INSERT INTO `wl_column` (`c_id`, `c_name`, `alias`, `parent_id`, `ctype_id`, `sort_order`, `if_show`) VALUES ('5', '编程栏目A', '', '2', '1', '255', '1');
INSERT INTO `wl_column` (`c_id`, `c_name`, `alias`, `parent_id`, `ctype_id`, `sort_order`, `if_show`) VALUES ('6', '编程栏目B', 'programb', '2', '1', '2', '1');
INSERT INTO `wl_column` (`c_id`, `c_name`, `alias`, `parent_id`, `ctype_id`, `sort_order`, `if_show`) VALUES ('7', '编程栏目C', '', '2', '1', '255', '1');
INSERT INTO `wl_column` (`c_id`, `c_name`, `alias`, `parent_id`, `ctype_id`, `sort_order`, `if_show`) VALUES ('8', '应用平台', 'webapp', '0', '2', '5', '1');
INSERT INTO `wl_column` (`c_id`, `c_name`, `alias`, `parent_id`, `ctype_id`, `sort_order`, `if_show`) VALUES ('10', '下载中心', 'download', '0', '1', '8', '1');


#
# TABLE STRUCTURE FOR: wl_content
#

DROP TABLE IF EXISTS `wl_content`;

CREATE TABLE `wl_content` (
  `cont_id` int(10) NOT NULL AUTO_INCREMENT,
  `type_id` smallint(4) NOT NULL DEFAULT '0',
  `user_id` int(10) NOT NULL,
  `c_id` int(10) NOT NULL COMMENT '所属栏目ID',
  `author` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(150) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `post_time` int(10) NOT NULL COMMENT '发布时间',
  `modify_time` int(10) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`cont_id`),
  KEY `k_title` (`title`),
  KEY `k_keywords` (`keywords`),
  FULLTEXT KEY `k_desc` (`description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: wl_content_article
#

DROP TABLE IF EXISTS `wl_content_article`;

CREATE TABLE `wl_content_article` (
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `cont_id` int(10) NOT NULL,
  `thumb_url` varchar(150) DEFAULT '',
  `content` text NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: wl_content_type
#

DROP TABLE IF EXISTS `wl_content_type`;

CREATE TABLE `wl_content_type` (
  `ctype_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `ctype_name` varchar(50) NOT NULL DEFAULT '',
  `column_app` varchar(50) NOT NULL COMMENT '该类型栏目页控制器',
  `content_app` varchar(50) NOT NULL COMMENT '该类型内容页控制器',
  PRIMARY KEY (`ctype_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

INSERT INTO `wl_content_type` (`ctype_id`, `ctype_name`, `column_app`, `content_app`) VALUES ('1', '文章类型', '', '');
INSERT INTO `wl_content_type` (`ctype_id`, `ctype_name`, `column_app`, `content_app`) VALUES ('2', '图片类型', '', '');


#
# TABLE STRUCTURE FOR: wl_sys_user
#

DROP TABLE IF EXISTS `wl_sys_user`;

CREATE TABLE `wl_sys_user` (
  `u_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user_uic` varchar(50) NOT NULL COMMENT '用户唯一标识码',
  `user_type` tinyint(3) NOT NULL DEFAULT '1' COMMENT '用户类型：1:学生,2:教师,3:有经验的人',
  `user_name` varchar(50) NOT NULL COMMENT '用户名',
  `nick_name` varchar(100) DEFAULT NULL COMMENT '用户昵称',
  `security` varchar(50) NOT NULL COMMENT '用户密码',
  `sex` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '性别 0=>保密,1=>男,2=>女',
  `face` text COMMENT '用户头像的图片地址',
  `add_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `modify_time` int(11) DEFAULT NULL COMMENT '最近一次修改时间',
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_uic` (`user_uic`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `wl_sys_user` (`u_id`, `user_uic`, `user_type`, `user_name`, `nick_name`, `security`, `sex`, `face`, `add_time`, `modify_time`) VALUES ('1', '', '1', 'admin', '????', '11c6988b5f1bc5fd6f973c15883bd46b', '1', NULL, NULL, NULL);


