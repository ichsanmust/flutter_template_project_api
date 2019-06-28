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

 Date: 28/06/2019 16:06:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `birthday` date NULL DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  `updated_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

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
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

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

SET FOREIGN_KEY_CHECKS = 1;
