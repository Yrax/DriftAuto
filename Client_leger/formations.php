<?php
ob_start(); 
session_start();
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

if ($page == 9) {
    session_destroy();
    unset($_SESSION['identifiant']);
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION['identifiant'])) {
    require_once("vue/header.php");
} else {
    require_once("vue/client/header_client.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Formations Détaillées</title>

    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f8fafc; 
            padding: 40px; 
        }

        .page-content {
            display: flex;
            justify-content: center;
        }

        .formations-container {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
            max-width: 1400px;
            justify-content: center;
        }

        .carte-simple {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 30px;
            width: 300px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .badge-populaire {
            position: absolute;
            top: -14px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #eff6ff;
            color: #3b82f6;
            font-size: 0.75rem;
            font-weight: 800;
            padding: 6px 16px;
            border-radius: 50px;
            text-transform: uppercase;
            border: 1px solid #bfdbfe;
            white-space: nowrap;
        }

        .entete-carte { border-bottom: 2px solid #f1f5f9; padding-bottom: 15px; margin-bottom: 20px; }
        .titre { margin: 0; color: #0f172a; font-size: 22px; text-transform: uppercase; font-weight: 900;}
        .heures { color: #64748b; font-size: 14px; margin-top: 5px; }
        .prix { font-size: 32px; font-weight: 900; color: #2563eb; margin-top: 15px; }
        .prix span { font-size: 16px; color: #64748b; font-weight: normal; }

        .liste-contenu { 
            list-style: none; 
            padding: 0; 
            margin: 0; 
            color: #475569; 
            line-height: 1.6;
            font-size: 0.95rem;
            flex-grow: 1;
        }
        .liste-contenu li { position: relative; padding-left: 28px; margin-bottom: 12px; }
        .liste-contenu li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #10b981;
            font-weight: bold;
            font-size: 18px;
        }

        .btn-choisir {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #0f172a;
            color: white;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 25px;
            transition: 0.2s;
        }
        .btn-choisir:hover { background-color: #334155; }

        .btn-disabled {
            background-color: #cbd5e1 !important;
            color: #64748b !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
        }
    </style>
</head>

<?php 
$choisies = $_SESSION['formations_client'] ?? [];
?>

<body>

<div class="page-content">
<form method="post">
<div class="formations-container">

<!-- PERMIS B -->
<div class="carte-simple">
    <span class="badge-populaire">Le plus populaire</span>

    <div class="entete-carte">
        <h2 class="titre">Permis B</h2>
        <div class="heures">Volume horaire : 21h</div>
        <div class="prix">1 299 €</div>
    </div>

    <ul class="liste-contenu">
        <li>Évaluation de départ (1h)</li>
        <li>Accès illimité au code en ligne (6 mois)</li>
        <li>20 heures de conduite</li>
        <li>Accompagnement examen</li>
    </ul>

    <?php $disabled = in_array(1, $choisies); ?>
    <button type="submit" name="formation" value="1"
        class="btn-choisir <?php if ($disabled) echo 'btn-disabled'; ?>"
        <?php if ($disabled) echo 'disabled'; ?>>
        <?= $disabled ? "Déjà choisi" : "Sélectionner"; ?>
    </button>
</div>

<!-- AAC -->
<div class="carte-simple">
    <div class="entete-carte">
        <h2 class="titre">AAC</h2>
        <div class="heures">Dès 15 ans</div>
        <div class="prix">999 €</div>
    </div>

    <ul class="liste-contenu">
        <li>Évaluation de départ</li>
        <li>20h de conduite</li>
        <li>Rendez-vous accompagnateur</li>
        <li>Suivi pédagogique</li>
    </ul>

    <?php $disabled = in_array(2, $choisies); ?>
    <button type="submit" name="formation" value="2"
        class="btn-choisir <?php if ($disabled) echo 'btn-disabled'; ?>"
        <?php if ($disabled) echo 'disabled'; ?>>
        <?= $disabled ? "Déjà choisi" : "Sélectionner"; ?>
    </button>
</div>

<!-- CODE EN LIGNE -->
<div class="carte-simple">
    <div class="entete-carte">
        <h2 class="titre">Code en ligne</h2>
        <div class="heures">En autonomie</div>
        <div class="prix">29 € <span>/ mois</span></div>
    </div>

    <ul class="liste-contenu">
        <li>Accès illimité</li>
        <li>Cours thématiques</li>
        <li>Tests blancs</li>
        <li>Suivi moniteur</li>
    </ul>

    <?php $disabled = in_array(3, $choisies); ?>
    <button type="submit" name="formation" value="3"
        class="btn-choisir <?php if ($disabled) echo 'btn-disabled'; ?>"
        <?php if ($disabled) echo 'disabled'; ?>>
        <?= $disabled ? "Déjà choisi" : "Sélectionner"; ?>
    </button>
</div>

<!-- STAGE INTENSIF -->
<div class="carte-simple">
    <div class="entete-carte">
        <h2 class="titre">Stage Intensif</h2>
        <div class="heures">Formation accélérée</div>
        <div class="prix">1 599 €</div>
    </div>

    <ul class="liste-contenu">
        <li>Stage code 3 jours</li>
        <li>Formation pratique rapide</li>
        <li>Suivi personnalisé</li>
        <li>Place examen prioritaire</li>
    </ul>

    <?php $disabled = in_array(4, $choisies); ?>
    <button type="submit" name="formation" value="4"
        class="btn-choisir <?php if ($disabled) echo 'btn-disabled'; ?>"
        <?php if ($disabled) echo 'disabled'; ?>>
        <?= $disabled ? "Déjà choisi" : "Sélectionner"; ?>
    </button>

</div>

</div>
</form>
</div>

</body>
</html>

<?php 

if (isset($_POST['formation'])) {

    if (!isset($_SESSION['email_client'])) {
        header("Location: connexion.php");
        exit;
    }

    if (!isset($_SESSION['formations_client'])) {
        $_SESSION['formations_client'] = [];
    }

    // Ajouter dans la session (pour désactiver les boutons)
    $_SESSION['formations_client'][] = $_POST['formation'];

    // Numéro du client
    $numero_client = $_SESSION['numero_client'];

    // Numéro de la formation (envoyé directement par le bouton)
    $numero_formation = intval($_POST['formation']);

    // Insérer dans Achete
    $unControleur->insert_achete([
        "numero_formation" => $numero_formation,
        "numero_client"    => $numero_client
    ]);

    header("Location: formations.php");
    exit;
}

require_once("vue/footer.php");

?>
