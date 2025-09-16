<?php
// LOGIN PAGE
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
<section id="login" class="section login active" aria-label="Login" tabindex="0">
  <!-- Page Header -->
  <div class="page-header glass-card" style="padding: 2rem; margin-bottom: 2rem; text-align: center;">
    <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
      Welcome Back
    </h1>
    <p style="color: var(--fluent-text-secondary); font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
      Sign in to your account to continue your fitness journey and access all features.
    </p>
  </div>

  <!-- Login Container -->
  <div class="login-container" style="max-width: 900px; margin: 0 auto;">
    <div class="login-wrapper glass-card widgetMorph" style="overflow: hidden;">
      <div class="login-card" role="region" aria-labelledby="signin-heading">
        <div class="split login-split" style="display: grid; grid-template-columns: 1fr 1px 1fr; gap: 0; min-height: 500px;">
          <div class="login-col login-col--left" style="padding: 3rem; display: flex; flex-direction: column; justify-content: center;">
            <div class="login-header" style="text-align: center; margin-bottom: 2rem;">
              <div class="avatar-display" aria-hidden="true" style="font-size: 4rem; margin-bottom: 1rem; filter: drop-shadow(0 4px 8px rgba(0,194,255,0.3)); animation: float 3s ease-in-out infinite;">🤖</div>
              <h2 id="signin-heading" style="color: var(--fluent-text-primary); font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Welcome back</h2>
              <p class="muted" style="color: var(--fluent-text-secondary); font-size: 1.1rem;">Sign in to continue to Fitness Club</p>
            </div>

            <!-- DB Banner -->
            <div id="dbBanner" class="db-banner" role="alert" style="display: none; margin-bottom: 1rem; padding: .75rem 1rem; border-radius: 10px; background: #fee2e2; color: #991b1b; border: 1px solid #fecaca;">Database connection failed. Please start MySQL in XAMPP and refresh.</div>

            <form id="loginForm" style="display: flex; flex-direction: column; gap: 1.5rem;">
              <div class="form-group">
                <label for="email" class="form-label" style="color: var(--fluent-text-primary); font-weight: 600; margin-bottom: 0.5rem; display: block;">Email</label>
                <input id="email" name="email" type="email" required class="form-input" placeholder="you@example.com" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem; color: var(--fluent-text-primary); font-size: 1rem; width: 100%; transition: all 0.3s ease; backdrop-filter: blur(10px);" />
                <div id="err_email" class="error-msg" aria-live="polite" style="color: #ef4444; font-size: 0.9rem; margin-top: 0.35rem; opacity: 0; transform: translateY(-4px); transition: opacity .25s ease, transform .25s ease;"></div>
              </div>

              <div class="form-group">
                <label for="password" class="form-label" style="color: var(--fluent-text-primary); font-weight: 600; margin-bottom: 0.5rem; display: block;">Password</label>
                <input id="password" name="password" type="password" required class="form-input" placeholder="Enter your password" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem; color: var(--fluent-text-primary); font-size: 1rem; width: 100%; transition: all 0.3s ease; backdrop-filter: blur(10px);" />
                <div id="err_password" class="error-msg" aria-live="polite" style="color: #ef4444; font-size: 0.9rem; margin-top: 0.35rem; opacity: 0; transform: translateY(-4px); transition: opacity .25s ease, transform .25s ease;"></div>
                <div id="pwdStrengthLogin" style="margin-top: .35rem; font-size: .9rem; color: var(--fluent-text-secondary);">Strength: <span id="pwdStrengthLoginText">🤔</span></div>
              </div>

              <div class="login-actions" style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem;">
                <label class="checkbox-container" style="display: flex; align-items: center; cursor: pointer;">
                  <input type="checkbox" id="rememberMe" name="rememberMe" style="margin-right: 0.5rem;" />
                  <span class="checkmark" style="width: 18px; height: 18px; border: 1px solid rgba(255,255,255,0.3); border-radius: 4px; display: inline-block; position: relative; margin-right: 0.5rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" style="width: 12px; height: 12px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0; transition: opacity 0.2s ease;">
                      <polyline points="20,6 9,17 4,12"/>
                    </svg>
                  </span>
                  Remember me
                </label>
                <a href="#" onclick="showForgotPassword()" style="color: var(--fluent-accent-secondary); text-decoration: none; font-weight: 600;">Forgot password?</a>
              </div>

              <button id="loginBtn" type="submit" class="cta-btn btn btn-primary" style="background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); border: none; border-radius: 12px; padding: 1rem 2rem; color: white; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0,194,255,0.3); width: 100%; display: flex; align-items: center; justify-content: center; gap: 0.6rem;">
                <svg class="lock" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" style="width: 22px; height: 22px;">
                  <path class="lock-shackle" d="M7 10V8a5 5 0 0110 0v2" />
                  <rect class="lock-body" x="5" y="10" width="14" height="10" rx="2" />
                  <circle cx="12" cy="15" r="1.5" />
                </svg>
                Sign In
              </button>
            </form>
          </div>

          <div class="login-sep" aria-hidden="true" style="background: linear-gradient(180deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1)); width: 1px; margin: 2rem 0;"></div>

          <aside class="login-col login-col--right" aria-labelledby="create-heading" style="padding: 3rem; display: flex; flex-direction: column; justify-content: center; background: linear-gradient(180deg, rgba(255,255,255,0.05), rgba(255,255,255,0.02));">
            <h3 id="create-heading" style="color: var(--fluent-text-primary); font-size: 1.8rem; font-weight: 700; margin-bottom: 1rem; text-align: center;">Continue with</h3>
            <p class="muted" style="color: var(--fluent-text-secondary); text-align: center; margin-bottom: 2rem; font-size: 1rem;">Or continue with one of the providers below</p>

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
              <p style="color: var(--fluent-text-secondary); margin-bottom: 1rem;">Don't have an account?</p>
              <a href="index.php?page=create_account" class="ghost" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 0.9rem 1.1rem; color: var(--fluent-text-primary); font-weight: 500; cursor: pointer; transition: all 0.3s ease; backdrop-filter: blur(10px); text-decoration: none; display: inline-block;">Create Account</a>
            </div>
          </aside>
        </div>
      </div>

      <!-- Signup Section -->
      <div id="signupSection" class="panel glass-card" aria-hidden="true" style="display:none; background: linear-gradient(180deg, rgba(255,255,255,0.12), rgba(255,255,255,0.06)); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.2); border-radius: 20px; padding: 3rem; margin-top: 2rem; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
        <div style="text-align: center; margin-bottom: 2rem;">
          <h2 style="color: var(--fluent-text-primary); font-size: 2.2rem; font-weight: 700; margin-bottom: 0.5rem; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Create your account</h2>
          <p class="muted" style="color: var(--fluent-text-secondary); font-size: 1.1rem;">Create an account to save progress, book classes, and manage your profile.</p>
        </div>

        <form id="signupForm" style="display: flex; flex-direction: column; gap: 1.5rem; max-width: 400px; margin: 0 auto;">
          <div class="form-group">
            <label for="su_name" style="color: var(--fluent-text-primary); font-weight: 600; margin-bottom: 0.5rem; display: block;">Full name</label>
            <input id="su_name" name="name" type="text" required style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem; color: var(--fluent-text-primary); font-size: 1rem; width: 100%; transition: all 0.3s ease; backdrop-filter: blur(10px);" placeholder="Enter your full name" />
          </div>

          <div class="form-group">
            <label for="su_email" style="color: var(--fluent-text-primary); font-weight: 600; margin-bottom: 0.5rem; display: block;">Email</label>
            <input id="su_email" name="email" type="email" required style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem; color: var(--fluent-text-primary); font-size: 1rem; width: 100%; transition: all 0.3s ease; backdrop-filter: blur(10px);" placeholder="Enter your email" />
          </div>

          <div class="form-group">
            <label for="su_password" style="color: var(--fluent-text-primary); font-weight: 600; margin-bottom: 0.5rem; display: block;">Password</label>
            <input id="su_password" name="password" type="password" minlength="8" required style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem; color: var(--fluent-text-primary); font-size: 1rem; width: 100%; transition: all 0.3s ease; backdrop-filter: blur(10px);" placeholder="Create a password" />
          </div>

          <div style="display:flex; gap:1rem; align-items:center; justify-content: center; margin-top: 1rem;">
            <button class="primary" type="submit" style="background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); border: none; border-radius: 12px; padding: 1rem 2rem; color: white; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0,194,255,0.3); flex: 1;">Create account</button>
            <button type="button" class="ghost" id="cancelSignup" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 1rem 2rem; color: var(--fluent-text-primary); font-weight: 500; cursor: pointer; transition: all 0.3s ease; backdrop-filter: blur(10px);">Back to Sign In</button>
          </div>

          <div id="signupMsg" role="status" aria-live="polite" style="margin-top: 1rem; text-align: center; padding: 0.75rem; border-radius: 8px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);"></div>
        </form>
      </div>

      <!-- Provider confirmation modal -->
      <div id="providerModal" class="modal provider-modal" aria-hidden="true" style="display:none;">
        <div class="modal-content glass-card" role="dialog" aria-modal="true" aria-labelledby="providerModalTitle" style="background: linear-gradient(180deg, rgba(255,255,255,0.15), rgba(255,255,255,0.08)); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.2); border-radius: 20px; max-width: 500px; width: 90%; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
          <button class="modal-close" aria-label="Close" id="provModalClose" style="position: absolute; top: 1rem; right: 1rem; background: rgba(255,255,255,0.1); border: none; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--fluent-text-primary); font-size: 1.2rem; transition: all 0.3s ease;">×</button>

          <div class="modal-header" style="text-align: center; margin-bottom: 2rem; padding-top: 1rem;">
            <div class="prov-avatar" id="provAvatar" aria-hidden="true" style="font-size: 3rem; margin-bottom: 1rem; filter: drop-shadow(0 4px 8px rgba(0,194,255,0.3));">P</div>
            <div>
              <h2 id="providerModalTitle" style="color: var(--fluent-text-primary); font-size: 1.8rem; font-weight: 700; margin-bottom: 0.5rem;">Complete your profile</h2>
              <p class="muted" style="color: var(--fluent-text-secondary); font-size: 1rem;">We need a few more details to create your account</p>
            </div>
          </div>

          <form id="providerConfirmForm" style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="prov-fields" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
              <div class="form-group">
                <label for="prov_firstName" style="color: var(--fluent-text-primary); font-weight: 600; margin-bottom: 0.5rem; display: block;">First Name</label>
                <input id="prov_firstName" name="firstName" type="text" required style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem; color: var(--fluent-text-primary); font-size: 1rem; width: 100%; transition: all 0.3s ease; backdrop-filter: blur(10px);" />
              </div>
              <div class="form-group">
                <label for="prov_lastName" style="color: var(--fluent-text-primary); font-weight: 600; margin-bottom: 0.5rem; display: block;">Last Name</label>
                <input id="prov_lastName" name="lastName" type="text" required style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem; color: var(--fluent-text-primary); font-size: 1rem; width: 100%; transition: all 0.3s ease; backdrop-filter: blur(10px);" />
              </div>
            </div>

            <div class="prov-note" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 1rem; color: var(--fluent-text-secondary); font-size: 0.9rem; margin: 1rem 0;">If you already have an account, you can link this provider to your existing account — enter your account password below to link, or use "Link to existing account" to reveal the fields.</div>

            <div style="margin-top: 1rem; display: flex; gap: 1rem; align-items: center;">
              <button type="submit" class="primary" style="background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); border: none; border-radius: 12px; padding: 1rem 2rem; color: white; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0,194,255,0.3); flex: 1;">Complete Setup</button>
              <button type="button" class="ghost" id="provLinkExisting" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 1rem 2rem; color: var(--fluent-text-primary); font-weight: 500; cursor: pointer; transition: all 0.3s ease; backdrop-filter: blur(10px);">Link to existing</button>
            </div>

            <div id="provExisting" style="display:none; margin-top: 1rem; padding: 1rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; backdrop-filter: blur(10px);">
              <div class="form-group">
                <label for="prov_existingEmail" style="color: var(--fluent-text-primary); font-weight: 600; margin-bottom: 0.5rem; display: block;">Account Email</label>
                <input id="prov_existingEmail" name="existingEmail" type="email" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem; color: var(--fluent-text-primary); font-size: 1rem; width: 100%; transition: all 0.3s ease; backdrop-filter: blur(10px);" placeholder="Enter your account email" />
              </div>
              <div class="form-group">
                <label for="prov_existingPassword" style="color: var(--fluent-text-primary); font-weight: 600; margin-bottom: 0.5rem; display: block;">Account Password</label>
                <input id="prov_existingPassword" name="existingPassword" type="password" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 1rem; color: var(--fluent-text-primary); font-size: 1rem; width: 100%; transition: all 0.3s ease; backdrop-filter: blur(10px);" placeholder="Enter your account password" />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Hidden by default; shown via CSS when aria-hidden="false" -->
  <div id="bootOverlay" class="boot-overlay" aria-hidden="true" style="display:none;">
    <div class="boot-card glass-card" role="dialog" aria-modal="true" style="background: linear-gradient(180deg, rgba(255,255,255,0.15), rgba(255,255,255,0.08)); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.2); border-radius: 20px; padding: 3rem; max-width: 500px; width: 90%; text-align: center; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
      <div class="boot-logo" style="font-size: 1.5rem; font-weight: 700; color: var(--fluent-text-primary); margin-bottom: 2rem; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Fitness Club • Secure Boot</div>
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

