<?php
ob_start(); // Sécurité pour les redirections
session_start();
require_once("controleur/controleur.class.php");

$unControleur = new Controleur();
$message = ""; // On initialise le message d'erreur à vide

// Si l'utilisateur clique sur le bouton d'inscription
if (isset($_POST['Valider'])) {
    
    //$mdp = $_POST['mdp_client'];
    $unControleur->insert_client($_POST);
    ?>
    <script>
    alert ("Insertion réussie de l'utilisateur.");

    window.location = "connexion.php";
    </script>

    <?php
}

// On charge ensuite le visuel (Le HTML/CSS de l'inscription)
require_once("vue/vue_insert_utilisateur.php");

ob_end_flush();
?>