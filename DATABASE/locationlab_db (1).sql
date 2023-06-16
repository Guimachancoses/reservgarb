-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Jun-2023 às 00:16
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
-- Criação: 02-Jun-2023 às 14:48
-- Última actualização: 16-Jun-2023 às 20:00
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
(16, 18, 2, '2023-06-05 15:14:30'),
(17, 18, 2, '2023-06-05 15:16:17'),
(18, 18, 2, '2023-06-05 15:24:43'),
(19, 11, NULL, '2023-06-05 15:30:46'),
(20, 21, 2, '2023-06-05 15:31:07'),
(21, 11, NULL, '2023-06-05 15:33:09'),
(22, 11, NULL, '2023-06-05 16:19:43'),
(23, 21, 2, '2023-06-05 16:20:02'),
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
(34, 2, 2, '2023-06-05 16:28:00'),
(35, 2, 2, '2023-06-05 16:32:17'),
(36, 2, 2, '2023-06-05 16:32:42'),
(37, 18, 5, '2023-06-05 16:34:39'),
(38, 18, 5, '2023-06-05 16:35:22'),
(39, 2, 5, '2023-06-05 16:35:41'),
(40, 2, 5, '2023-06-05 16:36:32'),
(41, 7, 1, '2023-06-05 16:37:58'),
(42, 2, 5, '2023-06-05 16:38:51'),
(43, 18, 4, '2023-06-05 16:54:13'),
(44, 18, 4, '2023-06-05 16:55:06'),
(45, 18, 4, '2023-06-05 16:55:36'),
(46, 11, NULL, '2023-06-05 16:59:37'),
(47, 21, 4, '2023-06-05 17:03:52'),
(48, 21, 4, '2023-06-05 17:03:56'),
(49, 11, NULL, '2023-06-05 17:06:37'),
(50, 13, NULL, '2023-06-05 17:07:01'),
(51, 13, NULL, '2023-06-05 17:07:12'),
(52, 21, 4, '2023-06-05 17:07:44'),
(53, 2, 4, '2023-06-05 17:08:18'),
(54, 2, 4, '2023-06-05 17:08:34'),
(55, 18, 6, '2023-06-05 17:13:00'),
(56, 18, 6, '2023-06-05 17:14:36'),
(57, 19, 6, '2023-06-05 17:16:23'),
(58, 21, 6, '2023-06-05 17:17:19'),
(59, 21, 6, '2023-06-05 17:17:23'),
(60, 21, 6, '2023-06-05 17:17:34'),
(61, 2, 6, '2023-06-05 17:18:21'),
(62, 18, 3, '2023-06-05 17:30:25'),
(63, 18, 3, '2023-06-05 17:30:57'),
(64, 21, 3, '2023-06-05 18:08:42'),
(65, 22, 3, '2023-06-05 18:10:17'),
(66, 2, 3, '2023-06-05 18:10:57'),
(67, 19, 3, '2023-06-05 18:14:02'),
(68, 19, 3, '2023-06-05 18:14:14'),
(69, 18, 3, '2023-06-05 18:24:56'),
(70, 20, 3, '2023-06-05 18:25:13'),
(71, 19, 3, '2023-06-05 18:31:49'),
(72, 19, 3, '2023-06-05 18:41:00'),
(73, 19, 3, '2023-06-05 19:19:09'),
(74, 19, 3, '2023-06-05 19:19:44'),
(75, 19, 3, '2023-06-05 19:19:59'),
(76, 19, 3, '2023-06-05 19:29:04'),
(77, 2, 3, '2023-06-05 19:29:17'),
(78, 19, 3, '2023-06-05 19:33:08'),
(79, 2, 3, '2023-06-05 19:33:27'),
(80, 21, 3, '2023-06-05 19:44:53'),
(81, 2, 3, '2023-06-05 19:45:33'),
(82, 2, 3, '2023-06-05 19:45:58'),
(83, 2, 3, '2023-06-05 19:51:55'),
(84, 19, 3, '2023-06-05 20:19:46'),
(85, 2, 3, '2023-06-05 20:23:19'),
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
(121, 9, 1, '2023-06-16 20:00:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--
-- Criação: 04-Maio-2023 às 11:40
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
-- Criação: 02-Jun-2023 às 14:48
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--
-- Criação: 04-Maio-2023 às 11:40
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
-- Criação: 02-Jun-2023 às 14:48
-- Última actualização: 05-Jun-2023 às 20:13
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
(1, 2, 1, 3, 'Banco de dados não relacional', '75', '2023-02-05'),
(2, 2, 1, 1, 'Programação orientada a objetos', '75', '2022-02-02'),
(3, 2, 1, 1, 'Java', '85', '2022-02-02'),
(4, 5, 1, 2, 'Bancos de dados relacional', '75', '2022-03-02'),
(5, 5, 1, 4, 'Análise de dados e business intelligence', '85', '2023-05-02'),
(6, 4, 1, 1, 'Serviços e infraestrutura de redes ', '80', '2022-02-01'),
(7, 4, 1, 3, 'Criptografia e cibersegurança ', '75', '2023-02-01'),
(8, 4, 1, 2, 'Estrutura de dados', '75', '2022-06-02'),
(9, 6, 1, 3, 'Desenvolvimento Web back-end ', '80', '2022-06-02'),
(10, 6, 1, 2, 'Desenvolvimento Web front-end ', '85', '2022-06-02'),
(11, 3, 1, 2, 'Algoritmos e lógica de programação', '65', '2022-02-02'),
(12, 3, 1, 2, 'Engenharia de software ', '65', '2022-06-02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `laboratorios`
--
-- Criação: 02-Jun-2023 às 14:48
-- Última actualização: 05-Jun-2023 às 16:37
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
(1, 'Informática', '100', '14'),
(2, 'Informática', '80', '15'),
(3, 'Informática', '70', '16'),
(4, 'Fisioterápia', '50', '01'),
(5, 'Elétrica', '50', '10'),
(6, 'Nutrição', '40', '20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `locacao`
--
-- Criação: 02-Jun-2023 às 14:48
-- Última actualização: 16-Jun-2023 às 13:25
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
(1, 2, 2, 4, 1, 4, '2023-06-09', '20:00:00', '23:00:00'),
(2, 2, 2, 4, 2, 4, '2023-06-08', '20:00:00', '23:00:00'),
(3, 2, 2, 4, 2, 4, '2023-06-15', '20:00:00', '23:00:00'),
(4, 5, 1, 4, 5, 4, '2023-06-07', '20:00:00', '23:00:00'),
(5, 5, 2, 2, 4, 1, '2023-06-16', '20:00:00', '23:00:00'),
(6, 5, 1, 2, 4, 1, '2023-06-19', '20:00:00', '23:00:00'),
(7, 4, 1, 4, 8, 4, '2023-06-06', '20:00:00', '23:00:00'),
(8, 4, 2, 4, 6, 4, '2023-06-12', '20:00:00', '23:00:00'),
(9, 6, 2, 2, 9, 1, '2023-06-23', '20:00:00', '23:00:00'),
(12, 3, 2, 4, 11, 4, '2023-06-07', '20:00:00', '23:00:00'),
(14, 3, 2, 4, 11, 4, '2023-06-14', '20:00:00', '23:00:00'),
(15, 3, 2, 4, 12, 4, '2023-06-06', '20:00:00', '23:00:00'),
(16, 3, 3, 4, 11, 4, '2023-06-08', '20:00:00', '23:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--
-- Criação: 04-Maio-2023 às 11:40
-- Última actualização: 05-Jun-2023 às 13:09
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
(25, 'Chamado excluído!'),
(26, 'Senha alterada!'),
(27, 'Senha alterada!'),
(28, 'Seus dados foram alterados!');

-- --------------------------------------------------------

--
-- Estrutura da tabela `prioridades`
--
-- Criação: 04-Maio-2023 às 11:40
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
-- Estrutura da tabela `pwdtemp`
--
-- Criação: 02-Jun-2023 às 14:48
-- Última actualização: 02-Jun-2023 às 14:48
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
-- Estrutura da tabela `req_software`
--
-- Criação: 02-Jun-2023 às 14:48
-- Última actualização: 05-Jun-2023 às 20:24
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
(1, 1, 1),
(2, 1, 2),
(4, 8, 1),
(5, 10, 2),
(6, 1, 4),
(7, 1, 5),
(8, 1, 6),
(9, 1, 7),
(10, 1, 8),
(11, 2, 8),
(12, 12, 8),
(13, 13, 6),
(14, 1, 9),
(15, 1, 10),
(16, 6, 9),
(17, 3, 9),
(18, 6, 10),
(20, 1, 12),
(23, 13, 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `semestre`
--
-- Criação: 04-Maio-2023 às 11:40
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
-- Criação: 05-Jun-2023 às 15:36
-- Última actualização: 05-Jun-2023 às 17:06
--

DROP TABLE IF EXISTS `softwares`;
CREATE TABLE `softwares` (
  `software_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `editor` varchar(50) NOT NULL,
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
(6, 'Sublime Text', 'Jon Skinner, Will Bond, ', 'Build 3211', '2019-10-01'),
(7, 'Power BI', 'Microsoft Corporation', '2.108.603.0', '2023-04-27'),
(8, 'MongoDB', 'MongoDB Inc.', '6.0 Community Edition - ', '2023-05-04'),
(9, 'NetBeans', 'Oracle', '18', '2023-05-30'),
(10, 'BlueJ', 'King\'s College London', '5.1.0', '2022-10-27'),
(11, 'Microsoft SQL Server', 'Microsoft Company', '2019', '2019-01-01'),
(12, 'Python', 'Guido van Rossum', '3.11.3', '2023-02-10'),
(13, 'Diagrams.net', 'JGraph Ltd', '21.3.5', '2023-05-28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `so_disponivel`
--
-- Criação: 02-Jun-2023 às 14:48
-- Última actualização: 05-Jun-2023 às 17:07
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
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 2, 1),
(8, 4, 1),
(9, 7, 1),
(10, 11, 1),
(11, 3, 2),
(12, 6, 2),
(13, 8, 2),
(14, 10, 2),
(15, 10, 3),
(16, 13, 2),
(17, 12, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--
-- Criação: 04-Maio-2023 às 11:40
-- Última actualização: 16-Jun-2023 às 19:24
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
-- Criação: 16-Jun-2023 às 19:25
-- Última actualização: 16-Jun-2023 às 20:00
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
  `password` varchar(30) NOT NULL,
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
(1, 'Guilherme', 'Machancoses', 'Administrador', 'guilherme.machancoses@gmail.com', '19981955602', '37565229890', 'Gui@19==', 5),
(2, 'Alex', 'Zacharias', 'Usuário', 'alexzacharias@gmail.com', '19997504736', '28618793000', 'Gui@19==', 5),
(3, 'Pedro', 'Ivo Garcia Nunes', 'Usuário', 'pedro.ivo@gmail.com', '19988043221', '11627744010', 'Gui@19==', 5),
(4, 'Jonas', 'Henrique Ferreira', 'Usuário', 'jonasferreira@gmail.com', '19981556622', '88911955027', 'Gui@19==', 5),
(5, 'Johanny', 'Tetzner De Souza', 'Usuário', 'johanny@gmail.com', '19877512221', '47730373009', 'Gui@19==', 5),
(6, 'Thiago', 'Salhab Alves', 'Aprovador', 'thiagosalhab@gmail.com', '19966552213', '56848593052', 'Gui@19==', 5),
(7, 'Wanderley', 'Piccinini Junior', 'Aprovador', 'wanderleypiccinini@gmail.com', '19981954422', '62575272017', 'Gui@19==', 7),
(11, 'Bruno', 'Rissio', 'Administrador', 'brunorissi@garbuio.com.br', '19981955602', '375.652.298-90', 'Gui@19==', 5);

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
-- Índices para tabela `pwdtemp`
--
ALTER TABLE `pwdtemp`
  ADD PRIMARY KEY (`pwd_temp`);

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
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `activities`
--
ALTER TABLE `activities`
  MODIFY `atctive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `chamados`
--
ALTER TABLE `chamados`
  MODIFY `chamado_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `curso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4735818;

--
-- AUTO_INCREMENT de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `disciplina_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `laboratorios`
--
ALTER TABLE `laboratorios`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `locacao`
--
ALTER TABLE `locacao`
  MODIFY `locacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `prioridades`
--
ALTER TABLE `prioridades`
  MODIFY `prioridade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pwdtemp`
--
ALTER TABLE `pwdtemp`
  MODIFY `pwd_temp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `req_software`
--
ALTER TABLE `req_software`
  MODIFY `rqs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `semestre`
--
ALTER TABLE `semestre`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `softwares`
--
ALTER TABLE `softwares`
  MODIFY `software_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `so_disponivel`
--
ALTER TABLE `so_disponivel`
  MODIFY `sod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
