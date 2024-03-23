<div id="form-container" style="width:50%">

    <div class="w3-container w3-center w3-margin w3-border w3-round-xxlarge w3-black">
        <h2 class="w3-center">Proposez un Voyage</h2>
    </div>

    <label for="depart">Départ:</label>
    <input type="text" id="depart" name="depart" required><br>

    <label for="arrivee">Arrivée:</label>
    <input type="text" id="arrivee" name="arrivee" required><br>

    <label for="heureDepart">Heure de Départ:</label>
    <input type="text" id="heureDepart" name="heureDepart" required><br>

    <label for="nbPlace">Nombre de Places:</label>
    <input type="text" id="nbPlace" name="nbPlace" required><br>

    <label for="tarif">Tarif:</label>
    <input type="text" id="tarif" name="tarif" required><br>

    <label for="contraintes">Contraintes:</label>
    <input type="text" id="contraintes" name="contraintes" required><br>
    <br>

    <button onclick="submitProposerVoyageForm()">Proposer le Voyage</button>

</div>
