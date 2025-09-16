/*
 * Shopping Cart - Handle cart operations and e-commerce functionality
 * Provides cart management, persistence, and checkout integration
 */

// Shopping Cart Manager
class ShoppingCartManager {
  constructor() {
    this.cart = [];
    this.cartKey = 'fitness_cart';
    this.init();
  }

  init() {
    this.loadCart();
    this.bindEvents();
    this.updateCartDisplay();
    this.setupCartPersistence();
  }

  bindEvents() {
    // Add to cart buttons
    document.addEventListener('click', (e) => {
      if (e.target.matches('.add-to-cart-btn') || e.target.closest('.add-to-cart-btn')) {
        e.preventDefault();
        const button = e.target.closest('.add-to-cart-btn');
        this.addToCartFromButton(button);
      }
    });

    // Remove from cart buttons
    document.addEventListener('click', (e) => {
      if (e.target.matches('.remove-from-cart') || e.target.closest('.remove-from-cart')) {
        e.preventDefault();
        const button = e.target.closest('.remove-from-cart');
        const itemId = button.dataset.itemId;
        this.removeFromCart(itemId);
      }
    });

    // Update quantity
    document.addEventListener('change', (e) => {
      if (e.target.matches('.cart-quantity')) {
        const input = e.target;
        const itemId = input.dataset.itemId;
        const quantity = parseInt(input.value);
        this.updateQuantity(itemId, quantity);
      }
    });

    // Quantity increment/decrement buttons
    document.addEventListener('click', (e) => {
      if (e.target.matches('.quantity-btn') || e.target.closest('.quantity-btn')) {
        e.preventDefault();
        const button = e.target.closest('.quantity-btn');
        const input = button.parentNode.querySelector('.cart-quantity');
        const itemId = input.dataset.itemId;
        const currentQty = parseInt(input.value);
        const delta = button.classList.contains('quantity-up') ? 1 : -1;
        const newQty = Math.max(1, currentQty + delta);
        input.value = newQty;
        this.updateQuantity(itemId, newQty);
      }
    });

    // Clear cart button
    document.addEventListener('click', (e) => {
      if (e.target.matches('.clear-cart-btn') || e.target.closest('.clear-cart-btn')) {
        e.preventDefault();
        this.clearCart();
      }
    });

    // Cart toggle (for mobile)
    const cartToggle = document.querySelector('.cart-toggle');
    if (cartToggle) {
      cartToggle.addEventListener('click', () => {
        this.toggleCart();
      });
    }

    // Checkout button
    document.addEventListener('click', (e) => {
      if (e.target.matches('.checkout-btn') || e.target.closest('.checkout-btn')) {
        e.preventDefault();
        this.proceedToCheckout();
      }
    });
  }

  addToCartFromButton(button) {
    const productData = {
      id: button.dataset.productId || Date.now().toString(),
      name: button.dataset.productName || 'Unknown Product',
      price: parseFloat(button.dataset.productPrice) || 0,
      image: button.dataset.productImage || '',
      category: button.dataset.productCategory || 'general',
      quantity: 1,
      addedAt: new Date().toISOString()
    };

    // Check for custom options
    const sizeSelect = button.closest('.product-card')?.querySelector('.product-size');
    if (sizeSelect) {
      productData.size = sizeSelect.value;
    }

    const colorSelect = button.closest('.product-card')?.querySelector('.product-color');
    if (colorSelect) {
      productData.color = colorSelect.value;
    }

    this.addToCart(productData);
  }

  addToCart(product) {
    // Check if item already exists
    const existingItem = this.cart.find(item =>
      item.id === product.id &&
      item.size === product.size &&
      item.color === product.color
    );

    if (existingItem) {
      existingItem.quantity += product.quantity || 1;
      existingItem.addedAt = new Date().toISOString();
    } else {
      this.cart.push({
        ...product,
        quantity: product.quantity || 1,
        addedAt: new Date().toISOString()
      });
    }

    this.saveCart();
    this.updateCartDisplay();
    this.showAddToCartFeedback(product);

    // Track add to cart event
    this.trackAddToCart(product);
  }

  removeFromCart(itemId) {
    this.cart = this.cart.filter(item => item.id !== itemId);
    this.saveCart();
    this.updateCartDisplay();
    this.showRemoveFromCartFeedback();
  }

  updateQuantity(itemId, quantity) {
    const item = this.cart.find(item => item.id === itemId);
    if (item) {
      item.quantity = Math.max(1, quantity);
      this.saveCart();
      this.updateCartDisplay();
    }
  }

  clearCart() {
    if (confirm('Are you sure you want to clear your cart?')) {
      this.cart = [];
      this.saveCart();
      this.updateCartDisplay();
      this.showClearCartFeedback();
    }
  }

