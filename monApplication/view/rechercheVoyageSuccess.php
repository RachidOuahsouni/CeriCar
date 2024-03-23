<?php if (count($context->voyages) != 0): ?>
    <!-- Affichage des voyages sous forme de cartes -->
    <div class="voyage-cards">
        <?php foreach ($context->voyages as $voyage): ?>
            <!-- Carte pour chaque voyage -->
            <div class="voyage-card">
                <h3><?php echo $voyage->conducteur->nom; ?></h3>
                <p>Nombre de places : <?php echo $voyage->nbplace; ?></p>
                <p>Départ : <?php echo $voyage->trajet->depart; ?></p>
                <p>Arrivée : <?php echo $voyage->trajet->arrivee; ?></p>
                <p>Tarif : <?php echo $voyage->tarif; ?> €</p>
                <p>Heure de départ : <?php echo $voyage->heuredepart; ?></p>
                <p>Contraintes : <?php echo $voyage->contraintes; ?></p>
                <p>Distance : <?php echo $voyage->trajet->distance; ?> KM</p>
                <!-- Ajoutez un bouton de réservation ici -->
                <button class="btnReservation" data-idVoyage="<?php echo $voyage->id; ?>">Réserver</button>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <!-- Message si aucun voyage trouvé pour le trajet spécifié -->
    <p>Aucun voyage trouvÃ© pour le trajet.</p>
<?php endif; ?>
