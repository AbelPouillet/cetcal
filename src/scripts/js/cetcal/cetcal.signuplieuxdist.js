/** 
 * @author 
 *  FROM SIGNUP LIEUX DIST
 */

 /* ***** SELECT ITEMS **********/
 const allMarcheBox = document.getElementById('the-basics');
 const selectElement = document.querySelector('.select--lieudist');
 const sousTypeSelect = document.querySelector('.qstprod--soustype');
 const recapMarche = document.querySelector('.qstprod--recap');
 const list = document.querySelector('.marche--list');
 const alert = document.querySelector('.top--alert');
 const clearMarche = document.querySelector('.clear--marches');
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
 //input post json
 const postJson = document.querySelector('#qstprod-signuplieuxdist-json');
  // bouton nav continuer
const boutonValider = document.getElementById('btn-signuplieuxdist.form-valider');
  // bouton nav retour
const boutonRetour = document.querySelector('#btn-signuplieuxdist.form-retour');

 let marches;
 let postObjet;
 let inputMarche;
 let precisions_texte = '';


/**
 *
 */
const PostObj = class {
  constructor(denomination, type, pk_entite, newMarche , precesions, dateLieux, heureDeb, heureFin) {
    this.denomination = denomination;
    this.type = type;
    this.pk_entite = pk_entite;
    this.newMarche = newMarche;
    this.precs = precesions;
    this.date = dateLieux;
    this.heure_deb = heureDeb;
    this.heure_fin = heureFin;
  }
}

let postO = [];

// edit option, Flags :
let editElement;
let editID = "";
let value ="";
let amapFlag = false;
let precisionsFlag = false;
let sousTypeFlag = false;
let checkboxFlag = false;

/* *********EVENT LISTENERS ************/
selectElement.addEventListener('change', (event)=> {
  value = selectElement.options[selectElement.selectedIndex].text;

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
  }

});

clearMarche.addEventListener('click', (e) => {

  const marchesASupprimer = document.querySelectorAll('.marche-item');
  if (marchesASupprimer.length > 0) {
    marchesASupprimer.forEach(function(marche){
      list.removeChild(marche)
    });
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
  }
});

checkboxMarche.addEventListener('click', (e) => {
  if (checkboxMarche.checked == true) {
    newMarcheProd.classList.remove('d-none');
    allMarcheBox.classList.add('d-none');
    checkboxFlag = true;
  } else {
    newMarcheProd.classList.add('d-none');
    allMarcheBox.classList.remove('d-none');
    checkboxFlag = false;


  }
});

/*btnNewMarcheProd.addEventListener('click', (e) => {

  e.preventDefault();
  const addItem = marcheInputProd.value;
  console.log(addItem);
  const element = document.createElement("div");
  const classItems = ["d-flex", "marche-item"]
  element.classList.add(...classItems);
  element.innerHTML = `<p>${addItem}</p>
  <div class="btn-container ml-5">
  <button type="button" class="delete-btn">
  <i class="fas fa-trash"></i>
  </button>
  </div>`
  list.appendChild(element);
  marcheInputProd.value = '';
  adresseMarcheProd.value = '';
  displayAlert("Marché ajouté", "success");

});*/


// Ajout marché objet datum
addCircuit.addEventListener('click', () => {
  if (postObjet === undefined && checkboxFlag === false) {
    displayAlert("Aucun le lieux de distribution sélectionné.", "danger");
    return;
  }

  else if ( postObjet === undefined && checkboxFlag === true) {
    postObjet = new PostObj();
    console.log("toto");
    postObjet.precs = textAreaProd.value;
    // Seulement si case cochée "nouveau marché non connu".
    if (checkboxFlag === true) {
      // nv-marche-lieuxdist-nom
      postObjet.denomination = $('#nv-marche-lieuxdist-nom').val();
      // nv-marche-lieuxdist-adr
      postObjet.adr = $('#nv-marche-lieuxdist-adr').val();
      // timeInput
      postObjet.heure_deb = $('#timeInput').val();
      console.log(postO);
    }
  }



  if (!pkPresent(postObjet.pk_entite) && !denominationPresente(postObjet.denomination)) {
    
    postO.push(postObjet);
    /**
     * Suite à push OK : 
     * 1 - Mise à jour du récapitulatif : 
     * 2 - tout ré-initialiser.
     */

  } else {
    displayAlert("Le lieux de distribution " + postObjet.denomination 
      + " est déjà sélectionné dans votre liste.", "danger");
  }

  console.log(postO);
});

