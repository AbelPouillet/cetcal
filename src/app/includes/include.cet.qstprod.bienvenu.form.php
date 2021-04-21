<!-- login & signup html forms -->
<div class="cet-module row justify-content-lg-center" id="cet-qstprod_intro" style="margin-bottom: 20px; display: none;">
  <div class="col-lg-9">
    <div class="alert alert-light cet-borderless-alert" role="alert" style="color: rgb(50,70,50);">
      <h4 class="alert-heading">Bienvenue Producteur.e.s !</h4>
      <p><?= CetQstprodConstTextes::login_intro_block_textinf_e; ?></p>
      <p>
        <a class="btn btn-danger cet-navbar-btn-infos" 
          href="/src/app/controller/cet.qstprod.controller.login.form.php"
          style="font-family: 'Courgette', cursive; color: white !important; font-size: 18px;">
          S'inscrire sur l'annuaire des Producteur.e.s
        </a>
      </p>
      <p><?= CetQstprodConstTextes::login_intro_block_textinf_d; ?></p>
      <p class="intro-prd-lire-plus"><?= CetQstprodConstTextes::login_intro_block_textinf_a; ?></p>
      <p class="intro-prd-lire-plus"><?= CetQstprodConstTextes::login_intro_block_textinf_b; ?></p>
      <p class="intro-prd-lire-plus"><?= CetQstprodConstTextes::login_intro_block_textinf_c; ?></p>
    </div>
  </div>
</div>