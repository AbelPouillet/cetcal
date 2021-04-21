#####################################################################
# données complètes par email.
#####################################################################
select distinct email from cetcal_producteur;
select * from cetcal_producteur where email='chateaufourtonlagarenne@gmail.com';

select * from cetcal_specificite_produits 
where fk_producteur_specificites_produits=
	(select pk_producteur from cetcal_producteur where email='chateaufourtonlagarenne@gmail.com');
select * from cetcal_type_production 
where fk_producteur_type_production=
	(select pk_producteur from cetcal_producteur where email='chateaufourtonlagarenne@gmail.com');
select * from cetcal_mode_conso
where fk_producteur_mode_conso=
	(select pk_producteur from cetcal_producteur where email='chateaufourtonlagarenne@gmail.com');
select * from cetcal_sondage
where fk_producteur_sondage=
	(select pk_producteur from cetcal_producteur where email='chateaufourtonlagarenne@gmail.com');
select * from cetcal_information_producteur
where fk_producteur_information_producteur=
	(select pk_producteur from cetcal_producteur where email='chateaufourtonlagarenne@gmail.com');
select * from cetcal_produit, producteur_join_produits
where fk_produits_join=pk_produit 
and fk_producteur_join=
	(select pk_producteur from cetcal_producteur where email='chateaufourtonlagarenne@gmail.com');
select * from cetcal_lieu, producteur_join_lieu
where fk_lieu=pk_lieu
and fk_producteur_join=
	(select pk_producteur from cetcal_producteur where email='chateaufourtonlagarenne@gmail.com');

#####################################################################
# Producteurs ayant répondus à une question spécifique du sondage.
#####################################################################
select reponse, fk_producteur from cetcal_sondage, 
where clef_question='s001' 
and reponse = 'manque de temps';

#####################################################################
# Nombre de réponses R pour une question Q
#####################################################################
select count(DISTINCT fk_producteur_sondage) from cetcal_sondage
where clef_question='s001' 
and reponse = 'manque de temps';
