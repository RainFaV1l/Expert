-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 23 2023 г., 12:43
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `grading_system`
--
CREATE DATABASE IF NOT EXISTS `grading_system` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci;
USE `grading_system`;

-- --------------------------------------------------------

--
-- Структура таблицы `answer`
--

CREATE TABLE `answer` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `answer`
--

INSERT INTO `answer` (`id`, `name`) VALUES
(1, 'Да'),
(2, 'Нет'),
(3, 'Отлично'),
(4, 'Хорошо'),
(5, 'Плохо');

-- --------------------------------------------------------

--
-- Структура таблицы `competition`
--

CREATE TABLE `competition` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_beginning` datetime NOT NULL,
  `expiration_date` datetime NOT NULL,
  `status` int DEFAULT '1',
  `path` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `competition`
--

INSERT INTO `competition` (`id`, `name`, `description`, `date_beginning`, `expiration_date`, `status`, `path`) VALUES
(1, 'Конкурс на лучший дизайн главной страницы клуба Паутины', 'Разработать дизайн главной страницы клуба паутины.', '2023-02-06 00:00:00', '2023-02-12 00:00:00', 1, 'public/images/1676366093WDfgh45v6bn.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `competition_status`
--

CREATE TABLE `competition_status` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `competition_status`
--

INSERT INTO `competition_status` (`id`, `name`) VALUES
(0, 'Отмененный'),
(1, 'Активный'),
(2, 'Завершенный');

-- --------------------------------------------------------

--
-- Структура таблицы `criterion_type`
--

CREATE TABLE `criterion_type` (
  `id` int NOT NULL,
  `name` varchar(250) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `criterion_type`
--

INSERT INTO `criterion_type` (`id`, `name`) VALUES
(1, 'Да, нет'),
(2, 'Отлично, хорошо, плохо');

-- --------------------------------------------------------

--
-- Структура таблицы `evaluation_criterion`
--

CREATE TABLE `evaluation_criterion` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `score` float NOT NULL,
  `competition_id` int NOT NULL,
  `type_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `evaluation_criterion`
--

INSERT INTO `evaluation_criterion` (`id`, `name`, `score`, `competition_id`, `type_id`) VALUES
(1, 'объем работы соответствует заданию', 3, 1, 2),
(2, 'используются простые и понятные заголовки', 3, 1, 2),
(3, 'реализован дизайн шапки', 1.5, 1, 1),
(4, 'качество реализации дизайна шапки', 1.5, 1, 2),
(5, 'реализован «Баннер с призывом вступить в клуб»', 3, 1, 1),
(6, 'качество реализации «Баннер с призывом вступить в клуб»', 3, 1, 2),
(7, 'реализован блок «Направления деятельности клуба»', 3, 1, 1),
(8, 'качество реализации блока «Направления деятельности клуба»', 3, 1, 2),
(9, 'реализован блок «Проекты»', 3, 1, 1),
(10, 'качество реализации блока «Проекты»', 3, 1, 2),
(11, 'реализован блок «Конкурсы»', 3, 1, 1),
(12, 'качество реализации блока «Конкурсы»', 3, 1, 2),
(13, 'реализован блок «Участники клуба»', 3, 1, 1),
(14, 'качество реализации блока «Участники клуба»', 3, 1, 2),
(15, 'реализован блок «Эксперты клуба»', 3, 1, 1),
(16, 'качество реализации блока «Эксперты клуба»', 3, 1, 2),
(17, 'реализован блок «Компетенции клуба»', 3, 1, 1),
(18, 'качество реализации блока «Компетенции клуба»', 3, 1, 2),
(19, 'реализован блок «Планы клуба»', 3, 1, 1),
(20, 'качество реализации блока «Планы клуба»', 3, 1, 2),
(21, 'реализован «Блок с призывом вступить в клуб»', 2, 1, 1),
(22, 'качество реализации «Блок с призывом вступить в клуб»', 2, 1, 2),
(23, 'реализован дизайн подвала', 1.5, 1, 1),
(24, 'качество реализации дизайн подвала', 1.5, 1, 2),
(25, 'используется преимущественно черные и белые цвета (допускается использование акцентных цветов)', 2, 1, 1),
(26, 'реализован адаптив страниц', 3, 1, 1),
(27, 'качество реализации адаптива страниц', 3, 1, 2),
(28, 'Общие впечатления от дизайна', 6, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `grade`
--

CREATE TABLE `grade` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `competition_id` int NOT NULL,
  `evaluation_criterion_id` int NOT NULL,
  `answer_id` int NOT NULL,
  `expert_id` int NOT NULL,
  `score` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `grade`
--

INSERT INTO `grade` (`id`, `user_id`, `competition_id`, `evaluation_criterion_id`, `answer_id`, `expert_id`, `score`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, 3, 2, 3, '2023-02-14 19:11:32', '2023-02-14 19:11:32'),
(2, 6, 1, 2, 4, 2, 1.5, '2023-02-14 19:11:35', '2023-02-14 19:11:35'),
(3, 6, 1, 4, 3, 2, 0, '2023-02-14 19:11:38', '2023-02-14 19:11:38'),
(4, 6, 1, 3, 3, 2, 1.5, '2023-02-14 19:11:41', '2023-02-14 19:11:41'),
(5, 5, 1, 1, 3, 4, 3, '2023-02-14 19:13:44', '2023-02-14 19:13:44'),
(6, 5, 1, 2, 4, 4, 1.5, '2023-02-14 19:13:47', '2023-02-14 19:13:47'),
(7, 5, 1, 3, 3, 4, 1.5, '2023-02-14 19:13:50', '2023-02-14 19:13:50'),
(8, 5, 1, 5, 1, 4, 0, '2023-02-14 19:13:52', '2023-02-14 19:13:52'),
(9, 6, 1, 5, 1, 2, 0, '2023-02-14 19:16:07', '2023-02-14 19:16:07'),
(10, 6, 1, 6, 3, 2, 3, '2023-02-14 19:16:13', '2023-02-14 19:16:13'),
(11, 6, 1, 7, 3, 2, 3, '2023-02-17 21:32:46', '2023-02-17 21:32:46'),
(12, 6, 1, 8, 3, 2, 3, '2023-02-17 21:32:53', '2023-02-17 21:32:53');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `patronymic` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `role` int NOT NULL,
  `pautina_id` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `surname`, `patronymic`, `role`, `pautina_id`) VALUES
