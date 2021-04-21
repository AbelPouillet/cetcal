<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.controller.fichedetaillee.producteur.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.annuaire.utils.format.php');
$utils = new FormatUtils();
$controller = new CETCALAnnuaireFicheDetailleController();
$data = $controller->fetchProducteursDerniersInscrit(5);
?>
<!-- login & signup html forms -->
<div class="cet-module row justify-content-lg-center" style="margin-bottom: 6px;">
  <div class="col-lg-9">
    <div class="alert alert-light cet-borderless-alert" role="alert" style="color: rgb(50,70,50);">
      <h4 class="alert-heading"><i class="far fa-thumbs-up fa-2x" style="color: #28a745; margin-bottom: -6px !important;"></i> Les derniers Producteur.e.s inscrits à ce jour :</h4>     
      <table>
        <?php foreach ($data as $prdDto): ?>
          <?php 
            $adr = $prdDto->prodInscrit === 'false' ? $prdDto->adrfermeLtrl : 
              str_replace("  ", " ", $prdDto->adrNumvoie.' '.$prdDto->adrRue.' '.$prdDto->adrLieudit.' '.
              $prdDto->adrCommune.' '.$prdDto->adrCodePostal.' '.$prdDto->adrComplementAdr);
          ?>
          <tr class="prd-a-lhonneur-row">
            <td>
              <span class="prd-a-lhonneur-denomination" onmousedown="cartographieFlyTo('<?= $prdDto->getLatLng(); ?>','/');">
                <?= html_entity_decode($utils->formatDenominationUpperCases(trim($prdDto->nomferme))); ?>                   
              </span>
            </td>
            <!--<td><i class="fas fa-directions fa-2x" style="color: #DD4215 !important;"></i></td>-->
            <td>
              &#160;<?= trim($adr); ?>, (<?= $utils->formatTypesProduction($prdDto->typeDeProduction); ?>).
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>