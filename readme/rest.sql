-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 03 月 20 日 20:10
-- 服务器版本: 5.1.58-log
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `rest`
--

-- --------------------------------------------------------

--
-- 表的结构 `yxz_company`
--

CREATE TABLE IF NOT EXISTS `yxz_company` (
  `company_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` text NOT NULL,
  `company_type` int(11) NOT NULL,
  `company_address` text,
  `company_phone` text,
  `company_status` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  `last_update_date` int(11) NOT NULL,
  `last_update_uid` int(11) NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yxz_file`
--

CREATE TABLE IF NOT EXISTS `yxz_file` (
  `file_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `path` text NOT NULL,
  `folder_id` int(11) DEFAULT NULL,
  `owner_uid` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  `update_date` int(11) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `create_uid` int(11) DEFAULT NULL,
  `create_uname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yxz_folder`
--

CREATE TABLE IF NOT EXISTS `yxz_folder` (
  `folder_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `folder_name` varchar(255) NOT NULL,
  `partent_id` int(11) NOT NULL,
  `path` text NOT NULL,
  PRIMARY KEY (`folder_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yxz_group`
--

CREATE TABLE IF NOT EXISTS `yxz_group` (
  `group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `group_desc` text NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yxz_order`
--

CREATE TABLE IF NOT EXISTS `yxz_order` (
  `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_status` varchar(255) NOT NULL,
  `order_date` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yxz_preference`
--

CREATE TABLE IF NOT EXISTS `yxz_preference` (
  `pref_key` varchar(255) NOT NULL,
  `pref_value` varchar(255) NOT NULL,
  PRIMARY KEY (`pref_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yxz_share`
--

CREATE TABLE IF NOT EXISTS `yxz_share` (
  `share_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(11) DEFAULT NULL,
  `folder_id` int(11) DEFAULT NULL,
  `share_type` int(11) NOT NULL,
  `owner_uid` int(11) NOT NULL,
  `permission` int(11) NOT NULL,
  `share_date` int(11) NOT NULL,
  `expiration` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `download_date` int(11) DEFAULT NULL,
  `download_nums` int(11) DEFAULT NULL,
  `share_link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`share_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yxz_share_to_group`
--

CREATE TABLE IF NOT EXISTS `yxz_share_to_group` (
  `share_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`share_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yxz_share_to_user`
--

CREATE TABLE IF NOT EXISTS `yxz_share_to_user` (
  `share_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`share_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yxz_user`
--

CREATE TABLE IF NOT EXISTS `yxz_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_salt` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `yxz_user`
--

INSERT INTO `yxz_user` (`user_id`, `user_name`, `user_type`, `email`, `password`, `password_salt`, `group_id`) VALUES
(1, 'admin', 1, 'ljzxzxl@gmail.com', '123456', '123456', 1),
(2, 'aaa', 2, 'test@gmail.com', '123456', '1', 1),
(3, 'bbb', 3, 'test@gmail.com', '123456', '1', 1),
(4, 'ccc', 4, 'test@gmail.com', '123456', '1', 1),
(5, 'ddd', 5, 'test@gmail.com', '123456', '1', 1),
(6, 'eee', 6, 'test@gmail.com', '123456', '1', 1);

-- --------------------------------------------------------

--
-- 表的结构 `yxz_workspace`
--

CREATE TABLE IF NOT EXISTS `yxz_workspace` (
  `workspace_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `workspace_name` varchar(255) NOT NULL,
  `workspace_desc` text NOT NULL,
  PRIMARY KEY (`workspace_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yxz_workspace_permission`
--

CREATE TABLE IF NOT EXISTS `yxz_workspace_permission` (
  `permission_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `workspace_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_permission` enum('true','false') DEFAULT 'true',
  `delete_permission` enum('true','false') DEFAULT 'true',
  `read_permission` enum('true','false') DEFAULT 'true',
  `share_permission` enum('true','false') DEFAULT 'true',
  PRIMARY KEY (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
