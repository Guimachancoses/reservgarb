-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/08/2023 às 04:19
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
-- Criação: 30/07/2023 às 14:11
-- Última atualização: 31/07/2023 às 22:26
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
(1, 2, 1, '2023-07-24 12:38:19'),
(2, 3, 1, '2023-07-25 15:12:31'),
(3, 4, 1, '2023-07-26 12:36:19'),
(4, 2, 1, '2023-07-26 13:10:19'),
(5, 4, 1, '2023-07-26 13:10:21'),
(6, 2, 1, '2023-07-26 13:27:04'),
(7, 2, 1, '2023-07-26 13:27:04'),
(8, 4, 1, '2023-07-26 13:27:07'),
(9, 2, 1, '2023-07-26 13:30:48'),
(10, 2, 1, '2023-07-26 13:30:48'),
(11, 4, 1, '2023-07-26 13:30:51'),
(12, 2, 1, '2023-07-26 13:34:21'),
(13, 3, 1, '2023-07-26 17:08:21'),
(14, 3, 1, '2023-07-26 18:45:41'),
(15, 3, 1, '2023-07-26 18:55:28'),
(16, 3, 1, '2023-07-26 19:15:37'),
(17, 3, 1, '2023-07-26 19:21:48'),
(18, 3, 1, '2023-07-26 19:23:07'),
(19, 3, 1, '2023-07-26 20:07:55'),
(20, 3, 1, '2023-07-26 20:09:49'),
(21, 4, 1, '2023-07-28 12:27:38'),
(22, 2, 15, '2023-07-28 17:53:14'),
(23, 2, 15, '2023-07-28 17:55:19'),
(24, 4, 1, '2023-07-30 14:18:12'),
(25, 4, 1, '2023-07-30 14:18:12'),
(26, 4, 1, '2023-07-30 14:18:12'),
(27, 4, 1, '2023-07-31 22:26:50'),
(28, 4, 1, '2023-07-31 22:26:50'),
(29, 4, 1, '2023-07-31 22:26:50');

-- --------------------------------------------------------

