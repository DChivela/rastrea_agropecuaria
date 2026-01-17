-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Jan-2026 às 13:55
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `rastreabilidade_agropecuaria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos_rastreio`
--

CREATE TABLE `eventos_rastreio` (
  `id` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  `tipo_evento` enum('producao','colheita','abate','processamento','armazenamento','transporte','venda') NOT NULL,
  `descricao` text DEFAULT NULL,
  `localizacao` varchar(255) DEFAULT NULL,
  `temperatura` decimal(5,2) DEFAULT NULL,
  `umidade` decimal(5,2) DEFAULT NULL,
  `responsavel` varchar(255) DEFAULT NULL,
  `data_evento` timestamp NOT NULL DEFAULT current_timestamp(),
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lotes`
--

CREATE TABLE `lotes` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `codigo_lote` varchar(100) NOT NULL,
  `quantidade` decimal(10,2) NOT NULL,
  `data_producao` date NOT NULL,
  `data_validade` date DEFAULT NULL,
  `status` enum('em_producao','em_transito','armazenado','vendido','expirado') DEFAULT 'em_producao',
  `local_origem` varchar(255) DEFAULT NULL,
  `local_atual` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtores`
--

CREATE TABLE `produtores` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `certificacao` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `produtor_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo` enum('carne','leite','graos','outros') NOT NULL,
  `descricao` text DEFAULT NULL,
  `unidade` varchar(20) DEFAULT 'kg',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `qr_codes`
--

CREATE TABLE `qr_codes` (
  `id` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `contador_escaneamentos` int(11) DEFAULT 0,
  `ultimo_escaneamento` timestamp NULL DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome_completo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `eventos_rastreio`
--
ALTER TABLE `eventos_rastreio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lote_id` (`lote_id`);

--
-- Índices para tabela `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo_lote` (`codigo_lote`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices para tabela `produtores`
--
ALTER TABLE `produtores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnpj` (`cnpj`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtor_id` (`produtor_id`);

--
-- Índices para tabela `qr_codes`
--
ALTER TABLE `qr_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `lote_id` (`lote_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `eventos_rastreio`
--
ALTER TABLE `eventos_rastreio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtores`
--
ALTER TABLE `produtores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `qr_codes`
--
ALTER TABLE `qr_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `eventos_rastreio`
--
ALTER TABLE `eventos_rastreio`
  ADD CONSTRAINT `eventos_rastreio_ibfk_1` FOREIGN KEY (`lote_id`) REFERENCES `lotes` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `lotes`
--
ALTER TABLE `lotes`
  ADD CONSTRAINT `lotes_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `produtores`
--
ALTER TABLE `produtores`
  ADD CONSTRAINT `produtores_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`produtor_id`) REFERENCES `produtores` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `qr_codes`
--
ALTER TABLE `qr_codes`
  ADD CONSTRAINT `qr_codes_ibfk_1` FOREIGN KEY (`lote_id`) REFERENCES `lotes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
