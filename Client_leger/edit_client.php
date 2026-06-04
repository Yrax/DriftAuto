<?php 
ob_start(); // Magie anti-crash de redirection
session_start();
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

// ==========================================
// 1. LE PHP EN PREMIER (Rien ne doit s'afficher avant ça !)
// ==========================================
if (isset($_POST['Modifier'])) {
    // Mise à jour en base
    $unControleur->update_client($_POST);
    
    // Mise à jour de la session
    $_SESSION['pseudo_client'] = $_POST['pseudo_client'];
    $_SESSION['nom_client'] = $_POST['nom_client'];
    $_SESSION['prenom_client'] = $_POST['prenom_client'];
    $_SESSION['adresse_client'] = $_POST['adresse_client'];
    $_SESSION['code_postal_client'] = $_POST['code_postal_client'];
    $_SESSION['ville_client'] = $_POST['ville_client'];
    $_SESSION['date_naissance_client'] = $_POST['date_naissance_client'];
    $_SESSION['telephone_client'] = $_POST['telephone_client'];
    $_SESSION['email_client'] = $_POST['email_client'];
    
    // Redirection propre
    header("Location: client.php");
    exit(); // Toujours exit() après un header !
}

if (isset($_POST['Annuler'])) {
    header("Location: client.php");
    exit();
}

// ==========================================
// 2. L'AFFICHAGE DU SITE (Seulement maintenant !)
// ==========================================
require_once("vue/client/header_client.php");
?>

<style>
/* ... */
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&display=swap');

:root {
  --navy:      #1b3160;
  --blue:      #2563eb;
  --gold:      #f59e0b;
  --bg-cream:  #f5f3ef;
  --bg-light:  #eef2f9;
  --bg-white:  #ffffff;
  --text-dark: #0f1f3d;
  --text-muted:#6b7280;
  --border:    #e2e8f5;
  --red:       #ef4444;
  --font-display: 'Bebas Neue', sans-serif;
  --font-body:    'Outfit', sans-serif;
}

.edit-page {
  font-family: var(--font-body);
  background: var(--bg-cream);
  min-height: 60vh;
  padding: 60px 5vw 80px;
  color: var(--text-dark);
}

/* NOUVEAU : Le conteneur qui centre tout (titre + formulaire) */
.edit-container {
  max-width: 680px;
  margin: 0 auto; /* La magie opère ici : marges automatiques à gauche et à droite */
  width: 100%;
}

/* Titre */
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
.edit-page h3::before {
  content: '';
  display: inline-block;
  width: 5px;
  height: 2rem;
  background: var(--gold);
  border-radius: 3px;
}

/* Carte formulaire */
.edit-page form {
  background: var(--bg-white);
  border: 1.5px solid var(--border);
  border-radius: 16px;
  box-shadow: 0 4px 24px rgba(27,49,96,.10);
  overflow: hidden;
  width: 100%; /* S'adapte parfaitement au conteneur centré */
}

/* Table des champs */
.edit-page table {
  width: 100%;
  border-collapse: collapse;
}

.edit-page table tr {
  border-bottom: 1.5px solid var(--border);
  transition: background .15s;
}
.edit-page table tr:last-child { border-bottom: none; }
.edit-page table tr:not(:last-child):hover { background: var(--bg-light); }

/* Colonne label */
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

/* Colonne input */
.edit-page table td:last-child {
  padding: 12px 20px 12px 0;
}

/* Inputs */
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
  box-sizing: border-box; /* Évite que l'input ne dépasse de la table */
}
.edit-page input[type="text"]:focus,
.edit-page input[type="email"]:focus,
.edit-page input[type="date"]:focus,
.edit-page input[type="password"]:focus {
  border-color: var(--blue);
  box-shadow: 0 0 0 3px rgba(37,99,235,.12);
}

/* Ligne boutons */
.edit-page table tr:last-child td {
  padding: 20px 24px;
  background: var(--bg-light);
}
.edit-page table tr:last-child td:first-child {
  text-transform: none;
  letter-spacing: 0;
  width: auto;
}

/* Bouton Annuler */
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

/* Bouton Modifier */
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

        <h3>Profil de <?= ($_SESSION['pseudo_client'] ?? '') ?></h3>

        <form method="post">
            <table>
                <tr>
                    <td>Pseudo</td>
                    <td>
                        <input type="text" name="pseudo_client"
                        value="<?= ($_SESSION['pseudo_client'] ?? '') ?>">
                    </td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td>
                        <input type="text" name="nom_client"
                        value="<?= ($_SESSION['nom_client'] ?? '') ?>">
                    </td>
                </tr>
                <tr>
                    <td>Prénom</td>
                    <td>
                        <input type="text" name="prenom_client"
                        value="<?= ($_SESSION['prenom_client'] ?? '') ?>">
                    </td>
                </tr>
                <tr>
                    <td>Adresse</td>
                    <td>
                        <input type="text" name="adresse_client"
                        value="<?= ($_SESSION['adresse_client'] ?? '') ?>">
                    </td>
                </tr>
                <tr>
                    <td>Code Postal</td>
                    <td>
                        <input type="text" name="code_postal_client"
                        value="<?= ($_SESSION['code_postal_client'] ?? '') ?>">
                    </td>
                </tr>
                <tr>
                    <td>Ville</td>
                    <td>
                        <input type="text" name="ville_client"
                        value="<?= ($_SESSION['ville_client'] ?? '') ?>">
                    </td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td>
                        <input type="date" name="date_naissance_client"
                        value="<?= ($_SESSION['date_naissance_client'] ?? '') ?>">
                    </td>
                </tr>
                <tr>
                    <td>Téléphone</td>
                    <td>
                        <input type="text" name="telephone_client"
                        value="<?= ($_SESSION['telephone_client'] ?? '') ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="email" name="email_client"
                        value="<?= ($_SESSION['email_client'] ?? '') ?>">
                    </td>
                </tr>
                <tr>
                    <td>Mot de passe</td>
                    <td>
                        <input type="password" name="mdp_client"
                        placeholder="••••••••">
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
            <input type="hidden" name="numero_client" value="<?= ($_SESSION['numero_client'] ?? '') ?>">
        </form>

    </div>
</div>