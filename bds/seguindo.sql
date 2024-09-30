-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 22-Set-2024 às 20:34
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `mesh`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `seguindo`
--

CREATE TABLE IF NOT EXISTS `seguindo` (
  `seguidor_email` varchar(255) NOT NULL DEFAULT '',
  `seguido_email` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`seguidor_email`,`seguido_email`),
  KEY `seguido_email` (`seguido_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `seguindo`
--
ALTER TABLE `seguindo`
  ADD CONSTRAINT `seguindo_ibfk_1` FOREIGN KEY (`seguidor_email`) REFERENCES `tb_contas` (`Email`),
  ADD CONSTRAINT `seguindo_ibfk_2` FOREIGN KEY (`seguido_email`) REFERENCES `tb_contas` (`Email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
