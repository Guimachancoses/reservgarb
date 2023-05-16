-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Abr-2023 às 23:03
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
-- Criação: 18-Abr-2023 às 10:19
-- Última actualização: 19-Abr-2023 às 20:31
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `atctive_id` int(11) NOT NULL,
  `mensagens_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `activities`:
--   `mensagens_id`
--       `mensagens` -> `mensagens_id`
--

--
-- Extraindo dados da tabela `activities`
--

INSERT INTO `activities` (`atctive_id`, `mensagens_id`, `timestamp`) VALUES
(1, 3, '2023-04-13 19:27:22'),
(2, 1, '2023-04-13 12:48:56'),
(3, 4, '2023-04-13 19:04:53'),
(4, 1, '2023-04-13 19:57:24'),
(5, 5, '2023-04-13 20:23:16'),
(6, 2, '2023-04-13 20:34:39'),
(7, 6, '2023-04-14 19:31:46'),
(8, 11, '2023-04-14 23:47:35'),
(9, 11, '2023-04-14 23:52:04'),
(10, 11, '2023-04-14 23:56:39'),
(11, 11, '2023-04-15 00:11:31'),
(12, 11, '2023-04-15 00:16:31'),
(13, 13, '2023-04-15 14:07:55'),
(14, 17, '2023-04-15 14:24:11'),
(15, 6, '2023-04-16 15:46:56'),
(16, 6, '2023-04-16 15:51:36'),
(17, 4, '2023-04-16 17:06:32'),
(18, 6, '2023-04-16 21:00:52'),
(19, 1, '2023-04-16 21:33:41'),
(20, 6, '2023-04-16 21:40:42'),
(21, 18, '2023-04-17 15:45:45'),
(22, 18, '2023-04-17 19:46:04'),
(23, 19, '2023-04-17 19:51:18'),
(24, 20, '2023-04-17 20:28:42'),
(25, 13, '2023-04-17 23:18:58'),
(26, 13, '2023-04-17 23:19:58'),
(27, 2, '2023-04-17 23:22:07'),
(28, 3, '2023-04-17 23:22:41'),
(29, 13, '2023-04-18 00:40:35'),
(30, 13, '2023-04-18 01:19:46'),
(31, 13, '2023-04-18 01:19:53'),
(32, 13, '2023-04-18 01:37:24'),
(33, 4, '2023-04-18 10:20:05'),
(34, 21, '2023-04-18 14:08:48'),
(35, 21, '2023-04-18 14:17:42'),
(36, 21, '2023-04-18 14:19:08'),
(37, 22, '2023-04-18 14:43:53'),
(38, 2, '2023-04-18 20:43:38'),
(39, 3, '2023-04-18 20:44:49'),
(40, 23, '2023-04-19 12:44:27'),
(41, 24, '2023-04-19 14:35:52'),
(42, 24, '2023-04-19 14:36:10'),
(43, 24, '2023-04-19 14:37:21'),
(44, 24, '2023-04-19 14:41:17'),
(45, 24, '2023-04-19 14:44:43'),
(46, 24, '2023-04-19 14:45:05'),
(47, 24, '2023-04-19 14:47:24'),
(48, 24, '2023-04-19 14:47:59'),
(49, 2, '2023-04-19 18:11:28'),
(50, 2, '2023-04-19 18:12:02'),
(51, 3, '2023-04-19 18:12:11'),
(52, 2, '2023-04-19 18:14:15'),
(53, 2, '2023-04-19 18:14:31'),
(54, 3, '2023-04-19 18:14:40'),
(55, 2, '2023-04-19 20:31:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--
-- Criação: 18-Abr-2023 às 19:16
-- Última actualização: 18-Abr-2023 às 19:16
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `categoria_id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `categorias`:
--

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `categoria`) VALUES
(1, 'Instalação de Softwares'),
(2, 'Instalação de Periféricos'),
(3, 'Atualização'),
(4, 'Manutenção'),
(5, 'Outro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamados`
--
-- Criação: 19-Abr-2023 às 12:28
-- Última actualização: 19-Abr-2023 às 15:16
--

DROP TABLE IF EXISTS `chamados`;
CREATE TABLE `chamados` (
  `chamado_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `prioridade_id` int(11) NOT NULL,
  `assuntos` varchar(50) NOT NULL,
  `msg_chamado` varchar(255) NOT NULL,
  `status_id` int(11) NOT NULL,
  `t_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `chamados`:
--   `users_id`
--       `users` -> `users_id`
--   `room_id`
--       `laboratorios` -> `room_id`
--   `categoria_id`
--       `categorias` -> `categoria_id`
--   `prioridade_id`
--       `prioridades` -> `prioridade_id`
--   `status_id`
--       `status` -> `status_id`
--

--
-- Extraindo dados da tabela `chamados`
--

INSERT INTO `chamados` (`chamado_id`, `users_id`, `room_id`, `categoria_id`, `prioridade_id`, `assuntos`, `msg_chamado`, `status_id`, `t_stamp`) VALUES
(1, 2, 1, 1, 1, 'Instalar Power Bi', 'Agora foi!', 1, '2023-04-19 14:47:59'),
(2, 2, 1, 3, 1, 'Atualização Power BI', 'Atualizar versão para 2023', 4, '2023-04-19 15:16:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--
-- Criação: 18-Abr-2023 às 10:19
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE `cursos` (
  `curso_id` int(11) NOT NULL,
  `curso` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `cursos`:
--

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`curso_id`, `curso`) VALUES
(1, 'TADS'),
(2, 'Adm'),
(3, 'Nutrição'),
(4, 'Estética'),
(5, 'Fisioterapia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinas`
--
-- Criação: 18-Abr-2023 às 10:19
--

DROP TABLE IF EXISTS `disciplinas`;
CREATE TABLE `disciplinas` (
  `disciplina_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `nm_disciplina` varchar(50) NOT NULL,
  `qtd_users` varchar(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `disciplinas`:
--   `users_id`
--       `users` -> `users_id`
--   `curso_id`
--       `cursos` -> `curso_id`
--   `semester_id`
--       `semestre` -> `semester_id`
--

--
-- Extraindo dados da tabela `disciplinas`
--

INSERT INTO `disciplinas` (`disciplina_id`, `users_id`, `curso_id`, `semester_id`, `nm_disciplina`, `qtd_users`, `date`) VALUES
(1, 3, 1, 1, 'Banco de dados não relacional', '70', '2023-02-01'),
(2, 2, 1, 2, 'Banco de dados relacional', '70', '2022-06-01'),
(3, 1, 2, 1, 'Inglês Técnico', '70', '2022-02-01'),
(4, 1, 1, 1, 'Culinária', '55', '2022-04-12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `laboratorios`
--
-- Criação: 18-Abr-2023 às 10:19
--

DROP TABLE IF EXISTS `laboratorios`;
CREATE TABLE `laboratorios` (
  `room_id` int(11) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `capacity` varchar(11) NOT NULL,
  `room_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- RELACIONAMENTOS PARA TABELAS `laboratorios`:
--

--
-- Extraindo dados da tabela `laboratorios`
--

INSERT INTO `laboratorios` (`room_id`, `room_type`, `capacity`, `room_no`) VALUES
(1, 'Informática', '80', '14'),
(2, 'Informática', '70', '15'),
(3, 'Informática', '80', '16'),
(4, 'Informática', '100', '17'),
(13, 'Fisioterápia', '60', '02'),
(14, 'Nutrição', '40', '05'),
(15, 'Estética', '55', '03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `locacao`
--
-- Criação: 18-Abr-2023 às 10:19
-- Última actualização: 19-Abr-2023 às 20:31
--

DROP TABLE IF EXISTS `locacao`;
CREATE TABLE `locacao` (
  `locacao_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `mensagens_id` int(11) DEFAULT NULL,
  `disciplina_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `checkin` date NOT NULL,
  `checkin_time` time NOT NULL,
  `checkout_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- RELACIONAMENTOS PARA TABELAS `locacao`:
--   `users_id`
--       `users` -> `users_id`
--   `room_id`
--       `laboratorios` -> `room_id`
--   `status_id`
--       `status` -> `status_id`
--   `disciplina_id`
--       `disciplinas` -> `disciplina_id`
--   `mensagens_id`
--       `mensagens` -> `mensagens_id`
--

--
-- Extraindo dados da tabela `locacao`
--

INSERT INTO `locacao` (`locacao_id`, `users_id`, `room_id`, `mensagens_id`, `disciplina_id`, `status_id`, `checkin`, `checkin_time`, `checkout_time`) VALUES
(115, 3, 1, 4, 1, 4, '2023-04-14', '20:00:00', '23:00:00'),
(116, 3, 1, 4, 1, 4, '2023-04-17', '21:00:00', '23:00:00'),
(117, 3, 1, 3, 1, 2, '2023-04-19', '20:00:00', '23:00:00'),
(119, 2, 4, 3, 2, 2, '2023-04-22', '20:00:00', '23:00:00'),
(120, 3, 3, 2, 1, 1, '2023-04-21', '20:00:00', '23:00:00'),
(121, 3, 3, 3, 1, 2, '2023-04-20', '20:00:00', '23:00:00'),
(122, 2, 1, 2, 2, 1, '2023-04-21', '20:00:00', '23:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--
-- Criação: 18-Abr-2023 às 10:19
-- Última actualização: 19-Abr-2023 às 15:38
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
(25, 'Chamado excluído!');

-- --------------------------------------------------------

--
-- Estrutura da tabela `prioridades`
--
-- Criação: 18-Abr-2023 às 19:07
-- Última actualização: 18-Abr-2023 às 19:12
--

DROP TABLE IF EXISTS `prioridades`;
CREATE TABLE `prioridades` (
  `prioridade_id` int(11) NOT NULL,
  `prioridade` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `prioridades`:
--

--
-- Extraindo dados da tabela `prioridades`
--

INSERT INTO `prioridades` (`prioridade_id`, `prioridade`) VALUES
(1, 'Baixa'),
(2, 'Média'),
(3, 'Alta');

-- --------------------------------------------------------

--
-- Estrutura da tabela `req_software`
--
-- Criação: 18-Abr-2023 às 10:19
-- Última actualização: 18-Abr-2023 às 14:43
--

DROP TABLE IF EXISTS `req_software`;
CREATE TABLE `req_software` (
  `rqs_id` int(11) NOT NULL,
  `software_id` int(11) NOT NULL,
  `disciplina_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `req_software`:
--   `software_id`
--       `softwares` -> `software_id`
--   `disciplina_id`
--       `disciplinas` -> `disciplina_id`
--

--
-- Extraindo dados da tabela `req_software`
--

INSERT INTO `req_software` (`rqs_id`, `software_id`, `disciplina_id`) VALUES
(1, 1, 2),
(2, 4, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `semestre`
--
-- Criação: 18-Abr-2023 às 10:19
--

DROP TABLE IF EXISTS `semestre`;
CREATE TABLE `semestre` (
  `semester_id` int(11) NOT NULL,
  `semestre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `semestre`:
--

--
-- Extraindo dados da tabela `semestre`
--

INSERT INTO `semestre` (`semester_id`, `semestre`) VALUES
(1, '1º Semestre'),
(2, '2º Semestre'),
(3, '3º Semestre'),
(4, '4º Semestre'),
(5, '5º Semestre'),
(6, '6º Semestre'),
(7, '7º Semestre'),
(8, '8º Semestre'),
(9, '9º Semestre'),
(10, '10º Semestre');

-- --------------------------------------------------------

--
-- Estrutura da tabela `softwares`
--
-- Criação: 18-Abr-2023 às 10:19
--

DROP TABLE IF EXISTS `softwares`;
CREATE TABLE `softwares` (
  `software_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `editor` varchar(24) NOT NULL,
  `version` varchar(24) NOT NULL,
  `realesed` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `softwares`:
--

--
-- Extraindo dados da tabela `softwares`
--

INSERT INTO `softwares` (`software_id`, `name`, `editor`, `version`, `realesed`) VALUES
(1, 'Microsoft 365', 'Microsoft Corporation', '16.0.16130.20332', '2023-04-11'),
(2, 'Visual Studio Code', 'Microsoft Corporation', '1.77.3', '2023-04-12'),
(3, 'XAMPP', 'Apache Friends', '8.2.0-0', '2022-12-28'),
(4, 'SQL Server Management Studio', 'Microsoft Corporation', '18.2.3.0', '2022-06-21'),
(5, 'VirtualBox', 'Oracle', '7.0.6', '2023-01-07'),
(6, 'Sublime Text', 'Jon Skinner, Will Bond, ', 'Build 3211', '2019-10-01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `so_disponivel`
--
-- Criação: 18-Abr-2023 às 10:19
--

DROP TABLE IF EXISTS `so_disponivel`;
CREATE TABLE `so_disponivel` (
  `sod_id` int(11) NOT NULL,
  `software_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `so_disponivel`:
--   `software_id`
--       `softwares` -> `software_id`
--   `room_id`
--       `laboratorios` -> `room_id`
--

--
-- Extraindo dados da tabela `so_disponivel`
--

INSERT INTO `so_disponivel` (`sod_id`, `software_id`, `room_id`) VALUES
(1, 1, 1),
(4, 6, 1),
(6, 2, 1),
(7, 3, 1),
(8, 4, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--
-- Criação: 18-Abr-2023 às 10:19
-- Última actualização: 19-Abr-2023 às 15:16
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
(4, 'Finalizado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--
-- Criação: 18-Abr-2023 às 10:19
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(7) NOT NULL,
  `funcao` varchar(24) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contactno` varchar(13) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- RELACIONAMENTOS PARA TABELAS `users`:
--

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`users_id`, `firstname`, `lastname`, `username`, `funcao`, `email`, `contactno`, `cpf`, `password`) VALUES
(1, 'Andréia', 'Machado', '0000002', 'Professor(a)', 'acmanchancoses@msn.com', '19982763272', '375.652.298-90', '12345678'),
(2, 'Johanny', 'Tetzner', '5566221', 'Professor(a)', 'johanny@hotmail.com', '666555222333', '375.652.298-90', '12345678'),
(3, 'Alex', 'Zacharias', '0000001', 'Responsável Laboratório', 'alexzacharias@gmail.com', '1934556678', '375.652.298-90', '12345678'),
(4, 'Guilherme', 'Machancoses', '0005221', 'Administrador', 'guilherme.machancoses@gmail.com', '19981955602', '37565229890', 'Gui@19=='),
(18, 'Lucas', 'Barros', '6665554', 'Responsável Laboratório', 'lucasbarros@garbuio.com.br', '19992630596', '375.652.298-90', '12345678'),
(19, 'Davi', 'Machancoses', '0123221', 'Professor(a)', 'davimachancoses@gmail.com', '19981955602', '375.652.298-90', '12345678');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`atctive_id`),
  ADD KEY `mensagens_id` (`mensagens_id`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Índices para tabela `chamados`
--
ALTER TABLE `chamados`
  ADD PRIMARY KEY (`chamado_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `prioridade_id` (`prioridade_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Índices para tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`curso_id`);

--
-- Índices para tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`disciplina_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `disciplinas_ibfk_2` (`curso_id`),
  ADD KEY `disciplinas_ibfk_3` (`semester_id`);

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
  ADD KEY `disciplina_id` (`disciplina_id`),
  ADD KEY `mensagens.id` (`mensagens_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Índices para tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`mensagens_id`);

--
-- Índices para tabela `prioridades`
--
ALTER TABLE `prioridades`
  ADD PRIMARY KEY (`prioridade_id`);

--
-- Índices para tabela `req_software`
--
ALTER TABLE `req_software`
  ADD PRIMARY KEY (`rqs_id`),
  ADD KEY `software_id` (`software_id`),
  ADD KEY `room_id` (`disciplina_id`);

--
-- Índices para tabela `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`semester_id`);

--
-- Índices para tabela `softwares`
--
ALTER TABLE `softwares`
  ADD PRIMARY KEY (`software_id`);

--
-- Índices para tabela `so_disponivel`
--
ALTER TABLE `so_disponivel`
  ADD PRIMARY KEY (`sod_id`),
  ADD KEY `software_id` (`software_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Índices para tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `activities`
--
ALTER TABLE `activities`
  MODIFY `atctive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `chamados`
--
ALTER TABLE `chamados`
  MODIFY `chamado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `curso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4735818;

--
-- AUTO_INCREMENT de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `disciplina_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `laboratorios`
--
ALTER TABLE `laboratorios`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `locacao`
--
ALTER TABLE `locacao`
  MODIFY `locacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT de tabela `prioridades`
--
ALTER TABLE `prioridades`
  MODIFY `prioridade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `req_software`
--
ALTER TABLE `req_software`
  MODIFY `rqs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `semestre`
--
ALTER TABLE `semestre`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `softwares`
--
ALTER TABLE `softwares`
  MODIFY `software_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `so_disponivel`
--
ALTER TABLE `so_disponivel`
  MODIFY `sod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`mensagens_id`) REFERENCES `mensagens` (`mensagens_id`);

--
-- Limitadores para a tabela `chamados`
--
ALTER TABLE `chamados`
  ADD CONSTRAINT `chamados_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `chamados_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `laboratorios` (`room_id`),
  ADD CONSTRAINT `chamados_ibfk_3` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`categoria_id`),
  ADD CONSTRAINT `chamados_ibfk_4` FOREIGN KEY (`prioridade_id`) REFERENCES `prioridades` (`prioridade_id`),
  ADD CONSTRAINT `chamados_ibfk_5` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Limitadores para a tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD CONSTRAINT `disciplinas_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `disciplinas_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`curso_id`),
  ADD CONSTRAINT `disciplinas_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `semestre` (`semester_id`);

--
-- Limitadores para a tabela `locacao`
--
ALTER TABLE `locacao`
  ADD CONSTRAINT `locacao_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `locacao_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `laboratorios` (`room_id`),
  ADD CONSTRAINT `locacao_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`),
  ADD CONSTRAINT `locacao_ibfk_4` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`disciplina_id`),
  ADD CONSTRAINT `locacao_ibfk_5` FOREIGN KEY (`mensagens_id`) REFERENCES `mensagens` (`mensagens_id`);

--
-- Limitadores para a tabela `req_software`
--
ALTER TABLE `req_software`
  ADD CONSTRAINT `req_software_ibfk_1` FOREIGN KEY (`software_id`) REFERENCES `softwares` (`software_id`),
  ADD CONSTRAINT `req_software_ibfk_2` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`disciplina_id`);

--
-- Limitadores para a tabela `so_disponivel`
--
ALTER TABLE `so_disponivel`
  ADD CONSTRAINT `so_disponivel_ibfk_2` FOREIGN KEY (`software_id`) REFERENCES `softwares` (`software_id`),
  ADD CONSTRAINT `so_disponivel_ibfk_3` FOREIGN KEY (`room_id`) REFERENCES `laboratorios` (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
