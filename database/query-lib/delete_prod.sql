DELETE cetcal.producteur_join_lieu.*, cetcal.cetcal_lieu.* FROM cetcal.producteur_join_lieu INNER JOIN cetcal.cetcal_lieu ON cetcal.producteur_join_lieu.fk_lieu=cetcal.cetcal_lieu.pk_lieu WHERE cetcal.producteur_join_lieu.fk_producteur_join IN (1, 52, 54, 55, 56);
DELETE cetcal.producteur_join_produits.*, cetcal.cetcal_produit.* FROM cetcal.producteur_join_produits INNER JOIN cetcal.cetcal_produit ON cetcal.producteur_join_produits.fk_produits_join=cetcal.cetcal_produit.pk_produit WHERE cetcal.producteur_join_produits.fk_producteur_join IN (1, 52, 54, 55, 56);
DELETE FROM cetcal.cetcal_type_production WHERE fk_producteur_type_production IN (1, 52, 54, 55, 56);
DELETE FROM cetcal.cetcal_specificite_produits WHERE fk_producteur_specificites_produits IN (1, 52, 54, 55, 56);
DELETE FROM cetcal.cetcal_sondage WHERE fk_producteur_sondage IN (1, 52, 54, 55, 56);
DELETE FROM cetcal.cetcal_mode_conso WHERE fk_producteur_mode_conso IN (1, 52, 54, 55, 56);
DELETE FROM cetcal.cetcal_mode_conso WHERE fk_producteur_mode_conso IN (1, 52, 54, 55, 56);
DELETE FROM cetcal.cetcal_information_producteur WHERE fk_producteur_information_producteur IN (1, 52, 54, 55, 56);

delete from cetcal_producteur where pk_producteur IN (1, 52, 54, 55, 56);
| pk_producteur |
+---------------+
|             1 |
|            52 |
|            54 |
|            55 |
|            56 |
+---------------+