/*
Navicat MySQL Data Transfer

Source Server         : 111
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : z

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2022-06-10 16:07:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ad_order`
-- ----------------------------
DROP TABLE IF EXISTS `ad_order`;
CREATE TABLE `ad_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `sf_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `isnot_vip` int(11) DEFAULT NULL,
  `xiagmu` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `yuanjia` varchar(255) DEFAULT NULL,
  `zk` float(100,2) DEFAULT NULL,
  `zh` float(100,2) DEFAULT NULL,
  `fk_time` varchar(255) DEFAULT NULL,
  `add_time` varchar(255) DEFAULT NULL,
  `tel` varchar(11) DEFAULT NULL,
  `add_time_sjc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ad_order
-- ----------------------------
INSERT INTO `ad_order` VALUES ('8', '张三', '1', '洗,剪,吹', '288', '0.60', '172.80', '2022-06-10', '2022-06-09 20:20:13', '18824863019', '1654828618');
INSERT INTO `ad_order` VALUES ('10', '张三', '1', '洗', '20', '0.60', '12.00', '2022-06-11', '2022-06-10 11:00:29', '18824863019', '1654830029');
INSERT INTO `ad_order` VALUES ('11', '张三', '0', '洗', '120', '0.00', '0.00', '2022-06-11', '2022-06-10 11:13:08', null, '1654830788');

-- ----------------------------
-- Table structure for `ad_vip`
-- ----------------------------
DROP TABLE IF EXISTS `ad_vip`;
CREATE TABLE `ad_vip` (
  `hyid` int(11) NOT NULL AUTO_INCREMENT,
  `tel` char(20) DEFAULT NULL,
  `money` decimal(18,2) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `discount` float(10,2) DEFAULT '0.00',
  `mima` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `date_sjc` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`hyid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ad_vip
-- ----------------------------
INSERT INTO `ad_vip` VALUES ('1', '18824863019', '35.20', '2022-06-10 11:00:29', '0.60', '111', null);
INSERT INTO `ad_vip` VALUES ('2', '1', null, '2022-06-09 11:16:43', '0.80', null, null);
INSERT INTO `ad_vip` VALUES ('3', '1', null, '2022-06-09 11:16:39', '0.50', null, null);
INSERT INTO `ad_vip` VALUES ('4', '1', null, '2022-06-09 11:16:32', '0.98', null, null);
INSERT INTO `ad_vip` VALUES ('5', '111', '2.00', '2022-06-10 10:52:06', '3.00', '111111111', '1654828618');
INSERT INTO `ad_vip` VALUES ('6', '22', '1.00', '2022-06-10 02:31:14', '2.00', '2', null);
