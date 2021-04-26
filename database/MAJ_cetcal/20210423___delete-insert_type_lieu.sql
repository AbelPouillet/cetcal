use cetcal;
alter table cetcal_type_lieu ADD column code_type VARCHAR(4) NOT NULL;
alter table cetcal_type_lieu ADD column code_sous_type VARCHAR(4) NOT NULL;

delete from cetcal_type_lieu;
INSERT INTO cetcal.cetcal_type_lieu (code_type, type, code_sous_type, sous_type) VALUES ('mbio', 'Magasin Biologique', 'epcr', 'Épicerie')
INSERT INTO cetcal.cetcal_type_lieu (code_type, type, code_sous_type, sous_type) VALUES ('mbio', 'Magasin Biologique', 'cvst', 'Caviste');
INSERT INTO cetcal.cetcal_type_lieu (code_type, type, code_sous_type, sous_type) VALUES ('mbio', 'Magasin Biologique', 'vrac', 'Vrac');
INSERT INTO cetcal.cetcal_type_lieu (code_type, type, code_sous_type, sous_type) VALUES ('mprd', 'Magasin de producteurs', '----', NULL);
INSERT INTO cetcal.cetcal_type_lieu (code_type, type, code_sous_type, sous_type) VALUES ('mrch', 'Marché', '----', NULL);
INSERT INTO cetcal.cetcal_type_lieu (code_type, type, code_sous_type, sous_type) VALUES ('rvcc', 'Réseau de vente en circuit court', 'amap', 'AMAP');
INSERT INTO cetcal.cetcal_type_lieu (code_type, type, code_sous_type, sous_type) VALUES ('rvcc', 'Réseau de vente en circuit court', 'driv', 'Drive');
INSERT INTO cetcal.cetcal_type_lieu (code_type, type, code_sous_type, sous_type) VALUES ('rvcc', 'Réseau de vente en circuit court', 'rqdo', 'Ruche qui dit Oui !');
INSERT INTO cetcal.cetcal_type_lieu (code_type, type, code_sous_type, sous_type) VALUES ('rvcc', 'Réseau de vente en circuit court', 'dndt', 'Distributeur indépendant');
INSERT INTO cetcal.cetcal_type_lieu (code_type, type, code_sous_type, sous_type) VALUES ('rvcc', 'Réseau de vente en circuit court', 'grpa', 'Groupement d’achat');
INSERT INTO cetcal.cetcal_type_lieu (code_type, type, code_sous_type, sous_type) VALUES ('rvcc', 'Réseau de vente en circuit court', 'ddca', 'Distributeur de casiers automatiques');
INSERT INTO cetcal.cetcal_type_lieu (code_type, type, code_sous_type, sous_type) VALUES ('cmch', 'Cooperative / Maraîcher', '----', NULL);
INSERT INTO cetcal.cetcal_type_lieu (code_type, type, code_sous_type, sous_type) VALUES ('vntd', 'Vente directe', 'frme', 'à la ferme');
INSERT INTO cetcal.cetcal_type_lieu (code_type, type, code_sous_type, sous_type) VALUES ('vntd', 'Vente directe', 'livr', 'en livraison');
INSERT INTO cetcal.cetcal_type_lieu (code_type, type, code_sous_type, sous_type) VALUES ('xprt', 'Export', 'hreg', 'Hors région, sur territoire National');
INSERT INTO cetcal.cetcal_type_lieu (code_type, type, code_sous_type, sous_type) VALUES ('xprt', 'Export', 'intr', 'à l\'international');