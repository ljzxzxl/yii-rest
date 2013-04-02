-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 04 月 02 日 19:36
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
-- 表的结构 `yxz_auth_assignment`
--

CREATE TABLE IF NOT EXISTS `yxz_auth_assignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yxz_auth_item`
--

CREATE TABLE IF NOT EXISTS `yxz_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yxz_auth_item_child`
--

CREATE TABLE IF NOT EXISTS `yxz_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yxz_company`
--

CREATE TABLE IF NOT EXISTS `yxz_company` (
  `company_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL COMMENT '公司名称',
  `company_type` int(11) NOT NULL COMMENT '公司类型',
  `company_address` varchar(255) DEFAULT NULL COMMENT '公司地址',
  `company_phone` varchar(50) DEFAULT NULL COMMENT '公司电话',
  `company_status` int(11) DEFAULT NULL COMMENT '公司状态',
  `create_date` int(11) NOT NULL COMMENT '创建时间',
  `last_update_date` int(11) NOT NULL COMMENT '最后更新时间',
  `last_update_uid` int(11) NOT NULL COMMENT '最后更新用户',
  PRIMARY KEY (`company_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `yxz_company`
--

INSERT INTO `yxz_company` (`company_id`, `company_name`, `company_type`, `company_address`, `company_phone`, `company_status`, `create_date`, `last_update_date`, `last_update_uid`) VALUES
(1, '测试公司名', 1, '上海市浦东新区', '021-64694684', 0, 1364892750, 1364892750, 1364892750),
(2, '测试公司名二', 1, '上海市嘉定区', '021-64694684', 0, 1364892750, 1364892750, 1364892750);

-- --------------------------------------------------------

--
-- 表的结构 `yxz_file`
--

CREATE TABLE IF NOT EXISTS `yxz_file` (
  `file_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL COMMENT '文件名称',
  `path` text NOT NULL COMMENT '文件路径',
  `folder_id` int(11) DEFAULT NULL COMMENT '文件夹id',
  `owner_uid` int(11) DEFAULT NULL COMMENT '所有者id',
  `size` int(11) DEFAULT NULL COMMENT '文件尺寸',
  `create_date` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_date` int(11) DEFAULT NULL COMMENT '更新时间',
  `mime_type` varchar(255) DEFAULT NULL COMMENT 'MIME类型',
  `hash` varchar(255) DEFAULT NULL COMMENT '哈希值',
  `create_uid` int(11) DEFAULT NULL COMMENT '创建者用户id',
  `create_uname` varchar(255) DEFAULT NULL COMMENT '创建者用户名',
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `yxz_file`
--

INSERT INTO `yxz_file` (`file_id`, `file_name`, `path`, `folder_id`, `owner_uid`, `size`, `create_date`, `update_date`, `mime_type`, `hash`, `create_uid`, `create_uname`) VALUES
(1, '测试文件名', 'D:\\www\\htdocs\\yii-rest\\readme', 1, 1, 1024, 1364894003, 1364894003, '1364894003', 'DODESTCOLUMNE', 1, 'admin'),
(2, '测试文件名二', 'D:\\www\\htdocs\\yii-rest\\readme', 1, 1, 1024, 1364894003, 1364894003, '1364894003', 'DODESTCOLUMNE', 1, 'admin');

-- --------------------------------------------------------

--
-- 表的结构 `yxz_folder`
--

CREATE TABLE IF NOT EXISTS `yxz_folder` (
  `folder_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `folder_name` varchar(255) NOT NULL COMMENT '文件夹名称',
  `parent_id` int(11) NOT NULL COMMENT '父文件夹id',
  `path` text NOT NULL COMMENT '路径',
  PRIMARY KEY (`folder_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `yxz_folder`
--

INSERT INTO `yxz_folder` (`folder_id`, `folder_name`, `parent_id`, `path`) VALUES
(1, '测试文件夹', 1, 'D:\\\\www\\\\htdocs\\\\yii-rest\\\\readme'),
(2, '测试文件夹二', 1, 'D:\\\\www\\\\htdocs\\\\yii-rest\\\\readme');

-- --------------------------------------------------------

--
-- 表的结构 `yxz_group`
--

CREATE TABLE IF NOT EXISTS `yxz_group` (
  `group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL COMMENT '组名称',
  `group_desc` text NOT NULL COMMENT '组简介',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `yxz_group`
--

INSERT INTO `yxz_group` (`group_id`, `group_name`, `group_desc`) VALUES
(1, '测试组名', '测试组说明文字'),
(2, '测试组名二', '测试组说明文字');

-- --------------------------------------------------------

--
-- 表的结构 `yxz_order`
--

CREATE TABLE IF NOT EXISTS `yxz_order` (
  `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_name` varchar(255) NOT NULL COMMENT '订单名称',
  `order_status` varchar(255) NOT NULL COMMENT '订单状态',
  `create_date` int(11) NOT NULL COMMENT '创建日期',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `yxz_order`
--

INSERT INTO `yxz_order` (`order_id`, `order_name`, `order_status`, `create_date`) VALUES
(1, '测试订单', 'checked', 1364379828),
(2, '测试订单二', 'yes', 1364379829),
(3, '测试订单三', 'no', 1364379828);

-- --------------------------------------------------------

--
-- 表的结构 `yxz_pref`
--

CREATE TABLE IF NOT EXISTS `yxz_pref` (
  `pref_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pref_key` varchar(255) NOT NULL COMMENT '设置项',
  `pref_name` varbinary(255) NOT NULL COMMENT '设置名称',
  `pref_value` varchar(255) NOT NULL COMMENT '设置值',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  PRIMARY KEY (`pref_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `yxz_pref`
--

INSERT INTO `yxz_pref` (`pref_id`, `pref_key`, `pref_name`, `pref_value`, `user_id`) VALUES
(1, 'login', '偏好设置名', 'true', 1),
(2, 'login', '偏好设置名二', 'true', 1);

-- --------------------------------------------------------

--
-- 表的结构 `yxz_share`
--

CREATE TABLE IF NOT EXISTS `yxz_share` (
  `share_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `share_name` varchar(255) NOT NULL COMMENT '分享名称',
  `file_id` int(11) DEFAULT NULL COMMENT '文件id',
  `folder_id` int(11) DEFAULT NULL COMMENT '文件夹id',
  `share_type` int(11) NOT NULL COMMENT '分享类型',
  `owner_uid` int(11) NOT NULL COMMENT '所有者用户id',
  `permission` int(11) NOT NULL COMMENT '权限',
  `share_date` int(11) NOT NULL COMMENT '分享日期',
  `expiration` int(11) DEFAULT NULL COMMENT '过期',
  `token` varchar(255) DEFAULT NULL COMMENT '标记',
  `download_date` int(11) DEFAULT NULL COMMENT '下载时间',
  `download_nums` int(11) DEFAULT NULL COMMENT '下载次数',
  `share_link` varchar(255) DEFAULT NULL COMMENT '分享链接',
  PRIMARY KEY (`share_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `yxz_share`
--

INSERT INTO `yxz_share` (`share_id`, `share_name`, `file_id`, `folder_id`, `share_type`, `owner_uid`, `permission`, `share_date`, `expiration`, `token`, `download_date`, `download_nums`, `share_link`) VALUES
(1, '测试分享', 1, 1, 0, 1, 1, 1364895640, NULL, NULL, 1364895640, 20, 'http://t.cn/zT2UoOP'),
(2, '测试分享二', 1, 1, 0, 1, 1, 1364895640, NULL, NULL, 1364895640, 20, 'http://t.cn/zT2UoOP');

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
  `user_name` varchar(255) NOT NULL COMMENT '用户名称',
  `user_type` int(11) NOT NULL COMMENT '用户类型',
  `email` varchar(255) NOT NULL COMMENT '用户邮箱',
  `password` varchar(255) NOT NULL COMMENT '用户密码',
  `password_salt` varchar(255) NOT NULL COMMENT '用户密钥',
  `group_id` int(11) NOT NULL COMMENT '组id',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `yxz_user`
--

INSERT INTO `yxz_user` (`user_id`, `user_name`, `user_type`, `email`, `password`, `password_salt`, `group_id`) VALUES
(1, 'admin', 1, 'ljzxzxl@gmail.com', '14fe8174cbffe4be35d9c69084b1b1c7', 'FF5FDD', 1),
(2, 'test1', 1, 'test1@gmail.com', '967dcb7b19b6867cf8f03c774454301e', '72AFD3', 1),
(3, 'test2', 1, 'test2@gmail.com', 'ba0dfed06422c61073eb26d177674818', 'A6CEDE', 1),
(4, 'test3', 1, 'test3@gmail.com', 'd03b441b74d1391be929b490c5144e18', '1B5AA0', 1);

-- --------------------------------------------------------

--
-- 表的结构 `yxz_workspace`
--

CREATE TABLE IF NOT EXISTS `yxz_workspace` (
  `workspace_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `workspace_name` varchar(255) NOT NULL COMMENT '工作空间名称',
  `workspace_desc` text NOT NULL COMMENT '工作空间简介',
  PRIMARY KEY (`workspace_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `yxz_workspace`
--

INSERT INTO `yxz_workspace` (`workspace_id`, `workspace_name`, `workspace_desc`) VALUES
(1, '测试工作空间', '测试描述文字'),
(2, '测试工作空间二', '测试描述文字');

-- --------------------------------------------------------

--
-- 表的结构 `yxz_workspace_permission`
--

CREATE TABLE IF NOT EXISTS `yxz_workspace_permission` (
  `permission_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `workspace_id` int(11) NOT NULL COMMENT '工作空间id',
  `group_id` int(11) DEFAULT NULL COMMENT '组id',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `create_permission` enum('true','false') DEFAULT 'true' COMMENT '创建权限',
  `delete_permission` enum('true','false') DEFAULT 'true' COMMENT '删除权限',
  `read_permission` enum('true','false') DEFAULT 'true' COMMENT '读取权限',
  `share_permission` enum('true','false') DEFAULT 'true' COMMENT '分享权限',
  PRIMARY KEY (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 限制导出的表
--

--
-- 限制表 `yxz_auth_assignment`
--
ALTER TABLE `yxz_auth_assignment`
  ADD CONSTRAINT `yxz_auth_assignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `yxz_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `yxz_auth_item_child`
--
ALTER TABLE `yxz_auth_item_child`
  ADD CONSTRAINT `yxz_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `yxz_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `yxz_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `yxz_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
