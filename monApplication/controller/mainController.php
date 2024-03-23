<?php

class mainController
{

	public static function helloWorld($request,$context)
	{
		$context->mavariable="hello world";
		$context->notification="C'est une notif";
		return context::SUCCESS;
	}


	public static function index($request,$context){
		
		return context::SUCCESS;
	}

	public static function superTest($request, $context)
	{
		// Vérification si les paramétres existent
		if (isset($request['param1']) && isset($request['param2'])) {
			// Construire le message en utilisant les paramétres du tableau $request
			$message = "j'ai compris {$request['param1']}, super : {$request['param2']}";
			// Affectez le message au contexte pour l'affichage
			$context->mavariable = $message;
		} else {
			// Gérez le cas ou les parametres sont manquants
			$context->mavariable = "Les paramétres param1 et param2 sont manquants.";
		}

		return context::SUCCESS;
	}


	public static function bandeauVoyage($request, $context)
{

     return context::SUCCESS;
}


	public static function testUtilisateur($request, $context)
{
    // Test de la classe utilisateur
    $context->user = utilisateurTable::getUserById(4);

     return context::SUCCESS;
}

  	public static function testTrajet($request, $context)
{
    // Test de la classe trajet
    $context->trajet = trajetTable::getTrajet("Paris", "Lille");

   	return context::SUCCESS;
}


    public static function testVoyage($request, $context)
{
    // Test de la classe voyage
    $context->trajet = trajetTable::getTrajet("Paris", "Lyon");
    $context->voyages = voyageTable::getVoyagesByTrajet($context->trajet);

    return context::SUCCESS;
}

    public static function testReservation($request, $context)
{
    // Test de la classe reservation
    $context->voyage = voyageTable::getVoyagesByTrajet(355); 
    $context->reservations = reservationTable::getReservationByVoyage($context->voyage);
  
    return context::SUCCESS;
}


public static function rechercheVoyage($request, $context)
{
    // Obtenir le trajet en fonction des villes de départ et d'arrivée
    $context->trajet = trajetTable::getTrajet($request["depart"], $request["arrivee"]);

    // Obtenir les voyages associés au trajet
    $context->voyages = voyageTable::getVoyagesByTrajet($context->trajet);

    // Indique une exécution réussie
    return context::SUCCESS;
}

public static function rechercheVoyageCorrespondance($request, $context)
{
    // Obtenir les correspondances en fonction des villes de d�part, d'arriv�e et du nombre de place
        $correspondances = voyageTable::getCorrespondance(
            $request["depart"],
            $request["arrivee"],
            $request["nbPlace"]
        );

        // Ajouter les correspondances au contexte
        $context->correspondances = $correspondances;

        // Indique une ex�cution r�ussie
        return context::SUCCESS;
}



public static function submitForm ($request, $context)
{
	// Indique une soumission de formulaire réussie
    return context::SUCCESS; 
}



public static function inscription($request, $context)
{
    // Assurez-vous que les donn�es n�cessaires sont pr�sentes
    if (
        isset($request['nom'], $request['prenom'], $request['dateNaissance'], $request['pseudo'], $request['pass'], $request['avatar'])
        && !empty($request['nom']) && !empty($request['prenom']) && !empty($request['dateNaissance']) && !empty($request['pseudo']) && !empty($request['pass'])&& !empty($request['avatar'])
    ) {
        // R�cup�rez les donn�es du formulaire
        $nom = $request['nom'];
        $prenom = $request['prenom'];
        $dateNaissance = $request['dateNaissance'];
        $pseudo = $request['pseudo'];
        $pass = $request['pass'];
        $avatar = $request['avatar'];

        // Appel � la m�thode d'inscription d'utilisateurTable
        utilisateurTable::inscription($nom, $prenom, $dateNaissance, $pseudo, $pass, $avatar);
      
        echo "Inscription réussie !";

       }
     
    return context::SUCCESS ; 
}

public static function login($request, $context)
{
    // Assurez-vous que les donn�es n�cessaires sont pr�sentes
    if (isset($request['pseudo'], $request['pass']) && !empty($request['pseudo']) && !empty($request['pass'])) {
        // R�cup�rez les donn�es du formulaire
        $pseudo = $request['pseudo'];
        $pass = $request['pass'];

        // Appel � la m�thode de connexion d'utilisateurTable
        $context->login = utilisateurTable::getUserByLoginAndPass($pseudo, $pass);

        if ($context->login) {
            // R�cup�rez l'ID de l'utilisateur
            $userId = $context->login->id;

            // Stockez l'ID dans la session
            $_SESSION['user_id'] = $userId;
         }
 
      }
    return context::SUCCESS;
}

