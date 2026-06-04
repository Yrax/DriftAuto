<style>
  /* ════════════════════════════
     CSS CONNEXION (Thème DriftAuto)
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

  .page-connexion {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    background: var(--bg-cream); /* Fond DriftAuto */
    font-family: var(--font-body);
  }

  .connexion-wrap {
    width: 100%; 
    max-width: 420px;
    background: var(--bg-white);
    border-radius: 16px;
    overflow: hidden;
    border: 1.5px solid var(--border);
    box-shadow: 0 8px 30px rgba(27,49,96,.08);
  }

  .connexion-header {
    background: var(--navy); /* Bleu Navy DriftAuto */
    padding: 2.5rem 2rem 2rem;
    display: flex; flex-direction: column; gap: 4px;
    position: relative; overflow: hidden;
  }
  .connexion-header::after {
    content: '🏎️'; /* Petite touche auto discrète en filigrane */
    position: absolute; right: 1rem; bottom: -10px;
    font-size: 5rem; opacity: 0.05; pointer-events: none;
  }
  
  .connexion-header .logo { 
    font-size: 0.95rem; 
    font-weight: 700; 
    color: var(--gold); /* Or DriftAuto */
    text-transform: uppercase;
    letter-spacing: 2px;
  }
  
  .connexion-header h2 { 
    font-family: var(--font-display);
    color: var(--bg-white); 
    font-size: 2.4rem; 
    letter-spacing: .05em;
    font-weight: normal;
  }
  
  .connexion-header p { 
    color: #b8c8ea; 
    font-size: 0.95rem; 
  }

  .connexion-body {
    padding: 2rem 2rem 2.5rem;
    display: flex; flex-direction: column; gap: 18px;
  }

  .field { display: flex; flex-direction: column; gap: 6px; }
  .field label { 
    font-size: 0.75rem; 
    font-weight: 700; 
    color: var(--text-muted); 
    text-transform: uppercase;
    letter-spacing: .12em;
  }
  
  .field input {
    padding: 12px 14px;
    border-radius: 8px;
    border: 1.5px solid var(--border);
    background: var(--bg-white);
    color: var(--text-dark);
    font-size: 0.95rem;
    font-family: var(--font-body);
    width: 100%; outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
  }
  .field input:focus {
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(37,99,235,.12);
  }
  .field input::placeholder { color: #9ca3af; }

  .connexion-actions { display: flex; flex-direction: column; gap: 16px; margin-top: 8px; }
  .connexion-actions-btns { display: flex; gap: 12px; }

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

  .register-link { text-align: center; font-size: 0.9rem; color: var(--text-muted); }
  .register-link a { color: var(--blue); text-decoration: none; font-weight: 600; }
  .register-link a:hover { text-decoration: underline; color: var(--navy); }

  .message-erreur {
    background-color: #fef2f2;
    color: var(--red);
    padding: 12px;
    border-radius: 8px;
    text-align: center;
    border: 1.5px solid #fca5a5;
    font-weight: 500;
    font-size: 0.9rem;
  }
</style>

<div class="page-connexion">
  <form method="post">
    <div class="connexion-wrap">

      <div class="connexion-header">
        <span class="logo">DriftAuto</span>
        <h2>Connexion</h2>
        <p>Bienvenue, connectez-vous à votre espace</p>
      </div>

      <div class="connexion-body">
        
        <?php 
        if (isset($message) && $message != "") { ?>
            <div class="message-erreur">
                <?= $message ?>
            </div>
        <?php } ?>

        <div class="field">
          <label>Email</label>
          <input type="text" name="identifiant" placeholder="jean.dupont@email.fr" required>
        </div>

        <div class="field">
          <label>Mot de passe</label>
          <input type="password" name="mdp" placeholder="Votre mot de passe" required>
        </div>

        <div class="connexion-actions">
          <div class="connexion-actions-btns">
            <button class="btn-reset" type="reset">Annuler</button>
            <button class="btn-submit" type="submit" name="Connexion">Se connecter</button>
          </div>
          <p class="register-link">Nouvel utilisateur ? <a href="inscription.php">Créer un compte</a></p>
        </div>
      </div>

    </div>
  </form>
</div>