<?php
Class SessionHelper
{
  private $PHP_FILES_PATH = "/res/data/";
  private $doc_root = "";

  function __construct($DOC_ROOT) 
  {
    $this->doc_root = $DOC_ROOT;
  }

  public function getDto($dtoType, $dtoInstance)
  {
    $dto = isset($_SESSION[$dtoType]) ? unserialize($_SESSION[$dtoType]) : NULL;
    $dtoInstance = $dto;

    return $dtoInstance;
  }

}