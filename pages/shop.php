<?php
// SHOP PAGE
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? 'Guest';
?>
<section id="shop" class="section shop active" aria-label="Fitness Shop" tabindex="0">
  <!-- Page Header -->
  <div class="page-header glass-card" style="padding: 2rem; margin-bottom: 2rem; text-align: center;">
    <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
      Fitness Gear & Supplements
    </h1>
    <p style="color: var(--fluent-text-secondary); font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
      Premium quality fitness equipment and supplements to support your training goals. Members get exclusive discounts!
    </p>
  </div>

  <!-- Shop Categories -->
  <div class="shop-categories glass-card" style="padding: 2rem; margin-bottom: 2rem;">
    <div class="categories-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem;">
      <button class="category-btn active" data-category="all" style="padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; margin-bottom: 0.5rem;">
          <circle cx="12" cy="12" r="10"/>
          <path d="M12 6v6l4 2"/>
        </svg>
        All Products
      </button>
      <button class="category-btn" data-category="equipment" style="padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; margin-bottom: 0.5rem;">
          <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
        </svg>
        Equipment
      </button>
      <button class="category-btn" data-category="supplements" style="padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; margin-bottom: 0.5rem;">
          <path d="M20 10c0 4.4-3.6 8-8 8s-8-3.6-8-8 3.6-8 8-8 8 3.6 8 8z"/>
          <path d="M12 2v16"/>
          <path d="M8 6h8"/>
        </svg>
        Supplements
      </button>
      <button class="category-btn" data-category="apparel" style="padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; margin-bottom: 0.5rem;">
          <path d="M20.38 3.46L16 2l-.5 4.5L12 6.5l4.5.5L18 11l1.46-4.54L22 6.5l-1.62-3.04z"/>
          <path d="M14 13l-2 6 2 2 2-2-2-6z"/>
          <path d="M9 7l-4 1 1 4 4-1-1-4z"/>
        </svg>
        Apparel
      </button>
      <button class="category-btn" data-category="accessories" style="padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; margin-bottom: 0.5rem;">
          <circle cx="12" cy="12" r="10"/>
          <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
          <path d="M12 17h.01"/>
        </svg>
        Accessories
      </button>
    </div>
  </div>

  <!-- Products Grid -->
  <div class="products-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
    <!-- Product 1: Protein Shaker -->
    <div class="product-card glass-card widgetMorph" data-category="accessories" style="overflow: hidden; border-radius: 16px;">
      <div class="product-image" style="height: 200px; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); display: flex; align-items: center; justify-content: center; position: relative;">
        <div style="font-size: 4rem;">🥤</div>
        <div class="product-badge" style="position: absolute; top: 10px; right: 10px; background: #10b981; color: white; padding: 0.5rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">New</div>
      </div>
      <div class="product-info" style="padding: 1.5rem;">
        <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">Premium Protein Shaker</h3>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; margin-bottom: 1rem;">Leak-proof, BPA-free shaker with mixing ball and measurement markings.</p>
        <div class="product-price" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
          <span style="font-size: 1.5rem; font-weight: 700; color: var(--fluent-accent-primary);">$24.99</span>
          <span style="color: var(--fluent-text-secondary); text-decoration: line-through; font-size: 1rem;">$29.99</span>
        </div>
        <div class="product-rating" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
          <div class="stars" style="display: flex; gap: 0.25rem;">
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #e5e7eb;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
          </div>
          <span style="color: var(--fluent-text-secondary); font-size: 0.9rem;">(128 reviews)</span>
        </div>
        <button class="primary buttonGlow" style="width: 100%;">Add to Cart</button>
      </div>
    </div>

    <!-- Product 2: Whey Protein -->
    <div class="product-card glass-card widgetMorph" data-category="supplements" style="overflow: hidden; border-radius: 16px;">
      <div class="product-image" style="height: 200px; background: linear-gradient(135deg, #8b5cf6, #06b6d4); display: flex; align-items: center; justify-content: center; position: relative;">
        <div style="font-size: 4rem;">💪</div>
        <div class="product-badge" style="position: absolute; top: 10px; right: 10px; background: var(--fluent-accent-primary); color: white; padding: 0.5rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">Best Seller</div>
      </div>
      <div class="product-info" style="padding: 1.5rem;">
        <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">Premium Whey Protein</h3>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; margin-bottom: 1rem;">25g protein per serving, great taste, mixes instantly. Available in Chocolate, Vanilla, Strawberry.</p>
        <div class="product-price" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
          <span style="font-size: 1.5rem; font-weight: 700; color: var(--fluent-accent-primary);">$49.99</span>
          <span style="color: var(--fluent-text-secondary); text-decoration: line-through; font-size: 1rem;">$59.99</span>
        </div>
        <div class="product-rating" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
          <div class="stars" style="display: flex; gap: 0.25rem;">
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
          </div>
          <span style="color: var(--fluent-text-secondary); font-size: 0.9rem;">(342 reviews)</span>
        </div>
        <button class="primary buttonGlow" style="width: 100%;">Add to Cart</button>
      </div>
    </div>

    <!-- Product 3: Dumbbells -->
    <div class="product-card glass-card widgetMorph" data-category="equipment" style="overflow: hidden; border-radius: 16px;">
      <div class="product-image" style="height: 200px; background: linear-gradient(135deg, #f59e0b, #ef4444); display: flex; align-items: center; justify-content: center; position: relative;">
        <div style="font-size: 4rem;">🏋️‍♂️</div>
        <div class="product-badge" style="position: absolute; top: 10px; right: 10px; background: #ef4444; color: white; padding: 0.5rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">Sale</div>
      </div>
      <div class="product-info" style="padding: 1.5rem;">
        <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">Adjustable Dumbbells</h3>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; margin-bottom: 1rem;">5-50 lbs adjustable weight set. Perfect for home workouts and progressive training.</p>
        <div class="product-price" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
          <span style="font-size: 1.5rem; font-weight: 700; color: var(--fluent-accent-primary);">$199.99</span>
          <span style="color: var(--fluent-text-secondary); text-decoration: line-through; font-size: 1rem;">$249.99</span>
        </div>
        <div class="product-rating" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
          <div class="stars" style="display: flex; gap: 0.25rem;">
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #d1d5db;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
          </div>
          <span style="color: var(--fluent-text-secondary); font-size: 0.9rem;">(89 reviews)</span>
        </div>
        <button class="primary buttonGlow" style="width: 100%;">Add to Cart</button>
      </div>
    </div>

    <!-- Product 4: Yoga Mat -->
    <div class="product-card glass-card widgetMorph" data-category="equipment" style="overflow: hidden; border-radius: 16px;">
      <div class="product-image" style="height: 200px; background: linear-gradient(135deg, #10b981, #06b6d4); display: flex; align-items: center; justify-content: center; position: relative;">
        <div style="font-size: 4rem;">🧘‍♀️</div>
      </div>
      <div class="product-info" style="padding: 1.5rem;">
        <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">Premium Yoga Mat</h3>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; margin-bottom: 1rem;">6mm thick, non-slip surface with carrying strap. Perfect for yoga, pilates, and floor exercises.</p>
        <div class="product-price" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
          <span style="font-size: 1.5rem; font-weight: 700; color: var(--fluent-accent-primary);">$39.99</span>
        </div>
        <div class="product-rating" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
          <div class="stars" style="display: flex; gap: 0.25rem;">
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #d1d5db;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
          </div>
          <span style="color: var(--fluent-text-secondary); font-size: 0.9rem;">(156 reviews)</span>
        </div>
        <button class="primary buttonGlow" style="width: 100%;">Add to Cart</button>
      </div>
    </div>

    <!-- Product 5: Resistance Bands -->
    <div class="product-card glass-card widgetMorph" data-category="equipment" style="overflow: hidden; border-radius: 16px;">
      <div class="product-image" style="height: 200px; background: linear-gradient(135deg, #8b5cf6, #ec4899); display: flex; align-items: center; justify-content: center; position: relative;">
        <div style="font-size: 4rem;">🔗</div>
      </div>
      <div class="product-info" style="padding: 1.5rem;">
        <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">Resistance Bands Set</h3>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; margin-bottom: 1rem;">5-band set with varying resistance levels. Includes door anchor and carrying bag.</p>
        <div class="product-price" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
          <span style="font-size: 1.5rem; font-weight: 700; color: var(--fluent-accent-primary);">$29.99</span>
        </div>
        <div class="product-rating" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
          <div class="stars" style="display: flex; gap: 0.25rem;">
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #e5e7eb;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
          </div>
          <span style="color: var(--fluent-text-secondary); font-size: 0.9rem;">(203 reviews)</span>
        </div>
        <button class="primary buttonGlow" style="width: 100%;">Add to Cart</button>
      </div>
    </div>

    <!-- Product 6: Fitness Apparel -->
    <div class="product-card glass-card widgetMorph" data-category="apparel" style="overflow: hidden; border-radius: 16px;">
      <div class="product-image" style="height: 200px; background: linear-gradient(135deg, #f97316, #eab308); display: flex; align-items: center; justify-content: center; position: relative;">
        <div style="font-size: 4rem;">👕</div>
      </div>
      <div class="product-info" style="padding: 1.5rem;">
        <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">Performance T-Shirt</h3>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; margin-bottom: 1rem;">Moisture-wicking fabric, UV protection, and breathable design. Available in multiple colors.</p>
        <div class="product-price" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
          <span style="font-size: 1.5rem; font-weight: 700; color: var(--fluent-accent-primary);">$19.99</span>
        </div>
        <div class="product-rating" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
          <div class="stars" style="display: flex; gap: 0.25rem;">
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px; color: #fbbf24;">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
          </div>
          <span style="color: var(--fluent-text-secondary); font-size: 0.9rem;">(287 reviews)</span>
        </div>
        <button class="primary buttonGlow" style="width: 100%;">Add to Cart</button>
      </div>
    </div>
  </div>

  <!-- Shopping Cart Summary -->
  <div class="cart-summary glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem;">
    <h2 style="margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 24px; height: 24px;">
        <circle cx="9" cy="21" r="1"/>
        <circle cx="20" cy="21" r="1"/>
        <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
      </svg>
      Shopping Cart
    </h2>

    <div class="cart-items" style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 2rem;">
      <div class="cart-empty" style="text-align: center; padding: 3rem; color: var(--fluent-text-secondary);">
        <div style="font-size: 3rem; margin-bottom: 1rem;">🛒</div>
        <h3 style="margin-bottom: 0.5rem;">Your cart is empty</h3>
        <p>Add some products to get started!</p>
      </div>
    </div>

    <div class="cart-total" style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1.5rem;">
      <div class="total-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
        <span>Subtotal:</span>
        <span style="font-weight: 600;">$0.00</span>
      </div>
      <div class="total-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
        <span>Shipping:</span>
        <span style="font-weight: 600;">$0.00</span>
      </div>
      <div class="total-row" style="display: flex; justify-content: space-between; align-items: center; font-size: 1.2rem; font-weight: 700; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1rem; margin-top: 1rem;">
        <span>Total:</span>
        <span style="color: var(--fluent-accent-primary);">$0.00</span>
      </div>
    </div>

    <button class="primary large buttonGlow" style="width: 100%; margin-top: 1.5rem;" disabled>
      Proceed to Checkout
    </button>
  </div>
