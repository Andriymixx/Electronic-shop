-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Гру 17 2022 р., 16:03
-- Версія сервера: 10.4.25-MariaDB
-- Версія PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `electronic_shop`
--

-- --------------------------------------------------------

--
-- Структура таблиці `customer`
--

CREATE TABLE `customer` (
  `cr_id` bigint(20) UNSIGNED NOT NULL,
  `cr_name` varchar(50) NOT NULL,
  `phone` int(11) UNSIGNED NOT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `customer`
--

INSERT INTO `customer` (`cr_id`, `cr_name`, `phone`, `email`) VALUES
(4, 'Sara Ola&#39;Moore', 98234954, 'look4at@mymailcr.com'),
(5, 'Anna Clarks', 2367436274, 'qweepcrkj4at@mymailcr.com'),
(6, 'Stacie O&#39;Moore', 4294967295, '1elfina0@hotmail.com'),
(8, 'Bethaney Simpson', 314845026, 'leola6@gmail.com'),
(9, 'Ciaran Raymond', 524424213, 'hope.rath58@yahoo.com'),
(10, 'Jensen Mayo', 810386466, 'olen.king@yahoo.com'),
(11, 'Bruno cartil', 4294967295, 'bazileo.sipes45@hotmail.com'),
(12, 'Abraham Greenwood', 605814644, 'kyle35@hotmail.com'),
(13, 'Kenzie Keech', 279079693, 'camryn.sanford@yahoo.com'),
(14, 'Maariyah Pollard', 123612473, 'marisol.hudson@yahoo.com'),
(15, 'Findlay Ayala', 425627898, 'elmo.pfannerstill54@yahoo.com'),
(16, 'Burhan Giles', 464579275, 'miles25@gmail.com'),
(17, 'Sullivan Rangel', 723689894, 'maxwell_baumbach@gmail.com'),
(18, 'Jon-Paul Proctor', 925668832, 'don96@gmail.com'),
(19, 'Nathalie Maynard', 746519814, 'maybelle79@yahoo.com'),
(20, 'Arvi Santos', 585461585, 'marge33@hotmail.com'),
(21, 'Micayla Mccaffrey', 148869719, 'trisha.larkin@gmail.com'),
(22, 'Jace Gross', 449081764, 'nedra15@yahoo.com'),
(23, 'Cara Fowler', 312276416, 'mamert95@hotmail.fr'),
(24, 'Maxime Shaw', 587920093, 'pascale10@yahoo.fr'),
(25, 'Maria Luisa', 134407075, 'marialuisa62@corpfolder.com'),
(26, 'Milla Wall', 390410937, 'owen96@yahoo.com'),
(27, 'King Hancock', 440312171, 'sebastian_kohler0@gmail.com'),
(28, 'Reem York', 263965496, 'linde.michiels@skynet.be'),
(29, 'Tomas Figueroa', 377205549, 'jayden.maes7@yahoo.com'),
(30, 'Alana Esparza', 731825284, 'ella25@yahoo.com'),
(31, 'Rudy Cole', 62342555, 'sid3387@yahoo.com'),
(32, 'Rudy Cole', 62342555, 'sid3387@yahoo.com'),
(33, 'Rudy Cole', 62342555, 'sid3387@yahoo.com'),
(34, 'Rudy asd', 235522352, 'coolMan1998@gmail.com'),
(36, 'Rudy asd', 235522352, 'coolMan1998@gmail.com'),
(37, 'Rudy asd', 235522352, 'coolMan1998@gmail.com'),
(38, 'Rudy Cole2', 235525, 'coolMan1998@gmail.com'),
(41, 'Tara Jenkins', 429496729, 'naughty.girl22@gmail.com'),
(42, 'Anna Matew', 975485444, 'amazingkiss@yahoo.com'),
(43, 'Rudy Cole', 73562356, 'coolMan1998@gmail.com'),
(44, 'Rudy asd', 123313, '12444');

-- --------------------------------------------------------

--
-- Структура таблиці `goods`
--

CREATE TABLE `goods` (
  `gs_id` bigint(20) UNSIGNED NOT NULL,
  `gs_name` varchar(50) NOT NULL,
  `mn_name` varchar(50) NOT NULL,
  `gs_price` double UNSIGNED NOT NULL,
  `gs_quantity` int(9) UNSIGNED NOT NULL,
  `warehouse_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `goods`
--

INSERT INTO `goods` (`gs_id`, `gs_name`, `mn_name`, `gs_price`, `gs_quantity`, `warehouse_id`) VALUES
(1, 'Bloody v4', 'A4Tech', 23.5, 9742, 13),
(2, 'Ryzen 5 3600x', 'Advanced Micro Devices', 140, 5678, 3),
(3, 'Ryzen 9 7950', 'Advanced Micro Devices', 760, 3456, 3),
(4, 'Ryzen 5 5800x3d', 'Advanced Micro Devices', 380, 4852, 4),
(5, 'Iphone 13 ', 'Apple', 1200, 1917, 5),
(6, 'Watch Ultra', 'Apple', 1100, 8253, 5),
(7, 'Strix RTX 3070', 'Asus', 780, 8526, 6),
(8, 'Proton BDF-600S', 'Chieftec', 58.8, 7413, 4),
(9, 'Ballistix U4', 'Crucial', 80.2, 5732, 8),
(11, 'ssd A400 480gb', 'Kingston', 150, 12475, 9),
(12, 'Legion 5 15ARH05H', 'Lenovo', 1100, 493, 8),
(13, 'Ideapad 5 15ALH05C', 'Lenovo', 890, 863, 10),
(14, 'G7', 'LG', 560, 14, 10),
(15, 'G305', 'Logitech', 44.9, 7355, 13),
(16, 'B450 A-PRO Max', 'Micro Star International', 160, 8353, 12),
(17, 'VENTUS GTX1660 Super', 'Micro Star International', 280, 9853, 12),
(18, 'Blade v6', 'Philips', 220, 453, 11),
(19, 'Galaxy S11Ultra', 'Samsung', 1300, 1872, 15),
(20, 'P2 1000Gb', 'Crucial', 112, 3422, 16),
(21, 'Dual RTX3050', 'Asus', 278, 8933, 14),
(23, 'MackBook Air 15', 'Apple', 1500, 345, 20),
(24, 'G102', 'Logitech', 33.4, 6233, 19),
(25, 'Bloody V4', 'A4Tech', 32.2, 7256, 18),
(33, 'Fury X DDDR4 3200mhz', 'Kingston', 120, 3123, 17),
(34, 'X570 TUF Gaming', 'Asus', 288, 1523, 16),
(35, 'G903', 'Logitech', 340, 822, 18),
(37, 'Optix G241C', 'Micro Star International', 240, 654, 19);

-- --------------------------------------------------------

--
-- Структура таблиці `info_order`
--

CREATE TABLE `info_order` (
  `or_id` bigint(20) UNSIGNED NOT NULL,
  `cr_id` bigint(20) UNSIGNED NOT NULL,
  `gs_id` bigint(20) UNSIGNED NOT NULL,
  `date_of_order` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `info_order`
--

INSERT INTO `info_order` (`or_id`, `cr_id`, `gs_id`, `date_of_order`) VALUES
(11, 11, 14, '2022-09-03'),
(14, 11, 17, '2022-10-25'),
(15, 20, 20, '2022-10-26'),
(17, 29, 18, '2022-10-27'),
(18, 30, 33, '2022-10-30'),
(19, 28, 4, '2022-10-31'),
(21, 26, 19, '2022-11-01'),
(22, 27, 1, '2022-11-01'),
(24, 14, 23, '2022-11-03'),
(25, 15, 34, '2022-11-03'),
(26, 16, 35, '2022-11-04'),
(27, 20, 13, '2022-11-06'),
(28, 19, 16, '2022-11-07'),
(29, 14, 14, '2022-11-10'),
(30, 9, 21, '2022-11-13'),
(32, 22, 5, '2022-09-21'),
(33, 19, 9, '2022-10-30'),
(34, 15, 13, '2022-10-29'),
(35, 23, 15, '2022-10-23'),
(36, 22, 11, '2022-11-11'),
(37, 11, 35, '2022-10-24'),
(38, 25, 8, '2022-10-13'),
(39, 29, 7, '2022-10-19');

-- --------------------------------------------------------

--
-- Структура таблиці `manufacturer`
--

CREATE TABLE `manufacturer` (
  `mn_name` varchar(50) NOT NULL,
  `mn_adress` varchar(50) NOT NULL,
  `mn_phone` int(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `manufacturer`
--

INSERT INTO `manufacturer` (`mn_name`, `mn_adress`, `mn_phone`) VALUES
('A4Tech', '678 O\'Keefe Keys', 891368201),
('Advanced Micro Devices', '1160 Elliott Springs', 773729110),
('Apple', '89074 Bartell Isle', 491343011),
('Asus', '50912 Reynolds Stream', 388613045),
('Chieftec', '63136 Drew Stream', 468766400),
('Crucial', '234 Macejkovic Pike', 404238873),
('Intel', '29832 Schinner Underpass', 2243546787),
('Kingston', '32841 Bethel Loaf', 884895484),
('Lenovo', '10980 Miracle Radial', 679182346),
('LG', '351 Bailee Fall', 939042341),
('Logitech', '38290 Marie Camp', 898409120),
('Micro Star International', '46689 Federico Field', 158098597),
('Philips', '7377 Wisozk Harbors', 700820612),
('Samsung', '002 Koelpin Views', 34010632);

-- --------------------------------------------------------

--
-- Структура таблиці `supply_contract`
--

CREATE TABLE `supply_contract` (
  `contract_id` bigint(20) UNSIGNED NOT NULL,
  `gs_id` bigint(20) UNSIGNED NOT NULL,
  `sl_price` double UNSIGNED NOT NULL,
  `sl_quantity` int(9) UNSIGNED NOT NULL,
  `contract_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `supply_contract`
--

INSERT INTO `supply_contract` (`contract_id`, `gs_id`, `sl_price`, `sl_quantity`, `contract_date`) VALUES
(1, 15, 250, 65, '2022-11-01'),
(2, 9, 200, 865, '2022-10-11'),
(3, 18, 234, 54, '2022-08-11'),
(4, 25, 22, 754, '2022-09-06'),
(5, 25, 21, 43, '2022-10-20'),
(6, 1, 19.8, 754, '2022-11-06'),
(9, 21, 250, 1236, '2022-10-27'),
(10, 33, 200, 854, '2022-10-29'),
(11, 12, 1059, 322, '2022-10-30'),
(12, 12, 1087, 34, '2022-11-13'),
(13, 15, 33, 578, '2022-09-27'),
(14, 17, 240, 44, '2022-09-22'),
(15, 4, 377, 954, '2022-10-16'),
(16, 34, 222, 255, '2022-10-22'),
(17, 5, 1130, 1288, '2022-11-07'),
(18, 7, 680, 1945, '2022-11-03'),
(20, 37, 202, 644, '2022-10-24'),
(21, 2, 122, 54, '2022-11-11'),
(23, 12, 1344, 442, '2022-09-11');

-- --------------------------------------------------------

--
-- Структура таблиці `warehouse`
--

CREATE TABLE `warehouse` (
  `warehouse_id` int(10) UNSIGNED NOT NULL,
  `w_address` varchar(50) DEFAULT NULL,
  `manager` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `warehouse`
--

INSERT INTO `warehouse` (`warehouse_id`, `w_address`, `manager`) VALUES
(1, '48 Oakwood Avenue', 'Marni Pemberton'),
(2, '2327 Bernardo Street', 'Kenzie Kaye'),
(3, '8238 Masonic &#39;Drive&#39;', 'Phillippa Marks'),
(4, '2810 Sampson Street', 'Alexandra Burt'),
(5, '200 Mudlick Road', 'Phyllis Mcguire'),
(6, '4855 Northwest Boulevard', 'Kaitlyn Gonzalez'),
(7, '1892 Turkey Pen Lane', 'Ashlyn Vaughan'),
(8, '2384 Rosewood Lane', 'Ailsa Lucero'),
(9, '3342 Jewell Road', 'Jon-Paul Parra'),
(10, '4240 Hickory Lane', 'Alison Sinclair'),
(11, '1959 Echo Lane', 'Zephaniah Johns'),
(12, '1551 Sycamore Lake Road', 'Jethro Chavez'),
(13, '3151 Shady Pines Drive', 'Neal Lee'),
(14, '4477 Sugarfoot Lane', 'Maxine Barnes'),
(15, '2609 Benson Park Drive', 'Luna Duran'),
(16, '2230 Agriculture Lane', 'Miller Sumner'),
(17, '3211 Green Avenue', 'Kyra Vickers'),
(18, '1229 Bagwell Avenue', 'Tabatha Galloway'),
(19, '1688 Fincham Road', 'Elara Chapman'),
(20, '1766 McVaney Road', 'Colby Baird'),
(21, '2327 July Street', 'Kenzie West');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cr_id`);

--
-- Індекси таблиці `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`gs_id`),
  ADD KEY `warehouse_id` (`warehouse_id`),
  ADD KEY `mn_name` (`mn_name`);

--
-- Індекси таблиці `info_order`
--
ALTER TABLE `info_order`
  ADD PRIMARY KEY (`or_id`),
  ADD KEY `cr_id` (`cr_id`),
  ADD KEY `gs_id` (`gs_id`);

--
-- Індекси таблиці `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`mn_name`);

--
-- Індекси таблиці `supply_contract`
--
ALTER TABLE `supply_contract`
  ADD PRIMARY KEY (`contract_id`),
  ADD KEY `gs_id` (`gs_id`);

--
-- Індекси таблиці `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouse_id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `customer`
--
ALTER TABLE `customer`
  MODIFY `cr_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблиці `goods`
--
ALTER TABLE `goods`
  MODIFY `gs_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблиці `info_order`
--
ALTER TABLE `info_order`
  MODIFY `or_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблиці `supply_contract`
--
ALTER TABLE `supply_contract`
  MODIFY `contract_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблиці `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `warehouse_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `goods`
--
ALTER TABLE `goods`
  ADD CONSTRAINT `goods_ibfk_1` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`warehouse_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `goods_ibfk_2` FOREIGN KEY (`mn_name`) REFERENCES `manufacturer` (`mn_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `info_order`
--
ALTER TABLE `info_order`
  ADD CONSTRAINT `info_order_ibfk_1` FOREIGN KEY (`cr_id`) REFERENCES `customer` (`cr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `info_order_ibfk_2` FOREIGN KEY (`gs_id`) REFERENCES `goods` (`gs_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `supply_contract`
--
ALTER TABLE `supply_contract`
  ADD CONSTRAINT `supply_contract_ibfk_2` FOREIGN KEY (`gs_id`) REFERENCES `goods` (`gs_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
