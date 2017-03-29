-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22-Mar-2017 às 18:47
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chkautomacao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `cnpj` bigint(14) UNSIGNED ZEROFILL NOT NULL,
  `empresa` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(150) CHARACTER SET utf8 NOT NULL,
  `telefone` bigint(14) NOT NULL,
  `respSistema` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nUsuario` int(2) DEFAULT NULL,
  `loja` varchar(30) DEFAULT NULL,
  `filial` int(1) DEFAULT NULL,
  `regime` varchar(6) DEFAULT NULL,
  `nFiscal` int(1) DEFAULT NULL,
  `ramo` varchar(15) DEFAULT NULL,
  `sintegra` int(1) DEFAULT NULL,
  `spedFiscal` int(1) DEFAULT NULL,
  `spedPis` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`cnpj`, `empresa`, `email`, `telefone`, `respSistema`, `nUsuario`, `loja`, `filial`, `regime`, `nFiscal`, `ramo`, `sintegra`, `spedFiscal`, `spedPis`) VALUES
(04535461000110, 'automação e cia', 'automac@gmail.com', 34225779, 'Marcelo', 40, 'Matriz', 2, 'SN', 0, 'software', 1, 1, 1),
(07887400000100, 'joao', 'joaogbsi@gmail.com', 34225779, 'joao', 1, 'Matriz', 1, 'lPres', 0, 'Loja', 1, 0, 1),
(12700707000190, 'SM Sto Antonio', 'smstoant@auto.com', 36363636, 'antonio', 4, 'Matriz', NULL, 'lPres', 0, 'Supermercado', 0, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_balanca`
--

