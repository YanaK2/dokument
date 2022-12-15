-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 15 2022 г., 23:11
-- Версия сервера: 10.6.5-MariaDB-1:10.6.5+maria~focal
-- Версия PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `649-19_docs`
--

-- --------------------------------------------------------

--
-- Структура таблицы `doc`
--

CREATE TABLE `doc` (
  `ID_doc` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `Category` enum('Заявление','Доверенность','Выписка') NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Тут будут пути к файлам документов';

--
-- Дамп данных таблицы `doc`
--

INSERT INTO `doc` (`ID_doc`, `ID_user`, `Category`, `name`) VALUES
(18, 1, 'Доверенность', 'ывапро');

-- --------------------------------------------------------

--
-- Структура таблицы `pattern`
--

CREATE TABLE `pattern` (
  `ID_pattern` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `Category` enum('Заявление','Доверенность','Выписка') NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Тут будут пути к файлам шаблонов';

--
-- Дамп данных таблицы `pattern`
--

INSERT INTO `pattern` (`ID_pattern`, `ID_user`, `Category`, `name`) VALUES
(5, 9, 'Заявление', '14f0f9fc53b3b961c367aa442045635c4342ffe3c2a827f4290c8b2f5431319f.doc'),
(7, 10, 'Заявление', '14f0f9fc53b3b961c367aa442045635c4342ffe3c2a827f4290c8b2f5431319f.doc'),
(12, 11, 'Заявление', '14f0f9fc53b3b961c367aa442045635c4342ffe3c2a827f4290c8b2f5431319f.doc');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `ID_user` int(11) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Post` enum('Нотариус','Помощник нотариуса','бухгалтер') NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Root` enum('Администратор','Не администратор') NOT NULL,
  `token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='таблица пользователей';

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`ID_user`, `Firstname`, `Lastname`, `Post`, `Password`, `Root`, `token`) VALUES
(1, 'Иван', 'Иванов', 'Помощник нотариуса', '123not', 'Не администратор', '1234yiopouytewq123432'),
(2, 'Федор', 'Федоров', 'Нотариус', 'sididoma1423', 'Администратор', 'dsw4wfcgftf7rfg3rg3f2'),
(3, 'Николай', 'Николаев', 'бухгалтер', 'fghj0198))', 'Не администратор', '2edf34rtyhju67uiolpo9op'),
(4, 'Лариса', 'Ларисова', 'Помощник нотариуса', 'asdfghjkl53', 'Не администратор', '9ijhbhyu7ytfdr4esw2qwsdfg'),
(5, 'Иван', 'Иванов', 'Помощник нотариуса', '$2y$13$XDbBYHltHGmrBI6u9lPD8.VFvA9QycAH.Bk2k.hWgn5ToLqo0zBVu', 'Администратор', 'H9AF5Fp52WRJQqZEVIs8oGKc0wvU8EFP'),
(6, 'Иван', 'Иванов', 'Помощник нотариуса', '$2y$13$w6Nw2D4eRRzu33XOpqG62.U6rBrovN5BdiQxm/pPKm6/nV1DhM6JS', 'Администратор', 'sdasad'),
(7, 'Иван', 'Иванов', 'Помощник нотариуса', '$2y$13$usc1GWaDDgvfuBgisCfYx.wBEwQ6OaajlETV.xcMp/Amkmc8/yMZC', 'Администратор', 'sdasad'),
(8, 'Тест', 'Тест', 'Помощник нотариуса', 'wow', 'Не администратор', NULL),
(9, 'Юлий', 'Блин', 'Помощник нотариуса', '$2y$13$GYj9QSlqpEiTzIqFvuZqXunoK8GSnZB2HY1LSMGpdOIS8NquKw4W6', 'Администратор', 'uiFO_3AlxOJQyCJvWJ4i6GI4AatUIqCv'),
(10, 'Анна', 'Шутова', 'Помощник нотариуса', 'Pass', 'Администратор', 'Jw14EJNdZIEEvTXG45oSNQ4ZhG8T5hk6'),
(11, 'Крендель', 'Иванов', 'Нотариус', '$2y$13$nt/XdrtjcZ5Jyd4jx8G/9.vcLeJWzdbAwpTFU0MCP.nDmzNY/cvOy', 'Администратор', 'jIJquoqVrnGM_NBJNfOXqwDFsFQjEsth');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `doc`
--
ALTER TABLE `doc`
  ADD PRIMARY KEY (`ID_doc`),
  ADD UNIQUE KEY `ID_user` (`ID_user`);

--
-- Индексы таблицы `pattern`
--
ALTER TABLE `pattern`
  ADD PRIMARY KEY (`ID_pattern`),
  ADD UNIQUE KEY `ID_user` (`ID_user`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `doc`
--
ALTER TABLE `doc`
  MODIFY `ID_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `pattern`
--
ALTER TABLE `pattern`
  MODIFY `ID_pattern` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `ID_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `doc`
--
ALTER TABLE `doc`
  ADD CONSTRAINT `doc_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `user` (`ID_user`);

--
-- Ограничения внешнего ключа таблицы `pattern`
--
ALTER TABLE `pattern`
  ADD CONSTRAINT `pattern_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `user` (`ID_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
