/*
Navicat MySQL Data Transfer

Source Server         : openserver
Source Server Version : 50541
Source Host           : localhost:3306
Source Database       : rgk

Target Server Type    : MYSQL
Target Server Version : 50541
File Encoding         : 65001

Date: 2016-05-03 21:54:25
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notifications
-- ----------------------------
INSERT INTO `notifications` VALUES ('1', 'signup', 'email', 'Здравствуйте, уважаемый {username}, благодарим Вас за регистрацию на нашем сайте {sitename}.');
INSERT INTO `notifications` VALUES ('2', 'posts', 'browser', 'Уважаемый {username}. На сайте {sitename} добавлена новая статья - {articleName}. {shortText}... &lt;a href=\"{link}\"&gt;читать далее&lt;/a&gt;\r\n');
INSERT INTO `notifications` VALUES ('3', 'posts', 'email', 'Уважаемый {username}. На сайте {sitename} добавлена новая статья - \"{articleName}\". {shortText}... <a href=\"{link}\">читать далее</a> ');
INSERT INTO `notifications` VALUES ('4', 'ban', 'email', 'Здравствуйте, уважаемый {username}, ваша учетная запись была заблокирована на сайте  {sitename}.');
INSERT INTO `notifications` VALUES ('5', 'ban', 'email', 'Уважаемый {username}. Ваша учетная запись на сайте {sitename} была заблокирована.');

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('29', 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sagittis sollicitudin mi, non tempus mauris maximus in. Vivamus bibendum elit nec ornare dictum. Aenean commodo lacinia faucibus. Sed elementum eros metus, vitae vehicula quam tempus sit amet. Sed vitae sagittis ligula, nec commodo arcu.', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sending_notifications
-- ----------------------------
INSERT INTO `sending_notifications` VALUES ('34', 'Register', 'signup', '1', 'Здравствуйте, уважаемый test2, благодарим Вас за регистрацию на нашем сайте Notificator.', '8', 'email');
INSERT INTO `sending_notifications` VALUES ('35', 'Register', 'signup', '1', 'Здравствуйте, уважаемый test3, благодарим Вас за регистрацию на нашем сайте Notificator.', '9', 'email');
INSERT INTO `sending_notifications` VALUES ('36', 'Register', 'signup', '1', 'Здравствуйте, уважаемый test4, благодарим Вас за регистрацию на нашем сайте Notificator.', '10', 'email');
INSERT INTO `sending_notifications` VALUES ('37', 'New article', 'posts', '1', 'Уважаемый admin. На сайте Notificator добавлена новая статья - Lorem ipsum. Lorem ipsum...... <a href=\"http://rgk.dev/post/view?id=29\">читать далее</a> ', '1', 'email');
INSERT INTO `sending_notifications` VALUES ('38', 'New article', 'posts', '1', 'Уважаемый test1. На сайте Notificator добавлена новая статья - Lorem ipsum. Lorem ipsum...... <a href=\"http://rgk.dev/post/view?id=29\">читать далее</a> ', '7', 'email');
INSERT INTO `sending_notifications` VALUES ('39', 'New article', 'posts', '1', 'Уважаемый test2. На сайте Notificator добавлена новая статья - Lorem ipsum. Lorem ipsum...... <a href=\"http://rgk.dev/post/view?id=29\">читать далее</a> ', '8', 'email');
INSERT INTO `sending_notifications` VALUES ('40', 'New article', 'posts', '1', 'Уважаемый test3. На сайте Notificator добавлена новая статья - Lorem ipsum. Lorem ipsum...... <a href=\"http://rgk.dev/post/view?id=29\">читать далее</a> ', '9', 'email');
INSERT INTO `sending_notifications` VALUES ('41', 'New article', 'posts', '1', 'Уважаемый test4. На сайте Notificator добавлена новая статья - Lorem ipsum. Lorem ipsum...... <a href=\"http://rgk.dev/post/view?id=29\">читать далее</a> ', '10', 'email');
INSERT INTO `sending_notifications` VALUES ('42', 'New article', 'posts', '1', 'Уважаемый admin. На сайте Notificator добавлена новая статья - Lorem ipsum. Lorem ipsum...... &lt;a href=&quot;http://rgk.dev/post/view?id=29&quot;&gt; читать далее &lt;/a&gt;  ', '1', 'browser');
INSERT INTO `sending_notifications` VALUES ('43', 'New article', 'posts', '1', 'Уважаемый test1. На сайте Notificator добавлена новая статья - Lorem ipsum. Lorem ipsum...... <a href=\"http://rgk.dev/post/view?id=29\">читать далее</a> ', '7', 'browser');
INSERT INTO `sending_notifications` VALUES ('44', 'New article', 'posts', '1', 'Уважаемый test2. На сайте Notificator добавлена новая статья - Lorem ipsum. Lorem ipsum...... <a href=\"http://rgk.dev/post/view?id=29\">читать далее</a> ', '8', 'browser');
INSERT INTO `sending_notifications` VALUES ('45', 'New article', 'posts', '1', 'Уважаемый test3. На сайте Notificator добавлена новая статья - Lorem ipsum. Lorem ipsum...... <a href=\"http://rgk.dev/post/view?id=29\">читать далее</a> ', '9', 'browser');
INSERT INTO `sending_notifications` VALUES ('46', 'New article', 'posts', '1', 'Уважаемый test4. На сайте Notificator добавлена новая статья - Lorem ipsum. Lorem ipsum...... <a href=\"http://rgk.dev/post/view?id=29\">читать далее</a> ', '10', 'browser');
INSERT INTO `sending_notifications` VALUES ('47', 'Привет test1, ты был забанен', 'ban', '1', 'Привет test1, ты был у нас забанен, пока', '7', 'browser');
INSERT INTO `sending_notifications` VALUES ('48', 'Привет test1, ты был забанен', 'ban', '1', 'Привет test1, ты был у нас забанен, пока', '7', 'browser');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '$2y$13$JcUal.SILDOUecmCDo.sTuxkvQd7axAaW4paxys2yLSED3viPLdS2', 'admin@test.com', 'Bvgo0BRYCjPcK42qRW3Run2yF79RCo9m', '10');
INSERT INTO `user` VALUES ('7', 'test1', '$2y$13$P45fJJkSDTRt4AK89IFxNO3Jr86x4AzSBFzNGRhg5eMCRA8CbhsY2', 'test1@test.com', 'RiJXBzXIXIGqjgCApzB42V_pWBoweB_k', '10');
INSERT INTO `user` VALUES ('8', 'test2', '$2y$13$.YUNK4H5nyFPtRvzYw1FAOUvngsr9pfkp3z8lGVV2BU4lnXrkWEH2', 'test2@test.com', 'YN5wsp-k-sb2ISUlI7SJG5WaiQo5_zPQ', '10');
INSERT INTO `user` VALUES ('9', 'test3', '$2y$13$kHsB3.K7n4TnPDZFzVxuk.AAFwmPRuXsMGKEi1LitLpuIEEJEMyW.', 'test3@test.com', '8PLiBKLf2b2BdyeXmh9P1_6f3aBm5wbT', '10');
INSERT INTO `user` VALUES ('10', 'test4', '$2y$13$3.mbqKYttdyqZautjiDTaepXoWPqpuug0DwUvpsoKSb.Rxc8SyBzO', 'test4@test.com', '5_ga-ZUMhWLApTIDSszcFFvp9xIYBcH3', '10');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of view_notices
-- ----------------------------
