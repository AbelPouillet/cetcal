<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();
$insrp_validee_email = (isset($_GET['ev']) && !empty($_GET['ev'])) ? 
  $dataProcessor->processHttpFormData($_GET['ev']) : "[email non renseigné]";
$idcetwww = (isset($_GET['idfcet']) && !empty($_GET['idfcet'])) ? 
  $dataProcessor->processHttpFormData($_GET['idfcet']) : "[erreure sur identifiant, veuillez nous contacter]";
?>
<!-- page de validation envoyé et traité avec succés -->
<div class="cet-module row justify-content-lg-center" id="cet-qstprod_referece" style="margin-bottom: 60px;">
  <div class="col-lg-6">
    <div class="alert alert-success" role="alert">
      <h5 class="alert-heading">Bienvenu.e Producteur.e.s !</h5>
      <h5 class="alert-heading">Nous avons traité votre inscription avec succès. Vous êtes maintenant référencé dans l'annuaire. Merci.</h5>
      <p><b>Veuillez noter votre identifiant cetcal.site :</b></p>
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <?php foreach (str_split($idcetwww) as $caractere): ?>
            <span class="badge badge-success cet-idcetwww-char">
              <?= $caractere; ?>
            </span>
            <span> </span>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <br>
      <p>Un email vous a été envoyé à l'adresse <b><?= $insrp_validee_email; ?></b>. Votre <b>identifiant de connection</b> y est signalé - garder cet identifiant. <b>S'il vient à être perdu, contactez nous.</b></p><p>Vous pourrez administrer votre fiche producteur prochainement en cliquant sur <b><i>"Votre page producteur"</i></b> depuis notre page d'accueil. Si vous n'avez pas souhaité nous communiqué votre adresse email, nous vous appelerons dans les plus bref délais pour activer votre compte par téléphone.</p>
      <p>Vous pouvez dès maintenant <a href="/">retourner à l'accueil.</a></p>
    </div>
  </div>
</div>