  getCartTotal() {
    return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
  }

  getCartItemCount() {
    return this.cart.reduce((count, item) => count + item.quantity, 0);
  }

  saveCart() {
    localStorage.setItem(this.cartKey, JSON.stringify(this.cart));
  }

  loadCart() {
    try {
      const savedCart = localStorage.getItem(this.cartKey);
      if (savedCart) {
        this.cart = JSON.parse(savedCart);
        // Validate cart items
        this.cart = this.cart.filter(item =>
          item.id && item.name && typeof item.price === 'number' && item.quantity > 0
        );
      }
    } catch (error) {
      console.error('Failed to load cart:', error);
      this.cart = [];
    }
  }

  setupCartPersistence() {
    // Auto-save cart every 30 seconds
    setInterval(() => {
      this.saveCart();
    }, 30000);

    // Save on page unload
    window.addEventListener('beforeunload', () => {
      this.saveCart();
    });
  }

  updateCartDisplay() {
    this.updateCartCounter();
    this.updateCartItems();
    this.updateCartSummary();
    this.updateCartVisibility();
  }

  updateCartCounter() {
    const counters = document.querySelectorAll('.cart-counter');
    const itemCount = this.getCartItemCount();

    counters.forEach(counter => {
      counter.textContent = itemCount;
      counter.style.display = itemCount > 0 ? 'inline' : 'none';
    });
  }

  updateCartItems() {
    const cartItemsContainer = document.querySelector('.cart-items');
    if (!cartItemsContainer) return;

    if (this.cart.length === 0) {
      cartItemsContainer.innerHTML = `
        <div class="empty-cart">
          <i class="fas fa-shopping-cart"></i>
          <p>Your cart is empty</p>
          <a href="?page=shop" class="btn btn-primary">Continue Shopping</a>
        </div>
      `;
      return;
    }

    cartItemsContainer.innerHTML = this.cart.map(item => `
      <div class="cart-item" data-item-id="${item.id}">
        <div class="cart-item-image">
          <img src="${item.image || '/assets/images/placeholder.jpg'}" alt="${item.name}" onerror="this.src='/assets/images/placeholder.jpg'">
        </div>
        <div class="cart-item-details">
          <h4 class="cart-item-name">${item.name}</h4>
          <div class="cart-item-meta">
            ${item.size ? `<span class="cart-item-size">Size: ${item.size}</span>` : ''}
            ${item.color ? `<span class="cart-item-color">Color: ${item.color}</span>` : ''}
          </div>
          <div class="cart-item-price">$${item.price.toFixed(2)}</div>
        </div>
        <div class="cart-item-controls">
          <div class="quantity-controls">
            <button class="quantity-btn quantity-down" data-item-id="${item.id}">
              <i class="fas fa-minus"></i>
            </button>
            <input type="number" class="cart-quantity" data-item-id="${item.id}" value="${item.quantity}" min="1">
            <button class="quantity-btn quantity-up" data-item-id="${item.id}">
              <i class="fas fa-plus"></i>
            </button>
          </div>
          <div class="cart-item-total">$${(item.price * item.quantity).toFixed(2)}</div>
          <button class="remove-from-cart" data-item-id="${item.id}">
            <i class="fas fa-trash"></i>
          </button>
        </div>
      </div>
    `).join('');
  }

  updateCartSummary() {
    const subtotalElement = document.querySelector('.cart-subtotal');
    const taxElement = document.querySelector('.cart-tax');
    const totalElement = document.querySelector('.cart-total');

    const subtotal = this.getCartTotal();
    const tax = subtotal * 0.08; // 8% tax
    const total = subtotal + tax;

    if (subtotalElement) {
      subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
    }

    if (taxElement) {
      taxElement.textContent = `$${tax.toFixed(2)}`;
    }

    if (totalElement) {
      totalElement.textContent = `$${total.toFixed(2)}`;
    }
  }

  updateCartVisibility() {
    const cartContainer = document.querySelector('.cart-container');
    if (cartContainer) {
      cartContainer.classList.toggle('empty', this.cart.length === 0);
    }
  }

  toggleCart() {
    const cartSidebar = document.querySelector('.cart-sidebar');
    if (cartSidebar) {
      cartSidebar.classList.toggle('open');
    }
  }

  showAddToCartFeedback(product) {
    if (window.FitnessAPI && window.FitnessAPI.notifications) {
      window.FitnessAPI.notifications.success(`${product.name} added to cart!`);
    } else {
      this.snackbar(`${product.name} added to cart!`, 'success');
    }

    // Animate cart icon
    const cartIcon = document.querySelector('.cart-icon');
    if (cartIcon) {
      cartIcon.style.animation = 'bounce 0.5s ease';
      setTimeout(() => {
        cartIcon.style.animation = '';
      }, 500);
    }
  }

