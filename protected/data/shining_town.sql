-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 05 月 25 日 04:09
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `st_comment`
--

INSERT INTO `st_comment` (`id`, `text`, `create_time`, `contact_method`, `service_attitude`, `delivery_speed`) VALUES
(1, 'comment test 1', '2012-03-14 00:00:00', NULL, 5, 5),
(2, 'comment test 2', '2012-03-27 00:00:00', NULL, 5, 5),
(3, 'Hello', '2012-04-15 13:30:56', 'hello@gmail.com', 5, 5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `st_feedback`
--

INSERT INTO `st_feedback` (`id`, `order_id`, `text`, `contact_method`, `create_time`, `photo_name`, `dealed`) VALUES
(1, '000001', 'test', '12345678901', '2012-05-04 00:00:00', 'feedback.png', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `st_order`
--

INSERT INTO `st_order` (`id`, `order_id`, `order_state_id`, `create_time`, `product_id`, `entered_pid`, `remark`) VALUES
(3, '000001', 2, '2012-03-25', '000001', '000001', '1天'),
(4, '000002', 1, '2012-03-24', '000001', '000001', '2012-03-26进行制作'),
(5, '000003', 1, '2012-03-24', '000001', '000001', '2012-03-26进行制作');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

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
(10, '13085.jpg', '000009', 1),
(11, 'Chrysanthemum.jpg', '000010', 1),
(12, 'Desert.jpg', '000010', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `st_product`
--

INSERT INTO `st_product` (`id`, `product_id`, `product_name`, `product_introduce`, `product_mark`, `product_create_time`, `product_marked_times`, `mask_photo_id`) VALUES
(11, '000004', 'another test', 'another test', 5, '2012-04-13 18:13:56', 0, 5),
(12, '000008', 'test4', 'test4', 5, '2012-04-17 19:46:55', 0, 8),
(13, '000009', 'test5', 'test4sdasdf', 5, '2012-04-17 19:48:38', 0, 9),
(14, '000010', '测试', '测试产品', 5, '2012-05-02 16:36:06', 0, 11);

-- --------------------------------------------------------

--
-- 表的结构 `st_product_comment`
--

CREATE TABLE IF NOT EXISTS `st_product_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `create_time` datetime NOT NULL,
  `contact_method` varchar(100) NOT NULL,
  `amazing_level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comment_product` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `st_product_comment`
--

INSERT INTO `st_product_comment` (`id`, `product_id`, `text`, `create_time`, `contact_method`, `amazing_level`) VALUES
(1, '000004', 'product comment test', '2012-04-13 00:00:00', 'roychad0421@gmail.com', 5),
(2, '000004', 'test', '2012-04-16 00:00:00', 'roychad0421@gmail.com', 5);

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
(1, 5, 5, 2, 2);

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
