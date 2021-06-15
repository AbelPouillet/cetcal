<?php
include $_SERVER['DOCUMENT_ROOT'].'/cet.qstprod.startup.php';
include $PHP_CONTROLLER_PATH.'cet.qstprod.controller.index.php';
$statut = (isset($_GET['statut']) && !empty($_GET['statut'])) ? 
  $dataProcessor->processHttpFormData($_GET['statut']) : 'accueil.cet';
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <META HTTP-EQUIV="EXPIRES" CONTENT="Sun, 2 Mai 2021 01:12:01 GMT">
    <title>Annuaire des producteurs bio de la région castillon</title>
    <meta name="description" content="............"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="-1">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <!--Scripts css debut-->
    <link rel="stylesheet" href="/src/scripts/css/bootstrap.min.css">
    <link rel="stylesheet" href="/src/scripts/css/font-awesome/css/all.min.css" >
    <link rel="stylesheet" href="/src/scripts/css/cet/cet.homepage.css">
    <link rel="stylesheet" href="/src/scripts/css/cet/cet.qstprod.css">
    <link rel="stylesheet" href="/src/scripts/css/cet/cet.qstprod.cartographie.css">
    <link rel="stylesheet" href="/src/scripts/css/cet/cet.fichedetailleeprd.css">
    <link rel="stylesheet" href="/src/scripts/css/cet/cet.annuaire.custom.css">
    <link rel="stylesheet" href="/src/scripts/js/timepicker/jquery.timepicker.min.css">
    <!--fin-->

    <!-- start : charte-g Fanny -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Courgette&family=Signika:wght@400;700&display=swap">
    <!-- end -->
    <!-- start LeafletJS and Mapbox -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.0/mapbox-gl.js'></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
      integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
      crossorigin=""/>
    <link rel="stylesheet" href="/src/scripts/css/MarkerCluster.css">
    <link rel="stylesheet" href="/src/scripts/css/MarkerCluster.Default.css">
    <link rel="stylesheet" href="/src/scripts/css/cet/datepicker.css">
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
      integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
      crossorigin=""></script>
    <!-- end -->
    <script src="/src/scripts/js/cetcal/cetcal.annuaire.geoloc.min.js"></script>
    <script src="/src/scripts/js/jquery/jquery-3.4.1.min.js"></script>
    <script src="/src/scripts/js/popper.min.js"></script>
    <script src="/src/scripts/js/bootstrap.min.js"></script>
    <script src="/src/scripts/js/cetcal/cetcal.min.js"></script>
  </head>
  <body id="cet-annuaire-body">
    <?php
      include $PHP_INCLUDES_PATH.'include.cet.qstprod.navbar.php';
      
      if (strcmp($statut, 'accueil.cet') === 0) include $PHP_INCLUDES_PATH.'include.cet.qstprod.login.form.php';    
      if (isset($cnx) && $cnx !== false) include $PHP_INCLUDES_PATH.'/areas/include.cet.annuaire.login.outcome.php';  
      if (isset($obl) && $obl !== false) include $PHP_INCLUDES_PATH.'/areas/include.cet.annuaire.renouvellement.outcome.php';  
      
      if (!$anr && !in_array($statut, CetQstProdFilArianneHelper::$statesFilAriane) 
        && strcmp($statut, 'sondage.marche') !== 0) include $PHP_INCLUDES_PATH.'cartographie/include.cet.qstprod.cartographie.php';
      if (strcmp($statut, 'accueil.cet') === 0) include $PHP_INCLUDES_PATH.'/areas/include.cet.annuaire.prd.a.lhonneur.php';
      
      if (!$anr && in_array($statut, CetQstProdFilArianneHelper::$statesFilAriane)) include $PHP_INCLUDES_PATH.'include.cet.qstprod.filarianne.php';
      $module = $PHP_INCLUDES_PATH.'include.cet.'.$scope.'.'.$statut.'.php';
      if (file_exists($module)) include $module;
      if ($anr && strcmp($statut, 'bienvenu.form') !== 0) include $PHP_INCLUDES_PATH.'include.cet.qstprod.bienvenu.form.php';
      if (strcmp($statut, 'accueil.cet') === 0) include $PHP_INCLUDES_PATH.'include.cet.qstprod.bienvenu.form.php';

      include $PHP_INCLUDES_PATH.'include.cet.qstprod.footer.php';
      include $PHP_INCLUDES_PATH.'modals/include.cet.qstprod.modal1.php';
      include $PHP_INCLUDES_PATH.'modals/include.cet.annuaire.modal.alerte.php';
      include $PHP_INCLUDES_PATH.'modals/include.cet.qstprod.modal.notreprojet.php';
      include $PHP_INCLUDES_PATH.'modals/include.cet.qstprod.modal.donnes.numeriques.php';
    ?>
  </body>
</html>
<?php if (strcmp($statut, 'accueil.cet') === 0): ?>
  <script type="text/javascript">
    $('#cet-qstprod_intro').show();
  </script>
<?php endif; ?>
<?php if (isset($_GET['demande']) && !empty($_GET['demande']) &&
  strcmp($dataProcessor->processHttpFormData($_GET['demande']), 'se-connecter') === 0): ?>
  <script type="text/javascript">
    $(document).ready(function() {
      setTimeout(function(){ $('#cet-annuaire-user-login').mousedown(); }, 1124);
    });
  </script>
<?php endif; ?>
<?php
  //require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.annuaire.utils.cryption.php');
  //echo EncryptionUtils::encryptProperties();
?>