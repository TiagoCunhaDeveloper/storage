-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06-Ago-2019 às 18:22
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_storage`
--
CREATE DATABASE IF NOT EXISTS `bd_storage` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bd_storage`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `color` enum('yellow','blue','green') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yellow',
  `xyz` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_usuario` smallint(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_arquivos_usuarios`
--

CREATE TABLE `tb_arquivos_usuarios` (
  `id_arquivos_usuarios` smallint(11) NOT NULL,
  `nome_arquivo` varchar(250) DEFAULT NULL,
  `tamanho_arquivo` varchar(1000) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  `backup` smallint(1) DEFAULT NULL,
  `data_upload` varchar(10) DEFAULT NULL,
  `hora_upload` varchar(10) DEFAULT NULL,
  `data_exclusao` varchar(10) DEFAULT NULL,
  `hora_exclusao` varchar(10) DEFAULT NULL,
  `versao` smallint(10) DEFAULT NULL,
  `copia` smallint(11) DEFAULT NULL,
  `caminho` varchar(1000) DEFAULT NULL,
  `fk_usuario` smallint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_compartilhados`
--

CREATE TABLE `tb_compartilhados` (
  `id_compartilhados` smallint(11) NOT NULL,
  `hash` varchar(350) DEFAULT NULL,
  `caminho_compartilhado` varchar(1500) DEFAULT NULL,
  `pessoas` varchar(50) DEFAULT NULL,
  `fk_usuario` smallint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_compartilhados_interno`
--

CREATE TABLE `tb_compartilhados_interno` (
  `id_compartilhados_interno` smallint(11) NOT NULL,
  `receptor_interno` smallint(11) DEFAULT NULL,
  `caminho_compartilhado_interno` varchar(2500) DEFAULT NULL,
  `data_compartilhamento_interno` varchar(10) DEFAULT NULL,
  `tipo` smallint(1) DEFAULT NULL,
  `nome_folder` varchar(250) DEFAULT NULL,
  `opcoes_compart` smallint(1) DEFAULT NULL,
  `fk_usuario` smallint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_planos_usuarios`
--

CREATE TABLE `tb_planos_usuarios` (
  `id_planos_usuarios` smallint(11) NOT NULL,
  `plano` smallint(1) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL,
  `data_solicitacao` varchar(10) DEFAULT NULL,
  `data_aprovacao` varchar(10) DEFAULT NULL,
  `fk_usuario` smallint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_planos_usuarios`
--

INSERT INTO `tb_planos_usuarios` (`id_planos_usuarios`, `plano`, `status`, `data_solicitacao`, `data_aprovacao`, `fk_usuario`) VALUES
(3, 3, 1, '17/10/2017', '17/10/2017', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_recuperacao`
--

CREATE TABLE `tb_recuperacao` (
  `id` int(11) NOT NULL,
  `email` varchar(35) NOT NULL,
  `codigo` varchar(40) NOT NULL,
  `data_expiracao` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id_usuario` smallint(11) NOT NULL,
  `nome_usu` varchar(20) DEFAULT NULL,
  `sobrenome_usu` varchar(20) DEFAULT NULL,
  `email_usu` varchar(100) DEFAULT NULL,
  `senha_usu` varchar(50) DEFAULT NULL,
  `tipo` smallint(1) DEFAULT NULL,
  `estilo` smallint(1) DEFAULT NULL,
  `preview` smallint(1) DEFAULT NULL,
  `plano` smallint(1) DEFAULT NULL,
  `scan` smallint(1) DEFAULT NULL,
  `qtd_pastas` smallint(10) DEFAULT NULL,
  `hash_email` varchar(50) DEFAULT NULL,
  `status_email` smallint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`id_usuario`, `nome_usu`, `sobrenome_usu`, `email_usu`, `senha_usu`, `tipo`, `estilo`, `preview`, `plano`, `scan`, `qtd_pastas`, `hash_email`, `status_email`) VALUES
(1, 'Admin', 'Admin', 'admin@admin.com', 'f5bb0c8de146c67b44babbf4e6584cc0', 1, 0, 0, 3, 1, 64, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_arquivos_usuarios`
--
ALTER TABLE `tb_arquivos_usuarios`
  ADD PRIMARY KEY (`id_arquivos_usuarios`);

--
-- Indexes for table `tb_compartilhados`
--
ALTER TABLE `tb_compartilhados`
  ADD PRIMARY KEY (`id_compartilhados`);

--
-- Indexes for table `tb_compartilhados_interno`
--
ALTER TABLE `tb_compartilhados_interno`
  ADD PRIMARY KEY (`id_compartilhados_interno`);

--
-- Indexes for table `tb_planos_usuarios`
--
ALTER TABLE `tb_planos_usuarios`
  ADD PRIMARY KEY (`id_planos_usuarios`);

--
-- Indexes for table `tb_recuperacao`
--
ALTER TABLE `tb_recuperacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tb_arquivos_usuarios`
--
ALTER TABLE `tb_arquivos_usuarios`
  MODIFY `id_arquivos_usuarios` smallint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_compartilhados`
--
ALTER TABLE `tb_compartilhados`
  MODIFY `id_compartilhados` smallint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_compartilhados_interno`
--
ALTER TABLE `tb_compartilhados_interno`
  MODIFY `id_compartilhados_interno` smallint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_planos_usuarios`
--
ALTER TABLE `tb_planos_usuarios`
  MODIFY `id_planos_usuarios` smallint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_recuperacao`
--
ALTER TABLE `tb_recuperacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id_usuario` smallint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
