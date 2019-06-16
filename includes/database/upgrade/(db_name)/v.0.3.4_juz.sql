CREATE TABLE `salamquran_data`.`1_detail` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,

`type` enum('juz', 'hizb', 'rub', 'nim', 'page', 'surah') NULL,

`index` smallint(4) UNSIGNED  NULL,

`startjuz` smallint(3) UNSIGNED NULL DEFAULT NULL,
`endjuz` smallint(3) UNSIGNED NULL DEFAULT NULL,
`juzcount` smallint(3) UNSIGNED NULL DEFAULT NULL,

`startpage` smallint(3) UNSIGNED NULL DEFAULT NULL,
`endpage` smallint(3) UNSIGNED NULL DEFAULT NULL,
`pagecount` smallint(3) UNSIGNED NULL DEFAULT NULL,

`startaya` smallint(4) UNSIGNED NULL DEFAULT NULL,
`endaya` smallint(4) UNSIGNED NULL DEFAULT NULL,
`ayacount` smallint(4) UNSIGNED NULL DEFAULT NULL,

`startsura` smallint(3) UNSIGNED NULL DEFAULT NULL,
`endsura` smallint(3) UNSIGNED NULL DEFAULT NULL,
`suracount` smallint(3) UNSIGNED NULL DEFAULT NULL,

`starthizb` smallint(3) UNSIGNED NULL DEFAULT NULL,
`endhizb` smallint(3) UNSIGNED NULL DEFAULT NULL,
`hezbcount` smallint(3) UNSIGNED NULL DEFAULT NULL,

`startnim` smallint(3) UNSIGNED NULL DEFAULT NULL,
`endnim` smallint(3) UNSIGNED NULL DEFAULT NULL,
`nimcount` smallint(3) UNSIGNED NULL DEFAULT NULL,

`startrub` smallint(3) UNSIGNED NULL DEFAULT NULL,
`endrub` smallint(3) UNSIGNED NULL DEFAULT NULL,
`rubcount` smallint(3) UNSIGNED NULL DEFAULT NULL,

`words` int(10) UNSIGNED NULL DEFAULT NULL,
`theletter` int(10) UNSIGNED NULL DEFAULT NULL,

PRIMARY KEY (`id`)

) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


ALTER TABLE `salamquran_data`.`1_detail` ADD INDEX `index_search_type` (`type`);



