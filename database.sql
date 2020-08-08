-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text COLLATE utf8_bin NOT NULL,
  `effects` text COLLATE utf8_bin NOT NULL,
  `part` int(11) NOT NULL,
  `next` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `answers` (`id`, `text`, `effects`, `part`, `next`) VALUES
(1,	'Fuck you',	'',	1,	2),
(2,	'Fuck them',	'',	1,	3),
(3,	'Fuck us',	'',	1,	4),
(4,	'Fuck this',	'',	1,	5),
(5,	'Fuck off',	'',	2,	1),
(6,	'Fuck off',	'',	3,	1),
(7,	'Fuck off',	'',	4,	1),
(8,	'Fuck off',	'',	5,	1);

DROP TABLE IF EXISTS `parts`;
CREATE TABLE `parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `parts` (`id`, `title`, `text`) VALUES
(1,	'The ..... fuck !?',	' fuck the the fuck the fuck fuck the fuck the fuck the fuck  fuck t fuck the the fuck the fuck fuck the fuck the fuck the fuck the fuck the fuck fuck the fuck the fuck thehe  fuck the the fuck the fuck fuck the fuck the fuck the fuck the fuck the fuck fuck the fuck the fuck thethe fuck the fuck fuck the fuck the fuck the fuck the fuck the fuck fuck the fuck the  fuck the the fuck the fuck fuck the fuck the fuck the fuck the fuck the fuck fuck the fuck the fuck thefuck thethe fuck the fuck fuck the fuck the fuck the fuck the the fuck the fuck fuck the fuck the fuck the fuck the fuck the fuck fuck the fuck the fuck the'),
(2,	'Fuck you!',	'Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, Fuck you, '),
(3,	'Fuck them!',	'Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. Fuck them.. '),
(4,	'Fuck us!',	'Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! \r\n\r\nFuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! Fuck us?! '),
(5,	'Fuck this!',	'Fuuuuuuuuuuuuuuuuuuuuuuuuck thhhhhhhhhhhhhhhhhhhhhhhhhhhis\r\n\r\nFuuuuuuuuuuuuuuuuuuuuuuuuck thhhhhhhhhhhhhhhhhhhhhhhhhhhis\r\n\r\nFuuuuuuuuuuuuuuuuuuuuuuuuck thhhhhhhhhhhhhhhhhhhhhhhhhhhis\r\n\r\nFuuuuuuuuuuuuuuuuuuuuuuuuck thhhhhhhhhhhhhhhhhhhhhhhhhhhis\r\n\r\nFuuuuuuuuuuuuuuuuuuuuuuuuck thhhhhhhhhhhhhhhhhhhhhhhhhhhis\r\n\r\n');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `position` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `users` (`id`, `username`, `password`, `position`) VALUES
(1,	'admin',	'test',	1),
(2,	'Kevin',	'kevin',	1);

-- 2020-08-08 08:50:29
