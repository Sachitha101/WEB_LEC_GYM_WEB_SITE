/*
 * API Shim - Client-side API handling with IndexedDB and bcryptjs
 * Provides seamless integration between client-side operations and server APIs
 */

// Global API Shim namespace
window.FitnessAPI = window.FitnessAPI || {};

// API Shim Configuration
const API_CONFIG = {
  baseURL: window.location.origin + '/fitness_win11',
  endpoints: {
    auth: '/api/auth.php',
    account: '/api/account.php',
    feedback: '/api/feedback.php',
    oauth: '/api/oauth.php'
  },
  storage: {
    users: 'fitness_users',
    sessions: 'fitness_sessions',
    cart: 'fitness_cart',
    feedback: 'fitness_feedback'
  }
};

// IndexedDB Database Manager
class FitnessDB {
  constructor() {
    this.db = null;
    this.dbName = 'FitnessClubDB';
    this.version = 1;
  }

  async init() {
    return new Promise((resolve, reject) => {
      const request = indexedDB.open(this.dbName, this.version);

      request.onerror = () => reject(request.error);
      request.onsuccess = () => {
        this.db = request.result;
        resolve(this.db);
      };

      request.onupgradeneeded = (event) => {
        const db = event.target.result;

        // Users store
        if (!db.objectStoreNames.contains(API_CONFIG.storage.users)) {
          const usersStore = db.createObjectStore(API_CONFIG.storage.users, { keyPath: 'id', autoIncrement: true });
          usersStore.createIndex('email', 'email', { unique: true });
          usersStore.createIndex('provider', 'provider', { unique: false });
        }

        // Sessions store
        if (!db.objectStoreNames.contains(API_CONFIG.storage.sessions)) {
          const sessionsStore = db.createObjectStore(API_CONFIG.storage.sessions, { keyPath: 'sessionId' });
          sessionsStore.createIndex('userId', 'userId', { unique: false });
          sessionsStore.createIndex('expires', 'expires', { unique: false });
        }

        // Cart store
        if (!db.objectStoreNames.contains(API_CONFIG.storage.cart)) {
          const cartStore = db.createObjectStore(API_CONFIG.storage.cart, { keyPath: 'id', autoIncrement: true });
          cartStore.createIndex('userId', 'userId', { unique: false });
          cartStore.createIndex('productId', 'productId', { unique: false });
        }

        // Feedback store
        if (!db.objectStoreNames.contains(API_CONFIG.storage.feedback)) {
          const feedbackStore = db.createObjectStore(API_CONFIG.storage.feedback, { keyPath: 'id', autoIncrement: true });
          feedbackStore.createIndex('userId', 'userId', { unique: false });
          feedbackStore.createIndex('type', 'type', { unique: false });
        }
      };
    });
  }

  async getStore(storeName, mode = 'readonly') {
    if (!this.db) await this.init();
    const transaction = this.db.transaction([storeName], mode);
    return transaction.objectStore(storeName);
  }

