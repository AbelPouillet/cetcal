<div id="zone-homepage-recherche-avancee" class="row justify-content-lg-center">
  <div class="cet-formgroup-container">
  
    <div class="col-lg-6">
      <div id="cet-annuaire-recherche-communes-conatiner">
        <label class="cet-input-label"><small class="cet-qstprod-label-text">Commune :</small></label>
        <input type="text" class="typeahead" placeholder="Rechercher votre commune" 
          id="cet-annuaire-recherche-communes-value" 
          name="cet-annuaire-recherche-communes-value" />
      </div>
    </div>

    <div class="col-lg-6" style="margin-top: 6px;">
      <label class="cet-input-label"><small class="cet-qstprod-label-text">Dans un rayon de :</small></label>
      <select class="form-select" id="rav-rayon" name="rav-rayon" style="display:none;">
        <!-- <option value="0">-- aucun rayon --</option> -->
        <option value="5">5 km</option>
        <option value="10" selected="selected">10 km</option>
        <option value="20">20 km</option>
        <option value="30">30 km</option>
        <option value="40">40 km</option>
      </select>
    </div>

    <div class="col-lg-6" style="margin-bottom: 12px;">
      <div class="dropdown categories-rav-dropdown" id="categories-rav-dropdown-container">
        <label class="cet-input-label"><small class="cet-qstprod-label-text">Catégories :</small></label>
        <button class="btn btn-small btn-success dropdown-toggle" type="button" id="rav-categories" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onmousedown="$('#categories-rav-dropdown-container').dropdown('toggle');">
          <span style="font-size: 14px;">Sélectionner des catégories</span>
        </button>
        <div class="dropdown-menu" aria-labelledby="rav-categories">
          <?php $categoriesCount = 0; ?>
          <?php foreach ($listes_arrays->activites as $activite): ?>
            <div class="form-check dropdown-item rav-categories-checkbox-div">
              <input class="form-check-input rav-categories-checkbox" type="checkbox" 
                value="<?= implode(';', $activite); ?>" data-type="producteur"
                id="<?= ++$categoriesCount; ?>" onmousedown="$(this).prop('checked', !$(this).is(':checked'));">
              <label class="form-check-label" for="<?= $categoriesCount; ?>"
                onmousedown="$('#' + '<?= $categoriesCount; ?>').prop('checked', !$('#' + '<?= $categoriesCount; ?>').is(':checked'));">
                <?= $activite[1]; ?>
              </label>
            </div>
          <?php endforeach; ?>
          <div class="form-check dropdown-item">
            <button class="btn btn-small btn-success" type="button" 
              onmousedown="$('#categories-rav-dropdown-container').dropdown('hide');">
              <span style="font-size: 14px;">Valider la/les sélection(s)</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <label class="cet-input-label"><small class="cet-qstprod-label-text">Critère :</small></label>
      <input class="form-select" type="text" id="rav-critere" name="rav-critere" placeholder="nom, produit, adresse etc...">
    </div>

    <div class="col-lg-6" style="margin-top: 6px; margin-bottom: 8px;">
      <button type="button" class="btn btn-link btn-sm" 
        style="margin-left: 10px;"
        onmousedown="$('#autres-criteres-rav').toggle();"><b>> </b> Autres critères de recherches :
      </button>
    </div>

    <div id="autres-criteres-rav" style="display:none;">
      <div class="col-lg-6" style="margin-bottom: 8px;">
        <div id="cet-annuaire-recherche-produits-conatiner">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Produits :</small></label>
          <input type="text" class="typeahead" placeholder="rechercher..." 
            aria-label="" 
            id="cet-annuaire-recherche-produits-value" 
            name="cet-annuaire-recherche-produits-value">
            <button type="button" id="rav-produit-ajouter" class="btn btn-success btn-sm" style="margin-top: 4px;">ajouter ce produit</button>
        </div>
        <div id="rav-produits-selected"></div>
      </div>

      <div class="col-lg-6">
        <label class="cet-input-label"><small class="cet-qstprod-label-text">Certification :</small></label>
        <select class="form-select" id="rav-certification" name="rav-certification">
          <option value="0" selected="selected">-- Aucune certification sélectionnée --</option>
          <option value="BIOAB">certifié Agriculture-Biologique</option>
          <option value="YTENDANT">agriculture éthique (non certifié BIO/AB)</option>
          <!--<option value="ENCOURSBIOAB">en cours de certification AB</option>-->
        </select>
      </div>

      <div hidden="hidden">
        <br>
        Modes de vente
        <select id="rav-modevente" name="rav-modevente">
          <option value="0" selected="selected">-- Aucun mode de vente sélectionné --</option>
        </select>
        <button type="button" class="btn btn-success btn-sm">ajouter</button>
      </div>
    </div>

    <div class="col-lg-6">
      <button id="rav-envoi-recherche-avancee" 
        type="button" class="btn btn-warning">Rechercher</button>
    </div>
  </div>
</div>