// validation des données post Json
console.log(boutonValider);
boutonValider.addEventListener('click', (e) => {
  e.preventDefault();
  dataToPost();
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
    limitTextAlert.textContent = "";
  }

  precisions_texte = target.value;
});

/* **********FUNCTIONS**************/

function showMarche(event) {
  let action = "Marché";
  const element = document.createElement('input');
  element.type = "text";
  element.classList.add('typeahead');
  let newEl = allMarcheBox.appendChild(element);
  document.body.insertAdjacentHTML('beforeend', newEl );
  inputMarche = document.querySelector('.typeahead');
  ajaxCall(action);
}

function showAmap() {

  const element = document.createElement('input');
  element.type = "text";
  const classTypeAhead = ["typeahead", "tt-input"]
  element.classList.add(...classTypeAhead);
  let newEl = amapTypeahead.appendChild(element);
  document.body.insertAdjacentHTML('beforeend', newEl );

  const button = document.createElement('button');
  const classesButton = ["btn", "btn-info", "btnAjoutAmap", "ml-5"]
  button.classList.add(...classesButton);
  button.textContent ='Ajouter une amap';
  let newButton = amapTypeahead.appendChild(button);
  document.body.insertAdjacentHTML('beforeend', newButton);
  const boutonAjoutMarche = document.querySelector('.btnAjoutAmap');
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

function clear(divToClear){
  while (divToClear.firstChild) divToClear.removeChild(divToClear.firstChild);
}

function showCircuitCout() {
  sousTypeSelect.classList.remove("d-none");
}

//supprimer un marché de la liste
function deleteItem(e){
  const element = e.currentTarget.parentElement.parentElement;
  const removeItem = element.firstChild.innerHTML;
  list.removeChild(element);
  displayAlert("Marché supprimé", "danger");
  postO = postO.filter(item => item.nom !== removeItem);
}

// display alert
function displayAlert(text, action) {
  alert.textContent = text;
  alert.classList.add(`alert-${action}`);
    // remove alert
    setTimeout(function () {
      alert.textContent = "";
      alert.classList.remove(`alert-${action}`);
    }, 2000);
  }

// vérifie si pk est présente : 
function pkPresent(pk_ent) {
  return postO.some(entite => entite.pk_entite === pk_ent);
}

// vérifie si la dénomination est présent : 
function denominationPresente(nom) {
  return postO.some(entite => entite.denomination === nom);
}

// envoie l'objet à poster dans l'input

function dataToPost(){
  postJson.value = JSON.stringify(postO);
  console.log(postJson.value);

}
// vérifie si le form est rempli
function checkForm() {



}

function ajaxCall(action) {

  $(document).ready(function() {

    $.ajax({ url: 'src/app/controller/ajaxhandlers/cet.qstprod.ajaxhandler.controller.signuplieuxdist.php',
      type: 'POST',
      data: {'action': action},
      dataType: 'JSON',
      success: function(response) {
      // Début si réseau de vente en circuit court
        if (action === "Reseau de vente en circuit court") {
          clear(selectSousType);
          const initOpt = document.createElement("option");
          initOpt.value ="0";
          initOpt.text = "--- Choississez un mode de distribution ---";
          selectSousType.add(initOpt, selectSousType.options[0]);
          const test = response.map((item) => `<option value="${item.id}">${item.sous_type}</option>`).join(' ');
          selectSousType.insertAdjacentHTML('beforeend', test);
        // fin si
        //Début si amap
        } else if (action === "amap" || "marché") {
          console.log(response);

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
  console.log(action)
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
    console.log(datum);
    postObjet = new PostObj(datum.denomination, value, datum.pk_entite, null, null, null, null);
  });
}
else if ( action === "Marché") {
  console.log(action)

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
    postObjet = new PostObj(datum.denomination, value, datum.pk_entite, null, null, null, null);
  });
      }

        // fin si
        }
      } // END Ajax success.
    }); // END Ajax.
  }); // END document.ready.
} // END fonction ajaxCall.

/**
 * TIMEPICKER
 */
 $(function() { $('#timeInput').timepicker(); });