<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.annuaire.controller.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.controller.marches.castillonnais.php');

if (isset($_POST) && $_POST['action'] === 'Marché') 
{
    require_once($_SERVER['DOCUMENT_ROOT'] . '/src/app/model/cet.qstprod.lieuxdist.model.php');
    $model = new QSTPRODLieuModel();
    $data = $model->getAllMarcheDenomination();

    echo json_encode($data);
}
else if (isset($_POST) && $_POST['action'] === 'Reseau de vente en circuit court') 
{

  require_once($_SERVER['DOCUMENT_ROOT'] . '/src/app/model/cet.qstprod.lieuxdist.model.php');
  $ctrl = new QSTPRODLieuModel();
  $req = strtolower($_POST['action']);
  $data = $ctrl->findOneTypeLieu($req);

  echo json_encode($data);
}
else if (isset($_POST) && $_POST['action'] === 'amap') 
{
  require_once($_SERVER['DOCUMENT_ROOT'] . '/src/app/model/cet.qstprod.lieuxdist.model.php');
  $model = new QSTPRODLieuModel();
  $data = $model->getAllAmapDenomination();

  echo json_encode($data);
}
else
{
  echo json_encode('{}'); 
}



