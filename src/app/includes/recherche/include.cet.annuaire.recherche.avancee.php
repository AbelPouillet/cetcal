<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.controller.entite.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/const/cet.annuaire.const.types.php');
$entite_types_ctrl = new EntiteController();
$types_entites = $entite_types_ctrl->getDistinctTypesEntites();
?>
<div id="zone-homepage-recherche-avancee" style="display:none;"> 
  
  <p>TODO</p>

</div>