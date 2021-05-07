<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.controller.fichedetaillee.producteur.php');
$controller = new CETCALAnnuaireFicheDetailleController();
//$lieux = $controller->fetchLieuByPkProducteur($pk);
$produits = $controller->fetchProduitByPkProducteur($pk);
$productsCategories = $controller->fetchCategorieProduitByPkProducteur($pk);
?>
<p>TODO</p>