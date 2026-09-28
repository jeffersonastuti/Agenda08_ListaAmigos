CREATE DATABASE IF NOT EXISTS `pwii`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `pwii`;

CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `uk_usuario_nome` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `amigo` (
  `idamigo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(60) NOT NULL,
  `sobrenome` VARCHAR(60) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `email` VARCHAR(120) NOT NULL,
  PRIMARY KEY (`idamigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `usuario` (`nome`, `senha`)
SELECT 'gabi', 'gabi123'
WHERE NOT EXISTS (
  SELECT 1 FROM `usuario` WHERE `nome` = 'gabi'
);
