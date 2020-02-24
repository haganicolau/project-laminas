--
-- Table structure for table `oauth_clients`
--
CREATE TABLE `oauth_clients` (
  `client_id` varchar(80) NOT NULL,
  `client_secret` varchar(80) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `grant_types` varchar(80) DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `oauth_refresh_tokens`
--
CREATE TABLE `oauth_refresh_tokens` (
  `refresh_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`refresh_token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `oauth_scopes`
--
CREATE TABLE `oauth_scopes` (
  `type` varchar(255) DEFAULT 'supported',
  `scope` varchar(2000) DEFAULT NULL,
  `client_id` varchar(80) DEFAULT NULL,
  `is_default` smallint(6) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `oauth_scopes_FK` (`client_id`),
  CONSTRAINT `oauth_scopes_FK` FOREIGN KEY (`client_id`) REFERENCES `oauth_clients` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


--
-- Table structure for table `users`
--
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(4) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;


--
-- Table structure for table `oauth_users`
--
CREATE TABLE `oauth_users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(2000) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `client_id` varchar(100) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `oauth_users_FK` (`client_id`),
  KEY `oauth_users_FK_1` (`id_user`),
  CONSTRAINT `oauth_users_FK` FOREIGN KEY (`client_id`) REFERENCES `oauth_clients` (`client_id`),
  CONSTRAINT `oauth_users_FK_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `oauth_access_tokens`
--
CREATE TABLE `oauth_access_tokens` (
  `access_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`access_token`),
  KEY `oauth_access_tokens_FK` (`user_id`),
  KEY `oauth_access_tokens_FK_1` (`client_id`),
  CONSTRAINT `oauth_access_tokens_FK` FOREIGN KEY (`user_id`) REFERENCES `oauth_users` (`username`),
  CONSTRAINT `oauth_access_tokens_FK_1` FOREIGN KEY (`client_id`) REFERENCES `oauth_clients` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `oauth_clients` VALUES ('app',NULL,'/','password',NULL,'');
INSERT INTO `oauth_scopes` VALUES ('user','USER','app',NULL,1);
