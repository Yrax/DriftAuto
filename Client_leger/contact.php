<?php
  session_start();
  require_once("controleur/controleur.class.php");
  $unControleur = new Controleur();
  

?>

<?php 
    if (!isset($_SESSION['identifiant'])) {
        require_once("vue/header.php");
    } else {
        require_once("vue/client/header_client.php");
    }

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
?>




<!-- ─── Fonts & CSS ─── -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/contact.css">


<!-- ════════════════════════════
     HERO
     ════════════════════════════ -->
<section class="contact-hero">
  <div class="hero-watermark">CONTACT</div>
  <div class="contact-hero-inner">
    <span class="hero-eyebrow">Nous contacter</span>
    <h1>On est là<br>pour <em>vous.</em></h1>
    <p>Une question sur nos formations, un devis, une inscription ou simplement envie d'échanger avec notre équipe ? On vous répond dans les plus brefs délais.</p>
  </div>
</section>


<!-- ════════════════════════════
     BANDE INFOS RAPIDES
     ════════════════════════════ -->
<div class="info-strip">

  <a href="tel:0123456789" class="info-item">
    <div class="info-icon"><span>📞</span></div>
    <div>
      <div class="info-title">Téléphone</div>
      <div class="info-value">01 23 45 67 89</div>
    </div>
  </a>

  <a href="mailto:contact@driftauto.fr" class="info-item">
    <div class="info-icon"><span>✉️</span></div>
    <div>
      <div class="info-title">E-mail</div>
      <div class="info-value">contact@driftauto.fr</div>
    </div>
  </a>

  <div class="info-item">
    <div class="info-icon"><span>📍</span></div>
    <div>
      <div class="info-title">Adresse</div>
      <div class="info-value">12 rue de la Victoire, 75009 Paris</div>
    </div>
  </div>

  <div class="info-item">
    <div class="info-icon"><span>🕐</span></div>
    <div>
      <div class="info-title">Horaires</div>
      <div class="info-value">Lun–Sam · 9h–19h</div>
    </div>
  </div>

</div>


<!-- ════════════════════════════
     FORMULAIRE + ASIDE
     ════════════════════════════ -->
<div class="contact-main">
  <div class="contact-grid">

    <!-- ─── FORMULAIRE ─── -->
    <div class="form-card">

      <!-- Contenu formulaire (masqué après envoi) -->
      <div id="formContent">
        <h2 class="form-card-title">Envoyez-nous un message</h2>
        <p class="form-card-sub">Choisissez le sujet de votre demande et remplissez le formulaire. Notre équipe vous contacte sous 24h.</p>

        <!-- Onglets sujet -->
        <div class="subject-tabs" id="subjectTabs">
          <button class="subject-tab active" data-value="information">Information</button>
          <button class="subject-tab" data-value="inscription">Inscription</button>
          <button class="subject-tab" data-value="devis">Devis</button>
          <button class="subject-tab" data-value="reclamation">Réclamation</button>
          <button class="subject-tab" data-value="autre">Autre</button>
        </div>
        <input type="hidden" id="subjectInput" value="information">

        <!-- Champs -->
        <form id="contactForm" novalidate>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="prenom">Prénom <span>*</span></label>
              <input class="form-input" type="text" id="prenom" name="prenom" placeholder="Jean" required>
            </div>
            <div class="form-group">
              <label class="form-label" for="nom">Nom <span>*</span></label>
              <input class="form-input" type="text" id="nom" name="nom" placeholder="Dupont" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="email">E-mail <span>*</span></label>
              <input class="form-input" type="email" id="email" name="email" placeholder="jean.dupont@mail.com" required>
            </div>
            <div class="form-group">
              <label class="form-label" for="tel">Téléphone</label>
              <input class="form-input" type="tel" id="tel" name="tel" placeholder="06 00 00 00 00">
            </div>
          </div>

          <div class="form-row single">
            <div class="form-group">
              <label class="form-label" for="formation">Formation concernée</label>
              <select class="form-select" id="formation" name="formation">
                <option value="" disabled selected>Choisissez une formation…</option>
                <option value="permis-b">Permis B classique</option>
                <option value="aac">Conduite accompagnée (AAC)</option>
                <option value="stage-intensif">Stage intensif</option>
                <option value="code-en-ligne">Code en ligne</option>
                <option value="autre">Autre / Je ne sais pas encore</option>
              </select>
            </div>
          </div>

          <div class="form-row single">
            <div class="form-group">
              <label class="form-label" for="message">Votre message <span>*</span></label>
              <textarea class="form-textarea" id="message" name="message" placeholder="Décrivez votre demande en quelques mots…" required></textarea>
            </div>
          </div>

          <div class="form-check">
            <input type="checkbox" id="rgpd" name="rgpd" required>
            <label for="rgpd">
              J'accepte que mes données soient utilisées pour traiter ma demande, conformément à la
              <a href="politique-confidentialite.php">politique de confidentialité</a> de DriftAuto.
            </label>
          </div>

          <button type="submit" class="btn-submit">
            <span>Envoyer le message</span>
            <span>→</span>
          </button>

        </form>
      </div>

      <!-- Message de succès -->
      <div class="form-success" id="formSuccess">
        <div class="success-icon">✅</div>
        <h3>Message envoyé !</h3>
        <p>Merci pour votre message. Notre équipe vous contactera dans les plus brefs délais (sous 24h en jours ouvrés).</p>
      </div>

    </div><!-- /form-card -->


    <!-- ─── ASIDE ─── -->
    <div class="contact-aside">

      <!-- Horaires -->
      <div class="aside-card">
        <h3 class="aside-card-title"><span>🕐</span> Nos horaires</h3>
        <span class="open-badge">Ouvert maintenant</span>
        <div class="hours-list">
          <div class="hours-row">
            <span class="hours-day">Lundi – Vendredi</span>
            <span class="hours-time">9h00 – 19h00</span>
          </div>
          <div class="hours-row">
            <span class="hours-day">Samedi</span>
            <span class="hours-time">9h00 – 17h00</span>
          </div>
          <div class="hours-row">
            <span class="hours-day">Dimanche</span>
            <span class="hours-time closed">Fermé</span>
          </div>
        </div>
      </div>

      <!-- Réseaux sociaux -->
      <div class="aside-card">
        <h3 class="aside-card-title"><span>💬</span> Suivez-nous</h3>
        <div class="social-row">
          <a href="#" class="social-btn">📘 Facebook</a>
          <a href="#" class="social-btn">📸 Instagram</a>
          <a href="#" class="social-btn">▶️ YouTube</a>
        </div>
      </div>

      <!-- Plan -->
      <div class="map-card">
        <div class="map-placeholder">
          <span class="map-pin">📍</span>
          <div class="map-address">
            12 rue de la Victoire<br>
            75009 Paris<br>
            <small style="opacity:.6">Métro : Chaussée d'Antin (L7/L9)</small>
          </div>
        </div>
        <a href="https://maps.google.com" target="_blank" rel="noopener" class="map-cta">
          Ouvrir dans Google Maps →
        </a>
      </div>

    </div><!-- /aside -->

  </div><!-- /contact-grid -->
