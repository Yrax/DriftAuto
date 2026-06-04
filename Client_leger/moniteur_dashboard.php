<?php 
session_start();
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

// ==========================================
// 1. LOGIQUE PHP EN PREMIER (Pour éviter le crash de redirection)
// ==========================================
if (isset($_POST['Modifier'])) {
    header("Location: edit_moniteur.php");
    exit(); // Ne jamais oublier le exit() après un header !
}

// ==========================================
// 2. AFFICHAGE DES VUES
// ==========================================
require_once("vue/moniteur/header_moniteur.php");
require_once("vue/moniteur/vue_profil_moniteur.php");
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700&display=swap');

/* ════════════════════════════
   ACTIONS MONITEUR (Bouton Modifier)
   ════════════════════════════ */
.moniteur-actions {
    font-family: 'Outfit', sans-serif;
    padding: 0 5vw 60px;
    background: #f5f3ef; /* Fond de la page profil */
    display: flex;
    justify-content: center; /* Centre le bouton parfaitement */
}

.moniteur-actions form {
    margin: 0;
}

.moniteur-actions input[type="submit"] {
    background: #1b3160; /* Bleu Navy */
    color: #ffffff;
    padding: 14px 36px;
    border: none;
    border-radius: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: 0.95rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(27,49,96,.2);
    transition: background .25s, transform .2s, box-shadow .25s, border-color .25s;
    
    /* La petite touche Staff : Liseré doré en bas du bouton */
    border-bottom: 3px solid #f59e0b; 
}

.moniteur-actions input[type="submit"]:hover {
    background: #234080; /* Bleu Navy un peu plus clair au survol */
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(27,49,96,.3);
    border-bottom-color: #fbbf24; /* Or plus clair au survol */
}
</style>

<div class="moniteur-actions">
    <form method="post">
        <input type="hidden" name="numero_moniteur" value="<?= $_SESSION['numero_moniteur'] ?>">
        
        <input type="submit" name="Modifier" value="Modifier mes informations">
    </form>
</div>