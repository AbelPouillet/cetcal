/** 
 * @author 
 *  FROM SIGNUP LIEUX DIST
 */
/* ***** SELECT ITEMS **********/
const allMarcheBox = document.getElementById('the-basics');
const selectElement = document.querySelector('.select--lieudist');
const sousTypeSelect = document.querySelector('.qstprod--soustype');
const list = document.querySelector('.lieux--list');
const clearLieuxRecap = document.querySelector('.clear--lieux');
const checkboxMarche = document.querySelector('.checkbox--new--marche');
const newMarcheBox = document.querySelector('.unfinded--marche')
const newMarcheProd = document.querySelector('.new--marche');
const btnNewMarcheProd = document.querySelector('.btn--new--marche--prod');
const marcheInputProd = document.querySelector('.marche--prod');
const selectSousType = document.querySelector('.select--sous--type');
const amapTypeahead = document.querySelector('.amap--typeahead');
const adresseMarcheProd = document.querySelector('.adresse--marche--prod');
const precisionsProd = document.querySelector('.qstprod--precisions');
const textAreaProd = document.querySelector("textarea");
const limitTextAlert = document.querySelector('.limit--text--alert');
const addLieu = document.querySelector('.addLieu');
const addCircuit = document.querySelector('.addCircuit');
const dataPost = document.querySelector('#data');
// input post json :
const postJson = document.querySelector('#qstprod-signuplieuxdist-json');
// bouton nav continuer :
const boutonValider = document.getElementById('btn-signuplieuxdist.form-valider');
// bouton nav retour :
const boutonRetour = document.querySelector('#btn-signuplieuxdist.form-retour');

let marches;
let postObjet;
let inputMarche;
let precisions_texte = '';

/**
 * Définition de la structure de données pour lieux de distributions (tous cas confondus).
 */
const PostObj = class {
  constructor(denomination, type, sous_type, pk_entite, crea_marche, precesions, dateLieux, 
    heureDeb, heureFin, jour) {
    this.denomination = denomination;
    this.type = type;
    this.sous_type = sous_type;
    this.pk_entite = pk_entite;
    this.crea_marche = crea_marche;
    this.precs = precesions;
    this.date = dateLieux;
    this.heure_deb = heureDeb;
    this.heure_fin = heureFin;
    this.jour = jour;
  }
}

/**
 * DTO JSON pour tous les lieux ajoutés.
 */
let postO = { lieux: [] };

// edit option, Flags :
let editElement;
let editID = "";
let value ="";
let amapFlag = false;
let precisionsFlag = false;
let sousTypeFlag = false;
let checkboxFlag = false;

/** *****************************************************************************************
 * EVENT LISTENERS 
 */
selectElement.addEventListener('change', (event)=> {
  value = selectElement.options[selectElement.selectedIndex].text;

  if (selectElement.options[selectElement.selectedIndex].value === 'NULL') {
    clearInputs();
    clear(amapTypeahead);
    clear(allMarcheBox);
    postObjet = undefined;
    return;
  }

  if (value === 'Marché') {

    if (addLieu != null) {
      addLieu.classList.add('d-none');
    } else {
      clear(amapTypeahead);
      showMarche();
      hideCircuitCourt();
      ajaxCall();
      allMarcheBox.classList.remove('d-none');
      newMarcheBox.classList.remove('d-none');
      precisionsProd.classList.remove('d-none');
      amapFlag = false;
    }

  } else if (value === 'Reseau de vente en circuit court') {

    if (precisionsFlag === true) {
      precisionsProd.classList.add('d-none');
      precisionsFlag = false;
      sousTypeFlag = true;
    }

    if (addLieu != null) {
      addLieu.classList.add('d-none');
    } else {
      clear(allMarcheBox);
      clear(amapTypeahead);
      hideNewMarche();
      showCircuitCout();
      ajaxCall(value);
    }

  } else {

    if (sousTypeFlag === true) {
      sousTypeSelect.classList.add('d-none');
      sousTypeFlag = false;
    }
    amapFlag = false;
    hideNewMarche();
    clear(amapTypeahead);
    clear(allMarcheBox);
    precisionsFlag = true;
    precisionsProd.classList.remove('d-none');
    ajaxCall(value);
  }

});

selectSousType.addEventListener('change', (e) => {
  const req = selectSousType.options[selectSousType.selectedIndex].text
  if (req === "amap" && amapFlag === false) {
    precisionsProd.classList.remove('d-none');
    amapTypeahead.classList.remove('d-none');
    showAmap();
    ajaxCall(req);
    console.log(req);
    amapFlag = true;
    sousTypeFlag = true;
  } else {
    amapFlag = false;
    clear(amapTypeahead);
    precisionsProd.classList.remove('d-none');
    sousTypeFlag = true;
    postObjet = new PostObj('TODO', value, req, null, false, null, null, null, null, null);
  }

});

