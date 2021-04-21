<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.communes.model.php');
$model = new CETCALCommunesModel();
$data = $model->selectAllGeolocSet();
echo json_encode($data);