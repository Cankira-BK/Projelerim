/*
 Navicat Premium Data Transfer

 Source Server         : 31.58.244.32
 Source Server Type    : MySQL
 Source Server Version : 50562 (5.5.62)
 Source Host           : 31.58.244.32:3306
 Source Schema         : metin2_runup

 Target Server Type    : MySQL
 Target Server Version : 50562 (5.5.62)
 File Encoding         : 65001

 Date: 17/02/2026 12:44:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for 01_level_bw
-- ----------------------------
DROP TABLE IF EXISTS `01_level_bw`;
CREATE TABLE `01_level_bw`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_date` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `level_01` int(8) NOT NULL DEFAULT 0,
  `level_02` int(8) NOT NULL DEFAULT 0,
  `level_03` int(8) NOT NULL DEFAULT 0,
  `level_04` int(8) NOT NULL DEFAULT 0,
  `level_05` int(8) NOT NULL DEFAULT 0,
  `level_06` int(8) NOT NULL DEFAULT 0,
  `level_07` int(8) NOT NULL DEFAULT 0,
  `level_08` int(8) NOT NULL DEFAULT 0,
  `level_09` int(8) NOT NULL DEFAULT 0,
  `level_10` int(8) NOT NULL DEFAULT 0,
  `level_11` int(8) NOT NULL DEFAULT 0,
  `level_12` int(8) NOT NULL DEFAULT 0,
  `level_13` int(8) NOT NULL DEFAULT 0,
  `level_14` int(8) NOT NULL DEFAULT 0,
  `level_15` int(8) NOT NULL DEFAULT 0,
  `level_16` int(8) NOT NULL DEFAULT 0,
  `level_17` int(8) NOT NULL DEFAULT 0,
  `level_18` int(8) NOT NULL DEFAULT 0,
  `level_19` int(8) NOT NULL DEFAULT 0,
  `level_20` int(8) NOT NULL DEFAULT 0,
  `level_21` int(8) NOT NULL DEFAULT 0,
  `level_22` int(8) NOT NULL DEFAULT 0,
  `level_23` int(8) NOT NULL DEFAULT 0,
  `level_24` int(8) NOT NULL DEFAULT 0,
  `level_25` int(8) NOT NULL DEFAULT 0,
  `level_26` int(8) NOT NULL DEFAULT 0,
  `level_27` int(8) NOT NULL DEFAULT 0,
  `level_28` int(8) NOT NULL DEFAULT 0,
  `level_29` int(8) NOT NULL DEFAULT 0,
  `level_30` int(8) NOT NULL DEFAULT 0,
  `level_31` int(8) NOT NULL DEFAULT 0,
  `level_32` int(8) NOT NULL DEFAULT 0,
  `level_33` int(8) NOT NULL DEFAULT 0,
  `level_34` int(8) NOT NULL DEFAULT 0,
  `level_35` int(8) NOT NULL DEFAULT 0,
  `level_36` int(8) NOT NULL DEFAULT 0,
  `level_37` int(8) NOT NULL DEFAULT 0,
  `level_38` int(8) NOT NULL DEFAULT 0,
  `level_39` int(8) NOT NULL DEFAULT 0,
  `level_40` int(8) NOT NULL DEFAULT 0,
  `level_41` int(8) NOT NULL DEFAULT 0,
  `level_42` int(8) NOT NULL DEFAULT 0,
  `level_43` int(8) NOT NULL DEFAULT 0,
  `level_44` int(8) NOT NULL DEFAULT 0,
  `level_45` int(8) NOT NULL DEFAULT 0,
  `level_46` int(8) NOT NULL DEFAULT 0,
  `level_47` int(8) NOT NULL DEFAULT 0,
  `level_48` int(8) NOT NULL DEFAULT 0,
  `level_49` int(8) NOT NULL DEFAULT 0,
  `level_50` int(8) NOT NULL DEFAULT 0,
  `level_51` int(8) NOT NULL DEFAULT 0,
  `level_52` int(8) NOT NULL DEFAULT 0,
  `level_53` int(8) NOT NULL DEFAULT 0,
  `level_54` int(8) NOT NULL DEFAULT 0,
  `level_55` int(8) NOT NULL DEFAULT 0,
  `level_56` int(8) NOT NULL DEFAULT 0,
  `level_57` int(8) NOT NULL DEFAULT 0,
  `level_58` int(8) NOT NULL DEFAULT 0,
  `level_59` int(8) NOT NULL DEFAULT 0,
  `level_60` int(8) NOT NULL DEFAULT 0,
  `level_61` int(8) NOT NULL DEFAULT 0,
  `level_62` int(8) NOT NULL DEFAULT 0,
  `level_63` int(8) NOT NULL DEFAULT 0,
  `level_64` int(8) NOT NULL DEFAULT 0,
  `level_65` int(8) NOT NULL DEFAULT 0,
  `level_66` int(8) NOT NULL DEFAULT 0,
  `level_67` int(8) NOT NULL DEFAULT 0,
  `level_68` int(8) NOT NULL DEFAULT 0,
  `level_69` int(8) NOT NULL DEFAULT 0,
  `level_70` int(8) NOT NULL DEFAULT 0,
  `level_71` int(8) NOT NULL DEFAULT 0,
  `level_72` int(8) NOT NULL DEFAULT 0,
  `level_73` int(8) NOT NULL DEFAULT 0,
  `level_74` int(8) NOT NULL DEFAULT 0,
  `level_75` int(8) NOT NULL DEFAULT 0,
  `level_76` int(8) NOT NULL DEFAULT 0,
  `level_77` int(8) NOT NULL DEFAULT 0,
  `level_78` int(8) NOT NULL DEFAULT 0,
  `level_79` int(8) NOT NULL DEFAULT 0,
  `level_80` int(8) NOT NULL DEFAULT 0,
  `level_81` int(8) NOT NULL DEFAULT 0,
  `level_82` int(8) NOT NULL DEFAULT 0,
  `level_83` int(8) NOT NULL DEFAULT 0,
  `level_84` int(8) NOT NULL DEFAULT 0,
  `level_85` int(8) NOT NULL DEFAULT 0,
  `level_86` int(8) NOT NULL DEFAULT 0,
  `level_87` int(8) NOT NULL DEFAULT 0,
  `level_88` int(8) NOT NULL DEFAULT 0,
  `level_89` int(8) NOT NULL DEFAULT 0,
  `level_90` int(8) NOT NULL DEFAULT 0,
  `level_91` int(8) NOT NULL DEFAULT 0,
  `level_92` int(8) NOT NULL DEFAULT 0,
  `level_93` int(8) NOT NULL DEFAULT 0,
  `level_94` int(8) NOT NULL DEFAULT 0,
  `level_95` int(8) NOT NULL DEFAULT 0,
  `level_96` int(8) NOT NULL DEFAULT 0,
  `level_97` int(8) NOT NULL DEFAULT 0,
  `level_98` int(8) NOT NULL DEFAULT 0,
  `level_99` int(8) NOT NULL DEFAULT 0,
  `last_play_5` int(8) NOT NULL DEFAULT 0,
  `last_play_4` int(8) NOT NULL DEFAULT 0,
  `last_play_3` int(8) NOT NULL DEFAULT 0,
  `last_play_2` int(8) NOT NULL DEFAULT 0,
  `last_play_1` int(8) NOT NULL DEFAULT 0,
  `today_play` int(8) NOT NULL DEFAULT 0,
  `today_user` int(8) NULL DEFAULT 0,
  `today_user_unreal` int(8) NULL DEFAULT 0,
  `total_user` int(8) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of 01_level_bw
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for 02_level_bw
-- ----------------------------
DROP TABLE IF EXISTS `02_level_bw`;
CREATE TABLE `02_level_bw`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_date` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `level_01` int(8) NOT NULL DEFAULT 0,
  `level_02` int(8) NOT NULL DEFAULT 0,
  `level_03` int(8) NOT NULL DEFAULT 0,
  `level_04` int(8) NOT NULL DEFAULT 0,
  `level_05` int(8) NOT NULL DEFAULT 0,
  `level_06` int(8) NOT NULL DEFAULT 0,
  `level_07` int(8) NOT NULL DEFAULT 0,
  `level_08` int(8) NOT NULL DEFAULT 0,
  `level_09` int(8) NOT NULL DEFAULT 0,
  `level_10` int(8) NOT NULL DEFAULT 0,
  `level_11` int(8) NOT NULL DEFAULT 0,
  `level_12` int(8) NOT NULL DEFAULT 0,
  `level_13` int(8) NOT NULL DEFAULT 0,
  `level_14` int(8) NOT NULL DEFAULT 0,
  `level_15` int(8) NOT NULL DEFAULT 0,
  `level_16` int(8) NOT NULL DEFAULT 0,
  `level_17` int(8) NOT NULL DEFAULT 0,
  `level_18` int(8) NOT NULL DEFAULT 0,
  `level_19` int(8) NOT NULL DEFAULT 0,
  `level_20` int(8) NOT NULL DEFAULT 0,
  `level_21` int(8) NOT NULL DEFAULT 0,
  `level_22` int(8) NOT NULL DEFAULT 0,
  `level_23` int(8) NOT NULL DEFAULT 0,
  `level_24` int(8) NOT NULL DEFAULT 0,
  `level_25` int(8) NOT NULL DEFAULT 0,
  `level_26` int(8) NOT NULL DEFAULT 0,
  `level_27` int(8) NOT NULL DEFAULT 0,
  `level_28` int(8) NOT NULL DEFAULT 0,
  `level_29` int(8) NOT NULL DEFAULT 0,
  `level_30` int(8) NOT NULL DEFAULT 0,
  `level_31` int(8) NOT NULL DEFAULT 0,
  `level_32` int(8) NOT NULL DEFAULT 0,
  `level_33` int(8) NOT NULL DEFAULT 0,
  `level_34` int(8) NOT NULL DEFAULT 0,
  `level_35` int(8) NOT NULL DEFAULT 0,
  `level_36` int(8) NOT NULL DEFAULT 0,
  `level_37` int(8) NOT NULL DEFAULT 0,
  `level_38` int(8) NOT NULL DEFAULT 0,
  `level_39` int(8) NOT NULL DEFAULT 0,
  `level_40` int(8) NOT NULL DEFAULT 0,
  `level_41` int(8) NOT NULL DEFAULT 0,
  `level_42` int(8) NOT NULL DEFAULT 0,
  `level_43` int(8) NOT NULL DEFAULT 0,
  `level_44` int(8) NOT NULL DEFAULT 0,
  `level_45` int(8) NOT NULL DEFAULT 0,
  `level_46` int(8) NOT NULL DEFAULT 0,
  `level_47` int(8) NOT NULL DEFAULT 0,
  `level_48` int(8) NOT NULL DEFAULT 0,
  `level_49` int(8) NOT NULL DEFAULT 0,
  `level_50` int(8) NOT NULL DEFAULT 0,
  `level_51` int(8) NOT NULL DEFAULT 0,
  `level_52` int(8) NOT NULL DEFAULT 0,
  `level_53` int(8) NOT NULL DEFAULT 0,
  `level_54` int(8) NOT NULL DEFAULT 0,
  `level_55` int(8) NOT NULL DEFAULT 0,
  `level_56` int(8) NOT NULL DEFAULT 0,
  `level_57` int(8) NOT NULL DEFAULT 0,
  `level_58` int(8) NOT NULL DEFAULT 0,
  `level_59` int(8) NOT NULL DEFAULT 0,
  `level_60` int(8) NOT NULL DEFAULT 0,
  `level_61` int(8) NOT NULL DEFAULT 0,
  `level_62` int(8) NOT NULL DEFAULT 0,
  `level_63` int(8) NOT NULL DEFAULT 0,
  `level_64` int(8) NOT NULL DEFAULT 0,
  `level_65` int(8) NOT NULL DEFAULT 0,
  `level_66` int(8) NOT NULL DEFAULT 0,
  `level_67` int(8) NOT NULL DEFAULT 0,
  `level_68` int(8) NOT NULL DEFAULT 0,
  `level_69` int(8) NOT NULL DEFAULT 0,
  `level_70` int(8) NOT NULL DEFAULT 0,
  `level_71` int(8) NOT NULL DEFAULT 0,
  `level_72` int(8) NOT NULL DEFAULT 0,
  `level_73` int(8) NOT NULL DEFAULT 0,
  `level_74` int(8) NOT NULL DEFAULT 0,
  `level_75` int(8) NOT NULL DEFAULT 0,
  `level_76` int(8) NOT NULL DEFAULT 0,
  `level_77` int(8) NOT NULL DEFAULT 0,
  `level_78` int(8) NOT NULL DEFAULT 0,
  `level_79` int(8) NOT NULL DEFAULT 0,
  `level_80` int(8) NOT NULL DEFAULT 0,
  `level_81` int(8) NOT NULL DEFAULT 0,
  `level_82` int(8) NOT NULL DEFAULT 0,
  `level_83` int(8) NOT NULL DEFAULT 0,
  `level_84` int(8) NOT NULL DEFAULT 0,
  `level_85` int(8) NOT NULL DEFAULT 0,
  `level_86` int(8) NOT NULL DEFAULT 0,
  `level_87` int(8) NOT NULL DEFAULT 0,
  `level_88` int(8) NOT NULL DEFAULT 0,
  `level_89` int(8) NOT NULL DEFAULT 0,
  `level_90` int(8) NOT NULL DEFAULT 0,
  `level_91` int(8) NOT NULL DEFAULT 0,
  `level_92` int(8) NOT NULL DEFAULT 0,
  `level_93` int(8) NOT NULL DEFAULT 0,
  `level_94` int(8) NOT NULL DEFAULT 0,
  `level_95` int(8) NOT NULL DEFAULT 0,
  `level_96` int(8) NOT NULL DEFAULT 0,
  `level_97` int(8) NOT NULL DEFAULT 0,
  `level_98` int(8) NOT NULL DEFAULT 0,
  `level_99` int(8) NOT NULL DEFAULT 0,
  `last_play_5` int(8) NOT NULL DEFAULT 0,
  `last_play_4` int(8) NOT NULL DEFAULT 0,
  `last_play_3` int(8) NOT NULL DEFAULT 0,
  `last_play_2` int(8) NOT NULL DEFAULT 0,
  `last_play_1` int(8) NOT NULL DEFAULT 0,
  `today_play` int(8) NOT NULL DEFAULT 0,
  `today_user` int(8) NULL DEFAULT 0,
  `today_user_unreal` int(8) NULL DEFAULT 0,
  `total_user` int(8) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of 02_level_bw
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for send_event
-- ----------------------------
DROP TABLE IF EXISTS `send_event`;
CREATE TABLE `send_event`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `e_type` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `e_value` int(5) NOT NULL DEFAULT 0,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of send_event
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
  `server` char(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `show_check` tinyint(2) NOT NULL DEFAULT 0,
  `content` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci;

-- ----------------------------
-- Records of send_notice
-- ----------------------------
BEGIN;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
