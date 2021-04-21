<?php
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
$PATH_MODEL_DTO = $DOC_ROOT.'/src/app/model/';
$cetcal_session_id = "";
$data = array();
try 
{
  require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
  $dataProcessor = new HTTPDataProcessor();
  $nav = $dataProcessor->processHttpFormData($_POST['qstprod-signuprecap-nav']);
  $cetcal_session_id = $dataProcessor->processHttpFormData($_POST['cetcal_session_id']);
  $form_opinions = $dataProcessor->processHttpFormData($_POST['qstprod-opinions-producteur']);

  if ($nav == 'valider')
  {
    session_id($cetcal_session_id);
    session_start();

    /** ***************************************************************************
     * Time to insert it all from SESSION to DB.
     */
    require_once($PATH_MODEL_DTO.'cet.qstprod.producteurs.model.php');
    require_once($PATH_MODEL_DTO.'cet.qstprod.lieuxdist.model.php');
    require_once($PATH_MODEL_DTO.'cet.qstprod.produits.model.php');
    require_once($PATH_MODEL_DTO.'cet.qstprod.questionnaire.sondage.producteur.model.php');
    require_once($PATH_MODEL_DTO.'cet.qstprod.informations.model.php');

    $model = new QSTPRODProducteurModel();
    $data = $model->createProducteur(isset($_SESSION['signupgen.form']) ? $_SESSION['signupgen.form'] : NULL,
      isset($_SESSION['signupprods.form']) ? $_SESSION['signupprods.form'] : NULL,
      isset($_SESSION['signupconso.form']) ? $_SESSION['signupconso.form'] : NULL,
      $form_opinions);
    $model = new QSTPRODLieuxModel();
    $model->createLieu($data['pk'], 
      isset($_SESSION['signuplieuxdist.form']) ? $_SESSION['signuplieuxdist.form'] : NULL,
      isset($_SESSION['signupconso.form']) ? $_SESSION['signupconso.form'] : NULL);
    $model = new QSTPRODProduitsModel();
    $model->createProduits($data['pk'], isset($_SESSION['signupprods.form']) ? $_SESSION['signupprods.form'] : NULL);
    $model = new QSTPRODSondageProducteurModel();
    $model->createSondages($data['pk'], isset($_SESSION['signupgen.form']) ? $_SESSION['signupgen.form'] : NULL);
    $model = new QSTPRODInformationsModel();
    $model->createInformations($data['pk'], isset($_SESSION['signupbesoins.form']) ? $_SESSION['signupbesoins.form'] : NULL);
    
    /** ***************************************************************************
     ** Database inserts done with success, ***************************************
     *  send email de confirmation inscription anuaire. ***************************/
    require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.mail.php');
    require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.filereader.php');
    $mailUtils = new CETQstprodMailUtils();
    $mailUtils->init();
    $mailSubject = "Inscription Annuaire enregistrée, bienvenue Producteur.e.s.";
    $mailUtils->sendSignup('cet.qstprod.signup.html.mail.content.html', 
      'cet.qstprod.signup.plain.mail.content', $data['ev'], $mailSubject, 
      new FileReaderUtils($DOC_ROOT), 'signup/', $data['idcetwww']);
  }

  // Prepare navigation :
  if ($nav != 'valider' && $nav != 'retour') { /*Error de navigation TODO.*/ $nav = 'retour'; }
  $statut = $nav == 'valider' ? 'signupeffectue.form' : 'signupbesoins.form';

  // Apply navigation :
  header('Location: /?statut='.$statut.'&sitkn='.$cetcal_session_id.'&ev='.(isset($data['ev']) ? $data['ev'] : "").'&idfcet='.(isset($data['idcetwww']) ? $data['idcetwww'] : ""));
  exit();
}
catch (Exception $e) 
{
  header('Location: /src/app/controller/cet.qstprod.controller.generique.erreure.php/?err='.$e->getMessage().'&sitkn='.$cetcal_session_id);
  exit();
}