-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/08/2024 às 15:00
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
-- Banco de dados: `projeto`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `spreadsheets`
--

CREATE TABLE `spreadsheets` (
  `id` int(11) NOT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `visibilidade` varchar(255) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `data_cadastro` date DEFAULT current_timestamp(),
  `conteudo` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cpf` int(11) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` int(11) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `instituicao` varchar(255) DEFAULT NULL,
  `funcao` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_atualizacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `cpf`, `senha`, `email`, `telefone`, `endereco`, `instituicao`, `funcao`, `status`, `data_cadastro`, `data_atualizacao`) VALUES
(1, 'breno', 70690, '$2y$10$wp0O.HwY0RHuLPkw1gyDh.J7N9UmHCUvRObpbjtVxy0k9nGigpxLm', 'breno@gmail.com', 0, 'sjsjsjs', 'jsjsjs', 'Professor/Pesquisador', 0, '2024-08-08 19:24:52', '2024-08-08 19:24:52'),
(2, 'João', NULL, NULL, 'joao@gmail.com', NULL, NULL, NULL, NULL, 0, '2024-08-08 19:24:52', '2024-08-08 19:24:52'),
(6, 'John Doe', 123456, '123456', 'joho@gmail.com', 123456789, 'Rua das Flores, 123', 'Universidade XYZ', 'Professor', 0, '2024-08-08 19:43:40', '2024-08-08 19:43:40');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `spreadsheets`
--
ALTER TABLE `spreadsheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`id_user`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `spreadsheets`
--
ALTER TABLE `spreadsheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `spreadsheets`
--
ALTER TABLE `spreadsheets`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
