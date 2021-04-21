<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class CETCALCartographieModel extends CETCALModel 
{

  public function getLatLng($pFk)
  {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_CARTOGRAPHIE_WHERE_PKFK);
      $stmt->bindParam(":pFkProducteur", $pFk, PDO::PARAM_INT);
      $stmt->execute();
      $data = $stmt->fetch(); 

      return $data;
  }

  public function exists($pFk)
  {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_COUNT_CRT_WHERE_PKFK);
      $stmt->bindParam(":pFkProducteur", $pFk, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetchColumn();
  }

  public function insert($latLng, $fk)
  {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_CARTOGRAPHIE);
      $stmt->bindParam(":pLat", $latLng[0], PDO::PARAM_STR);
      $stmt->bindParam(":pLng", $latLng[1], PDO::PARAM_STR);
      $stmt->bindParam(":pFkProducteur", $fk, PDO::PARAM_INT);
      $stmt->execute();
  }

}