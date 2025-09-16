/*
 * Feedback System - Handle user feedback and support interactions
 * Provides form validation, file uploads, and feedback submission
 */

// Feedback Manager Class
class FeedbackManager {
  constructor() {
    this.currentUser = null;
    this.attachments = [];
    this.maxFileSize = 5 * 1024 * 1024; // 5MB
    this.allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf', 'text/plain'];
    this.init();
  }

  init() {
    this.bindEvents();
    this.loadUserData();
  }

  bindEvents() {
    // Feedback form submission
    const feedbackForm = document.getElementById('feedbackForm');
    if (feedbackForm) {
      feedbackForm.addEventListener('submit', (e) => this.handleFeedbackSubmit(e));
    }

    // File upload handling
    const fileInput = document.getElementById('feedbackAttachments');
    if (fileInput) {
      fileInput.addEventListener('change', (e) => this.handleFileSelection(e));
    }

    // Drag and drop for file uploads
    const dropZone = document.getElementById('fileDropZone');
    if (dropZone) {
      this.setupDragAndDrop(dropZone);
    }

    // Feedback type selection
    const typeSelect = document.getElementById('feedbackType');
    if (typeSelect) {
      typeSelect.addEventListener('change', (e) => this.handleTypeChange(e));
    }

    // Rating system
    this.setupRatingSystem();

    // Dynamic form fields
    this.setupDynamicFields();
  }

  loadUserData() {
    // Load current user data
    if (window.FitnessAPI && window.FitnessAPI.apiShim) {
      this.currentUser = window.FitnessAPI.apiShim.getCurrentUser();
    }

    // Pre-fill user information if available
    if (this.currentUser) {
      this.prefillUserData();
    }
  }

  prefillUserData() {
    const nameField = document.getElementById('feedbackName');
    const emailField = document.getElementById('feedbackEmail');

    if (nameField && this.currentUser.name) {
      nameField.value = this.currentUser.name;
    }

    if (emailField && this.currentUser.email) {
      emailField.value = this.currentUser.email;
    }
  }

  setupRatingSystem() {
    const ratingContainer = document.querySelector('.rating-stars');
    if (!ratingContainer) return;

    const stars = ratingContainer.querySelectorAll('.star');
    let currentRating = 0;

    stars.forEach((star, index) => {
      star.addEventListener('click', () => {
        currentRating = index + 1;
        this.updateStarDisplay(stars, currentRating);

        // Update hidden input
        const ratingInput = document.getElementById('feedbackRating');
        if (ratingInput) {
          ratingInput.value = currentRating;
        }
      });

      star.addEventListener('mouseenter', () => {
        this.updateStarDisplay(stars, index + 1);
      });

      star.addEventListener('mouseleave', () => {
        this.updateStarDisplay(stars, currentRating);
      });
    });
  }

  updateStarDisplay(stars, rating) {
    stars.forEach((star, index) => {
      if (index < rating) {
        star.classList.add('active');
      } else {
        star.classList.remove('active');
      }
    });
  }

  setupDynamicFields() {
    const typeSelect = document.getElementById('feedbackType');
    if (!typeSelect) return;

    const dynamicContainer = document.getElementById('dynamicFields');
    if (!dynamicContainer) return;

    typeSelect.addEventListener('change', () => {
      const selectedType = typeSelect.value;
      this.showDynamicFields(selectedType, dynamicContainer);
    });

    // Initialize with default selection
    this.showDynamicFields(typeSelect.value, dynamicContainer);
  }

