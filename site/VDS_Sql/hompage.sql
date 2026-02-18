/*
 Navicat Premium Data Transfer

 Source Server         : 31.58.244.32
 Source Server Type    : MySQL
 Source Server Version : 50562 (5.5.62)
 Source Host           : 31.58.244.32:3306
 Source Schema         : hompage

 Target Server Type    : MySQL
 Target Server Version : 50562 (5.5.62)
 File Encoding         : 65001

 Date: 17/02/2026 11:28:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ban_log
-- ----------------------------
DROP TABLE IF EXISTS `ban_log`;
CREATE TABLE `ban_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` datetime NOT NULL,
  `grund` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `typ` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of ban_log
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for is_items
-- ----------------------------
DROP TABLE IF EXISTS `is_items`;
CREATE TABLE `is_items`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vnum` int(10) UNSIGNED NOT NULL,
  `kategorie_id` int(10) UNSIGNED NOT NULL,
  `bild` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `beschreibung` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `preis` int(10) UNSIGNED NOT NULL,
  `anzeigen` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `attrtype0` tinyint(4) NOT NULL DEFAULT 0,
  `attrvalue0` smallint(6) NOT NULL DEFAULT 0,
  `attrtype1` tinyint(4) NOT NULL DEFAULT 0,
  `attrvalue1` smallint(6) NOT NULL DEFAULT 0,
  `attrtype2` tinyint(4) NOT NULL DEFAULT 0,
  `attrvalue2` smallint(6) NOT NULL DEFAULT 0,
  `attrtype3` tinyint(4) NOT NULL DEFAULT 0,
  `attrvalue3` smallint(6) NOT NULL DEFAULT 0,
  `attrtype4` tinyint(4) NOT NULL DEFAULT 0,
  `attrvalue4` smallint(6) NOT NULL DEFAULT 0,
  `attrtype5` tinyint(4) NOT NULL DEFAULT 0,
  `attrvalue5` smallint(6) NOT NULL DEFAULT 0,
  `attrtype6` tinyint(4) NOT NULL DEFAULT 0,
  `attrvalue6` smallint(6) NOT NULL DEFAULT 0,
  `socket0` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `socket1` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `socket2` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `socket3` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `socket4` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `socket5` int(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of is_items
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for is_kategorien
-- ----------------------------
DROP TABLE IF EXISTS `is_kategorien`;
CREATE TABLE `is_kategorien`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titel` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of is_kategorien
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for is_log
-- ----------------------------
DROP TABLE IF EXISTS `is_log`;
CREATE TABLE `is_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_id` int(10) UNSIGNED NOT NULL,
  `vnum` int(10) UNSIGNED NOT NULL,
  `preis` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of is_log
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titel` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `inhalt` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `datum` int(10) UNSIGNED NOT NULL,
  `hot` tinyint(1) NOT NULL,
  `kategorie` int(10) UNSIGNED NOT NULL,
  `author` int(10) UNSIGNED NOT NULL,
  `anzeigen` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of news
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for psc_log
-- ----------------------------
DROP TABLE IF EXISTS `psc_log`;
CREATE TABLE `psc_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `admin_id` int(11) NULL DEFAULT NULL,
  `card_type` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `waehrung` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `psc_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `psc_betrag` decimal(5, 2) NOT NULL,
  `psc_pass` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `kommentar` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `datum` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of psc_log
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for server_settings
-- ----------------------------
DROP TABLE IF EXISTS `server_settings`;
CREATE TABLE `server_settings`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `variable` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `beschreibung` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `typ` enum('CHA','BOO','INT','DEC') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `value` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `variable`(`variable`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of server_settings
-- ----------------------------
BEGIN;
INSERT INTO `server_settings` (`id`, `variable`, `beschreibung`, `typ`, `value`) VALUES (1, 'maxGoldRate', 'Faktor der max. Gold-Drop-Rate', 'DEC', '1'), (2, 'expRate', 'Faktor der EXP-Rate', 'DEC', '1'), (3, 'minGoldRate', 'Faktor der minimalen Gold-Drop-Rate', 'DEC', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
