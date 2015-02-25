-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 25 2015 г., 20:44
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `type`, `name`, `size`, `uploadtime`, `comment`, `code`) VALUES
(1, 'image/jpeg', '14246322457130.jpg', 314070, '2015-02-25 16:42:50', 'wrk', '67v039kt7v171koc7q90a1pwu68exn87'),
(2, 'image/jpeg', 'hotkeysublime.jpg', 676750, '2015-02-25 16:42:59', 'sub', 'n7jdc3oq3egmm4k8pv63rl8psamltwxz'),
(3, 'application/pdf', 'sublime_text_2_hotkeys.pdf', 77463, '2015-02-25 16:43:22', '', 'wgb3sjyd4do4g64l922om0pt4mm1ptgf'),
(4, 'text/plain', 'file.txt', 14, '2015-02-25 16:43:57', 'txt', '68bcz9ms1wktwo57eum9dtlzh232p2bm'),
(5, 'image/jpeg', 'LdRVGqHYAAM.jpg', 107244, '2015-02-25 16:44:05', 'asm', 'ueq37hnf0l9bdxw10v5j1pjoblat0luz');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
