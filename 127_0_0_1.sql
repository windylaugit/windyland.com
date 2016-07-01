-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-07-08 13:07:52
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `windyland`
--

-- --------------------------------------------------------

--
-- 表的结构 `wl_sys_user`
--

CREATE TABLE IF NOT EXISTS `wl_sys_user` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wl_sys_user`
--

INSERT INTO `wl_sys_user` (`u_id`, `user_uic`, `user_type`, `user_name`, `nick_name`, `security`, `sex`, `face`, `add_time`, `modify_time`) VALUES
(1, '', 1, 'admin', '????', '11c6988b5f1bc5fd6f973c15883bd46b', '1', NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
