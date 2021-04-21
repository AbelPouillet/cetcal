<?php
$neant = "";
$currentForm = isset($_SESSION['signuplieuxdist.form.post']) ? $_SESSION['signuplieuxdist.form.post'] : $neant;
//var_dump($currentForm);
$cntxmdf = isset($_SESSION['CONTEXTE_MODIF-signupprods']) ? $_SESSION['CONTEXTE_MODIF-signupprods'] : false;
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/app/controller/cet.qstprod.controller.signuplieuxdist.php');
$datas = formLieuDistController::fetchUniqueAllTypeLieu();
$sousTypes = formLieuDistController::fetchAllTypeLieu();
?>

<div class="row justify-content-lg-center">
  <div class="col-lg-6">

    <?php include $PHP_INCLUDES_PATH.'areas/include.cet.qstprod.signup.entete.form.php'; ?>
    <!-- ------------------------- -->
    <!-- INPUTS formulaire START : ---
    <input class="form-control" id="qstprod-" name="qstprod-" type="text" placeholder="">
    ---- ------------------------- -->
    <br>
    <label class="cet-formgroup-container-label">
      <small class="form-text">Renseignez les lieux de distribution ou de vente :</small>
    </label>
    <div class="cet-formgroup-container">

      <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>
          <select class="form-control select--lieudist">
              <option class="" value=""> Choississez un type de lieu de distribution</option>
              <?php foreach ($datas as $data): ?>
                  <option value="<?=$data->id?>"><?= ucfirst($data->type) ?></option>
              <?php endforeach;?>
          </select>
          <div id="the-basics" class="qstprod--marchebox d-none mt-3">
          </div>
      </div>

      <div class="form-group mb-3 qstprod--soustype d-none">
        <label class="cet-input-label">
          <small class="cet-qstprod-label-text">Précisez votre choix</small>
        </label>
        <select class="form-control select--sous--type" name="qstlieudist-1-1">
            <option value="0">Default select</option>
        </select>
        <div id="amap" class="amap--typeahead mt-5 d-none"></div>
      </div>

      <div class="form-check form-check-inline unfinded--marche d-none" style="margin-bottom: 8px;">
        <input type="checkbox" class="checkbox--new--marche" name="qstlieudist-1" id="qstlieudist-1" 
          aria-label="">
        <label class="form-check-label cet-qstprod-label-text" name="qstlieudist-2" for="qstlieudist-1">
          &#160;Je n'ai pas trouvé le marché recherché
        </label>
      </div>

      <div class="new--marche ml-5 d-none">
        <div class="form-group mb-3">
          <label for="qstlieudist-3">
            <small class="cet-qstprod-label-text">Entrez le nom de votre marché : </small>
          </label>
          <input type="text" class="form-control marche--prod" name="nv-marche-lieuxdist-nom"
            id="nv-marche-lieuxdist-nom" placeholder="Entrez un seul marché à la fois">
        </div>
        <div class="form-group mb-3">
          <label for="qstlieudist-3-1">
            <small class="cet-qstprod-label-text">Entrez l'adresse de votre marché : </small>
          </label>
          <input type="text" class="form-control adresse--marche--prod" name="nv-marche-lieuxdist-adr"
            id="nv-marche-lieuxdist-adr" placeholder="Adresse du marché" >
        </div>
        <div class="form-group mb-3">
          <input class="form-control" type="text" id="timeInput" name="timeInput" data-time-format="H:i:s" 
            style="max-width: 256px;" />
        </div>
        <button class="btn btn--new--marche--prod cet-navbar-btn cet-navbar-btn-small">Ajouter ce marché</button>
      </div>

      <div class="form-group mb-3 qstprod--precisions d-none" style="margin-top: 12px;">
        <label for="qstprod--precisions--prod" name="qstlieudist-4"><i class="fas fa-question-circle"></i>&#160;&#160;Précisions liée à votre présence sur ce lieu de distribution :</label>
        <textarea class="form-control" name="qstlieudist-4" id="qstprod--precisions--prod" maxlength="256" rows="3"></textarea>
        <p class="limit--text--alert"></p>
        <div class="d-flex justify-content-end">
          <button class="btn cet-navbar-btn cet-navbar-btn-small addCircuit">Ajouter ce lieu de distribution</button>
        </div>
      </div>

      <p class="top--alert"></p>
      <div class="alert alert-success mt-5" role="alert">
          <p class="qstprod--recap">Récapitulatif de vos lieux de distributions :</p>
          <hr>
          <div class="marche--list"></div>
          <div class="btn btn-warning mt-3 clear--marches">supprimer les lieux de distribution</div>
      </div>

    </div> <!-- end container -->

    <!--DEBUT FORM POST-->
    <form id="signuplieuxdist.form" class="form" method="post"
      action="/src/app/controller/cet.qstprod.controller.signuplieuxdist.form.php">      
      <!-- boutons de control -->
      <div class="row cet-qstprod-btnnav">
        <div class="col text-center">
          <button class="btn cet-navbar-btn" type="submit" 
            onmousedown="$('#qstprod-signuplieuxdist-nav').val('retour');"
            id="btn-signuplieuxdist.form-retour"><?= CetQstprodConstLibelles::form_retour; ?></button>
          <button class="btn cet-navbar-btn" type="submit" 
            onmousedown="$('#qstprod-signuplieuxdist-nav').val('valider');"
            id="btn-signuplieuxdist.form-valider"><?= CetQstprodConstLibelles::form_valider; ?></button>
        </div>
      </div>
      <div id="data" style="display: none;"></div>    
      <input type="text" name="cetcal_session_id" id="cetcal_session_id" 
        value="<?= $cetcal_session_id; ?>" hidden="hidden">
      <input type="text" name="qstprod-signuplieuxdist-json" id="qstprod-signuplieuxdist-json"
        value="" hidden="hidden">
      <input type="text" name="qstprod-signuplieuxdist-nav" id="qstprod-signuplieuxdist-nav" 
        value="unset" hidden="hidden">
    </form>
    <!--FIN FORM POST-->

  </div><!-- fin col -->
</div><!-- fin row -->

<script src="/src/scripts/js/cetcal/cetcal.signuplieuxdist.js"></script>
<script src="/src/scripts/js/typeahead.0.11.1.min.js" ></script>
<script src="/src/scripts/js/timepicker/jquery.timepicker.min.js"></script>