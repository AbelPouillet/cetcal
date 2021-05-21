class UIHelper {

  constructor() {
    this.initialized = false;
  }

  init(type, sous_type, visiui) {
    this.type = type;
    this.sous_type = sous_type;
    this.visiui = visiui;
    this.initialized = true;
    return this;
  }

<<<<<<< HEAD
  apply(dataHelper, elemNonTrouve) {
    if (!this.initialized) throw 'UI Helper non initialisé';
    if (dataHelper.isReadyTypeAhead() || elemNonTrouve) $('.visiui-recherche-ta').each(function() { $(this).show(); });
    if (dataHelper.isReadyTypeAhead() || elemNonTrouve) {
      if (this.visiui > 0) $('.visiui-sup-0').each(function() { $(this).show(); });
      if (this.visiui > 8) $('.visiui-sup-8').each(function() { $(this).show(); });
      if (this.visiui > 16) $('.visiui-sup-16').each(function() { $(this).show(); });
=======
  initialize(){
    this.displayResults(this.results);

  }

  displayResults(results){
    console.log(this.results);

    const VISIBILTY = "visibility_ui";
    const TARGET_ENTITE = "entite";
    const TARGET_SOUS_TYPE = "sous_type";

    this.filterAndDispatch(results);
  }

  filterAndDispatch(results){
    let self = this;
    console.log(this.results);

    const VISIBILTY = "visibility_ui";
    const TARGET_ENTITE = "entite";
    const TARGET_SOUS_TYPE = "sous_type";


    if(results.some(item => item.target === TARGET_ENTITE)) {
      console.log("il faut afficher entité");
      let newArr = results.filter((item) => item.target != TARGET_ENTITE);
      console.log(newArr);
      this.maxVisibilityDisplay(newArr);


    } else if (results.some(item => item.target === TARGET_SOUS_TYPE )) {
      let newArr = results.filter((item) => item.target != TARGET_SOUS_TYPE);
      console.log("il faut afficher les sous types");
      this.displaySousSelect(newArr, this.filterAndDispatch);
>>>>>>> branch 'cetcal_phase2' of https://github.com/j-fish/cetcal.git
    }

    if (!dataHelper.hasSousTypes()) $('#qstprod-lieudist-soustypes-container').hide();
    if (elemNonTrouve === false) $('.cet-crea-entite').each(function() { $(this).hide(); });
    if (!dataHelper.isTypeAheadPopulated()) $('#qstprod-recherche-lieuxdist-container').hide();
    if (dataHelper.open_search == 1) $('#cet-lieux-non-trouve-container').show();
    else $('#cet-lieux-non-trouve-container').hide();
  }

<<<<<<< HEAD
  unInit() {
    this.type = undefined;
    this.sous_type = undefined;
    this.visiui = undefined;
    this.initialized = false;
    return this;
=======
  maxVisibilityDisplay(results) {
    console.log("toto 143")
    this.clear(selectSousType);
    this.typeAheadData(results);
    this.addNewCircuitDisplay();

>>>>>>> branch 'cetcal_phase2' of https://github.com/j-fish/cetcal.git
  }

<<<<<<< HEAD
  isInitialized() {
    return this.initialized && this.type !== undefined && this.sous_type !== undefined && this.visiui !== undefined;
=======
  displaySousSelect(arr){
    //allMarcheBox.classList.add("d-none");
    sousTypeSelect.classList.remove("d-none");
    this.clear(selectSousType);
    this.clear(newMarcheBox);
    this.clear(allMarcheBox);
    this.populateSousSelect(arr);
    this.sousSelectLogic();
>>>>>>> branch 'cetcal_phase2' of https://github.com/j-fish/cetcal.git
  }

}

class DataHelper {

  constructor(cible, type, sous_type, visiui, opensearch) {
    this.cible = cible;
    this.type = type;
    this.sous_type = sous_type;
    this.visiui = visiui;
    this.open_search = opensearch;
    this.typeahead_populated = false;
    this.data_typeahead = undefined;
    this.data_sous_types = undefined;
    this.datum_typeahead = undefined;
  }

  fetchdata(sousTypeRenseigne) {
    var outcome = false;
    $.ajax({
      url: 'src/app/controller/ajaxhandlers/cet.qstprod.ajaxhandler.controller.signuplieuxdist.php',
      type: 'POST',
      data: {
        'cible': sousTypeRenseigne ? 'entite' : this.cible, 
        'action': sousTypeRenseigne ? this.sous_type : this.type
      },
      dataType: 'JSON',
      async: false,
      context: this,
      success: function (response) {
        if (response.error) {
          this.data_typeahead = undefined;
        } else {
          if (this.cible === 'entite' || sousTypeRenseigne) this.data_typeahead = response;
          else this.data_sous_types = response;
          outcome = true;
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });

<<<<<<< HEAD
    return outcome;
=======
    selectSousType.addEventListener('change', (e) => {
      const data = selectSousType.options[selectSousType.selectedIndex].getAttribute("data");
      const cible = data.length > 0 ? 'sous_type' : 'entite';
      const req = selectSousType.value;
      console.log(req);
      console.log(cible);
      const test3 = new Data();
      test3.fetchData(cible, req);
      this.results = test3.resultsOfAjax;
      console.log(this.results);
      this.displayResults(this.results);
    });
>>>>>>> branch 'cetcal_phase2' of https://github.com/j-fish/cetcal.git
  }

  isReadyTypeAhead() {
    return this.data_typeahead !== undefined;
  }

  isTypeAheadPopulated() {
    return this.typeahead_populated;
  }

  hasSousTypes() {
    return this.data_sous_types !== undefined;
  }

}

var dataHelper = undefined;
var uiHelper = new UIHelper();
let postO = { lieux: [] };

$(document).ready(function() {

  resetForm();

  $('#cet-lieux-non-trouve').on('change', function() {
    uiHelper.init(dataHelper.type, dataHelper.sous_type, dataHelper.visiui)
      .apply(dataHelper, $('#cet-lieux-non-trouve').is(':checked'));
  });

  $('#qstprod-recherche-lieuxdist').on('typeahead:selected', function (e, datum) {
    dataHelper.datum_typeahead = datum;
  });

  $('#qstprod-lieuxdist-type').on('focus', function() { });

  $('#qstprod-lieuxdist-type').on('change', function() {
    
    resetForm();
    var value = $("#qstprod-lieuxdist-type option:selected").val();
    if (value === 'NULL') return;

    var data = $("#qstprod-lieuxdist-type option:selected").attr('data');
    var visibiliteui = $("#qstprod-lieuxdist-type option:selected").attr('visibiliteui');
    var opensearch = $("#qstprod-lieuxdist-type option:selected").attr('opensearch');
    dataHelper = new DataHelper(data.length > 0 ? 'sous_type' : 'entite', value, '', visibiliteui, opensearch);
    var fetch_result = dataHelper.fetchdata(false);
    if (dataHelper.isReadyTypeAhead()) {
      dataHelper.typeahead_populated = loadTypeahead(dataHelper.data_typeahead);
      if (!fetch_result) $('#cet-lieux-non-trouve').prop('checked', true);
    } else {
      populateSousSelect(dataHelper.data_sous_types);
    }

    uiHelper.init(dataHelper.type, dataHelper.sous_type, dataHelper.visiui)
      .apply(dataHelper, $('#cet-lieux-non-trouve').is(':checked'));
  });

  $('#qstprod-lieudist-soustypes').on('change', function() {
    var value = $("#qstprod-lieudist-soustypes option:selected").val();
    var data = $("#qstprod-lieudist-soustypes option:selected").attr('data');
    var visibiliteui = $("#qstprod-lieudist-soustypes option:selected").attr('visibiliteui');
    var opensearch = $("#qstprod-lieuxdist-type option:selected").attr('opensearch');
    dataHelper.open_search = opensearch;
    dataHelper.sous_type = value;
    dataHelper.visiui = visibiliteui;
    var fetch_result = dataHelper.fetchdata(true);
    dataHelper.typeahead_populated = loadTypeahead(dataHelper.data_typeahead);
    $('#cet-lieux-non-trouve').prop('checked', false);
    if (!fetch_result) $('#cet-lieux-non-trouve').prop('checked', true);

    uiHelper.init(dataHelper.type, dataHelper.sous_type, dataHelper.visiui)
      .apply(dataHelper, $('#cet-lieux-non-trouve').is(':checked'));
  });

  $('#add-lieuxdist-au-recap').on('mousedown', function() {
    var postObjet = new LieuDistPost();
    postObjet.crea_marche = $('#cet-lieux-non-trouve').is(':checked');
    postObjet.type = $("#qstprod-lieuxdist-type option:selected").text();
    postObjet.code_type = dataHelper.type;
    postObjet.sous_type = $("#qstprod-lieudist-soustypes option:selected").val() !== '' ? 
      $("#qstprod-lieudist-soustypes option:selected").text() : '';
    postObjet.code_sous_type = dataHelper.sous_type;
    postObjet.precs = $('#qstprod-precisions-prod').val();
    if (postObjet.crea_marche) { 
      postObjet.denomination = $('#nv-marche-lieuxdist-nom').val();
      postObjet.adr = $('#nv-marche-lieuxdist-adr').val();
      postObjet.heure_deb = $('#timeInput-heure-deb').val();
      postObjet.heure_fin = $('#timeInput-heure-fin').val();
      postObjet.date = $('#timeInput-date').val();
      postObjet.jour = $('#timeInput-jour').val();
    } else {
      postObjet.pk_entite = dataHelper.datum_typeahead.pk_entite;
      postObjet.denomination = dataHelper.datum_typeahead.denomination;
    }

    resetForm();
    $('#qstprod-lieuxdist-type').val('');
    $('#qstprod-lieudist-soustypes').val('');
    postO.lieux.push(postObjet);
    buildRecapLieux();
  });

});

function populateSousSelect(results) {
  $('#qstprod-lieudist-soustypes').empty();
  $('#qstprod-lieudist-soustypes').append(
    '<option value="0">Veuillez préciser votre choix</option>'
    );
  var newSelectOptions = results.map((item) => 
    `<option value="${item.code_sous_type}" data="" 
     visibiliteui="${item.visibilite_ui}"
     opensearch="${item.recherche_tbl_entite}">${item.sous_type}</option>`).join(' ');
  $('#qstprod-lieudist-soustypes').append(newSelectOptions);
  $('#qstprod-lieudist-soustypes-container').show('slow');
}

function loadTypeahead(results) {

    $('#qstprod-recherche-lieuxdist').typeahead("destroy");
    if (Array.isArray(results) === false || results.length < 1) return false;
    let engine = new Bloodhound({
      local: results,
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace("denomination")
    });
    engine.initialize();

    var substringMatcher = function(strs) {
      return function findMatches(q, cb) {
        var matches, substringRegex;
        matches = [];
        substrRegex = new RegExp(q, 'i');
        $.each(strs, function (i, str) {
          if (substrRegex.test(str)) matches.push(str);
        });
        cb(matches);
      };
    };

    $('#qstprod-recherche-lieuxdist').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      }, 
      {
        name: 'engine',
        display: function(item){
          return item.denomination
        },
        source: engine.ttAdapter(),
    });

<<<<<<< HEAD
    return true;
=======
  addNewCircuitDisplay(){
   // console.log("toto");
   // newMarcheProd.classList.remove('d-none');
    newMarcheBox.classList.remove("d-none");
    checkboxMarche.addEventListener('change', (event) => {
      if (checkboxMarche.checked) {
        newMarcheProd.classList.remove('d-none');
        allMarcheBox.classList.add('d-none');
        checkboxFlag = true;
        newMarcheValidator = new FormValidator();
      } else {
        newMarcheProd.classList.add('d-none');
        allMarcheBox.classList.remove('d-none');
        checkboxFlag = false;
        if (newMarcheValidator !== undefined) {
          newMarcheValidator.clear();
          newMarcheValidator = undefined;
        }
      }
    });
  }
  addNewCircuitModule(){
   /* checkboxMarche.addEventListener('change', (event) => {
      if (checkboxMarche.checked) {
        newMarcheProd.classList.remove('d-none');
        allMarcheBox.classList.add('d-none');
        checkboxFlag = true;
        newMarcheValidator = new FormValidator();
      } else {
        newMarcheProd.classList.add('d-none');
        allMarcheBox.classList.remove('d-none');
        checkboxFlag = false;
        if (newMarcheValidator !== undefined) {
          newMarcheValidator.clear();
          newMarcheValidator = undefined;
        }
      }
    });*/


// Event : Ajout des lieux.
    addCircuit.addEventListener('mousedown', () => {

      if (postObjet === undefined && checkboxMarche.checked === false) {
        alerter('Aucun le lieu de distribution renseigné', 'Veuillez renseigner tous les choix et sous-catégories proposés.', 'J\'ai compris');
        return;
      }

      if (!pasDeSousType && selectSousType.selectedIndex === 0) {
        alerter('Le lieu de distribution est incomplet',
            'Veuillez renseigner la sous-catégorie depuis la liste proposée.', 'J\'ai compris');
        return;
      }

      // Cas particulier des nouveaux marchés.
      if (checkboxMarche.checked) {
        if (!newMarcheValidator.isDataValidated()) {
          alerter('Des informations sont manquantes concernant ce marché.',
              'Veuillez, dans la mesure du possible, renseigner toutes les informations demandées.', 'J\'ai compris');
          return;
        } else {
          postObjet = new LieuDistPost();
          postObjet.crea_marche = true;
          postObjet.type = 'Marché';
          postObjet.pk_entite = null;
          postObjet.denomination = $('#nv-marche-lieuxdist-nom').val();
          postObjet.adr = $('#nv-marche-lieuxdist-adr').val();
          postObjet.heure_deb = $('#timeInput-heure-deb').val();
          postObjet.heure_fin = $('#timeInput-heure-fin').val();
          postObjet.date = $('#timeInput-date').val();
          postObjet.jour = $('#timeInput-jour').val();
          newMarcheValidator.clear();
          newMarcheValidator = undefined;
        }

      } else {
        postObjet.crea_marche = false;
      }

      // dans tous les cas :
      postObjet.precs = textAreaProd.value;
      postObjet.code_type = selectElement.options[selectElement.selectedIndex].value;
      postObjet.code_sous_type = pasDeSousType ? 'NULL' : selectSousType.options[selectSousType.selectedIndex].value;

      if (!pkPresent(postObjet.pk_entite) && !denominationPresente(postObjet.denomination)) {

        postO.lieux.push(postObjet);
        $('#qstprod-signuplieuxdist-json').val(encodeURIComponent(JSON.stringify(postO)));

        postObjet = undefined;
        // finalement ré-initialiser le formulaire et reconstruire le récap.
        clearInputs();
        buildRecapLieux();

      } else {
        alerter('Lieux de distribution déjà renseigné',
            'Le lieux de distribution ' + postObjet.denomination + ' est déjà sélectionné dans votre liste.',
            'J\'ai compris');
      }

    });
  }
    clear(divToClear) {
    console.log(divToClear);
    while (divToClear.firstChild) divToClear.removeChild(divToClear.firstChild);
  }
}//FIN Classe

const test = new Data();
//const testUI = new UI();



selectElement.addEventListener('change', (event)=> {
  let data = selectElement.options[selectElement.selectedIndex].getAttribute("data");
  //console.log(data);
  let cible = data.length > 0 ? 'sous_type' : 'entite';
  //console.log(cible);
  value = selectElement.value;
 //console.log(value);
  test.fetchData(cible, value);
  let obj = test.resultsOfAjax;
  console.log(obj);
  const testUI = new UI(obj);
        testUI.initialize();
})

/*selectSousType.addEventListener('change', (e) => {
  const req = selectSousType.options[selectSousType.selectedIndex].text
  if (req === "AMAP") {
    precisionsProd.classList.remove('d-none');
    amapTypeahead.classList.remove('d-none');
    showAmap();
    ajaxCall(req);
    amapFlag = true;
    sousTypeFlag = true;
  } else {
    amapFlag = false;
    clear(amapTypeahead);
    precisionsProd.classList.remove('d-none');
    sousTypeFlag = true;
    postObjet = new LieuDistPost('NULL', value, req, null, false, null, null, null, null, null);
  }

});*/

checkboxMarche.addEventListener('change', (event) => {
  if (checkboxMarche.checked) {
    newMarcheProd.classList.remove('d-none');
    allMarcheBox.classList.add('d-none');
    checkboxFlag = true;
    newMarcheValidator = new FormValidator();
  } else {
    newMarcheProd.classList.add('d-none');
    allMarcheBox.classList.remove('d-none');
    checkboxFlag = false;
    if (newMarcheValidator !== undefined) {
      newMarcheValidator.clear();
      newMarcheValidator = undefined;
    }
  }
});


// Event : Ajout des lieux.
addCircuit.addEventListener('mousedown', () => {

  if (postObjet === undefined && checkboxMarche.checked === false) {
    alerter('Aucun le lieu de distribution renseigné', 'Veuillez renseigner tous les choix et sous-catégories proposés.', 'J\'ai compris');
    return;
  } 

  if (!pasDeSousType && selectSousType.selectedIndex === 0) {
    alerter('Le lieu de distribution est incomplet', 
      'Veuillez renseigner la sous-catégorie depuis la liste proposée.', 'J\'ai compris');
    return;
  }

  // Cas particulier des nouveaux marchés.
  if (checkboxMarche.checked) {
    if (!newMarcheValidator.isDataValidated()) {
      alerter('Des informations sont manquantes concernant ce marché.', 
        'Veuillez, dans la mesure du possible, renseigner toutes les informations demandées.', 'J\'ai compris');
      return;
    } else {
      postObjet = new LieuDistPost();
      postObjet.crea_marche = true;
      postObjet.type = 'Marché';
      postObjet.pk_entite = null;
      postObjet.denomination = $('#nv-marche-lieuxdist-nom').val();
      postObjet.adr = $('#nv-marche-lieuxdist-adr').val();
      postObjet.heure_deb = $('#timeInput-heure-deb').val();
      postObjet.heure_fin = $('#timeInput-heure-fin').val();
      postObjet.date = $('#timeInput-date').val();
      postObjet.jour = $('#timeInput-jour').val();
      newMarcheValidator.clear();
      newMarcheValidator = undefined;
    }

  } else {
    postObjet.crea_marche = false;
  }

  // dans tous les cas :
  postObjet.precs = textAreaProd.value;
  postObjet.code_type = selectElement.options[selectElement.selectedIndex].value;
  postObjet.code_sous_type = pasDeSousType ? 'NULL' : selectSousType.options[selectSousType.selectedIndex].value; 

  if (!pkPresent(postObjet.pk_entite) && !denominationPresente(postObjet.denomination)) {
    
    postO.lieux.push(postObjet); 
    $('#qstprod-signuplieuxdist-json').val(encodeURIComponent(JSON.stringify(postO)));

    postObjet = undefined;
    // finalement ré-initialiser le formulaire et reconstruire le récap.
    clearInputs();
    buildRecapLieux();

  } else {
    alerter('Lieux de distribution déjà renseigné', 
      'Le lieux de distribution ' + postObjet.denomination + ' est déjà sélectionné dans votre liste.', 
      'J\'ai compris');
  }

});

// Limitation textarea :
textAreaProd.addEventListener("input", event => {

  const target = event.currentTarget;
  const maxLength = target.getAttribute("maxlength");
  const currentLength = target.value.length;
  if (currentLength >= maxLength) {
    limitTextAlert.textContent = "limite de caractères atteinte";
  } else if (currentLength > 0) {
    limitTextAlert.textContent = `${maxLength - currentLength} caractères restants`;
  } else {
    limitTextAlert.textContent = "Aucune saisie pour le moment.";
  }

  precisions_texte = target.value;
});

/** *****************************************************************************************
 * FUNCTIONS
 */
function clearInputs() {
  $('#nv-marche-lieuxdist-nom').val('');
  $('#nv-marche-lieuxdist-adr').val('');
  $('#timeInput-heure-deb').val('');
  $('#timeInput-heure-fin').val('');
  $('#timeInput-date').val('');
  $('#timeInput-jour').val('');
  // Remove class .is-valid pour nouveaux marchés.
  $('.nouveau-marche-error-message').hide();
  textAreaProd.value = '';
  $('input.typeahead').val('');
  checkboxMarche.checked = false;
  $('.unfinded--marche').hide();
  precisionsProd.classList.add('d-none');
  sousTypeSelect.classList.add('d-none');
  clear(amapTypeahead);
  selectElement.options[0].selected = 'selected';
  clear(allMarcheBox);
  pasDeSousType = false;

  var evt = document.createEvent("HTMLEvents");
  evt.initEvent("change", false, true);
  checkboxMarche.dispatchEvent(evt);
>>>>>>> branch 'cetcal_phase2' of https://github.com/j-fish/cetcal.git
}

function resetForm() {
  $('.cet-visiui-input').each(function() { $(this).val(''); });
  $('.cet-visiui-input-textarea').each(function() { $(this).val(''); });
  $('.cet-visiui-input-select').each(function() {  });
  $('.cet-visiui-input-checkbox').each(function() { $(this).prop('checked', false); });
  $('.cet-visiui').each(function() { $(this).hide(); });
}

function buildRecapLieux() {
  var html_thead = '<thead>' 
    + '<tr><th scope="col"></th><th scope="col">Type</th>' 
    + '<th scope="col">Nom</th>'
    + '<th scope="col">Date</th>'
    + '<th scope="col">Jour</th>'
    + '<th scope="col">Heure de début</th>' 
    + '<th scope="col">Heure de fin</th>'
    + '<th scope="col">Vos précisions</th></tr>'
    + '</thead>'
  var html_table = '';
  for (var i = 0; i < postO.lieux.length; i++) {
    html_table += '<tr><td style="text-align: center;"><span class="lieux-dist-recap-liste-sup" data="' + i 
      + '"><i class="fas fa-minus-square"></i><span></td>'
      + '<td><i>' + emptyIfNullOrUndefined(getTypeOuSousType(postO.lieux[i].type, postO.lieux[i].sous_type)) + '</i></td>'
      + '<td>' + emptyIfNullOrUndefined(postO.lieux[i].denomination) + '</td>'
      + '<td>' + emptyIfNullOrUndefined(postO.lieux[i].date) + '</td>'
      + '<td>' + emptyIfNullOrUndefined(postO.lieux[i].jour) + '</td>'
      + '<td>' + emptyIfNullOrUndefined(postO.lieux[i].heure_deb) + '</td>'
      + '<td>' + emptyIfNullOrUndefined(postO.lieux[i].heure_fin) + '</td>'
      + '<td>' + emptyIfNullOrUndefined(substrIfNeeded(postO.lieux[i].precs)) + '</td>'
      + '</tr>';
  }
  html_table = '<table class="table table-sm" id="lieux-dist-table-recap-lieux">' 
    + html_thead 
    + '<tbody>' 
    + html_table + '</tbody></table>';
  $('#lieux-dist-recap-liste').empty();
  $('#lieux-dist-recap-liste').append(html_table);
  $('#lieux-dist-recap-avant-envoi').show('slow');

  setupLieuDeleteEvent();
  if (postO.lieux.length <= 0) $('#lieux-dist-recap-avant-envoi').hide();
  else $('#lieux-dist-recap-avant-envoi').show();
  $('#qstprod-signuplieuxdist-json').val(encodeURIComponent(JSON.stringify(postO)));
}

function setupLieuDeleteEvent() {
  $('.lieux-dist-recap-liste-sup').off();
  
  $('.lieux-dist-recap-liste-sup').on('mousedown', function() {
    try {
      for (var i = 0; i < postO.lieux.length; i++) {
        if (i == parseInt($(this).attr('data'))) {
          $('#cet-modal-alerte-titre').text('Veuillez confirmer la suppression');
          $('#cet-modal-alerte-paragraphe').text('Veuillez confirmer la suppression du lieu de distribution "' 
            + postO.lieux[i].denomination + '".');
          $('#cet-modal-alerte-btn-primary').text('Supprimer');
          $('#cet-modal-alerte-btn-primary').attr('data', i);
          $('#cet-modal-alerte-btn-primary').off();
          $('#cet-modal-alerte-btn-primary').on('mousedown', function() { 
            postO.lieux.splice(parseInt($(this).attr('data')), 1);
            $('#cet-modal-alerte').modal('hide');
            buildRecapLieux();
          });
          $('#cet-modal-alerte-btn-annuler').text('Annuler');
          $('#cet-modal-alerte-btn').click();
        }
      }
    } catch (error) { 
      postO = { lieux: [] };
    }
  });
}

function emptyIfNullOrUndefined(data) {
  return data === undefined || data === 'undefined' || data == 'null' || data === null || data === 'NULL' ? '' : data;
}

function getTypeOuSousType(type, sousType) {
  return (sousType !== undefined && sousType !== null && sousType !== '') ? type + ' (' + sousType + ')' : type;
}

function substrIfNeeded(str) {
  return str.length > 37 ? str.substring(0, 34) + '...' : str;
}

/** *****************************************************************************************
 * On DOM ready et inits libs.
 */
/** TIMEPICKER */
$(function() { $('#timeInput-heure-deb').timepicker({
  timeFormat: 'HH:mm',
  minTime: '03:00:00',
  maxHour: 20,
  startTime: new Date(0,0,0,7,0,0),
  interval: 30
});
});
$(function() { $('#timeInput-heure-fin').timepicker({
  timeFormat: 'HH:mm',
  minTime: '03:00:00',
  maxHour: 20,
  startTime: new Date(0,0,0,13,0,0),
  interval: 30
});
});
$(function() { $('[data-toggle="datepicker"]').datepicker({
  autoHide: true,
  language: 'FR',
  format: 'dd/mm/yyyy'
}); });
/** persistance des lieux sélectionnés */
$(document).ready(function() {
  try {
    postO = JSON.parse(decodeURIComponent($('#qstprod-signuplieuxdist-json').val()));
    buildRecapLieux();
  } catch (error) {
    postO = { lieux: [] };
  }
});