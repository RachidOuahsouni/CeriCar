<?php
// Inclusion de la classe trajet
require_once "reservation.class.php";

class reservationTable {

    public static function getReservationByVoyage($voyage) {

        // R�cup�ration de l'EntityManager de Doctrine
        $em = dbconnection::getInstance()->getEntityManager();

        // R�cup�ration du r�f�rentiel (repository) pour l'entit� 'voyage'
        $reservationRepository = $em->getRepository('reservation');

        // Recherche de tous les voyages correspondant � un trajet sp�cifique
        $reservations = $reservationRepository->findBy(['voyage' => $voyage]);
        
        // V�rification si une reservation a �t� trouv�
        if ($reservations == false){
            echo 'Aucune reservation trouv�.';
                   }
                   
        return $reservations; 
        
    }

     public static function getReservationsByUserId($userId)
    {
        // R�cup�ration de l'EntityManager de Doctrine
        $em = dbconnection::getInstance()->getEntityManager();

        // R�cup�ration du r�f�rentiel (repository) pour l'entit� 'reservation'
        $reservationRepository = $em->getRepository('reservation');

        // Recherche de toutes les r�servations correspondant � un utilisateur sp�cifique
        $reservations = $reservationRepository->findBy(['voyageur' => $userId]);

        // V�rification si des r�servations ont �t� trouv�es
        if (empty($reservations)) {
            echo 'Aucune r�servation trouv�e.';
        }

        return $reservations;
    }


    public static function reserver($idvoyage, $idVoyageur)
{
    // Récupération de l'EntityManager de Doctrine
    $em = dbconnection::getInstance()->getEntityManager();

    // Récupération du voyage et du voyageur associés aux identifiants fournis
    $voyage = voyageTable::getVoyagesById($idvoyage);
    $voyageur = utilisateurTable::getUserById($idVoyageur);

    // Vérification de l'existence du voyage
    if (!$voyage) {
        echo 'Aucun voyage trouvé';
        return null;
    }

    // Vérification de la disponibilité des places dans le voyage
    if ($voyage->nbplace <= 0) {
        echo 'Réservation impossible';
        return null;
    }

    // Décrémentation du nombre de places disponibles dans le voyage
    $voyage->nbplace = $voyage->nbplace - 1;

    // Création d'une nouvelle instance de la classe Reservation
    $reservation = new reservation();
    $reservation->voyage = $voyage;
    $reservation->voyageur = $voyageur;

    // Persiste et flush pour sauvegarder la réservation et mettre à jour le voyage
    $em->persist($reservation);
    $em->flush();

    $em->persist($voyage);
    $em->flush();

    // Retourne la réservation créée
    return $reservation;
}


    public static function annulerReservation($idvoyage, $idVoyageur)
{
    $em = dbconnection::getInstance()->getEntityManager();

    // Récupérer le voyage correspondant à l'idvoyage
    $voyage = voyageTable::getVoyagesById($idvoyage);

    // Récupérer l'utilisateur correspondant à l'idVoyageur
    $voyageur = utilisateurTable::getUserById($idVoyageur);

    // Vérifier si le voyage et l'utilisateur existent
    if (!$voyage || !$voyageur) {
        echo 'Voyage ou utilisateur introuvable.';
        return null;
    }

    // Rechercher la réservation existante
    $reservationRepository = $em->getRepository('reservation');
    $reservation = $reservationRepository->findOneBy(['voyage' => $voyage, 'voyageur' => $voyageur]);

    // Vérifier si la réservation existe
    if (!$reservation) {
        echo 'Aucune réservation trouvée.';
        return null;
    }

    // Annuler la réservation
    $voyage->nbplace = $voyage->nbplace + 1; // Ajouter une place disponible
    $em->remove($reservation); // Supprimer la réservation
    $em->flush();

    return $reservation;
}

    


    
}

?>