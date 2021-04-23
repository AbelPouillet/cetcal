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

  /**
   * fonctions publiques
   */
  public static function allLieuDist()
  {
    $model = new CETCALModel();
    $qLib = $model->getQuerylib();
    $stmt = $model->getCnxdb()->prepare($qLib::SELECT_ALL_TYPE_LIEU);
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
  public function findOneTypeLieu(string $type)
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
    $model = new CETCALModel();
    $qLib = $model->getQuerylib();
    $stmt = $model->getCnxdb()->prepare($qLib::SELECT_ALL_DENOMINATION_MARCHE);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $data;
  }


  public function getAllAmapDenomination()
  {
    $model = new CETCALModel();
    $qLib = $model->getQuerylib();
    $stmt = $model->getCnxdb()->prepare($qLib::SELECT_ALL_DENOMINATION_AMAP);
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