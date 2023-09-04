-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema proyecto_php
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema proyecto_php
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `proyecto_php` DEFAULT CHARACTER SET utf8 ;
USE `proyecto_php` ;

-- -----------------------------------------------------
-- Table `proyecto_php`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto_php`.`clientes` (
  `rut_cliente` VARCHAR(10) NOT NULL,
  `nombres` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `correo` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`rut_cliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `proyecto_php`.`casos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto_php`.`casos` (
  `num_caso` INT NOT NULL AUTO_INCREMENT,
  `desc_caso` VARCHAR(200) NULL,
  `fecha_inicio` DATE NULL,
  `fecha_termino` DATE NULL,
  `estado_caso` VARCHAR(45) NOT NULL,
  `rut_cliente` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`num_caso`),
  INDEX `FK_rut_cliente_clientes_casos_idx` (`rut_cliente` ASC),
  CONSTRAINT `FK_rut_cliente_clientes_casos`
    FOREIGN KEY (`rut_cliente`)
    REFERENCES `proyecto_php`.`clientes` (`rut_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
