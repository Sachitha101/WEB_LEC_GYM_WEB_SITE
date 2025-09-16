<?php
// CREATE ACCOUNT PAGE
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? 'Guest';

// If user is already logged in, redirect to home
if ($isLoggedIn) {
    header('Location: index.php?page=home');
    exit;
}

// Light DB connectivity check
$db_ok = false;
$pdo = connectDB();
if ($pdo) { $db_ok = true; }
?>
<section id="create_account" class="section create-account active" aria-label="Create Account" tabindex="0">
  <!-- Page Header -->
  <div class="page-header glass-card" style="padding: 2rem; margin-bottom: 2rem; text-align: center;">
    <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
      Join Our Fitness Community
    </h1>
    <p style="color: var(--fluent-text-secondary); font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
      Start your fitness journey today. Create your account and unlock access to personalized workouts, progress tracking, and a supportive community.
    </p>
  </div>

  <!-- Registration Container -->
  <div class="registration-container" style="max-width: 900px; margin: 0 auto;">
    <div class="registration-wrapper glass-card widgetMorph" style="overflow: hidden;">
      <div class="registration-card" role="region" aria-labelledby="create-heading">
        <div class="split registration-split" style="display: grid; grid-template-columns: 1fr 1px 1fr; gap: 0; min-height: 600px;">
          <div class="registration-col registration-col--left" style="padding: 3rem; display: flex; flex-direction: column; justify-content: center;">
            <div class="registration-header" style="text-align: center; margin-bottom: 2rem;">
              <div class="avatar-display" aria-hidden="true" style="font-size: 4rem; margin-bottom: 1rem; filter: drop-shadow(0 4px 8px rgba(0,194,255,0.3)); animation: float 3s ease-in-out infinite;">🎯</div>
              <h2 id="create-heading" style="color: var(--fluent-text-primary); font-size: 2.2rem; font-weight: 700; margin-bottom: 0.5rem; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Create your account</h2>
              <p class="muted" style="color: var(--fluent-text-secondary); font-size: 1.1rem;">Join Fitness Club to save progress, book classes, and more.</p>
            </div>

            <!-- DB Banner -->
            <div id="dbBanner" class="db-banner" role="alert" style="display: none; margin-bottom: 1rem; padding: .75rem 1rem; border-radius: 10px; background: #fee2e2; color: #991b1b; border: 1px solid #fecaca;">Database connection failed. Please start MySQL in XAMPP and refresh.</div>

            <form id="registrationForm" style="display: flex; flex-direction: column; gap: 1.5rem;">
              <!-- Name Fields -->
              <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                  <label for="firstName" class="form-label" style="color: var(--fluent-text-primary); font-weight: 600; margin-bottom: 0.5rem; display: block;">First Name *</label>
                  <input type="text" id="firstName" name="firstName" required placeholder="John" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem; color: var(--fluent-text-primary); font-size: 1rem; width: 100%; transition: all 0.3s ease; backdrop-filter: blur(10px);" />
                  <div id="err_firstName" class="error-msg" aria-live="polite" style="color: #ef4444; font-size: 0.9rem; margin-top: 0.35rem; opacity: 0; transform: translateY(-4px); transition: opacity .25s ease, transform .25s ease;"></div>
                </div>
                <div class="form-group">
                  <label for="lastName" class="form-label" style="color: var(--fluent-text-primary); font-weight: 600; margin-bottom: 0.5rem; display: block;">Last Name *</label>
                  <input type="text" id="lastName" name="lastName" required placeholder="Doe" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem; color: var(--fluent-text-primary); font-size: 1rem; width: 100%; transition: all 0.3s ease; backdrop-filter: blur(10px);" />
                  <div id="err_lastName" class="error-msg" aria-live="polite" style="color: #ef4444; font-size: 0.9rem; margin-top: 0.35rem; opacity: 0; transform: translateY(-4px); transition: opacity .25s ease, transform .25s ease;"></div>
                </div>
              </div>

              <!-- Email Field -->
              <div class="form-group">
                <label for="email" class="form-label" style="color: var(--fluent-text-primary); font-weight: 600; margin-bottom: 0.5rem; display: block;">Email Address *</label>
                <input type="email" id="email" name="email" required placeholder="john.doe@example.com" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem; color: var(--fluent-text-primary); font-size: 1rem; width: 100%; transition: all 0.3s ease; backdrop-filter: blur(10px);" />
                <div id="err_email" class="error-msg" aria-live="polite" style="color: #ef4444; font-size: 0.9rem; margin-top: 0.35rem; opacity: 0; transform: translateY(-4px); transition: opacity .25s ease, transform .25s ease;"></div>
              </div>

              <!-- Password Fields -->
              <div class="form-group">
                <label for="password" class="form-label" style="color: var(--fluent-text-primary); font-weight: 600; margin-bottom: 0.5rem; display: block;">Password *</label>
                <div class="input-container" style="position: relative;">
                  <input type="password" id="password" name="password" required minlength="8" placeholder="Create a strong password" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem 3rem 1rem 3rem; color: var(--fluent-text-primary); font-size: 1rem; width: 100%; transition: all 0.3s ease; backdrop-filter: blur(10px);" />
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); width: 20px; height: 20px; color: var(--fluent-text-secondary);">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <circle cx="12" cy="16" r="1"/>
                    <path d="M7 11V7a5 5 0 0110 0v4"/>
                  </svg>
                  <button type="button" id="togglePassword" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--fluent-text-secondary); cursor: pointer; padding: 0;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px;">
                      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                      <circle cx="12" cy="12" r="3"/>
                    </svg>
                  </button>
                </div>
                <!-- Password Strength Indicator -->
                <div id="passwordStrength" class="password-strength" style="margin-top: 0.5rem; display: none;">
                  <div class="strength-bars" style="display: flex; gap: 0.25rem; margin-bottom: 0.5rem;">
                    <div class="strength-bar" style="height: 4px; flex: 1; background: rgba(255,255,255,0.2); border-radius: 2px;"></div>
                    <div class="strength-bar" style="height: 4px; flex: 1; background: rgba(255,255,255,0.2); border-radius: 2px;"></div>
                    <div class="strength-bar" style="height: 4px; flex: 1; background: rgba(255,255,255,0.2); border-radius: 2px;"></div>
                    <div class="strength-bar" style="height: 4px; flex: 1; background: rgba(255,255,255,0.2); border-radius: 2px;"></div>
                  </div>
                  <div class="strength-text" style="font-size: 0.8rem; color: var(--fluent-text-secondary);"></div>
                </div>
                <div id="err_password" class="error-msg" aria-live="polite" style="color: #ef4444; font-size: 0.9rem; margin-top: 0.35rem; opacity: 0; transform: translateY(-4px); transition: opacity .25s ease, transform .25s ease;"></div>
              </div>

              <div class="form-group">
                <label for="confirmPassword" class="form-label" style="color: var(--fluent-text-primary); font-weight: 600; margin-bottom: 0.5rem; display: block;">Confirm Password *</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required placeholder="Confirm your password" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem; color: var(--fluent-text-primary); font-size: 1rem; width: 100%; transition: all 0.3s ease; backdrop-filter: blur(10px);" />
                <div id="err_confirmPassword" class="error-msg" aria-live="polite" style="color: #ef4444; font-size: 0.9rem; margin-top: 0.35rem; opacity: 0; transform: translateY(-4px); transition: opacity .25s ease, transform .25s ease;"></div>
              </div>

              <!-- Terms removed per request -->

              <!-- Submit Button -->
              <button type="submit" class="cta-btn btn btn-primary" id="registerButton" style="background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); border: none; border-radius: 12px; padding: 1rem 2rem; color: white; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0,194,255,0.3); width: 100%; display: flex; align-items: center; justify-content: center; gap: 0.6rem;">
                <svg class="lock" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" style="width: 22px; height: 22px;">
                  <path class="lock-shackle" d="M7 10V8a5 5 0 0110 0v2" />
                  <rect class="lock-body" x="5" y="10" width="14" height="10" rx="2" />
                  <circle cx="12" cy="15" r="1.5" />
                </svg>
                Create Account
              </button>
            </form>

            <!-- Confirmation box removed; we will use CMD boot overlay -->
          </div>

          <div class="registration-sep" aria-hidden="true" style="background: linear-gradient(180deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1)); width: 1px; margin: 2rem 0;"></div>

          <aside class="registration-col registration-col--right" aria-labelledby="oauth-heading" style="padding: 3rem; display: flex; flex-direction: column; justify-content: center; background: linear-gradient(180deg, rgba(255,255,255,0.05), rgba(255,255,255,0.02));">
            <h3 id="oauth-heading" style="color: var(--fluent-text-primary); font-size: 1.8rem; font-weight: 700; margin-bottom: 1rem; text-align: center;">Continue with</h3>
            <p class="muted" style="color: var(--fluent-text-secondary); text-align: center; margin-bottom: 2rem; font-size: 1rem;">Or sign up with one of the providers below</p>

            <div class="oauth-list" style="display: flex; flex-direction: column; gap: 1rem;">
              <button type="button" class="oauth microsoft-oauth" id="microsoft-oauth" aria-label="Continue with Microsoft" style="background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05)); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem; color: var(--fluent-text-primary); font-weight: 500; cursor: pointer; transition: all 0.3s ease; backdrop-filter: blur(10px); display: flex; align-items: center; gap: 0.75rem; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <svg viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                  <path fill="#F25022" d="M1 1h10v10H1z"/>
                  <path fill="#00A4EF" d="M12 1h10v10H12z"/>
                  <path fill="#7FBA00" d="M1 12h10v10H1z"/>
                  <path fill="#FFB900" d="M12 12h10v10H12z"/>
                </svg>
                Microsoft
              </button>

              <button type="button" class="oauth google-oauth" id="google-oauth" aria-label="Continue with Google" style="background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05)); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem; color: var(--fluent-text-primary); font-weight: 500; cursor: pointer; transition: all 0.3s ease; backdrop-filter: blur(10px); display: flex; align-items: center; gap: 0.75rem; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <svg viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                  <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                  <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                  <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                  <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Google
              </button>

              <button type="button" class="oauth facebook-oauth" id="facebook-oauth" aria-label="Continue with Facebook" style="background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05)); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem; color: var(--fluent-text-primary); font-weight: 500; cursor: pointer; transition: all 0.3s ease; backdrop-filter: blur(10px); display: flex; align-items: center; gap: 0.75rem; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <svg viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                  <path fill="#1877F2" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                Facebook
              </button>
            </div>

            <div style="text-align: center; margin-top: 2rem;">
              <p style="color: var(--fluent-text-secondary); margin-bottom: 1rem;">Already have an account?</p>
              <a href="index.php?page=login" class="ghost" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 0.9rem 1.1rem; color: var(--fluent-text-primary); font-weight: 500; cursor: pointer; transition: all 0.3s ease; backdrop-filter: blur(10px); text-decoration: none; display: inline-block;">Sign In</a>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </div>
  <!-- Boot/CMD overlay shown after successful sign-up -->
  <div id="bootOverlay" class="boot-overlay" aria-hidden="true" style="display:none;">
    <div class="boot-card glass-card" role="dialog" aria-modal="true" style="background: linear-gradient(180deg, rgba(255,255,255,0.15), rgba(255,255,255,0.08)); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.2); border-radius: 20px; padding: 3rem; max-width: 500px; width: 90%; text-align: center; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
      <div class="boot-logo" style="font-size: 1.5rem; font-weight: 700; color: var(--fluent-text-primary); margin-bottom: 2rem; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Fitness Club • Secure Setup</div>
      <div class="cmd-window glass-card" style="background: rgba(0,0,0,0.8); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; font-family: 'Courier New', monospace; text-align: left;">
        <pre id="cmdOutput" style="color: var(--fluent-text-primary); margin: 0; font-size: 0.9rem; line-height: 1.4;"></pre>
      </div>
      <div class="boot-progress" aria-hidden="true" style="margin-top: 1rem;">
        <div class="boot-progress-bar" style="height: 8px; background: rgba(255,255,255,0.1); border-radius: 4px; overflow: hidden; backdrop-filter: blur(10px);">
          <div id="bootProgressFill" style="width: 0%; height: 100%; background: linear-gradient(90deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); border-radius: 4px; transition: width 0.3s ease;"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
