<style>
  /* ════════════════════════════
     CSS INSCRIPTION (Thème DriftAuto)
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
    --red:         #ef4444;
    --font-display:'Bebas Neue', sans-serif;
    --font-body:   'Outfit', sans-serif;
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }

  .page-inscription {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    background: var(--bg-cream); /* Fond DriftAuto */
    font-family: var(--font-body);
  }

  .form-wrap {
    width: 100%; max-width: 550px; /* Un poil plus large pour les deux colonnes */
    background: var(--bg-white);
    border-radius: 16px;
    overflow: hidden;
    border: 1.5px solid var(--border);
    box-shadow: 0 8px 30px rgba(27,49,96,.08);
  }

  .form-header {
    background: var(--navy); /* Bleu Navy DriftAuto */
    padding: 2rem 2.5rem 1.8rem;
    display: flex; flex-direction: column; gap: 4px;
    position: relative; overflow: hidden;
  }
  .form-header::after {
    content: '🏁'; /* Touche auto */
    position: absolute; right: 1rem; bottom: -5px;
    font-size: 4.5rem; opacity: 0.05; pointer-events: none;
  }
  
  .form-header .logo { 
    font-size: 0.95rem; 
    font-weight: 700; 
    color: var(--gold); 
    text-transform: uppercase;
    letter-spacing: 2px;
  }
  
  .form-header h3 { 
    font-family: var(--font-display);
    color: var(--bg-white); 
    font-size: 2.2rem; 
    letter-spacing: .05em;
    font-weight: normal;
  }
  
  .form-header p { 
    color: #b8c8ea; 
    font-size: 0.9rem; 
  }

  .form-body {
    padding: 1.8rem 2.5rem 2.5rem;
    display: flex; flex-direction: column; gap: 14px;
  }

  .section-label {
    font-size: 0.7rem; font-weight: 700;
    color: var(--navy); text-transform: uppercase; 
    letter-spacing: 0.1em;
    margin-top: 8px;
  }

  .divider {
    border: none;
    border-top: 1.5px solid var(--border);
    margin: 4px 0;
  }

  .field { display: flex; flex-direction: column; gap: 6px; }
  .field label { 
    font-size: 0.75rem; 
    font-weight: 700; 
    color: var(--text-muted); 
    text-transform: uppercase;
    letter-spacing: .05em;
  }
  
  .field input {
    padding: 11px 14px;
    border-radius: 8px;
    border: 1.5px solid var(--border);
    background: var(--bg-white);
    color: var(--text-dark);
    font-size: 0.9rem;
    font-family: var(--font-body);
    width: 100%; outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
  }
  .field input:focus {
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(37,99,235,.12);
  }
  .field input::placeholder { color: #9ca3af; }

  /* Info texte pour le RGPD */
  .password-hint {
    font-size: 0.75rem;
    color: #9ca3af;
    margin-top: 2px;
  }

  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

  .form-actions { display: flex; flex-direction: column; gap: 16px; margin-top: 12px; }
  .form-actions-btns { display: flex; gap: 12px; }

  .btn-reset {
    padding: 12px 20px; 
    border-radius: 8px;
    border: 1.5px solid var(--border);
    background: transparent; 
    color: var(--text-muted);
    font-size: 0.9rem; 
    font-weight: 600;
    cursor: pointer; 
    font-family: var(--font-body);
    transition: border-color 0.2s, color 0.2s;
  }
  .btn-reset:hover { 
    border-color: var(--red);
    color: var(--red);
  }

  .btn-submit {
    flex: 1; 
    padding: 12px 24px; 
    border-radius: 8px;
    border: none; 
    background: var(--navy); 
    color: white;
    font-size: 0.9rem; 
    font-weight: 700;
    cursor: pointer; 
    font-family: var(--font-body);
    transition: background 0.25s, transform 0.2s, box-shadow 0.25s;
    box-shadow: 0 3px 14px rgba(27,49,96,.22);
  }
  .btn-submit:hover { 
    background: var(--blue); 
    transform: translateY(-2px); 
    box-shadow: 0 6px 22px rgba(37,99,235,.35);
  }

  .login-link { text-align: center; font-size: 0.9rem; color: var(--text-muted); }
  .login-link a { color: var(--blue); text-decoration: none; font-weight: 600; }
  .login-link a:hover { text-decoration: underline; color: var(--navy); }

  @media (max-width: 520px) {
    .form-row { grid-template-columns: 1fr; gap: 12px; }
    .form-body { padding: 1.5rem; }
    .form-header { padding: 1.5rem; }
    .form-actions-btns { flex-direction: column; }
  }
</style>

<div class="page-inscription">
  <form method="post">
    <div class="form-wrap">
      
      <div class="form-header">
        <span class="logo">DriftAuto</span>
        <h3>Créer un compte</h3>
        <p>Remplissez tous les champs pour vous inscrire</p>
      </div>
      
      <div class="form-body">

        <p class="section-label">Identifiants</p>
        <div class="field">
          <label>Pseudo</label>
          <input type="text" name="pseudo_client" placeholder="Identifiant unique" required>
        </div>

        <hr class="divider">
        <p class="section-label">Informations personnelles</p>

        <div class="form-row">
          <div class="field">
            <label>Nom</label>
            <input type="text" name="nom_client" placeholder="Dupont" required>
          </div>
          <div class="field">
            <label>Prénom</label>
            <input type="text" name="prenom_client" placeholder="Jean" required>
          </div>
        </div>

        <div class="form-row">
          <div class="field">
            <label>Date de naissance</label>
            <input type="date" name="date_naissance_client" required>
          </div>
          <div class="field">
            <label>Téléphone</label>
            <input type="text" name="telephone_client" placeholder="06 00 00 00 00" required>
          </div>
        </div>

        <hr class="divider">
        <p class="section-label">Adresse</p>

        <div class="field">
          <label>Adresse</label>
          <input type="text" name="adresse_client" placeholder="12 rue de la Liberté" required>
        </div>

        <div class="form-row">
          <div class="field">
            <label>Code postal</label>
            <input type="text" name="code_postal_client" placeholder="75001" required>
          </div>
          <div class="field">
            <label>Ville</label>
            <input type="text" name="ville_client" placeholder="Paris" required>
          </div>
        </div>

        <hr class="divider">
        <p class="section-label">Compte</p>

        <div class="field">
          <label>Email</label>
          <input type="email" name="email_client" placeholder="jean.dupont@email.fr" required>
        </div>
        
        <div class="field">
          <label>Mot de passe</label>
          <input type="password" name="mdp_client" placeholder="Mot de passe sécurisé">
        </div>

        <div class="form-actions">
          <div class="form-actions-btns">
            <button class="btn-reset" type="reset">Annuler</button>
            <button class="btn-submit" type="submit" name="Valider">S'inscrire</button>
          </div>
          <p class="login-link">Déjà un compte ? <a href="connexion.php">Se connecter</a></p>
        </div>

      </div>
    </div>
  </form>
</div>