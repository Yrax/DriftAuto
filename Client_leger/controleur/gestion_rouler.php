<h2> Gestion rouler </h2>

<?php
$leRouler = null;

if (isset($_GET['action'], $_GET['numero_voiture'], $_GET['annee'])) {
    $action = $_GET['action'];

    switch ($action) {
        case "sup":
            $unControleur->delete_rouler($_GET);
            break;

        case "edit":
            $leRouler = $unControleur->selectWhere_rouler($_GET);
            break;
    }
}

$lesVoitures = $unControleur->selectAll_voitures();
$lesMois     = $unControleur->selectAll_mois();

require_once("vue/vue_insert_rouler.php");

if (isset($_POST['Valider'])) {
    $unControleur->insert_rouler($_POST);
}

if (isset($_POST['Modifier'])) {
    $unControleur->update_rouler($_POST);
    header("Location: admin_session.php?page=8");
}

$lesRoulers = $unControleur->selectAll_rouler();
require_once("vue/vue_select_rouler.php");
?>
