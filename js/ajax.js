// Fonction pour mettre � jour le bandeau de notification
function updateBandeau(message) {
    console.log("Updating bandeau with message:", message);
    $("#bandeauVoyage").text(message).show();
}

// Fonction pour charger le contenu initial
function loadInitialContent() {
    $.ajax({
        url: 'https://pedago.univ-avignon.fr/~uapv2000019/CeriCarProjet/squelette_L3/monApplicationAjax.php',
        type: 'GET',
        success: function (data) {
            $('#content-wrapper').html(data);

            // Mettre à jour le bandeau, etc., en fonction de l'état initial
            updateBandeau("ⓘ Bienvenue sur CERICar");
            $("#bandeauVoyage").show();

            // Vérifier si l'utilisateur est connecté après le chargement initial
            checkUserLoggedIn();
        }
    });
}

// Fonction pour vérifier si l'utilisateur est connecté
function checkUserLoggedIn() {
    $.ajax({
        url: 'https://pedago.univ-avignon.fr/~uapv2000019/CeriCarProjet/squelette_L3/monApplicationAjax.php?action=profil',
        type: 'GET',
        success: function (data) {
            if (data.includes("Erreur : Utilisateur non connecté")) {
                // L'utilisateur n'est pas connecté
                updateBandeauAfterLogout();
            } else {
                // L'utilisateur est connecté
                updateBandeauAfterLogin();
                $('#content-wrapper').html(data);
            }
        },
        error: function () {
            // Gérer l'erreur
        }
    });
}

// Appeler loadInitialContent au chargement de la page
$(document).ready(function () {
    loadInitialContent();
});

// Appeler loadInitialContent au chargement de la page
$(document).ready(function () {
    loadInitialContent();
});


function updateBandeauAfterLogin() {
    // Affiche les boutons "Profil" et "Déconnexion"
    $("#Profil").show();
    $("#logout").show();

    // Cache les boutons "Connexion" et "Inscription"
    $("#Connexion").hide();
    $("#Register").hide();
}

function updateBandeauAfterLogout() {
    // Afficher les boutons "Connexion" et "Inscription"
    $("#Connexion").show();
    $("#Register").show();

    // Cacher les boutons "Profil" et "Déconnexion"
    $("#Profil").hide();
    $("#logout").hide();
}

//Fonction pour faire une pr�visualisation de l'avatar

function prevAvatar(str) {//Fonction pour faire une pr�visualisation de l'avatar
	var avatarUrl=$("#avatar").val();
     $("#AvatarHint").html('<img class=" w3-display-topright w3-round-xxlarge" src="' + avatarUrl + '" width="68" height="68">');
}


// Fonction d�clench�e lors du clic sur le bouton de recherche
$(document).on('click', '#btnRecherche', function() {
    loadDoc();
});

function loadDoc() {
    var depart = $("#depart").val();
    var arrivee = $("#arrivee").val();
    var nbPlace = $("select[name=nbPlace]").val();

    // V�rification des champs de villes
    if (!depart) {
        updateBandeau("ⓘ Veuillez remplir la ville de départ.");
        return;
    }

    if (!arrivee) {
        updateBandeau("ⓘ Veuillez remplir la ville d'arrivée.");
        return;
    }

    if (!nbPlace) {
        updateBandeau("ⓘ Veuillez choisir le nombre de place.");
        return;
    }

    // Requ�te AJAX pour chercher des voyages en utilisant monApplicationajax
    $.ajax({
        url: "https://pedago.univ-avignon.fr/~uapv2000019/CeriCarProjet/squelette_L3/monApplicationAjax.php",
        method: "GET", // Utilisation de la méthode GET
        data: {
            action: "rechercheVoyageCorrespondance",
            depart: depart,
            arrivee: arrivee,
            nbPlace: nbPlace
        },
        success: function (response) {
            console.log(response);
            // Gestion de la r�ponse
            if (response.includes("Aucune correspondance trouvée pour le trajet.")) {
                updateBandeau("ⓘ Aucun voyage trouvé");
                $("#rechercheVoyageResultat").empty().hide();
            } else {
                $("#rechercheVoyageResultat").html(response).show();
                updateBandeau("ⓘ Recherche terminée"); // Mettre � jour le bandeau apr�s une recherche r�ussie

            }
        },
    });
}

