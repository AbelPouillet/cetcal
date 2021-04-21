<?php

/**
 * Abstract MODEL class.
 */
class CETCALModel 
{

  /*
  * Connection returned by PDO.
  */
  private $cnxdb;

  /**
   * SQL query library.
   */
  private $querylib;
  
  function __construct() 
  {
    $this->setConnection();
    require_once('cet.qstprod.querylibrary.php');
    $this->querylib = new CETCALQueryLibrary();
  }

  /*
   * 
   */
  private function setConnection() 
  {
    require_once('cet.qstprod.pdoconnector.php');
    $pdo = new CETCALPDOConnector();
    $this->cnxdb = $pdo->getPdoConnexion();
  }

  public function closeCnxdb()
  {
    $this->cnxdb = null;
  }

  /*
   *
   */
  public function getCnxdb() 
  {
    return $this->cnxdb;
  }

  public function getQueryLib()
  {
    return $this->querylib;
  }

  function getClientIP() 
  {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
      $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
      $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
      $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
      $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
      $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
      $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
      $ipaddress = 'UNKNOWN';
    return $ipaddress;
  }

}