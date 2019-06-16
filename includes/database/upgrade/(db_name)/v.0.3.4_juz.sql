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
`hizbcount` smallint(3) UNSIGNED NULL DEFAULT NULL,

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



INSERT INTO salamquran_data.1_detail
(`type`,`index`,`startjuz`,`endjuz`,`juzcount`,`startpage`,`endpage`,`pagecount`,`startaya`,`endaya`,`ayacount`,`startsura`,`endsura`,`suracount`,`starthizb`,`endhizb`,`hizbcount`,`startnim`,`endnim`,`nimcount`,`startrub`,`endrub`,`rubcount`,`words`)
VALUES
('juz', 1, 1, 1, 1, 1, 21, 21, 1, 148, 148, 1, 2, 2, 1, 2, 2, 1, 4, 4, 1, 8, 8, 2522),
('juz', 2, 2, 2, 1, 22, 41, 20, 149, 259, 111, 2, 2, 1, 3, 4, 2, 5, 8, 4, 9, 16, 8, 2579),
('juz', 3, 3, 3, 1, 42, 62, 21, 260, 385, 126, 2, 3, 2, 5, 6, 2, 9, 12, 4, 17, 24, 8, 2622),
('juz', 4, 4, 4, 1, 62, 81, 20, 386, 516, 131, 3, 4, 2, 7, 8, 2, 13, 16, 4, 25, 32, 8, 2506),
('juz', 5, 5, 5, 1, 82, 101, 20, 517, 640, 124, 4, 4, 1, 9, 10, 2, 17, 20, 4, 33, 40, 8, 2579),
('juz', 6, 6, 6, 1, 102, 121, 20, 641, 750, 110, 4, 5, 2, 11, 12, 2, 21, 24, 4, 41, 48, 8, 2503),
('juz', 7, 7, 7, 1, 121, 141, 21, 751, 899, 149, 5, 6, 2, 13, 14, 2, 25, 28, 4, 49, 56, 8, 2774),
('juz', 8, 8, 8, 1, 142, 161, 20, 900, 1041, 142, 6, 7, 2, 15, 16, 2, 29, 32, 4, 57, 64, 8, 2566),
('juz', 9, 9, 9, 1, 162, 181, 20, 1042, 1200, 159, 7, 8, 2, 17, 18, 2, 33, 36, 4, 65, 72, 8, 2487),
('juz', 10, 10, 10, 1, 182, 201, 20, 1201, 1327, 127, 8, 9, 2, 19, 20, 2, 37, 40, 4, 73, 80, 8, 2389),
('juz', 11, 11, 11, 1, 201, 221, 21, 1328, 1478, 151, 9, 11, 3, 21, 22, 2, 41, 44, 4, 81, 88, 8, 2657),
('juz', 12, 12, 12, 1, 222, 241, 20, 1479, 1648, 170, 11, 12, 2, 23, 24, 2, 45, 48, 4, 89, 96, 8, 2693),
('juz', 13, 13, 13, 1, 242, 261, 20, 1649, 1802, 154, 12, 14, 3, 25, 26, 2, 49, 52, 4, 97, 104, 8, 2613),
('juz', 14, 14, 14, 1, 262, 281, 20, 1803, 2029, 227, 15, 16, 2, 27, 28, 2, 53, 56, 4, 105, 112, 8, 2499),
('juz', 15, 15, 15, 1, 282, 301, 20, 2030, 2214, 185, 17, 18, 2, 29, 30, 2, 57, 60, 4, 113, 120, 8, 2684),
('juz', 16, 16, 16, 1, 302, 321, 20, 2215, 2483, 269, 18, 20, 3, 31, 32, 2, 61, 64, 4, 121, 128, 8, 2747),
('juz', 17, 17, 17, 1, 322, 341, 20, 2484, 2673, 190, 21, 22, 2, 33, 34, 2, 65, 68, 4, 129, 136, 8, 2443),
('juz', 18, 18, 18, 1, 342, 361, 20, 2674, 2875, 202, 23, 25, 3, 35, 36, 2, 69, 72, 4, 137, 144, 8, 2641),
('juz', 19, 19, 19, 1, 362, 381, 20, 2876, 3214, 339, 25, 27, 3, 37, 38, 2, 73, 76, 4, 145, 152, 8, 2611),
('juz', 20, 20, 20, 1, 382, 401, 20, 3215, 3385, 171, 27, 29, 3, 39, 40, 2, 77, 80, 4, 153, 160, 8, 2554),
('juz', 21, 21, 21, 1, 402, 421, 20, 3386, 3563, 178, 29, 33, 5, 41, 42, 2, 81, 84, 4, 161, 168, 8, 2582),
('juz', 22, 22, 22, 1, 422, 441, 20, 3564, 3732, 169, 33, 36, 4, 43, 44, 2, 85, 88, 4, 169, 176, 8, 2638),
('juz', 23, 23, 23, 1, 442, 461, 20, 3733, 4089, 357, 36, 39, 4, 45, 46, 2, 89, 92, 4, 177, 184, 8, 2628),
('juz', 24, 24, 24, 1, 462, 481, 20, 4090, 4264, 175, 39, 41, 3, 47, 48, 2, 93, 96, 4, 185, 192, 8, 2520),
('juz', 25, 25, 25, 1, 482, 502, 21, 4265, 4510, 246, 41, 45, 5, 49, 50, 2, 97, 100, 4, 193, 200, 8, 2668),
('juz', 26, 26, 26, 1, 502, 521, 20, 4511, 4705, 195, 46, 51, 6, 51, 52, 2, 101, 104, 4, 201, 208, 8, 2612),
('juz', 27, 27, 27, 1, 522, 541, 20, 4706, 5104, 399, 51, 57, 7, 53, 54, 2, 105, 108, 4, 209, 216, 8, 2528),
('juz', 28, 28, 28, 1, 542, 561, 20, 5105, 5241, 137, 58, 66, 9, 55, 56, 2, 109, 112, 4, 217, 224, 8, 2618),
('juz', 29, 29, 29, 1, 562, 581, 20, 5242, 5672, 431, 67, 77, 11, 57, 58, 2, 113, 116, 4, 225, 232, 8, 2661),
('juz', 30, 30, 30, 1, 582, 604, 23, 5673, 6236, 564, 78, 114, 37, 59, 60, 2, 117, 120, 4, 233, 240, 8, 2308);
