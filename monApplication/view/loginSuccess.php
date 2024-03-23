<?php


// Vérifier si $context->login est défini et est un objet
if ($context->login) {
    // Accéder aux proprietes seulement si $context->login est un objet
    $_SESSION['prenom'] = $context->login->prenom;
    $_SESSION['id'] = $context->login->id;

} else {
    // G�rer le cas oé $context->login n'est pas défini ou n'est pas un objet

    echo "Erreur de connexion"; 
}
?>
