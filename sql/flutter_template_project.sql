/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50714
 Source Host           : localhost:3306
 Source Schema         : flutter_template_project

 Target Server Type    : MySQL
 Target Server Version : 50714
 File Encoding         : 65001

 Date: 01/07/2019 11:37:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for mobile_application
-- ----------------------------
DROP TABLE IF EXISTS `mobile_application`;
CREATE TABLE `mobile_application`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `application_id` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `application_token` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `version` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `realese_date` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mobile_application
-- ----------------------------
INSERT INTO `mobile_application` VALUES (1, 'template_flutter_1_0', 'asfafasfdsajeej89sadfasjfbwasfsagipPajjqwidbQBiadq', 'Aplikasi Template Flutter Versi 1.0', '1.0', '2019-06-20');

-- ----------------------------
-- Table structure for mobile_session
-- ----------------------------
DROP TABLE IF EXISTS `mobile_session`;
CREATE TABLE `mobile_session`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `device_mobile_id` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `application_id` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `valid_date_time` datetime(0) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mobile_session
-- ----------------------------
INSERT INTO `mobile_session` VALUES (8, 5, 'W2P7bVftDyUfgDkOFUIqbcG8hmmqLgDS', 'sdfWtYdhdh', 'template_flutter_1_0', '2019-07-28 08:58:47', 0);
INSERT INTO `mobile_session` VALUES (9, 5, 'XEjW4f4wGrxjZsjCUtggmp05d8T48-vn', 'sdfWtYdhdh', 'template_flutter_1_0', '2019-07-28 08:59:47', 0);
INSERT INTO `mobile_session` VALUES (10, 5, '7jiyWgn7jbutGZT2iae41YsL93mfDatW', 'sdfWtYdhdh', 'template_flutter_1_0', '2019-07-28 09:01:01', 0);
INSERT INTO `mobile_session` VALUES (11, 5, 'lzln6vcB5HH4HVzEfOJxzlJ2sQSV3hae', 'sdfWtYdhdh', 'template_flutter_1_0', '2019-07-31 02:11:03', 0);
INSERT INTO `mobile_session` VALUES (12, 5, 'SOM7j4NqekqBNWq405Ml_lk5SK0lxQBy', 'sdfWtYdhdh', 'template_flutter_1_0', '2019-07-31 02:26:51', 1);

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student`  (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `age` int(3) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES (2, 'Rina', 'Jakarta', 18);
INSERT INTO `student` VALUES (3, 'Ruslan', 'Cimahi', 23);
INSERT INTO `student` VALUES (4, 'Rangga', 'Cimahi', 23);
INSERT INTO `student` VALUES (5, 'Andi', 'Sukabumi', 78);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (5, 'ichsanmust', 'Mustofa Ikhsan', 'SOM7j4NqekqBNWq405Ml_lk5SK0lxQBy', '$2y$13$C4GZToFIDWHy3pzNmHEpru8JV8N5VwS2i1SATLPUtE4XRNuuKwIni', NULL, 'ichsan.must10@gmail.com', 1, '2019-06-28 08:56:55', NULL);

SET FOREIGN_KEY_CHECKS = 1;
