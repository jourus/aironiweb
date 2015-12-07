CREATE TABLE `airophp`.`INFORMAZIONI` (
  `tipo` VARCHAR(255) NOT NULL,
  `localita` VARCHAR(255) NOT NULL,
  `provincia` VARCHAR(255) NOT NULL,
  `compagnia` VARCHAR(255) NOT NULL,
  `data` date NOT NULL,
  
  PRIMARY KEY (`tipo`));

ALTER TABLE `airophp`.`INFORMAZIONI` 
ADD COLUMN `piazzole` INT NOT NULL DEFAULT 24 AFTER `data`;