// Login form handling
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const loginData = {
        email: formData.get('email'),
        password: formData.get('password'),
        rememberMe: formData.get('rememberMe') ? true : false
    };

    // Show loading state
    const loginBtn = document.getElementById('loginBtn');
    const originalText = loginBtn.innerHTML;
    loginBtn.innerHTML = '<span>Signing In...</span>';
    loginBtn.disabled = true;

    // Clear previous errors
    clearErrors();

    // Check if DB is available
    if (!window.__DB_OK__) {
        showError('Database connection failed. Please start MySQL in XAMPP and refresh.');
        loginBtn.innerHTML = originalText;
        loginBtn.disabled = false;
        return;
    }

  try {
    const res = await fetch('api/auth.php?action=login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email: loginData.email, password: loginData.password })
    });
    const data = await res.json();
    if (data && data.success) {
      // Optionally remember email
      try { if (loginData.rememberMe) localStorage.setItem('remember_email', loginData.email); } catch (_) {}
      loginBtn.innerHTML = originalText;
      loginBtn.disabled = false;

      // Start authentication boot animation then redirect
      startAuthBoot('Fitness Club • Secure Sign-In', [
        'Initializing secure channel…',
        'Verifying credentials for ' + (loginData.email || 'user') + ' …',
        'Negotiating session keys…',
        'Syncing preferences…',
        'Finalizing session…'
      ], 'index.php?page=home');
    } else {
      showError(data && data.message ? data.message : 'Invalid email or password');
      loginBtn.innerHTML = originalText;
      loginBtn.disabled = false;
    }
  } catch (err) {
    showError('Network error. Please try again.');
    loginBtn.innerHTML = originalText;
    loginBtn.disabled = false;
  }
});

