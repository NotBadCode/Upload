-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 27 2015 г., 12:07
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
(1, 'image/jpeg', '14246400880390.jpg', 115754, '2015-02-27 08:05:54', '', 'b600lg7qxkvmb9045fdcder80ght36om'),
(2, 'image/jpeg', 'hotkeysublime.jpg', 676750, '2015-02-27 08:06:06', '', '53kwzy1fnt8qnnjdop5v9w4jh2wpln2e'),
(3, 'image/jpeg', '14246322457130.jpg', 314070, '2015-02-27 08:06:12', '', '6h6pq8z978ea2hnqzd23vr3ga54ygcs2'),
(4, 'text/plain', 'file.txt', 14, '2015-02-27 08:06:17', '', '8tc61k3e1dgf9hcwji7y1lyapg0vi1ab'),
(5, 'application/pdf', 'sublime_text_2_hotkeys.pdf', 77463, '2015-02-27 08:06:30', '', 'ju0l1lbgsvnnnpgelozf7s00v9ek8g9a');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;