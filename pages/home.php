<?php
// HOME PAGE
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? 'Guest';
?>
<section id="home" class="section hero active" aria-label="Home Dashboard" tabindex="0">
  <!-- Modern Hero Section -->
  <div class="hero-modern glass-card heroSlideIn" style="background: linear-gradient(180deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05)); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.2); border-radius: 24px; padding: 3rem; margin-bottom: 3rem; position: relative; overflow: hidden;">
    <!-- Animated Background Elements -->
    <div class="hero-bg-element" style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: radial-gradient(circle, rgba(0,194,255,0.1) 0%, transparent 70%); border-radius: 50%; animation: float 6s ease-in-out infinite;"></div>
    <div class="hero-bg-element" style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: radial-gradient(circle, rgba(34,197,94,0.1) 0%, transparent 70%); border-radius: 50%; animation: float 8s ease-in-out infinite reverse;"></div>

    <div class="hero-content-modern" style="display: grid; grid-template-columns: 1fr auto; gap: 3rem; align-items: center; position: relative; z-index: 2;">
      <!-- Main Content -->
      <div class="hero-text">
        <div class="hero-greeting" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
          <div class="hero-emoji-large" id="heroEmoji" aria-hidden="true" style="font-size: 4rem; animation: bounce 2s ease-in-out infinite;">💪</div>
          <div>
            <h1 class="hero-title-modern" id="greetingTitle" style="font-size: 3.5rem; font-weight: 800; margin: 0; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1.1;">
              <?php echo $isLoggedIn ? "Welcome Back, $userName!" : "Welcome to Fitness Club!"; ?>
            </h1>
            <p class="hero-subtitle" id="greetingSub" style="color: var(--fluent-text-secondary); font-size: 1.2rem; margin: 0.5rem 0 0; font-weight: 500;">
              <?php echo $isLoggedIn ? "Ready to crush your fitness goals today?" : "Join our premium gym and transform your lifestyle."; ?>
            </p>
          </div>
        </div>

        <?php if ($isLoggedIn): ?>
        <!-- Quick Stats Row -->
        <div class="hero-stats" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
          <div class="stat-card glass-card cardBounce" style="background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.04)); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); border-radius: 16px; padding: 1.5rem; text-align: center;">
            <div class="stat-number" style="font-size: 2rem; font-weight: 700; color: var(--fluent-accent-primary); margin-bottom: 0.5rem;">4</div>
            <div class="stat-label" style="color: var(--fluent-text-secondary); font-size: 0.9rem; font-weight: 600;">Workouts This Week</div>
          </div>
          <div class="stat-card glass-card" style="background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.04)); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); border-radius: 16px; padding: 1.5rem; text-align: center;">
            <div class="stat-number" style="font-size: 2rem; font-weight: 700; color: var(--fluent-accent-primary); margin-bottom: 0.5rem;">2,340</div>
            <div class="stat-label" style="color: var(--fluent-text-secondary); font-size: 0.9rem; font-weight: 600;">Calories Burned</div>
          </div>
          <div class="stat-card glass-card" style="background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.04)); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); border-radius: 16px; padding: 1.5rem; text-align: center;">
            <div class="stat-number" style="font-size: 2rem; font-weight: 700; color: var(--fluent-accent-primary); margin-bottom: 0.5rem;">12</div>
            <div class="stat-label" style="color: var(--fluent-text-secondary); font-size: 0.9rem; font-weight: 600;">Days Streak</div>
          </div>
        </div>
        <?php endif; ?>

        <!-- Quick Actions -->
        <div class="hero-actions" style="display: flex; gap: 1rem; flex-wrap: wrap;">
          <?php if ($isLoggedIn): ?>
            <a href="?page=booking" class="primary large buttonGlow" style="display: flex; align-items: center; gap: 0.5rem;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px;">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
              Book a Session
            </a>
            <a href="?page=shop" class="secondary large" style="display: flex; align-items: center; gap: 0.5rem;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px;">
                <circle cx="9" cy="21" r="1"/>
                <circle cx="20" cy="21" r="1"/>
                <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
              </svg>
              Shop Gear
            </a>
            <a href="?page=feedback" class="outline large" style="display: flex; align-items: center; gap: 0.5rem;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px;">
                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
              </svg>
              Send Feedback
            </a>
          <?php else: ?>
            <a href="?page=create_account" class="primary large buttonGlow" style="display: flex; align-items: center; gap: 0.5rem;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px;">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
              Join Now
            </a>
            <a href="?page=login" class="secondary large" style="display: flex; align-items: center; gap: 0.5rem;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px;">
                <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/>
                <polyline points="10,17 15,12 10,7"/>
                <line x1="15" y1="12" x2="3" y2="12"/>
              </svg>
              Sign In
            </a>
            <a href="?page=membership" class="outline large" style="display: flex; align-items: center; gap: 0.5rem;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px;">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                <polyline points="14,2 14,8 20,8"/>
              </svg>
              View Plans
            </a>
          <?php endif; ?>
        </div>
      </div>

      <!-- Hero Visual -->
      <div class="hero-visual" style="position: relative;">
        <div class="hero-visual-card glass-card widgetMorph" style="width: 300px; height: 400px; background: linear-gradient(180deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05)); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.2); border-radius: 20px; padding: 2rem; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
          <div class="hero-visual-icon" style="font-size: 6rem; margin-bottom: 1rem; animation: pulse 3s ease-in-out infinite;">🏋️‍♀️</div>
          <h3 style="margin: 0 0 1rem; font-size: 1.5rem; font-weight: 700;">PowerZone Pro</h3>
          <p style="margin: 0; color: var(--fluent-text-secondary); font-size: 1rem;">Advanced training programs with AI-powered workout recommendations.</p>
          <div class="hero-visual-features" style="margin-top: 1.5rem; display: flex; flex-direction: column; gap: 0.5rem; width: 100%;">
            <div class="feature-item" style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px; color: var(--fluent-accent-primary);">
                <polyline points="20,6 9,17 4,12"/>
              </svg>
              <span>Personalized Workouts</span>
            </div>
            <div class="feature-item" style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px; color: var(--fluent-accent-primary);">
                <polyline points="20,6 9,17 4,12"/>
              </svg>
              <span>Progress Tracking</span>
            </div>
            <div class="feature-item" style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px; color: var(--fluent-accent-primary);">
                <polyline points="20,6 9,17 4,12"/>
              </svg>
              <span>Nutrition Guidance</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php if ($isLoggedIn): ?>
  <!-- Recent Activity -->
  <div class="recent-activity glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem;">
    <h2 style="margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 24px; height: 24px;">
        <circle cx="12" cy="12" r="10"/>
        <polyline points="12,6 12,12 16,14"/>
      </svg>
      Recent Activity
    </h2>
    <div class="activity-list" style="display: flex; flex-direction: column; gap: 1rem;">
      <div class="activity-item" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 12px;">
        <div class="activity-icon" style="width: 40px; height: 40px; background: var(--fluent-accent-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
          <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" style="width: 20px; height: 20px;">
            <path d="M20 7l-8-4-8 4v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
          </svg>
        </div>
        <div class="activity-content" style="flex: 1;">
          <div class="activity-title" style="font-weight: 600;">Completed Upper Body Workout</div>
          <div class="activity-meta" style="color: var(--fluent-text-secondary); font-size: 0.9rem;">2 hours ago • 45 minutes • 320 calories</div>
        </div>
        <div class="activity-status" style="color: var(--fluent-accent-primary); font-weight: 600;">✓</div>
      </div>

      <div class="activity-item" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 12px;">
        <div class="activity-icon" style="width: 40px; height: 40px; background: var(--fluent-accent-secondary); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
          <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" style="width: 20px; height: 20px;">
            <circle cx="9" cy="21" r="1"/>
            <circle cx="20" cy="21" r="1"/>
            <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
          </svg>
        </div>
        <div class="activity-content" style="flex: 1;">
          <div class="activity-title" style="font-weight: 600;">Purchased Protein Shaker</div>
          <div class="activity-meta" style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Yesterday • Order #12345</div>
        </div>
        <div class="activity-status" style="color: var(--fluent-accent-secondary); font-weight: 600;">✓</div>
      </div>

      <div class="activity-item" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 12px;">
        <div class="activity-icon" style="width: 40px; height: 40px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
          <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" style="width: 20px; height: 20px;">
            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
          </svg>
        </div>
        <div class="activity-content" style="flex: 1;">
          <div class="activity-title" style="font-weight: 600;">Left Feedback</div>
          <div class="activity-meta" style="color: var(--fluent-text-secondary); font-size: 0.9rem;">3 days ago • Rating: 5/5</div>
        </div>
        <div class="activity-status" style="color: #10b981; font-weight: 600;">✓</div>
      </div>
    </div>
  </div>
  <?php endif; ?>
</section>