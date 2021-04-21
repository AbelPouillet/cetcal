<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/const/cet.annuaire.const.login.php');
?>
<?php if (isset($cnx) && (intval($cnx) === CetConnectionConst::CONNECTION_UTSR_REUSSIE || 
          intval($cnx) === CetConnectionConst::CONNECTION_PRD_REUSSIE)): ?>
<?php 
  $usr_identifiant = $dataProcessor->processHttpFormData($_GET['usridf']);
  $client_type = $dataProcessor->processHttpFormData($_GET['clitype']);
  $libelle_client_type = '';
  if (isset($client_type) && strcmp($client_type, 'prd') === 0) $libelle_client_type = 'Producteur.e';
  if (isset($client_type) && strcmp($client_type, 'usr') === 0) $libelle_client_type = 'utilisateur(trice)';
?>
  <div class="row justify-content-lg-center" id="cetcal-cnx-done">
    <div class="col-lg-9">
      <div class="alert alert-light cet-borderless-alert" role="alert" style="color: rgb(50,70,50);">
        <h4 class="alert-heading">Bienvenu <?= $libelle_client_type; ?>, vous êtes maintenant connecté.</h4>
        <p></p>
        <hr>
        <label>
          <small class="form-text cet-qstprod-label-text" style="margin-top: 2px;"><?= CetQstprodConstLibelles::lib_general_entete_garantit; ?><br>
            <a href="#" class="cet-conditions-donnees-numerique"><?= CetQstprodConstLibelles::lib_general_entete_donnees; ?></a>
          </small>
        </label>
      </div>
    </div>
  </div>
<?php elseif (isset($cnx) && intval($cnx) !== CetConnectionConst::CONNECTION_PRD_REUSSIE && 
              intval($cnx) !== CetConnectionConst::CONNECTION_UTSR_REUSSIE): ?>
  <div class="row justify-content-lg-center" id="cetcal-cnx-not-done">
    <div class="col-lg-9">
      <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">Les informations renseignées ne permettent pas de vous connecter.</h4>
        <p>Votre email est inconnu. Nous n'arrivons pas à vous connecter.</p>
        <ul>
          <li>
            Vous êtes <b>Producteur.e</b> et vous souhaitez bénéficier d'un soutient informatique (aide informatique ou à l'inscription et au référencement, autre) ? Cliquer ci-dessous :
            <br>
            <a href="#" class="btn btn-info" style="font-family: Courgette; margin-top: 10px;">Je suis Producteur et souhaite être aidé dans mes démarches</a>
          </li>
        </ul>
        <ul>
          <li>Vous êtes inscrit mais vous avez oublié vos informations de connection ? Veuillez cliquer sur <i><b>&#171; se connecter &#187;</b></i> puis sur <i><b>&#171; j'ai oublié mon mot de passe et/ou mon identifiant &#187;</b></i>.</li>
          <li><b>Producteur</b>, vous souhaitez vous inscrire pour être référencé ? Cliquer sur <i><b>&#171; Je suis Producteur.e.s &#187;</b></i> dans la bar de menu.</li>
          <li><b>Professionnel</b> ou particulier, vous souhaitez travailler avec nous : cliquer sur <i><b>&#171; créer un compte &#187;</b></i> dans la bar de menu.</li>
        </ul>
        <hr>
        <label>
          <small class="form-text cet-qstprod-label-text" style="margin-top: 2px;"><?= CetQstprodConstLibelles::lib_general_entete_garantit; ?><br>
            <a href="#" class="cet-conditions-donnees-numerique"><?= CetQstprodConstLibelles::lib_general_entete_donnees; ?></a>
          </small>
        </label>
        <p class="mb-0"><?= CetQstprodConstLibelles::en_cas_de_doute; ?></p>
      </div>
    </div>
  </div>
<?php endif; ?>
<script type="text/javascript">
  setTimeout(function() { 
    //$('#cetcal-cnx-done').hide('slow');
    //$('#cetcal-cnx-not-done').hide('slow');
  }, 1000 * 5);
</script>