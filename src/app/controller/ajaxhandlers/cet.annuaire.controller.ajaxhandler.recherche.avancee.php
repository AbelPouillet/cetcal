<?php
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
require_once($DOC_ROOT.'/src/app/model/cet.qstprod.producteurs.model.php');
$model_prd = new QSTPRODProducteurModel();
$dataProcessor = new HTTPDataProcessor();

$json = json_decode($_GET['json']);
$commune_cp = $json->commune;
$rayon = $json->rayon;
$categories = $json->categories;
$critere = $json->criteresplus;
$produits = $json->produits;
$certification = $json->certification;
$inclureentites = $json->inclureentites;

// TEMP call to see if all is linked up.
$producteurs = $model_prd->fetchAllListing();
echo json_encode($producteurs);