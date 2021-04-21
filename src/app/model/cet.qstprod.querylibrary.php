<?php
/**
 * Sql query's.
 */
class CETCALQueryLibrary
{

  const INSERT_QSTPROD_PRODUCTEUR = "INSERT INTO cetcal.cetcal_producteur (nom, prenom, email, email_bu, mdpsha, telfixe, telport, nom_ferme, siret, adrferme_numvoie, adrferme_rue, adrferme_lieudit, adrferme_commune, adrferme_cp, adrferme_compladr, pageurl_fb, pageurl_ig, pageurl_twitter, url_web, url_boutique, orgcertifbio, surfacehectterres, surfacesousserre, tetes_betail, hl_par_an, groupe_cagette, identifiant_cet, opinions, prod_inscrit) VALUES (:pNom, :pPrenom, :pEmail, :pEmailBu, :pMdpsha, :pTelfixe, :pTelPort, :pNomFerme, :pSiret, :pAdrNumvoie, :pAdrRue, :pAdrLieudit, :pAdrCommune, :pAdrcp, :pAdrCmpladr, :pPageFb, :pPageIg, :pPageTwitter, :pUrlWeb, :pUrlBoutique, :pOrgCertifBio, :pSurfaceHectTerres, :pSurfaceAresSerre, :pNbrTetes, :pHLParAn, :pGroupeCagette, :pIndentifiantCet, :pOpinions, :pProdInscrit);";
  const SELECT_ALL_ID_CET_PRODUCTEUR = "SELECT identifiant_cet FROM cetcal.cetcal_producteur;";
  const SELECT_ALL_EMAIL_PRODUCTEUR = "SELECT email FROM cetcal.cetcal_producteur;";
  const SELECT_ALL_CET_PRODUCTEUR = "SELECT * FROM cetcal.cetcal_producteur where email != 'thomashenrywarner@gmail.com' AND prod_active=1 AND prod_inscrit='true';";
  const SELECT_ALL_CET_PRODUCTEUR_N0N_INSCRIT = "SELECT * FROM cetcal.cetcal_producteur where email != 'thomashenrywarner@gmail.com' AND prod_active=1 AND prod_inscrit='false';";
  const SELECT_ALL_CET_PRODUCTEUR_INSCRITS_LIMIT_N = "SELECT * FROM cetcal.cetcal_producteur where email != 'thomashenrywarner@gmail.com' AND prod_active=1 AND prod_inscrit='true' ORDER BY pk_producteur DESC LIMIT :pLimit;";
  const SELECT_ALL_CET_PRODUCTEUR_INSCRIT_N0N_INSCRIT_ASC = "SELECT * FROM cetcal.cetcal_producteur where email != 'thomashenrywarner@gmail.com' AND prod_active=1 ORDER BY nom_ferme ASC;";
  const SELECT_ALL_CET_TYPE_PRODUCTION = "SELECT * FROM cetcal.cetcal_type_production WHERE fk_producteur_type_production=:pPk AND val_type_production != 'autre';";
  const SELECT_CETCAL_PRODUCTEUR_INSCRIT_BY_EMAIL_OR_IDWWWCET = "SELECT * FROM cetcal.cetcal_producteur where (email=:pEmail OR identifiant_cet=:pIdwwwcet) AND prod_inscrit='true';";
  const SELECT_PK_CETCAL_PRODUCTEUR_BY_EMAIL_AND_PWD_HASH = "SELECT * FROM cetcal.cetcal_producteur WHERE (email=:pEmail OR identifiant_cet=:pIdwwwcet) AND mdpsha=:pMdpHash;";
  const UPDATE_PRODUCTEUR_SESSION = "UPDATE cetcal.cetcal_producteur SET session_id=:pSessionId, producteur_ip=:pProducteurIp WHERE pk_producteur=:pPk;";
  const UPDATE_PRODUCTEUR_MOT_DE_PASSE = "UPDATE cetcal.cetcal_producteur SET mdpsha=:pMdpsha WHERE email=:pEmail;";


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
  const SELECT_COUNT_CRT_WHERE_PKFK_ENTITE= "SELECT count(fk_entite) FROM cetcal.cetcal_cartographie WHERE fk_entite=:pFkEntite;";
  const INSERT_CETCAL_CARTOGRAPHIE = "INSERT INTO cetcal.cetcal_cartographie (cetcal_prd_lat, cetcal_prd_lng, fk_producteur) VALUES (:pLat, :pLng, :pFkProducteur);";
  const INSERT_CETCAL_ENTITE_CARTOGRAPHIE = "INSERT INTO cetcal.cetcal_cartographie (cetcal_prd_lat, cetcal_prd_lng, fk_entite) VALUES (:pLat, :pLng, :pFkEntite);";
  const SELECT_CETCAL_CARTOGRAPHIE_WHERE_PKFK = "SELECT * FROM cetcal.cetcal_cartographie WHERE fk_producteur=:pFkProducteur;";
  const SELECT_CETCAL_CARTOGRAPHIE_WHERE_PKFK_ENTITE = "SELECT * FROM cetcal.cetcal_cartographie WHERE fk_entite=:pFkEntite;";

