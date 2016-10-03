-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'planets'
--
-- ---

DROP TABLE IF EXISTS `planets`;

CREATE TABLE `planets` (
  `id` serial PRIMARY KEY,
  `visitable` BINARY NULL DEFAULT NULL,
  `type` INTEGER NULL DEFAULT NULL,
  `population` INTEGER NULL DEFAULT NULL,
  `location_x` INTEGER NULL DEFAULT NULL,
  `location_y` INTEGER NULL DEFAULT NULL,
  `specialty` INTEGER NULL DEFAULT NULL,
  `taboo` INTEGER NULL DEFAULT NULL
);

-- ---
-- Table 'ship'
--
-- ---

DROP TABLE IF EXISTS `ship`;

CREATE TABLE `ship` (
  `id` serial PRIMARY KEY,
  `name` VARCHAR(128) NULL DEFAULT NULL,
  `cargo_capacity` INTEGER NULL DEFAULT NULL,
  `fuel_capacity` INTEGER NULL DEFAULT NULL,
  `credits` INTEGER NULL DEFAULT NULL,
  `location_x` INTEGER NULL DEFAULT NULL,
  `location_y` INTEGER NULL DEFAULT NULL
);

-- ---
-- Table 'tradegoods'
--
-- ---

DROP TABLE IF EXISTS `tradegoods`;

CREATE TABLE `tradegoods` (
  `id` serial PRIMARY KEY,
  `name` VARCHAR(128) NULL DEFAULT NULL,
  `price` INTEGER NULL DEFAULT NULL,
  `buy_at` INTEGER NULL DEFAULT NULL,
  `sell_at` INTEGER NULL DEFAULT NULL
);

-- ---
-- Table 'cargo'
--
-- ---

DROP TABLE IF EXISTS `cargo`;

CREATE TABLE `cargo` (
  `id` serial PRIMARY KEY,
  `id_tradegoods` INTEGER NULL DEFAULT NULL,
  `id_ship` INTEGER NULL DEFAULT NULL,
  `quantity` INTEGER NULL DEFAULT NULL
);

-- ---
-- Table 'inventory'
--
-- ---

DROP TABLE IF EXISTS `inventory`;

CREATE TABLE `inventory` (
  `id` serial PRIMARY KEY,
  `id_planets` INTEGER NULL DEFAULT NULL,
  `id_tradegoods` INTEGER NULL DEFAULT NULL,
  `quantity` INTEGER NULL DEFAULT NULL,
  `price` INTEGER NULL DEFAULT NULL
);

-- ---
-- Table 'parameters'
--
-- ---

DROP TABLE IF EXISTS `parameters`;

CREATE TABLE `parameters` (
  `id` serial PRIMARY KEY,
  `name` VARCHAR(128),
  `value` INTEGER
);

-- ---
-- Foreign Keys
-- ---

-- ALTER TABLE `cargo` ADD FOREIGN KEY (id_tradegoods) REFERENCES `tradegoods` (`id`);
-- ALTER TABLE `cargo` ADD FOREIGN KEY (id_ship) REFERENCES `ship` (`id`);
-- ALTER TABLE `inventory` ADD FOREIGN KEY (id_planets) REFERENCES `planets` (`id`);
-- ALTER TABLE `inventory` ADD FOREIGN KEY (id_tradegoods) REFERENCES `tradegoods` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `planets` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `ship` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `tradegoods` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `cargo` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `inventory` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `parameters` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `planets` (`id`,`visitable`,`type`,`population`,`location_x`,`location_y`,`specialty`,`taboo`) VALUES
-- ('','','','','','','','');
-- INSERT INTO `ship` (`id`,`name`,`cargo_capacity`,`fuel_capacity`,`credits`,`location_x`,`location_y`) VALUES
-- ('','','','','','','');
-- INSERT INTO `tradegoods` (`id`,`name`,`price`,`buy_at`,`sell_at`) VALUES
-- ('','','','','');
-- INSERT INTO `cargo` (`id`,`id_tradegoods`,`id_ship`,`quantity`) VALUES
-- ('','','','');
-- INSERT INTO `inventory` (`id`,`id_planets`,`id_tradegoods`,`quantity`,`price`) VALUES
-- ('','','','','');
-- INSERT INTO `parameters` (`id`,`name`,`value`) VALUES
-- ('','','');