// OAuth: open themed email modal instead of browser prompt
let __oauthProvider = null;
const oauthModal = (()=>{
  // Create once
  let el = document.getElementById('oauthEmailModal');
  if (el) return el;
  el = document.createElement('div');
  el.id = 'oauthEmailModal';
  el.className = 'cmd-modal';
  el.style.display = 'none';
  el.innerHTML = `
    <div class="cmd-window glass-card" role="dialog" aria-modal="true" aria-labelledby="oauthTitle" style="max-width: 520px; width: 92%; padding: 0; overflow: hidden;">
      <div style="display:flex; align-items:center; justify-content:space-between; padding:14px 16px; border-bottom:1px solid var(--glass-border); background: var(--fluent-surface-secondary);">
        <div id="oauthTitle" style="font-weight:700; color: var(--fluent-text-primary);">Continue with Provider</div>
        <button id="oauthClose" aria-label="Close" style="background:transparent; border:none; color: var(--fluent-text-secondary); font-size:20px; cursor:pointer;">×</button>
      </div>
      <form id="oauthForm" style="padding:18px; display:flex; flex-direction:column; gap:14px;">
        <div style="display:flex; align-items:center; gap:10px; color: var(--fluent-text-secondary);">
          <div id="oauthBadge" style="width:28px; height:28px; display:inline-grid; place-items:center; border-radius:8px; background:rgba(255,255,255,0.08); border:1px solid var(--glass-border);">🔐</div>
          <div style="font-size:0.95rem;">We’ll create or link your Fitness Club account using this email.</div>
        </div>
        <label for="oauthEmail" style="color: var(--fluent-text-primary); font-weight:600;">Email</label>
        <input id="oauthEmail" type="email" required placeholder="you@example.com" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 0.9rem; color: var(--fluent-text-primary); font-size: 1rem; width: 100%; transition: all 0.3s ease; backdrop-filter: blur(10px);" />
        <div id="oauthError" style="color:#ef4444; font-size:0.9rem; min-height:1.2em;"></div>
        <div style="display:flex; gap:10px; justify-content:flex-end; margin-top:6px;">
          <button type="button" id="oauthCancel" class="ghost" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 0.7rem 1rem; color: var(--fluent-text-primary);">Cancel</button>
          <button type="submit" class="primary" style="background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); border: none; border-radius: 10px; padding: 0.7rem 1rem; color: white; font-weight:600;">Continue</button>
        </div>
      </form>
    </div>`;
  document.body.appendChild(el);
  // Events
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
        startAuthBoot('Signing in with ' + provider, [
          'Contacting ' + provider + '…',
          'Validating identity…',
          'Linking provider to account…',
          'Creating secure session…'
        ], 'index.php?page=home');
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
  const el = oauthModal; // created above
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

// Signup form handling
document.getElementById('signupForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const signupData = {
        name: formData.get('name'),
        email: formData.get('email'),
        password: formData.get('password')
    };

    // Basic validation
    if (!signupData.name || !signupData.email || !signupData.password) {
        document.getElementById('signupMsg').innerHTML = '<div style="color: #ef4444;">Please fill in all fields</div>';
        return;
    }

    // Show success message
    document.getElementById('signupMsg').innerHTML = '<div style="color: #10b981;">Account created successfully! Redirecting to login...</div>';

    // Redirect to login after a delay
    setTimeout(() => {
        window.location.href = 'index.php?page=login';
    }, 2000);
});

