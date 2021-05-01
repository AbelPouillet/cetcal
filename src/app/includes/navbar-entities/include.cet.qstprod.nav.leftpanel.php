<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="navbar-collapse collapse w-100 order-3 dual-collapse2 navbar-cet-qstprod">
    <ul class="navbar-nav"> 
      <!-- Lieux de vente -->
      <li class="nav-item" style="margin-right: 4px;">
        <a class="nav-link cet-p" href="/?statut=asso.vente&anr=true&type=">
          <i class="fa fa-book" aria-hidden="true"></i>&#160;&#160;&#160;Lieux de vente
        </a>
      </li>
      <!-- listing prd complet -->
      <li class="nav-item" style="margin-right: 4px;">
        <a class="nav-link cet-p" id="cet-annuaire-crt-recherche-btn" 
          href="/?statut=listing.producteurs&anr=true">
          <i class="fas fa-seedling"></i>&#160;&#160;&#160;Je souhaite consommer BIO local 
        </a>
      </li>
      <?php if ($OPEN_PAGE_RECETTES): ?>
        <li class="nav-item" style="margin-right: 4px;">
          <a class="nav-link cet-p" href="/?statut=base.recettes&anr=true">
            <i class="fas fa-temperature-high"></i>&#160;&#160;&#160;Livret de recettes
          </a>
        </li>
      <?php endif; ?>
    </ul>
    <ul class="navbar-nav ml-auto">
      <?php if ($OPEN_LOGIN_SIGNUP && !$cnx_done && in_array($statut, NavbarHelper::$status_connection_signup)): ?>
        <li class="nav-item" style="margin-right: 4px;">
          <a id="cet-annuaire-user-login" class="btn cet-navbar-btn" href="#"
            onmousedown="$('#cet-qstprod_seconnecter').show('slow', function(){ 
              $('#cetcal-cnx-not-done').hide('slow'); 
              $('#cetcal-obl-done').hide('slow'); 
              $('#cetcal-obl-not-done').hide('slow'); });">
            <i class="fas fa-user"></i>&#160;Se connecter
          </a>
        </li>
        <li class="nav-item">
          <a id="cet-annuaire-user-signup" class="btn cet-navbar-btn" 
            href="/?statut=user.signup&anr=true">
            <i class="fas fa-info-circle"></i>&#160;Inscription (non producteur.e)
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>