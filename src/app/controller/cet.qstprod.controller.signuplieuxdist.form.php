<?php
$cetcal_session_id = NULL;

try
{
  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
  $dataProcessor = new HTTPDataProcessor();
  $cetcal_session_id = $dataProcessor->processHttpFormData($_POST['cetcal_session_id']);
  session_id($cetcal_session_id);
  session_start();

  // Prepare navigation :
  $nav = $dataProcessor->processHttpFormData($_POST['qstprod-signuplieuxdist-nav']);
  if ($nav != 'valider' && $nav != 'retour') /*Error de navigation TODO.*/ $nav = 'retour'; 
  $statut = $nav == 'valider' ? 'signupprods.form' : 'signupgen.form';

  // POST form logic :
  /* *****************************************************************************/
  /* HTTP POST : var setup : *****************************************************/
  // POST form logic - dans l'ordre du formulaire HTML :
  /**
   * Exemple de JSON reçu :
   * [{"denomination":"Marché de Targon","type":"Marché","pk_entite":"99","crea_marche":false,"precs":"hhklkjlkj","date":null,"heure_deb":null},
   {"denomination":"oipoiopi","crea_marche":true,"precs":"qsdfghjkl","heure_deb":"00:00:00","adr":"iopipoipoi"}]
   */
  // utiliser urldecode() pour décrypter le JSON à parser.
  $form_json_data = $dataProcessor->processHttpFormArrayData($_POST['qstprod-signuplieuxdist-definis']);

  $_SESSION['signuplieuxdist.form.post'] = $_POST;
  session_write_close();
  /* *****************************************************************************/

  // Apply navigation :
  header('Location: /?statut='.$statut.'&sitkn='.$cetcal_session_id);
  exit();
}
catch (Exception $e) 
{
  session_write_close();
  error_log($e->getMessage());
  header('Location: /src/app/controller/cet.qstprod.controller.generique.erreure.php/?err='.$e->getMessage().'&sitkn='.$cetcal_session_id);
  exit();
}