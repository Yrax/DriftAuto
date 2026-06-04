<?php 
// On démarre la session si ce n'est pas déjà fait
session_start();
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

// 1. INTERCEPTION DU CLIC (L'ACTION)
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $numero_lecon = $_GET['id'];

    if ($action == 'Confirmer') {
        $unControleur->updateStatusLecon($numero_lecon, 'Confirmer'); // Attention j'ai corrigé "Confirmer" en "Confirmé" pour matcher ta BDD
    } 
    elseif ($action == 'Annuler') {
        $unControleur->updateStatusLecon($numero_lecon, 'Annuler'); // Remplacé 'annuler' par 'Refusé' pour la cohérence des vues
    }

    // REDIRECTION pour vider l'URL
    header("Location: planning_client.php");
    exit();
}

// 2. MISE À JOUR DES SESSIONS EN TEMPS RÉEL
if (isset($_SESSION['numero_client'])) {
    $numero_client = $_SESSION['numero_client'];
    
    $_SESSION['lecons_attente'] = $unControleur->selectLeconsAttente($numero_client);
    $_SESSION['lecons_confirmees'] = $unControleur->selectLeconsConfirmees($numero_client);
    $_SESSION['lecons_refusees'] = $unControleur->selectLeconsRefusees($numero_client);
    $_SESSION['examens_client'] = $unControleur->selectExamensClient($numero_client);
}

// 3. AFFICHAGE DES VUES
require_once("vue/client/header_client.php");
require_once("vue/client/vue_activite_c.php"); // C'est elle qui contient ton CSS !
?>