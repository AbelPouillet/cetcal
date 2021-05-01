<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/?" style="color: #009c31 !important; font-family: 'Signika' !important; font-weight: 
  bold;">
    DECIDELABIOLOCALE.ORG
  </a>
  <button class="navbar-toggler margin-80-infeq-700" id="cet-navbar-hamburger" type="button" data-toggle="collapse" 
    data-target=".navbar-cet-qstprod" aria-controls="navbar-cet-qstprod" 
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse collapse w-100 navbar-cet-qstprod">
    <ul class="navbar-nav mr-auto">
      <?php if (!in_array($statut, CetQstProdFilArianneHelper::$states)): ?>
        <li class="nav-item">
          <a id="cet-inscription-producteur" class="btn cet-navbar-btn" style="white-space: nowrap !important;" 
            href="#"><i class="fas fas fa-globe-europe fa-lg"></i>&#160;&#160;Je suis Producteur.e</a>
        </li>
      <?php endif; ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle cet-p" href="#" id="navbar-qui-nous-sommes-dropdown" 
          role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Qui sommes nous ?    
        </a>
        <div class="dropdown-menu" aria-labelledby="navbar-qui-nous-sommes-dropdown">
          <a class="dropdown-item" href="http://castillonnaisentransition.org/" target="_blank">
            - L'association CET, à propos
          </a>
          <a class="dropdown-item" href="https://github.com/j-fish/cetcal" target="_blank">
            - Notre projet sur GitHub
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a id="cet-notre-projet" class="nav-link cet-p" href="#"
          style="white-space: nowrap !important;">
          <i class="fas fa-info-circle"></i>&#160;&#160;Notre projet décidelabiolocale.org
        </a>
      </li>
      <!-- PARTENAIRES -->
      <li class="nav-item">
        <a class="nav-link cet-p" href="/?statut=partenaires.liens&anr=true">
          <i class="fas fa-hands-helping"></i>&#160;&#160;&#160;Partenaires et liens utiles
        </a>
      </li>
    </ul>
  </div>
</nav>
<?php if (!in_array($statut, CetQstProdFilArianneHelper::$states)): ?>
  <?php include $PHP_INCLUDES_PATH.'navbar-entities/include.cet.qstprod.nav.leftpanel.php'; ?>
<?php endif; ?>
<div class="row justify-content-around">
  <div class="col-1 hidden-infeq-700"></div>
  <div id="w-100-infeq-700-div-id" class="col-8">
    <img class="img-fluid" src="/res/content/DCDL_biolocale_2.jpg" alt="">
  </div>
  <div class="col-2 my-auto hidden-infeq-700" align="center">
    <img class="float-left" src="/res/content/partenaires/logo_region.jpg" height="80">
    <img class="float-left" src="/res/content/partenaires/logo_gironde.jpg" height="80">
    <img class="float-left" src="/res/content/partenaires/logo_FSE.jpg" height="80">
  </div>
  <div class="col-1 hidden-infeq-700"></div>
</div>