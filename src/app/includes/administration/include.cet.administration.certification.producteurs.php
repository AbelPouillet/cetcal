<div id="cet-admin-bioab-accordion">
  <div class="card cet-accordion-admin cet-bloc">
    <div class="card-header" id="cet-admin-bioab-heading">
      <label class="cet-formgroup-container-label"><small class="form-text">
        Cette section vous aidera à valider la certification BIO/AB pour un producteur donné.
      </small></label>
      <h5 class="mb-0">
        <a class="badge badge-success cet-accordion-badge" href="#" data-toggle="collapse" data-target="#cet-admin-bioab" aria-expanded="true" aria-controls="cet-admin-bioab">
            Certifier un producteur.
        </a>
        <a class="align-middle" href="#" data-toggle="collapse" 
            data-target="#cet-admin-bioab" aria-expanded="true" 
            aria-controls="cet-admin-bioab">
            <i id="cet-accordion-icon-admin-main-1" class="fa fa-hand-o-down cet-accordion-icon"></i>
        </a>
      </h5>
    </div>

    <!-- Bloc collasable -->
    <div id="cet-admin-bioab" class="collapse cet-bloc" aria-labelledby="cet-admin-bioab-heading" 
      data-parent="#cet-admin-bioab-accordion">
      <!-- Formulaire de certification BIO/AB -->
      <div class="card-body cet-accordion-admin-critique cet-bloc">
        <form class="form" action="/src/app/controller/cet.annuaire.controller.administration.actions.php?sitkn=<?=$cetcal_session_id;?>" method="post">
          <!-- le premier input hidden déffini l'action, en dure. -->
          <input name="admin_action_cible" id="admin_action_cible" type="text" hidden="hidden" value="certif-bioab-prd">
          <!-- contenu du formulaire, reflet de la table cetcal_entite pour les entites -->
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Numéro producteur decidelabiolocale.ord : </small></label>
            <input class="form-control" name="producteur-bioab-pk" type="number" value="" maxlength="8">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">URL de la page de certification BIO/AB : </small></label>
            <input class="form-control" name="producteur-bioab-url-org" type="text" value="" maxlength="1024">
          </div>
          <div class="form-group mb-3">
            <label class="cet-input-label"><small class="cet-qstprod-label-text">Numéro ou matricule de certification (lié à l'organise certifiante) : </small></label>
            <input class="form-control" name="producteur-bioab-numcertif" type="text" value="" maxlength="128">
          </div>
          <!-- END contenu du formulaire -->
          <button class="btn cet-navbar-btn" id="btn-admin-ajout-certif-bioab" type="submit" 
            style="float: right; margin-right: 4px;">
            Certifier ce producteur BIO/AB
          </button>
        </form>
      </div>
    </div>
    <!-- END Bloc collasable -->
  </div>
</div>