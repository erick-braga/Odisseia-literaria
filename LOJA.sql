-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 30/07/2025 às 00:19
-- Versão do servidor: 10.11.13-MariaDB-0ubuntu0.24.04.1
-- Versão do PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `LOJA`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `LIVRARIA`
--

CREATE TABLE `LIVRARIA` (
  `ID` int(11) NOT NULL,
  `TITULO` varchar(150) NOT NULL,
  `EDITORA` varchar(100) NOT NULL,
  `AUTOR` varchar(100) NOT NULL,
  `IDIOMA` varcahr(50) NOT NULL,
  `GENERO` enum('Romance','Conto','Crônica','Poesia','Fábula','Drama',
  'Comédia','Tragédia','Auto','Ensaios','Literatura Infantil','Literatura Juvenil','Biografia','Autobiografia',
  'Memórias','Epistolar','Fantasia','Ficção Científica','Terror','Suspense','Mistério','Aventura','Histórico',
  'Policial','Psicológico','Erótico','Didático','Religioso','Espiritualista','Autoajuda','Humor','Satírico','Lírico',
  'Épico','Narrativo','Dramático','Gótico','Distopia','Utopia','Realismo Mágico','Regionalista','Naturalismo','Romantismo',
  'Modernismo','Pós-modernismo','Realismo','Simbolismo','Expressionismo','Existencialismo','Surrealismo') NOT NULL,
  `IMAGEM` longblob NOT NULL,
  `FORMATO` enum('FISICO','DIGITAL') NOT NULL,
  `VALOR_COMPRA` decimal(10,2) NOT NULL,
  `ANO_PUBLICACAO` year(4) NOT NULL,
  `ESTADO` enum('NOVO','SEMINOVO','USADO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `LIVRARIA`
--
ALTER TABLE `LIVRARIA`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `LIVRARIA`
--
ALTER TABLE `LIVRARIA`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
