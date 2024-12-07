-- MySQL Script generated by MySQL Workbench
-- Sat Nov 30 10:47:57 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema pizzaria
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema pizzaria
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pizzaria` DEFAULT CHARACTER SET utf8 ;
USE `pizzaria` ;

-- -----------------------------------------------------
-- Table `pizzaria`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pizzaria`.`orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(35) NOT NULL,
  `last_name` VARCHAR(50) NULL,
  `email` VARCHAR(255) NULL,
  `phone` VARCHAR(17) NOT NULL,
  `street` VARCHAR(100) NOT NULL,
  `number` INT NOT NULL,
  `date` DATETIME NULL DEFAULT NOW(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pizzaria`.`pizzas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pizzaria`.`pizzas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `orders_id` INT NOT NULL,
  `size` VARCHAR(15) NOT NULL,
  `dough_type` VARCHAR(45) NOT NULL,
  `sauce_type` VARCHAR(45) NOT NULL,
  `cheeses_type` VARCHAR(100) NOT NULL,
  `toppings_type` VARCHAR(600) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pizzas_orders_idx` (`orders_id` ASC),
  CONSTRAINT `fk_pizzas_orders`
    FOREIGN KEY (`orders_id`)
    REFERENCES `pizzaria`.`orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
