<?php 
// On démarre la session si ce n'est pas déjà fait
session_start();
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

// On s'assure que le moniteur est bien connecté avant de chercher ses leçons
if (isset($_SESSION['numero_moniteur'])) {
    $_SESSION['lecons_moniteur'] = $unControleur->selectLeconsMoniteur($_SESSION['numero_moniteur']);
    // 👉 L'AJOUT EST ICI : On charge les examens à faire passer
    $_SESSION['examens_moniteur'] = $unControleur->selectExamensMoniteur($_SESSION['numero_moniteur']);
}

// 1. On affiche l'en-tête (le menu)
require_once("vue/moniteur/header_moniteur.php");

// 2. On affiche le planning (qui contient déjà son propre CSS et HTML)
require_once("vue/moniteur/vue_planning.php");

?>