<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/?">
    <img src="/res/content/logo-annuaire.png" height="80" alt="">
  </a>
  <button class="navbar-toggler margin-80-infeq-700" id="cet-navbar-hamburger" type="button" data-toggle="collapse" 
    data-target="#navbar-cet-qstprod" aria-controls="navbar-cet-qstprod" 
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse flex-column ml-lg-0 ml-3" id="navbar-cet-qstprod">
    <ul class="navbar-nav mr-auto">
      <?php if (!in_array($statut, CetQstProdFilArianneHelper::$states)): ?>
        <li class="nav-item">
          <a id="cet-inscription-producteur" class="btn btn-success cet-navbar-btn" style="font-size: 18px !important; margin-right: 6px;" 
            href="#"><i class="fas fas fa-globe-europe fa-lg"></i>&#160;&#160;&#160;Je suis Producteur.e.s&#160;</a>
        </li>
      <?php endif; ?>
      <li class="nav-item dropdown" style="margin-top: 4px;">
        <a class="nav-link dropdown-toggle cet-p" href="#" id="navbar-qui-nous-sommes-dropdown" 
        	role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Qui sommes nous &#160;<i class="fas fa-question-circle"></i>&#160;</a>
        <div class="dropdown-menu" aria-labelledby="navbar-qui-nous-sommes-dropdown">
          <a class="dropdown-item" href="#" 
          onmousedown="scrollTowardsId('cet-annuaire-footer', 0);">L'association Castillonnais en Transition
          </a>
          <a class="dropdown-item align-middle" href="https://github.com/j-fish/cetcal" target="_blank">
            Notre projet sur GitHub <img src="/res/content/github-logo.png" height="40" alt="" style="float: right !important;">
          </a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item" style="z-index: 1; margin-top: 4px;">
        <a id="cet-notre-projet" class="nav-link cet-p" href="#"><i class="fas fa-info-circle"></i>&#160;&#160;Notre projet, <i>Circuits Alimentaires Locaux</i></a>
      </li>
    </ul>
    <ul class="navbar-nav mr-auto" style="margin-top: 8px;">
      <?php if (!in_array($statut, CetQstProdFilArianneHelper::$states)): ?>
        <li class="nav-item dropdown" style="float: left !important;">
          <?php include $PHP_INCLUDES_PATH.'navbar-entities/include.cet.qstprod.nav.leftpanel.php'; ?>
        </li>
      <?php endif; ?>
    </ul>
    <ul class="navbar-nav ml-auto" style="margin-bottom: 6px;">
      <?php if ($OPEN_LOGIN_SIGNUP && !$cnx_done && !in_array($statut, CetQstProdFilArianneHelper::$statesFilAriane)): ?>
        <?php if (strcmp($statut, "user.signup") !== 0): ?>
          <li class="nav-item">
            <a id="cet-annuaire-user-login" class="nav-link cet-custom-btn-sm" href="#"
              onmousedown="$('#cet-qstprod_seconnecter').toggle('slow');">
              <i class="fas fa-user"></i>&#160;se connecter
            </a>
          </li>
          <li class="nav-item">
            <a id="cet-annuaire-user-signup" class="nav-link cet-custom-btn-sm" 
              href="/?statut=user.signup&anr=true">
              <i class="fas fa-info-circle"></i>&#160;créer un compte
            </a>
          </li>
        <?php endif; ?>
      <?php endif; ?>
    </ul>
  </div>
  <div class="hidden-infeq-700" 
    style="position: absolute; right: 0px; top: 0px; z-index: 0;">
    <img src="/res/content/partenaires/logo_region.jpg" height="80">
    <img src="/res/content/partenaires/logo_gironde.jpg" height="80">
    <img src="/res/content/partenaires/logo_FSE.jpg" height="80">
  </div>
</nav>