<?php
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
$PATH_MODEL = $DOC_ROOT.'/src/app/model/';
require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();
require_once($PATH_MODEL.'cet.qstprod.producteurs.model.php');
$model = new QSTPRODProducteurModel();
$pks = array();

if (!isset($_GET['prds']) || empty($_GET['prds'])) 
{
  echo json_encode(['err' => 'Aucun producteur.e trouvé.']);
  return;
}
else
{
  $produits = $dataProcessor->processHttpFormData($_GET['prds']);
  error_log("[lookup producteurs par produits] produits=".$produits);
  $prds = explode(';', $produits);
  foreach ($prds as $produit) $pks = array_merge($pks, 
    $model->pksProducteursParNomProduit($produit, false));
}

$producteur = $model->findProducteursINPkArray(array_unique($pks));
if (count($producteur) > 0) echo json_encode($producteur);
else echo json_encode(['err' => 'Aucun producteur.e trouvé.']);
return;