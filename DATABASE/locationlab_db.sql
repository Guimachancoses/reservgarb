-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/07/2023 às 05:05
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
-- Criação: 14/07/2023 às 20:41
-- Última atualização: 16/07/2023 às 17:44
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
(2, 28, 1, '2023-06-05 13:13:24'),
(3, 1, 1, '2023-06-05 13:23:42'),
(4, 1, 1, '2023-06-05 13:27:17'),
(5, 6, 1, '2023-06-05 13:35:49'),
(6, 1, 1, '2023-06-05 13:41:09'),
(7, 1, 1, '2023-06-05 14:16:49'),
(8, 1, 1, '2023-06-05 14:17:55'),
(9, 5, 1, '2023-06-05 14:18:24'),
(10, 5, 1, '2023-06-05 14:18:53'),
(11, 5, 1, '2023-06-05 14:19:06'),
(12, 5, 1, '2023-06-05 14:19:19'),
(13, 5, 1, '2023-06-05 14:19:35'),
(14, 5, 1, '2023-06-05 14:19:53'),
(15, 1, 1, '2023-06-05 15:07:35'),
(19, 11, NULL, '2023-06-05 15:30:46'),
(21, 11, NULL, '2023-06-05 15:33:09'),
(22, 11, NULL, '2023-06-05 16:19:43'),
(24, 11, NULL, '2023-06-05 16:24:16'),
(25, 13, NULL, '2023-06-05 16:25:05'),
(26, 13, NULL, '2023-06-05 16:25:08'),
(27, 13, NULL, '2023-06-05 16:25:14'),
(28, 13, NULL, '2023-06-05 16:25:20'),
(29, 13, NULL, '2023-06-05 16:25:52'),
(30, 13, NULL, '2023-06-05 16:25:56'),
(31, 13, NULL, '2023-06-05 16:26:12'),
(32, 13, NULL, '2023-06-05 16:26:17'),
(33, 13, NULL, '2023-06-05 16:26:33'),
(41, 7, 1, '2023-06-05 16:37:58'),
(46, 11, NULL, '2023-06-05 16:59:37'),
(49, 11, NULL, '2023-06-05 17:06:37'),
(50, 13, NULL, '2023-06-05 17:07:01'),
(51, 13, NULL, '2023-06-05 17:07:12'),
(86, 4, 1, '2023-06-14 12:18:31'),
(87, 4, 1, '2023-06-14 12:18:31'),
(88, 4, 1, '2023-06-14 12:18:31'),
(89, 4, 1, '2023-06-14 12:18:31'),
(90, 4, 1, '2023-06-14 12:18:31'),
(91, 4, 1, '2023-06-14 12:18:31'),
(92, 4, 1, '2023-06-14 12:18:31'),
(93, 4, 1, '2023-06-14 12:18:31'),
(94, 4, 1, '2023-06-15 12:41:45'),
(95, 4, 1, '2023-06-16 13:25:04'),
(96, 1, 1, '2023-06-16 19:28:31'),
(97, 6, 1, '2023-06-16 19:48:34'),
(98, 9, 1, '2023-06-16 19:58:33'),
(99, 9, 1, '2023-06-16 19:58:40'),
(100, 9, 1, '2023-06-16 19:58:45'),
(101, 9, 1, '2023-06-16 19:59:45'),
(102, 9, 1, '2023-06-16 19:59:48'),
(103, 9, 1, '2023-06-16 19:59:48'),
(104, 9, 1, '2023-06-16 19:59:49'),
(105, 9, 1, '2023-06-16 19:59:50'),
(106, 9, 1, '2023-06-16 20:00:04'),
(107, 9, 1, '2023-06-16 20:00:06'),
(108, 9, 1, '2023-06-16 20:00:07'),
(109, 9, 1, '2023-06-16 20:00:07'),
(110, 9, 1, '2023-06-16 20:00:09'),
(111, 9, 1, '2023-06-16 20:00:11'),
(112, 9, 1, '2023-06-16 20:00:12'),
(113, 9, 1, '2023-06-16 20:00:15'),
(114, 9, 1, '2023-06-16 20:00:15'),
(115, 9, 1, '2023-06-16 20:00:16'),
(116, 9, 1, '2023-06-16 20:00:17'),
(117, 9, 1, '2023-06-16 20:00:45'),
(118, 9, 1, '2023-06-16 20:00:45'),
(119, 9, 1, '2023-06-16 20:00:46'),
(120, 9, 1, '2023-06-16 20:00:47'),
(121, 9, 1, '2023-06-16 20:00:48'),
(122, 9, 1, '2023-06-16 22:25:02'),
(123, 6, 1, '2023-06-16 22:34:02'),
(124, 9, 1, '2023-06-16 22:35:43'),
(125, 9, 1, '2023-06-16 22:35:45'),
(126, 9, 1, '2023-06-16 22:35:46'),
(127, 9, 1, '2023-06-16 22:35:47'),
(128, 9, 1, '2023-06-16 22:35:51'),
(129, 9, 1, '2023-06-16 22:35:52'),
(130, 1, 1, '2023-06-16 23:31:49'),
(131, 9, 1, '2023-06-16 23:35:51'),
(132, 1, 1, '2023-06-16 23:36:46'),
(133, 9, 1, '2023-06-17 00:48:30'),
(134, 1, 1, '2023-06-17 00:49:34'),
(135, 6, 1, '2023-06-17 01:04:33'),
(136, 6, 1, '2023-06-17 01:08:23'),
(137, 9, 1, '2023-06-17 01:45:01'),
(138, 9, 1, '2023-06-17 01:45:03'),
(139, 9, 1, '2023-06-17 01:45:06'),
(140, 9, 1, '2023-06-17 01:45:07'),
(141, 4, 1, '2023-06-17 02:33:59'),
(142, 4, 1, '2023-06-23 13:07:51'),
(143, 6, 1, '2023-06-23 13:09:22'),
(144, 4, 1, '2023-06-29 15:12:24'),
(145, 5, 1, '2023-07-10 19:30:53'),
(146, 5, 1, '2023-07-10 20:44:00'),
(147, 5, 1, '2023-07-10 20:44:53'),
(148, 10, 1, '2023-07-12 17:37:33'),
(149, 10, 1, '2023-07-12 17:37:41'),
(150, 10, 1, '2023-07-12 17:37:55'),
(151, 10, 1, '2023-07-12 17:48:20'),
(152, 10, 1, '2023-07-12 17:48:28'),
(153, 10, 1, '2023-07-12 17:48:33'),
(154, 7, 1, '2023-07-12 18:20:45'),
(155, 29, 1, '2023-07-12 20:35:04'),
(156, 29, 1, '2023-07-12 20:41:27'),
(157, 29, 1, '2023-07-12 20:43:01'),
(158, 29, 1, '2023-07-12 20:45:40'),
(159, 29, 1, '2023-07-12 20:46:28'),
(160, 29, 1, '2023-07-13 15:24:18'),
(161, 31, 1, '2023-07-13 15:37:54'),
(162, 30, 1, '2023-07-13 15:43:03'),
(163, 9, 1, '2023-07-13 17:57:51'),
(164, 6, 1, '2023-07-13 17:59:44'),
(165, 9, 1, '2023-07-13 18:00:51'),
(166, 6, 1, '2023-07-13 18:02:03'),
(167, 6, 1, '2023-07-13 18:02:18'),
(168, 6, 1, '2023-07-13 18:02:37'),
(169, 9, 1, '2023-07-13 18:03:16'),
(170, 9, 1, '2023-07-13 18:03:19'),
(171, 9, 1, '2023-07-13 18:03:21'),
(172, 6, 1, '2023-07-13 18:04:14'),
(173, 9, 1, '2023-07-13 18:04:18'),
(174, 32, 1, '2023-07-13 18:46:07'),
(175, 32, 1, '2023-07-13 18:54:29'),
(176, 30, 1, '2023-07-13 19:47:05'),
(177, 1, 1, '2023-07-13 20:34:11'),
(178, 1, 1, '2023-07-13 20:38:24'),
(179, 2, 1, '2023-07-13 23:53:08'),
(180, 2, 1, '2023-07-14 00:00:36'),
(181, 2, 1, '2023-07-14 00:09:37'),
(182, 2, 1, '2023-07-14 00:17:51'),
(183, 2, 1, '2023-07-14 00:18:35'),
(184, 2, 1, '2023-07-14 00:26:34'),
(185, 2, 1, '2023-07-14 00:28:05'),
(186, 2, 1, '2023-07-14 00:30:23'),
(187, 2, 1, '2023-07-14 00:34:25'),
(188, 2, 1, '2023-07-14 00:38:26'),
(189, 2, 1, '2023-07-14 00:39:45'),
(190, 2, 1, '2023-07-14 00:40:29'),
(191, 2, 1, '2023-07-14 14:55:42'),
(192, 2, 1, '2023-07-14 14:56:02'),
(193, 2, 1, '2023-07-14 16:25:23'),
(194, 2, 1, '2023-07-14 16:28:20'),
(195, 2, 1, '2023-07-14 16:30:28'),
(196, 2, 1, '2023-07-14 16:48:56'),
(197, 2, 1, '2023-07-14 16:50:15'),
(198, 2, 1, '2023-07-14 16:52:48'),
(199, 2, 1, '2023-07-14 16:55:38'),
(200, 2, 1, '2023-07-14 16:57:12'),
(201, 2, 1, '2023-07-14 17:39:33'),
(202, 2, 1, '2023-07-14 21:26:13'),
(203, 3, 1, '2023-07-14 21:46:09'),
(204, 4, 1, '2023-07-15 18:10:40'),
(205, 1, 1, '2023-07-15 18:13:03'),
(206, 35, 1, '2023-07-16 01:29:00'),
(207, 36, 1, '2023-07-16 01:29:08'),
(208, 36, 1, '2023-07-16 01:29:16'),
(209, 35, 1, '2023-07-16 01:29:22'),
(210, 35, 1, '2023-07-16 02:08:10'),
(211, 36, 1, '2023-07-16 02:08:14'),
(212, 3, 1, '2023-07-16 15:55:12'),
(213, 36, 1, '2023-07-16 17:05:41'),
(214, 35, 1, '2023-07-16 17:42:00'),
(215, 6, 1, '2023-07-16 17:44:46'),
(216, 35, 1, '2023-07-16 17:44:58');

