<?php
// ACCOUNT PAGE
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? 'Guest';
$userEmail = $_SESSION['user_email'] ?? '';
$userAvatar = $_SESSION['user_avatar'] ?? '';
?>
<section id="account" class="section account active" aria-label="Account Management" tabindex="0">
  <!-- Page Header -->
  <div class="page-header glass-card" style="padding: 2rem; margin-bottom: 2rem; text-align: center;">
    <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
      Account Management
    </h1>
    <p style="color: var(--fluent-text-secondary); font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
      Manage your profile, preferences, and account settings all in one place.
    </p>
  </div>

  <!-- Account Overview -->
  <div class="account-overview glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem;">
    <div class="overview-header" style="display: flex; align-items: center; gap: 2rem; margin-bottom: 2rem;">
      <div class="avatar-section">
        <div class="avatar-container" style="position: relative; display: inline-block;">
          <div class="avatar" id="profileAvatar" style="width: 120px; height: 120px; border-radius: 50%; background: var(--fluent-accent-primary); display: flex; align-items: center; justify-content: center; font-size: 3rem; font-weight: 600; color: white; cursor: pointer; transition: all 0.3s ease;">
            <?php echo htmlspecialchars(substr($userName, 0, 1)); ?>
          </div>
          <div class="avatar-overlay" style="position: absolute; top: 0; left: 0; width: 120px; height: 120px; border-radius: 50%; background: rgba(0,0,0,0.7); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease; cursor: pointer;">
            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" style="width: 24px; height: 24px;">
              <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
            </svg>
          </div>
        </div>
        <input type="file" id="avatarInput" accept="image/*" style="display: none;">
      </div>

      <div class="user-info" style="flex: 1;">
        <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem;"><?php echo htmlspecialchars($userName); ?></h2>
        <p style="color: var(--fluent-text-secondary); font-size: 1.1rem; margin-bottom: 1rem;"><?php echo htmlspecialchars($userEmail); ?></p>

        <div class="account-stats" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
          <div class="stat">
            <div style="font-size: 1.5rem; font-weight: 800; color: var(--fluent-accent-primary);">47</div>
            <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Workouts</div>
          </div>
          <div class="stat">
            <div style="font-size: 1.5rem; font-weight: 800; color: var(--fluent-accent-primary);">12</div>
            <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Achievements</div>
          </div>
          <div class="stat">
            <div style="font-size: 1.5rem; font-weight: 800; color: var(--fluent-accent-primary);">Premium</div>
            <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Membership</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
      <button class="action-button primary buttonGlow" onclick="showSection('profile')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; margin-right: 0.5rem;">
          <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
          <circle cx="12" cy="7" r="4"/>
        </svg>
        Edit Profile
      </button>
      <button class="action-button secondary" onclick="showSection('security')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; margin-right: 0.5rem;">
          <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
          <circle cx="12" cy="16" r="1"/>
          <path d="M7 11V7a5 5 0 0110 0v4"/>
        </svg>
        Security Settings
      </button>
      <button class="action-button secondary" onclick="showSection('notifications')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; margin-right: 0.5rem;">
          <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
          <path d="M13.73 21a2 2 0 01-3.46 0"/>
        </svg>
        Notifications
      </button>
      <button class="action-button secondary" onclick="showSection('billing')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; margin-right: 0.5rem;">
          <rect x="2" y="5" width="20" height="14" rx="2"/>
          <line x1="2" y1="10" x2="22" y2="10"/>
        </svg>
        Billing & Payments
      </button>
    </div>
  </div>

  <!-- Account Sections -->
  <div class="account-sections">
    <!-- Profile Section -->
    <div id="profile-section" class="account-section glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem;">
      <h3 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 2rem;">Profile Information</h3>

      <form id="profileForm" style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          <div class="form-group">
            <label for="firstName" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">First Name *</label>
            <input type="text" id="firstName" name="firstName" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
          </div>
          <div class="form-group">
            <label for="lastName" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Last Name *</label>
            <input type="text" id="lastName" name="lastName" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
          </div>
        </div>

        <div class="form-group">
          <label for="email" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Email Address *</label>
          <input type="email" id="email" name="email" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;" value="<?php echo htmlspecialchars($userEmail); ?>">
        </div>

        <div class="form-group">
          <label for="phone" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Phone Number</label>
          <input type="tel" id="phone" name="phone" style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
        </div>

        <div class="form-group">
          <label for="bio" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Bio</label>
          <textarea id="bio" name="bio" rows="4" placeholder="Tell us about yourself..." style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem; resize: vertical;"></textarea>
        </div>

        <div class="form-actions" style="text-align: center; margin-top: 1rem;">
          <button type="submit" class="primary large buttonGlow">Save Changes</button>
        </div>
      </form>
    </div>

    <!-- Security Section -->
    <div id="security-section" class="account-section glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem; display: none;">
      <h3 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 2rem;">Security Settings</h3>

      <!-- Change Password -->
      <div class="security-item" style="margin-bottom: 2rem;">
        <h4 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem;">Change Password</h4>
        <form id="passwordForm" style="display: flex; flex-direction: column; gap: 1rem;">
          <div class="form-group">
            <label for="currentPassword" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Current Password *</label>
            <input type="password" id="currentPassword" name="currentPassword" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
          </div>
          <div class="form-group">
            <label for="newPassword" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">New Password *</label>
            <input type="password" id="newPassword" name="newPassword" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
          </div>
          <div class="form-group">
            <label for="confirmPassword" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Confirm New Password *</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
          </div>
          <button type="submit" class="primary buttonGlow">Update Password</button>
        </form>
      </div>

      <!-- Two-Factor Authentication -->
      <div class="security-item" style="margin-bottom: 2rem;">
        <h4 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem;">Two-Factor Authentication</h4>
        <div class="tfa-status" style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 12px; margin-bottom: 1rem;">
          <div>
            <div style="font-weight: 600; margin-bottom: 0.25rem;">Status: Disabled</div>
            <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Add an extra layer of security to your account</div>
          </div>
          <button class="secondary buttonGlow" onclick="enableTFA()">Enable 2FA</button>
        </div>
      </div>

      <!-- Login Sessions -->
      <div class="security-item">
        <h4 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem;">Active Sessions</h4>
        <div class="sessions-list" style="display: flex; flex-direction: column; gap: 1rem;">
          <div class="session-item" style="padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
              <div>
                <div style="font-weight: 600; margin-bottom: 0.25rem;">Current Session</div>
                <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Chrome on Windows • Last active: Now</div>
              </div>
              <span style="background: #10b981; color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">Current</span>
            </div>
          </div>
          <div class="session-item" style="padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
              <div>
                <div style="font-weight: 600; margin-bottom: 0.25rem;">Mobile App</div>
                <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">iOS App • Last active: 2 hours ago</div>
              </div>
              <button class="danger small" onclick="revokeSession(this)">Revoke</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Notifications Section -->
    <div id="notifications-section" class="account-section glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem; display: none;">
      <h3 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 2rem;">Notification Preferences</h3>

      <div class="notification-settings" style="display: flex; flex-direction: column; gap: 1.5rem;">
        <!-- Email Notifications -->
        <div class="notification-group">
          <h4 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 1rem;">Email Notifications</h4>

          <div class="notification-item" style="display: flex; align-items: center; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div>
              <div style="font-weight: 600; margin-bottom: 0.25rem;">Workout Reminders</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Get reminded about your scheduled workouts</div>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="notification-item" style="display: flex; align-items: center; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div>
              <div style="font-weight: 600; margin-bottom: 0.25rem;">Progress Updates</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Weekly summary of your fitness progress</div>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="notification-item" style="display: flex; align-items: center; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div>
              <div style="font-weight: 600; margin-bottom: 0.25rem;">New Features</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Updates about new app features and improvements</div>
            </div>
            <label class="toggle">
              <input type="checkbox">
              <span class="toggle-slider"></span>
            </label>
          </div>
        </div>

        <!-- Push Notifications -->
        <div class="notification-group">
          <h4 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 1rem;">Push Notifications</h4>

          <div class="notification-item" style="display: flex; align-items: center; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div>
              <div style="font-weight: 600; margin-bottom: 0.25rem;">Achievement Unlocks</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Celebrate when you unlock new achievements</div>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="notification-item" style="display: flex; align-items: center; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div>
              <div style="font-weight: 600; margin-bottom: 0.25rem;">Social Interactions</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Comments, likes, and friend requests</div>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>
        </div>

        <div class="form-actions" style="text-align: center; margin-top: 1rem;">
          <button class="primary large buttonGlow" onclick="saveNotificationSettings()">Save Preferences</button>
        </div>
      </div>
    </div>

    <!-- Billing Section -->
    <div id="billing-section" class="account-section glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem; display: none;">
      <h3 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 2rem;">Billing & Payments</h3>

      <!-- Current Plan -->
      <div class="current-plan" style="padding: 2rem; background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05)); border-radius: 16px; border: 1px solid rgba(255,255,255,0.15); margin-bottom: 2rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
          <h4 style="font-size: 1.3rem; font-weight: 600;">Current Plan: Premium</h4>
          <span style="background: var(--fluent-accent-primary); color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">Active</span>
        </div>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1rem;">
          <div>
            <div style="font-weight: 600; color: var(--fluent-accent-primary); font-size: 1.2rem;">$29.99</div>
            <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Monthly</div>
          </div>
          <div>
            <div style="font-weight: 600; color: var(--fluent-accent-primary); font-size: 1.2rem;">Next billing</div>
            <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Dec 15, 2024</div>
          </div>
          <div>
            <div style="font-weight: 600; color: var(--fluent-accent-primary); font-size: 1.2rem;">Payment method</div>
            <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">•••• •••• •••• 4242</div>
          </div>
        </div>
        <div style="display: flex; gap: 1rem;">
          <button class="secondary buttonGlow">Change Plan</button>
          <button class="secondary buttonGlow">Update Payment Method</button>
        </div>
      </div>

      <!-- Billing History -->
      <div class="billing-history">
        <h4 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem;">Billing History</h4>

        <div class="billing-items" style="display: flex; flex-direction: column; gap: 1rem;">
          <div class="billing-item" style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);">
            <div>
              <div style="font-weight: 600; margin-bottom: 0.25rem;">Premium Plan - Monthly</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Nov 15, 2024 • Visa ending in 4242</div>
            </div>
            <div style="text-align: right;">
              <div style="font-weight: 600; color: var(--fluent-accent-primary);">$29.99</div>
              <button class="link-button" style="color: var(--fluent-accent-secondary); font-size: 0.9rem; text-decoration: none; background: none; border: none; cursor: pointer;">Download</button>
            </div>
          </div>

          <div class="billing-item" style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);">
            <div>
              <div style="font-weight: 600; margin-bottom: 0.25rem;">Premium Plan - Monthly</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Oct 15, 2024 • Visa ending in 4242</div>
            </div>
            <div style="text-align: right;">
              <div style="font-weight: 600; color: var(--fluent-accent-primary);">$29.99</div>
              <button class="link-button" style="color: var(--fluent-accent-secondary); font-size: 0.9rem; text-decoration: none; background: none; border: none; cursor: pointer;">Download</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
