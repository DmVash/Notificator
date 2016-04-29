/*
Navicat MySQL Data Transfer

Source Server         : openserver
Source Server Version : 50541
Source Host           : localhost:3306
Source Database       : rgk

Target Server Type    : MYSQL
Target Server Version : 50541
File Encoding         : 65001

Date: 2016-04-29 17:45:31
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notifications
-- ----------------------------
INSERT INTO `notifications` VALUES ('1', 'signup', 'email', 'Здравствуйте, уважаемый {username}, благодарим Вас за регистрацию на нашем сайте {sitename}.');
INSERT INTO `notifications` VALUES ('2', 'posts', 'browser', 'Уважаемый {username}. На сайте {sitename} добавлена новая статья - {articleName}. {shortText}... <a href=\"{link}\">читать далее</a> ');
INSERT INTO `notifications` VALUES ('3', 'posts', 'email', 'Уважаемый {username}. На сайте {sitename} добавлена новая статья - \"{articleName}\". {shortText}... <a href=\"{link}\">читать далее</a> ');
INSERT INTO `notifications` VALUES ('4', 'ban', 'email', 'Здравствуйте, уважаемый {username}, ваша учетная запись была заблокирована на сайте  {sitename}.');

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

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
INSERT INTO `posts` VALUES ('12', 'test', 'test', '2');
INSERT INTO `posts` VALUES ('13', 'test', 'test', '2');
INSERT INTO `posts` VALUES ('14', 'test', 'test', '2');
INSERT INTO `posts` VALUES ('15', 'test', 'test test test testt test', '2');
INSERT INTO `posts` VALUES ('16', 'test', 'test test test test', '2');
INSERT INTO `posts` VALUES ('17', 'test', 'test test test test', '2');
INSERT INTO `posts` VALUES ('18', 'test', 'test test test test', '2');
INSERT INTO `posts` VALUES ('19', 'test', 'test test test test', '2');
INSERT INTO `posts` VALUES ('20', 'test', 'test test test test', '2');
INSERT INTO `posts` VALUES ('21', 'test', 'test test test test', '2');
INSERT INTO `posts` VALUES ('22', 'test', 'test test test test', '2');
INSERT INTO `posts` VALUES ('23', 'test', 'test test test test', '2');
INSERT INTO `posts` VALUES ('24', 'test', 'test test test test', '2');
INSERT INTO `posts` VALUES ('25', 'test', 'test test test test', '2');
INSERT INTO `posts` VALUES ('26', 'test', 'test test test test', '2');
INSERT INTO `posts` VALUES ('27', 'test test test', 'test test test test test', '2');
INSERT INTO `posts` VALUES ('28', 'test test test', 'test test test test test', '2');

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
-- Table structure for sending_notifications
-- ----------------------------
DROP TABLE IF EXISTS `sending_notifications`;
CREATE TABLE `sending_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sending_notifications
-- ----------------------------
INSERT INTO `sending_notifications` VALUES ('3', 'test', 'posts', '2', 'test test test testt test', '1', null);
INSERT INTO `sending_notifications` VALUES ('4', 'test', 'posts', '2', 'test test test testt test', '2', null);
INSERT INTO `sending_notifications` VALUES ('5', 'test', 'posts', '2', 'Уважаемый sada. На сайте Notificator добавлена новая статья - test. Уважаемый sada.... <a href=\\\"http://test-rgk.dev/post/view?id=26\\\">читать далее</a> ', '1', 'email');
INSERT INTO `sending_notifications` VALUES ('6', 'test', 'posts', '2', 'Уважаемый ololosh. На сайте Notificator добавлена новая статья - test. Уважаемый ololosh.... <a href=\\\"http://test-rgk.dev/post/view?id=26\\\">читать далее</a> ', '2', 'email');
INSERT INTO `sending_notifications` VALUES ('7', 'test test test', 'posts', '2', 'Уважаемый sada. На сайте Notificator добавлена новая статья - test test test. Уважаемый sada.... <a href=\\\"http://test-rgk.dev/post/view?id=27\\\">читать далее</a> ', '1', 'email');
INSERT INTO `sending_notifications` VALUES ('8', 'test test test', 'posts', '2', 'Уважаемый ololosh. На сайте Notificator добавлена новая статья - test test test. Уважаемый ololosh.... <a href=\\\"http://test-rgk.dev/post/view?id=27\\\">читать далее</a> ', '2', 'email');
INSERT INTO `sending_notifications` VALUES ('9', 'test test test', 'posts', '2', 'Уважаемый sada. На сайте Notificator добавлена новая статья - test test test. Уважаемый sada.... <a href=\\\"http://test-rgk.dev/post/view?id=28\\\">читать далее</a> ', '1', 'email');
INSERT INTO `sending_notifications` VALUES ('10', 'test test test', 'posts', '2', 'Уважаемый ololosh. На сайте Notificator добавлена новая статья - test test test. Уважаемый ololosh.... <a href=\\\"http://test-rgk.dev/post/view?id=28\\\">читать далее</a> ', '2', 'email');
INSERT INTO `sending_notifications` VALUES ('11', 'test test test', 'posts', '2', 'Уважаемый sada. На сайте Notificator добавлена новая статья - test test test. Уважаемый sada.... <a href=\\\"http://test-rgk.dev/post/view?id=28\\\">читать далее</a> ', '1', 'browser');
INSERT INTO `sending_notifications` VALUES ('12', 'test test test', 'posts', '2', 'Уважаемый ololosh. На сайте Notificator добавлена новая статья - test test test. Уважаемый ololosh.... <a href=\\\"http://test-rgk.dev/post/view?id=28\\\">читать далее</a> ', '2', 'browser');
INSERT INTO `sending_notifications` VALUES ('13', 'test test test', 'posts', '2', 'Уважаемый sada. На сайте Notificator добавлена новая статья - test test test. Уважаемый sada.... <a href=\\\"http://test-rgk.dev/post/view?id=28\\\">читать далее</a> ', '1', 'email');
INSERT INTO `sending_notifications` VALUES ('14', 'test test test', 'posts', '2', 'Уважаемый ololosh. На сайте Notificator добавлена новая статья - test test test. Уважаемый ololosh.... <a href=\\\"http://test-rgk.dev/post/view?id=28\\\">читать далее</a> ', '2', 'email');
INSERT INTO `sending_notifications` VALUES ('15', 'test test test', 'posts', '2', 'Уважаемый sada. На сайте Notificator добавлена новая статья - test test test. Уважаемый sada.... <a href=\\\"http://test-rgk.dev/post/view?id=28\\\">читать далее</a> ', '1', 'browser');
INSERT INTO `sending_notifications` VALUES ('16', 'test test test', 'posts', '2', 'Уважаемый ololosh. На сайте Notificator добавлена новая статья - test test test. Уважаемый ololosh.... <a href=\\\"http://test-rgk.dev/post/view?id=28\\\">читать далее</a> ', '2', 'browser');
INSERT INTO `sending_notifications` VALUES ('17', null, 'ban', '2', 'Здравствуйте, уважаемый sada, ваша учетная запись была заблокирована на сайте  Notificator.', null, 'email');
INSERT INTO `sending_notifications` VALUES ('18', 'asdas asdasd', 'ban', '1', 'asdasd sada , sada dsfsf rrrr', '1', 'email');
INSERT INTO `sending_notifications` VALUES ('19', 'sada, sada', 'ban', '1', 'asdasd sada , sada dsfsf rrrr', '1', 'browser');
INSERT INTO `sending_notifications` VALUES ('20', 'sada, sada lol sada', 'ban', '1', 'asdasd sada , sada dsfsf rrrr', '1', 'browser');
INSERT INTO `sending_notifications` VALUES ('21', 'sada, sada lol Notificator', 'ban', '1', 'asdasd sada , sada dsfsf rrrr', '1', 'browser');
INSERT INTO `sending_notifications` VALUES ('22', 'sada, sada lol Notificator', 'ban', '1', 'asdasd sada , sada dsfsf rrrr', '1', 'browser');
INSERT INTO `sending_notifications` VALUES ('23', 'sada, sada lol Notificator', 'ban', '1', 'asdasd sada , sada dsfsf rrrr', '1', 'browser');
INSERT INTO `sending_notifications` VALUES ('24', 'sada, sada lol test', 'posts', '1', '', '1', 'browser');
INSERT INTO `sending_notifications` VALUES ('25', 'Register', 'signup', null, 'Здравствуйте, уважаемый admin, благодарим Вас за регистрацию на нашем сайте Notificator.', null, 'email');
INSERT INTO `sending_notifications` VALUES ('26', 'Register', 'signup', null, 'Здравствуйте, уважаемый 123321, благодарим Вас за регистрацию на нашем сайте Notificator.', null, 'email');
INSERT INTO `sending_notifications` VALUES ('27', 'test olol lil lol', 'posts', '2', 'rrr sada rrr test rrrr test1 test2...  rrrr http://test-rgk.dev/post/view?id=1 rrrr', '1', 'browser');
INSERT INTO `sending_notifications` VALUES ('28', 'test olol lil lol', 'posts', '2', 'rrr ololosh rrr test rrrr test1 test2...  rrrr http://test-rgk.dev/post/view?id=1 rrrr', '2', 'browser');
INSERT INTO `sending_notifications` VALUES ('29', 'test olol lil lol', 'posts', '2', 'rrr admin rrr test rrrr test1 test2...  rrrr http://test-rgk.dev/post/view?id=1 rrrr', '3', 'browser');
INSERT INTO `sending_notifications` VALUES ('30', 'test olol lil lol', 'posts', '2', 'rrr 123 rrr test rrrr test1 test2...  rrrr http://test-rgk.dev/post/view?id=1 rrrr', '4', 'browser');
INSERT INTO `sending_notifications` VALUES ('31', 'test olol lil lol', 'posts', '2', 'rrr 123 rrr test rrrr test1 test2...  rrrr http://test-rgk.dev/post/view?id=1 rrrr', '5', 'browser');
INSERT INTO `sending_notifications` VALUES ('32', 'test olol lil lol', 'posts', '2', 'rrr 123321 rrr test rrrr test1 test2...  rrrr http://test-rgk.dev/post/view?id=1 rrrr', '6', 'browser');

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
  `status` int(11) DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'sada', '$2y$13$qKpXdXENWZZM17d806jqGeXWgTZG/Ky4TN1JqbxEXNDikFuQVoSk6', 'sd@qwe.com', 'lI6rKLfYrZzI0lBuDKCeCf9COkqvE0-q', '0');
INSERT INTO `user` VALUES ('2', 'ololosh', '$2y$13$NnfvxY0Y21E9tCYSqYkaUO1KuKiAtmt04v8r0JAazgPfjTN4RwMEy', '123@123.com', 'ORT09HsuGnrFK1QudxSF5IEKWam2luyv', '10');
INSERT INTO `user` VALUES ('3', 'admin', '$2y$13$JcUal.SILDOUecmCDo.sTuxkvQd7axAaW4paxys2yLSED3viPLdS2', 'admin@test.com', 'Bvgo0BRYCjPcK42qRW3Run2yF79RCo9m', '10');
INSERT INTO `user` VALUES ('4', '123', '$2y$13$QS5.PLjll89wDlBkfOF9/.0LnLcjYLELhdL98YvNxMp/2DRR4OFFe', '123', '4s3Rf2shRCvoZa49ULH2VHPVfssNysO-', null);
INSERT INTO `user` VALUES ('5', '123', '$2y$13$CUaufyFv0Kai6RVYgUgfH.tX0n7yeq/3tPnPKpTmPWIMlQi12V81.', '123', 'pmpI-fqNOfZfWpWGqjgz-ahR5wDkl6C4', null);
INSERT INTO `user` VALUES ('6', '123321', '$2y$13$xnUjjfMKY/rELsNHWo2NAue.5fkaBT84UDYEYqkr2.BqF2QNqLGb2', '1233242@123.com', 'f3TrT30oWk8EkF3uBQLTXEvqouKFNY_m', '10');

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
  CONSTRAINT `view_notices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `view_notices_ibfk_2` FOREIGN KEY (`notice_id`) REFERENCES `sending_notifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of view_notices
-- ----------------------------
INSERT INTO `view_notices` VALUES ('1', '2', '3', null);
INSERT INTO `view_notices` VALUES ('2', null, null, null);
INSERT INTO `view_notices` VALUES ('3', '2', '9', null);
