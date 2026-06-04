<?php
  session_start();
  require_once("controleur/controleur.class.php");
  $unControleur = new Controleur();
  

?>

<!-- ─── Fonts & CSS ─── -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/index.css">

<?php 


    //$page = isset($_GET['page']) ? $_GET['page'] : 1;

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }


    if ($page == 9) {
        session_destroy();
        unset($_SESSION['identifiant']);
        header("Location: index.php");
        exit;
    }

        if (!isset($_SESSION['identifiant'])) {
        require_once("vue/header.php");
    } else {
        require_once("vue/client/header_client.php");
    }
?>


<!-- ════════════════════════════
     HERO SLIDER
     ════════════════════════════ -->
<section class="hero-slider" id="hero">

  <div class="slide active">
    <div class="slide-bg"></div>
    <div class="slide-content">
      <span class="slide-badge">Bienvenue chez DriftAuto</span>
      <h1 class="slide-title">Votre <span>permis en toute</span> confiance.</h1>
      <p class="slide-desc">Formateurs certifiés, véhicules récents et accompagnement personnalisé. Votre succès est notre priorité.</p>
      <div class="slide-cta-group">
        <a href="#formations" class="btn-primary">Commencer ma formation →</a>
        <a href="#formations" class="btn-secondary">Voir les formules</a>
      </div>
    </div>
  </div>

  <div class="slide">
    <div class="slide-bg"></div>
    <div class="slide-content">
      <span class="slide-badge">Conduite accompagnée</span>
      <h1 class="slide-title">Dès 15 ans <span>avec l'AAC</span> disponible.</h1>
      <p class="slide-desc">La conduite accompagnée vous permet d'acquérir de l'expérience en toute sécurité avant vos 18 ans.</p>
      <div class="slide-cta-group">
        <a href="#formations" class="btn-primary">En savoir plus →</a>
        <a href="contact.php" class="btn-secondary">Nous contacter</a>
      </div>
    </div>
  </div>

  <div class="slide">
    <div class="slide-bg"></div>
    <div class="slide-content">
      <span class="slide-badge">Offre spéciale</span>
      <h1 class="slide-title">Financement <span>en 10 fois</span> sans frais.</h1>
      <p class="slide-desc">Ne laissez pas le budget vous freiner. Profitez de nos solutions de paiement flexibles adaptées à chaque situation.</p>
      <div class="slide-cta-group">
        <a href="formations.php" class="btn-primary">Découvrir l'offre →</a>
        <a href="inscription.php" class="btn-secondary">S'inscrire</a>
      </div>
    </div>
  </div>

  <div class="slider-dots" id="sliderDots">
    <button class="dot active" data-index="0" aria-label="Slide 1"></button>
    <button class="dot" data-index="1" aria-label="Slide 2"></button>
    <button class="dot" data-index="2" aria-label="Slide 3"></button>
  </div>

  <div class="slider-arrows">
    <button class="arrow-btn" id="prevSlide" aria-label="Précédent">&#8592;</button>
    <button class="arrow-btn" id="nextSlide" aria-label="Suivant">&#8594;</button>
  </div>

  <div class="slider-progress" id="sliderProgress"></div>

</section>


<!-- ════════════════════════════
     STATS
     ════════════════════════════ -->
<div class="stats-band">

  <div class="stat-item">
    <span class="stat-num">98%</span>
    <span class="stat-label">Taux de réussite</span>
  </div>

  <div class="stat-divider"></div>

  <div class="stat-item">
    <span class="stat-num">+2 000</span>
    <span class="stat-label">Élèves formés</span>
  </div>

  <div class="stat-divider"></div>

  <div class="stat-item">
    <span class="stat-num">12</span>
    <span class="stat-label">Formateurs certifiés</span>
  </div>

  <div class="stat-divider"></div>

  <div class="stat-item">
    <span class="stat-num">15+</span>
    <span class="stat-label">Années d'expérience</span>
  </div>

</div>


<!-- ════════════════════════════
     SLIDER PROMOTIONS
     ════════════════════════════ -->