  const INSERT_INTO_CETCAL_ENTITES = "INSERT INTO cetcal.cetcal_entite (denomination, territoire, activite, adresse, tels, personne, email, urlwww, infoscmd, jourhoraire, specificites, type) VALUES (:pDenomination, :pTerritoire, :pActivite, :pAdrliterale, :pTels, :pContactPersonne, :pEmail, :pUrlwww, :pInfoCommande, :pJourHoraire, :pSpecificite, :pType);";
  const INSERT_INTO_CETCAL_ENTITES_MARCHE = "INSERT INTO cetcal.cetcal_entite (denomination, activite, adresse, infoscmd, jourhoraire, specificites, type) VALUES (:pDenomination, :pActivite, :pAdrliterale, :pInfoCommande, :pJourHoraire, :pSpecificite, :pType);";
  const SELECT_ALL_CETCAL_ENTITE = "SELECT * FROM cetcal.cetcal_entite WHERE etat=1;";
  const SELECT_ALL_CETCAL_ENTITE_NOT_MARCHE = "SELECT * FROM cetcal.cetcal_entite WHERE activite != 'marche du castillonnais' AND etat=1;";
  const SELECT_ALL_CETCAL_ENTITE_IS_MARCHE = "SELECT * FROM cetcal.cetcal_entite WHERE activite='marche du castillonnais' AND etat=1;";
  const SELECT_PK_CETCAL_ENTITE_BY_DENOMINATION = "SELECT * FROM cetcal.cetcal_entite WHERE denomination=:pDenomination;";
  const SELECT_ALL_CETCAL_ENTITE_BY_TYPE = "SELECT * FROM cetcal.cetcal_entite WHERE type=:pType AND etat=1;";
  const SELECT_CETCAL_ENTITE_BY_PK = "SELECT * FROM cetcal.cetcal_entite WHERE pk_entite=:pPk_entite;";
  const UPDATE_ENTITE_BY_PK = "UPDATE cetcal.cetcal_entite SET denomination=:pDenomination, territoire=:pTerritoire, activite=:pActivite, adresse=:pAdrliterale, tels=:pTels, personne=:pContactPersonne, email=:pEmail, urlwww=:pUrlwww, infoscmd=:pInfoCommande, jourhoraire=:pJourHoraire, specificites=:pSpecificite, type=:pType WHERE pk_entite=:pPk;";
  const DELETE_LOGIQUE_ENTITE_BY_PK = "UPDATE cetcal.cetcal_entite SET etat=0 WHERE pk_entite=:pPk;";

  const SELECT_ALL_FROM_AMINISTRATION = "SELECT * FROM cetcal.cetcal_administration;";
  const UPDATE_AMINISTRATION_SESSION = "UPDATE cetcal.cetcal_administration SET session_id=:pSessionId WHERE adm_email=:pAdmLoginEmail OR adm_usr_name=:pAdmLogin;";
  const SELECT_ALL_FROM_AMINISTRATION_SESSION = "SELECT * FROM cetcal.cetcal_administration WHERE session_id=:pSessionId;";
  const SELECT_ALL_FROM_AMINISTRATION_EMAIL_OR_LOGIN = "SELECT * FROM cetcal.cetcal_administration WHERE adm_usr_mdp=:pAdmUsrMdp AND adm_email=:pAdmEmail OR adm_usr_name=:pAdmUsrName;";

