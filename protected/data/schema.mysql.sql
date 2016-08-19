SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema x-empleos
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `x-empleos` ;

CREATE SCHEMA IF NOT EXISTS `x-empleos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `x-empleos` ;

-- -----------------------------------------------------
-- Table `x-empleos`.`empresas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `x-empleos`.`empresas` ;

CREATE TABLE IF NOT EXISTS `x-empleos`.`empresas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(64) NOT NULL,
  `activa` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `x-empleos`.`localidades`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `x-empleos`.`localidades` ;

CREATE TABLE IF NOT EXISTS `x-empleos`.`localidades` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_empresa` INT UNSIGNED NOT NULL,
  `calle` VARCHAR(128) NOT NULL,
  `numero` INT UNSIGNED NOT NULL,
  `colonia` VARCHAR(128) NOT NULL,
  `codigo_postal` INT UNSIGNED NOT NULL,
  `pais` INT UNSIGNED NOT NULL,
  `estado` INT UNSIGNED NOT NULL,
  `ciudad` INT UNSIGNED NOT NULL,
  `activa` BOOLEAN NOT NULL DEFAULT TRUE,
  PRIMARY KEY (`id`) ,
  INDEX `fk_localidades_empresas1_idx` (`id_empresa` ASC) ,
  CONSTRAINT `fk_localidades_empresas1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `x-empleos`.`empresas` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `x-empleos`.`vacantes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `x-empleos`.`vacantes` ;

CREATE TABLE IF NOT EXISTS `x-empleos`.`vacantes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_empresa` INT UNSIGNED NOT NULL,
  `id_localidad` INT UNSIGNED NOT NULL,
  `puesto` VARCHAR(20) NOT NULL,
  `sueldo` INT UNSIGNED NOT NULL,
  `ofrece` LONGTEXT NOT NULL,
  `requisitos` LONGTEXT NOT NULL,
  `disponibilidad` INT UNSIGNED NOT NULL,
  `fecha_publicacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activa` BOOLEAN NOT NULL DEFAULT TRUE,
  PRIMARY KEY (`id`) ,
  INDEX `fk_vacantes_empresas1_idx` (`id_empresa` ASC) ,
  INDEX `fk_vacantes_localidades1_idx` (`id_localidad` ASC) ,
  CONSTRAINT `fk_vacantes_empresas1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `x-empleos`.`empresas` (`id`),
  CONSTRAINT `fk_vacantes_localidades1`
    FOREIGN KEY (`id_localidad`)
    REFERENCES `x-empleos`.`localidades` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `x-empleos`.`aspirantes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `x-empleos`.`aspirantes` ;

CREATE TABLE IF NOT EXISTS `x-empleos`.`aspirantes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `datos` LONGTEXT NULL,
  `foto` LONGTEXT NULL,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `x-empleos`.`lista_aspirantes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `x-empleos`.`lista_aspirantes` ;

CREATE TABLE IF NOT EXISTS `x-empleos`.`lista_aspirantes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_vacante` INT UNSIGNED NOT NULL,
  `id_aspirante` INT UNSIGNED NOT NULL,
  `cita` TIMESTAMP NULL,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `respuesta` VARCHAR(2) NULL,
  `mensaje` LONGTEXT NULL,
  `activa` BOOLEAN NOT NULL DEFAULT TRUE,
  PRIMARY KEY (`id`, `id_vacante`, `id_aspirante`) ,
  INDEX `fk_lista_aspirantes_vacantes1_idx` (`id_vacante` ASC) ,
  INDEX `fk_lista_aspirantes_aspirantes1_idx` (`id_aspirante` ASC) ,
  CONSTRAINT `fk_lista_aspirantes_vacantes1`
    FOREIGN KEY (`id_vacante`)
    REFERENCES `x-empleos`.`vacantes` (`id`),
  CONSTRAINT `fk_lista_aspirantes_aspirantes1`
    FOREIGN KEY (`id_aspirante`)
    REFERENCES `x-empleos`.`aspirantes` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `x-empleos`.`usuarios_empresas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `x-empleos`.`usuarios_empresas` ;

CREATE TABLE IF NOT EXISTS `x-empleos`.`usuarios_empresas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_empresa` INT UNSIGNED NOT NULL,
  `usuario` VARCHAR(16) NOT NULL,
  `contrasena` VARCHAR(32) NOT NULL,
  `activo` BOOLEAN NOT NULL DEFAULT TRUE,
  PRIMARY KEY (`id`) ,
  INDEX `fk_usuarios_empresas_empresas1_idx` (`id_empresa` ASC) ,
  CONSTRAINT `fk_usuarios_empresas_empresas1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `x-empleos`.`empresas` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `x-empleos`.`usuarios_aspirantes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `x-empleos`.`usuarios_aspirantes` ;

CREATE TABLE IF NOT EXISTS `x-empleos`.`usuarios_aspirantes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_aspirante` INT UNSIGNED NOT NULL,
  `correo` VARCHAR(254) NOT NULL UNIQUE,
  `contrasena` VARCHAR(32) NOT NULL,
  `gcmKey` LONGTEXT NOT NULL,
  `activo` BOOLEAN NOT NULL DEFAULT TRUE,
  PRIMARY KEY (`id`) ,
  INDEX `fk_usuarios_aspirantes_aspirantes_idx` (`id_aspirante` ASC) ,
  CONSTRAINT `fk_usuarios_aspirantes_aspirantes`
    FOREIGN KEY (`id_aspirante`)
    REFERENCES `x-empleos`.`aspirantes` (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
