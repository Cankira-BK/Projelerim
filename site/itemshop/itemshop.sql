/*
Navicat MySQL Data Transfer

Source Server         : M2 - Files
Source Server Version : 50537
Source Host           : 192.168.0.118:3306
Source Database       : itemshop

Target Server Type    : MYSQL
Target Server Version : 50537
File Encoding         : 65001

Date: 2021-06-01 16:17:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ishop_category`
-- ----------------------------
DROP TABLE IF EXISTS `ishop_category`;
CREATE TABLE `ishop_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE latin2_hungarian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=latin2 COLLATE=latin2_hungarian_ci;

-- ----------------------------
-- Records of ishop_category
-- ----------------------------
INSERT INTO `ishop_category` VALUES ('1', 'V&eacute;rtek');
INSERT INTO `ishop_category` VALUES ('2', 'Fegyverek');
INSERT INTO `ishop_category` VALUES ('4', 'Pajzs-sisak');
INSERT INTO `ishop_category` VALUES ('5', 'Cip&otilde;k');
INSERT INTO `ishop_category` VALUES ('6', 'K&ouml;vek');
INSERT INTO `ishop_category` VALUES ('7', '&Ouml;vek-gy&#369;r&#369;k');
INSERT INTO `ishop_category` VALUES ('8', 'Fejleszt&eacute;s-biosz.');
INSERT INTO `ishop_category` VALUES ('9', 'Pecs&eacute;tek');
INSERT INTO `ishop_category` VALUES ('11', 'Koszt&uuml;m&ouml;k');
INSERT INTO `ishop_category` VALUES ('12', 'S&eacute; jegyek');
INSERT INTO `ishop_category` VALUES ('13', 'Alk&iacute;mia');
INSERT INTO `ishop_category` VALUES ('30', '&Eacute;kszerek');
INSERT INTO `ishop_category` VALUES ('31', 'Egy&eacute;b t&aacute;rgyak');

-- ----------------------------
-- Table structure for `ishop_items`
-- ----------------------------
DROP TABLE IF EXISTS `ishop_items`;
CREATE TABLE `ishop_items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name_item` varchar(255) COLLATE latin2_hungarian_ci NOT NULL,
  `category` int(11) DEFAULT NULL,
  `desc` varchar(255) COLLATE latin2_hungarian_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `count` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `vnum` int(11) unsigned NOT NULL DEFAULT '0',
  `vnum_icon` varchar(11) COLLATE latin2_hungarian_ci NOT NULL,
  `date_added` datetime NOT NULL,
  `socket0` int(10) unsigned NOT NULL DEFAULT '0',
  `socket1` int(10) unsigned NOT NULL DEFAULT '0',
  `socket2` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `item_vnum_index` (`vnum`)
) ENGINE=MyISAM AUTO_INCREMENT=1504 DEFAULT CHARSET=latin2 COLLATE=latin2_hungarian_ci;

-- ----------------------------
-- Records of ishop_items
-- ----------------------------
INSERT INTO `ishop_items` VALUES ('725', 'Fekete p&aacute;rduc pecs&eacute;t ', '9', '4500 TP-t, 30% sz&ouml;rny elleni er&otilde;t, 150 v&eacute;delmet,  20% kritet biztos&iacute;t sz&aacute;modra. 7 napos, az id&otilde; csak akkor telik ha rajta vag', '3500', '1', '71176', '71131', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('715', 'Kir&aacute;lytigris pecs&eacute;t (k) ', '9', '3500 TP-t, 25% sz&ouml;rny elleni er&otilde;t, 100 v&eacute;delmet biztos&iacute;t sz&aacute;modra. 7 napos, az id&otilde; csak akkor telik ha rajta vagy.', '2500', '1', '71137', '71137', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('716', 'Kir&aacute;lytigris pecs&eacute;t (v) ', '9', '3500 TP-t, 25% sz&ouml;rny elleni er&otilde;t, 100 v&eacute;delmet biztos&iacute;t sz&aacute;modra. 7 napos, az id&otilde; csak akkor telik ha rajta vagy.', '2500', '1', '71138', '71138', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('717', 'Kir&aacute;lytigris pecs&eacute;t (a) ', '9', '3500 TP-t, 25% sz&ouml;rny elleni er&otilde;t, 100 v&eacute;delmet biztos&iacute;t sz&aacute;modra. 7 napos, az id&otilde; csak akkor telik ha rajta vagy.', '2500', '1', '71139', '71139', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('718', 'Kir&aacute;lytigris pecs&eacute;t (z) ', '9', '3500 TP-t, 25% sz&ouml;rny elleni er&otilde;t, 100 v&eacute;delmet biztos&iacute;t sz&aacute;modra. 7 napos, az id&otilde; csak akkor telik ha rajta vagy.', '2500', '1', '71140', '71140', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('719', 'Kir&aacute;lytigris pecs&eacute;t (sz) ', '9', '3500 TP-t, 25% sz&ouml;rny elleni er&otilde;t, 100 v&eacute;delmet biztos&iacute;t sz&aacute;modra. 7 napos, az id&otilde; csak akkor telik ha rajta vagy.', '2500', '1', '71141', '71141', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('720', 'Kir&aacute;lytigris pecs&eacute;t (f) ', '9', '3500 TP-t, 25% sz&ouml;rny elleni er&otilde;t, 100 v&eacute;delmet biztos&iacute;t sz&aacute;modra. 7 napos, az id&otilde; csak akkor telik ha rajta vagy.', '2500', '1', '71142', '71142', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('130', 'B&ouml;lcsess&eacute;g itala', '31', '100% exp b&oacute;nusz 1 &oacute;r&aacute;ra', '500', '1', '71153', '71153', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('723', 'Equus Porphyreus pecs&eacute;t ', '9', '4000 TP-t, 25% sz&ouml;rny elleni er&otilde;t, 100 v&eacute;delmet, 15 kritet biztos&iacute;t sz&aacute;modra. 7 napos, az id&otilde; csak akkor telik ha rajta vagy.', '3000', '1', '71161', '71161', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('721', 'Sarki ragadoz&oacute;-pecs&eacute;t ', '9', '4000 TP-t, 25% sz&ouml;rny elleni er&otilde;t, 100 v&eacute;delmet, 15 kritet biztos&iacute;t sz&aacute;modra. 7 napos, az id&otilde; csak akkor telik ha rajta vagy', '3000', '1', '71165', '71131', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('722', 'P&aacute;nc&eacute;lozott panda-pecs&eacute;t ', '9', '4000 TP-t, 25% sz&ouml;rny elleni er&otilde;t, 100 v&eacute;delmet, 15 kritet biztos&iacute;t sz&aacute;modra. 7 napos, az id&otilde; csak akkor telik ha ', '3000', '1', '71166', '71131', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('727', 'Egyszarv&uacute;-pecs&eacute;t ', '9', '5000 TP-t, 35% sz&ouml;rny elleni er&otilde;t, 200 v&eacute;delmet 25% kritet biztos&iacute;t sz&aacute;modra. 7 napos, az id&otilde; csak akkor telik ha rajta vagy.', '4000', '1', '71171', '71171', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('728', 'R&eacute;m&aacute;lom-pecs&eacute;t ', '9', '5000 TP-t, 35% sz&ouml;rny elleni er&otilde;t, 200 v&eacute;delmet 25% kritet biztos&iacute;t sz&aacute;modra. 7 napos, az id&otilde; csak akkor telik ha rajta vagy', '4000', '1', '71172', '71172', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('375', 'Bel&eacute;p&eacute;si enged&eacute;ly (P)', '31', '', '200', '1', '71175', '71174', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('739', 'Rufusz pecs&eacute;t (pet) ', '9', '2500 TP-t, 15% kritet biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 2. Szint&ucirc; pet.', '1500', '1', '53013', '53008', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('752', 'Minih&oacute;h&eacute;r-pecs&eacute;t (pet) ', '9', '4500 TP-t, 30% kritet, 30% f&eacute;lember elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 4. Szint&ucirc; pet.', '3500', '1', '53014', '53008', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('758', 'Minih&oacute;h&eacute;r-pecs&eacute;t (arany) (pet) ', '9', '5500 TP-t, 35% kritet, 35% f&eacute;lember elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 5. Szint&ucirc; pet', '4500', '1', '53015', '53008', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('741', 'Csonti pecs&eacute;t (pet) ', '9', '3500 TP-t, 25% kritet 15% f&eacute;lember elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 3. Szint&ucirc; pet.', '2500', '1', '53016', '53016', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('740', 'J&aacute;de f&otilde;nix-pecs&eacute;t (pet) ', '9', '3500 TP-t, 25% kritet 15% f&eacute;lember elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 3. Szint&ucirc; pet.', '2500', '1', '53017', '53017', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('744', 'H&oacute;-Leonid&aacute;sz pecs&eacute;t (pet) ', '9', '3500 TP-t, 25% kritet 15% sz&ouml;rny elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 3. Szint&ucirc; pet.', '2500', '1', '53018', '53008', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('745', 'Sarkvid&eacute;ki K&aacute;n pecs&eacute;t (pet) ', '9', '3500 TP-t, 25% kritet 15% sz&ouml;rny elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 3. Szint&ucirc; pet.', '2500', '1', '53019', '53008', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('746', 'Sarki Porky pecs&eacute;t (pet) ', '9', '3500 TP-t, 25% kritet 15% sz&ouml;rny elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 3. Szint&ucirc; pet.', '2500', '1', '53020', '53008', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('747', 'Fagyos Rufusz pecs&eacute;t (pet) ', '9', '3500 TP-t, 25% kritet 15% sz&ouml;rny elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 3. Szint&ucirc; pet.', '2500', '1', '53021', '53008', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('750', 'P&aacute;rduck&ouml;ly&ouml;k pecs&eacute;t (pet) ', '9', '4500 TP-t, 30% kritet, 30% sz&ouml;rny elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 4. Szint&ucirc; pet.', '3500', '1', '53024', '53008', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('753', 'Leop&aacute;rdk&ouml;ly&ouml;k pecs&eacute;t (pet) ', '9', '4500 TP-t, 30% kritet, 30% f&eacute;lember elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 4. Szint&ucirc; pet.', '3500', '1', '53025', '53008', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('749', 'Kismajom pecs&eacute;t (barna) (pet) ', '9', '4500 TP-t, 30% kritet, 30% sz&ouml;rny elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 4. Szint&ucirc; pet.', '3500', '1', '53050', '55701', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('755', 'Kisp&oacute;k pecs&eacute;t (pet) ', '9', '4500 TP-t, 30% kritet, 30% f&eacute;lember elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 4. Szint&ucirc; pet.', '3500', '1', '53054', '55702', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('759', 'Mini Razador pecs&eacute;t (v&ouml;r&ouml;s) (pet) ', '9', '5500 TP-t, 35% kritet, 35% f&eacute;lember elleni er&otilde;t biztos&iacute;t sz&aacute;modra.  Id&otilde;tartam: 1 h&oacute;nap. 5. Szint&ucirc; pet', '4500', '1', '53058', '55703', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('757', 'Mini Nemere (k&eacute;k) (pet) ', '9', '5500 TP-t, 35% kritet, 35% sz&ouml;rny elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 5. Szint&ucirc; pet.', '4500', '1', '53062', '55704', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('733', 'V&ouml;r&ouml;s Holdsarl&oacute; (pet) ', '9', '1500 TP-t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 1. Szint&ucirc; pet.', '1000', '1', '53066', '53241', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('734', 'K&eacute;k Holdsarl&oacute; (pet) ', '9', '1500 TP-t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 1. Szint&ucirc; pet.', '1000', '1', '53067', '53240', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('760', 'Baby Huashin pecs&eacute;t (pet) ', '9', '5500 TP-t, 35% kritet, 35% f&eacute;lember elleni er&otilde;t biztos&iacute;t sz&aacute;modra.  Id&otilde;tartam: 1 h&oacute;nap. 5. Szint&ucirc; pet.', '4500', '1', '53068', '53232', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('748', 'Kos l&aacute;ny pecs&eacute;t (K&eacute;k) (pet) ', '9', '4500 TP-t, 30% kritet, 30% sz&ouml;rny elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 4. Szint&ucirc; pet.', '3500', '1', '53069', '53008', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('754', 'Kos l&aacute;ny pecs&eacute;t (Feh&eacute;r) (pet) ', '9', '4500 TP-t, 30% kritet, 30% f&eacute;lember elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 4. Szint&ucirc; pet.', '3500', '1', '53070', '53008', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('783', '&Aacute;rny&eacute;k &eacute;kszer ', '8', 'Fejleszt&eacute;si  t&aacute;rgy.', '50', '3', '60003', '60003', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('90', '&Aacute;rny&eacute;k Fejedelem foga ', '8', 'Fejleszt&eacute;si  t&aacute;rgy.', '450', '3', '70044', '70044', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('560', '&Aacute;rny&eacute;k Fejedelem m&eacute;rge ', '8', 'Fejleszt&eacute;si  t&aacute;rgy.', '450', '3', '70045', '70045', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('561', '&Aacute;rny&eacute;k Fejedelem sz&iacute;ve ', '8', 'Fejleszt&eacute;si  t&aacute;rgy.', '450', '3', '70046', '70040', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('506', 'B&aacute;tors&aacute;g k&ouml;peny (v&eacute;gtelen)', '31', '', '200', '1', '70057', '70038', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('131', 'Kasz&aacute;s &Aacute;tv&aacute;ltoztat&oacute; g&ouml;mb', '31', '', '500', '1', '70104', '70104', '2018-08-24 00:00:00', '1093', '0', '0');
INSERT INTO `ishop_items` VALUES ('81', 'Brut&aacute;lis kegyenc ', '31', '&Aacute;tv&aacute;ltoztat&oacute; g&ouml;mb', '250', '1', '70104', '70104', '2018-08-24 00:00:00', '532', '0', '0');
INSERT INTO `ishop_items` VALUES ('784', '&Aacute;rny&eacute;k jegyzet ', '8', 'Fejleszt&eacute;si  t&aacute;rgy.', '50', '3', '71022', '71022', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('372', 'Megv&aacute;ltoztat&oacute; var&aacute;zslat', '31', '', '500', '1', '71048', '71048', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('371', 'Birodalmak oldata', '31', '', '500', '1', '71054', '71054', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('370', 'N&eacute;v oldalta', '31', '', '2000', '1', '71055', '71055', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('562', 'Ut&oacute;d gy&ucirc;r&ucirc; ', '31', 'C&eacute;h vez&eacute;r v&aacute;lt&aacute;shoz', '1000', '1', '71099', '80009', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('135', '&Eacute;let gy&uuml;m&ouml;lcse', '31', '', '150', '1', '71107', '71107', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('89', 'S&aacute;rk&aacute;ny pikkely ', '8', 'Fejleszt&eacute;si  t&aacute;rgy.', '250', '3', '71123', '71123', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('714', 'Feh&eacute;r oroszl&aacute;n pecs&eacute;t ', '9', '2500 TP-t, 15% sz&ouml;rny elleni er&otilde;t biztos&iacute;t. 7 napos, az id&otilde; csak akkor telik ha rajta vagy.', '2000', '1', '71124', '71124', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('710', 'Harci vadkan pecs&eacute;t ', '9', '2000 TP-t, 10% sz&ouml;rny elleni er&otilde;t biztos&iacute;t. 7 napos, az id&otilde; csak akkor telik ha rajta vagy.', '1500', '1', '71125', '71125', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('711', 'Harci farkas pecs&eacute;t ', '9', '2000 TP-t, 10% sz&ouml;rny elleni er&otilde;t biztos&iacute;t. 7 napos, az id&otilde; csak akkor telik ha rajta vagy.', '1500', '1', '71126', '71126', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('712', 'Vihar tigris pecs&eacute;t ', '9', '2000 TP-t, 10% sz&ouml;rny elleni er&otilde;t biztos&iacute;t. 7 napos, az id&otilde; csak akkor telik ha rajta vagy.', '1500', '1', '71127', '71127', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('713', 'Harci oroszl&aacute;n pecs&eacute;t ', '9', '2000 TP-t, 10% sz&ouml;rny elleni er&otilde;t biztos&iacute;t. 7 napos, az id&otilde; csak akkor telik ha rajta vagy.', '1500', '1', '71128', '71128', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('91', 'S&aacute;rk&aacute;ny karom ', '8', 'Fejleszt&eacute;si  t&aacute;rgy.', '250', '3', '71129', '71129', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('724', 'Event l&oacute; pecs&eacute;t ', '9', '4000 TP-t, 25% sz&ouml;rny elleni er&otilde;t, 100 v&eacute;delmet, 15 kritet biztos&iacute;t sz&aacute;modra. 7 napos, az id&otilde; csak akkor telik ha rajta vagy.', '3000', '1', '71134', '71131', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('141', 'Sivatagi harcos+ (f, V&ouml;r&ouml;s) ', '11', 'B&oacute;nuszos, 30napos.', '1000', '1', '41326', '41324', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('142', 'Sivatagi harcos+ (n, V&ouml;r&ouml;s) ', '11', 'B&oacute;nuszos, 30napos.', '1000', '1', '41327', '41325', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('126', 'Kobra fejd&iacute;sz+ (f) ', '11', 'B&oacute;nuszos, 30napos.', '2000', '1', '45137', '45135', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('127', 'Kobra fejd&iacute;sz+ (n) ', '11', 'B&oacute;nuszos, 30napos.', '750', '1', '45138', '45136', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('128', 'Fekete turb&aacute;n+ (F) ', '11', 'B&oacute;nuszos, 30napos.', '750', '1', '45149', '45143', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('129', 'Fekete turb&aacute;n+ (N) ', '11', 'B&oacute;nuszos, 30napos.', '750', '1', '45150', '45144', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('124', 'Azrael sisakja+ (f) ', '11', 'B&oacute;nuszos, 30napos.', '750', '1', '45153', '45147', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('125', 'Azrael sisakja+ (n) ', '11', 'B&oacute;nuszos, 30napos.', '750', '1', '45154', '45148', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('143', 'Sivatagi haj+ (f, V&ouml;r&ouml;s) ', '11', 'B&oacute;nuszos, 30napos.', '750', '1', '45162', '45160', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('144', 'Sivatagi haj+ (n, V&ouml;r&ouml;s) ', '11', 'B&oacute;nuszos, 30napos.', '750', '1', '45163', '45161', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('115', 'Cor Draconis (Nyers)', '13', '', '200', '1', '51501', '51501', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('116', 'Cor Draconis (Norm&aacute;l)', '13', '', '300', '1', '51503', '51501', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('117', 'Cor Draconis (ritka)', '13', '', '450', '1', '51508', '51501', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('118', 'Cor Draconis (antik)', '13', '', '650', '1', '51509', '51505', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('119', 'Cor Draconis (legend&aacute;s)', '13', '', '850', '1', '51510', '51506', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('730', 'T&ucirc;zf&otilde;nix pecs&eacute;t (pet) ', '9', '1500 TP-t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 1. Szint&ucirc; pet.', '1000', '1', '53001', '53001', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('732', 'Szarvasgida pecs&eacute;t (pet) ', '9', '1500 TP-t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 1. Szint&ucirc; pet.', '1000', '1', '53002', '53002', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('735', 'Bambi pecs&eacute;t (pet) ', '9', '2500 TP-t, 15% kritet biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 2. Szint&ucirc; pet.', '1500', '1', '53002', '53002', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('731', 'J&eacute;gf&otilde;nix pecs&eacute;t (pet) ', '9', '1500 TP-t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 1. Szint&ucirc; pet.', '1000', '1', '53003', '53003', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('751', 'Baby Azrael pecs&eacute;t (pet) ', '9', '4500 TP-t, 30% kritet, 30% sz&ouml;rny elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 4. Szint&ucirc; pet.', '3500', '1', '53005', '53005', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('756', 'Baby Azrael (arany) (pet) ', '9', '5500 TP-t, 35% kritet, 35% sz&ouml;rny elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 5. Szint&ucirc; pet', '4500', '1', '53006', '53006', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('742', 'Knuud pecs&eacute;t (pet) ', '9', '3500 TP-t, 25% kritet 15% f&eacute;lember elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 3. Szint&ucirc; pet.', '2500', '1', '53008', '53008', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('743', 'Bao Bao pecs&eacute;t (pet) ', '9', '3500 TP-t, 25% kritet 15% sz&ouml;rny elleni er&otilde;t biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 3. Szint&ucirc; pet.', '2500', '1', '53009', '53008', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('736', 'Leonid&aacute;sz pecs&eacute;t (pet) ', '9', '2500 TP-t, 15% kritet biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 2. Szint&ucirc; pet.', '1500', '1', '53010', '53008', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('737', 'K&aacute;n pecs&eacute;t (pet) ', '9', '2500 TP-t, 15% kritet biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 2. Szint&ucirc; pet.', '1500', '1', '53011', '53008', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('738', 'Porky pecs&eacute;t (pet) ', '9', '2500 TP-t, 15% kritet biztos&iacute;t sz&aacute;modra. Id&otilde;tartam: 1 h&oacute;nap. 2. Szint&ucirc; pet.', '1500', '1', '53012', '53008', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('807', 'S&aacute;m&aacute;nok elleni k&#337;+6', '6', '', '1000', '1', '28636', '28006', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('808', 'Sz&ouml;rny elleni k&#337;+6', '6', '', '1000', '1', '28637', '28007', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('809', 'Kitart&aacute;s k&ouml;ve+6', '6', '', '1000', '1', '28638', '28008', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('810', 'Fort&eacute;ly k&ouml;ve+6', '6', '', '1000', '1', '28639', '28009', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('811', 'M&aacute;gia k&ouml;ve+6', '6', '', '1000', '1', '28640', '28010', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('812', '&Eacute;leter&otilde; k&ouml;ve+6', '6', '', '1000', '1', '28641', '28011', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('813', 'V&eacute;delem k&ouml;ve+6', '6', '', '1000', '1', '28642', '28012', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('814', 'Siets&eacute;g k&ouml;ve+6', '6', '', '1000', '1', '28643', '28013', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('777', 'Vez&eacute;r jegyzete ', '8', 'Lv 90 biol&oacute;gus k&uuml;ldet&eacute;s.', '100', '3', '30168', '30168', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('373', 'Csavart kulcs', '31', '', '100', '1', '30179', '30179', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('778', 'Rosszakarat &eacute;kk&otilde; ', '8', 'Lv 92 biol&oacute;gus k&uuml;ldet&eacute;s.', '450', '3', '30251', '30251', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('779', 'B&ouml;lcsess&eacute;g &eacute;kk&otilde; ', '8', 'Lv 94 biol&oacute;gus k&uuml;ldet&eacute;s.', '450', '3', '30252', '30252', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('780', 'H&ucirc;s&eacute;g &eacute;kk&otilde; ', '8', 'Lv 96 biol&oacute;gus k&uuml;ldet&eacute;s.', '450', '3', '30253', '30253', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('374', 'Zsugor&iacute;tott fej', '31', '', '150', '1', '30319', '30319', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('595', 'Arany gy&ucirc;r&ucirc; ', '7', 'Kritikus tal&aacute;lat 10%, &aacute;that&oacute; tal&aacute;lat 10%-ot biztos&iacute;t.', '2500', '1', '30526', '30526', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('596', 'Ez&uuml;st gy&ucirc;r&ucirc; ', '7', 'V&eacute;dekez&eacute;s +50 &eacute;s sz&ouml;rnyek elleni er&otilde; 25%-ot biztos&iacute;t.', '2500', '1', '30527', '30527', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('597', 'Bronz gy&ucirc;r&ucirc; ', '7', '25% exp b&oacute;nuszt &eacute;s 30% dupla mennyis&eacute;g&ucirc; yang dob&aacute;st biztos&iacute;t.', '2500', '1', '30528', '30528', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('772', 'D&eacute;moni Eml&eacute;kt&aacute;rgy', '8', 'Lv 50 biol&oacute;gus k&uuml;ldet&eacute;s.', '100', '3', '30015', '30015', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('774', 'Zelkova fa&aacute;g', '8', 'Lv 70 biol&oacute;gus k&uuml;ldet&eacute;s.', '100', '3', '30165', '30165', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('776', 'V&ouml;r&ouml;s szellemfa &aacute;g', '8', 'Lv 85 biol&oacute;gus k&uuml;ldet&eacute;s.', '100', '3', '30167', '30167', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('771', '&Aacute;tokk&ouml;nyv', '8', 'Lv 40 biol&oacute;gus k&uuml;ldet&eacute;s.', '100', '3', '30047', '30047', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('773', 'J&eacute;gg&ouml;mb', '8', 'Lv 60 biol&oacute;gus k&uuml;ldet&eacute;s.', '100', '3', '30050', '30050', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('775', 'Tugyi tanus&iacute;tv&aacute;ny', '8', 'Lv 80 biol&oacute;gus k&uuml;ldet&eacute;s.', '100', '3', '30166', '30166', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('770', 'Orkfog', '8', 'Lv 30 biol&oacute;gus k&uuml;ldet&eacute;s.', '100', '3', '30006', '30006', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('782', '&Aacute;rny&eacute;k t&uuml;ske ', '8', 'Fejleszt&eacute;si  t&aacute;rgy.', '50', '3', '31070', '31070', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('590', 'Er&otilde; snack (7 napos)', '31', '', '500', '1', '38100', '38100', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('591', 'Er&otilde; snack (15 napos)', '31', '', '1000', '1', '38101', '38100', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('592', 'Er&otilde; snack (30 napos)', '31', '', '1500', '1', '38102', '38100', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('120', 'Kobra jelmez+ (f) ', '11', 'B&oacute;nuszos, 30napos.', '1000', '1', '41309', '41307', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('121', 'Kobra jelmez+ (n) ', '11', 'B&oacute;nuszos, 30napos.', '1000', '1', '41310', '41308', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('107', 'Sivatagi harcos fekete (F) ', '11', 'B&oacute;nuszos, 30napos.', '1000', '1', '41313', '41311', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('108', 'Sivatagi harcos fekete (N) ', '11', 'B&oacute;nuszos, 30napos.', '1000', '1', '41314', '41312', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('122', 'Azrael p&aacute;nc&eacute;lja+ (f) ', '11', 'B&oacute;nuszos, 30napos.', '1000', '1', '41317', '41315', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('123', 'Azrael p&aacute;nc&eacute;lja+ (n) ', '11', 'B&oacute;nuszos, 30napos.', '1000', '1', '41318', '41316', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('14', 'Csatakard+9', '2', '', '1000', '1', '149', '00140', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('16', 'Szellemfog penge+9', '2', '', '1000', '1', '159', '00150', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('32', 'M&eacute;regkard+9', '2', '', '2000', '1', '189', '00180', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('33', 'Oroszl&eacute;kard+9', '2', '', '2000', '1', '199', '00190', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('1313', 'Hold kard ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '229', '00220', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1314', 'Mennyei kard ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '239', '00230', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1315', 'B&aacute;r&oacute; kard ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '269', '00260', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('25', 'Triton kard+6', '2', '', '2500', '1', '276', '00270', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('26', 'Szent Kard+6', '2', '', '2500', '1', '286', '00280', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('82', 'R&uacute;nakard +0', '2', 'Harcos, Nindzsa, Sura', '5000', '1', '460', '00460', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('83', 'S&aacute;rk&aacute;nyfog-penge +0', '2', 'Sura', '5000', '1', '470', '00470', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('40', 'S&aacute;rk&aacute;ny k&eacute;s+9', '2', '', '1000', '1', '1109', '01100', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('36', '&Ouml;rd&ouml;gsz&aacute;rny Chakram+9', '2', '', '2000', '1', '1139', '01130', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('1301', 'F&ucirc;r&eacute;szfog k&eacute;s ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '1149', '01140', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1302', 'Napf&eacute;ny k&eacute;s ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '1159', '01150', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1303', 'Patak k&eacute;s ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '1169', '01160', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('86', '&Ouml;t elem penge +0', '2', 'Nindzsa', '5000', '1', '1340', '01340', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('20', 'S&aacute;rgas&aacute;rk&aacute;ny &iacute;j+9', '2', '', '1000', '1', '2149', '02140', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('28', '&Oacute;ri&aacute;s&ouml;rd&ouml;g &iacute;j+6', '2', '', '2500', '1', '2166', '02160', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('35', 'Varj&uacute;ac&eacute;l &Iacute;j+9', '2', '', '2000', '1', '2179', '02170', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('1305', 'K&iacute;s&eacute;rtetkereszt &iacute;j ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '2199', '02190', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('85', 'F&otilde;nix &iacute;j +0', '2', 'Nindzsa', '5000', '1', '2370', '02370', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('17', 'Partiz&aacute;n+9', '2', '', '1000', '1', '3139', '03130', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('34', 'Harag Kard+9', '2', '', '2000', '1', '3169', '03160', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('1306', 'S&aacute;rgas&aacute;rk&aacute;ny ', '11', 'Gyilkos 20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '3179', '03170', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1307', 'K&eacute;ks&aacute;rk&aacute;ny ', '11', 'Gyilkos 20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '3189', '03180', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('84', 'Nap-penge +0', '2', 'Harcos', '5000', '1', '3190', '03190', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('27', 'S&aacute;rk&aacute;nyisten Penge+0', '2', '', '2500', '1', '3200', '03200', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('1304', 'Holdiker t&otilde;r ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '4039', '04030', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('29', 'L&eacute;lektelen K&eacute;s+6', '2', '', '2500', '1', '4046', '04040', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('21', 'Viharmad&aacute;r Harang+9', '2', '', '1000', '1', '5099', '05090', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('37', 'Orchidea Harang+9', '2', '', '2000', '1', '5129', '05120', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('1308', 'Kasz&aacute;s Harang ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '5139', '05130', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1309', 'S&aacute;rk&aacute;ny Harang', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '5149', '05140', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1310', 'Hibiszkusz Harang ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '5159', '05150', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('30', 'S&aacute;rk&aacute;ny Torok Harang+6', '2', '', '2500', '1', '5336', '05330', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('87', 'S&aacute;rk&aacute;nyszellem-harang +0', '2', 'S&aacute;m&aacute;n', '5000', '1', '5340', '05340', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('1201', 'F&ucirc;r&eacute;sz kard ', '11', '15% f&eacute;lembert, 15% kritet, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '6401', '40101', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1202', 'F&ucirc;r&eacute;sz penge ', '11', '15% f&eacute;lembert, 15% kritet, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '6402', '40104', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1203', 'F&ucirc;r&eacute;sz t&otilde;r ', '11', '15% f&eacute;lembert, 15% kritet, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '6403', '40102', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1204', 'F&ucirc;r&eacute;sz &iacute;j ', '11', '15% f&eacute;lembert, 15% kritet, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '6404', '40103', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1205', 'F&ucirc;r&eacute;sz harang ', '11', '15% f&eacute;lembert, 15% kritet, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '6405', '40105', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1206', 'F&ucirc;r&eacute;sz legyez&otilde; ', '11', '15% f&eacute;lembert, 15% kritet, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '6406', '40106', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1207', 'Kar&aacute;csonyi kard ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '6411', '40115', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1208', 'Kar&aacute;csonyi penge ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '6412', '40118', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1209', 'Kar&aacute;csonyi t&otilde;r ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '6413', '40116', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1210', 'Kar&aacute;csonyi &iacute;j ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '6414', '40117', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1211', 'Kar&aacute;csonyi harang ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '6415', '40119', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1212', 'Kar&aacute;csonyi legyez&otilde; ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '6416', '40120', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('24', 'Megv&aacute;lt&oacute; Legyez&otilde;+9', '2', '', '1000', '1', '7149', '07140', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('1311', 'Nyolc-trigram Legyez&otilde; ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '7179', '07170', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1312', 'S&aacute;rk&aacute;ny Legyez&otilde; ', '11', '20% mobot, 20% exp b&oacute;nuszt, 20% t&aacute;mad&oacute; sebess&eacute;get biztos&iacute;t.', '2000', '1', '7189', '07180', '2018-08-24 00:00:00', '2592000', '0', '0');
INSERT INTO `ishop_items` VALUES ('31', 'D&eacute;mon Legyez&otilde;+6', '2', '', '2500', '1', '7196', '07190', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('88', 'S&aacute;rk&aacute;ny Legyez&otilde;+0', '2', 'S&aacute;m&aacute;n', '5000', '1', '7370', '07370', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('391', 'Pikkelyes lemezv&eacute;rt+9', '1', '', '500', '1', '11269', '11260', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('1', 'S&aacute;rk&aacute;ny isten v&eacute;rt +9', '1', '', '500', '1', '11289', '11280', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('2', 'Feketevas v&eacute;rt +9', '1', '', '1000', '1', '11299', '11290', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('392', 'Fiatals&aacute;rk&aacute;ny &ouml;lt&ouml;ny+9', '1', '', '500', '1', '11469', '11460', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('5', 'Feketesz&eacute;l &ouml;lt&ouml;ny +9', '1', '', '1000', '1', '11499', '11490', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('393', 'K&ouml;d&ouml;s lemezv&eacute;rt+9', '1', '', '500', '1', '11669', '11660', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('7', 'L&eacute;lek Lemezv&eacute;rt+9', '1', '', '500', '1', '11689', '11680', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('8', 'Fekete m&aacute;gia v&eacute;rt+9', '1', '', '1000', '1', '11699', '11690', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('394', 'Erk&ouml;lcs ruha+9', '1', '', '500', '1', '11869', '11860', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('10', 'B&aacute;r&oacute;n&otilde;i Ruha+9', '1', '', '500', '1', '11889', '11880', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('11', 'Fekete ruha+9', '1', '', '1000', '1', '11899', '11890', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('565', 'Hwang fegyverzet ', '1', 'Harcos', '1800', '1', '11971', '11971', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('566', 'Ninja Hwang fegyverzet ', '1', 'Nindzsa', '1800', '1', '11972', '11972', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('567', 'Zin-Hwang fegyverzet ', '1', 'Sura', '1800', '1', '11973', '11973', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('568', 'Sang-Hwang fegyverzet ', '1', 'S&aacute;m&aacute;n', '1800', '1', '11974', '11974', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('3', 'K&eacute;kac&eacute;l v&eacute;rt +0', '1', '', '2500', '1', '12010', '12020', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('6', 'K&eacute;k S&aacute;rk&aacute;ny &ouml;lt&ouml;ny +0', '1', '', '2500', '1', '12020', '12030', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('9', 'Aura lemezv&eacute;rt +0', '1', '', '2500', '1', '12030', '12010', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('12', 'S&aacute;rk&aacute;ny ruha +0', '1', 'S&aacute;m&aacute;n', '2500', '1', '12040', '12040', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('380', 'Szellemmaszk sisak+9', '4', '', '500', '1', '12249', '12240', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('61', 'F&eacute;lelem maszk +6', '4', '', '500', '1', '12266', '12260', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('62', 'H&aacute;bor&uacute; Mester sisak +6', '4', '', '1000', '1', '12286', '12280', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('381', 'Ac&eacute;l csuklya+9', '4', '', '500', '1', '12389', '12380', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('63', 'Ork csuklya +6', '4', '', '500', '1', '12396', '12390', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('64', 'P&oacute;k csuklya +6', '4', '', '1000', '1', '12406', '12540', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('382', 'V&aacute;r sisak+9', '4', '', '500', '1', '12529', '12520', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('65', 'Szarvas sisak +6', '4', '', '500', '1', '12536', '12530', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('66', 'M&aacute;gikus sisak +6', '4', '', '1000', '1', '12546', '12400', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('383', 'Napf&eacute;ny kalap+9', '4', '', '500', '1', '12669', '12660', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('67', 'B&iacute;boros kalap +6', '4', '', '500', '1', '12676', '12670', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('68', 'L&eacute;lekszil&aacute;nk kalap +6', '4', '', '1000', '1', '12686', '12680', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('53', 'S&oacute;lyom pajzs+9', '4', '', '1000', '1', '13069', '13060', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('54', 'Tigris Pajzs+9', '4', '', '1000', '1', '13089', '13080', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('55', 'Oroszl&aacute;n&eacute;l pajzs+9', '4', '', '1000', '1', '13109', '13100', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('56', 'S&aacute;rk&aacute;nypikkely Pajzs+9', '4', '', '1000', '1', '13129', '13120', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('550', 'Tit&aacute;n Pajzs+6', '4', '', '1000', '1', '13146', '13140', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('50', '&Eacute;benfa Kark&ouml;t&otilde;+9', '30', '', '1000', '1', '14109', '14100', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('41', 'Krist&aacute;ly Kark&ouml;t&otilde;+9', '30', '', '1000', '1', '14169', '14160', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('42', 'Ametiszt Kark&ouml;t&otilde;+9', '30', '', '1000', '1', '14189', '14180', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('43', 'Mennyei k&ouml;nny Kark&ouml;t&otilde;+9', '30', '', '1000', '1', '14209', '14200', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('615', 'L&eacute;lekkrist&aacute;ly kark&ouml;t&otilde;+6', '30', '', '2000', '1', '14226', '14220', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('4', 'Fukszia &ouml;lt&ouml;ny +9', '1', 'Nindsza', '500', '1', '14289', '11480', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('601', 'Rubin kark&ouml;t&otilde;+6', '30', '', '2500', '1', '14506', '14500', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('602', 'Gr&aacute;n&aacute;t kark&ouml;t&otilde;+6', '30', '', '2500', '1', '14526', '14520', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('603', 'Smaragd kark&ouml;t&otilde;+6', '30', '', '2500', '1', '14546', '14540', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('604', 'Zaf&iacute;r kark&ouml;t&otilde;+6', '30', '', '2500', '1', '14566', '14560', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('350', 'Dicsf&eacute;ny Csizma+9', '5', '', '500', '1', '15189', '15180', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('351', 'F&otilde;nix Cip&otilde;+9', '5', '', '500', '1', '15209', '15200', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('352', 'T&ucirc;zmad&aacute;r Cip&otilde;+9', '5', '', '500', '1', '15229', '15220', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('57', 'Euf&oacute;ria cip&otilde; +6', '5', '', '500', '1', '15376', '15370', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('58', 'Dics&otilde;s&eacute;g csizma +6', '5', '', '500', '1', '15396', '15390', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('59', 'Qilin cip&otilde; +6', '5', '', '500', '1', '15416', '15410', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('60', 'J&eacute;gmad&aacute;r cip&otilde; +6', '5', '', '500', '1', '15436', '15430', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('51', '&Eacute;benfa nyakl&aacute;nc+9', '30', '', '1000', '1', '16109', '16100', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('44', 'Krist&aacute;ly nyakl&aacute;nc+9', '30', '', '1000', '1', '16169', '16160', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('45', 'Ametiszt nyakl&aacute;nc+9', '30', '', '1000', '1', '16189', '16180', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('46', 'Mennyei k&ouml;nny nyakl&aacute;nc+9', '30', '', '1000', '1', '16209', '16200', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('614', 'L&eacute;lekkrist&aacute;ly nyakl&aacute;nc+6', '30', '', '2000', '1', '16225', '16220', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('605', 'Rubin nyakl&aacute;nc+6', '30', '', '2500', '1', '16504', '16500', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('606', 'Gr&aacute;n&aacute;t nyakl&aacute;nc+6', '30', '', '2500', '1', '16524', '16520', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('607', 'Smaragd nyakl&aacute;nc+6', '30', '', '2500', '1', '16544', '16540', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('608', 'Zaf&iacute;r nyakl&aacute;nc+6', '30', '', '2500', '1', '16564', '16560', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('52', '&Eacute;benfa F&uuml;lbeval&oacute;+9', '30', '', '1000', '1', '17109', '17100', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('47', 'Krist&aacute;ly F&uuml;lbeval&oacute;+9', '30', '', '1000', '1', '17169', '17160', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('48', 'Ametiszt F&uuml;lbeval&oacute;+9', '30', '', '1000', '1', '17189', '17180', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('49', 'Mennyei k&ouml;nny F&uuml;lbeval&oacute;+9', '30', '', '1000', '1', '17209', '17200', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('613', 'L&eacute;lekkrist&aacute;ly f&uuml;lbev.+6', '30', '', '2000', '1', '17226', '17220', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('609', 'Rubin f&uuml;lbeval&oacute;+6', '30', '', '2500', '1', '17504', '17500', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('610', 'Gr&aacute;n&aacute;t f&uuml;lbeval&oacute;+6', '30', '', '2500', '1', '17524', '17520', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('611', 'Smaragd f&uuml;lbeval&oacute;+6', '30', '', '2500', '1', '17544', '17540', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('612', 'Zaf&iacute;r f&uuml;lbeval&oacute;+6', '30', '', '2500', '1', '17564', '17560', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('73', 'Kir&aacute;lyi &ouml;v+9 ', '7', '5 v&eacute;delmet &eacute;s 10% er&otilde;t biztos&iacute;t a harcosok ellen.', '2500', '1', '18049', '18040', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('74', '&Aacute;rny&eacute; k&ouml;v+9 ', '7', '5% v&eacute;delmet &eacute;s 10% er&otilde;t biztos&iacute;t a ninj&aacute;k ellen.', '2500', '1', '18059', '18050', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('75', 'R&uacute;na &ouml;v+9 ', '7', '5% v&eacute;delmet &eacute;s 10% er&otilde;t biztos&iacute;t a sur&aacute;k ellen.', '2500', '1', '18069', '18060', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('76', 'Nagy medve &ouml;v+9 ', '7', '5% v&eacute;delmet &eacute;s 10% er&otilde;t biztos&iacute;t a s&aacute;m&aacute;nok ellen.', '2500', '1', '18079', '18070', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('551', 'L&eacute;lek &ouml;v+9 ', '7', '15% sz&ouml;rny elleni er&otilde;t biztos&iacute;t.', '2500', '1', '18089', '18080', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('510', '&Ouml;rd&ouml;gszarv-v&eacute;rt +0', '1', 'Harcos', '5000', '1', '20000', '20000', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('511', 'S&aacute;rk&aacute;nylovas-&ouml;lt&ouml;z&eacute;k +0', '1', 'Ninja', '5000', '1', '20250', '20250', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('512', 'Csont lemezv&eacute;rt +0', '1', 'Sura', '5000', '1', '20500', '20750', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('513', 'Arany ruha +0', '1', 'S&aacute;m&aacute;n', '5000', '1', '20750', '20500', '2018-08-24 00:00:00', '1', '1', '1');
INSERT INTO `ishop_items` VALUES ('1000', 'Szellemk&otilde; Tekercs', '6', '', '100', '1', '25100', '25000', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('781', '&Aacute;rny&eacute;k gy&ouml;ngy ', '8', 'Fejleszt&eacute;si  t&aacute;rgy.', '50', '3', '27984', '27984', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('785', 'Feh&eacute;r gy&ouml;ngy ', '8', 'Fejleszt&eacute;si t&aacute;rgy.', '50', '3', '27992', '27992', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('786', 'K&eacute;k gy&ouml;ngy ', '8', 'Fejleszt&eacute;si t&aacute;rgy.', '50', '3', '27993', '27993', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('787', 'V&ouml;r&ouml;s gy&ouml;ngy ', '8', 'Fejleszt&eacute;si t&aacute;rgy', '50', '3', '27994', '27994', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('801', '&Aacute;tt&ouml;r&eacute;s k&ouml;ve+6', '6', '', '1000', '1', '28630', '28000', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('802', 'Hal&aacute;los Csap&aacute;s k&ouml;ve+6', '6', '', '1000', '1', '28631', '28001', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('803', 'Visszat&eacute;r&eacute;s k&ouml;ve+6', '6', '', '1000', '1', '28632', '28002', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('804', 'Harcos elleni k&#337;+6', '6', '', '1000', '1', '28633', '28003', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('805', 'Nindzsa elleni k&#337;+6', '6', '', '1000', '1', '28634', '28004', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('806', 'Sura elleni k&#337;+6', '6', '', '1000', '1', '28635', '28005', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('726', 'Leop&aacute;rd pecs&eacute;t ', '9', '4500 TP-t, 30% sz&ouml;rny elleni er&otilde;t, 150 v&eacute;delmet,  20% kritet biztos&iacute;t sz&aacute;modra. 7 napos, az id&otilde; csak akkor telik ha rajta vagy.', '3500', '1', '71177', '71131', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('729', 'Z&ouml;ld l&oacute;-pecs&eacute;t ', '9', '5000 TP-t, 35% sz&ouml;rny elleni er&otilde;t, 200 v&eacute;delmet 25% kritet biztos&iacute;t sz&aacute;modra. 7 napos, az id&otilde; csak akkor telik ha rajta vagy.', '4000', '1', '71178', '71178_z', '2018-08-24 00:00:00', '648000', '0', '0');
INSERT INTO `ishop_items` VALUES ('1500', 'Tigriscsont f&uuml;lbeval&oacute; ', '30', 'T&aacute;mad&oacute;&eacute;rt&eacute;ked megn&ouml;vekszik 200 ponttal 2 &oacute;r&aacute;n &aacute;t.', '1250', '1', '72703', '72703', '2018-08-24 00:00:00', '0', '0', '120');
INSERT INTO `ishop_items` VALUES ('1501', 'S&aacute;rk&aacute;nycsont f&uuml;lbeval&oacute; ', '30', 'V&eacute;delmi &eacute;rt&eacute;ked megn&ouml;vekszik 200 ponttal 2 &oacute;r&aacute;n &aacute;t.', '1250', '1', '72704', '72704', '2018-08-24 00:00:00', '0', '0', '120');
INSERT INTO `ishop_items` VALUES ('1502', 'Tigriscsont kark&ouml;t&otilde; ', '30', 'A k&eacute;szs&eacute;geid 15%-kal t&ouml;bb k&aacute;rt okoznak 2 &oacute;r&aacute;n &aacute;t.', '1250', '1', '72705', '72705', '2018-08-24 00:00:00', '0', '0', '120');
INSERT INTO `ishop_items` VALUES ('1503', 'S&aacute;rk&aacute;nycsont kark&ouml;t&otilde; ', '30', 'A k&eacute;szs&eacute;gek elleni v&eacute;delem megemelkedik 15%-kal 2 &oacute;r&aacute;n &aacute;t.', '1250', '1', '72706', '72706', '2018-08-24 00:00:00', '0', '0', '120');
INSERT INTO `ishop_items` VALUES ('570', 'Nap Elix&iacute;r (Nagy)', '31', '', '200', '1', '72725', '72725', '2018-08-24 00:00:00', '0', '0', '7000000');
INSERT INTO `ishop_items` VALUES ('571', 'Nap Elix&iacute;r (K&uuml;l&ouml;nleges)', '31', '', '300', '1', '72726', '72726', '2018-08-24 00:00:00', '0', '0', '10000000');
INSERT INTO `ishop_items` VALUES ('572', 'Hold Elix&iacute;r (Nagy)', '31', '', '200', '1', '72729', '72729', '2018-08-24 00:00:00', '0', '0', '700000');
INSERT INTO `ishop_items` VALUES ('573', 'Hold Elix&iacute;r (K&uuml;l&ouml;nleges)', '31', '', '300', '1', '72730', '72730', '2018-08-24 00:00:00', '0', '0', '1000000');
INSERT INTO `ishop_items` VALUES ('377', '&Iacute;j&aacute;sz tegez ', '31', '30 nap kifogythatatlan nyilvessz&otilde;, a t&aacute;voli sebz&eacute;sek nem sebeznek kevesebbet.', '1250', '1', '79504', '79501', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('69', 'S&eacute; jegy (100)', '12', '', '100', '1', '80014', '80017', '2018-08-24 01:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('70', 'S&eacute; jegy (500)', '12', '', '500', '1', '80015', '80015', '2018-08-24 02:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('71', 'S&eacute; jegy (1000)', '12', '', '1000', '1', '80016', '80014', '2018-08-24 03:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('320', 'S&eacute; jegy (3000)', '12', '', '3000', '1', '80017', '80016', '2018-08-24 04:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('376', 'SD4 bel&eacute;p&otilde;', '31', '', '150', '1', '80019', '71096', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('397', 'Alapk&otilde; ', '31', 'C&eacute;h telekhez.', '50', '3', '90010', '90010', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('395', 'T&ouml;rzs ', '31', 'C&eacute;h telekhez.', '50', '3', '90011', '90011', '2018-08-24 00:00:00', '0', '0', '0');
INSERT INTO `ishop_items` VALUES ('396', 'Furn&eacute;rlemez ', '31', 'C&eacute;h telekhez.', '50', '3', '90012', '90012', '2018-08-24 00:00:00', '0', '0', '0');

-- ----------------------------
-- Table structure for `ishop_log`
-- ----------------------------
DROP TABLE IF EXISTS `ishop_log`;
CREATE TABLE `ishop_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer_name` varchar(255) COLLATE latin2_hungarian_ci NOT NULL,
  `item_name` varchar(255) COLLATE latin2_hungarian_ci NOT NULL,
  `date_of_buy` datetime NOT NULL,
  `vnum_icon` varchar(11) COLLATE latin2_hungarian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=296 DEFAULT CHARSET=latin2 COLLATE=latin2_hungarian_ci;

-- ----------------------------
-- Records of ishop_log
-- ----------------------------
INSERT INTO `ishop_log` VALUES ('293', 'admin000', 'S&eacute; jegy (3000)', '2021-06-01 16:16:20', '80016');
INSERT INTO `ishop_log` VALUES ('294', 'admin000', 'S&eacute; jegy (1000)', '2021-06-01 16:16:24', '80014');
INSERT INTO `ishop_log` VALUES ('295', 'admin000', 'S&eacute; jegy (500)', '2021-06-01 16:16:27', '80015');
