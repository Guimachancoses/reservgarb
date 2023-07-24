-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Jul-2023 às 21:54
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

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
-- Estrutura da tabela `activities`
--
-- Criação: 18-Jul-2023 às 13:30
-- Última actualização: 21-Jul-2023 às 18:39
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
-- Extraindo dados da tabela `activities`
--

INSERT INTO `activities` (`atctive_id`, `mensagens_id`, `users_id`, `timestamp`) VALUES
(1, 2, 1, '2023-07-18 17:53:40'),
(2, 2, 1, '2023-07-18 20:19:13'),
(3, 2, 1, '2023-07-18 20:19:48'),
(4, 2, 1, '2023-07-18 20:20:03'),
(5, 2, 1, '2023-07-18 20:20:18'),
(6, 2, 1, '2023-07-18 20:20:33'),
(7, 2, 1, '2023-07-18 20:20:55'),
(8, 2, 1, '2023-07-18 20:21:28'),
(9, 3, 1, '2023-07-18 20:21:44'),
(10, 3, 1, '2023-07-18 20:21:55'),
(11, 3, 1, '2023-07-18 20:22:13'),
(12, 3, 1, '2023-07-18 20:22:45'),
(13, 2, 1, '2023-07-18 20:23:25'),
(14, 4, 15, '2023-07-19 11:46:21'),
(15, 2, 15, '2023-07-19 12:50:17'),
(16, 2, 15, '2023-07-19 12:57:32'),
(17, 2, 15, '2023-07-19 12:57:49'),
(18, 2, 15, '2023-07-19 13:00:57'),
(19, 2, 15, '2023-07-19 13:02:24'),
(20, 2, 1, '2023-07-19 13:05:44'),
(21, 2, 15, '2023-07-19 13:07:38'),
(22, 2, 15, '2023-07-19 13:09:47'),
(23, 1, 1, '2023-07-19 13:22:26'),
(24, 2, 1, '2023-07-19 13:57:22'),
(25, 2, 1, '2023-07-19 13:59:02'),
(26, 2, 1, '2023-07-19 14:01:57'),
(27, 2, 15, '2023-07-19 14:03:02'),
(28, 2, 1, '2023-07-19 14:04:21'),
(29, 2, 1, '2023-07-19 14:08:49'),
(30, 2, 1, '2023-07-19 14:13:38'),
(31, 2, 1, '2023-07-19 14:16:44'),
(32, 2, 1, '2023-07-19 14:38:51'),
(33, 2, 1, '2023-07-19 14:44:18'),
(34, 2, 1, '2023-07-19 14:51:55'),
(35, 2, 1, '2023-07-19 14:55:31'),
(36, 2, 1, '2023-07-19 14:57:36'),
(37, 4, 1, '2023-07-19 18:49:08'),
(38, 4, 15, '2023-07-20 10:15:10'),
(39, 2, 15, '2023-07-20 14:36:49'),
(40, 2, 1, '2023-07-20 14:38:21'),
(41, 2, 15, '2023-07-20 14:39:25'),
(42, 3, 15, '2023-07-20 14:40:23'),
(43, 2, 15, '2023-07-20 14:57:22'),
(44, 2, 15, '2023-07-20 15:01:09'),
(45, 2, 1, '2023-07-20 15:26:05'),
(46, 2, 1, '2023-07-20 15:26:37'),
(47, 2, 1, '2023-07-20 15:26:50'),
(48, 2, 1, '2023-07-20 15:27:02'),
(49, 2, 1, '2023-07-20 17:49:54'),
(50, 2, 1, '2023-07-20 17:50:06'),
(51, 2, 1, '2023-07-20 17:50:31'),
(52, 2, 1, '2023-07-20 18:19:23'),
(53, 2, 1, '2023-07-20 18:20:03'),
(54, 3, 1, '2023-07-20 18:56:35'),
(55, 4, 15, '2023-07-20 18:59:03'),
(56, 2, 1, '2023-07-20 19:10:47'),
(57, 2, 1, '2023-07-20 19:20:28'),
(58, 2, 1, '2023-07-20 19:30:56'),
(59, 4, 15, '2023-07-21 11:31:20'),
(60, 2, 1, '2023-07-21 15:26:56'),
(61, 2, 1, '2023-07-21 15:32:29'),
(62, 2, 1, '2023-07-21 16:36:02'),
(63, 2, 1, '2023-07-21 16:36:56'),
(64, 2, 1, '2023-07-21 16:39:35'),
(65, 2, 1, '2023-07-21 17:02:50'),
(66, 2, 1, '2023-07-21 17:19:53'),
(67, 2, 1, '2023-07-21 17:22:31'),
(68, 2, 1, '2023-07-21 17:25:03'),
(69, 2, 1, '2023-07-21 17:26:31'),
(70, 2, 1, '2023-07-21 17:27:31'),
(71, 2, 1, '2023-07-21 17:27:31'),
(72, 2, 1, '2023-07-21 17:30:17'),
(73, 2, 1, '2023-07-21 17:30:17'),
(74, 2, 1, '2023-07-21 17:36:18'),
(75, 2, 1, '2023-07-21 17:36:18'),
(76, 2, 1, '2023-07-21 17:36:18'),
(77, 2, 1, '2023-07-21 17:36:18'),
(78, 2, 1, '2023-07-21 17:36:18'),
(79, 2, 1, '2023-07-21 17:36:18'),
(80, 2, 1, '2023-07-21 17:47:38'),
(81, 2, 1, '2023-07-21 17:47:38'),
(82, 2, 1, '2023-07-21 17:47:38'),
(83, 2, 1, '2023-07-21 17:47:38'),
(84, 2, 1, '2023-07-21 17:47:38'),
(85, 2, 1, '2023-07-21 17:47:38'),
(86, 2, 1, '2023-07-21 17:59:48'),
(87, 2, 15, '2023-07-21 18:39:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `approver`
--
-- Criação: 17-Jul-2023 às 11:40
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
-- Extraindo dados da tabela `approver`
--

INSERT INTO `approver` (`approver_id`, `approvers`) VALUES
(1, 'Administrador'),
(2, 'Veículos'),
(3, 'Equipamentos'),
(4, 'Salas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipment`
--
-- Criação: 20-Jul-2023 às 19:29
-- Última actualização: 20-Jul-2023 às 19:29
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
-- Extraindo dados da tabela `equipment`
--

INSERT INTO `equipment` (`equip_id`, `equipment`, `description`, `sector`, `photo`, `approver_id`) VALUES
(1, 'Caixa de Som', 'Bluetooth, Sem fio, com microfone - 300 wats', 'RH', 'CxPolyvox.jpg', 3),
(2, 'Projetor Portátil Multimidia', 'Pequeno', 'RH', '720PTheater.jpg', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `gp_approver`
--
-- Criação: 17-Jul-2023 às 11:40
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
-- Extraindo dados da tabela `gp_approver`
--

INSERT INTO `gp_approver` (`gp_approver_id`, `users_id`, `approver_id`) VALUES
(1, 1, 1),
(5, 17, 2),
(8, 11, 1),
(9, 15, 1),
(10, 18, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `laboratorios`
--
-- Criação: 20-Jul-2023 às 19:26
-- Última actualização: 20-Jul-2023 às 19:27
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
-- Extraindo dados da tabela `laboratorios`
--

INSERT INTO `laboratorios` (`room_id`, `room_type`, `capacity`, `room_no`, `photo`, `approver_id`) VALUES
(7, 'Sala de treinamento', '20', 'Ao lado da oficina', 'SalaT.jpg', 4),
(8, 'Sala de reunião', '10', 'Segundo piso', 'SalaR.jpg', 4),
(9, 'Sala de atendimento', '5', 'Ao lado do RH', 'SalaA.jpg', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lc_period`
--
-- Criação: 21-Jul-2023 às 15:47
-- Última actualização: 21-Jul-2023 às 17:47
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
  `approver_id` int(11) DEFAULT NULL
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
-- Extraindo dados da tabela `lc_period`
--

INSERT INTO `lc_period` (`lc_period_id`, `users_id`, `room_id`, `vehicle_id`, `equip_id`, `mensagens_id`, `weekday`, `checkin`, `checkout`, `checkin_time`, `checkout_time`, `approver_id`) VALUES
(13, 1, 7, NULL, NULL, 2, 'Monday', '2023-08-28', '2023-09-28', '20:00:00', '23:00:00', 4),
(14, 1, 7, NULL, NULL, 2, 'Tuesday', '2023-08-29', '2023-09-29', '20:00:00', '23:00:00', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `locacao`
--
-- Criação: 21-Jul-2023 às 17:18
-- Última actualização: 21-Jul-2023 às 18:39
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
  `lc_period_id` int(11) DEFAULT NULL
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
--   `lc_period_id`
--       `lc_period` -> `lc_period_id`
--

--
-- Extraindo dados da tabela `locacao`
--

INSERT INTO `locacao` (`locacao_id`, `users_id`, `room_id`, `vehicle_id`, `equip_id`, `mensagens_id`, `status_id`, `checkin`, `checkin_time`, `checkout_time`, `approver_id`, `lc_period_id`) VALUES
(15, 1, 7, NULL, NULL, 2, 1, '2023-08-28', '20:00:00', '23:00:00', 4, 13),
(16, 1, 7, NULL, NULL, 2, 1, '2023-09-04', '20:00:00', '23:00:00', 4, 13),
(17, 1, 7, NULL, NULL, 2, 1, '2023-09-11', '20:00:00', '23:00:00', 4, 13),
(18, 1, 7, NULL, NULL, 2, 1, '2023-09-18', '20:00:00', '23:00:00', 4, 13),
(19, 1, 7, NULL, NULL, 2, 1, '2023-09-25', '20:00:00', '23:00:00', 4, 13),
(20, 1, 7, NULL, NULL, 2, 1, '2023-08-29', '20:00:00', '23:00:00', 4, 14),
(21, 1, 7, NULL, NULL, 2, 1, '2023-09-05', '20:00:00', '23:00:00', 4, 14),
(22, 1, 7, NULL, NULL, 2, 1, '2023-09-12', '20:00:00', '23:00:00', 4, 14),
(23, 1, 7, NULL, NULL, 2, 1, '2023-09-19', '20:00:00', '23:00:00', 4, 14),
(24, 1, 7, NULL, NULL, 2, 1, '2023-09-26', '20:00:00', '23:00:00', 4, 14),
(25, 1, 7, NULL, NULL, 2, 1, '2023-07-22', '20:00:00', '23:00:00', 4, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--
-- Criação: 17-Jul-2023 às 11:40
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
-- Extraindo dados da tabela `mensagens`
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
-- Estrutura da tabela `pwdtemp`
--
-- Criação: 17-Jul-2023 às 11:40
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
-- Estrutura da tabela `status`
--
-- Criação: 17-Jul-2023 às 11:40
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
-- Extraindo dados da tabela `status`
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
-- Estrutura da tabela `users`
--
-- Criação: 17-Jul-2023 às 11:40
-- Última actualização: 19-Jul-2023 às 13:22
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
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`users_id`, `firstname`, `lastname`, `funcao`, `email`, `contactno`, `cpf`, `password`, `status`) VALUES
(1, 'Guilherme', 'Machancoses', 'Administrador', 'guilherme.machancoses@gmail.com', '19981955602', '37565229890', '$2y$10$ei1w1VFlynqxNSGVlJKPsOy67BZ9/rzSDu6Olu0cJC9nzkvAccp/q', 5),
(11, 'Bruno', 'Rissio', 'Administrador', 'brunorissio@garbuio.com.br', '19981955602', '375.652.298-90', '$2y$10$dJAcS5q4pvq522.HVHpLmeZN6jI4E.6uzPr.qwGkb9SAgRjEMpCB6', 5),
(15, 'Orlando', 'Bagni', 'Aprovador', 'bagnijr@garbuio.com.br', '19997293396', '027.877.648-51', '$2y$10$Am450jjp2.nHHs8ZsyBB4u3DOJVHuYvQgD4rX/CJZgjM6c/mrKKTW', 5),
(16, 'Cesar', 'Monção', 'Usuário', 'cesarmoncao@garbuio.com.br', '19998068077', '286.430.488-01', '$2y$10$rFic2iVN3XhJKEuKORVQNeUUhbHUc6PvXXaIzB32jh.YR0EPKrkvO', 5),
(17, 'Fernanda', 'Rochel', 'Aprovador', 'fernandarochel@garbuio.com.br', '19981971509', '460.748.888-76', '$2y$10$BKNAQwIVQK382iIF3kDPfuoPLEMxhzmgqpcBbmYZRekykdx.8eQjK', 5),
(18, 'Janaina', 'Campos', 'Aprovador', 'janainacampos@garbuio.com.br', '19997411896', '343.524.098-98', '$2y$10$YZMyfdMPPkHagKZMAxyY6uImu80vsb7YscC6IwNdojRsZ4pc3LC.K', 5),
(19, 'Lucas', 'Barros', 'Usuário', 'lucasbarros@garbuio.com.br', '19992630596', '39824231803', '$2y$10$1hsecwTCf2NJmvfw1hu8EO7qVFJhdhe39Ih8vZ8CCi3Fzu5h5gvV2', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vehicles`
--
-- Criação: 20-Jul-2023 às 19:28
-- Última actualização: 20-Jul-2023 às 19:28
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
-- Extraindo dados da tabela `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `name`, `model`, `description`, `photo`, `approver_id`) VALUES
(1, 'Nivus', 'Comfortline 1.0 TS', 'Automático, Flex', '1.jpg', 2),
(2, 'Virtus', 'Virtus 1.6 MSI MT', 'Automático', '2.jpg', 2),
(3, 'Polo', 'Comfortline 200 TSI', 'Automático', '3.jpg', 2),
(4, 'T-Cross', ' Comfortline 250 TSI', 'Automático', '4.jpg', 2),
(5, 'Gol', 'Total Flex 1.0', 'Manual', '5.jpg', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`atctive_id`),
  ADD KEY `mensagens_id` (`mensagens_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Índices para tabela `approver`
--
ALTER TABLE `approver`
  ADD PRIMARY KEY (`approver_id`);

--
-- Índices para tabela `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equip_id`),
  ADD KEY `approver_id` (`approver_id`);

--
-- Índices para tabela `gp_approver`
--
ALTER TABLE `gp_approver`
  ADD PRIMARY KEY (`gp_approver_id`),
  ADD KEY `approver_id` (`approver_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Índices para tabela `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `approver_id` (`approver_id`);

--
-- Índices para tabela `lc_period`
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
-- Índices para tabela `locacao`
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
  ADD KEY `lc_period_id` (`lc_period_id`);

--
-- Índices para tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`mensagens_id`);

--
-- Índices para tabela `pwdtemp`
--
ALTER TABLE `pwdtemp`
  ADD PRIMARY KEY (`pwd_temp`);

--
-- Índices para tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `status` (`status`);

--
-- Índices para tabela `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `approver_id` (`approver_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `activities`
--
ALTER TABLE `activities`
  MODIFY `atctive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

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
  MODIFY `gp_approver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `laboratorios`
--
ALTER TABLE `laboratorios`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `lc_period`
--
ALTER TABLE `lc_period`
  MODIFY `lc_period_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `locacao`
--
ALTER TABLE `locacao`
  MODIFY `locacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`mensagens_id`) REFERENCES `mensagens` (`mensagens_id`),
  ADD CONSTRAINT `activities_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

--
-- Limitadores para a tabela `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`approver_id`) REFERENCES `approver` (`approver_id`);

--
-- Limitadores para a tabela `gp_approver`
--
ALTER TABLE `gp_approver`
  ADD CONSTRAINT `gp_approver_ibfk_1` FOREIGN KEY (`approver_id`) REFERENCES `approver` (`approver_id`),
  ADD CONSTRAINT `gp_approver_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

--
-- Limitadores para a tabela `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD CONSTRAINT `laboratorios_ibfk_1` FOREIGN KEY (`approver_id`) REFERENCES `approver` (`approver_id`);

--
-- Limitadores para a tabela `lc_period`
--
ALTER TABLE `lc_period`
  ADD CONSTRAINT `lc_period_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `lc_period_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `laboratorios` (`room_id`),
  ADD CONSTRAINT `lc_period_ibfk_3` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`),
  ADD CONSTRAINT `lc_period_ibfk_4` FOREIGN KEY (`equip_id`) REFERENCES `equipment` (`equip_id`),
  ADD CONSTRAINT `lc_period_ibfk_5` FOREIGN KEY (`mensagens_id`) REFERENCES `mensagens` (`mensagens_id`),
  ADD CONSTRAINT `lc_period_ibfk_6` FOREIGN KEY (`approver_id`) REFERENCES `approver` (`approver_id`);

--
-- Limitadores para a tabela `locacao`
--
ALTER TABLE `locacao`
  ADD CONSTRAINT `locacao_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `locacao_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `laboratorios` (`room_id`),
  ADD CONSTRAINT `locacao_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`),
  ADD CONSTRAINT `locacao_ibfk_5` FOREIGN KEY (`mensagens_id`) REFERENCES `mensagens` (`mensagens_id`),
  ADD CONSTRAINT `locacao_ibfk_6` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`),
  ADD CONSTRAINT `locacao_ibfk_7` FOREIGN KEY (`equip_id`) REFERENCES `equipment` (`equip_id`),
  ADD CONSTRAINT `locacao_ibfk_8` FOREIGN KEY (`approver_id`) REFERENCES `approver` (`approver_id`),
  ADD CONSTRAINT `locacao_ibfk_9` FOREIGN KEY (`lc_period_id`) REFERENCES `lc_period` (`lc_period_id`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`);

--
-- Limitadores para a tabela `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`approver_id`) REFERENCES `approver` (`approver_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
