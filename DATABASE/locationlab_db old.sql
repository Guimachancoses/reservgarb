-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Jul-2023 às 23:10
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
-- Última actualização: 18-Jul-2023 às 20:23
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
(13, 2, 1, '2023-07-18 20:23:25');

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
-- Criação: 17-Jul-2023 às 11:40
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
-- Extraindo dados da tabela `equipment`
--

INSERT INTO `equipment` (`equip_id`, `equipment`, `description`, `sector`) VALUES
(1, 'Caixa de Som', 'Bluetooth, Sem fio, com microfone - 300 wats', 'RH'),
(2, 'Projetor Portátil Multimidia', 'Pequeno', 'RH');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gp_approver`
--
-- Criação: 17-Jul-2023 às 11:40
-- Última actualização: 17-Jul-2023 às 11:57
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
-- Criação: 17-Jul-2023 às 11:40
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
-- Extraindo dados da tabela `laboratorios`
--

INSERT INTO `laboratorios` (`room_id`, `room_type`, `capacity`, `room_no`) VALUES
(7, 'Sala de treinamento', '20', 'Ao lado da oficina'),
(8, 'Sala de reunião', '10', 'Segundo piso'),
(9, 'Sala de atendimento', '5', 'Ao lado do RH');

-- --------------------------------------------------------

--
-- Estrutura da tabela `locacao`
--
-- Criação: 17-Jul-2023 às 11:40
-- Última actualização: 18-Jul-2023 às 20:23
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
-- Extraindo dados da tabela `locacao`
--

INSERT INTO `locacao` (`locacao_id`, `users_id`, `room_id`, `vehicle_id`, `equip_id`, `mensagens_id`, `status_id`, `checkin`, `checkin_time`, `checkout_time`, `approver_id`) VALUES
(28, 15, 7, NULL, NULL, 4, 4, '2023-07-17', '20:00:00', '23:00:00', 4),
(38, 11, NULL, 1, NULL, 4, 4, '2023-07-18', '20:00:00', '23:00:00', 2),
(42, 11, NULL, 5, NULL, 3, 2, '2023-07-18', '20:00:00', '23:00:00', NULL),
(43, 15, 7, NULL, NULL, 3, 2, '2023-07-19', '12:00:00', '13:00:00', NULL),
(44, 15, NULL, 1, NULL, 3, 2, '2023-07-20', '18:00:00', '00:00:00', NULL),
(46, 18, NULL, NULL, 2, 3, 2, '2023-07-23', '13:00:00', '16:00:00', NULL),
(47, 16, NULL, 3, NULL, 2, 1, '2023-07-24', '12:00:00', '23:00:00', NULL),
(48, 17, 8, NULL, NULL, 2, 1, '2023-07-25', '16:00:00', '19:00:00', NULL),
(49, 16, NULL, NULL, 1, 2, 1, '2023-07-21', '20:00:00', '23:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--
-- Criação: 17-Jul-2023 às 11:40
-- Última actualização: 18-Jul-2023 às 13:31
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
-- Última actualização: 17-Jul-2023 às 21:05
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
(18, 'Janaina', 'Campos', 'Aprovador', 'janainacampos@garbuio.com.br', '19997411896', '343.524.098-98', '$2y$10$YZMyfdMPPkHagKZMAxyY6uImu80vsb7YscC6IwNdojRsZ4pc3LC.K', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vehicles`
--
-- Criação: 17-Jul-2023 às 11:40
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
-- Extraindo dados da tabela `vehicles`
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
  ADD PRIMARY KEY (`equip_id`);

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
  ADD PRIMARY KEY (`room_id`);

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
  ADD KEY `approver_id` (`approver_id`);

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
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `activities`
--
ALTER TABLE `activities`
  MODIFY `atctive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- AUTO_INCREMENT de tabela `locacao`
--
ALTER TABLE `locacao`
  MODIFY `locacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
-- Limitadores para a tabela `gp_approver`
--
ALTER TABLE `gp_approver`
  ADD CONSTRAINT `gp_approver_ibfk_1` FOREIGN KEY (`approver_id`) REFERENCES `approver` (`approver_id`),
  ADD CONSTRAINT `gp_approver_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

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
  ADD CONSTRAINT `locacao_ibfk_8` FOREIGN KEY (`approver_id`) REFERENCES `approver` (`approver_id`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
