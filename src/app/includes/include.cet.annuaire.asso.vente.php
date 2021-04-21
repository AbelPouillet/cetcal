<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();
$filtre = isset($_GET['q']) ? $dataProcessor->processHttpFormData($_GET['q']) : false; 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.controller.asso.vente.php');
$ctrl = new AssoDistributeursController();
$data = !$filtre ? $ctrl->init() : $ctrl->loadQuery($filtre);
$resultNull = is_array($data) && count($data) === 0;
$counter = 0;
?>

<div class="row justify-content-lg-center" style="margin-bottom: 8px;">
  <div class="col-md-6">
    <p class="form-text text-muted">Les structures de type <i>Associations</i> ou <i>Distributeurs</i> connues de CETCAL.<br>Filtrer/Rechercher par mot clé :</p>
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Rechercher par mot clé, commune, activité, marché..." aria-label="Recherche par mot clé" id="cet-annuaire-recherche-filtre" name="cet-annuaire-recherche-filtre">
      <div class="input-group-append">
        <a class="btn btn-outline-success" id="cet-annuaire-recherche-filtrer"
          href="/?statut=asso.vente&anr=true&q=">
          Rechercher  <i class="fa fa-search" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </div>
  <div class="col-md-3"></div>
</div>

<?php if ($resultNull): ?>
<div class="row justify-content-lg-center" style="margin-bottom: 80px;">
  <div class="col-md-6">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <p>
        Aucun résultat pour le mot clé "<span class="cet-r-q"><?= $dataProcessor->processHttpFormData($filtre) ?></span>".<br>
        <i class="fa fa-info-circle" aria-hidden="true"> </i> Essayer avec le nom d'une commune, un territoire, une activité...
      </p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
  <div class="col-md-3"></div>
</div>
<?php endif; ?>

<div style="margin-bottom: 60px; margin-top: 30px;">
  <?php foreach ($data as $row): ?>
  <?php ++$counter; ?>
  <?php if ($counter === 1): ?> 
    <div class="row justify-content-lg-center" style="margin-bottom: 8px;">
  <?php endif; ?>
      <div class="col-md-3">
        <div class="card border-warning cet-carte-info">
          <div class="card-header text-white bg-warning"><?= $row['denomination']; ?></div>
          <div class="card-body">
            <h6 class="card-subtitle mb-2 text-muted"><?= $row['territoire']; ?></h6>
            <p class="card-text"><?= $row['activite']; ?> <?= $row['specificites']; ?></p>
            <p class="card-text"><?= $row['adresse']; ?></p>
            <?php if (isset($row['infoscmd']) && !empty($row['infoscmd'])): ?>
              <p class="card-text"><i class="fa fa-warning-circle" aria-hidden="true"></i> <?= $row['infoscmd']; ?></p>
            <?php endif; ?>
            <?php if (isset($row['jourhoraire']) && !empty($row['jourhoraire'])): ?>
              <p class="card-text">Jours/Horaires : <?= $row['jourhoraire']; ?></p>
            <?php endif; ?>
          </div>
          <ul class="list-group list-group-flush border-warning">
            <?php if (isset($row['email']) && !empty($row['email'])): ?> 
              <li class="list-group-item border-warning">
                <?php foreach ($ctrl->splitData("#", $row['email']) as $value): ?>
                  <a href="#" class="card-link">
                    <email class="cet-email-tag"><?= $value; ?></email>
                  </a>
                <?php endforeach; ?>
              </li>
            <?php endif; ?>
            <?php if (isset($row['tels']) && !empty($row['tels'])): ?> 
              <li class="list-group-item border-warning">
                <?php foreach ($ctrl->splitData("#", $row['tels']) as $value): ?>
                  <a href="tel:<?= $value; ?>" class="card-link">
                    <?= $value; ?>
                  </a>
                <?php endforeach; ?>
              </li>
            <?php endif; ?>
            <?php if (isset($row['urlwww']) && !empty($row['urlwww'])): ?> 
              <li class="list-group-item border-warning">
                <?php foreach ($ctrl->splitData("#", $row['urlwww']) as $value): ?>
                  <a href="<?= $value; ?>" class="card-link" target="_blank">
                    <?= $value; ?>
                  </a>
                <?php endforeach; ?>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
  <?php if ($counter === 3): ?>
    </div>
    <?php $counter = 0; ?>
  <?php endif; ?>
  <?php endforeach; ?>
  <?php if ($counter !== 3): // close div if it hasn't been done in loop. ?>
    </div>
  <?php endif; ?>
</div>
<script src="/src/scripts/js/cetcal/cetcal.recherche.min.js"></script>