<?php
// MEMBERSHIP PAGE
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? 'Guest';
?>
<section id="membership" class="section membership active" aria-label="Membership Plans" tabindex="0">
  <!-- Page Header -->
  <div class="page-header glass-card" style="padding: 2rem; margin-bottom: 2rem; text-align: center;">
    <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
      Choose Your Fitness Journey
    </h1>
    <p style="color: var(--fluent-text-secondary); font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
      Select the perfect membership plan that fits your lifestyle and goals. All plans include access to our premium facilities and expert guidance.
    </p>
  </div>

  <!-- Membership Plans Grid -->
  <div class="plans-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
    <!-- Basic Plan -->
    <div class="plan-card glass-card widgetMorph" style="background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.04)); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.15); border-radius: 20px; padding: 2rem; position: relative; overflow: hidden;">
      <div class="plan-header" style="text-align: center; margin-bottom: 2rem;">
        <div class="plan-icon" style="font-size: 3rem; margin-bottom: 1rem;">🏃‍♂️</div>
        <h3 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 0.5rem;">Basic</h3>
        <div class="plan-price" style="font-size: 2.5rem; font-weight: 800; color: var(--fluent-accent-primary); margin-bottom: 0.5rem;">
          $29<span style="font-size: 1rem; font-weight: 600;">/month</span>
        </div>
        <p style="color: var(--fluent-text-secondary); margin: 0;">Perfect for beginners starting their fitness journey</p>
      </div>

      <div class="plan-features" style="margin-bottom: 2rem;">
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0;">
            <polyline points="20,6 9,17 4,12"/>
          </svg>
          <span>24/7 Gym Access</span>
        </div>
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0;">
            <polyline points="20,6 9,17 4,12"/>
          </svg>
          <span>Free Weights & Cardio Equipment</span>
        </div>
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0;">
            <polyline points="20,6 9,17 4,12"/>
          </svg>
          <span>Locker Room Access</span>
        </div>
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0;">
            <polyline points="20,6 9,17 4,12"/>
          </svg>
          <span>Mobile App Access</span>
        </div>
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0; opacity: 0.5;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-text-secondary); flex-shrink: 0;">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
          <span>Personal Training Sessions</span>
        </div>
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0; opacity: 0.5;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-text-secondary); flex-shrink: 0;">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
          <span>Nutrition Consultation</span>
        </div>
      </div>

      <div class="plan-action">
        <button class="primary large buttonGlow choose-plan-btn" data-tier="basic" data-price="29" style="width: 100%; text-align: center; display: block;">
          Choose Basic Plan
        </button>
      </div>
    </div>

    <!-- Premium Plan (Popular) -->
    <div class="plan-card glass-card widgetMorph popular" style="background: linear-gradient(180deg, rgba(255,255,255,0.12), rgba(255,255,255,0.08)); backdrop-filter: blur(20px); border: 2px solid var(--fluent-accent-primary); border-radius: 20px; padding: 2rem; position: relative; overflow: hidden; transform: scale(1.05);">
      <div class="popular-badge" style="position: absolute; top: -10px; left: 50%; transform: translateX(-50%); background: var(--fluent-accent-primary); color: white; padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.9rem; font-weight: 600;">Most Popular</div>

      <div class="plan-header" style="text-align: center; margin-bottom: 2rem;">
        <div class="plan-icon" style="font-size: 3rem; margin-bottom: 1rem;">💪</div>
        <h3 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 0.5rem;">Premium</h3>
        <div class="plan-price" style="font-size: 2.5rem; font-weight: 800; color: var(--fluent-accent-primary); margin-bottom: 0.5rem;">
          $59<span style="font-size: 1rem; font-weight: 600;">/month</span>
        </div>
        <p style="color: var(--fluent-text-secondary); margin: 0;">Complete fitness experience with personal training</p>
      </div>

      <div class="plan-features" style="margin-bottom: 2rem;">
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0;">
            <polyline points="20,6 9,17 4,12"/>
          </svg>
          <span>Everything in Basic</span>
        </div>
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0;">
            <polyline points="20,6 9,17 4,12"/>
          </svg>
          <span>4 Personal Training Sessions/Month</span>
        </div>
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0;">
            <polyline points="20,6 9,17 4,12"/>
          </svg>
          <span>Nutrition Consultation</span>
        </div>
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0;">
            <polyline points="20,6 9,17 4,12"/>
          </svg>
          <span>Group Classes Unlimited</span>
        </div>
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0;">
            <polyline points="20,6 9,17 4,12"/>
          </svg>
          <span>Sauna & Spa Access</span>
        </div>
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0;">
            <polyline points="20,6 9,17 4,12"/>
          </svg>
          <span>Priority Booking</span>
        </div>
      </div>

      <div class="plan-action">
        <button class="primary large buttonGlow choose-plan-btn" data-tier="premium" data-price="59" style="width: 100%; text-align: center; display: block;">
          Choose Premium Plan
        </button>
      </div>
    </div>

    <!-- Elite Plan -->
    <div class="plan-card glass-card widgetMorph" style="background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.04)); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.15); border-radius: 20px; padding: 2rem; position: relative; overflow: hidden;">
      <div class="plan-header" style="text-align: center; margin-bottom: 2rem;">
        <div class="plan-icon" style="font-size: 3rem; margin-bottom: 1rem;">👑</div>
        <h3 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 0.5rem;">Elite</h3>
        <div class="plan-price" style="font-size: 2.5rem; font-weight: 800; color: var(--fluent-accent-primary); margin-bottom: 0.5rem;">
          $99<span style="font-size: 1rem; font-weight: 600;">/month</span>
        </div>
        <p style="color: var(--fluent-text-secondary); margin: 0;">VIP experience with unlimited personal training</p>
      </div>

      <div class="plan-features" style="margin-bottom: 2rem;">
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0;">
            <polyline points="20,6 9,17 4,12"/>
          </svg>
          <span>Everything in Premium</span>
        </div>
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0;">
            <polyline points="20,6 9,17 4,12"/>
          </svg>
          <span>Unlimited Personal Training</span>
        </div>
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0;">
            <polyline points="20,6 9,17 4,12"/>
          </svg>
          <span>Private Locker & Towel Service</span>
        </div>
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0;">
            <polyline points="20,6 9,17 4,12"/>
          </svg>
          <span>Nutritionist Consultation</span>
        </div>
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0;">
            <polyline points="20,6 9,17 4,12"/>
          </svg>
          <span>VIP Lounge Access</span>
        </div>
        <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding: 0.5rem 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0;">
            <polyline points="20,6 9,17 4,12"/>
          </svg>
          <span>Guest Passes (2/month)</span>
        </div>
      </div>

      <div class="plan-action">
        <button class="primary large buttonGlow choose-plan-btn" data-tier="elite" data-price="99" style="width: 100%; text-align: center; display: block;">
          Choose Elite Plan
        </button>
      </div>
    </div>
  </div>

  <!-- FAQ Section -->
  <div class="faq-section glass-card" style="padding: 2rem;">
    <h2 style="text-align: center; margin-bottom: 2rem; font-size: 2rem; font-weight: 700;">Frequently Asked Questions</h2>

    <div class="faq-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem;">
      <div class="faq-item">
        <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">Can I cancel my membership anytime?</h3>
        <p style="color: var(--fluent-text-secondary); margin: 0;">Yes, you can cancel your membership at any time with no cancellation fees. Your access will continue until the end of your billing period.</p>
      </div>

      <div class="faq-item">
        <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">Are there any signup fees?</h3>
        <p style="color: var(--fluent-text-secondary); margin: 0;">No signup fees for any of our membership plans. You only pay the monthly subscription fee.</p>
      </div>

      <div class="faq-item">
        <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">Can I freeze my membership?</h3>
        <p style="color: var(--fluent-text-secondary); margin: 0;">Yes, you can freeze your membership for up to 3 months per year for medical or travel reasons.</p>
      </div>

      <div class="faq-item">
        <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">Do you offer student discounts?</h3>
        <p style="color: var(--fluent-text-secondary); margin: 0;">Yes, we offer 20% off for full-time students with valid student ID. Contact us for more details.</p>
      </div>

      <div class="faq-item">
        <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">What's included in personal training?</h3>
        <p style="color: var(--fluent-text-secondary); margin: 0;">Personal training includes one-on-one sessions with certified trainers, customized workout plans, and progress tracking.</p>
      </div>

      <div class="faq-item">
        <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">Can I bring a guest?</h3>
        <p style="color: var(--fluent-text-secondary); margin: 0;">Guests are welcome with Elite membership. Basic and Premium members can purchase day passes for guests.</p>
      </div>
    </div>
  </div>
