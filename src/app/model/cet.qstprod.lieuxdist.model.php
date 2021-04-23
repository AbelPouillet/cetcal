<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class QSTPRODLieuModel extends CETCALModel
{

  /**
   * Gestion de l'écriture en base lors de l'inscription ou des ré-écriture / updates en contexte de modification.
   */
  public function gestionEnvoiQstprod($pPK, $pLieuDto, $contextMdifGlobal, $pk_mdif)
  {
    $this->createLieu($contextMdifGlobal ? $pk_mdif : $pPK, $pLieuDto);
  }

  public function getSousTypesSiNonNULL($type)
  {
    try 
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_SOUS_TYPE_LIEU_BY_TYPE);
      $stmt->bindParam(":pType", $type, PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_OBJ);

      return $data;
    }
    catch (Exception $e)
    {
      error_log($e->getMessage());
    }
  }

  /**
   * fonctions publiques
   */
  public function allLieuDist()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_TYPE_LIEU);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function allLieuDist2()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_TYPE_LIEU);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $filtered = array_unique($data);

    return $filtered;
  }

  /**
   * Permet de récupérer tout les sous types d'un type
   * @param string $type
   * @return array
   */
  public function findOneTypeLieu($type)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ONE_TYPE_LIEU);
    $stmt->bindParam(":pType", $type, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  public function getAllMarcheDenomination()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_DENOMINATION_MARCHE);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }


  public function getAllAmapDenomination()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_DENOMINATION_AMAP);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }

  /* *************************************************************************************************
   * fonctions privées.
   */

  private function createLieu($pPK, $pLieuDto) 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signuplieuxdist.dto.php');
    $dtoLieux = new QstLieuxDistributionDTO();
    $dtoLieux = unserialize($pLieuDto);
  }

}