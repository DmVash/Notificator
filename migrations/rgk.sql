/*
Navicat MySQL Data Transfer

Source Server         : openserver
Source Server Version : 50541
Source Host           : localhost:3306
Source Database       : rgk

Target Server Type    : MYSQL
Target Server Version : 50541
File Encoding         : 65001

Date: 2016-04-11 23:04:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1460052574');
INSERT INTO `migration` VALUES ('m160406_135427_create_users', '1460052584');
INSERT INTO `migration` VALUES ('m160406_191107_create_notice_type', '1460052584');
INSERT INTO `migration` VALUES ('m160406_191656_create_sending_notice', '1460052584');
INSERT INTO `migration` VALUES ('m160406_192255_create_view_notices', '1460052585');

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notifications
-- ----------------------------
INSERT INTO `notifications` VALUES ('1', 'signup', 'email', 'Здравствуйте, уважаемый {username}, благодарим Вас за регистрацию на нашем сайте {sitename}.');

-- ----------------------------
-- Table structure for Posts
-- ----------------------------
DROP TABLE IF EXISTS `Posts`;
CREATE TABLE `Posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of Posts
-- ----------------------------

-- ----------------------------
-- Table structure for sending_notice
-- ----------------------------
DROP TABLE IF EXISTS `sending_notice`;
CREATE TABLE `sending_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sending_notice
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', null, null, 'admin@test.com', '10', 'fx0dHBsc_iqD_VG9lVuVuR1sqjwzXUJ5', null);
INSERT INTO `user` VALUES ('3', null, null, null, '10', 'vhYA6SnXjcuOhp5pg9HP7EtcXsMWX8YQ', null);
INSERT INTO `user` VALUES ('4', null, null, 'asdasd', '10', 'oNyHfBUKcul2Oz_YLcs_Haai3krT8zxO', '$2y$13$F1h5YDGK/PM42c.Z0dH6...pd2UPFurkWYa12PqmRYprD/61WWK7q');
INSERT INTO `user` VALUES ('5', '12', '12', '12', '10', 'XSKq6KzrjH-g0vIqvEKr7hLyzNvDK78g', '$2y$13$IB.zo9.GbDCN5t74zsV03u2dDjp9j4oS7g/e2erhDDPhzbCUS80l.');
INSERT INTO `user` VALUES ('6', null, null, '12', '10', 'l7XyiKFhPuDwYHQ4-YtKcHv4nZgVk1lU', '$2y$13$1jqRd03Tm7lXlx3iT3szS.Qaogw3hdCcrLMm5dJlajxLH1AkEAfUG');
INSERT INTO `user` VALUES ('7', null, null, '12', null, '_YRQ1HojTL9iFkvfoOe6Cf2c9AMEI7Cy', '$2y$13$YNPIakZlIugaWkfS4gLucutGGYJm/iqL/Ok2J8787z7UwEZKDeCMy');
INSERT INTO `user` VALUES ('8', null, null, '12', null, 'G_5DiiDwqVh3BpFQMxZUrYVN0_9J38EK', '$2y$13$9rLXJQQ.pqh4iZqrAcXlhu.8J3EVkA7wOWYyOWyRKcgCDu1x5Bj4i');
INSERT INTO `user` VALUES ('9', null, null, '12', null, 'hb8ENHFD20Ik2_UOoP7Y1WBPPyMGOz-B', '$2y$13$gRec9Q0yyveG8MJXQCZcteumjbWX7XsQo11PLAiI03WxWrhkskbDe');
INSERT INTO `user` VALUES ('10', null, null, '213213', null, 'Pzv-rAJXL_0fOTIGLgKIwFLqVPmY71Un', '$2y$13$NsbSjGoUUei9WNQ57ZJ5hOlgsjIrtC0UTfvJ0hxZdalByGhW5elSC');
INSERT INTO `user` VALUES ('11', null, null, '123213', null, 'm_Z_pz1MR5pLby5HJEkxYf0Y4jQwZZx8', '$2y$13$J3/StKl68yeW077dySr1NeiQb4MW.HvM70oWgLWOcWTyVqHDvXvBK');
INSERT INTO `user` VALUES ('12', '12', null, '12', '10', 'd_88T-VsSI5fe5Uv6_FSCKTC0DqpBAOq', null);
INSERT INTO `user` VALUES ('13', '321', '$2y$13$pf8OpO/qEBXLd3cjvMLlZuYXFMpoxLtkWOWgzBfqmHqH24JioES7K', '231', '10', 'CeJBeb5oEusLeTVEcewmDwG3uHpMf8JO', null);
INSERT INTO `user` VALUES ('14', 'test', '$2y$13$w/haCTJPEEpIXc6JG3n9OOW6D56kaqRbls4SDF8lZUPOUDpBlRlMO', 'test', '10', 'U6ayLo3EdKehcumhCWHXWN9a83ZJhMYj', null);
INSERT INTO `user` VALUES ('15', '123', '$2y$13$Sk85A.6aKPf5Hu2tlms57eyEwpl5eUR2yQMg3DghX2sVPPsd9ypJi', '123', null, 'F7dEQcRqg7bnVkke9cFTGh53L5CODEYZ', null);
INSERT INTO `user` VALUES ('16', 'sad', '$2y$13$id.UkPpv.BV3xQmDnb8/.ukUclyyIdszlQCeJVQ/R1HQHPLW1Z3G2', 'asd', null, 'SwH_0-Vo62O85JUB1ziO7TKdKlxw2djA', null);
INSERT INTO `user` VALUES ('17', 'dadad', '$2y$13$X8AnFczI2DVYDTMonJjCl.fT6x/1dreh.Y89ZAPxlvDoafMORVxXe', 'adad', null, '5nsgXTq_Q28CCvaVvJLeOBm5dmpzu7LV', null);
INSERT INTO `user` VALUES ('18', 'role', '$2y$13$Ylc8qLyYla6fN0Jj05RQsuKfYhPhVlFhJoPY.wTcCP8ZIiS26Fk0C', 'role', null, '-rZ5MZZdizAMfSbNvU00wW6CUVgjDCqa', null);
INSERT INTO `user` VALUES ('19', 'sada', '$2y$13$1UF1nMG1KxKr1XnBNovhRupOYvFJ32EdX99AumJBpH2AXZsqXjCmO', 'asdsad', null, 'fK3tTl7t_uGSQTudMAw_wTKpCrg3lryn', null);
INSERT INTO `user` VALUES ('20', 'sdas', '$2y$13$RpGOagtuL9430ZCuz87EuOxpBac9pUtWdHWoip4lDCBH2Ao/yuC/a', 'asdad', null, 'NW4ZgibeuZw584W9Aa_18u2vErrlS8iQ', null);
INSERT INTO `user` VALUES ('21', 'dsfdsf', '$2y$13$dpCDsaAgyCpk.v9abmo./.DR0zRV1IkEYJV9aEouFqBXam53PD8qy', 'sdfsf', null, '_WKDmga0i10DR-93gqD7M1oBTgvccIS6', null);
INSERT INTO `user` VALUES ('22', 'dsfsf', '$2y$13$f5ByzOmlgPPHgtMFQ1qZYOxcCZknK15nWqYBNlM4dOSDgs./eF15i', 'sdfs', null, 'CqBp1tK5X9vW0mG0-S0OUSJ5iCbvEXGN', null);
INSERT INTO `user` VALUES ('23', 'sd', '$2y$13$3GgttJVq8pocEfXs66z6kuB1h3Fp806wyNM5kytFGTHTsvPVviAue', 'cxv', null, 'ySkWdQK3Mzi0oAzM_gmqN9Jxmqxstjik', null);
INSERT INTO `user` VALUES ('24', 'sd', '$2y$13$xri2bL1/38AhnH8OlUhMVOVDgfNq4Q/VEYX3ZkNGEJ7Y3bEcd.k0W', 'cxv', null, 'RqyHhU2QqCpaCKRvf6lUjN4dViSAmYY6', null);

-- ----------------------------
-- Table structure for view_notices
-- ----------------------------
DROP TABLE IF EXISTS `view_notices`;
CREATE TABLE `view_notices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `notice_id` int(11) DEFAULT NULL,
  `viewed` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of view_notices
-- ----------------------------