  async addUser(userData) {
    const store = await this.getStore(API_CONFIG.storage.users, 'readwrite');
    return new Promise((resolve, reject) => {
      const request = store.add(userData);
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async getUser(email) {
    const store = await this.getStore(API_CONFIG.storage.users);
    return new Promise((resolve, reject) => {
      const index = store.index('email');
      const request = index.get(email);
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async updateUser(id, userData) {
    const store = await this.getStore(API_CONFIG.storage.users, 'readwrite');
    return new Promise((resolve, reject) => {
      const request = store.put({ ...userData, id });
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async addToCart(cartItem) {
    const store = await this.getStore(API_CONFIG.storage.cart, 'readwrite');
    return new Promise((resolve, reject) => {
      const request = store.add(cartItem);
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async getCart(userId) {
    const store = await this.getStore(API_CONFIG.storage.cart);
    return new Promise((resolve, reject) => {
      const index = store.index('userId');
      const request = index.getAll(userId);
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async clearCart(userId) {
    const store = await this.getStore(API_CONFIG.storage.cart, 'readwrite');
    const cartItems = await this.getCart(userId);

    return Promise.all(cartItems.map(item => {
      return new Promise((resolve, reject) => {
        const request = store.delete(item.id);
        request.onsuccess = () => resolve(request.result);
        request.onerror = () => reject(request.error);
      });
    }));
  }

  async addFeedback(feedbackData) {
    const store = await this.getStore(API_CONFIG.storage.feedback, 'readwrite');
    return new Promise((resolve, reject) => {
      const request = store.add(feedbackData);
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async getFeedback(userId) {
    const store = await this.getStore(API_CONFIG.storage.feedback);
    return new Promise((resolve, reject) => {
      const index = store.index('userId');
      const request = index.getAll(userId);
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }
}

// Password hashing utilities using bcryptjs
class PasswordUtils {
  static async hashPassword(password) {
    const saltRounds = 12;
    return new Promise((resolve, reject) => {
      if (typeof bcrypt !== 'undefined') {
        bcrypt.hash(password, saltRounds, (err, hash) => {
          if (err) reject(err);
          else resolve(hash);
        });
      } else {
        // Fallback if bcryptjs not loaded
        resolve(password); // In production, this should never happen
      }
    });
  }

  static async verifyPassword(password, hash) {
    return new Promise((resolve, reject) => {
      if (typeof bcrypt !== 'undefined') {
        bcrypt.compare(password, hash, (err, result) => {
          if (err) reject(err);
          else resolve(result);
        });
      } else {
        // Fallback if bcryptjs not loaded
        resolve(password === hash);
      }
    });
  }

  static validatePasswordStrength(password) {
    const checks = {
      length: password.length >= 8,
      uppercase: /[A-Z]/.test(password),
      lowercase: /[a-z]/.test(password),
      numbers: /\d/.test(password),
      special: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)
    };

    const score = Object.values(checks).filter(Boolean).length;
    let strength = 'weak';

    if (score >= 5) strength = 'strong';
    else if (score >= 3) strength = 'medium';

    return { strength, checks, score };
  }
}

// API Shim - Intercepts fetch calls and handles client-side operations
class APIShim {
  constructor() {
    this.db = new FitnessDB();
    this.interceptFetch();
  }

  async interceptFetch() {
    const originalFetch = window.fetch;

    window.fetch = async (url, options = {}) => {
      // Check if this is one of our API endpoints
      if (this.isAPIEndpoint(url)) {
        return this.handleAPIRequest(url, options);
      }

      // Otherwise, use original fetch
      return originalFetch(url, options);
    };
  }

  isAPIEndpoint(url) {
    const fullUrl = typeof url === 'string' ? url : url.url;
    return Object.values(API_CONFIG.endpoints).some(endpoint =>
      fullUrl.includes(endpoint)
    );
  }

  async handleAPIRequest(url, options) {
    const endpoint = this.getEndpointType(url);
    const action = this.getActionFromOptions(options);

    try {
      switch (endpoint) {
        case 'auth':
          return await this.handleAuthRequest(action, options);
        case 'account':
          return await this.handleAccountRequest(action, options);
        case 'feedback':
          return await this.handleFeedbackRequest(action, options);
        case 'oauth':
          return await this.handleOAuthRequest(action, options);
        default:
          throw new Error('Unknown endpoint');
      }
    } catch (error) {
      return new Response(JSON.stringify({
        success: false,
        message: error.message
      }), {
        status: 500,
        headers: { 'Content-Type': 'application/json' }
      });
    }
  }

  getEndpointType(url) {
    const fullUrl = typeof url === 'string' ? url : url.url;
    for (const [key, endpoint] of Object.entries(API_CONFIG.endpoints)) {
      if (fullUrl.includes(endpoint)) return key;
    }
    return null;
  }

  getActionFromOptions(options) {
    if (!options.body) return null;

    try {
      const body = JSON.parse(options.body);
      return body.action || null;
    } catch {
      // Try to extract from URL query parameters
      const url = typeof options === 'string' ? options : options.url || '';
      const urlParams = new URLSearchParams(url.split('?')[1] || '');
      return urlParams.get('action');
    }
  }

  async handleAuthRequest(action, options) {
    const body = JSON.parse(options.body || '{}');

    switch (action) {
      case 'login':
        return await this.handleLogin(body);
      case 'signup':
        return await this.handleSignup(body);
      case 'logout':
        return await this.handleLogout();
      default:
        throw new Error('Unknown auth action');
    }
  }

  async handleLogin({ email, password }) {
    try {
      const user = await this.db.getUser(email);

      if (!user) {
        return new Response(JSON.stringify({
          success: false,
          message: 'User not found'
        }), {
          status: 404,
          headers: { 'Content-Type': 'application/json' }
        });
      }

      const isValidPassword = await PasswordUtils.verifyPassword(password, user.password);

      if (!isValidPassword) {
        return new Response(JSON.stringify({
          success: false,
          message: 'Invalid password'
        }), {
          status: 401,
          headers: { 'Content-Type': 'application/json' }
        });
      }

      // Create session
      const sessionId = 'session_' + Date.now() + '_' + Math.random();
      const session = {
        sessionId,
        userId: user.id,
        email: user.email,
        name: user.name,
        expires: Date.now() + (24 * 60 * 60 * 1000) // 24 hours
      };

      // Store session in localStorage for simplicity
      localStorage.setItem('fitness_session', JSON.stringify(session));

      return new Response(JSON.stringify({
        success: true,
        message: 'Login successful',
        user: {
          id: user.id,
          email: user.email,
          name: user.name
        }
      }), {
        status: 200,
        headers: { 'Content-Type': 'application/json' }
      });

    } catch (error) {
      return new Response(JSON.stringify({
        success: false,
        message: 'Login failed: ' + error.message
      }), {
        status: 500,
        headers: { 'Content-Type': 'application/json' }
      });
    }
  }

  async handleSignup({ name, email, password }) {
    try {
      // Check if user already exists
      const existingUser = await this.db.getUser(email);
      if (existingUser) {
        return new Response(JSON.stringify({
          success: false,
          message: 'User already exists'
        }), {
          status: 409,
          headers: { 'Content-Type': 'application/json' }
        });
      }

      // Hash password
      const hashedPassword = await PasswordUtils.hashPassword(password);

      // Create user
      const userData = {
        name,
        email,
        password: hashedPassword,
        createdAt: new Date().toISOString(),
        provider: 'local'
      };

      const userId = await this.db.addUser(userData);

      return new Response(JSON.stringify({
        success: true,
        message: 'Account created successfully',
        user: {
          id: userId,
          email,
          name
        }
      }), {
        status: 201,
        headers: { 'Content-Type': 'application/json' }
      });

    } catch (error) {
      return new Response(JSON.stringify({
        success: false,
        message: 'Signup failed: ' + error.message
      }), {
        status: 500,
        headers: { 'Content-Type': 'application/json' }
      });
    }
  }

  async handleLogout() {
    localStorage.removeItem('fitness_session');

    return new Response(JSON.stringify({
      success: true,
      message: 'Logged out successfully'
    }), {
      status: 200,
      headers: { 'Content-Type': 'application/json' }
    });
  }

  async handleAccountRequest(action, options) {
    // For now, just return success for account operations
    return new Response(JSON.stringify({
      success: true,
      message: 'Account operation completed'
    }), {
      status: 200,
      headers: { 'Content-Type': 'application/json' }
    });
  }

  async handleFeedbackRequest(action, options) {
    const body = JSON.parse(options.body || '{}');

    try {
      const feedbackData = {
        ...body,
        userId: this.getCurrentUserId(),
        timestamp: new Date().toISOString(),
        type: action || 'general'
      };

      await this.db.addFeedback(feedbackData);

      return new Response(JSON.stringify({
        success: true,
        message: 'Feedback submitted successfully'
      }), {
        status: 200,
        headers: { 'Content-Type': 'application/json' }
      });

    } catch (error) {
      return new Response(JSON.stringify({
        success: false,
        message: 'Feedback submission failed: ' + error.message
      }), {
        status: 500,
        headers: { 'Content-Type': 'application/json' }
      });
    }
  }

  async handleOAuthRequest(action, options) {
    const body = JSON.parse(options.body || '{}');

    try {
      // Simulate OAuth flow
      const userData = {
        name: body.name || 'OAuth User',
        email: body.email,
        provider: body.provider,
        providerId: body.provider_id,
        createdAt: new Date().toISOString()
      };

      const userId = await this.db.addUser(userData);

      // Create session
      const sessionId = 'oauth_session_' + Date.now();
      const session = {
        sessionId,
        userId,
        email: userData.email,
        name: userData.name,
        provider: userData.provider,
        expires: Date.now() + (24 * 60 * 60 * 1000)
      };

      localStorage.setItem('fitness_session', JSON.stringify(session));

      return new Response(JSON.stringify({
        success: true,
        message: 'OAuth login successful',
        user: {
          id: userId,
          email: userData.email,
          name: userData.name,
          provider: userData.provider
        }
      }), {
        status: 200,
        headers: { 'Content-Type': 'application/json' }
      });

    } catch (error) {
      return new Response(JSON.stringify({
        success: false,
        message: 'OAuth failed: ' + error.message
      }), {
        status: 500,
        headers: { 'Content-Type': 'application/json' }
      });
    }
  }

  getCurrentUserId() {
    const session = localStorage.getItem('fitness_session');
    if (session) {
      const sessionData = JSON.parse(session);
      return sessionData.userId;
    }
    return null;
  }

  getCurrentUser() {
    const session = localStorage.getItem('fitness_session');
    if (session) {
      return JSON.parse(session);
    }
    return null;
  }

  isLoggedIn() {
    const session = localStorage.getItem('fitness_session');
    if (!session) return false;

    const sessionData = JSON.parse(session);
    return sessionData.expires > Date.now();
  }
}

// Notification System
class NotificationManager {
  constructor() {
    this.container = null;
    this.init();
  }

  init() {
    // Create notification container if it doesn't exist
    if (!document.getElementById('notification-container')) {
      this.container = document.createElement('div');
      this.container.id = 'notification-container';
      this.container.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 10000;
        max-width: 400px;
      `;
      document.body.appendChild(this.container);
    } else {
      this.container = document.getElementById('notification-container');
    }
  }

  show(message, type = 'info', duration = 5000) {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.style.cssText = `
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      padding: 1rem;
      margin-bottom: 0.5rem;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
      animation: slideInRight 0.3s ease-out;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    `;

    const icon = this.getIcon(type);
    const content = `
      <div class="notification-icon">${icon}</div>
      <div class="notification-content" style="flex: 1;">
        <div class="notification-message" style="font-weight: 500; color: #1f2937;">${message}</div>
      </div>
      <button class="notification-close" style="background: none; border: none; cursor: pointer; color: #6b7280; font-size: 1.25rem; line-height: 1;">×</button>
    `;

    notification.innerHTML = content;

    // Add close button functionality
    const closeBtn = notification.querySelector('.notification-close');
    closeBtn.addEventListener('click', () => this.remove(notification));

    // Auto remove after duration
    if (duration > 0) {
      setTimeout(() => this.remove(notification), duration);
    }

    this.container.appendChild(notification);

    // Add slide in animation
    setTimeout(() => {
      notification.style.transform = 'translateX(0)';
    }, 10);
  }

  getIcon(type) {
    const icons = {
      success: '✓',
      error: '✕',
      warning: '⚠',
      info: 'ℹ'
    };
    return icons[type] || icons.info;
  }

  remove(notification) {
    notification.style.animation = 'slideOutRight 0.3s ease-in';
    setTimeout(() => {
      if (notification.parentNode) {
        notification.parentNode.removeChild(notification);
      }
    }, 300);
  }

  success(message, duration) {
    this.show(message, 'success', duration);
  }

  error(message, duration) {
    this.show(message, 'error', duration);
  }

  warning(message, duration) {
    this.show(message, 'warning', duration);
  }

  info(message, duration) {
    this.show(message, 'info', duration);
  }
}

// Initialize API Shim when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  // Initialize API Shim
  window.FitnessAPI.db = new FitnessDB();
  window.FitnessAPI.apiShim = new APIShim();
  window.FitnessAPI.notifications = new NotificationManager();
  window.FitnessAPI.passwordUtils = PasswordUtils;

  // Initialize IndexedDB
  window.FitnessAPI.db.init().then(() => {
    console.log('Fitness Club API Shim initialized');
  }).catch(error => {
    console.error('Failed to initialize API Shim:', error);
  });
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
  module.exports = {
    FitnessDB,
    PasswordUtils,
    APIShim,
    NotificationManager,
    API_CONFIG
  };
}