window.__DB_OK__ = <?php echo $db_ok ? 'true' : 'false'; ?>;

// Registration form handling
document.getElementById('registrationForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(this);
  const registrationData = {
    firstName: formData.get('firstName'),
    lastName: formData.get('lastName'),
    email: formData.get('email'),
    password: formData.get('password'),
    confirmPassword: formData.get('confirmPassword')
  };

    // Show loading state
    const registerButton = document.getElementById('registerButton');
    const originalText = registerButton.innerHTML;
    registerButton.innerHTML = '<span>Creating Account...</span>';
    registerButton.disabled = true;

    // Clear previous errors
    clearErrors();

    // Check if DB is available
    if (!window.__DB_OK__) {
        showError('Database connection failed. Please start MySQL in XAMPP and refresh.');
        registerButton.innerHTML = originalText;
        registerButton.disabled = false;
        return;
    }

    // Validate passwords match
    if (registrationData.password !== registrationData.confirmPassword) {
        showFieldError('err_confirmPassword', 'Passwords do not match');
        registerButton.innerHTML = originalText;
        registerButton.disabled = false;
        return;
    }

    // Validate password strength
    if (!isPasswordStrong(registrationData.password)) {
        showFieldError('err_password', 'Password must be at least 8 characters long and contain uppercase, lowercase, and numbers');
        registerButton.innerHTML = originalText;
        registerButton.disabled = false;
        return;
    }

  // Terms acceptance removed per request

  // Use CMD/boot-style animation on success

  // Call real signup API
  try {
    const payload = {
      name: `${registrationData.firstName} ${registrationData.lastName}`.trim(),
      email: registrationData.email,
      password: registrationData.password,
      age: 18, // minimal acceptable default for demo; adjust if you add field
      gender: null,
      education: null,
      country: null
    };
    const res = await fetch('api/auth.php?action=signup', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    const data = await res.json();
    if (data && data.success) {
      registerButton.innerHTML = originalText;
      registerButton.disabled = false;
      startAuthBoot('Fitness Club • Creating Account', [
        'Encrypting credentials…',
        'Creating secure profile…',
        'Initializing preferences…',
        'Finalizing setup…'
      ], 'index.php?page=login');
    } else {
      showFieldError('err_email', (data && data.message) ? data.message : 'Registration failed');
      registerButton.innerHTML = originalText;
      registerButton.disabled = false;
    }
  } catch (err) {
    showFieldError('err_email', 'Network error. Please try again.');
    registerButton.innerHTML = originalText;
    registerButton.disabled = false;
  }
});

