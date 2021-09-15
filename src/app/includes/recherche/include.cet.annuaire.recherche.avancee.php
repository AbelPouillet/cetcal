<div class="modal fade" tabindex="-1" id="modal-cet-recherche-avancee" 
  role="dialog" style="display: none;">
  <div class="modal-dialog modal-lg" role="document" style="max-width: 80% !important;">
    <div class="modal-content">
      <div class="modal-body">

        Commune <input type="text" id="rav-commune" name="rav-commune" placeholder="autour de vous ou commune">

        <br>
        Dans un rayon de 
        <select id="rav-rayon" name="rav-rayon">
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
            <option value="<?= implode(';', $activite); ?>"><?= $activite[1]; ?></option>
          <?php endforeach; ?>
        </select>
        <button type="button" class="btn btn-success btn-sm">ajouter</button>

        <br>
        Critère
        <input type="text" id="rav-critere" name="rav-critere" placeholder="nom, produit, adresse etc...">

        <br>
        <button type="button" class="btn btn-light btn-sm" 
        style="margin-left: 10px;"
        onmousedown="$('#autres-criteres-rav').toggle();"><b>> </b> Autres critères</button>

        <div id="autres-criteres-rav" style="display:none;">
          Produits <input type="text" id="rav-produits" name="rav-produits" placeholder="">
          <button type="button" class="btn btn-success btn-sm">ajouter</button>
          
          <br>
          Certification
          <select id="rav-certification" name="rav-certification">
            <option value="0" selected="selected">-- Aucune certification sélectionnée --</option>
            <option value="BIOAB">certifié Agriculture-Biologique</option>
            <option value="YTENDANT">agriculture éthique (non certifié BIO/AB)</option>
            <option value="ENCOURSBIOAB">en cours de certification AB</option>
          </select>

          <br>
          Modes de vente
          <select id="rav-modevente" name="rav-modevente">
            <option value="0" selected="selected">-- Aucun mode de vente sélectionné --</option>
          </select>
          <button type="button" class="btn btn-success btn-sm">ajouter</button>
        </div>

        <br>
        <input type="checkbox" id="inclure-entites-rav" name="inclure-entites-rav" value="oui" checked="true">
        Inclure les éléments annexes dans la recherche (marchés, lieux de vente, magasins, associations etc)

        <br>
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Rechercher</button> 
      </div>
    </div>
  </div>
</div>
<button type="button" class="btn btn-success" id="modal-cet-recherche-avancee-btn" data-toggle="modal" data-target="#modal-cet-recherche-avancee" hidden="hidden"></button>