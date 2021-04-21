$(function(){
  $('#btn-contact-form-valider').on('mousedown', function(e) {
    checkFormInput(1024, 'annuaire-contact-problematique');
    checkValidEmail(60, 'annuaire-contact-email');
    checkFormInput(10, 'annuaire-contact-ntel');
    if (document.querySelector('.is-invalid') !== null || 
        $('#annuaire-contact-problematique').val().length < 1) {
        e.preventDefault();
        var text = 'Le formulaire de contact est incomplet.'
        text += ' Pour traiter votre demande nous avons besoin des éléments suivant :'
        text += ' Votre email, un numéro de téléphone pour vous joindre ainsi que la description de votre demande.';
        $('#modal-questionaire-titre').text('Le formulaire de contact est incomplet');
      $('#modal-questionaire-paragraphe').text(text);
      $('#modal-questionaire-btn-primary').text("J'ai compris");
      $('#modal-questionaire-btn').click();
      return;
    } else {
      $('#qstprod-signupgen-nav').val('valider');
    }
  });
});

$(document).ready(function() {
  checkValidEmail(60, 'annuaire-contact-email');
  checkFormInput(10, 'annuaire-contact-ntel');
  checkFormInput(1024, 'annuaire-contact-problematique');
});
