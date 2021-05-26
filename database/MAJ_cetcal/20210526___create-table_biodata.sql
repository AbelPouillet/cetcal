use cetcal;
CREATE TABLE cetcal_biodata (
  id INT NOT NULL AUTO_INCREMENT,
  dept INT NOT NULL,
  denomination VARCHAR(512) NOT NULL,
  adr_certification VARCHAR(512) NOT NULL,
  id_certification VARCHAR(512) NOT NULL,
  source VARCHAR(128) NOT NULL,
  PRIMARY KEY (id)
);