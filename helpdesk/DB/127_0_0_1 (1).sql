-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 23/11/2021 às 12:34
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
  `ativo` int NOT NULL,
  `tipo_cod_tipo` int NOT NULL,
  PRIMARY KEY (`cod_categoria`),
  KEY `fk_categoria_tipo1_idx` (`tipo_cod_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`cod_categoria`, `nome_categoria`, `ativo`, `tipo_cod_tipo`) VALUES
(1, 'Hardware', 1, 1),
(2, 'Software', 0, 1),
(3, 'Sistemas', 0, 1),
(4, 'Telefonia', 0, 1),
(5, 'Rede', 0, 1),
(6, 'E-mail', 1, 1),
(7, 'Hardware', 0, 2),
(8, 'Software', 0, 2),
(9, 'Sistemas', 0, 2),
(10, 'Telefonia', 0, 2),
(11, 'Rede', 0, 2),
(12, 'E-mail', 0, 2);

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
  `usuarios_matricula` int NOT NULL,
  `status_chamado_cod_status` int NOT NULL,
  `prioridade_chamado_cod_prioridade` int NOT NULL,
  `tipo_atendimento_cod_tipo_atendimento` int NOT NULL,
  `tipo_cod_tipo` int NOT NULL,
  `categoria_cod_categoria` int NOT NULL,
  `subcategoria_cod_subcategoria` int NOT NULL,
  `item_cod_item` int NOT NULL,
  `fechado` int NOT NULL,
  PRIMARY KEY (`numero_chamado`),
  KEY `fk_chamados_usuarios_idx` (`usuarios_matricula`),
  KEY `fk_chamados_item1_idx` (`item_cod_item`),
  KEY `fk_chamados_status_chamado1_idx` (`status_chamado_cod_status`),
  KEY `fk_chamados_prioridade_chamado1_idx` (`prioridade_chamado_cod_prioridade`),
  KEY `fk_chamados_tipo_atendimento1_idx` (`tipo_atendimento_cod_tipo_atendimento`),
  KEY `fk_chamados_tipo1_idx` (`tipo_cod_tipo`),
  KEY `fk_chamados_categoria1_idx` (`categoria_cod_categoria`),
  KEY `fk_chamados_subcategoria1_idx` (`subcategoria_cod_subcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `cod_item` int NOT NULL AUTO_INCREMENT,
  `nome_item` varchar(45) NOT NULL,
  `ativo` int NOT NULL,
  `subcategoria_cod_subcategoria` int NOT NULL,
  PRIMARY KEY (`cod_item`),
  KEY `fk_item_subcategoria1_idx` (`subcategoria_cod_subcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `item`
--

INSERT INTO `item` (`cod_item`, `nome_item`, `ativo`, `subcategoria_cod_subcategoria`) VALUES
(1, 'Não Liga', 1, 1),
(2, 'Tela Azul', 1, 1),
(3, 'Lentidão', 1, 1),
(4, 'Outros', 1, 1),
(5, 'Novo Desktop', 1, 7),
(6, 'Troca de Mesa', 1, 7),
(7, 'Não Liga', 1, 2),
(8, 'Novo Monitor', 1, 8),
(9, 'Não Funciona', 1, 3),
(10, 'Novo Mouse', 1, 9),
(11, 'Não Funciona', 1, 4),
(12, 'Novo Teclado', 1, 10),
(13, 'Não Liga', 1, 5),
(14, 'Não Conecta', 1, 5),
(15, 'Não Imprime', 1, 5),
(16, 'Instalação', 1, 11),
(17, 'Não Funciona', 1, 6),
(18, 'Instalação', 1, 12),
(19, 'Não Abre', 1, 13),
(20, 'Instalação', 1, 19),
(21, 'Ativação', 1, 19),
(22, 'Não Inicia', 1, 14),
(23, 'Lentidão', 1, 14),
(24, 'Ativação', 1, 20),
(25, 'Formatação', 1, 20),
(26, 'Backup', 1, 20),
(27, 'Não Funciona', 1, 15),
(28, 'Instalação', 1, 21),
(29, 'Não Abre', 1, 16),
(30, 'Lentidão', 1, 16),
(31, 'Instalação', 1, 22),
(32, 'Configuracão', 1, 22),
(33, 'Não Abre', 1, 17),
(34, 'Instalação', 1, 23),
(35, 'Não Abre', 1, 18),
(36, 'Instalação', 1, 24),
(37, 'Não Abre', 1, 25),
(38, 'Acesso', 1, 29),
(39, 'Não Abre', 1, 26),
(40, 'Acesso', 1, 30),
(41, 'Não Abre', 1, 27),
(42, 'Acesso', 1, 31),
(43, 'Não Funciona', 1, 28),
(44, 'Acesso', 1, 32),
(45, 'Não Funciona', 1, 33),
(46, 'Chiado ', 1, 33),
(47, 'Instalação', 1, 35),
(48, 'Troca de Aparelho', 1, 35),
(49, 'Troca de Mesa', 1, 35),
(50, 'Rompimento', 1, 37),
(51, 'Troca de Cabos', 1, 40),
(52, 'Troca de Lugar', 1, 40),
(53, 'Nova Ligacao', 1, 40),
(54, 'Não Funciona', 1, 38),
(55, 'Troca de Aparelho', 1, 41),
(56, 'Configuração', 1, 41),
(57, 'Troca de Lugar', 1, 41),
(58, 'Sem Internet', 1, 39),
(59, 'Configuração', 1, 42),
(60, 'Liberar Acesso', 1, 42),
(61, 'Não Abre', 1, 43),
(62, 'Não Conecta', 1, 43),
(63, 'Configuração', 1, 45),
(64, 'Ativação', 1, 45),
(65, 'Não abre', 1, 44),
(66, 'Configuração', 1, 46);

-- --------------------------------------------------------

--
-- Estrutura para tabela `prioridade_chamado`
--

DROP TABLE IF EXISTS `prioridade_chamado`;
CREATE TABLE IF NOT EXISTS `prioridade_chamado` (
  `cod_prioridade` int NOT NULL AUTO_INCREMENT,
  `nome_prioridade` varchar(45) NOT NULL,
  `ativo` int NOT NULL,
  PRIMARY KEY (`cod_prioridade`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `prioridade_chamado`
--

INSERT INTO `prioridade_chamado` (`cod_prioridade`, `nome_prioridade`, `ativo`) VALUES
(1, 'Baixa', 1),
(2, 'Média', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `status_chamado`
--

DROP TABLE IF EXISTS `status_chamado`;
CREATE TABLE IF NOT EXISTS `status_chamado` (
  `cod_status` int NOT NULL AUTO_INCREMENT,
  `nome_status` varchar(45) NOT NULL,
  `ativo` int NOT NULL,
  PRIMARY KEY (`cod_status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `status_chamado`
--

INSERT INTO `status_chamado` (`cod_status`, `nome_status`, `ativo`) VALUES
(1, 'Pendente', 1),
(2, 'Em Andamento', 1),
(3, 'Finalizado', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `subcategoria`
--

DROP TABLE IF EXISTS `subcategoria`;
CREATE TABLE IF NOT EXISTS `subcategoria` (
  `cod_subcategoria` int NOT NULL AUTO_INCREMENT,
  `nome_subcategoria` varchar(45) NOT NULL,
  `ativo` int NOT NULL,
  `categoria_cod_categoria` int NOT NULL,
  PRIMARY KEY (`cod_subcategoria`),
  KEY `fk_subcategoria_categoria1_idx` (`categoria_cod_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `subcategoria`
--

INSERT INTO `subcategoria` (`cod_subcategoria`, `nome_subcategoria`, `ativo`, `categoria_cod_categoria`) VALUES
(1, 'Desktop', 1, 1),
(2, 'Monitor', 1, 1),
(3, 'Mouse', 1, 1),
(4, 'Teclado', 1, 1),
(5, 'Impressora', 1, 1),
(6, 'Scanner', 1, 1),
(7, 'Desktop', 1, 7),
(8, 'Monitor', 1, 7),
(9, 'Mouse', 1, 7),
(10, 'Teclado', 1, 7),
(11, 'Impressora', 1, 7),
(12, 'Scanner', 1, 7),
(13, 'Office', 1, 2),
(14, 'Windows', 1, 2),
(15, 'Antivírus', 1, 2),
(16, 'Navegadores', 1, 2),
(17, 'Certificados', 1, 2),
(18, 'Outros', 1, 2),
(19, 'Office', 1, 8),
(20, 'Windows', 1, 8),
(21, 'Antivirus', 1, 8),
(22, 'Navegadores', 1, 8),
(23, 'Certificados', 1, 8),
(24, 'Outros', 1, 8),
(25, 'IPM', 1, 3),
(26, 'Protocolo', 1, 3),
(27, 'MV', 1, 3),
(28, 'Diária', 1, 3),
(29, 'IPM', 1, 9),
(30, 'Protocolo', 1, 9),
(31, 'MV', 1, 9),
(32, 'Diária', 1, 9),
(33, 'Aparelho', 1, 4),
(34, 'Linha', 1, 4),
(35, 'Aparelho', 1, 10),
(36, 'Linha', 1, 10),
(37, 'Cabeamento', 1, 5),
(38, 'Roteador', 1, 5),
(39, 'Internet', 1, 5),
(40, 'Cabeamento', 1, 11),
(41, 'Roteador', 1, 11),
(42, 'Internet', 1, 11),
(43, 'Outlook', 1, 6),
(44, 'Webmail', 1, 6),
(45, 'Outlook', 1, 12),
(46, 'Webmail', 1, 12);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo`
--

DROP TABLE IF EXISTS `tipo`;
CREATE TABLE IF NOT EXISTS `tipo` (
  `cod_tipo` int NOT NULL AUTO_INCREMENT,
  `nome_tipo` varchar(45) NOT NULL,
  `ativo` int NOT NULL,
  PRIMARY KEY (`cod_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tipo`
--

INSERT INTO `tipo` (`cod_tipo`, `nome_tipo`, `ativo`) VALUES
(1, 'Falha', 1),
(2, 'Requisição', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_atendimento`
--

DROP TABLE IF EXISTS `tipo_atendimento`;
CREATE TABLE IF NOT EXISTS `tipo_atendimento` (
  `cod_tipo_atendimento` int NOT NULL AUTO_INCREMENT,
  `nome_tipo_atendimento` varchar(45) NOT NULL,
  `ativo` int NOT NULL,
  PRIMARY KEY (`cod_tipo_atendimento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tipo_atendimento`
--

INSERT INTO `tipo_atendimento` (`cod_tipo_atendimento`, `nome_tipo_atendimento`, `ativo`) VALUES
(1, 'Dúvidas do Usuário', 1),
(2, 'Erro Operacional', 1);

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
(0, 'Usuário', '0000000', 'usuario@usuario.com', 'TI', '1234', 0, 1),
(1, 'Analista', '11111111', 'analista@analista.com', 'TI2', '123', 1, 1),
(2, 'Administrador', '22222222', 'adm@adm.com', 'TI', '12', 2, 1),
(789, 'PHP', '15815', 'php@php.com', 'TI2234', '1234', 0, 1),
(4880, 'Luizz', '999999999', '123@gmail.com', 'TI2', '1234', 2, 0);

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
  ADD CONSTRAINT `fk_chamados_categoria1` FOREIGN KEY (`categoria_cod_categoria`) REFERENCES `categoria` (`cod_categoria`),
  ADD CONSTRAINT `fk_chamados_item1` FOREIGN KEY (`item_cod_item`) REFERENCES `item` (`cod_item`),
  ADD CONSTRAINT `fk_chamados_prioridade_chamado1` FOREIGN KEY (`prioridade_chamado_cod_prioridade`) REFERENCES `prioridade_chamado` (`cod_prioridade`),
  ADD CONSTRAINT `fk_chamados_status_chamado1` FOREIGN KEY (`status_chamado_cod_status`) REFERENCES `status_chamado` (`cod_status`),
  ADD CONSTRAINT `fk_chamados_subcategoria1` FOREIGN KEY (`subcategoria_cod_subcategoria`) REFERENCES `subcategoria` (`cod_subcategoria`),
  ADD CONSTRAINT `fk_chamados_tipo1` FOREIGN KEY (`tipo_cod_tipo`) REFERENCES `tipo` (`cod_tipo`),
  ADD CONSTRAINT `fk_chamados_tipo_atendimento1` FOREIGN KEY (`tipo_atendimento_cod_tipo_atendimento`) REFERENCES `tipo_atendimento` (`cod_tipo_atendimento`),
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
