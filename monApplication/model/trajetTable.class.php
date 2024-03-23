<?php
// Inclusion de la classe trajet
require_once "trajet.class.php";

class trajetTable {
  public static function getTrajet($depart, $arrivee) {
    // Récupération de l'EntityManager de Doctrine
    $em = dbconnection::getInstance()->getEntityManager();

    // Récupération du référentiel (repository) pour l'entité 'trajet'
    $trajetRepository = $em->getRepository('trajet');

    // Recherche d'un trajet avec les valeurs de départ et d'arrivée spécifiées
    $trajet = $trajetRepository->findOneBy(array('depart' => $depart, 'arrivee' => $arrivee));

    return $trajet; 
  }


}


?>