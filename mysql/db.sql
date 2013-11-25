DROP TABLE IF EXISTS `access_levels`;

CREATE TABLE `access_levels` (
  `grade` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  PRIMARY KEY (`grade`),
  UNIQUE KEY `grade_UNIQUE` (`grade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


LOCK TABLES `access_levels` WRITE;

INSERT INTO access_levels VALUES('0','administrator');

INSERT INTO access_levels VALUES('1','manager');

INSERT INTO access_levels VALUES('2','clerk');

INSERT INTO access_levels VALUES('3','agent');

INSERT INTO access_levels VALUES('4','visitor');

UNLOCK TABLES;


DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `access_level` int(11) NOT NULL DEFAULT '5',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


LOCK TABLES `users` WRITE;

INSERT INTO users VALUES('0','admin','5f4dcc3b5aa765d61d8327deb882cf99','sys','admin','0');

UNLOCK TABLES;


