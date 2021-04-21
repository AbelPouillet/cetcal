<?php
$neant = "";
$currentForm = isset($_SESSION['signuplieuxdist.form.post']) ? $_SESSION['signuplieuxdist.form.post'] : $neant;
//var_dump($currentForm);
$cntxmdf = isset($_SESSION['CONTEXTE_MODIF-signupprods']) ? $_SESSION['CONTEXTE_MODIF-signupprods'] : false;
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/app/controller/cet.qstprod.controller.signuplieuxdist.php');
$datas = formLieuDistController::fetchUniqueAllTypeLieu();
$sousTypes = formLieuDistController::fetchAllTypeLieu();
?>
<!--TEST-->
<div class="row justify-content-lg-center">
    <div class="col-lg-6">

        <?php include $PHP_INCLUDES_PATH.'areas/include.cet.qstprod.signup.entete.form.php'; ?>
        <!-- ------------------------- -->
        <!-- INPUTS formulaire START : ---
        <input class="form-control" id="qstprod-" name="qstprod-" type="text" placeholder="">
        ---- ------------------------- -->
        <br>
        <label class="cet-formgroup-container-label"><small class="form-text">Renseignez les lieux de distribution ou de vente :</small></label>
        <div class="cet-formgroup-container">

            <div class="form-group mb-3">
                <label class="cet-input-label" name="qstlieudist-1"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>
                <select class="form-control select--lieudist" name="qstlieudist-1">
                    <option class="" value=""> Choississez un type de lieu de distribution</option>
                    <?php foreach ($datas as $data): ?>
                        <option value="<?=$data->id?>"><?= ucfirst($data->type) ?></option>
                    <?php endforeach;?>
                </select>
                <div id="the-basics" class="qstprod--marchebox d-none mt-3">
                </div>

                <input type="text" class="span1" id="item_code" value="" />
                <div class="qstprod--soustype d-none">
                  <label class="cet-input-label" name="qstlieudist-1-1"><small class="cet-qstprod-label-text">Précisez votre choix</small></label>
                  <select class="form-control select--sous--type" name="qstlieudist-1-1">
                      <option value="0">Default select</option>
                  </select>
                  <div id="amap" class="amap--typeahead mt-5 d-none"></div>
                </div>

                <div class="input-group unfinded--marche d-none mt-5">
                    <div class="input-group-prepend">
                        <label class="cet-input-label" name="qstlieudist-2">
                            <small class="cet-qstprod-label-text">
                                Je n'ai pas trouvé le marché recherché
                            </small>
                        </label>
                        <input type="checkbox" class="checkbox--new--marche pt-2" name="qstlieudist-1" aria-label="Checkbox for following text input">

                        <div class="new--marche ml-5 d-none">
                            <label for="qstlieudist-3">
                                <small class="cet-qstprod-label-text">
                                    Entrez le nom de votre marché
                                </small>
                            </label>
                            <input type="text" class="form-control ml-5 marche--prod" 
                              id="nv-marche-lieuxdist-nom" placeholder="Entrez un seul marché à la fois" >
                            <label for="qstlieudist-3-1">
                                <small class="cet-qstprod-label-text">
                                    Entrez l'adresse de votre marché
                                </small>
                            </label>
                            <input type="text" class="form-control ml-5 adresse--marche--prod" 
                              id="nv-marche-lieuxdist-adr"  placeholder="Adresse du marché" >
                            <input type="text" id="timeInput" data-time-format="H:i:s" />
                            <button class="btn btn-info btn--new--marche--prod mt-2 ml-5">Ajouter ce marché</button>
                        </div>
                    </div>
                </div>

                <div class="form-group  qstprod--precisions mt-3 d-none">
                    <label for="qstprod--precisions--prod" name="qstlieudist-4">Précisions liée à votre présence sur ce lieu de distribution :</label>
                    <textarea class="form-control" name="qstlieudist-4" id="qstprod--precisions--prod" maxlength="256" rows="3"></textarea>
                    <p class="limit--text--alert"></p>
                    <div class="d-flex">
                        <div class="btn btn-info mt-2 ml-auto p-2 addCircuit">Ajouter ce lieu de distribution 2</div>
                    </div>
                </div>
                <p class="top--alert"></p>
                <div class="alert alert-success mt-5" role="alert">
                    <p class="qstprod--recap">Récapitulatif de vos lieux de distributions :</p>
                    <hr>
                    <div class="marche--list">

                    </div>
                    <div class="btn btn-warning mt-3 clear--marches"> supprimer les lieux de distribution</div>
                </div>

            </div>
        </div>

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
          <input type="text" name="qstprod-signuplieuxdist-nav" id="qstprod-signuplieuxdist-nav" 
            value="unset" hidden="hidden">
        </form>
        <!--FIN FORM POST-->

    </div><!-- fin col -->
</div><!-- fin row -->
<script src="/src/scripts/js/cetcal/cetcal.signuplieuxdist.js"></script>
<script src="/src/scripts/js/typeahead.0.11.1.min.js" ></script>
<script src="/src/scripts/js/timepicker/jquery.timepicker.min.js"></script>