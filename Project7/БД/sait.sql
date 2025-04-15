-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 15 2025 г., 10:45
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sait`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `created_at`) VALUES
(2, 'Канеки', 'zxc@gmail.com', '89005532112', '$2y$10$ED3noZ0XhcrSZv9A5pU1ru9o7tDVC8SFRu.RViJZ0Mip6sXHksTcm', '2025-04-08 21:54:16'),
(3, 'аоаоаоаоаоа', 'qwqe@gmail.com', '331233312321312', '$2y$10$ElZT7.Eqc72fEMg2pZRlVe5z2I.G5qYzdLhI93qIcve0vh0yCtd4C', '2025-04-10 12:28:43'),
(4, 'qwe', 'qwe@gmail.com', '+7 (374) 431-23-21', '$2y$10$Hsi7E04U6iOo4gvXJ5KWnegqkJxz7sZ2f29LK5SLFTZUz90BT.dQq', '2025-04-10 12:34:12'),
(5, 'Владимир Шолохов', 'aimaimovic5@gmail.com', '+7 (899) 932-32-32', '$2y$10$cgLsUYbeuWh5EfUJIXqsBuHOTJTRHzJtQ7.YVi1oAuIV.i5bAvp2W', '2025-04-11 08:55:32'),
(6, 'qweqeqwew', 'fgh@gmail.com', '+7 (890) 055-35-35', '$2y$10$XUA9IdX8uU8FOVsnW7fxv.QN.zUup1jkJoFikpABaUP.ipt/GwF3e', '2025-04-13 19:54:41');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
