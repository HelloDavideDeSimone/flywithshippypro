-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Oct 30, 2022 at 09:07 AM
-- Server version: 10.6.3-MariaDB-1:10.6.3+maria~focal
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Dumping data for table `airport`

/*
Dev data
INSERT INTO `airport` (`id`, `lat`, `lng`, `code`, `name`) VALUES
(1, 42.58, -99.9933, 'A', 'A AIRPORT'),
(2, 17.136749, -61.792667, 'B', 'B AIRPORT'),
(3, 51.189444, 4.460278, 'C', 'C AIRPORT'),
(4, 61.5816, -159.543, 'D', 'D AIRPORT'),
(5, 40.128082, 32.995083, 'E', 'E AIRPORT'),
(6, 45.729247, 0.221456, 'F', 'F AIRPORT'),
(7, -23.444478, -70.4451, 'G', 'G AIRPORT');
*/
--

INSERT INTO `airport` (`code`, `name`, `lat`, `lng`) VALUES
('AEY', 'Akureyri', '65.659994', '-18.072703'),
('ESF', 'Esler Field', '31.394903', '-92.295772'),
('AEX', 'Alexandria Intl Arpt', '31.3274', '-92.549833'),
('AES', 'Vigra Airport', '62.560372', '6.110164'),
('AER', 'Alder Sochi Arpt', '43.449928', '39.956589'),
('AEL', 'Albert Lea Arpt', '0', '0'),
('AEI', 'Algeciras Arpt', '0', '0'),
('ADZ', 'San Andres Island Arpt', '12.583594', '-81.711192'),
('ABL', 'Ambler Arpt', '67.106389', '-157.8575'),
('ABI', 'Abilene Municipal Arpt', '32.411319', '-99.681897'),
('ABE', 'Lehigh Valley Intl Arpt', '40.652083', '-75.440806'),
('ABD', 'Abadan Arpt', '30.371111', '48.228333'),
('ABC', 'Los Llanos Arpt', '38.948', '-1.863');