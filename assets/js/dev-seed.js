/*
 * Development Data Seeding - Populate database with sample data for testing
 * Provides utilities to seed users, workouts, products, and other test data
 */

// Development Data Seeder
class DevDataSeeder {
  constructor() {
    this.isDevelopment = this.checkDevelopmentMode();
    this.seedData = {
      users: [],
      workouts: [],
      products: [],
      feedback: [],
      notifications: []
    };
    this.init();
  }

  init() {
    if (this.isDevelopment) {
      this.generateSeedData();
      this.bindSeedControls();
      console.log('Development Data Seeder initialized');
    }
  }

  checkDevelopmentMode() {
    // Check if we're in development mode
    return window.location.hostname === 'localhost' ||
           window.location.hostname === '127.0.0.1' ||
           window.location.hostname.includes('dev') ||
           window.location.search.includes('dev=true');
  }

  bindSeedControls() {
    // Add development controls to page
    this.addDevControls();

    // Listen for seed commands
    document.addEventListener('keydown', (e) => {
      // Ctrl+Shift+S to seed all data
      if (e.ctrlKey && e.shiftKey && e.key === 'S') {
        e.preventDefault();
        this.seedAllData();
      }

      // Ctrl+Shift+C to clear all data
      if (e.ctrlKey && e.shiftKey && e.key === 'C') {
        e.preventDefault();
        this.clearAllData();
      }

      // Ctrl+Shift+U to seed users
      if (e.ctrlKey && e.shiftKey && e.key === 'U') {
        e.preventDefault();
        this.seedUsers();
      }
    });
  }

  addDevControls() {
    const devControls = document.createElement('div');
    devControls.id = 'dev-controls';
    devControls.innerHTML = `
      <div class="dev-panel">
        <div class="dev-header">
          <span class="dev-title">Dev Tools</span>
          <button class="dev-toggle" title="Toggle Dev Panel">
            <i class="fas fa-cog"></i>
          </button>
        </div>
        <div class="dev-content">
          <div class="dev-section">
            <h4>Data Seeding</h4>
            <button class="dev-btn" onclick="window.devSeeder.seedAllData()">
              <i class="fas fa-seedling"></i> Seed All Data
            </button>
            <button class="dev-btn" onclick="window.devSeeder.seedUsers()">
              <i class="fas fa-users"></i> Seed Users
            </button>
            <button class="dev-btn" onclick="window.devSeeder.seedWorkouts()">
              <i class="fas fa-dumbbell"></i> Seed Workouts
            </button>
            <button class="dev-btn" onclick="window.devSeeder.seedProducts()">
              <i class="fas fa-shopping-bag"></i> Seed Products
            </button>
          </div>
          <div class="dev-section">
            <h4>Data Management</h4>
            <button class="dev-btn danger" onclick="window.devSeeder.clearAllData()">
              <i class="fas fa-trash"></i> Clear All Data
            </button>
            <button class="dev-btn" onclick="window.devSeeder.exportData()">
              <i class="fas fa-download"></i> Export Data
            </button>
            <button class="dev-btn" onclick="window.devSeeder.showDataStats()">
              <i class="fas fa-chart-bar"></i> Show Stats
            </button>
          </div>
          <div class="dev-section">
            <h4>Testing</h4>
            <button class="dev-btn" onclick="window.devSeeder.simulateUserLogin()">
              <i class="fas fa-sign-in-alt"></i> Simulate Login
            </button>
            <button class="dev-btn" onclick="window.devSeeder.testNotifications()">
              <i class="fas fa-bell"></i> Test Notifications
            </button>
            <button class="dev-btn" onclick="window.devSeeder.testAPI()">
              <i class="fas fa-plug"></i> Test API
            </button>
          </div>
        </div>
      </div>
    `;

    // Add styles
    const style = document.createElement('style');
    style.textContent = `
      #dev-controls {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 10000;
        font-family: 'Segoe UI', sans-serif;
      }

      .dev-panel {
        background: rgba(0, 0, 0, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        min-width: 280px;
        overflow: hidden;
      }

      .dev-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        background: rgba(255, 255, 255, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      }

      .dev-title {
        color: #00d4ff;
        font-weight: 600;
        font-size: 14px;
      }

      .dev-toggle {
        background: none;
        border: none;
        color: #00d4ff;
        cursor: pointer;
        padding: 4px;
        border-radius: 4px;
        transition: background 0.2s;
      }

      .dev-toggle:hover {
        background: rgba(255, 255, 255, 0.1);
      }

      .dev-content {
        padding: 16px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
      }

      .dev-panel.expanded .dev-content {
        max-height: 500px;
      }

      .dev-section {
        margin-bottom: 16px;
      }

      .dev-section h4 {
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }

      .dev-btn {
        display: block;
        width: 100%;
        background: rgba(0, 194, 255, 0.1);
        border: 1px solid rgba(0, 194, 255, 0.3);
        color: #00d4ff;
        padding: 8px 12px;
        margin-bottom: 4px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        text-align: left;
        transition: all 0.2s;
      }

      .dev-btn:hover {
        background: rgba(0, 194, 255, 0.2);
        border-color: rgba(0, 194, 255, 0.5);
        transform: translateX(2px);
      }

      .dev-btn.danger {
        background: rgba(239, 68, 68, 0.1);
        border-color: rgba(239, 68, 68, 0.3);
        color: #ef4444;
      }

      .dev-btn.danger:hover {
        background: rgba(239, 68, 68, 0.2);
        border-color: rgba(239, 68, 68, 0.5);
      }

      .dev-btn i {
        margin-right: 8px;
        width: 12px;
      }
    `;

    document.head.appendChild(style);
    document.body.appendChild(devControls);

    // Toggle functionality
    const toggleBtn = devControls.querySelector('.dev-toggle');
    const panel = devControls.querySelector('.dev-panel');

    toggleBtn.addEventListener('click', () => {
      panel.classList.toggle('expanded');
    });
  }

