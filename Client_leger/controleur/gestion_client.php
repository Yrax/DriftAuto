<h2> Gestion des clients </h2>

<?php
// ==========================================
// 1. TOUTE LA LOGIQUE (Avant le moindre HTML)
// ==========================================
$leClient = null;

// A. Gestion de la suppression et de l'édition
if (isset($_GET['action']) && isset($_GET['numero_client'])) {
    $action = $_GET['action'];
    $numero_client = $_GET['numero_client'];

    switch ($action) {
        case "sup":
            $unControleur->delete_client($numero_client);
            break;

        case "edit":
            $leClient = $unControleur->selectWhere_client($numero_client);
            break;
    }
}

// B. Gestion de l'insertion
if (isset($_POST['Valider'])) {
    $unControleur->insert_client($_POST);
    $message_insertion = "<br> Insertion réussie du client.";
}

// C. Gestion de la modification (LA REDIRECTION EST ICI)
if (isset($_POST['Modifier'])) {
    $unControleur->update_client($_POST);
    // Maintenant ça marche car aucun HTML n'a encore été affiché !
    header("Location: admin_session.php?page=2");
    exit; // IL FAUT TOUJOURS METTRE 'exit;' APRÈS UN HEADER
}


// ==========================================
// 2. PRÉPARATION DES DONNÉES (Pour les vues)
// ==========================================
$lesMoniteurs = $unControleur->selectAll_moniteurs();

if (isset($_POST['Filtrer'])) {
    $lesClients = $unControleur->selectLike_clients($_POST['filtre']);
} else {
    $lesClients = $unControleur->selectAll_clients();
}


// ==========================================
// 3. AFFICHAGE DU HTML (Maintenant on peut y aller !)
// ==========================================
?>

<?php
// On affiche le formulaire d'insertion / modification
require_once("vue/client/vue_insert_client.php");

// S'il y a un message d'insertion, on l'affiche ici
if (isset($message_insertion)) {
    echo $message_insertion;
}

// On affiche le tableau des clients
require_once("vue/client/vue_select_clients.php");
?>