// Password strength checking
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthIndicator = document.getElementById('passwordStrength');
    const strengthBars = strengthIndicator.querySelectorAll('.strength-bar');
    const strengthText = strengthIndicator.querySelector('.strength-text');

    if (password.length === 0) {
        strengthIndicator.style.display = 'none';
        return;
    }

    strengthIndicator.style.display = 'block';

    let strength = 0;
    let feedback = [];

    // Length check
    if (password.length >= 8) {
        strength += 1;
    } else {
        feedback.push('At least 8 characters');
    }

    // Lowercase check
    if (/[a-z]/.test(password)) {
        strength += 1;
    } else {
        feedback.push('Lowercase letter');
    }

    // Uppercase check
    if (/[A-Z]/.test(password)) {
        strength += 1;
    } else {
        feedback.push('Uppercase letter');
    }

    // Number check
    if (/\d/.test(password)) {
        strength += 1;
    } else {
        feedback.push('Number');
    }

    // Update visual indicator
    strengthBars.forEach((bar, index) => {
        if (index < strength) {
            if (strength <= 2) {
                bar.style.background = '#ef4444'; // Red
            } else if (strength <= 3) {
                bar.style.background = '#f59e0b'; // Yellow
            } else if (strength <= 4) {
                bar.style.background = '#10b981'; // Green
            } else {
                bar.style.background = '#10b981'; // Green
            }
        } else {
            bar.style.background = 'rgba(255,255,255,0.2)';
        }
    });

    // Update text feedback
    if (strength <= 2) {
        strengthText.textContent = 'Weak password. ' + feedback.join(', ');
        strengthText.style.color = '#ef4444';
    } else if (strength <= 3) {
        strengthText.textContent = 'Fair password. Add: ' + feedback.join(', ');
        strengthText.style.color = '#f59e0b';
    } else if (strength <= 4) {
        strengthText.textContent = 'Good password!';
        strengthText.style.color = '#10b981';
    } else {
        strengthText.textContent = 'Strong password!';
        strengthText.style.color = '#10b981';
    }
});

