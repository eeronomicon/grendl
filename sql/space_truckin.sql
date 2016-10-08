--
-- Database: `space_truckin`
--
CREATE DATABASE IF NOT EXISTS `space_truckin` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `space_truckin`;

-- --------------------------------------------------------

--
-- Table structure for table `cargo`
--

CREATE TABLE cargo (
  id serial PRIMARY KEY,
  id_tradegoods int,
  id_ship int,
  quantity int
);

--
-- Dumping data for table `cargo`
--

INSERT INTO `cargo` (`id`, `id_tradegoods`, `id_ship`, `quantity`) VALUES
(105, 1, 13, 0),
(106, 2, 13, 0),
(107, 3, 13, 0),
(108, 4, 13, 0),
(109, 5, 13, 0),
(110, 6, 13, 0),
(111, 7, 13, 0),
(112, 8, 13, 0),
(113, 1, 14, 0),
(114, 2, 14, 0),
(115, 3, 14, 0),
(116, 4, 14, 0),
(117, 5, 14, 0),
(118, 6, 14, 0),
(119, 7, 14, 0),
(120, 8, 14, 0),
(121, 1, 15, 0),
(122, 2, 15, 13),
(123, 3, 15, 0),
(124, 4, 15, 0),
(125, 5, 15, 0),
(126, 6, 15, 0),
(127, 7, 15, 0),
(128, 8, 15, 0),
(129, 1, 16, 0),
(130, 2, 16, 0),
(131, 3, 16, 0),
(132, 4, 16, 0),
(133, 5, 16, 0),
(134, 6, 16, 0),
(135, 7, 16, 0),
(136, 8, 16, 0),
(137, 1, 17, 0),
(138, 2, 17, 0),
(139, 3, 17, 0),
(140, 4, 17, 0),
(141, 5, 17, 0),
(142, 6, 17, 0),
(143, 7, 17, 0),
(144, 8, 17, 0),
(145, 1, 18, 0),
(146, 2, 18, 0),
(147, 3, 18, 0),
(148, 4, 18, 0),
(149, 5, 18, 0),
(150, 6, 18, 37),
(151, 7, 18, 0),
(152, 8, 18, 0),
(153, 1, 19, 50),
(154, 2, 19, 0),
(155, 3, 19, 49),
(156, 4, 19, 0),
(157, 5, 19, 0),
(158, 6, 19, 0),
(159, 7, 19, 0),
(160, 8, 19, 0),
(161, 1, 20, 0),
(162, 2, 20, 0),
(163, 3, 20, 0),
(164, 4, 20, 0),
(165, 5, 20, 22),
(166, 6, 20, 35),
(167, 7, 20, 0),
(168, 8, 20, 43),
(169, 1, 21, 0),
(170, 2, 21, 0),
(171, 3, 21, 0),
(172, 4, 21, 0),
(173, 5, 21, 0),
(174, 6, 21, 0),
(175, 7, 21, 0),
(176, 8, 21, 0),
(177, 1, 22, 0),
(178, 2, 22, 0),
(179, 3, 22, 0),
(180, 4, 22, 0),
(181, 5, 22, 0),
(182, 6, 22, 0),
(183, 7, 22, 0),
(184, 8, 22, 0),
(185, 1, 23, 0),
(186, 2, 23, 0),
(187, 3, 23, 0),
(188, 4, 23, 0),
(189, 5, 23, 0),
(190, 6, 23, 18),
(191, 7, 23, 69),
(192, 8, 23, 0),
(193, 1, 24, 0),
(194, 2, 24, 0),
(195, 3, 24, 0),
(196, 4, 24, 0),
(197, 5, 24, 0),
(198, 6, 24, 0),
(199, 7, 24, 0),
(200, 8, 24, 0),
(201, 1, 25, 0),
(202, 2, 25, 0),
(203, 3, 25, 0),
(204, 4, 25, 0),
(205, 5, 25, 0),
(206, 6, 25, 0),
(207, 7, 25, 0),
(208, 8, 25, 0),
(209, 1, 26, 0),
(210, 2, 26, 0),
(211, 3, 26, 33),
(212, 4, 26, 67),
(213, 5, 26, 0),
(214, 6, 26, 0),
(215, 7, 26, 0),
(216, 8, 26, 0);

-- --------------------------------------------------------

--
-- Table structure for table `high_scores`
--

CREATE TABLE high_scores (
  ship_name varchar (255),
  score int,
  id serial PRIMARY KEY,
  turn int
);

--
-- Dumping data for table `high_scores`
--

INSERT INTO `high_scores` (`ship_name`, `score`, `id`, `turn`) VALUES
('Beowulf', 452, 1, 45),
('Serenity', 768, 2, 45),
('Apollo 11', -45, 3, 45),
('S.S. Nimoy', 94000, 4, 45),
('WM Shatner', 99500, 5, 3),
('Space Bud', 99750, 8, 2),
('WozniaArk', 90587, 9, 39),
('Star Bug', 81680, 10, 5),
('Heart of Gold', 36825, 11, 4),
('Hank the Dog', 49000, 12, 2),
('Alan Turing', 155810, 13, 38),
('StarBug', 0, 14, 11),
('Space Ship Jimmy', 177522, 15, 50);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE inventory (
  id serial PRIMARY KEY,
  id_planets int,
  id_tradegoods int,
  quantity int,
  price int
);

