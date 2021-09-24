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
$producteurs = $model_prd->fetchAllListing();

/** ************************************************************************
 * Filtre commune. Code postal.
 */
if (strlen($commune_cp) > 0)
{
  $cp = substr($commune_cp, -5);
  for ($i = 0; $i < count($producteurs); ++$i)
  {
    if (strcmp($producteurs[$i]->adrCodePostal, $cp) === 0 || 
      strrpos($producteurs[$i]->adrfermeLtrl, $cp)) array_push($result, $producteurs[$i]);
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

echo json_encode($result);