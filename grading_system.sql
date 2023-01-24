-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 19 2023 г., 12:45
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
(8, 'Конкурс на дизайн проекта \"Квесты 2.0\"', 'Необходимо разработать дизайн проекта \"Квесты 2.0\". Дизайн должен быть красивым и стильным.', '2023-01-09 00:00:00', '2023-01-14 00:00:00', 1, 'public/images/1673279227casual-life-3d-desig.png'),
(9, 'Конкурс на верстку проекта \"Квесты 2.0\"', 'Необходимо сверстать страницы проекта \"Квесты 2.0\" по макету figma', '2023-01-16 00:00:00', '2023-01-21 00:00:00', 1, 'public/images/1673279399bb3153.jpg'),
(10, 'Конкурс на программирование проекта \"Квесты 2.0\"', 'Необходимо запрограммировать проект \"Квесты 2.0\"', '2023-01-23 00:00:00', '2023-01-29 00:00:00', 1, 'public/images/16732794576262e1508a0d5148237423.png');

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
(8, 'Понятный дизайн', 4, 8, 2),
(9, 'Наличие шапки', 1, 8, 1),
(10, 'Наличие лэндинга', 10, 8, 2),
(11, 'Наличие формы обратной связи', 6, 8, 1),
(12, 'Наличие футера', 4, 8, 2),
(13, 'Наличие шапки', 4, 9, 1),
(14, 'Наличие лэндинга', 10, 9, 2),
(15, 'Наличие формы обратной связи', 6, 9, 1),
(16, 'Наличие футера', 4, 9, 1),
(17, 'Программирование формы обратной связи (наличие ajax для отлично)', 12, 10, 2);

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
(1, 2, 8, 8, 3, 4, 4, '2023-01-09 17:41:16', '2023-01-09 17:41:16'),
(2, 2, 8, 9, 1, 4, 0, '2023-01-09 17:41:19', '2023-01-09 17:41:19'),
(3, 2, 8, 10, 4, 4, 5, '2023-01-09 17:41:21', '2023-01-09 17:41:21'),
(4, 2, 8, 11, 3, 4, 6, '2023-01-09 17:41:23', '2023-01-09 17:41:23'),
(5, 2, 9, 13, 3, 4, 4, '2023-01-09 17:47:27', '2023-01-09 17:47:27'),
(6, 2, 9, 14, 4, 4, 5, '2023-01-09 17:47:35', '2023-01-09 17:47:35'),
(7, 2, 9, 15, 1, 4, 0, '2023-01-09 17:55:55', '2023-01-09 17:55:55'),
(8, 2, 9, 16, 3, 4, 4, '2023-01-09 17:56:26', '2023-01-09 17:56:26'),
(9, 2, 8, 12, 3, 4, 4, '2023-01-19 09:41:40', '2023-01-19 09:41:40');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `patronymic` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `role` int NOT NULL,
  `pautina_id` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `surname`, `patronymic`, `role`, `pautina_id`) VALUES
(1, 'admin@mail.ru', '$2y$10$Cb5nOMfHbALm572hIk3u6e7AvipatFUgCxmRefTJT8ZGM2dkvFZo2', 'Админ', 'Админский', 'Админович', 3, 100),
(2, 'user@mail.ru', '$2y$10$48kPimOlPzmqNwImmmbgGOeNL2iNqYF59hsPb/Z/.3sBqUYHVfHSC', 'Пользователь', 'Пользовательский', 'Пользователь', 1, 20),
(3, 'test@mail.ru', '$2y$10$e2Q5ZNbYa9xQGC2qzliPBOiDFc5lkvm0GmvqTKkfdM1H66aEFtzYy', 'Тест', 'Тестовый', 'Тестович', 1, 25),
(4, 'expert@mail.ru', '$2y$10$BTIVF2ZoA0RcvOFMD9KKnOeOtp5GbEgnAmUYdf8GdDEEPDEhpCtCK', 'Эксперт', 'Экспретский', 'Экспертович', 2, 45),
(5, 'expert2@mail.ru', '$2y$10$.H0D9Wjz8lRq2B86Qlwt2ORDBaJkxZkePwf1yynXNuRxMXxlfm/2y', 'Expert', 'Expert', 'Expert', 2, 11),
(6, 'expert3@mail.ru', '$2y$10$vLxEM9RXNhmtVDZ8xTY2ze39EEXd7lwLa1DdKzVjbI421BxidKqba', 'expert3', 'expert3', 'expert3', 2, 25);

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
(58, 8, 2, 1),
(59, 8, 3, 1),
(60, 8, 4, 2),
(61, 8, 5, 2),
(62, 9, 4, 2),
(63, 9, 2, 1),
(64, 10, 4, 2);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users_competition`
--
ALTER TABLE `users_competition`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

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
