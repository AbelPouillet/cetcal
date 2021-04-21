<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupprods.dto.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signuplieuxdist.dto.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupconso.dto.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupbesoins.dto.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.sessionshelper.php');
$sessionshelper = new SessionHelper($_SERVER['DOCUMENT_ROOT']);
$infogenerales = $sessionshelper->getDto('signupgen.form', new QstProdGeneraleDTO()); 
$produits = $sessionshelper->getDto('signupprods.form', new QstProduitDTO());
$lieuxdist = $sessionshelper->getDto('signuplieuxdist.form', new QstLieuxDistributionDTO());
$conso = $sessionshelper->getDto('signupconso.form', new QstConsomateursDTO());
$besoins = $sessionshelper->getDto('signupbesoins.form', new QstBesoinsDTO());
?>

<!-- singup récapitulatif html form -->
<!-- -------------------------------------- -->
<!-- ZONE de récap informations générales.   -->
<!-- -------------------------------------- -->
<div class="row justify-content-lg-center">
  <div class="col-lg-6">
    <label class="cet-formgroup-container-label">
      <small class="form-text">Récapitulatif de vos informations générales :</small>
    </label>
    <label>
      <small class="form-text text-muted" style="color: rgb(70, 80, 40) !important;"><?= CetQstprodConstLibelles::lib_general_entete_garantit; ?><br>
        <a href="#" class="cet-conditions-donnees-numerique"><?= CetQstprodConstLibelles::lib_general_entete_donnees; ?></a>
      </small>
    </label>
    <div class="cet-formgroup-container">
      <div class="d-flex justify-content-center">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td><span class="text-muted">Nom, prénom : </span><?= $infogenerales->nom; ?> <?= $infogenerales->prenom; ?></td>
            </tr>
            <tr>
              <td><span class="text-muted">Adresse email : </span><?= $infogenerales->email; ?></td>
            </tr>
            <tr>
              <td><span class="text-muted">Téléphone fix : </span><?= $infogenerales->telfix; ?></td>
            </tr>
            <tr>
              <td><span class="text-muted">Téléphone mobil : </span><?= $infogenerales->telport; ?></td>
            </tr>
            <tr>
              <td><span class="text-muted">Nom de la ferme : </span><?= $infogenerales->nomferme; ?></td>
            </tr>
            <tr>
              <td><span class="text-muted">Siret associé à la ferme : </span><?= $infogenerales->siret; ?></td>
            </tr>
            <?php if (isset($infogenerales->adrLieudit) || isset($infogenerales->adrComplementAdr)) $displayCmplAdr = true; ?>
            <tr>
              <td><span class="text-muted">Adresse postale de la ferme : </span><?= $infogenerales->adrNumvoie; ?> <?= $infogenerales->adrRue; ?><?php if ($displayCmplAdr) : ?><br><?= $infogenerales->adrLieudit; ?> <?= $infogenerales->adrComplementAdr; ?><?php endif; ?><br><?= $infogenerales->adrCommune; ?> <?= $infogenerales->adrCodePostal; ?>
              </td>
            </tr>
            <tr>
              <td><span class="text-muted">Page Facebook : </span><?= $infogenerales->pageFB; ?></td>
            </tr>
            <tr>
              <td><span class="text-muted">Page Instagram : </span><?= $infogenerales->pageIG; ?></td>
            </tr>
            <tr>
              <td><span class="text-muted">Page Twitter : </span><?= $infogenerales->pageTwitter; ?></td>
            </tr>
            <tr>
              <td><span class="text-muted">Adresse web de votre site dédié : </span><?= $infogenerales->siteWebUrl; ?></td>
            </tr>
            <tr>
              <td>
                <span class="text-muted">Adresse web, Boutique en ligne : </span><?= $infogenerales->boutiqueEnLigneUrl; ?>
              </td>
            </tr>
            <tr>
              <td>
                <span class="text-muted">Votre groupe Cagette : </span><?= $infogenerales->groupeCagette; ?>
              </td>
            </tr>
            <tr>
              <td>
                <span class="text-muted">Organisme Certificateur BIO : </span><?= $infogenerales->organismeCertificateurBIO; ?>
              </td>
            </tr>
            <tr>
              <td><span class="text-muted">Type de production : </span>
              <?php if (isset($infogenerales->typeDeProduction) && is_array($infogenerales->typeDeProduction) && count($infogenerales->typeDeProduction) > 0): ?>
              <?php $counter = 0; ?>
              <?php foreach ($infogenerales->typeDeProduction as $typeprod): ?>
              <?php echo explode(';', $typeprod)[1].($counter + 1 === count($infogenerales->typeDeProduction) ? '' : ', '); ?>
              <?php ++$counter; ?>
              <?php endforeach; ?>
              <?php endif; ?>
              </td>
            </tr>
            <tr>
              <td>
                <span class="text-muted">Surface de terres cultivées : </span><?= $infogenerales->surfaceHectTerres; ?> <i>Hectares</i>
              </td>
            </tr>
            <tr>
              <td>
                <span class="text-muted">Surface sous serre(s) : </span><?= $infogenerales->surfaceHectSousSerre; ?> <i>Ares</i>
              </td>
            </tr>
            <tr>
              <td>
                <span class="text-muted">Nombre de têtes (si bétail) : </span><?= $infogenerales->nbrTetesBetail; ?>
              </td>
            </tr>
            <tr>
              <td>
                <span class="text-muted">Hectolitres / an (si production boissons) : </span><?= $infogenerales->hectolitresParAn; ?> <i>Hectolitres</i>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- -------------------------------------- -->
