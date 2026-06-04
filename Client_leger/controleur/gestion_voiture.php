<h2> Gestion des voitures </h2>

<?php
$laVoiture = null;

if (isset($_GET['action']) && isset($_GET['numero_voiture'])) {
    $action = $_GET['action'];
    $numero_voiture = $_GET['numero_voiture'];

    switch ($action) {
        case "sup":
            $unControleur->delete_voiture($numero_voiture);
            break;

        case "edit":
            $laVoiture = $unControleur->selectWhere_voiture($numero_voiture);
            break;
    }
}

$lesLecons   = $unControleur->selectAll_lecons();

require_once("vue/voiture/vue_insert_voiture.php");

if (isset($_POST['Valider'])) {
    $unControleur->insert_voiture($_POST);
    echo "<br> Insertion réussie de la voiture.";
}

if (isset($_POST['Modifier'])) {
    $unControleur->update_voiture($_POST);
    header("Location: admin_session.php?page=5");
}

if (isset($_POST['Filtrer'])) {
    $lesVoitures = $unControleur->selectLike_voitures($_POST['filtre']);
} else {
    $lesVoitures = $unControleur->selectAll_voitures();
}

require_once("vue/voiture/vue_select_voitures.php");
?>
