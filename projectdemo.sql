/*
Navicat MySQL Data Transfer

Source Server         : test
Source Server Version : 50045
Source Host           : localhost:3306
Source Database       : projectdemo

Target Server Type    : MYSQL
Target Server Version : 50045
File Encoding         : 65001

Date: 2015-06-24 17:51:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for group_cart
-- ----------------------------
DROP TABLE IF EXISTS `group_cart`;
CREATE TABLE `group_cart` (
  `user_id` int(10) unsigned NOT NULL,
  `goods_id` int(10) unsigned NOT NULL COMMENT '购物车表',
  `goods_num` smallint(6) NOT NULL COMMENT '商品数',
  `cart_id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`cart_id`),
  KEY `fk_group_user_has_group_goods_group_goods4_idx` (`goods_id`),
  KEY `fk_group_user_has_group_goods_group_user4_idx` (`user_id`),
  CONSTRAINT `fk_group_user_has_group_goods_group_goods4` FOREIGN KEY (`goods_id`) REFERENCES `group_goods` (`gid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_group_user_has_group_goods_group_user4` FOREIGN KEY (`user_id`) REFERENCES `group_user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户购物车表';

-- ----------------------------
-- Table structure for group_category
-- ----------------------------
DROP TABLE IF EXISTS `group_category`;
CREATE TABLE `group_category` (
  `cid` smallint(5) unsigned NOT NULL auto_increment,
  `cname` char(20) NOT NULL default '' COMMENT '分类名称',
  `keywords` varchar(255) NOT NULL default '' COMMENT '分类关键字',
  `title` varchar(120) NOT NULL default '' COMMENT '分类标题',
  `description` varchar(255) NOT NULL default '' COMMENT '分类描述',
  `sort` smallint(5) unsigned NOT NULL COMMENT '排序',
  `display` tinyint(3) unsigned NOT NULL default '1' COMMENT '是否显示',
  `pid` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`cid`),
  UNIQUE KEY `cid_UNIQUE` (`cid`),
  UNIQUE KEY `cname_UNIQUE` (`cname`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
-- Table structure for group_collect
-- ----------------------------
DROP TABLE IF EXISTS `group_collect`;
CREATE TABLE `group_collect` (
  `goods_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  KEY `fk_group_goods_has_group_user_group_user1_idx` (`user_id`),
  KEY `fk_group_goods_has_group_user_group_goods1_idx` (`goods_id`),
  CONSTRAINT `fk_group_goods_has_group_user_group_goods1` FOREIGN KEY (`goods_id`) REFERENCES `group_goods` (`gid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_group_goods_has_group_user_group_user1` FOREIGN KEY (`user_id`) REFERENCES `group_user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户收藏表';

-- ----------------------------
-- Table structure for group_comment
-- ----------------------------
DROP TABLE IF EXISTS `group_comment`;
CREATE TABLE `group_comment` (
  `user_id` int(10) unsigned NOT NULL,
  `goods_id` int(10) unsigned NOT NULL,
  `time` int(11) NOT NULL COMMENT '评论时间',
  `content` varchar(255) NOT NULL COMMENT '评论内容',
  KEY `fk_group_user_has_group_goods_group_goods3_idx` (`goods_id`),
  KEY `fk_group_user_has_group_goods_group_user3_idx` (`user_id`),
  CONSTRAINT `fk_group_user_has_group_goods_group_goods3` FOREIGN KEY (`goods_id`) REFERENCES `group_goods` (`gid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_group_user_has_group_goods_group_user3` FOREIGN KEY (`user_id`) REFERENCES `group_user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户评论表';

-- ----------------------------
-- Table structure for group_goods
-- ----------------------------
DROP TABLE IF EXISTS `group_goods`;
CREATE TABLE `group_goods` (
  `gid` int(10) unsigned NOT NULL auto_increment COMMENT '商品主键',
  `shopid` smallint(5) unsigned NOT NULL,
  `cid` smallint(5) unsigned NOT NULL,
  `lid` smallint(5) unsigned NOT NULL,
  `main_title` varchar(30) NOT NULL default '' COMMENT '商品主标题',
  `sub_title` varchar(255) NOT NULL default '' COMMENT '商品副标题',
  `price` decimal(7,1) NOT NULL default '0.0' COMMENT '商品价格',
  `old_price` decimal(7,1) NOT NULL default '0.0' COMMENT '原价',
  `buy` smallint(6) NOT NULL default '0' COMMENT '购买人数',
  `goods_img` varchar(60) NOT NULL COMMENT '商品图',
  `begin_time` int(10) unsigned NOT NULL,
  `end_time` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`gid`),
  UNIQUE KEY `gid` (`gid`),
  KEY `fk_group_goods_group_shop_idx` (`shopid`),
  KEY `fk_group_goods_group_category1_idx` (`cid`),
  KEY `fk_group_goods_group_locality1_idx` (`lid`),
  CONSTRAINT `fk_group_goods_group_category1` FOREIGN KEY (`cid`) REFERENCES `group_category` (`cid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_group_goods_group_locality1` FOREIGN KEY (`lid`) REFERENCES `group_locality` (`lid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_group_goods_group_shop` FOREIGN KEY (`shopid`) REFERENCES `group_shop` (`shopid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Table structure for group_goods_detail
-- ----------------------------
DROP TABLE IF EXISTS `group_goods_detail`;
CREATE TABLE `group_goods_detail` (
  `goods_id` int(10) unsigned NOT NULL,
  `detail` text,
  `goods_server` varchar(60) NOT NULL,
  KEY `fk_table1_group_goods1_idx` (`goods_id`),
  CONSTRAINT `fk_table1_group_goods1` FOREIGN KEY (`goods_id`) REFERENCES `group_goods` (`gid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for group_locality
-- ----------------------------
DROP TABLE IF EXISTS `group_locality`;
CREATE TABLE `group_locality` (
  `lid` smallint(5) unsigned NOT NULL auto_increment,
  `lname` char(20) default '',
  `pid` smallint(5) unsigned default '0',
  `sort` smallint(5) unsigned default '0' COMMENT '排序',
  `display` tinyint(4) default '1' COMMENT '是否显示',
  PRIMARY KEY  (`lid`),
  UNIQUE KEY `lid_UNIQUE` (`lid`),
  UNIQUE KEY `lname_UNIQUE` (`lname`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='地区表';

-- ----------------------------
-- Table structure for group_open_bind
-- ----------------------------
DROP TABLE IF EXISTS `group_open_bind`;
CREATE TABLE `group_open_bind` (
  `user_id` int(10) unsigned NOT NULL,
  `openid` char(64) NOT NULL,
  `open_distinguish` tinyint(4) NOT NULL COMMENT '开发平台区别',
  `open_name` varchar(16) NOT NULL COMMENT '开发平台名称',
  UNIQUE KEY `openid_UNIQUE` (`openid`),
  KEY `fk_group_open_bind_group_user1_idx` (`user_id`),
  CONSTRAINT `fk_group_open_bind_group_user1` FOREIGN KEY (`user_id`) REFERENCES `group_user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='站点用户与开发平台绑定表';

-- ----------------------------
-- Table structure for group_order
-- ----------------------------
DROP TABLE IF EXISTS `group_order`;
CREATE TABLE `group_order` (
  `user_id` int(10) unsigned NOT NULL,
  `goods_id` int(10) unsigned NOT NULL default '0',
  `goods_num` smallint(6) unsigned NOT NULL,
  `orderid` int(10) unsigned NOT NULL auto_increment COMMENT '订单id',
  `total_money` smallint(6) NOT NULL COMMENT '总金额',
  `status` tinyint(1) default '0',
  PRIMARY KEY  (`orderid`),
  UNIQUE KEY `orderid_UNIQUE` (`orderid`),
  KEY `fk_group_user_has_group_goods_group_goods1_idx` (`goods_id`),
  KEY `fk_group_user_has_group_goods_group_user1_idx` (`user_id`),
  CONSTRAINT `fk_group_user_has_group_goods_group_goods1` FOREIGN KEY (`goods_id`) REFERENCES `group_goods` (`gid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_group_user_has_group_goods_group_user1` FOREIGN KEY (`user_id`) REFERENCES `group_user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COMMENT='用户订单表';

-- ----------------------------
-- Table structure for group_shop
-- ----------------------------
DROP TABLE IF EXISTS `group_shop`;
CREATE TABLE `group_shop` (
  `shopid` smallint(5) unsigned NOT NULL auto_increment,
  `shopname` varchar(30) NOT NULL default '' COMMENT '商品名称',
  `shopaddress` varchar(120) NOT NULL default '' COMMENT '商铺地址',
  `metroaddress` varchar(120) NOT NULL default '' COMMENT '地铁地址',
  `shoptel` char(12) NOT NULL COMMENT '商铺电话',
  `shopcoord` varchar(60) NOT NULL default '' COMMENT '商铺坐标',
  PRIMARY KEY  (`shopid`),
  UNIQUE KEY `shopid_UNIQUE` (`shopid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='商铺表';

-- ----------------------------
-- Table structure for group_user
-- ----------------------------
DROP TABLE IF EXISTS `group_user`;
CREATE TABLE `group_user` (
  `uid` int(10) unsigned NOT NULL auto_increment,
  `email` varchar(32) NOT NULL COMMENT '邮箱',
  `uname` char(16) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `phone` char(11) NOT NULL,
  PRIMARY KEY  (`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `uname_UNIQUE` (`uname`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for group_userinfo
-- ----------------------------
DROP TABLE IF EXISTS `group_userinfo`;
CREATE TABLE `group_userinfo` (
  `user_id` int(10) unsigned NOT NULL,
  `balance` smallint(6) NOT NULL COMMENT '余额',
  `integral` smallint(6) NOT NULL COMMENT '积分',
  KEY `fk_group_userinfo_group_user1_idx` (`user_id`),
  CONSTRAINT `fk_group_userinfo_group_user1` FOREIGN KEY (`user_id`) REFERENCES `group_user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户信息表,用于保存用户账户余额，积分等数据';

-- ----------------------------
-- Table structure for group_user_address
-- ----------------------------
DROP TABLE IF EXISTS `group_user_address`;
CREATE TABLE `group_user_address` (
  `addressid` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL,
  `consignee` char(20) NOT NULL,
  `city` char(20) NOT NULL COMMENT '市',
  `province` char(12) NOT NULL COMMENT '省',
  `county` char(12) NOT NULL COMMENT '县',
  `tel` char(12) NOT NULL,
  `street` varchar(120) NOT NULL COMMENT '街道地址',
  `postcode` char(10) NOT NULL,
  PRIMARY KEY  (`addressid`),
  KEY `fk_group_user_address_group_user1_idx` (`user_id`),
  CONSTRAINT `fk_group_user_address_group_user1` FOREIGN KEY (`user_id`) REFERENCES `group_user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='用户收货地址表，一个用户可以有多个收货地址';
