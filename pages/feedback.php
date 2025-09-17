<?php
// FEEDBACK PAGE
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? 'Guest';
?>
<section id="feedback" class="section feedback active" aria-label="Feedback & Support" tabindex="0">
  <!-- Page Header -->
  <div class="page-header glass-card" style="padding: 2rem; margin-bottom: 2rem; text-align: center;">
    <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
      Feedback & Support
    </h1>
    <p style="color: var(--fluent-text-secondary); font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
      Your feedback helps us improve. Share your thoughts, report issues, or get help from our support team.
    </p>
  </div>

  <!-- Quick Actions -->
  <div class="quick-actions glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem;">
    <h2 style="margin-bottom: 2rem; font-size: 1.8rem; font-weight: 700;">How can we help you today?</h2>

    <div class="actions-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
      <!-- Report Issue -->
  <a href="?page=feedback_issue" class="action-card" style="display:block; padding: 2rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); text-align: center; cursor: pointer; transition: all 0.3s ease; text-decoration:none; color:inherit;">
        <div class="action-icon" style="margin-bottom: 1rem;">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            <line x1="12" y1="9" x2="12" y2="13"/>
            <line x1="12" y1="17" x2="12.01" y2="17"/>
          </svg>
        </div>
        <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">Report an Issue</h3>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; line-height: 1.4;">
          Technical problems, bugs, or system errors
        </p>
  </a>

      <!-- Feature Request -->
  <a href="?page=feedback_feature" class="action-card" style="display:block; padding: 2rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); text-align: center; cursor: pointer; transition: all 0.3s ease; text-decoration:none; color:inherit;">
        <div class="action-icon" style="margin-bottom: 1rem;">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 18h6"/>
            <path d="M10 22h4"/>
            <path d="M2 11a10 10 0 1020 0A10 10 0 002 11z"/>
          </svg>
        </div>
        <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">Feature Request</h3>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; line-height: 1.4;">
          Suggest new features or improvements
        </p>
  </a>

      <!-- General Feedback -->
  <a href="?page=feedback_general" class="action-card" style="display:block; padding: 2rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); text-align: center; cursor: pointer; transition: all 0.3s ease; text-decoration:none; color:inherit;">
        <div class="action-icon" style="margin-bottom: 1rem;">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
          </svg>
        </div>
        <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">General Feedback</h3>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; line-height: 1.4;">
          Share your thoughts and suggestions
        </p>
  </a>

      <!-- Support Ticket -->
  <a href="?page=feedback_support" class="action-card" style="display:block; padding: 2rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); text-align: center; cursor: pointer; transition: all 0.3s ease; text-decoration:none; color:inherit;">
        <div class="action-icon" style="margin-bottom: 1rem;">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="5" width="18" height="14" rx="2"/>
            <path d="M7 5v14"/>
            <path d="M17 5v14"/>
          </svg>
        </div>
        <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">Support Ticket</h3>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; line-height: 1.4;">
          Get help with account or billing issues
        </p>
  </a>
    </div>
  </div>

  <!-- Quick General Feedback -->
  <div class="quick-feedback glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem;">
    <h2 style="margin-bottom: 1rem; font-size: 1.5rem; font-weight: 700;">Quick Feedback</h2>
    <p style="color: var(--fluent-text-secondary); margin-bottom: 1.5rem;">Share your thoughts quickly without navigating to a separate page.</p>
    <form id="quickFeedbackForm" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1rem;">
      <input type="hidden" name="category" value="general" />
      <div>
        <label>Subject *</label>
        <input name="subject" required class="form-input" placeholder="Brief subject" />
      </div>
      <div>
        <label>Description *</label>
        <textarea name="description" required class="form-input" rows="4" placeholder="Your feedback..."></textarea>
      </div>
      <div>
        <label>Attachment (optional)</label>
        <input type="file" name="attachment" />
      </div>
      <button class="btn btn-primary" type="submit">Submit Quick Feedback</button>
    </form>
  </div>

  <!-- Feedback Form Container -->
  <div id="feedbackFormContainer" class="feedback-form-container glass-card widgetMorph" style="padding: 2rem; display: none;">
    <div class="form-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
      <h2 id="formTitle" style="font-size: 1.8rem; font-weight: 700;">Submit Feedback</h2>
      <button onclick="hideForm()" class="close-button" style="background: none; border: none; color: var(--fluent-text-secondary); font-size: 1.5rem; cursor: pointer; padding: 0.5rem; border-radius: 8px; transition: all 0.2s ease;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px;">
          <line x1="18" y1="6" x2="6" y2="18"/>
          <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
    </div>

    <form id="feedbackForm" style="display: flex; flex-direction: column; gap: 1.5rem;">
      <!-- Hidden field for feedback type -->
      <input type="hidden" id="feedbackType" name="feedbackType" value="">

      <!-- Contact Information -->
      <div class="form-section">
        <h3 style="margin-bottom: 1rem; font-size: 1.2rem; font-weight: 600;">Contact Information</h3>

        <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          <div class="form-group">
            <label for="contactName" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Name *</label>
            <input type="text" id="contactName" name="contactName" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;" value="<?php echo htmlspecialchars($userName); ?>">
          </div>
          <div class="form-group">
            <label for="contactEmail" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Email *</label>
            <input type="email" id="contactEmail" name="contactEmail" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
          </div>
        </div>
      </div>

      <!-- Feedback Details -->
      <div class="form-section">
        <h3 style="margin-bottom: 1rem; font-size: 1.2rem; font-weight: 600;">Feedback Details</h3>

        <div class="form-group">
          <label for="subject" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Subject *</label>
          <input type="text" id="subject" name="subject" required placeholder="Brief description of your feedback" style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
        </div>

        <div class="form-group">
          <label for="category" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Category</label>
          <select id="category" name="category" style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
            <option value="">Select a category</option>
            <option value="bug">Bug Report</option>
            <option value="feature">Feature Request</option>
            <option value="improvement">Improvement</option>
            <option value="usability">Usability Issue</option>
            <option value="performance">Performance Issue</option>
            <option value="other">Other</option>
          </select>
        </div>

        <div class="form-group">
          <label for="priority" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Priority</label>
          <select id="priority" name="priority" style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
            <option value="urgent">Urgent</option>
          </select>
        </div>

        <div class="form-group">
          <label for="description" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Description *</label>
          <textarea id="description" name="description" rows="6" required placeholder="Please provide detailed information about your feedback..." style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem; resize: vertical;"></textarea>
        </div>

        <!-- File Upload for Screenshots -->
        <div class="form-group">
          <label for="attachments" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Attachments</label>
          <div class="file-upload-area" style="border: 2px dashed rgba(255,255,255,0.2); border-radius: 12px; padding: 2rem; text-align: center; cursor: pointer; transition: all 0.3s ease;" ondrop="handleFileDrop(event)" ondragover="handleFileDragOver(event)">
            <input type="file" id="attachments" name="attachments[]" multiple accept="image/*,.pdf,.doc,.docx,.txt" style="display: none;" onchange="handleFileSelect(event)">
            <div class="upload-icon" style="font-size: 3rem; margin-bottom: 1rem; color: var(--fluent-text-secondary);">📎</div>
            <div class="upload-text">
              <p style="margin-bottom: 0.5rem; font-weight: 600;">Drop files here or click to browse</p>
              <p style="color: var(--fluent-text-secondary); font-size: 0.9rem;">Supported: Images, PDF, Word documents (Max 10MB each)</p>
            </div>
          </div>
          <div id="fileList" class="file-list" style="margin-top: 1rem;"></div>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-actions" style="text-align: center; margin-top: 1rem;">
        <button type="submit" class="primary large buttonGlow">Submit Feedback</button>
        <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; margin-top: 1rem;">
          We'll respond to your feedback within 24-48 hours.
        </p>
      </div>
    </form>
  </div>

  <!-- Recent Feedback -->
  <div class="recent-feedback glass-card widgetMorph" style="padding: 2rem;">
    <h2 style="margin-bottom: 2rem; font-size: 1.8rem; font-weight: 700;">Recent Updates & Responses</h2>

    <div class="feedback-timeline" style="display: flex; flex-direction: column; gap: 1.5rem;">
      <!-- Feedback Item 1 -->
      <div class="timeline-item" style="padding: 1.5rem; background: rgba(255,255,255,0.05); border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);">
        <div class="timeline-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
          <div class="timeline-meta">
            <span class="timeline-type" style="background: var(--fluent-accent-primary); color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">FEATURE REQUEST</span>
            <span class="timeline-date" style="color: var(--fluent-text-secondary); font-size: 0.9rem; margin-left: 1rem;">2 days ago</span>
          </div>
          <div class="timeline-status" style="background: #10b981; color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">IN PROGRESS</div>
        </div>
        <h4 style="font-weight: 600; margin-bottom: 0.5rem;">Mobile App Dark Mode</h4>
        <p style="color: var(--fluent-text-secondary); line-height: 1.5; margin-bottom: 1rem;">
          Many users have requested a dark mode option for the mobile app. We're currently working on implementing this feature and plan to release it in the next update.
        </p>
        <div class="timeline-response" style="background: rgba(16,185,129,0.1); border-left: 4px solid #10b981; padding: 1rem; border-radius: 8px;">
          <div style="font-weight: 600; margin-bottom: 0.5rem; color: #10b981;">Response from Support Team</div>
          <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; line-height: 1.4;">
            Thank you for the suggestion! Dark mode is a popular request and we're excited to add this feature. Our design team is working on the implementation and we expect to have it available in version 2.1.2.
          </p>
        </div>
      </div>

      <!-- Feedback Item 2 -->
      <div class="timeline-item" style="padding: 1.5rem; background: rgba(255,255,255,0.05); border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);">
        <div class="timeline-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
          <div class="timeline-meta">
            <span class="timeline-type" style="background: var(--fluent-accent-secondary); color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">BUG REPORT</span>
            <span class="timeline-date" style="color: var(--fluent-text-secondary); font-size: 0.9rem; margin-left: 1rem;">1 week ago</span>
          </div>
          <div class="timeline-status" style="background: #10b981; color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">RESOLVED</div>
        </div>
        <h4 style="font-weight: 600; margin-bottom: 0.5rem;">Login Issues on Mobile Safari</h4>
        <p style="color: var(--fluent-text-secondary); line-height: 1.5; margin-bottom: 1rem;">
          Users reported difficulty logging in when using Safari on iOS devices. The login form would sometimes not submit properly.
        </p>
        <div class="timeline-response" style="background: rgba(16,185,129,0.1); border-left: 4px solid #10b981; padding: 1rem; border-radius: 8px;">
          <div style="font-weight: 600; margin-bottom: 0.5rem; color: #10b981;">Response from Development Team</div>
          <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; line-height: 1.4;">
            We've identified and fixed the Safari compatibility issue. The problem was related to form validation and event handling. The fix has been deployed and should resolve the login issues on iOS devices.
          </p>
        </div>
      </div>

      <!-- Feedback Item 3 -->
      <div class="timeline-item" style="padding: 1.5rem; background: rgba(255,255,255,0.05); border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);">
        <div class="timeline-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
          <div class="timeline-meta">
            <span class="timeline-type" style="background: #f59e0b; color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">IMPROVEMENT</span>
            <span class="timeline-date" style="color: var(--fluent-text-secondary); font-size: 0.9rem; margin-left: 1rem;">2 weeks ago</span>
          </div>
          <div class="timeline-status" style="background: #3b82f6; color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">PLANNED</div>
        </div>
        <h4 style="font-weight: 600; margin-bottom: 0.5rem;">Enhanced Workout Tracking</h4>
        <p style="color: var(--fluent-text-secondary); line-height: 1.5; margin-bottom: 1rem;">
          Request for more detailed workout tracking features including heart rate monitoring, GPS tracking for outdoor activities, and integration with popular fitness wearables.
        </p>
        <div class="timeline-response" style="background: rgba(59,130,246,0.1); border-left: 4px solid #3b82f6; padding: 1rem; border-radius: 8px;">
          <div style="font-weight: 600; margin-bottom: 0.5rem; color: #3b82f6;">Response from Product Team</div>
          <p style="color: var(--fluent-text-secondary); font-size: 0.9rem; line-height: 1.4;">
            We love this idea! Enhanced workout tracking is on our roadmap for Q2. We're planning to add heart rate integration, GPS tracking, and wearable device support. We'll keep you updated on our progress.
          </p>
        </div>
      </div>
    </div>

    <!-- Load More Button -->
    <div class="load-more" style="text-align: center; margin-top: 2rem;">
      <button class="secondary buttonGlow" style="padding: 1rem 2rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-weight: 600; cursor: pointer;">
        Load More Updates
      </button>
    </div>
  </div>
