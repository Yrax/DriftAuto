<style>
/* ════════════════════════════
   CSS HEADER CONNECTÉ + LOGO (DriftAuto)
   ════════════════════════════ */
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@400;500;600;700&display=swap');

:root {
    --navy:        #1b3160;
    --blue:        #2563eb;
    --gold:        #f59e0b;
    --bg-white:    #ffffff;
    --text-dark:   #0f1f3d;
    --border:      #e2e8f5;
    --red:         #ef4444;
}

/* 1. L'enveloppe du menu */
form.nav-wrapper-form {
    width: 100%;
    display: flex;
    justify-content: center;
    padding: 20px 0; 
    margin: 0;
    background: transparent;
}

/* 2. La barre pilule flottante */
nav.nav-main {
    width: 92%;
    max-width: 1100px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 12px 8px 15px; /* Un peu moins de padding à gauche pour laisser respirer le logo */
    
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    
    border-radius: 100px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 10px 30px rgba(27, 49, 96, 0.1);
    
    font-family: 'Outfit', sans-serif;
    position: relative;
    z-index: 1000;
}

/* 3. Logo (Image + Texte alignés) */
.nav-logo a {
    display: flex;
    align-items: center;
    gap: 12px; /* Espace entre l'image et le texte */
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.8rem;
    color: var(--navy);
    text-decoration: none;
    letter-spacing: 0.05em;
    transition: color 0.3s;
}

/* Style de ton image logo */
.nav-logo img {
    width: 42px; /* Taille parfaite pour rester dans la pilule */
    height: 42px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid var(--navy);
    transition: transform 0.3s, border-color 0.3s;
}

.nav-logo a:hover {
    color: var(--blue);
}
.nav-logo a:hover img {
    transform: scale(1.08) rotate(-5deg); /* Petit effet dynamique */
    border-color: var(--blue);
}

/* Liens du milieu */
.nav-links {
    display: flex;
    list-style: none;
    gap: 10px;
    margin: 0;
    padding: 0;
}
.nav-links li a {
    text-decoration: none;
    color: var(--text-dark);
    font-weight: 600;
    font-size: 0.95rem;
    padding: 8px 16px;
    border-radius: 50px;
    transition: all 0.2s;
}
.nav-links li a:hover {
    background: rgba(27, 49, 96, 0.05);
    color: var(--blue);
}

/* 4. Zone Utilisateur et Dropdown */
.nav-user {
    position: relative; 
    display: flex;
    align-items: center;
    cursor: pointer;
}

.nav-avatar {
    background: var(--navy);
    color: var(--bg-white);
    font-weight: 700;
    font-size: 0.95rem;
    padding: 10px 22px;
    border-radius: 50px;
    box-shadow: 0 4px 12px rgba(27, 49, 96, 0.15);
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 8px;
}
.nav-avatar::after {
    content: '▼';
    font-size: 0.6rem;
    opacity: 0.8;
}
.nav-user:hover .nav-avatar {
    background: var(--blue);
    transform: translateY(-1px);
}

.nav-dropdown {
    position: absolute;
    top: 120%; 
    right: 0;
    background: var(--bg-white);
    border-radius: 16px;
    border: 1.5px solid var(--border);
    box-shadow: 0 8px 24px rgba(27, 49, 96, 0.12);
    min-width: 180px;
    padding: 10px 0;
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.nav-user:hover .nav-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.nav-dropdown a {
    display: block;
    padding: 12px 20px;
    color: var(--text-dark);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    transition: background 0.2s, color 0.2s;
}
.nav-dropdown a:hover {
    background: rgba(27, 49, 96, 0.04);
    color: var(--blue);
}

.nav-dropdown hr {
    border: none;
    border-top: 1.5px solid var(--border);
    margin: 8px 0;
}

.nav-dropdown a.nav-dropdown-logout {
    color: var(--red);
}
.nav-dropdown a.nav-dropdown-logout:hover {
    background: #fef2f2; 
}

@media (max-width: 850px) {
    .nav-links { display: none; }
    /* Sur téléphone, on peut cacher le texte pour ne garder que le logo si ça prend trop de place */
    .nav-logo a span { display: none; }
}
</style>

<form method="post" class="nav-wrapper-form">
    <nav class="nav-main">
      
        <div class="nav-logo">
            <a href="index.php">
                <img src="assets/images/logo1.png" alt="Logo DriftAuto">
                <span>DriftAuto</span>
            </a>
        </div>
      
        <ul class="nav-links">
            <li><a href="index.php#formations">Formations</a></li>
            <li><a href="index.php#processus">Comment ça marche</a></li>
            <li><a href="planning_client.php">Planning</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
      
        <div class="nav-user">
            <?php 
                $pseudo = isset($_SESSION['pseudo_client']) ? $_SESSION['pseudo_client'] : 'Mon Profil';
                echo "<div class='nav-avatar'>" . htmlspecialchars($pseudo) . "</div>";
            ?>
            
            <div class="nav-dropdown">
                <a href="client.php">Mon profil</a>
                <hr>
                <a href="index.php?page=9" class="nav-dropdown-logout">Déconnexion</a>
            </div>
        </div>
        
    </nav>
</form>