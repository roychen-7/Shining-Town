-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 06 月 30 日 22:52
-- 服务器版本: 5.5.16
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `shining_town`
--

-- --------------------------------------------------------

--
-- 表的结构 `st_comment`
--

CREATE TABLE IF NOT EXISTS `st_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `create_time` datetime NOT NULL,
  `contact_method` varchar(100) DEFAULT NULL,
  `service_attitude` int(11) NOT NULL,
  `delivery_speed` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- 转存表中的数据 `st_comment`
--

INSERT INTO `st_comment` (`id`, `text`, `create_time`, `contact_method`, `service_attitude`, `delivery_speed`) VALUES
(3, 'Hello', '2012-04-15 13:30:56', 'hello@gmail.com', 5, 5),
(4, '56456', '2012-06-30 10:10:45', '', 2, 2),
(5, 'ertrt', '2012-06-30 10:19:26', '', 2, 2),
(6, '123', '2012-06-30 16:02:37', '', 1, 1),
(7, '123123', '2012-06-30 16:02:44', '', 1, 1),
(8, '123swd', '2012-06-30 16:02:49', '', 1, 1),
(9, '123', '2012-06-30 16:02:59', '', 4, 4),
(10, 'df', '2012-06-30 16:03:04', '', 2, 3),
(11, '5df', '2012-06-30 16:03:09', '', 3, 4),
(12, 'ewr', '2012-06-30 16:03:15', '', 3, 2),
(13, 'sdf', '2012-06-30 16:03:22', '', 3, 3),
(14, 'dfbv', '2012-06-30 16:03:29', '', 3, 4),
(15, 'sdf', '2012-06-30 16:03:35', '', 2, 5),
(16, '3', '2012-06-30 16:03:41', '', 4, 5),
(17, '3e', '2012-06-30 16:05:11', '', 2, 3),
(18, '123', '2012-06-30 16:05:31', '', 2, 1),
(19, 'dsf', '2012-06-30 16:05:36', '', 1, 2),
(20, '34', '2012-06-30 16:05:40', '', 2, 3),
(21, 'dgg', '2012-06-30 16:05:44', '', 1, 2),
(22, 'sdf', '2012-06-30 16:05:49', '', 2, 4),
(23, '2312', '2012-06-30 16:05:54', '', 5, 5),
(24, '5234', '2012-06-30 16:06:00', '', 5, 5),
(25, 'werwer', '2012-06-30 16:06:05', '', 5, 5),
(26, 'rwer5', '2012-06-30 16:06:11', '', 5, 5),
(27, 'weqwe', '2012-06-30 16:06:16', '', 3, 3),
(28, 'qweq', '2012-06-30 16:06:21', '', 3, 3),
(29, 'Hello', '2012-04-15 13:30:56', NULL, 5, 5),
(30, '56456', '2012-06-30 10:10:45', NULL, 2, 2),
(31, 'ertrt', '2012-06-30 10:19:26', NULL, 2, 2),
(32, '123', '2012-06-30 16:02:37', NULL, 1, 1),
(33, '123123', '2012-06-30 16:02:44', NULL, 1, 1),
(34, '123swd', '2012-06-30 16:02:49', NULL, 1, 1),
(35, '123', '2012-06-30 16:02:59', NULL, 4, 4),
(36, 'df', '2012-06-30 16:03:04', NULL, 2, 3),
(37, '5df', '2012-06-30 16:03:09', NULL, 3, 4),
(38, 'ewr', '2012-06-30 16:03:15', NULL, 3, 2),
(39, 'sdf', '2012-06-30 16:03:22', NULL, 3, 3),
(40, 'dfbv', '2012-06-30 16:03:29', NULL, 3, 4),
(41, 'sdf', '2012-06-30 16:03:35', NULL, 2, 5),
(42, '3', '2012-06-30 16:03:41', NULL, 4, 5),
(43, '3e', '2012-06-30 16:05:11', NULL, 2, 3),
(44, '123', '2012-06-30 16:05:31', NULL, 2, 1),
(45, 'dsf', '2012-06-30 16:05:36', NULL, 1, 2),
(46, '34', '2012-06-30 16:05:40', NULL, 2, 3),
(47, 'dgg', '2012-06-30 16:05:44', NULL, 1, 2),
(48, 'sdf', '2012-06-30 16:05:49', NULL, 2, 4),
(49, '2312', '2012-06-30 16:05:54', NULL, 5, 5),
(50, '5234', '2012-06-30 16:06:00', NULL, 5, 5),
(51, 'werwer', '2012-06-30 16:06:05', NULL, 5, 5),
(52, 'rwer5', '2012-06-30 16:06:11', NULL, 5, 5),
(53, 'weqwe', '2012-06-30 16:06:16', NULL, 3, 3),
(54, 'qweq', '2012-06-30 16:06:21', NULL, 3, 3),
(60, 'sdd', '2012-06-30 17:55:07', '', 3, 3),
(61, '3', '2012-06-30 17:55:13', '', 3, 3),
(62, '3', '2012-06-30 17:55:17', '', 3, 3),
(63, '3', '2012-06-30 17:55:22', '', 3, 3),
(64, '3', '2012-06-30 17:55:27', '', 3, 3),
(65, '3', '2012-06-30 17:55:33', '', 3, 3),
(66, '3', '2012-06-30 17:55:42', '', 4, 2),
(67, '2', '2012-06-30 17:55:46', '', 2, 1),
(68, 'z', '2012-06-30 20:56:07', '', 5, 5);

-- --------------------------------------------------------

--
-- 表的结构 `st_feedback`
--

CREATE TABLE IF NOT EXISTS `st_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `contact_method` varchar(100) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `photo_name` varchar(100) DEFAULT NULL,
  `dealed` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feedback_order` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `st_feedback`
--

INSERT INTO `st_feedback` (`id`, `order_id`, `text`, `contact_method`, `create_time`, `photo_name`, `dealed`) VALUES
(1, '000001', 'test', '12345678901', '2012-05-04 00:00:00', 'feedback.png', 1),
(2, '000010', 'Nima', '', '2012-06-30 22:12:20', NULL, 1),
(3, '000010', 'Nima', '', '2012-06-30 22:14:51', NULL, 2),
(4, '000010', 'Aa', '', '2012-06-30 22:20:29', NULL, 2),
(5, '000010', 'Aa', '', '2012-06-30 22:20:44', NULL, 2),
(6, '000010', 'Aa', '', '2012-06-30 22:22:36', NULL, 2),
(7, '000010', 'Qq', '', '2012-06-30 22:39:53', 'feedback.png', 2),
(8, '000011', 'Qq', '', '2012-06-30 22:46:39', 'feedback.png', 1);

-- --------------------------------------------------------

--
-- 表的结构 `st_feedback_dealed`
--

CREATE TABLE IF NOT EXISTS `st_feedback_dealed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dealed_zn` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `st_feedback_dealed`
--

INSERT INTO `st_feedback_dealed` (`id`, `dealed_zn`) VALUES
(1, '是'),
(2, '否');

-- --------------------------------------------------------

--
-- 表的结构 `st_order`
--

CREATE TABLE IF NOT EXISTS `st_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) NOT NULL,
  `order_state_id` int(11) NOT NULL,
  `create_time` date NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `entered_pid` varchar(11) NOT NULL,
  `remark` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`),
  KEY `fk_order_orderState` (`order_state_id`),
  KEY `fk_order_product` (`product_id`),
  KEY `fk_order_user` (`entered_pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `st_order`
