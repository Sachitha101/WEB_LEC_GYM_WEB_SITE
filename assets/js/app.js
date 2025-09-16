/*
 * Main Application - Fitness Club UI and Core Functionality
 * Handles navigation, UI interactions, and application state
 */

// Application configuration
const APP_CONFIG = {
  name: 'Fitness Club',
  version: '1.0.0',
  theme: 'fluent',
  animations: {
    duration: 300,
    easing: 'cubic-bezier(0.4, 0, 0.2, 1)'
  }
};

// Application state management
class AppState {
  constructor() {
    this.currentUser = null;
    this.currentPage = 'home';
    this.theme = localStorage.getItem('fitness_theme') || 'light';
    this.notifications = [];
    this.cart = [];
    this.listeners = {};
  }

  // User management
  setCurrentUser(user) {
    this.currentUser = user;
    localStorage.setItem('fitness_user', JSON.stringify(user));
    this.emit('userChanged', user);
  }

  getCurrentUser() {
    if (!this.currentUser) {
      const stored = localStorage.getItem('fitness_user');
      if (stored) {
        this.currentUser = JSON.parse(stored);
      }
    }
    return this.currentUser;
  }

  logout() {
    this.currentUser = null;
    localStorage.removeItem('fitness_user');
    localStorage.removeItem('fitness_session');
    this.emit('userChanged', null);
  }

  // Page management
  setCurrentPage(page) {
    this.currentPage = page;
    this.emit('pageChanged', page);
    this.updateNavigation(page);
  }

  getCurrentPage() {
    return this.currentPage;
  }

  // Theme management
  setTheme(theme) {
    this.theme = theme;
    localStorage.setItem('fitness_theme', theme);
    document.documentElement.setAttribute('data-theme', theme);
    this.emit('themeChanged', theme);
  }

  getTheme() {
    return this.theme;
  }

  toggleTheme() {
    const newTheme = this.theme === 'light' ? 'dark' : 'light';
    this.setTheme(newTheme);
  }

  // Cart management
  addToCart(item) {
    this.cart.push(item);
    this.emit('cartChanged', this.cart);
    this.saveCart();
  }

  removeFromCart(itemId) {
    this.cart = this.cart.filter(item => item.id !== itemId);
    this.emit('cartChanged', this.cart);
    this.saveCart();
  }

  getCart() {
    return this.cart;
  }

  clearCart() {
    this.cart = [];
    this.emit('cartChanged', this.cart);
    this.saveCart();
  }

  saveCart() {
    localStorage.setItem('fitness_cart', JSON.stringify(this.cart));
  }

  loadCart() {
    const stored = localStorage.getItem('fitness_cart');
    if (stored) {
      this.cart = JSON.parse(stored);
    }
  }

  // Event system
  on(event, callback) {
    if (!this.listeners[event]) {
      this.listeners[event] = [];
    }
    this.listeners[event].push(callback);
  }

  off(event, callback) {
    if (this.listeners[event]) {
      this.listeners[event] = this.listeners[event].filter(cb => cb !== callback);
    }
  }

  emit(event, data) {
    if (this.listeners[event]) {
      this.listeners[event].forEach(callback => callback(data));
    }
  }

  // Navigation update
  updateNavigation(activePage) {
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
      link.classList.remove('active');
      if (link.getAttribute('data-page') === activePage) {
        link.classList.add('active');
      }
    });
  }
}

// UI Utilities
class UIUtils {
  static showLoading(element, text = 'Loading...') {
    if (typeof element === 'string') {
      element = document.querySelector(element);
    }

    if (!element) return;

    element.innerHTML = `
      <div class="loading-spinner">
        <div class="spinner"></div>
        <div class="loading-text">${text}</div>
      </div>
    `;
  }

  static hideLoading(element) {
    if (typeof element === 'string') {
      element = document.querySelector(element);
    }

    if (!element) return;

    const spinner = element.querySelector('.loading-spinner');
    if (spinner) {
      spinner.remove();
    }
  }

  static showMessage(message, type = 'info', duration = 5000) {
    if (window.FitnessAPI && window.FitnessAPI.notifications) {
      window.FitnessAPI.notifications.show(message, type, duration);
    } else {
      // Fallback notification
      this.createToast(message, type, duration);
    }
  }

