/*
 * Checkout System - Handle payment processing and order completion
 * Provides checkout flow, payment integration, and order management
 */

// Checkout Manager
class CheckoutManager {
  constructor() {
    this.cart = [];
    this.orderData = {
      billing: {},
      shipping: {},
      payment: {},
      items: []
    };
    this.currentStep = 1;
    this.init();
  }

  init() {
    this.loadCartData();
    this.bindEvents();
    this.initializeCheckout();
    this.setupFormValidation();
  }

  loadCartData() {
    // Try to load from session storage first (from cart page)
    const sessionCart = sessionStorage.getItem('checkout_cart');
    if (sessionCart) {
      this.cart = JSON.parse(sessionCart);
    } else if (window.shoppingCart) {
      // Fallback to shopping cart manager
      this.cart = window.shoppingCart.cart || [];
    } else {
      // Fallback to localStorage
      const savedCart = localStorage.getItem('fitness_cart');
      if (savedCart) {
        this.cart = JSON.parse(savedCart);
      }
    }

    if (this.cart.length === 0) {
      this.showEmptyCartMessage();
      return;
    }

    this.updateOrderSummary();
  }

  bindEvents() {
    // Step navigation
    document.addEventListener('click', (e) => {
      if (e.target.matches('.step-btn') || e.target.closest('.step-btn')) {
        e.preventDefault();
        const button = e.target.closest('.step-btn');
        const step = parseInt(button.dataset.step);
        this.navigateToStep(step);
      }
    });

    // Form submissions
    const billingForm = document.getElementById('billingForm');
    if (billingForm) {
      billingForm.addEventListener('submit', (e) => this.handleBillingSubmit(e));
    }

    const shippingForm = document.getElementById('shippingForm');
    if (shippingForm) {
      shippingForm.addEventListener('submit', (e) => this.handleShippingSubmit(e));
    }

    const paymentForm = document.getElementById('paymentForm');
    if (paymentForm) {
      paymentForm.addEventListener('submit', (e) => this.handlePaymentSubmit(e));
    }

    // Shipping method selection
    document.addEventListener('change', (e) => {
      if (e.target.name === 'shipping_method') {
        this.updateShippingCost(e.target.value);
      }
    });

    // Payment method selection
    document.addEventListener('change', (e) => {
      if (e.target.name === 'payment_method') {
        this.togglePaymentFields(e.target.value);
      }
    });

    // Same as billing checkbox
    const sameAsBilling = document.getElementById('sameAsBilling');
    if (sameAsBilling) {
      sameAsBilling.addEventListener('change', (e) => {
        this.toggleShippingAddress(e.target.checked);
      });
    }

    // Promo code
    const applyPromoBtn = document.querySelector('.apply-promo-btn');
    if (applyPromoBtn) {
      applyPromoBtn.addEventListener('click', () => this.applyPromoCode());
    }

    // Order review and submit
    const placeOrderBtn = document.getElementById('placeOrderBtn');
    if (placeOrderBtn) {
      placeOrderBtn.addEventListener('click', () => this.placeOrder());
    }
  }

  initializeCheckout() {
    this.updateStepIndicator();
    this.loadSavedData();
    this.updateOrderSummary();
  }

  navigateToStep(step) {
    if (step < 1 || step > 4) return;

    // Validate current step before proceeding
    if (step > this.currentStep && !this.validateCurrentStep()) {
      return;
    }

    this.currentStep = step;
    this.updateStepIndicator();
    this.showStepContent(step);
  }

  updateStepIndicator() {
    // Update step indicators
    const steps = document.querySelectorAll('.checkout-step');
    steps.forEach((stepEl, index) => {
      const stepNumber = index + 1;
      stepEl.classList.toggle('active', stepNumber === this.currentStep);
      stepEl.classList.toggle('completed', stepNumber < this.currentStep);
    });

    // Update step content visibility
    this.showStepContent(this.currentStep);
  }

