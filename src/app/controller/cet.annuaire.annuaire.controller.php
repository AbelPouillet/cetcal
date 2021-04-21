<?php
/**
 * 
 */
class AnnuaireController
{

  function __construct() { }

  public function loadQuery($filtre)
  {
    $res = array();
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
    $dataProcessor = new HTTPDataProcessor();
    $data = $this->init();
    $motCle = isset($filtre) ? $dataProcessor->processHttpFormData($filtre) : false;

    foreach ($data as $row)
    {
      foreach ($row as $key => $value) 
      {
        if (!isset($value)) continue; 
        $index = stripos($value, $motCle);
        if ($index !== false && $index >= 0) 
        {
          array_push($res, 
            str_ireplace($filtre, '<span class="cet-r-q">'.$filtre.'</span>', 
              $row));
          break;
        }
      }
    }

    return !$filtre ? $data : $res;
  }

  public function splitData($spliter, $data)
  {
    $res = array();
    if (!strpos($data, $spliter)) array_push($res, $data);
    else $res = explode($spliter, $data);
    return $res;
  }

}