<?php
// BOOKING PAGE
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? 'Guest';

if (!$isLoggedIn) {
    header('Location: ?page=login');
    exit;
}
?>
<section id="booking" class="section booking active" aria-label="Book a Session" tabindex="0">
  <!-- Page Header -->
  <div class="page-header glass-card" style="padding: 2rem; margin-bottom: 2rem; text-align: center;">
    <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
      Book Your Session
    </h1>
    <p style="color: var(--fluent-text-secondary); font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
      Schedule your personal training session or group class. Choose from our expert trainers and available time slots.
    </p>
  </div>

  <!-- Booking Form -->
  <div class="booking-container" style="display: grid; grid-template-columns: 1fr 400px; gap: 2rem;">
    <!-- Main Booking Form -->
    <div class="booking-form glass-card widgetMorph" style="padding: 2rem;">
      <h2 style="margin-bottom: 2rem; display: flex; align-items: center; gap: 0.5rem;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 24px; height: 24px;">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
          <line x1="16" y1="2" x2="16" y2="6"/>
          <line x1="8" y1="2" x2="8" y2="6"/>
          <line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
        Session Details
      </h2>

      <form id="bookingForm" style="display: flex; flex-direction: column; gap: 1.5rem;">
        <!-- Session Type -->
        <div class="form-group">
          <label for="sessionType" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Session Type</label>
          <select id="sessionType" name="sessionType" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
            <option value="">Select a session type</option>
            <option value="personal">Personal Training (1-on-1)</option>
            <option value="group">Group Class</option>
            <option value="consultation">Nutrition Consultation</option>
            <option value="assessment">Fitness Assessment</option>
          </select>
        </div>

        <!-- Trainer Selection -->
        <div class="form-group">
          <label for="trainer" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Trainer</label>
          <select id="trainer" name="trainer" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
            <option value="">Select a trainer</option>
            <option value="sarah">Sarah Johnson - Strength & Conditioning</option>
            <option value="mike">Mike Chen - HIIT Specialist</option>
            <option value="emma">Emma Davis - Yoga & Flexibility</option>
            <option value="alex">Alex Rodriguez - Weight Training</option>
            <option value="lisa">Lisa Park - Nutrition Expert</option>
          </select>
        </div>

        <!-- Date Selection -->
        <div class="form-group">
          <label for="sessionDate" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Preferred Date</label>
          <input type="date" id="sessionDate" name="sessionDate" required min="<?php echo date('Y-m-d'); ?>" style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
        </div>

        <!-- Time Selection -->
        <div class="form-group">
          <label for="sessionTime" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Preferred Time</label>
          <select id="sessionTime" name="sessionTime" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
            <option value="">Select a time</option>
            <option value="06:00">6:00 AM</option>
            <option value="07:00">7:00 AM</option>
            <option value="08:00">8:00 AM</option>
            <option value="09:00">9:00 AM</option>
            <option value="10:00">10:00 AM</option>
            <option value="11:00">11:00 AM</option>
            <option value="12:00">12:00 PM</option>
            <option value="13:00">1:00 PM</option>
            <option value="14:00">2:00 PM</option>
            <option value="15:00">3:00 PM</option>
            <option value="16:00">4:00 PM</option>
            <option value="17:00">5:00 PM</option>
            <option value="18:00">6:00 PM</option>
            <option value="19:00">7:00 PM</option>
            <option value="20:00">8:00 PM</option>
          </select>
        </div>

        <!-- Duration -->
        <div class="form-group">
          <label for="duration" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Duration</label>
          <select id="duration" name="duration" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
            <option value="30">30 minutes</option>
            <option value="45">45 minutes</option>
            <option value="60" selected>60 minutes</option>
            <option value="90">90 minutes</option>
          </select>
        </div>

        <!-- Special Requests -->
        <div class="form-group">
          <label for="specialRequests" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Special Requests or Notes</label>
          <textarea id="specialRequests" name="specialRequests" rows="4" placeholder="Any specific goals, injuries, or preferences..." style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem; resize: vertical;"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="form-actions" style="display: flex; gap: 1rem; margin-top: 1rem;">
          <button type="submit" class="primary large buttonGlow" style="flex: 1;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; margin-right: 0.5rem;">
              <polyline points="20,6 9,17 4,12"/>
            </svg>
            Book Session
          </button>
          <button type="button" class="secondary large" onclick="clearBookingForm()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; margin-right: 0.5rem;">
              <line x1="18" y1="6" x2="6" y2="18"/>
              <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
            Clear Form
          </button>
        </div>
      </form>
    </div>

    <!-- Booking Summary & Calendar -->
    <div class="booking-sidebar">
      <!-- Quick Stats -->
      <div class="booking-stats glass-card widgetMorph" style="padding: 1.5rem; margin-bottom: 2rem;">
        <h3 style="margin-bottom: 1rem; font-size: 1.2rem; font-weight: 600;">Your Membership</h3>
        <div class="stats-grid" style="display: flex; flex-direction: column; gap: 1rem;">
          <div class="stat-item" style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: var(--fluent-text-secondary);">Plan:</span>
            <span style="font-weight: 600;">Premium</span>
          </div>
          <div class="stat-item" style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: var(--fluent-text-secondary);">Sessions Left:</span>
            <span style="font-weight: 600; color: var(--fluent-accent-primary);">3/4</span>
          </div>
          <div class="stat-item" style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: var(--fluent-text-secondary);">Next Session:</span>
            <span style="font-weight: 600;">Tomorrow 2:00 PM</span>
          </div>
        </div>
      </div>

      <!-- Upcoming Sessions -->
      <div class="upcoming-sessions glass-card widgetMorph" style="padding: 1.5rem;">
        <h3 style="margin-bottom: 1rem; font-size: 1.2rem; font-weight: 600;">Upcoming Sessions</h3>
        <div class="sessions-list" style="display: flex; flex-direction: column; gap: 1rem;">
          <div class="session-item" style="padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 12px;">
            <div class="session-title" style="font-weight: 600; margin-bottom: 0.5rem;">HIIT Training with Mike</div>
            <div class="session-meta" style="color: var(--fluent-text-secondary); font-size: 0.9rem;">
              <div>Tomorrow, 2:00 PM - 3:00 PM</div>
              <div>Main Studio</div>
            </div>
            <div class="session-actions" style="margin-top: 1rem; display: flex; gap: 0.5rem;">
              <button class="outline small" style="flex: 1;">Reschedule</button>
              <button class="secondary small" style="flex: 1;">Cancel</button>
            </div>
          </div>

          <div class="session-item" style="padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 12px;">
            <div class="session-title" style="font-weight: 600; margin-bottom: 0.5rem;">Personal Training with Sarah</div>
            <div class="session-meta" style="color: var(--fluent-text-secondary); font-size: 0.9rem;">
              <div>Friday, 10:00 AM - 11:00 AM</div>
              <div>Training Room 2</div>
            </div>
            <div class="session-actions" style="margin-top: 1rem; display: flex; gap: 0.5rem;">
              <button class="outline small" style="flex: 1;">Reschedule</button>
              <button class="secondary small" style="flex: 1;">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Available Classes Schedule -->
  <div class="classes-schedule glass-card widgetMorph" style="padding: 2rem; margin-top: 2rem;">
    <h2 style="margin-bottom: 2rem; display: flex; align-items: center; gap: 0.5rem;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 24px; height: 24px;">
        <circle cx="12" cy="12" r="10"/>
        <polyline points="12,6 12,12 16,14"/>
      </svg>
      Today's Group Classes
    </h2>

    <div class="schedule-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
      <div class="class-card" style="padding: 1.5rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1);">
        <div class="class-header" style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
          <div>
            <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">Morning Yoga Flow</h3>
            <div class="class-instructor" style="color: var(--fluent-text-secondary); font-size: 0.9rem;">with Emma Davis</div>
          </div>
          <div class="class-time" style="background: var(--fluent-accent-primary); color: white; padding: 0.5rem; border-radius: 8px; font-size: 0.9rem; font-weight: 600;">8:00 AM</div>
        </div>
        <div class="class-details" style="margin-bottom: 1rem;">
          <div class="class-duration" style="color: var(--fluent-text-secondary); font-size: 0.9rem; margin-bottom: 0.5rem;">60 minutes • All Levels</div>
          <div class="class-spots" style="color: var(--fluent-accent-primary); font-size: 0.9rem; font-weight: 600;">12 spots left</div>
        </div>
        <button class="primary small buttonGlow" style="width: 100%;">Join Class</button>
      </div>

      <div class="class-card" style="padding: 1.5rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1);">
        <div class="class-header" style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
          <div>
            <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">HIIT Blast</h3>
            <div class="class-instructor" style="color: var(--fluent-text-secondary); font-size: 0.9rem;">with Mike Chen</div>
          </div>
          <div class="class-time" style="background: var(--fluent-accent-primary); color: white; padding: 0.5rem; border-radius: 8px; font-size: 0.9rem; font-weight: 600;">6:00 PM</div>
        </div>
        <div class="class-details" style="margin-bottom: 1rem;">
          <div class="class-duration" style="color: var(--fluent-text-secondary); font-size: 0.9rem; margin-bottom: 0.5rem;">45 minutes • Intermediate</div>
          <div class="class-spots" style="color: var(--fluent-accent-primary); font-size: 0.9rem; font-weight: 600;">8 spots left</div>
        </div>
        <button class="primary small buttonGlow" style="width: 100%;">Join Class</button>
      </div>

      <div class="class-card" style="padding: 1.5rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1);">
        <div class="class-header" style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
          <div>
            <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">Strength Training</h3>
            <div class="class-instructor" style="color: var(--fluent-text-secondary); font-size: 0.9rem;">with Alex Rodriguez</div>
          </div>
          <div class="class-time" style="background: var(--fluent-accent-primary); color: white; padding: 0.5rem; border-radius: 8px; font-size: 0.9rem; font-weight: 600;">7:30 PM</div>
        </div>
        <div class="class-details" style="margin-bottom: 1rem;">
          <div class="class-duration" style="color: var(--fluent-text-secondary); font-size: 0.9rem; margin-bottom: 0.5rem;">75 minutes • All Levels</div>
          <div class="class-spots" style="color: #10b981; font-size: 0.9rem; font-weight: 600;">Waitlist Available</div>
        </div>
        <button class="outline small" style="width: 100%;">Join Waitlist</button>
      </div>
    </div>
  </div>
