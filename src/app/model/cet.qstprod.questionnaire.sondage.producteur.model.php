<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class QSTPRODSondageProducteurModel extends CETCALModel 
{
  
  public function createSondages($pPK, $pInfoGeneralesDto) 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    $dtoinfos = new QstProdGeneraleDTO();
    $dtoinfos = unserialize($pInfoGeneralesDto);
    
    foreach ($dtoinfos->sondageDifficultes as $difficulte) 
    {
      $qrsondage = explode(";", $difficulte);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_SONDAGE);
      $stmt->bindParam(":pPkProducteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pClefQuestion", $qrsondage[0], PDO::PARAM_STR);
      $stmt->bindParam(":pReponse", $qrsondage[1], PDO::PARAM_STR);
      $stmt->execute();
    }

    foreach ($dtoinfos->sondage as $reponse) 
    {
      $qrsondage = explode(";", $reponse);
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_SONDAGE);
      $stmt->bindParam(":pPkProducteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pClefQuestion", $qrsondage[0], PDO::PARAM_STR);
      $stmt->bindParam(":pReponse", $qrsondage[1], PDO::PARAM_STR);
      $stmt->execute();
    }

    if (isset($dtoinfos->sondageNombrePostes)) 
    {
      $clefQuestion = "snbp";
      $valQuestion = "Nombre de postes";
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_SONDAGE_NBRS);
      $stmt->bindParam(":pPkProducteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pClefQuestion", $clefQuestion, PDO::PARAM_STR);
      $stmt->bindParam(":pValQuestion", $valQuestion, PDO::PARAM_STR);
      $stmt->bindParam(":pReponse", $dtoinfos->sondageNombrePostes, PDO::PARAM_STR);
      $stmt->execute();
    }

    if (isset($dtoinfos->sondageNombreSaisonniers)) 
    {
      $clefQuestion = "snbs";
      $valQuestion = "Nombre de saisonniers";
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_SONDAGE_NBRS);
      $stmt->bindParam(":pPkProducteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pClefQuestion", $clefQuestion, PDO::PARAM_STR);
      $stmt->bindParam(":pValQuestion", $valQuestion, PDO::PARAM_STR);
      $stmt->bindParam(":pReponse", $dtoinfos->sondageNombreSaisonniers, PDO::PARAM_STR);
      $stmt->execute();
    }

    if (isset($dtoinfos->sondageNombreHeuresSemaine)) 
    {
      $clefQuestion = "snhs";
      $valQuestion = "Nombre d'heures semaine";
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_SONDAGE_NBRS);
      $stmt->bindParam(":pPkProducteur", $pPK, PDO::PARAM_INT);
      $stmt->bindParam(":pClefQuestion", $clefQuestion, PDO::PARAM_STR);
      $stmt->bindParam(":pValQuestion", $valQuestion, PDO::PARAM_STR);
      $stmt->bindParam(":pReponse", $dtoinfos->sondageNombreHeuresSemaine, PDO::PARAM_STR);
      $stmt->execute();
    }
  }

}