// Fonction pour l'inscription
$(document).on('click', '#btnInscription', function() {
    submitInscriptionForm();
});

function submitInscriptionForm() {
    // Récupérer les valeurs des champs
    var nom = $("#nom").val();
    var prenom = $("#prenom").val();
    var dateNaissance = $("#dateNaissance").val();
    var pseudo = $("#pseudo").val();
    var pass = $("#pass").val();
    var avatar = $("#avatar").val();

    // Vérifier si tous les champs sont remplis
    if (!nom || !prenom || !dateNaissance || !pseudo || !pass) {
        updateBandeau("ⓘ Veuillez remplir tous les champs.");
        return;
    }

    // Effectuer la requête AJAX si tous les champs sont remplis
    $.ajax({
        url: "https://pedago.univ-avignon.fr/~uapv2000019/CeriCarProjet/squelette_L3/monApplicationAjax.php",
        method: "GET",
        data: {
            action: "inscription",
            nom: nom,
            prenom: prenom,
            dateNaissance: dateNaissance,
            pseudo: pseudo,
            pass: pass,
            avatar: avatar
        },
        success: function (data) {
            console.log(data);
            if (data.includes("Inscription réussie !")) {
                updateBandeau("ⓘ Inscription réussie");
                // Afficher la page de connexion
                // Charger le contenu du profil
                $('#content-wrapper').html(data);
            } else {
                updateBandeau("ⓘ Erreur lors de l'inscription. Veuillez réessayer.");
            }
        },
    });
}



// Fonction pour la connexion
$(document).on('click', '#btnConnexion', function() {
    submitConnexionForm();
});

function submitConnexionForm() {
    // Récupérer les valeurs des champs
    var pseudo = $("#pseudo").val();
    var pass = $("#pass").val();

    // Vérifier si tous les champs sont remplis
    if (!pseudo || !pass) {
        updateBandeau("ⓘ Veuillez remplir tous les champs.");
        return false;
    }

    // Effectuer la requête AJAX si tous les champs sont remplis
    $.ajax({
        url: "https://pedago.univ-avignon.fr/~uapv2000019/CeriCarProjet/squelette_L3/monApplicationAjax.php",
        method: "POST",
        data: {
            action: "login",
            pseudo: pseudo,
            pass: pass
        },
        success: function (data) {
            console.log(data);
            if (data.includes("Erreur sql")) {
                updateBandeau("ⓘ Erreur lors de la connexion. Veuillez réessayer.");
            } else {
                // Afficher la section de profil
                $("#form-container-connexion").hide();
                $("#form-container-profil").show();
                updateBandeauAfterLogin();

                // Mettre à jour le bandeau
                updateBandeau("ⓘ Connexion réussie, Bonjour " + pseudo + " !");
                
                // Charger le contenu du profil
                $('#content-wrapper').html(data);
            }
        },
    });
}

// Fonction pour la d�connexion
$(document).on('click', '#logout', function() {
    submitLogoutRequest();
});

function submitLogoutRequest() {
    // Effectuer la requ�te AJAX pour la d�connexion
    $.ajax({
        url: "https://pedago.univ-avignon.fr/~uapv2000019/CeriCarProjet/squelette_L3/monApplicationAjax.php",
        method: "POST",
        data: {
            action: "logout"
        },
        success: function (data) {
            console.log(data);
             if (data.includes("D"))
             {
                updateBandeau("Déconnexion réussie. Au revoir !");
                updateBandeauAfterLogout();
                console.log("667");
            }         
      },
    });
}

function reserver(idvoyage) {
    $.ajax({
    type: 'GET',
    url: 'https://pedago.univ-avignon.fr/~uapv2000019/CeriCarProjet/squelette_L3/monApplicationAjax.php?action=reservation&idvoyage='+idvoyage,
    success: function (data) {
        updateBandeau("ⓘ Réservation effectuée avec Success");
    },
    error: function (error) {
    console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
    }
    });
   }
   
    $(document).on('click', '#reserverButton', function () {
        reserver($(this).attr('class'));
    });

