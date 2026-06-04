<?php 
session_start();
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

// ==========================================
// TRAITEMENT DU FORMULAIRE (Placé en haut pour éviter l'erreur Header)
// ==========================================
if (isset($_POST['Modifier'])) {
    // Mise à jour en base (Je laisse update_client comme tu l'as écrit)
    $unControleur->update_moniteur($_POST);

    // Mise à jour de la session
    $_SESSION['nom_moniteur']            = $_POST['nom_moniteur'];
    $_SESSION['prenom_moniteur']         = $_POST['prenom_moniteur'];
    $_SESSION['adresse_moniteur']        = $_POST['adresse_moniteur'];
    $_SESSION['code_postal_moniteur']    = $_POST['code_postal_moniteur'];
    $_SESSION['ville_moniteur']          = $_POST['ville_moniteur'];
    $_SESSION['date_naissance_moniteur'] = $_POST['date_naissance_moniteur'];
    $_SESSION['date_embauche']= $_POST['date_embauche'];
    $_SESSION['administrateur']= $_POST['administrateur'];
    $_SESSION['telephone_moniteur']      = $_POST['telephone_moniteur'];

    // Penser à ajouter un truc pour prévenir l'utilisateur qu'il y a eu maj
    header("Location: moniteur_dashboard.php");
    exit(); // Toujours ajouter exit() après une redirection
}

if (isset($_POST['Annuler'])) {
    header("Location: moniteur_dashboard.php");
    exit();
}

// ==========================================
// AFFICHAGE DE LA PAGE
// ==========================================
require_once("vue/moniteur/header_moniteur.php");
?>

<style>
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
    --red:         #ef4444;
    --font-display:'Bebas Neue', sans-serif;
    --font-body:   'Outfit', sans-serif;
}

.edit-page {
    font-family: var(--font-body);
    background: var(--bg-cream);
    min-height: 60vh;
    padding: 60px 5vw 80px;
    color: var(--text-dark);
}

.edit-container {
    max-width: 680px;
    margin: 0 auto; 
    width: 100%;
}

.edit-page h3 {
    font-family: var(--font-display);
    font-size: 2.4rem;
    letter-spacing: .05em;
    color: var(--text-dark);
    margin-bottom: 32px;
    display: flex;
    align-items: center;
    gap: 12px;
}

/* Le petit trait Doré pour le moniteur */
.edit-page h3::before {
    content: '';
    display: inline-block;
    width: 5px;
    height: 2rem;
    background: var(--gold);
    border-radius: 3px;
}

.edit-page form {
    background: var(--bg-white);
    border: 1.5px solid var(--border);
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(27,49,96,.10);
    overflow: hidden;
    width: 100%; 
}

.edit-page table {
    width: 100%;
    border-collapse: collapse;
}

.edit-page table tr {
    border-bottom: 1.5px solid var(--border);
    transition: background .15s;
}

.edit-page table tr:last-child { 
    border-bottom: none; 
}

.edit-page table tr:not(:last-child):hover { 
    background: var(--bg-light); 
}

.edit-page table td:first-child {
    padding: 16px 24px;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--text-muted);
    white-space: nowrap;
    width: 180px;
    background: transparent;
}

.edit-page table td:last-child {
    padding: 12px 20px 12px 0;
}

.edit-page input[type="text"],
.edit-page input[type="email"],
.edit-page input[type="date"],
.edit-page input[type="password"] {
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-family: var(--font-body);
    font-size: .92rem;
    color: var(--text-dark);
    background: var(--bg-white);
    outline: none;
    transition: border-color .2s, box-shadow .2s;
    box-sizing: border-box; 
}

/* NOUVEAU : Style pour les champs grisés (non modifiables) */
.edit-page input:disabled {
    background-color: #f1f5f9;
    color: #94a3b8;
    cursor: not-allowed;
    border-color: #e2e8f0;
}

.edit-page input:not(:disabled):focus {
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(37,99,235,.12);
}

