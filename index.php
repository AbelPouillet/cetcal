<?php
include $_SERVER['DOCUMENT_ROOT'].'/cet.qstprod.startup.php';
include $PHP_CONTROLLER_PATH.'cet.qstprod.controller.index.php';
$statut = (isset($_GET['statut']) && !empty($_GET['statut'])) ? 
  $dataProcessor->processHttpFormData($_GET['statut']) : 'login.form';
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <!--<base href="http://http://82.65.74.33/"/>-->
    <title>Annuaire des producteurs bio de la région castillon</title>
    <meta name="description" content="............"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="-1">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" href="/src/scripts/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/src/scripts/css/cet/cet.qstprod.css">
    <link rel="stylesheet" href="/src/scripts/css/cet/cet.qstprod.cartographie.css">
    <!-- start : charte-g Fanny -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Courgette&family=Signika:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Courgette&family=Signika:wght@400;700&display=swap">
    <!-- end -->
    <!-- start LeafletJS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
      integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
      crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
      integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
      crossorigin=""></script>
    <!-- end -->
    <script src="/src/scripts/js/jquery/jquery-3.4.1.min.js"></script>
    <script src="/src/scripts/js/bootstrap.min.js"></script>
    <script src="/src/scripts/js/cetcal/cetcal.min.js"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v7.0" nonce="XVrFhpSY"></script>
  </head>
  <body id="cet-annuaire-body">
    <?php
      include $PHP_INCLUDES_PATH.'include.cet.qstprod.navbar.php';
      if (!$anr && !in_array($statut, CetQstProdFilArianneHelper::$statesFilAriane)) include $PHP_INCLUDES_PATH.'cartographie/include.cet.qstprod.cartographie.php';
      if (!$anr && in_array($statut, CetQstProdFilArianneHelper::$statesFilAriane)) include $PHP_INCLUDES_PATH.'include.cet.qstprod.filarianne.php';
      $module = $PHP_INCLUDES_PATH.'include.cet.'.$scope.'.'.$statut.'.php';
      include file_exists($module) ? $module : $PHP_INCLUDES_PATH.'include.cet.qstprod.login.form.php';
      include $PHP_INCLUDES_PATH.'include.cet.qstprod.footer.php';
      include $PHP_INCLUDES_PATH.'modals/include.cet.qstprod.modal1.php';
      include $PHP_INCLUDES_PATH.'modals/include.cet.qstprod.modal.notreprojet.php';
      include $PHP_INCLUDES_PATH.'modals/include.cet.qstprod.modal.donnes.numeriques.php';
    ?>
  </body>
</html>