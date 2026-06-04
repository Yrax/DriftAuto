<style>
/* ════════════════════════════
   CSS HEADER ADAPTÉ (DriftAuto)
   ════════════════════════════ */
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@400;500;600;700&display=swap');

:root {
    --navy: #1b3160;
    --blue: #2563eb;
    --gold: #f59e0b;
    --text-dark: #0f1f3d;
}

/* 1. L'ENVELOPPE (Le Wrapper)
   C'est elle qui réserve la place en haut de tes pages PHP
*/
.nav-wrapper {
    width: 100%;
    padding: 20px 0; /* Crée l'espace pour que la pilule ne touche pas le bord */
    display: flex;
    justify-content: center;
    background-color: transparent; /* Laisse voir le fond de ta page (bleu ou crème) */
}

/* 2. LA BARRE PILULE
   On enlève le "fixed" pour qu'elle reste dans le flux de la page
*/
.nav-main {
    width: 92%;
    max-width: 1100px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 12px 8px 25px;
    
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    
    border-radius: 100px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 10px 30px rgba(27, 49, 96, 0.1);
    
    font-family: 'Outfit', sans-serif;
}

/* Logo */
.nav-logo img {
    width: 55px; 
    height: auto;
    border-radius: 50%;
    border: 2px solid var(--navy);
    vertical-align: middle;
}

/* Liens du milieu */
.nav-links {
    display: flex;
    list-style: none;
    gap: 10px;
    margin: 0;
    padding: 0;
}
.nav-links a {
    text-decoration: none;
    color: var(--text-dark);
    font-weight: 600;
    font-size: 0.9rem;
    padding: 8px 16px;
    border-radius: 50px;
    transition: all 0.2s;
}
.nav-links a:hover {
    background: rgba(27, 49, 96, 0.05);
    color: var(--blue);
}

/* Actions à droite */
.nav-actions {
    display: flex;
    align-items: center;
    gap: 5px;
}

.nav-btn-connexion {
    text-decoration: none;
    color: var(--navy);
    font-weight: 700;
    font-size: 0.9rem;
    padding: 10px 18px;
    border-radius: 50px;
}

.nav-btn-inscription {
    text-decoration: none;
    background: var(--navy);
    color: white;
    font-weight: 700;
    font-size: 0.9rem;
    padding: 10px 24px;
    border-radius: 50px;
    box-shadow: 0 4px 12px rgba(27, 49, 96, 0.15);
    transition: all 0.2s;
}
.nav-btn-inscription:hover {
    background: var(--blue);
    transform: translateY(-1px);
}

/* Responsive */
@media (max-width: 850px) {
    .nav-links { display: none; }
}
</style>

<header class="nav-wrapper">
    <nav class="nav-main">
        <a href="index.php" class="nav-logo">
            <img src="assets/images/logo1.png" alt="Logo DriftAuto">
        </a>

         <ul class="nav-links">
            <li><a href="index.php#formations">Formations</a></li>
            <li><a href="index.php#processus">Comment ça marche</a></li>
            <li><a href="index.php#avis">Avis</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>

        <div class="nav-actions">
            <a href="connexion.php" class="nav-btn-connexion">Connexion</a>
            <a href="inscription.php" class="nav-btn-inscription">Inscription</a>
        </div>
    </nav>
</header>