  generateSeedData() {
    this.seedData.users = this.generateUsers();
    this.seedData.workouts = this.generateWorkouts();
    this.seedData.products = this.generateProducts();
    this.seedData.feedback = this.generateFeedback();
    this.seedData.notifications = this.generateNotifications();
  }

  generateUsers() {
    const users = [];
    const firstNames = ['John', 'Jane', 'Mike', 'Sarah', 'David', 'Emma', 'Chris', 'Lisa', 'Tom', 'Anna'];
    const lastNames = ['Smith', 'Johnson', 'Brown', 'Williams', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez'];

    for (let i = 0; i < 20; i++) {
      const firstName = firstNames[Math.floor(Math.random() * firstNames.length)];
      const lastName = lastNames[Math.floor(Math.random() * lastNames.length)];
      const email = `${firstName.toLowerCase()}.${lastName.toLowerCase()}@example.com`;

      users.push({
        id: i + 1,
        name: `${firstName} ${lastName}`,
        email: email,
        password: '$2b$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewdBPjYQmHqU2nO', // password: "password123"
        provider: 'local',
        avatar: `https://via.placeholder.com/100x100?text=${firstName.charAt(0)}${lastName.charAt(0)}`,
        createdAt: new Date(Date.now() - Math.random() * 365 * 24 * 60 * 60 * 1000).toISOString(),
        lastLogin: new Date(Date.now() - Math.random() * 30 * 24 * 60 * 60 * 1000).toISOString(),
        membership: Math.random() > 0.5 ? 'premium' : 'basic',
        goals: this.generateRandomGoals()
      });
    }

    return users;
  }

  generateRandomGoals() {
    const goals = ['weight_loss', 'muscle_gain', 'endurance', 'flexibility', 'general_fitness'];
    const selectedGoals = [];

    for (let i = 0; i < Math.floor(Math.random() * 3) + 1; i++) {
      const goal = goals[Math.floor(Math.random() * goals.length)];
      if (!selectedGoals.includes(goal)) {
        selectedGoals.push(goal);
      }
    }

    return selectedGoals;
  }

  generateWorkouts() {
    const workouts = [];
    const exercises = [
      'Push-ups', 'Squats', 'Lunges', 'Planks', 'Burpees', 'Mountain Climbers',
      'Deadlifts', 'Bench Press', 'Pull-ups', 'Dips', 'Rows', 'Shoulder Press',
      'Bicep Curls', 'Tricep Extensions', 'Leg Press', 'Calf Raises'
    ];

    const types = ['strength', 'cardio', 'flexibility', 'sports', 'crossfit'];

    for (let i = 0; i < 100; i++) {
      const userId = Math.floor(Math.random() * 20) + 1;
      const workoutDate = new Date(Date.now() - Math.random() * 90 * 24 * 60 * 60 * 1000);
      const duration = Math.floor(Math.random() * 90) + 15; // 15-105 minutes

      workouts.push({
        id: i + 1,
        userId: userId,
        type: types[Math.floor(Math.random() * types.length)],
        date: workoutDate.toISOString(),
        duration: duration,
        exercises: this.generateRandomExercises(exercises),
        calories: Math.floor(duration * (Math.random() * 10 + 5)), // 5-15 cal/min
        notes: Math.random() > 0.7 ? this.generateRandomNote() : '',
        createdAt: workoutDate.toISOString()
      });
    }

    return workouts;
  }

  generateRandomExercises(exercises) {
    const workoutExercises = [];
    const numExercises = Math.floor(Math.random() * 8) + 3; // 3-10 exercises

    for (let i = 0; i < numExercises; i++) {
      const exercise = exercises[Math.floor(Math.random() * exercises.length)];
      if (!workoutExercises.find(e => e.name === exercise)) {
        workoutExercises.push({
          name: exercise,
          sets: Math.floor(Math.random() * 5) + 1,
          reps: Math.floor(Math.random() * 20) + 5,
          weight: Math.floor(Math.random() * 200) + 10
        });
      }
    }

    return workoutExercises;
  }

  generateRandomNote() {
    const notes = [
      'Great workout! Feeling strong.',
      'Tough session, but worth it.',
      'Need to work on form.',
      'Personal best on squats!',
      'Felt a bit tired today.',
      'Amazing energy levels.',
      'Focus on core strength next time.',
      'Good progress on endurance.'
    ];

    return notes[Math.floor(Math.random() * notes.length)];
  }

  generateProducts() {
    const products = [];
    const categories = ['equipment', 'supplements', 'clothing', 'accessories'];
    const productNames = {
      equipment: ['Dumbbells', 'Yoga Mat', 'Resistance Bands', 'Kettlebell', 'Foam Roller', 'Pull-up Bar'],
      supplements: ['Protein Powder', 'Creatine', 'BCAAs', 'Pre-workout', 'Vitamins', 'Fish Oil'],
      clothing: ['Gym Shorts', 'Sports Bra', 'Tank Top', 'Leggings', 'Hoodie', 'Sneakers'],
      accessories: ['Water Bottle', 'Gym Bag', 'Heart Rate Monitor', 'Jump Rope', 'Wrist Wraps', 'Gym Towel']
    };

    for (let i = 0; i < 50; i++) {
      const category = categories[Math.floor(Math.random() * categories.length)];
      const names = productNames[category];
      const name = names[Math.floor(Math.random() * names.length)];

      products.push({
        id: i + 1,
        name: `${name} ${Math.floor(Math.random() * 100) + 1}`,
        category: category,
        price: Math.floor(Math.random() * 200) + 10,
        description: this.generateProductDescription(name, category),
        image: `https://via.placeholder.com/300x300?text=${name.replace(' ', '+')}`,
        inStock: Math.random() > 0.2, // 80% in stock
        rating: Math.floor(Math.random() * 5) + 1,
        reviews: Math.floor(Math.random() * 100),
        tags: this.generateProductTags(category)
      });
    }

    return products;
  }

  generateProductDescription(name, category) {
    const descriptions = {
      equipment: `High-quality ${name.toLowerCase()} perfect for your fitness routine.`,
      supplements: `Premium ${name.toLowerCase()} to support your fitness goals.`,
      clothing: `Comfortable and stylish ${name.toLowerCase()} for optimal performance.`,
      accessories: `Essential ${name.toLowerCase()} to enhance your workout experience.`
    };

    return descriptions[category] || `Quality ${name.toLowerCase()} for fitness enthusiasts.`;
  }

  generateProductTags(category) {
    const tagSets = {
      equipment: ['fitness', 'workout', 'gym', 'strength', 'training'],
      supplements: ['nutrition', 'supplements', 'health', 'recovery', 'performance'],
      clothing: ['activewear', 'comfort', 'style', 'performance', 'gym'],
      accessories: ['convenience', 'durability', 'portable', 'essential', 'quality']
    };

    const tags = tagSets[category] || [];
    return tags.slice(0, Math.floor(Math.random() * tags.length) + 1);
  }

  generateFeedback() {
    const feedback = [];
    const types = ['general', 'bug', 'feature', 'improvement'];
    const subjects = [
      'Great app!', 'Found a bug', 'Feature request', 'UI improvement',
      'Performance issue', 'Login problem', 'New workout ideas', 'Support request'
    ];

    for (let i = 0; i < 30; i++) {
      const userId = Math.floor(Math.random() * 20) + 1;
      const type = types[Math.floor(Math.random() * types.length)];

      feedback.push({
        id: i + 1,
        userId: userId,
        type: type,
        subject: subjects[Math.floor(Math.random() * subjects.length)],
        message: this.generateFeedbackMessage(type),
        rating: Math.floor(Math.random() * 5) + 1,
        timestamp: new Date(Date.now() - Math.random() * 60 * 24 * 60 * 60 * 1000).toISOString(),
        status: Math.random() > 0.5 ? 'resolved' : 'pending'
      });
    }

    return feedback;
  }

  generateFeedbackMessage(type) {
    const messages = {
      general: [
        'Love using this fitness app! It really helps me stay motivated.',
        'Great user interface and easy to navigate.',
        'The workout plans are very helpful and well-structured.'
      ],
      bug: [
        'I found a bug in the workout tracker. It sometimes duplicates entries.',
        'The login page is not working properly on mobile devices.',
        'There seems to be an issue with saving progress data.'
      ],
      feature: [
        'Would love to see a social sharing feature for completed workouts.',
        'Please add more customization options for workout plans.',
        'It would be great to have integration with fitness wearables.'
      ],
      improvement: [
        'The loading times could be improved for better user experience.',
        'More detailed progress analytics would be very helpful.',
        'The mobile app could use some UI improvements.'
      ]
    };

    const typeMessages = messages[type] || messages.general;
    return typeMessages[Math.floor(Math.random() * typeMessages.length)];
  }

  generateNotifications() {
    const notifications = [];
    const types = ['workout_reminder', 'achievement', 'social', 'system', 'promotion'];
    const messages = {
      workout_reminder: 'Don\'t forget your workout today! 💪',
      achievement: 'Congratulations! You\'ve reached a new milestone! 🏆',
      social: 'Your friend just completed an amazing workout! 👏',
      system: 'Your account settings have been updated successfully.',
      promotion: 'Special offer: 20% off on all supplements this week!'
    };

    for (let i = 0; i < 40; i++) {
      const userId = Math.floor(Math.random() * 20) + 1;
      const type = types[Math.floor(Math.random() * types.length)];

      notifications.push({
        id: i + 1,
        userId: userId,
        type: type,
        title: this.getNotificationTitle(type),
        message: messages[type],
        read: Math.random() > 0.5,
        timestamp: new Date(Date.now() - Math.random() * 30 * 24 * 60 * 60 * 1000).toISOString(),
        data: this.generateNotificationData(type)
      });
    }

    return notifications;
  }

  getNotificationTitle(type) {
    const titles = {
      workout_reminder: 'Workout Reminder',
      achievement: 'Achievement Unlocked!',
      social: 'Social Update',
      system: 'System Notification',
      promotion: 'Special Offer'
    };

    return titles[type] || 'Notification';
  }

  generateNotificationData(type) {
    switch (type) {
      case 'workout_reminder':
        return { workoutId: Math.floor(Math.random() * 100) + 1 };
      case 'achievement':
        return { achievementId: Math.floor(Math.random() * 10) + 1 };
      case 'social':
        return { friendId: Math.floor(Math.random() * 20) + 1 };
      case 'promotion':
        return { discount: Math.floor(Math.random() * 30) + 10 };
      default:
        return {};
    }
  }

  async seedAllData() {
    console.log('Seeding all development data...');

    try {
      await this.seedUsers();
      await this.seedWorkouts();
      await this.seedProducts();
      await this.seedFeedback();
      await this.seedNotifications();

      this.showToast('All data seeded successfully!', 'success');
      console.log('All development data seeded successfully');
    } catch (error) {
      console.error('Failed to seed data:', error);
      this.showToast('Failed to seed data', 'error');
    }
  }

  async seedUsers() {
    console.log('Seeding users...');

    try {
      for (const user of this.seedData.users) {
        await this.saveToIndexedDB('fitness_users', user);
      }

      this.showToast(`Seeded ${this.seedData.users.length} users`, 'success');
      console.log(`Seeded ${this.seedData.users.length} users`);
    } catch (error) {
      console.error('Failed to seed users:', error);
      this.showToast('Failed to seed users', 'error');
    }
  }

  async seedWorkouts() {
    console.log('Seeding workouts...');

    try {
      for (const workout of this.seedData.workouts) {
        await this.saveToIndexedDB('fitness_workouts', workout);
      }

      this.showToast(`Seeded ${this.seedData.workouts.length} workouts`, 'success');
      console.log(`Seeded ${this.seedData.workouts.length} workouts`);
    } catch (error) {
      console.error('Failed to seed workouts:', error);
      this.showToast('Failed to seed workouts', 'error');
    }
  }

  async seedProducts() {
    console.log('Seeding products...');

    try {
      // Store products in localStorage for shop functionality
      localStorage.setItem('dev_products', JSON.stringify(this.seedData.products));

      this.showToast(`Seeded ${this.seedData.products.length} products`, 'success');
      console.log(`Seeded ${this.seedData.products.length} products`);
    } catch (error) {
      console.error('Failed to seed products:', error);
      this.showToast('Failed to seed products', 'error');
    }
  }

  async seedFeedback() {
    console.log('Seeding feedback...');

    try {
      for (const feedback of this.seedData.feedback) {
        await this.saveToIndexedDB('fitness_feedback', feedback);
      }

      this.showToast(`Seeded ${this.seedData.feedback.length} feedback entries`, 'success');
      console.log(`Seeded ${this.seedData.feedback.length} feedback entries`);
    } catch (error) {
      console.error('Failed to seed feedback:', error);
      this.showToast('Failed to seed feedback', 'error');
    }
  }

  async seedNotifications() {
    console.log('Seeding notifications...');

    try {
      for (const notification of this.seedData.notifications) {
        await this.saveToIndexedDB('fitness_notifications', notification);
      }

      this.showToast(`Seeded ${this.seedData.notifications.length} notifications`, 'success');
      console.log(`Seeded ${this.seedData.notifications.length} notifications`);
    } catch (error) {
      console.error('Failed to seed notifications:', error);
      this.showToast('Failed to seed notifications', 'error');
    }
  }

  async saveToIndexedDB(storeName, data) {
    if (!window.FitnessDB || !window.FitnessDB.manager) {
      throw new Error('IndexedDB not available');
    }

    return await window.FitnessDB.manager.add(storeName, data);
  }

  async clearAllData() {
    if (!confirm('Are you sure you want to clear ALL development data? This cannot be undone.')) {
      return;
    }

    console.log('Clearing all development data...');

    try {
      const stores = ['fitness_users', 'fitness_sessions', 'fitness_workouts', 'fitness_feedback', 'fitness_notifications'];

      for (const store of stores) {
        await window.FitnessDB.manager.clear(store);
      }

      // Clear localStorage items
      localStorage.removeItem('dev_products');
      localStorage.removeItem('fitness_cart');
      localStorage.removeItem('fitness_session');

      this.showToast('All data cleared successfully', 'success');
      console.log('All development data cleared');
    } catch (error) {
      console.error('Failed to clear data:', error);
      this.showToast('Failed to clear data', 'error');
    }
  }

  exportData() {
    const exportData = {
      users: this.seedData.users,
      workouts: this.seedData.workouts,
      products: this.seedData.products,
      feedback: this.seedData.feedback,
      notifications: this.seedData.notifications,
      exportDate: new Date().toISOString(),
      version: '1.0.0'
    };

    const dataStr = JSON.stringify(exportData, null, 2);
    const dataBlob = new Blob([dataStr], { type: 'application/json' });

    const link = document.createElement('a');
    link.href = URL.createObjectURL(dataBlob);
    link.download = `fitness-dev-data-${new Date().toISOString().split('T')[0]}.json`;
    link.click();

    this.showToast('Data exported successfully', 'success');
  }

  showDataStats() {
    if (!window.FitnessDB || !window.FitnessDB.manager) {
      this.showToast('Database not available', 'error');
      return;
    }

    // This would show statistics about the current data
    const stats = {
      users: 'Checking...',
      workouts: 'Checking...',
      feedback: 'Checking...',
      notifications: 'Checking...'
    };

    // Show stats modal
    const modal = document.createElement('div');
    modal.className = 'dev-stats-modal';
    modal.innerHTML = `
      <div class="modal-content">
        <h3>Data Statistics</h3>
        <div class="stats-grid">
          <div class="stat-item">
            <span class="stat-label">Users:</span>
            <span class="stat-value">${stats.users}</span>
          </div>
          <div class="stat-item">
            <span class="stat-label">Workouts:</span>
            <span class="stat-value">${stats.workouts}</span>
          </div>
          <div class="stat-item">
            <span class="stat-label">Feedback:</span>
            <span class="stat-value">${stats.feedback}</span>
          </div>
          <div class="stat-item">
            <span class="stat-label">Notifications:</span>
            <span class="stat-value">${stats.notifications}</span>
          </div>
        </div>
        <div class="modal-actions">
          <button class="btn btn-secondary" onclick="this.closest('.dev-stats-modal').remove()">Close</button>
        </div>
      </div>
    `;

    // Add modal styles
    const style = document.createElement('style');
    style.textContent = `
      .dev-stats-modal {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10001;
      }

      .dev-stats-modal .modal-content {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        max-width: 500px;
        width: 90%;
      }

      .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin: 1.5rem 0;
      }

      .stat-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem;
        background: #f8f9fa;
        border-radius: 6px;
      }
    `;

    document.head.appendChild(style);
    document.body.appendChild(modal);
  }

  simulateUserLogin() {
    const testUser = this.seedData.users[0];
    if (testUser) {
      // Simulate login
      const session = {
        sessionId: 'dev_session_' + Date.now(),
        userId: testUser.id,
        email: testUser.email,
        name: testUser.name,
        expires: Date.now() + (24 * 60 * 60 * 1000)
      };

      localStorage.setItem('fitness_session', JSON.stringify(session));

      this.showToast(`Logged in as ${testUser.name}`, 'success');

      // Reload page to reflect login state
      setTimeout(() => {
        window.location.reload();
      }, 1000);
    } else {
      this.showToast('No test users available', 'error');
    }
  }

  testNotifications() {
    if (window.FitnessAPI && window.FitnessAPI.notifications) {
      window.FitnessAPI.notifications.success('Test success notification!');
      window.FitnessAPI.notifications.error('Test error notification!');
      window.FitnessAPI.notifications.warning('Test warning notification!');
      window.FitnessAPI.notifications.info('Test info notification!');
    } else {
      this.showToast('Notification system not available', 'error');
    }
  }

  async testAPI() {
    console.log('Testing API endpoints...');

    const tests = [
      { name: 'Auth API', url: 'api/auth.php?action=test' },
      { name: 'Account API', url: 'api/account.php?action=test' },
      { name: 'Feedback API', url: 'api/feedback.php?action=test' }
    ];

    for (const test of tests) {
      try {
        const response = await fetch(test.url);
        console.log(`${test.name}: ${response.status === 200 ? 'OK' : 'FAILED'}`);
      } catch (error) {
        console.log(`${test.name}: FAILED - ${error.message}`);
      }
    }

    this.showToast('API tests completed - check console', 'info');
  }

  showToast(message, type = 'info') {
    if (window.FitnessAPI && window.FitnessAPI.notifications) {
      window.FitnessAPI.notifications.show(message, type);
    } else {
      // Fallback toast
      const toast = document.createElement('div');
      toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
        color: white;
        padding: 1rem;
        border-radius: 6px;
        z-index: 10000;
        animation: slideInRight 0.3s ease-out;
      `;
      toast.textContent = message;

      document.body.appendChild(toast);

      setTimeout(() => {
        if (toast.parentNode) {
          toast.parentNode.removeChild(toast);
        }
      }, 3000);
    }
  }
}

// Initialize development seeder
document.addEventListener('DOMContentLoaded', () => {
  if (typeof window.devSeeder === 'undefined') {
    window.devSeeder = new DevDataSeeder();
  }
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
  module.exports = DevDataSeeder;
}