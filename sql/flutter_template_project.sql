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

 Date: 10/07/2019 10:09:01
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
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `version` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `realese_date` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mobile_application
-- ----------------------------
INSERT INTO `mobile_application` VALUES (1, 'template_flutter_1_0', 'Aplikasi Template Flutter Versi 1.0', '1.0', '2019-06-20');

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
) ENGINE = MyISAM AUTO_INCREMENT = 78 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

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
) ENGINE = MyISAM AUTO_INCREMENT = 41 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES (37, 'Roby', 'Padalarang', 20);
INSERT INTO `student` VALUES (36, 'Siti', 'Madiun', 23);
INSERT INTO `student` VALUES (35, 'Santi', 'Jakarta', 40);
INSERT INTO `student` VALUES (34, 'Yaya', 'Sukabumi', 32);
INSERT INTO `student` VALUES (33, 'Febri', 'Bandung', 13);
INSERT INTO `student` VALUES (32, 'Maman', 'Jakarta', 20);
INSERT INTO `student` VALUES (31, 'Reno', 'Bandung', 17);
INSERT INTO `student` VALUES (30, 'Rahman', 'Aceh', 20);
INSERT INTO `student` VALUES (29, 'Indah', 'Garut', 18);
INSERT INTO `student` VALUES (28, 'Eman', 'Garut', 11);
INSERT INTO `student` VALUES (27, 'Udin', 'Padalarang', 20);
INSERT INTO `student` VALUES (26, 'Nanang', 'Madiun', 23);
INSERT INTO `student` VALUES (25, 'Limbad', 'Jakarta', 40);
INSERT INTO `student` VALUES (24, 'Risa', 'Sukabumi', 32);
INSERT INTO `student` VALUES (23, 'Musa', 'Bandung', 13);
INSERT INTO `student` VALUES (22, 'Ali', 'Jakarta', 20);
INSERT INTO `student` VALUES (21, 'Ahmad', 'Bandung', 17);
INSERT INTO `student` VALUES (38, 'Ririn', 'Garut', 11);
INSERT INTO `student` VALUES (39, 'Lina', 'Garut', 18);
INSERT INTO `student` VALUES (40, 'Lala', 'Aceh', 20);

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
INSERT INTO `user` VALUES (5, 'ichsanmust', 'Mustofa Ikhsan', 'yJkh0Ka7TjbUYCq-WXWUeJDyGsLszk1q', '$2y$13$mLrkpCjFPMju2semfMu4eujvnDAvABN1s7pL0o9kp808zqJs4TWo2', NULL, 'ichsan.must10@gmail.com', 1, '2019-06-28 08:56:55', '2019-07-01 07:12:32');

SET FOREIGN_KEY_CHECKS = 1;
