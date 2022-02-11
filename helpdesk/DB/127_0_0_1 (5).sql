-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 11/02/2022 às 18:26
-- Versão do servidor: 8.0.21
-- Versão do PHP: 8.1.2

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
  `localizacao` varchar(100) NOT NULL,
  `descricao` varchar(3000) NOT NULL,
  `descricao_analista` varchar(3000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `data_hora_abertura` datetime NOT NULL,
  `data_prazo` date DEFAULT NULL,
  `data_hora_fechamento` datetime DEFAULT NULL,
  `usuarios_matricula` int NOT NULL,
  `analista` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status_chamado_cod_status` int NOT NULL,
  `prioridade_chamado_cod_prioridade` int NOT NULL,
  `tipo_atendimento_cod_tipo_atendimento` int NOT NULL,
  `tipo_cod_tipo` int NOT NULL,
  `categoria_cod_categoria` int NOT NULL,
  `subcategoria_cod_subcategoria` int NOT NULL,
  `item_cod_item` int NOT NULL,
  `fila_geral` int NOT NULL,
  PRIMARY KEY (`numero_chamado`),
  KEY `fk_chamados_usuarios_idx` (`usuarios_matricula`),
  KEY `fk_chamados_item1_idx` (`item_cod_item`),
  KEY `fk_chamados_status_chamado1_idx` (`status_chamado_cod_status`),
  KEY `fk_chamados_prioridade_chamado1_idx` (`prioridade_chamado_cod_prioridade`),
  KEY `fk_chamados_tipo_atendimento1_idx` (`tipo_atendimento_cod_tipo_atendimento`),
  KEY `fk_chamados_tipo1_idx` (`tipo_cod_tipo`),
  KEY `fk_chamados_categoria1_idx` (`categoria_cod_categoria`),
  KEY `fk_chamados_subcategoria1_idx` (`subcategoria_cod_subcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `chamados`
--

INSERT INTO `chamados` (`numero_chamado`, `localizacao`, `descricao`, `descricao_analista`, `data_hora_abertura`, `data_prazo`, `data_hora_fechamento`, `usuarios_matricula`, `analista`, `status_chamado_cod_status`, `prioridade_chamado_cod_prioridade`, `tipo_atendimento_cod_tipo_atendimento`, `tipo_cod_tipo`, `categoria_cod_categoria`, `subcategoria_cod_subcategoria`, `item_cod_item`, `fila_geral`) VALUES
(8, '', 'Desktop novo', 'dfg', '2021-11-29 09:43:06', '2021-12-08', '2021-12-02 03:10:19', 1010, 'Analista', 1, 2, 1, 2, 7, 7, 5, 0),
(9, '', 'Não abre não', '', '2021-11-29 09:44:04', '0000-00-00', NULL, 1010, 'analista2', 2, 2, 1, 1, 2, 13, 19, 0),
(10, '', 'Instalar novo aparelho', NULL, '2021-11-29 09:46:04', '2022-02-17', NULL, 1010, 'Administrador', 5, 4, 4, 2, 10, 35, 47, 0),
(11, '', 'Cancela logo', '', '2021-11-29 09:46:59', '2021-11-10', NULL, 1010, 'analista2', 4, 2, 2, 1, 5, 39, 58, 0),
(12, '', 'teste', '', '2021-11-30 10:45:45', '2022-01-26', NULL, 1111, 'Analista', 5, 1, 1, 2, 8, 22, 31, 0),
(13, '', 'juhyhy', '', '2021-11-30 11:01:15', '2021-12-24', NULL, 1111, 'analista2', 6, 1, 1, 2, 12, 45, 63, 0),
(14, '', 'kl.,.ç,p,,p0,p', '', '2021-12-15 15:29:34', '2021-12-26', NULL, 1010, 'Analista', 7, 1, 2, 2, 8, 22, 32, 0),
(15, '', 'jjjjhjhjhjhhh', '', '2021-12-16 08:14:21', '2021-12-25', NULL, 1010, 'Analista', 8, 2, 1, 1, 2, 14, 23, 0),
(16, '', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Harum earum, delectus numquam eius debitis quas dolor. Vitae asperiores illo laborum earum aspernatur voluptate, dolorem explicabo quidem optio? Similique, esse! Accusamus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima dolorem similique deleniti ea autem qui nemo aspernatur sit labore neque. Autem, quidem nam. Ea laborum deserunt eligendi mollitia aliquam fugiat?locale_accept_from_http Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere reiciendis assumenda tenetur tempore, officiis facilis odit ullam quia voluptatum animi nisi id accusantium laboriosam eveniet doloremque non commodi optio est! Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, temporibus reiciendis quos deserunt fuga recusandae excepturi. Corrupti vitae repudiandae maiores aspernatur ullam, dolores inventore eaque, dignissimos at unde ducimus officiis!', '', '2022-01-04 14:08:45', '2022-01-26', NULL, 1010, 'Administrador', 9, 4, 2, 2, 11, 41, 57, 0),
(17, 'parede2', ' rtyu222222222222222222222', '', '2022-01-06 13:18:35', '2022-01-27', NULL, 3030, 'Administrador', 10, 2, 2, 2, 8, 20, 25, 0),
(18, 'Algun lugar', 'Teste status', '', '2022-01-21 09:37:55', '2022-01-22', NULL, 3030, 'Administrador', 11, 3, 4, 1, 2, 13, 19, 0),
(19, 'Algun lugar', 'test', NULL, '2022-01-21 15:08:44', '0000-00-00', NULL, 3030, 'Administrador', 6, 2, 1, 1, 2, 14, 22, 0),
(20, 'sei la', 't', NULL, '2022-01-21 15:21:22', '0000-00-00', NULL, 3030, 'Administrador', 2, 2, 1, 2, 7, 8, 8, 0),
(22, 'lll', 'kkkkkk', NULL, '2022-02-03 09:31:03', '0000-00-00', NULL, 3030, 'Administrador', 7, 3, 2, 2, 7, 8, 8, 0),
(28, 'iukjjjj', 'hhhhhhhhhhhhhhhhhhhh', NULL, '2022-02-11 10:22:56', '2022-02-08', NULL, 3030, 'Administrador', 2, 2, 2, 1, 1, 2, 7, 0),
(29, 'ppopo', 'okkkkkkk', NULL, '2022-02-11 10:57:14', '2022-02-01', NULL, 3030, 'Administrador', 2, 2, 3, 1, 3, 26, 39, 0),
(30, 'nmnmnj', 'jjjjjnnuunnjjjj', NULL, '2022-02-11 10:59:27', '2022-02-03', NULL, 3030, 'Administrador', 2, 3, 2, 1, 2, 13, 19, 0),
(31, 'nnjjjjj', 'jjjjjjjujnjhjh', NULL, '2022-02-11 10:59:50', '2022-02-15', NULL, 3030, 'Administrador', 2, 2, 1, 2, 7, 8, 8, 0),
(32, 'lll', 'uijjujuuu', NULL, '2022-02-11 11:11:16', '2022-02-08', NULL, 3030, 'Administrador', 3, 1, 2, 1, 2, 16, 29, 0),
(33, 'ppopo', 'oioikkk', NULL, '2022-02-11 11:19:28', '2022-02-08', NULL, 3030, 'Administrador', 1, 1, 2, 1, 3, 26, 39, 0),
(34, 'l0oo00oo', 'iokkkk9', NULL, '2022-02-11 11:26:19', '2022-02-09', NULL, 3030, 'Administrador', 1, 1, 1, 2, 9, 30, 40, 0),
(35, 'ppopo', 'uiiiu78iuu787', NULL, '2022-02-11 13:20:49', '2022-02-08', NULL, 3030, 'Administrador', 1, 2, 2, 1, 1, 1, 2, 0),
(36, 'ppopo', 'loi998999', NULL, '2022-02-11 13:53:21', '2022-02-07', NULL, 3030, 'Administrador', 1, 2, 1, 1, 1, 1, 2, 0),
(37, 'lll', '0PO0000', NULL, '2022-02-11 14:37:25', '2022-02-15', NULL, 3030, 'Administrador', 2, 1, 2, 1, 1, 3, 9, 0),
(38, 'bbgbbb', 'bbbbghggg', NULL, '2022-02-11 14:42:46', '2022-02-08', NULL, 3030, 'Administrador', 2, 2, 1, 1, 3, 25, 37, 0),
(39, 'tttttt', 'ttttttt', NULL, '2022-02-11 14:47:15', '2022-02-08', NULL, 3030, 'Administrador', 2, 1, 1, 1, 2, 13, 19, 0),
(40, '-´p', '´´p´-´-', NULL, '2022-02-11 15:07:33', NULL, NULL, 3030, NULL, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `departamento`
--

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `cod_departamento` int NOT NULL AUTO_INCREMENT,
  `nome_departamento` varchar(45) NOT NULL,
  `ativo` int NOT NULL,
  PRIMARY KEY (`cod_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `departamento`
--

INSERT INTO `departamento` (`cod_departamento`, `nome_departamento`, `ativo`) VALUES
(0, 'TI22', 1),
(1, 'TI11', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `prioridade_chamado`
--

INSERT INTO `prioridade_chamado` (`cod_prioridade`, `nome_prioridade`, `ativo`) VALUES
(1, 'Baixa', 1),
(2, 'Média', 0),
(3, 'Alta', 0),
(4, 'Crítica', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `status_chamado`
--

INSERT INTO `status_chamado` (`cod_status`, `nome_status`, `ativo`) VALUES
(1, 'Pendente', 1),
(2, 'Em Andamento', 1),
(3, 'Finalizado', 0),
(4, 'Cancelado', 1),
(5, 'Teste', 0),
(6, 'Atualizar', 1),
(7, 'Correção', 0),
(8, 'Aguardando Usuário', 0),
(9, 'Fornecedor', 0),
(10, 'Rejeitado', 0),
(11, 'Em Análise', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tipo`
--

INSERT INTO `tipo` (`cod_tipo`, `nome_tipo`, `ativo`) VALUES
(1, 'Falha', 1),
(2, 'Requisição', 1),
(3, 'Reclamação', 0),
(4, 'Teste', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tipo_atendimento`
--

INSERT INTO `tipo_atendimento` (`cod_tipo_atendimento`, `nome_tipo_atendimento`, `ativo`) VALUES
(1, 'Dúvidas do Usuário', 1),
(2, 'Erro Operacional', 1),
(3, 'Sistemas', 0),
(4, 'Suporte', 0);

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
  `senha` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `chave` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nivel` int NOT NULL,
  `ativo` int NOT NULL,
  PRIMARY KEY (`matricula`),
  KEY `fk_cod_departamento` (`departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`matricula`, `nome`, `telefone`, `email`, `departamento`, `senha`, `chave`, `nivel`, `ativo`) VALUES
(100, 'tdep', '100100100', 'dep@dep.com', '0', '$2y$10$G0.Kzzfkv3ap8LJajAHPWe85Y/JFEq/otS1PLMh4Drzvw9qvYhveS', '$2y$10$25Y/w/FBf5vlNLJjxb3sl.kGUhKZ7FMBzdJuhG5B3pIX2m8xiVMqS', 1, 0),
(1010, 'Usuário', '11111111', 'usuario@user.com', '0', '$2y$10$jtIZQ/bKD/7Foi7gTwTkOeF8zGqAqMCQjmLbXY/qvQT7LjMKWfjHG', '$2y$10$v3y/N.akS2ibsRrkfUlgduu7t28f4TeaoGXIx0MMhpiNTbtR2lyZ2', 0, 1),
(1111, 'usuário2', '45454545', 'usuario2@user.com', '1', '$2y$10$ehiuEP5zU0FLOooKZrjQi.tQNxivTblHuFcmQ5VerB3uuJo4ufEZm', '', 0, 0),
(2020, 'Analista', '22222222', 'analista@user.com', '1', '$2y$10$.8tIvNKSQZM6WpNRQgEy8uhKtRiQGxyF.heq9qPuKeLV2b9qMUQG.', '$2y$10$Mb/6u.DHsOgtCjLO4m2Pzu1KzuUEVckY4MOSxyN3K6QSJlChzpxbK', 1, 1),
(2121, 'analista22', '21212121', 'analista2@user.com', '0', '$2y$10$FrciR/9tx8te10yd3s2I2O0/z6mhXwcSsBTWFND0Dho.Qgl8Qf4bO', '', 1, 1),
(3030, 'Administrador', '33333333', 'adm@user.com', '1', '$2y$10$VUnJc/w3kMERv9nZtEucj.7J.WTC/jhc7Xpt4hg.RbGce1cQGPqMi', '', 2, 1);

--
-- Restrições para tabelas despejadas
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