  const SELECT_ALL_PARTENAIRES_LIENS = "SELECT * from cetcal.cetcal_partenaires_liens ORDER BY denomination ASC;";

  const UPDATE_COMMUNES_BY_LIBELLE = "UPDATE cetcal.cetcal_communes SET lat=:pLat, lng=:pLng WHERE libelle=:pLibelle AND id=:pId;";
  const SELECT_ALL_CETCAL_COMMUNES = "SELECT * FROM cetcal.cetcal_communes;";
  const SELECT_ALL_CETCAL_COMMUNES_GEOLOC_SET = "SELECT * FROM cetcal.cetcal_communes WHERE lat <> 'NULL' AND lng <> 'NULL' AND lat <> '' AND lng <> '';";
  const SELECT_CETCAL_COMMUNES_BY_ID_LATLNG_EXISTS = "SELECT * FROM cetcal.cetcal_communes WHERE id=:pId AND lat <> 'NULL' AND lng <> 'NULL';";
  const SELECT_COMMUNE_BY_PK = "SELECT * FROM cetcal.cetcal_communes WHERE id=:pId;";
  
  const INSERT_CETCAL_USER = "INSERT INTO cetcal.cetcal_user (user_email, user_usr_name, user_usr_mdp, user_telport, user_commune, user_ip, identifiant_cet, user_fk_commune, notifier_info, notifier_achat, notifier_hebdo) VALUES (:pEmail, :pUsrNom, :pMdpHash, :pTelPort, :pCommune, :pIP, :pCetWebID, :pFKCommune, :pInfos, :pAchat, :pHebdo);";
  const SELECT_ONE_USER_BY_EMAIL = "SELECT * FROM cetcal.cetcal_user WHERE user_email=:pEmail LIMIT 1;";
  const SELECT_CETCAL_USER_BY_EMAIL = "SELECT * FROM cetcal.cetcal_user WHERE user_email=:pEmail;";
  const SELECT_CETCAL_USER_BY_EMAIL_AND_PWD_HASH = "SELECT * FROM cetcal.cetcal_user WHERE user_email=:pEmail AND user_usr_mdp=:pMdpHash;";
  const UPDATE_USER_MOT_DE_PASSE = "UPDATE cetcal.cetcal_user SET user_usr_mdp=:pMdpsha WHERE user_email=:pEmail;";

  // Queries pour fiche détaillée producteur
  const SELECT_CETCAL_PRODUCTEUR_BY_PK = "SELECT * FROM cetcal.cetcal_producteur WHERE pk_producteur=:pPk_producteur;";
  const SELECT_PRODUCTEUR_LIEU_JOIN = "SELECT * FROM cetcal.cetcal_lieu, cetcal.producteur_join_lieu WHERE fk_lieu=pk_lieu AND fk_producteur_join=(select pk_producteur from cetcal.cetcal_producteur where pk_producteur = :pPk_producteur) ";
  const SELECT_PRODUIT_BY_PK_PRODUCTEUR = "SELECT * FROM cetcal.producteur_join_produits, cetcal.cetcal_produit WHERE fk_produits_join=pk_produit AND fk_producteur_join=:pPk_producteur";
  const SELECT_CATEGORIES_PRODUITS_BY_PK_PRODUCTEUR = "SELECT DISTINCT (categorie) FROM cetcal.producteur_join_produits, cetcal.cetcal_produit WHERE fk_produits_join=pk_produit AND fk_producteur_join=:pPk_producteur";
  const UPDATE_USER_SESSION = "UPDATE cetcal.cetcal_user SET session_id=:pSessionId, user_ip=:pUserIp WHERE user_id=:pUserId;";

  // Queries pour select lieux de vente
  const SELECT_ALL_TYPES_LIEU = "SELECT DISTINCT (type) FROM cetcal.cetcal_entite";



}