(1, 'admin@example.com', '$2y$10$aDvHCdoOt9hhEFY2r68mHupRLO0aDFAszvEIbOEfkNb90oUEc.nSq', 'Админ', 'Админ', 'Админ', 3, 0),
(2, 'expert1@example.com', '$2y$10$i9cg4eTOEvIIhLlGuR/ANOQz.QLzZtxZuxu1LjMV7UwbcEpLhZA4S', 'Expert1', 'Expert1', NULL, 2, 0),
(3, 'expert2@example.com', '$2y$10$yaBX7gJSr4dkHovwQnUEuOpGXgG4whK.ba9gpBsLuMs.MWIZDa70u', 'Expert2', 'Expert2', NULL, 2, 0),
(4, 'expert3@example.com', '$2y$10$AJg70AAxEhOoer1yVZtupu9wayV66rF9fPUFa4YCMbgYJhh55Ng2a', 'Expert3', 'Expert3', NULL, 2, 0),
(5, 'test@mail.ru', '$2y$10$miMmxmK58kVsV4VyCpWAwOBcgf09CJwgHYpNY58Kccx3kpOiyb.p2', 'test', 'test', 'test', 1, 0),
(6, 'test2', 'test2', 'test2', 'test2', 'test2', 1, 0),
(7, 'test3', 'test3', 'test3', 'test3', 'test3', 1, 0),
(8, 'test4', 'test4', 'test3', 'test4', 'test4', 1, 0),
(9, 'test4', 'test4', 'test4', 'test4', 'test4', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users_competition`
--

CREATE TABLE `users_competition` (
  `id` int NOT NULL,
  `competition_id` int NOT NULL,
  `user_id` int NOT NULL,
  `user_role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `users_competition`
--

INSERT INTO `users_competition` (`id`, `competition_id`, `user_id`, `user_role`) VALUES
(1, 1, 2, 2),
(2, 1, 3, 2),
(3, 1, 4, 2),
(6, 1, 6, 1),
(7, 1, 5, 1),
(8, 1, 7, 1),
(9, 1, 8, 1),
(10, 1, 9, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE `user_role` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(1, 'Участник'),
(2, 'Эксперт'),
(3, 'Администратор');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `competition`
--
ALTER TABLE `competition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Индексы таблицы `competition_status`
--
ALTER TABLE `competition_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `criterion_type`
--
ALTER TABLE `criterion_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `evaluation_criterion`
--
ALTER TABLE `evaluation_criterion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type_id`),
  ADD KEY `competition_id` (`competition_id`);

--
-- Индексы таблицы `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `answer_id` (`answer_id`),
  ADD KEY `competition_id` (`competition_id`),
  ADD KEY `evaluation_criterion_id` (`evaluation_criterion_id`),
  ADD KEY `expert_id` (`expert_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- Индексы таблицы `users_competition`
--
ALTER TABLE `users_competition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`user_role`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `competition_id` (`competition_id`);

--
-- Индексы таблицы `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `competition`
--
ALTER TABLE `competition`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `competition_status`
--
ALTER TABLE `competition_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `criterion_type`
--
ALTER TABLE `criterion_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `evaluation_criterion`
--
ALTER TABLE `evaluation_criterion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users_competition`
--
ALTER TABLE `users_competition`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `competition`
--
ALTER TABLE `competition`
  ADD CONSTRAINT `competition_ibfk_1` FOREIGN KEY (`status`) REFERENCES `competition_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `evaluation_criterion`
--
ALTER TABLE `evaluation_criterion`
  ADD CONSTRAINT `evaluation_criterion_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `criterion_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluation_criterion_ibfk_3` FOREIGN KEY (`competition_id`) REFERENCES `competition` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `grade_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grade_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grade_ibfk_3` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grade_ibfk_4` FOREIGN KEY (`competition_id`) REFERENCES `competition` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grade_ibfk_5` FOREIGN KEY (`evaluation_criterion_id`) REFERENCES `evaluation_criterion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grade_ibfk_6` FOREIGN KEY (`expert_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users_competition`
--
ALTER TABLE `users_competition`
  ADD CONSTRAINT `users_competition_ibfk_1` FOREIGN KEY (`user_role`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_competition_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_competition_ibfk_3` FOREIGN KEY (`competition_id`) REFERENCES `competition` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