// Account management functionality
function showSection(sectionName) {
    // Hide all sections
    const sections = document.querySelectorAll('.account-section');
    sections.forEach(section => section.style.display = 'none');

    // Show selected section
    const targetSection = document.getElementById(sectionName + '-section');
    if (targetSection) {
        targetSection.style.display = 'block';
        targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

// Avatar upload functionality
document.getElementById('profileAvatar').addEventListener('click', function() {
    document.getElementById('avatarInput').click();
});

document.getElementById('avatarInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profileAvatar').style.backgroundImage = `url(${e.target.result})`;
            document.getElementById('profileAvatar').style.backgroundSize = 'cover';
            document.getElementById('profileAvatar').style.backgroundPosition = 'center';
            document.getElementById('profileAvatar').textContent = '';
        };
        reader.readAsDataURL(file);
    }
});

// Profile form handling
document.getElementById('profileForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const profileData = Object.fromEntries(formData);

    // Show success message
    showNotification('Profile updated successfully!', 'success');

    // Update displayed name
    const fullName = profileData.firstName + ' ' + profileData.lastName;
    document.querySelector('.user-info h2').textContent = fullName;
    document.getElementById('profileAvatar').textContent = profileData.firstName.charAt(0);
});

// Password form handling
document.getElementById('passwordForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (newPassword !== confirmPassword) {
        showNotification('Passwords do not match!', 'error');
        return;
    }

    if (newPassword.length < 8) {
        showNotification('Password must be at least 8 characters long!', 'error');
        return;
    }

    // Show success message
    showNotification('Password updated successfully!', 'success');
    this.reset();
});

// Two-factor authentication
function enableTFA() {
    showNotification('Two-factor authentication setup coming soon!', 'info');
}

// Session management
function revokeSession(button) {
    const sessionItem = button.closest('.session-item');
    sessionItem.style.animation = 'fadeOut 0.3s ease-out';
    setTimeout(() => {
        sessionItem.remove();
        showNotification('Session revoked successfully!', 'success');
    }, 300);
}

// Notification settings
function saveNotificationSettings() {
    showNotification('Notification preferences saved!', 'success');
}

// Toggle switches styling
document.querySelectorAll('.toggle input').forEach(toggle => {
    toggle.addEventListener('change', function() {
        // Handle toggle changes
        console.log('Toggle changed:', this.checked);
    });
});

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

// Initialize profile form with current data
document.addEventListener('DOMContentLoaded', function() {
    // Split name for form fields
    const nameParts = '<?php echo htmlspecialchars($userName); ?>'.split(' ');
    if (nameParts.length >= 2) {
        document.getElementById('firstName').value = nameParts[0];
        document.getElementById('lastName').value = nameParts.slice(1).join(' ');
    } else {
        document.getElementById('firstName').value = nameParts[0] || '';
        document.getElementById('lastName').value = '';
    }
});
</script>