</div><!-- /contact-main -->


<!-- ════════════════════════════
     FAQ
     ════════════════════════════ -->
<section class="faq-section">
  <div>
    <p class="section-eyebrow" style="font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;color:var(--blue);font-weight:700;margin-bottom:10px;">FAQ</p>
    <h2 style="font-family:var(--font-display);font-size:clamp(2rem,3.5vw,3.2rem);letter-spacing:.04em;color:var(--text-dark);line-height:1;">
      Questions <em style="font-style:normal;color:var(--blue);">fréquentes</em>
    </h2>
  </div>

  <div class="faq-grid">

    <div class="faq-item">
      <button class="faq-question">
        Comment s'inscrire à une formation ?
        <span class="faq-arrow">▼</span>
      </button>
      <div class="faq-answer">
        L'inscription se fait en ligne via notre formulaire d'inscription ou directement en agence. Un conseiller vous contacte dans les 24h pour finaliser votre dossier et planifier votre bilan de conduite.
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">
        Quels documents fournir à l'inscription ?
        <span class="faq-arrow">▼</span>
      </button>
      <div class="faq-answer">
        Vous aurez besoin d'une pièce d'identité en cours de validité, d'un justificatif de domicile de moins de 3 mois, d'une photo d'identité et d'un NEPH si vous en possédez déjà un.
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">
        Peut-on payer en plusieurs fois ?
        <span class="faq-arrow">▼</span>
      </button>
      <div class="faq-answer">
        Oui ! Nous proposons un règlement en 3 ou 10 fois sans frais. Le CPF est également accepté pour financer tout ou partie de votre formation. Parlez-en à notre équipe lors de votre inscription.
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">
        Combien de temps dure la formation ?
        <span class="faq-arrow">▼</span>
      </button>
      <div class="faq-answer">
        La durée varie selon votre niveau de départ et votre rythme. En moyenne, comptez 3 à 6 mois pour le permis B classique. Notre stage intensif permet d'obtenir le permis en 3 semaines.
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">
        Est-il possible de prendre des cours le soir ?
        <span class="faq-arrow">▼</span>
      </button>
      <div class="faq-answer">
        Absolument. Nos formateurs sont disponibles jusqu'à 19h en semaine et le samedi matin. Vous choisissez vos créneaux en toute flexibilité depuis votre espace élève en ligne.
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">
        Que se passe-t-il en cas d'échec à l'examen ?
        <span class="faq-arrow">▼</span>
      </button>
      <div class="faq-answer">
        Pas de panique ! Nous analysons ensemble les points à améliorer et planifions des heures de conduite supplémentaires. Nos forfaits incluent un accompagnement jusqu'à la réussite.
      </div>
    </div>

  </div>
</section>

<?php   

  require_once("vue/footer.php")

 ?>

<!-- ─── Script FAQ accordion + formulaire ─── -->
<script src="assets/js/contact.js"></script>
