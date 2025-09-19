-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/09/2025 às 17:02
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistemacolaboradores`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `Funcionario_Codigo` varchar(20) NOT NULL,
  `Funcionario_Nome` varchar(100) NOT NULL,
  `Funcionario_CPF` char(11) NOT NULL,
  `Funcionario_Senha` varchar(255) NOT NULL,
  `Funcionario_Deletado` tinyint(1) DEFAULT 0,
  `Funcionario_Acesso` tinyint(1) DEFAULT 1,
  `Funcionario_Vendedor` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionario`
--

INSERT INTO `funcionario` (`Funcionario_Codigo`, `Funcionario_Nome`, `Funcionario_CPF`, `Funcionario_Senha`, `Funcionario_Deletado`, `Funcionario_Acesso`, `Funcionario_Vendedor`) VALUES
('0400001', 'Larissa Cristina Fernandes Balieiro', '47800152863', 'b7b1ab9139eb525fe7fe986cad123af0', 0, 1, 1),
('0400002', 'Paulo Henrique Hambruck Dos Santos', '52523517833', 'b7b1ab9139eb525fe7fe986cad123af0', 0, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `rh_comissao`
--

CREATE TABLE `rh_comissao` (
  `Comissao_Codigo` int(11) NOT NULL,
  `Comissao_Data` varchar(50) DEFAULT NULL,
  `Comissao_PDF` longtext DEFAULT NULL,
  `Comissao_Lido` tinyint(1) DEFAULT 0,
  `Comissao_Funcionario_Codigo` varchar(20) DEFAULT NULL,
  `Comissao_Data_Real` datetime DEFAULT current_timestamp(),
  `Comissao_Valor` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `rh_comissao`
--

INSERT INTO `rh_comissao` (`Comissao_Codigo`, `Comissao_Data`, `Comissao_PDF`, `Comissao_Lido`, `Comissao_Funcionario_Codigo`, `Comissao_Data_Real`, `Comissao_Valor`) VALUES
(1, '2021-05-07', 'comissao-411-06-2021-478.001.528-63', 1, '0400001', '2021-06-11 11:16:20', 592.24);

-- --------------------------------------------------------

--
-- Estrutura para tabela `rh_holerite`
--

CREATE TABLE `rh_holerite` (
  `Holerite_Codigo` int(11) NOT NULL,
  `Holerite_Data` date NOT NULL,
  `Holerite_PDF` varchar(255) NOT NULL,
  `Holerite_Lido` tinyint(1) NOT NULL DEFAULT 0,
  `Holerite_Funcionario_Codigo` varchar(20) NOT NULL,
  `Holerite_Data_Real` datetime NOT NULL,
  `Holerite_Valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `rh_holerite`
--

INSERT INTO `rh_holerite` (`Holerite_Codigo`, `Holerite_Data`, `Holerite_PDF`, `Holerite_Lido`, `Holerite_Funcionario_Codigo`, `Holerite_Data_Real`, `Holerite_Valor`) VALUES
(1, '2021-01-31', 'holerite-01-2021-0400001', 1, '0400001', '2021-02-01 09:00:00', 3500.00),
(2, '2021-02-28', 'holerite-02-2021-0400001', 0, '0400001', '2021-03-01 09:15:00', 3600.50),
(3, '2021-03-31', 'holerite-03-2021-0400001', 1, '0400001', '2021-04-01 10:30:00', 3700.75),
(4, '2021-04-30', 'holerite-04-2021-0400001', 0, '0400001', '2021-05-01 08:45:00', 3800.00),
(5, '2021-05-31', 'holerite-05-2021-0400001', 1, '0400001', '2021-06-01 09:05:00', 3900.25),
(6, '2025-09-19', 'holerite-01-2021-0400002', 0, '0400002', '2025-09-19 16:02:54', 300.00),
(7, '2025-09-19', 'holerite-01-2021-0400002', 0, '0400002', '2025-09-19 16:02:54', 300.00),
(8, '2025-09-19', 'holerite-02-2021-0400002', 0, '0400002', '2025-09-19 16:02:54', 300.00),
(9, '2025-09-19', 'holerite-03-2021-0400002', 0, '0400002', '2025-09-19 16:02:54', 300.00),
(10, '2025-09-19', 'holerite-04-2021-0400002', 0, '0400002', '2025-09-19 16:02:54', 300.00),
(11, '2025-09-19', 'holerite-05-2021-0400002', 0, '0400002', '2025-09-19 16:02:54', 300.00),
(12, '2025-09-19', 'holerite-06-2021-0400002', 0, '0400002', '2025-09-19 16:02:54', 300.00),
(13, '2025-09-19', 'holerite-07-2021-0400002', 0, '0400002', '2025-09-19 16:02:54', 300.00),
(14, '2025-09-19', 'holerite-08-2021-0400002', 0, '0400002', '2025-09-19 16:02:54', 300.00),
(15, '2025-09-19', 'holerite-09-2021-0400002', 0, '0400002', '2025-09-19 16:02:54', 300.00),
(16, '2025-09-19', 'holerite-10-2021-0400002', 0, '0400002', '2025-09-19 16:02:54', 300.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `rh_ponto`
--

CREATE TABLE `rh_ponto` (
  `Ponto_Codigo` int(11) NOT NULL,
  `Ponto_Data` varchar(20) DEFAULT NULL,
  `Ponto_PDF` longtext DEFAULT NULL,
  `Ponto_Lido` int(2) NOT NULL DEFAULT 0,
  `Ponto_Funcionario_Codigo` varchar(20) DEFAULT NULL,
  `Ponto_Data_Real` datetime NOT NULL DEFAULT current_timestamp(),
  `Ponto_Visualizado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `rh_ponto`
--

INSERT INTO `rh_ponto` (`Ponto_Codigo`, `Ponto_Data`, `Ponto_PDF`, `Ponto_Lido`, `Ponto_Funcionario_Codigo`, `Ponto_Data_Real`, `Ponto_Visualizado`) VALUES
(11, '2025-09', 'pdf_exemplo_1', 0, '0400001', '2025-09-01 08:00:00', '0000-00-00 00:00:00'),
(12, '2025-09', 'pdf_exemplo_2', 0, '0400001', '2025-09-02 08:00:00', '0000-00-00 00:00:00'),
(13, '2025-09', 'pdf_exemplo_3', 0, '0400001', '2025-09-03 08:00:00', '0000-00-00 00:00:00'),
(14, '2025-09', 'pdf_exemplo_4', 0, '0400001', '2025-09-04 08:00:00', '0000-00-00 00:00:00'),
(15, '2025-09', 'pdf_exemplo_5', 0, '0400001', '2025-09-05 08:00:00', '0000-00-00 00:00:00'),
(16, '2025-09-05', 'pdf_exemplo_1', 0, '0400002', '2025-09-01 08:00:00', '0000-00-00 00:00:00'),
(17, '2025-09-05', 'pdf_exemplo_2', 0, '0400002', '2025-09-02 08:00:00', '0000-00-00 00:00:00'),
(18, '2025-09-05', 'pdf_exemplo_3', 0, '0400002', '2025-09-03 08:00:00', '0000-00-00 00:00:00'),
(19, '2025-09-05', 'pdf_exemplo_4', 0, '0400002', '2025-09-04 08:00:00', '0000-00-00 00:00:00'),
(20, '2025-09-05', 'pdf_exemplo_5', 0, '0400002', '2025-09-05 08:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `rh_reembolso`
--

CREATE TABLE `rh_reembolso` (
  `Reembolso_Codigo` int(11) NOT NULL,
  `Reembolso_Data` date NOT NULL,
  `Reembolso_Resposta` text DEFAULT NULL,
  `Reembolso_Funcionario_Codigo` varchar(20) NOT NULL,
  `Reembolso_Viagem` varchar(100) DEFAULT NULL,
  `Reembolso_Tipo` varchar(50) NOT NULL,
  `Reembolso_Moeda` varchar(10) NOT NULL,
  `Reembolso_Valor` decimal(10,2) NOT NULL,
  `Reembolso_Anexo` longtext DEFAULT NULL,
  `Reembolso_Banco` varchar(100) DEFAULT NULL,
  `Reembolso_Pix` varchar(150) DEFAULT NULL,
  `Reembolso_Data_Registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `rh_reembolso`
--

INSERT INTO `rh_reembolso` (`Reembolso_Codigo`, `Reembolso_Data`, `Reembolso_Resposta`, `Reembolso_Funcionario_Codigo`, `Reembolso_Viagem`, `Reembolso_Tipo`, `Reembolso_Moeda`, `Reembolso_Valor`, `Reembolso_Anexo`, `Reembolso_Banco`, `Reembolso_Pix`, `Reembolso_Data_Registro`) VALUES
(1, '2025-09-19', 'Em Análise', '0400001', '1', 'Transporte', 'USD', 3.00, 'reembolso', 'Pix', '19987185559', '2025-09-19 09:28:59');

-- --------------------------------------------------------

--
-- Estrutura para tabela `rh_rendimentos`
--

CREATE TABLE `rh_rendimentos` (
  `Rendimentos_Codigo` int(11) NOT NULL,
  `Rendimentos_Data` varchar(50) DEFAULT NULL,
  `Rendimentos_PDF` longtext DEFAULT NULL,
  `Rendimentos_Lido` int(2) NOT NULL DEFAULT 0,
  `Rendimentos_Funcionario_Codigo` varchar(50) DEFAULT NULL,
  `Rendimentos_Data_Real` datetime NOT NULL DEFAULT current_timestamp(),
  `Rendimentos_Visualizado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `rh_rendimentos`
--

INSERT INTO `rh_rendimentos` (`Rendimentos_Codigo`, `Rendimentos_Data`, `Rendimentos_PDF`, `Rendimentos_Lido`, `Rendimentos_Funcionario_Codigo`, `Rendimentos_Data_Real`, `Rendimentos_Visualizado`) VALUES
(3, '2025-09-01', 'rendimento_setembro', 0, '0400001', '2025-09-01 08:00:00', NULL),
(4, '2025-09-01', 'rendimento_outubro', 0, '0400002', '2025-09-01 08:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `rh_sugestao`
--

CREATE TABLE `rh_sugestao` (
  `Sugestao_Codigo` int(11) NOT NULL,
  `Sugestao_Texto` longtext DEFAULT NULL,
  `Sugestao_Data` datetime DEFAULT NULL,
  `Sugestao_Deletado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `rh_sugestao`
--

INSERT INTO `rh_sugestao` (`Sugestao_Codigo`, `Sugestao_Texto`, `Sugestao_Data`, `Sugestao_Deletado`) VALUES
(1, 'Teeste de envio de sugestão', '2025-09-19 14:23:03', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`Funcionario_Codigo`),
  ADD UNIQUE KEY `Funcionario_CPF` (`Funcionario_CPF`);

--
-- Índices de tabela `rh_comissao`
--
ALTER TABLE `rh_comissao`
  ADD PRIMARY KEY (`Comissao_Codigo`),
  ADD KEY `Comissao_Funcionario_Codigo` (`Comissao_Funcionario_Codigo`);

--
-- Índices de tabela `rh_holerite`
--
ALTER TABLE `rh_holerite`
  ADD PRIMARY KEY (`Holerite_Codigo`),
  ADD KEY `Holerite_Funcionario_Codigo` (`Holerite_Funcionario_Codigo`);

--
-- Índices de tabela `rh_ponto`
--
ALTER TABLE `rh_ponto`
  ADD PRIMARY KEY (`Ponto_Codigo`),
  ADD KEY `Ponto_Funcionario_Codigo` (`Ponto_Funcionario_Codigo`);

--
-- Índices de tabela `rh_reembolso`
--
ALTER TABLE `rh_reembolso`
  ADD PRIMARY KEY (`Reembolso_Codigo`),
  ADD KEY `Reembolso_Funcionario_Codigo` (`Reembolso_Funcionario_Codigo`);

--
-- Índices de tabela `rh_rendimentos`
--
ALTER TABLE `rh_rendimentos`
  ADD PRIMARY KEY (`Rendimentos_Codigo`),
  ADD KEY `Rendimentos_Funcionario_Codigo` (`Rendimentos_Funcionario_Codigo`);

--
-- Índices de tabela `rh_sugestao`
--
ALTER TABLE `rh_sugestao`
  ADD PRIMARY KEY (`Sugestao_Codigo`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `rh_comissao`
--
ALTER TABLE `rh_comissao`
  MODIFY `Comissao_Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `rh_holerite`
--
ALTER TABLE `rh_holerite`
  MODIFY `Holerite_Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `rh_ponto`
--
ALTER TABLE `rh_ponto`
  MODIFY `Ponto_Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `rh_reembolso`
--
ALTER TABLE `rh_reembolso`
  MODIFY `Reembolso_Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `rh_rendimentos`
--
ALTER TABLE `rh_rendimentos`
  MODIFY `Rendimentos_Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `rh_sugestao`
--
ALTER TABLE `rh_sugestao`
  MODIFY `Sugestao_Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `rh_comissao`
--
ALTER TABLE `rh_comissao`
  ADD CONSTRAINT `rh_comissao_ibfk_1` FOREIGN KEY (`Comissao_Funcionario_Codigo`) REFERENCES `funcionario` (`Funcionario_Codigo`);

--
-- Restrições para tabelas `rh_holerite`
--
ALTER TABLE `rh_holerite`
  ADD CONSTRAINT `rh_holerite_ibfk_1` FOREIGN KEY (`Holerite_Funcionario_Codigo`) REFERENCES `funcionario` (`Funcionario_Codigo`);

--
-- Restrições para tabelas `rh_ponto`
--
ALTER TABLE `rh_ponto`
  ADD CONSTRAINT `rh_ponto_ibfk_1` FOREIGN KEY (`Ponto_Funcionario_Codigo`) REFERENCES `funcionario` (`Funcionario_Codigo`);

--
-- Restrições para tabelas `rh_reembolso`
--
ALTER TABLE `rh_reembolso`
  ADD CONSTRAINT `rh_reembolso_ibfk_1` FOREIGN KEY (`Reembolso_Funcionario_Codigo`) REFERENCES `funcionario` (`Funcionario_Codigo`);

--
-- Restrições para tabelas `rh_rendimentos`
--
ALTER TABLE `rh_rendimentos`
  ADD CONSTRAINT `rh_rendimentos_ibfk_1` FOREIGN KEY (`Rendimentos_Funcionario_Codigo`) REFERENCES `funcionario` (`Funcionario_Codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
