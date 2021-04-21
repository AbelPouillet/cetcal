<?php
/** 
 * signuplieuxdist.form html form DTO.
 */
Class QstLieuxDistributionDTO
{

  public $pointsDeVente;
  public $pointsDeVenteAutre;
  public $marcheAdr;
  public $marcheJours;
  public $joursMarchesSaisies;

  function __construct($pPointDeVente = "", $pPointsDeVenteAutre = "", $pMarcheAdr = "",
    $pMarcheJours = "", $pJoursMarchesSaisies = "")
  {
    $this->pointsDeVente = $pPointDeVente;
    $this->pointsDeVenteAutre = $pPointsDeVenteAutre;
    $this->marcheAdr = $pMarcheAdr;
    $this->marcheJours = $pMarcheJours;
    $this->joursMarchesSaisies = $pJoursMarchesSaisies;
  }

}