 public static function connexion($request, $context)
{
    return context::SUCCESS;
}

public static function logout($request,$context)
{
    return context::SUCCESS;
}

public static function inscrit($request,$context)
{
    return context::SUCCESS;
}

 public static function profil($request, $context)
{
    // Assurez-vous que l'utilisateur est connect� en v�rifiant l'ID dans la session
    if (isset($_SESSION['user_id'])) {
        // R�cup�rez les informations de l'utilisateur � partir de la base de donn�es en utilisant son ID
        $userId = $_SESSION['user_id'];
        $context->user = utilisateurTable::getUserById($userId);

        // R�cup�rez les r�servations de l'utilisateur
        $context->reservations = reservationTable::getReservationsByUserId($userId);
     }

        return context::SUCCESS;
}


public static function reservation($request, $context)
{
    // Afficher le contenu du tableau $request à des fins de débogage
    var_dump($request);

    // Vérifier si la clé "idVoyage" est définie dans le tableau $request
    if (isset($request["idvoyage"])) {
        // La clé "idVoyage" est définie, appel de la fonction reserver
        $context->reservation = reservationTable::reserver($request["idvoyage"], $_SESSION["user_id"]);
        return context::SUCCESS;
    } else {
        // La clé "idVoyage" n'est pas définie, gérer cette situation en conséquence
        echo 'La clé "idVoyage" n\'est pas définie dans le tableau $request.';
        return context::ERROR; // Ou tout autre code d'erreur que vous souhaitez utiliser
    }
}

public static function annulerReservation($request, $context)
{
    // Vérifier si la clé "idVoyage" est définie dans le tableau $request
    if (isset($request["idvoyage"])) {
        // La clé "idVoyage" est définie, appel de la fonction annulerReservation
        $context->reservation = reservationTable::annulerReservation($request["idvoyage"], $_SESSION["user_id"]);
        return context::SUCCESS;
    } else {
        // La clé "idVoyage" n'est pas définie, gérer cette situation en conséquence
        echo 'La clé "idVoyage" n\'est pas définie dans le tableau $request.';
        return context::ERROR; 
    }
}



public static function proposerVoyage($request, $context)
{
    // Assurez-vous que les indices nécessaires existent dans $request
    if (
        isset($request['depart'], $request['arrivee'], $request['heureDepart'], $request['nbPlace'], $request['tarif'], $request['contraintes'])
        && !empty($request['depart']) && !empty($request['arrivee']) && !empty($request['heureDepart']) && !empty($request['nbPlace']) && !empty($request['tarif']) && !empty($request['contraintes'])
    ) {
        // Récupérez les données du formulaire
        $depart = $request['depart'];
        $arrivee = $request['arrivee'];
        $heureDepart = $request['heureDepart'];
        $nbPlace = $request['nbPlace'];
        $tarif = $request['tarif'];
        $contraintes = $request['contraintes'];

        // Utilisez getTrajet pour obtenir le trajet correspondant aux villes de départ et d'arrivée
        $trajet = trajetTable::getTrajet($depart, $arrivee);

        if ($trajet) {
            // Si le trajet existe, utilisez creationVoyage pour créer un nouveau voyage
            $userId = $_SESSION['user_id'];
            voyageTable::creationVoyage($userId, $trajet, $heureDepart, $nbPlace, $tarif, $contraintes);

            echo "Creation de voyage reussie !";
        } else {
            echo "Le trajet spécifié n'existe pas.";
        }
    } 

    return context::SUCCESS;
}



}
