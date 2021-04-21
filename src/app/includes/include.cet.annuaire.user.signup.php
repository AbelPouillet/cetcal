<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.annuaire.controller.php');
$ctrl = new AnnuaireController();
$communes = $ctrl->getCommunes();
$neant = '';
$currentForm = (isset($_SESSION['annuaire.user.signup.form']) && isset($_SESSION['annuaire.user.signup.form.post'])) ? $_SESSION['annuaire.user.signup.form.post'] : array();

require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();


$email_does_exist = false; $email_user = ''; $email_exists = '';
if (isset($_GET['usrs']) && isset($_GET['email']))
{
  $email_exists = $dataProcessor->processHttpFormData($_GET['usrs']);
  $email_user = $dataProcessor->processHttpFormData($_GET['email']);
  $email_does_exist = strcmp($email_exists, 'email_exists') === 0;
}
?>

<?php if (isset($_GET['usrs']) && $email_does_exist): ?>
  <div class="row justify-content-lg-center">
    <div class="col-lg-9">
      <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">L'email <b><?= $email_user ?></b> est déjà utilisé.</h4>
        <p>
          L'email renseigné est déjà présent dans notre liste d'inscrits et est associé à compte existant.<br>Veuillez renouveller l'inscription avec une autre adresse de messagerie.<br>
          <a href="./">Retourner à l'accueil.</a>
        </p>
        <hr>
        <label>
          <small class="form-text cet-qstprod-label-text" style="margin-top: 2px;"><?= CetQstprodConstLibelles::lib_general_entete_garantit; ?><br>
            <a href="#" class="cet-conditions-donnees-numerique"><?= CetQstprodConstLibelles::lib_general_entete_donnees; ?></a>
          </small>
        </label>
      </div>
    </div>
  </div>
<?php elseif (isset($_GET['usrs']) && strcmp($email_exists, 'true') === 0 
  && isset($email_user) && !empty($email_user)): ?>
  <div class="row justify-content-lg-center">
    <div class="col-lg-9">
      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Votre inscription est finalisé.</h4>
        <p>Un email de confirmation vient d'être envoyé à <b><?= $email_user ?></b>.</p>
        <p>Vous pouver maintenant <a href="./">retourner à l'accueil et vous connecter.</a></p>
        <hr>
        <label><?= CetQstprodConstLibelles::lib_general_entete_veuillez_renseigner; ?>
          <small class="form-text cet-qstprod-label-text" style="margin-top: 2px;"><?= CetQstprodConstLibelles::lib_general_entete_garantit; ?><br>
            <a href="#" class="cet-conditions-donnees-numerique"><?= CetQstprodConstLibelles::lib_general_entete_donnees; ?></a>
          </small>
        </label>
        <p class="mb-0"><?= CetQstprodConstLibelles::en_cas_de_doute; ?></p>
      </div>
    </div>
  </div>
