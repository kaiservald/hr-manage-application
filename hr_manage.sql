-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 24 2020 г., 08:17
-- Версия сервера: 5.6.37
-- Версия PHP: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hr_manage`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1608542748),
('authUser', '4', 1608542748),
('authUser', '5', 1608547217),
('manager', '2', 1608542748),
('manager', '3', 1608542748);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1608542748, 1608542748),
('authUser', 1, NULL, NULL, NULL, 1608542748, 1608542748),
('createRequest', 2, 'Create a request', NULL, NULL, 1608542748, 1608542748),
('createVacation', 2, 'Create a vacation', NULL, NULL, 1608542748, 1608542748),
('deleteRequest', 2, 'Delete Request', NULL, NULL, 1608542748, 1608542748),
('deleteVacation', 2, 'Delete a vacation', NULL, NULL, 1608542748, 1608542748),
('manager', 1, NULL, NULL, NULL, 1608542748, 1608542748),
('updateOwnVacation', 2, 'Update own vacation', 'managerVacationRule', NULL, 1608544385, 1608544385),
('updateRequest', 2, 'Update Request', NULL, NULL, 1608542748, 1608542748),
('updateRequestOwnVacation', 2, 'Update request for own vacation', 'managerRequestRule', NULL, 1608544428, 1608544428),
('updateVacation', 2, 'Update vacation', NULL, NULL, 1608542748, 1608542748);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('manager', 'authUser'),
('authUser', 'createRequest'),
('manager', 'createVacation'),
('admin', 'deleteRequest'),
('admin', 'deleteVacation'),
('admin', 'manager'),
('manager', 'updateOwnVacation'),
('admin', 'updateRequest'),
('updateRequestOwnVacation', 'updateRequest'),
('manager', 'updateRequestOwnVacation'),
('admin', 'updateVacation'),
('updateOwnVacation', 'updateVacation');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('managerRequestRule', 0x4f3a33303a22636f6d6d6f6e5c726261635c4d616e616765725265717565737452756c65223a333a7b733a343a226e616d65223b733a31383a226d616e616765725265717565737452756c65223b733a393a22637265617465644174223b693a313630383534343432383b733a393a22757064617465644174223b693a313630383534343432383b7d, 1608544428, 1608544428),
('managerVacationRule', 0x4f3a33313a22636f6d6d6f6e5c726261635c4d616e616765725661636174696f6e52756c65223a333a7b733a343a226e616d65223b733a31393a226d616e616765725661636174696f6e52756c65223b733a393a22637265617465644174223b693a313630383534343338353b733a393a22757064617465644174223b693a313630383534343338353b7d, 1608544385, 1608544385);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1608542232),
('m130524_201442_init', 1608542234),
('m140506_102106_rbac_init', 1608542404),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1608542404),
('m180523_151638_rbac_updates_indexes_without_prefix', 1608542404),
('m190124_110200_add_verification_token_column_to_user_table', 1608542235),
('m200409_110543_rbac_update_mssql_trigger', 1608542404);

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `vacancy_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `resume` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `request`
--

INSERT INTO `request` (`request_id`, `first_name`, `last_name`, `email`, `vacancy_id`, `created_by`, `created_at`, `status`, `resume`) VALUES
(1, 'John', 'Black', 'john@gmail.com', 3, 2, '2020-12-24 05:24:19', 1, ''),
(2, 'John', 'Black', 'john@gmail.com', 5, 2, '2020-12-24 07:21:00', 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`status_id`, `status_name`, `type`) VALUES
(1, 'активний', 1),
(2, 'не активний', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'Jane', 'SzxUww95ewuECLCTuQRuyJaMD4TeDbaQ', '$2y$13$8OpuOqMMUFXU6Vd08lHPYeVZEVF706g6.2mj8ANScGHTvklf5P.ZW', NULL, 'jane@gmail.com', 10, 1608542639, 1608542639, 'MaTMIb3v1de3k6spTCSORUpstqe27uq5_1608542639'),
(2, 'John', 'hJIZ4bbPPS7PIp6k4RJ9rcEK6Q3Wud0V', '$2y$13$utW/AjHpBxgJZtoWRM3H8OVHvsxrOyo1Z/T3GFxbZlpnLo12NeKem', NULL, 'john@gmail.com', 10, 1608542664, 1608542664, 'JW-j2bjTsQxT6MaSTSAyOlVujZ5kJyJt_1608542664'),
(3, 'Alex', 'gY0rJr580--4Ho0nuxawnuzdKWqLp03n', '$2y$13$sd6VS5pWmUzfULB7NikLKehU3yWVOMh/1lIdRytF4bDcWNDOIDRe.', NULL, 'alex@gmail.com', 10, 1608542682, 1608542682, 'CmOhcMkN3OSZVxugVet_8_fSD8ndlLFo_1608542682'),
(4, 'Peter', 'Xzc8D66OlRoNJa67zjsEGhWyKpAS7KIi', '$2y$13$h5J2VqoEAa3vr4FZtV8KMOoShW.9ub1aSQRIxIdmiK9Le2uK12lO6', NULL, 'peter@gmail.com', 10, 1608542721, 1608542721, 'n31Yfj7ByP-2kN6BA7m6fpVmxvtFeSPb_1608542721'),
(5, 'Michael', '61nl2IgzZyMvhoJm0C1nv8AJRrMfQ_Wi', '$2y$13$4L6M8yHgcOjNeg6G0No/rOOkmXRRDbyx9eAJxOMehZdPaxhTX939a', NULL, 'michael@gmail.com', 10, 1608547217, 1608547217, 'ZCMaOiXF8Jlcer0RxcvluichTESKF1FV_1608547217');

