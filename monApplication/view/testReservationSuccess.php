<?php

// Affichage des résultats
echo "Réservations trouvées : " . count($context->reservations) . "<br>";

// Affichage des détails de chaque réservation
foreach ($context->reservations as $reservation) {
    echo "Réservation ID: " . $reservation->id . ", Voyageur: " . $reservation->voyageur->nom . ", Voyage: " . $reservation->voyage->trajet->depart . " --> " . $reservation->voyage->trajet->arrivee . "<br>";
}

?>
