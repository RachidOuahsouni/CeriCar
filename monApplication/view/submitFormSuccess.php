
<div id="form-container-recherche" style="width:50%">
    
    <div class="w3-container w3-center w3-margin w3-border w3-round-xxlarge w3-black">
        <h2 class="w3-center ">Le voyage démarre maintenant</h2>
    </div>
    
    <label class="w3-text-teal" for="depart"><b>Ville de départ :</b></label>
    <input type="text" id="depart" name="depart" placeholder="Entrez la ville de départ" required>
    <br>
    <br>
    <label class="w3-text-teal" for="arrivee"><b>Ville d'arrivée :</b></label>
    <input type="text" id="arrivee" name="arrivee" placeholder="Entrez la ville d'arrivée" required>
    <br>
    <br>
    <p id="nbPlace">
             <label class="w3-text-teal"><b>Nombre de Voyageurs :</b></label>
             <select class="w3-select w3-border w3-round" name="nbPlace" required="">
                    <option value="" disabled="" selected="">Choisissez le nombre de voyageurs</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
             </select>
     </p>
<br>
<br>
<br>

    <button onclick="loadDoc()">Rechercher ▶</button>
    
</div>
<div id="rechercheVoyageResultat"></div>