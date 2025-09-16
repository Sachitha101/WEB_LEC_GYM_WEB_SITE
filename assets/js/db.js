/*
 * Database Operations - IndexedDB utilities for Fitness Club
 * Provides advanced database operations and data management
 */

// Database configuration
const DB_CONFIG = {
  name: 'FitnessClubDB',
  version: 1,
  stores: {
    users: 'fitness_users',
    sessions: 'fitness_sessions',
    cart: 'fitness_cart',
    feedback: 'fitness_feedback',
    workouts: 'fitness_workouts',
    progress: 'fitness_progress',
    notifications: 'fitness_notifications'
  }
};

// Enhanced Database Manager
class DatabaseManager {
  constructor() {
    this.db = null;
    this.isInitialized = false;
  }

  async initialize() {
    if (this.isInitialized) return this.db;

    return new Promise((resolve, reject) => {
      const request = indexedDB.open(DB_CONFIG.name, DB_CONFIG.version);

      request.onerror = () => {
        console.error('Database initialization failed:', request.error);
        reject(request.error);
      };

      request.onsuccess = () => {
        this.db = request.result;
        this.isInitialized = true;
        console.log('Database initialized successfully');
        resolve(this.db);
      };

      request.onupgradeneeded = (event) => {
        const db = event.target.result;
        this.createObjectStores(db);
      };
    });
  }

  createObjectStores(db) {
    // Users store
    if (!db.objectStoreNames.contains(DB_CONFIG.stores.users)) {
      const usersStore = db.createObjectStore(DB_CONFIG.stores.users, { keyPath: 'id', autoIncrement: true });
      usersStore.createIndex('email', 'email', { unique: true });
      usersStore.createIndex('provider', 'provider', { unique: false });
      usersStore.createIndex('createdAt', 'createdAt', { unique: false });
    }

    // Sessions store
    if (!db.objectStoreNames.contains(DB_CONFIG.stores.sessions)) {
      const sessionsStore = db.createObjectStore(DB_CONFIG.stores.sessions, { keyPath: 'sessionId' });
      sessionsStore.createIndex('userId', 'userId', { unique: false });
      sessionsStore.createIndex('expires', 'expires', { unique: false });
    }

    // Cart store
    if (!db.objectStoreNames.contains(DB_CONFIG.stores.cart)) {
      const cartStore = db.createObjectStore(DB_CONFIG.stores.cart, { keyPath: 'id', autoIncrement: true });
      cartStore.createIndex('userId', 'userId', { unique: false });
      cartStore.createIndex('productId', 'productId', { unique: false });
      cartStore.createIndex('addedAt', 'addedAt', { unique: false });
    }

    // Feedback store
    if (!db.objectStoreNames.contains(DB_CONFIG.stores.feedback)) {
      const feedbackStore = db.createObjectStore(DB_CONFIG.stores.feedback, { keyPath: 'id', autoIncrement: true });
      feedbackStore.createIndex('userId', 'userId', { unique: false });
      feedbackStore.createIndex('type', 'type', { unique: false });
      feedbackStore.createIndex('timestamp', 'timestamp', { unique: false });
    }

    // Workouts store
    if (!db.objectStoreNames.contains(DB_CONFIG.stores.workouts)) {
      const workoutsStore = db.createObjectStore(DB_CONFIG.stores.workouts, { keyPath: 'id', autoIncrement: true });
      workoutsStore.createIndex('userId', 'userId', { unique: false });
      workoutsStore.createIndex('date', 'date', { unique: false });
      workoutsStore.createIndex('type', 'type', { unique: false });
    }

    // Progress store
    if (!db.objectStoreNames.contains(DB_CONFIG.stores.progress)) {
      const progressStore = db.createObjectStore(DB_CONFIG.stores.progress, { keyPath: 'id', autoIncrement: true });
      progressStore.createIndex('userId', 'userId', { unique: false });
      progressStore.createIndex('date', 'date', { unique: false });
      progressStore.createIndex('metric', 'metric', { unique: false });
    }

    // Notifications store
    if (!db.objectStoreNames.contains(DB_CONFIG.stores.notifications)) {
      const notificationsStore = db.createObjectStore(DB_CONFIG.stores.notifications, { keyPath: 'id', autoIncrement: true });
      notificationsStore.createIndex('userId', 'userId', { unique: false });
      notificationsStore.createIndex('type', 'type', { unique: false });
      notificationsStore.createIndex('read', 'read', { unique: false });
      notificationsStore.createIndex('timestamp', 'timestamp', { unique: false });
    }
  }

  async getStore(storeName, mode = 'readonly') {
    if (!this.isInitialized) await this.initialize();
    const transaction = this.db.transaction([storeName], mode);
    return transaction.objectStore(storeName);
  }

