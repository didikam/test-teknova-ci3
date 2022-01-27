/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100605
 Source Host           : localhost:3306
 Source Schema         : teknova

 Target Server Type    : MySQL
 Target Server Version : 100605
 File Encoding         : 65001

 Date: 28/01/2022 06:08:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for keys
-- ----------------------------
DROP TABLE IF EXISTS `keys`;
CREATE TABLE `keys`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  `date_created` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of keys
-- ----------------------------
INSERT INTO `keys` VALUES (5, 1, 'CZ6FwlbvH5VUpcaOdBsq', 0, 0, 0, NULL, '2022-01-28 06:07:55');

-- ----------------------------
-- Table structure for pegawai
-- ----------------------------
DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE `pegawai`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` int(11) NOT NULL,
  `nama` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jabatan` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pegawai
-- ----------------------------
INSERT INTO `pegawai` VALUES (1, 12345, 'Didik Abdul Mukmin', 'didik@mail.com', 'Staff');
INSERT INTO `pegawai` VALUES (2, 12346, 'Abdul Mukmin', 'abdul@gmail.com', 'Kepala Bidang');
INSERT INTO `pegawai` VALUES (4, 12347, 'Mukmin Abdul', 'mukmin@gmail.com', 'Kepala Seksi');
INSERT INTO `pegawai` VALUES (5, 12345, 'Didik Abdul Mukmin', 'didik@mail.com', 'Staff');
INSERT INTO `pegawai` VALUES (6, 12346, 'Abdul Mukmin', 'abdul@gmail.com', 'Kepala Bidang');
INSERT INTO `pegawai` VALUES (7, 12347, 'Mukmin Abdul', 'mukmin@gmail.com', 'Kepala Seksi');
INSERT INTO `pegawai` VALUES (8, 12345, 'Didik Abdul Mukmin', 'didik@mail.com', 'Staff');
INSERT INTO `pegawai` VALUES (9, 12346, 'Abdul Mukmin', 'abdul@gmail.com', 'Kepala Bidang');
INSERT INTO `pegawai` VALUES (10, 12347, 'Mukmin Abdul', 'mukmin@gmail.com', 'Kepala Seksi');
INSERT INTO `pegawai` VALUES (11, 12345, 'Didik Abdul Mukmin', 'didik@mail.com', 'Staff');
INSERT INTO `pegawai` VALUES (12, 12346, 'Abdul Mukmin', 'abdul@gmail.com', 'Kepala Bidang');
INSERT INTO `pegawai` VALUES (13, 12347, 'Mukmin Abdul', 'mukmin@gmail.com', 'Kepala Seksi');

-- ----------------------------
-- Table structure for system_users
-- ----------------------------
DROP TABLE IF EXISTS `system_users`;
CREATE TABLE `system_users`  (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `usr_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `usr_username` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `usr_password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`usr_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of system_users
-- ----------------------------
INSERT INTO `system_users` VALUES (1, 'DIDIK ABDUL MUKMIN', 'didik@mail.com', 'administrator', '$2y$10$Yu7.5jPNkMGpdwz2TvW.iueZBVRzHg0jp6uZy35f9U/mQFjSUoy6y');

SET FOREIGN_KEY_CHECKS = 1;
