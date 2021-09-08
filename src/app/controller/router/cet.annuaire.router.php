<?php
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
?>