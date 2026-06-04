<?php
session_start();
require_once("controleur/controleur.class.php");

$unControleur = new Controleur();
$message = ""; // Toujours bien d'initialiser la variable

if (isset($_POST['Connexion'])) {

    $identifiant = $_POST['identifiant'];
    $mdp = $_POST['mdp'];

    // 1. Vérifier si c'est un moniteur (ou un admin)
    if (str_contains($identifiant, "@driftauto.mo")) {

        $unMoniteur = $unControleur->select_moniteur($identifiant, $mdp);

        if ($unMoniteur == null) {
            $message = "Identifiants moniteur incorrects";
        } 
        else {
            // STOCKAGE DES SESSIONS COMMUNES
            $_SESSION['numero_moniteur'] = $unMoniteur['numero_moniteur'];
            $_SESSION['nom_moniteur'] = $unMoniteur['nom_moniteur'];
            $_SESSION['prenom_moniteur'] = $unMoniteur['prenom_moniteur'];
            $_SESSION['date_embauche'] = $unMoniteur['date_embauche'];
            $_SESSION['administrateur'] = $unMoniteur['administrateur'];
            $_SESSION['adresse_moniteur'] = $unMoniteur['adresse_moniteur'];
            $_SESSION['code_postal_moniteur'] = $unMoniteur['code_postal_moniteur'];
            $_SESSION['ville_moniteur'] = $unMoniteur['ville_moniteur'];
            $_SESSION['date_naissance_moniteur'] = $unMoniteur['date_naissance_moniteur'];
            $_SESSION['telephone_moniteur'] = $unMoniteur['telephone_moniteur'];
            $_SESSION['email_moniteur'] = $unMoniteur['email_moniteur'];
            
            // 👉 L'AJOUT EST ICI : On charge son planning dès la connexion
            $_SESSION['lecons_moniteur'] = $unControleur->selectLeconsMoniteur($unMoniteur['numero_moniteur']);

            // REDIRECTION SELON LE RÔLE
            if ($unMoniteur['administrateur'] == true ) {
                header("Location: admin_session.php");
                exit;   
            } elseif ($unMoniteur['administrateur'] == false ) {
                header("Location: moniteur_dashboard.php");
                exit;
            } else {
                $message = "Erreur de droits : rôle non défini."; 
            }
        }
    }
        else {
            // 2. Sinon → c'est un client
            $unUser = $unControleur->select_user($identifiant, $mdp);

            if ($unUser == null) {
                $message = "Veuillez vérifier vos identifiants";
            } else {
                $numero_client = $unUser['numero_client'];

                // SESSIONS FIXES DU CLIENT (On garde l'essentiel)
                $_SESSION['identifiant'] = $identifiant;
                $_SESSION['numero_client'] = $numero_client;
                $_SESSION['pseudo_client'] = $unUser['pseudo_client'];
                $_SESSION['nom_client'] = $unUser['nom_client'];
                $_SESSION['prenom_client'] = $unUser['prenom_client'];
                $_SESSION['date_naissance_client'] = $unUser['date_naissance_client'];
                $_SESSION['telephone_client'] = $unUser['telephone_client'];
                $_SESSION['adresse_client'] = $unUser['adresse_client'];
                $_SESSION['code_postal_client'] = $unUser['code_postal_client'];
                $_SESSION['ville_client'] = $unUser['ville_client'];
                $_SESSION['email_client'] = $unUser['email_client'];

                // On charge les formations si tu en as besoin sur la page d'accueil
                $_SESSION['formations_client'] = $unControleur->selectFormationsByClient($numero_client);

                // Redirection
                header("Location: index.php");
                exit;
            }
        }
}

echo "<br><br><br><br>";
// Inclusion de la vue qui contient le formulaire HTML
require_once("vue/vue_connexion.php");
?>