--
-- Estrutura para tabela `approver`
--
-- Criação: 30/07/2023 às 14:11
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
-- Criação: 30/07/2023 às 14:11
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
-- Criação: 30/07/2023 às 14:11
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
(9, 15, 1),
(10, 18, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `laboratorios`
--
-- Criação: 30/07/2023 às 14:11
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
-- Criação: 30/07/2023 às 14:11
-- Última atualização: 31/07/2023 às 22:26
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
-- Despejando dados para a tabela `lc_period`
--

INSERT INTO `lc_period` (`lc_period_id`, `users_id`, `room_id`, `vehicle_id`, `equip_id`, `mensagens_id`, `weekday`, `checkin`, `checkout`, `checkin_time`, `checkout_time`, `approver_id`) VALUES
(1, 11, 7, NULL, NULL, 4, 'AllDays', '2023-07-27', '2023-07-30', '20:00:00', '23:00:00', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `locacao`
--
-- Criação: 30/07/2023 às 14:11
-- Última atualização: 31/07/2023 às 22:26
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
-- Despejando dados para a tabela `locacao`
--

INSERT INTO `locacao` (`locacao_id`, `users_id`, `room_id`, `vehicle_id`, `equip_id`, `mensagens_id`, `status_id`, `checkin`, `checkin_time`, `checkout_time`, `approver_id`, `lc_period_id`) VALUES
(1, 11, 7, NULL, NULL, 4, 4, '2023-07-27', '20:00:00', '23:00:00', 4, 1),
(2, 11, 7, NULL, NULL, 4, 4, '2023-07-28', '20:00:00', '23:00:00', 4, 1),
(3, 11, 7, NULL, NULL, 4, 4, '2023-07-29', '20:00:00', '23:00:00', 4, 1),
(4, 11, 7, NULL, NULL, 4, 4, '2023-07-30', '20:00:00', '23:00:00', 4, 1),
(5, 15, 7, NULL, NULL, 4, 4, '2023-07-31', '12:00:00', '16:00:00', 4, NULL),
(6, 15, 7, NULL, NULL, 4, 4, '2023-07-29', '12:00:00', '13:00:00', 4, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `login_attempts`
--
-- Criação: 30/07/2023 às 14:11
-- Última atualização: 01/08/2023 às 01:56
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
-- Criação: 30/07/2023 às 14:11
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
-- Criação: 30/07/2023 às 14:11
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
-- Criação: 31/07/2023 às 22:33
-- Última atualização: 01/08/2023 às 02:18
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
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `status`
--
-- Criação: 30/07/2023 às 14:11
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
-- Criação: 30/07/2023 às 14:11
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
(1, 'Guilherme', 'Machancoses', 'Administrador', 'guilherme.machancoses@gmail.com', '19981955602', '37565229890', '$2y$10$ei1w1VFlynqxNSGVlJKPsOy67BZ9/rzSDu6Olu0cJC9nzkvAccp/q', 5),
(11, 'Bruno', 'Rissio', 'Administrador', 'brunorissio@garbuio.com.br', '19981955602', '35152066807', '$2y$10$dJAcS5q4pvq522.HVHpLmeZN6jI4E.6uzPr.qwGkb9SAgRjEMpCB6', 5),
(15, 'Orlando', 'Bagni', 'Aprovador', 'bagnijr@garbuio.com.br', '19997293396', '02787764851', '$2y$10$Am450jjp2.nHHs8ZsyBB4u3DOJVHuYvQgD4rX/CJZgjM6c/mrKKTW', 5),
(16, 'Cesar', 'Monção', 'Usuário', 'cesarmoncao@garbuio.com.br', '19998068077', '28643048801', '$2y$10$rFic2iVN3XhJKEuKORVQNeUUhbHUc6PvXXaIzB32jh.YR0EPKrkvO', 5),
(17, 'Fernanda', 'Rochel', 'Aprovador', 'fernandarochel@garbuio.com.br', '19981971509', '46074888876', '$2y$10$BKNAQwIVQK382iIF3kDPfuoPLEMxhzmgqpcBbmYZRekykdx.8eQjK', 5),
(18, 'Janaina', 'Campos', 'Aprovador', 'janainacampos@garbuio.com.br', '19997411896', '343524.09898', '$2y$10$YZMyfdMPPkHagKZMAxyY6uImu80vsb7YscC6IwNdojRsZ4pc3LC.K', 5),
(19, 'Lucas', 'Barros', 'Usuário', 'lucasbarros@garbuio.com.br', '19992630596', '39824231803', '$2y$10$1hsecwTCf2NJmvfw1hu8EO7qVFJhdhe39Ih8vZ8CCi3Fzu5h5gvV2', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vehicles`
--
-- Criação: 30/07/2023 às 14:11
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
(1, 'Nivus', 'Comfortline 1.0 TS', 'Automático, Flex', '1.jpg', 2),
(2, 'Virtus', 'Virtus 1.6 MSI MT', 'Automático', '2.jpg', 2),
(3, 'Polo', 'Comfortline 200 TSI', 'Automático', '3.jpg', 2),
(4, 'T-Cross', ' Comfortline 250 TSI', 'Automático', '4.jpg', 2),
(5, 'Gol', 'Total Flex 1.0', 'Manual', '5.jpg', 2);

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
  ADD KEY `lc_period_id` (`lc_period_id`);

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
  MODIFY `atctive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  MODIFY `lc_period_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `locacao`
--
ALTER TABLE `locacao`
  MODIFY `locacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de tabela `pwdtemp`
--
ALTER TABLE `pwdtemp`
  MODIFY `pwd_temp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `set_color`
--
ALTER TABLE `set_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
