CREATE TABLE `cetcal`.`cetcal_type_lieu` (
 `id` INT NOT NULL,
 `type` VARCHAR(128) NULL,
 `sous_type` VARCHAR(128) NULL,
 PRIMARY KEY (`id`));

ALTER TABLE `cetcal`.`cetcal_type_lieu`
CHANGE COLUMN `id` `id` INT NOT NULL AUTO_INCREMENT ;

INSERT INTO cetcal.cetcal_type_lieu (type, sous_type) VALUES ('magasin biologique', 'epicerie')
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('magasin biologique', 'caviste');
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('magasin biologique', 'vrac');

/*Magasin de producteur*/

INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('magasin de producteurs', NULL);

/*Marché*/

INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('marché', NULL);

/*circuit court*/

INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('reseau de vente en circuit court', 'amap');
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('reseau de vente en circuit court', 'drive');
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('reseau de vente en circuit court', 'ruche');
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('reseau de vente en circuit court', 'distributeur independant');
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('reseau de vente en circuit court', 'groupement d’achat');
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('reseau de vente en circuit court', 'distributeur de casiers automatique');

/*coopérative producteurs et maraichers*/

INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('cooperative / maraicher', NULL);

/*vente directe*/

INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('vente directe', 'a la ferme');
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('vente directe', 'livraison');

/*Export*/

INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('export', 'hors région');
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('export', 'international');
