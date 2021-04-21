<?php
$cetcal_session_id = "";
if (isset($_GET['sitkn']))
{
  $cetcal_session_id = htmlentities(htmlspecialchars($_GET['sitkn']));
  session_id($cetcal_session_id);
  include $_SERVER['DOCUMENT_ROOT'].'/src/app/const/cet.qstprod.const.globals.php';
  // 2 heure de Session côté serveur.
  ini_set('session.gc_maxlifetime', CetQstprodConstGlobals::session_life_span);
  // Les clients devront se souvenir de leurs Session ID durant le même lapse de temps :
  session_set_cookie_params(CetQstprodConstGlobals::session_life_span);
  session_start();
}

$reboot = isset($_GET['reboot']) && $_GET['reboot'] == "true";
$anr = isset($_GET['anr']) && $_GET['anr'] == "true";
$scope = $anr ? 'annuaire' : 'qstprod';
$tag_mep = "";
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
$PHP_INCLUDES_PATH = $DOC_ROOT.'/src/app/includes/';
$PHP_CONST_PATH = $DOC_ROOT.'/src/app/const/';
$PHP_CONTROLLER_PATH = $DOC_ROOT.'/src/app/controller/';
$PHP_UTILS_PATH = $DOC_ROOT.'/src/app/utils/';

include $PHP_CONST_PATH.'cet.qstprod.const.listes.php';
require_once($PHP_UTILS_PATH.'cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();
include $PHP_UTILS_PATH.'cet.qstprod.utils.filereader.php';
$listes_arrays = new CetQstprodConstListes(new FileReaderUtils($DOC_ROOT));

include $PHP_CONST_PATH.'cet.qstprod.const.textes.php';
include $PHP_CONST_PATH.'cet.qstprod.const.libelles.php';
include $PHP_UTILS_PATH.'cet.qstprod.utils.filarianne.php';
?>