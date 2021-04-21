<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.qstprod.controller.cartographie.php');
$controller = new CETCALCartographieController();
$data = $controller->fetchDataCartographie($SELECT_PRD_NON_INSCRITS);
$entites_data = $controller->fetchDataCartographieEntite();

require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/admin/cet.qstprod.admin.cartographie.loader.php');
$loader = new CETCALCartographieLoader();
$loader->loadCommunes();
?>

<div id="cet-annuaire-crt-main-anchor"></div>
<?php include $PHP_INCLUDES_PATH.'areas/include.cet.annuaire.gestion.carte.php'; ?>
<div class="cet-module row justify-content-lg-center">
  <div id="cet-annuaire-crt-controls-container" class="col-lg-9">
    <p class="cet-p-dark" style="margin-bottom: 0px; margin-left: 4px;">
      Producteur.e.s BIO et marchés (à 40km et + autour de Castillon)<br><small><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;Si votre commune ne vous est pas proposée dans la recherche, veuillez rechercher une commune à proximité.</small>
      <?php if ($CLIENT_CARTO_AVANCEE) include $PHP_INCLUDES_PATH.'cartographie/include.cet.annuaire.params.cartographie.php'; ?>
    </p>
    <div class="input-group mb-3" style="margin-bottom: 6px !important;">
      <div class="input-group-prepend">
        <p class="input-group-text cet-p-dark" id="crt-search-libelle"></p>
      </div>
      <div id="cet-annuaire-recherche-communes-conatiner">
        <input type="text" class="form-control typeahead" placeholder="" aria-label="" 
          id="cet-annuaire-recherche-communes-value" name="cet-annuaire-recherche-communes-value"
          style="border-radius: 0px !important;">
      </div>
      <div class="input-group-append">
        <button class="btn btn-outline-success" id="valider-recherche-commune-cartographie" 
          type="button">Valider
        </button>
      </div>
    </div>
  </div>
</div>
<div id="cet-annuaire-crt-main-container" class="cet-module row justify-content-lg-center" 
  style="margin-bottom: 20px;">
  <div id="cet-annuaire-crt-bootstrap-wrapper" class="col-lg-9">
    <div id="cet-annuaire-crt-main"></div>
  </div>
  <div id="cet-annuaire-crt-mini-fiche-producteur-container" class="col-lg-3" style="display: none;">
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
          $adr = $prdDto->prodInscrit === 'false' ? $prdDto->adrfermeLtrl : 
            str_replace("  ", " ", $prdDto->adrNumvoie.' '.$prdDto->adrRue.' '.$prdDto->adrLieudit.' '.
            $prdDto->adrCommune.' '.$prdDto->adrCodePostal.' '.$prdDto->adrComplementAdr);
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
        <prodinscrit><?= $prdDto->prodInscrit; ?></prodinscrit>
        <produitsltrl><?= str_replace([","], ', ', $prdDto->produitsLtrl); ?></produitsltrl>
        <marchesltrl><?= $prdDto->marchesLtrl; ?></marchesltrl>
        <lieuxltrl><?= str_replace([","], ', ', $prdDto->lieuxLtrl); ?></lieuxltrl>
        <infosltrl><?= $prdDto->infosLtrl; ?></infosltrl>
        <fournisseurcet><?= $prdDto->fournisseurcet; ?></fournisseurcet>
      </producteur>
    <?php endforeach; ?>
  </producteurs>
</div>

<div id="cetcal.entite.xml" hidden="hidden">
  <entites hidden="hidden">
    <?php foreach ($entites_data as $entiteDto): ?>
      <?php if(strcmp($entiteDto->type, "marche") !== 0) continue; ?>
      <entite>
        <pk><?= $entiteDto->getPk(); ?></pk>
        <type><?= $entiteDto->type; ?></type>
        <denomination><?= $entiteDto->denomination; ?></denomination>
        <email><?= $entiteDto->email; ?></email>
        <adresse><?= $entiteDto->adresse; ?></adresse>
        <latlng><?= $entiteDto->getLatLng(); ?></latlng>
      </entite>
    <?php endforeach; ?>
  </entites>
</div>
<script src="/src/scripts/js/leaflet-markercluster/leaflet.markercluster.js"></script>
<script src="/src/scripts/js/leaflet-markercluster/leaflet.markercluster-src.js"></script>
<script src="/src/scripts/js/typeahead.0.11.1.min.js"></script>
<script src="/src/scripts/js/cetcal/cetcal.cartographie.min.js"></script>