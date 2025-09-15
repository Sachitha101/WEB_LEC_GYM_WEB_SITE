getNavButtons().forEach(btn=>{
  btn.addEventListener('click', (e)=>{
    const sec = e.currentTarget.dataset.section;
    getNavButtons().forEach(x=>x.classList.remove('active'));
    const navBtn = document.querySelector(`.nav-btn[data-section="${sec}"]`);
    if (navBtn) navBtn.classList.add('active');
    showSection(sec);
  });
});
