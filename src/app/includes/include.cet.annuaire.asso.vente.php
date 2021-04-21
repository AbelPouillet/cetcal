<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/app/controller/cet.annuaire.controller.asso.vente.php');
$ctrl = new AssoDistributeursController();
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/app/controller/cet.annuaire.controller.marches.castillonnais.php');
$LieuxDeVenteCtrl = new MarchesCastillonnaisController();
$typesDeLieux = $LieuxDeVenteCtrl->showAllTypes();
$countSelect = "";

if (isset($_GET['q'])) 
{
    $filtre = $dataProcessor->processHttpFormData($_GET['q']);
    $data = $ctrl->loadQuery($filtre, 'association distributeur');
} 
else if (isset($_GET['type'])) 
{
    $filtre = $dataProcessor->processHttpFormData($_GET['type']);
    if (!empty($filtre)) 
    {
        $data = $ctrl->init($filtre);
        $countSelect = count($data);
    } 
    else 
    {
        $data = $ctrl->init('association distributeur');
    }
} 
else 
{
    $filtre = false;
    $data = $ctrl->init('association distributeur');
}
$ctrl = new AssoDistributeursController();

$resultNull = is_array($data) && count($data) === 0;
$counter = 0;
?>

    <div class="row justify-content-center">
        <div class="col-lg-6">
                        <p class="form-text text-muted">Les lieux de vente connues de
                CETCAL.<br>Filtrer/Rechercher par mot clé :</p>
            <div class="input-group mb-3">
                <select id="cet-annuaire-select-filter" class="form-control" aria-label="Default select example">
                    <option>--- Recherche par filtre ---</option>
                    <option value="">Tous les lieux</option>
                    <?php foreach ($typesDeLieux as $type): ?>
                        
                        <option value="<?= $type->type ?>"><?= $type->type ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="input-group-append">
                    <a class="btn btn-outline-success" id="cet-annuaire-button-filter" href="/?statut=asso.vente&anr=true&type=">valider</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>
    <div class="row justify-content-center" style="margin-bottom: 8px;">
        <div class="col-lg-6">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Rechercher par mot clé, commune, activité, marché..."
                       aria-label="Recherche par mot clé" id="cet-annuaire-recherche-filtre"
                       name="cet-annuaire-recherche-filtre">
                <div class="input-group-append">
                    <a class="btn btn-outline-success" id="cet-annuaire-recherche-filtrer"
                       href="/?statut=asso.vente&anr=true&q=">
                        Rechercher <i class="fa fa-search" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>

    <div class="d-flex justify-content-center">
        <?=  $countSelect ? '<span class="" >'  . "<b> $countSelect résultats  </b>" . " pour " . $filtre . '<span>' : " "?>
    </div>

    <?php if ($resultNull): ?>
        <div class="row justify-content-lg-center" style="margin-bottom: 80px;">
            <div class="col-9">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p>
                        Aucun résultat pour le mot clé "<span
                                class="cet-r-q"><?= $dataProcessor->processHttpFormData($filtre) ?></span>".<br>
                        <i class="fa fa-info-circle" aria-hidden="true"> </i> Essayer avec le nom d'une commune, un
                        territoire, une activité...
                    </p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="" style="margin-bottom: 60px; margin-top: 30px;">
        <?php foreach ($data as $row): ?>
            <?php ++$counter; ?>
            <?php if ($counter === 1): ?>
                <div class="row justify-content-center">
            <?php endif; ?>
            <div class="col-lg-3">
                <div class="card border-warning cet-carte-info">
                    <div class="card-header text-white bg-warning"><?= $row['denomination']; ?></div>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted"><?= $row['territoire']; ?></h6>
                        <p class="card-text"><?= $row['activite']; ?> <?= $row['specificites']; ?></p>
                        <p class="card-text"><?= $row['adresse']; ?></p>
                        <?php if (isset($row['infoscmd']) && !empty($row['infoscmd'])): ?>
                            <p class="card-text"><i class="fa fa-warning-circle"
                                                    aria-hidden="true"></i> <?= $row['infoscmd']; ?></p>
                        <?php endif; ?>
                        <?php if (isset($row['jourhoraire']) && !empty($row['jourhoraire'])): ?>
                            <p class="card-text">Jours/Horaires : <?= $row['jourhoraire']; ?></p>
                        <?php endif; ?>
                    </div>
                    <ul class="list-group list-group-flush border-warning">
                        <?php if (isset($row['email']) && !empty($row['email'])): ?>
                            <li class="list-group-item border-warning">
                                <?php foreach ($ctrl->splitData("#", $row['email']) as $value): ?>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control copier-element-presse-papier-input"
                                               value="<?= $value; ?>" disabled="disabled">
                                        <div class="input-group-append">
                                            <button class="btn btn-success copier-element-presse-papier" type="button"
                                                    onmousedown="copierPressePapier('<?= $value; ?>');">
                                                <small>copier</small>
                                            </button>
                                        </div>
                                    </div>
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
        <?php if ($counter !== 3): // close div if it hasn't been done in loop.  ?>
    </div>
<?php endif; ?>
</div>

<script src="/src/scripts/js/cetcal/cetcal.recherche.min.js"></script>