<section class="promo-section">
  <div class="promo-section-header">
    <span class="section-tag">Nos offres</span>
    <h2 class="promo-section-title">Découvrez nos promotions</h2>
  </div>

  <div class="promo-slider-wrap">
    <div class="promo-arrows">
      <button class="promo-arrow" id="promoPrev" aria-label="Précédent">&#8592;</button>
      <button class="promo-arrow" id="promoNext" aria-label="Suivant">&#8594;</button>
    </div>

    <div class="promo-track" id="promoTrack">

      <a href="<?php echo isset($_SESSION['numero_client']) ? 'formations.php' : 'inscription.php'; ?>" class="promo-card blue">
        <div class="promo-card-body">
          <div>
            <span class="promo-card-badge">🔥 Offre spéciale</span>
            <h3 class="promo-card-title">Permis B<br>à partir de 1 299€</h3>
            <p class="promo-card-desc">Formation complète code + conduite avec un formateur certifié. Obtenez votre permis B dans les meilleures conditions.</p>
          </div>
          <span class="promo-card-btn">Je m'inscris →</span>
        </div>
        <div class="promo-card-visual"><span class="promo-card-emoji">🚗</span></div>
      </a>

      <a href="formations.php" class="promo-card gold">
        <div class="promo-card-body">
          <div>
            <span class="promo-card-badge">Conduite accompagnée</span>
            <h3 class="promo-card-title">Dès 15 ans,<br>préparez-vous tôt.</h3>
            <p class="promo-card-desc">L'AAC vous permet d'accumuler de l'expérience et d'aborder le permis avec confiance. Taux de réussite supérieur à 96%.</p>
          </div>
          <span class="promo-card-btn">Découvrir l'AAC →</span>
        </div>
        <div class="promo-card-visual"><span class="promo-card-emoji">⭐</span></div>
      </a>

      <a href="formations.php" class="promo-card dark">
        <div class="promo-card-body">
          <div>
            <span class="promo-card-badge">⚡ Formule intensive</span>
            <h3 class="promo-card-title">Permis en<br>3 semaines chrono.</h3>
            <p class="promo-card-desc">Besoin de votre permis rapidement ? Notre formule accélérée avec formateur dédié vous prépare en un temps record.</p>
          </div>
          <span class="promo-card-btn">Voir la formule →</span>
        </div>
        <div class="promo-card-visual"><span class="promo-card-emoji">⚡</span></div>
      </a>

      <a href="<?php echo isset($_SESSION['numero_client']) ? 'formations.php' : 'inscription.php'; ?>" class="promo-card blue">
        <div class="promo-card-body">
          <div>
            <span class="promo-card-badge">🎓 Code de la route</span>
            <h3 class="promo-card-title">Révisez en ligne,<br>quand vous voulez.</h3>
            <p class="promo-card-desc">Accès illimité à notre plateforme de révision. Plus de 3 000 questions, statistiques et examens blancs inclus.</p>
          </div>
          <span class="promo-card-btn">Essayer gratuitement →</span>
        </div>
        <div class="promo-card-visual"><span class="promo-card-emoji">🎓</span></div>
      </a>

    </div>

    <div class="promo-dots" id="promoDots">
      <button class="promo-dot active" data-index="0"></button>
      <button class="promo-dot" data-index="1"></button>
      <button class="promo-dot" data-index="2"></button>
      <button class="promo-dot" data-index="3"></button>
    </div>
  </div>
</section>


<!-- ════════════════════════════
     FORMATIONS — fond blanc
     ════════════════════════════ -->
<section class="section" id="formations">
  <div class="section-header">
    <div>
      <p class="section-eyebrow">Nos formules</p>
      <h2 class="section-title">Choisissez votre<br><em>formation</em></h2>
    </div>
    <a href="formations.php" class="btn-outline">Toutes les formations →</a>
  </div>

  <div class="formations-grid">
    <a href="formations.php" class="formation-card">
      <span class="card-tag">Le plus populaire</span>
      <div class="card-icon">🚗</div>
      <h3 class="card-title">Permis B</h3>
      <p class="card-desc">La formation classique pour obtenir votre permis voiture. Cours de code et leçons de conduite inclus.</p>
      <div class="card-price">À partir de 1 299€ <span>/ formation complète</span></div>
    </a>
    <a href="formations.php" class="formation-card">
      <div class="card-icon">🎓</div>
      <h3 class="card-title">Conduite Accompagnée</h3>
      <p class="card-desc">Démarrez dès 15 ans avec l'AAC. Une approche progressive pour gagner en confiance avant le permis.</p>
      <div class="card-price">À partir de 999€ <span>/ formation complète</span></div>
    </a>
    <a href="formations.php" class="formation-card">
      <div class="card-icon">📱</div>
      <h3 class="card-title">Code en Ligne</h3>
      <p class="card-desc">Préparez votre code depuis chez vous avec notre plateforme en ligne. Accès illimité pendant 1 an.</p>
      <div class="card-price">29€ <span>/ mois</span></div>
    </a>
    <a href="formations.php" class="formation-card">
      <div class="card-icon">⚡</div>
      <h3 class="card-title">Stage Intensif</h3>
      <p class="card-desc">Obtenez votre permis en quelques semaines grâce à notre formule accélérée avec heures de conduite quotidiennes.</p>
      <div class="card-price">À partir de 1 599€ <span>/ stage</span></div>
    </a>
  </div>
</section>


<!-- ════════════════════════════
     PROCESSUS — fond bleu clair
     ════════════════════════════ -->
