<?php
/**
 * Sql query's.
 */
class CETCALQueryLibrary
{

  const INSERT_QSTPROD_PRODUCTEUR = "INSERT INTO cetcal.cetcal_producteur (nom, prenom, email, email_bu, mdpsha, telfixe, telport, nom_ferme, siret, adrferme_numvoie, adrferme_rue, adrferme_lieudit, adrferme_commune, adrferme_cp, adrferme_compladr, pageurl_fb, pageurl_ig, pageurl_twitter, url_web, url_boutique, orgcertifbio, surfacehectterres, surfacesousserre, tetes_betail, hl_par_an, groupe_cagette, identifiant_cet, opinions) VALUES (:pNom, :pPrenom, :pEmail, :pEmailBu, :pMdpsha, :pTelfixe, :pTelPort, :pNomFerme, :pSiret, :pAdrNumvoie, :pAdrRue, :pAdrLieudit, :pAdrCommune, :pAdrcp, :pAdrCmpladr, :pPageFb, :pPageIg, :pPageTwitter, :pUrlWeb, :pUrlBoutique, :pOrgCertifBio, :pSurfaceHectTerres, :pSurfaceAresSerre, :pNbrTetes, :pHLParAn, :pGroupeCagette, :pIndentifiantCet, :pOpinions);";
  const SELECT_ALL_ID_CET_PRODUCTEUR = "SELECT identifiant_cet FROM cetcal.cetcal_producteur;";
  const SELECT_ALL_CET_PRODUCTEUR = "SELECT * FROM cetcal.cetcal_producteur where email != 'thomashenrywarner@gmail.com';";

  const INSERT_CETCAL_TYPEPRODUCTION = "INSERT INTO cetcal.cetcal_type_production (clef_type_production, val_type_production, fk_producteur_type_production) VALUES (:pClef, :pVal, :pPkProducteur);";

  const INSERT_CETCAL_SPECIFICITE_PRODUITS = "INSERT INTO cetcal.cetcal_specificite_produits (clef_specificite, val_specificite, fk_producteur_specificites_produits) VALUES (:pClef, :pVal, :pPkProducteur);";

  const INSERT_CETCAL_MODE_CONSO = "INSERT INTO cetcal.cetcal_mode_conso (clef_mode_conso, val_mode_conso, fk_producteur_mode_conso) VALUES (:pClef, :pVal, :pPkProducteur);";

  const INSERT_CETCAL_LIEU = "INSERT INTO cetcal.cetcal_lieu (nom, adresse_literale, jour_producteur, jour_collecte_conso) VALUES (:pNom, :pAdrLit, :pJoursProducteur, :pJourCollecteConso);";
  const INSERT_PRODUCTEUR_JOIN_LIEU = "INSERT INTO cetcal.producteur_join_lieu (fk_producteur_join, fk_lieu) VALUES (:pFkProducteur, :pFkLieu);";

  const INSERT_CETCAL_PRODUIT = "INSERT INTO cetcal.cetcal_produit (nom, categorie) VALUES (:pNom, :pCategorie);";
  const INSERT_PRODUCTEUR_JOIN_PRODUITS = "INSERT INTO cetcal.producteur_join_produits (fk_producteur_join, fk_produits_join) VALUES (:pFkProducteur, :pFkProduit);";

  const INSERT_SONDAGE = "INSERT INTO cetcal.cetcal_sondage (fk_producteur_sondage, clef_question, reponse) VALUES (:pPkProducteur, :pClefQuestion, :pReponse);";
  const INSERT_SONDAGE_NBRS = "INSERT INTO cetcal.cetcal_sondage (fk_producteur_sondage, clef_question, val_question, reponse) VALUES (:pPkProducteur, :pClefQuestion, :pValQuestion, :pReponse);";
  const INSERT_CETCAL_INFORMATION = "INSERT INTO cetcal.cetcal_information_producteur (fk_producteur_information_producteur, clef_information, information) VALUES (:pPkProducteur, :pClefInformation, :pInformation);";

  const SELECT_COUNT_CRT_WHERE_PKFK = "SELECT count(fk_producteur) FROM cetcal.cetcal_cartographie WHERE fk_producteur=:pFkProducteur;";
  const INSERT_CETCAL_CARTOGRAPHIE = "INSERT INTO cetcal.cetcal_cartographie (cetcal_prd_lat, cetcal_prd_lng, fk_producteur) VALUES (:pLat, :pLng, :pFkProducteur);";
  const SELECT_CETCAL_CARTOGRAPHIE_WHERE_PKFK = "SELECT * FROM cetcal.cetcal_cartographie WHERE fk_producteur=:pFkProducteur;";

  const INSERT_INTO_CETCAL_ENTITES = "INSERT INTO cetcal.cetcal_entite (denomination, territoire, activite, adresse, tels, personne, email, urlwww, infoscmd, jourhoraire, specificites) VALUES (:pDenomination, :pTerritoire, :pActivite, :pAdrliterale, :pTels, :pContactPersonne, :pEmail, :pUrlwww, :pInfoCommande, :pJourHoraire, :pSpecificite);";
  const INSERT_INTO_CETCAL_ENTITES_MARCHE = "INSERT INTO cetcal.cetcal_entite (denomination, activite, adresse, infoscmd, jourhoraire, specificites) VALUES (:pDenomination, :pActivite, :pAdrliterale, :pInfoCommande, :pJourHoraire, :pSpecificite);";
  const SELECT_ALL_CETCAL_ENTITE = "SELECT * from cetcal.cetcal_entite;";
  const SELECT_ALL_CETCAL_ENTITE_NOT_MARCHE = "SELECT * from cetcal.cetcal_entite WHERE activite != 'marche du castillonnais';";
  const SELECT_ALL_CETCAL_ENTITE_IS_MARCHE = "SELECT * from cetcal.cetcal_entite WHERE activite='marche du castillonnais';";
  const SELECT_PK_CETCAL_ENTITE_BY_DENOMINATION = "SELECT * FROM cetcal.cetcal_entite WHERE denomination=:pDenomination;";
}