  showStepContent(step) {
    const stepContents = document.querySelectorAll('.checkout-step-content');
    stepContents.forEach((content, index) => {
      content.style.display = (index + 1 === step) ? 'block' : 'none';
    });
  }

  validateCurrentStep() {
    switch (this.currentStep) {
      case 1:
        return this.validateBillingInfo();
      case 2:
        return this.validateShippingInfo();
      case 3:
        return this.validatePaymentInfo();
      default:
        return true;
    }
  }

  validateBillingInfo() {
    const requiredFields = ['firstName', 'lastName', 'email', 'phone', 'address', 'city', 'zipCode'];
    return this.validateFormFields('billingForm', requiredFields);
  }

  validateShippingInfo() {
    const sameAsBilling = document.getElementById('sameAsBilling')?.checked;
    if (sameAsBilling) {
      // Copy billing info to shipping
      this.copyBillingToShipping();
      return true;
    }

    const requiredFields = ['shippingFirstName', 'shippingLastName', 'shippingAddress', 'shippingCity', 'shippingZipCode'];
    return this.validateFormFields('shippingForm', requiredFields);
  }

  validatePaymentInfo() {
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;

    if (!paymentMethod) {
      this.showError('Please select a payment method');
      return false;
    }

    switch (paymentMethod) {
      case 'credit_card':
        return this.validateCreditCardFields();
      case 'paypal':
        return true; // PayPal validation handled by PayPal SDK
      case 'apple_pay':
        return true; // Apple Pay validation handled by system
      default:
        return false;
    }
  }

  validateCreditCardFields() {
    const requiredFields = ['cardNumber', 'expiryDate', 'cvv', 'cardName'];
    return this.validateFormFields('paymentForm', requiredFields);
  }

  validateFormFields(formId, fieldNames) {
    const form = document.getElementById(formId);
    if (!form) return false;

    let isValid = true;

    fieldNames.forEach(fieldName => {
      const field = form.querySelector(`[name="${fieldName}"]`);
      if (field && !field.value.trim()) {
        this.showFieldError(field, 'This field is required');
        isValid = false;
      } else if (field) {
        this.clearFieldError(field);
      }
    });

    return isValid;
  }

  handleBillingSubmit(e) {
    e.preventDefault();
    if (this.validateBillingInfo()) {
      this.saveBillingData();
      this.navigateToStep(2);
    }
  }

  handleShippingSubmit(e) {
    e.preventDefault();
    if (this.validateShippingInfo()) {
      this.saveShippingData();
      this.navigateToStep(3);
    }
  }

  handlePaymentSubmit(e) {
    e.preventDefault();
    if (this.validatePaymentInfo()) {
      this.savePaymentData();
      this.navigateToStep(4);
    }
  }

  saveBillingData() {
    const form = document.getElementById('billingForm');
    if (!form) return;

    const formData = new FormData(form);
    this.orderData.billing = {
      firstName: formData.get('firstName'),
      lastName: formData.get('lastName'),
      email: formData.get('email'),
      phone: formData.get('phone'),
      address: formData.get('address'),
      city: formData.get('city'),
      state: formData.get('state'),
      zipCode: formData.get('zipCode'),
      country: formData.get('country') || 'US'
    };

    localStorage.setItem('checkout_billing', JSON.stringify(this.orderData.billing));
  }

  saveShippingData() {
    const sameAsBilling = document.getElementById('sameAsBilling')?.checked;

    if (sameAsBilling) {
      this.orderData.shipping = { ...this.orderData.billing };
    } else {
      const form = document.getElementById('shippingForm');
      if (form) {
        const formData = new FormData(form);
        this.orderData.shipping = {
          firstName: formData.get('shippingFirstName'),
          lastName: formData.get('shippingLastName'),
          address: formData.get('shippingAddress'),
          city: formData.get('shippingCity'),
          state: formData.get('shippingState'),
          zipCode: formData.get('shippingZipCode'),
          country: formData.get('shippingCountry') || 'US'
        };
      }
    }

    localStorage.setItem('checkout_shipping', JSON.stringify(this.orderData.shipping));
  }

