<div class="row justify-content-lg-center" id="cet-qstprod_seconnecter" style="display: none;">
  <div class="col-lg-9"> 
    <div class="alert alert-success" role="alert">
      <form action="/src/app/controller/cet.qstprod.controller.login.form.php" method="post"
        style="margin-bottom: 18px;">
        <div class="row">
          <div class="col-sm" style="padding-top: 18px;"> 
            <h5>Veuillez renseigner votre identifiant et mot de passe.</h5>
            <label>
              <small class="form-text text-muted" style="margin-top: 2px;"><?= CetQstprodConstLibelles::lib_general_entete_garantit; ?><br>
                <a href="#" class="cet-conditions-donnees-numerique"><?= CetQstprodConstLibelles::lib_general_entete_donnees; ?></a>
              </small>
            </label>
            <br>
            <a href="#" style="margin-top: 12px;" onmousedown="$('#zone-oubli-login').toggle('slow');"> - J'ai oublié mon mot de passe et/ou mon identifiant.</a><br>
            <a href="#" onmousedown="$('#login-nav').val('prd'); $('#cet-qstprod_seconnecter').find('form').submit();"> - Producteur, je souhaite m'inscrire et être référencé.</a>
            
            <div id="zone-oubli-login" style="display: none; margin-bottom: 12px;">
              <small class="form-text text-muted" style="margin-left: 6px; margin-top: 6px;">Si vous avez effectué votre inscription avec votre adresse email, une solution vous sera envoyée.<b>Si vous êtes producteur et vous n'avez renseigné aucune information de contact (email, ou n° de téléphone mobil) alors l'équipe de cetcal prendra rapidement contact avec vous.</b> Dans ce cas, <b>veuillez cocher la case, <u>je suis producteur référencé et souhaite être contacté.</u></b> et renseigner votre adresse email <b>ainsi que votre numéro</b> de téléphone.</small>
              <br>
              <div class="input-group mb-3">
                <input class="form-control" name="login-oublie-email" id="login-oublie-email" type="text" placeholder="Entrez votre adresse email" aria-label="">
              </div>
              <!--
              <div class="input-group mb-3">
                <input class="form-control" name="login-oublie-telport" id="login-oublie-telport" type="text" placeholder="Entrez votre numéro de téléphone portable" aria-label="">
              </div>
              -->
              <div class="form-check">
                <input class="form-check-input" name="login-oublie-jesuisproducteur" 
                  id="login-oublie-jesuisproducteur" type="checkbox" value="jesuisproducteur">
                <label class="form-check-label" for="login-oublie-jesuisproducteur">
                  je suis producteur BIO référencé dans l'annuaire cetcal et je souhaite être contacté.
                </label>
              </div>
              <button class="btn btn-warning btn-block" type="submit" 
                style="margin-top: 8px; font-family: 'Courgette', cursive;"
                onmousedown="$('#login-nav').val('obl');"><i class="fas fa-sign-in-alt"></i>&#160;&#160;&#160;Envoyer ma demande</button>
            </div>

          </div>
          <div class="col-sm"> 
            <small class="form-text text-muted" style="margin-left: 6px;">Votre identifiant correspond à l'email utilisé pour l'inscription ou bien l'identifiant qui vous a été fourni spécifiquement en fin d'inscription :</small>
            <div class="input-group mb-3">
              <input class="form-control" name="login-email" id="login-email" type="text" placeholder="Votre adresse email ou identifiant" aria-label="email ou identifiant">
            </div>
            <small class="form-text text-muted" style="margin-left: 6px;">Veuillez saisir votre mot de passe :</small>
            <div class="input-group mb-3">
              <input class="form-control" name="login-motdepasse" id="login-motdepasse" 
                type="password" placeholder="Mot de passe" aria-label="Mot de passe">
            </div>
            <button class="btn btn-info btn-block" type="submit" 
              style="margin-top: 8px; font-family: 'Courgette', cursive;"
              onmousedown="$('#login-nav').val('cnx');"><i class="fas fa-sign-in-alt"></i>&#160;&#160;&#160;Se connecter</button>
          </div>
        </div>

        <input type="text" name="login-nav" value="" id="login-nav" hidden="hidden">
      </form>
    </div>
  </div>
</div>