  showDynamicFields(type, container) {
    let fields = '';

    switch (type) {
      case 'bug':
        fields = `
          <div class="form-group">
            <label for="bugSeverity">Severity Level</label>
            <select id="bugSeverity" name="severity" class="form-control">
              <option value="low">Low - Minor issue</option>
              <option value="medium">Medium - Affects functionality</option>
              <option value="high">High - Critical issue</option>
              <option value="critical">Critical - System unusable</option>
            </select>
          </div>
          <div class="form-group">
            <label for="bugSteps">Steps to Reproduce</label>
            <textarea id="bugSteps" name="steps" class="form-control" rows="4" placeholder="Please describe the steps to reproduce this issue..."></textarea>
          </div>
        `;
        break;

      case 'feature':
        fields = `
          <div class="form-group">
            <label for="featurePriority">Priority Level</label>
            <select id="featurePriority" name="priority" class="form-control">
              <option value="low">Low - Nice to have</option>
              <option value="medium">Medium - Would be helpful</option>
              <option value="high">High - Important for workflow</option>
              <option value="critical">Critical - Essential feature</option>
            </select>
          </div>
          <div class="form-group">
            <label for="featureUseCase">Use Case</label>
            <textarea id="featureUseCase" name="use_case" class="form-control" rows="3" placeholder="Describe how you would use this feature..."></textarea>
          </div>
        `;
        break;

      case 'improvement':
        fields = `
          <div class="form-group">
            <label for="improvementArea">Area of Improvement</label>
            <select id="improvementArea" name="area" class="form-control">
              <option value="ui">User Interface</option>
              <option value="performance">Performance</option>
              <option value="usability">Usability</option>
              <option value="functionality">Functionality</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="currentExperience">Current Experience</label>
            <textarea id="currentExperience" name="current_experience" class="form-control" rows="2" placeholder="How does it currently work?"></textarea>
          </div>
          <div class="form-group">
            <label for="desiredExperience">Desired Experience</label>
            <textarea id="desiredExperience" name="desired_experience" class="form-control" rows="2" placeholder="How would you like it to work?"></textarea>
          </div>
        `;
        break;

      default:
        fields = '';
    }

    container.innerHTML = fields;

    // Animate new fields
    if (fields) {
      const newFields = container.querySelectorAll('.form-group');
      newFields.forEach((field, index) => {
        field.style.opacity = '0';
        field.style.transform = 'translateY(10px)';
        setTimeout(() => {
          field.style.transition = 'all 0.3s ease-out';
          field.style.opacity = '1';
          field.style.transform = 'translateY(0)';
        }, index * 100);
      });
    }
  }

