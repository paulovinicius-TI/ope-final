-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10-Set-2018 às 18:11
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ope`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista`
--

CREATE TABLE IF NOT EXISTS `lista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text NOT NULL,
  `texto` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `lista`
--

INSERT INTO `lista` (`id`, `titulo`, `texto`) VALUES
(1, 'Teste 3', 'Content 4'),
(2, 'Teste 2', 'Content 4');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_aux_pedido`
--

CREATE TABLE IF NOT EXISTS `tb_aux_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_aux_pedido`
--

INSERT INTO `tb_aux_pedido` (`id`, `id_pedido`, `id_cliente`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cargo`
--

CREATE TABLE IF NOT EXISTS `tb_cargo` (
  `idcargo` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(50) NOT NULL,
  PRIMARY KEY (`idcargo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tb_cargo`
--

INSERT INTO `tb_cargo` (`idcargo`, `cargo`) VALUES
(1, 'Administrador'),
(2, 'Atendente'),
(3, 'Cozinheiro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_categoria`
--

CREATE TABLE IF NOT EXISTS `tb_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente`
--

CREATE TABLE IF NOT EXISTS `tb_cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` char(14) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_cliente`
--

INSERT INTO `tb_cliente` (`idcliente`, `cpf`, `nome`, `sobrenome`, `status`) VALUES
(1, '95195175375365', 'João', 'Vinicius', 1),
(2, '98778998765445', 'Fernando', 'Gomes', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_endereco`
--

CREATE TABLE IF NOT EXISTS `tb_endereco` (
  `idendereco` int(11) NOT NULL AUTO_INCREMENT,
  `endereco` varchar(255) NOT NULL,
  `numero` varchar(200) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `estado` char(2) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  PRIMARY KEY (`idendereco`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `tb_endereco`
--

INSERT INTO `tb_endereco` (`idendereco`, `endereco`, `numero`, `cidade`, `bairro`, `estado`, `cpf`) VALUES
(1, 'Rua: São Paulo', '333', 'Arujá', 'Jardim Real', 'SP', '22494676843'),
(2, 'Rua: Presidente Vemslau', '400', 'Santa Isabel', 'Centro', 'SP', '06065498765432'),
(3, 'AV: Antônio de Lima', '400', 'Arujá', 'Centro', 'SP', '98765432165487'),
(4, 'Rua: Santa julia, Vila dos Pescadores', '23C', 'Cubatão', 'Jardim Casqueiro', 'SP', '98765445678912'),
(5, 'Av: Tiradentes', '504', 'Guarulhos', 'Centro', 'SP', '95195175375365'),
(6, 'Rua: Recife', '98', 'Arujá', 'Mirante', 'SP', '98778998765445'),
(7, 'Rua: Teste', '98C', 'Arujá', 'Real', 'SP', '2265465424'),
(8, 'AV. Tiradentes', '350C - Apart 4', 'Arujá', 'Arujazihho', 'SP', '95175365415954');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_ficha_funcionario`
--

CREATE TABLE IF NOT EXISTS `tb_ficha_funcionario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_funcionario` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `id_telefone` int(11) NOT NULL,
  `id_acao` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_funcionario`
--

CREATE TABLE IF NOT EXISTS `tb_funcionario` (
  `idfuncionario` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` char(14) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `sobrenome` varchar(250) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`idfuncionario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `tb_funcionario`
--

INSERT INTO `tb_funcionario` (`idfuncionario`, `cpf`, `nome`, `id_cargo`, `sobrenome`, `email`, `senha`, `status`) VALUES
(1, '22494676843', 'Vinicius', 1, 'Oliveira', 'vinicius@exemplo.com', '123456', 1),
(2, '06065498765432', 'Jose', 2, 'Paulo', 'jose@exemplo.com', '123456', 0),
(3, '98765432165487', 'Hellen', 2, 'Alves', 'hellen@exemplo.com', '123456', 0),
(4, '98765445678912', 'Guilherme', 2, 'Matheus', 'guilherme@exemplo.com', '123456', 1),
(5, '95175365415954', 'Deived', 3, 'Alves', 'deived@exemplo.com', '123456', 0),
(6, '2265465424', 'teste', 3, 'tester', 'teste@exemplo.com', '123456', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pedido`
--

CREATE TABLE IF NOT EXISTS `tb_pedido` (
  `idpedido` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` varchar(200) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `clienteCad` tinyint(1) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  PRIMARY KEY (`idpedido`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_pedido`
--

INSERT INTO `tb_pedido` (`idpedido`, `cliente`, `id_funcionario`, `status`, `clienteCad`, `total`) VALUES
(1, 'Guilherme Alves', 1, 'F', 0, '0'),
(2, 'João', 1, 'A', 1, '10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produto`
--

CREATE TABLE IF NOT EXISTS `tb_produto` (
  `idproduto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `categoria` char(1) NOT NULL,
  `qtd` int(11) NOT NULL,
  `preco_unit` decimal(10,0) NOT NULL,
  PRIMARY KEY (`idproduto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_produto`
--

INSERT INTO `tb_produto` (`idproduto`, `nome`, `categoria`, `qtd`, `preco_unit`) VALUES
(1, 'Cerveja', 'P', 20, '5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produto_pedido`
--

CREATE TABLE IF NOT EXISTS `tb_produto_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qtd` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `preco_total` decimal(11,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_produto_pedido`
--

INSERT INTO `tb_produto_pedido` (`id`, `qtd`, `id_pedido`, `id_produto`, `preco_total`) VALUES
(1, 2, 2, 1, '10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_telefone`
--

CREATE TABLE IF NOT EXISTS `tb_telefone` (
  `idtelefone` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(14) NOT NULL,
  `tel` varchar(15) NOT NULL,
  PRIMARY KEY (`idtelefone`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `tb_telefone`
--

INSERT INTO `tb_telefone` (`idtelefone`, `cpf`, `tel`) VALUES
(1, '22494676843', '46522937'),
(2, '06065498765432', '40028922'),
(3, '98765432165487', '46511913'),
(4, '98765445678912', '46533557'),
(5, '95195175375365', '46529865'),
(6, '98778998765445', '40025674'),
(7, '2265465424', '46526578'),
(8, '95175365415954', '49876398');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
