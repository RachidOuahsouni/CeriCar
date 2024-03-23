<?php

    // Affichage des r sultats
    echo "Voyages trouvés : " . count($context->voyages) . "<br>";

    // Affichage des d tails de chaque voyage
    foreach ($context->voyages as $voyage) {
        echo "Voyage ID: " . $voyage->id . ", Conducteur: " . $voyage->conducteur->nom . ", Trajet: " . $voyage->trajet->depart . " --> " . $voyage->trajet->arrivee . ", heure de depart:" .$voyage->heuredepart.", tarif:" .$voyage->tarif.", nb de place :" .$voyage->nbplace. "<br>";
    }

?>