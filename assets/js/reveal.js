// Simple reveal-on-scroll animations for cards and sections
(function(){
  const els = Array.from(document.querySelectorAll('.glass-card, .widgetMorph, .section'));
  if (!('IntersectionObserver' in window) || els.length === 0) return;

  els.forEach(el => el.classList.add('reveal-pending'));

  const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('reveal-in');
        e.target.classList.remove('reveal-pending');
        io.unobserve(e.target);
      }
    });
  }, { rootMargin: '0px 0px -10% 0px', threshold: 0.12 });

  els.forEach(el => io.observe(el));
})();
