<?php

// Vérifier si $trajet est défini et n'est pas null
if ($context->trajet) {
    // Affichage des résultats
    echo "Trajet trouvé : Départ: " . $context->trajet->depart ."  " . ", Arrivée:  " . $context->trajet->arrivee . "  " .", Distance:  " . $context->trajet->distance ;
    } else {
    echo "Aucun trajet trouvé.";
}

?>