</section>

<script>
// Feedback form handling
let selectedFiles = [];

function showForm(type) {
    const container = document.getElementById('feedbackFormContainer');
    const formTitle = document.getElementById('formTitle');
    const feedbackType = document.getElementById('feedbackType');

    // Set form title and type
    const titles = {
        'issue': 'Report an Issue',
        'feature': 'Request a Feature',
        'general': 'Share Feedback',
        'support': 'Create Support Ticket'
    };

    formTitle.textContent = titles[type] || 'Submit Feedback';
    feedbackType.value = type;

    // Pre-fill category based on type
    const categorySelect = document.getElementById('category');
    if (type === 'issue') categorySelect.value = 'bug';
    else if (type === 'feature') categorySelect.value = 'feature';
    else if (type === 'support') categorySelect.value = 'other';

    // Show form with animation
    container.style.display = 'block';
    container.style.animation = 'fadeInUp 0.3s ease-out';
    container.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function hideForm() {
    const container = document.getElementById('feedbackFormContainer');
    container.style.animation = 'fadeOutDown 0.3s ease-in';
    setTimeout(() => {
        container.style.display = 'none';
    }, 300);
}

// File upload handling
function handleFileSelect(event) {
    const files = Array.from(event.target.files);
    addFiles(files);
}

function handleFileDrop(event) {
    event.preventDefault();
    const files = Array.from(event.dataTransfer.files);
    addFiles(files);
}

function handleFileDragOver(event) {
    event.preventDefault();
    event.currentTarget.style.borderColor = 'var(--fluent-accent-primary)';
}

function addFiles(files) {
    const maxSize = 10 * 1024 * 1024; // 10MB
    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'];

    files.forEach(file => {
        if (file.size > maxSize) {
            showNotification(`File "${file.name}" is too large. Maximum size is 10MB.`, 'error');
            return;
        }

        if (!allowedTypes.includes(file.type)) {
            showNotification(`File type "${file.type}" is not supported.`, 'error');
            return;
        }

        selectedFiles.push(file);
        displayFile(file);
    });

    // Reset border color
    document.querySelector('.file-upload-area').style.borderColor = 'rgba(255,255,255,0.2)';
}

function displayFile(file) {
    const fileList = document.getElementById('fileList');
    const fileItem = document.createElement('div');
    fileItem.className = 'file-item';
    fileItem.style.cssText = `
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 1rem;
        background: rgba(255,255,255,0.05);
        border-radius: 8px;
        margin-bottom: 0.5rem;
    `;

    const fileInfo = document.createElement('div');
    fileInfo.style.cssText = 'display: flex; align-items: center; gap: 0.75rem;';

    const fileIcon = document.createElement('span');
    fileIcon.textContent = getFileIcon(file.type);
    fileIcon.style.fontSize = '1.2rem';

    const fileDetails = document.createElement('div');
    fileDetails.innerHTML = `
        <div style="font-weight: 600; font-size: 0.9rem;">${file.name}</div>
        <div style="color: var(--fluent-text-secondary); font-size: 0.8rem;">${formatFileSize(file.size)}</div>
    `;

    const removeButton = document.createElement('button');
    removeButton.innerHTML = '×';
    removeButton.style.cssText = `
        background: none;
        border: none;
        color: var(--fluent-text-secondary);
        font-size: 1.5rem;
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 4px;
        transition: all 0.2s ease;
    `;
    removeButton.onmouseover = () => removeButton.style.background = 'rgba(255,0,0,0.1)';
    removeButton.onmouseout = () => removeButton.style.background = 'none';
    removeButton.onclick = () => {
        selectedFiles = selectedFiles.filter(f => f !== file);
        fileItem.remove();
    };

    fileInfo.appendChild(fileIcon);
    fileInfo.appendChild(fileDetails);
    fileItem.appendChild(fileInfo);
    fileItem.appendChild(removeButton);
    fileList.appendChild(fileItem);
}

function getFileIcon(type) {
    if (type.startsWith('image/')) return '🖼️';
    if (type === 'application/pdf') return '📄';
    if (type.includes('word')) return '📝';
    return '📎';
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Form submission
document.getElementById('feedbackForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    // Add selected files
    selectedFiles.forEach((file, index) => {
        formData.append(`attachment_${index}`, file);
    });

    // Show loading state
    const submitButton = this.querySelector('button[type="submit"]');
    const originalText = submitButton.textContent;
    submitButton.textContent = 'Submitting...';
    submitButton.disabled = true;

    // Simulate form submission (replace with actual API call)
    setTimeout(() => {
        showNotification('Thank you for your feedback! We\'ll respond within 24-48 hours.', 'success');

        // Reset form
        this.reset();
        selectedFiles = [];
        document.getElementById('fileList').innerHTML = '';
        hideForm();

        // Reset button
        submitButton.textContent = originalText;
        submitButton.disabled = false;
    }, 2000);
});

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
    z-index: 1600;
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

// Click outside to close form
document.addEventListener('click', function(e) {
    const container = document.getElementById('feedbackFormContainer');
    const form = document.getElementById('feedbackForm');

    if (container.style.display === 'block' && !container.contains(e.target)) {
        hideForm();
    }
});

// Quick feedback form
document.getElementById('quickFeedbackForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  const fd = new FormData(e.target);
  const btn = e.target.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Submitting...';
  try{
    const res = await fetch('api/feedback.php', { method:'POST', body: fd, credentials: 'include' });
    const json = await res.json();
    if(!json.success) throw new Error(json.message||'Submit failed');
    if (window.FitnessAPI?.notifications) FitnessAPI.notifications.success('Quick feedback submitted!');
    e.target.reset();
  }catch(err){
    (window.FitnessAPI?.notifications||{error:alert}).error('Error: ' + err.message);
  }finally{
    btn.disabled = false; btn.textContent = 'Submit Quick Feedback';
  }
});
</script>