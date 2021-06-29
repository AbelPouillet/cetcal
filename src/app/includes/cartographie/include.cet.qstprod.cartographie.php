<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.qstprod.controller.cartographie.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/media/cet.qstprod.controller.media.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.qstprod.controller.certification.bioab.php');
$controller = new CETCALCartographieController();
$media_controller = new MediaController();
$certif_controller = new CertificationBioABProducteurController();
$data = $controller->fetchDataCartographie($SELECT_PRD_NON_INSCRITS);
$entites_data = $controller->fetchDataCartographieEntite();
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/admin/cet.qstprod.admin.cartographie.loader.php');
$loader = new CETCALCartographieLoader();
$loader->loadCommunes();
?>

<div class="container-fluid">
    <div class="row">
        <?php if ($CLIENT_CARTO_AVANCEE) include $PHP_INCLUDES_PATH.'cartographie/include.cet.annuaire.params.cartographie.php'; ?>
    </div>
    <div id="cet-annuaire-crt-main-container" class="row cet-module ">
        <div id="cet-annuaire-crt-bootstrap-wrapper" class="col-lg-12" style="width: 100% !important; margin-left: 0px !important; margin-right: 0px !important; padding-right: 0px !important; padding-left: 0px !important;">
            <div id="cet-annuaire-crt-main"></div>
        </div>
        <!--SEARCH BAR DEBUT-->
        <div class="row searchbar-wrapper">
            <div class="col-12">
                <div class="d-flex">
                    <div class="input-wrapper">
                        <input class="search-input"type="text">
                    </div>
                    <div class="btn-wrapper d-flex">
                        <button class="btn-search text-center">Rechercher</button>
                        <button class="btn-filter">Filtrer</button>
                    </div>
                </div>
            </div>
        </div>

        <!--SEARCH BAR FIN-->
    </div>

</div>


<div id="cetcal.producteur.xml" hidden="hidden">
    <producteurs hidden="hidden">
        <?php foreach ($data as $prdDto): ?>
            <producteur>
                <pk><?= $prdDto->getPk(); ?></pk>
                <categorie><?= $prdDto->categorie; ?></categorie>
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
                <logoferme><?= $media_controller->selectSrcLogoFemreProducteur($prdDto->getPk()); ?></logoferme>
                <?php $certif_bioab = $certif_controller->getCertificationProducteur($prdDto->getPk()); ?>
                <certifbioab><?= $certif_bioab === false ? 'false' : 'true'; ?></certifbioab>
                <certifbioaburl>
                    <?= $certif_bioab === false ? 'false' : $certif_bioab['url_org_certif']; ?>
                </certifbioaburl>
            </producteur>
        <?php endforeach; ?>
    </producteurs>
</div>

<div id="cetcal.entite.xml" hidden="hidden">
    <entites hidden="hidden">
        <?php foreach ($entites_data as $entiteDto): ?>
            <entite>
                <pk><?= $entiteDto->getPk(); ?></pk>
                <type><?= $entiteDto->type; ?></type>
                <denomination><?= $entiteDto->denomination; ?></denomination>
                <email><?= $entiteDto->email; ?></email>
                <adresse><?= $entiteDto->adresse; ?></adresse>
                <latlng><?= $entiteDto->getLatLng(); ?></latlng>
                <logoentite><?= $media_controller->selectSrcLogoEntite($entiteDto->getPk()); ?></logoentite>
            </entite>
        <?php endforeach; ?>
    </entites>
</div>
<?php include $PHP_INCLUDES_PATH.'modals/include.cet.annuaire.modal.gestion.cartographie.php'; ?>
<script src="/src/scripts/js/leaflet-markercluster/leaflet.markercluster.js"></script>
<script src="/src/scripts/js/leaflet-markercluster/leaflet.markercluster-src.js"></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet'/>
<script src="/src/scripts/js/typeahead.0.11.1.min.js"></script>
<script src="/src/scripts/js/cetcal/cetcal.cartographie.min.js"></script>