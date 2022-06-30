
-- -----------------------------
-- Table structure for `ad_admin`
-- -----------------------------
DROP TABLE IF EXISTS `ad_admin`;
CREATE TABLE `ad_admin` (
  `adminid` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '管理员用户名',
  `password` varchar(70) NOT NULL COMMENT '管理员密码',
  `email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `realname` varchar(10) DEFAULT NULL COMMENT '真实姓名',
  `tel` varchar(30) DEFAULT NULL COMMENT '电话号码',
  `loginip` varchar(40) DEFAULT NULL COMMENT '登录IP',
  `ipadress` varchar(50) DEFAULT NULL COMMENT '登录IP详细地址',
  `logintime` int(11) unsigned DEFAULT NULL COMMENT '上次登录时间',
  `loginnum` int(10) unsigned DEFAULT '0' COMMENT '登录次数',
  `ip` varchar(20) DEFAULT NULL COMMENT 'IP地址',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `is_open` tinyint(2) unsigned DEFAULT NULL COMMENT '审核状态',
  `avatar` varchar(120) DEFAULT '' COMMENT '头像',
  `salt` varchar(6) DEFAULT NULL COMMENT '随机字符串',
  `group_id` mediumint(8) DEFAULT NULL COMMENT '分组ID',
  PRIMARY KEY (`adminid`) USING BTREE,
  KEY `admin_username` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='后台管理员';

-- -----------------------------
-- Records of `ad_admin`
-- -----------------------------
INSERT INTO `ad_admin` VALUES ('1', 'admin', '5a36a37259270480e8f7f386b2e6402e', '1109305454@qq.com', '', '18792402229', '127.0.0.1', '本机地址', '1553303801', '164', '127.0.0.1', '1482132862', '1', '/uploads/admin/20190322/3ebd6f18bb9277177957df59cbb6512b.jpg', 'GF45EW', '1');
INSERT INTO `ad_admin` VALUES ('2', 'beauty', '31d0f226497b4fe940cf6d7a824cf4e8', '58545544@qq.com', '', '15698745947', '127.0.0.1', '本机地址', '1548311680', '1', '127.0.0.1', '1547345851', '1', '/uploads/20190113/1fa5738380ab2b4348eaf0210919e797.jpg', '6xDv8G', '2');
INSERT INTO `ad_admin` VALUES ('3', 'iii', 'b455a309296a0353ea63b5b5405a462e', '55', '', '55', '', '', '0', '0', '127.0.0.1', '1553243836', '1', '/uploads/admin/20190322/06358481d62f8984fcf0fd731777a111.png', 'P7CaWh', '3');
