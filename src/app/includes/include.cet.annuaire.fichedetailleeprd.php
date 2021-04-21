<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/app/controller/cet.annuaire.controller.fichedetaillee.producteur.php');
$pk = $_GET['pkPrd'];
$controller = new CETCALAnnuaireFicheDetailleController();
$data = $controller->fetchProducteurByPk($pk);
$lieux = $controller->fetchLieuByPkProducteur($pk);
$produits = $controller->fetchProduitByPkProducteur($pk);
$ProductsCategories = $controller->fetchCategorieProduitByPkProducteur($pk);

?>
<div class="container hero--container pt-5">
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Fonctionnalité en cours de réalisation</h4>
        <p>Page prototype</p>
        <hr>
    </div>
    <div class="row">

        <div class="col-4 text-center fiche--producteur">

            <img class="logo--producteur" src="https://via.placeholder.com/150">
            <h1 class="mt-5"> <?= $data['nom_ferme'] ? $data['nom_ferme'] : "" ?></h1>
            <hr>
            <h3 class="producteur--name"><?= $data['prenom']?></h3>
            <h3><?= $data['nom']?></h3>
            <hr>
                <?= $data['telport'] ? "<p>".$data['telport']."</p>" : ""?>
                <?= $data['telfixe'] ? "<p>".$data['telfixe']."</p>" : ""?>
            <p><?= $data['adrferme_numvoie'] ? "<span>". $data['adrferme_numvoie'] . " " . $data['adrferme_rue'] . "</span>" : "<span>" . $data['adrferme_rue'] . "</span>"?> <?= $data['adrferme_lieudit'] ? "<span>".$data['adrferme_lieudit'] . "</span>" : ""?>
                <?= $data['adrferme_commune']?>
                <?= $data['adrferme_cp']?>
            </p>
<!--            <p>Commune: <?/*= $data['adrferme_commune']*/?></p>
-->           <!-- <p>Code postal : <?/*= $data['adrferme_cp']*/?></p>-->
           <?= $data['url_web'] ? "<a href=".$data['url_web'].">"."site web </a>" : " " ?>
            <hr>
            <?= $data['url_boutique'] ? "<a href=".$data['url_boutique'].">"."Boutique en ligne </a>" : " " ?>
            <?= $data['pageurl_fb'] ? "<a href=".$data['pageurl_fb']." class='d-block mt-1'>"."Facebook </a>" : " " ?>
            <?= $data['pageurl_ig'] ? "<a href=".$data['pageurl_ig']." class=' d-block mt-1'>"."Instagram </a>" : " " ?>
            <?= $data['pageurl_twitter'] ? "<a href=".$data['pageurl_twitter']." class=' d-block mt-1'>"."Twitter </a>" : " " ?>
            <?= $data['groupe_cagette'] ? "<a href=".$data['groupe_cagette']." class=' d-block mt-1'>"."groupe cagette </a>" : " " ?>
        </div>

        <div class="col-8">
            <div class="text-center">
                <img class="photo-producteur" src="https://via.placeholder.com/450/450" alt="placeholder">
            </div>

            <div class="pl-5 mt-3 categorie--producteur mt-5">

                <?php foreach ($ProductsCategories as $categorie): ?>
                    <span class="badge badge-pill badge-primary"><?= $categorie->categorie ?></span>
                <?php endforeach;?>
            </div>
            <div class="pl-5 mt-3 produit--producteur">

                <?php foreach ($produits as $produit): ?>
                    <span class="cet-qstprod-produit-type <?= $produit->categorie . "s" ?>"><?= $produit->nom ?></span>
                <?php endforeach;?>
            </div>
            <div class="d-inline-flex ">
                <?= $data['surfacehectterres'] || $data['surfacesousserre'] || $data['tetes_betail'] || $data['hl_par_an'] ? " <div class=\" col-8 mt-5 presentation--producteur text-center\" style=\"border: solid 1px;border-radius: 25px;\">" : " " ?>
                    <?= $data['surfacehectterres'] || $data['surfacesousserre'] || $data['tetes_betail'] || $data['hl_par_an'] ? "<h3>Production</h3>" : " " ?>
                    <?= $data['surfacehectterres'] ? "<p>". "Surface hectares terres : " .  $data['surfacehectterres'] . "</p>" : " " ?>
                    <?= $data['surfacesousserre'] ? "<p>".  "Surface hectares sous serre : " . $data['surfacesousserre'] . "</p>" : " " ?>
                    <?= $data['tetes_betail'] ? "<p>".  "tetes betail : " . $data['tetes_betail'] . "</p>" : " " ?>
                    <?= $data['hl_par_an'] ? "<p>".  "Hectolitres par an : " . $data['hl_par_an'] . "</p>" : " " ?>
                    <?= $data['surfacehectterres'] || $data['surfacesousserre'] || $data['tetes_betail'] || $data['hl_par_an'] ? " </div>" : " " ?>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="container">
            <div class="col-12">
                <table class="table mt-5">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Point de vente</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Jour</th>
                        <th scope="col">Heures</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lieux as $lieu): ?>
                        <tr>
                            <th scope="row"></th>
                            <td><?= $lieu->nom ?></td>
                            <td><?= $lieu->adresse_literale ?></td>
                            <td><?= $lieu->jour_producteur ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