-- --------------------------------------------------------

--
-- Table structure for table `parameters`
--

CREATE TABLE parameters (
  id serial PRIMARY KEY,
  name varchar (128),
  value int,
  type varchar (255)
);

--
-- Dumping data for table `parameters`
--

INSERT INTO parameters (id, name, value, type) VALUES
(1, 'pop_1_max_inventory', 60, 'max_inventory'),
(2, 'pop_2_max_inventory', 80, 'max_inventory'),
(3, 'pop_3_max_inventory', 100, 'max_inventory'),
(4, 'type_match_min_factor', 25, 'type_factor'),
(5, 'type_match_max_factor', 50, 'type_factor'),
(6, 'type_mismatch_min_factor', 125, 'type_factor'),
(7, 'type_mismatch_max_factor', 150, 'type_factor'),
(8, 'pop_1_min_factor', 50, 'pop_factor'),
(9, 'pop_1_max_factor', 75, 'pop_factor'),
(10, 'pop_2_min_factor', 100, 'pop_factor'),
(11, 'pop_2_max_factor', 100, 'pop_factor'),
(12, 'pop_3_min_factor', 125, 'pop_factor'),
(13, 'pop_3_max_factor', 150, 'pop_factor'),
(14, 'specialty_min_factor', 25, 'specialty_factor'),
(15, 'specialty_max_factor', 50, 'specialty_factor'),
(16, 'controlled_min_factor', 150, 'controlled_factor'),
(17, 'controlled_max_factor', 200, 'controlled_factor'),
(18, 'min_planet_density', 28, 'system_setup'),
(19, 'max_planet_density', 35, 'system_setup'),
(20, 'universe_size_sqrt', 10, 'system_setup'),
(21, 'ag_planet_share', 35, 'system_setup'),
(22, 'in_planet_share', 35, 'system_setup'),
(23, 'fuel_planet_share', 30, 'system_setup'),
(24, 'inventory_increment_min_percent', 25, 'increment_percent'),
(25, 'inventory_increment_max_percent', 50, 'increment_percent'),
(26, 'increment_specialty_share', 33, 'increment_percent'),
(27, 'increment_regular_share', 67, 'increment_percent'),
(28, 'fuel_price', 10, 'gameplay'),
(29, 'max_fuel', 100, 'gameplay'),
(30, 'starting_fuel', 80, 'gameplay'),
(31, 'max_cargo', 100, 'gameplay'),
(32, 'starting_credits', 10000, 'gameplay'),
(33, 'starting_x', 3, 'gameplay'),
(34, 'starting_y', 3, 'gameplay'),
(35, 'max_turns', 20, 'gameplay'),
(36, 'upkeep_cost', 1000, 'gameplay'),
(37, 'travel_cost', 10, 'gameplay');

-- --------------------------------------------------------

--
-- Table structure for table `planets`
--

CREATE TABLE planets (
  id serial PRIMARY KEY,
  type int,
  population int,
  location_x int,
  location_y int,
  specialty int,
  controlled int,
  regular int,
  name varchar (255)
);

-- --------------------------------------------------------

--
-- Table structure for table `planet_names`
--

CREATE TABLE planet_names (
  id serial PRIMARY KEY,
  name varchar (255)
);

--
-- Dumping data for table `planet_names`
--

