-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 22/03/2024 às 22:14
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `locationlab_db`
--
CREATE DATABASE IF NOT EXISTS `locationlab_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `locationlab_db`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `activities`
--
-- Criação: 26/02/2024 às 17:38
-- Última atualização: 22/03/2024 às 19:08
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `atctive_id` int(11) NOT NULL,
  `mensagens_id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `activities`:
--   `mensagens_id`
--       `mensagens` -> `mensagens_id`
--   `users_id`
--       `users` -> `users_id`
--

--
-- Despejando dados para a tabela `activities`
--

INSERT INTO `activities` (`atctive_id`, `mensagens_id`, `users_id`, `timestamp`) VALUES
(1, 1, 1, '2024-02-26 17:48:47'),
(2, 1, 1, '2024-02-27 12:03:19'),
(3, 1, 1, '2024-02-27 12:05:22'),
(4, 1, 1, '2024-02-27 12:08:14'),
(5, 1, 1, '2024-02-27 12:09:47'),
(6, 1, 1, '2024-02-27 12:14:16'),
(7, 1, 1, '2024-02-27 12:17:34'),
(8, 1, 1, '2024-02-27 12:21:46'),
(9, 1, 1, '2024-02-27 12:23:18'),
(10, 6, 1, '2024-02-27 12:26:41'),
(11, 1, 1, '2024-02-27 12:29:34'),
(12, 6, 1, '2024-02-27 13:09:09'),
(13, 1, 1, '2024-02-27 14:48:34'),
(14, 1, 1, '2024-02-27 14:59:00'),
(15, 6, 1, '2024-02-29 15:09:44'),
(16, 35, 1, '2024-02-29 15:10:10'),
(17, 35, 1, '2024-02-29 15:10:19'),
(18, 35, 1, '2024-02-29 15:10:28'),
(19, 2, 34, '2024-02-29 15:11:17'),
(20, 6, 1, '2024-02-29 15:14:55'),
(21, 35, 1, '2024-02-29 16:39:10'),
(22, 35, 1, '2024-02-29 16:39:21'),
(23, 35, 1, '2024-02-29 16:39:38'),
(24, 36, 1, '2024-02-29 16:45:40'),
(25, 36, 1, '2024-02-29 16:45:48'),
(26, 36, 1, '2024-02-29 16:45:54'),
(27, 35, 1, '2024-02-29 16:46:13'),
(28, 36, 1, '2024-02-29 16:46:28'),
(29, 35, 1, '2024-02-29 16:46:38'),
(30, 36, 1, '2024-02-29 16:46:46'),
(31, 36, 1, '2024-02-29 16:46:48'),
(32, 36, 1, '2024-02-29 16:46:59'),
(33, 36, 1, '2024-02-29 16:47:11'),
(34, 35, 1, '2024-02-29 16:47:32'),
(35, 28, 1, '2024-02-29 19:36:42'),
(36, 3, 1, '2024-02-29 19:41:58'),
(37, 4, 1, '2024-03-01 17:22:40'),
(38, 4, 1, '2024-03-01 18:00:03'),
(39, 4, 1, '2024-03-01 18:06:24'),
(40, 3, 1, '2024-03-01 19:15:28'),
(41, 4, 1, '2024-03-01 19:41:49'),
(42, 28, 30, '2024-03-05 13:12:58'),
(43, 28, 30, '2024-03-05 13:16:16'),
(44, 28, 18, '2024-03-05 13:19:37'),
(45, 28, 30, '2024-03-05 14:54:43'),
(47, 28, 18, '2024-03-05 15:16:16'),
(49, 28, 34, '2024-03-05 18:18:32'),
(52, 28, 34, '2024-03-05 19:15:50'),
(54, 28, 19, '2024-03-05 20:46:29'),
(55, 6, 1, '2024-03-11 18:19:13'),
(56, 6, 1, '2024-03-11 20:55:02'),
(57, 29, 1, '2024-03-13 12:29:38'),
(58, 29, 1, '2024-03-13 12:38:53'),
(59, 28, 34, '2024-03-13 12:48:48'),
(60, 2, 34, '2024-03-13 12:50:19'),
(61, 36, 1, '2024-03-13 12:54:55'),
(62, 2, 34, '2024-03-13 12:56:40'),
(63, 3, 1, '2024-03-13 12:57:18'),
(64, 3, 1, '2024-03-13 12:57:47'),
(65, 4, 34, '2024-03-13 13:01:07'),
(66, 6, 1, '2024-03-13 13:20:28'),
(67, 6, 1, '2024-03-13 13:21:22'),
(68, 28, 18, '2024-03-13 17:47:17'),
(69, 30, 1, '2024-03-13 18:00:57'),
(70, 30, 1, '2024-03-13 18:01:51'),
(71, 2, 34, '2024-03-13 18:02:29'),
(72, 35, 1, '2024-03-13 18:02:55'),
(73, 35, 1, '2024-03-13 18:03:01'),
(74, 35, 1, '2024-03-13 18:03:06'),
(75, 35, 1, '2024-03-13 18:03:10'),
(76, 35, 1, '2024-03-13 18:03:15'),
(77, 35, 1, '2024-03-13 18:03:19'),
(78, 2, 34, '2024-03-13 18:03:58'),
(79, 2, 1, '2024-03-13 18:07:38'),
(80, 2, 34, '2024-03-13 18:09:43'),
(81, 3, 18, '2024-03-13 18:11:57'),
(82, 4, 1, '2024-03-13 18:15:16'),
(83, 2, 1, '2024-03-13 18:19:22'),
(84, 4, 1, '2024-03-13 18:25:45'),
(85, 2, 1, '2024-03-13 18:27:36'),
(86, 2, 34, '2024-03-13 18:45:38'),
(87, 2, 1, '2024-03-13 19:15:41'),
(88, 1, 1, '2024-03-13 19:38:45'),
(89, 4, 34, '2024-03-13 20:00:11'),
(90, 8, 34, '2024-03-13 20:03:10'),
(91, 27, 20, '2024-03-14 11:17:43'),
(92, 28, 20, '2024-03-14 11:18:55'),
(93, 3, 20, '2024-03-14 11:19:13'),
(94, 3, 20, '2024-03-14 11:19:27'),
(95, 4, 1, '2024-03-14 19:02:04'),
(96, 4, 1, '2024-03-15 18:18:07'),
(97, 4, 20, '2024-03-18 11:47:07'),
(98, 4, 20, '2024-03-18 11:47:07'),
(99, 35, 1, '2024-03-19 12:06:37'),
(100, 28, 260, '2024-03-19 12:30:13'),
(101, 28, 199, '2024-03-19 12:33:50'),
(102, 28, 125, '2024-03-19 12:34:00'),
(103, 2, 260, '2024-03-19 12:35:38'),
(104, 2, 199, '2024-03-19 12:39:29'),
(105, 6, 1, '2024-03-19 12:43:12'),
(106, 3, 20, '2024-03-19 12:43:18'),
(107, 28, 30, '2024-03-19 12:50:26'),
(108, 2, 260, '2024-03-19 12:52:04'),
(109, 6, 1, '2024-03-19 12:58:11'),
(110, 2, 260, '2024-03-19 13:07:58'),
(111, 2, 260, '2024-03-19 13:11:05'),
(112, 2, 260, '2024-03-19 13:12:29'),
(113, 28, 19, '2024-03-19 13:14:03'),
(114, 2, 260, '2024-03-19 13:15:46'),
(115, 4, 34, '2024-03-19 13:17:20'),
(116, 2, 28, '2024-03-19 13:17:22'),
(117, 2, 260, '2024-03-19 13:17:29'),
(118, 2, 28, '2024-03-19 13:18:42'),
(119, 4, 34, '2024-03-19 13:19:39'),
(120, 4, 34, '2024-03-19 13:19:42'),
(121, 2, 28, '2024-03-19 13:19:47'),
(122, 2, 28, '2024-03-19 13:21:14'),
(123, 2, 28, '2024-03-19 13:22:16'),
(124, 2, 28, '2024-03-19 13:23:34'),
(125, 2, 260, '2024-03-19 13:24:47'),
(126, 2, 28, '2024-03-19 13:24:52'),
(127, 2, 28, '2024-03-19 13:26:22'),
(128, 2, 260, '2024-03-19 13:28:23'),
(129, 2, 260, '2024-03-19 13:30:00'),
(130, 2, 37, '2024-03-19 13:33:50'),
(131, 6, 1, '2024-03-19 13:56:56'),
(132, 6, 1, '2024-03-19 13:57:03'),
(133, 6, 1, '2024-03-19 13:57:17'),
(134, 6, 1, '2024-03-19 13:57:30'),
(135, 6, 1, '2024-03-19 13:57:42'),
(136, 6, 1, '2024-03-19 13:57:57'),
(137, 6, 1, '2024-03-19 13:58:09'),
(138, 6, 1, '2024-03-19 13:58:24'),
(139, 6, 1, '2024-03-19 13:58:39'),
(140, 6, 1, '2024-03-19 13:58:49'),
(141, 6, 1, '2024-03-19 13:59:00'),
(142, 6, 1, '2024-03-19 13:59:34'),
(143, 6, 1, '2024-03-19 13:59:53'),
(144, 6, 1, '2024-03-19 14:00:18'),
(145, 6, 1, '2024-03-19 14:00:30'),
(146, 6, 1, '2024-03-19 14:00:46'),
(147, 6, 1, '2024-03-19 14:01:10'),
(148, 6, 1, '2024-03-19 14:01:39'),
(149, 6, 1, '2024-03-19 14:02:04'),
(150, 6, 1, '2024-03-19 14:02:47'),
(151, 2, 28, '2024-03-19 14:10:23'),
(152, 6, 1, '2024-03-19 14:46:12'),
(153, 6, 1, '2024-03-19 14:47:19'),
(154, 6, 1, '2024-03-19 15:53:29'),
(155, 6, 1, '2024-03-19 15:54:15'),
(156, 6, 1, '2024-03-19 15:55:01'),
(157, 6, 1, '2024-03-19 15:56:17'),
(158, 6, 1, '2024-03-19 15:56:46'),
(159, 6, 1, '2024-03-19 15:57:21'),
(160, 6, 1, '2024-03-19 15:57:34'),
(161, 6, 1, '2024-03-19 15:57:48'),
(162, 6, 1, '2024-03-19 15:58:55'),
(163, 6, 1, '2024-03-19 15:59:03'),
(164, 6, 1, '2024-03-19 15:59:30'),
(165, 6, 1, '2024-03-19 16:03:21'),
(166, 6, 1, '2024-03-19 16:03:32'),
(167, 6, 1, '2024-03-19 16:18:15'),
(168, 6, 1, '2024-03-19 16:18:31'),
(169, 6, 1, '2024-03-19 16:18:50'),
(170, 6, 1, '2024-03-19 16:19:04'),
(171, 6, 1, '2024-03-19 16:19:22'),
(172, 6, 1, '2024-03-19 16:20:26'),
(173, 6, 1, '2024-03-19 16:20:45'),
(174, 6, 1, '2024-03-19 16:22:31'),
(175, 6, 1, '2024-03-19 16:22:50'),
(176, 6, 1, '2024-03-19 16:23:00'),
(177, 6, 1, '2024-03-19 16:24:16'),
(178, 6, 1, '2024-03-19 16:24:41'),
(179, 6, 1, '2024-03-19 16:24:54'),
(180, 6, 1, '2024-03-19 16:26:51'),
(181, 28, 203, '2024-03-19 16:38:58'),
(182, 3, 15, '2024-03-19 16:40:28'),
(183, 3, 15, '2024-03-19 16:40:43'),
(184, 3, 15, '2024-03-19 16:40:54'),
(185, 3, 15, '2024-03-19 16:41:07'),
(186, 3, 15, '2024-03-19 16:41:28'),
(187, 3, 15, '2024-03-19 16:41:41'),
(188, 3, 15, '2024-03-19 16:41:51'),
(189, 3, 15, '2024-03-19 16:42:00'),
(190, 3, 15, '2024-03-19 16:42:09'),
(191, 28, 216, '2024-03-19 17:09:09'),
(192, 2, 216, '2024-03-19 17:14:17'),
(193, 2, 11, '2024-03-19 18:12:48'),
(194, 8, 1, '2024-03-19 19:02:33'),
(195, 8, 1, '2024-03-19 19:04:04'),
(196, 2, 11, '2024-03-19 19:04:38'),
(197, 35, 1, '2024-03-19 19:06:22'),
(198, 8, 11, '2024-03-19 19:06:38'),
(199, 2, 11, '2024-03-19 19:07:01'),
(200, 3, 11, '2024-03-19 19:09:12'),
(201, 6, 1, '2024-03-19 19:50:43'),
(202, 4, 16, '2024-03-19 20:03:27'),
(203, 6, 1, '2024-03-19 21:00:54'),
(204, 6, 1, '2024-03-20 10:57:19'),
(205, 3, 18, '2024-03-20 10:58:14'),
(206, 3, 18, '2024-03-20 10:58:28'),
(207, 3, 18, '2024-03-20 10:58:37'),
(208, 3, 18, '2024-03-20 10:58:47'),
(209, 3, 18, '2024-03-20 10:58:56'),
(210, 3, 18, '2024-03-20 10:59:05'),
(211, 3, 18, '2024-03-20 10:59:14'),
(212, 3, 18, '2024-03-20 10:59:29'),
(213, 3, 15, '2024-03-20 11:56:25'),
(214, 28, 37, '2024-03-20 18:12:39'),
(215, 28, 15, '2024-03-20 18:41:09'),
(216, 6, 1, '2024-03-20 20:26:37'),
(217, 4, 48, '2024-03-20 21:00:08'),
(218, 6, 1, '2024-03-21 16:11:06'),
(219, 6, 1, '2024-03-21 16:12:16'),
(220, 35, 1, '2024-03-21 16:13:12'),
(221, 4, 19, '2024-03-22 11:53:12'),
(222, 4, 19, '2024-03-22 11:53:12'),
(223, 4, 19, '2024-03-22 11:53:12'),
(224, 38, 19, '2024-03-22 11:53:12'),
(225, 6, 1, '2024-03-22 12:21:57'),
(226, 9, 1, '2024-03-22 12:22:11'),
(227, 6, 1, '2024-03-22 12:22:25'),
(228, 6, 1, '2024-03-22 12:22:56'),
(229, 28, 48, '2024-03-22 18:48:05'),
(230, 28, 48, '2024-03-22 18:57:36'),
(231, 28, 48, '2024-03-22 19:03:28'),
(232, 28, 48, '2024-03-22 19:08:28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `approver`
--
-- Criação: 19/01/2024 às 17:34
--

DROP TABLE IF EXISTS `approver`;
CREATE TABLE `approver` (
  `approver_id` int(11) NOT NULL,
  `approvers` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `approver`:
--

--
-- Despejando dados para a tabela `approver`
--

INSERT INTO `approver` (`approver_id`, `approvers`) VALUES
(1, 'Administrador'),
(2, 'Veículos'),
(3, 'Equipamentos'),
(4, 'Salas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipment`
--
-- Criação: 19/01/2024 às 17:34
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE `equipment` (
  `equip_id` int(11) NOT NULL,
  `equipment` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `sector` varchar(26) NOT NULL,
  `photo` varchar(24) DEFAULT NULL,
  `approver_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `equipment`:
--   `approver_id`
--       `approver` -> `approver_id`
--

--
-- Despejando dados para a tabela `equipment`
--

INSERT INTO `equipment` (`equip_id`, `equipment`, `description`, `sector`, `photo`, `approver_id`) VALUES
(1, 'Caixa de Som', 'Bluetooth, Sem fio, com microfone - 300 wats', 'RH', 'CxPolyvox.jpg', 3),
(2, 'Projetor Portátil Multimidia', 'Pequeno', 'RH', '720PTheater.jpg', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `gp_approver`
--
-- Criação: 19/01/2024 às 17:34
-- Última atualização: 21/03/2024 às 16:13
--

DROP TABLE IF EXISTS `gp_approver`;
CREATE TABLE `gp_approver` (
  `gp_approver_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `approver_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `gp_approver`:
--   `approver_id`
--       `approver` -> `approver_id`
--   `users_id`
--       `users` -> `users_id`
--

--
-- Despejando dados para a tabela `gp_approver`
--

INSERT INTO `gp_approver` (`gp_approver_id`, `users_id`, `approver_id`) VALUES
(1, 1, 1),
(20, 18, 1),
(21, 30, 1),
(22, 15, 1),
(23, 16, 1),
(24, 17, 1),
(25, 20, 1),
(26, 36, 1),
(27, 11, 1),
(28, 19, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `gr_approved`
--
-- Criação: 19/03/2024 às 13:05
-- Última atualização: 22/03/2024 às 12:22
--

DROP TABLE IF EXISTS `gr_approved`;
CREATE TABLE `gr_approved` (
  `gr_id` int(11) NOT NULL,
  `gp_approver_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `gr_approved`:
--

--
-- Despejando dados para a tabela `gr_approved`
--

INSERT INTO `gr_approved` (`gr_id`, `gp_approver_id`, `users_id`) VALUES
(219, 1, 19),
(220, 22, 34),
(221, 29, 37),
(222, 29, 38),
(223, 22, 23),
(224, 20, 18),
(225, 20, 27),
(226, 30, 41),
(227, 28, 42),
(228, 27, 44),
(229, 0, 43),
(230, 28, 50),
(231, 28, 57),
(232, 28, 58),
(233, 29, 56),
(234, 29, 59),
(235, 0, 61),
(236, 28, 66),
(237, 29, 68),
(238, 0, 70),
(239, 31, 71),
(240, 22, 72),
(241, 22, 73),
(242, 29, 74),
(243, 29, 75),
(244, 0, 77),
(245, 29, 80),
(246, 23, 90),
(247, 30, 92),
(248, 23, 93),
(249, 30, 94),
(250, 31, 95),
(251, 30, 96),
(252, 25, 106),
(253, 28, 108),
(254, 25, 100),
(255, 30, 101),
(256, 29, 102),
(257, 28, 109),
(258, 28, 103),
(259, 27, 111),
(260, 28, 117),
(261, 27, 119),
(262, 20, 118),
(263, 26, 121),
(264, 29, 123),
(265, 31, 124),
(266, 25, 125),
(267, 27, 128),
(268, 31, 131),
(269, 26, 135),
(270, 28, 137),
(271, 26, 141),
(272, 30, 142),
(273, 30, 151),
(274, 29, 150),
(275, 28, 158),
(276, 23, 164),
(277, 20, 163),
(278, 26, 166),
(279, 30, 167),
(280, 22, 168),
(281, 0, 192),
(282, 29, 171),
(283, 28, 172),
(284, 28, 173),
(285, 30, 175),
(286, 0, 177),
(287, 26, 179),
(288, 29, 181),
(289, 28, 193),
(290, 30, 202),
(291, 25, 204),
(292, 31, 205),
(293, 20, 207),
(294, 28, 209),
(295, 27, 211),
(296, 30, 213),
(297, 26, 212),
(298, 28, 217),
(299, 28, 215),
(300, 26, 216),
(301, 30, 221),
(302, 29, 222),
(303, 22, 228),
(304, 28, 231),
(305, 29, 233),
(306, 28, 237),
(307, 31, 238),
(308, 31, 240),
(309, 30, 241),
(310, 28, 242),
(311, 28, 243),
(312, 30, 244),
(313, 26, 245),
(314, 30, 246),
(315, 30, 248),
(316, 31, 251),
(317, 26, 253),
(318, 26, 254),
(319, 28, 259),
(320, 30, 264),
(321, 29, 265),
(322, 31, 267),
(323, 30, 274),
(324, 28, 276),
(325, 31, 281),
(326, 25, 20),
(327, 23, 17),
(328, 22, 21),
(329, 22, 22),
(330, 20, 24),
(331, 21, 25),
(332, 25, 35),
(333, 26, 36),
(334, 22, 26),
(335, 20, 28),
(336, 22, 29),
(337, 21, 30),
(338, 21, 31),
(339, 21, 32),
(340, 21, 33),
(341, 23, 203),
(342, 20, 160),
(343, 21, 262),
(344, 22, 120),
(345, 23, 197),
(346, 25, 55),
(347, 25, 199),
(348, 25, 116),
(349, 23, 206),
(350, 20, 97),
(351, 20, 138),
(352, 26, 91),
(353, 26, 188),
(354, 22, 147);

-- --------------------------------------------------------

--
-- Estrutura para tabela `laboratorios`
--
-- Criação: 19/01/2024 às 17:34
--

DROP TABLE IF EXISTS `laboratorios`;
CREATE TABLE `laboratorios` (
  `room_id` int(11) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `capacity` varchar(11) NOT NULL,
  `room_no` varchar(50) NOT NULL,
  `photo` varchar(24) DEFAULT NULL,
  `approver_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- RELACIONAMENTOS PARA TABELAS `laboratorios`:
--   `approver_id`
--       `approver` -> `approver_id`
--

--
-- Despejando dados para a tabela `laboratorios`
--

INSERT INTO `laboratorios` (`room_id`, `room_type`, `capacity`, `room_no`, `photo`, `approver_id`) VALUES
(7, 'Sala de treinamento', '20', 'Ao lado da oficina', 'SalaT.jpg', 4),
(8, 'Sala de reunião', '10', 'Segundo piso', 'SalaR.jpg', 4),
(9, 'Sala de atendimento', '5', 'Ao lado do RH', 'SalaA.jpg', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `lc_period`
--
-- Criação: 20/03/2024 às 13:55
-- Última atualização: 22/03/2024 às 11:53
--

DROP TABLE IF EXISTS `lc_period`;
CREATE TABLE `lc_period` (
  `lc_period_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `equip_id` int(11) DEFAULT NULL,
  `mensagens_id` int(11) NOT NULL,
  `weekday` varchar(24) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `checkin_time` time NOT NULL,
  `checkout_time` time NOT NULL,
  `approver_id` int(11) DEFAULT NULL,
  `gp_approver_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `lc_period`:
--   `users_id`
--       `users` -> `users_id`
--   `room_id`
--       `laboratorios` -> `room_id`
--   `vehicle_id`
--       `vehicles` -> `vehicle_id`
--   `equip_id`
--       `equipment` -> `equip_id`
--   `mensagens_id`
--       `mensagens` -> `mensagens_id`
--   `approver_id`
--       `approver` -> `approver_id`
--

--
-- Despejando dados para a tabela `lc_period`
--

INSERT INTO `lc_period` (`lc_period_id`, `users_id`, `room_id`, `vehicle_id`, `equip_id`, `mensagens_id`, `weekday`, `checkin`, `checkout`, `checkin_time`, `checkout_time`, `approver_id`, `gp_approver_id`) VALUES
(3, 20, NULL, 8, NULL, 3, 'Saturday', '2024-03-16', '2024-09-07', '00:01:00', '23:59:00', 2, NULL),
(4, 20, NULL, 8, NULL, 3, 'Sunday', '2024-03-17', '2024-09-08', '00:01:00', '23:59:00', 2, NULL),
(5, 28, 7, NULL, NULL, 37, 'AllDays', '2024-04-17', '2024-04-19', '08:00:00', '18:00:00', 4, 20),
(6, 37, NULL, 2, NULL, 3, 'AllDays', '2024-03-21', '2024-03-25', '18:00:00', '08:00:00', 2, 22),
(10, 11, NULL, 5, NULL, 38, 'AllDays', '2024-03-21', '2024-03-22', '18:00:00', '08:00:00', 2, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `locacao`
--
-- Criação: 19/03/2024 às 11:59
-- Última atualização: 22/03/2024 às 11:53
--

DROP TABLE IF EXISTS `locacao`;
CREATE TABLE `locacao` (
  `locacao_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `equip_id` int(11) DEFAULT NULL,
  `mensagens_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `checkin` date NOT NULL,
  `checkin_time` time NOT NULL,
  `checkout_time` time NOT NULL,
  `approver_id` int(11) DEFAULT NULL,
  `gp_approver_id` int(11) DEFAULT NULL,
  `lc_period_id` int(11) DEFAULT NULL,
  `eventInfo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- RELACIONAMENTOS PARA TABELAS `locacao`:
--   `users_id`
--       `users` -> `users_id`
--   `gp_approver_id`
--       `gp_approver` -> `gp_approver_id`
--   `room_id`
--       `laboratorios` -> `room_id`
--   `status_id`
--       `status` -> `status_id`
--   `mensagens_id`
--       `mensagens` -> `mensagens_id`
--   `vehicle_id`
--       `vehicles` -> `vehicle_id`
--   `equip_id`
--       `equipment` -> `equip_id`
--   `approver_id`
--       `approver` -> `approver_id`
--   `lc_period_id`
--       `lc_period` -> `lc_period_id`
--

--
-- Despejando dados para a tabela `locacao`
--

INSERT INTO `locacao` (`locacao_id`, `users_id`, `room_id`, `vehicle_id`, `equip_id`, `mensagens_id`, `status_id`, `checkin`, `checkin_time`, `checkout_time`, `approver_id`, `gp_approver_id`, `lc_period_id`, `eventInfo`) VALUES
(1, 34, NULL, 5, NULL, 4, 4, '2024-03-01', '16:12:00', '16:30:00', 4, 1, NULL, NULL),
(2, 34, NULL, 5, NULL, 4, 4, '2024-03-13', '10:00:00', '11:00:00', 2, 1, NULL, NULL),
(3, 34, 8, NULL, NULL, 4, 4, '2024-03-14', '11:00:00', '16:00:00', 4, 1, NULL, NULL),
(4, 34, NULL, 5, NULL, 4, 4, '2024-03-13', '16:00:00', '17:00:00', 2, 20, NULL, NULL),
(5, 34, NULL, 5, NULL, 4, 4, '2024-03-15', '13:00:00', '14:00:00', 2, 25, NULL, NULL),
(212, 20, NULL, 8, NULL, 4, 4, '2024-03-16', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(213, 20, NULL, 8, NULL, 3, 2, '2024-03-23', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(214, 20, NULL, 8, NULL, 3, 2, '2024-03-30', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(215, 20, NULL, 8, NULL, 3, 2, '2024-04-06', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(216, 20, NULL, 8, NULL, 3, 2, '2024-04-13', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(217, 20, NULL, 8, NULL, 3, 2, '2024-04-20', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(218, 20, NULL, 8, NULL, 3, 2, '2024-04-27', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(219, 20, NULL, 8, NULL, 3, 2, '2024-05-04', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(220, 20, NULL, 8, NULL, 3, 2, '2024-05-11', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(221, 20, NULL, 8, NULL, 3, 2, '2024-05-18', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(222, 20, NULL, 8, NULL, 3, 2, '2024-05-25', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(223, 20, NULL, 8, NULL, 3, 2, '2024-06-01', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(224, 20, NULL, 8, NULL, 3, 2, '2024-06-08', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(225, 20, NULL, 8, NULL, 3, 2, '2024-06-15', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(226, 20, NULL, 8, NULL, 3, 2, '2024-06-22', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(227, 20, NULL, 8, NULL, 3, 2, '2024-06-29', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(228, 20, NULL, 8, NULL, 3, 2, '2024-07-06', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(229, 20, NULL, 8, NULL, 3, 2, '2024-07-13', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(230, 20, NULL, 8, NULL, 3, 2, '2024-07-20', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(231, 20, NULL, 8, NULL, 3, 2, '2024-07-27', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(232, 20, NULL, 8, NULL, 3, 2, '2024-08-03', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(233, 20, NULL, 8, NULL, 3, 2, '2024-08-10', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(234, 20, NULL, 8, NULL, 3, 2, '2024-08-17', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(235, 20, NULL, 8, NULL, 3, 2, '2024-08-24', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(236, 20, NULL, 8, NULL, 3, 2, '2024-08-31', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(237, 20, NULL, 8, NULL, 3, 2, '2024-09-07', '00:01:00', '23:59:00', 2, 1, 3, NULL),
(238, 34, 8, NULL, NULL, 4, 4, '2024-03-19', '14:00:00', '17:00:00', 4, 25, NULL, NULL),
(239, 20, NULL, 8, NULL, 4, 4, '2024-03-17', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(240, 20, NULL, 8, NULL, 3, 2, '2024-03-24', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(241, 20, NULL, 8, NULL, 3, 2, '2024-03-31', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(242, 20, NULL, 8, NULL, 3, 2, '2024-04-07', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(243, 20, NULL, 8, NULL, 3, 2, '2024-04-14', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(244, 20, NULL, 8, NULL, 3, 2, '2024-04-21', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(245, 20, NULL, 8, NULL, 3, 2, '2024-04-28', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(246, 20, NULL, 8, NULL, 3, 2, '2024-05-05', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(247, 20, NULL, 8, NULL, 3, 2, '2024-05-12', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(248, 20, NULL, 8, NULL, 3, 2, '2024-05-19', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(249, 20, NULL, 8, NULL, 3, 2, '2024-05-26', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(250, 20, NULL, 8, NULL, 3, 2, '2024-06-02', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(251, 20, NULL, 8, NULL, 3, 2, '2024-06-09', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(252, 20, NULL, 8, NULL, 3, 2, '2024-06-16', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(253, 20, NULL, 8, NULL, 3, 2, '2024-06-23', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(254, 20, NULL, 8, NULL, 3, 2, '2024-06-30', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(255, 20, NULL, 8, NULL, 3, 2, '2024-07-07', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(256, 20, NULL, 8, NULL, 3, 2, '2024-07-14', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(257, 20, NULL, 8, NULL, 3, 2, '2024-07-21', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(258, 20, NULL, 8, NULL, 3, 2, '2024-07-28', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(259, 20, NULL, 8, NULL, 3, 2, '2024-08-04', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(260, 20, NULL, 8, NULL, 3, 2, '2024-08-11', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(261, 20, NULL, 8, NULL, 3, 2, '2024-08-18', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(262, 20, NULL, 8, NULL, 3, 2, '2024-08-25', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(263, 20, NULL, 8, NULL, 3, 2, '2024-09-01', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(264, 20, NULL, 8, NULL, 3, 2, '2024-09-08', '00:01:00', '23:59:00', 2, 1, 4, NULL),
(265, 260, NULL, 2, NULL, 3, 2, '2024-03-25', '09:30:00', '19:00:00', 2, 25, NULL, NULL),
(267, 260, NULL, 2, NULL, 3, 2, '2024-04-03', '09:00:00', '18:30:00', 2, 22, NULL, NULL),
(268, 260, NULL, 2, NULL, 3, 2, '2024-04-10', '09:30:00', '19:00:00', 2, 22, NULL, NULL),
(269, 260, NULL, 2, NULL, 3, 2, '2024-05-08', '09:00:00', '19:00:00', 2, 22, NULL, NULL),
(270, 260, NULL, 2, NULL, 3, 2, '2024-05-23', '09:00:00', '19:00:00', 2, 22, NULL, NULL),
(271, 260, NULL, 2, NULL, 3, 2, '2024-06-11', '08:00:00', '19:00:00', 2, 22, NULL, NULL),
(272, 28, 7, NULL, NULL, 3, 2, '2024-04-01', '08:00:00', '18:00:00', 4, 20, NULL, NULL),
(273, 260, NULL, 2, NULL, 3, 2, '2024-06-19', '09:30:00', '15:00:00', 2, 22, NULL, NULL),
(274, 28, 7, NULL, NULL, 3, 2, '2024-04-02', '13:00:00', '18:00:00', 4, 20, NULL, NULL),
(275, 28, 7, NULL, NULL, 3, 2, '2024-04-03', '08:00:00', '18:00:00', 4, 20, NULL, NULL),
(276, 28, 7, NULL, NULL, 3, 2, '2024-04-04', '08:00:00', '18:00:00', 4, 20, NULL, NULL),
(277, 28, 7, NULL, NULL, 3, 2, '2024-04-05', '08:00:00', '18:00:00', 4, 20, NULL, NULL),
(278, 28, 7, NULL, NULL, 3, 2, '2024-04-15', '08:00:00', '18:00:00', 4, 20, NULL, NULL),
(279, 260, NULL, 2, NULL, 3, 2, '2024-07-01', '08:00:00', '19:00:00', 2, 22, NULL, NULL),
(280, 28, 7, NULL, NULL, 3, 2, '2024-04-16', '13:00:00', '18:00:00', 4, 20, NULL, NULL),
(281, 28, 7, NULL, NULL, 2, 1, '2024-04-17', '08:00:00', '18:00:00', 4, 20, 5, NULL),
(282, 28, 7, NULL, NULL, 2, 1, '2024-04-18', '08:00:00', '18:00:00', 4, 20, 5, NULL),
(283, 28, 7, NULL, NULL, 2, 1, '2024-04-19', '08:00:00', '18:00:00', 4, 20, 5, NULL),
(284, 260, NULL, 2, NULL, 3, 2, '2024-09-03', '08:00:00', '19:00:00', 2, 22, NULL, NULL),
(285, 260, NULL, 2, NULL, 3, 2, '2024-09-05', '13:00:00', '18:00:00', 2, 22, NULL, NULL),
(286, 37, NULL, 2, NULL, 4, 4, '2024-03-21', '18:00:00', '23:59:00', 2, 22, 6, NULL),
(288, 37, NULL, 2, NULL, 3, 2, '2024-03-22', '00:00:00', '23:59:00', 2, 22, 6, NULL),
(290, 37, NULL, 2, NULL, 3, 2, '2024-03-23', '00:00:00', '23:59:00', 2, 22, 6, NULL),
(292, 37, NULL, 2, NULL, 3, 2, '2024-03-24', '00:00:00', '23:59:00', 2, 22, 6, NULL),
(293, 37, NULL, 2, NULL, 3, 2, '2024-03-25', '00:00:00', '08:00:00', 2, 22, 6, NULL),
(294, 28, 9, NULL, NULL, 4, 4, '2024-03-20', '17:00:00', '18:00:00', 4, 20, NULL, NULL),
(299, 11, NULL, 5, NULL, 4, 4, '2024-03-21', '18:00:00', '23:59:00', 2, 22, 10, NULL),
(302, 11, NULL, 5, NULL, 4, 4, '2024-03-22', '00:00:00', '08:00:00', 2, 22, 10, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `login_attempts`
--
-- Criação: 26/02/2024 às 17:42
-- Última atualização: 22/03/2024 às 15:24
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `attempt_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `login_attempts`:
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens`
--
-- Criação: 19/01/2024 às 17:34
--

DROP TABLE IF EXISTS `mensagens`;
CREATE TABLE `mensagens` (
  `mensagens_id` int(11) NOT NULL,
  `assunto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `mensagens`:
--

--
-- Despejando dados para a tabela `mensagens`
--

INSERT INTO `mensagens` (`mensagens_id`, `assunto`) VALUES
(1, 'Usuário Inserido com sucesso!'),
(2, 'Solicitações pendentes!'),
(3, 'Reserva realizada!'),
(4, 'Reserva finalizada!!'),
(5, 'Sala inserida com sucesso!'),
(6, 'Usuário editado com sucesso!'),
(7, 'Sala editada com sucesso!'),
(8, 'Pendências excluídas!'),
(9, 'Usuário excluído com sucesso!'),
(10, 'Sala excluída com sucesso!'),
(11, 'Sua reserva foi aprovada!'),
(12, 'Sua reserva por período foi aprovada!'),
(26, 'Senha alterada!'),
(27, 'Senha alterada!'),
(28, 'Seus dados foram alterados!'),
(29, 'Veículo inserido!'),
(30, 'Veículo editado!'),
(31, 'Veículo excluído!'),
(32, 'Equipamento inserído!'),
(33, 'Equipamento excluído!'),
(34, 'Equipamento editado!'),
(35, 'Aprovador inserido!'),
(36, 'Aprovador removido!'),
(37, 'Reserva Por Período Pendente!'),
(38, 'Reserva atrasada!');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pwdtemp`
--
-- Criação: 26/02/2024 às 17:42
-- Última atualização: 22/03/2024 às 15:24
--

DROP TABLE IF EXISTS `pwdtemp`;
CREATE TABLE `pwdtemp` (
  `pwd_temp` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `email` varchar(26) NOT NULL,
  `codigo` varchar(26) NOT NULL,
  `timestp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `pwdtemp`:
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `set_color`
--
-- Criação: 19/01/2024 às 17:34
-- Última atualização: 22/03/2024 às 17:18
--

DROP TABLE IF EXISTS `set_color`;
CREATE TABLE `set_color` (
  `color_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `colorMode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `set_color`:
--

--
-- Despejando dados para a tabela `set_color`
--

INSERT INTO `set_color` (`color_id`, `users_id`, `colorMode`) VALUES
(1, 1, 1),
(2, 11, 1),
(3, 15, 0),
(4, 17, 0),
(5, 19, 1),
(6, 37, 0),
(7, 199, 1),
(8, 216, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `status`
--
-- Criação: 19/01/2024 às 17:34
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `status`:
--

--
-- Despejando dados para a tabela `status`
--

INSERT INTO `status` (`status_id`, `status`) VALUES
(1, 'Pendente'),
(2, 'Reservado'),
(3, 'Disponível'),
(4, 'Finalizado'),
(5, 'Ativo'),
(6, 'Inativo'),
(7, 'Não atribuído'),
(8, 'Atrasado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--
-- Criação: 18/03/2024 às 17:26
-- Última atualização: 22/03/2024 às 19:08
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `funcao` varchar(24) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contactno` varchar(13) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `password` varchar(60) NOT NULL,
  `status` int(11) NOT NULL,
  `first_lg` int(11) DEFAULT NULL,
  `gp_approver_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- RELACIONAMENTOS PARA TABELAS `users`:
--   `status`
--       `status` -> `status_id`
--

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`users_id`, `firstname`, `lastname`, `funcao`, `email`, `contactno`, `cpf`, `password`, `status`, `first_lg`, `gp_approver_id`) VALUES
(1, 'Guilherme', 'Machancoses', 'Administrador', 'guilherme.machancoses@gmail.com', '19981955602', '37565229890', '$2y$10$66eHdkOzwwc19gcvocbhzeG.yokwfslcMbVsG898D5w6nWY2h8d32', 5, 1, 22),
(11, 'Bruno', 'Rissio', 'Administrador', 'brunorissio@garbuio.com.br', '19997253656', '35152066807', '$2y$10$BfPVm0rDPh6HP/T2z28nhO3v.PcnlJCzPTtZ0tni73Xeu0bdAvJQS', 5, 1, 22),
(15, 'Orlando', 'Bagni', 'Aprovador', 'bagnijr@garbuio.com.br', '19997293396', '02787764851', '$2y$10$8N.N6x3EFQBMT9x/hzl8zepLDpUyqD7zxMllQZSE0fk1oJ8VX00/W', 5, 1, 22),
(16, 'Cesar', 'Monção', 'Aprovador', 'cesarmoncao@garbuio.com.br', '19998068077', '28643048801', '$2y$10$tGM4gYhCGa44.2NpJPY5UeRn.lfHQcxqgv5wO0ERXxu/njIaD3vIC', 5, NULL, 23),
(17, 'Fernanda', 'Rochel', 'Aprovador', 'fernandarochel@garbuio.com.br', '19981971509', '46074888876', '$2y$10$YymbWNDKbyO5ZSaHacLx7.8hkT7BXmUQxiGEH9XAIIbIxHbrJUrO6', 5, 1, 23),
(18, 'Janaina', 'Campos', 'Aprovador', 'janainacampos@garbuio.com.br', '19997411896', '34352409898', '$2y$10$z7dExg5ujcKxdqwkj1pJXuy8g9QQ2WS6P1brQt1LHGvNI059R1bIC', 5, 1, 20),
(19, 'Lucas', 'Barros', 'Coordenador', 'guilhermemachancoses@garbuio.com.br', '19992630596', '39824231803', '$2y$10$E71D45A4ssb0pdldsPcQL.SOkTLNEWUNob8pEFCoyY0ipc64AgyOO', 5, 1, 1),
(20, 'Frederico', 'Garbuio', 'Coordenador', 'frederico@garbuio.com.br', '19996064566', '30815669836', '$2y$10$XjksqWhppVBpI2ym6l9uvepxfMrxMjp0/4jLw5JaYcR6vwdcHFcoS', 5, 1, 25),
(21, 'Karina', 'Oliveira', 'Usuário', 'karina@garbuio.com.br', '19995662889', '30629984824', '$2y$10$ScVsEATp7FP1XRM1U4CBzOJ5KCWlqiAi9ES9QRmwVwXDC6/ZZXpPO', 5, 0, 22),
(22, 'Rodnei', 'Pereira', 'Usuário', 'rodnei@garbuio.com.br', '19994975749', '22422262821', '$2y$10$0eBibplW./AEXKOt59l1fu1vKeu/Nev4cINVSiMkmtmlJD5NT8xpm', 5, 0, 22),
(23, 'Mariana', 'Silva', 'Usuário', 'marianasilva@garbuio.com.br', '19996773181', '28810366867', '$2y$10$W9kIgeN7J2bZ4DjjnCrD2ufxvn/zF57OQVpstiCwBbJ.HsN4cxL/y', 5, 0, 22),
(24, 'Verônica', 'Lima', 'Usuário', 'veronicalima@garbuio.com.br', '19971419564', '37088509806', '$2y$10$k8r2La0RwUILSNV0bgs05.Y2bjM2SwkYaH0guhT/UO0hfW4zh7wbC', 5, 0, 20),
(25, 'Enrico', 'Garcia', 'Usuário', 'enricogarcia@garbuio.com.br', '19998017444', '5450217288', '$2y$10$7qbMi/Sjwh6UHFUcOXFKT.mneIoVty.2sh78sfzjtcaHCsr1NQVsG', 5, 0, 21),
(26, 'Diogo', 'Pereira', 'Usuário', 'diogopereira@garbuio.com.br', '19996010217', '34650917875', '$2y$10$LU0d4ZVQWDPkG/XQ6CPqNusgMJgB7nXIYpqdXSHiDNn5kAxKr3tVm', 5, 0, 22),
(27, 'Gilberto', 'Damas', 'Usuário', 'gilberto@garbuio.com.br', '19991939037', '44209592900', '$2y$10$REkzl7sQqzfFf3aC8RwXPOo6.AQWmi3K2nHwco9O3Mo3T4wqG/MtS', 5, 0, 20),
(28, 'Narciane', 'Souza', 'Usuário', 'narcianesouza@garbuio.com.br', '19997870204', '69909814153', '$2y$10$W1gJydGU3/dpHdw2BzPO3uhCFl99ZFXmkxzJGozDko2K8ILrlPm1W', 5, 0, 20),
(29, 'Geraldo', 'Silva', 'Usuário', 'faturamento@garbuio.com.br', '19981917763', '05540322444', '$2y$10$w8o9izvYFg5Dq4iDbLwmgu6LKIs1MumK6EffFE463YaUbjYgaPfry', 5, 0, 22),
(30, 'Rafael', 'Lopes', 'Aprovador', 'rafaellopes@garbuio.com.br', '19994889292', '33717344803', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 21),
(31, 'Ana', 'Ortigoza', 'Usuário', 'anaortigoza@garbuio.com.br', '19983149657', '43085074805', '$2y$10$Kr4XD/4Mcv0ci8aSKTcqyuevSFXP8Me.Oy3OtUJSwr/BAGGIkOseq', 5, 0, 21),
(32, 'Mario', 'Viana', 'Usuário', 'marioviana@garbuio.com.br', '19987151852', '35632906876', '$2y$10$p5SND2nfTYfzb..oYPLG8udmw5R00pChOBZmVnLud7xWnHJCVoahO', 5, 0, 21),
(33, 'Julia', 'Fontana', 'Usuário', 'juliafontana@garbuio.com.br', '19992928570', '41667471856', '$2y$10$/0FhSwUNa2CgLRuCSwsXyOp6wbxWdx/5UeXbiFgJvXu0RBLMD/Yjm', 5, 0, 21),
(34, 'Marina', 'Montesso', 'Usuário', 'marinamontesso@garbuio.com.br', '19996283502', '48062462803', '$2y$10$s511Qo.Y5g6k.pH6mNT3HeupuXdOS255MY6JJFFLQam3E54FrtQrm', 5, 1, 22),
(35, 'Daniel', 'Velasco', 'Usuário', 'danielvelasco@garbuio.com.br', '19983470141', '05164523710', '$2y$10$OtVPNJ/a5xGaC/HQzRCR.OmXhQsDDomZUpfd.mgIrqGPYAdv/J6Ce', 5, 0, 25),
(36, 'Luiz', 'Bordinhão', 'Aprovador', 'luiz@garbuio.com.br', '19997674718', '42036744842', '$2y$10$6cW9TOY3wc3f40D4wZaRvu8TzePSX2HrG1Dts8cPCqvY4Q0P6udEW', 5, 0, 26),
(37, 'Luis', 'Oliveira', 'Usuário', 'luisoliveira@garbuio.com.br', '19997710389', '03023275173', '$2y$10$WqUl5KLzY.A6Ugtzcn/DI.X739A8FN7ylnPewOd8PMIhNxwQoFmuy', 5, 1, 29),
(39, 'Adilson', 'Mendes', 'Usuário', 'adilsonmendes@garbuio.com.br', '1921145000', '06410376510', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 30),
(40, 'Adriano', 'Santana', 'Usuário', 'adrianosantana@garbuio.com.br', '1921145000', '31207067873', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(41, 'Adriano', 'Bessa', 'Usuário', 'adrianobessa@garbuio.com.br', '1921145000', '19628047809', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 0),
(42, 'Alan', 'Santos', 'Usuário', 'alansantos@garbuio.com.br', '1921145000', '31207160814', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 27),
(43, 'ALCI', 'SANTOS', 'Usuário', 'alcisantos@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(44, 'ALDINEY', 'SILVA', 'Usuário', '', '1921145000', '88257738468', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(45, 'ALEXANDRE', 'OLIVEIRA', 'Usuário', 'alexandreoliveira@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 26),
(46, 'ALEXSANDRO', 'NASCIMENTO', 'Usuário', '', '1921145000', '09063541457', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(47, 'ALLAF', 'TORRECILHA', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(48, 'Ana', 'Lacerda', 'Usuário', 'analacerda@garbuio.com.br', '1921145000', '00417760620', '$2y$10$DMHjlVVkfcX5qKTy.Q2ZM.HhJfQn8Gw7eKryM/7duRYb1ZPNQDz0O', 5, NULL, 28),
(49, 'ANDERSON', 'OLIVEIRA', 'Usuário', '', '1921145000', '34021638881', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 27),
(50, 'ANDERSON', 'ROQUE', 'Usuário', 'andersonroque@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(51, 'ANDERSON', 'SPANHOLO', 'Usuário', 'andersonspanholo@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(52, 'ANDERSON', 'TOGNATTO', 'Usuário', 'andersonferreira@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(53, 'ANDRE', 'FILHO', 'Usuário', '', '1921145000', '35230433876', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(54, 'Andre', 'Lossolli', 'Usuário', 'andrelossoli@garbuio.com.br', '1921145000', '06759065808', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 29),
(55, 'Andre', 'Oliveira', 'Usuário', 'andreoliveira@garbuio.com.br', '1921145000', '52364644801', '$2y$10$7jHNmZwCWFF8IwNdTgYbmuBWIjDrofapbdDJ0qwMtOWbwEmPbWzcy', 5, 0, 25),
(56, 'Andre', 'Candido', 'Usuário', 'andrecandido@garbuio.com.br', '1921145000', '38835132886', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(57, 'Anna', 'Pinheiro', 'Usuário', 'annapinheiro@garbuio.com.br', '1921145000', '14184055664', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 29),
(58, 'ANTONIO', 'SANTOS', 'Usuário', '', '1921145000', '15003322755', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(59, 'Antonio', 'Araujo', 'Usuário', 'antonioaraujo@garbuio.com.br', '1921145000', '80988113520', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 0),
(60, 'ANTONIO', 'SILVA', 'Usuário', '', '1921145000', '24878720808', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(61, 'APARECIDO', 'SILVA', 'Usuário', '', '1921145000', '00279530846', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(62, 'ARILSON', 'SILVA', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 27),
(63, 'ARNALDO', 'FERNANDES', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(64, 'Arthur', 'Mello', 'Usuário', 'arthurmello@garbuio.com.br', '1921145000', '30876429835', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(65, 'BEATRIZ', 'SANTOS', 'Usuário', 'beatrizvargas@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 29),
(66, 'Beatryz', 'Santos', 'Usuário', 'beatryzsantos@garbuio.com.br', '1921145000', '52722047861', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 29),
(67, 'BELCHIOR', 'VIANA', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(68, 'Bianca', 'Cruz', 'Usuário', 'analistaslp@garbuio.com.br', '1921145000', '35634201810', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 0),
(69, 'Braian', 'Zamoro', 'Usuário', 'braianzamoro@garbuio.com.br', '1921145000', '46286955801', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 31),
(70, 'Breno', 'Oliveira', 'Usuário', 'brenooliveira@garbuio.com.br', '1921145000', '70823339190', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(71, 'Bruno', 'Souza', 'Usuário', 'analistaslp@garbuio.com.br', '1921145000', '43937064800', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 0),
(72, 'Camila', 'Carvalho', 'Usuário', 'camilacarvalho@garbuio.com.br', '1921145000', '30490736831', '$2y$10$2KbcFRZsbqDicrblw0RCoeDIe5cwnforgQ0GyKshd22Eo5jbK3Gf6', 5, 0, 22),
(73, 'Carlos', 'Lossolli', 'Usuário', 'carloslossolli@garbuio.com.br', '1921145000', '06758874885', '$2y$10$weryu6buub0EIVGLw6U.T.nQNKYmsfJMRAOzjcX7XEDbzdFYAqDaW', 5, 0, 22),
(74, 'CARLOS', 'SANTOS', 'Usuário', '', '1921145000', '27589457892', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(75, 'Carlos', 'Correa', 'Usuário', 'analistaslp@garbuio.com.br', '1921145000', '33607355878', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 0),
(76, 'CARLOS', 'SILVA', 'Usuário', '', '1921145000', '88455750634', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(77, 'CELSO', 'SANTANA', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(78, 'Cesar', 'Macedo', 'Usuário', 'cte@garbuio.com.br', '1921145000', '39566965818', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, 0, 29),
(79, 'CLAUDELEI', 'SILVA', 'Usuário', 'claudeleisilva@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(80, 'CLAUDIO', 'SPANHOLO', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(81, 'CLAUDIO', 'AFASTADO', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(82, 'CLOVIS', 'GENTINA', 'Usuário', 'clovisgentina@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 29),
(83, 'DAIANE', 'VAZ', 'Usuário', 'daianesantolia@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 29),
(84, 'DANIEL', 'SA', 'Usuário', '', '1921145000', '44274764818', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(85, 'DANIEL', 'CARNEIRO', 'Usuário', '', '1921145000', '05565932432', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(86, 'DANILO', 'SOUSA', 'Usuário', '', '1921145000', '07460297305', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(87, 'Danilo', 'Silva', 'Usuário', 'danilosilva@garbuio.com.br', '1921145000', '36944317800', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(88, 'DANILO', 'SILVA', 'Usuário', 'daniloguerra@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(89, 'Davi', 'Ribeiro', 'Usuário', 'gr@garbuio.com.br', '1921145000', '51843026899', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, 0, 30),
(90, 'David', 'Damaceno', 'Usuário', 'daviddamaceno@garbuio.com.br', '1921145000', '48297133800', '$2y$10$32af5PebD4Fh0d0t6hhGhOlqJG2ZTQ.fVIQW31zjJmS1lWBkOaRwC', 5, 0, 23),
(91, 'Debora', 'Oliveira', 'Usuário', 'deboraoliveira@garbuio.com.br', '1921145000', '40515236837', '$2y$10$NSR3IaPXwm2dbU2f7yp0M.jo1xvxAKPiJJunTCp0EO6L7iyp83/9.', 5, 0, 26),
(92, 'Dejair', 'Silva', 'Usuário', 'dejairsilva@garbuio.com.br', '1921145000', '27143168831', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 31),
(93, 'Ederson', 'Meneguetti', 'Usuário', 'edersonmeneguetti@garbuio.com.br', '1921145000', '07223991976', '$2y$10$XvCvSVLs9uUhGHsuF8gfW.oNsbSJ1S4GUU353KrwS0.KIWaJNDVcS', 5, 0, 23),
(94, 'EDIVALDO', 'SILVA', 'Usuário', '', '1921145000', '34451145449', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(95, 'EDSON', 'SANTOS', 'Usuário', '', '1921145000', '95789200168', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(96, 'EDSON', 'JUNIOR', 'Usuário', 'edsonjunior@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 29),
(97, 'Eduarda', 'Oliveira', 'Usuário', 'eduardaoliveira@garbuio.com.br', '1921145000', '51886171882', '$2y$10$7A0tZAN.cTCuPayzHpO37e2N7BZxyHJQ92fYq1L34G7H0RXnXZUTm', 5, 0, 20),
(98, 'Eduardo', 'Schnoor', 'Usuário', 'gr@garbuio.com.br', '1921145000', '50403337810', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, 0, 30),
(99, 'Elizete', 'Marcelino', 'Usuário', 'elizetemarcelino@garbuio.com.br', '1921145000', '22323494899', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 29),
(100, 'Emily', 'Benatto', 'Usuário', 'emilybenatto@garbuio.com.br', '1921145000', '51057102822', '$2y$10$/YFkGhiDBf0ihiQBym.bg.8zWJE4XlUfu3fFY/52IuVam2cxCXtJK', 5, 0, 25),
(101, 'FABIANO', 'PACHECO', 'Usuário', '', '1921145000', '00379988119', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(102, 'FABIO', '(SOLDA)', 'Usuário', '', '1921145000', '31026909805', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(103, 'Fabio', 'Tanjoni', 'Usuário', 'fabiotanjoni@garbuio.com.br', '1921145000', '29875082805', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 30),
(104, 'FABIO', 'PACAGNELLA', 'Usuário', 'fabiopacagnella@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 23),
(105, 'Fabiola', 'Lima', 'Usuário', 'fabiolaamaral@garbuio.com.br', '1921145000', '00439047188', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(106, 'Fabricio', 'Ribeiro', 'Usuário', 'fabricioribeiro@garbuio.com.br', '1921145000', '40859243893', '$2y$10$CJFLcXiT7FE6U1etOriaAOUrwisVfkycBaK49v3Tfe3C/XzlJMtGa', 5, 0, 25),
(107, 'FELIPE', 'NASCIMENTO', 'Usuário', '', '1921145000', '01733233598', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(108, 'Felipe', 'Martins', 'Usuário', 'felipemartins@garbuio.com.br', '1921145000', '41992734844', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 27),
(109, 'FELIPE', 'FERRARI', 'Usuário', 'cte@garbuio.com.br', '1921145000', '40848235894', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 29),
(110, 'FERNANDO', 'CERQUEIRA', 'Usuário', '', '1921145000', '70413854183', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(111, 'FRANCISCO', 'OLIVEIRA', 'Usuário', 'francisco@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 25),
(112, 'FRANCISCO', 'SOUSA', 'Usuário', '', '1921145000', '82797030206', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(113, 'GABRIEL', 'SILVA', 'Usuário', 'gabrielsilva@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 27),
(114, 'Gabriel', 'Bueno', 'Usuário', 'gabrielbueno@garbuio.com.br', '1921145000', '45795500801', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(115, 'Gabriel', 'Correia', 'Usuário', 'gabrielcorreia@garbuio.com.br', '1921145000', '44170583850', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(116, 'Gabriel', 'Gazzin', 'Usuário', 'gabrielgazzin@garbuio.com.br', '1921145000', '48822643828', '$2y$10$TReizAROti7CNKWkhlS6YubHZYrOIGYz3gQR2dzl5ukQWkvDer98e', 5, 0, 25),
(117, 'GABRIELA', 'SANTOS', 'Usuário', 'aprendizcr@garbuio.com.br', '1921145000', '48952228880', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 29),
(118, 'Gabriela', 'Lemos', 'Usuário', 'gabrielalemos@garbuio.com.br', '1921145000', '42793799807', '$2y$10$qyzvyA7pRSDSlwe6VOcQh.hla7JM8eI.JW44FRgdbxC/oml/o7U7C', 5, 0, 20),
(119, 'GABRIELE', 'SANTOS', 'Usuário', 'gr@garbuio.com.br', '1921145000', '45308347867', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(120, 'Gabrielly', 'Silva', 'Usuário', 'gabriellysilva@garbuio.com.br', '1921145000', '50181563843', '$2y$10$QUblj2ru2g4a4Hms5Hn.O.UsHyvBCYBeKGIXov6.fiXed2XeJQa3i', 5, 0, 22),
(121, 'Gedriel', 'Silva', 'Usuário', 'gedrielsilva@garbuio.com.br', '1921145000', '00246828536', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 31),
(122, 'Geovane', 'Nascimento', 'Usuário', 'geovanenascimento@garbuio.com.br', '1921145000', '03556045311', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(123, 'GILMAR', 'BENATTO', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(124, 'GISELLE', 'CARVALHO', 'Usuário', 'gisellemoreira@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(125, 'Guilherme', 'Botechia', 'Usuário', 'guilhermebotechia@garbuio.com.br', '1921145000', '45211133897', '$2y$10$oHCpHWNs1a0uFFSX0GUF0.SCCxq8inKcphoi5enQcu/KIiCH./Hdi', 5, 1, 25),
(126, 'GUSTAVO', 'LIMA', 'Usuário', '', '1921145000', '46562763835', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(127, 'HEBSON', 'GOMES', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(128, 'Helder', 'Correia', 'Usuário', 'heldercorreia@garbuio.com.br', '1921145000', '01928461166', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 31),
(129, 'HELIO', 'LIMA', 'Usuário', 'helio@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(130, 'HUGO', 'SILVA', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(131, 'IGOR', 'FIGUEREDO', 'Usuário', 'igorfigueredo@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 31),
(132, 'Ines', 'Vigilato', 'Usuário', 'inesvigilato@garbuio.com.br', '1921145000', '43890039847', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 26),
(133, 'IVAN', 'ZACARIAS', 'Usuário', '', '1921145000', '21266841806', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(134, 'Jacob', 'Filho', 'Usuário', 'jacobqueiroz@garbuio.com.br', '1921145000', '00532516109', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(135, 'JAIR', 'SOUZA', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 27),
(136, 'JEFERSON', 'SOBRINHO', 'Usuário', '', '1921145000', '15489762888', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 31),
(137, 'JEFERSON', 'SANTOS', 'Usuário', '', '1921145000', '41962210847', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 27),
(138, 'Jessika', 'Silva', 'Usuário', 'jessikasilva@garbuio.com.br', '1921145000', '38927227816', '$2y$10$/bgrSawMp/CPvsy.PiERQ.aXEh36YFMvBxekfFY4jxA398DRnzAeW', 5, 0, 20),
(139, 'Jessyca', 'Costa', 'Usuário', 'jessycacosta@garbuio.com.br', '1921145000', '36989089806', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 30),
(140, 'JEZIEL', 'COSTA', 'Usuário', '', '1921145000', '29279484885', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(141, 'JHEMERSON', 'SOARES', 'Usuário', 'gr@garbuio.com.br', '1921145000', '45844352866', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(142, 'JHON', 'BAQUETA', 'Usuário', '', '1921145000', '48031427852', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 27),
(143, 'JOAO', 'ALVES', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(144, 'JOAO', 'JUNIOR', 'Usuário', 'cte@garbuio.com.br', '1921145000', '22586015843', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 29),
(145, 'JOAO', 'PASCHOALINOTO', 'Usuário', '', '1921145000', '46943405810', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(146, 'JOAO', 'FANELLI', 'Usuário', 'gr@garbuio.com.br', '1921145000', '44264510864', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(147, 'João', 'Logarezi', 'Usuário', 'joaocosta@garbuio.com.br', '1921145000', '49106931812', '$2y$10$/Yfz2Nd3Uav0263VlOtbme/DOlxVmwonL2AjFRcagqzrTVLVEyUqy', 5, 0, 22),
(148, 'Joao', 'Oliveira', 'Usuário', 'joaooliveira@garbuio.com.br', '1921145000', '51032454857', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 30),
(149, 'JOELITON', 'FARIAS', 'Usuário', '', '1921145000', '98818791591', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(150, 'JOSE', 'SILVA', 'Usuário', 'gr@garbuio.com.br', '1921145000', '50522588875', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(151, 'JOSE', 'BRINER', 'Usuário', '', '1921145000', '29406345803', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(152, 'JOSE', 'PASCHOALINOTO', 'Usuário', '', '1921145000', '46943371819', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(153, 'JOSE', 'JUNIOR', 'Usuário', '', '1921145000', '38798916807', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(154, 'JOSE', 'SANTOS', 'Usuário', '', '1921145000', '22763249884', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 27),
(155, 'Jose', 'Mancano', 'Usuário', 'josemancano@garbuio.com.br', '1921145000', '45851628871', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(156, 'JOSE', 'SANTOS', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 31),
(157, 'JOSE', 'PAIVA', 'Usuário', '', '1921145000', '78263875404', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(158, 'JOSE', 'MIRANDA', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(159, 'JOSUE', 'PAULA', 'Usuário', '', '1921145000', '08438406688', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(160, 'Julia', 'Vieira', 'Usuário', 'juliavieira@garbuio.com.br', '1921145000', '53624786806', '$2y$10$i6go3h7wl1QPVvPnyjGNdOzhfmoQVUZ9zgU2lGazJHDvPe8lSg.oK', 5, 0, 20),
(161, 'Juliana', 'Donadel', 'Usuário', 'julianadonadel@garbuio.com.br', '1921145000', '32435083807', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 29),
(162, 'JULIO', 'CHINALLI', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(163, 'Karolyne', 'Nunes', 'Usuário', 'karolynenunes@garbuio.com.br', '1921145000', '51701903873', '$2y$10$kiTWcGWV4el9G6pHRidIw..V8rXnBh97WWPBxmSuWccq33yDTguoS', 5, 0, 20),
(164, 'Kethillyn', 'Santos', 'Usuário', 'kethillynsantos@garbuio.com.br', '1921145000', '46448026894', '$2y$10$WpRAFiZihCJBQ5ChgiOdt.w.VBhTMmI2.ekqyQcsnzToT1cFjv60i', 5, 0, 23),
(165, 'Keven', 'Berto', 'Usuário', 'kevenberto@garbuio.com.br', '1921145000', '54142429841', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 29),
(166, 'KLEYTON', 'SILVA', 'Usuário', '', '1921145000', '51695046838', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(167, 'LAZARO', 'SILVA', 'Usuário', 'lazarosilva@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(168, 'Leandro', 'Lopes', 'Usuário', 'leandrolopes@garbuio.com.br', '1921145000', '48320952859', '$2y$10$ORGdtxKIpauMZuErez151egBz9Kh80Qs6s2GaOgZ02QFJnenr5Efq', 5, 0, 22),
(169, 'Leandro', 'Rodrigues', 'Usuário', 'leandrosimoes@garbuio.com.br', '1921145000', '36099133801', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(170, 'Leandro', 'Goncalves', 'Usuário', 'leandrogoncalves@garbuio.com.br', '1921145000', '39096976827', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(171, 'LEONARDO', 'ZACARIAS', 'Usuário', '', '1921145000', '37429908888', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 27),
(172, 'Leonardo', 'Fernandes', 'Usuário', 'leonardofernandes@garbuio.com.br', '1921145000', '41036564843', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 30),
(173, 'LETICIA', 'RODRIGUES', 'Usuário', 'leticiarodrigues@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(174, 'Linsmara', 'Fortunato', 'Usuário', 'linsmarafortunato@garbuio.com.br', '1921145000', '01811773583', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 0),
(175, 'LOREN', 'VOOS', 'Usuário', 'lorenvoos@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 26),
(176, 'Lorena', 'Silva', 'Usuário', 'lorenasilva@garbuio.com.br', '1921145000', '04115878118', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 26),
(177, 'LUANA', 'JORGE', 'Usuário', 'gr@garbuio.com.br', '1921145000', '50151482837', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(178, 'Lucas', 'Capossoli', 'Usuário', 'lucascapossoli@garbuio.com.br', '1921145000', '37867680802', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 29),
(179, 'LUCAS', 'SOUSA', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 27),
(180, 'MANOEL', 'SILVA', 'Usuário', '', '1921145000', '04653361401', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(181, 'MARCELINO', 'SILVA', 'Usuário', '', '1921145000', '11534681825', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(182, 'MARCELO', 'LOSSOLLI', 'Usuário', 'marcelolossolli@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 25),
(183, 'MARCELO', 'BERTOLOTO', 'Usuário', 'gr@garbuio.com.br', '1921145000', '52649383852', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(184, 'MARCELO', 'SANTOS', 'Usuário', 'marcelosantos@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(185, 'MARCIO', 'SILVA', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(186, 'MARCIO', 'FERRAZ', 'Usuário', '', '1921145000', '69122202668', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 31),
(187, 'MARCOS', 'SANTOS', 'Usuário', '', '1921145000', '09546817627', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(188, 'Marcos', 'Roque', 'Usuário', 'marcosroque@garbuio.com.br', '1921145000', '56272502915', '$2y$10$cx4gGeDes/VaK8Ddo4DSc.N/GfR8pI4d.JNOoKH/AJVdEQ2bb/i4y', 5, 0, 26),
(189, 'Marcos', 'Braguim', 'Usuário', 'marcos.braguim@garbuio.com.br', '1921145000', '09879559851', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(190, 'MARIA', 'SANTOS', 'Usuário', '', '1921145000', '01246276500', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 26),
(191, 'MARIO', 'SILVA', 'Usuário', '', '1921145000', '03770352890', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(192, 'MATEUS', 'DORNELAS', 'Usuário', '', '1921145000', '11321306628', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(193, 'MATHEUS', 'BAZUCO', 'Usuário', 'matheusbazuco@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 23),
(194, 'MATHEUS', 'VICENTE', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(195, 'MAURIVAN', 'MOURA', 'Usuário', '', '1921145000', '01870518101', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(196, 'MESSIAS', 'NETO', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(197, 'Michele', 'Fogagnoli', 'Usuário', 'michelefogagnoli@garbuio.com.br', '1921145000', '39711640805', '$2y$10$dWzaOU9srujh.60cEgtjye7AzBahExgdYqUN5AywaH5jGishSrWxy', 5, 0, 23),
(198, 'NAELSON', 'CAMPOS', 'Usuário', '', '1921145000', '06729477814', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(199, 'Natã', 'Souza', 'Usuário', 'natasouza@garbuio.com.br', '1921145000', '46026003878', '$2y$10$xsIHTWCVYOs/qcHk9/dY9eAZnxxmpu/qdzhT7iTOI4ivhbdBHlNf.', 5, 1, 25),
(200, 'Natan', 'Almeida', 'Usuário', 'natanalmeida@garbuio.com.br', '1921145000', '44389351800', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 31),
(201, 'NATHALIA', 'ROCHEL', 'Usuário', 'aprendizcr@garbuio.com.br', '1921145000', '50749760818', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 29),
(202, 'Nathan', 'Silva', 'Usuário', 'nathansilva@garbuio.com.br', '1921145000', '06616193110', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 27),
(203, 'Nicolas', 'Paula', 'Usuário', 'nicolaspaula@garbuio.com.br', '1921145000', '41826195/00010', '$2y$10$Kp5BU34/vfEUR80HXOpjxeA6Nkz/fUxKFQsnO22u6HKEvo0XsyfH6', 5, 1, 23),
(204, 'Nicolas', 'Lossolli', 'Usuário', 'nicolaslossolli@garbuio.com.br', '1921145000', '50952907828', '$2y$10$c7oMMAdaoP6iLNAzEEnWDON2AT8HSLpCh8DjFZoY65lxTnLYIjoYy', 5, 0, 25),
(205, 'PAULO', 'VIEIRA', 'Usuário', '', '1921145000', '33054095843', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(206, 'Pedro', 'Alves', 'Usuário', 'pedroalves@garbuio.com.br', '1921145000', '27485830864', '$2y$10$/E3S1s2jjcLYOSSnL8bGAuxp9M0K70j3fT4RVW2UOf0YKO3hoXpFG', 5, 0, 23),
(207, 'Pedro', 'Henrique', 'Usuário', 'pedrocardoso@garbuio.com.br', '1921145000', '43124393899', '$2y$10$EFa5iHvhWXtcj8eTwR59f.GPwStVn1aIV3EuGaqZeoyxTZNSyDRiK', 5, 0, 20),
(208, 'Pedro', 'Marques', 'Usuário', 'pedromarques@garbuio.com.br', '1921145000', '00595761038', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 30),
(209, 'RAFAEL', 'FERREIRA', 'Usuário', '', '1921145000', '05719901507', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(210, 'Rafael', 'Aita', 'Usuário', 'rafaelaita@garbuio.com.br', '1921145000', '36347800888', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(211, 'Rafael', 'Rodrigues', 'Usuário', 'jornada@garbuio.com.br', '1921145000', '39815019856', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 26),
(212, 'Rafael', 'Santos', 'Usuário', 'rafaelsantos@garbuio.com.br', '1921145000', '40274871840', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(213, 'RAFAELLA', 'SOUZA', 'Usuário', 'gr@garbuio.com.br', '1921145000', '19595895717', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(214, 'RAIMUNDO', 'MEDEIROS', 'Usuário', '', '1921145000', '04396953410', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(215, 'RAPHAEL', 'KNUPP', 'Usuário', '', '1921145000', '35394591890', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(216, 'Raul', 'Francisco', 'Usuário', 'raullopes@garbuio.com.br', '1921145000', '48930812848', '$2y$10$GUHdw/A5W.qHs/hyN/EO4.0cW5m5Wdl2wY8D8VaFMuIDP0bTVu5XK', 5, 1, 30),
(217, 'Rebeca', 'Palmeira', 'Usuário', 'rebecapalmeira@garbuio.com.br', '1921145000', '46876779831', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 29),
(218, 'REINALDO', 'MILANI', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(219, 'REINALDO', 'SANTOS', 'Usuário', '', '1921145000', '02287385550', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(220, 'RENAN', 'RIBEIRO', 'Usuário', 'renanoliveira@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(221, 'RENATO', 'MILANI', 'Usuário', '', '1921145000', '48567001897', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(222, 'RENIVALDO', 'BARBOSA', 'Usuário', '', '1921145000', '98724193534', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(223, 'Rhitiere', 'Machado', 'Usuário', 'rhitieremachado@garbuio.com.br', '1921145000', '46527088825', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 30),
(224, 'RICARDO', 'SANTOS', 'Usuário', '', '1921145000', '31189870819', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 31),
(225, 'RICARDO', 'BERNARDO', 'Usuário', 'ricardobernardo@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(226, 'Ricardo', 'Santos', 'Usuário', 'ricardosantos@garbuio.com.br', '1921145000', '40954767888', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(227, 'RICARDO', 'SOUZA', 'Usuário', '', '1921145000', '31770867880', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 31),
(228, 'Rita', 'Bonfim', 'Usuário', 'ritabonfim@garbuio.com.br', '1921145000', '36932785803', '$2y$10$cbm.j5MQzRNMtnuoyC1BOuXbdyNRao8c.RP4rDz6Wy8.2cqFsyb0S', 5, 0, 22),
(229, 'ROBSON', 'ALMEIDA', 'Usuário', '', '1921145000', '47313987897', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(230, 'RODRIGO', 'PAZ', 'Usuário', '', '1921145000', '35557240888', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(231, 'ROGERIO', 'MORETTI', 'Usuário', '', '1921145000', '48063282191', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(232, 'Rogerio', 'Machado', 'Usuário', 'rogeriomachado@garbuio.com.br', '1921145000', '34363745800', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(233, 'Romildo', 'Silva', 'Usuário', 'romildosilva@garbuio.com.br', '1921145000', '64699978649', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 31),
(234, 'RONALDO', 'VIEIRA', 'Usuário', '', '1921145000', '41563688824', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(235, 'Rosieli', 'Virgens', 'Usuário', 'rosielivirgens@garbuio.com.br', '1921145000', '03885129540', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 31),
(236, 'Rubens', 'Neto', 'Usuário', 'rubensribeiro@garbuio.com.br', '1921145000', '48415704895', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 30),
(237, 'Rud', 'Gimenez', 'Usuário', 'rudgimenez@garbuio.com.br', '1921145000', '32550419880', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(238, 'Rudy', 'Bacchi', 'Usuário', 'rudybacchi@garbuio.com.br', '1921145000', '36162390870', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(239, 'Samuel', 'Silva', 'Usuário', 'samuelramo@garbuio.com.br', '1921145000', '47659986813', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 30),
(240, 'Sara', 'Pinheiro', 'Usuário', 'saranavarro@garbuio.com.br', '1921145000', '49242884898', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 26),
(241, 'Sergio', 'Lopes', 'Usuário', 'sergiolopes@garbuio.com.br', '1921145000', '21973732858', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 30),
(242, 'SHIGUEO', 'TANAMACHI', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(243, 'Silmara', 'Silva', 'Usuário', 'silmarasilva@garbuio.com.br', '1921145000', '22621100856', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 30),
(244, 'SILVIO', 'SANTOS', 'Usuário', '', '1921145000', '82665907887', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(245, 'SUELI', 'PEREIRA', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 26),
(246, 'Thiago', 'Silva', 'Usuário', 'thiagosilva@garbuio.com.br', '1921145000', '27937422874', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 31),
(247, 'THIAGO', 'SOUZA', 'Usuário', '', '1921145000', '48564314800', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(248, 'Tiago', 'Ribeiro', 'Usuário', 'jornada@garbuio.com.br', '1921145000', '52638094846', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 26),
(249, 'Ulisses', 'Neto', 'Usuário', 'ulissesneto@garbuio.com.br', '1921145000', '42036746896', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(250, 'VAGNER', 'SANTOS', 'Usuário', '', '1921145000', '43211033807', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(251, 'VAGNER', 'AMORIS', 'Usuário', '', '1921145000', '65371550100', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(252, 'VALDEMIR', 'CORREA', 'Usuário', '', '1921145000', '12004008873', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(253, 'VALDEMR', 'ALVES', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(254, 'Valter', 'Junior', 'Usuário', 'valterjunior@garbuio.com.br', '1921145000', '44323850816', '$2y$10$VJ8bwUUekIVyQTaReFLHrOUZDRnq/j4mXFtSwhY95Ob7B4vHfff7.', 5, 0, 26),
(255, 'VANDERCI', 'MILANI', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(256, 'VICTOR', 'VIEIRA', 'Usuário', '', '1921145000', '54050799871', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(257, 'VICTOR', 'MACHADO', 'Usuário', 'gr@garbuio.com.br', '1921145000', '46303433855', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(258, 'VINICIUS', 'STRADIOTTO', 'Usuário', 'cte@garbuio.com.br', '1921145000', '50120306808', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 29),
(259, 'Vinicius', 'Silva', 'Usuário', 'viniciussilva@garbuio.com.br', '1921145000', '53063579890', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 30),
(260, 'Virginia', 'Torrezan', 'Usuário', 'virginiatorrezan@garbuio.com.br', '1921145000', '32569398802', '$2y$10$7iMhsY/YaTUoDZrWvBqqw.sq5ocSFan656SJWMFIIZtv9SWtsJzgu', 5, 1, 29),
(261, 'VITOR', 'MILANI', 'Usuário', '', '1921145000', '42533184870', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(262, 'Vitoria', 'Silva', 'Usuário', 'vitoriasilva@garbuio.com.br', '1921145000', '52816927806', '$2y$10$GxqIjvYfn50g477gUgOHq.R4nBg/N6v8klyZbtZqg5KGnMd0.Ixq6', 5, 0, 21),
(263, 'WAGNER', 'GRASSI', 'Usuário', '', '1921145000', '46080532808', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 27),
(264, 'WALACI', 'SANTOS', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 0),
(265, 'WANDERLEY', 'MILANI', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(266, 'WANIELI', 'SILVA', 'Usuário', 'wanielisilva@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 20),
(267, 'WASHILEY', 'CINTRA', 'Usuário', 'washileycintra@garbuio.com.br', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(268, 'WDELSON', 'RODRIGUES', 'Usuário', '', '1921145000', '81508140197', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(269, 'Wesley', 'Michelique', 'Usuário', 'wesleymichelique@garbuio.com.br', '1921145000', '38589733866', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 30),
(270, 'WILLIAM', 'SILVA', 'Usuário', '', '1921145000', '40025434802', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(271, 'Willian', 'Oliveira', 'Usuário', 'wilianoliveira@garbuio.com.br', '1921145000', '39593915877', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 28),
(272, 'WILSON', 'SALGUEIRO', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(273, 'WILSON', 'SANTOS', 'Usuário', '', '1921145000', '08232074558', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(274, 'WILSON', 'FRANCISCO', 'Usuário', '', '1921145000', '', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 28),
(275, 'YANIC', 'JOAO', 'Usuário', 'gr@garbuio.com.br', '1921145000', '23645734830', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 6, NULL, 30),
(276, 'Zacarias', 'Junior', 'Usuário', 'zacariassilva@garbuio.com.br', '1921145000', '92525792149', '$2y$10$0vugl/s/etOFRG1mYa4z0.i.9B83Nk4K3auYy.H1a.imfOY6mdzJ.', 5, 0, 31);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vehicles`
--
-- Criação: 19/01/2024 às 17:34
-- Última atualização: 18/03/2024 às 12:19
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `name` varchar(26) NOT NULL,
  `model` varchar(26) NOT NULL,
  `description` varchar(50) NOT NULL,
  `photo` varchar(24) NOT NULL,
  `approver_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `vehicles`:
--   `approver_id`
--       `approver` -> `approver_id`
--

--
-- Despejando dados para a tabela `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `name`, `model`, `description`, `photo`, `approver_id`) VALUES
(2, 'Virtus', 'Virtus 1.6 MSI MT', 'RNH7J49', '2.jpg', 2),
(5, 'Gol', 'Limeira - Total Flex 1.0', 'EKU2811', '5.jpg', 2),
(7, 'Gol', 'Bauru - Total Flex 1.0', 'EXU6E71', '6.jpeg', 2),
(8, 'F250', 'XLT - Dupla', 'DMD6464', '7.jpg', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`atctive_id`),
  ADD KEY `mensagens_id` (`mensagens_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Índices de tabela `approver`
--
ALTER TABLE `approver`
  ADD PRIMARY KEY (`approver_id`);

--
-- Índices de tabela `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equip_id`),
  ADD KEY `approver_id` (`approver_id`);

--
-- Índices de tabela `gp_approver`
--
ALTER TABLE `gp_approver`
  ADD PRIMARY KEY (`gp_approver_id`),
  ADD KEY `approver_id` (`approver_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Índices de tabela `gr_approved`
--
ALTER TABLE `gr_approved`
  ADD PRIMARY KEY (`gr_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Índices de tabela `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `approver_id` (`approver_id`);

--
-- Índices de tabela `lc_period`
--
ALTER TABLE `lc_period`
  ADD PRIMARY KEY (`lc_period_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `equip_id` (`equip_id`),
  ADD KEY `mensagens_id` (`mensagens_id`),
  ADD KEY `approver_id` (`approver_id`);

--
-- Índices de tabela `locacao`
--
ALTER TABLE `locacao`
  ADD PRIMARY KEY (`locacao_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `mensagens.id` (`mensagens_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `equip_id` (`equip_id`),
  ADD KEY `approver_id` (`approver_id`),
  ADD KEY `lc_period_id` (`lc_period_id`),
  ADD KEY `gp_approver_id` (`gp_approver_id`);

--
-- Índices de tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`mensagens_id`);

--
-- Índices de tabela `pwdtemp`
--
ALTER TABLE `pwdtemp`
  ADD PRIMARY KEY (`pwd_temp`);

--
-- Índices de tabela `set_color`
--
ALTER TABLE `set_color`
  ADD PRIMARY KEY (`color_id`);

--
-- Índices de tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `status` (`status`);

--
-- Índices de tabela `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `approver_id` (`approver_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `activities`
--
ALTER TABLE `activities`
  MODIFY `atctive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT de tabela `approver`
--
ALTER TABLE `approver`
  MODIFY `approver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `gp_approver`
--
ALTER TABLE `gp_approver`
  MODIFY `gp_approver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `gr_approved`
--
ALTER TABLE `gr_approved`
  MODIFY `gr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;

--
-- AUTO_INCREMENT de tabela `laboratorios`
--
ALTER TABLE `laboratorios`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `lc_period`
--
ALTER TABLE `lc_period`
  MODIFY `lc_period_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `locacao`
--
ALTER TABLE `locacao`
  MODIFY `locacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT de tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de tabela `pwdtemp`
--
ALTER TABLE `pwdtemp`
  MODIFY `pwd_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `set_color`
--
ALTER TABLE `set_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT de tabela `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`mensagens_id`) REFERENCES `mensagens` (`mensagens_id`),
  ADD CONSTRAINT `activities_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

--
-- Restrições para tabelas `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`approver_id`) REFERENCES `approver` (`approver_id`);

--
-- Restrições para tabelas `gp_approver`
--
ALTER TABLE `gp_approver`
  ADD CONSTRAINT `gp_approver_ibfk_1` FOREIGN KEY (`approver_id`) REFERENCES `approver` (`approver_id`),
  ADD CONSTRAINT `gp_approver_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

--
-- Restrições para tabelas `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD CONSTRAINT `laboratorios_ibfk_1` FOREIGN KEY (`approver_id`) REFERENCES `approver` (`approver_id`);

--
-- Restrições para tabelas `lc_period`
--
ALTER TABLE `lc_period`
  ADD CONSTRAINT `lc_period_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `lc_period_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `laboratorios` (`room_id`),
  ADD CONSTRAINT `lc_period_ibfk_3` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`),
  ADD CONSTRAINT `lc_period_ibfk_4` FOREIGN KEY (`equip_id`) REFERENCES `equipment` (`equip_id`),
  ADD CONSTRAINT `lc_period_ibfk_5` FOREIGN KEY (`mensagens_id`) REFERENCES `mensagens` (`mensagens_id`),
  ADD CONSTRAINT `lc_period_ibfk_6` FOREIGN KEY (`approver_id`) REFERENCES `approver` (`approver_id`);

--
-- Restrições para tabelas `locacao`
--
ALTER TABLE `locacao`
  ADD CONSTRAINT `locacao_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `locacao_ibfk_10` FOREIGN KEY (`gp_approver_id`) REFERENCES `gp_approver` (`gp_approver_id`),
  ADD CONSTRAINT `locacao_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `laboratorios` (`room_id`),
  ADD CONSTRAINT `locacao_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`),
  ADD CONSTRAINT `locacao_ibfk_5` FOREIGN KEY (`mensagens_id`) REFERENCES `mensagens` (`mensagens_id`),
  ADD CONSTRAINT `locacao_ibfk_6` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`),
  ADD CONSTRAINT `locacao_ibfk_7` FOREIGN KEY (`equip_id`) REFERENCES `equipment` (`equip_id`),
  ADD CONSTRAINT `locacao_ibfk_8` FOREIGN KEY (`approver_id`) REFERENCES `approver` (`approver_id`),
  ADD CONSTRAINT `locacao_ibfk_9` FOREIGN KEY (`lc_period_id`) REFERENCES `lc_period` (`lc_period_id`);

--
-- Restrições para tabelas `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`);

--
-- Restrições para tabelas `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`approver_id`) REFERENCES `approver` (`approver_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