</section>

<script>
// Category filtering
document.querySelectorAll('.category-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // Remove active class from all buttons
        document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
        // Add active class to clicked button
        this.classList.add('active');

        const category = this.dataset.category;

        // Filter products
        document.querySelectorAll('.product-card').forEach(card => {
            if (category === 'all' || card.dataset.category === category) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});

// Add to cart functionality
document.querySelectorAll('.product-card button').forEach(btn => {
    btn.addEventListener('click', function() {
        const productCard = this.closest('.product-card');
        const productName = productCard.querySelector('h3').textContent;
        const productPrice = productCard.querySelector('.product-price span:first-child').textContent;

        // Show notification
        showNotification(`${productName} added to cart!`, 'success');

        // Here you would typically update the cart in your backend
        updateCartDisplay();
    });
});

function updateCartDisplay() {
    // This would update the cart summary with actual cart data
    // For now, just show a placeholder
    const cartEmpty = document.querySelector('.cart-empty');
    if (cartEmpty) {
        cartEmpty.innerHTML = `
            <div style="font-size: 3rem; margin-bottom: 1rem;">🛒</div>
            <h3 style="margin-bottom: 0.5rem;">Items in your cart</h3>
            <p>Checkout when you're ready!</p>
        `;
    }
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.style.cssText = `
    position: fixed;
    top: calc(var(--navbar-height, 56px) + 16px);
        right: 20px;
    background: ${type === 'success' ? 'var(--fluent-accent-primary)' : 'var(--fluent-accent-secondary)'};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    z-index: 1200;
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