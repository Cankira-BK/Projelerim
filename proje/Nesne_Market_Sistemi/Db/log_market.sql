/*
Navicat MySQL Data Transfer

Source Server         : Nemeria Siber
Source Server Version : 50651
Source Host           : 185.124.85.210:3306
Source Database       : player

Target Server Type    : MYSQL
Target Server Version : 50651
File Encoding         : 65001

Date: 2022-11-10 02:19:23
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `log_market`
-- ----------------------------
DROP TABLE IF EXISTS `log_market`;
CREATE TABLE `log_market` (
  `id` int(15) NOT NULL,
  `alan` varchar(255) CHARACTER SET latin5 NOT NULL,
  `pid` int(15) DEFAULT NULL,
  `account_id` int(15) DEFAULT NULL,
  `item_isim` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs DEFAULT NULL,
  `item_kod` int(15) DEFAULT NULL,
  `count` int(15) DEFAULT '1',
  `tarih` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of log_market
-- ----------------------------
