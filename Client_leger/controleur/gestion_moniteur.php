<h2> Gestion des moniteurs </h2>

<?php
$leMoniteur = null;

if (isset($_GET['action']) && isset($_GET['numero_moniteur'])) {
    $action = $_GET['action'];
    $numero_moniteur = $_GET['numero_moniteur'];

    switch ($action) {
        case "sup":
            $unControleur->delete_moniteur($numero_moniteur);
            break;

        case "edit":
            $leMoniteur = $unControleur->selectWhere_moniteur($numero_moniteur);
            break;
    }
}

require_once("vue/moniteur/vue_insert_moniteur.php");

// B. Gestion de l'insertion
if (isset($_POST['Valider'])) {
    $unControleur->insert_moniteur($_POST);
    $message_insertion = "<br> Insertion réussie du moniteur.";
}


// ----------------------
//  MODIFICATION
// ----------------------
if (isset($_POST['Modifier'])) {

    // On récupère l'ancien moniteur
    $leMoniteur = $unControleur->selectWhere_moniteur($_POST['numero_moniteur']);

    // Préparation du tableau
    $tab = $_POST;

    // Mise à jour
    $unControleur->update_moniteur($tab);
    header("Location: admin_session.php?page=4");
}


// ----------------------
//  AFFICHAGE LISTE
// ----------------------
if (isset($_POST['Filtrer'])) {
    $lesMoniteurs = $unControleur->selectLike_moniteurs($_POST['filtre']);
} else {
    $lesMoniteurs = $unControleur->selectAll_moniteurs();
}

require_once("vue/moniteur/vue_select_moniteurs.php");
?>
