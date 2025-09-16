/*
 * Account Creation - Handle user registration and account setup
 * Provides form validation, password strength checking, and registration submission
 */

// Account Creation Manager
class AccountCreationManager {
  constructor() {
    this.passwordStrength = {
      score: 0,
      checks: {
        length: false,
        uppercase: false,
        lowercase: false,
        numbers: false,
        special: false
      }
    };
    this.init();
  }

  init() {
    this.bindEvents();
    this.setupPasswordValidation();
    this.setupFormValidation();
    this.loadExistingData();
  }

  bindEvents() {
    // Registration form submission
    const registerForm = document.getElementById('createAccountForm') || document.getElementById('registerForm');
    if (registerForm) {
      registerForm.addEventListener('submit', (e) => this.handleRegistration(e));
    }

    // Password confirmation matching
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');

    if (passwordInput && confirmPasswordInput) {
      confirmPasswordInput.addEventListener('input', () => {
        this.validatePasswordMatch();
      });

      passwordInput.addEventListener('input', () => {
        this.validatePasswordMatch();
      });
    }

    // Real-time validation
    this.setupRealTimeValidation();

    // Terms and conditions
    const termsCheckbox = document.getElementById('acceptTerms');
    if (termsCheckbox) {
      termsCheckbox.addEventListener('change', (e) => {
        this.toggleSubmitButton(e.target.checked);
      });
    }

    // Newsletter signup
    const newsletterCheckbox = document.getElementById('newsletterSignup');
    if (newsletterCheckbox) {
      newsletterCheckbox.addEventListener('change', (e) => {
        this.handleNewsletterSignup(e.target.checked);
      });
    }

    // Social registration buttons
    this.setupSocialRegistration();
  }

  setupPasswordValidation() {
    const passwordInput = document.getElementById('password');
    if (!passwordInput) return;

    passwordInput.addEventListener('input', (e) => {
      this.checkPasswordStrength(e.target.value);
      this.updatePasswordStrengthUI();
    });

    // Show/hide password toggle
    const toggleBtn = document.querySelector('.password-toggle');
    if (toggleBtn) {
      toggleBtn.addEventListener('click', () => {
        this.togglePasswordVisibility(passwordInput, toggleBtn);
      });
    }
  }

  checkPasswordStrength(password) {
    this.passwordStrength.checks = {
      length: password.length >= 8,
      uppercase: /[A-Z]/.test(password),
      lowercase: /[a-z]/.test(password),
      numbers: /\d/.test(password),
      special: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)
    };

    // Calculate score
    const passedChecks = Object.values(this.passwordStrength.checks).filter(Boolean).length;
    this.passwordStrength.score = passedChecks;

