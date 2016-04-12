/*
Navicat MySQL Data Transfer

Source Server         : openserver
Source Server Version : 50541
Source Host           : localhost:3306
Source Database       : rgk

Target Server Type    : MYSQL
Target Server Version : 50541
File Encoding         : 65001

Date: 2016-04-12 23:23:15
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
-- Table structure for notice_type
-- ----------------------------
DROP TABLE IF EXISTS `notice_type`;
CREATE TABLE `notice_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notice_type
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notifications
-- ----------------------------
INSERT INTO `notifications` VALUES ('1', 'signup', 'email', 'Здравствуйте, уважаемый {username}, благодарим Вас за регистрацию на нашем сайте {sitename}.');
INSERT INTO `notifications` VALUES ('2', 'posts', 'browser', 'Уважаемый {username}. На сайте {sitename} добавлена новая статья - {articleName}. {shortText}... <a href=\\\"{link}\\\">читать далее</a> ');
INSERT INTO `notifications` VALUES ('3', 'posts', 'email', 'Уважаемый {username}. На сайте {sitename} добавлена новая статья - \"{articleName}\". {shortText}... <a href=\\\"{link}\\\">читать далее</a> ');

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('1', 'test', 'test1 test2 test3 test4 test5 test6', null);
INSERT INTO `posts` VALUES ('2', 'test', 'test', null);
INSERT INTO `posts` VALUES ('3', 'test', 'test', null);
INSERT INTO `posts` VALUES ('4', 'test', 'test', null);
INSERT INTO `posts` VALUES ('5', 'test', 'test', null);
INSERT INTO `posts` VALUES ('6', 'test', 'test', null);
INSERT INTO `posts` VALUES ('7', 'test', 'test', '2');
INSERT INTO `posts` VALUES ('8', 'asd', 'asd', '2');
INSERT INTO `posts` VALUES ('9', 'asd', 'asd', '2');
INSERT INTO `posts` VALUES ('10', 'test test test', 'lolol', '1');
INSERT INTO `posts` VALUES ('11', 'zxzxczc', 'zxcxzc', '1');

-- ----------------------------
-- Table structure for sending_browser_notifications
-- ----------------------------
DROP TABLE IF EXISTS `sending_browser_notifications`;
CREATE TABLE `sending_browser_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sending_browser_notifications
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
  `auth_key` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'sada', '$2y$13$qKpXdXENWZZM17d806jqGeXWgTZG/Ky4TN1JqbxEXNDikFuQVoSk6', 'sd', 'lI6rKLfYrZzI0lBuDKCeCf9COkqvE0-q', '10');
INSERT INTO `user` VALUES ('2', 'ololosh', '$2y$13$NnfvxY0Y21E9tCYSqYkaUO1KuKiAtmt04v8r0JAazgPfjTN4RwMEy', '123@123.com', 'ORT09HsuGnrFK1QudxSF5IEKWam2luyv', '10');

-- ----------------------------
-- Table structure for view_notices
-- ----------------------------
DROP TABLE IF EXISTS `view_notices`;
CREATE TABLE `view_notices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `notice_id` int(11) DEFAULT NULL,
  `viewed` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `notice_id` (`notice_id`),
  CONSTRAINT `view_notices_ibfk_2` FOREIGN KEY (`notice_id`) REFERENCES `sending_browser_notifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `view_notices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of view_notices
-- ----------------------------
