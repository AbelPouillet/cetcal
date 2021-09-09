<div class="modal fade" tabindex="-1" id="modal-cet-recherche-avancee" 
  role="dialog" style="display: none;">
  <div class="modal-dialog modal-lg" role="document" style="max-width: 80% !important;">
    <div class="modal-content">
      <div class="modal-body">

        <div class="mb-3 row">
          <label for="rav-commune" class="col-sm-2 col-form-label">Commune</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="rav-commune" name="rav-commune" placeholder="autour de vous ou commune">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="rav-critere" class="col-sm-2 col-form-label">Critère</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="rav-critere" name="rav-critere" placeholder="nom, produit, adresse etc...">
          </div>
        </div>
        
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Rechercher</button> 
      </div>
    </div>
  </div>
</div>
<button type="button" class="btn btn-success" id="modal-cet-recherche-avancee-btn" data-toggle="modal" data-target="#modal-cet-recherche-avancee" hidden="hidden"></button>