// Fonction pour proposer un voyage
$(document).on('click', '#btnProposerVoyage', function() {
    submitProposerVoyageForm();
});

function submitProposerVoyageForm() {
    // R�cup�rer les valeurs des champs
    var depart = $("#depart").val();
    var arrivee = $("#arrivee").val();
    var heureDepart = $("#heureDepart").val();
    var nbPlace = $("#nbPlace").val();
    var tarif = $("#tarif").val();  // Assurez-vous d'utiliser le bon ID pour le champ tarif
    var contraintes = $("#contraintes").val();

    // V�rifier si tous les champs sont remplis
    if (!depart || !arrivee || !heureDepart || !nbPlace || !tarif || !contraintes) {
        updateBandeau("ⓘ Veuillez remplir tous les champs.");
        return;
    }

    // Effectuer la requ�te AJAX si tous les champs sont remplis
    $.ajax({
        url: "https://pedago.univ-avignon.fr/~uapv2000019/CeriCarProjet/squelette_L3/monApplicationAjax.php",
        method: "POST",
        data: {
            action: "proposerVoyage",
            conducteurId: "<?php echo $context->user->id; ?>",
            depart: depart,
            arrivee: arrivee,
            heureDepart: heureDepart,
            nbPlace: nbPlace,
            tarif: tarif,
            contraintes: contraintes,
              
        },
        success: function (data) {
            console.log(data);
            if (data.includes("Creation de voyage reussie !")) {
                updateBandeau("ⓘ Proposition de voyage réussie");
            } else {
                updateBandeau("ⓘ Erreur lors de la proposition de voyage. Veuillez vous connecter.");
            }
        },
    });
}


// Fonction pour annuler une réservation
$(document).on('click', '.annuler-button', function () {
    var idVoyage = $(this).data('idvoyage');
    annulerReservation(idVoyage);
});

function annulerReservation(idVoyage) {
    $.ajax({
        type: 'GET',
        url: 'https://pedago.univ-avignon.fr/~uapv2000019/CeriCarProjet/squelette_L3/monApplicationAjax.php?action=annulerReservation&idvoyage=' + idVoyage,
        success: function (data) {
            // Mettez à jour le contenu ou effectuez d'autres actions nécessaires
            console.log(data);
            updateBandeau("ⓘ Annulation effectuée avec Success");
        },
        error: function (error) {
            console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
        }
    });
}


$(document).on('click', '.btnAlt', function() {
    var btn = $(this).attr('id');
    showAlt(btn);
});

function showAlt(btn) {
    console.log("showAlt called with button:", btn);
    var action;

    if (btn == 'Connexion') {
        console.log("Action: Connexion");
        action = "monApplicationAjax.php?action=connexion";
    } else if (btn == 'Register') {
        console.log("Action: Register");
        action = "monApplicationAjax.php?action=inscription";
    } else if (btn == 'Profil') {
        console.log("Action: Profil");
        action = "monApplicationAjax.php?action=profil";
        $("#form-container-profil").show();
    } else if (btn == 'Recherche') {
        console.log("Action: Recherche");
        action = "monApplicationAjax.php?action=submitForm";
    } else if (btn == 'Publier') {
        console.log("Action: proposerVoyage");
        action = "monApplicationAjax.php?action=proposerVoyage";
    } else if (btn == 'logout') {
        console.log("Action: logout");
        action = "monApplicationAjax.php?action=logout";
    } else {
        console.log("Action: Default");
        action = "monApplicationAjax.php";
    }

    var url = action;
    console.log("Fetching URL:", url);

    $.get(url, function (response) {
        console.log("Received response:", response);
        $("#content-wrapper").html(response);

        
        updateBandeau("ⓘ Bienvenue sur CERICar");
        $("#bandeauVoyage").show();
        console.log("oui");
    });
}

