<?php
if (is_array($context->correspondances) && count($context->correspondances) != 0):
    $directFound = false;
    $correspondanceFound=false;
?>

<!-- Affichage des correspondances sous forme de tableaux -->
<div class="voyage-container" style="display: inline-table; margin: 0 auto;">

    <div class="w3-row">
        <!-- Tableau pour les voyages directs -->
            <div id="voyage-direct" class="table-container w3-container w3-border w3-round-xxlarge containerAppli w3-col" style="width:100%">            <div class="w3-container w3-center w3-margin-bottom w3-margin-top w3-round-xxlarge w3-black">
                <h2>Voyages directs</h2>
            </div>
            <table class="w3-table">
                <thead>
                    <tr>
                        <th>Horaires</th>
                        <th>Prix</th>
                        <th>Ville de départ</th>
                        <th>Ville d'arrivée</th>
                        <th>Conducteur</th>
                        <th>Places restantes</th>
                        <th>Contraintes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($context->correspondances as $correspondance): ?>
                        <?php if (isset($correspondance['escales']) && $correspondance['escales'] == 0): ?>
                            <!-- Voyage direct -->
                            <tr>
                                <td><?php echo str_replace(['{', '}'], '', $correspondance['liste_horaires']); ?></td>
                                <td><?php echo str_replace(['{', '}'], '', $correspondance['tarifs']); ?></td>
                                <td><?php echo str_replace(['{', '}'], '', $correspondance['ville_depart']); ?></td>
                                <td><?php echo str_replace(['{', '}'], '', $correspondance['ville_arrivee']); ?></td>
                                <td><?php echo str_replace(['{', '}'], '', $correspondance['conducteur_prenom'] . ' ' . $correspondance['conducteur_nom']); ?></td>
                                <td><?php echo str_replace(['{', '}'], '', $correspondance['nb_places']); ?></td>
                                <td><?php echo str_replace(['{', '}'], '', $correspondance['contraintes']); ?></td>
                                <td>
                                    <?php
                                    if (isset($_SESSION['user_id'])) {
                                        
                                        // Utilisez le bon nom de variable pour l'identifiant du voyage
                                        echo '<button id="reserverButton" class="' . str_replace(['{', '}'], '', $correspondance['liste_id_voyage']) . '" onclick="reserver()">Reserver</button>';                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php $directFound = true; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if (!$directFound): ?>
                <!-- Message si aucune correspondance trouvée pour le trajet direct -->
                <p>Aucun voyage direct disponible.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Tableau pour les voyages avec correspondance -->
    <div id="voyage-correspondance" class="table-container w3-container w3-border w3-round-xxlarge containerAppli w3-col" style="width:100%">       
        <div class="w3-container w3-center w3-margin-bottom w3-margin-top w3-round-xxlarge w3-black">
            <h2>Voyages avec correspondance</h2>
        </div>
        <table class="w3-table">
            <thead>
                <tr>
                    <th>Horaires</th>
                    <th>Prix</th>
                    <th>Trajet de correspondance</th>
                    <th>Conducteur</th>
                    <th>Places restantes</th>
                    <th>Contraintes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($context->correspondances as $correspondance): ?>
                    <?php if (isset($correspondance['escales']) && $correspondance['escales'] !== 0): ?>
                        <!-- Voyage avec correspondance -->
                        <tr>
                            <td><?php echo str_replace(['{', '}'], '', $correspondance['liste_horaires']); ?></td>
                            <td><?php echo str_replace(['{', '}'], '', $correspondance['tarifs']); ?></td>
                            <td><?php echo str_replace(['{', '}'], '', $correspondance['liste_correspondances']); ?></td>
                            <td>
                                <?php
                                if (isset($correspondance['conducteur_prenom']) && isset($correspondance['conducteur_nom'])) {
                                    // Supprimez les caractères '{' et '}'
                                    $conducteurPrenom = str_replace(['{', '}'], '', $correspondance['conducteur_prenom']);
                                    $conducteurNom = str_replace(['{', '}'], '', $correspondance['conducteur_nom']);

                                    $conducteurPrenomArray = explode(',', $conducteurPrenom);
                                    $conducteurNomArray = explode(',', $conducteurNom);

                                    // Initialisez un tableau pour stocker les noms formatés
                                    $conducteurs = [];

                                    // Parcourez les deux tableaux simultanément et ajoutez les noms au tableau
                                    foreach (array_map(null, $conducteurPrenomArray, $conducteurNomArray) as [$prenom, $nom]) {
                                        $conducteurs[] = $prenom . ' ' . $nom;
                                    }

                                    // Utilisez implode pour ajouter une virgule entre chaque conducteur
                                    echo implode(', ', $conducteurs);
                                }
                                ?>
                            </td>

                           
                            <td><?php echo str_replace(['{', '}'], '', $correspondance['nb_places']); ?></td>
                            <td><?php echo str_replace(['{', '}'], '', $correspondance['contraintes']); ?></td>
                            <td>
                            <?php
                                if (isset($_SESSION['user_id'])) {
                                    // Récupérez le contenu entre les accolades et éliminez les virgules
                                    $voyageDetails = str_replace(['{', '}'], '', $correspondance['liste_id_voyage']);
                                    
                                    // Convertissez la chaîne en un tableau d'entiers
                                    $voyageDetailsArray = array_map('intval', explode(',', $voyageDetails));

                                    // Affichez chaque élément du tableau
                                    foreach ($voyageDetailsArray as $detail) {
                                    }

                                    // Ajoutez le bouton de réservation pour chaque voyage de l'itinéraire
                                    foreach ($voyageDetailsArray as $voyageId) {
                                        echo '<button id="reserverButton" class="' . $voyageId . '" onclick="reserver()">Réserver</button>';
                                    }
                                }
                            ?>
                            </td>

                        <?php $correspondanceFound = true; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if (!$correspondanceFound): ?>
            <!-- Message si aucune correspondance trouvée pour le trajet avec correspondance -->
            <p>Aucun voyage avec correspondance disponible.</p>
        <?php endif; ?>
    </div>

</div>

<?php else: ?>
    <!-- Message si aucune correspondance trouvée pour le trajet spécifié -->
    <p>Aucune correspondance trouvée pour le trajet.</p>
<?php endif; ?>