  savePaymentData() {
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
    this.orderData.payment = { method: paymentMethod };

    if (paymentMethod === 'credit_card') {
      const form = document.getElementById('paymentForm');
      if (form) {
        const formData = new FormData(form);
        this.orderData.payment = {
          ...this.orderData.payment,
          cardNumber: formData.get('cardNumber')?.replace(/\d(?=\d{4})/g, '*'),
          expiryDate: formData.get('expiryDate'),
          cardName: formData.get('cardName')
        };
      }
    }

    localStorage.setItem('checkout_payment', JSON.stringify(this.orderData.payment));
  }

  copyBillingToShipping() {
    if (!this.orderData.billing) return;

    this.orderData.shipping = { ...this.orderData.billing };

    // Update form fields
    const shippingForm = document.getElementById('shippingForm');
    if (shippingForm) {
      Object.entries(this.orderData.billing).forEach(([key, value]) => {
        const field = shippingForm.querySelector(`[name="shipping${key.charAt(0).toUpperCase() + key.slice(1)}"]`);
        if (field) {
          field.value = value;
        }
      });
    }
  }

  toggleShippingAddress(sameAsBilling) {
    const shippingSection = document.querySelector('.shipping-address-section');
    if (shippingSection) {
      shippingSection.style.display = sameAsBilling ? 'none' : 'block';
    }
  }

  updateShippingCost(method) {
    const costs = {
      standard: 5.99,
      express: 12.99,
      overnight: 24.99
    };

    this.orderData.shipping.method = method;
    this.orderData.shipping.cost = costs[method] || 0;

    this.updateOrderSummary();
  }

  togglePaymentFields(method) {
    // Hide all payment method fields
    const paymentFields = document.querySelectorAll('.payment-fields');
    paymentFields.forEach(field => field.style.display = 'none');

    // Show selected payment method fields
    const selectedFields = document.querySelector(`.${method}-fields`);
    if (selectedFields) {
      selectedFields.style.display = 'block';
    }
  }

  updateOrderSummary() {
    const summaryContainer = document.querySelector('.order-summary');
    if (!summaryContainer) return;

    const subtotal = this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    const shipping = this.orderData.shipping?.cost || 0;
    const tax = (subtotal + shipping) * 0.08; // 8% tax
    const discount = this.orderData.discount || 0;
    const total = subtotal + shipping + tax - discount;

    summaryContainer.innerHTML = `
      <div class="order-summary-header">
        <h3>Order Summary</h3>
      </div>
      <div class="order-items">
        ${this.cart.map(item => `
          <div class="order-item">
            <div class="item-info">
              <span class="item-name">${item.name}</span>
              <span class="item-quantity">Qty: ${item.quantity}</span>
            </div>
            <span class="item-price">$${(item.price * item.quantity).toFixed(2)}</span>
          </div>
        `).join('')}
      </div>
      <div class="order-totals">
        <div class="summary-row">
          <span>Subtotal:</span>
          <span>$${subtotal.toFixed(2)}</span>
        </div>
        <div class="summary-row">
          <span>Shipping:</span>
          <span>$${shipping.toFixed(2)}</span>
        </div>
        <div class="summary-row">
          <span>Tax:</span>
          <span>$${tax.toFixed(2)}</span>
        </div>
        ${discount > 0 ? `
          <div class="summary-row discount">
            <span>Discount:</span>
            <span>-$${discount.toFixed(2)}</span>
          </div>
        ` : ''}
        <div class="summary-row total">
          <span>Total:</span>
          <span>$${total.toFixed(2)}</span>
        </div>
      </div>
    `;

    this.orderData.totals = { subtotal, shipping, tax, discount, total };
  }

