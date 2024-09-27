-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para hunterscadastro
CREATE DATABASE IF NOT EXISTS `hunterscadastro` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `hunterscadastro`;

-- Copiando estrutura para tabela hunterscadastro.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `senha` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela hunterscadastro.usuarios: ~4 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `login`, `email`, `senha`, `foto`) VALUES
	(28, 'Ramalho', 'gabrielaramalho@gmail.com', '$2y$10$9EJoPuMSZEhnUKxVyyqlH.L55FB5ZHKHPJ3T.qJYBEk.HOHSbIKJi', '../src/imagens/66f424cf26dd3.jpg'),
	(29, 'Leorio Palanight', 'leoriohunter@gmail.com', '$2y$10$ZYVGWHrFmQ7CIoVmE2d.5OWJsNxctXAMuPWImbLwI8ai2lVt87Dsa', '../src/imagens/66f4337d097d1.jpg'),
	(30, 'Gon Freecs', 'gonfreecs808@gmail.com', '$2y$10$9EqnEMcn/5i9KDY5CzrRD.SLPO3kEzdxw6jDnbR9CjZcG/YE5Qnkq', '../src/imagens/66f43b17e86f5.jpg'),
	(31, 'Killua Z.', 'killuazoldyck@gmail.com', '$2y$10$3m5r85HBV4GV.p505P.BUu4Lp7YKZ.F9NpCbD60ehkIsDSoV9pAoi', '../src/imagens/66f440250032f.jpg');

-- Copiando estrutura para view hunterscadastro.usuario_sigilo
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `usuario_sigilo` (
	`id` INT(10) NOT NULL,
	`login` VARCHAR(40) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`email` VARCHAR(100) NULL COLLATE 'utf8mb4_0900_ai_ci'
) ENGINE=MyISAM;

-- Copiando estrutura para view hunterscadastro.usuario_sigilo
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `usuario_sigilo`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `usuario_sigilo` AS select `usuarios`.`id` AS `id`,`usuarios`.`login` AS `login`,`usuarios`.`email` AS `email` from `usuarios`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