</section>
<script>
// Membership selection: persist to DB (if logged in), update UI, and add to cart without redirect
(function(){
  const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
  function ucfirst(s){ return s ? s.charAt(0).toUpperCase() + s.slice(1) : s; }

  async function saveTierServer(tier){
    try {
      const res = await fetch('api/membership.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify({ tier })
      });
      const data = await res.json();
      if (!res.ok || !data.success) throw new Error(data.message || 'Failed to save tier');
      return data.data?.tier || tier;
    } catch (e) {
      throw e;
    }
  }

  function applyTierClass(tier){
    const b = document.body;
    ['tier-basic','tier-premium','tier-elite'].forEach(c => b.classList.remove(c));
    if (tier) b.classList.add('tier-' + tier);
  }

  function updateHeaderBadge(tier){
    const badge = document.querySelector('.membership-badge');
    if (badge) {
      badge.textContent = tier ? ucfirst(tier) : '';
      badge.style.display = tier ? 'inline-flex' : 'none';
    }
  }

  function addMembershipToCart(tier, price){
    if (!window.shoppingCart) return;
    // Remove any existing membership line from cart
    const cart = window.shoppingCart.cart || [];
    const filtered = cart.filter(item => item.category !== 'membership');
    window.shoppingCart.cart = filtered;
    window.shoppingCart.saveCart();
    // Add new membership line
    const prod = {
      id: 'membership-' + tier,
      name: 'Membership - ' + ucfirst(tier),
      price: parseFloat(price) || 0,
      image: '',
      category: 'membership',
      quantity: 1
    };
    window.shoppingCart.addToCart(prod);
  }

  function notify(msg, type){
    if (window.FitnessAPI && window.FitnessAPI.notifications) {
      return window.FitnessAPI.notifications[type || 'info'](msg);
    }
    alert(msg);
  }

  document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.choose-plan-btn');
    if (!btn) return;
    e.preventDefault();
    const tier = btn.getAttribute('data-tier');
    const price = btn.getAttribute('data-price');

    try {
      if (isLoggedIn) {
        const saved = await saveTierServer(tier);
        applyTierClass(saved);
        updateHeaderBadge(saved);
        notify(ucfirst(saved) + ' plan saved to your account', 'success');
      } else {
        notify('Plan selected. Log in to save it to your account.', 'info');
      }

      addMembershipToCart(tier, price);
      notify(ucfirst(tier) + ' added to your order. You can complete it in Checkout.', 'success');

      // Optional: visually mark selected card
      document.querySelectorAll('.plan-card').forEach(c => c.classList.remove('selected'));
      btn.closest('.plan-card')?.classList.add('selected');
    } catch (err) {
      notify('Could not save plan: ' + (err?.message || err), 'error');
    }
  });
})();
</script>