  applyPromoCode() {
    const promoInput = document.querySelector('.promo-code-input');
    const promoCode = promoInput?.value?.trim();

    if (!promoCode) {
      this.showError('Please enter a promo code');
      return;
    }

    // Simulate promo code validation
    const validCodes = {
      'WELCOME10': 0.1, // 10% off
      'FITNESS20': 0.2, // 20% off
      'SUMMER15': 0.15  // 15% off
    };

    const discount = validCodes[promoCode.toUpperCase()];
    if (discount) {
      const subtotal = this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
      this.orderData.discount = subtotal * discount;
      this.orderData.promoCode = promoCode.toUpperCase();
      this.updateOrderSummary();
      this.showSuccess(`Promo code applied! ${discount * 100}% off`);
    } else {
      this.showError('Invalid promo code');
    }
  }

  async placeOrder() {
    if (!this.validateOrderData()) {
      return;
    }

    this.setLoadingState(true);

    try {
      // Prepare order data
      const orderData = {
        ...this.orderData,
        items: this.cart,
        orderNumber: this.generateOrderNumber(),
        timestamp: new Date().toISOString(),
        status: 'processing'
      };

      // Submit order
      const response = await this.submitOrder(orderData);

      if (response.success) {
        this.showOrderSuccess(response.orderId);
        this.clearCheckoutData();
      } else {
        throw new Error(response.message || 'Order submission failed');
      }

    } catch (error) {
      console.error('Order placement failed:', error);
      this.showError(error.message || 'Failed to place order. Please try again.');
    } finally {
      this.setLoadingState(false);
    }
  }

  validateOrderData() {
    return this.orderData.billing &&
           this.orderData.shipping &&
           this.orderData.payment &&
           this.cart.length > 0;
  }

  async submitOrder(orderData) {
    // Try API first
    try {
      const response = await fetch('api/orders.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(orderData),
        credentials: 'include'
      });

      if (response.ok) {
        return await response.json();
      }
    } catch (error) {
      console.warn('API submission failed, using local storage:', error);
    }

