/**
 * Prevent form submit if any necessary fields are unset.
 */
  $(function(){
    $('#btn-signupgen-form-valider').on('mousedown', function(e) {
      if (document.querySelector('.is-invalid') !== null) {
        	e.preventDefault();
        	var text = 'Des informations obligatoires sont manquantes au formulaire.'
        	text += ' Pour traiter votre inscription et créer votre compte, nous avons besoin des éléments suivant :'
        	text += ' Votre mot de passe et confirmation de celui-ci, la commune et le code postal de la ferme.';
          $('#modal-questionaire-titre').text('Des informations obligatoires sont manquantes');
		    $('#modal-questionaire-paragraphe').text(text);
		    $('#modal-questionaire-btn-primary').text("J'ai compris");
		    $('#modal-questionaire-btn').click();
  		} else {
  			$('#qstprod-signupgen-nav').val('valider');
  		}
    });
 });

$(document).ready(function() {
    checkFormInput(60, 'qstprod-commune');
    checkFormInputInteger(9, 4, 'qstprod-cp');
});

$('#cet-infosweb').on('hidden.bs.collapse', function () {
  $('#cet-accordion-icon-infosweb').removeClass('fa-hand-o-up');
  $('#cet-accordion-icon-infosweb').addClass('fa-hand-o-down');
});

$('#cet-infosweb').on('shown.bs.collapse', function () {
  $('#cet-accordion-icon-infosweb').removeClass('fa-hand-o-down');
  $('#cet-accordion-icon-infosweb').addClass('fa-hand-o-up');
});

$('#cet-sondage-1').on('hidden.bs.collapse', function () {
  $('#cet-accordion-icon-sondage-1').removeClass('fa-hand-o-up');
  $('#cet-accordion-icon-sondage-1').addClass('fa-hand-o-down');
});

$('#cet-sondage-1').on('shown.bs.collapse', function () {
  $('#cet-accordion-icon-sondage-1').removeClass('fa-hand-o-down');
  $('#cet-accordion-icon-sondage-1').addClass('fa-hand-o-up');
});
