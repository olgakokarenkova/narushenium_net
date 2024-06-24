-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 07 2024 г., 21:47
-- Версия сервера: 10.5.17-MariaDB
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_demo_2021`
--

-- --------------------------------------------------------

--
-- Структура таблицы `applications`
--

CREATE TABLE `applications` (
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_to_image_before` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_to_image_after` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rejection_reason` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `applications`
--

INSERT INTO `applications` (`application_id`, `user_id`, `title`, `description`, `path_to_image_before`, `path_to_image_after`, `rejection_reason`, `created_at`, `status_id`, `category_id`) VALUES
(1, 1, 'Оспаривание', 'Решите нашу проблему', 'images/before/1619715495.jpg', NULL, 'Мы отказываемся решать вашу проблему', '2021-04-30 14:46:34', 1, 1),
(2, 3, 'Другая добавляемая заявка', 'Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба Текст рыба', 'images/before/1619792845.jpg', 'images/after/1619784305.jpg', NULL, '2021-04-30 17:30:22', 1, 1),
(3, 3, 'Заявка на тестирование счётчика', 'Рыба рыба рыба Рыба рыба рыба Рыба рыба рыба Рыба рыба рыба Рыба рыба рыба Рыба рыба рыба Рыба рыба рыба Рыба рыба рыба Рыба рыба рыба Рыба рыба рыба', 'images/before/1619793095.jpg', 'images/after/1619792862.jpg', NULL, '2021-04-30 18:44:42', 1, 1),
(4, 1, 'Заявка первого пользователя', 'Заявка для добавления заявок', 'images/before/1619798331.jpg', 'images/after/1619793041.jpg', NULL, '2021-05-03 09:15:04', 1, 1),
(5, 2, 'Заявка второго пользователя', 'Заявка второго пользователя', 'images/before/1620022504.jpg', 'images/after/1620022623.jpg', NULL, '2021-05-03 09:15:46', 1, 1),
(6, 3, 'Заявка третьего пользователя', 'Заявка третьего пользователя', 'images/before/1620022546.jpg', 'images/after/1620022631.jpg', NULL, '2021-05-03 09:16:41', 1, 1),
(7, 2, 'Ещё одна тестовая заявка второго пользователя', 'Свободу Анжеле Девис', 'images/before/1620279836.jpg', NULL, 'Тема закрыта', '2021-05-03 09:19:15', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`category_id`, `category`) VALUES
(1, 'Дворовые территории'),
(2, 'Дороги'),
(3, 'Природа, экология'),
(4, 'Строительство');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`status_id`, `status`) VALUES
(1, 'Решена'),
(2, 'Отклонена'),
(3, 'Заявка находится на рассмотрении');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fio` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `fio`, `login`, `email`, `password`, `token`, `role`) VALUES
(1, 'Александр', 'ewoase', '1@1', '1234', NULL, 'admin'),
(2, 'Пользователь', 'admin', '2@2', 'adminWSR', NULL, 'admin'),
(3, 'user1', 'userone', '3@3', '1234', NULL, 'user'),
(4, 'user2', 'usertwo', '4@4', '1234', NULL, 'user'),
(5, 'user3', 'userthree', '5@5', '1234', NULL, 'user'),
(7, 'Соколова', 'sokol', 'sokol@05.com', '1234', NULL, 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `applications`
--
ALTER TABLE `applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `applications_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
