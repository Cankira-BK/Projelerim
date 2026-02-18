/*
 Navicat Premium Data Transfer

 Source Server         : 31.58.244.32
 Source Server Type    : MySQL
 Source Server Version : 50562 (5.5.62)
 Source Host           : 31.58.244.32:3306
 Source Schema         : common

 Target Server Type    : MySQL
 Target Server Version : 50562 (5.5.62)
 File Encoding         : 65001

 Date: 17/02/2026 11:27:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for gmhost
-- ----------------------------
DROP TABLE IF EXISTS `gmhost`;
CREATE TABLE `gmhost`  (
  `mIP` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT ''
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of gmhost
-- ----------------------------
BEGIN;
INSERT INTO `gmhost` (`mIP`) VALUES ('127.0.0.1');
COMMIT;

-- ----------------------------
-- Table structure for gmlist
-- ----------------------------
DROP TABLE IF EXISTS `gmlist`;
CREATE TABLE `gmlist`  (
  `mID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mAccount` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `mName` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `mContactIP` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `mServerIP` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'ALL',
  `mAuthority` enum('IMPLEMENTOR','HIGH_WIZARD','GOD','LOW_WIZARD','PLAYER') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'PLAYER',
  PRIMARY KEY (`mID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of gmlist
-- ----------------------------
BEGIN;
INSERT INTO `gmlist` (`mID`, `mAccount`, `mName`, `mContactIP`, `mServerIP`, `mAuthority`) VALUES (10, 'bordo', '[TL]FRODO', '', 'ALL', 'IMPLEMENTOR'), (14, 'nuyagame', '[TL]Nuya2', '', 'ALL', 'IMPLEMENTOR'), (13, 'cankira', '[TL]Cankira', '', 'ALL', 'IMPLEMENTOR'), (12, 'bamsi80', 'HAYDO', '', 'ALL', 'IMPLEMENTOR'), (11, 'canbutmad', '[GM]CAN', '', 'ALL', 'IMPLEMENTOR');
COMMIT;

-- ----------------------------
-- Table structure for locale
-- ----------------------------
DROP TABLE IF EXISTS `locale`;
CREATE TABLE `locale`  (
  `mKey` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `mValue` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`mKey`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of locale
-- ----------------------------
BEGIN;
INSERT INTO `locale` (`mKey`, `mValue`) VALUES ('SKILL_POWER_BY_LEVEL_TYPE0', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125'), ('SKILL_POWER_BY_LEVEL_TYPE1', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125'), ('SKILL_POWER_BY_LEVEL_TYPE2', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125'), ('SKILL_POWER_BY_LEVEL_TYPE3', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125'), ('SKILL_POWER_BY_LEVEL_TYPE4', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125'), ('SKILL_POWER_BY_LEVEL_TYPE5', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125'), ('SKILL_POWER_BY_LEVEL_TYPE6', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125'), ('SKILL_POWER_BY_LEVEL_TYPE7', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125'), ('LOCALE', 'turkey'), ('DB_NAME_COLUMN', 'locale_name'), ('SKILL_DAMAGE_BY_LEVEL_UNDER_90', '0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0'), ('SKILL_DAMAGE_BY_LEVEL_UNDER_45', '0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0'), ('SKILL_POWER_BY_LEVEL', '0 5 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 50 52 54 56 58 60 63 66 69 72 82 85 88 91 94 98 102 106 110 115 125 125 125 125 125');
COMMIT;

-- ----------------------------
-- Table structure for locale_bug
-- ----------------------------
DROP TABLE IF EXISTS `locale_bug`;
CREATE TABLE `locale_bug`  (
  `mKey` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `mValue` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`mKey`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of locale_bug
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for spam_db
-- ----------------------------
DROP TABLE IF EXISTS `spam_db`;
CREATE TABLE `spam_db`  (
  `type` set('GOOD','SPAM') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'SPAM',
  `word` varchar(256) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `score` int(11) NOT NULL DEFAULT 10,
  PRIMARY KEY (`word`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of spam_db
-- ----------------------------
BEGIN;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
