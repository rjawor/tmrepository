-- MySQL Script generated by MySQL Workbench
-- sob, 8 paź 2016, 21:57:03
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema tmrepository
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `tmrepository` ;

-- -----------------------------------------------------
-- Schema tmrepository
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tmrepository` DEFAULT CHARACTER SET utf8 ;
USE `tmrepository` ;

-- -----------------------------------------------------
-- Table `tmrepository`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmrepository`.`roles` ;

CREATE TABLE IF NOT EXISTS `tmrepository`.`roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tmrepository`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmrepository`.`users` ;

CREATE TABLE IF NOT EXISTS `tmrepository`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(30) NULL,
  `password` TEXT NULL,
  `role_id` INT NOT NULL,
  `firstname` VARCHAR(45) NULL,
  `lastname` VARCHAR(100) NULL,
  `email` VARCHAR(100) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_roles1_idx` (`role_id` ASC),
  CONSTRAINT `fk_users_roles1`
    FOREIGN KEY (`role_id`)
    REFERENCES `tmrepository`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tmrepository`.`languages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmrepository`.`languages` ;

CREATE TABLE IF NOT EXISTS `tmrepository`.`languages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(10) NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tmrepository`.`tm_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmrepository`.`tm_types` ;

CREATE TABLE IF NOT EXISTS `tmrepository`.`tm_types` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `tmrepository`.`domains`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmrepository`.`domains` ;

CREATE TABLE IF NOT EXISTS `tmrepository`.`domains` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `tmrepository`.`translation_memories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmrepository`.`translation_memories` ;

CREATE TABLE IF NOT EXISTS `tmrepository`.`translation_memories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` TEXT NULL,
  `description` TEXT NULL,
  `user_id` INT NOT NULL,
  `source_language_id` INT NOT NULL,
  `target_language_id` INT NOT NULL,
  `tm_type_id` INT NOT NULL,
  `domain_id` INT DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_translation_memories_users_idx` (`user_id` ASC),
  INDEX `fk_translation_memories_languages1_idx` (`source_language_id` ASC),
  INDEX `fk_translation_memories_languages2_idx` (`target_language_id` ASC),
  INDEX `fk_translation_memories_tm_types1_idx` (`tm_type_id` ASC),
  INDEX `fk_translation_memories_domains_idx` (`domain_id` ASC),
  CONSTRAINT `fk_translation_memories_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `tmrepository`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_translation_memories_languages1`
    FOREIGN KEY (`source_language_id`)
    REFERENCES `tmrepository`.`languages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_translation_memories_languages2`
    FOREIGN KEY (`target_language_id`)
    REFERENCES `tmrepository`.`languages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_translation_memories_tm_types1`
    FOREIGN KEY (`tm_type_id`)
    REFERENCES `tmrepository`.`tm_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tmrepository`.`units`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tmrepository`.`units` ;

CREATE TABLE IF NOT EXISTS `tmrepository`.`units` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `translation_memory_id` INT NOT NULL,
  `source_segment` TEXT NULL,
  `target_segment` TEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_units_translation_memories1_idx` (`translation_memory_id` ASC),
  CONSTRAINT `fk_units_translation_memories1`
    FOREIGN KEY (`translation_memory_id`)
    REFERENCES `tmrepository`.`translation_memories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
