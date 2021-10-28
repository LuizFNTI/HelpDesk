-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 28/10/2021 às 17:17
-- Versão do servidor: 8.0.21
-- Versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_helpdesk`
--
CREATE DATABASE IF NOT EXISTS `db_helpdesk` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_helpdesk`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `cod_categoria` int NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(45) NOT NULL,
  `tipo_cod_tipo` int NOT NULL,
  PRIMARY KEY (`cod_categoria`),
  KEY `fk_categoria_tipo1_idx` (`tipo_cod_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`cod_categoria`, `nome_categoria`, `tipo_cod_tipo`) VALUES
(1, 'Hardware', 1),
(2, 'Software', 1),
(3, 'Sistemas', 1),
(4, 'Telefonia', 1),
(5, 'Rede', 1),
(6, 'E-mail', 1),
(7, 'Hardware', 2),
(8, 'Software', 2),
(9, 'Sistemas', 2),
(10, 'Telefonia', 2),
(11, 'Rede', 2),
(12, 'E-mail', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `chamados`
--

DROP TABLE IF EXISTS `chamados`;
CREATE TABLE IF NOT EXISTS `chamados` (
  `numero_chamado` int NOT NULL AUTO_INCREMENT,
  `descricao` blob NOT NULL,
  `data_abertura` date NOT NULL,
  `data_prazo` date DEFAULT NULL,
  `data_fechamento` date DEFAULT NULL,
  `hora_abertura` datetime(6) NOT NULL,
  `hora_fechamento` datetime(6) DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `prioridade` varchar(45) NOT NULL,
  `tipo_atendimento` varchar(45) NOT NULL,
  `usuarios_matricula` int NOT NULL,
  `item_cod_item` int NOT NULL,
  PRIMARY KEY (`numero_chamado`),
  KEY `fk_chamados_usuarios_idx` (`usuarios_matricula`),
  KEY `fk_chamados_item1_idx` (`item_cod_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `cod_item` int NOT NULL AUTO_INCREMENT,
  `nome_item` varchar(45) NOT NULL,
  `subcategoria_cod_subcategoria` int NOT NULL,
  PRIMARY KEY (`cod_item`),
  KEY `fk_item_subcategoria1_idx` (`subcategoria_cod_subcategoria`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `item`
--

INSERT INTO `item` (`cod_item`, `nome_item`, `subcategoria_cod_subcategoria`) VALUES
(1, 'Não Liga', 1),
(2, 'Tela Azul', 1),
(3, 'Lentidão', 1),
(4, 'Outros', 1),
(5, 'Novo Desktop', 7),
(6, 'Troca de Mesa', 7),
(7, 'Não Liga', 2),
(8, 'Novo Monitor', 8),
(9, 'Não Funciona', 3),
(10, 'Novo Mouse', 9),
(11, 'Não Funciona', 4),
(12, 'Novo Teclado', 10),
(13, 'Não Liga', 5),
(14, 'Não Conecta', 5),
(15, 'Não Imprime', 5),
(16, 'Instalação', 11),
(17, 'Não Funciona', 6),
(18, 'Instalação', 12),
(19, 'Não Abre', 13),
(20, 'Instalação', 19),
(21, 'Ativação', 19),
(22, 'Não Inicia', 14),
(23, 'Lentidão', 14),
(24, 'Ativação', 20),
(25, 'Formatação', 20),
(26, 'Backup', 20),
(27, 'Não Funciona', 15),
(28, 'Instalação', 21),
(29, 'Não Abre', 16),
(30, 'Lentidão', 16),
(31, 'Instalação', 22),
(32, 'Configuracão', 22),
(33, 'Não Abre', 17),
(34, 'Instalação', 23),
(35, 'Não Abre', 18),
(36, 'Instalação', 24),
(37, 'Não Abre', 25),
(38, 'Acesso', 29),
(39, 'Não Abre', 26),
(40, 'Acesso', 30),
(41, 'Não Abre', 27),
(42, 'Acesso', 31),
(43, 'Não Funciona', 28),
(44, 'Acesso', 32),
(45, 'Não Funciona', 33),
(46, 'Chiado ', 33),
(47, 'Instalação', 35),
(48, 'Troca de Aparelho', 35),
(49, 'Troca de Mesa', 35),
(50, 'Rompimento', 37),
(51, 'Troca de Cabos', 40),
(52, 'Troca de Lugar', 40),
(53, 'Nova Ligacao', 40),
(54, 'Não Funciona', 38),
(55, 'Troca de Aparelho', 41),
(56, 'Configuração', 41),
(57, 'Troca de Lugar', 41),
(58, 'Sem Internet', 39),
(59, 'Configuração', 42),
(60, 'Liberar Acesso', 42),
(61, 'Não Abre', 43),
(62, 'Não Conecta', 43),
(63, 'Configuração', 45),
(64, 'Ativação', 45),
(65, 'Não abre', 44),
(66, 'Configuração', 46);

-- --------------------------------------------------------

--
-- Estrutura para tabela `subcategoria`
--

DROP TABLE IF EXISTS `subcategoria`;
CREATE TABLE IF NOT EXISTS `subcategoria` (
  `cod_subcategoria` int NOT NULL AUTO_INCREMENT,
  `nome_subcategoria` varchar(45) NOT NULL,
  `categoria_cod_categoria` int NOT NULL,
  PRIMARY KEY (`cod_subcategoria`),
  KEY `fk_subcategoria_categoria1_idx` (`categoria_cod_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `subcategoria`
--

INSERT INTO `subcategoria` (`cod_subcategoria`, `nome_subcategoria`, `categoria_cod_categoria`) VALUES
(1, 'Desktop', 1),
(2, 'Monitor', 1),
(3, 'Mouse', 1),
(4, 'Teclado', 1),
(5, 'Impressora', 1),
(6, 'Scanner', 1),
(7, 'Desktop', 8),
(8, 'Monitor', 8),
(9, 'Mouse', 8),
(10, 'Teclado', 8),
(11, 'Impressora', 8),
(12, 'Scanner', 8),
(13, 'Office', 2),
(14, 'Windows', 2),
(15, 'Antivírus', 2),
(16, 'Navegadores', 2),
(17, 'Certificados', 2),
(18, 'Outros', 2),
(19, 'Office', 9),
(20, 'Windows', 9),
(21, 'Antivirus', 9),
(22, 'Navegadores', 9),
(23, 'Certificados', 9),
(24, 'Outros', 9),
(25, 'IPM', 3),
(26, 'Protocolo', 3),
(27, 'MV', 3),
(28, 'Diária', 3),
(29, 'IPM', 10),
(30, 'Protocolo', 10),
(31, 'MV', 10),
(32, 'Diária', 10),
(33, 'Aparelho', 4),
(34, 'Linha', 4),
(35, 'Aparelho', 11),
(36, 'Linha', 11),
(37, 'Cabeamento', 5),
(38, 'Roteador', 5),
(39, 'Internet', 5),
(40, 'Cabeamento', 12),
(41, 'Roteador', 12),
(42, 'Internet', 12),
(43, 'Outlook', 6),
(44, 'Webmail', 6),
(45, 'Outlook', 13),
(46, 'Webmail', 13);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo`
--

DROP TABLE IF EXISTS `tipo`;
CREATE TABLE IF NOT EXISTS `tipo` (
  `cod_tipo` int NOT NULL AUTO_INCREMENT,
  `nome_tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`cod_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tipo`
--

INSERT INTO `tipo` (`cod_tipo`, `nome_tipo`) VALUES
(1, 'Falha'),
(2, 'Requisição');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `matricula` int NOT NULL,
  `nome` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `departamento` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `nivel` int NOT NULL,
  `ativo` int NOT NULL,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`matricula`, `nome`, `telefone`, `email`, `departamento`, `senha`, `nivel`, `ativo`) VALUES
(1, 'Luiz', '32711108', '123@gmail.com', 'TI', '1234', 0, 0),
(2, 'php', '999999999', 'php@php.com', 'TI', '555', 0, 0);

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria_tipo1` FOREIGN KEY (`tipo_cod_tipo`) REFERENCES `tipo` (`cod_tipo`);

--
-- Restrições para tabelas `chamados`
--
ALTER TABLE `chamados`
  ADD CONSTRAINT `fk_chamados_item1` FOREIGN KEY (`item_cod_item`) REFERENCES `item` (`cod_item`),
  ADD CONSTRAINT `fk_chamados_usuarios` FOREIGN KEY (`usuarios_matricula`) REFERENCES `usuarios` (`matricula`);

--
-- Restrições para tabelas `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_item_subcategoria1` FOREIGN KEY (`subcategoria_cod_subcategoria`) REFERENCES `subcategoria` (`cod_subcategoria`);

--
-- Restrições para tabelas `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `fk_subcategoria_categoria1` FOREIGN KEY (`categoria_cod_categoria`) REFERENCES `categoria` (`cod_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
