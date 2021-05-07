<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/media/cet.qstprod.controller.media.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.controller.fichedetaillee.producteur.php');
$pk = $_GET['pkprd'];
$controller = new CETCALAnnuaireFicheDetailleController();
$media_controller = new MediaController();
$data = $controller->fetchProducteurByPk($pk);
?>

<div class="row justify-content-lg-center">
  <div class="col-xl-3">
    <div class="cet-formgroup-container" style="overflow-wrap: break-word;">
      <h4><?= $data['nom_ferme']; ?></h4>
      <p>
        <span><?= ucfirst($data['prenom']); ?> <?= ucfirst($data['nom']); ?></span><br>
        <?php
          $adr = str_replace("  ", " ", $data['adrferme_numvoie'].' '.$data['adrferme_rue'].' '
            .$data['adrferme_lieudit'].' '.$data['adrferme_commune'].' '
            .$data['adrferme_cp'].' '.$data['adrferme_compladr']);
        ?>
        <span><?= $adr; ?></span><br>
        <span>Tél : <?= $data['telfixe']; ?></span><br>
        <span>Tél mobil : <?= $data['telport']; ?></span><br>
        <span>Email : <?= $data['email']; ?></span><br>
        <span>Site web : <br>
          <a href="<?= $data['url_web']; ?>" target="_blank"><?= $data['url_web']; ?></a>
        </span><br>
        <span>Boutique en ligne : <br>
          <a href="<?= $data['url_boutique']; ?>" target="_blank"><?= $data['url_boutique']; ?></a>
        </span><br>
        <?php if (isset($data['pageurl_fb']) && strlen($data['pageurl_fb']) > 3): ?>
          <span>
            <a href="<?= $data['pageurl_fb']; ?>" target="_blank"><img class="cet-crt-icon" src="/res/content/icons/facebook-flat-icon.png" height="42"/></a>
          </span>
        <?php endif; ?>
        <?php if (isset($data['pageurl_ig']) && strlen($data['pageurl_ig']) > 3): ?>
          <span>
            <a href="<?= $data['pageurl_ig']; ?>" target="_blank"><img class="cet-crt-icon" src="/res/content/icons/ig-flat-icon_256.png" height="42"/></a>
          </span>
        <?php endif; ?>
      </p>
    </div>
  </div>
  <div class="col-xl-3">
    <div class="cet-formgroup-container">
      <img class="mini-fiche-logo-ferme" src="<?= $media_controller->selectSrcLogoFemreProducteur($pk); ?>"/>
      <?php
        var_dump($media_controller->selectMediasProducteur($pk));
      ?>
    </div>
  </div>
</div>
<?php include $PHP_INCLUDES_PATH.'/areas/include.cet.annuaire.produits.fichedetailleeprd.php'; ?>