    // Determine strength level
    if (passedChecks >= 5) this.passwordStrength.level = 'strong';
    else if (passedChecks >= 3) this.passwordStrength.level = 'medium';
    else if (passedChecks >= 2) this.passwordStrength.level = 'weak';
    else this.passwordStrength.level = 'very-weak';
  }

  updatePasswordStrengthUI() {
    const strengthIndicator = document.getElementById('passwordStrength');
    const strengthText = document.getElementById('passwordStrengthText');
    const checksList = document.getElementById('passwordChecks');

    if (!strengthIndicator || !strengthText || !checksList) return;

    // Update strength indicator
    strengthIndicator.className = `password-strength ${this.passwordStrength.level}`;

    // Update strength text
    const strengthLabels = {
      'very-weak': 'Very Weak',
      'weak': 'Weak',
      'medium': 'Medium',
      'strong': 'Strong'
    };
    strengthText.textContent = strengthLabels[this.passwordStrength.level] || 'Very Weak';

    // Update checks list
    checksList.innerHTML = '';
    const checkLabels = {
      length: 'At least 8 characters',
      uppercase: 'One uppercase letter',
      lowercase: 'One lowercase letter',
      numbers: 'One number',
      special: 'One special character'
    };

    Object.entries(this.passwordStrength.checks).forEach(([check, passed]) => {
      const checkItem = document.createElement('li');
      checkItem.className = `password-check ${passed ? 'passed' : 'failed'}`;
      checkItem.innerHTML = `
        <i class="fas ${passed ? 'fa-check' : 'fa-times'}"></i>
        <span>${checkLabels[check]}</span>
      `;
      checksList.appendChild(checkItem);
    });
  }

  validatePasswordMatch() {
    const password = document.getElementById('password')?.value || '';
    const confirmPassword = document.getElementById('confirmPassword')?.value || '';
    const matchIndicator = document.getElementById('passwordMatch');

    if (!matchIndicator) return;

    if (!confirmPassword) {
      matchIndicator.style.display = 'none';
      return;
    }

    matchIndicator.style.display = 'block';

    if (password === confirmPassword) {
      matchIndicator.className = 'password-match success';
      matchIndicator.innerHTML = '<i class="fas fa-check"></i> Passwords match';
    } else {
      matchIndicator.className = 'password-match error';
      matchIndicator.innerHTML = '<i class="fas fa-times"></i> Passwords do not match';
    }
  }

  togglePasswordVisibility(input, toggleBtn) {
    const isVisible = input.type === 'text';
    input.type = isVisible ? 'password' : 'text';

    const icon = toggleBtn.querySelector('i');
    if (icon) {
      icon.className = isVisible ? 'fas fa-eye' : 'fas fa-eye-slash';
    }

    toggleBtn.setAttribute('aria-label', isVisible ? 'Hide password' : 'Show password');
  }

  setupRealTimeValidation() {
    const inputs = document.querySelectorAll('input[required], textarea[required]');
    inputs.forEach(input => {
      input.addEventListener('blur', () => {
        this.validateField(input);
      });

      input.addEventListener('input', () => {
        if (input.classList.contains('error')) {
          this.validateField(input);
        }
      });
    });
  }

  validateField(field) {
    const value = field.value.trim();
    let isValid = true;
    let errorMessage = '';

    // Required validation
    if (field.hasAttribute('required') && !value) {
      isValid = false;
      errorMessage = 'This field is required';
    }

    // Email validation
    if (field.type === 'email' && value) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(value)) {
        isValid = false;
        errorMessage = 'Please enter a valid email address';
      }
    }

    // Phone validation
    if (field.type === 'tel' && value) {
      const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
      if (!phoneRegex.test(value.replace(/[\s\-\(\)]/g, ''))) {
        isValid = false;
        errorMessage = 'Please enter a valid phone number';
      }
    }

    // Username validation
    if (field.name === 'username' && value) {
      if (value.length < 3) {
        isValid = false;
        errorMessage = 'Username must be at least 3 characters long';
      } else if (!/^[a-zA-Z0-9_]+$/.test(value)) {
        isValid = false;
        errorMessage = 'Username can only contain letters, numbers, and underscores';
      }
    }

    if (isValid) {
      this.clearFieldError(field);
    } else {
      this.showFieldError(field, errorMessage);
    }

    return isValid;
  }

  setupFormValidation() {
    const form = document.getElementById('createAccountForm') || document.getElementById('registerForm');
    if (!form) return;

    form.addEventListener('submit', (e) => {
      e.preventDefault();

      if (this.validateEntireForm(form)) {
        this.handleRegistration(e);
      }
    });
  }

  validateEntireForm(form) {
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    let isValid = true;

    inputs.forEach(input => {
      if (!this.validateField(input)) {
        isValid = false;
      }
    });

    // Password strength validation
    if (this.passwordStrength.score < 3) {
      this.showFieldError(document.getElementById('password'), 'Password is too weak. Please choose a stronger password.');
      isValid = false;
    }

    // Password match validation
    const password = document.getElementById('password')?.value || '';
    const confirmPassword = document.getElementById('confirmPassword')?.value || '';
    if (password !== confirmPassword) {
      this.showFieldError(document.getElementById('confirmPassword'), 'Passwords do not match');
      isValid = false;
    }

    // Terms acceptance validation
    const termsCheckbox = document.getElementById('acceptTerms');
    if (termsCheckbox && !termsCheckbox.checked) {
      this.showFieldError(termsCheckbox, 'You must accept the terms and conditions');
      isValid = false;
    }

    return isValid;
  }

  showFieldError(field, message) {
    this.clearFieldError(field);
    field.classList.add('error');

    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.textContent = message;
    errorDiv.style.cssText = `
      color: #ef4444;
      font-size: 0.875rem;
      margin-top: 0.25rem;
      animation: slideDownFade 0.2s ease-out;
    `;

    field.parentNode.appendChild(errorDiv);
  }

  clearFieldError(field) {
    field.classList.remove('error');
    const errorDiv = field.parentNode.querySelector('.field-error');
    if (errorDiv) {
      errorDiv.remove();
    }
  }

  toggleSubmitButton(accepted) {
    const submitBtn = document.querySelector('button[type="submit"]');
    if (submitBtn) {
      submitBtn.disabled = !accepted;
      submitBtn.style.opacity = accepted ? '1' : '0.5';
    }
  }

  handleNewsletterSignup(signedUp) {
    if (signedUp) {
      // Track newsletter signup
      if (window.gtag) {
        window.gtag('event', 'newsletter_signup', {
          event_category: 'engagement',
          event_label: 'registration_form'
        });
      }
    }
  }

  setupSocialRegistration() {
    const socialButtons = document.querySelectorAll('.social-register-btn');

    socialButtons.forEach(button => {
      button.addEventListener('click', (e) => {
        e.preventDefault();
        const provider = button.dataset.provider;

        if (provider) {
          this.handleSocialRegistration(provider);
        }
      });
    });
  }

  async handleSocialRegistration(provider) {
    try {
      // Show loading state
      const button = document.querySelector(`[data-provider="${provider}"]`);
      if (button) {
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Connecting...';
      }

      // Simulate OAuth flow (in real implementation, this would redirect to OAuth provider)
      const mockUserData = {
        provider: provider,
        provider_id: `${provider}_${Date.now()}`,
        email: `${provider}-user@example.com`,
        name: `${provider.charAt(0).toUpperCase() + provider.slice(1)} User`,
        avatar: `https://via.placeholder.com/100x100?text=${provider.charAt(0).toUpperCase()}`
      };

      // Submit to API
      const response = await fetch('api/auth.php?action=oauth', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(mockUserData),
        credentials: 'include'
      });

      const result = await response.json();

      if (result.success) {
        this.showSuccess('Account created successfully with ' + provider + '!');
        setTimeout(() => {
          window.location.href = 'index.php?page=home';
        }, 2000);
      } else {
        throw new Error(result.message || 'Social registration failed');
      }

    } catch (error) {
      console.error('Social registration error:', error);
      this.showError(error.message || 'Failed to register with ' + provider);
    } finally {
      // Reset button state
      const button = document.querySelector(`[data-provider="${provider}"]`);
      if (button) {
        button.disabled = false;
        button.innerHTML = `Continue with ${provider.charAt(0).toUpperCase() + provider.slice(1)}`;
      }
    }
  }

  async handleRegistration(e) {
    e.preventDefault();

    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');

    // Validate form
    if (!this.validateEntireForm(form)) {
      return;
    }

    // Show loading state
    this.setLoadingState(submitBtn, true);

    try {
      const formData = new FormData(form);

      // Add additional metadata
      formData.append('registration_date', new Date().toISOString());
      formData.append('user_agent', navigator.userAgent);
      formData.append('timezone', Intl.DateTimeFormat().resolvedOptions().timeZone);

      // Submit registration
      const response = await fetch('api/auth.php?action=signup', {
        method: 'POST',
        body: formData,
        credentials: 'include'
      });

      const result = await response.json();

      if (result.success) {
        this.showSuccess('Account created successfully! Welcome to Fitness Club!');
        this.trackRegistration(formData);

        // Redirect after success
        setTimeout(() => {
          window.location.href = 'index.php?page=home';
        }, 2000);

      } else {
        throw new Error(result.message || 'Registration failed');
      }

    } catch (error) {
      console.error('Registration error:', error);
      this.showError(error.message || 'Failed to create account. Please try again.');
    } finally {
      this.setLoadingState(submitBtn, false);
    }
  }

  setLoadingState(button, isLoading) {
    if (isLoading) {
      button.disabled = true;
      button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Account...';
    } else {
      button.disabled = false;
      button.innerHTML = 'Create Account';
    }
  }

  showSuccess(message) {
    if (window.FitnessAPI && window.FitnessAPI.notifications) {
      window.FitnessAPI.notifications.success(message);
    } else {
      this.showToast(message, 'success');
    }
  }

  showError(message) {
    if (window.FitnessAPI && window.FitnessAPI.notifications) {
      window.FitnessAPI.notifications.error(message);
    } else {
      this.showToast(message, 'error');
    }
  }

  showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
      <div class="toast-content">
        <span class="toast-message">${message}</span>
        <button class="toast-close">&times;</button>
      </div>
    `;

    toast.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      padding: 1rem;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
      z-index: 10000;
      max-width: 400px;
      animation: slideInRight 0.3s ease-out;
    `;

    if (type === 'success') {
      toast.style.borderColor = 'rgba(34, 197, 94, 0.2)';
    } else if (type === 'error') {
      toast.style.borderColor = 'rgba(239, 68, 68, 0.2)';
    }

    document.body.appendChild(toast);

    // Close button
    const closeBtn = toast.querySelector('.toast-close');
    closeBtn.addEventListener('click', () => toast.remove());

    // Auto remove
    setTimeout(() => {
      if (toast.parentNode) {
        toast.parentNode.removeChild(toast);
      }
    }, 5000);
  }

  trackRegistration(formData) {
    // Track registration completion
    if (window.gtag) {
      window.gtag('event', 'registration_complete', {
        event_category: 'engagement',
        event_label: 'account_creation',
        value: 1
      });
    }

    // Store registration data for analytics
    const registrationData = {
      timestamp: new Date().toISOString(),
      source: 'web_form',
      user_agent: navigator.userAgent,
      newsletter_signup: formData.get('newsletter') === 'on'
    };

    localStorage.setItem('registration_data', JSON.stringify(registrationData));
  }

  loadExistingData() {
    // Load any existing form data from localStorage (for form recovery)
    const savedData = localStorage.getItem('registration_form_data');
    if (savedData) {
      try {
        const data = JSON.parse(savedData);
        Object.entries(data).forEach(([field, value]) => {
          const input = document.getElementById(field) || document.querySelector(`[name="${field}"]`);
          if (input && !input.value) {
            input.value = value;
          }
        });
      } catch (error) {
        console.warn('Failed to load saved form data:', error);
      }
    }

    // Auto-save form data
    this.setupFormAutoSave();
  }

  setupFormAutoSave() {
    const form = document.getElementById('createAccountForm') || document.getElementById('registerForm');
    if (!form) return;

    const inputs = form.querySelectorAll('input, textarea, select');
    let saveTimeout;

    inputs.forEach(input => {
      input.addEventListener('input', () => {
        clearTimeout(saveTimeout);
        saveTimeout = setTimeout(() => {
          this.saveFormData(form);
        }, 1000);
      });
    });
  }

  saveFormData(form) {
    const formData = new FormData(form);
    const data = {};

    for (let [key, value] of formData.entries()) {
      if (key !== 'password' && key !== 'confirmPassword') { // Don't save passwords
        data[key] = value;
      }
    }

    localStorage.setItem('registration_form_data', JSON.stringify(data));
  }
}

// Initialize account creation manager when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  // Initialize for account creation page
  if (document.querySelector('.create-account-form') ||
      document.getElementById('createAccountForm') ||
      document.getElementById('registerForm')) {
    window.accountCreationManager = new AccountCreationManager();
  }
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
  module.exports = AccountCreationManager;
}