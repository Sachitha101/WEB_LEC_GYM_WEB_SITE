<?php
// NEWS PAGE
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? 'Guest';
?>
<section id="news" class="section news active" aria-label="Fitness News & Updates" tabindex="0">
  <!-- Page Header -->
  <div class="page-header glass-card" style="padding: 2rem; margin-bottom: 2rem; text-align: center;">
    <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
      Fitness News & Updates
    </h1>
    <p style="color: var(--fluent-text-secondary); font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
      Stay informed with the latest fitness trends, health tips, and gym updates. Get expert advice and motivation for your fitness journey.
    </p>
  </div>

  <!-- Featured Article -->
  <div class="featured-article glass-card widgetMorph" style="padding: 0; margin-bottom: 2rem; overflow: hidden; border-radius: 20px;">
    <div class="article-image" style="height: 300px; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); display: flex; align-items: center; justify-content: center; position: relative;">
      <div style="font-size: 6rem;">🏃‍♀️</div>
      <div class="article-badge" style="position: absolute; top: 20px; left: 20px; background: white; color: var(--fluent-accent-primary); padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.9rem; font-weight: 600;">Featured</div>
    </div>
    <div class="article-content" style="padding: 2rem;">
      <div class="article-meta" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; color: var(--fluent-text-secondary); font-size: 0.9rem;">
        <span>By Sarah Johnson</span>
        <span>•</span>
        <span>2 hours ago</span>
        <span>•</span>
        <span>5 min read</span>
      </div>
      <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 1rem; line-height: 1.2;">The Science Behind HIIT: Why High-Intensity Workouts Work</h2>
      <p style="color: var(--fluent-text-secondary); font-size: 1.1rem; line-height: 1.6; margin-bottom: 1.5rem;">
        Discover the physiological mechanisms that make high-intensity interval training so effective for fat loss, cardiovascular health, and metabolic conditioning. Learn how to incorporate HIIT safely into your routine.
      </p>
      <div class="article-tags" style="display: flex; gap: 0.5rem; margin-bottom: 1.5rem;">
        <span class="tag" style="background: rgba(255,255,255,0.1); color: var(--fluent-text-primary); padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.8rem; font-weight: 500;">HIIT</span>
        <span class="tag" style="background: rgba(255,255,255,0.1); color: var(--fluent-text-primary); padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.8rem; font-weight: 500;">Science</span>
        <span class="tag" style="background: rgba(255,255,255,0.1); color: var(--fluent-text-primary); padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.8rem; font-weight: 500;">Fat Loss</span>
      </div>
      <a href="#" class="primary buttonGlow" style="display: inline-flex; align-items: center; gap: 0.5rem;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px;">
          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
          <circle cx="12" cy="12" r="3"/>
        </svg>
        Read Full Article
      </a>
    </div>
  </div>

  <!-- News Grid -->
  <div class="news-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
    <!-- Article 1 -->
    <div class="news-card glass-card widgetMorph" style="overflow: hidden; border-radius: 16px;">
      <div class="news-image" style="height: 200px; background: linear-gradient(135deg, #10b981, #06b6d4); display: flex; align-items: center; justify-content: center;">
        <div style="font-size: 4rem;">🥗</div>
      </div>
      <div class="news-content" style="padding: 1.5rem;">
        <div class="news-meta" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; color: var(--fluent-text-secondary); font-size: 0.8rem;">
          <span>Nutrition</span>
          <span>•</span>
          <span>1 day ago</span>
        </div>
        <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem; line-height: 1.3;">10 Superfoods for Post-Workout Recovery</h3>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; line-height: 1.5; margin-bottom: 1rem;">
          Fuel your body with these nutrient-dense foods that support muscle repair and replenish energy stores after intense training sessions.
        </p>
        <a href="#" class="read-more" style="color: var(--fluent-accent-primary); font-weight: 600; font-size: 0.9rem;">Read More →</a>
      </div>
    </div>

    <!-- Article 2 -->
    <div class="news-card glass-card widgetMorph" style="overflow: hidden; border-radius: 16px;">
      <div class="news-image" style="height: 200px; background: linear-gradient(135deg, #f59e0b, #ef4444); display: flex; align-items: center; justify-content: center;">
        <div style="font-size: 4rem;">🏋️‍♂️</div>
      </div>
      <div class="news-content" style="padding: 1.5rem;">
        <div class="news-meta" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; color: var(--fluent-text-secondary); font-size: 0.8rem;">
          <span>Training</span>
          <span>•</span>
          <span>2 days ago</span>
        </div>
        <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem; line-height: 1.3;">Progressive Overload: The Key to Continuous Gains</h3>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; line-height: 1.5; margin-bottom: 1rem;">
          Learn how to systematically increase training intensity to break through plateaus and achieve consistent progress in strength and muscle development.
        </p>
        <a href="#" class="read-more" style="color: var(--fluent-accent-primary); font-weight: 600; font-size: 0.9rem;">Read More →</a>
      </div>
    </div>

    <!-- Article 3 -->
    <div class="news-card glass-card widgetMorph" style="overflow: hidden; border-radius: 16px;">
      <div class="news-image" style="height: 200px; background: linear-gradient(135deg, #8b5cf6, #ec4899); display: flex; align-items: center; justify-content: center;">
        <div style="font-size: 4rem;">🧠</div>
      </div>
      <div class="news-content" style="padding: 1.5rem;">
        <div class="news-meta" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; color: var(--fluent-text-secondary); font-size: 0.8rem;">
          <span>Mindset</span>
          <span>•</span>
          <span>3 days ago</span>
        </div>
        <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem; line-height: 1.3;">Building Mental Resilience in Your Fitness Journey</h3>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; line-height: 1.5; margin-bottom: 1rem;">
          Develop the psychological tools and strategies needed to stay motivated, overcome setbacks, and maintain consistency in your fitness routine.
        </p>
        <a href="#" class="read-more" style="color: var(--fluent-accent-primary); font-weight: 600; font-size: 0.9rem;">Read More →</a>
      </div>
    </div>

    <!-- Article 4 -->
    <div class="news-card glass-card widgetMorph" style="overflow: hidden; border-radius: 16px;">
      <div class="news-image" style="height: 200px; background: linear-gradient(135deg, #06b6d4, #3b82f6); display: flex; align-items: center; justify-content: center;">
        <div style="font-size: 4rem;">💊</div>
      </div>
      <div class="news-content" style="padding: 1.5rem;">
        <div class="news-meta" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; color: var(--fluent-text-secondary); font-size: 0.8rem;">
          <span>Supplements</span>
          <span>•</span>
          <span>4 days ago</span>
        </div>
        <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem; line-height: 1.3;">The Truth About Protein Supplements</h3>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; line-height: 1.5; margin-bottom: 1rem;">
          Separating fact from fiction about protein powders, their benefits, potential risks, and how to choose the right supplement for your needs.
        </p>
        <a href="#" class="read-more" style="color: var(--fluent-accent-primary); font-weight: 600; font-size: 0.9rem;">Read More →</a>
      </div>
    </div>

    <!-- Article 5 -->
    <div class="news-card glass-card widgetMorph" style="overflow: hidden; border-radius: 16px;">
      <div class="news-image" style="height: 200px; background: linear-gradient(135deg, #ef4444, #f97316); display: flex; align-items: center; justify-content: center;">
        <div style="font-size: 4rem;">🏥</div>
      </div>
      <div class="news-content" style="padding: 1.5rem;">
        <div class="news-meta" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; color: var(--fluent-text-secondary); font-size: 0.8rem;">
          <span>Health</span>
          <span>•</span>
          <span>5 days ago</span>
        </div>
        <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem; line-height: 1.3;">Preventing Exercise-Related Injuries</h3>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; line-height: 1.5; margin-bottom: 1rem;">
          Essential strategies for injury prevention, proper form techniques, and when to seek professional medical advice for fitness-related concerns.
        </p>
        <a href="#" class="read-more" style="color: var(--fluent-accent-primary); font-weight: 600; font-size: 0.9rem;">Read More →</a>
      </div>
    </div>

    <!-- Article 6 -->
    <div class="news-card glass-card widgetMorph" style="overflow: hidden; border-radius: 16px;">
      <div class="news-image" style="height: 200px; background: linear-gradient(135deg, #10b981, #8b5cf6); display: flex; align-items: center; justify-content: center;">
        <div style="font-size: 4rem;">📱</div>
      </div>
      <div class="news-content" style="padding: 1.5rem;">
        <div class="news-meta" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; color: var(--fluent-text-secondary); font-size: 0.8rem;">
          <span>Technology</span>
          <span>•</span>
          <span>1 week ago</span>
        </div>
        <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem; line-height: 1.3;">Fitness Apps and Wearables: Do They Really Help?</h3>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; line-height: 1.5; margin-bottom: 1rem;">
          An in-depth review of popular fitness tracking apps and wearable devices, their accuracy, features, and impact on training outcomes.
        </p>
        <a href="#" class="read-more" style="color: var(--fluent-accent-primary); font-weight: 600; font-size: 0.9rem;">Read More →</a>
      </div>
    </div>
  </div>

  <!-- Gym Updates Section -->
  <div class="gym-updates glass-card widgetMorph" style="padding: 2rem;">
    <h2 style="margin-bottom: 2rem; display: flex; align-items: center; gap: 0.5rem;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 24px; height: 24px;">
        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
        <polyline points="13,2 13,8 19,8"/>
      </svg>
      Gym Updates & Announcements
    </h2>

    <div class="updates-list" style="display: flex; flex-direction: column; gap: 1.5rem;">
      <!-- Update 1 -->
      <div class="update-item" style="display: flex; gap: 1.5rem; padding: 1.5rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1);">
        <div class="update-icon" style="width: 50px; height: 50px; background: var(--fluent-accent-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" style="width: 24px; height: 24px;">
            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
          </svg>
        </div>
        <div class="update-content" style="flex: 1;">
          <div class="update-title" style="font-weight: 600; font-size: 1.1rem; margin-bottom: 0.5rem;">New Equipment Installation</div>
          <div class="update-description" style="color: var(--fluent-text-secondary); margin-bottom: 1rem;">
            We're excited to announce the installation of our new state-of-the-art cardio equipment! The new treadmills and ellipticals feature advanced heart rate monitoring and interactive touchscreens.
          </div>
          <div class="update-meta" style="display: flex; align-items: center; gap: 1rem; color: var(--fluent-text-secondary); font-size: 0.9rem;">
            <span>Posted 3 days ago</span>
            <span>•</span>
            <span>By Management Team</span>
          </div>
        </div>
      </div>

      <!-- Update 2 -->
      <div class="update-item" style="display: flex; gap: 1.5rem; padding: 1.5rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1);">
        <div class="update-icon" style="width: 50px; height: 50px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" style="width: 24px; height: 24px;">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12,6 12,12 16,14"/>
          </svg>
        </div>
        <div class="update-content" style="flex: 1;">
          <div class="update-title" style="font-weight: 600; font-size: 1.1rem; margin-bottom: 0.5rem;">Extended Holiday Hours</div>
          <div class="update-description" style="color: var(--fluent-text-secondary); margin-bottom: 1rem;">
            During the upcoming holiday season, we'll be extending our operating hours. The gym will remain open until 10 PM on weekdays and 8 PM on weekends to accommodate your busy schedules.
          </div>
          <div class="update-meta" style="display: flex; align-items: center; gap: 1rem; color: var(--fluent-text-secondary); font-size: 0.9rem;">
            <span>Posted 1 week ago</span>
            <span>•</span>
            <span>By Front Desk</span>
          </div>
        </div>
      </div>

      <!-- Update 3 -->
      <div class="update-item" style="display: flex; gap: 1.5rem; padding: 1.5rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1);">
        <div class="update-icon" style="width: 50px; height: 50px; background: var(--fluent-accent-secondary); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" style="width: 24px; height: 24px;">
            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
        </div>
        <div class="update-content" style="flex: 1;">
          <div class="update-title" style="font-weight: 600; font-size: 1.1rem; margin-bottom: 0.5rem;">New Trainer Introduction</div>
          <div class="update-description" style="color: var(--fluent-text-secondary); margin-bottom: 1rem;">
            Please welcome our newest trainer, Alex Rodriguez! Alex specializes in strength training and has over 8 years of experience helping clients achieve their fitness goals.
          </div>
          <div class="update-meta" style="display: flex; align-items: center; gap: 1rem; color: var(--fluent-text-secondary); font-size: 0.9rem;">
            <span>Posted 2 weeks ago</span>
            <span>•</span>
            <span>By HR Team</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Newsletter Signup -->
  <div class="newsletter-signup glass-card widgetMorph" style="padding: 2rem; margin-top: 2rem; text-align: center;">
    <h2 style="margin-bottom: 1rem; font-size: 1.8rem; font-weight: 700;">Stay Updated</h2>
    <p style="color: var(--fluent-text-secondary); margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto;">
      Subscribe to our newsletter for the latest fitness tips, workout plans, and exclusive member offers delivered straight to your inbox.
    </p>

    <form id="newsletterForm" style="max-width: 400px; margin: 0 auto; display: flex; gap: 1rem;">
      <input type="email" placeholder="Enter your email address" required style="flex: 1; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
      <button type="submit" class="primary buttonGlow">Subscribe</button>
    </form>
  </div>
</section>

<script>
// Newsletter form handling
document.getElementById('newsletterForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const email = this.querySelector('input[type="email"]').value;

    // Show success message
    showNotification('Successfully subscribed to newsletter!', 'success');

    // Clear form
    this.reset();
});

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? 'var(--fluent-accent-primary)' : 'var(--fluent-accent-secondary)'};
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
    }, 3000);
}
</script>