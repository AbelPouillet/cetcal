<?php
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
require_once($DOC_ROOT.'/src/app/model/cet.qstprod.producteurs.model.php');
require_once($DOC_ROOT.'/src/app/model/cet.annuaire.produits.model.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.qstprod.controller.certification.bioab.php');
$certif_controller = new CertificationBioABProducteurController();
$model_prd = new QSTPRODProducteurModel();
$model_produits = new AnnuaireProduitsModel();
$dataProcessor = new HTTPDataProcessor();

$json = json_decode($_GET['json']);
$commune_cp = $json->commune;
$rayon = $json->rayon;
$categories = $json->categories;
$critere = $json->criteresplus;
$produits = $json->produits;
$certification = $json->certification;
$inclureentites = $json->inclureentites;

$result = [];
$result_inscrits = $model_prd->fetchAllFrontEndDTOArray();
$result_preinscrits = $model_prd->fetchAllFrontEndDTOArrayPreInscrits();
$producteurs = array_merge($result_preinscrits, $result_inscrits);

/** ************************************************************************
 * Filtre commune. Code postal.
 */
if (strlen($commune_cp) > 0)
{
  $cp = substr($commune_cp, -5);
  $commune = substr($commune_cp, 0, -6);
  error_log("{commune:".$commune."}");
  for ($i = 0; $i < count($producteurs); ++$i)
  {
    /**
     * Anciennement utiliser pour strpos et cmp le code postal. 
     * Si présence du Code postal alors ajout dans ce code commenté.
     * Le problème étant que de multiples communes possèdent le même code postal.
     * 
     * if (strcmp($producteurs[$i]->adrCodePostal, $cp) === 0 || 
        stripos($producteurs[$i]->adrCommune, $commune) != false ||
        stripos($producteurs[$i]->adrfermeLtrl, $cp) != false ||
        stripos($producteurs[$i]->adrfermeLtrl, $commune) != false) 
    {*/
    if (stripos(str_replace("-", " ", $producteurs[$i]->adrCommune), $commune) != false ||
        strcmp(str_replace("-", " ", $producteurs[$i]->adrCommune), $commune) === 0 ||
        stripos(str_replace("-", " ", $producteurs[$i]->adrfermeLtrl), $commune) != false ||
        strcmp(str_replace("-", " ", $producteurs[$i]->adrfermeLtrl), $commune) === 0) 
    {
      array_push($result, $producteurs[$i]);
    }
  }
  $producteurs = $result;
}

/** ************************************************************************
 * Filtre sur produits.
 */
if (count($produits) > 0)
{
  $result = [];
  for ($i = 0; $i < count($producteurs); ++$i) 
  {
    if ($model_produits->countProduits($produits, $producteurs[$i]->getPk()) > 0) 
    {
      array_push($result, $producteurs[$i]); 
    }
    else 
    {
      foreach($produits as $p) 
      {
        if (strrpos(strtolower($producteurs[$i]->produitsLtrl), strtolower($p)) !== false)
        {
          array_push($result, $producteurs[$i]); 
          break;
        }
      }
    }
  }

  $producteurs = $result;
}

/** ************************************************************************
 * Filtre sur BIO / y tendant.
 */
if (strlen($certification) > 0 && $certification !== "0")
{
  $result = [];
  for ($i = 0; $i < count($producteurs); ++$i) 
  {
    $certif_bioab = $certif_controller->getCertificationProducteur($producteurs[$i]->getPk());
    if (strcmp($certification, "BIOAB") === 0 && isset($certif_bioab) && $certif_bioab !== false && 
      strlen($certif_bioab['url_org_certif']) > 7) array_push($result, $producteurs[$i]);
    else if (strcmp($certification, "YTENDANT") === 0 && $certif_bioab === false) 
      array_push($result, $producteurs[$i]);
  }

  $producteurs = $result;
}

/** ************************************************************************
 * Filtre catégorie de producteur.
 */
if (count($categories) > 0)
{
  $result = [];
  for ($i = 0; $i < count($producteurs); ++$i) 
  { 
    $cat = $producteurs[$i]->typeDeProduction;
    if (strlen($cat) <= 0) continue;
    foreach ($categories as $selected_cat)
    {
      if (strrpos(strtolower($cat), strtolower(explode(";", $selected_cat)[1])) !== false)
      {
        array_push($result, $producteurs[$i]);
        break;
      }
    }
  }

  $producteurs = $result;
}

/** ************************************************************************
 * Filtre critère de producteur.
 */
if (strlen($critere) > 4)
{
  $result = [];
  for ($i = 0; $i < count($producteurs); ++$i) 
  {
    $string_data = json_encode($producteurs[$i]);
    $produits_string_data = json_encode($model_prd->findProduitByPkProducteur($producteurs[$i]->getPk()));
    if (strrpos(strtolower($string_data), strtolower($critere)) !== false) 
      array_push($result, $producteurs[$i]);
    else if (isset($produits_string_data) && 
      strrpos(strtolower($produits_string_data), strtolower($critere)) !== false) 
      array_push($result, $producteurs[$i]);
  }

  $producteurs = $result;
}

echo json_encode($result);