// Cancel signup
document.getElementById('cancelSignup').addEventListener('click', function() {
    document.getElementById('signupSection').style.display = 'none';
    document.getElementById('loginForm').style.display = 'flex';
});

// Provider modal handlers
document.getElementById('provModalClose').addEventListener('click', function() {
    document.getElementById('providerModal').style.display = 'none';
});

document.getElementById('provLinkExisting').addEventListener('click', function() {
    const existingSection = document.getElementById('provExisting');
    existingSection.style.display = existingSection.style.display === 'none' ? 'block' : 'none';
});

// Form validation
document.getElementById('email').addEventListener('blur', function() {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (this.value && !emailRegex.test(this.value)) {
        showFieldError('err_email', 'Please enter a valid email address');
    } else {
        clearFieldError('err_email');
    }
});

document.getElementById('password').addEventListener('blur', function() {
    if (this.value && this.value.length < 6) {
        showFieldError('err_password', 'Password must be at least 6 characters long');
    } else {
        clearFieldError('err_password');
    }
});

// Simple password strength indicator on login
document.getElementById('password').addEventListener('input', function() {
  const text = document.getElementById('pwdStrengthLoginText');
  const v = this.value || '';
  let score = 0;
  if (v.length >= 8) score++;
  if (/[a-z]/.test(v)) score++;
  if (/[A-Z]/.test(v)) score++;
  if (/\d/.test(v)) score++;
  if (/[^A-Za-z0-9]/.test(v)) score++;
  const emoji = ['🤔', '😬', '🙂', '💪', '🛡️', '🏆'][Math.min(score, 5)];
  text.textContent = emoji;
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
    clearFieldError('err_email');
    clearFieldError('err_password');
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

// ===== Boot/Command animation =====
function startAuthBoot(title, lines, redirectTo) {
  const overlay = document.getElementById('bootOverlay');
  if (!overlay) { window.location.href = redirectTo || 'index.php?page=home'; return; }

  // Set visible
  overlay.setAttribute('aria-hidden', 'false');
  overlay.style.display = 'flex';
  requestAnimationFrame(() => { overlay.style.opacity = '1'; });

  // Title
  const headerEl = overlay.querySelector('.boot-logo');
  if (headerEl && title) headerEl.textContent = title;

  // Reset output
  const cmd = document.getElementById('cmdOutput');
  const bar = document.getElementById('bootProgressFill');
  if (cmd) cmd.textContent = '';
  if (bar) bar.style.width = '0%';

  // Play steps
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
        // Fade out and redirect
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

// Checkbox styling
document.getElementById('rememberMe').addEventListener('change', function() {
    const checkmark = this.parentElement.querySelector('.checkmark svg');
    if (this.checked) {
        checkmark.style.opacity = '1';
    } else {
        checkmark.style.opacity = '0';
    }
});

// Forgot password functionality
function showForgotPassword() {
    showNotification('Password reset functionality coming soon!', 'info');
}

// Enter key support
document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && document.activeElement.closest('#loginForm')) {
        document.getElementById('loginForm').dispatchEvent(new Event('submit'));
    }
});
</script>