checkboxMarche.addEventListener('change', (event) => {
  if (checkboxMarche.checked) {
    newMarcheProd.classList.remove('d-none');
    allMarcheBox.classList.add('d-none');
    checkboxFlag = true;
  } else {
    newMarcheProd.classList.add('d-none');
    allMarcheBox.classList.remove('d-none');
    checkboxFlag = false;
  }
});

// Event : Ajout des lieux.
addCircuit.addEventListener('mousedown', () => {

  if (checkboxFlag === false && (postObjet === undefined || postObjet.denomination === undefined)) {
    console.log("Aucun le lieux de distribution renseigné.", "danger");
    return;
  } 

  if (checkboxFlag === true) {
    postObjet = new PostObj();
    postObjet.crea_marche = true;
    postObjet.type = 'Marché';
    postObjet.denomination = $('#nv-marche-lieuxdist-nom').val();
    postObjet.adr = $('#nv-marche-lieuxdist-adr').val();
    postObjet.heure_deb = $('#timeInput-heure-deb').val();
    postObjet.heure_fin = $('#timeInput-heure-fin').val();
    postObjet.date = $('#timeInput-date').val();
    postObjet.jour = $('#timeInput-jour').val();
  } else {
    postObjet.crea_marche = false;
  }

  // dans tous les cas :
  postObjet.precs = textAreaProd.value;

  if (!pkPresent(postObjet.pk_entite) && !denominationPresente(postObjet.denomination)) {
    
    postO.lieux.push(postObjet);

    /**
     * Suite à push OK : 
     * 0 - mise à jour du JSON en cas de validation / POST de la page : FAIT.
     * 1 - Mise à jour du récapitulatif : 
     * 2 - tout ré-initialiser.
     */
    $('#qstprod-signuplieuxdist-json').val(encodeURIComponent(JSON.stringify(postO)));
    console.log(JSON.parse(decodeURIComponent($('#qstprod-signuplieuxdist-json').val())));

    postObjet = undefined;
    // finalement ré-initialiser le formulaire et reconstruire le récap.
    clearInputs();
    buildRecapLieux();

  } else {
    console.log("Le lieux de distribution " + postObjet.denomination 
      + " est déjà sélectionné dans votre liste.", "danger");
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
  textAreaProd.value = '';
  $('input.typeahead').val('');
  checkboxMarche.checked = false;
  $('.unfinded--marche').hide();
  precisionsProd.classList.add('d-none');
  sousTypeSelect.classList.add('d-none');
  clear(amapTypeahead);
  selectElement.options[0].selected = 'selected';
  clear(allMarcheBox);

  var evt = document.createEvent("HTMLEvents");
  evt.initEvent("change", false, true);
  checkboxMarche.dispatchEvent(evt);
}

function showMarche(event) {
  $('.unfinded--marche').show();
  let action = "Marché";
  const element = document.createElement('input');
  element.type = "text";
  element.classList.add('typeahead');
  element.classList.add('form-control');
  element.classList.add('lieux-dist-recherche-typeahead');
  element.setAttribute('placeholder', 'Rechercher votre marché ...');
  let newEl = allMarcheBox.appendChild(element);
  document.body.insertAdjacentHTML('beforeend', newEl);
  inputMarche = document.querySelector('.typeahead');
  ajaxCall(action);
}

function showAmap() {
  const element = document.createElement('input');
  element.type = "text";
  const classTypeAhead = ["typeahead", "tt-input", "form-control", "lieux-dist-recherche-typeahead"];
  element.classList.add(...classTypeAhead);
  element.setAttribute('placeholder', 'Rechercher votre AMAP ...');
  let newEl = amapTypeahead.appendChild(element);
  document.body.insertAdjacentHTML('beforeend', newEl);
  inputMarche = document.querySelector('.typeahead');
}

function hideCircuitCourt(){
  sousTypeSelect.classList.add("d-none");
}

function hideNewMarche(){
  newMarcheBox.classList.add("d-none");
  newMarcheProd.classList.add("d-none");
  checkboxMarche.checked = false;
}

function clear(divToClear) {
  while (divToClear.firstChild) divToClear.removeChild(divToClear.firstChild);
}

function showCircuitCout() {
  sousTypeSelect.classList.remove("d-none");
}

// display alert
function displayAlert(text, action) {
  
}

// vérifie si pk est présente : 
function pkPresent(pk_ent) {
  return (pk_ent !== undefined && pk_ent !== null && pk_ent !== '') && 
    postO.lieux.some(entite => entite.pk_entite === pk_ent);
}

// vérifie si la dénomination est présent : 
function denominationPresente(nom) {
  if (nom === 'TODO') return false;
  return postO.lieux.some(entite => entite.denomination === nom);
}

function buildRecapLieux() {
  var html_thead = '<thead>' 
    + '<tr><th scope="col">Type</th>' 
    + '<th scope="col">Nom</th>'
    + '<th scope="col">Date</th>'
    + '<th scope="col">Jour</th>'
    + '<th scope="col">Heure de début</th>' 
    + '<th scope="col">Heure de fin</th>'
    + '<th scope="col">Vos précisions</th></tr>'
    + '</thead>'
  var html_table = '';
  for (var i = 0; i < postO.lieux.length; i++) {
    html_table += '<tr><td><i>' + emptyIfNullOrUndefined(getTypeOuSousType(postO.lieux[i].type, postO.lieux[i].sous_type)) + '</i></td>'
      + '<td>' + emptyIfNullOrUndefined(postO.lieux[i].denomination) + '</td>'
      + '<td>' + emptyIfNullOrUndefined(postO.lieux[i].date) + '</td>'
      + '<td>' + emptyIfNullOrUndefined(postO.lieux[i].jour) + '</td>'
      + '<td>' + emptyIfNullOrUndefined(postO.lieux[i].heure_deb) + '</td>'
      + '<td>' + emptyIfNullOrUndefined(postO.lieux[i].heure_fin) + '</td>'
      + '<td>' + emptyIfNullOrUndefined(postO.lieux[i].precs) + '</td>'
      + '</tr>';
  }
  html_table = '<table class="table table-sm" id="lieux-dist-table-recap-lieux">' 
    + html_thead 
    + '<tbody>' 
    + html_table + '</tbody></table>';
  $('#lieux-dist-recap-liste').empty();
  $('#lieux-dist-recap-liste').append(html_table);
  $('#lieux-dist-recap-avant-envoi').show('slow');
}

function emptyIfNullOrUndefined(data) {
  return data === undefined || data === 'undefined' || data == 'null' || data === null || data === 'TODO' ? '' : data;
}

function getTypeOuSousType(type, sousType) {
  return (sousType !== undefined && sousType !== null && sousType !== '') ? type + ' (' + sousType + ')' : type;
}

/** *****************************************************************************************
 * AJAXs.
 */
function ajaxCall(action) {

  if (action === undefined) return;
  $(document).ready(function() {

    $.ajax({ url: 'src/app/controller/ajaxhandlers/cet.qstprod.ajaxhandler.controller.signuplieuxdist.php',
      type: 'POST',
      data: {'action': action },
      dataType: 'JSON',
      success: function(response) {
      // Début si réseau de vente en circuit court
      
        if (action === "Reseau de vente en circuit court") {
          clear(selectSousType);
          const initOpt = document.createElement("option");
          initOpt.value ="0";
          initOpt.text = "-- Choississez un mode de distribution --";
          selectSousType.add(initOpt, selectSousType.options[0]);
          const test = response.map((item) => `<option value="${item.id}">${item.sous_type}</option>`).join(' ');
          selectSousType.insertAdjacentHTML('beforeend', test);
        // fin si
        //Début si amap
        } else if (action === "amap" || action === "Marché") {

          let engine = new Bloodhound({
            local: response,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace("denomination")
          });
          engine.initialize();

          var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
              var matches, substringRegex;
              // an array that will be populated with substring matches
              matches = [];
              // regex used to determine if a string contains the substring `q`
              substrRegex = new RegExp(q, 'i');
              // iterate through the pool of strings and for any string that
              // contains the substring `q`, add it to the `matches` array
              $.each(strs, function (i, str) {
                if (substrRegex.test(str)) matches.push(str);
              });
              
              cb(matches);
            };
          };
if (action === "amap") {

  $('#amap .typeahead').typeahead({
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

  $('#amap').on('typeahead:selected', function (e, datum) {
    postObjet = new PostObj(datum.denomination, action, value, datum.pk_entite, null, null, null, null, null, null);
  });
}
else if ( action === "Marché") {

  $('#the-basics .typeahead').typeahead({
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


  $('#the-basics').on('typeahead:selected', function (e, datum) {
    postObjet = new PostObj(datum.denomination, action, null, datum.pk_entite, null, null, null, null, null, null);
  });
      } else if (action !== 'Reseau de vente en circuit court') {
        postObjet = new PostObj('TODO', action, null, null, null, null, null, null, null, null);   
        console.log(postObjet);
      }

        // fin si
        } else {
          clear(selectSousType);
          var initOpt = document.createElement("option");
          initOpt.value ="0";
          initOpt.text = "-- Préciser votre choix --";
          selectSousType.add(initOpt, selectSousType.options[0]);
          for (var i = 0; i < response.length; i++) {
            initOpt = document.createElement("option");
            initOpt.value = response[i].sous_type;
            initOpt.text = response[i].sous_type;
            selectSousType.add(initOpt, selectSousType.options[i + 1]);
          }
          showCircuitCout();
        }
      }, // END Ajax success.
    error: function(jqXHR, textStatus, errorThrown) {
        console.log('err ajax' + response);
        console.log(textStatus, errorThrown);
      }
    }); // END Ajax.
  }); // END document.ready.
} // END fonction ajaxCall.

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