.edit-page table tr:last-child td {
    padding: 20px 24px;
    background: var(--bg-light);
}

.edit-page table tr:last-child td:first-child {
    text-transform: none;
    letter-spacing: 0;
    width: auto;
}

.edit-page input[name="Annuler"] {
    padding: 11px 24px;
    background: transparent;
    color: var(--text-muted);
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-family: var(--font-body);
    font-size: .9rem;
    font-weight: 600;
    cursor: pointer;
    transition: border-color .2s, color .2s;
}

.edit-page input[name="Annuler"]:hover {
    border-color: var(--red);
    color: var(--red);
}

.edit-page input[name="Modifier"] {
    padding: 11px 28px;
    background: var(--navy);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-family: var(--font-body);
    font-size: .9rem;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 3px 14px rgba(27,49,96,.22);
    transition: background .25s, transform .2s, box-shadow .25s;
}

.edit-page input[name="Modifier"]:hover {
    background: var(--blue);
    transform: translateY(-2px);
    box-shadow: 0 6px 22px rgba(37,99,235,.35);
}

@media (max-width: 540px) {
    .edit-page table td:first-child { width: 120px; padding: 14px 14px; }
    .edit-page table td:last-child  { padding: 10px 14px 10px 0; }
    .edit-page form                 { border-radius: 12px; }
}
</style>

<div class="edit-page">
    <div class="edit-container">

        <h3> Profil de <?= $_SESSION['nom_moniteur'] ?> </h3>

        <form method="post">
            <table>
                <tr>
                    <td>Nom</td>
                    <td>
                        <input type="text" name="nom_moniteur" value="<?= $_SESSION['nom_moniteur'] ?>">
                    </td>
                </tr>

                <tr>
                    <td>Prénom</td>
                    <td>
                        <input type="text" name="prenom_moniteur" value="<?= $_SESSION['prenom_moniteur'] ?>">
                    </td>
                </tr>

                <tr>
                    <td>Adresse</td>
                    <td>
                        <input type="text" name="adresse_moniteur" value="<?= $_SESSION['adresse_moniteur'] ?>">
                    </td>
                </tr>

                <tr>
                    <td>Code Postal</td>
                    <td>
                        <input type="text" name="code_postal_moniteur" value="<?= $_SESSION['code_postal_moniteur'] ?>">
                    </td>
                </tr>

                <tr>
                    <td>Ville</td>
                    <td>
                        <input type="text" name="ville_moniteur" value="<?= $_SESSION['ville_moniteur'] ?>">
                    </td>
                </tr>

                <tr>
                    <td>Date de naissance</td>
                    <td>
                        <input type="date" name="date_naissance_moniteur" value="<?= $_SESSION['date_naissance_moniteur'] ?>">
                    </td>
                </tr>

                <tr>
                    <td>Téléphone</td>
                    <td>
                        <input type="text" name="telephone_moniteur" value="<?= $_SESSION['telephone_moniteur'] ?>">
                    </td>
                </tr>

                <tr>
                    <td>Date d'embauche</td>
                    <td>
                        <input type="date" name="date_embauche" value="<?= $_SESSION['date_embauche'] ?? '' ?>" disabled>
                    </td>
                </tr>

                <tr>
                    <td>Administrateur</td>
                    <td>
                        <input type="text" name="administrateur" value="<?= $_SESSION['administrateur'] ?? '' ?>" disabled>
                    </td>
                </tr>

                <tr>
                    <td>Mot de passe</td>
                    <td>
                        <input type="password" name="mdp_moniteur" placeholder="••••••••">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="Annuler" value="Annuler">
                    </td>
                    <td>
                        <input type="submit" name="Modifier" value="Modifier">
                    </td>
                </tr>
            </table>
            
            <input type="hidden" name="numero_moniteur" value="<?= $_SESSION['numero_moniteur'] ?>">
        </form>

    </div>
</div>