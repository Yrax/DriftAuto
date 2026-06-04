<?php
// 1. LA MAGIE ICI : On active la mise en mémoire tampon pour éviter les erreurs de redirection !
ob_start(); 
session_start();

// 2. SÉCURITÉ : On vérifie si la personne est connectée
if (!isset($_SESSION['email_moniteur'])) {
    header("Location: connexion.php"); 
    exit;
}

// 3. GESTION DE LA DÉCONNEXION (Placée avant le HTML)
if (isset($_GET["page"]) && $_GET["page"] == 9) {
    session_destroy();
    header("Location: index.php"); 
    exit; 
}

require_once("controleur/controleur.class.php");
$unControleur = new Controleur();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DriftAuto - Administration</title>
    
    <style>
        /* ════════════════════════════
           CSS ESPACE ADMINISTRATEUR
           ════════════════════════════ */
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&display=swap');

        :root {
            --navy:        #1b3160;
            --blue:        #2563eb;
            --gold:        #f59e0b;
            --bg-cream:    #f5f3ef;
            --bg-light:    #eef2f9;
            --bg-white:    #ffffff;
            --text-dark:   #0f1f3d;
            --text-muted:  #6b7280;
            --border:      #e2e8f5;
            --shadow:      0 8px 30px rgba(27,49,96,.06);
        }

        body {
            margin: 0;
            padding: 0;
            background-color: var(--bg-light); 
            font-family: 'Outfit', sans-serif;
            color: var(--text-dark);
        }

        center {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 5vw;
        }

        h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3.5rem;
            color: var(--navy);
            letter-spacing: 0.05em;
            margin-bottom: 40px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.05);
        }

        .menu-admin {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            background: var(--bg-white);
            padding: 25px 40px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            border: 1.5px solid var(--border);
            max-width: 1000px;
            width: 100%;
            box-sizing: border-box;
        }

        .menu-admin a {
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            transition: transform 0.3s ease, background 0.3s ease;
            padding: 15px;
            border-radius: 16px;
        }

        .menu-admin a:hover {
            transform: translateY(-8px);
            background: rgba(37,99,235,.06);
        }

        .menu-admin img {
            width: 70px !important;
            height: 70px !important;
            object-fit: contain; 
            filter: drop-shadow(0 4px 6px rgba(27,49,96,.15));
            transition: filter 0.3s;
        }

        .menu-admin a:first-child img {
            width: 120px !important;
            height: auto !important;
        }

        h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.8rem;
            color: var(--navy);
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: 700;
        }

        p {
            color: var(--text-muted);
            font-size: 1.1rem;
            margin-top: 0;
        }
    </style>
</head>
<body>
    <center>
        <h1>DriftAuto - Espace Administrateur</h1>
        
        <div class="menu-admin">
            <a href="admin_session.php?page=1"><img src="assets/images/logoDriftAuto.png" width="8%" height="8%" alt="Accueil"></a>
            <a href="admin_session.php?page=2"><img src="assets/images/client.png" width="100" height="100" alt="Clients"></a>
            <a href="admin_session.php?page=3"><img src="assets/images/leçon.png" width="100" height="100" alt="Leçons"></a>
            <a href="admin_session.php?page=4"><img src="assets/images/moniteur.png" width="100" height="100" alt="Moniteurs"></a>
            <a href="admin_session.php?page=5"><img src="assets/images/voiture.png" width="100" height="100" alt="Voitures"></a>
            <a href="admin_session.php?page=9"><img src="assets/images/deconnexion.png" width="100" height="100" alt="Déconnexion"></a>
        </div>

        <br><br>

        <?php 
        // 4. GESTION DU ROUTAGE DES PAGES
        if(isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }

        switch($page){
            case 1 : 
                echo "<h3>Bienvenue " . $_SESSION['prenom_moniteur'] . " dans l'espace d'administration.</h3>";
                echo "<p>Sélectionnez une option dans le menu ci-dessus pour commencer.</p>";
                break;
            case 2 : require_once ("controleur/gestion_client.php") ; break;
            case 3 : require_once ("controleur/gestion_lecon.php") ; break;
            case 4 : require_once ("controleur/gestion_moniteur.php") ; break;
            case 5 : require_once ("controleur/gestion_voiture.php") ; break;
            case 6 : require_once ("controleur/gestion_modele.php") ; break;
            case 7 : require_once ("controleur/gestion_mois.php") ; break;
            case 8 : require_once ("controleur/gestion_rouler.php") ; break;
            // Le case 9 n'est plus nécessaire ici car on le gère tout en haut !
            default : 
                if ($page != 9) { // Sécurité pour ne pas afficher l'erreur lors de la déconnexion
                    require_once ("controleur/erreur.php") ; 
                }
                break;
        }
        ?>
    </center>
</body>
</html>
<?php 
// 5. On libère et on envoie le HTML stocké en mémoire vers le navigateur
ob_end_flush(); 
?>