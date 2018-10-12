-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Out-2018 às 05:26
-- Versão do servidor: 10.1.35-MariaDB
-- versão do PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ope`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista`
--

CREATE TABLE `lista` (
  `id` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `tb_aux_pedido` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_aux_pedido`
--

INSERT INTO `tb_aux_pedido` (`id`, `id_pedido`, `id_cliente`) VALUES
(28, 30, 0),
(29, 31, 0),
(30, 32, 3),
(31, 33, 0),
(32, 34, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cargo`
--

CREATE TABLE `tb_cargo` (
  `idcargo` int(11) NOT NULL,
  `cargo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_cargo`
--

INSERT INTO `tb_cargo` (`idcargo`, `cargo`) VALUES
(1, 'Administrador'),
(2, 'Funcionário'),
(3, 'Cozinheiro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_categoria`
--

CREATE TABLE `tb_categoria` (
  `idcategoria` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_categoria`
--

INSERT INTO `tb_categoria` (`idcategoria`, `categoria`, `status`) VALUES
(1, 'Perecível', b'1'),
(2, 'teste', b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `idcliente` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `cpf` varchar(50) NOT NULL,
  `status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_cliente`
--

INSERT INTO `tb_cliente` (`idcliente`, `nome`, `sobrenome`, `cpf`, `status`) VALUES
(1, 'Vinicius', 'Oliveira', '22494676843', b'1'),
(3, 'ope', 'ope', '000.000.000-00', b'1'),
(4, 'test', 'test', 'test', b'1'),
(5, 'Lucas', 'test', '654.654.654-65', b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente_endereco`
--

CREATE TABLE `tb_cliente_endereco` (
  `id` int(11) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `estado` char(2) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_cliente_endereco`
--

INSERT INTO `tb_cliente_endereco` (`id`, `endereco`, `numero`, `cidade`, `bairro`, `estado`, `id_cliente`) VALUES
(1, 'Rua São paulo', '222', 'Arujá', 'Jd real', 'SP', 1),
(2, 'ope', '333', 'ope', 'ope', 'SP', 3),
(3, 'test', 'test', 'tet', 'test', 'SP', 4),
(4, 'L test', '321', 'L test', 'L test', 'SP', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente_telefone`
--

CREATE TABLE `tb_cliente_telefone` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `tel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_cliente_telefone`
--

INSERT INTO `tb_cliente_telefone` (`id`, `id_cliente`, `tel`) VALUES
(1, 1, '46522937'),
(2, 3, 'ope'),
(3, 4, 'test'),
(4, 5, '65-46561-3521');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_endereco`
--

CREATE TABLE `tb_endereco` (
  `idendereco` int(11) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `numero` varchar(200) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `estado` char(2) NOT NULL,
  `cpf` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(8, 'AV. Tiradentes', '350C - Apart 4', 'Arujá', 'Arujazihho', 'SP', '95175365415954'),
(9, 'Rua teste', 'AC98', 'Arujá', 'TESTE', 'SP', '123'),
(10, 'Rua teste', 'AC98', 'Arujá', 'TESTE', 'SP', '123'),
(11, 'Rua teste', 'AC98', 'Arujá', 'TESTE', 'SP', '123'),
(12, 'ope', '654', 'ope', 'ope', 'SP', '654'),
(13, 'ope', '4', 'ope', 'ope', 'SP', '849564654');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_ficha_funcionario`
--

CREATE TABLE `tb_ficha_funcionario` (
  `id` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `id_telefone` int(11) NOT NULL,
  `id_acao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fornecedor`
--

CREATE TABLE `tb_fornecedor` (
  `idfornecedor` int(11) NOT NULL,
  `fornecedor` varchar(255) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_fornecedor`
--

INSERT INTO `tb_fornecedor` (`idfornecedor`, `fornecedor`, `cnpj`, `email`, `status`) VALUES
(1, 'Skol', '00123456', 'skol@skol.com', b'1'),
(2, 'Danone', '0231321', 'danone@danone.com', b'1'),
(3, 'test', 'test', 'test@test.com', b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fornecedor_endereco`
--

CREATE TABLE `tb_fornecedor_endereco` (
  `id` int(11) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `numero` varchar(25) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `estado` char(2) NOT NULL,
  `id_fornecedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_fornecedor_endereco`
--

INSERT INTO `tb_fornecedor_endereco` (`id`, `endereco`, `numero`, `cidade`, `bairro`, `estado`, `id_fornecedor`) VALUES
(1, 'Teste', '98', 'Teste', 'teste', 'SP', 1),
(2, 'teste', '54', 'teste', 'teste', 'SP', 2),
(3, 'test', 'test', 'test', 'test', 'SP', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fornecedor_telefone`
--

CREATE TABLE `tb_fornecedor_telefone` (
  `id` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `tel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_fornecedor_telefone`
--

INSERT INTO `tb_fornecedor_telefone` (`id`, `id_fornecedor`, `tel`) VALUES
(1, 1, '40028922'),
(2, 2, '321564'),
(3, 3, 'test');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_funcionario`
--

CREATE TABLE `tb_funcionario` (
  `idfuncionario` int(11) NOT NULL,
  `cpf` char(14) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `sobrenome` varchar(250) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_funcionario`
--

INSERT INTO `tb_funcionario` (`idfuncionario`, `cpf`, `nome`, `id_cargo`, `sobrenome`, `email`, `senha`, `status`) VALUES
(1, '22494676843', 'Vinicius', 1, 'Oliveira', 'vinicius@exemplo.com', '123456', 1),
(8, '14725836901472', 'teste', 2, 'teste', 'teste@teste.com', 'teste', 1),
(9, 'op', 'ope', 2, 'ope', 'paulovinicius_ti@outlook.com', 'ope', 1),
(10, 'test', 'test', 1, 'test54', 'teste@t32.com', 'test', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_funcionario_endereco`
--

CREATE TABLE `tb_funcionario_endereco` (
  `idenderecofunc` int(11) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `estado` char(2) NOT NULL,
  `id_funcionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_funcionario_endereco`
--

INSERT INTO `tb_funcionario_endereco` (`idenderecofunc`, `endereco`, `numero`, `cidade`, `bairro`, `estado`, `id_funcionario`) VALUES
(1, 'Rua São paulo', '333', 'Arujá', 'Jd real', 'SP', 1),
(2, 'teste', 'teste', 'teste', 'teste', 'SP', 8),
(3, 'ope', 'ope', 'ope', 'ope', 'SP', 9),
(4, 'tet', 'test', 'test', 'test', 'SP', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_funcionario_telefone`
--

CREATE TABLE `tb_funcionario_telefone` (
  `id` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `tel` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_funcionario_telefone`
--

INSERT INTO `tb_funcionario_telefone` (`id`, `id_funcionario`, `tel`) VALUES
(1, 1, 46522937),
(2, 8, 222),
(3, 9, 0),
(4, 10, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pedido`
--

CREATE TABLE `tb_pedido` (
  `idpedido` int(11) NOT NULL,
  `cliente` varchar(200) DEFAULT 'Não informado',
  `id_funcionario` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `clienteCad` bit(1) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_pedido`
--

INSERT INTO `tb_pedido` (`idpedido`, `cliente`, `id_funcionario`, `status`, `clienteCad`, `total`) VALUES
(30, 'Teste 1', 1, 'A', b'0', '50'),
(31, 'Carina', 8, 'A', b'0', '30'),
(32, 'ope ope', 8, 'C', b'1', '0'),
(33, 'Não informado', 1, 'A', b'0', '12'),
(34, 'Vinicius Oliveira', 1, 'C', b'1', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produto`
--

CREATE TABLE `tb_produto` (
  `idproduto` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `id_categoria` int(1) NOT NULL,
  `estoque` int(11) NOT NULL,
  `preco_unit` decimal(10,0) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `status` bit(1) NOT NULL,
  `alerta_estoque` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_produto`
--

INSERT INTO `tb_produto` (`idproduto`, `nome`, `id_categoria`, `estoque`, `preco_unit`, `id_fornecedor`, `status`, `alerta_estoque`) VALUES
(1, 'Cerveja G', 1, 10, '10', 1, b'1', 0),
(2, 'Danoninho', 1, 43, '6', 1, b'1', 10),
(3, 'Leite saquinho', 1, 50, '5', 1, b'1', 456),
(4, 'Produto meu', 1, 2000, '20', 0, b'0', 10),
(5, 'rwewe', 1, 100, '10', 2, b'1', 10),
(6, 'coca', 0, 10, '10', 0, b'0', 10),
(7, 'Coca', 2, 10, '10', 1, b'1', 10),
(8, 'Fanta Uva', 0, 30, '10', 1, b'0', 10),
(9, 'Suco', 0, 20, '10', 1, b'1', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produto_pedido`
--

CREATE TABLE `tb_produto_pedido` (
  `id` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_produto_pedido`
--

INSERT INTO `tb_produto_pedido` (`id`, `qtd`, `id_pedido`, `id_produto`, `status`) VALUES
(44, 5, 30, 1, b'1'),
(45, 5, 31, 2, b'1'),
(46, 2, 33, 2, b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_aux_pedido`
--
ALTER TABLE `tb_aux_pedido`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_cargo`
--
ALTER TABLE `tb_cargo`
  ADD PRIMARY KEY (`idcargo`);

--
-- Indexes for table `tb_categoria`
--
ALTER TABLE `tb_categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indexes for table `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indexes for table `tb_cliente_endereco`
--
ALTER TABLE `tb_cliente_endereco`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_cliente_telefone`
--
ALTER TABLE `tb_cliente_telefone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_endereco`
--
ALTER TABLE `tb_endereco`
  ADD PRIMARY KEY (`idendereco`);

--
-- Indexes for table `tb_ficha_funcionario`
--
ALTER TABLE `tb_ficha_funcionario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_fornecedor`
--
ALTER TABLE `tb_fornecedor`
  ADD PRIMARY KEY (`idfornecedor`);

--
-- Indexes for table `tb_fornecedor_endereco`
--
ALTER TABLE `tb_fornecedor_endereco`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_fornecedor_telefone`
--
ALTER TABLE `tb_fornecedor_telefone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  ADD PRIMARY KEY (`idfuncionario`);

--
-- Indexes for table `tb_funcionario_endereco`
--
ALTER TABLE `tb_funcionario_endereco`
  ADD PRIMARY KEY (`idenderecofunc`);

--
-- Indexes for table `tb_funcionario_telefone`
--
ALTER TABLE `tb_funcionario_telefone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pedido`
--
ALTER TABLE `tb_pedido`
  ADD PRIMARY KEY (`idpedido`);

--
-- Indexes for table `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD PRIMARY KEY (`idproduto`);

--
-- Indexes for table `tb_produto_pedido`
--
ALTER TABLE `tb_produto_pedido`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lista`
--
ALTER TABLE `lista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_aux_pedido`
--
ALTER TABLE `tb_aux_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tb_cargo`
--
ALTER TABLE `tb_cargo`
  MODIFY `idcargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_categoria`
--
ALTER TABLE `tb_categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_cliente_endereco`
--
ALTER TABLE `tb_cliente_endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_cliente_telefone`
--
ALTER TABLE `tb_cliente_telefone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_endereco`
--
ALTER TABLE `tb_endereco`
  MODIFY `idendereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_ficha_funcionario`
--
ALTER TABLE `tb_ficha_funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_fornecedor`
--
ALTER TABLE `tb_fornecedor`
  MODIFY `idfornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_fornecedor_endereco`
--
ALTER TABLE `tb_fornecedor_endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_fornecedor_telefone`
--
ALTER TABLE `tb_fornecedor_telefone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  MODIFY `idfuncionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_funcionario_endereco`
--
ALTER TABLE `tb_funcionario_endereco`
  MODIFY `idenderecofunc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_funcionario_telefone`
--
ALTER TABLE `tb_funcionario_telefone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pedido`
--
ALTER TABLE `tb_pedido`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_produto`
--
ALTER TABLE `tb_produto`
  MODIFY `idproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_produto_pedido`
--
ALTER TABLE `tb_produto_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
