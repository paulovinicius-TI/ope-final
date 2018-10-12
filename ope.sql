-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Out-2018 às 05:18
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD PRIMARY KEY (`idproduto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_produto`
--
ALTER TABLE `tb_produto`
  MODIFY `idproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
