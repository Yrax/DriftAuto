/* ═══════════════════════════════════════════════
   DriftAuto — contact.js
   Logique de la page contact
   ═══════════════════════════════════════════════ */

(function () {

  /* ─── Onglets de sujet ─── */
  const tabs        = document.querySelectorAll('.subject-tab');
  const subjectInput = document.getElementById('subjectInput');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      if (subjectInput) subjectInput.value = tab.dataset.value;
    });
  });


  /* ─── Accordion FAQ ─── */
  const faqItems = document.querySelectorAll('.faq-item');

  faqItems.forEach(item => {
    const btn = item.querySelector('.faq-question');
    btn.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');
      // Ferme tous les autres
      faqItems.forEach(i => i.classList.remove('open'));
      // Toggle celui-ci
      if (!isOpen) item.classList.add('open');
    });
  });


  /* ─── Formulaire — validation + succès simulé ─── */
  const form        = document.getElementById('contactForm');
  const formContent = document.getElementById('formContent');
  const formSuccess = document.getElementById('formSuccess');

  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      // Validation basique
      const required = form.querySelectorAll('[required]');
      let valid = true;

      required.forEach(field => {
        field.style.borderColor = '';
        if (!field.value.trim() || (field.type === 'checkbox' && !field.checked)) {
          field.style.borderColor = '#ef4444';
          valid = false;
        }
      });

      if (!valid) return;

      // Bouton : état chargement
      const btn = form.querySelector('.btn-submit');
      btn.disabled = true;
      btn.innerHTML = '<span>Envoi en cours…</span>';

      // Simule l'envoi (à remplacer par fetch/AJAX vers le serveur)
      setTimeout(() => {
        formContent.style.display = 'none';
        formSuccess.classList.add('show');
      }, 1000);
    });

    // Reset couleur sur saisie
    form.querySelectorAll('input, textarea, select').forEach(field => {
      field.addEventListener('input', () => { field.style.borderColor = ''; });
    });
  }


  /* ─── Badge "Ouvert maintenant" dynamique ─── */
  const badge = document.querySelector('.open-badge');
  if (badge) {
    const now   = new Date();
    const day   = now.getDay();   // 0 = dim, 6 = sam
    const hour  = now.getHours();
    const min   = now.getMinutes();
    const time  = hour + min / 60;

    let isOpen = false;

    if (day >= 1 && day <= 5 && time >= 9 && time < 19) isOpen = true; // Lun-Ven
    if (day === 6 && time >= 9 && time < 17) isOpen = true;             // Sam

    if (!isOpen) {
      badge.style.background = '#fee2e2';
      badge.style.color      = '#b91c1c';
      badge.querySelector('::before') ; // handled via CSS
      badge.textContent = '';
      // Rebuild content sans le pseudo-élément
      badge.innerHTML = '<span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:#ef4444;margin-right:6px;"></span>Actuellement fermé';
    }
  }

})();
