<div id="zone-homepage-recherche-avancee" style="display:none;"> 
  <div class="row">
    <div class="col">

      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text cet-rav-input-group-text" id="cet-annuaire-recherche-communes-value">Commune : </div>
        </div>
        <div id="cet-annuaire-recherche-communes-conatiner">
          <input type="text" class="typeahead" placeholder="Rechercher votre commune" 
            id="cet-annuaire-recherche-communes-value" 
            name="cet-annuaire-recherche-communes-value" 
            aria-describedby="rav-rayon-text"
            style="padding: 8px;" />
        </div>
        <div class="input-group-append">
          <div class="input-group-text cet-rav-input-group-text" id="rav-rayon-text">dans un rayon de : </div>
        </div>
        <div class="input-group-append">
          <select class="form-select" id="rav-rayon" name="rav-rayon" style="padding: 8px;">
            <option value="5">5 km</option>
            <option value="10" selected="selected">10 km</option>
            <option value="20">20 km</option>
            <option value="30">30 km</option>
            <option value="40">40 km</option>
          </select>
        </div>
      </div>

      <br>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text cet-rav-input-group-text" for="categories-rav-dropdown-container">Catégories : </div>
        </div>
        <div class="dropdown categories-rav-dropdown" id="categories-rav-dropdown-container">
          <button class="btn btn-small btn-success dropdown-toggle" type="button" id="rav-categories" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onmousedown="$('#categories-rav-dropdown-container').dropdown('toggle');" style="border-radius: 0px; padding: 8px;">
            <span style="font-size: 14px;">Sélectionner des catégories</span>
          </button>
          <div class="dropdown-menu" aria-labelledby="rav-categories">
            <?php $categoriesCount = 0; ?>
            <?php foreach ($listes_arrays->activites as $activite): ?>
              <div class="form-check dropdown-item rav-categories-checkbox-div">
                <input class="form-check-input rav-categories-checkbox" type="checkbox" 
                  value="<?= implode(';', $activite); ?>" data-type="producteur"
                  id="<?= ++$categoriesCount; ?>" onmousedown="$(this).prop('checked', !$(this).is(':checked'));">
                <label for="<?= $categoriesCount; ?>"
                  onmousedown="$('#' + '<?= $categoriesCount; ?>').prop('checked', !$('#' + '<?= $categoriesCount; ?>').is(':checked'));">
                  <?= $activite[1]; ?>
                </label>
              </div>
            <?php endforeach; ?>
            <div class="form-check dropdown-item">
              <button class="btn btn-small btn-success" type="button" 
                onmousedown="$('#categories-rav-dropdown-container').dropdown('hide');">
                <span style="font-size: 14px;">Valider la sélection</span>
              </button>
            </div>
          </div>
        </div>
      </div>

      <br>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text cet-rav-input-group-text" id="rav-critere">Critère : </div>
        </div>
        <input class="form-select" type="text" id="rav-critere" name="rav-critere" 
          placeholder="nom, produit, adresse etc..." style="padding: 8px;">        
      </div>

      <div class="form-group mb-3" style="margin: 4px; margin-top: 8px;">
        <button type="button" class="btn btn-link btn-sm" 
          style="margin-left: 10px;"
          onmousedown="$('#autres-criteres-rav').toggle('slow');"><i class="fas fa-angle-double-right"></i> Autres critères de recherches :
        </button>
      </div>


      <div id="autres-criteres-rav" style="display:none;">

        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text cet-rav-input-group-text" id="cet-annuaire-recherche-produits-conatiner">Produits : </div>
          </div>
          <div id="cet-annuaire-recherche-produits-conatiner">
            <input type="text" class="typeahead" placeholder="rechercher..." 
              aria-label="" 
              id="cet-annuaire-recherche-produits-value" 
              name="cet-annuaire-recherche-produits-value"
              style="padding: 8px;">
          </div>
          <div class="input-group-append">
            <button type="button" id="rav-produit-ajouter" class="btn btn-success btn-sm">ajouter ce produit</button>
          </div>
        </div>
        <div id="rav-produits-selected"></div>

        <br>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text cet-rav-input-group-text" id="rav-certification">Certification : </div>
          </div>
          <select class="form-select" id="rav-certification" name="rav-certification" style="padding: 12px;">
            <option value="0" selected="selected">-- Aucune certification sélectionnée --</option>
            <option value="BIOAB">certifié Agriculture-Biologique</option>
            <option value="YTENDANT">agriculture éthique (non certifié BIO/AB)</option>
            <!--<option value="ENCOURSBIOAB">en cours de certification AB</option>-->
          </select>
        </div>
        <br>

        <div hidden="hidden">
          <br>
          Modes de vente
          <select id="rav-modevente" name="rav-modevente">
            <option value="0" selected="selected">-- Aucun mode de vente sélectionné --</option>
          </select>
          <button type="button" class="btn btn-success btn-sm">ajouter</button>
        </div>

      </div>

      <div class="form-group mb-3">
        <button id="rav-envoi-recherche-avancee" 
          type="button" class="btn btn-success">Rechercher</button>
      </div>

    </div>
  </div>
</div>