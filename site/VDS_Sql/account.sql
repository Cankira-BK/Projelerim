/*
 Navicat Premium Data Transfer

 Source Server         : 31.58.244.32
 Source Server Type    : MySQL
 Source Server Version : 50562 (5.5.62)
 Source Host           : 31.58.244.32:3306
 Source Schema         : account

 Target Server Type    : MySQL
 Target Server Version : 50562 (5.5.62)
 File Encoding         : 65001

 Date: 17/02/2026 11:27:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) CHARACTER SET big5 COLLATE big5_chinese_ci NOT NULL DEFAULT '',
  `password` varchar(45) CHARACTER SET big5 COLLATE big5_chinese_ci NOT NULL DEFAULT '',
  `real_name` varchar(16) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT '',
  `social_id` varchar(7) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT '',
  `email` varchar(64) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT '',
  `phone1` varchar(16) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `phone2` varchar(16) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `address` varchar(128) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `zipcode` varchar(7) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT '',
  `create_time` datetime NULL DEFAULT '0000-00-00 00:00:00',
  `question1` varchar(48) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `answer1` varchar(48) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `question2` varchar(48) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `answer2` varchar(48) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `is_testor` tinyint(1) NULL DEFAULT 0,
  `status` varchar(8) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT 'OK',
  `securitycode` varchar(192) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT '',
  `newsletter` tinyint(1) NULL DEFAULT 0,
  `empire` tinyint(4) NULL DEFAULT 0,
  `name_checked` tinyint(1) NULL DEFAULT 0,
  `availDt` datetime NULL DEFAULT '0000-00-00 00:00:00',
  `mileage` int(11) NULL DEFAULT 0,
  `cash` int(11) NULL DEFAULT 0,
  `gold_expire` datetime NULL DEFAULT '2022-01-24 23:59:59',
  `silver_expire` datetime NULL DEFAULT '2022-01-24 23:59:59',
  `safebox_expire` datetime NULL DEFAULT '2022-01-24 23:59:59',
  `autoloot_expire` datetime NULL DEFAULT '2022-01-24 23:59:59',
  `fish_mind_expire` datetime NULL DEFAULT '2022-01-24 23:59:59',
  `marriage_fast_expire` datetime NULL DEFAULT '2022-01-24 23:59:59',
  `money_drop_rate_expire` datetime NULL DEFAULT '2022-01-24 23:59:59',
  `ttl_cash` int(11) NULL DEFAULT 0,
  `ttl_mileage` int(11) NULL DEFAULT 0,
  `channel_company` varchar(30) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT '',
  `ban_sure` varchar(30) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `ban_neden` varchar(30) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `ban_time` datetime NULL DEFAULT NULL,
  `ticket_id` varchar(30) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `kim_banlamis` varchar(30) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `coins` int(11) NULL DEFAULT 0,
  `web_admin` int(1) NULL DEFAULT 0,
  `web_ip` varchar(15) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `web_aktiviert` varchar(32) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `server` int(1) NULL DEFAULT 4,
  `bilgi` int(11) NULL DEFAULT 1,
  `email_onay` int(11) NULL DEFAULT 0,
  `last_play` datetime NULL DEFAULT NULL,
  `banacilis` varchar(25) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `dost` varchar(30) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `gecici` int(11) NULL DEFAULT 0,
  `ip` varchar(40) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT '0',
  `mailaktive` int(1) NULL DEFAULT 0,
  `t_status` int(11) NULL DEFAULT 0,
  `t_key` varchar(255) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT '0',
  `t_token` varchar(100) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT '0',
  `t_type` int(1) NULL DEFAULT 0,
  `t_date` datetime NULL DEFAULT '0000-00-00 00:00:00',
  `ticket_ban` int(1) NULL DEFAULT 0,
  `mac` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
  `language` tinyint(4) NULL DEFAULT 1,
  `tl_point` bigint(255) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `login`(`login`) USING BTREE,
  INDEX `social_id`(`social_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19869 CHARACTER SET = big5 COLLATE = big5_chinese_ci;

-- ----------------------------
-- Records of account
-- ----------------------------
BEGIN;
INSERT INTO `account` (`id`, `login`, `password`, `real_name`, `social_id`, `email`, `phone1`, `phone2`, `address`, `zipcode`, `create_time`, `question1`, `answer1`, `question2`, `answer2`, `is_testor`, `status`, `securitycode`, `newsletter`, `empire`, `name_checked`, `availDt`, `mileage`, `cash`, `gold_expire`, `silver_expire`, `safebox_expire`, `autoloot_expire`, `fish_mind_expire`, `marriage_fast_expire`, `money_drop_rate_expire`, `ttl_cash`, `ttl_mileage`, `channel_company`, `ban_sure`, `ban_neden`, `ban_time`, `ticket_id`, `kim_banlamis`, `coins`, `web_admin`, `web_ip`, `web_aktiviert`, `server`, `bilgi`, `email_onay`, `last_play`, `banacilis`, `dost`, `gecici`, `ip`, `mailaktive`, `t_status`, `t_key`, `t_token`, `t_type`, `t_date`, `ticket_ban`, `mac`, `language`, `tl_point`) VALUES (1, 'admin', '*00A51F3F48415C7D4E8908980D443C29C69B60C9', '', '7777776', '', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 0, 'OK', '', 0, 0, 0, '0000-00-00 00:00:00', 0, 8, '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', 0, 0, '', '', '', '0000-00-00 00:00:00', '', '', 2, 0, '', '', 4, 1, 0, '2026-02-06 02:23:50', '', '', 0, '0', 0, 0, '0', '0', 0, '0000-00-00 00:00:00', 0, 'E0:BE:03:19:BE:E0', 6, 89), (19862, 'cankira', '*1AE39E84C804B47EE39911AC4C8A5A6A25AB25F7', '', '', '', NULL, NULL, NULL, '', '2026-01-10 01:50:10', NULL, NULL, NULL, NULL, 0, 'OK', '', 0, 0, 0, '0000-00-00 00:00:00', 0, 17298, '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', 0, 0, '', NULL, NULL, NULL, NULL, NULL, 20852, 0, NULL, NULL, 4, 1, 0, '2026-02-17 11:15:02', NULL, NULL, 0, '0', 0, 0, '0', '0', 0, '0000-00-00 00:00:00', 0, '', 1, 0), (19863, 'cankira1', '*CC67043C7BCFF5EEA5566BD9B1F3C74FD9A5CF5D', 'cankira kilic', '1234567', 'cankira@hotmail.com', '5454321111', NULL, NULL, '', '2026-01-17 10:25:35', NULL, NULL, NULL, NULL, 0, 'OK', '', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', 0, 0, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 4, 1, 0, NULL, NULL, NULL, 0, '188.132.164.12', 0, 0, '0', '0', 0, '0000-00-00 00:00:00', 0, '', 1, 0), (19864, 'nuyagame', '*1B57A1E20F1CBB80509A3C899D981EAD0C08E0DD', 'kagan daban', '1234567', 'nuyaplayer@gmail.com', '5442238585', NULL, NULL, '', '2026-01-18 18:31:16', NULL, NULL, NULL, NULL, 0, 'OK', '', 0, 0, 0, '0000-00-00 00:00:00', 0, 1185, '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', 0, 0, '', NULL, NULL, NULL, NULL, NULL, 20000, 0, NULL, NULL, 4, 1, 0, '2026-02-16 00:12:29', NULL, NULL, 0, '176.236.186.90', 0, 0, '0', '0', 0, '0000-00-00 00:00:00', 0, '', 1, 0), (19865, 'bamsi80', '*7C40B74F169C9E5E32D11FF441E6F55129CC8624', 'Hasan ?elik', '1234567', 'asd@gmail.com', '5555555555', NULL, NULL, '', '2026-01-19 01:06:30', NULL, NULL, NULL, NULL, 0, 'OK', '', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', 0, 0, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 4, 1, 0, '2026-02-15 23:47:19', NULL, NULL, 0, '104.28.164.99', 0, 0, '0', '0', 0, '0000-00-00 00:00:00', 0, '', 1, 0), (19866, 'deneme', '*CC67043C7BCFF5EEA5566BD9B1F3C74FD9A5CF5D', 'deneme deneme', '1234567', 'deneme@hotmail.com', '5454454544', NULL, NULL, '', '2026-01-31 21:42:59', NULL, NULL, NULL, NULL, 0, 'OK', '', 0, 0, 0, '0000-00-00 00:00:00', 0, 20, '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', 0, 0, '', NULL, NULL, NULL, NULL, NULL, 30, 0, NULL, NULL, 4, 1, 0, '2026-02-17 10:40:22', NULL, NULL, 0, '188.132.164.12', 0, 0, '0', '0', 0, '0000-00-00 00:00:00', 0, '', 1, 0), (19867, 'nuyatest', '*1B57A1E20F1CBB80509A3C899D981EAD0C08E0DD', 'kagan', '1234567', 'naskdna@gmail.com', '5442238585', NULL, NULL, '', '2026-02-08 20:51:42', NULL, NULL, NULL, NULL, 0, 'OK', '', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', 0, 0, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 4, 1, 0, '2026-02-16 00:42:44', NULL, NULL, 0, '176.236.186.90', 0, 0, '0', '0', 0, '0000-00-00 00:00:00', 0, '', 1, 0), (19868, 'asilmahkum03', '*02BD515646AE09C4D22897CEB97A8284024C9EFE', 'bayram', '1111111', 'asilmahkum03@gmail.com', NULL, NULL, NULL, '', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 0, 'OK', '', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', '2022-01-24 23:59:59', 0, 0, '', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 4, 1, 0, NULL, NULL, NULL, 0, '0', 0, 0, '0', '0', 0, '0000-00-00 00:00:00', 0, '', 1, 0);
COMMIT;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(11) NOT NULL DEFAULT 0,
  `admin` varchar(50) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `password` varchar(50) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = big5 COLLATE = big5_chinese_ci;

-- ----------------------------
-- Records of admin
-- ----------------------------
BEGIN;
COMMIT;

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
-- Table structure for block_exception
-- ----------------------------
DROP TABLE IF EXISTS `block_exception`;
CREATE TABLE `block_exception`  (
  `login` int(11) NULL DEFAULT NULL
) ENGINE = MyISAM CHARACTER SET = big5 COLLATE = big5_chinese_ci;

-- ----------------------------
-- Records of block_exception
-- ----------------------------
BEGIN;
INSERT INTO `block_exception` (`login`) VALUES (100);
COMMIT;

-- ----------------------------
-- Table structure for gametime
-- ----------------------------
DROP TABLE IF EXISTS `gametime`;
CREATE TABLE `gametime`  (
  `UserID` varchar(50) CHARACTER SET euckr COLLATE euckr_korean_ci NOT NULL DEFAULT '',
  `paymenttype` tinyint(2) NOT NULL DEFAULT 1,
  `LimitTime` int(11) NULL DEFAULT 0,
  `LimitDt` datetime NULL DEFAULT '1990-01-01 00:00:00',
  `Scores` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`UserID`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = euckr COLLATE = euckr_korean_ci;

-- ----------------------------
-- Records of gametime
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for gametimeip
-- ----------------------------
DROP TABLE IF EXISTS `gametimeip`;
CREATE TABLE `gametimeip`  (
  `ipid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET euckr COLLATE euckr_korean_ci NULL DEFAULT NULL,
  `ip` varchar(11) CHARACTER SET euckr COLLATE euckr_korean_ci NOT NULL DEFAULT '000.000.000',
  `startIP` int(11) NOT NULL DEFAULT 0,
  `endIP` int(11) NOT NULL DEFAULT 255,
  `paymenttype` tinyint(2) NOT NULL DEFAULT 1,
  `LimitTime` int(11) NOT NULL DEFAULT 0,
  `LimitDt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `readme` varchar(128) CHARACTER SET euckr COLLATE euckr_korean_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ipid`) USING BTREE,
  UNIQUE INDEX `ip_uniq`(`ip`, `startIP`, `endIP`) USING BTREE,
  INDEX `ip_idx`(`ip`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = euckr COLLATE = euckr_korean_ci;

-- ----------------------------
-- Records of gametimeip
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for gametimelog
-- ----------------------------
DROP TABLE IF EXISTS `gametimelog`;
CREATE TABLE `gametimelog`  (
  `login` varchar(16) CHARACTER SET gb2312 COLLATE gb2312_chinese_ci NULL DEFAULT NULL,
  `type` enum('IP_FREE','FREE','IP_TIME','IP_DAY','TIME','DAY') CHARACTER SET gb2312 COLLATE gb2312_chinese_ci NULL DEFAULT NULL,
  `logon_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logout_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `use_time` int(11) NULL DEFAULT NULL,
  `ip` varchar(15) CHARACTER SET gb2312 COLLATE gb2312_chinese_ci NOT NULL DEFAULT '000.000.000.000',
  `server` varchar(32) CHARACTER SET gb2312 COLLATE gb2312_chinese_ci NOT NULL DEFAULT '',
  INDEX `login_key`(`login`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = gb2312 COLLATE = gb2312_chinese_ci;

-- ----------------------------
-- Records of gametimelog
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for iptocountry
-- ----------------------------
DROP TABLE IF EXISTS `iptocountry`;
CREATE TABLE `iptocountry`  (
  `IP_FROM` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `IP_TO` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `COUNTRY_NAME` varchar(56) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of iptocountry
-- ----------------------------
BEGIN;
INSERT INTO `iptocountry` (`IP_FROM`, `IP_TO`, `COUNTRY_NAME`) VALUES ('0.0.0.0', '0.0.0.0', 'NONE');
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
-- Table structure for monarch
-- ----------------------------
DROP TABLE IF EXISTS `monarch`;
CREATE TABLE `monarch`  (
  `empire` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `pid` int(10) UNSIGNED NULL DEFAULT 0,
  `name` varchar(16) CHARACTER SET big5 COLLATE big5_chinese_ci NULL DEFAULT NULL,
  `windate` datetime NULL DEFAULT '0000-00-00 00:00:00',
  `money` bigint(20) UNSIGNED NULL DEFAULT 0,
  PRIMARY KEY (`empire`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = big5 COLLATE = big5_chinese_ci;

-- ----------------------------
-- Records of monarch
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
-- Table structure for send_notice
-- ----------------------------
DROP TABLE IF EXISTS `send_notice`;
CREATE TABLE `send_notice`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) NOT NULL DEFAULT 0,
  `server` varchar(3) CHARACTER SET big5 COLLATE big5_chinese_ci NOT NULL DEFAULT '',
  `show_check` tinyint(2) NOT NULL DEFAULT 0,
  `content` text CHARACTER SET big5 COLLATE big5_chinese_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = big5 COLLATE = big5_chinese_ci;

-- ----------------------------
-- Records of send_notice
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
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of server_settings
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for string
-- ----------------------------
DROP TABLE IF EXISTS `string`;
CREATE TABLE `string`  (
  `name` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `text` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`name`, `text`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of string
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tele_block
-- ----------------------------
DROP TABLE IF EXISTS `tele_block`;
CREATE TABLE `tele_block`  (
  `account_id` int(11) NOT NULL DEFAULT 0,
  `lastlogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tele_block` varchar(30) CHARACTER SET big5 COLLATE big5_chinese_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`account_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = big5 COLLATE = big5_chinese_ci;

-- ----------------------------
-- Records of tele_block
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for server
-- ----------------------------
DROP TABLE IF EXISTS `server`;
CREATE TABLE `server`  ();
