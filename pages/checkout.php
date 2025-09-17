<?php
// CHECKOUT PAGE
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? 'Guest';
$userEmail = $_SESSION['user_email'] ?? '';
?>
<section id="checkout" class="section checkout active" aria-label="Checkout" tabindex="0">
  <!-- Page Header -->
  <div class="page-header glass-card" style="padding: 2rem; margin-bottom: 2rem; text-align: center;">
    <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
      Complete Your Purchase
    </h1>
    <p style="color: var(--fluent-text-secondary); font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
      Secure checkout process with multiple payment options. Your information is protected with bank-level security.
    </p>
  </div>

  <!-- Checkout Progress -->
  <div class="checkout-progress glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem;">
    <div class="progress-steps" style="display: flex; align-items: center; justify-content: space-between; max-width: 600px; margin: 0 auto;">
      <div class="progress-step completed" style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem;">
        <div class="step-circle" style="width: 40px; height: 40px; border-radius: 50%; background: var(--fluent-accent-primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">1</div>
        <div class="step-label" style="font-size: 0.9rem; font-weight: 600; color: var(--fluent-accent-primary);">Cart</div>
      </div>
      <div class="progress-line" style="flex: 1; height: 2px; background: var(--fluent-accent-primary); margin: 0 1rem;"></div>
      <div class="progress-step active" style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem;">
        <div class="step-circle" style="width: 40px; height: 40px; border-radius: 50%; background: var(--fluent-accent-primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">2</div>
        <div class="step-label" style="font-size: 0.9rem; font-weight: 600; color: var(--fluent-accent-primary);">Checkout</div>
      </div>
      <div class="progress-line" style="flex: 1; height: 2px; background: rgba(255,255,255,0.2); margin: 0 1rem;"></div>
      <div class="progress-step" style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem;">
        <div class="step-circle" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; color: var(--fluent-text-secondary); font-weight: 600;">3</div>
        <div class="step-label" style="font-size: 0.9rem; font-weight: 600; color: var(--fluent-text-secondary);">Confirmation</div>
      </div>
    </div>
  </div>

  <!-- Checkout Container -->
  <div class="checkout-container" style="display: grid; grid-template-columns: 1fr 400px; gap: 2rem; max-width: 1200px; margin: 0 auto;">
    <!-- Main Checkout Form -->
    <div class="checkout-main">
      <!-- Contact Information -->
      <div class="checkout-section glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem;">
        <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">Contact Information</h3>

        <div class="form-group">
          <label for="email" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Email Address *</label>
          <input type="email" id="email" name="email" required placeholder="your.email@example.com" style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;" value="<?php echo htmlspecialchars($userEmail); ?>">
        </div>
      </div>

      <!-- Shipping Information -->
      <div class="checkout-section glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem;">
        <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">Shipping Information</h3>

        <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
          <div class="form-group">
            <label for="firstName" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">First Name *</label>
            <input type="text" id="firstName" name="firstName" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
          </div>
          <div class="form-group">
            <label for="lastName" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Last Name *</label>
            <input type="text" id="lastName" name="lastName" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
          </div>
        </div>

        <div class="form-group" style="margin-bottom: 1rem;">
          <label for="address" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Street Address *</label>
          <input type="text" id="address" name="address" required placeholder="123 Main Street" style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
        </div>

        <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
          <div class="form-group">
            <label for="city" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">City *</label>
            <input type="text" id="city" name="city" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
          </div>
          <div class="form-group">
            <label for="state" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">State/Province *</label>
            <input type="text" id="state" name="state" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
          </div>
        </div>

        <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          <div class="form-group">
            <label for="zipCode" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">ZIP/Postal Code *</label>
            <input type="text" id="zipCode" name="zipCode" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
          </div>
          <div class="form-group">
            <label for="country" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Country *</label>
            <select id="country" name="country" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
              <option value="">Select Country</option>
              <option value="US">United States</option>
              <option value="CA">Canada</option>
              <option value="UK">United Kingdom</option>
              <option value="AU">Australia</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Payment Information -->
      <div class="checkout-section glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem;">
        <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">Payment Information</h3>

        <!-- Payment Method Selection -->
        <div class="payment-methods" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
          <label class="payment-method" style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem; border: 2px solid rgba(255,255,255,0.2); border-radius: 12px; cursor: pointer; transition: all 0.3s ease;">
            <input type="radio" name="paymentMethod" value="card" checked style="margin: 0;">
            <div class="method-info">
              <div style="font-weight: 600; margin-bottom: 0.25rem;">Credit Card</div>
              <div style="font-size: 0.8rem; color: var(--fluent-text-secondary);">Visa, MasterCard, Amex</div>
            </div>
          </label>
          <label class="payment-method" style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem; border: 2px solid rgba(255,255,255,0.2); border-radius: 12px; cursor: pointer; transition: all 0.3s ease;">
            <input type="radio" name="paymentMethod" value="paypal" style="margin: 0;">
            <div class="method-info">
              <div style="font-weight: 600; margin-bottom: 0.25rem;">PayPal</div>
              <div style="font-size: 0.8rem; color: var(--fluent-text-secondary);">Fast & Secure</div>
            </div>
          </label>
          <label class="payment-method" style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem; border: 2px solid rgba(255,255,255,0.2); border-radius: 12px; cursor: pointer; transition: all 0.3s ease;">
            <input type="radio" name="paymentMethod" value="apple" style="margin: 0;">
            <div class="method-info">
              <div style="font-weight: 600; margin-bottom: 0.25rem;">Apple Pay</div>
              <div style="font-size: 0.8rem; color: var(--fluent-text-secondary);">Touch ID Required</div>
            </div>
          </label>
        </div>

        <!-- Card Information -->
        <div id="cardInfo" class="card-info">
          <div class="form-group" style="margin-bottom: 1rem;">
            <label for="cardNumber" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Card Number *</label>
            <div class="input-container" style="position: relative;">
              <input type="text" id="cardNumber" name="cardNumber" required placeholder="1234 5678 9012 3456" maxlength="19" style="width: 100%; padding: 1rem 4rem 1rem 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
              <div class="card-icons" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); display: flex; gap: 0.25rem;">
                <div class="card-icon visa" style="width: 24px; height: 16px; background: #1A1F71; border-radius: 2px; display: flex; align-items: center; justify-content: center; font-size: 8px; color: white; font-weight: 600;">V</div>
                <div class="card-icon mastercard" style="width: 24px; height: 16px; background: linear-gradient(135deg, #EB001B, #F79E1B); border-radius: 2px; display: flex; align-items: center; justify-content: center; font-size: 8px; color: white; font-weight: 600;">M</div>
              </div>
            </div>
          </div>

          <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
            <div class="form-group">
              <label for="expiryDate" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Expiry Date *</label>
              <input type="text" id="expiryDate" name="expiryDate" required placeholder="MM/YY" maxlength="5" style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
            </div>
            <div class="form-group">
              <label for="cvv" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">CVV *</label>
              <input type="text" id="cvv" name="cvv" required placeholder="123" maxlength="4" style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
            </div>
          </div>

          <div class="form-group" style="margin-bottom: 1rem;">
            <label for="cardName" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Name on Card *</label>
            <input type="text" id="cardName" name="cardName" required placeholder="John Doe" style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
          </div>
        </div>

        <!-- PayPal Placeholder -->
        <div id="paypalInfo" class="paypal-info" style="display: none; text-align: center; padding: 2rem;">
          <div style="font-size: 3rem; margin-bottom: 1rem;">🅿️</div>
          <p style="color: var(--fluent-text-secondary); margin-bottom: 1rem;">You'll be redirected to PayPal to complete your payment securely.</p>
          <button class="primary buttonGlow" style="padding: 1rem 2rem;">Continue with PayPal</button>
        </div>

        <!-- Apple Pay Placeholder -->
        <div id="applePayInfo" class="apple-pay-info" style="display: none; text-align: center; padding: 2rem;">
          <div style="font-size: 3rem; margin-bottom: 1rem;">📱</div>
          <p style="color: var(--fluent-text-secondary); margin-bottom: 1rem;">Complete your purchase with Apple Pay for instant checkout.</p>
          <button class="primary buttonGlow" style="padding: 1rem 2rem;">Pay with Apple Pay</button>
        </div>
      </div>

      <!-- Billing Address -->
      <div class="checkout-section glass-card widgetMorph" style="padding: 2rem;">
        <div class="billing-toggle" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
          <input type="checkbox" id="sameAsShipping" name="sameAsShipping" checked style="margin: 0;">
          <label for="sameAsShipping" style="font-weight: 600; cursor: pointer;">Billing address is the same as shipping</label>
        </div>

        <div id="billingAddress" class="billing-address" style="display: none;">
          <h4 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 1rem;">Billing Address</h4>

          <div class="form-group" style="margin-bottom: 1rem;">
            <label for="billingAddress" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Street Address *</label>
            <input type="text" id="billingAddressInput" name="billingAddress" placeholder="123 Main Street" style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
          </div>

          <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
              <label for="billingCity" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">City *</label>
              <input type="text" id="billingCity" name="billingCity" style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
            </div>
            <div class="form-group">
              <label for="billingState" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">State/Province *</label>
              <input type="text" id="billingState" name="billingState" style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Order Summary Sidebar -->
    <div class="checkout-sidebar">
      <div class="order-summary glass-card widgetMorph" style="padding: 2rem; position: sticky; top: 2rem;">
        <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">Order Summary</h3>

        <!-- Order Items (dynamic) -->
        <div class="order-items" id="orderItems" style="margin-bottom: 2rem;"></div>

        <!-- Order Totals -->
        <div class="order-totals" style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1.5rem;">
          <div class="total-row" style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
            <span style="color: var(--fluent-text-secondary);">Subtotal</span>
            <span id="subtotal" style="font-weight: 600;">$0.00</span>
          </div>
          <div class="total-row" style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
            <span style="color: var(--fluent-text-secondary);">Shipping</span>
            <span id="shipping" style="font-weight: 600;">$0.00</span>
          </div>
          <div class="total-row" style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
            <span style="color: var(--fluent-text-secondary);">Tax</span>
            <span id="tax" style="font-weight: 600;">$0.00</span>
          </div>
          <div class="total-row" style="display: flex; justify-content: space-between; font-size: 1.2rem; font-weight: 700; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.2);">
            <span>Total</span>
            <span id="grandTotal" style="color: var(--fluent-accent-primary);">$0.00</span>
          </div>
        </div>

        <!-- Promo Code -->
        <div class="promo-code" style="margin: 1.5rem 0;">
          <div class="promo-input" style="display: flex; gap: 0.5rem;">
            <input type="text" placeholder="Promo code" style="flex: 1; padding: 0.75rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 0.9rem;">
            <button class="secondary small" style="padding: 0.75rem 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-weight: 600; cursor: pointer;">Apply</button>
          </div>
        </div>

        <!-- Checkout Button -->
  <button type="submit" form="checkoutForm" class="primary large buttonGlow" id="completeOrderButton" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-top: 1rem;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px;">
            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
            <line x1="1" y1="10" x2="23" y2="10"/>
          </svg>
          <span id="completeOrderLabel">Complete Order - $0.00</span>
        </button>

        <!-- Security Notice -->
        <div class="security-notice" style="text-align: center; margin-top: 1rem; padding: 1rem; background: rgba(16, 185, 129, 0.1); border-radius: 8px;">
          <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-bottom: 0.5rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px; color: #10b981;">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>
            <span style="font-weight: 600; color: #10b981; font-size: 0.9rem;">Secure Checkout</span>
          </div>
          <p style="color: var(--fluent-text-secondary); font-size: 0.8rem; line-height: 1.4;">
            Your payment information is encrypted and secure. We never store your card details.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
