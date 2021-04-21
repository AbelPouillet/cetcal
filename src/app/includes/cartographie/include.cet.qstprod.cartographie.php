<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.qstprod.controller.cartographie.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.producteurs.model.php');
$controller = new CETCALCartographieController();
$data = $controller->fetchDataCartographie();
?>

<div id="cet-annuaire-crt-main-anchor"></div>
<div id="cet-annuaire-crt-main-container" class="cet-module row justify-content-lg-center" 
  style="margin-bottom: 20px;">
  <div id="cet-annuaire-crt-bootstrap-wrapper" class="col-lg-6"> 
    <div id="cet-annuaire-crt-main"></div>
  </div>
  <div id="cet-annuaire-crt-mini-fiche-producteur-container" class="col-lg-3" 
    style="display: none;">
    <div id="cet-annuaire-crt-mini-fiche-producteur"></div>
  </div>
</div>
<div id="cetcal.producteur.xml" hidden="hidden">
  <producteurs hidden="hidden">
    <?php foreach ($data as $prdDto): ?>
      <producteur>
        <pk><?= $prdDto->getPk(); ?></pk>
        <nom><?= $prdDto->nom; ?></nom>
        <prenom><?= $prdDto->prenom; ?></prenom>
        <email><?= $prdDto->email; ?></email>
        <?php
          $adr = str_replace("  ", " ", $prdDto->adrNumvoie.' '.$prdDto->adrRue.' '.$prdDto->adrLieudit.' '.$prdDto->adrCommune.' '.$prdDto->adrCodePostal.' '.$prdDto->adrComplementAdr);
          $adrcrt = str_replace(" ", "%20", $adr);
        ?>
        <addresscrt><?= $adrcrt; ?></addresscrt>
        <address><?= $adr; ?></address>
        <nomferme><?= $prdDto->nomferme; ?></nomferme>
        <urlfb><?= $prdDto->pageFB; ?></urlfb>
        <urlig><?= $prdDto->pageIG; ?></urlig>
        <grpcagette><?= $prdDto->groupeCagette; ?></grpcagette>
        <urltwitter><?= $prdDto->pageTwitter; ?></urltwitter>
        <urlwww><?= $prdDto->siteWebUrl; ?></urlwww>
        <urlboutique><?= $prdDto->boutiqueEnLigneUrl; ?></urlboutique>
        <telfixe><?= $prdDto->telfix; ?></telfixe>
        <telport><?= $prdDto->telport; ?></telport>
        <latlng><?= $prdDto->getLatLng(); ?></latlng>
      </producteur>
    <?php endforeach; ?>
  </producteurs>
</div>
<script src="/src/scripts/js/cetcal/cetcal.cartographie.min.js"></script>