(() => {
  const menuToggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.primary-nav');

  if (menuToggle && nav) {
    menuToggle.addEventListener('click', () => {
      const expanded = menuToggle.getAttribute('aria-expanded') === 'true';
      menuToggle.setAttribute('aria-expanded', String(!expanded));
      nav.classList.toggle('is-open');
    });
  }

  const filterButtons = document.querySelectorAll('.filter-btn');
  const cards = document.querySelectorAll('#product-grid .card');

  filterButtons.forEach((button) => {
    button.addEventListener('click', () => {
      filterButtons.forEach((b) => b.classList.remove('is-active'));
      button.classList.add('is-active');
      const filter = button.dataset.filter;

      cards.forEach((card) => {
        const show = filter === 'all' || card.dataset.category === filter;
        card.style.display = show ? 'block' : 'none';
      });
    });
  });

  const testimonialWrap = document.querySelector('.testimonial-wrap');
  const nextButton = document.getElementById('next-testimonial');

  if (testimonialWrap && nextButton) {
    const testimonials = testimonialWrap.querySelectorAll('.testimonial');
    nextButton.addEventListener('click', () => {
      const current = Number(testimonialWrap.dataset.testimonialIndex || 0);
      const next = (current + 1) % testimonials.length;
      testimonials[current].classList.remove('is-active');
      testimonials[next].classList.add('is-active');
      testimonialWrap.dataset.testimonialIndex = String(next);
    });
  }
})();
