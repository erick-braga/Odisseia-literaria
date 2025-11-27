-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 16/09/2025 às 20:11
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja`
--

-- --------------------------------------------------------


-- Tabela de pedidos
  CREATE TABLE pedidos (
      id INT AUTO_INCREMENT PRIMARY KEY,
      cliente_nome VARCHAR(255) NOT NULL,
      cliente_email VARCHAR(255) NOT NULL,
      total DECIMAL(10,2) NOT NULL,
      data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  );

-- Tabela de itens do pedido
CREATE TABLE pedido_itens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE
);    



--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `cpf` varchar(14) NOT NULL,
  `senha` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`cpf`, `senha`) VALUES
('00000000000', '$2y$10$.Wh1mItACK2sogHycoQvFeICahWGD1Y.JS9ukssSKYrIG1GCf/MCy'),
('111111111111', '$2y$10$wRHXGr8fZNMhh1s0hJJJP.dzMaIpKSNnulnE1WsplfE/aop8fWkri'),
('12345678900', '$2y$10$3yZb6ARBmbi9eHZnKMFb9./Je7m9UtO.M8c/lH7gVxOKeMZZgThYC'),
('12345678901', '$2y$10$KUAJbboU6G6dEWzdoU1cr.hW685Aal9u/jzRBjr8igjZQJmOua61e'),
('12345678909', '$2y$10$0E.rOPz1VCnu2KI3Y4mAHO4aFQMJXjvnIN86xzsuZygT671jsEbPi');

-- --------------------------------------------------------

--
-- Estrutura para tabela `dados`
--

CREATE TABLE `dados` (
  `cpf` varchar(14) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `genero` enum('homem','mulher','transmasculino','transfeminino','naobinario','agenero','bigenero','pangenero','demiboy','demigirl','genderfluid','genderqueer','androgino','neutrois','two-spirit','intergenero','poligenero','maverique','omnigenero','x-gender','genderquestioning','gendernonconforming','gendervariant','androgyne','demiflux','autigenero','ceterogenero','greygender','neutro-gênero','floragenero','libragenero','novigenero','mirigenero','quarternario','omnisexual-gender','androsexual-gender','gynesexual-gender','skoliosexual-gender','demigender','subgender','novogender','transgenero','cisgenero','androqueer','gyniqueer','apogenero','ambigenero','exogenero','outra') NOT NULL,
  `nascimento` date NOT NULL,
  `fone` varchar(15) NOT NULL,
  `longadouro` varchar(75) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(150) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` char(2) NOT NULL,
  `cep` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `dados`
--

INSERT INTO `dados` (`cpf`, `nome`, `sobrenome`, `genero`, `nascimento`, `fone`, `longadouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`) VALUES
('111111111111', 'gdjdjdgj', 'jfggsjg', 'naobinario', '2025-09-03', '(11) 12345-6789', '', 3645, 'dghnrghrtgeh', 'rthrthrt', 'tghrth', 'SP', '12345678');

-- --------------------------------------------------------

--
-- Estrutura para tabela `LIVRARIA`
--

CREATE TABLE `LIVRARIA` (
  `ID` int(11) NOT NULL,
  `TITULO` varchar(150) NOT NULL,
  `EDITORA` varchar(100) NOT NULL,
  `AUTOR` varchar(100) NOT NULL,
  `IDIOMA` varchar(50) NOT NULL,
  `GENERO` enum('Romance','Conto','Crônica','Poesia','Fábula','Drama','Comédia','Tragédia','Auto','Ensaios','Literatura Infantil','Literatura Juvenil','Biografia','Autobiografia','Memórias','Epistolar','Fantasia','Ficção Científica','Terror','Suspense','Mistério','Aventura','Histórico','Policial','Psicológico','Erótico','Didático','Religioso','Espiritualista','Autoajuda','Humor','Satírico','Lírico','Épico','Narrativo','Dramático','Gótico','Distopia','Utopia','Realismo Mágico','Regionalista','Naturalismo','Romantismo','Modernismo','Pós-modernismo','Realismo','Simbolismo','Expressionismo','Existencialismo','Surrealismo') NOT NULL,
  `IMAGEM` varchar(125) NOT NULL,
  `FORMATO` enum('FISICO','DIGITAL') NOT NULL,
  `VALOR_COMPRA` decimal(10,2) NOT NULL,
  `ANO_PUBLICACAO` year(4) NOT NULL,
  `ESTADO` enum('NOVO','SEMINOVO','USADO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `LIVRARIA`
--

INSERT INTO `LIVRARIA` (`ID`, `TITULO`, `EDITORA`, `AUTOR`, `IDIOMA`, `GENERO`, `IMAGEM`, `FORMATO`, `VALOR_COMPRA`, `ANO_PUBLICACAO`, `ESTADO`) VALUES
(1, 'ysdr', 'sryry', 'syrys', 'ysry', 'Drama', '68b8e74fad786.png', 'FISICO', 463.00, '2020', 'USADO'),
(2, '3rfg4rg', 'ergrg', 'bedfb', 'febb', 'Auto', '68b8f7dd6c17f.png', 'FISICO', 345.00, '2020', 'USADO'),
(3, 'wedfwe', 'fwefwe', 'fwefwe', 'fwefwefr', 'Literatura Juvenil', '68ba057e79d43.png', 'DIGITAL', 34.00, '2020', 'SEMINOVO');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cpf`);

--
-- Índices de tabela `dados`
--
ALTER TABLE `dados`
  ADD PRIMARY KEY (`cpf`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
