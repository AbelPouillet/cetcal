<?php
/**
 * 
 */
class CETCALCartographieController
{

  function __construct() { }

  public function fetchDataCartographie() 
  {
    $result = array();
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.producteurs.model.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/admin/cet.qstprod.admin.cartographie.loader.php');
    $model = new QSTPRODProducteurModel();
    $result = $model->fetchAllDataToDTOArray();
    $loader = new CETCALCartographieLoader();
    $loader->load($result);

    return $result;
  }

}