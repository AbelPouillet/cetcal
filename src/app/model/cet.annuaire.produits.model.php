<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class AnnuaireProduitsModel extends CETCALModel 
{
  public function selectAllDistinctLibellesProduits()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_DISTINCT_NOMS_PRODUITS);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }
}