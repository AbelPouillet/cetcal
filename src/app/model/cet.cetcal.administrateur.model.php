<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 */
class CETCALAdminModel extends CETCALModel 
{
  
  public function get($mpd, $login) 
  {
    $qLib = $this->getQuerylib();
  }

  public function getAll()
  {
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_FROM_AMINISTRATION);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return $data;
  }

  public function exists($mdp, $email, $usrName)
  {
    $result = false;
    $mdp_hash = hash("sha512", $mdp);

    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_FROM_AMINISTRATION_EMAIL_OR_LOGIN);
    $stmt->bindParam(":pAdmEmail", $email, PDO::PARAM_STR);
    $stmt->bindParam(":pAdmUsrName", $usrName, PDO::PARAM_STR);
    $stmt->bindParam(":pAdmUsrMdp", $mdp_hash, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row) 
    {
      if (isset($row['adm_email']) && strcmp($row['adm_usr_mdp'], $mdp_hash) === 0) 
      {
        $result = true;
      }
      else if (isset($row['adm_usr_name']) && strcmp($row['adm_usr_mdp'], $mdp_hash) === 0) 
      {
        $result = true;
      }
    }

    return $result;
  }

  public function setTempSessionId($sessionId, $login)
  {
    $session_hash = hash("sha512", $sessionId);
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::UPDATE_AMINISTRATION_SESSION);
    $stmt->bindParam(":pSessionId", $session_hash, PDO::PARAM_STR);
    $stmt->bindParam(":pAdmLoginEmail", $login, PDO::PARAM_STR);
    $stmt->bindParam(":pAdmLogin", $login, PDO::PARAM_STR);
    $stmt->execute();
  }

  public function authTempSessionId($sessionId)
  {
    $session_hash = hash("sha512", $sessionId);
    $qLib = $this->getQuerylib();
    $stmt = $this->getCnxdb()->prepare($qLib::SELECT_ALL_FROM_AMINISTRATION_SESSION);
    $stmt->bindParam(":pSessionId", $session_hash, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC); 

    if (isset($data['session_id']) && 
        strcmp($data['session_id'], $session_hash) === 0) return 1;
    return -1;
  }

}