<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.+ for communes CETCAL.
 */
class CETCALCommunesModel extends CETCALModel 
{

  public function update($data, $lat, $lng) 
  {
    try 
    {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::UPDATE_COMMUNES_BY_LIBELLE);

      $stmt->bindParam(":pLat", $lat, PDO::PARAM_STR);
      $stmt->bindParam(":pLng", $lng, PDO::PARAM_STR);
      $stmt->bindParam(":pId", $data['id'], PDO::PARAM_INT);
      $stmt->bindParam(":pLibelle", $data['libelle'], PDO::PARAM_STR);
      $stmt->execute();
    }
    catch (Exception $e)
    {
      error_log(var_dump($e));
    }
  }  

  public function getLibelleCommuneByPK($pk) 
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_COMMUNE_BY_PK);
    $stmt->bindParam(":pId",  $pk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch();

    return isset($data['libelle']) ? $data['libelle'] : false;
  }

  public function selectAll()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CETCAL_COMMUNES);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

  public function selectAllGeolocSet()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CETCAL_COMMUNES_GEOLOC_SET);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

  public function hasGeolocData($id)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_COMMUNES_BY_ID_LATLNG_EXISTS);
    $stmt->bindParam(":pId", $id, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    if (count($data) <= 0) return false;
    else return true;
  }

}