    // Fallback to local storage
    return this.saveOrderLocally(orderData);
  }

  async saveOrderLocally(orderData) {
    const orders = JSON.parse(localStorage.getItem('pending_orders') || '[]');
    orders.push(orderData);
    localStorage.setItem('pending_orders', JSON.stringify(orders));

    return {
      success: true,
      orderId: orderData.orderNumber,
      message: 'Order saved locally and will be processed when online'
    };
  }

  generateOrderNumber() {
    const timestamp = Date.now();
    const random = Math.floor(Math.random() * 1000);
    return `FIT${timestamp}${random}`;
  }

  showOrderSuccess(orderId) {
    const successModal = document.createElement('div');
    successModal.className = 'order-success-modal';
    successModal.innerHTML = `
      <div class="modal-content">
        <div class="success-icon">
          <i class="fas fa-check-circle"></i>
        </div>
        <h2>Order Placed Successfully!</h2>
        <p>Your order number is: <strong>${orderId}</strong></p>
        <p>You will receive a confirmation email shortly.</p>
        <div class="modal-actions">
          <button class="btn btn-primary" onclick="window.location.href='?page=home'">Continue Shopping</button>
          <button class="btn btn-secondary" onclick="window.print()">Print Receipt</button>
        </div>
      </div>
    `;

    document.body.appendChild(successModal);

    // Track order completion
    this.trackOrderCompletion(orderId);
  }

  clearCheckoutData() {
    // Clear cart
    if (window.shoppingCart) {
      window.shoppingCart.clearCart();
    }
    localStorage.removeItem('fitness_cart');
    sessionStorage.removeItem('checkout_cart');

    // Clear checkout data
    localStorage.removeItem('checkout_billing');
    localStorage.removeItem('checkout_shipping');
    localStorage.removeItem('checkout_payment');
  }

  loadSavedData() {
    // Load saved billing data
    const billingData = localStorage.getItem('checkout_billing');
    if (billingData) {
      this.orderData.billing = JSON.parse(billingData);
      this.populateFormFields('billingForm', this.orderData.billing);
    }

    // Load saved shipping data
    const shippingData = localStorage.getItem('checkout_shipping');
    if (shippingData) {
      this.orderData.shipping = JSON.parse(shippingData);
      this.populateFormFields('shippingForm', this.orderData.shipping, 'shipping');
    }

    // Load saved payment data
    const paymentData = localStorage.getItem('checkout_payment');
    if (paymentData) {
      this.orderData.payment = JSON.parse(paymentData);
    }
  }

  populateFormFields(formId, data, prefix = '') {
    const form = document.getElementById(formId);
    if (!form) return;

    Object.entries(data).forEach(([key, value]) => {
      const fieldName = prefix + key.charAt(0).toUpperCase() + key.slice(1);
      const field = form.querySelector(`[name="${fieldName}"]`);
      if (field) {
        field.value = value;
      }
    });
  }

  showEmptyCartMessage() {
    const checkoutContainer = document.querySelector('.checkout-container');
    if (checkoutContainer) {
      checkoutContainer.innerHTML = `
        <div class="empty-checkout">
          <i class="fas fa-shopping-cart"></i>
          <h2>Your cart is empty</h2>
          <p>Add some items to your cart before proceeding to checkout.</p>
          <a href="?page=shop" class="btn btn-primary">Continue Shopping</a>
        </div>
      `;
    }
  }

  showFieldError(field, message) {
    this.clearFieldError(field);
    field.classList.add('error');

    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.textContent = message;
    errorDiv.style.cssText = 'color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem;';

    field.parentNode.appendChild(errorDiv);
  }

  clearFieldError(field) {
    field.classList.remove('error');
    const errorDiv = field.parentNode.querySelector('.field-error');
    if (errorDiv) {
      errorDiv.remove();
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

    document.body.appendChild(toast);

    const closeBtn = toast.querySelector('.toast-close');
    closeBtn.addEventListener('click', () => toast.remove());

    setTimeout(() => {
      if (toast.parentNode) {
        toast.parentNode.removeChild(toast);
      }
    }, 5000);
  }

  setLoadingState(isLoading) {
    const submitBtn = document.getElementById('placeOrderBtn');
    if (submitBtn) {
      submitBtn.disabled = isLoading;
      submitBtn.innerHTML = isLoading ?
        '<i class="fas fa-spinner fa-spin"></i> Processing...' :
        'Place Order';
    }
  }

  trackOrderCompletion(orderId) {
    // Track order completion
    if (window.gtag) {
      window.gtag('event', 'purchase', {
        event_category: 'ecommerce',
        transaction_id: orderId,
        value: this.orderData.totals?.total || 0,
        currency: 'USD'
      });
    }

    // Store order analytics
    const analytics = JSON.parse(localStorage.getItem('order_analytics') || '{}');
    analytics.completed = (analytics.completed || 0) + 1;
    localStorage.setItem('order_analytics', JSON.stringify(analytics));
  }

  setupFormValidation() {
    // Credit card validation
    const cardNumberInput = document.getElementById('cardNumber');
    if (cardNumberInput) {
      cardNumberInput.addEventListener('input', (e) => {
        this.formatCardNumber(e.target);
      });
    }

    const expiryInput = document.getElementById('expiryDate');
    if (expiryInput) {
      expiryInput.addEventListener('input', (e) => {
        this.formatExpiryDate(e.target);
      });
    }

    const cvvInput = document.getElementById('cvv');
    if (cvvInput) {
      cvvInput.addEventListener('input', (e) => {
        this.limitCvvLength(e.target);
      });
    }
  }

  formatCardNumber(input) {
    let value = input.value.replace(/\D/g, '');
    value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
    input.value = value;
  }

  formatExpiryDate(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length >= 2) {
      value = value.substring(0, 2) + '/' + value.substring(2, 4);
    }
    input.value = value;
  }

  limitCvvLength(input) {
    let value = input.value.replace(/\D/g, '');
    input.value = value.substring(0, 4);
  }
}

// Initialize checkout manager when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  // Initialize checkout for checkout page
  if (document.querySelector('.checkout-container') ||
      document.getElementById('billingForm') ||
      document.getElementById('shippingForm') ||
      document.getElementById('paymentForm')) {
    window.checkoutManager = new CheckoutManager();
  }
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
  module.exports = CheckoutManager;
}