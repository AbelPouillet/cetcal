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

}