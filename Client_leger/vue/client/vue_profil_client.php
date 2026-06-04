  <?php
  // profil.php — DriftAuto | Mon Profil
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
  }

  .profil-page {
    font-family: var(--font-body);
    background: var(--bg-cream);
    min-height: 60vh;
    padding: 60px 5vw 80px;
    color: var(--text-dark);
  }

  /* Titre */
  .profil-page h3 {
    font-family: var(--font-display);
    font-size: 2.6rem;
    letter-spacing: .05em;
    color: var(--text-dark);
    margin-bottom: 32px;
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

  /* Card formations — pleine largeur */
  .profil-board-card.full {
    grid-column: 1 / -1;
  }

  /* Tags formations */
  .formations-cell {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 4px;
  }
  .formation-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(37,99,235,.08);
    border: 1.5px solid rgba(37,99,235,.22);
    border-radius: 50px;
    padding: 5px 13px;
    font-size: .8rem;
    font-weight: 600;
    color: var(--navy);
    white-space: nowrap;
  }
  .formation-tag::before {
    content: '🎓';
    font-size: .8rem;
  }

  @media (max-width: 500px) {
    .profil-board { grid-template-columns: 1fr 1fr; }
  }
  </style>


  <div class="profil-page">

  <h3>Mon Profil</h3>

  <div class="profil-board">

    <div class="profil-board-card">
      <span class="profil-board-label">Identifiant</span>
      <span class="profil-board-value"><?php echo $_SESSION['pseudo_client'] ?? ''; ?></span>
    </div>

    <div class="profil-board-card">
      <span class="profil-board-label">Nom</span>
      <span class="profil-board-value"><?php echo $_SESSION['nom_client'] ?? ''; ?></span>
    </div>

    <div class="profil-board-card">
      <span class="profil-board-label">Prénom</span>
      <span class="profil-board-value"><?php echo $_SESSION['prenom_client'] ?? ''; ?></span>
    </div>

    <div class="profil-board-card">
      <span class="profil-board-label">Date de naissance</span>
      <span class="profil-board-value"><?php echo $_SESSION['date_naissance_client'] ?? ''; ?></span>
    </div>

    <div class="profil-board-card">
      <span class="profil-board-label">Téléphone</span>
      <span class="profil-board-value"><?php echo $_SESSION['telephone_client'] ?? ''; ?></span>
    </div>

    <div class="profil-board-card">
      <span class="profil-board-label">Code postal</span>
      <span class="profil-board-value"><?php echo $_SESSION['code_postal_client'] ?? ''; ?></span>
    </div>

    <div class="profil-board-card">
      <span class="profil-board-label">Ville</span>
      <span class="profil-board-value"><?php echo $_SESSION['ville_client'] ?? ''; ?></span>
    </div>

    <div class="profil-board-card">
      <span class="profil-board-label">Adresse</span>
      <span class="profil-board-value"><?php echo $_SESSION['adresse_client'] ?? ''; ?></span>
    </div>

    <div class="profil-board-card">
      <span class="profil-board-label">Email</span>
      <span class="profil-board-value"><?php echo $_SESSION['email_client'] ?? ''; ?></span>
    </div>

  <div class="profil-board-card full">
    <span class="profil-board-label">Formations choisies</span>
    <div class="formations-cell">
        <?php
            if (!empty($_SESSION['formations_client'])) {

              foreach ($_SESSION['formations_client'] as $idFormation) {
                  $nom = $unControleur->selectNomFormation($idFormation);
                  echo "<span class='formation-tag'>" . $nom . "</span>";
              }

            } else {
                echo "<span style='color:#9ca3af;font-size:.85rem;'>—</span>";
            }
        ?>
    </div>
</div>

</div>