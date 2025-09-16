/*
Project Roles (Vote to assign):
1. Frontend Developer (HTML/CSS/JS)
2. Authentication & Security Lead
3. API Integration Specialist
4. Testing & Quality Assurance
5. Documentation & Support

Handles login form submission and boot animation. Owner: Frontend + Auth Lead.
Voting note: any auth-related change requires an Auth Lead review.
*/
// Enhanced login.js with Fluent Design animations and micro-interactions
// Updated to use client-side API shim and bcrypt hashing
(function(){
  const form = document.getElementById('loginForm');
  const overlay = document.getElementById('bootOverlay');
  const cmdOutput = document.getElementById('cmdOutput');

  function sleep(ms){ return new Promise(r=>setTimeout(r,ms)); }

  async function typeLine(text){
    if (!cmdOutput) return;
    for(let i=0;i<text.length;i++){
      cmdOutput.textContent = cmdOutput.textContent + text.charAt(i);
      await sleep(12);
    }
    cmdOutput.textContent += '\n';
  }

  function animateProgress(el, duration){
    if (!el) return;
    const start = performance.now();
    function step(now){
      const t = Math.min(1,(now-start)/duration);
      el.style.width = (t*100) + '%';
      if (t<1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }

  async function runBootSequence(){
    if (!overlay || !cmdOutput) return Promise.resolve();
    // accessibility: remember previously focused element and move focus into overlay
    const previouslyFocused = document.activeElement;
    overlay.style.display = 'flex';
    overlay.setAttribute('aria-hidden','false');
    // make cmdOutput an accessible live region and focus target
    try { cmdOutput.setAttribute('tabindex', '-1'); cmdOutput.setAttribute('role','status'); cmdOutput.setAttribute('aria-live','polite'); cmdOutput.focus(); } catch(e){}

    // robust focus trap: keep focus inside overlay and handle Escape to cancel
    const trapElements = overlay.querySelectorAll('button, [href], input, textarea, select, [tabindex]');
    const firstTrap = trapElements[0] || cmdOutput;
    const lastTrap = trapElements[trapElements.length - 1] || cmdOutput;
    function handleKey(e){
      if (e.key === 'Tab') {
        // Shift+Tab
        if (e.shiftKey && document.activeElement === firstTrap) { e.preventDefault(); lastTrap.focus(); }
        else if (!e.shiftKey && document.activeElement === lastTrap) { e.preventDefault(); firstTrap.focus(); }
      }
      if (e.key === 'Escape') {
        e.preventDefault();
        // allow overlay to be dismissed early if needed
        overlay.style.opacity = '0';
        overlay.setAttribute('aria-hidden','true');
        overlay.style.display = 'none';
      }
    }
    overlay.addEventListener('keydown', handleKey);

    // Smooth fade in
    requestAnimationFrame(() => {
      overlay.style.opacity = '1';
    });

  cmdOutput.textContent = '';
    const progressFill = document.getElementById('bootProgressFill');
    const totalDuration = 1800;
    const lines = [
      'Initializing Fitness Club UI...',
      'Loading authentication modules...',
      'Establishing secure connection...',
      'Applying modern Fluent Design...',
      'Launching personalized dashboard'
    ];
    animateProgress(progressFill, totalDuration);
    const perLineDelay = Math.max(140, Math.floor(totalDuration / Math.max(1, lines.length)));
    for(const line of lines){
      await typeLine(line);
      await sleep(perLineDelay);
    }
    await sleep(300);

    cmdOutput.textContent += '\n✓ Ready for action!';
    overlay.style.transition = 'opacity 0.6s ease';
    overlay.style.opacity = '1';
    return new Promise(res=>{
      setTimeout(()=>{
        overlay.style.opacity = '0';
        setTimeout(()=>{
          overlay.setAttribute('aria-hidden','true');
          overlay.style.display = 'none';
          overlay.style.opacity = '';
          // remove trap listener
          overlay.removeEventListener('keydown', handleKey);
          // restore focus
          try{ if (previouslyFocused && typeof previouslyFocused.focus === 'function') previouslyFocused.focus(); }catch(e){}
          res();
        }, 600);
      }, 500);
    });
  }

  // restore focus after overlay hidden (wraps runBootSequence when used elsewhere)
  const originalRunBoot = runBootSequence;
  window.__fitnessRunBoot = async function(){
    const prev = document.activeElement;
    await originalRunBoot();
    try{ if (prev && typeof prev.focus === 'function') prev.focus(); }catch(e){}
  };

  async function submitLogin(ev){
    ev.preventDefault();
    if (!form) return;

    const email = (form.email && form.email.value) ? form.email.value.trim() : (document.getElementById('email')?.value || '').trim();
    const password = (form.password && form.password.value) ? form.password.value : (document.getElementById('password')?.value || '');

    if (!email || !password) {
      showMessage('Please fill in all fields', 'error');
      return;
    }

    // Add loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.textContent = 'Signing in...';
      submitBtn.style.opacity = '0.7';
    }

    // Use API shim instead of direct fetch to PHP
    const payload = { email, password };
    try {
      // The API shim will intercept this fetch and handle it with IndexedDB
      const resp = await fetch('api/auth.php?action=login', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify(payload),
        credentials: 'include'
      });
      const data = await resp.json();

      if (data.success) {
        showMessage('Login successful!', 'success');
        await runBootSequence();
        setTimeout(()=>{ window.location.href = 'index.html'; }, 600);
      } else {
        showMessage(data.message || 'Login failed', 'error');
        // Reset button
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.textContent = 'Sign In';
          submitBtn.style.opacity = '1';
        }
      }
    } catch(err) {
      showMessage('Network error occurred', 'error');
      // Reset button
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Sign In';
        submitBtn.style.opacity = '1';
      }
    }
  }

  function showMessage(message, type) {
    // Remove existing message
    const existingMsg = document.getElementById('loginMsg');
    if (existingMsg) existingMsg.remove();

    // Create new message
    const msgEl = document.createElement('div');
    msgEl.id = 'loginMsg';
    msgEl.setAttribute('role', 'status');
    msgEl.setAttribute('aria-live', 'polite');
    msgEl.textContent = message;
    msgEl.style.cssText = `
      margin-top: 1rem;
      padding: 0.75rem 1rem;
      border-radius: 12px;
      font-weight: 500;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255,255,255,0.1);
      animation: slideDownFade 0.3s ease-out;
    `;

    if (type === 'success') {
      msgEl.style.background = 'rgba(34, 197, 94, 0.1)';
      msgEl.style.color = '#22c55e';
      msgEl.style.borderColor = 'rgba(34, 197, 94, 0.2)';
    } else {
      msgEl.style.background = 'rgba(239, 68, 68, 0.1)';
      msgEl.style.color = '#ef4444';
      msgEl.style.borderColor = 'rgba(239, 68, 68, 0.2)';
    }

    // Insert after form
    if (form) {
      form.appendChild(msgEl);
    }
  }

  if (form) form.addEventListener('submit', submitLogin);

  // expose for other scripts
  window.__fitnessRunBoot = runBootSequence;
})();
// Login page logic with boot/terminal animation
document.addEventListener('DOMContentLoaded', ()=>{
  const form = document.getElementById('loginPageForm') || document.getElementById('loginForm');
  const msgEl = document.getElementById('loginPageMsg') || document.getElementById('loginMsg');
  const overlay = document.getElementById('bootOverlay');
  const cmd = document.getElementById('cmdOutput');

  // Avoid a duplicate fetch/animation handler; main handler is already registered above.
  // Here we only enhance interactions and wire provider flows.

  // Enhanced micro-interactions for login page
  (function fluentLoginInteractions(){
    try{
      // Enhanced input focus effects
      document.querySelectorAll('input, button').forEach(el => {
        el.addEventListener('focus', () => {
          el.style.transform = 'scale(1.02)';
          el.style.boxShadow = '0 0 0 3px rgba(0, 194, 255, 0.1)';
          el.style.outline = 'none';
        });

        el.addEventListener('blur', () => {
          el.style.transform = 'scale(1)';
          el.style.boxShadow = '';
        });

        // Enhanced button hover
        if (el.tagName === 'BUTTON') {
          el.addEventListener('mouseenter', () => {
            el.style.transform = 'scale(1.05)';
            el.style.boxShadow = '0 8px 24px rgba(0, 194, 255, 0.2)';
          });

          el.addEventListener('mouseleave', () => {
            el.style.transform = 'scale(1)';
            el.style.boxShadow = '';
          });
        }
      });

      // OAuth button enhancements
      document.querySelectorAll('.oauth').forEach(btn => {
        btn.addEventListener('mouseenter', () => {
          btn.style.transform = 'translateY(-2px)';
          btn.style.boxShadow = '0 8px 24px rgba(0, 0, 0, 0.15)';
        });

        btn.addEventListener('mouseleave', () => {
          btn.style.transform = 'translateY(0)';
          btn.style.boxShadow = '';
        });

        btn.addEventListener('click', () => {
          btn.style.transform = 'scale(0.98)';
          setTimeout(() => btn.style.transform = 'scale(1)', 150);
        });
      });

      // Avatar floating animation
      const avatar = document.querySelector('.avatar-display');
      if (avatar) {
        let floatAnimation = null;
        function startFloat() {
          if (floatAnimation) cancelAnimationFrame(floatAnimation);
          let start = null;
          function animate(timestamp) {
            if (!start) start = timestamp;
            const progress = (timestamp - start) / 3000; // 3 second cycle
            const y = Math.sin(progress * Math.PI * 2) * 5; // 5px float
            avatar.style.transform = `translateY(${y}px)`;
            floatAnimation = requestAnimationFrame(animate);
          }
          floatAnimation = requestAnimationFrame(animate);
        }
        startFloat();
      }

      // Show signup section toggle
      const showSignupBtn = document.getElementById('showSignup');
      const signupSection = document.getElementById('signupSection');
      const cancelSignupBtn = document.getElementById('cancelSignup');

      if (showSignupBtn && signupSection) {
        showSignupBtn.addEventListener('click', () => {
          signupSection.style.display = 'block';
          signupSection.style.opacity = '0';
          signupSection.style.transform = 'translateY(20px)';
          requestAnimationFrame(() => {
            signupSection.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
            signupSection.style.opacity = '1';
            signupSection.style.transform = 'translateY(0)';
          });
          showSignupBtn.style.display = 'none';
        });
      }

      if (cancelSignupBtn && signupSection && showSignupBtn) {
        cancelSignupBtn.addEventListener('click', () => {
          signupSection.style.opacity = '0';
          signupSection.style.transform = 'translateY(20px)';
          setTimeout(() => {
            signupSection.style.display = 'none';
            showSignupBtn.style.display = 'block';
          }, 500);
        });
      }

    }catch(e){ console.warn('Fluent login interactions failed', e); }
  })();

  // Removed duplicate runBootSequence implementation to prevent overlapping typing.

  // OAuth and signup removed for simplified demo: login only
  // Provider buttons (demo): click -> prompt for provider email, run animation, POST to server oauth endpoint
  const providerButtons = {
    microsoft: document.getElementById('microsoft-oauth'),
    google: document.getElementById('google-oauth'),
    apple: document.getElementById('apple-oauth')
  };

  // Modal elements
  const providerModal = document.getElementById('providerModal');
  const provName = document.getElementById('prov_name');
  const provEmail = document.getElementById('prov_email');
  const provCancel = document.getElementById('provCancel');
  const provConfirm = document.getElementById('provConfirm');
  const provModalClose = document.getElementById('provModalClose');
  const provLinkBtn = document.getElementById('provLinkBtn');
  const provExisting = document.getElementById('provExisting');
  const provExistEmail = document.getElementById('prov_exist_email');
  const provExistPassword = document.getElementById('prov_exist_password');
  const provAvatar = document.getElementById('provAvatar');

  let pendingProvider = null;

  // Reusable provider sign-in with boot animation and redirect
  async function signInWithProvider(provider, opts={}){
    const email = (opts.email || `${provider}-user@example.com`).trim();
    const name = (opts.name || email.split('@')[0]).trim();
    const linkExisting = !!opts.linkExisting;
    const existingEmail = opts.existingEmail || '';
    const existingPassword = opts.existingPassword || '';

    // Show boot overlay and run animation in parallel with API call
    if (overlay) overlay.setAttribute('aria-hidden','false');
    const payload = {
      provider,
      provider_id: provider + '-' + Date.now(),
      email,
      name,
      link_existing: linkExisting,
      existing_email: existingEmail,
      existing_password: existingPassword
    };

    try{
      const fetchPromise = fetch('api/auth.php?action=oauth', {
        method:'POST', headers:{'Content-Type':'application/json'},
        body: JSON.stringify(payload), credentials:'include'
      }).then(r=>r.json());
  const animPromise = (window.__fitnessRunBoot ? window.__fitnessRunBoot() : Promise.resolve());
      const [res] = await Promise.all([fetchPromise, animPromise]);
      if (res && res.success){
        setTimeout(()=>{ window.location.href = 'index.html'; }, 200);
      } else {
        if (overlay) overlay.setAttribute('aria-hidden','true');
        if (msgEl) { msgEl.textContent = (res && res.message) ? res.message : 'Provider login failed'; msgEl.style.color = 'red'; }
      }
    }catch(err){
      if (overlay) overlay.setAttribute('aria-hidden','true');
      if (msgEl) { msgEl.textContent = 'Network error'; msgEl.style.color = 'red'; }
    }
  }

  // One‑click OAuth: clicking provider buttons triggers sign-in and boot animation
  Object.entries(providerButtons).forEach(([provider, btn])=>{
    if (!btn) return;
    btn.addEventListener('click', (e)=>{
      e.preventDefault();
      // If the user holds Alt/Option, open the modal to edit details; otherwise quick sign-in
      if (e.altKey){
        if (!providerModal || !provName || !provEmail) return;
        pendingProvider = provider;
        const simulatedEmail = provider + '-user@example.com';
        try { provName.value = simulatedEmail.split('@')[0]; } catch(e){}
        try { provEmail.value = simulatedEmail; } catch(e){}
        if (provAvatar) provAvatar.textContent = provider.charAt(0).toUpperCase();
        const subtitle = document.getElementById('providerModalSubtitle');
        if (subtitle) subtitle.textContent = `Signing in with ${provider.charAt(0).toUpperCase() + provider.slice(1)} — review or edit details to continue.`;
        providerModal.style.display = '';
        providerModal.setAttribute('aria-hidden','false');
      } else {
        // quick sign-in path
        signInWithProvider(provider);
      }
    });
  });

  // Expose globally in case other scripts need to trigger it
  window.signInWithProvider = signInWithProvider;

  // Fallback: event delegation in case direct listeners are removed or the DOM is re-rendered
  document.addEventListener('click', (e)=>{
    const btn = e.target.closest && e.target.closest('.oauth');
    if (!btn) return;
    const id = btn.id || '';
  const map = { 'microsoft-oauth':'microsoft', 'google-oauth':'google', 'apple-oauth':'apple' };
    const provider = map[id];
    if (provider) {
      e.preventDefault();
      if (e.altKey) return; // allow modal path previously handled above
      signInWithProvider(provider);
    }
  });

  function closeProviderModal(){
    pendingProvider = null;
    if (providerModal) {
      providerModal.style.display = 'none';
      providerModal.setAttribute('aria-hidden','true');
    }
  }
  if (provCancel) provCancel.addEventListener('click', closeProviderModal);
  if (provModalClose) provModalClose.addEventListener('click', closeProviderModal);

  // Toggle link-to-existing account fields
  provLinkBtn && provLinkBtn.addEventListener('click', ()=>{
    if (!provExisting) return;
    const visible = provExisting.style.display !== 'none';
    provExisting.style.display = visible ? 'none' : 'block';
    provLinkBtn.textContent = visible ? 'Link to existing account' : 'Hide linking fields';
  });

  // Submit provider confirmation form
  const providerConfirmForm = document.getElementById('providerConfirmForm');
  providerConfirmForm && providerConfirmForm.addEventListener('submit', async (ev)=>{
    ev.preventDefault();
    if (!pendingProvider) return;
    const provider = pendingProvider;
    const email = provEmail.value.trim();
    const name = provName.value.trim() || (email ? email.split('@')[0] : provider + '-user');

    // collect existing-account linking info if present
    const linkExisting = provExisting && provExisting.style.display !== 'none';
    const existingEmail = linkExisting && provExistEmail ? provExistEmail.value.trim() : '';
    const existingPassword = linkExisting && provExistPassword ? provExistPassword.value : '';

    // hide modal then proceed with the common sign-in flow
    if (providerModal) { providerModal.style.display = 'none'; providerModal.setAttribute('aria-hidden','true'); }
    signInWithProvider(provider, { email, name, linkExisting, existingEmail, existingPassword });
  });

  // Signup: re-add submit handler
  const signupForm = document.getElementById('signupForm');
  if (signupForm) signupForm.addEventListener('submit', async (e)=>{
    e.preventDefault();
    const msgEl = document.getElementById('signupMsg'); if (msgEl) msgEl.textContent = '';
    const payload = {
      name: document.getElementById('su_name').value,
      email: document.getElementById('su_email').value,
      password: document.getElementById('su_password').value
    };
    try{
  const res = await fetch('api/auth.php?action=signup',{method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(payload), credentials:'include'});
  const j = await res.json();
  if (j.success){ if (msgEl){ msgEl.textContent = 'Account created. Redirecting...'; msgEl.style.color = 'green'; } if (overlay) overlay.setAttribute('aria-hidden','false'); await runBootSequence(cmd); window.location.href = 'index.html'; }
      else { if (msgEl){ msgEl.textContent = j.message || 'Signup failed'; msgEl.style.color = 'red'; } }
    }catch(err){ if (msgEl){ msgEl.textContent = 'Network error'; msgEl.style.color = 'red'; } }
  });
});