// Password visibility toggle
document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const icon = this.querySelector('svg');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.innerHTML = '<path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>';
    } else {
        passwordInput.type = 'password';
        icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
    }
});

// OAuth button handlers
// OAuth: open themed email modal matching login page
let __oauthProvider = null;
const oauthModal = (()=>{
  let el = document.getElementById('oauthEmailModal');
  if (el) return el;
  el = document.createElement('div');
  el.id = 'oauthEmailModal';
  el.className = 'cmd-modal';
  el.style.display = 'none';
  el.innerHTML = `
    <div class="cmd-window glass-card" role="dialog" aria-modal="true" aria-labelledby="oauthTitle" style="max-width: 520px; width: 92%; padding: 0; overflow: hidden;">
      <div style=\"display:flex; align-items:center; justify-content:space-between; padding:14px 16px; border-bottom:1px solid var(--glass-border); background: var(--fluent-surface-secondary);\">
        <div id=\"oauthTitle\" style=\"font-weight:700; color: var(--fluent-text-primary);\">Continue with Provider</div>
        <button id=\"oauthClose\" aria-label=\"Close\" style=\"background:transparent; border:none; color: var(--fluent-text-secondary); font-size:20px; cursor:pointer;\">×</button>
      </div>
      <form id=\"oauthForm\" style=\"padding:18px; display:flex; flex-direction:column; gap:14px;\">
        <div style=\"display:flex; align-items:center; gap:10px; color: var(--fluent-text-secondary);\">
          <div id=\"oauthBadge\" style=\"width:28px; height:28px; display:inline-grid; place-items:center; border-radius:8px; background:rgba(255,255,255,0.08); border:1px solid var(--glass-border);\">🔐</div>
          <div style=\"font-size:0.95rem;\">We’ll create or link your Fitness Club account using this email.</div>
        </div>
        <label for=\"oauthEmail\" style=\"color: var(--fluent-text-primary); font-weight:600;\">Email</label>
        <input id=\"oauthEmail\" type=\"email\" required placeholder=\"you@example.com\" style=\"background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 0.9rem; color: var(--fluent-text-primary); font-size: 1rem; width: 100%; transition: all 0.3s ease; backdrop-filter: blur(10px);\" />
        <div id=\"oauthError\" style=\"color:#ef4444; font-size:0.9rem; min-height:1.2em;\"></div>
        <div style=\"display:flex; gap:10px; justify-content:flex-end; margin-top:6px;\">
          <button type=\"button\" id=\"oauthCancel\" class=\"ghost\" style=\"background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 0.7rem 1rem; color: var(--fluent-text-primary);\">Cancel</button>
          <button type=\"submit\" class=\"primary\" style=\"background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); border: none; border-radius: 10px; padding: 0.7rem 1rem; color: white; font-weight:600;\">Continue</button>
        </div>
      </form>
    </div>`;
  document.body.appendChild(el);
  const close = ()=>{ el.style.display = 'none'; el.style.opacity = '0'; };
  el.querySelector('#oauthClose').addEventListener('click', close);
  el.querySelector('#oauthCancel').addEventListener('click', close);
  el.addEventListener('click', (e)=>{ if (e.target === el) close(); });
  el.querySelector('#oauthForm').addEventListener('submit', async (e)=>{
    e.preventDefault();
    const email = el.querySelector('#oauthEmail').value.trim();
    const err = el.querySelector('#oauthError');
    err.textContent = '';
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { err.textContent = 'Please enter a valid email.'; return; }
    el.style.opacity = '0.6';
    el.style.pointerEvents = 'none';
    try{
      const provider = __oauthProvider || 'provider';
      const payload = { provider, provider_id: provider + '-' + Date.now(), email, name: email.split('@')[0] };
      const res = await fetch('api/auth.php?action=oauth', { method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify(payload) });
      const data = await res.json();
      if (data && data.success) {
        close();
        // Reuse the same boot animation UX from login after oauth success
        if (typeof startAuthBoot === 'function') {
          startAuthBoot('Signing in with ' + provider, [
            'Contacting ' + provider + '…',
            'Validating identity…',
            'Linking provider to account…',
            'Creating secure session…'
          ], 'index.php?page=home');
        } else {
          window.location.href = 'index.php?page=home';
        }
      } else {
        err.textContent = (data && data.message) ? data.message : 'Provider sign-in failed';
      }
    } catch(ex){
      err.textContent = 'Network error. Please try again.';
    } finally {
      el.style.opacity = '';
      el.style.pointerEvents = '';
    }
  });
  return el;
})();

