<div id="zone-homepage-recherche-searchbar"> 
  <div class="row align-items-start no-gutters" id="zone-homepage-recherche-searchbar-container">
    
    <div class="col-md-auto">
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
          <div class="input-group-text cet-rav-input-group-text" id="rav-rayon-text">dans un rayon de</div>
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
    </div>

    <div class="col-md-auto">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text cet-rav-input-group-text">Critère : </div>
        </div>
        <input class="form-select" type="text" id="rav-critere" name="rav-critere" 
          placeholder="nom, produit, adresse etc..." style="padding: 8px;">
        <div class="input-group-append">
          <button class="btn text-center" id="rav-homepage-envoyer" style="background-color: #de4317; color: white;">Rechercher</button>
          <a class="btn text-center" style="background-color: #de4317; color: white;" href="/?statut=recherche.avancee&anr=true" id="afficher-recherche-avancee">Recherche avancée</a>
        </div>
      </div>
    </div>

  </div>
</div>