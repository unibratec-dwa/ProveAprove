-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jul 11, 2014 as 08:27 PM
-- Versão do Servidor: 5.5.9
-- Versão do PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Banco de Dados: `ProveAprove`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` VALUES(1, 'Saladas');
INSERT INTO `categoria` VALUES(2, 'Sopas');
INSERT INTO `categoria` VALUES(3, 'Massas');
INSERT INTO `categoria` VALUES(4, 'Bebidas');
INSERT INTO `categoria` VALUES(5, 'Bolos');
INSERT INTO `categoria` VALUES(6, 'Carnes');
INSERT INTO `categoria` VALUES(7, 'Aves');
INSERT INTO `categoria` VALUES(8, 'Peixes e Frutos do Mar');
INSERT INTO `categoria` VALUES(9, 'Doces');
INSERT INTO `categoria` VALUES(10, 'Lanches');
INSERT INTO `categoria` VALUES(11, 'Prato Único');
INSERT INTO `categoria` VALUES(12, 'Especiais');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingrediente`
--

CREATE TABLE `ingrediente` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `ingrediente`
--

INSERT INTO `ingrediente` VALUES(1, 'Achocolatado');
INSERT INTO `ingrediente` VALUES(2, 'Leite');
INSERT INTO `ingrediente` VALUES(3, 'Carne Moída');
INSERT INTO `ingrediente` VALUES(4, 'Batata Palha');
INSERT INTO `ingrediente` VALUES(5, 'Ovo');
INSERT INTO `ingrediente` VALUES(6, 'Açucar');
INSERT INTO `ingrediente` VALUES(7, 'Agua');
INSERT INTO `ingrediente` VALUES(8, 'Banana');
INSERT INTO `ingrediente` VALUES(9, 'Cerveja');
INSERT INTO `ingrediente` VALUES(10, 'Picanha');
INSERT INTO `ingrediente` VALUES(11, 'Cebola');
INSERT INTO `ingrediente` VALUES(12, 'Uva');
INSERT INTO `ingrediente` VALUES(13, 'Oleo');
INSERT INTO `ingrediente` VALUES(14, 'Sal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita`
--

CREATE TABLE `receita` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `categoria_id` smallint(6) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `modoDePreparo` text NOT NULL,
  `tempoDePreparo` time NOT NULL,
  `rendimento` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `receita`
--

INSERT INTO `receita` VALUES(1, 'leandro@gmail.com', 12, 'Ovo frito especial', 'Pegue um ovo fresco, quebre a casca e asse em uma assadeira adicionando oleo', '00:05:00', '01 porção');
INSERT INTO `receita` VALUES(2, 'rosalva@gmail.com', 6, 'Costela Bovina a moda do chefe', 'Pegue a costela bovina, coloque numa assadeira e asse em fogo brando tempere a gosto.', '01:00:00', '01 porção');
INSERT INTO `receita` VALUES(3, 'rosalva@gmail.com', 6, 'Picanha na cerveja preta', 'Em uma churrasqueira pegue uma picanha gorda, deixe assar, tempere com cerveja e sirva', '00:30:00', '01 porção');
INSERT INTO `receita` VALUES(4, 'rosalva@gmail.com', 6, 'Fricassê de carne moida a moda do chefe', 'Tempere a seu gosto e cozinhe a carne moída, após cozida separe e sirva', '00:30:00', '01 porção');
INSERT INTO `receita` VALUES(5, 'rosalva@gmail.com', 4, 'Bebida forte', 'Coloque o curaçau com vodka e cidra', '01:00:00', '1 pessoa');
INSERT INTO `receita` VALUES(6, 'leandro@gmail.com', 4, 'Achocolatado Batido', 'Adicione achocolatado e bata no liquidificador', '00:05:00', '01 porção');
INSERT INTO `receita` VALUES(7, 'leandro@gmail.com', 4, 'Vitamina de Banana', 'Adicione bana e leite, bata no liquidificador', '00:05:00', '02 porções');
INSERT INTO `receita` VALUES(8, 'leandro@gmail.com', 4, 'Suco de Abacaxi', 'Adicione abacaxi com agua e bata no liquidificador', '00:05:00', '10 porções');
INSERT INTO `receita` VALUES(9, 'leandro@gmail.com', 4, 'Suco de Uva', 'Lave bem as uvas e bata num liquidificador', '00:05:00', '10 porções');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita_ingrediente`
--

CREATE TABLE `receita_ingrediente` (
  `receita_id` smallint(6) NOT NULL,
  `ingrediente_id` smallint(6) NOT NULL,
  `quantidade` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `receita_ingrediente`
--

INSERT INTO `receita_ingrediente` VALUES(1, 5, '1');
INSERT INTO `receita_ingrediente` VALUES(2, 3, '1');
INSERT INTO `receita_ingrediente` VALUES(3, 10, '1');
INSERT INTO `receita_ingrediente` VALUES(4, 3, '1');
INSERT INTO `receita_ingrediente` VALUES(5, 7, '1');
INSERT INTO `receita_ingrediente` VALUES(6, 2, '1');
INSERT INTO `receita_ingrediente` VALUES(7, 8, '1');
INSERT INTO `receita_ingrediente` VALUES(8, 7, '1');
INSERT INTO `receita_ingrediente` VALUES(9, 12, '1');
INSERT INTO `receita_ingrediente` VALUES(9, 7, '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `email` varchar(50) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` VALUES('leandro@gmail.com', '123456', 'Leandro Rodrigo');
INSERT INTO `usuario` VALUES('rosalva@gmail.com', '123456', 'Rosalva Freire');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_receita`
--

CREATE TABLE `usuario_receita` (
  `email` varchar(255) NOT NULL,
  `receita_id` smallint(6) NOT NULL,
  `favorito` tinyint(1) DEFAULT NULL,
  `gostou` tinyint(1) DEFAULT NULL,
  `nota` tinyint(1) DEFAULT NULL,
  KEY `email` (`email`),
  KEY `receita_id` (`receita_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario_receita`
--

INSERT INTO `usuario_receita` VALUES('leandro@gmail.com', 1, 1, NULL, NULL);
INSERT INTO `usuario_receita` VALUES('leandro@gmail.com', 2, NULL, 1, NULL);

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `receita`
--
ALTER TABLE `receita`
  ADD CONSTRAINT `receita_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`),
  ADD CONSTRAINT `receita_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`);
