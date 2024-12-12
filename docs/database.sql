
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
