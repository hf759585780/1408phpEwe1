/*
Navicat MySQL Data Transfer

Source Server         : windows.fei
Source Server Version : 50547
Source Host           : 127.0.0.1:3306
Source Database       : we

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-06-20 10:41:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for we_custom
-- ----------------------------
DROP TABLE IF EXISTS `we_custom`;
CREATE TABLE `we_custom` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `c_type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `f_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of we_custom
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
INSERT INTO `we_menu` VALUES ('2', '主要业务', '0', '0', null, null);
INSERT INTO `we_menu` VALUES ('3', '客户关系', '0', '0', null, null);
INSERT INTO `we_menu` VALUES ('4', '全局参数设定', '0', '1', null, null);
INSERT INTO `we_menu` VALUES ('5', '自动回复', '1', '0', null, null);
INSERT INTO `we_menu` VALUES ('6', '基础功能', '1', '0', null, null);
INSERT INTO `we_menu` VALUES ('7', '微站功能', '1', '0', null, null);
INSERT INTO `we_menu` VALUES ('8', '微CMS', '2', '0', null, null);
INSERT INTO `we_menu` VALUES ('9', '粉丝管理', '3', '0', null, null);
INSERT INTO `we_menu` VALUES ('10', '微会员', '3', '0', null, null);
INSERT INTO `we_menu` VALUES ('11', '公众号管理', '4', '1', 'account', 'display');
INSERT INTO `we_menu` VALUES ('12', '常用服务管理', '4', '1', null, null);
INSERT INTO `we_menu` VALUES ('13', '模块管理', '4', '1', null, null);
INSERT INTO `we_menu` VALUES ('14', '模板风格管理', '4', '1', null, null);
INSERT INTO `we_menu` VALUES ('15', '多用户管理', '4', '1', null, null);
INSERT INTO `we_menu` VALUES ('16', '云服务', '4', '1', null, null);
INSERT INTO `we_menu` VALUES ('17', '系统管理', '4', '1', null, null);
INSERT INTO `we_menu` VALUES ('18', '文字回复', '5', '0', 'rule', 'display');
INSERT INTO `we_menu` VALUES ('19', '图文回复', '5', '0', null, null);
INSERT INTO `we_menu` VALUES ('20', '音乐回复', '5', '0', null, null);
INSERT INTO `we_menu` VALUES ('21', '自定义接口回复', '5', '0', null, null);
INSERT INTO `we_menu` VALUES ('22', '常用服务接入', '5', '0', null, null);
INSERT INTO `we_menu` VALUES ('23', '自定义菜单', '5', '0', null, null);
INSERT INTO `we_menu` VALUES ('24', '特殊回复', '5', '0', null, null);
INSERT INTO `we_menu` VALUES ('25', '二维码推广', '6', '0', null, null);
INSERT INTO `we_menu` VALUES ('26', '模块设置', '6', '0', null, null);
INSERT INTO `we_menu` VALUES ('27', '当前公众号设置', '6', '0', null, null);
INSERT INTO `we_menu` VALUES ('28', '支付参数', '6', '0', null, null);
INSERT INTO `we_menu` VALUES ('29', '网站风格设置', '7', '0', null, null);
INSERT INTO `we_menu` VALUES ('30', '微站导航图标', '7', '0', null, null);
INSERT INTO `we_menu` VALUES ('31', '快捷菜单风格设置', '7', '0', null, null);
INSERT INTO `we_menu` VALUES ('32', '微站访问入口', '7', '0', null, null);
INSERT INTO `we_menu` VALUES ('33', '关键字触发列表', '8', '0', null, null);
INSERT INTO `we_menu` VALUES ('34', '微站导航设置', '8', '0', null, null);
INSERT INTO `we_menu` VALUES ('35', '文章管理', '8', '0', null, null);
INSERT INTO `we_menu` VALUES ('36', '文章分类', '8', '0', null, null);
INSERT INTO `we_menu` VALUES ('37', '微站导航设置', '9', '0', null, null);
INSERT INTO `we_menu` VALUES ('38', '粉丝管理选项', '9', '0', null, null);
INSERT INTO `we_menu` VALUES ('39', '地理位置分布', '9', '0', null, null);
INSERT INTO `we_menu` VALUES ('40', '粉丝分组', '9', '0', null, null);
INSERT INTO `we_menu` VALUES ('41', '粉丝列表', '9', '0', null, null);
INSERT INTO `we_menu` VALUES ('42', '优惠券入口设置', '10', '0', null, null);
INSERT INTO `we_menu` VALUES ('43', '会员卡入口设置', '10', '0', null, null);
INSERT INTO `we_menu` VALUES ('44', '微站导航设置', '10', '0', null, null);
INSERT INTO `we_menu` VALUES ('45', '消费密码管理', '10', '0', null, null);
INSERT INTO `we_menu` VALUES ('46', '优惠券管理', '10', '0', null, null);
INSERT INTO `we_menu` VALUES ('47', '商家设置', '10', '0', null, null);
INSERT INTO `we_menu` VALUES ('48', '会员管理', '10', '0', null, null);
INSERT INTO `we_menu` VALUES ('49', '会员卡设置', '10', '0', null, null);
INSERT INTO `we_menu` VALUES ('50', '模块列表', '13', '1', null, null);
INSERT INTO `we_menu` VALUES ('51', '模块设计', '13', '1', null, null);
INSERT INTO `we_menu` VALUES ('52', '微站风格管理', '14', '1', null, null);
INSERT INTO `we_menu` VALUES ('53', '站点风格管理', '14', '1', null, null);
INSERT INTO `we_menu` VALUES ('54', '资料设置', '15', '1', null, null);
INSERT INTO `we_menu` VALUES ('55', '注册设置', '15', '1', null, null);
INSERT INTO `we_menu` VALUES ('56', '用户管理', '15', '1', null, null);
INSERT INTO `we_menu` VALUES ('57', '用户组管理', '15', '1', null, null);
INSERT INTO `we_menu` VALUES ('58', '自动更新', '16', '1', null, null);
INSERT INTO `we_menu` VALUES ('59', '我的推广页面', '16', '1', null, null);
INSERT INTO `we_menu` VALUES ('60', '站点注册资料', '16', '1', null, null);
INSERT INTO `we_menu` VALUES ('61', '云服务状态诊断', '16', '1', null, null);
INSERT INTO `we_menu` VALUES ('62', '站点管理', '17', '1', null, null);
INSERT INTO `we_menu` VALUES ('63', '其他设置', '17', '1', null, null);
INSERT INTO `we_menu` VALUES ('64', '更新缓存', '17', '1', null, null);

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
INSERT INTO `we_type` VALUES ('4', '自定义接口回复');
INSERT INTO `we_type` VALUES ('5', '微CMS');

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
