<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/admin/cet.annuaire.admin.decoupe.data.producteur.sql.php');
$decoupeur = new CETCALDeoucpeCSVProducteur();
$decoupeur->decoupe($_SERVER['DOCUMENT_ROOT'].'/qualification/thomas_data-céline_29012021.csv');
?>