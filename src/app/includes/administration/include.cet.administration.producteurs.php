<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.annuaire.controller.php');
$dataProcessor = new HTTPDataProcessor();
$ctrl = new AnnuaireController();
$sau_cetcal_session_id = $dataProcessor->processHttpFormData($_GET['sitkn']);
$logged_admin = $ctrl->getAdminBySessionId($sau_cetcal_session_id);
$sau_pk = $logged_admin['adm_id'];
// TODO : possibilité ici de comparer le sitkn ou autre donnée avec les données admins. 
$producteurs = $ctrl->fetchAllFrontEndDTOArray();
?>

<div id="cet-admin-prd-inscrits-accordion">
  <div class="card cet-accordion-admin">
    <div class="card-header" id="cet-admin-prd-inscrits-heading">
      <label class="cet-formgroup-container-label"><small class="form-text">
        Cette section vous aidera à administrer les tous les producteur.e.s.
      </small></label>
      <h5 class="mb-0">
        <a class="badge badge-success cet-accordion-badge" href="#" 
          data-toggle="collapse" data-target="#cet-admin-prd-inscrits" aria-expanded="true" aria-controls="cet-admin-prd-inscrits">
          Administrer les producteur.e.s.
        </a>
        <a class="align-middle" href="#" data-toggle="collapse" 
            data-target="#cet-admin-prd-inscrits" aria-expanded="true" 
            aria-controls="cet-admin-prd-inscrits  ">
          <i id="cet-accordion-icon-admin-prd-inscrits" class="fa fa-hand-o-down cet-accordion-icon"></i>
        </a>
      </h5>
    </div>
    <div id="cet-admin-prd-inscrits" class="collapse" aria-labelledby="cet-admin-prd-inscrits-heading" 
      data-parent="#cet-admin-prd-inscrits-accordion">
      <div class="card-body">
        <p>Liste administrable des Producteur.e.s insctits (producteur.e.s ayant reçu un identifiant cetcal) et pré-inscrits (pas d'identifiant cetcal) :</p>
        <table class="table" id="cetcal-admin-producteurs">
          <tr>
            <th>ID</th>
            <th>Nom Ferme</th>
            <th>Adresse</th>
            <th>Email</th>
            <th>Identifiant CETCAL</th>
            <th>Nom Prénom</th>
            <th>Lat/lng</th>
            <th>Actions</th>
          </tr>
          <tr><td colspan="6"><b>Producteur.e.s inscrits (avec identifiant cetcal) : </b></td></tr>
          <?php $count = 0; $count_preinscrits = 0; ?>
          <?php foreach ($producteurs as $prd): ?>
            <?php if ((strcmp($prd->identifiant_cet, '0') === 0 || 
                       strcmp($prd->identifiant_cet, '') === 0) || 
                       strcmp($prd->prodInscrit, 'false') === 0 ||
                       strcmp($prd->prodInscrit, 'amdif') === 0) continue;
                  else ++$count; ?>
            <?php 
              $adr = $prd->prodInscrit === 'false' ? $prd->adrfermeLtrl : 
                str_replace("  ", " ", $prd->adrNumvoie.' '.$prd->adrRue.' '.$prd->adrLieudit.' '.
                $prd->adrCommune.' '.$prd->adrCodePostal.' '.$prd->adrComplementAdr); 
            ?>
            <tr id="row-admin-prd-pk-<?= $prd->getPk(); ?>">
              <td><?= $prd->getPk(); ?></td>
              <td class="admin-producteur-wordbreakable">
                <a href="/src/app/controller/cet.qstprod.controller.demande.update.superadmin.php?sau_pk=<?= $sau_pk; ?>&sau_sitkn=<?= $sau_cetcal_session_id; ?>&sau_pkprd=<?= $prd->getPk(); ?>" target="_blank"><?= $prd->nomferme; ?></a>
              </td>
              <td class="admin-producteur-wordbreakable"><?= $adr; ?></td>
              <td class="admin-producteur-wordbreakable"><?= $prd->email; ?></td>
              <td class="admin-producteur-wordbreakable"><?= $prd->identifiant_cet; ?></td>
              <td class="admin-producteur-wordbreakable"><?= $prd->nom.' '.$prd->prenom; ?></td>
              <td class="admin-producteur-wordbreakable"><?= $prd->getLatLng(); ?></td>
              <td class="admin-producteur-wordbreakable">
                <button class="administration-desactiver-producteur btn-small btn btn-outline-danger" 
                  row-cible="row-admin-prd-pk-<?= $prd->getPk(); ?>"
                  prd-cible="[n°<?= $prd->getPk(); ?>] <?= $prd->nomferme; ?> (adresse: <?= $adr; ?>)."
                  data="<?= $prd->getPk(); ?>"
                  style="float: right; padding: 4px !important;">
                  <i class="fas fa-user-times"></i>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
          <tr><td colspan="6"><br><br><b>Producteur.e.s préinscrits : </b></td></tr>
          <?php foreach ($producteurs as $prd_preinscrit): ?>
            <?php if (strlen($prd_preinscrit->identifiant_cet) > 1 && 
                      strcmp($prd_preinscrit->prodInscrit, 'true') === 0) continue;
                  else ++$count_preinscrits; ?>
            <tr id="row-admin-prd-pk-<?= $prd_preinscrit->getPk(); ?>">
              <td><?= $prd_preinscrit->getPk(); ?></td>
              <td class="admin-producteur-wordbreakable">
                <a href="/src/app/controller/cet.qstprod.controller.demande.update.superadmin.php?sau_pk=<?= $sau_pk; ?>&sau_sitkn=<?= $sau_cetcal_session_id; ?>&sau_pkprd=<?= $prd_preinscrit->getPk(); ?>" target="_blank"><?= $prd_preinscrit->nomferme; ?></a>
              </td>
              <td class="admin-producteur-wordbreakable"><?= $prd_preinscrit->adrfermeLtrl; ?></td>
              <td class="admin-producteur-wordbreakable"><?= $prd_preinscrit->email; ?></td>
              <td class="admin-producteur-wordbreakable"><?= $prd_preinscrit->identifiant_cet; ?></td>
              <td class="admin-producteur-wordbreakable"><?= $prd_preinscrit->nom.' '.$prd_preinscrit->prenom; ?></td>
              <td class="admin-producteur-wordbreakable"><?= $prd_preinscrit->getLatLng(); ?></td>
              <td class="admin-producteur-wordbreakable">
                <button class="administration-desactiver-producteur btn-small btn btn-outline-danger" 
                  row-cible="row-admin-prd-pk-<?= $prd_preinscrit->getPk(); ?>"
                  prd-cible="[n°<?= $prd_preinscrit->getPk(); ?>] <?= $prd_preinscrit->nomferme; ?> (adresse: <?= $prd_preinscrit->adrfermeLtrl; ?>)."
                  data="<?= $prd_preinscrit->getPk(); ?>"
                  style="float: right; padding: 4px !important;">
                  <i class="fas fa-user-times"></i>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
        <p>
          Total de <?= $count; ?> Producteur.e.s <b>inscrits (producteur.e.s ayant reçu un identifiant cetcal)</b>. Total de <?= $count_preinscrits; ?> Producteur.e.s <b>pré-inscrits</b>.
        </p>
      </div>
    </div>
  </div>
</div>