CREATE TABLE `tb_balanca` (
  `id` int(4) NOT NULL,
  `cnpjEmp` bigint(14) UNSIGNED ZEROFILL NOT NULL,
  `qtde` int(3) NOT NULL,
  `marca` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_balanca`
--

INSERT INTO `tb_balanca` (`id`, `cnpjEmp`, `qtde`, `marca`) VALUES
(2, 04535461000110, 1, 'toledo'),
(3, 04535461000110, 1, 'filizola'),
(4, 12700707000190, 1, 'fili');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_computadores`
--

CREATE TABLE `tb_computadores` (
  `id` int(3) NOT NULL,
  `cnpjEmp` bigint(14) UNSIGNED ZEROFILL NOT NULL,
  `qtd` int(2) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `sistOp` varchar(50) NOT NULL,
  `hd` varchar(20) DEFAULT NULL,
  `memoria` varchar(20) DEFAULT NULL,
  `serial` int(1) DEFAULT NULL,
  `serv` int(1) DEFAULT NULL,
  `term` int(1) DEFAULT NULL,
  `caixa` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_computadores`
--

INSERT INTO `tb_computadores` (`id`, `cnpjEmp`, `qtd`, `descricao`, `sistOp`, `hd`, `memoria`, `serial`, `serv`, `term`, `caixa`) VALUES
(1, 04535461000110, 10, 'rc 8000', 'win 7', '500 gb', '2 gb', 1, 1, 0, 0),
(2, 04535461000110, 15, 'rc 8400', 'win 7', '1 tb', '2 gb', 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_ecf`
--

CREATE TABLE `tb_ecf` (
  `id` int(4) NOT NULL,
  `cnpjEmp` bigint(20) UNSIGNED ZEROFILL NOT NULL,
  `qtde` int(3) NOT NULL,
  `marca` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_ecf`
--

INSERT INTO `tb_ecf` (`id`, `cnpjEmp`, `qtde`, `marca`) VALUES
(3, 00000004535461000110, 1, 'bematech'),
(4, 00000004535461000110, 1, 'sweda'),
(5, 00000007887400000100, 1, '2'),
(6, 00000012700707000190, 3, 'bema');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_eqprede`
--

CREATE TABLE `tb_eqprede` (
  `id` int(5) NOT NULL,
  `cnpjEmp` bigint(14) UNSIGNED ZEROFILL NOT NULL,
  `qtde` int(3) NOT NULL,
  `marca` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_eqprede`
--

INSERT INTO `tb_eqprede` (`id`, `cnpjEmp`, `qtde`, `marca`) VALUES
(3, 04535461000110, 1, 'zte'),
(4, 04535461000110, 1, 'cisco'),
(5, 12700707000190, 1, 'intelbras');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_nobreak`
--

CREATE TABLE `tb_nobreak` (
  `id` int(4) NOT NULL,
  `cnpjEmp` bigint(14) UNSIGNED ZEROFILL NOT NULL,
  `qtde` int(3) NOT NULL,
  `marca` varchar(30) CHARACTER SET utf8 NOT NULL,
  `serv` int(1) NOT NULL,
  `term` int(1) NOT NULL,
  `caixa` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_nobreak`
--

INSERT INTO `tb_nobreak` (`id`, `cnpjEmp`, `qtde`, `marca`, `serv`, `term`, `caixa`) VALUES
(3, 04535461000110, 1, 'nhs', 1, 1, 1),
(4, 07887400000100, 1, 'nhs', 1, 1, 1),
(5, 12700707000190, 1, 'nhs', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_operador`
--

CREATE TABLE `tb_operador` (
  `id` int(3) NOT NULL,
  `cpf` bigint(11) UNSIGNED ZEROFILL NOT NULL,
  `cnpjEmp` bigint(14) UNSIGNED ZEROFILL NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8 NOT NULL,
  `turno` int(2) NOT NULL,
  `descAcr` int(1) NOT NULL,
  `cancelar` int(1) NOT NULL,
  `liberar` int(1) NOT NULL,
  `redZ` int(1) NOT NULL,
  `suprSang` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_operador`
--

INSERT INTO `tb_operador` (`id`, `cpf`, `cnpjEmp`, `nome`, `turno`, `descAcr`, `cancelar`, `liberar`, `redZ`, `suprSang`) VALUES
(3, 12312312312, 04535461000110, 'naka', 2, 1, 1, 1, 1, 1),
(4, 41825515832, 07887400000100, 'cesar', 1, 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_outrasinfo`
--

CREATE TABLE `tb_outrasinfo` (
  `cnpjEmp` bigint(14) UNSIGNED ZEROFILL NOT NULL,
  `certDigital` varchar(2) DEFAULT NULL,
  `tipoInternet` varchar(15) DEFAULT NULL,
  `qualInternet` varchar(30) DEFAULT NULL,
  `buscaPreco` varchar(30) DEFAULT NULL,
  `impEtiqueta` varchar(30) DEFAULT NULL,
  `marcaTef` varchar(30) DEFAULT NULL,
  `tipoTef` varchar(5) DEFAULT NULL,
  `impressora` varchar(1) DEFAULT NULL,
  `colDados` varchar(1) DEFAULT NULL,
  `leitorMesaMarca` varchar(30) DEFAULT NULL,
  `leitorMesaQtd` int(3) DEFAULT NULL,
  `leitorMesaUsb` int(1) DEFAULT NULL,
  `leitorMaoMarca` varchar(30) DEFAULT NULL,
  `leitorMaoQtd` int(3) DEFAULT NULL,
  `leitorMaoUsb` int(1) DEFAULT NULL,
  `palmMarca` varchar(30) DEFAULT NULL,
  `palmQtd` int(3) DEFAULT NULL,
  `palmSO` varchar(30) DEFAULT NULL,
  `nomeSistema` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_outrasinfo`
--

INSERT INTO `tb_outrasinfo` (`cnpjEmp`, `certDigital`, `tipoInternet`, `qualInternet`, `buscaPreco`, `impEtiqueta`, `marcaTef`, `tipoTef`, `impressora`, `colDados`, `leitorMesaMarca`, `leitorMesaQtd`, `leitorMesaUsb`, `leitorMaoMarca`, `leitorMaoQtd`, `leitorMaoUsb`, `palmMarca`, `palmQtd`, `palmSO`, `nomeSistema`) VALUES
(04535461000110, 'A1', 'internetOutras', 'teste', 'buscaPreco', 'impEtiq', 'tef', 'VPN', '1', '1', 'mesa', 1, 1, 'mao', 1, 1, 'palm', 1, 'sopal', 'sis'),
(07887400000100, 'A3', 'internetDsl', '', 'busca', 'inmp', '', '', '1', '1', 'mesa', 1, 1, '', 0, 0, '', 0, '', 'sis'),
(12700707000190, 'A1', 'internetRadio', '', 'gertec', '', 'igenic', 'moden', '1', '1', '', 0, 0, '', 0, 0, '', 0, '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_processos`
--

CREATE TABLE `tb_processos` (
  `cnpjEmp` bigint(14) UNSIGNED ZEROFILL NOT NULL,
  `qtdCadastro` varchar(30) DEFAULT NULL,
  `pessoaLanc` varchar(30) DEFAULT NULL,
  `lancPreco` varchar(30) DEFAULT NULL,
  `recebeMerc` varchar(30) DEFAULT NULL,
  `compraVenda` varchar(30) DEFAULT NULL,
  `fiscalVendas` varchar(30) DEFAULT NULL,
  `fechamentoDiario` varchar(1) DEFAULT NULL,
  `respFechamento` varchar(30) DEFAULT NULL,
  `respFinanceiro` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_processos`
--

INSERT INTO `tb_processos` (`cnpjEmp`, `qtdCadastro`, `pessoaLanc`, `lancPreco`, `recebeMerc`, `compraVenda`, `fiscalVendas`, `fechamentoDiario`, `respFechamento`, `respFinanceiro`) VALUES
(04535461000110, '10', 'joao', 'nakajima', 'pires', 'cesar', 'leonardo', 'N', 'jessica', 'thiago'),
(07887400000100, '2', '', '', '', '', '', 'N', '', ''),
(12700707000190, '2', '', '', '', '', '', 'N', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_remoto`
--

CREATE TABLE `tb_remoto` (
  `cnpjEmp` bigint(14) UNSIGNED ZEROFILL NOT NULL,
  `recebeAcesso` varchar(1) DEFAULT NULL,
  `interligaFilial` varchar(1) DEFAULT NULL,
  `ipFixo` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_remoto`
--

INSERT INTO `tb_remoto` (`cnpjEmp`, `recebeAcesso`, `interligaFilial`, `ipFixo`) VALUES
(04535461000110, 'S', 'S', '192.168.0.209'),
(07887400000100, 'S', 'S', '127.0.0.1'),
(12700707000190, 'N', 'N', '127.0.0.1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_sistema`
--

CREATE TABLE `tb_sistema` (
  `cnpjEmp` bigint(14) UNSIGNED ZEROFILL NOT NULL,
  `intellicashFull` int(1) DEFAULT NULL,
  `intellicashLight` int(1) DEFAULT NULL,
  `easycash` int(1) DEFAULT NULL,
  `gnfe` int(1) DEFAULT NULL,
  `cotacao` int(1) DEFAULT NULL,
  `intelligroup` int(1) DEFAULT NULL,
  `intellistock` int(1) DEFAULT NULL,
  `vendaAssistida` int(1) DEFAULT NULL,
  `orcamento` int(1) DEFAULT NULL,
  `pedido` int(1) DEFAULT NULL,
  `produto` int(1) DEFAULT NULL,
  `edi` int(1) DEFAULT NULL,
  `mgMobile` int(1) DEFAULT NULL,
  `nfDestinada` int(1) DEFAULT NULL,
  `contasPgRc` int(1) DEFAULT NULL,
  `sincronizador` int(1) DEFAULT NULL,
  `entregaCega` int(1) DEFAULT NULL,
  `cte` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_sistema`
--

INSERT INTO `tb_sistema` (`cnpjEmp`, `intellicashFull`, `intellicashLight`, `easycash`, `gnfe`, `cotacao`, `intelligroup`, `intellistock`, `vendaAssistida`, `orcamento`, `pedido`, `produto`, `edi`, `mgMobile`, `nfDestinada`, `contasPgRc`, `sincronizador`, `entregaCega`, `cte`) VALUES
(04535461000110, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(07887400000100, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(12700707000190, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_vendedor`
--

CREATE TABLE `tb_vendedor` (
  `id` int(3) NOT NULL,
  `cpf` bigint(11) UNSIGNED ZEROFILL NOT NULL,
  `cnpjEmp` bigint(14) UNSIGNED ZEROFILL NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8 NOT NULL,
  `codigo` varchar(30) CHARACTER SET utf8 NOT NULL,
  `desconto` int(1) NOT NULL,
  `comissao` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_vendedor`
--

INSERT INTO `tb_vendedor` (`id`, `cpf`, `cnpjEmp`, `nome`, `codigo`, `desconto`, `comissao`) VALUES
(3, 07329511609, 04535461000110, 'joao', '114', 1, 1),
(4, 07329511609, 07887400000100, 'joao', '2', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `is_active`) VALUES
(32, 'admin', '948779d5b0045b1403135b557cc16b0b', 'admin', 1),
(33, 'tm', 'ab77837d2b06cc3d7cd91747c375c642', 'tm', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`cnpj`);

--
-- Indexes for table `tb_balanca`
--
ALTER TABLE `tb_balanca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_balanca_cnpjEmp` (`cnpjEmp`);

--
-- Indexes for table `tb_computadores`
--
ALTER TABLE `tb_computadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cnpj_comp` (`cnpjEmp`);

--
-- Indexes for table `tb_ecf`
--
ALTER TABLE `tb_ecf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ecf_cnpj` (`cnpjEmp`);

--
-- Indexes for table `tb_eqprede`
--
ALTER TABLE `tb_eqprede`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_eqprede_cnpj` (`cnpjEmp`);

--
-- Indexes for table `tb_nobreak`
--
ALTER TABLE `tb_nobreak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nobreak_cnpj` (`cnpjEmp`);

--
-- Indexes for table `tb_operador`
--
ALTER TABLE `tb_operador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_operador_cnpj` (`cnpjEmp`);

--
-- Indexes for table `tb_outrasinfo`
--
ALTER TABLE `tb_outrasinfo`
  ADD PRIMARY KEY (`cnpjEmp`);

--
-- Indexes for table `tb_processos`
--
ALTER TABLE `tb_processos`
  ADD PRIMARY KEY (`cnpjEmp`);

--
-- Indexes for table `tb_remoto`
--
ALTER TABLE `tb_remoto`
  ADD PRIMARY KEY (`cnpjEmp`);

--
-- Indexes for table `tb_sistema`
--
ALTER TABLE `tb_sistema`
  ADD PRIMARY KEY (`cnpjEmp`);

--
-- Indexes for table `tb_vendedor`
--
ALTER TABLE `tb_vendedor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vendedor_cnpj` (`cnpjEmp`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_balanca`
--
ALTER TABLE `tb_balanca`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_computadores`
--
ALTER TABLE `tb_computadores`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_ecf`
--
ALTER TABLE `tb_ecf`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_eqprede`
--
ALTER TABLE `tb_eqprede`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_nobreak`
--
ALTER TABLE `tb_nobreak`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_operador`
--
ALTER TABLE `tb_operador`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_vendedor`
--
ALTER TABLE `tb_vendedor`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_balanca`
--
ALTER TABLE `tb_balanca`
  ADD CONSTRAINT `fk_balanca_cnpj` FOREIGN KEY (`cnpjEmp`) REFERENCES `empresa` (`cnpj`);

--
-- Limitadores para a tabela `tb_computadores`
--
ALTER TABLE `tb_computadores`
  ADD CONSTRAINT `fk_cnpj_comp` FOREIGN KEY (`cnpjEmp`) REFERENCES `empresa` (`cnpj`);

--
-- Limitadores para a tabela `tb_ecf`
--
ALTER TABLE `tb_ecf`
  ADD CONSTRAINT `fk_ecf_cnpj` FOREIGN KEY (`cnpjEmp`) REFERENCES `empresa` (`cnpj`);

--
-- Limitadores para a tabela `tb_eqprede`
--
ALTER TABLE `tb_eqprede`
  ADD CONSTRAINT `fk_eqprede_cnpj` FOREIGN KEY (`cnpjEmp`) REFERENCES `empresa` (`cnpj`);

--
-- Limitadores para a tabela `tb_nobreak`
--
ALTER TABLE `tb_nobreak`
  ADD CONSTRAINT `fk_nobreak_cnpj` FOREIGN KEY (`cnpjEmp`) REFERENCES `empresa` (`cnpj`);

--
-- Limitadores para a tabela `tb_operador`
--
ALTER TABLE `tb_operador`
  ADD CONSTRAINT `fk_operador_cnpj` FOREIGN KEY (`cnpjEmp`) REFERENCES `empresa` (`cnpj`);

--
-- Limitadores para a tabela `tb_outrasinfo`
--
ALTER TABLE `tb_outrasinfo`
  ADD CONSTRAINT `fk_outraInfo_cnpj` FOREIGN KEY (`cnpjEmp`) REFERENCES `empresa` (`cnpj`);

--
-- Limitadores para a tabela `tb_processos`
--
ALTER TABLE `tb_processos`
  ADD CONSTRAINT `fk_processos_cnpj` FOREIGN KEY (`cnpjEmp`) REFERENCES `empresa` (`cnpj`);

--
-- Limitadores para a tabela `tb_remoto`
--
ALTER TABLE `tb_remoto`
  ADD CONSTRAINT `fk_remoto_cnpj` FOREIGN KEY (`cnpjEmp`) REFERENCES `empresa` (`cnpj`);

--
-- Limitadores para a tabela `tb_sistema`
--
ALTER TABLE `tb_sistema`
  ADD CONSTRAINT `fk_sistema_cnpj` FOREIGN KEY (`cnpjEmp`) REFERENCES `empresa` (`cnpj`);

--
-- Limitadores para a tabela `tb_vendedor`
--
ALTER TABLE `tb_vendedor`
  ADD CONSTRAINT `fk_vendedor_cnpj` FOREIGN KEY (`cnpjEmp`) REFERENCES `empresa` (`cnpj`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
