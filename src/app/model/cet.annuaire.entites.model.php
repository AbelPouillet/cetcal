<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class CETCALEntitesModel extends CETCALModel 
{

  public function insert($csvlines)
  {
    try 
    {
      /**
       * CSV splitter = ¤.
       * CSV definition : 
       Associations/distributeurs;territoire;Activité;adresse;tel;Contacts;Email;site internet;adresse distribution paniers ou commandes;jour/horaire;  éthique produits fournis
       */
      foreach ($csvlines as $csvline)
      {
        $data = explode("¤", $csvline);
        if (!is_array($data) || count($data) !== 11) continue;
        
        for ($i=0; $i < count($data); $i++) 
        { 
          if (!is_string($data[$i])) $data[$i] = '';
          if (is_string($data[$i]) && $data[$i] == 'null') $data[$i] = '';
        } 

        $denomination = $data[0];
        $territoire = $data[1];
        $activite = $data[2];
        $adr = $data[3];
        $tels = $data[4];
        $personne = $data[5];
        $email = $data[6];
        $urlwww = $data[7];
        $infoscmd = $data[8];
        $jourh = $data[9];
        $specificite = $data[10];

        if ($this->exists($denomination)) 
        {
          continue;
        }
        else
        {
          $qLib = $this->getQuerylib();
          $stmt = $this->getCnxdb()->prepare($qLib::INSERT_INTO_CETCAL_ENTITES);
          $stmt->bindParam(":pDenomination", $denomination, PDO::PARAM_STR);
          $stmt->bindParam(":pTerritoire", $territoire, PDO::PARAM_STR);
          $stmt->bindParam(":pActivite", $activite, PDO::PARAM_STR);
          $stmt->bindParam(":pAdrliterale", $adr, PDO::PARAM_STR);
          $stmt->bindParam(":pTels", $tels, PDO::PARAM_STR);
          $stmt->bindParam(":pContactPersonne", $personne, PDO::PARAM_STR);
          $stmt->bindParam(":pEmail", $email, PDO::PARAM_STR);
          $stmt->bindParam(":pUrlwww", $urlwww, PDO::PARAM_STR);
          $stmt->bindParam(":pInfoCommande", $infoscmd, PDO::PARAM_STR);
          $stmt->bindParam(":pJourHoraire", $jourh, PDO::PARAM_STR);
          $stmt->bindParam(":pSpecificite", $specificite, PDO::PARAM_STR);
          $stmt->execute();    
        } 
      }
    }
    catch (Exception $e)
    {
      var_dump($e);
    }
  }

  public function insertMarches($csvlines) 
  {
    /**
      CSV example : 
      Marché de Pujols;33350-pujols/890;Ce marché a lieu toute l'année le samedi de 8h à 13h;Centre ville
      Soit : denomination, adresse, jourhoraire, infoscmd, activite='marche du castillonnais'
    */
    foreach ($csvlines as $csvline)
    {
      try 
      {
        $data = explode(";", $csvline);

        $denomination = $data[0];
        $adr = explode("$", explode("/", $data[1])[0]);
        $adrlit = $adr[0].' '.ucfirst($adr[1]);
        $jourh = str_replace("Ce marché a lieu toute l'année ", '', $data[2]);
        $jourh = str_replace("les jours suivants : ", '', $jourh);
        $activite = "marche du castillonnais";
        $infoscmd = "";
        $specificite = "";

        //echo '<p>'.$denomination.', '.$adrlit.', '.$jourh.'</p>';

        if ($this->exists($denomination)) 
        {
          continue;
        }
        else
        {
          $qLib = $this->getQuerylib();
          $stmt = $this->getCnxdb()->prepare($qLib::INSERT_INTO_CETCAL_ENTITES_MARCHE);
          $stmt->bindParam(":pDenomination", $denomination, PDO::PARAM_STR);
          $stmt->bindParam(":pActivite", $activite, PDO::PARAM_STR);
          $stmt->bindParam(":pAdrliterale", $adrlit, PDO::PARAM_STR);
          $stmt->bindParam(":pInfoCommande", $infoscmd, PDO::PARAM_STR);
          $stmt->bindParam(":pJourHoraire", $jourh, PDO::PARAM_STR);
          $stmt->bindParam(":pSpecificite", $specificite, PDO::PARAM_STR);
          $stmt->execute();    
        }
      }
      catch (Exception $e)
      {
        var_dump($e);
      }  
    }  
  }

  private function exists($denomination)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_PK_CETCAL_ENTITE_BY_DENOMINATION);
    $stmt->execute(['pDenomination' => $denomination]);
    $data = $stmt->fetchAll();

    foreach ($data as $row) 
    {
      if (isset($row['denomination']) && 
        strcmp($row['denomination'], $denomination) === 0) return true;
    }
    return false;
  }

  public function selectAllIsMarche()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CETCAL_ENTITE_IS_MARCHE);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

  public function selectAllNotMarche()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CETCAL_ENTITE_NOT_MARCHE);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

  public function selectAll()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CETCAL_ENTITE);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

}