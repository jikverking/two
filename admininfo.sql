/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : admininfo

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-05-08 18:04:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ad_admin
-- ----------------------------
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
  `salt` varchar(6) NOT NULL COMMENT '随机字符串',
  `group_id` mediumint(8) DEFAULT NULL COMMENT '分组ID',
  PRIMARY KEY (`adminid`) USING BTREE,
  KEY `username` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='后台管理员';

-- ----------------------------
-- Records of ad_admin
-- ----------------------------
INSERT INTO `ad_admin` VALUES ('1', 'admin', '5a36a37259270480e8f7f386b2e6402e', '1109305454@qq.com', '', '18792402229', '127.0.0.1', '本机地址', '1557298802', '250', '127.0.0.1', '1482132862', '1', '/uploads/admin/20190325/8472bcf8e43ba985a78f8cc72333a8cb.jpg', 'GF45EW', '1');
INSERT INTO `ad_admin` VALUES ('2', 'beauty', '31d0f226497b4fe940cf6d7a824cf4e8', '58545544@qq.com', '', '15698745947', '127.0.0.1', '本机地址', '1556503122', '13', '127.0.0.1', '1547345851', '1', '/uploads/admin/20190424/92adeae987eba3765e1b02cc52fd10cd.jpg', '6xDv8G', '2');
INSERT INTO `ad_admin` VALUES ('3', 'iii', 'b455a309296a0353ea63b5b5405a462e', '55', '', '55', '', '', '0', '0', '127.0.0.1', '1553243836', '0', '/uploads/admin/20190424/e3949337c3d180bc7a2e5589739227e2.jpg', 'P7CaWh', '3');

-- ----------------------------
-- Table structure for ad_audio_platform
-- ----------------------------
DROP TABLE IF EXISTS `ad_audio_platform`;
CREATE TABLE `ad_audio_platform` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(100) NOT NULL COMMENT '音乐平台名称',
  `statu` tinyint(1) unsigned NOT NULL COMMENT '状态：1表示启用；0表示禁止',
  `addtime` int(10) unsigned NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE COMMENT '平台名称；name唯一标识'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='音频平台';

-- ----------------------------
-- Records of ad_audio_platform
-- ----------------------------
INSERT INTO `ad_audio_platform` VALUES ('1', '网易云音乐', '1', '1556429598');
INSERT INTO `ad_audio_platform` VALUES ('2', '酷狗音乐', '1', '1556429608');
INSERT INTO `ad_audio_platform` VALUES ('3', 'QQ音乐', '1', '1556429618');
INSERT INTO `ad_audio_platform` VALUES ('4', '酷我音乐', '1', '1556432698');

