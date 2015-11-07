-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-11-04 15:20:16
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dxstreet`
--

-- --------------------------------------------------------

--
-- 表的结构 `building`
--

CREATE TABLE IF NOT EXISTS `building` (
  `building_dm` varchar(50) NOT NULL DEFAULT '' COMMENT '建筑物代码',
  `building_mc` varchar(50) DEFAULT NULL COMMENT '建筑物名称（可为空）',
  `keywords` varchar(255) DEFAULT NULL COMMENT '建筑物搜索关键字',
  `type` varchar(255) DEFAULT NULL COMMENT '建筑物类型',
  `street_dm` varchar(50) DEFAULT NULL COMMENT '所属街区（指向街区代码）',
  `location` int(11) DEFAULT '0' COMMENT '相对街道位置：1表示临街、2表示中，3表示后',
  `space` int(11) DEFAULT '0' COMMENT '门前空地类型：1表示停车场、2广场、3草坪、4树木绿化、5空地',
  `direction` int(11) DEFAULT '0' COMMENT '在街道的方向（上/下或者东南西北）(1,2,3,4,5,6)',
  `ordera` decimal(18,2) DEFAULT '0.00' COMMENT '排序号（可为小数）',
  `photos` varchar(50) DEFAULT NULL COMMENT '照片路径（可以多个，逗号分隔）',
  `stime` datetime DEFAULT NULL COMMENT '信息采集时间',
  `author` varchar(50) DEFAULT NULL COMMENT '信息采集人',
  `admin` varchar(50) DEFAULT NULL COMMENT '信息管理员',
  `expired` tinyint(1) NOT NULL COMMENT '是否过期，默认否表示未过期',
  PRIMARY KEY (`building_dm`),
  KEY `buildingstreet_dm` (`street_dm`),
  KEY `keywords` (`keywords`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `building`
--

INSERT INTO `building` (`building_dm`, `building_mc`, `keywords`, `type`, `street_dm`, `location`, `space`, `direction`, `ordera`, `photos`, `stime`, `author`, `admin`, `expired`) VALUES
('330101100201000001', '弗雷德', 'frid', '3', '330101100201', 1, 0, 0, '16.00', '', '2001-02-03 04:05:06', '', '', 0),
('330101100201000002', '杭电', '杭电', '0', '330101100201', 1, 0, 1, '4.00', 'hd', '2015-02-02 08:38:32', NULL, NULL, 0),
('330101100201000003', '广场', '广场', '31', '330101100201', 1, 0, 1, '17.00', 'gc', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000004', '杭电体育场', '体育', '0', '330101100201', 1, 0, 1, '1.00', 'tyc', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000005', '苹果维修店', '店', '0', '330101100201', 2, 5, 1, '5.00', 'sd', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000006', '奶茶店A', '店', '0', '330101100201', 2, 5, 1, '6.00', 'sd', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000007', '生活超市A', '店', '0', '330101100201', 2, 5, 1, '7.00', 'sd', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000008', '一鸣酸奶店', '店', '0', '330101100201', 2, 5, 1, '8.00', 'sd', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000009', '水果店', '店', '0', '330101100201', 2, 5, 1, '9.00', 'sd', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000010', '晨光文具店', '店', '0', '330101100201', 2, 5, 1, '10.00', 'sd', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000011', '图文打印', '店', '0', '330101100201', 2, 5, 1, '11.00', 'sd', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000012', '奶茶店B', '店', '0', '330101100201', 2, 5, 1, '12.00', 'sd', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000013', '自行车站', NULL, '43', '330101100201', 1, 0, 1, '13.00', 'zxcz', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000014', '报刊亭B', '报刊亭', '45', '330101100201', 1, 0, 1, '14.00', 'bkt', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000015', '杭电南一门', '杭电', '0', '330101100201', 1, 0, 1, '15.00', 'hd', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000016', '杭电体育馆', '体育\r\n\r\n馆', NULL, '330101100201', 1, 0, 2, '1.00', 'tyg', '2001-02-03 04:05:06', '', '', 0),
('330101100201000017', '杭电教学区', '杭电', NULL, '330101100201', 1, 0, 2, '2.00', 'hd', '2001-02-03 04:05:06', '', '', 0),
('330101100201000018', '杭电学活区门', '杭电', NULL, '330101100201', 1, 0, 2, '3.00', 'hd', '2001-02-03 04:05:06', '', '', 0),
('330101100201000019', '报刊亭A', '报刊亭', '45', '330101100201', 1, 0, 1, '3.00', 'bkt', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000021', '路口', '路', '21', '330101100201', 1, 0, 1, '15.10', 'lu', '2001-02-06 04:05:06', '', '', 0),
('330101100201000022', '生活超市A', '店', '0', '330101100202', 2, 5, 1, '7.00', 'sd', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000023', '图文打印', '店', '0', '330101100202', 2, 5, 2, '10.20', 'sd', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000024', '报刊亭A', '报刊亭', '45', '330101100202', 1, 0, 2, '3.03', 'bkt', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000025', '路口', '路', '21', '330101100202', 1, 2, 2, '15.24', 'lu', '2001-02-06 04:05:06', '', '', 0),
('330101100201000026', '奶茶店B', '店', '0', '330101100203', 2, 5, 1, '12.00', 'sd', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000027', '奶茶店B', '店', '0', '330101100203', 2, 4, 2, '12.00', 'sd', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000028', '报刊亭B', '报刊亭', '45', '330101100203', 1, 0, 1, '14.00', 'bkt', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000029', '水果店', '店', '0', '330101100203', 2, 5, 1, '9.00', 'sd', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000032', '报刊亭A', '报刊亭', '45', '330101100202', 1, 3, 2, '3.22', 'bkt', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000033', '奶茶店B', '店', '0', '330101100202', 2, 2, 2, '6.03', 'sd', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100201000051', '水果店', '店', '0', '330101100202', 2, 5, 1, '9.00', 'sd', '2015-02-02 09:43:22', NULL, NULL, 0),
('330101100501000001', '弗雷德', 'frid', NULL, '330101100501', 1, 0, 0, '0.00', '', '2001-02-03 04:05:06', '', '', 0),
('330101100901000001', '建筑一', '建\r\n\r\n筑', NULL, '330101100901', 1, 2, 3, '0.00', '2rmugs8nv6', '2001-02-03 04:05:06', '', '', 0),
('330104000101000031', '高沙文渊大厦', '文渊大厦', NULL, '330104000101', 1, 0, 0, '1.00', 'fdvto2w1dt', '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000032', '杭州电子科技大学体育馆', '杭电体育馆', NULL, '330101100201', 2, 4, 3, '1.00', 'fdvto2w1d', '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000033', '高沙文渊大厦', '文渊大厦', NULL, '330101100201', 1, 5, 6, '1.00', 'fdvto2w1d', '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000034', '高沙公寓', '高沙公寓', NULL, '330101100201', 1, 5, 2, '1.00', 'fdvto2w1d', '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000035', '路口', '路口', NULL, '330101100201', 1, 5, 4, '2.00', NULL, '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000036', '杭州电子科技大学体育馆', '杭电体育馆', NULL, '330101100202', 3, 4, 1, '1.00', 'decs210qjv', '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000037', '杭州电子科技大学校区北二门', NULL, NULL, '330101100202', 1, 5, 1, '2.00', 'rjrhv7meox', '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000038', 'building_mc\r\n杭州电子科技大学体育场', NULL, NULL, '330101100202', 3, 5, 2, '1.00', 'daqbd835jg', '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000039', 'building_mc\r\n空地', NULL, NULL, '330101100202', 1, 5, 2, '2.00', NULL, '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000040', '\r\n杭州电子科技大学生活区南二门', NULL, NULL, '330101100202', 1, 5, 2, '3.00', '4nex8timdt', '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000041', '\r\n空地', NULL, NULL, '330101100202', 1, 5, 1, '3.00', NULL, '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000042', '\r\n空地', NULL, NULL, '330101100202', 1, 5, 2, '4.00', NULL, '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000043', '\r\n空地', NULL, NULL, '330101100202', 1, 5, 1, '4.00', NULL, '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000044', '\r\n杭电学生公寓', NULL, NULL, '330101100202', 2, 5, 2, '5.00', NULL, '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000045', '\r\n空地', NULL, NULL, '330101100202', 1, 5, 1, '5.00', NULL, '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000046', '\r\n杭电学生生活区南一门', NULL, NULL, '330101100202', 1, 5, 2, '6.00', 'i0hxlebctq', '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000047', '\r\n杭电校区北一门', NULL, NULL, '330101100202', 1, 5, 1, '6.00', 'hgqqrmt0nm', '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000048', '\r\n空地', NULL, NULL, '330101100202', 1, 5, 2, '7.00', 'hgqqrmt0nm', '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000049', '\r\n福雷德支路路口', NULL, NULL, '330101100202', 1, 5, 1, '8.00', 'hgqqrmt0nm', '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000050', '\r\n福雷德', NULL, NULL, '330101100202', 1, 3, 2, '8.00', 'h7pgstglpl', '0000-00-00 00:00:00', NULL, NULL, 0),
('330104000101000051', '\r\n空地', NULL, NULL, '330101100202', 1, 4, 1, '9.00', 'h7pgstglpl', '0000-00-00 00:00:00', NULL, NULL, 0),
('330104100202000001', '商业大厦', '', NULL, '330101101201', 2, 5, 1, '1.00', '', '2001-02-03 04:05:06', '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `chains`
--

CREATE TABLE IF NOT EXISTS `chains` (
  `chains_dm` varchar(50) NOT NULL DEFAULT '' COMMENT '连锁店代码',
  `chains_mc` varchar(50) DEFAULT NULL COMMENT '连锁店名称',
  `type` varchar(50) DEFAULT NULL COMMENT '类型（指向类型表）',
  `address` varchar(50) NOT NULL COMMENT '总店地址',
  `tellphoto` varchar(50) NOT NULL COMMENT '联系方式',
  `photo` varchar(100) NOT NULL COMMENT '总店图片，多张照片间用逗号隔开',
  `intro` text NOT NULL COMMENT '简介',
  PRIMARY KEY (`chains_dm`),
  UNIQUE KEY `chains_dm` (`chains_dm`),
  KEY `chainstype` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `chains`
--

INSERT INTO `chains` (`chains_dm`, `chains_mc`, `type`, `address`, `tellphoto`, `photo`, `intro`) VALUES
('3301041002020000010004', '施盖造型z', 'E11', '浙江省杭州市江干区59好号', '1627336383', 'CR-Q8.jpg,4.jpg', '这里这里的东西很好吃，下次可以经常过来吃，，好不东西很好吃，下次可以经常过来吃，，好不好东西很好吃，下次可以很好吃，下次可以经常过');

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(50) NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `shop_id` varchar(50) NOT NULL COMMENT '评论店铺ID',
  `user_id` varchar(50) NOT NULL COMMENT '评论用户ID',
  `c_content` text NOT NULL COMMENT '评论内容',
  `c_photo` varchar(100) NOT NULL COMMENT '评论图片，多张图片用‘，’号隔开',
  `reply` text NOT NULL COMMENT '评论回复',
  `reply_time` date NOT NULL COMMENT '回复时间',
  `reply_pass_time` date NOT NULL COMMENT '评论通过时间',
  `c_time` date NOT NULL COMMENT '评论时间',
  `c_type` int(11) NOT NULL COMMENT '评论类型（1是评论2是纠错）',
  `feedback` int(1) NOT NULL COMMENT '0表示评论内容显示，1表示评论内容不显示，2表示纠错状态：已完成，3表示纠错状态待解决',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`comment_id`, `shop_id`, `user_id`, `c_content`, `c_photo`, `reply`, `reply_time`, `reply_pass_time`, `c_time`, `c_type`, `feedback`) VALUES
(1, '3301041002020000010004', '37', '这里的东西挺好吃的这里的东西挺好吃的这里的东西挺好吃的这里的东西挺好吃的这里的东西挺好吃的这里的东西挺好吃的这里的东西挺好吃的这里的东西挺好吃的这里的东西挺好吃的这里的东西挺好吃的这里的东西挺好吃的', 'c.jpg,b.jpg', '谢谢夸奖////、欢迎下次再来//、谢谢夸奖////、欢迎下次再来谢谢夸奖////、欢迎下次再来谢谢夸奖////、欢迎下次再来', '2015-06-03', '0000-00-00', '2015-06-01', 1, 0),
(2, '3301041002020000010004', '28', '这里。，、的东西 挺好吃的这里的，。，。东西挺好吃的这里的东西挺好我也觉得吃 的这里的东西挺好吃的这。、。你们，里的东西挺好吃的这里的东西挺好吃的这里的东西挺好吃的这 里的东西挺？。好吃的这里的东西挺好吃的这里的东西挺好吃的这里，。的东西挺', '', '谢谢夸奖////、欢迎下次再来//、谢谢夸奖////、欢迎下次再来谢谢夸奖////、欢迎下次再来谢谢夸奖////、欢迎下次再来', '2015-06-01', '0000-00-00', '2015-06-18', 1, 0),
(3, '3301041002020000010004', '37', '。，、的东西 挺好吃的这里的，。，。东西挺好吃的这里的东西挺好我也觉得吃 的这里的东西挺好吃的这。、。你们，里的东西挺好吃的这里的东西挺好吃的这里的东西挺好吃的这 里的东西挺？。好吃的这里的东西挺好吃的这里的东西挺好吃的这里，。的东', '', '谢谢夸奖////、欢迎下次再来//、谢谢夸奖////、欢迎下次再来谢谢夸奖////、欢迎下次再来谢谢夸奖////、欢迎下次再来', '2015-06-01', '0000-00-00', '2015-06-01', 1, 0),
(4, '3301041002020000010004', '28', '。，、的东西 挺好吃的这里的，。，。东西挺好吃的这里的东西挺好我也觉得吃 的这里的东西挺好吃的这。、。你们，里的东西挺好吃的这里的东西挺好吃的这里的东西挺好吃的这 里的东西挺？。好吃的这里的东西挺好吃的这里的东西挺好吃的这里，。的东', '', '谢谢夸奖////、欢迎下次再来//、谢谢夸奖////、欢迎下次再来谢谢夸奖////、欢迎下次再来谢谢夸奖////、欢迎下次再来', '2015-06-01', '0000-00-00', '2015-06-01', 1, 0),
(7, '3301041002020000010004', '37', '这里的东西不好吃，以后不要来这里了', '', '', '0000-00-00', '0000-00-00', '2015-06-04', 2, 0),
(8, '3301041002020000010004', '37', '这里的东西不好吃，以后不要来这里了', '', '', '0000-00-00', '0000-00-00', '2015-06-04', 1, 0),
(14, '3301041002020000010002', '37', '发生的FA算法', '', '', '0000-00-00', '0000-00-00', '2015-06-04', 1, 0),
(15, '3301041002020000010001', '37', '国家的规划大家更好更好', '', '', '0000-00-00', '0000-00-00', '2015-06-04', 1, 0),
(16, '3301041002020000010001', '37', '哎呀地方所得税法', '', '', '0000-00-00', '0000-00-00', '2015-06-04', 1, 0),
(17, '3301041002020000010004', '28', '。，、的东西 挺好吃的这里的，。，。东西挺好吃的这里的东西挺好我也觉得吃 的这里的东西挺好吃的这。、。你们，里的东西挺好吃的这里的东西挺好吃的这里的东西挺好吃的这 里的东西挺？。好吃的这里的东西挺好吃的这里的东西挺好吃的这里，。的东', '', '谢谢夸奖////、欢迎下次再来//、谢谢夸奖////、欢迎下次再来谢谢夸奖////、欢迎下次再来谢谢夸奖////、欢迎下次再来', '2015-06-01', '0000-00-00', '2015-06-01', 1, 1),
(18, '3301041002020000010004', '28', '。，、的东西 挺好吃的这里的，。，。东西挺好吃的这里的东西挺好我也觉得吃 的这里的东西挺好吃的这。、。你们，里的东西挺好吃的这里的东西挺好吃的这里的东西挺好吃的这 里的东西挺？。好吃的这里的东西挺好吃的这里的东西挺好吃的这里，。的东', '', '谢谢夸奖////、欢迎下次再来//、谢谢夸奖////、欢迎下次再来谢谢夸奖////、欢迎下次再来谢谢夸奖////、欢迎下次再来', '2015-06-01', '0000-00-00', '2015-06-01', 1, 2),
(19, '3301041002020000010001', '37', '哎呀地方所得税法', '', '', '0000-00-00', '0000-00-00', '2015-06-04', 1, 3),
(20, '3301041002020000010001', '37', '哎呀地方所得税法', '', '', '0000-00-00', '0000-00-00', '2015-06-04', 1, 4),
(21, '3301041002020000010004', '37', '这里的东西不好吃，以后不要来这里了', '', '', '0000-00-00', '0000-00-00', '2015-06-04', 1, 3),
(22, '3301041002020000010004', '37', '这里的东西不好吃，以后不要来这里了', '', '', '0000-00-00', '0000-00-00', '2015-06-04', 1, 4),
(23, '3301041002020000010004', '37', '这里的东西不好好吃，以后不要吃，以后不要来这里了', '', '', '0000-00-00', '0000-00-00', '2015-06-04', 1, 3),
(24, '3301041002020000010004', '37', 'dsfzasdgfa', '', '', '0000-00-00', '0000-00-00', '2015-06-05', 1, 0),
(25, '3301041002020000010004', '37', 'lalalalla ', '', '', '0000-00-00', '0000-00-00', '2015-06-05', 1, 0),
(26, '3301041002020000010004', '37', 'dsadmslajdk sl', '', '', '0000-00-00', '0000-00-00', '2015-06-05', 1, 0),
(27, '3301041002020000010004', '37', '这家店的电话号码是错的', '', '', '0000-00-00', '0000-00-00', '2015-06-05', 1, 3),
(28, '3301041002020000010004', '37', '测试正常那就好次哦', '', '', '0000-00-00', '0000-00-00', '2015-06-05', 1, 3),
(29, '3301040001010000010005', '37', '这家店的地址错了', '', '', '0000-00-00', '2015-10-25', '2015-06-06', 1, 0),
(30, '3301040001010000010005', '37', '这家点的地址错了，应该是。。。。。', '', '', '0000-00-00', '0000-00-00', '2015-06-06', 1, 4),
(31, '3301040001010000010005', '37', '这家点的东西很好', '', '', '0000-00-00', '0000-00-00', '2015-06-06', 1, 0),
(32, '3301041002020000010004', '37', '啦啦啦啦', '', '', '0000-00-00', '0000-00-00', '2015-09-30', 1, 0),
(33, '3301041002020000010004', '37', '啦啦啦', '', '', '0000-00-00', '0000-00-00', '2015-09-30', 1, 0),
(34, '3301041002020000010004', '37', '我是评论呀呀呀呀呀', 'CR-F.55.46.jpg,CR-v2.42.51.jpg,CR-G14.55.46.jpg', '', '0000-00-00', '2015-10-25', '2015-10-23', 1, 0),
(35, '3301041002020000010004', '37', '我是一只卖报的小行家', 'CR-t.43.12.jpg', '哈哈哈哈哈', '2015-10-25', '2015-10-26', '2015-10-24', 1, 0),
(36, '3301041002020000010004', '37', '我来就错了', '', '', '0000-00-00', '0000-00-00', '2015-10-24', 2, 3),
(37, '3301041002020000010004', '37', '12', '', '', '0000-00-00', '0000-00-00', '2015-10-24', 2, 3),
(38, '3301041002020000010004', '37', '这个店的电话号码应该是。。。。。。', '', '', '0000-00-00', '0000-00-00', '2015-10-24', 2, 3),
(39, '3301041002020000010004', '37', '我又来了。。。。', 'CR-S.42.45.jpg', '', '0000-00-00', '0000-00-00', '2015-10-24', 2, 3),
(40, '3301041002020000010004', '37', '呃呃呃', 'CR-n.jpg', '', '0000-00-00', '0000-00-00', '2015-10-26', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `d_buildtype`
--

CREATE TABLE IF NOT EXISTS `d_buildtype` (
  `btypedm` varchar(2) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `btypemc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `d_buildtype`
