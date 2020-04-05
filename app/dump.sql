-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.19-log - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных test
CREATE DATABASE IF NOT EXISTS `test` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `test`;

-- Дамп структуры для таблица test.test_admin
CREATE TABLE IF NOT EXISTS `test_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `pass` tinytext NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test.test_admin: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `test_admin` DISABLE KEYS */;
INSERT INTO `test_admin` (`id`, `name`, `pass`, `is_active`) VALUES
	(1, 'admin', '$2y$10$0oMB0BIPY.iBxwGPdgKJweQj5Rn6fMsOIkAg20gVYM/VL5YhfUP8a', 0);
/*!40000 ALTER TABLE `test_admin` ENABLE KEYS */;

-- Дамп структуры для таблица test.test_left_menu
CREATE TABLE IF NOT EXISTS `test_left_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `href` tinytext,
  `pos` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test.test_left_menu: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `test_left_menu` DISABLE KEYS */;
INSERT INTO `test_left_menu` (`id`, `name`, `href`, `pos`) VALUES
	(1, 'Главная', NULL, 1),
	(2, 'Войти', 'admin/authorisation', 3),
	(3, 'Выйти', 'admin/exit', 4),
	(4, 'Добавить задачу', 'index/add', 2);
/*!40000 ALTER TABLE `test_left_menu` ENABLE KEYS */;

-- Дамп структуры для таблица test.test_task
CREATE TABLE IF NOT EXISTS `test_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `email` text NOT NULL,
  `task` text NOT NULL,
  `status` int(10) unsigned NOT NULL DEFAULT '0',
  `is_edited` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test.test_task: ~18 rows (приблизительно)
/*!40000 ALTER TABLE `test_task` DISABLE KEYS */;
INSERT INTO `test_task` (`id`, `user`, `email`, `task`, `status`, `is_edited`) VALUES
	(15, 'user1', 'user1@mail.ru', 'task1', 1, 0),
	(16, 'user2', 'user2@mail.ru', 'alert(‘test’);', 0, 0),
	(17, 'user3', 'user3@mail.ru', 'task3', 0, 0),
	(18, 'user4', 'user4@mail.ru', 'task473sdf', 1, 1),
	(19, 'user5', 'marran_@mail.ru', 'task5i', 1, 1),
	(20, 'asdf', 'user2@mail.ru', 'sdfdf', 1, 0),
	(21, 'sdf', 'user2@mail.ru', 'asdfdf', 0, 0),
	(22, 'werer', 'user4@mail.ru', 'asdf', 0, 0),
	(23, 'asdf', 'user2@mail.ru', 'kjgh', 0, 0),
	(24, 'asdf', 'user2@mail.ru', 'sdf', 0, 0),
	(25, 'asdf', 'user2@mail.ru', 'asdf', 0, 0),
	(26, 'asdf', 'user4@mail.ru', 'sdf', 0, 0),
	(27, 'asdf', 'user2@mail.ru', 'asdf', 0, 0),
	(28, 'zxcv', 'user2@mail.ru', 'xcv', 0, 0),
	(29, 'admin', 'user2@mail.ru', 'asdfро', 1, 1),
	(30, 'sdf', 'user2@mail.ru', 'sdf', 0, 0),
	(31, 'asdf', 'user2@mail.ru', 'df', 0, 0),
	(32, 'asdf', 'user2@mail.ru', 'df', 0, 0),
	(33, 'фыва', 'user2@mail.ru', 'фыва', 0, 0);
/*!40000 ALTER TABLE `test_task` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
