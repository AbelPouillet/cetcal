<?php
Class HTTPDataProcessor 
{

  /**
   * Contains all error messages.
   */
  private $errors = Array();

  public function __construct() {}

  /**
   * Control/check input. When data is unset, appends to error message array for View layer purposes.
   * param0  : the data to check.
   * returns : the param0 data processed and safe for database.
   */
  public function processHttpFormData($data)
  {
    if (!isset($data)) array_push($this->errors, 
      "CETCAL.HTTPDataProcessor : Le champ /// est obligatoire et n'est pas renseigné.");
    else return htmlspecialchars(filter_var(
          $data, FILTER_SANITIZE_STRING));
      /*htmlentities(htmlspecialchars(
        filter_var(
          $data, FILTER_SANITIZE_STRING), 
        ENT_QUOTES), 
      ENT_QUOTES);*/
  }

  /**
   * Same but for arrays.
   */
  public function processHttpFormArrayData($array)
  {
    $data = array();
    if (!isset($array) || !is_array($array) || count($array) < 1) return $data;
    foreach ($array as $entry) array_push($data, $this->processHttpFormData($entry));
    return $data;
  }

  /**
   * this does whats coded... ez
   */
  public function checkNonNullData($array_data)
  {
    foreach ($array_data as $data)
    {
      if (!isset($data) || strlen($data) <= 0) 
        throw new Exception("CETCAL.HTTPDataProcessor : Des donnees obligatoires sont manquantes.");
    }
  }

  /**
   * Dans les cas de choix multiples avec au moins une saisie obligatoire, utiliser cette fonction.
   * Vérifie qu'un tableau n'est pas vide et si non-vide, vérifie que les données contenues sont elles aussi non vides.
   */
  public function checkArrayPopulated($array_data) 
  {
    if (!isset($array_data) || count($array_data) <= 0) throw new Exception("CETCAL.HTTPDataProcessor : Des donnees obligatoires sont manquantes.");
    $c = count($array_data);
    $c_check = 0;
    foreach ($array_data as $entry) if (isset($entry) && !empty($entry) && strlen($entry) > 1) ++$c_check;
    if ($c !== $c_check) throw new Exception("CETCAL.HTTPDataProcessor : Des donnees obligatoires sont manquantes.");  
  }

}