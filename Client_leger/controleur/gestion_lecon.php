<h2> Gestion des leçons </h2>

<?php
$laLecon = null;

if (isset($_GET['action']) && isset($_GET['numero_lecon'])) {
    $action = $_GET['action'];
    $numero_lecon = $_GET['numero_lecon'];

    switch ($action) {
        case "sup":
            $unControleur->delete_lecon($numero_lecon);
            break;

        case "edit":
            $laLecon = $unControleur->selectWhere_lecon($numero_lecon);
            break;
    }
}

$lesMoniteurs = $unControleur->selectAll_moniteurs();
$lesClients   = $unControleur->selectAll_clients();
$lesVoitures = $unControleur->selectAll_voitures();

require_once("vue/lecon/vue_insert_lecon.php");


// ----------------------
// INSERTION AVEC MESSAGE PROPRE
// ----------------------
if (isset($_POST['Valider'])) {

    $result = $unControleur->insert_lecon($_POST);

    if ($result === true) {
        echo "<p style='color:green;'>Leçon ajoutée avec succès.</p>";
    } else {
        echo "<p style='color:red;'>$result</p>";
    }
}


// ----------------------
// MODIFICATION
// ----------------------
if (isset($_POST['Modifier'])) {

    $result = $unControleur->update_lecon($_POST);

    if ($result === true) {
        header("Location: admin_session.php?page=3");
    } else {
        echo "<p style='color:red;'>$result</p>";
    }
}


// ----------------------
// AFFICHAGE LISTE
// ----------------------
if (isset($_POST['Filtrer'])) {
    $lesLecons = $unControleur->selectLike_lecons($_POST['filtre']);
} else {
    $lesLecons = $unControleur->selectAll_lecons();
}

require_once("vue/lecon/vue_select_lecons.php");
?>
