<!-- Fil d'Arianne -->
<div class="row justify-content-lg-center">
  <div class="col-lg-6 align-middle">
    <div class="alert alert-light alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <label class="align-middle">
        <small class="form-text text-muted">
          <?= CetQstProdFilArianneHelper::$prefix_fa; ?>
        </small>
      </label>
      <?= CetQstProdFilArianneHelper::update($statut); ?>
    </div>
  </div>
</div>