INSERT INTO planet_names (id, name) VALUES
(1, 'Odriulia'),
(2, 'Echoyhines'),
(3, 'Vobrarth'),
(4, 'Eslion'),
(5, 'Peyter'),
(6, 'Yiylia'),
(7, 'Gretothea'),
(8, 'Slamanus'),
(9, 'Treron NQ5'),
(10, 'Trore HU'),
(11, 'Tusneinus'),
(12, 'Deproilara'),
(13, 'Maswov'),
(14, 'Gacrorth'),
(15, 'Mopra'),
(16, 'Xuagantu'),
(17, 'Brusoclite'),
(18, 'Snegunides'),
(19, 'Shurn 3G17'),
(20, 'Scilia 48'),
(21, 'Cestreter'),
(22, 'Fawhauter'),
(23, 'Hosnora'),
(24, 'Vapriea'),
(25, 'Aovis'),
(26, 'Aenerth'),
(27, 'Pruzozuno'),
(28, 'Shoahiri'),
(29, 'Glomia 02A'),
(30, 'Plade BIL'),
(31, 'Dopraopra'),
(32, 'Tabreyhiri'),
(33, 'Kathiuq'),
(34, 'Zocrade'),
(35, 'Goeria'),
(36, 'Iahines'),
(37, 'Gredotov'),
(38, 'Grafonides'),
(39, 'Whiea A07'),
(40, 'Blinda 65D'),
(41, 'Mostreotania'),
(42, 'Xoswaolea'),
(43, 'Qeshapus'),
(44, 'Askoria'),
(45, 'Foynus'),
(46, 'Aitune'),
(47, 'Fluwoliv'),
(48, 'Blozaturn'),
(49, 'Bleshan WIB'),
(50, 'Glore C279'),
(51, 'Iabreynus'),
(52, 'Dewheutera'),
(53, 'Jaglapus'),
(54, 'Powhadus'),
(55, 'Aynov'),
(56, 'Negawa'),
(57, 'Scolacarro'),
(58, 'Slaeruta'),
(59, 'Crarvis 4'),
(60, 'Freon DJJL'),
(61, 'Kaploihiri'),
(62, 'Utroalea'),
(63, 'Kogleon'),
(64, 'Xacriea'),
(65, 'Vophus'),
(66, 'Suyrilia'),
(67, 'Whekaliv'),
(68, 'Frufawei'),
(69, 'Smiuq 9T7M'),
(70, 'Snao 69C'),
(71, 'Xusmiuruta'),
(72, 'Gufroythea'),
(73, 'Ruthore'),
(74, 'Esnade'),
(75, 'Seylia'),
(76, 'Teulara'),
(77, 'Glagutania'),
(78, 'Thunuter'),
(79, 'Grarth JK'),
(80, 'Ploria XIGM'),
(81, 'Yasmuihines'),
(82, 'Ugliotune'),
(83, 'Peshippe'),
(84, 'Rospion'),
(85, 'Ailiv'),
(86, 'Duotera'),
(87, 'Strouter'),
(88, 'Strasobos'),
(89, 'Shars 75Y'),
(90, 'Strade TD'),
(91, 'Uchuegantu'),
(92, 'Obrewei'),
(93, 'Askeron'),
(94, 'Ducrosie'),
(95, 'Liylea'),
(96, 'Rouclite'),
(97, 'Braputhea'),
(98, 'Straconus'),
(99, 'Blichi WMOE'),
(100, 'Wheshan OEP');

-- --------------------------------------------------------

--
-- Table structure for table `ship`
--

CREATE TABLE ship (
  id serial PRIMARY KEY,
  name varchar (64),
  cargo_capacity int,
  fuel_capacity int,
  credits int,
  location_x int,
  location_y int,
  current_fuel int,
  turn int
);

--
-- Dumping data for table `ship`
--

INSERT INTO `ship` (`id`, `name`, `cargo_capacity`, `fuel_capacity`, `credits`, `location_x`, `location_y`, `current_fuel`, `turn`) VALUES
(13, 'New', 100, 100, 99750, 3, 4, 70, 2),
(14, 'Please!!', 100, 100, 99750, 10, 4, 0, 2),
(15, 'Work', 100, 100, 90587, 4, 6, 0, 39),
(16, 'test', 100, 100, 99500, 4, 5, 30, 3),
(17, 'Test', 100, 100, 100000, 3, 3, 80, 1),
(18, 'TestTest', 100, 100, 99528, 3, 5, 60, 2),
(19, 'Testing', 100, 100, 81680, 6, 3, 0, 5),
(20, 'beowulf', 100, 100, 36825, 3, 3, 0, 4),
(21, 'test', 100, 100, 49000, 5, 10, 0, 2),
(22, 'test', 100, 100, 155810, 4, 4, 0, 38),
(23, 'Frank', 100, 100, 49, 4, 4, 60, 4),
(24, 'Test', 100, 100, 9000, 2, 4, 60, 2),
(25, 'StarBug', 100, 100, 0, 6, 6, 20, 11),
(26, 'Space Ship Jim', 100, 100, 177522, 7, 6, 30, 50);

-- --------------------------------------------------------

--
-- Table structure for table `tradegoods`
--

CREATE TABLE tradegoods (
  id serial PRIMARY KEY,
  name varchar (128),
  price int,
  buy_at int,
  sell_at int
);

--
-- Dumping data for table `tradegoods`
--

INSERT INTO tradegoods (id, name, price, buy_at, sell_at) VALUES
(1, 'Ore', 90, 1, 2),
(2, 'Grain', 80, 1, 2),
(3, 'Livestock', 110, 1, 2),
(4, 'Consumables', 120, 1, 2),
(5, 'Consumer Goods', 80, 2, 1),
(6, 'Heavy Machinery', 130, 2, 1),
(7, 'Military Hardware', 120, 2, 1),
(8, 'Robots', 100, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `high_scores`
--
ALTER TABLE `high_scores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `planets`
--
ALTER TABLE `planets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `planet_names`
--
ALTER TABLE `planet_names`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ship`
--
ALTER TABLE `ship`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tradegoods`
--
ALTER TABLE `tradegoods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;
--
-- AUTO_INCREMENT for table `high_scores`
--
ALTER TABLE `high_scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4833;
--
-- AUTO_INCREMENT for table `parameters`
--
ALTER TABLE `parameters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `planets`
--
ALTER TABLE `planets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;
--
-- AUTO_INCREMENT for table `planet_names`
--
ALTER TABLE `planet_names`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `ship`
--
ALTER TABLE `ship`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `tradegoods`
--
ALTER TABLE `tradegoods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
