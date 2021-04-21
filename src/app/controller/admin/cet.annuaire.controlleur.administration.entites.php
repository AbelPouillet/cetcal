<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.annuaire.controller.php');

/**
 * 
 */
class AdminEntitesCastillonnaisController extends AnnuaireController
{

  function __construct() { }

  public function insertEntite($post)
  {
    try
    {
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
      $dataProcessor = new HTTPDataProcessor();
      $data = array();

      // POST form logic - dans l'ordre du formulaire HTML :
      $data['denomination'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-denomination']) ? $post['entite-entite-denomination'] : NULL);
      $data['territoire'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-territoire']) ? $post['entite-entite-territoire'] : NULL);
      $data['activite'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-activite']) ? $post['entite-entite-activite'] : NULL);
      $data['adr'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-adresse']) ? $post['entite-entite-adresse'] : NULL);
      $data['tel'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-tel']) ? $post['entite-entite-tel'] : NULL);
      $data['personne'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-personne']) ? $post['entite-entite-personne'] : NULL);
      $data['email'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-email']) ? $post['entite-entite-email'] : NULL);
      $data['urlwww'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-urlwww']) ? $post['entite-entite-urlwww'] : NULL);
      $data['infoscmd'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-infoscmd']) ? $post['entite-entite-infoscmd'] : NULL);
      $data['jourh'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-jourhoraire']) ? $post['entite-entite-jourhoraire'] : NULL);
      $data['specificite'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-specificites']) ? $post['entite-entite-specificites'] : NULL);
      $data['type'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-type']) ? $post['entite-entite-type'] : NULL);

      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
      $model = new CETCALEntitesModel();
      $model->insertEntite($data);
    }
    catch (Exception $e) 
    {
      var_dump($e);
      return false;
    }

    return true;
  }

  public function updateEntite($post)
  {
    try
    {
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
      $dataProcessor = new HTTPDataProcessor();
      $data = array();

      // POST form logic - dans l'ordre du formulaire HTML :
      $data['denomination'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-denomination']) ? $post['entite-entite-denomination'] : NULL);
      $data['territoire'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-territoire']) ? $post['entite-entite-territoire'] : NULL);
      $data['activite'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-activite']) ? $post['entite-entite-activite'] : NULL);
      $data['adr'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-adresse']) ? $post['entite-entite-adresse'] : NULL);
      $data['tel'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-tel']) ? $post['entite-entite-tel'] : NULL);
      $data['personne'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-personne']) ? $post['entite-entite-personne'] : NULL);
      $data['email'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-email']) ? $post['entite-entite-email'] : NULL);
      $data['urlwww'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-urlwww']) ? $post['entite-entite-urlwww'] : NULL);
      $data['infoscmd'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-infoscmd']) ? $post['entite-entite-infoscmd'] : NULL);
      $data['jourh'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-jourhoraire']) ? $post['entite-entite-jourhoraire'] : NULL);
      $data['specificite'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-specificites']) ? $post['entite-entite-specificites'] : NULL);
      $data['type'] = $dataProcessor->processHttpFormData(
        isset($post['entite-entite-type']) ? $post['entite-entite-type'] : NULL);
      $data['admin-pk-entite'] = $dataProcessor->processHttpFormData(
        isset($post['admin-pk-entite']) ? $post['admin-pk-entite'] : NULL);

      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
      $model = new CETCALEntitesModel();
      $model->updateEntite($data);
    }
    catch (Exception $e) 
    {
      var_dump($e);
      return false;
    }

    return true;
  }

  public function deleteEntite($post)
  {
    try
    {
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
      $dataProcessor = new HTTPDataProcessor();
      $data = array();

      $data['admin-pk-entite'] = $dataProcessor->processHttpFormData(
        isset($post['admin-pk-entite']) ? $post['admin-pk-entite'] : NULL);

      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
      $model = new CETCALEntitesModel();
      $model->deleteEntite($data);
    }
    catch (Exception $e) 
    {
      var_dump($e);
      return false;
    }

    return true;
  }

  public function selectByPk($pk)
  {
    try
    {
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
      $model = new CETCALEntitesModel();
      return $model->selectByPk($pk); 
    }
    catch (Exception $e) 
    {
      var_dump($e);
    }
    return false;
  }

  public function selectAll()
  {
    try
    {
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.entites.model.php');
      $model = new CETCALEntitesModel();
      return $model->selectAll(); 
    }
    catch (Exception $e) 
    {
      var_dump($e);
    }
    return false;
  }

}