function openOauthEmailModal(provider){
  __oauthProvider = provider;
  const el = oauthModal;
  el.querySelector('#oauthTitle').textContent = `Continue with ${provider.charAt(0).toUpperCase()+provider.slice(1)}`;
  const badge = el.querySelector('#oauthBadge');
  badge.textContent = provider === 'google' ? 'G' : provider === 'microsoft' ? 'MS' : provider === 'facebook' ? 'f' : '🔐';
  const emailField = document.getElementById('email');
  el.querySelector('#oauthEmail').value = emailField && emailField.value ? emailField.value.trim() : '';
  el.style.display = 'flex';
  requestAnimationFrame(()=>{ el.style.opacity = '1'; });
}

document.getElementById('microsoft-oauth').addEventListener('click', function() { openOauthEmailModal('microsoft'); });
document.getElementById('google-oauth').addEventListener('click', function() { openOauthEmailModal('google'); });
document.getElementById('facebook-oauth').addEventListener('click', function() { openOauthEmailModal('facebook'); });

// Terms checkbox removed

// Form validation
document.getElementById('email').addEventListener('blur', function() {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (this.value && !emailRegex.test(this.value)) {
        showFieldError('err_email', 'Please enter a valid email address');
    } else {
        clearFieldError('err_email');
    }
});

