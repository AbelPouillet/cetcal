<?php
require_once('cet.annuaire.annuaire.controller.php');

/**
 * 
 */
class MarchesCastillonnaisController extends AnnuaireController
{

  function __construct() { }

  public function init() 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
    $model = new CETCALEntitesModel();
    $data = $model->selectAllIsMarche();
    return $data;
  }
  
}