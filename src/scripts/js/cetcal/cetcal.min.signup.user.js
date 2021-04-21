$(document).ready(function() {

	$("#annuaire-user-signup-form").submit(function(event) {

	  var entries = $("#annuaire-user-signup-form :input").serializeArray();
	  var commune = $('#annuaire-user-signup-commune').val();
	  var email = $('#annuaire-user-signup-email').val();
	  var email_conf = $('#annuaire-user-signup-email-conf').val();
	  var mdp = $('#annuaire-user-signup-mdp').val();
	  var mdp_conf = $('#annuaire-user-signup-mdpconf').val();
    var choix_contacts = $("#annuaire-user-signup-form input:checkbox:checked").length > 0 ?
      'ok' : undefined;
	  var data = [email, email_conf, mdp_conf, mdp, choix_contacts];

	  var r = -1;
		for (var i = 0; i < data.length; i++) {
			var entry = data[i];
			if (entry === undefined || entry == 'undefined' || 
        entry.length < 1) ++r;
		}

	  if (r !== -1) {
	  	event.preventDefault();
	  	$('#modal-questionaire-titre').text('Le formulaire d\'inscription est incomplet.');
			$('#modal-questionaire-paragraphe').text(
        'Le formulaire d\'inscription est incomplet. Veuillez vérifier votre saisie. Veuillez également nous indiquer comment vous contacter.');
			$('#modal-questionaire-btn-primary').text("J'ai compris");
			$('#modal-questionaire-btn').click(); 
	  	return false;
	  } else {
	  	return true;
	  }
	});

});