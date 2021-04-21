<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

/**
 * 
 */
class CETCALCartographieLoader
{
  
  function __construct() {}

  public function load($data)
  {
    $latLng = NULL;
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.cartographie.model.php');
    $model = new CETCALCartographieModel();
    
    foreach ($data as $prdDto)
    {
      if ($model->exists($prdDto->getPk()))
      {
        $latLng = $model->getLatLng($prdDto->getPk());
        $prdDto->setLatLng($latLng['cetcal_prd_lat'], $latLng['cetcal_prd_lng']);
      }
      else
      {
        try
        {
          $adr = (is_numeric($prdDto->adrNumvoie) ? $prdDto->adrNumvoie : '').
            '%20'.$prdDto->adrRue.'%20'.$prdDto->adrLieudit.'%20'.$prdDto->adrCommune.'%20'.
            (is_numeric($prdDto->adrCodePostal) ? $prdDto->adrCodePostal : '').'%20'.$prdDto->adrComplementAdr;
          $client = new Client();
          $response = $client->get('https://api.mapbox.com/geocoding/v5/mapbox.places/'.$adr.'.json?limit=1&country=FR&access_token=pk.eyJ1IjoiY2V0Y2FsIiwiYSI6ImNrYzllZ2ZyczEzeTAyd3BoYjBiMTJ2bzMifQ.QdHZsjNjHQ_LQbMOGfbceQ', 
            ['synchronous' => true]);
          $latLng = $this->forwardGeocoder(json_decode($response->getBody()->getContents()));
          $model->insert($latLng, $prdDto->getPk());
          $prdDto->setLatLng($latLng[0], $latLng[1]);
        }
        catch (Exception $e)
        {
          error_log("CETCAL.CETCALCartographieLoader: error loading geocodes for pk_producteur=".$prdDto->getPk(), 0);
        }
      }
    }
  }

  private function forwardGeocoder($data) 
  {
    for ($i = 0; $i < count($data->features); $i++) 
    {
      $feature = $data->features[$i];
      if ($feature->geometry->coordinates !== 'undefined') return $feature->geometry->coordinates;
    }
    return NULL;
  }

}