--

INSERT INTO `d_buildtype` (`btypedm`, `btypemc`) VALUES
('30', '填充'),
('31', '空地'),
('32', '绿化'),
('33', '河道'),
('34', '河口'),
('36', '建设工地'),
('40', '街前设施'),
('41', '公交站'),
('42', '地铁站'),
('43', '自行车站'),
('44', '公厕'),
('45', '报刊亭'),
('46', '电话亭'),
('47', '服务厅'),
('50', '油气站'),
('51', '加油站'),
('52', '加气站'),
('53', '加电站'),
('35', '码头'),
('0', '普通'),
('1', '独栋'),
('2', '综合娱乐'),
('3', '综合卖场'),
('4', '写字楼'),
('10', '门'),
('11', '普通开门'),
('12', '伸缩门'),
('13', '道闸门'),
('14', '常闭消防门'),
('20', '道路'),
('21', '路口'),
('22', '小通道'),
('23', '桥口'),
('11', '普通开门'),
('12', '伸缩门'),
('13', '道闸门'),
('14', '常闭消防门'),
('20', '道路'),
('21', '路口'),
('22', '小通道'),
('23', '桥头');

-- --------------------------------------------------------

--
-- 表的结构 `d_city`
--

CREATE TABLE IF NOT EXISTS `d_city` (
  `city_dm` varchar(6) NOT NULL DEFAULT '' COMMENT '城市代码（6位国标）',
  `city_mc` varchar(50) DEFAULT NULL COMMENT '城市名称',
  PRIMARY KEY (`city_dm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `d_city`
--

INSERT INTO `d_city` (`city_dm`, `city_mc`) VALUES
('330000', '浙江省'),
('330100', '杭州市'),
('330101', '市辖区'),
('330102', '上城区'),
('330103', '下城区'),
('330104', '江干区'),
('330105', '拱墅区'),
('330106', '西湖区'),
('330108', '滨江区');

-- --------------------------------------------------------

--
-- 表的结构 `d_shop_type`
--

CREATE TABLE IF NOT EXISTS `d_shop_type` (
  `type_dm` varchar(3) NOT NULL DEFAULT '' COMMENT '类别代码',
  `type_mc` varchar(50) DEFAULT NULL COMMENT '类别名称',
  `type_sm` varchar(50) DEFAULT NULL COMMENT '类别说明',
  `type_img` varchar(50) DEFAULT NULL COMMENT '类别图标',
  PRIMARY KEY (`type_dm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `d_shop_type`
--

INSERT INTO `d_shop_type` (`type_dm`, `type_mc`, `type_sm`, `type_img`) VALUES
('A00', '衣', '衣物饰品', NULL),
('A10', '综合', NULL, NULL),
('A11', '男装', NULL, NULL),
('A12', '女装', NULL, NULL),
('A13', '童装', NULL, NULL),
('A20', '内衣', NULL, NULL),
('A30', '鞋袜', NULL, NULL),
('A40', '箱包', NULL, NULL),
('A50', '饰品', NULL, NULL),
('A60', '衣物服务', '洗衣、裁剪等', NULL),
('B00', '食', '饮食', NULL),
('B10', '综合', '大中型餐饮店', NULL),
('B11', '中餐', '小炒类', NULL),
('B12', '中式快餐', NULL, NULL),
('B13', '面食', NULL, NULL),
('B14', '火锅', '砂锅火锅类', NULL),
('B20', '西餐', NULL, NULL),
('B21', '西式快餐', '麦肯必等', NULL),
('B22', '西式正餐', '牛排等', NULL),
('B23', '日本料理', NULL, NULL),
('B24', '韩国料理', NULL, NULL),
('B30', '饮品', NULL, NULL),
('B31', '奶茶店', NULL, NULL),
('B32', '饮料、酒', NULL, NULL),
('B40', '特产类', '茶叶、山货、糕点等', NULL),
('B41', '茶叶', NULL, NULL),
('B42', '山货', NULL, NULL),
('B43', '糕点', NULL, NULL),
('B50', '零食类', NULL, NULL),
('B60', '食材类', NULL, NULL),
('B61', '综合菜场', NULL, NULL),
('B62', '调味品类', NULL, NULL),
('B63', '海鲜类', NULL, NULL),
('C00', '住', NULL, NULL),
('C10', '酒店饭店', '大中型住宿为主', NULL),
('C20', '旅馆', NULL, NULL),
('C21', '连锁旅馆', NULL, NULL),
('C22', '招待所', NULL, NULL),
('C23', '农家乐', NULL, NULL),
('C30', '房产中介类', NULL, NULL),
('C31', '房产中介', NULL, NULL),
('C32', '售楼处', NULL, NULL),
('C40', '装修服务', NULL, NULL),
('C41', '建材', NULL, NULL),
('C42', '家具', NULL, NULL),
('D00', '行', NULL, NULL),
('D10', '公共交通类', NULL, NULL),
('D11', '公交相关', NULL, NULL),
('D12', '地铁相关', NULL, NULL),
('D13', '码头相关', NULL, NULL),
('D14', '火车相关', NULL, NULL),
('D15', '民航相关', NULL, NULL),
('D20', '汽车综合', '4S', NULL),
('D21', '售车', NULL, NULL),
('D22', '汽车修理', '保养', NULL),
('D23', '汽车服务', '洗车', NULL),
('D24', '汽车用品', NULL, NULL),
('D30', '自行车类', NULL, NULL),
('D31', '普通自行车', NULL, NULL),
('D32', '电动自行车', NULL, NULL),
('E00', '服', '服务', NULL),
('E10', '美容美发', NULL, NULL),
('E11', '理发店', NULL, NULL),
('E12', '美容店', NULL, NULL),
('E13', '美体店', NULL, NULL),
('E14', '美甲店', NULL, NULL),
('E20', '按摩推拿', NULL, NULL),
('E21', '足浴', NULL, NULL),
('E22', '按摩', NULL, NULL),
('E23', '盲人推拿', NULL, NULL),
('E30', '摄影', NULL, NULL),
('E31', '婚纱摄影', NULL, NULL),
('E32', '儿童摄影', NULL, NULL),
('E33', '普通摄影店', NULL, NULL),
('E40', '事务所', '技术服务类', NULL),
('E41', '律师', NULL, NULL),
('E42', '会计', '会计审计', NULL),
('E43', '专利', '知识产权', NULL),
('E50', '特殊服务类', NULL, NULL),
('E51', '婚庆类', NULL, NULL),
('E52', '白事类', NULL, NULL),
('F00', '乐', '娱乐', NULL),
('F10', '综合', NULL, NULL),
('F11', '酒吧', NULL, NULL),
('F12', 'KTV', NULL, NULL),
('F13', '舞厅', NULL, NULL),
('F20', '电玩', NULL, NULL),
('F30', '景点', NULL, NULL),
('F31', '免费公园', NULL, NULL),
('F32', '收费景点', NULL, NULL),
('G00', '用', '日用品', NULL),
('G10', '大超市', NULL, NULL),
('G11', '小超市', NULL, NULL),
('G12', '杂货店', NULL, NULL),
('G20', '专用工具类', NULL, NULL),
('G21', '工具', NULL, NULL),
('G22', '户外', NULL, NULL),
('G23', '登山', NULL, NULL),
('G24', '渔具', NULL, NULL),
('G28', '孕产妇', NULL, NULL),
('G29', '婴幼儿', NULL, NULL),
('H00', '文', '文化教育类', NULL),
('H10', '学校', NULL, NULL),
('H11', '大学', NULL, NULL),
('H12', '中学', NULL, NULL),
('H13', '小学', NULL, NULL),
('H14', '幼儿园', NULL, NULL),
('H15', '科研院所', NULL, NULL),
('H20', '社会培训', NULL, NULL),
('H21', '早教班', NULL, NULL),
('H22', '功课辅导', NULL, NULL),
('H23', '文体艺术班', NULL, NULL),
('H26', '考试、技能培训班', NULL, NULL),
('H27', '驾校', NULL, NULL),
('H30', '图书', NULL, NULL),
('H31', '小书店', NULL, NULL),
('H32', '文体用品', NULL, NULL),
('H40', '印刷广告等', NULL, NULL),
('H41', '文印', NULL, NULL),
('H42', '广告字牌印章', NULL, NULL),
('I00', '医', NULL, NULL),
('I10', '综合性医院', NULL, NULL),
('I11', '专科医院', NULL, NULL),
('I12', '小诊所', NULL, NULL),
('I20', '药店', NULL, NULL),
('I30', '宠物诊所', NULL, NULL),
('J00', '电', '电子电器', NULL),
('J10', '家电卖场', NULL, NULL),
('J20', '通讯类', NULL, NULL),
('J30', '家电修理', NULL, NULL),
('K00', '公', '公共服务', NULL),
('K10', '党政军部门', NULL, NULL),
('K20', '行政服务', '政府、工商、社保等', NULL),
('K30', '公用服务', '水、电、气、通讯、电视、邮政', NULL),
('K31', '中国移动服务厅', NULL, NULL),
('K32', '中国联通服务厅', NULL, NULL),
('K33', '中国电信服务厅', NULL, NULL),
('K34', '有线电视服务厅', NULL, NULL),
('K35', '中国邮政', NULL, NULL),
('K40', '银行', '人行', NULL),
('K41', '工行', NULL, NULL),
('K42', '建行', NULL, NULL),
('K43', '农行', NULL, NULL),
('K44', '其它银行', NULL, NULL),
('K45', 'ATM', NULL, NULL),
('K50', '证券金融', NULL, NULL),
('K51', '典当', NULL, NULL),
('K52', '彩票', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `d_streettype`
--

CREATE TABLE IF NOT EXISTS `d_streettype` (
  `stypedm` varchar(1) DEFAULT NULL,
  `stypemc` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `d_streettype`
--

INSERT INTO `d_streettype` (`stypedm`, `stypemc`) VALUES
('0', '普通'),
('1', '步行街'),
('2', '历史街'),
('3', '仿古街'),
('4', '风景街');

-- --------------------------------------------------------

--
-- 表的结构 `preferential`
--

CREATE TABLE IF NOT EXISTS `preferential` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` varchar(50) NOT NULL COMMENT '店主用户',
  `intro` varchar(150) NOT NULL COMMENT '优惠信息',
  `publish_time` datetime NOT NULL COMMENT '发布时间',
  `period_start` date NOT NULL COMMENT '优惠时间段开始时间',
  `period_end` date NOT NULL COMMENT '优惠时间段结束时间',
  `discount` int(11) NOT NULL COMMENT '优惠力度',
  `p_content` text NOT NULL COMMENT '优惠内容',
  `shop_id` varchar(50) NOT NULL COMMENT '认领店铺id',
  `expired` int(1) NOT NULL COMMENT '是否过期，1表示过期，0表示没过期',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `preferential`
--

INSERT INTO `preferential` (`id`, `owner`, `intro`, `publish_time`, `period_start`, `period_end`, `discount`, `p_content`, `shop_id`, `expired`) VALUES
(1, 'admin', '10元优惠券', '2015-06-01 00:00:00', '2015-06-01', '2015-06-30', 5, '凡是在这优惠时间段进入本店消费将享受该优惠，而且还有抽奖活动', '3301011002010000020001', 0),
(2, 'admin', '本店所有东西打8折', '2015-06-01 00:00:00', '2015-06-01', '2015-06-30', 5, '凡是在这优惠时间段进入本店将享受8折优惠凡是在这优惠时间段进入本店消费将享受该优惠，而且还有抽奖活动凡是在这优惠时间段进入本店消费将享受该优惠，而且还有抽奖活动凡是在这优惠时间段进入本店消费将享受该优惠，而且还有抽奖活动凡是在这优惠时间段进入本店消费将享受该优惠，而且还有抽奖活动凡是在这优惠时间段进入本店消费将享受该优惠，而且还有抽奖活动凡是在这优惠时间段进入本店消费将享受该优惠，而且还有抽奖活动凡是', '3301011002010000020004', 0),
(3, 'admin', '购买本店东西满50返5', '2015-06-01 00:00:00', '2015-06-03', '2015-06-13', 6, '凡是在这优惠时间段进入本店将享受满50返5优惠', '3301011002010000020019', 0),
(4, 'admin', '本店所有东西打8折', '2015-06-01 00:00:00', '2015-06-01', '2015-06-30', 5, '凡是在这优惠时间段进入本店将享受8折优惠', '3301011002010000020018', 0),
(5, 'admin', '本店所有东西打8折', '2015-06-01 00:00:00', '2015-06-01', '2015-06-30', 5, '凡是在这优惠时间段进入本店将享受8折优惠', '3301011002010000020016', 0),
(6, 'admin', '10元优惠券', '2015-06-01 00:00:00', '2015-06-01', '2015-06-30', 5, '凡是在这优惠时间段进入本店消费将享受该优惠，而且还有抽奖活动凡是在这优惠时间段进入本店消费将享受该优惠，而且还有抽奖活动凡是在这优惠时间段进入本店消费将享受该优惠，而且还有抽奖活动凡是在这优惠时间段进入本店消费将享受该优惠，而且还有抽奖活动凡是', '3301011002010000020020', 0),
(7, 'admin', '10元优惠券', '2015-06-01 00:00:00', '2015-06-01', '2015-06-30', 5, '凡是在这优惠时间段进入本店消费将享受该优惠，而且还有抽奖活动', '3301011002010000020022', 0),
(8, 'admin', '全场75折', '2015-06-13 00:00:00', '2015-06-15', '2015-07-15', 7, '再优惠期间进入本店者，将享受75折优惠，不仅如此，还有小礼品相送，赶紧行动起来吧！！！', '3301041002020000010004', 0),
(9, 'admin', '全场75折', '2015-06-13 00:00:00', '2015-06-15', '2015-07-15', 7, '再优惠期间进入本店者，将享受75折优惠，不仅如此，还有小礼品相送，赶紧行动起来吧！！！', '3301041002020000010004', 0);

-- --------------------------------------------------------

--
-- 表的结构 `relations`
--

CREATE TABLE IF NOT EXISTS `relations` (
  `id` int(11) NOT NULL,
  `street_dm` varchar(255) DEFAULT NULL,
  `street_cdm` varchar(255) DEFAULT NULL,
  `street_mc` varchar(255) DEFAULT NULL,
  `direction` int(11) DEFAULT NULL,
  `stype` int(11) DEFAULT NULL,
  `speed` tinyint(3) DEFAULT NULL,
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `relations`
--

INSERT INTO `relations` (`id`, `street_dm`, `street_cdm`, `street_mc`, `direction`, `stype`, `speed`, `content`) VALUES
(1, '3301040001', '01', '高沙段', 0, 0, 50, '{"building":[{"building_dm":"330104000101000001","building_mc":"高沙文渊大厦","type":"0","location":"1","space":5,"direction":6,"order":2,"shop":[{"shop_dm":"3301040001010000010001","type":"E11","type_mc":"理发店"},{"shop_dm":"3301040001010000010002","type":"F11","type_mc":"飞龙网吧"},{"shop_dm":"3301040001010000010003","type":"K31","type_mc":"中国移动服务厅"},{"shop_dm":"3301040001010000010004","type":"B11","type_mc":"茶餐厅"},{"shop_dm":"3301040001010000010005","type":"B30","type_mc":"饮品"}]},{"building_dm":"330104000101000002","building_mc":"路口","type":"21","location":"","space":5,"direction":6,"order":1,"shop":[{"shop_dm":"3301040001010000020001","type":"21","type_mc":"路口"}]},{"building_dm":"330104000101000003","building_mc":"高沙公寓","type":"0","location":"1","space":5,"direction":4,"order":2,"shop":[{"shop_dm":"3301040001010000030001","type":"A50","type_mc":"饰品"},{"shop_dm":"3301040001010000030002","type":"A12","type_mc":"女装"},{"shop_dm":"3301040001010000030003","type":"B32","type_mc":"饮料、酒"},{"shop_dm":"3301040001010000030004","type":"B31","type_mc":"奶茶店"},{"shop_dm":"3301040001010000030005","type":"A12","type_mc":"女装"},{"shop_dm":"3301040001010000030006","type":"A12","type_mc":"女装"},{"shop_dm":"3301040001010000030007","type":"E12","type_mc":"美容店"}]},{"building_dm":"330104000101000004","building_mc":"路口","type":"21","location":"","space":5,"direction":4,"order":1,"shop":[{"shop_dm":"3301040001010000040001","type":"21","type_mc":"路口"}]},{"building_dm":"330104000101000005","building_mc":"文渊路口","type":"21","location":"330104100201","space":5,"direction":4,"order":3,"shop":[]},{"building_dm":"330104000101000006","building_mc":"文渊路口","type":"21","location":"330104100202","space":5,"direction":6,"order":3,"shop":[]}]}'),
(2, '3301040001', '02', '文渊路与文泽路段', 0, 0, 50, '{"building":[{"building_dm":"330104000102000001","building_mc":"杭州电子科技大学体育馆","type":"1","location":"3","space":4,"direction":4,"order":2,"shop":[{"shop_dm":"3301040001020000010001","type":"1","type_mc":"独栋"}]},{"building_dm":"330104000102000002","building_mc":"杭州电子科技大学校区北二门","type":"12","location":"1","space":5,"direction":4,"order":3,"shop":[{"shop_dm":"3301040001020000020001","type":"12","type_mc":"伸缩门"}]},{"building_dm":"330104000102000003","building_mc":"杭州电子科技大学体育场","type":"1","location":"3","space":5,"direction":6,"order":2,"shop":[{"shop_dm":"3301040001020000030001","type":"1","type_mc":"独栋"}]},{"building_dm":"330104000102000004","building_mc":"空地","type":"31","location":"1","space":5,"direction":6,"order":3,"shop":[{"shop_dm":"3301040001020000040001","type":"31","type_mc":"空地"}]},{"building_dm":"330104000102000005","building_mc":"杭州电子科技大学生活区南二门","type":"11","location":"1","space":5,"direction":6,"order":4,"shop":[{"shop_dm":"3301040001020000050001","type":"11","type_mc":"普通开门"}]},{"building_dm":"330104000102000006","building_mc":"空地","type":"31","location":"1","space":5,"direction":4,"order":4,"shop":[{"shop_dm":"3301040001020000060001","type":"31","type_mc":"空地"}]},{"building_dm":"330104000102000007","building_mc":"空地","type":"31","location":"1","space":5,"direction":6,"order":5,"shop":[{"shop_dm":"3301040001020000070001","type":"31","type_mc":"空地"}]},{"building_dm":"330104000102000008","building_mc":"空地","type":"31","location":"1","space":5,"direction":4,"order":5,"shop":[{"shop_dm":"3301040001020000080001","type":"31","type_mc":"空地"}]},{"building_dm":"330104000102000009","building_mc":"杭电学生公寓","type":"0","location":"2","space":5,"direction":6,"order":9,"shop":[{"shop_dm":"3301040001020000090001","type":"J00","type_mc":"电"},{"shop_dm":"3301040001020000090002","type":"J00","type_mc":"电"},{"shop_dm":"3301040001020000090003","type":"B31","type_mc":"奶茶店"},{"shop_dm":"3301040001020000090004","type":"G11","type_mc":"小超市"},{"shop_dm":"3301040001020000090005","type":"B00","type_mc":"食"},{"shop_dm":"3301040001020000090006","type":"H32","type_mc":"文体用品"},{"shop_dm":"3301040001020000090007","type":"G00","type_mc":"用"},{"shop_dm":"3301040001020000090008","type":"H41","type_mc":"文印"},{"shop_dm":"3301040001020000090009","type":"B30","type_mc":"饮品"}]},{"building_dm":"330104000102000010","building_mc":"空地","type":"31","location":"1","space":5,"direction":4,"order":9,"shop":[{"shop_dm":"3301040001020000100001","type":"31","type_mc":"空地"}]},{"building_dm":"330104000102000011","building_mc":"杭电学生生活区南一门","type":"11","location":"1","space":5,"direction":6,"order":7,"shop":[{"shop_dm":"3301040001020000110001","type":"11","type_mc":"普通开门"}]},{"building_dm":"330104000102000012","building_mc":"杭电校区北一门","type":"12","location":"1","space":5,"direction":4,"order":7,"shop":[{"shop_dm":"3301040001020000120001","type":"12","type_mc":"伸缩门"}]},{"building_dm":"330104000102000013","building_mc":"空地","type":"31","location":"1","space":5,"direction":6,"order":8,"shop":[{"shop_dm":"3301040001020000130001","type":"31","type_mc":"空地"}]},{"building_dm":"330104000102000014","building_mc":"空地","type":"31","location":"1","space":5,"direction":4,"order":8,"shop":[{"shop_dm":"3301040001020000140001","type":"31","type_mc":"空地"}]},{"building_dm":"330104000102000015","building_mc":"福雷德支路路口","type":"21","location":"1","space":5,"direction":6,"order":9,"shop":[{"shop_dm":"3301040001020000150001","type":"21","type_mc":"路口"}]},{"building_dm":"330104000102000016","building_mc":"福雷德","type":"1","location":"1","space":3,"direction":6,"order":10,"shop":[{"shop_dm":"3301040001020000160001","type":"K41","type_mc":"工行"},{"shop_dm":"3301040001020000160002","type":"B20","type_mc":"西餐"},{"shop_dm":"3301040001020000160003","type":"G00","type_mc":"用"},{"shop_dm":"3301040001020000160004","type":"B00","type_mc":"食"},{"shop_dm":"3301040001020000160005","type":"B21","type_mc":"西式快餐"},{"shop_dm":"3301040001020000160006","type":"B21","type_mc":"西式快餐"}]},{"building_dm":"330104000102000017","building_mc":"空地","type":"31","location":"1","space":5,"direction":4,"order":10,"shop":[{"shop_dm":"3301040001020000170001","type":"31","type_mc":"空地"}]},{"building_dm":"330104000102000018","building_mc":"文渊路口","type":"21","location":"330104100201","space":5,"direction":4,"order":1,"shop":[]},{"building_dm":"330104000102000019","building_mc":"文渊路口","type":"21","location":"330104100202","space":5,"direction":6,"order":1,"shop":[]},{"building_dm":"330104000102000020","building_mc":"文泽路口","type":"21","location":"","space":5,"direction":4,"order":11,"shop":[]},{"building_dm":"330104000102000021","building_mc":"文泽路口","type":"21","location":"","space":5,"direction":6,"order":11,"shop":[]}]}'),
(3, '3301041002', '01', '学林街与二号大街段', 1, 0, 40, '{"building":[{"building_dm":"330104100201000001","building_mc":"杭州电子科技大学体育馆","type":"1","location":"2","space":4,"direction":3,"order":1,"shop":[{"shop_dm":"3301041002010000010001","type":"1","type_mc":"独栋"}]},{"building_dm":"330104100201000002","building_mc":"高沙公寓","type":"0","location":"2","space":1,"direction":5,"order":1,"shop":[{"shop_dm":"3301041002010000020001","type":"A50","type_mc":"饰品"},{"shop_dm":"3301041002010000020002","type":"B00","type_mc":"食"},{"shop_dm":"3301041002010000020003","type":"B00","type_mc":"食"},{"shop_dm":"3301041002010000020004","type":"G11","type_mc":"小超市"},{"shop_dm":"3301041002010000020005","type":"A00","type_mc":"衣"},{"shop_dm":"3301041002010000020006","type":"A00","type_mc":"衣"},{"shop_dm":"3301041002010000020007","type":"K40","type_mc":"银行"},{"shop_dm":"3301041002010000020008","type":"F00","type_mc":"乐"},{"shop_dm":"3301041002010000020009","type":"K45","type_mc":"ATM"},{"shop_dm":"3301041002010000020010","type":"A00","type_mc":"衣"},{"shop_dm":"3301041002010000020011","type":"A12","type_mc":"女装"},{"shop_dm":"3301041002010000020012","type":"A20","type_mc":"内衣"},{"shop_dm":"3301041002010000020013","type":"A12","type_mc":"女装"},{"shop_dm":"3301041002010000020014","type":"F00","type_mc":"乐"},{"shop_dm":"3301041002010000020015","type":"G00","type_mc":"用"},{"shop_dm":"3301041002010000020016","type":"G00","type_mc":"用"},{"shop_dm":"3301041002010000020017","type":"F00","type_mc":"乐"},{"shop_dm":"3301041002010000020018","type":"A00","type_mc":"衣"},{"shop_dm":"3301041002010000020019","type":"A30","type_mc":"鞋袜"},{"shop_dm":"3301041002010000020020","type":"K52","type_mc":"彩票"},{"shop_dm":"3301041002010000020021","type":"A12","type_mc":"女装"},{"shop_dm":"3301041002010000020022","type":"A30","type_mc":"鞋袜"},{"shop_dm":"3301041002010000020023","type":"F00","type_mc":"乐"},{"shop_dm":"3301041002010000020024","type":"A12","type_mc":"女装"}]},{"building_dm":"330104100201000003","building_mc":"学林街路口","type":"21","location":"330104000101","space":5,"direction":5,"order":2,"shop":[]},{"building_dm":"330104100201000004","building_mc":"学林街路口","type":"21","location":"330104000102","space":5,"direction":3,"order":2,"shop":[]}]}'),
(4, '3301041002', '02', '学林街与学源街段', 1, 0, 40, '{"building":[{"building_dm":"330104100202000001","building_mc":"高沙文渊大厦","type":"0","location":"2","space":1,"direction":5,"order":1,"shop":[{"shop_dm":"3301041002020000010001","type":"B11","type_mc":"中餐"},{"shop_dm":"3301041002020000010002","type":"B11","type_mc":"中餐"},{"shop_dm":"3301041002020000010003","type":"K41","type_mc":"工行"},{"shop_dm":"3301041002020000010004","type":"E11","type_mc":"理发店"}]},{"building_dm":"330104100202000002","building_mc":"学林街路口","type":"21","location":"330104000101","space":5,"direction":5,"order":2,"shop":[]},{"building_dm":"330104100202000003","building_mc":"学林街路口","type":"21","location":"330104000102","space":5,"direction":3,"order":1,"shop":[]}]}'),
(5, '3301040002', '01', '福雷德支路', 1, 0, 45, '{"building":[{"building_dm":"330104000201000001","building_mc":"福雷德支路杭电学生公寓","type":"0","location":"2","space":1,"direction":5,"order":2,"shop":[{"shop_dm":"3301040002010000010001","type":"K45","type_mc":"ATM"},{"shop_dm":"3301040002010000010002","type":"K31","type_mc":"中国移动服务厅"},{"shop_dm":"3301040002010000010003","type":"B50","type_mc":"零食类"},{"shop_dm":"3301040002010000010004","type":"E11","type_mc":"理发店"}]},{"building_dm":"330104000201000002","building_mc":"福雷德支路杭电学生公寓","type":"0","location":"2","space":1,"direction":5,"order":3,"shop":[{"shop_dm":"3301040002010000020001","type":"H41","type_mc":"文印"},{"shop_dm":"3301040002010000020002","type":"J00","type_mc":"电"},{"shop_dm":"3301040002010000020003","type":"J00","type_mc":"电"},{"shop_dm":"3301040002010000020004","type":"G11","type_mc":"小超市"}]},{"building_dm":"330104000201000003","building_mc":"杭州电子科技大学学生生活区东门","type":"11","location":"2","space":5,"direction":5,"order":4,"shop":[{"shop_dm":"3301040002010000030001","type":"11","type_mc":"普通开门"}]},{"building_dm":"330104000201000004","building_mc":"杭电学生公寓","type":"0","location":"2","space":1,"direction":5,"order":5,"shop":[{"shop_dm":"3301040002010000040001","type":"G00","type_mc":"用"},{"shop_dm":"3301040002010000040002","type":"B43","type_mc":"糕点"},{"shop_dm":"3301040002010000040003","type":"K33","type_mc":"中国电信服务厅"},{"shop_dm":"3301040002010000040004","type":"H26","type_mc":"考试、技能培训班"},{"shop_dm":"3301040002010000040005","type":"G00","type_mc":"用"}]},{"building_dm":"330104000201000005","building_mc":"福雷德小区","type":"0","location":"1","space":5,"direction":3,"order":5,"shop":[{"shop_dm":"3301040002010000050001","type":"B00","type_mc":"食"},{"shop_dm":"3301040002010000050002","type":"G00","type_mc":"用"},{"shop_dm":"3301040002010000050003","type":"B50","type_mc":"零食类"}]},{"building_dm":"330104000201000006","building_mc":"路口","type":"21","location":"1","space":5,"direction":3,"order":4,"shop":[{"shop_dm":"3301040002010000060001","type":"21","type_mc":"路口"}]},{"building_dm":"330104000201000007","building_mc":"空地","type":"31","location":"1","space":5,"direction":3,"order":3,"shop":[{"shop_dm":"3301040002010000070001","type":"31","type_mc":"空地"}]},{"building_dm":"330104000201000008","building_mc":"福雷德","type":"1","location":"2","space":1,"direction":3,"order":2,"shop":[{"shop_dm":"3301040002010000080001","type":"F00","type_mc":"乐"}]},{"building_dm":"330104000201000009","building_mc":"学林街路口","type":"1","location":"330104000102","space":1,"direction":5,"order":1,"shop":[]},{"building_dm":"330104000201000010","building_mc":"学林街路口","type":"1","location":"330104000102","space":1,"direction":3,"order":1,"shop":[]}]}'),
(6, '3301041002', '00', '学渊路', 1, 0, 40, NULL),
(7, '3301040001', '00', '学林街', 0, 0, 50, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `file` int(11) DEFAULT NULL,
  `city` varchar(6) DEFAULT NULL,
  `street` varchar(5) DEFAULT NULL,
  `block` varchar(2) DEFAULT NULL,
  `building` varchar(3) DEFAULT NULL,
  `shop` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `setting`
--

INSERT INTO `setting` (`id`, `dir`, `file`, `city`, `street`, `block`, `building`, `shop`) VALUES
(1, 'D:My Documents桌面desktop2014-11-05sony', 8, '330108', '01', '02', '123', '32');

-- --------------------------------------------------------

--
-- 表的结构 `shop`
--

CREATE TABLE IF NOT EXISTS `shop` (
  `shop_dm` varchar(50) NOT NULL DEFAULT '' COMMENT '店铺代码',
  `shop_mc` varchar(50) DEFAULT NULL COMMENT '店铺名称',
  `keywords` varchar(255) DEFAULT NULL COMMENT '店铺搜索关键字',
  `type` varchar(50) DEFAULT NULL COMMENT '类型（指向类型表）',
  `building` varchar(50) DEFAULT NULL COMMENT '所属建筑物（指向建筑物表）',
  `address` varchar(50) DEFAULT NULL COMMENT '地址',
  `doorplate` varchar(50) DEFAULT NULL COMMENT '门牌号（多个连续用~连接451~459，子门牌号用-连接 296-2）',
  `telno` varchar(50) DEFAULT NULL COMMENT '电话号码（多个用逗号分隔）',
  `shop_state` int(1) NOT NULL DEFAULT '0' COMMENT '店铺状态：0正常营业、',
  `enviro_support` char(8) NOT NULL DEFAULT '000' COMMENT '环境支持',
  `sever_support` char(11) NOT NULL DEFAULT '00000' COMMENT '服务支持',
  `chains` varchar(50) DEFAULT NULL COMMENT '连锁店（默认0表示非连锁，否则指向连锁店代码）',
  `intro` varchar(250) DEFAULT NULL COMMENT '简介',
  `photos` varchar(50) DEFAULT NULL COMMENT '照片路径（可多个，逗号分隔,第一个为主）',
  `ico` varchar(50) DEFAULT NULL COMMENT '店铺图标',
  `stime` datetime DEFAULT NULL COMMENT '信息采集时间',
  `author` varchar(50) DEFAULT NULL COMMENT '信息采集人',
  `admin` varchar(50) DEFAULT NULL COMMENT '信息管理员',
  `expired` tinyint(1) NOT NULL COMMENT '是否过期，默认否表示未过期',
  PRIMARY KEY (`shop_dm`),
  KEY `keywords` (`keywords`),
  KEY `shoptype` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop`
--

INSERT INTO `shop` (`shop_dm`, `shop_mc`, `keywords`, `type`, `building`, `address`, `doorplate`, `telno`, `shop_state`, `enviro_support`, `sever_support`, `chains`, `intro`, `photos`, `ico`, `stime`, `author`, `admin`, `expired`) VALUES
('3301011002010000020001', '么么兔礼品店', '么么兔', 'A50', '330101100201000002', '文渊路与学林街路口高沙公寓一层', '201', NULL, 0, '111', '11111', '0', NULL, '57odhoubip.jpeg', NULL, '2001-02-03 04:05:06', NULL, NULL, 0),
('3301011002010000020002', '一品红果业', '一品红', 'B11', '330101100201000002', '文渊路与学林街路口高沙公寓一层', '199', '13067823505', 0, '0', '0', '0', NULL, 's9j6t350u8.jpeg', NULL, '2001-02-03 04:05:06', NULL, NULL, 0),
('3301011002010000020003', '顶尚迷宗蟹', '蟹', 'B11', '330101100201000002', '文渊路与学林街路口高沙公寓二层', '197', '', 0, '0', '0', '0', '', 'rhhfwwoijc.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020004', '蓝天超市', '蓝天超市', 'G11', '330101100201000002', '文渊路与学林街路口高沙公寓一层', '193', '', 0, '0', '0', '0', '', '57odhoubip.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020005', 'JUST MODE', '', 'A11', '330101100201000002', '文渊路与学林街路口高沙公寓一层', '189', '', 0, '0', '0', '0', '', 'hvagmjrolg.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('33010110020100000200054', '豆豆网咖', '', 'F11', '330101100201000006', '文渊路高沙公寓一层', '175', '382738278', 0, '0', '0', '0', '', 'tsk27d3wuh.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('33010110020100000200055', '顶尚迷宗蟹', '蟹', 'B11', '330101100201000006', '文渊路与学林街路口高沙公寓二层', '197', '1837392223', 0, '0', '0', '0', '', 'rhhfwwoijc.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020006', 'EGOU', NULL, 'A11', '330101100201000002', '文渊路高沙公寓一层', '187', NULL, 0, '0', '0', '0', NULL, '7vklwkmq4k.jpeg', NULL, '2001-02-03 04:05:06', NULL, NULL, 0),
('3301011002010000020007', '杭州联合银行', '银行', 'K40', '330101100201000002', '文渊路高沙公寓一层', '183', '', 0, '0', '0', '0', '', 'rykgh4fhnl.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020008', '豆豆网咖', '', 'F11', '330101100201000002', '文渊路高沙公寓一层', '175', '', 0, '0', '0', '0', '', 'tsk27d3wuh.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020009', '渤海银行', '', 'K45', '330101100201000002', '文渊路高沙公寓一层', '175', '', 0, '0', '0', '0', '', '5je6fqscer.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020010', 'jeni SEVEN', '', 'A11', '330101100201000002', '文渊路高沙公寓一层', '173', '', 0, '0', '0', '0', '', 'xg023pg4qy.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020016', '宝岛眼镜', '', 'G11', '330101100201000002', '文渊路高沙公寓一层', '159', '', 0, '0', '0', '0', '', 'sfl4bwfsnx.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020017', '顶尚网咖', '', 'F11', '330101100201000002', '文渊路高沙公寓一层', '153', '', 0, '0', '0', '0', '', 'ga62sxmecs.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020018', '牡丹阁', '', 'A11', '330101100201000002', '文渊路高沙公寓一层', '151', '', 0, '0', '0', '0', '', 'de7cja9vot.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020019', '珂卡芙', '', 'A30', '330101100201000002', '文渊路高沙公寓一层', '149', '', 0, '0', '0', '0', '', 'vbb165pvj7.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020020', '中国体育彩票', '', 'K52', '330101100201000002', '文渊路高沙公寓一层', '147', '', 0, '0', '0', '0', '', 'unqurp3d38.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020021', '卖乐优品', '', 'A12', '330101100201000002', '文渊路高沙公寓一层', '145', '', 0, '0', '0', '0', '', '07fv915r3p.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020022', '卓诗尼', '', 'A30', '330101100201000002', '文渊路高沙公寓一层', '', '', 0, '0', '0', '0', '', '5gd7mb2ek6', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020023', '天马网咖', '', 'F11', '330101100201000002', '文渊路高沙公寓一层', '', '', 0, '0', '0', '0', '', '90tcrs7txh', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020024', '名品汇', '', 'A12', '330101100201000002', '文渊路高沙公寓一层', '139', '', 0, '0', '0', '0', '', 'c7wjoipm00', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020050', '卖乐优品', '', 'A12', '330101100201000004', '文渊路高沙公寓一层', '145', '', 0, '0', '0', '0', '', '07fv915r3p', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020051', '卖乐优品', '', 'A12', '330101100201000004', '文渊路高沙公寓一层', '145', '', 0, '0', '0', '0', '', '07fv915r3p', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020052', '卖乐优品', '', 'A12', '330101100201000004', '文渊路高沙公寓一层', '145', '', 0, '0', '0', '0', '', '07fv915r3p', '', '2001-02-03 04:05:06', '', '', 0),
('3301011002010000020057', '中国体育彩票', '', 'K52', '30104000101000034', '文渊路高沙公寓一层', '147', '', 0, '0', '0', '0', '', 'unqurp3d38', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001010000010001', '边尼造型', '边尼', 'E11', '330104000101000001', '下沙高沙文渊大厦', '学林街', '18057195552', 0, '0', '0', '0', '', '', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001010000010002', '飞龙网吧', '飞龙', 'F11', '330104000101000001', '下沙高沙文渊大厦', '', '', 0, '0', '0', '0', '', 'cw67e7rc34.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001010000010003', '中国移动奥亨智能手机精品店', '奥亨手机', 'K31', '330104000101000001', '下沙高沙文渊大厦一层', '', '', 0, '0', '0', '0', '', '82mcvvjdp0.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001010000010004', 'cool seven茶餐厅', 'c7', 'B11', '330104000101000001', '下沙高沙文渊大厦一层', '1098', '', 0, '0', '0', '0', '', 'rd5qo5mb5w.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001010000010005', '85度C', '85度', 'B30', '330104000101000001', '下沙高沙文渊大厦一层', '1096', '', 0, '0', '0', '0', '', 'b1gab83j10.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001010000010058', 'cool seven茶餐厅', 'c7', 'B30', '330104000101000034', '下沙高沙文渊大厦一层', '1098', '', 0, '0', '0', '0', '', 'rd5qo5mb5w.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001010000010059', '中国移动奥亨智能手机精品店', '奥亨手机', 'K31', '30104000101000034', '下沙高沙文渊大厦一层', '', '', 0, '0', '0', '0', '', '82mcvvjdp0.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001010000030001', '么么兔饰品店', '饰品店', 'A50', '330104000101000003', '文泽路与文渊路口高沙公寓一层', '1095', '', 0, '0', '0', '0', '', 'sdcg5tqmwv.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001010000030002', '闺蜜', '闺蜜', 'A12', '330104000101000003', '文泽路与文苑路口高沙公寓一层', '1097', '', 0, '0', '0', '0', '', '9lrwlt9da6.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001010000030003', '烟酒商行', '烟酒', 'B32', '330104000101000003', '文泽路与文渊路口高沙公寓一层', '1101', '', 0, '0', '0', '0', '', 'h6sckk0c0k.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001010000030004', '都可茶饮', '都可', 'B31', '330104000101000003', '文泽路与文渊路口高沙公寓一层', '1103', '', 0, '0', '0', '0', '', 'ay1586n8u4.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001010000030005', '秋水伊人', '秋水伊人', 'A12', '330104000101000003', '文泽路与文渊路口高沙公寓一层', '1105', '', 0, '0', '0', '0', '', '31umab6kbj.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('33010400010100000300053', '烟酒商行', '烟酒', 'B32', '330104000101000004', '文泽路与文渊路口高沙公寓一层', '1101', '', 0, '0', '0', '0', '', 'h6sckk0c0k.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001010000030006', '爱裳衣品', '爱裳衣品', 'A12', '330104000101000003', '文泽路与文渊路口高沙公寓一层', '1107', '', 0, '0', '0', '0', '', 'trmqq7888u.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001010000030007', '卡卡芭莎', '卡卡芭莎', 'E12', '330104000101000003', '文泽路与文渊路口高沙公寓一层', '', '', 0, '0', '0', '0', '', '157025wysh.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001020000090001', '苹果维修服务中心', '', 'J30', '330104000102000009', '学林街杭电学生公寓', '', '', 0, '0', '0', '0', '', '4fwshe65cp.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001020000090002', '联想', '', 'J30', '330104000102000009', '学林街杭电学生公寓', '', '', 0, '0', '0', '0', '', 'uhocpkydd2.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001020000090003', '意杯鲜饮', '', 'B31', '330104000102000009', '学林街杭电学生公寓', '', '', 0, '0', '0', '0', '', 'onl9qy4xit.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001020000090004', '老李超市', '', 'G11', '', '学林街杭电学生公寓', '', '13989843479', 0, '0', '0', '0', '', '8hjqmiyw73', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001020000090005', '曹华平水果果大卖场', '', 'B11', '330104000102000009', '学林街杭电学生公寓', '', '', 0, '0', '0', '0', '', 'e8v1p3v8a8', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001020000090006', '晨光文具', '', 'H32', '330104000102000009', '学林街杭电学生公寓', '', '', 0, '0', '0', '0', '', '5pgm9rexde', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001020000090007', '亮博眼睛', '', 'G11', '330104000102000009', '学林街杭电学生公寓', '', '', 0, '0', '0', '0', '', 'x7n85adqib', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001020000090008', '菲凡图文', '', 'H41', '330104000102000009', '学林街杭电学生公寓', '', '', 0, '0', '0', '0', '', 'xmp16u65is', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001020000090009', '世界茶饮', '', 'B30', '330104000102000009', '学林街杭电学生公寓', '', '', 0, '0', '0', '0', '', 'g7kwcejrlb', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001020000160001', '中国工商银行', '', 'K41', '330104000102000016', '', '', '', 0, '0', '0', '0', '', 'ijdqt13c3n', '', '2001-02-03 04:05:06', '', '', 0),
('3301040001020000160002', '两岸咖啡', '', 'B20', '330104000102000016', '', '1B05', '', 0, '0', '0', '0', '', '9439h65k4l.jpeg', '', '2001-02-03 04:05:06', '', '', 0),
('3301041002020000010001', '小商店', '', 'E11', '330104100202000001', '文渊路高沙文渊大厦', '205', '15355496612', 0, '1', '1', '0', '', 'CR-T.jpg,CR-2c.jpg', '', '2001-02-03 04:05:06', '', '', 0),
('3301041002020000010002', '饮品店', '', 'B11', '330104100202000001', '文渊路高沙文渊大厦', '207', '15355496612', 0, '111', '10001', '0', '', 'CR-T.jpg,CR-2c.jpg', '', '2001-02-03 04:05:06', '', '', 0),
('3301041002020000010003', '工商银行', '工行', 'k41', '330104100202000001', '文渊路高沙文渊大厦', '211', '15355496612', 0, '101', '11', '0', '', 'CR-T.jpg,CR-2c.jpg', '', '2001-02-03 04:05:06', '', '', 0),
('3301041002020000010004', '盖斯造型', 'SKY', 'E12', '330104100202000001', '文渊路高沙文渊大厦', '215', '15355496612', 0, '111', '11111', '1', '', 'CR-0.jpg,CR-LW.jpg,CR-cpL.jpg', '', '2001-02-03 04:05:06', '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `shopowner`
--

CREATE TABLE IF NOT EXISTS `shopowner` (
  `shop_id` varchar(50) NOT NULL COMMENT '店铺代码',
  `user_id` int(11) NOT NULL COMMENT '店主代码',
  `business_license` varchar(50) NOT NULL COMMENT '营业执照',
  `organization_code` varchar(50) NOT NULL COMMENT '组织结构代码证',
  `ownertime` date NOT NULL COMMENT '认领时间',
  `pass` int(1) NOT NULL DEFAULT '0' COMMENT '0表示没通过，1表示通过'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shopowner`
--

INSERT INTO `shopowner` (`shop_id`, `user_id`, `business_license`, `organization_code`, `ownertime`, `pass`) VALUES
('', 37, 'CR-f65lWq8iGa.png', 'CR-35FT9OdvbRU.png', '2015-06-06', 0),
('3301041002020000010004', 37, 'CR-MO0ytjFFmt.png', 'CR-kc005wJW5qY.png', '2015-06-06', 0),
('3301041002020000010004', 37, 'CR-JQcGUlgHLJ.png', 'CR-JQcGUlgHLJ8.png', '2015-06-06', 0),
('3301041002020000010004', 37, 'CR-4zvQEwEc9T.png', 'CR-Ah15y0R8KxJ.png', '2015-06-06', 0),
('3301041002020000010004', 37, 'CR-FYpCybhajo.png', 'CR-gNcVQwzeQHy.png', '2015-06-06', 0),
('3301041002020000010004', 37, 'CR-VtwBBvbB6g.png', 'CR-Ly0WFsIPmqK.png', '2015-06-06', 0),
('3301041002020000010004', 37, 'CR-lwxbeKM9nX.png', 'CR-BExDtECnxUh.png', '2015-06-06', 0),
('3301040001010000010005', 37, 'CR-OXVfHUR3J5.png', 'CR-OXVfHUR3J5U.png', '2015-06-07', 0),
('3301041002020000010003', 37, 'CR-JNzSrldBFM.png', 'CR-JNzSrldBFMi.png', '2015-06-07', 0),
('3301041002020000010001', 37, 'CR-tCERoFFfCU.png', 'CR-tCERoFFfCUR.png', '2015-06-07', 0),
('3301041002020000010003', 37, 'CR-Sn3vc6ojHd.png', 'CR-5zSsTtXObXi.png', '2015-06-07', 0),
('3301041002020000010004', 37, 'CR-4zvQEwEc9T.png', 'CR-Ah15y0R8KxJ.png', '2015-06-06', 1),
('3301041002020000010004', 37, 'CR-8ePTrVSgwQ.42.51.jpg', 'CR-nUSqWJpq2Vx.55.13.jpg', '2015-10-24', 0);

-- --------------------------------------------------------

--
-- 表的结构 `street`
--

CREATE TABLE IF NOT EXISTS `street` (
  `street_id` bigint(20) NOT NULL,
  `street_dm` varchar(10) DEFAULT NULL COMMENT '街道编码（4位）',
  `street_cdm` varchar(2) DEFAULT NULL COMMENT '街区编码（2位）（0表示街道，非0表示街区）',
  `street_mc` varchar(50) DEFAULT NULL COMMENT '街道街区名称',
  `keywords` varchar(255) DEFAULT NULL COMMENT '街道街区搜索关键字',
  `city_dm` varchar(6) DEFAULT NULL COMMENT '所属城市代码（6位国标）',
  `direction` tinyint(3) unsigned DEFAULT NULL COMMENT '方向（0东西，1南北;单行：2东、3南、4西、5北，街区可继承街道方向，也可设置自己的方向）',
  `stype` tinyint(3) unsigned DEFAULT '0' COMMENT '类型（默认0表示普通街道，其他:街道类型表）',
  `lane` tinyint(3) unsigned DEFAULT '0' COMMENT '车道数量（0表示步行街）',
  `speed` tinyint(3) unsigned DEFAULT '0' COMMENT '限速（公里）',
  `status` tinyint(3) unsigned DEFAULT NULL COMMENT '状态（0正常 1修路中不通 2修路中可通）',
  `photos` varchar(255) DEFAULT NULL COMMENT '照片路径（可多个，逗号分隔）',
  `stime` datetime DEFAULT NULL COMMENT '数据采集时间',
  `author` varchar(50) DEFAULT NULL COMMENT '数据采集员',
  `admin` varchar(50) DEFAULT NULL COMMENT '街道管理员',
  PRIMARY KEY (`street_id`),
  KEY `keywords` (`keywords`),
  KEY `streetcity_dm` (`city_dm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `street`
--

INSERT INTO `street` (`street_id`, `street_dm`, `street_cdm`, `street_mc`, `keywords`, `city_dm`, `direction`, `stype`, `lane`, `speed`, `status`, `photos`, `stime`, `author`, `admin`) VALUES
(1, '3301011001', '00', '文一路', NULL, '330101', 0, 0, 6, 50, NULL, NULL, NULL, NULL, NULL),
(2, '3301011001', '01', '文一路教工路至学院路街\r\n\r\n区', NULL, '330101', 0, 0, 6, 50, NULL, NULL, NULL, NULL, NULL),
(3, '3301011001', '02', '文一路学院路至古翠路街\r\n\r\n区', NULL, '330101', 0, 0, 6, 50, NULL, NULL, NULL, NULL, NULL),
(5, '3301021003', '00', '1', '2', '330102', 5, 0, 3, 4, NULL, '', '2014-11-04 00:39:05', 'aa', 'bb'),
(6, '3301081004', '00', '1', '2', '330108', 6, 3, 4, 5, 7, 'IGAKGBIN', '2014-11-04 00:41:30', 'aa', 'bb'),
(9, '3301011002', '00', '学林街', '学林', '330101', 1, 1, 1, 1, 1, '', '2014-12-13 01:02:03', '', ''),
(10, '3301011003', '00', '学源街', '学院', '330101', 0, 0, 0, 0, 0, '', '2014-12-13 01:02:03', '', ''),
(11, '3301011002', '01', '学林街一区', '一区', '330101', 0, 0, 0, 0, 0, '', '2014-12-13 01:02:03', '', ''),
(12, '3301011004', '00', '学源街', '学院', '330101', 0, 0, 0, 0, 0, '', '2014-12-13 01:02:03', '', ''),
(13, '3301011004', '01', '学源街二号区', '学院', '330101', 0, 0, 0, 0, 0, '', '2014-12-13 01:02:03', '', ''),
(14, '3301011005', '00', '学林街', '学林', '330101', 0, 0, 0, 0, 0, '', '2014-12-13 01:02:03', '', ''),
(15, '3301011002', '02', '学林街二区', '二区', '330101', 0, 0, 0, 0, 0, '', '2014-12-13 01:02:03', '', ''),
(16, '3301011002', '03', '学林街三区', '三区', '330101', 0, 0, 0, 0, 0, '', '2014-12-13 01:02:03', '', ''),
(17, '3301011007', '00', '学源街四区', '四区', '330101', 0, 0, 4, 60, 1, 'hcghuvwvxj', '2014-12-13 01:02:03', '', ''),
(18, '3301011007', '01', '学源街四区', '四区+', '330101', 0, 0, 4, 60, 1, '5briiqirox', '2014-12-13 01:02:03', '', ''),
(19, '3301011008', '00', '学源街', '学源街', '330101', 0, 0, 0, 60, 0, 'vq1j0a70i3', '2014-11-06 14:27:33', '', ''),
(20, '3301011009', '00', '二号路', '二号', '330101', 0, 1, 2, 4, 1, '2tnqiee60q', '2001-01-01 00:00:00', '', ''),
(21, '3301011009', '01', '二号路一区', '一区', '330101', 0, 1, 2, 4, 1, '4kx30golfv', '2014-12-13 01:02:03', '', ''),
(22, '3301011009', '02', '二号路一区', '一区', '330101', 0, 1, 2, 4, 1, '', '2014-12-13 01:02:03', '', ''),
(23, '3301011010', '00', '一号路', '一号路', '330101', 0, 0, 0, 60, 0, 'tfxwqqh3x1', '2014-11-06 14:27:33', '', ''),
(24, '3301011010', '01', '一号路一区', '一区', '330101', 0, 0, 0, 60, 0, 'sckvo7j02k', '2014-12-13 01:02:03', '', ''),
(25, '3301011011', '00', 'SKJDF', 'JK', '330101', 1, 2, 3, 5, 0, 'vec1k4xb5f', '2001-01-01 00:00:00', '', ''),
(26, '3301011011', '01', 'AAA', '', '330101', 1, 2, 3, 5, 0, 'yagn3qwide', '2014-12-13 01:02:03', '', ''),
(27, '3301011012', '00', '6豪杰', '', '330101', 0, 0, 4, 50, 0, 'lodyrkhh6s', '2014-11-06 14:27:33', '', ''),
(28, '3301011012', '01', '啊飒飒的', '', '330101', 0, 0, 4, 50, 0, '', '2014-12-13 01:02:03', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `support`
--

CREATE TABLE IF NOT EXISTS `support` (
  `sever_support` int(1) NOT NULL DEFAULT '0' COMMENT '服务支持'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `support`
--

INSERT INTO `support` (`sever_support`) VALUES
(1010),
(1101),
(10101),
(11111);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nicknames` varchar(50) NOT NULL COMMENT '昵称',
  `mail` varchar(50) NOT NULL COMMENT '邮箱',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `sex` int(1) NOT NULL COMMENT '性别0是男，1是女',
  `birthday` varchar(25) NOT NULL COMMENT '生日',
  `name` varchar(50) NOT NULL COMMENT '姓名',
  `professional` int(2) NOT NULL COMMENT '职业：0是其他，1是企业员工，2是事业单位员工，3是公务员，4是自由职业，5是全职太太，6是个人经商，7是教师，8是学生，9是待业',
  `cellphone` int(11) NOT NULL COMMENT '手机号',
  `identity_card` varchar(25) NOT NULL COMMENT '身份证号',
  `experience` int(50) NOT NULL COMMENT '经验',
  `intergral` int(50) NOT NULL COMMENT '积分',
  `u_type` int(1) NOT NULL COMMENT '用户类型（普通用户0、店家1）',
  `avatar` varchar(50) NOT NULL COMMENT '头像',
  `register_time` datetime NOT NULL COMMENT '注册日期',
  `token` varchar(50) NOT NULL COMMENT '账号激活码',
  `token_exptime` int(10) NOT NULL COMMENT '激活码有效期',
  `status` tinyint(1) NOT NULL COMMENT '状态、0-未激活、1-已激活',
  `regtime` int(10) NOT NULL COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `nicknames`, `mail`, `password`, `sex`, `birthday`, `name`, `professional`, `cellphone`, `identity_card`, `experience`, `intergral`, `u_type`, `avatar`, `register_time`, `token`, `token_exptime`, `status`, `regtime`) VALUES
(28, 'ymq', '2319087927@qq.com', 'e10adc3949ba59abbe56e057f20f883e', 0, '0000-00-00', '', 0, 0, '', 0, 0, 0, 'a.jpg', '0000-00-00 00:00:00', 'fd43e75d4107bf25a2f7d896f3a5dda3', 1432446139, 1, 1432359739),
(37, 'admin', '1161486206@qq.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '1993-10-10', '邹雅文', 8, 2147483647, '78997988273', 0, 0, 1, 'CR-TGVbC4f9hw.jpg', '0000-00-00 00:00:00', 'be0a84c6c374028d3d8b54ecf243056d', 1432465490, 1, 1432379090),
(54, 'zyw', '1254329686@qq.com', 'e10adc3949ba59abbe56e057f20f883e', 0, '', '', 0, 0, '', 0, 0, 0, '', '0000-00-00 00:00:00', '7cd4b484dc5520cfffba8802640ffe9a', 1443517083, 1, 1443430683);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
