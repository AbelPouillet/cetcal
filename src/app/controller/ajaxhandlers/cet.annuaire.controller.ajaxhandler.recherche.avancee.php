<?php
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
require_once($DOC_ROOT.'/src/app/model/cet.qstprod.producteurs.model.php');
require_once($DOC_ROOT.'/src/app/model/cet.annuaire.produits.model.php');
require_once($DOC_ROOT.'/src/app/utils/cet.annuaire.geocoordinate.helper.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.qstprod.controller.certification.bioab.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.communes.model.php');

$certif_controller = new CertificationBioABProducteurController();
$model_prd = new QSTPRODProducteurModel();
$model_produits = new AnnuaireProduitsModel();
$model_communes = new CETCALCommunesModel();
$dataProcessor = new HTTPDataProcessor();
$geo_helper = new GeoCoordinateHelper();

$json = json_decode($_GET['json']);
$recherche_avancee = $json->rav;
$commune_cp = $json->commune;
$rayon = $json->rayon;
$types = $json->types;
$categories = $json->categories;
$critere = $json->criteresplus;
$produits = $json->produits;
$certification = $json->certification;
$inclureentites = $json->inclureentites;

$result = [];
$result_inscrits = $model_prd->fetchAllFrontEndDTOArray();
$result_preinscrits = $model_prd->fetchAllFrontEndDTOArrayPreInscrits();
$producteurs = array_merge($result_preinscrits, $result_inscrits);

error_log("[[[ RECHERCHE AVANCEE - criteres recus  controller :]]]");
error_log("[commune, rayon] ".$commune_cp. ", ".$rayon);
error_log("[critere(s)] ".$critere);
error_log("[produits(s)] ".implode(' / ', $produits));
error_log("[[[ RECHERCHE AVANCEE - debut filtrage :]]]");

/** ************************************************************************
 * Filtre commune et rayon.
 */
if (strlen($commune_cp) > 2 && isset($rayon) && $rayon > 0)
{
  error_log("[[ RECHERCHE AVANCEE - commune_cp + rayon]]");
  $latlng = explode(";", $model_communes->selectLatLngByLibelle($commune_cp));
  error_log($latlng[0]."/".$latlng[1]);
  
  for ($i = 0; $i < count($producteurs); ++$i) 
  {
    $distance_km = $geo_helper->haversineGreatCircleDistance(
      $latlng[1], $latlng[0], $producteurs[$i]->getLat(), $producteurs[$i]->getLng()) / 1000;
    error_log("distance km:".($distance_km));
    if ($distance_km <= $rayon) array_push($result, $producteurs[$i]);
  }

  $producteurs = $result;
}

/** ************************************************************************
 * Filtre sur produits.
 */
if (count($produits) > 0)
{
  error_log("[[ RECHERCHE AVANCEE - produits]]");
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
if (strlen($certification) > 0 && $certification != "0")
{
  error_log("[[ RECHERCHE AVANCEE - BIOAB]]");
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
  error_log("[[ RECHERCHE AVANCEE - categories]]");
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
  error_log("[[ RECHERCHE AVANCEE - critere]]");
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