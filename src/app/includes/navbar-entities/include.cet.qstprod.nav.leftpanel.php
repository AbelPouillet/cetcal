<div aria-labelledby="cet-annuaire-main-dropdown" style="margin-top: -4px !important;">
  <!-- Lieux de vente -->
  <a class="btn btn-info cet-navbar-btn-small cet-navbar-btn-infos" href="/?statut=asso.vente&anr=true">
  	<i class="fa fa-book" aria-hidden="true"></i>&#160;&#160;&#160;Lieux de vente
  </a>
  <!-- listing prd complet -->
  <?php if (($anr || !in_array($statut, CetQstProdFilArianneHelper::$states)) && 
      strcmp($statut, 'listing.producteurs') != 0): ?>  
    <a id="cet-annuaire-crt-recherche-btn" class="btn btn-success cet-navbar-btn-small cet-navbar-btn-infos" 
      href="/?statut=listing.producteurs&anr=true">
      <i class="fas fa-seedling"></i>&#160;&#160;&#160;Je souhaite consommer BIO local 
    </a>
  <?php endif; ?>
  <!-- PARTENAIRES -->
  <a class="btn btn-info cet-navbar-btn-small" href="/?statut=partenaires.liens&anr=true">
  	<i class="fas fa-hands-helping"></i>&#160;&#160;&#160;Partenaires et liens utiles
  </a>
</div>