--

INSERT INTO `st_order` (`id`, `order_id`, `order_state_id`, `create_time`, `product_id`, `entered_pid`, `remark`) VALUES
(3, '000001', 2, '2012-03-25', '000001', '000001', '1天'),
(4, '000002', 1, '2012-03-24', '000001', '000001', '2012-03-26进行制作'),
(5, '000003', 1, '2012-03-24', '000001', '000001', '2012-03-26进行制作'),
(6, '000010', 1, '2012-06-30', '000001', '000001', '2012-07-02进行制作'),
(8, '000011', 1, '2012-06-30', '000004', '000001', '2012-07-02进行制作');

-- --------------------------------------------------------

--
-- 表的结构 `st_order_state`
--

CREATE TABLE IF NOT EXISTS `st_order_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_zn` varchar(50) NOT NULL,
  `order_state_id` int(11) NOT NULL,
  `state_display` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_state_id` (`order_state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `st_order_state`
--

INSERT INTO `st_order_state` (`id`, `state_zn`, `order_state_id`, `state_display`) VALUES
(1, '付款成功，已经进入排单，预计将于', 1, '进入排单'),
(2, '已经开始制作，制作时间大概为', 2, '开始制作'),
(3, '已经制作完成，正在风干，时间为一天。', 3, '正在风干'),
(4, '正在做细节处理和装机测试。', 4, '细节处理'),
(5, '正在塑封装箱', 5, '塑装封箱'),
(6, '已发货，快递订单号为', 6, '已发货'),
(7, '保养方法：', 7, '保养方法');

-- --------------------------------------------------------

--
-- 表的结构 `st_photo`
--

