<?php

// Vérifier si l'utilisateur a été trouvé
    if ($context->user) {
        // Affichage des résultats
        echo "Utilisateur trouvé : " . " (ID " . $context->user->id . ")" ." ". $context->user->nom . " " . $context->user->prenom ." " . $context->user->pass ;
    } else {
        echo "Utilisateur non trouvé.";
    }
?>
