-- MySQL Script generated by MySQL Workbench
-- 02/22/17 12:52:50
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema biempleos
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema biempleos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `biempleos` DEFAULT CHARACTER SET utf8 ;
USE `biempleos` ;

-- -----------------------------------------------------
-- Table `biempleos`.`empresas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `biempleos`.`empresas` ;

CREATE TABLE IF NOT EXISTS `biempleos`.`empresas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(64) NOT NULL,
  `activa` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biempleos`.`localidades`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `biempleos`.`localidades` ;

CREATE TABLE IF NOT EXISTS `biempleos`.`localidades` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_empresa` INT UNSIGNED NOT NULL,
  `calle` VARCHAR(128) NOT NULL,
  `numero` INT UNSIGNED NOT NULL,
  `colonia` VARCHAR(128) NOT NULL,
  `codigo_postal` INT UNSIGNED NOT NULL,
  `pais` INT UNSIGNED NOT NULL,
  `estado` INT UNSIGNED NOT NULL,
  `ciudad` INT UNSIGNED NOT NULL,
  `activa` TINYINT NOT NULL DEFAULT TRUE,
  PRIMARY KEY (`id`),
  INDEX `fk_localidades_empresas1_idx` (`id_empresa` ASC),
  CONSTRAINT `fk_localidades_empresas1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `biempleos`.`empresas` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biempleos`.`vacantes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `biempleos`.`vacantes` ;

CREATE TABLE IF NOT EXISTS `biempleos`.`vacantes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_empresa` INT UNSIGNED NOT NULL,
  `id_localidad` INT UNSIGNED NOT NULL,
  `puesto` VARCHAR(20) NOT NULL,
  `sueldo` INT UNSIGNED NOT NULL,
  `ofrece` LONGTEXT NOT NULL,
  `requisitos` LONGTEXT NOT NULL,
  `disponibilidad` TINYINT NOT NULL,
  `fecha_publicacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_finalizacion` TIMESTAMP NULL DEFAULT NULL,
  `activa` TINYINT NOT NULL DEFAULT TRUE,
  PRIMARY KEY (`id`),
  INDEX `fk_vacantes_empresas1_idx` (`id_empresa` ASC),
  INDEX `fk_vacantes_localidades1_idx` (`id_localidad` ASC),
  CONSTRAINT `fk_vacantes_empresas1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `biempleos`.`empresas` (`id`),
  CONSTRAINT `fk_vacantes_localidades1`
    FOREIGN KEY (`id_localidad`)
    REFERENCES `biempleos`.`localidades` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biempleos`.`aspirantes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `biempleos`.`aspirantes` ;

