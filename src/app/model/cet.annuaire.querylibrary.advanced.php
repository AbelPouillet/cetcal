<?php
/**
 * Sql query's de type avancées.
 */
class CETCALAdvancedQueryLibrary
{

  const SELECT_PKS_PRODUCTEUR_BY_NOM_PRODUIT_WILCARDS = "SELECT distinct(prd.pk_producteur) FROM cetcal.cetcal_producteur prd, cetcal.cetcal_produit p, cetcal.producteur_join_produits j WHERE 1=1 AND p.pk_produit=j.fk_produits_join AND j.fk_producteur_join=prd.pk_producteur AND p.nom LIKE CONCAT('%', :pNomProduit, '%');";
  const SELECT_PKS_PRODUCTEUR_BY_NOM_PRODUIT = "SELECT distinct(prd.pk_producteur) FROM cetcal.cetcal_producteur prd, cetcal.cetcal_produit p, cetcal.producteur_join_produits j WHERE 1=1 AND p.pk_produit=j.fk_produits_join AND j.fk_producteur_join=prd.pk_producteur AND p.nom=:pNomProduit;";

  const SELECT_CETCAL_PRODUCTEUR_IN_PKS = "SELECT * from cetcal.cetcal_producteur WHERE pk_producteur IN ([pks]);";

}