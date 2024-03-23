<div id="form-container"  style="width:50%">

    <div class="w3-container w3-center w3-margin w3-border w3-round-xxlarge w3-black">
        <h2 class="w3-center ">Inscrivez-vous</h2>
    </div>

    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" required><br>

    <label for="prenom">Prénom:</label>
    <input type="text" id="prenom" name="prenom" required><br>

    <label for="dateNaissance">Date de Naissance:</label>
    <input type="date" id="dateNaissance" name="dateNaissance" required><br>

    <label for="pseudo">Pseudo:</label>
    <input type="text" id="pseudo" name="pseudo" required><br>

    <label for="pass">Mot de Passe:</label>
    <input type="pass" id="pass" name="pass" required><br>

    <label for="avatar">Avatar:</label>

     <i id="AvatarHint" class="fas fa-user-circle w3-display-right w3-round-xxlarge" style="font-size:68px;"></i>

    <input type="text"  id="avatar" name="avatar" placeholder="Entrez le lien de l'avatar" oninput="prevAvatar(this.value)">
     
    <br>
    <br>
    <button id = "Profil"  onclick="submitInscriptionForm()">Inscription</button>

    <div style="padding-left:20px;">
	<h4><i class="fa fa-question-circle fa-lg questionMark"></i> <b>Déja membre ? </b></h4>
	<p style="margin-left:15px;"></p><a id="Connexion" class="btnAlt w3-button w3-round-xxlarge">Connectez-vous</a><p></p>
    </div>
</div>

