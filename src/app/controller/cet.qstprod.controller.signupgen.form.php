<?php
$cetcal_session_id = "";
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();
$nav = $dataProcessor->processHttpFormData($_POST['qstprod-signupgen-nav']);

try
{
  if ($nav == 'valider') $dataProcessor->checkNonNullData(array($_POST['qstprod-mdp'], $_POST['qstprod-mdpconf'], $_POST['qstprod-commune'], $_POST['qstprod-cp']));

  $s_email = $dataProcessor->processHttpFormData($_POST['qstprod-email']);
  $s_tfixe = $dataProcessor->processHttpFormData($_POST['qstprod-numbtel-fix']);
  $s_tport = $dataProcessor->processHttpFormData($_POST['qstprod-numbtel-port']);

  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.identifiantcet.php');
  $idHelper = new IdentifiantCETHelper();
  $cetcal_session_id = (isset($_POST['cetcal_session_id']) && !empty($_POST['cetcal_session_id']) && strlen($_POST['cetcal_session_id']) > 0) ? $dataProcessor->processHttpFormData($_POST['cetcal_session_id']) : hash('sha1', $idHelper->generateRandomString().$idHelper->generateRandomString().$idHelper->generateRandomString());
  session_id($cetcal_session_id);
  session_start();

  // Prepare navigation :
  if ($nav != 'valider' && $nav != 'retour')
  {
    /*Error de navigation TODO.*/
    $nav = 'retour';
  }
  $statut = $nav == 'valider' ? 'signuplieuxdist.form' : '';

  /* *****************************************************************************/
  /* HTTP POST : var setup : *****************************************************/
  // POST form logic - dans l'ordre du formulaire HTML :
  if ($nav == 'valider')
  {
    $form_obl_nom = $dataProcessor->processHttpFormData($_POST['qstprod-nom']);
    $form_obl_prenom = $dataProcessor->processHttpFormData($_POST['qstprod-prenom']);
    $form_obl_email = $dataProcessor->processHttpFormData($_POST['qstprod-email']);
    $form_obl_emailconf = $dataProcessor->processHttpFormData($_POST['qstprod-email-conf']);
    $form_obl_mdp_hash = hash('sha256', $dataProcessor->processHttpFormData($_POST['qstprod-mdp']));
    $form_obl_mdpconf_hash = $dataProcessor->processHttpFormData($_POST['qstprod-mdpconf']);
    $form_telfix = $dataProcessor->processHttpFormData($_POST['qstprod-numbtel-fix']);
    $form_telport = $dataProcessor->processHttpFormData($_POST['qstprod-numbtel-port']);
    $form_obl_nomferme = $dataProcessor->processHttpFormData($_POST['qstprod-nomferme']);
    $form_obl_siret = $dataProcessor->processHttpFormData($_POST['qstprod-siret']);
    $form_adr_numvoie = $dataProcessor->processHttpFormData($_POST['qstprod-numvoie']);
    $form_adr_rue = $dataProcessor->processHttpFormData($_POST['qstprod-rue']);
    $form_adr_lieudit = $dataProcessor->processHttpFormData($_POST['qstprod-lieudit']);
    $form_adr_commune = $dataProcessor->processHttpFormData($_POST['qstprod-commune']);
    $form_adr_cp = $dataProcessor->processHttpFormData($_POST['qstprod-cp']);
    $form_adr_cmpladr = $dataProcessor->processHttpFormData($_POST['qstprod-cmpladrs']);
    $form_pagefb = $dataProcessor->processHttpFormData($_POST['qstprod-fb']);
    $form_pageig = $dataProcessor->processHttpFormData($_POST['qstprod-ig']);
    $form_pagetwitter = $dataProcessor->processHttpFormData($_POST['qstprod-twitter']);
    $form_siteweb = $dataProcessor->processHttpFormData($_POST['qstprod-www']);
    $form_boutiquewww = $dataProcessor->processHttpFormData($_POST['qstprod-adrwebboutiqueenligne']);
    $form_typeprod = $dataProcessor->processHttpFormArrayData(isset($_POST['qstprod-besoins-activites']) ? $_POST['qstprod-besoins-activites'] : NULL);
    $form_typeprod_autre = $dataProcessor->processHttpFormData($_POST['qstprod-activite-production-autre']);
    $form_surfacepc = $dataProcessor->processHttpFormData($_POST['qstprod-surfacepc']);
    $form_surfaceserre = $dataProcessor->processHttpFormData($_POST['qstprod-supserre']);
    $form_nbrtetes = $dataProcessor->processHttpFormData($_POST['qstprod-nbrtetes']);
    $form_hectolitresparan = $dataProcessor->processHttpFormData($_POST['qstprod-hectolitresparan']);
    $form_sondage_difficultes = $dataProcessor->processHttpFormArrayData(isset($_POST['qstprod-sondagedifficultes']) ? $_POST['qstprod-sondagedifficultes'] : NULL);
    $form_sondage = $dataProcessor->processHttpFormArrayData(isset($_POST['qstprod-sondage']) ? $_POST['qstprod-sondage'] : NULL);
    $form_nombre_postes = $dataProcessor->processHttpFormData($_POST['qstprod-nbrpostes']);
    $form_nombre_saisonniers = $dataProcessor->processHttpFormData($_POST['qstprod-nbrsaisonniers']);
    $form_nombre_heuressemaine = $dataProcessor->processHttpFormData($_POST['qstprod-nbrheuressemaine']);
    $form_cagette = $dataProcessor->processHttpFormData($_POST['qstprod-cagette']);

    // Construct new DTO object :
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
    $dtoQstGeneralesProd = new QstProdGeneraleDTO($form_obl_nom, $form_obl_prenom,
      $form_obl_email, $form_obl_mdp_hash,
      $form_telfix, $form_telport, $form_obl_nomferme, $form_obl_siret, $form_adr_numvoie, $form_adr_rue,
      $form_adr_lieudit, $form_adr_commune, $form_adr_cp, $form_adr_cmpladr, $form_pagefb, $form_pageig,
      $form_pagetwitter, $form_siteweb, $form_boutiquewww, "" /* org certif bio deprecated */,
      $form_typeprod, $form_typeprod_autre, $form_surfacepc, $form_surfaceserre, $form_nbrtetes, $form_hectolitresparan,
      $form_sondage_difficultes, $form_sondage, $form_cagette, "identifiantcet",
      $form_nombre_postes, $form_nombre_saisonniers, $form_nombre_heuressemaine);
    $_SESSION['signupgen.form'] = serialize($dtoQstGeneralesProd);
  }

  $_SESSION['signupgen.form.post'] = $_POST;
  session_write_close();
  /* **************************************************************************** */

  // Apply navigation :
  header('Location: /?statut='.$statut.'&sitkn='.$cetcal_session_id);
  exit;
}
catch (Exception $e)
{
  session_write_close();
  header('Location: /src/app/controller/cet.qstprod.controller.generique.erreure.php/?err='.$e->getMessage());
  exit;
}