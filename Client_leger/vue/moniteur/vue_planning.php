<?php
// vue_planning_moniteur.php — DriftAuto | Mon Planning
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&display=swap');

:root {
  --navy:         #1b3160;
  --blue:         #2563eb;
  --gold:         #f59e0b;
  --bg-cream:     #f5f3ef;
  --bg-light:     #eef2f9;
  --bg-white:     #ffffff;
  --text-dark:    #0f1f3d;
  --text-muted:   #6b7280;
  --border:       #e2e8f5;
  --font-display: 'Bebas Neue', sans-serif;
  --font-body:    'Outfit', sans-serif;
  --green:        #10b981;
}

.profil-page {
  font-family: var(--font-body);
  background: var(--bg-cream);
  min-height: 60vh;
  padding: 60px 5vw 80px;
  color: var(--text-dark);
}

/* Titre principal */
.profil-page h3 {
  font-family: var(--font-display);
  font-size: 2.6rem;
  letter-spacing: .05em;
  color: var(--text-dark);
  margin-bottom: 16px;
  display: flex;
  align-items: center;
  gap: 12px;
}
.profil-page h3::before {
  content: '';
  display: inline-block;
  width: 5px;
  height: 2.2rem;
  background: var(--gold);
  border-radius: 3px;
}

/* Titres des sections */
.section-title {
  font-family: var(--font-display);
  font-size: 1.8rem;
  margin: 32px 0 16px 0;
  color: var(--text-dark);
}
.title-green { color: var(--green); }
.title-gold { color: var(--gold); } /* Ajout pour le titre des examens */

/* Board — grille de cards */
.profil-board {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: 16px;
}

/* Card individuelle */
.profil-board-card {
  background: var(--bg-white);
  border: 1.5px solid var(--border);
  border-radius: 12px;
  padding: 20px 22px;
  box-shadow: 0 2px 12px rgba(27,49,96,.07);
  display: flex;
  flex-direction: column;
  gap: 6px;
  transition: box-shadow .2s, border-color .2s, transform .2s;
}
.profil-board-card:hover {
  border-color: #b8c8ea;
  box-shadow: 0 8px 28px rgba(27,49,96,.13);
  transform: translateY(-3px);
}

/* Accent coloré en haut */
.profil-board-card::before {
  content: '';
  display: block;
  width: 32px;
  height: 3px;
  background: var(--blue);
  border-radius: 2px;
  margin-bottom: 6px;
}

/* Couleurs des barres */
.card-confirme::before { background: var(--green); }
.card-examen::before { background: var(--gold); } /* Ajout de la barre dorée pour différencier l'examen */

.profil-board-card.full { grid-column: 1 / -1; }

.profil-board-label {
  font-size: .67rem;
  font-weight: 700;
  letter-spacing: .16em;
  text-transform: uppercase;
  color: var(--text-muted);
}

.profil-board-value {
  font-size: .97rem;
  font-weight: 600;
  color: var(--text-dark);
  word-break: break-word;
}

@media (max-width: 500px) {
  .profil-board { grid-template-columns: 1fr 1fr; }
}
</style>

<div class="profil-page">

  <h3>📅 Mon Planning</h3>

  <div class="section-title title-green">✅ Leçons à assurer</div>
  
  <?php if (!empty($_SESSION['lecons_moniteur'])): ?>
    <?php foreach ($_SESSION['lecons_moniteur'] as $lecon): ?>
      <div class="profil-board" style="margin-bottom: 24px; padding-bottom: 24px; border-bottom: 2px dashed var(--border);">
        <div class="profil-board-card card-confirme">
          <span class="profil-board-label">N° Leçon</span>
          <span class="profil-board-value">#<?php echo $lecon['numero_lecon']; ?></span>
        </div>
        <div class="profil-board-card card-confirme">
          <span class="profil-board-label">Date & Heure</span>
          <span class="profil-board-value"><?php echo $lecon['date_heure_lecon']; ?></span>
        </div>
        <div class="profil-board-card card-confirme">
          <span class="profil-board-label">Voiture (Immat.)</span>
          <span class="profil-board-value"><?php echo $lecon['numero_immatriculation']; ?></span>
        </div>
        <div class="profil-board-card card-confirme">
          <span class="profil-board-label">Élève</span>
          <span class="profil-board-value"><?php echo $lecon['nom_client']; ?></span>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="profil-board">
      <div class="profil-board-card card-confirme full">
        <span class="profil-board-label">Information</span>
        <span class="profil-board-value">Aucune leçon n'est planifiée pour le moment.</span>
      </div>
    </div>
  <?php endif; ?>


  <div class="section-title title-gold">🎓 Examens prévus</div>

  <?php if (!empty($_SESSION['examens_moniteur'])): ?>
    <?php foreach ($_SESSION['examens_moniteur'] as $examen): ?>
      <div class="profil-board" style="margin-bottom: 24px; padding-bottom: 24px; border-bottom: 2px dashed var(--border);">
        <div class="profil-board-card card-examen">
          <span class="profil-board-label">N° Examen</span>
          <span class="profil-board-value">#<?php echo $examen['numero_examen']; ?></span>
        </div>
        <div class="profil-board-card card-examen">
          <span class="profil-board-label">Date & Heure</span>
          <span class="profil-board-value"><?php echo $examen['date_heure_examen']; ?></span>
        </div>
        <div class="profil-board-card card-examen">
          <span class="profil-board-label">Candidat</span>
          <span class="profil-board-value"><?php echo $examen['nom_client']; ?></span>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="profil-board">
      <div class="profil-board-card card-examen full">
        <span class="profil-board-label">Information</span>
        <span class="profil-board-value">Aucun examen n'est programmé pour le moment.</span>
      </div>
    </div>
  <?php endif; ?>

</div>