document.getElementById('firstName').addEventListener('blur', function() {
    if (this.value && this.value.length < 2) {
        showFieldError('err_firstName', 'First name must be at least 2 characters long');
    } else {
        clearFieldError('err_firstName');
    }
});

document.getElementById('lastName').addEventListener('blur', function() {
    if (this.value && this.value.length < 2) {
        showFieldError('err_lastName', 'Last name must be at least 2 characters long');
    } else {
        clearFieldError('err_lastName');
    }
});

document.getElementById('confirmPassword').addEventListener('blur', function() {
    const password = document.getElementById('password').value;
    if (this.value && this.value !== password) {
        showFieldError('err_confirmPassword', 'Passwords do not match');
    } else {
        clearFieldError('err_confirmPassword');
    }
});

// Utility functions
function showError(message) {
    const dbBanner = document.getElementById('dbBanner');
    dbBanner.textContent = message;
    dbBanner.style.display = 'block';
    dbBanner.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function clearErrors() {
    document.getElementById('dbBanner').style.display = 'none';
    clearFieldError('err_firstName');
    clearFieldError('err_lastName');
    clearFieldError('err_email');
    clearFieldError('err_password');
    clearFieldError('err_confirmPassword');
  // terms error removed
}

function showFieldError(elementId, message) {
    const errorElement = document.getElementById(elementId);
    errorElement.textContent = message;
    errorElement.classList.add('show');
}

function clearFieldError(elementId) {
    const errorElement = document.getElementById(elementId);
    errorElement.classList.remove('show');
}

function isPasswordStrong(password) {
    return password.length >= 8 &&
           /[a-z]/.test(password) &&
           /[A-Z]/.test(password) &&
           /\d/.test(password);
}

// Start boot overlay animation (copied from login with minor title tweak)
function startAuthBoot(title, lines, redirectTo) {
  const overlay = document.getElementById('bootOverlay');
  if (!overlay) { window.location.href = redirectTo || 'index.php?page=login'; return; }
  overlay.setAttribute('aria-hidden', 'false');
  overlay.style.display = 'flex';
  requestAnimationFrame(() => { overlay.style.opacity = '1'; });
  const headerEl = overlay.querySelector('.boot-logo');
  if (headerEl && title) headerEl.textContent = title;
  const cmd = document.getElementById('cmdOutput');
  const bar = document.getElementById('bootProgressFill');
  if (cmd) cmd.textContent = '';
  if (bar) bar.style.width = '0%';
  const total = Math.max(lines.length, 4);
  let idx = 0;
  function step() {
    if (idx < lines.length && cmd) {
      cmd.textContent += `> ${lines[idx]}\n`;
      cmd.scrollTop = cmd.scrollHeight;
    }
    idx++;
    const pct = Math.min(100, Math.round((idx / (total + 1)) * 100));
    if (bar) bar.style.width = pct + '%';
    if (idx <= total) {
      setTimeout(step, 350);
    } else {
      setTimeout(() => {
        overlay.style.opacity = '0';
        setTimeout(() => {
          overlay.setAttribute('aria-hidden', 'true');
          overlay.style.display = 'none';
          if (redirectTo) window.location.href = redirectTo;
        }, 280);
      }, 420);
    }
  }
  setTimeout(step, 280);
}

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? 'var(--fluent-accent-primary)' : type === 'error' ? '#ef4444' : 'var(--fluent-accent-secondary)'};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        z-index: 1000;
        animation: slideInRight 0.3s ease-out;
        max-width: 400px;
    `;
    notification.textContent = message;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease-in';
        setTimeout(() => notification.remove(), 300);
    }, 5000);
}

// Enter key support
document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && document.activeElement.closest('#registrationForm')) {
        document.getElementById('registrationForm').dispatchEvent(new Event('submit'));
    }
});
</script>