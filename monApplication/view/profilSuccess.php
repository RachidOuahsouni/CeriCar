<div id="form-container-profil" style="width: 50%">

    <!-- Section pour le profil utilisateur -->
    <div class="w3-container w3-center w3-margin w3-border w3-round-xxlarge w3-black">
        <h2 class="w3-center ">Profil Utilisateur</h2>
    </div>

    <!-- Avatar de l'utilisateur -->
    <div><i id="AvatarHint" class="fas fa-user-circle w3-display-center w3-round-xxlarge" style="font-size: 98px;"></i></div>

    <!-- Informations de l'utilisateur -->
    <h1>Informations de l'utilisateur</h1>
    <p>ID: <?php echo $context->user->id; ?></p>
    <p>Nom: <?php echo $context->user->nom; ?></p>
    <p>Prénom: <?php echo $context->user->prenom; ?></p>

    <!-- Section pour les réservations -->
    <div class="w3-container w3-center w3-margin w3-border w3-round-xxlarge w3-black">
        <h2 class="w3-center ">Réservations</h2>
    </div>

    <?php if (is_array($context->reservations) && count($context->reservations) != 0): ?>
        <!-- Affiche le nombre de réservations -->
        <h1>Vous avez actuellement <?php echo count($context->reservations); ?> réservation(s) en cours :</h1>

        <!-- Tableau responsive pour afficher les réservations -->
        <div class="w3-responsive">
            <table class="w3-table custom-table-style">
                <thead>
                    <tr>
                        <th>Référence du voyage</th>
                        <th>Conducteur du voyage</th>
                        <th>Trajet</th>
                        <th>Tarif</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($context->reservations as $reservation): ?>
                        <!-- Affiche les détails de chaque réservation -->
                        <tr>
                            <td><?php echo $reservation->voyage->id; ?></td>
                            <td><?php echo $reservation->voyage->conducteur->nom . ' ' . $reservation->voyage->conducteur->prenom; ?></td>
                            <td><?php echo $reservation->voyage->trajet->depart . ' -> ' . $reservation->voyage->trajet->arrivee; ?></td>
                            <td><?php echo $reservation->voyage->tarif; ?> €</td>
                            <td>
                                <button class="annuler-button" data-idvoyage="<?php echo $reservation->voyage->id; ?>">Annuler</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <!-- Message si aucune réservation trouvée -->
        <p>Aucune réservation trouvée.</p>
    <?php endif; ?>
</div>