</section>

<script>
// Booking form handling
document.getElementById('bookingForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  const bookingData = Object.fromEntries(formData);
  try {
    const res = await fetch('api/booking.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(bookingData),
      credentials: 'include'
    });
    const out = await res.json();
    if (out.success) {
      showNotification('Session booked successfully! Reference #' + (out.data?.id || ''), 'success');
      this.reset();
    } else {
      showNotification(out.message || 'Failed to book session', 'error');
    }
  } catch (err) {
    showNotification('Network error while booking', 'error');
  }
});

function clearBookingForm() {
    document.getElementById('bookingForm').reset();
}

function showNotification(message, type = 'info') {
  // Create notification element positioned below the fixed navbar
  const notification = document.createElement('div');
  notification.className = `notification ${type}`;
  notification.setAttribute('role', 'alert');
  notification.setAttribute('aria-live', 'polite');
  notification.style.cssText = `
    position: fixed;
    top: calc(var(--navbar-height, 56px) + 16px);
    right: 20px;
    background: ${type === 'success' ? 'var(--fluent-accent-primary)' : 'var(--fluent-accent-secondary)'};
    color: white;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    z-index: 1600;
    animation: slideInRight 0.3s ease-out;
    max-width: 400px;
  `;
  notification.textContent = message;

  document.body.appendChild(notification);

  // Remove after 5 seconds
  setTimeout(() => {
    notification.style.animation = 'slideOutRight 0.3s ease-in';
    setTimeout(() => notification.remove(), 300);
  }, 5000);
}
</script>