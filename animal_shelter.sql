-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Czas generowania: 01 Paź 2020, 20:49
-- Wersja serwera: 5.7.24
-- Wersja PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `animal_shelter`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `animal`
--

DROP TABLE IF EXISTS `animal`;
CREATE TABLE IF NOT EXISTS `animal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color_id` int(11) NOT NULL,
  `breed_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admission_date` datetime NOT NULL,
  `year_of_birth` int(11) NOT NULL,
  `weigth` double NOT NULL,
  `height` double NOT NULL,
  `length` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6AAB231F7ADA1FB5` (`color_id`),
  KEY `IDX_6AAB231FA8B4A30F` (`breed_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `animal`
--

INSERT INTO `animal` (`id`, `color_id`, `breed_id`, `name`, `admission_date`, `year_of_birth`, `weigth`, `height`, `length`) VALUES
(7, 2, 3, 'Reks', '2015-01-01 00:00:00', 2000, 20, 30, 50),
(8, 5, 4, 'Filemon', '2015-01-01 00:00:00', 2005, 13, 30, 75),
(9, 6, 10, 'Zosia', '2011-02-28 00:00:00', 2012, 10, 25, 40);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `breed`
--

DROP TABLE IF EXISTS `breed`;
CREATE TABLE IF NOT EXISTS `breed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `breed`
--

INSERT INTO `breed` (`id`, `name`) VALUES
(3, 'pudel'),
(4, 'mieszaniec (kot)'),
(5, 'doberman'),
(6, 'border collie'),
(7, 'owczarek niemiecki'),
(8, 'jamnik'),
(9, 'mieszaniec (pies)'),
(10, 'królik');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `color`
--

DROP TABLE IF EXISTS `color`;
CREATE TABLE IF NOT EXISTS `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `color`
--

INSERT INTO `color` (`id`, `name`, `value`) VALUES
(2, 'biały', 16581375),
(3, 'czarny', 0),
(4, 'szary', 0),
(5, 'brązowy', 0),
(6, 'rudy', 0),
(9, 'żółty', 0),
(10, 'pomarańczowy', 0),
(11, 'czerwony', 0),
(12, 'zielony', 0),
(13, 'niebieski', 0),
(14, 'fioletowy', 0),
(15, 'różowy', 0),
(16, 'granatowy', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20200929143825', '2020-09-29 14:40:28', 3911),
('DoctrineMigrations\\Version20200930114801', '2020-09-30 11:48:18', 617);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(5, 'admin1@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$UThEMktJVnBEMlgxMEFCLg$TTCLER3DxvJd9SV2aYHUkkRIjBezWp/KoHIt+M5v4GM'),
(6, 'admin2@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$ZmFsNjlzZFpUcldCeUxCWQ$00e0fNJF2lU5p3FKQrL/PfxabhVXEdoYiAqNkuphsOs');

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `FK_6AAB231F7ADA1FB5` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`),
  ADD CONSTRAINT `FK_6AAB231FA8B4A30F` FOREIGN KEY (`breed_id`) REFERENCES `breed` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
