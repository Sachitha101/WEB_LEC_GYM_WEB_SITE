(() => {
  const $ = (sel) => document.querySelector(sel);
  const form = $('#createForm');
  if (!form) return;

  const nameEl = $('#name');
  const emailEl = $('#email');
  const pwdEl = $('#password');
  const confirmEl = $('#confirm');
  const btn = $('#createBtn');
  const dbBanner = $('#dbBanner');
  const confirmBox = $('#confirmBox');
  const log1 = $('#log1');
  const log2 = $('#log2');
  const log3 = $('#log3');

  const err = {
    name: $('#err_name'),
    email: $('#err_email'),
    password: $('#err_password'),
    confirm: $('#err_confirm')
  };

  // DB connectivity hint
  const dbOk = form.getAttribute('data-db-ok') === '1';
  if (!dbOk) {
    dbBanner?.classList.add('show');
  }

  // Password strength meter
  const bars = Array.from(document.querySelectorAll('.bar'));
  const strengthText = $('#strengthText');
  function scorePassword(pw) {
    let score = 0;
    if (!pw) return score;
    const variations = {
      digits: /\d/.test(pw),
      lower: /[a-z]/.test(pw),
      upper: /[A-Z]/.test(pw),
      symbols: /[^A-Za-z0-9]/.test(pw),
      length: pw.length >= 8,
    };
    score = Object.values(variations).filter(Boolean).length;
    // extra bump for 12+ chars
    if (pw.length >= 12) score++;
    return Math.min(score, 3);
  }
  function renderStrength(pw) {
    const s = scorePassword(pw);
    bars.forEach((b, i) => {
      b.classList.toggle('active', i < s);
    });
    const labels = ['Weak', 'Medium', 'Strong'];
    strengthText.textContent = s === 0 ? 'Strength: —' : `Strength: ${labels[s-1]}`;
  }

  // Real-time validation helpers
  function showErr(key, msg) {
    if (!err[key]) return;
    err[key].textContent = msg || '';
    err[key].classList.toggle('show', !!msg);
  }
  function validateName() {
    const v = nameEl.value.trim();
    if (v.length < 2) { showErr('name', 'Please enter your full name'); return false; }
    showErr('name'); return true;
  }
  function validateEmail() {
    const v = emailEl.value.trim();
    const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
    if (!ok) { showErr('email', 'Enter a valid email address'); return false; }
    showErr('email'); return true;
  }
  function validatePassword() {
    const v = pwdEl.value;
    renderStrength(v);
    if (v.length < 8) { showErr('password', 'Min 8 characters'); return false; }
    if (!(/[a-z]/.test(v) && /[A-Z]/.test(v) && /\d/.test(v))) {
      showErr('password', 'Use upper, lower, and a number');
      return false;
    }
    showErr('password'); return true;
  }
  function validateConfirm() {
    const ok = confirmEl.value === pwdEl.value && confirmEl.value.length > 0;
    if (!ok) { showErr('confirm', 'Passwords do not match'); return false; }
    showErr('confirm'); return true;
  }

  nameEl.addEventListener('input', validateName);
  emailEl.addEventListener('input', validateEmail);
  pwdEl.addEventListener('input', () => { validatePassword(); validateConfirm(); });
  confirmEl.addEventListener('input', validateConfirm);

  // Submit
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const v1 = validateName();
    const v2 = validateEmail();
    const v3 = validatePassword();
    const v4 = validateConfirm();
    if (!(v1 && v2 && v3 && v4)) return;

    // Button animation
    btn.classList.add('submitting');
    btn.disabled = true;

    // Call API
    try {
      const payload = {
        name: nameEl.value.trim(),
        email: emailEl.value.trim(),
        password: pwdEl.value,
        // The signup API optionally accepts these; we send minimal fields
        age: 18
      };
      const res = await fetch('api/auth.php?action=signup', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      });
      const data = await res.json();
      if (!data.success) {
        // Surface errors near fields when possible
        const msg = (data.message || 'Registration failed');
        if (/email/i.test(msg)) showErr('email', msg);
        else if (/password/i.test(msg)) showErr('password', msg);
        else showErr('name', msg);
        return;
      }

      // Success: staged confirmation animation and redirect
      confirmBox.classList.add('show');
      // animate lines
      setTimeout(() => log1.classList.add('show'), 200);
      setTimeout(() => log2.classList.add('show'), 900);
      setTimeout(() => log3.classList.add('show'), 1600);

      // redirect after delay
      setTimeout(() => {
        window.location.href = 'login.php';
      }, 2300);
    } catch (errAny) {
      console.error(errAny);
      showErr('name', 'Network error. Please try again.');
    } finally {
      // Keep disabled briefly to avoid double submits; will redirect on success
      setTimeout(() => { btn.classList.remove('submitting'); btn.disabled = false; }, 1500);
    }
  });
})();
