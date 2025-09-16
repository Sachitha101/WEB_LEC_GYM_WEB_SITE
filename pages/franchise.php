<?php
// FRANCHISE PAGE
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? 'Guest';
?>
<section id="franchise" class="section franchise active" aria-label="Franchise Opportunities" tabindex="0">
  <!-- Page Header -->
  <div class="page-header glass-card" style="padding: 2rem; margin-bottom: 2rem; text-align: center;">
    <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
      Franchise Opportunities
    </h1>
    <p style="color: var(--fluent-text-secondary); font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
      Join our successful fitness franchise network. Be part of a proven business model with comprehensive support, training, and marketing resources.
    </p>
  </div>

  <!-- Franchise Hero -->
  <div class="franchise-hero glass-card widgetMorph" style="padding: 3rem; margin-bottom: 2rem; text-align: center;">
    <div class="hero-stats" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
      <div class="stat-item">
        <div class="stat-number" style="font-size: 3rem; font-weight: 800; color: var(--fluent-accent-primary); margin-bottom: 0.5rem;">150+</div>
        <div class="stat-label" style="color: var(--fluent-text-secondary); font-size: 1rem; font-weight: 600;">Locations Worldwide</div>
      </div>
      <div class="stat-item">
        <div class="stat-number" style="font-size: 3rem; font-weight: 800; color: var(--fluent-accent-primary); margin-bottom: 0.5rem;">95%</div>
        <div class="stat-label" style="color: var(--fluent-text-secondary); font-size: 1rem; font-weight: 600;">Success Rate</div>
      </div>
      <div class="stat-item">
        <div class="stat-number" style="font-size: 3rem; font-weight: 800; color: var(--fluent-accent-primary); margin-bottom: 0.5rem;">$2.5M</div>
        <div class="stat-label" style="color: var(--fluent-text-secondary); font-size: 1rem; font-weight: 600;">Average Revenue</div>
      </div>
      <div class="stat-item">
        <div class="stat-number" style="font-size: 3rem; font-weight: 800; color: var(--fluent-accent-primary); margin-bottom: 0.5rem;">18</div>
        <div class="stat-label" style="color: var(--fluent-text-secondary); font-size: 1rem; font-weight: 600;">Months ROI</div>
      </div>
    </div>

    <div class="hero-cta">
      <a href="#inquiry-form" class="primary large buttonGlow" style="display: inline-flex; align-items: center; gap: 0.5rem;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px;">
          <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
        </svg>
        Request Franchise Info
      </a>
    </div>
  </div>

  <!-- Why Choose Our Franchise -->
  <div class="why-franchise glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem;">
    <h2 style="text-align: center; margin-bottom: 2rem; font-size: 2rem; font-weight: 700;">Why Choose Our Franchise?</h2>

    <div class="benefits-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
      <!-- Benefit 1 -->
      <div class="benefit-card" style="padding: 2rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); text-align: center;">
        <div class="benefit-icon" style="font-size: 3rem; margin-bottom: 1rem;">🏆</div>
        <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem;">Proven Business Model</h3>
        <p style="color: var(--fluent-text-secondary); line-height: 1.6;">
          Join a franchise with a 15-year track record of success. Our proven systems and processes ensure consistent results across all locations.
        </p>
      </div>

      <!-- Benefit 2 -->
      <div class="benefit-card" style="padding: 2rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); text-align: center;">
        <div class="benefit-icon" style="font-size: 3rem; margin-bottom: 1rem;">🎓</div>
        <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem;">Comprehensive Training</h3>
        <p style="color: var(--fluent-text-secondary); line-height: 1.6;">
          Receive extensive training in operations, management, marketing, and fitness expertise. Our training program lasts 8 weeks and continues with ongoing support.
        </p>
      </div>

      <!-- Benefit 3 -->
      <div class="benefit-card" style="padding: 2rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); text-align: center;">
        <div class="benefit-icon" style="font-size: 3rem; margin-bottom: 1rem;">📈</div>
        <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem;">Marketing Support</h3>
        <p style="color: var(--fluent-text-secondary); line-height: 1.6;">
          Benefit from national marketing campaigns, local marketing support, and co-op advertising funds to drive membership growth and brand awareness.
        </p>
      </div>

      <!-- Benefit 4 -->
      <div class="benefit-card" style="padding: 2rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); text-align: center;">
        <div class="benefit-icon" style="font-size: 3rem; margin-bottom: 1rem;">🔧</div>
        <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem;">Ongoing Support</h3>
        <p style="color: var(--fluent-text-secondary); line-height: 1.6;">
          Access to our dedicated support team for operations, marketing, IT, and business development. Regular site visits and performance reviews included.
        </p>
      </div>

      <!-- Benefit 5 -->
      <div class="benefit-card" style="padding: 2rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); text-align: center;">
        <div class="benefit-icon" style="font-size: 3rem; margin-bottom: 1rem;">💰</div>
        <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem;">Financial Performance</h3>
        <p style="color: var(--fluent-text-secondary); line-height: 1.6;">
          Strong financial performance with average annual revenues of $2.5M and net profits of 25-35%. Most locations achieve break-even within 18 months.
        </p>
      </div>

      <!-- Benefit 6 -->
      <div class="benefit-card" style="padding: 2rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); text-align: center;">
        <div class="benefit-icon" style="font-size: 3rem; margin-bottom: 1rem;">🌟</div>
        <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem;">Brand Recognition</h3>
        <p style="color: var(--fluent-text-secondary); line-height: 1.6;">
          Leverage our established brand with high recognition and trust in the fitness industry. Immediate credibility and customer attraction.
        </p>
      </div>
    </div>
  </div>

  <!-- Investment Requirements -->
  <div class="investment-requirements glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem;">
    <h2 style="text-align: center; margin-bottom: 2rem; font-size: 2rem; font-weight: 700;">Investment Requirements</h2>

    <div class="requirements-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
      <!-- Total Investment -->
      <div class="requirement-card" style="padding: 2rem; background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.04)); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.15); border-radius: 20px; text-align: center;">
        <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem;">Total Investment</h3>
        <div class="investment-amount" style="font-size: 2.5rem; font-weight: 800; color: var(--fluent-accent-primary); margin-bottom: 1rem;">$500K - $750K</div>
        <p style="color: var(--fluent-text-secondary); margin-bottom: 1rem;">Includes franchise fee, equipment, build-out, and working capital</p>
        <div class="breakdown" style="text-align: left;">
          <div class="breakdown-item" style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; padding: 0.5rem 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <span>Franchise Fee:</span>
            <span style="font-weight: 600;">$50,000</span>
          </div>
          <div class="breakdown-item" style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; padding: 0.5rem 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <span>Equipment & Build-out:</span>
            <span style="font-weight: 600;">$350,000 - $550,000</span>
          </div>
          <div class="breakdown-item" style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; padding: 0.5rem 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <span>Working Capital:</span>
            <span style="font-weight: 600;">$100,000</span>
          </div>
        </div>
      </div>

      <!-- Requirements -->
      <div class="requirement-card" style="padding: 2rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1);">
        <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1.5rem;">Franchise Requirements</h3>

        <div class="requirements-list" style="display: flex; flex-direction: column; gap: 1rem;">
          <div class="requirement-item" style="display: flex; align-items: flex-start; gap: 1rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0; margin-top: 0.25rem;">
              <polyline points="20,6 9,17 4,12"/>
            </svg>
            <div>
              <div style="font-weight: 600; margin-bottom: 0.25rem;">Net Worth</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Minimum $1M liquid assets</div>
            </div>
          </div>

          <div class="requirement-item" style="display: flex; align-items: flex-start; gap: 1rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0; margin-top: 0.25rem;">
              <polyline points="20,6 9,17 4,12"/>
            </svg>
            <div>
              <div style="font-weight: 600; margin-bottom: 0.25rem;">Location</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">3,000-5,000 sq ft commercial space</div>
            </div>
          </div>

          <div class="requirement-item" style="display: flex; align-items: flex-start; gap: 1rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0; margin-top: 0.25rem;">
              <polyline points="20,6 9,17 4,12"/>
            </svg>
            <div>
              <div style="font-weight: 600; margin-bottom: 0.25rem;">Experience</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Business management or fitness industry experience preferred</div>
            </div>
          </div>

          <div class="requirement-item" style="display: flex; align-items: flex-start; gap: 1rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: var(--fluent-accent-primary); flex-shrink: 0; margin-top: 0.25rem;">
              <polyline points="20,6 9,17 4,12"/>
            </svg>
            <div>
              <div style="font-weight: 600; margin-bottom: 0.25rem;">Commitment</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Full-time dedication to operations</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Success Stories -->
  <div class="success-stories glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem;">
    <h2 style="text-align: center; margin-bottom: 2rem; font-size: 2rem; font-weight: 700;">Franchisee Success Stories</h2>

    <div class="stories-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem;">
      <!-- Story 1 -->
      <div class="story-card" style="padding: 2rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1);">
        <div class="story-header" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
          <div class="story-avatar" style="width: 60px; height: 60px; background: var(--fluent-accent-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 600;">MJ</div>
          <div>
            <div class="story-name" style="font-weight: 600; font-size: 1.1rem;">Mike Johnson</div>
            <div class="story-location" style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Austin, TX - Year 3</div>
          </div>
        </div>
        <div class="story-content">
          <p style="color: var(--fluent-text-secondary); line-height: 1.6; margin-bottom: 1rem; font-style: italic;">
            "Opening my Fitness Club franchise was the best business decision I've made. The support from the corporate team has been incredible, and I've seen consistent growth year after year."
          </p>
          <div class="story-stats" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
            <div class="stat">
              <div style="font-weight: 600; color: var(--fluent-accent-primary); font-size: 1.2rem;">2,800</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.8rem;">Active Members</div>
            </div>
            <div class="stat">
              <div style="font-weight: 600; color: var(--fluent-accent-primary); font-size: 1.2rem;">$3.2M</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.8rem;">Annual Revenue</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Story 2 -->
      <div class="story-card" style="padding: 2rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1);">
        <div class="story-header" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
          <div class="story-avatar" style="width: 60px; height: 60px; background: var(--fluent-accent-secondary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 600;">SC</div>
          <div>
            <div class="story-name" style="font-weight: 600; font-size: 1.1rem;">Sarah Chen</div>
            <div class="story-location" style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Seattle, WA - Year 2</div>
          </div>
        </div>
        <div class="story-content">
          <p style="color: var(--fluent-text-secondary); line-height: 1.6; margin-bottom: 1rem; font-style: italic;">
            "The comprehensive training and ongoing support made the transition smooth. My location has exceeded all projections and I'm already planning to open a second gym."
          </p>
          <div class="story-stats" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
            <div class="stat">
              <div style="font-weight: 600; color: var(--fluent-accent-primary); font-size: 1.2rem;">1,900</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.8rem;">Active Members</div>
            </div>
            <div class="stat">
              <div style="font-weight: 600; color: var(--fluent-accent-primary); font-size: 1.2rem;">$2.8M</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.8rem;">Annual Revenue</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Story 3 -->
      <div class="story-card" style="padding: 2rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1);">
        <div class="story-header" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
          <div class="story-avatar" style="width: 60px; height: 60px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 600;">DR</div>
          <div>
            <div class="story-name" style="font-weight: 600; font-size: 1.1rem;">David Rodriguez</div>
            <div class="story-location" style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Miami, FL - Year 4</div>
          </div>
        </div>
        <div class="story-content">
          <p style="color: var(--fluent-text-secondary); line-height: 1.6; margin-bottom: 1rem; font-style: italic;">
            "From day one, the marketing support and brand recognition gave us a competitive edge. We've built a thriving community and the business continues to grow steadily."
          </p>
          <div class="story-stats" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
            <div class="stat">
              <div style="font-weight: 600; color: var(--fluent-accent-primary); font-size: 1.2rem;">3,100</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.8rem;">Active Members</div>
            </div>
            <div class="stat">
              <div style="font-weight: 600; color: var(--fluent-accent-primary); font-size: 1.2rem;">$3.8M</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.8rem;">Annual Revenue</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Franchise Inquiry Form -->
  <div id="inquiry-form" class="inquiry-form glass-card widgetMorph" style="padding: 2rem;">
    <h2 style="text-align: center; margin-bottom: 2rem; font-size: 2rem; font-weight: 700;">Request Franchise Information</h2>
    <p style="text-align: center; color: var(--fluent-text-secondary); margin-bottom: 2rem;">
      Fill out the form below and we'll send you a comprehensive franchise package with all the details you need to get started.
    </p>

    <form id="franchiseInquiryForm" style="max-width: 600px; margin: 0 auto; display: flex; flex-direction: column; gap: 1.5rem;">
      <!-- Personal Information -->
      <div class="form-section">
        <h3 style="margin-bottom: 1rem; font-size: 1.2rem; font-weight: 600;">Personal Information</h3>

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

        <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          <div class="form-group">
            <label for="email" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Email Address *</label>
            <input type="email" id="email" name="email" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
          </div>
          <div class="form-group">
            <label for="phone" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Phone Number *</label>
            <input type="tel" id="phone" name="phone" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
          </div>
        </div>
      </div>

      <!-- Business Information -->
      <div class="form-section">
        <h3 style="margin-bottom: 1rem; font-size: 1.2rem; font-weight: 600;">Business Information</h3>

        <div class="form-group">
          <label for="businessExperience" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Business Experience</label>
          <select id="businessExperience" name="businessExperience" style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
            <option value="">Select your experience level</option>
            <option value="none">No business experience</option>
            <option value="some">Some business experience</option>
            <option value="extensive">Extensive business experience</option>
            <option value="owner">Current business owner</option>
          </select>
        </div>

        <div class="form-group">
          <label for="investmentRange" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Investment Range</label>
          <select id="investmentRange" name="investmentRange" style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
            <option value="">Select investment range</option>
            <option value="under-500k">Under $500,000</option>
            <option value="500k-750k">$500,000 - $750,000</option>
            <option value="750k-1m">$750,000 - $1,000,000</option>
            <option value="over-1m">Over $1,000,000</option>
          </select>
        </div>

        <div class="form-group">
          <label for="timeline" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Timeline to Open</label>
          <select id="timeline" name="timeline" style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
            <option value="">Select timeline</option>
            <option value="asap">As soon as possible</option>
            <option value="3-6months">3-6 months</option>
            <option value="6-12months">6-12 months</option>
            <option value="1-2years">1-2 years</option>
            <option value="exploring">Just exploring options</option>
          </select>
        </div>
      </div>

      <!-- Location Preferences -->
      <div class="form-section">
        <h3 style="margin-bottom: 1rem; font-size: 1.2rem; font-weight: 600;">Location Preferences</h3>

        <div class="form-group">
          <label for="preferredState" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Preferred State/Region</label>
          <input type="text" id="preferredState" name="preferredState" placeholder="e.g., California, Southeast, etc." style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
        </div>

        <div class="form-group">
          <label for="additionalInfo" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Additional Information</label>
          <textarea id="additionalInfo" name="additionalInfo" rows="4" placeholder="Tell us about your background, why you're interested in franchising, or any questions you have..." style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem; resize: vertical;"></textarea>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-actions" style="text-align: center; margin-top: 1rem;">
        <button type="submit" class="primary large buttonGlow">Submit Franchise Inquiry</button>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; margin-top: 1rem;">
          By submitting this form, you agree to receive communications from our franchise team.
        </p>
      </div>
    </form>
  </div>
</section>

<script>
// Franchise inquiry form handling
document.getElementById('franchiseInquiryForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const inquiryData = Object.fromEntries(formData);

    // Show success message
    showNotification('Franchise inquiry submitted successfully! Our team will contact you within 24 hours.', 'success');

    // Clear form
    this.reset();

    // Here you would typically send the data to your backend API
    console.log('Franchise inquiry:', inquiryData);
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
    }, 5000);
}
</script>