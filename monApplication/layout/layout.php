<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://pedago.univ-avignon.fr/~uapv2000019/CeriCarProjet/squelette_L3/css/style.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <title>CeriCar</title>
</head>

<body>
    <div id="bandeauCERICar" class="w3-white w3-bar w3-card w3-xxlarge w3-mobile" style="display: flex; justify-content: space-between; align-items: center; padding: 10px;">

        <div class="w3-col" style="width: 20%;">
            <a class="w3-button w3-theme w3-xlarge w3-round-large btnAlt" id="index" style="display: flex; align-items: center;">
                <img src="https://pedago.univ-avignon.fr/~uapv2000019/CeriCarProjet/squelette_L3/images/logo.png" alt="logo" width="100" height="85" style="margin-right: 10px;"> CERICar
            </a>
        </div>

        <div class="w3-col" style="width: 70%; display: flex; justify-content: flex-end; gap: 20px;">

            <a class="w3-button w3-round-xxlarge w3-black w3-large btnAlt" id="Recherche">Rechercher <i class="fas fa-search" style="margin-left: 5px;"></i></a>
            <a class="w3-button w3-round-xxlarge w3-black w3-large btnAlt" id="Publier">Proposer un Voyage<i class="fa fa-plus-square" style="font-size:24px; margin-left: 5px;"></i></a>
            <a class="w3-button w3-round-xxlarge w3-black w3-large btnAlt" id="Profil" style="display: none;"><i class="fas fa-user" style="margin-right: 5px;"></i>Profil</a>
            <a class="w3-button w3-round-xxlarge w3-black w3-large btnAlt" id="logout"style="display: none; "><i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i>Déconnexion</a>
            <a class="w3-button w3-round-xxlarge w3-black w3-large btnAlt" id="Connexion"><i class="fas fa-sign-in-alt" style="margin-right: 5px;"></i> Connexion</a>
            <a class="w3-button w3-round-xxlarge w3-black w3-large btnAlt" id="Register"><i class="fas fa-user" style="margin-right: 5px;"></i>Inscription</a>

        </div>


    </div>
    <br>
    <br>
    <br>
    <div id="bandeauVoyage"><?php echo " ⓘ Bienvenue sur CERICar " ?></div>
    <br>
    <br>



    <div id="content-wrapper">


        <div id="page">

            <?php if ($context->error) : ?>
                <div id="flash_error" class="error">
                    <?php echo $context->error; ?>
                </div>
            <?php endif; ?>

            <?php if ($context->notification) : ?>
                <div id="flash_notification" class="notification">
                    <?php echo $context->notification; ?>
                </div>
            <?php endif; ?>

            <div id="page_maincontent">

                <?php include($template_view); ?>
            </div>

        </div>
        <script src="https://pedago.univ-avignon.fr/~uapv2000019/CeriCarProjet/squelette_L3/js/ajax.js"></script>

    </div>

    <footer class="w3-container w3-black w3-padding-32 w3-center">
        <div class="w3-xlarge w3-padding-32">
            <i class="fab fa-facebook w3-hover-opacity"></i>
            <i class="fab fa-instagram w3-hover-opacity"></i>
            <i class="fab fa-snapchat-ghost w3-hover-opacity"></i>
            <i class="fab fa-pinterest w3-hover-opacity"></i>
            <i class="fab fa-twitter w3-hover-opacity"></i>
            <i class="fab fa-linkedin-in w3-hover-opacity"></i>
        </div>
        <p>footer</p>
    </footer>
</body>

</html>