  static createToast(message, type = 'info', duration = 5000) {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
      <div class="toast-content">
        <span class="toast-message">${message}</span>
        <button class="toast-close">&times;</button>
      </div>
    `;

    // Add styles
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

    // Close button
    const closeBtn = toast.querySelector('.toast-close');
    closeBtn.addEventListener('click', () => this.removeToast(toast));

    // Auto remove
    if (duration > 0) {
      setTimeout(() => this.removeToast(toast), duration);
    }
  }

  static removeToast(toast) {
    toast.style.animation = 'slideOutRight 0.3s ease-in';
    setTimeout(() => {
      if (toast.parentNode) {
        toast.parentNode.removeChild(toast);
      }
    }, 300);
  }

  static animateElement(element, animation, duration = 300) {
    if (typeof element === 'string') {
      element = document.querySelector(element);
    }

    if (!element) return;

    element.style.animation = `${animation} ${duration}ms ease-out`;
    setTimeout(() => {
      element.style.animation = '';
    }, duration);
  }

  static scrollToElement(element, offset = 0) {
    if (typeof element === 'string') {
      element = document.querySelector(element);
    }

    if (!element) return;

    const elementTop = element.getBoundingClientRect().top + window.pageYOffset;
    window.scrollTo({
      top: elementTop - offset,
      behavior: 'smooth'
    });
  }

  static formatCurrency(amount, currency = 'USD') {
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: currency
    }).format(amount);
  }

  static formatDate(date, options = {}) {
    const defaultOptions = {
      year: 'numeric',
      month: 'short',
      day: 'numeric'
    };

    return new Date(date).toLocaleDateString('en-US', { ...defaultOptions, ...options });
  }

  static debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  }

  static throttle(func, limit) {
    let inThrottle;
    return function() {
      const args = arguments;
      const context = this;
      if (!inThrottle) {
        func.apply(context, args);
        inThrottle = true;
        setTimeout(() => inThrottle = false, limit);
      }
    };
  }
}

// Navigation Manager
class NavigationManager {
  constructor(appState) {
    this.appState = appState;
    this.init();
  }

  init() {
    this.bindNavigationEvents();
    this.handleBrowserNavigation();
  }

  bindNavigationEvents() {
    document.addEventListener('click', (e) => {
      const navLink = e.target.closest('.nav-link');
      if (navLink) {
        e.preventDefault();
        const page = navLink.getAttribute('data-page');
        if (page) {
          this.navigateTo(page);
        }
      }
    });
  }

  navigateTo(page, data = {}) {
    // Update URL without page reload
    const url = new URL(window.location);
    url.searchParams.set('page', page);
    window.history.pushState({ page, data }, '', url);

    // Update application state
    this.appState.setCurrentPage(page);

    // Load page content
    this.loadPage(page, data);
  }

  async loadPage(page, data = {}) {
    const mainContent = document.querySelector('.main-content') || document.querySelector('main');

    if (!mainContent) return;

    UIUtils.showLoading(mainContent, 'Loading page...');

    try {
      // Load page content via AJAX or use existing content
      const response = await fetch(`pages/${page}.php`, {
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      if (response.ok) {
        const html = await response.text();
        mainContent.innerHTML = html;
      } else {
        // Fallback to existing content or show error
        console.warn(`Page ${page}.php not found, using existing content`);
      }
    } catch (error) {
      console.error('Error loading page:', error);
      UIUtils.showMessage('Error loading page', 'error');
    } finally {
      UIUtils.hideLoading(mainContent);
    }

    // Execute page-specific JavaScript
    this.executePageScript(page);
  }

  executePageScript(page) {
    // Execute page-specific initialization
    const scriptFunction = window[`init${page.charAt(0).toUpperCase() + page.slice(1)}Page`];
    if (typeof scriptFunction === 'function') {
      scriptFunction();
    }
  }

  handleBrowserNavigation() {
    window.addEventListener('popstate', (e) => {
      if (e.state && e.state.page) {
        this.appState.setCurrentPage(e.state.page);
        this.loadPage(e.state.page, e.state.data || {});
      }
    });
  }

  // Initialize page based on URL parameters
  initializeFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page') || 'home';
    this.navigateTo(page);
  }
}

// Theme Manager
class ThemeManager {
  constructor(appState) {
    this.appState = appState;
    this.init();
  }

  init() {
    this.applyTheme(this.appState.getTheme());
    this.bindThemeToggle();
  }

  applyTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);

    // Update theme toggle button
    const toggleBtn = document.querySelector('.theme-toggle');
    if (toggleBtn) {
      const icon = toggleBtn.querySelector('i') || toggleBtn.querySelector('.theme-icon');
      if (icon) {
        icon.className = theme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
      }
    }
  }

  bindThemeToggle() {
    document.addEventListener('click', (e) => {
      const toggleBtn = e.target.closest('.theme-toggle');
      if (toggleBtn) {
        e.preventDefault();
        this.appState.toggleTheme();
      }
    });
  }
}

// Search and Filter Utilities
class SearchUtils {
  static filterItems(items, query, fields = []) {
    if (!query) return items;

    const lowercaseQuery = query.toLowerCase();

    return items.filter(item => {
      return fields.some(field => {
        const value = this.getNestedValue(item, field);
        return value && value.toString().toLowerCase().includes(lowercaseQuery);
      });
    });
  }

  static getNestedValue(obj, path) {
    return path.split('.').reduce((current, key) => current && current[key], obj);
  }

  static sortItems(items, field, direction = 'asc') {
    return items.sort((a, b) => {
      const aValue = this.getNestedValue(a, field);
      const bValue = this.getNestedValue(b, field);

      if (aValue < bValue) return direction === 'asc' ? -1 : 1;
      if (aValue > bValue) return direction === 'asc' ? 1 : -1;
      return 0;
    });
  }

  static paginateItems(items, page = 1, perPage = 10) {
    const start = (page - 1) * perPage;
    const end = start + perPage;

    return {
      items: items.slice(start, end),
      total: items.length,
      page,
      perPage,
      totalPages: Math.ceil(items.length / perPage),
      hasNext: end < items.length,
      hasPrev: page > 1
    };
  }
}

// Form Utilities
class FormUtils {
  static serialize(form) {
    const data = new FormData(form);
    const result = {};

    for (let [key, value] of data.entries()) {
      if (result[key]) {
        if (Array.isArray(result[key])) {
          result[key].push(value);
        } else {
          result[key] = [result[key], value];
        }
      } else {
        result[key] = value;
      }
    }

    return result;
  }

  static validate(form) {
    const inputs = form.querySelectorAll('input, textarea, select');
    let isValid = true;
    const errors = [];

    inputs.forEach(input => {
      const value = input.value.trim();

      // Required validation
      if (input.hasAttribute('required') && !value) {
        this.showFieldError(input, 'This field is required');
        isValid = false;
        errors.push(`${input.name || input.id} is required`);
        return;
      }

      // Email validation
      if (input.type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
          this.showFieldError(input, 'Please enter a valid email address');
          isValid = false;
          errors.push('Invalid email format');
          return;
        }
      }

      // Password validation
      if (input.type === 'password' && value) {
        if (value.length < 8) {
          this.showFieldError(input, 'Password must be at least 8 characters long');
          isValid = false;
          errors.push('Password too short');
          return;
        }
      }

      // Clear any existing errors
      this.clearFieldError(input);
    });

    return { isValid, errors };
  }

  static showFieldError(input, message) {
    this.clearFieldError(input);

    input.classList.add('error');

    const errorElement = document.createElement('div');
    errorElement.className = 'field-error';
    errorElement.textContent = message;
    errorElement.style.cssText = `
      color: #ef4444;
      font-size: 0.875rem;
      margin-top: 0.25rem;
      animation: slideDownFade 0.2s ease-out;
    `;

    input.parentNode.appendChild(errorElement);
  }

  static clearFieldError(input) {
    input.classList.remove('error');
    const errorElement = input.parentNode.querySelector('.field-error');
    if (errorElement) {
      errorElement.remove();
    }
  }

  static showSuccess(input) {
    input.classList.add('success');
    setTimeout(() => input.classList.remove('success'), 2000);
  }
}

// Animation utilities
class AnimationUtils {
  static fadeIn(element, duration = 300) {
    if (typeof element === 'string') {
      element = document.querySelector(element);
    }

    if (!element) return;

    element.style.opacity = '0';
    element.style.display = 'block';

    requestAnimationFrame(() => {
      element.style.transition = `opacity ${duration}ms ease-out`;
      element.style.opacity = '1';
    });
  }

  static fadeOut(element, duration = 300) {
    if (typeof element === 'string') {
      element = document.querySelector(element);
    }

    if (!element) return;

    element.style.transition = `opacity ${duration}ms ease-out`;
    element.style.opacity = '0';

    setTimeout(() => {
      element.style.display = 'none';
    }, duration);
  }

  static slideIn(element, direction = 'up', duration = 300) {
    if (typeof element === 'string') {
      element = document.querySelector(element);
    }

    if (!element) return;

    const directions = {
      up: 'translateY(20px)',
      down: 'translateY(-20px)',
      left: 'translateX(20px)',
      right: 'translateX(-20px)'
    };

    element.style.transform = directions[direction];
    element.style.opacity = '0';
    element.style.display = 'block';

    requestAnimationFrame(() => {
      element.style.transition = `all ${duration}ms ${APP_CONFIG.animations.easing}`;
      element.style.transform = 'translateY(0)';
      element.style.opacity = '1';
    });
  }

  static slideOut(element, direction = 'up', duration = 300) {
    if (typeof element === 'string') {
      element = document.querySelector(element);
    }

    if (!element) return;

    const directions = {
      up: 'translateY(-20px)',
      down: 'translateY(20px)',
      left: 'translateX(-20px)',
      right: 'translateX(20px)'
    };

    element.style.transition = `all ${duration}ms ${APP_CONFIG.animations.easing}`;
    element.style.transform = directions[direction];
    element.style.opacity = '0';

    setTimeout(() => {
      element.style.display = 'none';
      element.style.transform = '';
      element.style.opacity = '';
    }, duration);
  }
}

// Initialize application
document.addEventListener('DOMContentLoaded', () => {
  // Create application state
  const appState = new AppState();

  // Initialize managers
  const navigationManager = new NavigationManager(appState);
  const themeManager = new ThemeManager(appState);

  // Load initial state
  appState.loadCart();

  // Set up global references
  window.FitnessApp = {
    state: appState,
    navigation: navigationManager,
    theme: themeManager,
    ui: UIUtils,
    forms: FormUtils,
    search: SearchUtils,
    animations: AnimationUtils,
    config: APP_CONFIG
  };

  // Initialize from URL
  navigationManager.initializeFromURL();

  console.log('Fitness Club Application initialized');
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
  module.exports = {
    AppState,
    UIUtils,
    NavigationManager,
    ThemeManager,
    SearchUtils,
    FormUtils,
    AnimationUtils,
    APP_CONFIG
  };
}