  setupDragAndDrop(dropZone) {
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
      dropZone.addEventListener(eventName, (e) => {
        e.preventDefault();
        e.stopPropagation();
      });
    });

    ['dragenter', 'dragover'].forEach(eventName => {
      dropZone.addEventListener(eventName, () => {
        dropZone.classList.add('drag-over');
      });
    });

    ['dragleave', 'drop'].forEach(eventName => {
      dropZone.addEventListener(eventName, () => {
        dropZone.classList.remove('drag-over');
      });
    });

    dropZone.addEventListener('drop', (e) => {
      const files = Array.from(e.dataTransfer.files);
      this.processFiles(files);
    });
  }

  handleFileSelection(e) {
    const files = Array.from(e.target.files);
    this.processFiles(files);
  }

  processFiles(files) {
    files.forEach(file => {
      if (this.validateFile(file)) {
        this.attachments.push(file);
        this.displayAttachment(file);
      }
    });

    this.updateFileInput();
  }

  validateFile(file) {
    // Check file size
    if (file.size > this.maxFileSize) {
      this.showError(`File "${file.name}" is too large. Maximum size is 5MB.`);
      return false;
    }

    // Check file type
    if (!this.allowedTypes.includes(file.type)) {
      this.showError(`File type "${file.type}" is not allowed. Allowed types: JPEG, PNG, GIF, PDF, TXT.`);
      return false;
    }

    return true;
  }

  displayAttachment(file) {
    const attachmentList = document.getElementById('attachmentList');
    if (!attachmentList) return;

    const attachmentItem = document.createElement('div');
    attachmentItem.className = 'attachment-item';
    attachmentItem.innerHTML = `
      <div class="attachment-info">
        <i class="fas fa-file"></i>
        <span class="attachment-name">${file.name}</span>
        <span class="attachment-size">(${this.formatFileSize(file.size)})</span>
      </div>
      <button type="button" class="attachment-remove" data-file="${file.name}">
        <i class="fas fa-times"></i>
      </button>
    `;

    attachmentList.appendChild(attachmentItem);

    // Bind remove event
    const removeBtn = attachmentItem.querySelector('.attachment-remove');
    removeBtn.addEventListener('click', () => {
      this.removeAttachment(file.name);
      attachmentItem.remove();
    });
  }

  removeAttachment(fileName) {
    this.attachments = this.attachments.filter(file => file.name !== fileName);
    this.updateFileInput();
  }

  updateFileInput() {
    const fileInput = document.getElementById('feedbackAttachments');
    if (fileInput) {
      // Create new DataTransfer to update input
      const dt = new DataTransfer();
      this.attachments.forEach(file => dt.items.add(file));
      fileInput.files = dt.files;
    }
  }

  formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
  }

  async handleFeedbackSubmit(e) {
    e.preventDefault();

    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');

    // Validate form
    if (!this.validateForm(form)) {
      return;
    }

    // Show loading state
    this.setLoadingState(submitBtn, true);

    try {
      const formData = new FormData(form);

      // Add attachments
      this.attachments.forEach((file, index) => {
        formData.append(`attachment_${index}`, file);
      });

      // Add metadata
      formData.append('timestamp', new Date().toISOString());
      formData.append('user_agent', navigator.userAgent);
      formData.append('url', window.location.href);

      if (this.currentUser) {
        formData.append('user_id', this.currentUser.id);
      }

      // Submit feedback
      const response = await this.submitFeedback(formData);

      if (response.success) {
        this.showSuccess('Feedback submitted successfully!');
        this.resetForm(form);
        this.trackFeedbackSubmission(formData);
      } else {
        throw new Error(response.message || 'Failed to submit feedback');
      }

    } catch (error) {
      console.error('Feedback submission error:', error);
      this.showError(error.message || 'Failed to submit feedback. Please try again.');
    } finally {
      this.setLoadingState(submitBtn, false);
    }
  }

  validateForm(form) {
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;

    requiredFields.forEach(field => {
      if (!field.value.trim()) {
        this.showFieldError(field, 'This field is required');
        isValid = false;
      } else {
        this.clearFieldError(field);
      }
    });

    // Validate email format
    const emailField = form.querySelector('input[type="email"]');
    if (emailField && emailField.value) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(emailField.value)) {
        this.showFieldError(emailField, 'Please enter a valid email address');
        isValid = false;
      }
    }

    return isValid;
  }

  async submitFeedback(formData) {
    // Try API first, fallback to local storage
    try {
      const response = await fetch('api/feedback.php', {
        method: 'POST',
        body: formData
      });

      if (response.ok) {
        return await response.json();
      }
    } catch (error) {
      console.warn('API submission failed, using local storage:', error);
    }

    // Fallback to local storage
    return this.saveFeedbackLocally(formData);
  }

  async saveFeedbackLocally(formData) {
    const feedbackData = {
      id: Date.now(),
      type: formData.get('type'),
      subject: formData.get('subject'),
      message: formData.get('message'),
      name: formData.get('name'),
      email: formData.get('email'),
      rating: formData.get('rating'),
      attachments: this.attachments.map(file => ({
        name: file.name,
        size: file.size,
        type: file.type
      })),
      timestamp: formData.get('timestamp'),
      user_agent: formData.get('user_agent'),
      url: formData.get('url'),
      status: 'pending'
    };

    // Save to local storage
    const existingFeedback = JSON.parse(localStorage.getItem('pending_feedback') || '[]');
    existingFeedback.push(feedbackData);
    localStorage.setItem('pending_feedback', JSON.stringify(existingFeedback));

    return { success: true, message: 'Feedback saved locally and will be submitted when online' };
  }

  setLoadingState(button, isLoading) {
    if (isLoading) {
      button.disabled = true;
      button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
    } else {
      button.disabled = false;
      button.innerHTML = 'Submit Feedback';
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
      alert(message);
    }
  }

  showError(message) {
    if (window.FitnessAPI && window.FitnessAPI.notifications) {
      window.FitnessAPI.notifications.error(message);
    } else {
      alert('Error: ' + message);
    }
  }

  resetForm(form) {
    form.reset();
    this.attachments = [];
    const attachmentList = document.getElementById('attachmentList');
    if (attachmentList) {
      attachmentList.innerHTML = '';
    }

    // Reset dynamic fields
    const dynamicContainer = document.getElementById('dynamicFields');
    if (dynamicContainer) {
      dynamicContainer.innerHTML = '';
    }

    // Reset rating
    const stars = document.querySelectorAll('.rating-stars .star');
    stars.forEach(star => star.classList.remove('active'));
  }

  trackFeedbackSubmission(formData) {
    // Track feedback submission for analytics
    if (window.gtag) {
      window.gtag('event', 'feedback_submitted', {
        event_category: 'engagement',
        event_label: formData.get('type'),
        value: formData.get('rating') || 0
      });
    }

    // Store in local analytics
    const analytics = JSON.parse(localStorage.getItem('feedback_analytics') || '{}');
    const type = formData.get('type') || 'general';
    analytics[type] = (analytics[type] || 0) + 1;
    localStorage.setItem('feedback_analytics', JSON.stringify(analytics));
  }

  handleTypeChange(e) {
    const type = e.target.value;
    this.trackTypeSelection(type);
  }

  trackTypeSelection(type) {
    // Track feedback type selection
    if (window.gtag) {
      window.gtag('event', 'feedback_type_selected', {
        event_category: 'engagement',
        event_label: type
      });
    }
  }
}

// Initialize feedback system when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  // Initialize feedback manager for feedback page
  if (document.querySelector('.feedback-form') || document.getElementById('feedbackForm')) {
    window.feedbackManager = new FeedbackManager();
  }
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
  module.exports = FeedbackManager;
}