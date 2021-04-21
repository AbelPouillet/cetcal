-- -----------------------------------------------------
-- Table cetcal.cetcal_cartographie
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS cetcal.cetcal_cartographie (
  pk_cartographie INT NOT NULL AUTO_INCREMENT,
  cetcal_prd_lat VARCHAR(16) NOT NULL,
  cetcal_prd_lng VARCHAR(16) NOT NULL,
  fk_producteur INT NOT NULL,
  PRIMARY KEY (pk_cartographie))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table cetcal.cetcal_entite
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS cetcal.cetcal_entite (
  pk_entite INT NOT NULL AUTO_INCREMENT,
  fk_producteur INT NULL,
  fk_lieu INT NULL,
  fk_produit INT NULL,
  denomination VARCHAR(128) NOT NULL,
  territoire VARCHAR(64) NULL,
  activite VARCHAR(64) NULL,
  adresse VARCHAR(256) NULL,
  tels VARCHAR(45) NULL,
  personne VARCHAR(45) NULL,
  email VARCHAR(64) NULL,
  urlwww VARCHAR(256) NULL,
  infoscmd VARCHAR(512) NULL,
  jourhoraire VARCHAR(128) NULL,
  specificites VARCHAR(512) NULL,
  PRIMARY KEY (pk_entite))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


