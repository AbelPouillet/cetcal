$('#cet-admin-prd-inscrits').on('hidden.bs.collapse', function () {
  $('#cet-accordion-icon-admin-prd-inscrits').removeClass('fa-hand-o-up');
  $('#cet-accordion-icon-admin-prd-inscrits').addClass('fa-hand-o-down');
});

$('#cet-admin-prd-inscrits').on('shown.bs.collapse', function () {
  $('#cet-accordion-icon-admin-prd-inscrits').removeClass('fa-hand-o-down');
  $('#cet-accordion-icon-admin-prd-inscrits').addClass('fa-hand-o-up');
});

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
							// mise à jour du statut des boutons et visibilité de fonctionnalités.
							$('#btn-admin-ajout-entite').hide();
							$('#btn-admin-modifier-entite').show();
							$('#btn-admin-delete-entite').show();
							$('#btn-admin-annuler-entite').show();

              // START Lié administration des images et dropzone.
              $('#data-media-admin-entite-container').show();
              $('#entite-media-pkent-value').val(entite.pk_entite);
              $('#cetFileDropzoneImgentite').attr('action', '/src/app/controller/media/cet.qstprod.controller.media.form.php?pkent=' + entite.pk_entite 
                + '&sitkn=' + urlParams.get('sitkn') + '&cible=media-entite');
              // Initier la dropzone pour cette entite : 
              Dropzone.forElement("#cetFileDropzoneImgentite").options.url = '/src/app/controller/media/cet.qstprod.controller.media.form.php?pkent=' + entite.pk_entite 
                + '&sitkn=' + urlParams.get('sitkn') + '&cible=media-entite';
              clearAllFiles(1);
              reloadMedia(entite.pk_entite, 'entite');
              // END dropzone.

		        }, error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }
		    });
		});
	});
	/*********************************************************************/

});

Dropzone.options.cetFileDropzoneImgentite = {
  init: function() {
    this.on("success", function(file) { 
      var pk = $('#entite-media-pkent-value').val();
      reloadMedia(pk, 'entite');
    });
  }
};

function clearAllFiles(t) {
  setTimeout(function() {  
      Dropzone.forElement("#cetFileDropzoneImgentite").removeAllFiles();
    }, t);
}

/**
 * Recharger un media et l'ajouter.
 */
function appendAllMedia(images) {
  
  var content = false;
  $('#espace-entite-media-listing').empty();
  for (var i = 0; i < images.length; i++) {
    content = true;
    $('#espace-entite-media-listing').append('<button type="button" class="btn entite-media-element-btn"><div><span class="badge entite-media-element-desc">' + images[i].cible + '</span><span class="badge entite-media-element-delete-btn" data="' + images[i].id + '" pkent="' + images[i].fk_entite + '" urlr="' + images[i].urlr + '"><i class="fas fa-folder-minus fa-2x"></i></span></div><img src="' + images[i].urlr + '" class="rounded mx-auto d-block entite-media-element" height="128" alt="' + images[i].libelle + '"></button>');
  } 

  // Si aucune image alors notifier :
  if (!content) {
    $('#espace-entite-media-listing').append('<p style="margin: 12px; color: rgb(30,40,30) !important;">Aucune image ajouté pour le moment...</p>');
  }

  // Si media(s) trouvé(s), ajouter la fonctionnalité delete/suppression sur l'icone de suppression :
  $('.entite-media-element-delete-btn').on('mousedown', function() {

    var urlr_delete = $(this).attr('urlr');
    var pkent_delete = $(this).attr('pkent');
    var id_media_delete = $(this).attr('data');
    $('#cet-modal-alerte-titre').text("Veuillez confirmer la suppression de l'image");
    $('#cet-modal-alerte-paragraphe').text("La suppression de l'image est définitive. Vous pouvez cependant télécharger à nouveau une image supprimée par erreur. Veuillez confirmer la suppression de l'image " + urlr_delete);
    $('#cet-modal-alerte-btn-annuler').text("Annuler");
    $('#cet-modal-alerte-btn-primary').text("Je confirme");
    $('#cet-modal-alerte-btn-primary').off();
    $('#cet-modal-alerte-btn-primary').on('mousedown', function() {
      $('#cet-modal-alerte').modal('hide');
      deleteMedia(id_media_delete, pkent_delete, urlr_delete);
    });
    $('#cet-modal-alerte-btn-annuler').on('mousedown', function() { 
      $('#cet-modal-alerte').modal('hide'); 
    });
    $('#cet-modal-alerte-btn').click(); 
  });

  // finallement, vider les zones dropzone :
  clearAllFiles(2000);
}

/**
 * Recharger les medias.
 */
function reloadMedia(pk, tbl) {
  $.ajax({
    url: '/src/app/controller/ajaxhandlers/cet.annuaire.controller.ajaxhandler.media.php'
      + '?pk=' + pk
      + '&tbl=' + tbl,
    success: function(json) { appendAllMedia(JSON.parse(json)); },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    }
  });
}

function deleteMedia(id_media, pk_entite, urlr) {
  $.ajax({
    url: '/src/app/controller/media/cet.qstprod.controller.delete.media.php'
      + '?idm=' + id_media
      + '&pkent=' + pk_entite
      + '&urlr=' + urlr,
    success: function(json) { reloadMedia(pk_entite, 'entite'); },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    }
  });
}
