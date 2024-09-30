-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 22-Set-2024 às 20:35
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
-- Estrutura da tabela `tb_contas`
--

CREATE TABLE IF NOT EXISTS `tb_contas` (
  `Imagem` longblob NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Senha` varchar(25) NOT NULL,
  `Seguidores` int(11) NOT NULL,
  `Cargo` varchar(35) NOT NULL,
  `Empresa` varchar(35) NOT NULL,
  `Data_Nascimento` date NOT NULL,
  `Telefone` int(15) NOT NULL,
  `Sobre` varchar(100) NOT NULL,
  `Formacao` varchar(50) NOT NULL,
  `Habilidades` varchar(100) NOT NULL,
  `Interesses` varchar(100) NOT NULL,
  `Estado` varchar(20) NOT NULL,
  `Cidade` varchar(35) NOT NULL,
  `Seguindo` tinyint(1) DEFAULT '0',
  `Facebook` varchar(200) NOT NULL,
  `Instagram` varchar(200) NOT NULL,
  `Linkedin` varchar(200) NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
