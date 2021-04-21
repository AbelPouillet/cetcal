$('#cet-admin-1').on('hidden.bs.collapse', function () {
  $('#cet-accordion-icon-admin-main-1').removeClass('fa-hand-o-up');
  $('#cet-accordion-icon-admin-main-1').addClass('fa-hand-o-down');
});

$('#cet-admin-1').on('shown.bs.collapse', function () {
  $('#cet-accordion-icon-admin-main-1').removeClass('fa-hand-o-down');
  $('#cet-accordion-icon-admin-main-1').addClass('fa-hand-o-up');
});

$('#cet-admin-2').on('hidden.bs.collapse', function () {
  $('#cet-accordion-icon-admin-main-2').removeClass('fa-hand-o-up');
  $('#cet-accordion-icon-admin-main-2').addClass('fa-hand-o-down');
});

$('#cet-admin-2').on('shown.bs.collapse', function () {
  $('#cet-accordion-icon-admin-main-2').removeClass('fa-hand-o-down');
  $('#cet-accordion-icon-admin-main-2').addClass('fa-hand-o-up');
});

$('#cet-admin-3').on('hidden.bs.collapse', function () {
  $('#cet-accordion-icon-admin-main-3').removeClass('fa-hand-o-up');
  $('#cet-accordion-icon-admin-main-3').addClass('fa-hand-o-down');
});

$('#cet-admin-3').on('shown.bs.collapse', function () {
  $('#cet-accordion-icon-admin-main-3').removeClass('fa-hand-o-down');
  $('#cet-accordion-icon-admin-main-3').addClass('fa-hand-o-up');
});

$(document).ready(function() {

	/*********************************************************************
	 * Actions liées aux marchés, leiux de distributions, Asso, AMAPS etc.
	 */
	$('#btn-admin-ajout-entite').click(function() {
		$('input#admin_action_cible').val('insert-entite');
		$('#admin-entite-form').submit();
	});

	$('#btn-admin-modifier-entite').click(function() {
		$('input#admin_action_cible').val('update-entite');
		$('#admin-entite-form').submit();
	});

	$('#btn-admin-delete-entite').click(function() {
		$('input#admin_action_cible').val('delete-entite');
		$('#admin-entite-form').submit();
	});

	$('#btn-admin-annuler-entite').click(function() {
		$('input#admin_action_cible').val('');
		$('#admin-entite-form').submit();
	});

	$('.admin-entite-administrer').each(function() {
		$(this).click(function() {
			var pk = $(this).find('.pk').text();
			const queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			$.ajax({
		        url: '../../../controller/cet.annuaire.controller.administration.actions.php?sitkn=' + urlParams.get('sitkn'),
		        type: 'POST',
		        data: {
		        	admin_action_cible : 'get-entite',
            		pkid : pk
		        },
		        success: function (json) {
							var entite = JSON.parse(json);	        	
		        	// Ajouter les données au formaulaire 
		        	// Relancer la zone de création marchés en update.
		        	$('input[name ="admin-pk-entite"]').val(entite.pk_entite);
		        	$('input[name ="entite-entite-denomination"]').val(entite.denomination);
		        	$('input[name ="entite-entite-territoire"]').val(entite.territoire);
		        	$('textarea[name ="entite-entite-activite"]').text(entite.activite);
		        	$('input[name ="entite-entite-adresse"]').val(entite.adresse);
		        	$('input[name ="entite-entite-tel"]').val(entite.tels);
		        	$('input[name ="entite-entite-personne"]').val(entite.personne);
		        	$('input[name ="entite-entite-email"]').val(entite.email);
		        	$('input[name ="entite-entite-urlwww"]').val(entite.urlwww);
		        	$('textarea[name ="entite-entite-infoscmd"]').text(entite.infoscmd);
		        	$('textarea[name ="entite-entite-jourhoraire"]').text(entite.jourhoraire);
		        	$('textarea[name ="entite-entite-specificites"]').text(entite.specificites);
		        	$('input[name ="entite-entite-type"]').val(entite.type);
		        	// maintenant, déplacer vers l'ancre.
							scrollTowardsId('admin-entite-form', -172);
							// mise à jour du statut des boutons : 
							$('#btn-admin-ajout-entite').hide();
							$('#btn-admin-modifier-entite').show();
							$('#btn-admin-delete-entite').show();
							$('#btn-admin-annuler-entite').show();
		        }, error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }
		    });
		});
	});
	/*********************************************************************/

});