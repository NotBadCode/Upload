-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 04 2015 г., 12:15
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `files`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `path` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `fileid` int(11) NOT NULL,
  `text` varchar(200) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `number`, `path`, `name`, `fileid`, `text`, `time`) VALUES
(1, 1, '1', 'Аноним', 13, '2323', '2015-03-04 08:02:55'),
(2, 2, '2', 'Аноним', 13, '123', '2015-03-04 08:02:57'),
(3, 3, '3', 'Аноним', 13, '1111', '2015-03-04 08:03:00'),
(4, 1, '1.1', 'Аноним', 13, '212', '2015-03-04 08:03:19'),
(5, 1, '3.1', 'Аноним', 13, '2323', '2015-03-04 08:03:26'),
(6, 1, '3.1.1', 'Аноним', 13, '23232', '2015-03-04 08:03:36'),
(7, 1, '1.1.1', 'Аноним', 13, '23232323', '2015-03-04 08:03:45');

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `size` int(11) NOT NULL,
  `uploadtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` varchar(500) NOT NULL,
  `code` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `type`, `name`, `size`, `uploadtime`, `comment`, `code`) VALUES
(1, 'image/jpeg', '14246400880390.jpg', 115754, '2015-02-27 08:05:54', '', 'b600lg7qxkvmb9045fdcder80ght36om'),
(2, 'image/jpeg', 'hotkeysublime.jpg', 676750, '2015-02-27 08:06:06', '', '53kwzy1fnt8qnnjdop5v9w4jh2wpln2e'),
(3, 'image/jpeg', '14246322457130.jpg', 314070, '2015-02-27 08:06:12', '', '6h6pq8z978ea2hnqzd23vr3ga54ygcs2'),
(4, 'text/plain', 'file.txt', 14, '2015-02-27 08:06:17', '', '8tc61k3e1dgf9hcwji7y1lyapg0vi1ab'),
(5, 'application/pdf', 'sublime_text_2_hotkeys.pdf', 77463, '2015-02-27 08:06:30', '', 'ju0l1lbgsvnnnpgelozf7s00v9ek8g9a'),
(6, 'image/jpeg', 'LdRVGqHYAAM.jpg', 107244, '2015-02-27 10:32:59', '', '5sb811mpyeaor13ym7cy3mj0dv6v65ry'),
(7, 'image/png', 'logo.png', 46522, '2015-02-27 12:01:29', '', '43fneev4dtdi87hjtmpdc4cpgsokxom6'),
(8, 'image/jpeg', 'ddddddddddddd.jpg', 335728, '2015-02-27 12:57:10', '', 'ntmozzw2w0rj9c07jy6s0pcl5ewlbqpp'),
(9, 'application/pdf', 'c-ruby.pdf', 194329, '2015-02-27 12:58:00', '', '5lndel7smra95dx2xvy950exy2jg3s5q'),
(10, 'application/pdf', 'c-ruby.pdf', 194329, '2015-02-27 12:58:14', '', 'b4o0y3cf63rw3ftfthbf7zo3xc02bpgn'),
(11, 'application/pdf', 'c-ruby.pdf', 194329, '2015-02-27 12:58:24', '', 'xhfb10db6ltao4opmu0mmj5hvv6ennfg'),
(12, 'image/jpeg', '14246322457130.jpg', 314070, '2015-02-27 13:29:41', '', 'i8ymz5m36etmedl3idnuftnuwp2kg6k4'),
(13, 'image/png', '128.png', 20922, '2015-03-03 19:07:08', '', 'whdtkctdadmy75nw5900qlgb73c60zhc');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
