<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();
$nav = $dataProcessor->processHttpFormData($_POST['annuaire-user-signup-nav']);

try
{

  if ($nav == 'valider') 
  {
    $dataProcessor->checkNonNullData(array(
    	$_POST['annuaire-user-signup-email'], 
    	$_POST['annuaire-user-signup-email-conf'], 
    	$_POST['annuaire-user-signup-mdp'], 
    	$_POST['annuaire-user-signup-mdpconf'])
    );
    $dataProcessor->checkArrayPopulated(
      $dataProcessor->processHttpFormArrayData($_POST['annuaire-user-signup-recevoir'])
    );

    /**
     * Si l'IP est black listée alors logger et retourner à la racine.
     * Si l'IP a faite une inscription il y à moins d'une heure alors refuser et 
     * monter la vigilance sur IP d'un cran.
     * Si l'IP a un niveau de vigilance trop élevé alors blacklister et retourner à la racine.
     */
  }

  if ($nav != 'valider' && $nav != 'retour')
  {
    $nav = 'retour';
  }
  $statut = $nav == 'valider' ? 'user.signup' : './';

  /* *****************************************************************************/
  /* HTTP POST : var setup : *****************************************************/
  // POST form logic - dans l'ordre du formulaire HTML :
  if ($nav == 'valider')
  {
  	$form_commune = $dataProcessor->processHttpFormData($_POST['annuaire-user-signup-commune']);
    $form_user = $dataProcessor->processHttpFormData($_POST['annuaire-user-signup-nomusr']);
    $form_email = $dataProcessor->processHttpFormData($_POST['annuaire-user-signup-email']);
    $form_emailconf = $dataProcessor->processHttpFormData($_POST['annuaire-user-signup-email-conf']);
    $form_mdp_hash = hash('sha256', $dataProcessor->processHttpFormData($_POST['annuaire-user-signup-mdp']));
    $form_mdpconf_hash = $dataProcessor->processHttpFormData($_POST['annuaire-user-signup-mdpconf']);
    $form_telport = $dataProcessor->processHttpFormData($_POST['annuaire-user-signup-numbtel-port']);

    $form_recevoir = $dataProcessor->processHttpFormArrayData($_POST['annuaire-user-signup-recevoir']);
    $form_neant = in_array('neant', $form_recevoir) ? 1 : 0;
    $form_infos = ($form_neant === 0 && in_array('infos', $form_recevoir)) ? 1 : 0;
    $form_achat = ($form_neant === 0 && in_array('achat', $form_recevoir)) ? 1 : 0;
    $form_hebdo = ($form_neant === 0 && in_array('hebdo', $form_recevoir)) ? 1 : 0;
  }

  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.communes.model.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.user.model.php');
  $communes_mdl = new CETCALCommunesModel();
  $commune_libelle = $communes_mdl->getLibelleCommuneByPK($form_commune);
  $mdl = new CETCALUserModel();

  $exists = $mdl->existsByEmail(trim($form_email));
  if (!$exists) 
  {
  	$user = $mdl->insert($form_email, $form_user, $form_mdp_hash, $form_telport, $commune_libelle, 
  		$_SERVER['REMOTE_ADDR'], $form_commune, $form_infos, $form_achat, $form_hebdo);
  	$signup_done = (isset($user['pk']) && isset($user['wid'])) ? 'true' : 'false'; 
    // Apply navigation. Arrivé ici, l'utilisateur est inscrit.
	  header('Location: /?statut='.$statut.'&anr=true&usrs='.$signup_done.'&usri='.$user['pk'].'&email='.$form_email);
  }
  else 
  {
  	// Apply navigation.
	  header('Location: /?statut='.$statut.'&anr=true&usrs=email_exists&email='.$form_email);
  }

  if (strcmp($signup_done, 'true') === 0)
  {
    /**  envoyer email de confirmation inscription cetcal. ***************************/
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.annuaire.utils.mailjet.helper.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.filereader.php');
    $mailHelper = new CETMailjetHelper();
    $mailSubject = "Inscription cetcal.site enregistrée, merci pour votre participation !";
    $mailHelper->send('cet.user.signup.html.mail.content.html', 
        'cet.user.signup.plain.mail.content', trim($form_email), $mailSubject, 
        new FileReaderUtils($_SERVER['DOCUMENT_ROOT']), 'signup/');
  }
  else
  {
    error_log("Erreur d'inscription pour ".$form_email);
  }

  exit;
}
catch (Exception $e)
{
  session_write_close();
  header('Location: /src/app/controller/cet.qstprod.controller.generique.erreure.php/?err='.$e->getMessage());
  exit;
}