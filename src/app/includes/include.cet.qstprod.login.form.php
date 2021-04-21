<!-- login & signup html forms -->
<div class="cet-module row justify-content-lg-center" id="cet-qstprod_intro" style="margin-bottom: 20px;">
  <div class="col-lg-6">
    <div class="alert alert-success cet-bienvenue-producteurs" role="alert">
      <h5 class="alert-heading">Bienvenue Producteur.e.s !</h5>
      <p><?= CetQstprodConstTextes::login_intro_block_textinf_e; ?></p>
      <p><a class="btn btn-success btn-block" href="/src/app/controller/cet.qstprod.controller.login.form.php" style="margin-top: 8px; background-color: #DD4215 !important; border: 1px solid #DD4215 !important;">S'inscrire sur l'annuaire</a></p>
      <p><?= CetQstprodConstTextes::login_intro_block_textinf_d; ?></p>
      <p><?= CetQstprodConstTextes::login_intro_block_textinf_a; ?></p>
      <p><?= CetQstprodConstTextes::login_intro_block_textinf_b; ?></p>
      <p><?= CetQstprodConstTextes::login_intro_block_textinf_c; ?></p>
      <?php include $PHP_INCLUDES_PATH.'include.cet.qstprod.carousel.php'; ?>
    </div>
  </div>
</div>

<div class="cet-module row justify-content-lg-center" id="cet-qstprod_seconnecter" style="display: none; margin-bottom: 60px;">
  <div class="col-lg-5"> 
    <div class="alert alert-success" role="alert">
      <h5 class="alert-heading">Bienvenue Producteurs !</h5>
      <form class="form" action="/src/app/controller/cet.qstprod.controller.login.form.php" method="post">
        <label>Veuillez renseigner votre identifiant et mot de passe :
          <small class="form-text text-muted" style="margin-top: 2px;"><?= CetQstprodConstLibelles::lib_general_entete_garantit; ?><br>
            <a href="#"><?= CetQstprodConstLibelles::lib_general_entete_donnees; ?></a>
          </small>
        </label>
        <div class="input-group mb-3">
          <input class="form-control" name="qstprod-email" id="qstprod-email" type="text" placeholder="Email, n°de téléphone ou identifiant" aria-label="email ou identifiant">
        </div>
        <div class="input-group mb-3">
          <input class="form-control" name="qstprod-motdepasse" id="qstprod-motdepasse" type="password" placeholder="Mot de passe" aria-label="Mot de passe">
        </div>
        <button class="btn btn-primary btn-block" type="submit" style="margin-top: 8px;">Se connecter</button>  
      </form>
      <small class="form-text text-muted" style="margin-top: 12px;">
          <a href="#"> - J'ai oublié mon mot de passe.</a><br>
          <a href="#"> - J'ai perdu mon identifiant de connexion.</a><br>
          <a href="/src/app/controller/cet.qstprod.controller.login.form.php"> - Producteur, je souhaite m'inscrire et être référencé.</a></small>
    </div>
  </div>
</div>