<!-- ZONE de récap lieux de distribution.   -->
<!-- -------------------------------------- -->
<div class="row justify-content-lg-center">
  <div class="col-lg-6">
    <label class="cet-formgroup-container-label"><small class="form-text">Récapitulatif de vos points de vente / distribution :</small></label>
    <div class="cet-formgroup-container">
      <div class="d-flex justify-content-center">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td><span class="text-muted">Vos lieux de Distribution / Vente : </span>
                <?php if (isset($lieuxdist->pointsDeVente) && is_array($lieuxdist->pointsDeVente) && count($lieuxdist->pointsDeVente) > 0): ?>
                <?php $counter = 0; ?>
                <?php foreach ($lieuxdist->pointsDeVente as $lieuxVenteDist): ?>
                  <?php echo explode(';', $lieuxVenteDist)[1].($counter + 1 === count($lieuxdist->pointsDeVente) ? '' : ', '); ?>
                <?php ++$counter; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php if (isset($lieuxdist->pointsDeVenteAutre) && strlen($lieuxdist->pointsDeVenteAutre) > 0): ?>
                  <?php echo ', '.$lieuxdist->pointsDeVenteAutre; ?>
                <?php endif; ?>
                <?php if (isset($lieuxdist->joursMarchesSaisies) && is_array($lieuxdist->joursMarchesSaisies) && count($lieuxdist->joursMarchesSaisies) > 0): ?>
                <?php $counter = 0; ?>
                <?php foreach ($lieuxdist->joursMarchesSaisies as $lieuxVenteDist): ?>
                  <?php echo explode(';', $lieuxVenteDist)[1].($counter + 1 === count($lieuxdist->joursMarchesSaisies) ? '' : ', '); ?>
                <?php ++$counter; ?>
                <?php endforeach; ?>
                <?php endif; ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- -------------------------------------- -->
<!-- ZONE de récap produits.                -->
<!-- -------------------------------------- -->
<div class="row justify-content-lg-center">
  <div class="col-lg-6">
    <label class="cet-formgroup-container-label"><small class="form-text">Récapitulatif de vos produits :</small></label>
    <div class="cet-formgroup-container">
      <div class="d-flex justify-content-center">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td>
                <span class="text-muted">Vos produits : </span>
                <?php foreach ($produits->listAllProducts() as $k => $v): ?>
                  <?php foreach ($v as $prd): ?>
                    <span class="cet-qstprod-produit-type <?= $k ?>"><?= $prd; ?></span>
                  <?php endforeach; ?>
                <?php endforeach; ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row justify-content-lg-center">
  <div class="col-lg-6">
    <div class="cet-formgroup-container">
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <p><small class="cet-qstprod-label-text"><b><?= CetQstprodConstTextes::recap_questionnaire_declaratif_a; ?></b></small></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="form-group mb-3">
        <label class="cet-input-label"><small class="cet-qstprod-label-text">Vos idées, remarques :</small></label>   
        <textarea class="form-control" id="qstprod-opinions-producteur" name="qstprod-opinions-producteur"
          placeholder="votre avis nous intéresse..." form="signuprecap.form.declaratif" value=""
          maxlength="512"></textarea>
      </div>
      <label>
        <small class="form-text cet-qstprod-label-text">Souhaitez-vous valider votre inscription et envoyer votre questionnaire ? Si oui, merci de déclarer vos informations :</small>
      </label>
      <div class="input-group mb-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="qstprod-declaration-valide" 
            name="qstprod-declaration-valide" value="oui"
            checked="false">
          <label class="form-check-label" for="qstprod-question-reseaux-participation-oui">Oui, je déclare que les informations renseignées sont exactes et vérifiées.</label>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row justify-content-lg-center">
  <div class="col-lg-6">
    <form id="signuprecap.form.declaratif" class="form" method="post" action="/src/app/controller/cet.qstprod.controller.signuprecap.form.php">

      <div class="row cet-qstprod-btnnav">
        <div class="col text-center">
          <button class="btn btn-info" type="submit" 
            onmousedown="$('#qstprod-signuprecap-nav').val('retour');"
            id="btn-signuprecap.form-retour"><?= CetQstprodConstLibelles::form_retour; ?></button>
          <button class="btn btn-info" type="submit" id="btn-signuprecap-form-valider"
            onmousedown="$('#qstprod-signuprecap-nav').val('valider');">Valider votre inscription</button>
        </div>
      </div>

      <input type="text" name="cetcal_session_id" id="cetcal_session_id" value="<?= $cetcal_session_id; ?>" hidden="hidden">
      <input type="text" name="qstprod-signuprecap-nav" id="qstprod-signuprecap-nav" value="unset" hidden="hidden">
    </form>
  </div>
</div>
<script src="/src/scripts/js/cetcal/cetcal.min.signuprecap.js"></script>