CREATE TABLE IF NOT EXISTS `biempleos`.`aspirantes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `foto` LONGTEXT NULL DEFAULT NULL,
  `nombre` TEXT NULL,
  `fecha_nacimiento` DATE NULL,
  `sexo` TINYINT(1) NULL,
  `nacionalidad` TEXT NULL,
  `estatura` DOUBLE NULL,
  `peso` DOUBLE NULL,
  `estado_civil` TINYINT(1) NULL,
  `calle` TEXT NULL,
  `numero` TEXT NULL,
  `colonia` TEXT NULL,
  `codigo_postal` TEXT NULL,
  `curp` TEXT NULL,
  `rfc` TEXT NULL,
  `nss` TEXT NULL,
  `afore` TEXT NULL,
  `cartilla_militar` TEXT NULL,
  `pasaporte` TEXT NULL,
  `licencia` TINYINT(1) NULL,
  `clase_licencia` TINYINT(1) NULL,
  `numero_licencia` TEXT NULL,
  `deportista` TINYINT(1) NULL,
  `deporte` TEXT NULL,
  `club` TINYINT(1) NULL,
  `pasatiempo` TEXT NULL,
  `meta` TEXT NULL,
  `estudio` TINYINT(1) NULL,
  `escuela` TEXT NULL,
  `inicio` DATE NULL,
  `finalizacion` DATE NULL,
  `titulo` TINYINT(1) NULL,
  `idioma` TEXT NULL,
  `porcentaje` INT NULL,
  `funciones_oficina` TEXT NULL,
  `maquinaria_oficina` TEXT NULL,
  `software` TEXT NULL,
  `otras_funciones` TEXT NULL,
  `trabajo_anterior` TINYINT(1) NULL,
  `tiempo_trabajo` DOUBLE NULL,
  `compania` TEXT NULL,
  `direccion` TEXT NULL,
  `telefono` TEXT NULL,
  `puesto` TEXT NULL,
  `sueldo_inicial` DOUBLE NULL,
  `sueldo_final` DOUBLE NULL,
  `motivo_separacion` TEXT NULL,
  `nombre_jefe` TEXT NULL,
  `puesto_jefe` TEXT NULL,
  `nombre_ref1` TEXT NULL,
  `domicilio_ref1` TEXT NULL,
  `telefono_ref1` TEXT NULL,
  `ocupacion_ref1` TEXT NULL,
  `tiempo_ref1` DOUBLE NULL,
  `nombre_ref2` TEXT NULL,
  `domicilio_ref2` TEXT NULL,
  `telefono_ref2` TEXT NULL,
  `ocupacion_ref2` TEXT NULL,
  `tiempo_ref2` DOUBLE NULL,
  `nombre_ref3` TEXT NULL,
  `domicilio_ref3` TEXT NULL,
  `telefono_ref3` TEXT NULL,
  `ocupacion_ref3` TEXT NULL,
  `tiempo_ref3` DOUBLE NULL,
  `parientes` TINYINT(1) NULL,
  `afianzado` TINYINT(1) NULL,
  `sindicato` TINYINT(1) NULL,
  `seguro_vida` TINYINT(1) NULL,
  `viajar` TINYINT(1) NULL,
  `cambiar_residencia` TINYINT(1) NULL,
  `otros_ingresos` TINYINT(1) NULL,
  `importe_ingresos` DOUBLE NULL,
  `conyuge_trabaja` TINYINT(1) NULL,
  `percepcion` DOUBLE NULL,
  `casa_propia` TINYINT(1) NULL,
  `valor_casa` DOUBLE NULL,
  `paga_renta` TINYINT(1) NULL,
  `renta` DOUBLE NULL,
  `dependientes` INT NULL,
  `automovil` TINYINT(1) NULL,
  `deudas` TINYINT(1) NULL,
  `importe_deudas` DOUBLE NULL,
  `acreedor` TEXT NULL,
  `abono_mensual` DOUBLE NULL,
  `gastos_mensuales` DOUBLE NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biempleos`.`usuarios_empresas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `biempleos`.`usuarios_empresas` ;

CREATE TABLE IF NOT EXISTS `biempleos`.`usuarios_empresas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_empresa` INT UNSIGNED NOT NULL,
  `usuario` VARCHAR(264) NOT NULL,
  `correoAlt` VARCHAR(264) NULL,
  `contrasena` VARCHAR(32) NOT NULL,
  `activo` TINYINT NOT NULL DEFAULT TRUE,
  PRIMARY KEY (`id`),
  INDEX `fk_usuarios_empresas_empresas1_idx` (`id_empresa` ASC),
  CONSTRAINT `fk_usuarios_empresas_empresas1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `biempleos`.`empresas` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biempleos`.`usuarios_aspirantes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `biempleos`.`usuarios_aspirantes` ;

CREATE TABLE IF NOT EXISTS `biempleos`.`usuarios_aspirantes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_aspirante` INT UNSIGNED NOT NULL,
  `correo` VARCHAR(254) NOT NULL,
  `contrasena` VARCHAR(32) NOT NULL,
  `gcmKey` LONGTEXT NOT NULL,
  `activo` TINYINT NOT NULL DEFAULT TRUE,
  UNIQUE INDEX (`correo` ASC),
  PRIMARY KEY (`id`),
  INDEX `fk_usuarios_aspirantes_aspirantes_idx` (`id_aspirante` ASC),
  CONSTRAINT `fk_usuarios_aspirantes_aspirantes`
    FOREIGN KEY (`id_aspirante`)
    REFERENCES `biempleos`.`aspirantes` (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