<?php elseif (!isset($_GET['usrs'])): ?>
  <div class="row justify-content-lg-center">
    <div class="col-lg-6">
      <div class="alert alert-success cet-bloc" role="alert">
        <p><?= CetQstprodConstLibelles::lib_general_entete_veuillez_renseigner; ?></p>
        <hr>
        <label>
          <small class="form-text cet-qstprod-label-text" style="margin-top: 2px;"><?= CetQstprodConstLibelles::lib_general_entete_garantit; ?><br>
            <a href="#" class="cet-conditions-donnees-numerique"><?= CetQstprodConstLibelles::lib_general_entete_donnees; ?></a>
          </small>
        </label>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if (!isset($_GET['usrs'])): ?>
  <div class="row justify-content-lg-center" id="annuaire-user-signup-form-container">
    <div class="col-lg-6">
      <form id="annuaire-user-signup-form" class="form" method="post" 
        action="/src/app/controller/cet.annuaire.controller.user.signup.form.php">
        <label class="cet-formgroup-container-label">
          <small class="form-text">Informations nécessaires à votre inscription :</small>
        </label>
        <div class="cet-formgroup-container">
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Ou souhaitez-vous consommer BIO, local ?<br><b>Si votre commune ne figure pas dans la liste, merci de sélectionner une commune à proximité.</b><br>Choississez votre commune :</small></label>
            <select class="form-control" id="annuaire-user-signup-commune" name="annuaire-user-signup-commune">
              <?php //foreach ($communes as $commune): ?>
                <option value="<?= $commune['id'] ?>"><?= $commune['libelle'] ?></option>
              <?php //endforeach; ?>
              <option value="0" selected="selected">-- Villes, Communes --</option>
            </select>
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Choisir un nom d'utilisateur (ou pseudo).<br>Si aucun nom d'utilisateur n'est renseigné, l'email sera utilisé :</small></label>
            <input class="form-control" id="annuaire-user-signup-nomusr" name="annuaire-user-signup-nomusr" 
              type="text" placeholder="Entrez un nom d'utilisateur" 
              value="<?= isset($currentForm['annuaire-user-signup-nomusr']) ? $currentForm['annuaire-user-signup-nomusr'] : $neant; ?>"
              maxlength="32">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Adresse e-mail (sera utiliser pour envoi d'un email d'activation de votre compte cetcal) :</small></label>
            <input class="form-control is-invalid" id="annuaire-user-signup-email" name="annuaire-user-signup-email" 
              type="text" placeholder="Adresse e-mail de connection" 
              value="<?= isset($currentForm['annuaire-user-signup-email']) ? $currentForm['annuaire-user-signup-email'] : $neant; ?>"
              maxlength="64">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Confirmation adresse e-mail :</small></label>
            <input class="form-control is-invalid" id="annuaire-user-signup-email-conf" 
              name="annuaire-user-signup-email-conf" type="text" 
              placeholder="Confirmation de l'adresse e-mail" 
              onblur="checkValidEmailConfirmation(64, 'annuaire-user-signup-email', this.id);"
              value="<?= isset($currentForm['annuaire-user-signup-email-conf']) ? $currentForm['annuaire-user-signup-email-conf'] : $neant; ?>"
              maxlength="64">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Mot de passe de connexion à l'annuaire (8 caractères minimum) :</small></label>
            <input class="form-control is-invalid" id="annuaire-user-signup-mdp" name="annuaire-user-signup-mdp" 
              type="password" 
              placeholder="Mot de passe de connexion à l'annuaire"
              onblur="checkFormInputMin(32, 8, this.id);"
              maxlength="32">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Confirmer votre mot de passe :</small></label>
            <input class="form-control is-invalid" id="annuaire-user-signup-mdpconf" 
              name="annuaire-user-signup-mdpconf" 
              type="password" placeholder="Confirmer votre mot de passe"
              onblur="checkMotsDePasse(30, 8, 'annuaire-user-signup-mdp', this.id);"
              maxlength="32">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">N° de téléphone mobile :</small></label>
            <input class="form-control" id="annuaire-user-signup-numbtel-port" name="annuaire-user-signup-numbtel-port" 
              type="text" maxlength="10" minlength="10" placeholder="N° de téléphone mobile."
              value="<?= isset($currentForm['annuaire-user-signup-numbtel-port']) ? $currentForm['annuaire-user-signup-port'] : $neant; ?>">
          </div>
        </div>

        <div class="cet-formgroup-container">
          <div class="form-group mb-3">
            <h4 class="alert-heading">Dites nous quelles informations vos intéressent</h4>
            <p><i>Je souhaite...</i> (indication obligatoire)</p>    
            <div class="mandatory-cbx-group" id="annuaire-user-signup-mandatory-cbx-group">
              <div class="form-check">
                <input class="form-check-input cet-qstprod-label-text user-signup-mandatory-cbx" type="checkbox" 
                  value="neant" id="annuaire-user-signup-neant" name="annuaire-user-signup-recevoir[]"
                  <?= isset($currentForm['annuaire-user-signup-recevoir']) && 
                    in_array(implode(';', $recevoir), $currentForm['annuaire-user-signup-recevoir']) ? 
                    'checked="checked"' : $neant; ?>>
                <label class="form-check-label cet-qstprod-label-text annuaire-user-signup-cbx" for="annuaire-user-signup-neant">
                  <i>ne recevoir aucune information(s).</i>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input cet-qstprod-label-text user-signup-mandatory-cbx" type="checkbox" 
                  value="infos" id="annuaire-user-signup-infos" name="annuaire-user-signup-recevoir[]"
                  <?= isset($currentForm['annuaire-user-signup-recevoir']) && 
                    in_array(implode(';', $recevoir), $currentForm['annuaire-user-signup-recevoir']) ? 
                    'checked="checked"' : $neant; ?>>
                <label class="form-check-label cet-qstprod-label-text annuaire-user-signup-cbx" for="annuaire-user-signup-infos">
                  <i>recevoir les informations générales concernant l'annuaire CETCAL et être informé de l'événementiel.</i>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input cet-qstprod-label-text user-signup-mandatory-cbx" type="checkbox" 
                  value="achat" id="annuaire-user-signup-achat" name="annuaire-user-signup-recevoir[]"
                  <?= isset($currentForm['annuaire-user-signup-recevoir']) && 
                    in_array(implode(';', $recevoir), $currentForm['annuaire-user-signup-recevoir']) ? 
                    'checked="checked"' : $neant; ?>>
                <label class="form-check-label cet-qstprod-label-text annuaire-user-signup-cbx" for="annuaire-user-signup-achat">
                  <i>être notifié des informations concernant la vente de produits BIO locaux, les lieux de vente et la présence des producteur.e.s sur ces derniers.</i>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input cet-qstprod-label-text user-signup-mandatory-cbx" type="checkbox" 
                  value="hebdo" id="annuaire-user-signup-hebdo" name="annuaire-user-signup-recevoir[]"
                  <?= isset($currentForm['annuaire-user-signup-recevoir']) && 
                    in_array(implode(';', $recevoir), $currentForm['annuaire-user-signup-recevoir']) ? 
                    'checked="checked"' : $neant; ?> checked>
                <label class="form-check-label cet-qstprod-label-text annuaire-user-signup-cbx" for="annuaire-user-signup-hebdo">
                  <i>recevoir les informations mensuelles et/ou hebdomadaires sur toutes les activités de production, de distribution, l'événementiel et la vente locale de produits BIO !</i>
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col text-center">
            <a class="btn cet-navbar-btn" id="btn-user-signup-form-retour" href="./">Annuler</a>
            <button class="btn cet-navbar-btn" type="submit" id="btn-user-signup-form-valider" 
              onmousedown="$('#annuaire-user-signup-nav').val('valider');">Valider l'inscription</button>
          </div>
        </div>

        <input type="text" name="annuaire-user-signup-nav" id="annuaire-user-signup-nav" value="unset" hidden="hidden">
      </form>
    </div>
  </div>
<?php endif; ?>

<?php include $PHP_INCLUDES_PATH.'include.cet.qstprod.bienvenu.form.php'; ?>
<script src="/src/scripts/js/cetcal/cetcal.min.signup.user.js"></script>
<script type="text/javascript">
  $('#cet-qstprod_intro').show();
</script>