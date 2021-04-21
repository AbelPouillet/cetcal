<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class QSTPRODProducteurModel extends CETCALModel 
{
  
  public function createProducteur($pProducteurDto, $pProduitsDto, $pConsoDto, $pOpinionsProducteurs) 
  {
    /**
     * Générer un identifiant de connexion et cela dans tous les 
     * cas (email, n° tel fixe ou mobile renseingés).
     */
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.identifiantcet.php');
    $idHelper = new IdentifiantCETHelper();
    $cetcal_web_id = $idHelper->generateRandomString();
    while ($this->identifiantExists($cetcal_web_id)) $cetcal_web_id = $idHelper->generateRandomString(12);

    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupprods.dto.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupconso.dto.php');
    $nullClef= '0000';
    $dtoGenerale = new QstProdGeneraleDTO();
    $dtoGenerale = unserialize($pProducteurDto);
    $dtoProduits = new QstProduitDTO();
    $dtoProduits = unserialize($pProduitsDto);
    $dtoConsomation = new QstConsomateursDTO();
    $dtoConsomation = unserialize($pConsoDto);

    $prodInscrit = 'true';
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::INSERT_QSTPROD_PRODUCTEUR);
    $stmt->bindParam(":pNom", $dtoGenerale->nom, PDO::PARAM_STR);
    $stmt->bindParam(":pPrenom", $dtoGenerale->prenom, PDO::PARAM_STR);
    $stmt->bindParam(":pEmail", $dtoGenerale->email, PDO::PARAM_STR);
    $stmt->bindParam(":pEmailBu", $dtoGenerale->email, PDO::PARAM_STR);
    $stmt->bindParam(":pMdpsha", $dtoGenerale->motdepasseMD5, PDO::PARAM_STR);
    $stmt->bindParam(":pTelfixe", $dtoGenerale->telfix, PDO::PARAM_STR);
    $stmt->bindParam(":pTelPort", $dtoGenerale->telport, PDO::PARAM_STR);
    $stmt->bindParam(":pNomFerme", $dtoGenerale->nomferme, PDO::PARAM_STR);
    $stmt->bindParam(":pSiret", $dtoGenerale->siret, PDO::PARAM_STR);
    $stmt->bindParam(":pAdrNumvoie", $dtoGenerale->adrNumvoie, PDO::PARAM_STR);
    $stmt->bindParam(":pAdrRue", $dtoGenerale->adrRue, PDO::PARAM_STR);
    $stmt->bindParam(":pAdrLieudit", $dtoGenerale->adrLieudit, PDO::PARAM_STR);
    $stmt->bindParam(":pAdrCommune", $dtoGenerale->adrCommune, PDO::PARAM_STR);
    $stmt->bindParam(":pAdrcp", $dtoGenerale->adrCodePostal, PDO::PARAM_STR);
    $stmt->bindParam(":pAdrCmpladr", $dtoGenerale->adrComplementAdr, PDO::PARAM_STR);
    $stmt->bindParam(":pPageFb", $dtoGenerale->pageFB, PDO::PARAM_STR);
    $stmt->bindParam(":pPageIg", $dtoGenerale->pageIG, PDO::PARAM_STR);
    $stmt->bindParam(":pPageTwitter", $dtoGenerale->pageTwitter, PDO::PARAM_STR);
    $stmt->bindParam(":pUrlWeb", $dtoGenerale->siteWebUrl, PDO::PARAM_STR);
    $stmt->bindParam(":pUrlBoutique", $dtoGenerale->boutiqueEnLigneUrl, PDO::PARAM_STR);
    $stmt->bindParam(":pOrgCertifBio", $dtoGenerale->organismeCertificateurBIO, PDO::PARAM_STR);
    $stmt->bindParam(":pSurfaceHectTerres", $dtoGenerale->surfaceHectTerres, PDO::PARAM_STR);
    $stmt->bindParam(":pSurfaceAresSerre", $dtoGenerale->surfaceHectSousSerre, PDO::PARAM_STR);
    $stmt->bindParam(":pNbrTetes", $dtoGenerale->nbrTetesBetail, PDO::PARAM_STR);
    $stmt->bindParam(":pHLParAn", $dtoGenerale->hectolitresParAn, PDO::PARAM_STR);
    $stmt->bindParam(":pGroupeCagette", $dtoGenerale->groupeCagette, PDO::PARAM_STR);
    $stmt->bindParam(":pIndentifiantCet", $cetcal_web_id, PDO::PARAM_STR);
    $stmt->bindParam(":pOpinions", $pOpinionsProducteurs, PDO::PARAM_STR);
    $stmt->bindParam(":pProdInscrit", $prodInscrit, PDO::PARAM_STR);
    $stmt->execute();
    $pk = $this->getCnxdb()->lastInsertId();

    if (isset($dtoGenerale->typeDeProductionAutre) && strlen($dtoGenerale->typeDeProductionAutre) > 0) array_push($dtoGenerale->typeDeProduction, "0001;".$dtoGenerale->typeDeProductionAutre);
    foreach ($dtoGenerale->typeDeProduction as $type) 
    {
      $typeprod = explode(';', $type);
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_TYPEPRODUCTION);
      $stmt->bindParam(":pClef", $typeprod[0], PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $typeprod[1], PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }

    foreach ($dtoProduits->specificite as $spec)
    {
      $speci = explode(';', $spec);
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_SPECIFICITE_PRODUITS);
      $stmt->bindParam(":pClef", $speci[0], PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $speci[1], PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }
    if (strlen($dtoProduits->specificiteAutre) > 0) 
    {
      $nullClef = "0002";
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_SPECIFICITE_PRODUITS);
      $stmt->bindParam(":pClef", $nullClef, PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $dtoProduits->specificiteAutre, PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }

    foreach ($dtoConsomation->consoachats as $achat) 
    {
      $cachat = explode(';', $achat);
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_MODE_CONSO);
      $stmt->bindParam(":pClef", $cachat[0], PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $cachat[1], PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }
    if (strlen($dtoConsomation->consoachatsAutre) > 0) 
    {
      $nullClef = "c001";
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_MODE_CONSO);
      $stmt->bindParam(":pClef", $nullClef, PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $dtoConsomation->consoachatsAutre, PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }
    
    foreach ($dtoConsomation->paiments as $paiment) 
    {
      $cpaie = explode(';', $paiment);
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_MODE_CONSO);
      $stmt->bindParam(":pClef", $cpaie[0], PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $cpaie[1], PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }
    if (strlen($dtoConsomation->paimentAutre) > 0) 
    {
      $nullClef = "c003";
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_MODE_CONSO);
      $stmt->bindParam(":pClef", $nullClef, PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $dtoConsomation->paimentAutre, PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }

    foreach ($dtoConsomation->receptions as $recep)
    {
      $crecep = explode(';', $recep);
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_MODE_CONSO);
      $stmt->bindParam(":pClef", $crecep[0], PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $crecep[1], PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }
    if (strlen($dtoConsomation->receptionAutre) > 0) 
    {
      $nullClef = "c002";
      $stmt = $this->getCnxdb()->prepare($qLib::INSERT_CETCAL_MODE_CONSO);
      $stmt->bindParam(":pClef", $nullClef, PDO::PARAM_STR);
      $stmt->bindParam(":pVal", $dtoConsomation->receptionAutre, PDO::PARAM_STR);
      $stmt->bindParam(":pPkProducteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
    }

    return array("pk" => $pk, "ev" => $dtoGenerale->email, "idcetwww" => $cetcal_web_id);
  }

  public function fetchPKByEmailORIDwwwCETAndPWD($login, $mdp)
  {
    $pwd_hash = hash('sha256', $mdp);
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_PK_CETCAL_PRODUCTEUR_BY_EMAIL_AND_PWD_HASH);
    $stmt->bindParam(":pEmail", $login, PDO::PARAM_STR);
    $stmt->bindParam(":pIdwwwcet", $login, PDO::PARAM_STR);
    $stmt->bindParam(":pMdpHash", $pwd_hash, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetch();

    return $data['pk_producteur'];
  }

  public function exists($pProducteurDto) 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    $dtoGenerale = new QstProdGeneraleDTO();
    $dtoGenerale = unserialize($pProducteurDto);

    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_SIRET_PRODUCTEUR_PAR_SIRET);
    $stmt->execute(['pSiret' => $dtoGenerale->siret]);
    $data = $stmt->fetchAll();

    foreach ($data as $row) 
    {
      if (isset($row['siret']) && strcmp($row['siret'], $dtoGenerale->siret) === 0) return true;
    }
    return false;
  }

  public function emailExists($email)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_EMAIL_PRODUCTEUR);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row)
    {
      if (isset($row['email']) && strcmp($row['email'], $email) === 0) return 1;
    }
    return 0;
  }

  private function identifiantExists($pIdCet)
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_ID_CET_PRODUCTEUR);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row) 
    {
      if (isset($row['identifiant_cet']) && strcmp($row['identifiant_cet'], $pIdCet) === 0) return true;
    }
    return false;
  }

  public function fetchAllDataToDTOArray()
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    $dataCarto = array();
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CET_PRODUCTEUR);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row) 
    {
      $dtoGenerale = new QstProdGeneraleDTO();
      $dtoGenerale->initFrontEndDTO($row['nom'], $row['prenom'], $row['email'], 
        $row['telfixe'], $row['telport'], $row['nom_ferme'], 
        $row['adrferme_numvoie'], $row['adrferme_rue'], $row['adrferme_lieudit'], 
        $row['adrferme_commune'], $row['adrferme_cp'], $row['adrferme_compladr'], 
        $row['pageurl_fb'], $row['pageurl_ig'], $row['pageurl_twitter'], 
        $row['url_web'], $row['url_boutique'], $row['groupe_cagette']);
      $dtoGenerale->setPk($row['pk_producteur']);
      array_push($dataCarto, $dtoGenerale);
    }

    return $dataCarto;
  }

  public function fetchProducteurInscritByEmailOrIdWWWCET($login)
  {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_PRODUCTEUR_INSCRIT_BY_EMAIL_OR_IDWWWCET);
      $stmt->bindParam(":pEmail", $login, PDO::PARAM_STR);
      $stmt->bindParam(":pIdwwwcet", $login, PDO::PARAM_STR);
      $stmt->execute();
      $data = $stmt->fetchAll();

      return $data;
  }

  public function findProducteurByPk($pk)
  {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CETCAL_PRODUCTEUR_BY_PK);
      $stmt->bindParam(":pPk_producteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
      $data = $stmt->fetch();

      return $data;
  }

  public function findLieuByProducteurByPk($pk)
  {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_PRODUCTEUR_LIEU_JOIN);
      $stmt->bindParam(":pPk_producteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_OBJ);

      return $data;
  }

  public function findProduitByPkProducteur($pk)
  {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_PRODUIT_BY_PK_PRODUCTEUR);
      $stmt->bindParam(":pPk_producteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_OBJ);

      return $data;
  }

  public function findCategoriesProduitsByPkProducteur($pk)
  {
      $qLib = $this->getQuerylib();
      $stmt = $this->getCnxdb()->prepare($qLib::SELECT_CATEGORIES_PRODUITS_BY_PK_PRODUCTEUR);
      $stmt->bindParam(":pPk_producteur", $pk, PDO::PARAM_INT);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_OBJ);

      return $data;
  }
  
  /**
   * Select all des producteurs inscrits via questionnaire producteur CETCAL.
   */
  public function fetchAllFrontEndDTOArray()
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.cartographie.model.php');
    $modelCarto = new CETCALCartographieModel();
    $dataDto = array();
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CET_PRODUCTEUR);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row)
    {
      $dtoGenerale = new QstProdGeneraleDTO();
      $dtoGenerale->initFrontEndDTO($row['nom'], $row['prenom'], $row['email'],
        $row['telfixe'], $row['telport'], $row['nom_ferme'],
        $row['adrferme_numvoie'], $row['adrferme_rue'], $row['adrferme_lieudit'],
        $row['adrferme_commune'], $row['adrferme_cp'], $row['adrferme_compladr'],
        $row['pageurl_fb'], $row['pageurl_ig'], $row['pageurl_twitter'],
        $row['url_web'], $row['url_boutique'], $row['groupe_cagette'], $row['identifiant_cet'],
        $row['adrferme_ltrl'], $row['prod_inscrit'], $row['desc_produits_ltrl'],
        $row['marches_ltrl'], $row['lieux_distribution_ltrl'], $row['infos_ltrl'], 
        $row['urls_mltpl'], $row['fournisseur_cet']);
      $dtoGenerale->setPk($row['pk_producteur']);
      $dtoGenerale->setTypeDeProduction($this->getTypesProduction($row['pk_producteur']));
      $latLng = $modelCarto->getLatLng($row['pk_producteur']);
      if (is_array($latLng)) $dtoGenerale->setLatLng($latLng['cetcal_prd_lat'], $latLng['cetcal_prd_lng']);
      array_push($dataDto, $dtoGenerale);
    }

    return $dataDto;
  }

  /**
   * Select all des producteurs pré-inscrits via traitement batch sur fichier CSV de Céline.
   */
  public function fetchAllFrontEndDTOArrayPreInscrits()
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.cartographie.model.php');
    $modelCarto = new CETCALCartographieModel();
    $dataDto = array();
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CET_PRODUCTEUR_N0N_INSCRIT);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row)
    {
      $dtoGenerale = new QstProdGeneraleDTO();
      $dtoGenerale->initFrontEndDTO($row['nom'], $row['prenom'], $row['email'],
        $row['telfixe'], $row['telport'], $row['nom_ferme'],
        $row['adrferme_numvoie'], $row['adrferme_rue'], $row['adrferme_lieudit'],
        $row['adrferme_commune'], $row['adrferme_cp'], $row['adrferme_compladr'],
        $row['pageurl_fb'], $row['pageurl_ig'], $row['pageurl_twitter'],
        $row['url_web'], $row['url_boutique'], $row['groupe_cagette'], $row['identifiant_cet'],
        $row['adrferme_ltrl'], $row['prod_inscrit'], $row['desc_produits_ltrl'],
        $row['marches_ltrl'], $row['lieux_distribution_ltrl'], $row['infos_ltrl'], 
        $row['urls_mltpl'], $row['fournisseur_cet']);
      $dtoGenerale->setPk($row['pk_producteur']);
      $dtoGenerale->setTypeDeProduction($this->getTypesProduction($row['pk_producteur']));
      $latLng = $modelCarto->getLatLng($row['pk_producteur']);
      if (is_array($latLng)) $dtoGenerale->setLatLng($latLng['cetcal_prd_lat'], $latLng['cetcal_prd_lng']);
      array_push($dataDto, $dtoGenerale);
    }

    return $dataDto;
  }

  public function fetchAllListing() 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.cartographie.model.php');
    $modelCarto = new CETCALCartographieModel();
    $dataDto = array();
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CET_PRODUCTEUR_INSCRIT_N0N_INSCRIT_ASC);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row)
    {
      $dtoGenerale = new QstProdGeneraleDTO();
      $dtoGenerale->initFrontEndDTO($row['nom'], $row['prenom'], $row['email'],
        $row['telfixe'], $row['telport'], $row['nom_ferme'],
        $row['adrferme_numvoie'], $row['adrferme_rue'], $row['adrferme_lieudit'],
        $row['adrferme_commune'], $row['adrferme_cp'], $row['adrferme_compladr'],
        $row['pageurl_fb'], $row['pageurl_ig'], $row['pageurl_twitter'],
        $row['url_web'], $row['url_boutique'], $row['groupe_cagette'], $row['identifiant_cet'],
        $row['adrferme_ltrl'], $row['prod_inscrit'], $row['desc_produits_ltrl'],
        $row['marches_ltrl'], $row['lieux_distribution_ltrl'], $row['infos_ltrl'], 
        $row['urls_mltpl'], $row['fournisseur_cet']);
      $dtoGenerale->setPk($row['pk_producteur']);
      $dtoGenerale->setTypeDeProduction($this->getTypesProduction($row['pk_producteur']));
      $latLng = $modelCarto->getLatLng($row['pk_producteur']);
      if (is_array($latLng)) $dtoGenerale->setLatLng($latLng['cetcal_prd_lat'], $latLng['cetcal_prd_lng']);
      array_push($dataDto, $dtoGenerale);
    }

    return $dataDto;   
  }

  /**
   * Select des N derniers producteur inscrits (order by desc LIMIT = $limit).
   */
  public function fetchProducteursDerniersInscrit($limit)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.cartographie.model.php');
    $modelCarto = new CETCALCartographieModel();
    $dataDto = array();
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CET_PRODUCTEUR_INSCRITS_LIMIT_N);
    $stmt->bindParam(":pLimit", $limit, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row)
    {
      $dtoGenerale = new QstProdGeneraleDTO();
      $dtoGenerale->initFrontEndDTO($row['nom'], $row['prenom'], $row['email'],
        $row['telfixe'], $row['telport'], $row['nom_ferme'],
        $row['adrferme_numvoie'], $row['adrferme_rue'], $row['adrferme_lieudit'],
        $row['adrferme_commune'], $row['adrferme_cp'], $row['adrferme_compladr'],
        $row['pageurl_fb'], $row['pageurl_ig'], $row['pageurl_twitter'],
        $row['url_web'], $row['url_boutique'], $row['groupe_cagette'], $row['identifiant_cet'],
        $row['adrferme_ltrl'], $row['prod_inscrit'], $row['desc_produits_ltrl'],
        $row['marches_ltrl'], $row['lieux_distribution_ltrl'], $row['infos_ltrl'], 
        $row['urls_mltpl'], $row['fournisseur_cet']);
      $dtoGenerale->setPk($row['pk_producteur']);
      $dtoGenerale->setTypeDeProduction($this->getTypesProduction($row['pk_producteur']));
      $latLng = $modelCarto->getLatLng($row['pk_producteur']);
      if (is_array($latLng)) $dtoGenerale->setLatLng($latLng['cetcal_prd_lat'], $latLng['cetcal_prd_lng']);
      array_push($dataDto, $dtoGenerale);
    }

    return $dataDto;
  }

  private function getTypesProduction($pk) {
    $types = '';
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_CET_TYPE_PRODUCTION);
    $stmt->bindParam(":pPk", $pk, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row)
    {
      $types.= $row['val_type_production'].'µ';
    }

    return $types;
  }

  public function setTempSessionId($sessionId, $ip, $pk)
  {    
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::UPDATE_PRODUCTEUR_SESSION);
    $stmt->bindParam(":pSessionId", $sessionId, PDO::PARAM_STR);
    $stmt->bindParam(":pProducteurIp", $ip, PDO::PARAM_STR);
    $stmt->bindParam(":pPk", $pk, PDO::PARAM_INT);

    $stmt->execute();
  }

  public function updateMdpByEmail($email, $mdp_tmp)
  {
    $pwd_hash = hash('sha256', $mdp_tmp);
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::UPDATE_PRODUCTEUR_MOT_DE_PASSE);
    $stmt->bindParam(":pEmail", $email, PDO::PARAM_STR);
    $stmt->bindParam(":pMdpsha", $pwd_hash, PDO::PARAM_STR);

    $stmt->execute();
  }

}