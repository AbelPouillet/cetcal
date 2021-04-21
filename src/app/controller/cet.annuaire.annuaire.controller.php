<?php
/**
 * 
 */
class AnnuaireController
{

  function __construct() { }

  public function loadQuery($filtre, $type)
  {
    $res = array();
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
    $dataProcessor = new HTTPDataProcessor();
    $data = $this->init($type);
    $motCle = isset($filtre) ? $dataProcessor->processHttpFormData($filtre) : false;

    foreach ($data as $row)
    {
      foreach ($row as $key => $value) 
      {
        if (!isset($value)) continue; 
        $index = stripos($value, $motCle);
        if ($index !== false && $index >= 0) 
        {
          array_push($res, str_ireplace($filtre, '<span class="cet-r-q">'.$filtre.'</span>', $row));
          break;
        }
      }
    }

    return !$filtre ? $data : $res;
  }

  public function init($type) 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
    $model = new CETCALEntitesModel();
    $data = $model->selectAllByType($type);
    return $data;
  }

  public function filtrerProducteurs($filtre, $data)
  {
    $res = array();
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
    $dataProcessor = new HTTPDataProcessor();
    $motCle = isset($filtre) ? $dataProcessor->processHttpFormData($filtre) : false;

    foreach ($data as $row)
    {
      foreach ($row as $key => $value) 
      {
        if (!isset($value)) continue; 
        $index = stripos(strval($value), $motCle);
        if ($index !== false && $index >= 0) 
        {
          $row->$key = str_ireplace($filtre, '<span class="cet-r-q">'.$filtre.'</span>', $row->$key);
          array_push($res, $row);
          break;
        }
      }
    }

    return !$filtre ? $data : $res;
  }

  public function splitData($spliter, $data)
  {
    $res = array();
    if (!strpos($data, $spliter)) array_push($res, $data);
    else $res = explode($spliter, $data);
    return $res;
  }

  /**
   * Lecture données producteur.
   */
  public function fetchAllFrontEndDTOArray()
  {
    $res = [];
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.producteurs.model.php');
    $model = new QSTPRODProducteurModel();
    $data = $model->fetchAllListing();
    return $data;
  }

  /**
   * Lecture données partenaires.
   */
  public function fetchPartenairesLiens() 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.partenaires.liens.model.php');
    $model = new CETCALPartenairesLiensModel();
    $data = $model->selectAll();
    return $data;
  }

  public function getCommunes()
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.communes.model.php');
    $model = new CETCALCommunesModel();
    $data = $model->selectAll();
    return $data; 
  }

}