  // Generic CRUD operations
  async add(storeName, data) {
    const store = await this.getStore(storeName, 'readwrite');
    return new Promise((resolve, reject) => {
      const request = store.add(data);
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async get(storeName, key) {
    const store = await this.getStore(storeName);
    return new Promise((resolve, reject) => {
      const request = store.get(key);
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async getAll(storeName, indexName = null, indexValue = null) {
    const store = await this.getStore(storeName);
    return new Promise((resolve, reject) => {
      let request;
      if (indexName && indexValue !== null) {
        const index = store.index(indexName);
        request = index.getAll(indexValue);
      } else {
        request = store.getAll();
      }
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async update(storeName, key, data) {
    const store = await this.getStore(storeName, 'readwrite');
    return new Promise((resolve, reject) => {
      const request = store.put({ ...data, id: key });
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async delete(storeName, key) {
    const store = await this.getStore(storeName, 'readwrite');
    return new Promise((resolve, reject) => {
      const request = store.delete(key);
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async clear(storeName) {
    const store = await this.getStore(storeName, 'readwrite');
    return new Promise((resolve, reject) => {
      const request = store.clear();
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  // Advanced query operations
  async query(storeName, query = {}) {
    const allItems = await this.getAll(storeName);
    return allItems.filter(item => {
      return Object.entries(query).every(([key, value]) => {
        if (typeof value === 'function') {
          return value(item[key]);
        }
        return item[key] === value;
      });
    });
  }

  async count(storeName, query = {}) {
    const results = await this.query(storeName, query);
    return results.length;
  }

  // Bulk operations
  async bulkAdd(storeName, items) {
    const store = await this.getStore(storeName, 'readwrite');
    const transaction = store.transaction;

    return Promise.all(items.map(item => {
      return new Promise((resolve, reject) => {
        const request = store.add(item);
        request.onsuccess = () => resolve(request.result);
        request.onerror = () => reject(request.error);
      });
    }));
  }

  async bulkDelete(storeName, keys) {
    const store = await this.getStore(storeName, 'readwrite');

    return Promise.all(keys.map(key => {
      return new Promise((resolve, reject) => {
        const request = store.delete(key);
        request.onsuccess = () => resolve(request.result);
        request.onerror = () => reject(request.error);
      });
    }));
  }

  // User-specific operations
  async getUserWorkouts(userId, limit = null, offset = 0) {
    const workouts = await this.getAll(DB_CONFIG.stores.workouts, 'userId', userId);
    workouts.sort((a, b) => new Date(b.date) - new Date(a.date));

    if (limit) {
      return workouts.slice(offset, offset + limit);
    }
    return workouts.slice(offset);
  }

  async getUserProgress(userId, metric = null, limit = 30) {
    let progress = await this.getAll(DB_CONFIG.stores.progress, 'userId', userId);

    if (metric) {
      progress = progress.filter(p => p.metric === metric);
    }

    progress.sort((a, b) => new Date(b.date) - new Date(a.date));
    return progress.slice(0, limit);
  }

  async addWorkout(userId, workoutData) {
    const workout = {
      ...workoutData,
      userId,
      date: new Date().toISOString(),
      createdAt: new Date().toISOString()
    };

    return await this.add(DB_CONFIG.stores.workouts, workout);
  }

  async addProgress(userId, metric, value, notes = '') {
    const progress = {
      userId,
      metric,
      value,
      notes,
      date: new Date().toISOString(),
      createdAt: new Date().toISOString()
    };

    return await this.add(DB_CONFIG.stores.progress, progress);
  }

  async getUnreadNotifications(userId) {
    return await this.query(DB_CONFIG.stores.notifications, {
      userId,
      read: false
    });
  }

  async markNotificationAsRead(notificationId) {
    const notification = await this.get(DB_CONFIG.stores.notifications, notificationId);
    if (notification) {
      notification.read = true;
      notification.readAt = new Date().toISOString();
      return await this.update(DB_CONFIG.stores.notifications, notificationId, notification);
    }
    return null;
  }

  async addNotification(userId, type, title, message, data = {}) {
    const notification = {
      userId,
      type,
      title,
      message,
      data,
      read: false,
      timestamp: new Date().toISOString(),
      createdAt: new Date().toISOString()
    };

    return await this.add(DB_CONFIG.stores.notifications, notification);
  }

  // Cart operations
  async getCartTotal(userId) {
    const cartItems = await this.getAll(DB_CONFIG.stores.cart, 'userId', userId);
    return cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
  }

  async updateCartItemQuantity(cartItemId, quantity) {
    const cartItem = await this.get(DB_CONFIG.stores.cart, cartItemId);
    if (cartItem) {
      cartItem.quantity = quantity;
      cartItem.updatedAt = new Date().toISOString();
      return await this.update(DB_CONFIG.stores.cart, cartItemId, cartItem);
    }
    return null;
  }

  // Analytics and reporting
  async getUserStats(userId) {
    const [workouts, progress, feedback] = await Promise.all([
      this.getAll(DB_CONFIG.stores.workouts, 'userId', userId),
      this.getAll(DB_CONFIG.stores.progress, 'userId', userId),
      this.getAll(DB_CONFIG.stores.feedback, 'userId', userId)
    ]);

    return {
      totalWorkouts: workouts.length,
      totalProgressEntries: progress.length,
      totalFeedback: feedback.length,
      workoutsThisMonth: workouts.filter(w =>
        new Date(w.date).getMonth() === new Date().getMonth()
      ).length,
      lastWorkout: workouts.length > 0 ?
        workouts.sort((a, b) => new Date(b.date) - new Date(a.date))[0] : null
    };
  }

  // Data export/import
  async exportUserData(userId) {
    const [workouts, progress, feedback, notifications] = await Promise.all([
      this.getAll(DB_CONFIG.stores.workouts, 'userId', userId),
      this.getAll(DB_CONFIG.stores.progress, 'userId', userId),
      this.getAll(DB_CONFIG.stores.feedback, 'userId', userId),
      this.getAll(DB_CONFIG.stores.notifications, 'userId', userId)
    ]);

    return {
      userId,
      exportDate: new Date().toISOString(),
      data: {
        workouts,
        progress,
        feedback,
        notifications
      }
    };
  }

  async importUserData(userId, data) {
    const operations = [];

    // Import workouts
    if (data.workouts) {
      operations.push(this.bulkAdd(DB_CONFIG.stores.workouts,
        data.workouts.map(w => ({ ...w, userId }))
      ));
    }

    // Import progress
    if (data.progress) {
      operations.push(this.bulkAdd(DB_CONFIG.stores.progress,
        data.progress.map(p => ({ ...p, userId }))
      ));
    }

    // Import feedback
    if (data.feedback) {
      operations.push(this.bulkAdd(DB_CONFIG.stores.feedback,
        data.feedback.map(f => ({ ...f, userId }))
      ));
    }

    // Import notifications
    if (data.notifications) {
      operations.push(this.bulkAdd(DB_CONFIG.stores.notifications,
        data.notifications.map(n => ({ ...n, userId }))
      ));
    }

    return Promise.all(operations);
  }

  // Database maintenance
  async cleanupExpiredSessions() {
    const sessions = await this.getAll(DB_CONFIG.stores.sessions);
    const expiredSessions = sessions.filter(s => s.expires < Date.now());

    if (expiredSessions.length > 0) {
      const keys = expiredSessions.map(s => s.sessionId);
      return await this.bulkDelete(DB_CONFIG.stores.sessions, keys);
    }

    return 0;
  }

  async optimizeStorage() {
    // Clear old notifications (older than 30 days)
    const thirtyDaysAgo = new Date();
    thirtyDaysAgo.setDate(thirtyDaysAgo.getDate() - 30);

    const oldNotifications = await this.query(DB_CONFIG.stores.notifications, {
      timestamp: (timestamp) => new Date(timestamp) < thirtyDaysAgo
    });

    if (oldNotifications.length > 0) {
      const keys = oldNotifications.map(n => n.id);
      await this.bulkDelete(DB_CONFIG.stores.notifications, keys);
    }

    return oldNotifications.length;
  }
}

// Data synchronization utilities
class DataSync {
  constructor(dbManager) {
    this.db = dbManager;
  }

  async syncWithServer(userId) {
    try {
      // Get local data
      const localData = await this.db.exportUserData(userId);

      // Send to server for sync
      const response = await fetch('/api/sync.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(localData)
      });

      if (response.ok) {
        const serverData = await response.json();

        // Merge server data with local data
        await this.mergeServerData(userId, serverData);

        return { success: true, message: 'Data synchronized successfully' };
      } else {
        throw new Error('Server sync failed');
      }
    } catch (error) {
      console.error('Sync failed:', error);
      return { success: false, message: error.message };
    }
  }

  async mergeServerData(userId, serverData) {
    // This would implement conflict resolution and data merging
    // For now, we'll just update local data with server data
    if (serverData.data) {
      await this.db.importUserData(userId, serverData.data);
    }
  }
}

// Initialize database when module loads
const dbManager = new DatabaseManager();
const dataSync = new DataSync(dbManager);

// Export for global use
window.FitnessDB = {
  manager: dbManager,
  sync: dataSync,
  config: DB_CONFIG,

  // Convenience methods
  async initialize() {
    return await dbManager.initialize();
  },

  async addWorkout(userId, workoutData) {
    return await dbManager.addWorkout(userId, workoutData);
  },

  async getUserStats(userId) {
    return await dbManager.getUserStats(userId);
  },

  async addNotification(userId, type, title, message, data) {
    return await dbManager.addNotification(userId, type, title, message, data);
  },

  async getUnreadNotifications(userId) {
    return await dbManager.getUnreadNotifications(userId);
  },

  async syncData(userId) {
    return await dataSync.syncWithServer(userId);
  }
};

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  dbManager.initialize().then(() => {
    console.log('Advanced Database Manager initialized');
  }).catch(error => {
    console.error('Failed to initialize database:', error);
  });
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
  module.exports = {
    DatabaseManager,
    DataSync,
    DB_CONFIG
  };
}