  showRemoveFromCartFeedback() {
    if (window.FitnessAPI && window.FitnessAPI.notifications) {
      window.FitnessAPI.notifications.info('Item removed from cart');
    } else {
      this.snackbar('Item removed from cart', 'info');
    }
  }

  showClearCartFeedback() {
    if (window.FitnessAPI && window.FitnessAPI.notifications) {
      window.FitnessAPI.notifications.info('Cart cleared');
    } else {
      this.snackbar('Cart cleared', 'info');
    }
  }

  // Modern snackbar (bottom-right) – not blocked by navbar and looks clean on both themes
  snackbar(message, type = 'info', timeout = 2600) {
    let container = document.querySelector('.snackbar-container');
    if (!container) {
      container = document.createElement('div');
      container.className = 'snackbar-container';
      document.body.appendChild(container);
    }

    const snack = document.createElement('div');
    snack.className = `snackbar ${type}`;
    const icon = type === 'success' ? '✅' : type === 'warning' ? '⚠️' : type === 'error' ? '⛔' : 'ℹ️';
    snack.innerHTML = `
      <div class="snack-icon">${icon}</div>
      <div class="snack-message">${message}</div>
      <button class="snack-close" aria-label="Close">&times;</button>
    `;
    container.appendChild(snack);

    const close = () => {
      snack.classList.add('hide');
      setTimeout(() => snack.remove(), 200);
    };
    snack.querySelector('.snack-close').addEventListener('click', close);
    setTimeout(close, timeout);
  }

  proceedToCheckout() {
    if (this.cart.length === 0) {
      this.showToast('Your cart is empty', 'warning');
      return;
    }

    // Save cart for checkout process
    sessionStorage.setItem('checkout_cart', JSON.stringify(this.cart));

    // Navigate to checkout
    window.location.href = '?page=checkout';
  }

  trackAddToCart(product) {
    // Track add to cart event
    if (window.gtag) {
      window.gtag('event', 'add_to_cart', {
        event_category: 'ecommerce',
        event_label: product.name,
        value: product.price
      });
    }

    // Store cart analytics
    const analytics = JSON.parse(localStorage.getItem('cart_analytics') || '{}');
    analytics.added = (analytics.added || 0) + 1;
    localStorage.setItem('cart_analytics', JSON.stringify(analytics));
  }

  // Cart synchronization with server
  async syncCartWithServer() {
    if (!window.FitnessAPI || !window.FitnessAPI.apiShim) return;

    const currentUser = window.FitnessAPI.apiShim.getCurrentUser();
    if (!currentUser) return;

    try {
      // Load server cart
      const response = await fetch('api/cart.php?action=get', {
        method: 'GET',
        credentials: 'include'
      });

      if (response.ok) {
        const serverCart = await response.json();

        if (serverCart && serverCart.items) {
          // Merge with local cart
          this.mergeCarts(serverCart.items);
        }
      }

      // Sync local cart to server
      await this.saveCartToServer();

    } catch (error) {
      console.error('Cart sync failed:', error);
    }
  }

  async saveCartToServer() {
    if (!window.FitnessAPI || !window.FitnessAPI.apiShim) return;

    try {
      const response = await fetch('api/cart.php?action=save', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ items: this.cart }),
        credentials: 'include'
      });

      if (!response.ok) {
        console.warn('Failed to save cart to server');
      }
    } catch (error) {
      console.error('Cart save to server failed:', error);
    }
  }

  mergeCarts(serverItems) {
    // Simple merge strategy: add server items not in local cart
    serverItems.forEach(serverItem => {
      const localItem = this.cart.find(item =>
        item.id === serverItem.id &&
        item.size === serverItem.size &&
        item.color === serverItem.color
      );

      if (!localItem) {
        this.cart.push(serverItem);
      } else {
        // Use the higher quantity
        localItem.quantity = Math.max(localItem.quantity, serverItem.quantity);
      }
    });

    this.saveCart();
    this.updateCartDisplay();
  }

  // Export cart data
  exportCart() {
    return {
      items: this.cart,
      total: this.getCartTotal(),
      itemCount: this.getCartItemCount(),
      exportDate: new Date().toISOString()
    };
  }

  // Import cart data
  importCart(cartData) {
    if (cartData && cartData.items) {
      this.cart = cartData.items;
      this.saveCart();
      this.updateCartDisplay();
    }
  }
}

// Initialize cart manager when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  // Initialize cart for pages that need it
  if (document.querySelector('.cart-container') ||
      document.querySelector('.add-to-cart-btn') ||
      document.querySelector('.cart-sidebar')) {
    window.shoppingCart = new ShoppingCartManager();
  }
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
  module.exports = ShoppingCartManager;
}