CREATE TABLE IF NOT EXISTS `st_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_name` varchar(32) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `photo_state_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_photo_state` (`photo_state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `st_photo`
--

INSERT INTO `st_photo` (`id`, `photo_name`, `product_id`, `photo_state_id`) VALUES
(3, '13085.jpg', '000003', 1),
(4, '61186e38129a0e7896ddd825.jpg', '000003', 1),
(5, '61186e38129a0e7896ddd825.jpg', '000004', 1),
(6, 'iphone_4_colors.jpg', '000004', 1),
(7, 'iphone_4_colors.jpg', '000008', 1),
(8, '13085.jpg', '000008', 1),
(9, '61186e38129a0e7896ddd825.jpg', '000009', 1),
(11, 'Chrysanthemum.jpg', '000010', 1),
(12, 'Desert.jpg', '000010', 1),
(13, 'Chrysanthemum.jpg', '000009', 1),
(14, 'Chrysanthemum.jpg', '000001', 1),
(15, 'Hydrangeas.jpg', '000001', 1);

-- --------------------------------------------------------

--
-- 表的结构 `st_photo_state`
--

CREATE TABLE IF NOT EXISTS `st_photo_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `st_photo_state`
--

INSERT INTO `st_photo_state` (`id`, `state_name`) VALUES
(1, 'USING'),
(2, 'UNUSING');

-- --------------------------------------------------------

--
-- 表的结构 `st_product`
--

CREATE TABLE IF NOT EXISTS `st_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_introduce` varchar(200) NOT NULL,
  `product_mark` float NOT NULL,
  `product_create_time` datetime NOT NULL,
  `product_marked_times` int(11) NOT NULL,
  `mask_photo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `fk_product_photo` (`mask_photo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `st_product`
--

INSERT INTO `st_product` (`id`, `product_id`, `product_name`, `product_introduce`, `product_mark`, `product_create_time`, `product_marked_times`, `mask_photo_id`) VALUES
(11, '000004', 'another test', 'another test', 5, '2012-04-13 18:13:56', 0, 5),
(12, '000008', 'test4', 'test4', 5, '2012-04-17 19:46:55', 0, 8),
(13, '000009', 'test5', 'test4sdasdf', 5, '2012-04-17 19:48:38', 0, 13),
(14, '000010', '测试', '测试产品', 5, '2012-05-02 16:36:06', 4, 11),
(15, '000001', 'xiashuai', 'haha', 5, '2012-06-30 11:27:57', 0, 14);

-- --------------------------------------------------------

--
-- 表的结构 `st_product_comment`
--

CREATE TABLE IF NOT EXISTS `st_product_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `create_time` datetime NOT NULL,
  `contact_method` varchar(100) DEFAULT NULL,
  `amazing_level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comment_product` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `st_product_comment`
--

INSERT INTO `st_product_comment` (`id`, `product_id`, `text`, `create_time`, `contact_method`, `amazing_level`) VALUES
(1, '000010', 'g', '2012-06-30 20:29:23', 'G', 5),
(2, '000010', 'g', '2012-06-30 20:55:19', '', 5),
(3, '000010', 'f', '2012-06-30 20:55:36', '', 5);

-- --------------------------------------------------------

--
-- 表的结构 `st_site_mark`
--

CREATE TABLE IF NOT EXISTS `st_site_mark` (
  `id` int(11) NOT NULL,
  `service_attitude` float NOT NULL,
  `delivery_speed` float NOT NULL,
  `service_attitude_times` int(11) NOT NULL,
  `delivery_speed_times` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `st_site_mark`
--

INSERT INTO `st_site_mark` (`id`, `service_attitude`, `delivery_speed`, `service_attitude_times`, `delivery_speed_times`) VALUES
(1, 2.93444, 3.2459, 61, 61);

-- --------------------------------------------------------

--
-- 表的结构 `st_user`
--

CREATE TABLE IF NOT EXISTS `st_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `limit_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `st_user`
--

INSERT INTO `st_user` (`id`, `user_id`, `username`, `password`, `limit_id`) VALUES
(3, '000001', 'admin', '21218cca77804d2ba1922c33e0151105', 0),
(4, '000002', 'roychad', '21218cca77804d2ba1922c33e0151105', 1);

-- --------------------------------------------------------

--
-- 表的结构 `st_user_limit`
--

CREATE TABLE IF NOT EXISTS `st_user_limit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `limit_id` int(11) NOT NULL,
  `limit_zn` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `st_user_limit`
--

INSERT INTO `st_user_limit` (`id`, `limit_id`, `limit_zn`) VALUES
(1, 0, '管理员'),
(2, 1, '员工');

--
-- 限制导出的表
--

--
-- 限制表 `st_feedback`
--
ALTER TABLE `st_feedback`
  ADD CONSTRAINT `fk_feedback_order` FOREIGN KEY (`order_id`) REFERENCES `st_order` (`order_id`);

--
-- 限制表 `st_order`
--
ALTER TABLE `st_order`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`entered_pid`) REFERENCES `st_user` (`user_id`);

--
-- 限制表 `st_photo`
--
ALTER TABLE `st_photo`
  ADD CONSTRAINT `fk_photo_state` FOREIGN KEY (`photo_state_id`) REFERENCES `st_photo_state` (`id`);

--
-- 限制表 `st_product`
--
ALTER TABLE `st_product`
  ADD CONSTRAINT `fk_product_photo` FOREIGN KEY (`mask_photo_id`) REFERENCES `st_photo` (`id`);

--
-- 限制表 `st_product_comment`
--
ALTER TABLE `st_product_comment`
  ADD CONSTRAINT `fk_comment_product` FOREIGN KEY (`product_id`) REFERENCES `st_product` (`product_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
