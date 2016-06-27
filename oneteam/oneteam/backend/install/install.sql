/*
Navicat MySQL Data Transfer

Source Server         : windows.fei
Source Server Version : 50547
Source Host           : 127.0.0.1:3306
Source Database       : we

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-06-27 13:17:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for we_custom
-- ----------------------------
DROP TABLE IF EXISTS `we_custom`;
CREATE TABLE `we_custom` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_type` int(11) DEFAULT NULL,
  `c_key` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of we_custom
-- ----------------------------

-- ----------------------------
-- Table structure for we_img
-- ----------------------------
DROP TABLE IF EXISTS `we_img`;
CREATE TABLE `we_img` (
  `i_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_image` varchar(255) DEFAULT NULL,
  `rid` int(11) DEFAULT NULL,
  `i_title` varchar(255) DEFAULT NULL,
  `i_content` varchar(255) DEFAULT NULL,
  `i_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`i_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of we_img
-- ----------------------------

-- ----------------------------
-- Table structure for we_menu
-- ----------------------------
DROP TABLE IF EXISTS `we_menu`;
CREATE TABLE `we_menu` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_name` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `f_id` int(11) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  `m_controller` varchar(255) DEFAULT NULL,
  `m_action` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of we_menu
-- ----------------------------
INSERT INTO `we_menu` VALUES ('1', '基本设置', '0', '0', null, null);
INSERT INTO `we_menu` VALUES ('4', '全局参数设定', '0', '1', null, null);
INSERT INTO `we_menu` VALUES ('5', '自动回复', '1', '0', null, null);
INSERT INTO `we_menu` VALUES ('11', '公众号管理', '4', '1', 'account', 'display');
INSERT INTO `we_menu` VALUES ('18', '文字回复', '5', '0', 'rule', 'display');
INSERT INTO `we_menu` VALUES ('19', '图文回复', '5', '0', 'rule', 'img');
INSERT INTO `we_menu` VALUES ('20', '音乐回复', '5', '0', 'rule', 'music');
INSERT INTO `we_menu` VALUES ('23', '自定义菜单', '5', '0', 'menu', 'designer');

-- ----------------------------
-- Table structure for we_pub
-- ----------------------------
DROP TABLE IF EXISTS `we_pub`;
CREATE TABLE `we_pub` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `appid` varchar(255) DEFAULT NULL,
  `appsecret` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `w_num` varchar(255) DEFAULT NULL,
  `w_numone` varchar(255) DEFAULT NULL,
  `p_photo` varchar(255) DEFAULT NULL,
  `w_twoma` varchar(255) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `p_rand` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of we_pub
-- ----------------------------

-- ----------------------------
-- Table structure for we_rule
-- ----------------------------
DROP TABLE IF EXISTS `we_rule`;
CREATE TABLE `we_rule` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `r_type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `r_content` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `r_key` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `c_id` int(11) DEFAULT '0',
  `p_id` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `r_mo` int(11) DEFAULT '0',
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of we_rule
-- ----------------------------

-- ----------------------------
-- Table structure for we_type
-- ----------------------------
DROP TABLE IF EXISTS `we_type`;
CREATE TABLE `we_type` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of we_type
-- ----------------------------
INSERT INTO `we_type` VALUES ('1', '基本文字回复');
INSERT INTO `we_type` VALUES ('2', '混合图文回复');
INSERT INTO `we_type` VALUES ('3', '基本语音回复');

-- ----------------------------
-- Table structure for we_upload
-- ----------------------------
DROP TABLE IF EXISTS `we_upload`;
CREATE TABLE `we_upload` (
  `up_id` int(11) NOT NULL AUTO_INCREMENT,
  `up_img` varchar(255) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `up_content` varchar(255) DEFAULT NULL,
  `up_url` varchar(255) DEFAULT NULL,
  `up_text` varchar(255) DEFAULT NULL,
  `up_title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`up_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of we_upload
-- ----------------------------

-- ----------------------------
-- Table structure for we_user
-- ----------------------------
DROP TABLE IF EXISTS `we_user`;
CREATE TABLE `we_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `user_pwd` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `user_tel` varchar(32) DEFAULT NULL,
  `user_email` varchar(32) DEFAULT NULL,
  `user_status` int(11) NOT NULL DEFAULT '0',
  `user_time` date DEFAULT NULL,
  `user_ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of we_user
-- ----------------------------
