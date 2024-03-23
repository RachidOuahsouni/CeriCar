<?php
// Inclusion de la classe trajet
require_once "voyage.class.php";

class voyageTable {

    public static function getVoyagesByTrajet($trajet) {

        // Récupération le référentiel (repository) pour l'entité 'voyage'
        $em = dbconnection::getInstance()->getEntityManager();
        $voyageRepository = $em->getRepository('voyage');

        // Recherche de tous les voyages correspondant à un trajet spécifique
        $voyages = $voyageRepository->findBy(['trajet' => $trajet]);
        
        // Vérification si un voyage a été trouvé
        if ($voyages == false){
            echo 'Aucun trajet trouvé.';
                   }
        return $voyages; 
        
    }

    public static function getVoyagesById($idvoyage) {
        // Récupération le référentiel (repository) pour l'entité 'voyage'
        $em = dbconnection::getInstance()->getEntityManager();
        $voyageRepository = $em->getRepository('voyage');
    
        // Recherche du voyage par son ID
        $voyage = $voyageRepository->findOneBy(['id' => $idvoyage]);

    
        // Vérification si un voyage a été trouvé
        if ($voyage === null) {
            echo 'Aucun voyage trouvé pour l\'ID donné.';
        }
    
        return $voyage;
    }
    
   
   public static function getCorrespondance($depart,$arrivee,$nbPlace) {

        $em = dbconnection::getInstance()->getEntityManager()->getConnection() ;
		$query = $em->prepare('SELECT * FROM recherche_voyage(?, ?, ?)');
		$bool = $query->execute([$depart,$arrivee,$nbPlace]);
		if ($bool == false){
		return NULL;
		}
		return $query->fetchAll(); 
    }




public static function creationVoyage($conducteurId, $trajet, $heureDepart, $nbPlace, $tarif, $contraintes)
{
    // Obtenez l'EntityManager de Doctrine
    $em = dbconnection::getInstance()->getEntityManager(); // Connexion à la base de données.

    // Récupérer l'objet utilisateur correspondant à partir de l'identifiant
    $userRepository = $em->getRepository('utilisateur');
    $conducteur = $userRepository->find($conducteurId);

    // Vérifier si l'utilisateur existe déjà
    if (!$conducteur) {
    // Gérer l'erreur, l'utilisateur n'existe pas
    return null;
    }

    // Créer une nouvelle instance de la classe 'voyage' et définir les propriétés
    $newVoyage = new voyage();
    $newVoyage->trajet = $trajet;
    $newVoyage->conducteur = $conducteur; // Assigner l'objet utilisateur
    $newVoyage->tarif = $tarif;
    $newVoyage->nbplace = $nbPlace;
    $newVoyage->heuredepart = $heureDepart;
    $newVoyage->contraintes = $contraintes;

    // Ajouter le voyage à la base de données
    $em->persist($newVoyage);
    $em->flush();

    // Retourner le voyage nouvellement créé
    return $newVoyage;
}  



}

?>