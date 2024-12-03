-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 10:59 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `content` text NOT NULL,
  `adddate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `author`, `content`, `adddate`) VALUES
(1, 1, 'helllo', '2024-11-29 06:28:11'),
(2, 1, '1', '2024-11-29 06:28:19'),
(3, 1, '2', '2024-11-29 06:28:21'),
(4, 1, '2', '2024-11-29 06:28:21'),
(5, 1, '2', '2024-11-29 06:28:21'),
(6, 1, '', '2024-11-29 06:28:21'),
(7, 1, '3', '2024-11-29 06:28:22'),
(8, 1, '4', '2024-11-29 06:28:23'),
(9, 1, '', '2024-11-29 06:28:23'),
(10, 1, '', '2024-11-29 06:28:24'),
(11, 1, '', '2024-11-29 06:28:24'),
(12, 1, '', '2024-11-29 06:28:25'),
(13, 1, '5', '2024-11-29 06:28:26'),
(14, 1, 'dupa', '2024-11-29 06:29:04'),
(15, 1, '1', '2024-11-29 06:29:05'),
(16, 1, '2', '2024-11-29 06:29:05'),
(17, 1, '34', '2024-11-29 06:29:06'),
(18, 1, '3124', '2024-11-29 06:29:07'),
(19, 1, '2137', '2024-11-29 06:29:10'),
(20, 1, 'elo żelo', '2024-11-29 06:29:14');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `ID` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `autor` int(11) NOT NULL,
  `date` date NOT NULL,
  `added` datetime NOT NULL DEFAULT current_timestamp(),
  `private` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `title`, `content`, `autor`, `date`, `added`, `private`) VALUES
(4, 'sprawdzam uniqid', 'D:\\xampp\\htdocs\\cms/usersposts/1/67458873108fd.md', 1, '2024-11-27', '2024-11-26 09:36:03', 0),
(5, 'test posta', 'D:\\xampp\\htdocs\\cms/usersposts/1/674ed1f96a994.md', 1, '2024-12-03', '2024-12-03 10:40:09', 0),
(6, 'nie ma mnie', 'D:\\xampp\\htdocs\\cms/usersposts/1/674ed21f463df.md', 1, '2024-12-02', '2024-12-03 10:40:47', 1),
(7, 'ufjgh', 'D:\\xampp\\htdocs\\cms/usersposts/1/674ed642d5e6d.md', 1, '2024-12-03', '2024-12-03 10:58:26', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` int(10) UNSIGNED NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  `added` datetime NOT NULL DEFAULT current_timestamp(),
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `email`, `password`, `active`, `added`, `is_admin`) VALUES
(1, 'admin', 'admin@mail.com', 'e5e9fa1ba31ecd1ae84f75caaa474f3a663f05f4', 1, '2024-11-11 17:06:33', 1),
(2, 'rafal', 'rafal@mail.com', 'e5e9fa1ba31ecd1ae84f75caaa474f3a663f05f4', 1, '2024-11-13 15:28:40', 0),
(3, 'david', 'david@mail.com', 'e5e9fa1ba31ecd1ae84f75caaa474f3a663f05f4', 0, '2024-11-13 16:20:20', 0),
(6, 'kamil', 'kamil@mail.com', '1561482c1292222496d39bb43eb61619184a51c9', 1, '2024-11-22 09:23:44', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