-- --------------------------------------------------------

--
-- Структура таблицы `vacancy`
--

CREATE TABLE `vacancy` (
  `vacancy_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vacancy`
--

INSERT INTO `vacancy` (`vacancy_id`, `title`, `description`, `status_id`, `created_by`, `created_at`) VALUES
(1, 'Шукаємо баристу, офіціанта', 'Шукаємо баристу з досвідом та без до нас у кафе-пекарю \"Віденські булочки \" по вул. Пушкінська 1-3/5. Метро Хрещатик або Театральна.\r\n30 грн./год.+ чайові + % від чеку замовлення.\r\nГрафік роботи закладу з 7:30 - 19:00 Графік оговорюється. Для студентів підбираємо зміни .\r\nПобажання до кандидатів:\r\nприємний зовнішній вигляд, товариськість, грамотність, дівчата та хлопці віком від 18 років.', 1, 1, '2020-12-22 10:06:07'),
(2, 'Працівник залу, офіціант 9 500 – 11 500 грн', 'Привіт! Ми хочемо, щоб Ти був впевнений у нас та в роботі, яку ти отримаєш.\r\n\r\nПрочитай, будь ласка, уважно цю вакансію, і якщо Ти впізнаєш себе — не соромся відгукнутись!\r\n\r\nПРАЦІВНИК ЗАЛУ ШВИДКО ВИНОСИТЬ ЗАМОВЛЕННЯ, ВМІЄ НАВОДИТИ ІДЕАЛЬНУ ЧИСТОТУ ТА ПОРЯДОК У ЗАКЛАДІ, І ДОПОМАГАЄ КОЛЕГАМ З НАПОЯМИ', 1, 1, '2020-12-23 08:48:45'),
(3, 'Офіціант у готельно-ресторанний комплекс', 'На роботу запрошується офіціант у готельно-ресторанний комплекс.\r\nВимоги: активність, порядність, відповідальність.\r\nОбов’язки: сервірування столу, зустріч відвідувачів, пробивання чеків та розрахунок.\r\nГрафік роботи: змінний.\r\nБільш детальна інформація за тел. 067-588-42-82, 093-240-18-47.\r\nПрохання дзвонити з 10.00 до 17.00, крім вихідних.', 1, 2, '2020-12-23 06:26:48'),
(5, 'Офіціант-бармен в кафе', 'В кафе в Центрі міста потрібен офіціант.\r\nВимоги: жінка 25-40 років, обов`язково досвід роботи офіціантом.\r\nГрафік роботи: з 10.30 до 23.00, підвіз та харчування за рахунок роботодавця. 3/3 або 5/5 (за домовленістю, можливі й інші варянти робочих днів).\r\nЗ/п 350 грн/день+чайові.', 1, 2, '2020-12-24 06:18:21');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `status` (`status`),
  ADD KEY `vacancy_id` (`vacancy_id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `type` (`type`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Индексы таблицы `vacancy`
--
ALTER TABLE `vacancy`
  ADD PRIMARY KEY (`vacancy_id`),
  ADD KEY `status` (`status_id`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `vacancy`
--
ALTER TABLE `vacancy`
  MODIFY `vacancy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`vacancy_id`) REFERENCES `vacancy` (`vacancy_id`);

--
-- Ограничения внешнего ключа таблицы `vacancy`
--
ALTER TABLE `vacancy`
  ADD CONSTRAINT `vacancy_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
