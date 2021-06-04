<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.controller.fichedetaillee.producteur.php');
$controller = new CETCALAnnuaireFicheDetailleController();
$produits = $controller->fetchProduitByPkProducteur($pk);
$productsCategories = $controller->fetchCategorieProduitByPkProducteur($pk);
?>
<div class="container">
  <div class="row d-flex justify-content-center">
    <div class="col-xs-12 col-xl-8 col-md-12">
      <div class="cet-formgroup-container">
          <div class="row d-flex flex-column">
              <div class="mt-2">
                  <div class="ml-2">Types de production</div>
                  <?php foreach ( $productsCategories as $productCategorie) : ?>
                  <p class="cst-produits"><?= $productCategorie->categorie ?></p>
                  <?php endforeach; ?>
              </div>
              <div class="mt-2">
                  <div class="ml-2">Produits</div>
                  <?php foreach ( $produits as $produit) : ?>
                  <p class="cst-produits"><?=  $produit->nom ?></p>
                  <?php endforeach; ?>
              </div>
        </div>
    </div>
  </div>
</div>