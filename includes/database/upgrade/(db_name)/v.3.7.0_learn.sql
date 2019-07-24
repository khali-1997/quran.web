CREATE TABLE `learngroup` (
`id` int(10) UNSIGNED NOT NULL auto_increment,
`title` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`desc` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`sort` int(10) NULL DEFAULT NULL,
`unlockscore` int(10) NULL DEFAULT NULL,
`status` enum('enable', 'disable', 'awaiting', 'deleted', 'publish', 'expire')  NULL DEFAULT NULL,
`datecreated` datetime  NOT NULL DEFAULT CURRENT_TIMESTAMP,
`file` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `learnlevel` (
`id` int(10) UNSIGNED NOT NULL auto_increment,
`learngroup_id` int(10) UNSIGNED NOT NULL,
`title` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`desc` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`type` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`quran` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`examcaller` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`file` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`setting` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`sort` int(10) NULL DEFAULT NULL,
`ratio1` int(10) NULL DEFAULT NULL,
`ratio2` int(10) NULL DEFAULT NULL,
`ratio3` int(10) NULL DEFAULT NULL,
`unlockscore` int(10) NULL DEFAULT NULL,
`status` enum('enable', 'disable', 'awaiting', 'deleted', 'publish', 'expire')  NULL DEFAULT NULL,
`datecreated` datetime  NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `learnlevel_learngroup_id` FOREIGN KEY (`learngroup_id`) REFERENCES `learngroup` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `learnexam` (
`id` int(10) UNSIGNED NOT NULL auto_increment,
`learngroup_id` int(10) UNSIGNED NOT NULL,
`caller` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`desc` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`type` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`opt1` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`opt2` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`opt3` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`opt4` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`trueopt` enum('opt1', 'opt2', 'opt3', 'opt4') NULL DEFAULT NULL,
`status` enum('enable', 'disable', 'awaiting', 'deleted', 'publish', 'expire')  NULL DEFAULT NULL,
`datecreated` datetime  NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `learnexam_learngroup_id` FOREIGN KEY (`learngroup_id`) REFERENCES `learngroup` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `learnscore` (
`id` int(10) UNSIGNED NOT NULL auto_increment,
`learngroup_id` int(10) UNSIGNED NOT NULL,
`learnlevel_id` int(10) UNSIGNED NOT NULL,
`user_id` int(10) UNSIGNED NOT NULL,
`examcaller` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
`star` smallint(3) NULL DEFAULT NULL,
`score` int(10) NULL DEFAULT NULL,
`status` enum('enable', 'disable', 'awaiting', 'deleted', 'publish', 'expire')  NULL DEFAULT NULL,
`datecreated` datetime  NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
CONSTRAINT `learnscore_learngroup_id` FOREIGN KEY (`learngroup_id`) REFERENCES `learngroup` (`id`) ON UPDATE CASCADE,
CONSTRAINT `learnscore_learnlevel_id` FOREIGN KEY (`learnlevel_id`) REFERENCES `learnlevel` (`id`) ON UPDATE CASCADE,
CONSTRAINT `learnscore_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
