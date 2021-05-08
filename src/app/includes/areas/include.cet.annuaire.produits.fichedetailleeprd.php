<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.controller.fichedetaillee.producteur.php');
$controller = new CETCALAnnuaireFicheDetailleController();
//$lieux = $controller->fetchLieuByPkProducteur($pk);
$produits = $controller->fetchProduitByPkProducteur($pk);
$productsCategories = $controller->fetchCategorieProduitByPkProducteur($pk);
//var_dump($productsCategories);
?>

<div class="container">
  <div class="row d-flex justify-content-center">
    <div class="col-xs-12 col-xl-8 col-md-12">
      <div class="cet-formgroup-container">
          <div>
              <?php foreach ( $productsCategories as $productCategorie) : ?>
              <?= "<p class='cst-catProduits'>" . $productCategorie->categorie . "</p>" ?>
              <?php endforeach; ?>
          </div>
      </div>
    </div>
  </div>
</div>