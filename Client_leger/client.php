<?php 
session_start();
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

// ==========================================
// 1. LOGIQUE PHP (Toujours tout en haut !)
// ==========================================

// Gestion du bouton Modifier
if (isset($_POST['Modifier'])) {
    header("Location: edit_client.php");
    exit(); // Toujours mettre un exit après une redirection
}

// Gestion du bouton Supprimer
if (isset($_POST['Supprimer'])) {
    $unControleur->delete_client($_SESSION['numero_client']);
    session_destroy();
    header("Location: index.php?page=accueil");
    exit();
}

// ==========================================
// 2. AFFICHAGE HTML ET VUES
// ==========================================

require_once("vue/client/header_client.php");
require_once("vue/client/vue_profil_client.php");
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap');

.profil-actions {
  font-family: 'Outfit', sans-serif;
  padding: 0 5vw 60px;
  background: #f5f3ef; /* Fond de ton thème */
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
  justify-content: center; /* Permet de centrer les boutons proprement sous le profil */
}

.profil-actions input[type="submit"] {
  padding: 12px 28px;
  border: none;
  border-radius: 8px;
  font-family: 'Outfit', sans-serif;
  font-size: .92rem;
  font-weight: 600;
  cursor: pointer;
  transition: background .25s, transform .2s, box-shadow .25s;
}

/* Bouton Modifier */
.profil-actions input[name="Modifier"] {
  background: #1b3160;
  color: #ffffff;
  box-shadow: 0 3px 14px rgba(27,49,96,.22);
}
.profil-actions input[name="Modifier"]:hover {
  background: #2563eb;
  transform: translateY(-2px);
  box-shadow: 0 6px 22px rgba(37,99,235,.35);
}

/* Bouton Supprimer */
.profil-actions input[name="Supprimer"] {
  background: transparent;
  color: #ef4444;
  border: 1.5px solid #fca5a5;
}
.profil-actions input[name="Supprimer"]:hover {
  background: #fef2f2;
  border-color: #ef4444;
  transform: translateY(-2px);
}
</style>
<br>
<br>
<br>
<div class="profil-actions">
  <form method="post">
    <input type="hidden" name="numero_client" value="<?= $_SESSION['numero_client'] ?>">
    <input type="submit" name="Modifier" value="Modifier">
    
    <input type="submit" name="Supprimer" value="Supprimer le profil" 
           onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement votre compte ? Cette action est irréversible.');">
  </form>
</div>

<?php 

  require_once("vue/footer.php");

 ?>