-- ----------------------------
-- Table structure for ad_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `ad_auth_group`;
CREATE TABLE `ad_auth_group` (
  `group_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '全新ID',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '标题',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态',
  `rules` longtext COMMENT '规则',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='管理员分组';

-- ----------------------------
-- Records of ad_auth_group
-- ----------------------------
INSERT INTO `ad_auth_group` VALUES ('1', '超级管理员', '1', '0,72,73,74,1,13,16,15,14,17,18,19,2,7,6,5,4,3,8,12,11,10,9,20,21,48,55,56,67,69,66,65,64,63,68,57,60,62,61,59,58,50,53,70,54,52,51,71,27,28,33,41,22,23,44,42,43,24,47,46,45,38,39,49,', '1546926561');
INSERT INTO `ad_auth_group` VALUES ('2', '管理员', '1', '0,72,73,74,1,13,15,19,8,11,9,2,7,6,5,20,21,22,23,43,44,42,24,27,28,41,38,39,', '1546924757');
INSERT INTO `ad_auth_group` VALUES ('3', '操作员', '1', '0,29,24,28,', '1546926357');
INSERT INTO `ad_auth_group` VALUES ('4', '会员', '0', null, '1546926757');
INSERT INTO `ad_auth_group` VALUES ('5', '游客', '0', '0,20,21,', '1547521477');

-- ----------------------------
-- Table structure for ad_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `ad_auth_rule`;
CREATE TABLE `ad_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `href` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `authopen` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `icon` varchar(20) DEFAULT NULL COMMENT '样式',
  `condition` char(100) DEFAULT '',
  `pid` int(5) NOT NULL DEFAULT '0' COMMENT '父栏目ID',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `zt` int(1) DEFAULT NULL,
  `levels` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '层级',
  `menustatus` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='权限节点';

-- ----------------------------
-- Records of ad_auth_rule
-- ----------------------------
INSERT INTO `ad_auth_rule` VALUES ('1', 'Auth', '权限管理', '1', '1', '0', 'eercast', '', '0', '2', '1547370255', '0', '1', '1');
INSERT INTO `ad_auth_rule` VALUES ('2', 'Auth/adminlist', '管理员列表', '1', '1', '0', 'user-circle', '', '1', '50', '1547370326', '0', '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('3', 'Auth/admineditopen', '操作-状态', '1', '1', '0', '', '', '2', '50', '1547370352', '0', '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('4', 'Auth/admindel', '操作-删除', '1', '1', '0', '', '', '2', '50', '1547370402', '0', '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('5', 'Auth/editpass', '操作-密码', '1', '1', '0', '', '', '2', '50', '1547370416', '0', '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('6', 'Auth/adminedit', '操作-编辑', '1', '1', '0', '', '', '2', '50', '1547370433', '0', '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('7', 'Auth/adminadd', '操作-添加', '1', '1', '0', '', '', '2', '50', '1547370463', '0', '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('8', 'Auth/admingroup', '用户组列表', '1', '1', '0', 'users', '', '1', '50', '1547370485', '0', '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('9', 'Auth/groupaccess', '操作-权限', '1', '1', '0', '', '', '8', '50', '1547370503', '0', '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('10', 'Auth/groupdel', '操作-删除', '1', '1', '0', '', '', '8', '50', '1547370524', '0', '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('11', 'Auth/groupedit', '操作-编辑', '1', '1', '0', '', '', '8', '50', '1547370543', '0', '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('12', 'Auth/groupadd', '操作-添加', '1', '1', '0', '', '', '8', '50', '1547370623', '0', '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('13', 'Auth/adminrule', '权限列表', '1', '1', '0', 'inbox', '', '1', '0', '1547370643', '0', '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('14', 'Auth/authopen', '操作-验证', '1', '1', '0', '', '', '13', '50', '1547370667', '0', '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('15', 'Auth/menustatus', '操作-状态', '1', '1', '0', '', '', '13', '50', '1547370696', '0', '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('16', 'Auth/ruledel', '操作-删除', '1', '1', '0', '', '', '13', '50', '1547370709', '0', '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('17', 'Auth/ruleedit', '操作-编辑', '1', '1', '0', '', '', '13', '50', '1547370727', '0', '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('18', 'Auth/ruleadd', '操作-添加', '1', '1', '0', '', '', '13', '50', '1547370728', '0', '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('19', 'Auth/rulesort', '操作-排序', '1', '1', '0', '', '', '13', '50', '1547370824', '0', '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('20', 'Config', '系统设置', '1', '1', '0', 'cogs', '', '0', '3', '1547370859', '0', '1', '1');
INSERT INTO `ad_auth_rule` VALUES ('21', 'Config/index', '系统设置', '1', '1', '0', 'cog', '', '20', '1', '1547370885', '0', '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('22', 'Database', '数据库管理', '1', '1', '0', 'database', '', '0', '50', '1548404716', '0', '1', '1');
INSERT INTO `ad_auth_rule` VALUES ('23', 'Database/database', '数据库备份', '1', '1', '0', 'copy', '', '22', '1', '1548405119', '0', '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('24', 'Database/restore', '还原数据库', '1', '1', '0', 'mail-reply', '', '22', '50', '1548481150', '0', '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('75', 'User/useradd', '操作-添加', '1', '1', '0', '', '', '86', '50', '1556074260', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('27', 'Log', '日志管理', '1', '1', '0', 'address-book-o', '', '0', '55', '1548661791', null, '1', '1');
INSERT INTO `ad_auth_rule` VALUES ('28', 'Log/index', '日志列表', '1', '1', '0', 'address-book', '', '27', '50', '1548661835', null, '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('43', 'Database/optimize', '操作-优化', '1', '1', '0', '', '', '23', '50', '1553332977', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('42', 'Database/backup', '操作-备份', '1', '1', '0', '', '', '23', '50', '1553332935', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('41', 'Log/index', '操作-列表', '1', '1', '0', '', '', '27', '50', '1553328774', null, '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('33', 'Log/del', '操作-删除', '1', '1', '0', '', '', '28', '50', '1548831077', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('44', 'Database/repair', '操作-修复', '1', '1', '0', '', '', '23', '50', '1553333016', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('45', 'Database/import', '操作-还原', '1', '1', '0', '', '', '24', '50', '1553333462', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('46', 'Database/downFile', '操作-下载', '1', '1', '0', '', '', '24', '50', '1553333500', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('38', 'Template', '上传管理', '1', '1', '0', 'cloud-upload', '', '0', '60', '1552466230', null, '1', '1');
INSERT INTO `ad_auth_rule` VALUES ('39', 'Template/images', '上传文件信息', '1', '1', '0', 'folder-open', '', '38', '1', '1552466284', null, '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('76', 'User', '用户管理', '1', '1', '0', 'address-book', '', '0', '50', '1556074688', null, '1', '1');
INSERT INTO `ad_auth_rule` VALUES ('47', 'Database/delSqlFiles', '操作-删除', '1', '1', '0', '', '', '24', '50', '1553336358', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('48', 'Config/edit', '操作-编辑', '1', '1', '0', '', '', '21', '50', '1553508991', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('49', 'Template/imgDel', '操作-删除', '1', '1', '0', '', '', '39', '50', '1553680126', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('50', 'Trill', '抖音管理', '1', '1', '0', 'music', '', '0', '5', '1554688415', null, '1', '1');
INSERT INTO `ad_auth_rule` VALUES ('51', 'Trill/commentlist', '评论管理', '1', '1', '0', 'comment', '', '50', '50', '1554702307', null, '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('52', 'Trill/letterlist', '私信管理', '1', '1', '0', 'envelope', '', '50', '50', '1554776212', null, '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('53', 'Trill/accountlist', '账号管理', '1', '1', '0', 'address-book', '', '50', '1', '1554780433', null, '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('54', 'Trill/playlist', '播放量管理', '1', '1', '0', 'play-circle', '', '50', '50', '1554781057', null, '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('55', 'Device', '设备管理', '1', '1', '0', 'building', '', '0', '4', '1554788027', null, '1', '1');
INSERT INTO `ad_auth_rule` VALUES ('56', 'Device/devicelist', '设备列表', '1', '1', '0', 'list', '', '55', '50', '1554788586', null, '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('57', 'Device/grouplist', '分组管理', '1', '1', '0', 'object-group', '', '55', '50', '1554947730', null, '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('58', 'Device/addgroups', '操作-添加', '1', '1', '0', '', '', '57', '50', '1554966245', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('59', 'Device/groupedit', '操作-编辑', '1', '1', '0', '', '', '57', '50', '1554966427', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('60', 'Device/restarts', '操作-设备重启', '1', '1', '0', '', '', '57', '50', '1555319737', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('61', 'Device/upgrades', '操作-软件升级', '1', '1', '0', '', '', '57', '50', '1555319792', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('62', 'Device/cleanemptys', '操作-任务清空', '1', '1', '0', '', '', '57', '50', '1555319856', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('63', 'Device/deviceadd', '操作-添加', '1', '1', '0', '', '', '56', '50', '1555320211', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('64', 'Device/devicealladd', '操作-批量添加', '1', '1', '0', '', '', '56', '50', '1555320335', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('65', 'Device/devicedel', '操作-删除', '1', '1', '0', '', '', '56', '50', '1555320408', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('66', 'Device/addgroups', '操作-加入分组', '1', '1', '0', '', '', '56', '50', '1555320454', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('67', 'Device/restart', '操作-设备重启', '1', '1', '0', '', '', '56', '50', '1555320515', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('68', 'Device/upgrade', '操作-软件升级', '1', '1', '0', '', '', '56', '50', '1555320560', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('69', 'Device/emptys', '操作-任务清空', '1', '1', '0', '', '', '56', '50', '1555320598', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('70', 'Trill/accountdel', '操作-删除', '1', '1', '0', '', '', '53', '50', '1555403470', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('71', 'Trill/commenting', '评论分组', '1', '1', '0', 'commenting', '', '50', '50', '1555408527', null, '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('72', 'Index', '后台首页', '1', '1', '0', 'tachometer', '', '0', '1', '1555636415', null, '1', '1');
INSERT INTO `ad_auth_rule` VALUES ('74', 'Index/chart', '图表信息', '1', '1', '0', 'bar-chart-o', '', '72', '50', '1555637255', null, '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('73', 'Index/index', '控制台', '1', '1', '0', 'tachometer', '', '72', '1', '1555636808', null, '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('77', 'Config/typelist', '应用类型', '1', '1', '0', 'bookmark', '', '20', '49', '1556417010', null, '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('78', 'User/userstatu', '操作-状态', '1', '1', '0', '', '', '86', '50', '1556417063', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('79', 'User/editpass', '操作-密码', '1', '1', '0', '', '', '86', '50', '1556417757', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('80', 'User/userdel', '操作-删除', '1', '1', '0', '', '', '86', '50', '1556419604', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('84', 'User/useredit', '操作-编辑', '1', '1', '0', '', '', '86', '50', '1556432978', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('85', 'Config/taglist', '应用标识', '1', '1', '0', 'microchip', '', '20', '50', '1556433056', null, '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('86', 'User/userlist', '用户列表', '1', '1', '0', 'user', '', '76', '50', '1556504920', null, '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('87', 'Config/accesslist', '权限列表', '1', '1', '0', 'inbox', '', '20', '48', '1556589222', null, '2', '1');
INSERT INTO `ad_auth_rule` VALUES ('88', 'Config/typeadd', '操作-添加', '1', '1', '0', '', '', '77', '50', '1556594618', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('89', 'Config/typeedit', '操作-编辑', '1', '1', '0', '', '', '77', '50', '1556594683', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('90', 'Config/typestatu', '操作-状态', '1', '1', '0', '', '', '77', '50', '1556594723', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('91', 'Config/typedel', '操作-删除', '1', '1', '0', '', '', '77', '50', '1556594778', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('92', 'Config/tagadd', '操作-添加', '1', '1', '0', '', '', '85', '50', '1556594941', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('93', 'Config/tagedit', '操作-编辑', '1', '1', '0', '', '', '85', '50', '1556594967', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('94', 'Config/tagstatu', '操作-状态', '1', '1', '0', '', '', '85', '50', '1556595632', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('95', 'Config/tagdel', '操作-删除', '1', '1', '0', '', '', '85', '50', '1556595669', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('96', 'Config/accessadd', '操作-添加', '1', '1', '0', '', '', '87', '50', '1556595700', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('97', 'Config/accessedit', '操作-编辑', '1', '1', '0', '', '', '87', '50', '1556595737', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('98', 'Config/menustatus', '操作-状态', '1', '1', '0', '', '', '87', '50', '1556595824', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('99', 'Config/authopen', '操作-验证', '1', '1', '0', '', '', '87', '50', '1556595865', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('100', 'Config/rulesort', '操作-排序', '1', '1', '0', '', '', '87', '50', '1556595934', null, '3', '1');
INSERT INTO `ad_auth_rule` VALUES ('101', 'Config/accessdel', '操作-删除', '1', '1', '0', '', '', '87', '50', '1556595959', null, '3', '1');

-- ----------------------------
-- Table structure for ad_config
-- ----------------------------
DROP TABLE IF EXISTS `ad_config`;
CREATE TABLE `ad_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(30) NOT NULL COMMENT '主键名',
  `value` text COMMENT '值',
  `type` varchar(30) DEFAULT NULL COMMENT '类型',
  `desc` varchar(50) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统设置';

-- ----------------------------
-- Records of ad_config
-- ----------------------------
INSERT INTO `ad_config` VALUES ('1', 'name', '后台管理', null, '应用名');
INSERT INTO `ad_config` VALUES ('2', 'url', 'http://127.0.0.20/layuiadmin/public/index.php/admin/config/index.html', null, '客户端域名');
INSERT INTO `ad_config` VALUES ('3', 'logo', '/uploads/logo/20190425/f65afc59801aeb633c8cb57254bb2284.jpg', null, '网站LOGO');
INSERT INTO `ad_config` VALUES ('4', 'bah', '© 2019 layuiadmin.com MIT license', null, '备案号');
INSERT INTO `ad_config` VALUES ('5', 'copyright', '2019-2025', null, 'Copyright');
INSERT INTO `ad_config` VALUES ('6', 'ads', '宝安', null, '公司地址');
INSERT INTO `ad_config` VALUES ('7', 'tel', '18792402222', null, '联系电话');
INSERT INTO `ad_config` VALUES ('8', 'email', '18792402229@qq.com', null, '邮箱账号');
INSERT INTO `ad_config` VALUES ('9', 'title', '后台管理', null, 'SEO标题');
INSERT INTO `ad_config` VALUES ('10', 'key', '内容管理系统', null, 'SEO关键字');
INSERT INTO `ad_config` VALUES ('11', 'des', '内容管理系统', null, 'SEO描述');
INSERT INTO `ad_config` VALUES ('12', 'statu', 'open', null, '网站状态');
INSERT INTO `ad_config` VALUES ('13', 'code', 'open', null, '管理员验证码');
INSERT INTO `ad_config` VALUES ('14', 'uploadsize', '4', 'upload', '上传图片大小');
INSERT INTO `ad_config` VALUES ('15', 'uploadimgtype', ' jpg|png|jpeg', 'upload', '上传图片类型');
INSERT INTO `ad_config` VALUES ('16', 'uploadfiletype', 'doc|pdf|xls', 'upload', '上传文件类型');
INSERT INTO `ad_config` VALUES ('17', 'uploadvideotype', 'avi|rmvb|flv', 'upload', '上传视频类型');
INSERT INTO `ad_config` VALUES ('18', 'uploadaudiotype', 'mp3|aac|opus', 'upload', '上传音频类型');
INSERT INTO `ad_config` VALUES ('19', 'userwx', '2', null, '用户最大在线微信');
INSERT INTO `ad_config` VALUES ('20', 'bigs', '242542', null, '大淘客cms-apikey');
INSERT INTO `ad_config` VALUES ('21', 'redpaper', '423435', null, '支付宝红包口令');
INSERT INTO `ad_config` VALUES ('22', 'qq', '354354', null, 'QQ群二维码');
INSERT INTO `ad_config` VALUES ('23', 'focus', '53535', null, '自动关注公众号');
INSERT INTO `ad_config` VALUES ('24', 'reg', 'open', null, '注册验证码');
INSERT INTO `ad_config` VALUES ('25', 'logins', 'open', null, '登录验证码');
INSERT INTO `ad_config` VALUES ('26', 'tixian', 'close', null, '提现验证码');
INSERT INTO `ad_config` VALUES ('27', 'apiappkey', 'eb35491f4477994ab201d8cb2b5f980f', 'api', 'appkey');
INSERT INTO `ad_config` VALUES ('28', 'apiurl', 'http://www.zh.com', 'api', '接口请求url地址');
INSERT INTO `ad_config` VALUES ('29', 'usercode', 'open', 'user', '用户登录');

-- ----------------------------
-- Table structure for ad_log
-- ----------------------------
DROP TABLE IF EXISTS `ad_log`;
CREATE TABLE `ad_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `aid` int(10) NOT NULL COMMENT '操作用户ID',
  `rid` int(10) DEFAULT NULL,
  `pid` int(10) DEFAULT NULL,
  `pids` int(10) DEFAULT NULL,
  `addtime` int(10) NOT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=685 DEFAULT CHARSET=utf8 COMMENT='日志表';

-- ----------------------------
-- Records of ad_log
-- ----------------------------
INSERT INTO `ad_log` VALUES ('677', '1', '78', '86', '76', '1557297748');
INSERT INTO `ad_log` VALUES ('676', '1', '78', '86', '76', '1557297747');
INSERT INTO `ad_log` VALUES ('675', '1', '78', '86', '76', '1557297745');
INSERT INTO `ad_log` VALUES ('674', '1', '78', '86', '76', '1557297744');
INSERT INTO `ad_log` VALUES ('673', '1', '78', '86', '76', '1557297743');
INSERT INTO `ad_log` VALUES ('672', '1', '78', '86', '76', '1557297709');
INSERT INTO `ad_log` VALUES ('671', '1', '78', '86', '76', '1557297707');
INSERT INTO `ad_log` VALUES ('670', '1', '78', '86', '76', '1557297707');
INSERT INTO `ad_log` VALUES ('669', '1', '78', '86', '76', '1557297700');
INSERT INTO `ad_log` VALUES ('668', '1', '78', '86', '76', '1557297699');
INSERT INTO `ad_log` VALUES ('667', '1', '78', '86', '76', '1557297698');
INSERT INTO `ad_log` VALUES ('666', '1', '78', '86', '76', '1557297697');
INSERT INTO `ad_log` VALUES ('665', '1', '78', '86', '76', '1557297695');
INSERT INTO `ad_log` VALUES ('664', '1', '78', '86', '76', '1557297694');
INSERT INTO `ad_log` VALUES ('663', '1', '78', '86', '76', '1557297692');
INSERT INTO `ad_log` VALUES ('662', '1', '78', '86', '76', '1557296905');
INSERT INTO `ad_log` VALUES ('661', '1', '84', '86', '76', '1557296249');
INSERT INTO `ad_log` VALUES ('660', '1', '84', '86', '76', '1557296232');
INSERT INTO `ad_log` VALUES ('659', '1', '84', '86', '76', '1557296206');
INSERT INTO `ad_log` VALUES ('658', '1', '75', '86', '76', '1557295696');
INSERT INTO `ad_log` VALUES ('657', '1', '96', '87', '20', '1557295509');
INSERT INTO `ad_log` VALUES ('656', '1', '97', '87', '20', '1557295334');
INSERT INTO `ad_log` VALUES ('655', '1', '96', '87', '20', '1557295324');
INSERT INTO `ad_log` VALUES ('654', '1', '96', '87', '20', '1557295000');
INSERT INTO `ad_log` VALUES ('653', '1', '100', '87', '20', '1557294866');
INSERT INTO `ad_log` VALUES ('652', '1', null, null, null, '1557136074');
INSERT INTO `ad_log` VALUES ('651', '1', '96', '87', '20', '1557136042');
INSERT INTO `ad_log` VALUES ('650', '1', '96', '87', '20', '1557135990');
INSERT INTO `ad_log` VALUES ('649', '1', '96', '87', '20', '1557135923');
INSERT INTO `ad_log` VALUES ('648', '1', '97', '87', '20', '1557135684');
INSERT INTO `ad_log` VALUES ('647', '1', '96', '87', '20', '1557135648');
INSERT INTO `ad_log` VALUES ('646', '1', '92', '85', '20', '1557135624');
INSERT INTO `ad_log` VALUES ('645', '1', '100', '87', '20', '1557135506');
INSERT INTO `ad_log` VALUES ('644', '1', '96', '87', '20', '1557135495');
INSERT INTO `ad_log` VALUES ('643', '1', '96', '87', '20', '1557131009');
INSERT INTO `ad_log` VALUES ('642', '1', '97', '87', '20', '1557130828');
INSERT INTO `ad_log` VALUES ('641', '1', '97', '87', '20', '1557130815');
INSERT INTO `ad_log` VALUES ('640', '1', '92', '85', '20', '1557127388');
INSERT INTO `ad_log` VALUES ('639', '1', null, null, null, '1557125053');
INSERT INTO `ad_log` VALUES ('638', '1', '100', '87', '20', '1557110401');
INSERT INTO `ad_log` VALUES ('637', '1', '100', '87', '20', '1557107080');
INSERT INTO `ad_log` VALUES ('636', '1', '100', '87', '20', '1557107071');
INSERT INTO `ad_log` VALUES ('635', '1', null, null, null, '1557107050');
INSERT INTO `ad_log` VALUES ('634', '1', '97', '87', '20', '1557107012');
INSERT INTO `ad_log` VALUES ('633', '1', '97', '87', '20', '1557107001');
INSERT INTO `ad_log` VALUES ('632', '1', '97', '87', '20', '1557106985');
INSERT INTO `ad_log` VALUES ('631', '1', '96', '87', '20', '1557106942');
INSERT INTO `ad_log` VALUES ('630', '1', '96', '87', '20', '1557106942');
INSERT INTO `ad_log` VALUES ('629', '1', '96', '87', '20', '1557106819');
INSERT INTO `ad_log` VALUES ('628', '1', '96', '87', '20', '1557106757');
INSERT INTO `ad_log` VALUES ('627', '1', '96', '87', '20', '1557106685');
INSERT INTO `ad_log` VALUES ('626', '1', '100', '87', '20', '1557106645');
INSERT INTO `ad_log` VALUES ('625', '1', '96', '87', '20', '1557106609');
INSERT INTO `ad_log` VALUES ('624', '1', '97', '87', '20', '1557106099');
INSERT INTO `ad_log` VALUES ('623', '1', '96', '87', '20', '1557105752');
INSERT INTO `ad_log` VALUES ('622', '1', '96', '87', '20', '1557105601');
INSERT INTO `ad_log` VALUES ('621', '1', '97', '87', '20', '1557045303');
INSERT INTO `ad_log` VALUES ('620', '1', '97', '87', '20', '1557045290');
INSERT INTO `ad_log` VALUES ('619', '1', '93', '85', '20', '1557043518');
INSERT INTO `ad_log` VALUES ('618', '1', '93', '85', '20', '1557041546');
INSERT INTO `ad_log` VALUES ('617', '1', '93', '85', '20', '1557041539');
INSERT INTO `ad_log` VALUES ('616', '1', '93', '85', '20', '1557041420');
INSERT INTO `ad_log` VALUES ('615', '1', '93', '85', '20', '1557041414');
INSERT INTO `ad_log` VALUES ('614', '1', '93', '85', '20', '1557041402');
INSERT INTO `ad_log` VALUES ('613', '1', '93', '85', '20', '1557041387');
INSERT INTO `ad_log` VALUES ('612', '1', '93', '85', '20', '1557041379');
INSERT INTO `ad_log` VALUES ('611', '1', '93', '85', '20', '1557041258');
INSERT INTO `ad_log` VALUES ('610', '1', '93', '85', '20', '1557041240');
INSERT INTO `ad_log` VALUES ('609', '1', '92', '85', '20', '1557040636');
INSERT INTO `ad_log` VALUES ('608', '1', '65', '56', '55', '1557040554');
INSERT INTO `ad_log` VALUES ('607', '1', '65', '56', '55', '1557040542');
INSERT INTO `ad_log` VALUES ('606', '1', '15', '13', '1', '1557038132');
INSERT INTO `ad_log` VALUES ('605', '1', '17', '13', '1', '1557038094');
INSERT INTO `ad_log` VALUES ('684', '1', '96', '87', '20', '1557299810');
INSERT INTO `ad_log` VALUES ('683', '1', '84', '86', '76', '1557297914');
INSERT INTO `ad_log` VALUES ('682', '1', '84', '86', '76', '1557297890');
INSERT INTO `ad_log` VALUES ('681', '1', '84', '86', '76', '1557297881');
INSERT INTO `ad_log` VALUES ('680', '1', '78', '86', '76', '1557297865');
INSERT INTO `ad_log` VALUES ('679', '1', '84', '86', '76', '1557297857');
INSERT INTO `ad_log` VALUES ('678', '1', '78', '86', '76', '1557297749');
INSERT INTO `ad_log` VALUES ('604', '1', '33', '28', '27', '1557038047');

-- ----------------------------
-- Table structure for ad_news_platform
-- ----------------------------
DROP TABLE IF EXISTS `ad_news_platform`;
CREATE TABLE `ad_news_platform` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(100) NOT NULL COMMENT '音乐平台名称',
  `statu` tinyint(1) unsigned NOT NULL COMMENT '状态：1表示启用；0表示禁止',
  `addtime` int(10) unsigned NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE COMMENT '平台名称；name唯一标识'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='视频平台';

-- ----------------------------
-- Records of ad_news_platform
-- ----------------------------
INSERT INTO `ad_news_platform` VALUES ('1', '今日头条', '1', '1556444541');

-- ----------------------------
-- Table structure for ad_tag
-- ----------------------------
DROP TABLE IF EXISTS `ad_tag`;
CREATE TABLE `ad_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT '应用名称',
  `tagname` varchar(50) NOT NULL COMMENT '应用标识',
  `type` tinyint(2) unsigned NOT NULL COMMENT '应用类型',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `statu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态：1表示启用，0表示禁止',
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE COMMENT '应用名称',
  KEY `tagname` (`tagname`) USING BTREE COMMENT '应用标识'
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ad_tag
-- ----------------------------
INSERT INTO `ad_tag` VALUES ('1', '网易云音乐', 'Cloud', '1', '1556530560', '1');
INSERT INTO `ad_tag` VALUES ('2', 'QQ音乐', 'Qq', '1', '1556531792', '1');
INSERT INTO `ad_tag` VALUES ('3', '酷狗音乐', 'Kugou', '1', '1556586353', '1');
INSERT INTO `ad_tag` VALUES ('4', '抖音', 'Trill', '2', '1557040636', '1');
INSERT INTO `ad_tag` VALUES ('5', '快手', 'Qqs', '2', '1557127388', '1');
INSERT INTO `ad_tag` VALUES ('6', '今日头条', 'Todayhead', '3', '1557135624', '1');

-- ----------------------------
-- Table structure for ad_tag_type
-- ----------------------------
DROP TABLE IF EXISTS `ad_tag_type`;
CREATE TABLE `ad_tag_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT '类型名称',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `statu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态：1表示启用，0表示禁止',
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE COMMENT '类型名称'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ad_tag_type
-- ----------------------------
INSERT INTO `ad_tag_type` VALUES ('1', '音频', '1556528160', '1');
INSERT INTO `ad_tag_type` VALUES ('2', '视频', '1556528362', '1');
INSERT INTO `ad_tag_type` VALUES ('3', '新闻', '1556528369', '1');

-- ----------------------------
-- Table structure for ad_trill_account
-- ----------------------------
DROP TABLE IF EXISTS `ad_trill_account`;
CREATE TABLE `ad_trill_account` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `statu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态：1表示启用，0表示禁止',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='抖音账号表';

-- ----------------------------
-- Records of ad_trill_account
-- ----------------------------
INSERT INTO `ad_trill_account` VALUES ('6', '5', '5', '1555575969', '1');
INSERT INTO `ad_trill_account` VALUES ('7', '5', '5', '1555575969', '1');
INSERT INTO `ad_trill_account` VALUES ('8', '55', '442', '1555459200', '1');
INSERT INTO `ad_trill_account` VALUES ('9', 'yy', 'yt', '1555459200', '0');
INSERT INTO `ad_trill_account` VALUES ('10', 'yt', 'yy', '1555459200', '5');
INSERT INTO `ad_trill_account` VALUES ('11', 'yty', 'yy', '1555200000', '0');

-- ----------------------------
-- Table structure for ad_trill_comment
-- ----------------------------
DROP TABLE IF EXISTS `ad_trill_comment`;
CREATE TABLE `ad_trill_comment` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `uid` bigint(19) unsigned NOT NULL COMMENT '用户ID',
  `content` text NOT NULL COMMENT '评论内容',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='抖音评论表';

-- ----------------------------
-- Records of ad_trill_comment
-- ----------------------------
INSERT INTO `ad_trill_comment` VALUES ('19', '0', 'uu一i', '1555480778');
INSERT INTO `ad_trill_comment` VALUES ('16', '0', '<p>11</p>', '1555386288');
INSERT INTO `ad_trill_comment` VALUES ('17', '0', '<p>u&nbsp;</p>', '1555398201');
INSERT INTO `ad_trill_comment` VALUES ('18', '0', '<p>utyu&nbsp;</p>', '1555398209');
INSERT INTO `ad_trill_comment` VALUES ('23', '0', '878 78', '1555643266');
INSERT INTO `ad_trill_comment` VALUES ('7', '0', '<p>uuuuu</p>', '1555384435');
INSERT INTO `ad_trill_comment` VALUES ('13', '0', 'yy', '1555385567');
INSERT INTO `ad_trill_comment` VALUES ('20', '0', 'Y', '1555554735');
INSERT INTO `ad_trill_comment` VALUES ('21', '0', '887 87', '1555642939');
INSERT INTO `ad_trill_comment` VALUES ('22', '0', '888', '1555643249');
INSERT INTO `ad_trill_comment` VALUES ('24', '0', '77', '1555754470');
INSERT INTO `ad_trill_comment` VALUES ('25', '0', '7776', '1555754476');
INSERT INTO `ad_trill_comment` VALUES ('26', '0', '【】【】', '1556160157');

-- ----------------------------
-- Table structure for ad_trill_commenting
-- ----------------------------
DROP TABLE IF EXISTS `ad_trill_commenting`;
CREATE TABLE `ad_trill_commenting` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `cid` text NOT NULL COMMENT '评论分组ID',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '数量',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `statu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态：1表示启用；0表示禁止',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE COMMENT '平台名称；name唯一标识'
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='抖音评论分组表';

-- ----------------------------
-- Records of ad_trill_commenting
-- ----------------------------
INSERT INTO `ad_trill_commenting` VALUES ('25', '18,17,16,13,7', '8看', '5', '1555468340', '0');
INSERT INTO `ad_trill_commenting` VALUES ('24', '25,24,23,22,21,20,19,18,17,16,13,7', '85', '12', '1555468329', '1');
INSERT INTO `ad_trill_commenting` VALUES ('22', '', '一', '0', '1555466369', '0');
INSERT INTO `ad_trill_commenting` VALUES ('23', '18,17,16,13,7', '可好看', '5', '1555466373', '1');
INSERT INTO `ad_trill_commenting` VALUES ('26', '', 'i了45', '0', '1555473609', '1');

-- ----------------------------
-- Table structure for ad_trill_letter
-- ----------------------------
DROP TABLE IF EXISTS `ad_trill_letter`;
CREATE TABLE `ad_trill_letter` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `content` text NOT NULL COMMENT '私信内容',
  `addtime` int(10) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='抖音私信表';

-- ----------------------------
-- Records of ad_trill_letter
-- ----------------------------
INSERT INTO `ad_trill_letter` VALUES ('7', '7r7', '1555723301');
INSERT INTO `ad_trill_letter` VALUES ('6', '77', '1555723295');

-- ----------------------------
-- Table structure for ad_trill_play
-- ----------------------------
DROP TABLE IF EXISTS `ad_trill_play`;
CREATE TABLE `ad_trill_play` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `num` bigint(19) unsigned NOT NULL DEFAULT '0' COMMENT '播放量',
  `addtime` int(10) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='抖音播放量数据表';

-- ----------------------------
-- Records of ad_trill_play
-- ----------------------------
INSERT INTO `ad_trill_play` VALUES ('6', '10', '5');
INSERT INTO `ad_trill_play` VALUES ('5', '20', '65668686');

-- ----------------------------
-- Table structure for ad_user
-- ----------------------------
DROP TABLE IF EXISTS `ad_user`;
CREATE TABLE `ad_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `phone` varchar(20) NOT NULL COMMENT '手机号码',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `statu` tinyint(1) unsigned NOT NULL COMMENT '账号状态：1启用，0禁止',
  `appkey` varchar(32) NOT NULL COMMENT 'APPKEY',
  `addtime` int(10) unsigned NOT NULL COMMENT '添加时间',
  `endtime` int(10) unsigned NOT NULL COMMENT '到期时间',
  `salt` varchar(8) NOT NULL COMMENT '随机字符串',
  `loginip` varchar(40) DEFAULT NULL COMMENT '登录IP',
  `ipadress` varchar(50) DEFAULT NULL COMMENT '登录IP详细地址',
  `logintime` int(11) unsigned DEFAULT NULL COMMENT '上次登录时间',
  `loginnum` int(10) unsigned DEFAULT '0' COMMENT '登录次数',
  `rules` text COMMENT '权限',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `username` (`username`) USING BTREE COMMENT '用户名'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ad_user
-- ----------------------------
INSERT INTO `ad_user` VALUES ('2', 'jack', '15989865138', '2d265d2bd980ce115dd1cbf82b5760b5', '1', '9428ef7ddfbe0d08a0057f5a3c8b57a6', '1556520662', '1559145600', 'NFU0VG9D', '127.0.0.1', '本机地址', '1556608025', '3', '0,1,2,3,4,17,18,5,6,15,11,10,8,9,14,13,12,16,7,19,20,21,');
INSERT INTO `ad_user` VALUES ('1', 'admin', '18322222222', 'cade616bb93b9af9dcf837cf648edaa2', '1', '3d36e3c31f3d9dbde41a2ba9a2c3a31c', '1557295696', '1557244800', 'JDcjGoCJ', '127.0.0.1', '本机地址', '1557304748', '1', null);

-- ----------------------------
-- Table structure for ad_user_account
-- ----------------------------
DROP TABLE IF EXISTS `ad_user_account`;
CREATE TABLE `ad_user_account` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `phone` varchar(100) NOT NULL COMMENT '手机号码',
  `addtime` int(10) unsigned NOT NULL COMMENT '添加时间',
  `updatetime` int(10) unsigned DEFAULT NULL COMMENT '修改时间',
  `tagname` varchar(100) NOT NULL COMMENT '应用标识',
  `statu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态：1表示启用，0表示禁止',
  PRIMARY KEY (`id`),
  KEY `tagname` (`tagname`) USING BTREE COMMENT '应用标识',
  KEY `username` (`username`) USING BTREE COMMENT '用户名'
) ENGINE=MRG_MyISAM DEFAULT CHARSET=utf8 INSERT_METHOD=LAST UNION=(`ad_user_account_ping1`) COMMENT='账号表';

-- ----------------------------
-- Records of ad_user_account
-- ----------------------------
INSERT INTO `ad_user_account` VALUES ('1', '2', 'yyytytyt', 'tryty', '868968686', '1557198671', null, 'Cloud', '1');
INSERT INTO `ad_user_account` VALUES ('2', '0', 'yyytytyts', 'tryty', '868968686', '1557198671', null, 'Cloud', '1');
INSERT INTO `ad_user_account` VALUES ('3', '2', 'yyty', 'tryty', 'uyuyu', '1557198671', null, 'Trill', '0');

-- ----------------------------
-- Table structure for ad_user_account_copy
-- ----------------------------
DROP TABLE IF EXISTS `ad_user_account_copy`;
CREATE TABLE `ad_user_account_copy` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `phone` varchar(100) NOT NULL COMMENT '手机号码',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `updatetime` int(10) DEFAULT NULL COMMENT '修改时间',
  `tagname` varchar(100) NOT NULL COMMENT '应用标识',
  `statu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态：1表示启用，0表示禁止',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='58同城账号表';

-- ----------------------------
-- Records of ad_user_account_copy
-- ----------------------------

-- ----------------------------
-- Table structure for ad_user_account_ping1
-- ----------------------------
DROP TABLE IF EXISTS `ad_user_account_ping1`;
CREATE TABLE `ad_user_account_ping1` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `phone` varchar(100) NOT NULL COMMENT '手机号码',
  `addtime` int(10) unsigned NOT NULL COMMENT '添加时间',
  `updatetime` int(10) unsigned DEFAULT NULL COMMENT '修改时间',
  `tagname` varchar(100) NOT NULL COMMENT '应用标识',
  `statu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态：1表示启用，0表示禁止',
  PRIMARY KEY (`id`),
  KEY `tagname` (`tagname`) USING BTREE COMMENT '应用标识',
  KEY `username` (`username`) USING BTREE COMMENT '用户名'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='账号表';

-- ----------------------------
-- Records of ad_user_account_ping1
-- ----------------------------
INSERT INTO `ad_user_account_ping1` VALUES ('1', '2', 'yyytytyt', 'tryty', '868968686', '1557198671', null, 'Cloud', '1');
INSERT INTO `ad_user_account_ping1` VALUES ('2', '0', 'yyytytyts', 'tryty', '868968686', '1557198671', null, 'Cloud', '1');
INSERT INTO `ad_user_account_ping1` VALUES ('3', '2', 'yyty', 'tryty', 'uyuyu', '1557198671', null, 'Trill', '0');

-- ----------------------------
-- Table structure for ad_user_audio_account
-- ----------------------------
DROP TABLE IF EXISTS `ad_user_audio_account`;
CREATE TABLE `ad_user_audio_account` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `phone` varchar(100) NOT NULL COMMENT '手机号码',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `updatetime` int(10) DEFAULT NULL COMMENT '修改时间',
  `tagname` varchar(100) NOT NULL COMMENT '应用标识',
  `statu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态：1表示启用，0表示禁止',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='58同城账号表';

-- ----------------------------
-- Records of ad_user_audio_account
-- ----------------------------
INSERT INTO `ad_user_audio_account` VALUES ('23', 'jack', '123456', '18655555555', '2147483647', null, 'Cloud', '1');
INSERT INTO `ad_user_audio_account` VALUES ('25', 'jack', '123456', '18655555555', '2147483647', null, 'Cloud', '1');
INSERT INTO `ad_user_audio_account` VALUES ('22', 'jack', '123456', '18655555555', '2147483647', null, 'Cloud', '1');
INSERT INTO `ad_user_audio_account` VALUES ('24', 'jack', '123456', '18655555555', '2147483647', null, 'Cloud', '1');

-- ----------------------------
-- Table structure for ad_user_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `ad_user_auth_rule`;
CREATE TABLE `ad_user_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `href` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `authopen` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `icon` varchar(20) DEFAULT NULL COMMENT '样式',
  `condition` char(100) DEFAULT '',
  `pid` int(5) NOT NULL DEFAULT '0' COMMENT '父栏目ID',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `zt` int(1) DEFAULT NULL,
  `levels` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '层级',
  `menustatus` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='权限节点';

-- ----------------------------
-- Records of ad_user_auth_rule
-- ----------------------------
INSERT INTO `ad_user_auth_rule` VALUES ('1', 'Index', '后台首页', '1', '1', '0', 'tachometer', '', '0', '1', '1556606327', null, '1', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('2', 'Index/index', '控制台', '1', '1', '0', 'tachometer', '', '1', '50', '1556606491', null, '2', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('3', 'Index/chart', '图表信息', '1', '1', '0', 'bar-chart-o', '', '1', '50', '1556608122', null, '2', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('4', 'Account', '账号管理', '1', '1', '0', 'address-book', '', '0', '2', '1556609989', null, '1', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('5', 'Show', '音频管理', '1', '1', '0', 'music', '', '4', '50', '1556610105', null, '2', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('6', 'Cloud/accountlist', '网易云音乐', '1', '1', '0', 'cloud', '', '5', '50', '1556610227', null, '3', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('7', 'Task', '任务管理', '1', '1', '0', 'tasks', '', '0', '3', '1557037090', null, '1', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('8', 'Show', '视频管理', '1', '1', '0', 'video-camera', '', '4', '50', '1557105601', null, '2', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('9', 'Trill/accountlist', '抖音', '1', '1', '0', 'play-circle', '', '8', '50', '1557105752', null, '3', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('10', 'Cloud/accountstatu', '操作-状态', '1', '1', '0', '', '', '6', '50', '1557106609', null, '4', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('11', 'Cloud/accountdel', '操作-删除', '1', '1', '0', '', '', '6', '50', '1557106685', null, '4', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('12', 'Trill/accountstatu', '操作-状态', '1', '1', '0', '', '', '9', '50', '1557106757', null, '4', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('13', 'Trill/accountdel', '操作-删除', '1', '1', '0', '', '', '9', '50', '1557106819', null, '4', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('14', 'Trill/accountlist', '操作-列表', '1', '1', '0', '', '', '9', '1', '1557106942', null, '4', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('15', 'Cloud/accountlist', '操作-列表', '1', '1', '0', '', '', '6', '1', '1557106942', null, '4', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('16', 'Fodder', '素材管理', '1', '1', '0', 'comments', '', '0', '50', '1557131009', null, '1', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('17', 'Show', '新闻管理', '1', '1', '0', 'hacker-news', '', '4', '50', '1557135495', null, '2', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('18', 'Todayhead/accountlist', '今日头条', '1', '1', '0', '', '', '17', '50', '1557135648', null, '3', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('19', 'Show', '新闻管理', '1', '1', '0', 'hacker-news', '', '7', '50', '1557135923', null, '2', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('20', 'Show', '视频管理', '1', '1', '0', 'video-camera', '', '7', '50', '1557135990', null, '2', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('21', 'Show', '音频管理', '1', '1', '0', 'music', '', '7', '50', '1557136042', null, '2', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('22', 'Show', '新闻管理', '1', '1', '0', 'hacker-news', '', '16', '50', '1557295000', null, '2', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('23', 'Show', '视频管理', '1', '1', '0', 'video-camera', '', '16', '50', '1557295324', null, '2', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('24', 'Show', '音频管理', '1', '1', '0', 'music', '', '16', '50', '1557295509', null, '2', '1');
INSERT INTO `ad_user_auth_rule` VALUES ('25', 'Trill/commentlist', '抖音评论', '1', '1', '0', 'comment', '', '23', '50', '1557299810', null, '3', '1');

-- ----------------------------
-- Table structure for ad_user_comment
-- ----------------------------
DROP TABLE IF EXISTS `ad_user_comment`;
CREATE TABLE `ad_user_comment` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `uid` bigint(19) unsigned NOT NULL COMMENT '用户ID',
  `content` text NOT NULL COMMENT '评论内容',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `tagname` varchar(100) NOT NULL COMMENT '应用标识',
  `statu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态：1表示启用，0表示禁止',
  PRIMARY KEY (`id`),
  KEY `content` (`content`(333)) USING BTREE COMMENT '评论内容'
) ENGINE=MRG_MyISAM DEFAULT CHARSET=utf8 INSERT_METHOD=LAST UNION=(`ad_user_comment_ping1`) COMMENT='评论表';

-- ----------------------------
-- Records of ad_user_comment
-- ----------------------------
INSERT INTO `ad_user_comment` VALUES ('1', '2', 'ee888888888888', '1557305443', 'Trill', '1');
INSERT INTO `ad_user_comment` VALUES ('2', '2', 'aii88', '1557307340', 'Trill', '1');

-- ----------------------------
-- Table structure for ad_user_comment_ping1
-- ----------------------------
DROP TABLE IF EXISTS `ad_user_comment_ping1`;
CREATE TABLE `ad_user_comment_ping1` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `uid` bigint(19) unsigned NOT NULL COMMENT '用户ID',
  `content` text NOT NULL COMMENT '评论内容',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `tagname` varchar(100) NOT NULL COMMENT '应用标识',
  `statu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态：1表示启用，0表示禁止',
  PRIMARY KEY (`id`),
  KEY `content` (`content`(333)) USING BTREE COMMENT '评论内容'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='评论表';

-- ----------------------------
-- Records of ad_user_comment_ping1
-- ----------------------------
INSERT INTO `ad_user_comment_ping1` VALUES ('1', '2', 'ee888888888888', '1557305443', 'Trill', '1');
INSERT INTO `ad_user_comment_ping1` VALUES ('2', '2', 'aii88', '1557307340', 'Trill', '1');

-- ----------------------------
-- Table structure for ad_video_platform
-- ----------------------------
DROP TABLE IF EXISTS `ad_video_platform`;
CREATE TABLE `ad_video_platform` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(100) NOT NULL COMMENT '音乐平台名称',
  `statu` tinyint(1) unsigned NOT NULL COMMENT '状态：1表示启用；0表示禁止',
  `addtime` int(10) unsigned NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE COMMENT '平台名称；name唯一标识'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='视频平台';

-- ----------------------------
-- Records of ad_video_platform
-- ----------------------------
INSERT INTO `ad_video_platform` VALUES ('1', '抖音', '1', '1556433522');
INSERT INTO `ad_video_platform` VALUES ('2', '快手', '1', '1556433536');
SET FOREIGN_KEY_CHECKS=1;