<section class="section alt" id="processus">
  <div class="section-header">
    <div>
      <p class="section-eyebrow">Notre méthode</p>
      <h2 class="section-title">Simple comme<br><em>bonjour</em></h2>
    </div>
  </div>
  <div class="steps-grid">
    <div class="step">
      <div class="step-number">1</div>
      <div class="step-title">Inscription en ligne</div>
      <p class="step-desc">Remplissez votre dossier en quelques minutes depuis chez vous, 24h/24.</p>
    </div>
    <div class="step">
      <div class="step-number">2</div>
      <div class="step-title">Bilan de conduite</div>
      <p class="step-desc">Un formateur évalue votre niveau pour construire un programme personnalisé.</p>
    </div>
    <div class="step">
      <div class="step-number">3</div>
      <div class="step-title">Formation code & conduite</div>
      <p class="step-desc">Apprenez à votre rythme avec nos outils digitaux et vos leçons en voiture.</p>
    </div>
    <div class="step">
      <div class="step-number">4</div>
      <div class="step-title">Passage aux examens</div>
      <p class="step-desc">Nous vous présentons aux examens dès que vous êtes prêt(e). Félicitations !</p>
    </div>
  </div>
</section>


<!-- ════════════════════════════
     POURQUOI NOUS — fond bleu clair
     ════════════════════════════ -->
<section class="section why-section">
  <div class="why-grid">
    <div class="why-visual">
      <div class="why-card-stack">
        <div class="float-card main">
          <div class="float-card-label">Taux de réussite 2024</div>
          <div class="float-card-value">98%</div>
          <div class="float-card-sub">+12 points vs moyenne nationale</div>
        </div>
        <div class="float-card secondary">
          <div class="float-card-label">Satisfaction élèves</div>
          <div class="float-card-value">4.9 ★</div>
          <div class="float-card-sub">Basé sur 340 avis Google</div>
        </div>
      </div>
    </div>
    <div>
      <p class="section-eyebrow">Pourquoi DriftAuto ?</p>
      <h2 class="section-title" style="margin-bottom:36px">Une école<br><em>différente</em></h2>
      <div class="why-features">
        <div class="feature-row">
          <div class="feature-icon">🎯</div>
          <div class="feature-text">
            <h4>Suivi personnalisé</h4>
            <p>Chaque élève bénéficie d'un bilan de progression et d'un plan adapté à son niveau et ses disponibilités.</p>
          </div>
        </div>
        <div class="feature-row">
          <div class="feature-icon">🚘</div>
          <div class="feature-text">
            <h4>Véhicules récents et équipés</h4>
            <p>Flotte renouvelée chaque année. Boîte manuelle et automatique, double commande de sécurité.</p>
          </div>
        </div>
        <div class="feature-row">
          <div class="feature-icon">💳</div>
          <div class="feature-text">
            <h4>Paiement flexible</h4>
            <p>Paiement en plusieurs fois sans frais, CPF accepté. Nous nous adaptons à votre budget.</p>
          </div>
        </div>
        <div class="feature-row">
          <div class="feature-icon">📍</div>
          <div class="feature-text">
            <h4>Prise en charge à domicile</h4>
            <p>Vos leçons débutent directement depuis chez vous ou votre lieu de travail.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ════════════════════════════
     TÉMOIGNAGES — fond crème
     ════════════════════════════ -->
<section class="section testi-section" id="avis">
  <div class="section-header">
    <div>
      <p class="section-eyebrow">Avis élèves</p>
      <h2 class="section-title">Ils ont obtenu<br><em>leur permis</em></h2>
    </div>
  </div>
  <div class="testimonials-grid">
    <div class="testi-card">
      <div class="testi-stars">★★★★★</div>
      <p class="testi-text">"Formateur au top, toujours disponible. J'ai eu mon permis du premier coup en seulement 2 mois !"</p>
      <div class="testi-author">
        <div class="testi-avatar">L</div>
        <div>
          <div class="testi-name">Lucas M.</div>
          <div class="testi-date">Obtenu en octobre 2024</div>
        </div>
      </div>
    </div>
    <div class="testi-card">
      <div class="testi-stars">★★★★★</div>
      <p class="testi-text">"J'ai commencé l'AAC à 15 ans et aujourd'hui j'ai mon permis B. Pédagogie excellente et très rassurante."</p>
      <div class="testi-author">
        <div class="testi-avatar">S</div>
        <div>
          <div class="testi-name">Sarah K.</div>
          <div class="testi-date">Obtenu en juillet 2024</div>
        </div>
      </div>
    </div>
    <div class="testi-card">
      <div class="testi-stars">★★★★★</div>
      <p class="testi-text">"Le stage intensif était parfaitement organisé. En 3 semaines j'avais mon permis. Je recommande vivement DriftAuto !"</p>
      <div class="testi-author">
        <div class="testi-avatar">R</div>
        <div>
          <div class="testi-name">Romain D.</div>
          <div class="testi-date">Obtenu en mars 2024</div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ════════════════════════════
     CTA BAND — fond navy
     ════════════════════════════ -->


  <?php 

    require_once("vue/footer.php");

   ?>

<!-- ─── Scripts ─── -->
<script src="assets/js/slider.js"></script>
