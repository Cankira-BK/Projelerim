/*
Navicat MySQL Data Transfer

Source Server         : Nemeria Siber
Source Server Version : 50651
Source Host           : 185.124.85.210:3306
Source Database       : player

Target Server Type    : MYSQL
Target Server Version : 50651
File Encoding         : 65001

Date: 2022-11-10 02:18:28
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `item_shop_table`
-- ----------------------------
DROP TABLE IF EXISTS `item_shop_table`;
CREATE TABLE `item_shop_table` (
  `itemID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL DEFAULT '0',
  `subCategoryID` int(11) NOT NULL,
  `itemVnum` int(11) NOT NULL,
  `itemPrice` int(11) NOT NULL,
  `itemPriceOld` int(11) NOT NULL DEFAULT '0',
  `itemCount` int(11) NOT NULL,
  `itemSocketZero` int(11) NOT NULL DEFAULT '0',
  `itemMark` int(11) NOT NULL,
  `socket0` int(11) NOT NULL DEFAULT '0',
  `socket1` int(11) NOT NULL DEFAULT '0',
  `socket2` int(11) NOT NULL DEFAULT '0',
  `socket3` int(11) NOT NULL DEFAULT '0',
  `socket4` int(11) NOT NULL DEFAULT '0',
  `socket5` int(11) NOT NULL DEFAULT '0',
  `type0` int(11) NOT NULL DEFAULT '0',
  `value0` int(11) NOT NULL DEFAULT '0',
  `type1` int(11) NOT NULL DEFAULT '0',
  `value1` int(11) NOT NULL DEFAULT '0',
  `type2` int(11) NOT NULL DEFAULT '0',
  `value2` int(11) NOT NULL DEFAULT '0',
  `type3` int(11) NOT NULL DEFAULT '0',
  `value3` int(11) NOT NULL DEFAULT '0',
  `type4` int(11) NOT NULL DEFAULT '0',
  `value4` int(11) NOT NULL DEFAULT '0',
  `type5` int(11) NOT NULL DEFAULT '0',
  `value5` int(11) NOT NULL DEFAULT '0',
  `type6` int(11) NOT NULL DEFAULT '0',
  `value6` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`itemID`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of item_shop_table
-- ----------------------------
INSERT INTO `item_shop_table` VALUES ('1007', '3', '0', '8899', '50', '0', '1', '1296000', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `item_shop_table` VALUES ('1079', '0', '0', '70253', '50', '0', '100', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');