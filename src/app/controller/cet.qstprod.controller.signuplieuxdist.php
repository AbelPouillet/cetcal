<?php
require_once('cet.annuaire.annuaire.controller.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');

/**
 *
 */
class formLieuDistController extends AnnuaireController 
{

  public function test() 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.lieuxdist.model.php');
    $model = new QSTPRODLieuModel();
    $datas = $model->allLieuDist();
    return json_encode($datas);
  }

  public static function fetchUniqueAllTypeLieu()
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.lieuxdist.model.php');
    $model = new QSTPRODLieuModel();
    $datas = $model->allLieuDist();

    $temp_array = [];
    $i = 0;
    $key_array =[];

    foreach ($datas as $data) 
    {
        if (!in_array($data->type, $key_array))
        {
            $key_array[$i] = $data->type;
            $temp_array[$i] = $data;
        }
        $i++;
    }

    return $temp_array;
  }

  public static function fetchAllTypeLieu()
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.lieuxdist.model.php');
    $model = new QSTPRODLieuModel();
    $datas = $model->allLieuDist();

    $temp_array = [];
    $i = 0;
    $key_array = [];

    foreach ($datas as $data) 
    {
        if (!in_array($data->sous_type, $key_array) && !empty($data->sous_type))
        {
            $key_array[$i] = $data->sous_type;
            $temp_array[$i] = $data;
        }
        $i++;
    }

    return $temp_array;
  }

}