// Checkout form handling
document.addEventListener('DOMContentLoaded', function() {
    // Render order summary from cart
    function loadCart() {
        try {
            return JSON.parse(localStorage.getItem('fitness_cart') || '[]');
        } catch { return []; }
    }

    function money(n){ return `$${(n||0).toFixed(2)}`; }

    function renderOrderSummary() {
        const items = loadCart();
        const list = document.getElementById('orderItems');
        if (!list) return;
        if (items.length === 0) {
            list.innerHTML = `
              <div style="text-align:center; color: var(--fluent-text-secondary); padding:1rem 0;">Your cart is empty. Add items from the <a href='?page=shop'>Shop</a>.</div>
            `;
        } else {
            list.innerHTML = items.map(it => `
              <div class="order-item" style="display:flex; align-items:center; gap:1rem; padding:1rem 0; border-bottom:1px solid rgba(255,255,255,0.1);">
                <div class="item-image" style="width:60px; height:60px; background: var(--glass-bg, rgba(255,255,255,0.06)); border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:1.1rem;">
                  ${it.category === 'equipment' ? '🏋️' : it.category === 'supplements' ? '💊' : it.category === 'apparel' ? '👕' : '🛍️'}
                </div>
                <div class="item-details" style="flex:1;">
                  <div style="font-weight:600; margin-bottom:0.25rem;">${it.name}</div>
                  <div style="color: var(--fluent-text-secondary); font-size:0.9rem;">${it.size ? `Size: ${it.size} ` : ''}${it.color ? `Color: ${it.color} ` : ''}× ${it.quantity || 1}</div>
                </div>
                <div class="item-price" style="font-weight:600; color: var(--fluent-accent-primary);">${money((it.price||0) * (it.quantity||1))}</div>
              </div>
            `).join('');
        }

        // totals
        const subtotal = items.reduce((s, it) => s + (it.price||0) * (it.quantity||1), 0);
        const shipping = items.length ? 9.99 : 0;
        const tax = +(subtotal * 0.084).toFixed(2);
        const total = subtotal + shipping + tax;

        const el = id => document.getElementById(id);
        if (el('subtotal')) el('subtotal').textContent = money(subtotal);
        if (el('shipping')) el('shipping').textContent = money(shipping);
        if (el('tax')) el('tax').textContent = money(tax);
        if (el('grandTotal')) el('grandTotal').textContent = money(total);
        if (el('completeOrderLabel')) el('completeOrderLabel').textContent = `Complete Order - ${money(total)}`;
    }

    renderOrderSummary();
    window.addEventListener('storage', (e)=>{ if (e.key === 'fitness_cart') renderOrderSummary(); });
    window.addEventListener('cart:updated', renderOrderSummary);
    // Payment method switching
    document.querySelectorAll('input[name="paymentMethod"]').forEach(radio => {
        radio.addEventListener('change', function() {
            // Hide all payment info sections
            document.getElementById('cardInfo').style.display = 'none';
            document.getElementById('paypalInfo').style.display = 'none';
            document.getElementById('applePayInfo').style.display = 'none';

            // Show selected payment info
            if (this.value === 'card') {
                document.getElementById('cardInfo').style.display = 'block';
            } else if (this.value === 'paypal') {
                document.getElementById('paypalInfo').style.display = 'block';
            } else if (this.value === 'apple') {
                document.getElementById('applePayInfo').style.display = 'block';
            }

            // Update payment method styling
            document.querySelectorAll('.payment-method').forEach(method => {
                method.style.borderColor = 'rgba(255,255,255,0.2)';
            });
            this.closest('.payment-method').style.borderColor = 'var(--fluent-accent-primary)';
        });
    });

    // Card number formatting
    document.getElementById('cardNumber').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
        let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
        e.target.value = formattedValue;
    });

    // Expiry date formatting
    document.getElementById('expiryDate').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 2) {
            value = value.substring(0, 2) + '/' + value.substring(2, 4);
        }
        e.target.value = value;
    });

    // CVV validation
    document.getElementById('cvv').addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\D/g, '');
    });

    // Billing address toggle
    document.getElementById('sameAsShipping').addEventListener('change', function() {
        const billingAddress = document.getElementById('billingAddress');
        if (this.checked) {
            billingAddress.style.display = 'none';
        } else {
            billingAddress.style.display = 'block';
        }
    });

    // Form submission
    const checkoutForm = document.createElement('form');
    checkoutForm.id = 'checkoutForm';
    checkoutForm.style.display = 'none';
    document.body.appendChild(checkoutForm);

  checkoutForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Show loading state
        const button = document.getElementById('completeOrderButton');
        const originalText = button.innerHTML;
        button.innerHTML = '<span>Processing...</span>';
        button.disabled = true;

    // Secure CMD-style animation, then redirect
    startSecurePaymentBoot('Fitness Club • Secure Payment', [
      'Initializing payment gateway…',
      'Encrypting payload (AES-256)…',
      'Authorizing transaction…',
      'Finalizing order…'
    ], () => {
      // Reset button
      button.innerHTML = originalText;
      button.disabled = false;
      window.location.href = 'index.php?page=confirmation';
    });
    });
});

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.style.cssText = `
        position: fixed;
    top: calc(var(--navbar-height, 56px) + 16px);
        right: 20px;
        background: ${type === 'success' ? 'var(--fluent-accent-primary)' : type === 'error' ? '#ef4444' : 'var(--fluent-accent-secondary)'};
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
    }, 5000);
}

// Form validation
function validateCheckoutForm() {
    const requiredFields = [
        'email', 'firstName', 'lastName', 'address', 'city', 'state', 'zipCode', 'country'
    ];

    let isValid = true;

    requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (!field.value.trim()) {
            showFieldError(field, 'This field is required');
            isValid = false;
        } else {
            clearFieldError(field);
        }
    });

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const emailField = document.getElementById('email');
    if (emailField.value && !emailRegex.test(emailField.value)) {
        showFieldError(emailField, 'Please enter a valid email address');
        isValid = false;
    }

    // Card validation if card payment is selected
    const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
    if (paymentMethod === 'card') {
        const cardFields = ['cardNumber', 'expiryDate', 'cvv', 'cardName'];
        cardFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (!field.value.trim()) {
                showFieldError(field, 'This field is required');
                isValid = false;
            } else {
                clearFieldError(field);
            }
        });
    }

    return isValid;
}

function showFieldError(field, message) {
    clearFieldError(field);

    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.style.cssText = `
        color: #ef4444;
        font-size: 0.8rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    `;
    errorDiv.innerHTML = `
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
            <circle cx="12" cy="12" r="10"/>
            <line x1="15" y1="9" x2="9" y2="15"/>
            <line x1="9" y1="9" x2="15" y2="15"/>
        </svg>
        ${message}
    `;

    field.parentElement.appendChild(errorDiv);
    field.style.borderColor = '#ef4444';
}

function clearFieldError(field) {
    const existingError = field.parentElement.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
    field.style.borderColor = 'rgba(255,255,255,0.2)';
}

// Secure payment CMD-style overlay
function startSecurePaymentBoot(title, lines, onDone) {
  // Create overlay lazily if needed
  let overlay = document.getElementById('secureBootOverlay');
  if (!overlay) {
    overlay = document.createElement('div');
    overlay.id = 'secureBootOverlay';
    overlay.className = 'boot-overlay';
    overlay.style.display = 'none';
    overlay.innerHTML = `
      <div class="boot-card glass-card" role="dialog" aria-modal="true" style="background: linear-gradient(180deg, rgba(10,40,22,0.70), rgba(6,18,12,0.82)); border: 1px solid rgba(16,185,129,0.35); border-radius: 20px; padding: 3rem; max-width: 520px; width: 90%; text-align: center; box-shadow: 0 22px 50px rgba(0,0,0,0.35);">
        <div class="boot-logo" style="font-size: 1.3rem; font-weight: 700; color: #a7f3d0; margin-bottom: 1.5rem;">Secure Payment</div>
        <div class="cmd-window glass-card" style="background: #07150f; border: 1px solid rgba(16,185,129,0.35); border-radius: 12px; padding: 1.25rem; margin-bottom: 1.2rem; font-family: 'Courier New', monospace; text-align: left; color: #a7f3d0;">
          <pre id="secureCmdOutput" style="margin: 0; font-size: 0.92rem; line-height: 1.45;"></pre>
        </div>
        <div class="boot-progress" aria-hidden="true" style="margin-top: 0.5rem;">
          <div class="boot-progress-bar" style="height: 8px; background: rgba(16,185,129,0.22); border-radius: 4px; overflow: hidden;">
            <div id="secureBootProgressFill" style="width: 0%; height: 100%; background: linear-gradient(90deg, #10b981, #34d399); border-radius: 4px; transition: width 0.3s ease;"></div>
          </div>
        </div>
      </div>`;
    document.body.appendChild(overlay);
  }

  // Open overlay
  overlay.setAttribute('aria-hidden', 'false');
  overlay.style.display = 'flex';
  requestAnimationFrame(() => { overlay.style.opacity = '1'; });

  // Title
  const headerEl = overlay.querySelector('.boot-logo');
  if (headerEl && title) headerEl.textContent = title;

  // Reset content
  const cmd = overlay.querySelector('#secureCmdOutput');
  const bar = overlay.querySelector('#secureBootProgressFill');
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
      setTimeout(step, 420);
    } else {
      setTimeout(() => {
        overlay.style.opacity = '0';
        setTimeout(() => {
          overlay.setAttribute('aria-hidden', 'true');
          overlay.style.display = 'none';
          if (typeof onDone === 'function') onDone();
        }, 280);
      }, 520);
    }
  }
  setTimeout(step, 320);
}
</script>