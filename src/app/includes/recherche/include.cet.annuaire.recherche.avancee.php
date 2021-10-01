<div id="zone-homepage-recherche-avancee" style="display:none; margin: 12px;">

  <div id="cet-annuaire-recherche-communes-conatiner">
    Commune
    <input type="text" class="typeahead" placeholder="rechercher..." 
      aria-label="" 
      id="cet-annuaire-recherche-communes-value" 
      name="cet-annuaire-recherche-communes-value">
  </div>

  <br>
  Dans un rayon de 
  <select id="rav-rayon" name="rav-rayon" style="display:none;">
    <!-- <option value="0">-- aucun rayon --</option> -->
    <option value="5">5 km</option>
    <option value="10" selected="selected">10 km</option>
    <option value="20">20 km</option>
    <option value="30">30 km</option>
    <option value="40">40 km</option>
  </select>

  <br>
  Catégories
  <select id="rav-categorie" name="rav-categorie">
    <option value="0" selected="selected">-- Aucune catégorie sélectionnée --</option>
    <?php foreach ($listes_arrays->activites as $activite): ?>
      <option value="<?= implode(';', $activite); ?>" data-type="producteur">
        <?= $activite[1]; ?>
      </option>
    <?php endforeach; ?>
  </select>
  <button type="button" id="rav-categorie-ajouter" class="btn btn-success btn-sm">ajouter</button>
  <div id="rav-categorie-selected"></div>

  <br>
  Critère
  <input type="text" id="rav-critere" name="rav-critere" placeholder="nom, produit, adresse etc...">

  <br>
  <button type="button" class="btn btn-light btn-sm" 
  style="margin-left: 10px;"
  onmousedown="$('#autres-criteres-rav').toggle();"><b>> </b> Autres critères</button>

  <div id="autres-criteres-rav" style="display:none;">
    <div id="cet-annuaire-recherche-produits-conatiner">
      Produits
      <input type="text" class="typeahead" placeholder="rechercher..." 
        aria-label="" 
        id="cet-annuaire-recherche-produits-value" 
        name="cet-annuaire-recherche-produits-value">
        <button type="button" id="rav-produit-ajouter" class="btn btn-success btn-sm">ajouter</button>
    </div>
    <div id="rav-produits-selected"></div>
    
    <br>
    Certification
    <select id="rav-certification" name="rav-certification">
      <option value="0" selected="selected">-- Aucune certification sélectionnée --</option>
      <option value="BIOAB">certifié Agriculture-Biologique</option>
      <option value="YTENDANT">agriculture éthique (non certifié BIO/AB)</option>
      <!--<option value="ENCOURSBIOAB">en cours de certification AB</option>-->
    </select>

    <div hidden="hidden">
      <br>
      Modes de vente
      <select id="rav-modevente" name="rav-modevente">
        <option value="0" selected="selected">-- Aucun mode de vente sélectionné --</option>
      </select>
      <button type="button" class="btn btn-success btn-sm">ajouter</button>
    </div>
  </div>

  <!--
  <br>
  <input type="checkbox" id="inclure-entites-rav" name="inclure-entites-rav" value="oui">
  Inclure les éléments annexes à proximité dans votre recherche (marchés, lieux de vente, magasins, associations etc)
  -->

  <br>
  <button id="rav-envoi-recherche-avancee" 
  type="button" class="btn btn-success btn-sm" >Rechercher</button> 
</div>