-- Adminer 4.8.0 MySQL 5.5.5-10.5.17-MariaDB-1:10.5.17+maria~ubu2004 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `questions` (`id`, `question`, `answer`) VALUES
(1,	'Question 1',	'A'),
(2,	'Question 2',	'B'),
(3,	'Question 3',	'D'),
(4,	'Question 4',	'D');

DROP TABLE IF EXISTS `results`;
CREATE TABLE `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `results_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `results_ibfk_4` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `results` (`id`, `user_id`, `question_id`, `answer`) VALUES
(1,	3,	1,	'A'),
(2,	3,	2,	'A'),
(3,	3,	3,	'B'),
(4,	3,	4,	'C'),
(5,	2,	1,	'A'),
(6,	2,	2,	'B'),
(7,	2,	3,	'B'),
(8,	2,	4,	'C');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1,	'John',	'john@gmail.com',	'$2y$10$93IMWJGeCPR.KDh7bJIbGOsIa5NUr1llrWGCsdhJqKlJuYgTu3dja',	'user',	'2023-06-08 09:40:26'),
(2,	'Jane',	'jane@gmail.com',	'$2y$10$thgHB81jD.crXeFANytoQ.EfD2XB3ZPZ1OqVMrDH32GERkPsmNYPG',	'user',	'2023-05-21 05:55:24'),
(3,	'Jack',	'jack@gmail.com',	'$2y$10$FrNYGeEY1GnHZxCJ6hgw2ePyFkahlEj69JIRFiS76pCpNlDAe94QS',	'admin',	'2023-05-21 05:57:07');

-- 2023-06-08 09:43:01