-- --------------------------------------------------------

--
-- Estrutura para tabela `approver`
--
-- Criação: 14/07/2023 às 22:16
-- Última atualização: 14/07/2023 às 22:19
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
-- Criação: 14/07/2023 às 20:41
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE `equipment` (
  `equip_id` int(11) NOT NULL,
  `equipment` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `sector` varchar(26) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `equipment`:
--

--
-- Despejando dados para a tabela `equipment`
--

INSERT INTO `equipment` (`equip_id`, `equipment`, `description`, `sector`) VALUES
(1, 'Caixa de Som', 'Bluetooth, Sem fio, com microfone - 300 wats', 'RH'),
(2, 'Projetor Portátil Multimidia', 'Pequeno', 'RH');

-- --------------------------------------------------------

--
-- Estrutura para tabela `gp_approver`
--
-- Criação: 14/07/2023 às 22:20
-- Última atualização: 16/07/2023 às 17:44
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
(5, 17, 2),
(8, 11, 1),
(9, 15, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `laboratorios`
--
-- Criação: 14/07/2023 às 20:41
--

DROP TABLE IF EXISTS `laboratorios`;
CREATE TABLE `laboratorios` (
  `room_id` int(11) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `capacity` varchar(11) NOT NULL,
  `room_no` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- RELACIONAMENTOS PARA TABELAS `laboratorios`:
--

--
-- Despejando dados para a tabela `laboratorios`
--

INSERT INTO `laboratorios` (`room_id`, `room_type`, `capacity`, `room_no`) VALUES
(7, 'Sala de treinamento', '20', 'Ao lado da oficina'),
(8, 'Sala de reunião', '10', 'Segundo piso'),
(9, 'Sala de atendimento', '5', 'Ao lado do RH');

-- --------------------------------------------------------

--
-- Estrutura para tabela `locacao`
--
-- Criação: 16/07/2023 às 01:36
-- Última atualização: 16/07/2023 às 15:55
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
  `approver_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- RELACIONAMENTOS PARA TABELAS `locacao`:
--   `users_id`
--       `users` -> `users_id`
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
--

--
-- Despejando dados para a tabela `locacao`
--

INSERT INTO `locacao` (`locacao_id`, `users_id`, `room_id`, `vehicle_id`, `equip_id`, `mensagens_id`, `status_id`, `checkin`, `checkin_time`, `checkout_time`, `approver_id`) VALUES
(20, 15, 9, NULL, NULL, 4, 4, '2023-07-14', '20:00:00', '23:00:00', 4),
(28, 15, 7, NULL, NULL, 3, 2, '2023-07-17', '20:00:00', '23:00:00', 4),
(38, 11, NULL, 1, NULL, 3, 2, '2023-07-18', '20:00:00', '23:00:00', 2),
(39, 16, NULL, NULL, 1, 2, 1, '2023-07-19', '10:00:00', '23:00:00', 3),
(40, 15, NULL, 1, NULL, 2, 1, '2023-07-20', '20:00:00', '23:00:00', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens`
--
-- Criação: 14/07/2023 às 20:41
-- Última atualização: 16/07/2023 às 01:11
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
(3, 'Laboratório reservado!!'),
(4, 'Evento finalizado!!'),
(5, 'Laboratório inserido com sucesso!!'),
(6, 'Usuário editado com sucesso!'),
(7, 'Laboratório editado com sucesso!!'),
(8, 'Pendências excluídas!!'),
(9, 'Usuário excluído com sucesso!!'),
(10, 'Laboratório excluído com sucesso!!'),
(11, 'Software inserido com sucesso!!'),
(12, 'Software editado com sucesso!!'),
(13, 'Requisitos do lab. inseridos!!'),
(14, 'Requisitos do lab. editados!!'),
(15, 'Requisições pendentes!!'),
(16, 'Software excluído com sucesso!!'),
(17, 'Requisitos do lab. excluídos!!'),
(18, 'Disciplina inserida com sucesso!!'),
(19, 'Disciplina editada com sucesso!!'),
(20, 'Disciplina excluída com sucesso!!'),
(21, 'Requisito inserido à disciplina!!'),
(22, 'Requisito excluído da disciplina!!'),
(23, 'Chamado aberto!'),
(24, 'Chamado alterado!'),
(25, 'Chamado excluído!'),
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
(36, 'Aprovador removido!');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pwdtemp`
--
-- Criação: 14/07/2023 às 20:41
--

DROP TABLE IF EXISTS `pwdtemp`;
CREATE TABLE `pwdtemp` (
  `pwd_temp` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `username` varchar(26) NOT NULL,
  `codigo` varchar(26) NOT NULL,
  `timestp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `pwdtemp`:
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `status`
--
-- Criação: 14/07/2023 às 20:41
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
(7, 'Não atribuído');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--
-- Criação: 14/07/2023 às 22:25
-- Última atualização: 16/07/2023 às 17:44
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
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- RELACIONAMENTOS PARA TABELAS `users`:
--   `status`
--       `status` -> `status_id`
--

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`users_id`, `firstname`, `lastname`, `funcao`, `email`, `contactno`, `cpf`, `password`, `status`) VALUES
(1, 'Guilherme', 'Machancoses', 'Administrador', 'guilherme.machancoses@gmail.com', '19981955602', '37565229890', '$2y$10$RylogYa9uphx/65rXnElnuGBldU24osOcYLt6mcyVqyq4UYcMGw3W', 5),
(11, 'Bruno', 'Rissio', 'Administrador', 'brunorissio@garbuio.com.br', '19981955602', '375.652.298-90', '$2y$10$dJAcS5q4pvq522.HVHpLmeZN6jI4E.6uzPr.qwGkb9SAgRjEMpCB6', 5),
(15, 'Orlando', 'Bagni', 'Aprovador', 'bagnijr@garbuio.com.br', '19997293396', '027.877.648-51', '$2y$10$AK6U0VFfZs5L9pyo4TCLb.OL08zDvgrJSUj.hdt7HdOjrswsBtCNm', 5),
(16, 'Cesar', 'Monção', 'Usuário', 'cesarmoncao@garbuio.com.br', '19998068077', '286.430.488-01', '$2y$10$rFic2iVN3XhJKEuKORVQNeUUhbHUc6PvXXaIzB32jh.YR0EPKrkvO', 5),
(17, 'Fernanda', 'Rochel', 'Aprovador', 'fernandarochel@garbuio.com.br', '19981955602', '375.652.298-90', '$2y$10$NtMqr2RtDs19z0THswbiSeHUnjY2U5gO7RdUwnenqxPA4Mo2bRPpK', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vehicles`
--
-- Criação: 14/07/2023 às 20:41
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `name` varchar(26) NOT NULL,
  `model` varchar(26) NOT NULL,
  `description` varchar(50) NOT NULL,
  `photo` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `vehicles`:
--

--
-- Despejando dados para a tabela `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `name`, `model`, `description`, `photo`) VALUES
(1, 'Nivus', 'Comfortline 1.0 TS', 'Automático, Flex', '1.jpg'),
(2, 'Virtus', 'Virtus 1.6 MSI MT', 'Automático', '2.jpg'),
(3, 'Polo', 'Comfortline 200 TSI', 'Automático', '3.jpg'),
(4, 'T-Cross', ' Comfortline 250 TSI', 'Automático', '4.jpg'),
(5, 'Gol', 'Total Flex 1.0', 'Manual', '5.jpg');

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
  ADD PRIMARY KEY (`equip_id`);

--
-- Índices de tabela `gp_approver`
--
ALTER TABLE `gp_approver`
  ADD PRIMARY KEY (`gp_approver_id`),
  ADD KEY `approver_id` (`approver_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Índices de tabela `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD PRIMARY KEY (`room_id`);

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
  ADD KEY `approver_id` (`approver_id`);

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
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `activities`
--
ALTER TABLE `activities`
  MODIFY `atctive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

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
  MODIFY `gp_approver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `laboratorios`
--
ALTER TABLE `laboratorios`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `locacao`
--
ALTER TABLE `locacao`
  MODIFY `locacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `pwdtemp`
--
ALTER TABLE `pwdtemp`
  MODIFY `pwd_temp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Restrições para tabelas `gp_approver`
--
ALTER TABLE `gp_approver`
  ADD CONSTRAINT `gp_approver_ibfk_1` FOREIGN KEY (`approver_id`) REFERENCES `approver` (`approver_id`),
  ADD CONSTRAINT `gp_approver_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

--
-- Restrições para tabelas `locacao`
--
ALTER TABLE `locacao`
  ADD CONSTRAINT `locacao_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `locacao_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `laboratorios` (`room_id`),
  ADD CONSTRAINT `locacao_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`),
  ADD CONSTRAINT `locacao_ibfk_5` FOREIGN KEY (`mensagens_id`) REFERENCES `mensagens` (`mensagens_id`),
  ADD CONSTRAINT `locacao_ibfk_6` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`),
  ADD CONSTRAINT `locacao_ibfk_7` FOREIGN KEY (`equip_id`) REFERENCES `equipment` (`equip_id`),
  ADD CONSTRAINT `locacao_ibfk_8` FOREIGN KEY (`approver_id`) REFERENCES `approver` (`approver_id`);

--
-- Restrições para tabelas `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
