<?php
// POWERZONE PAGE
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? 'Guest';
?>
<section id="powerzone" class="section powerzone active" aria-label="PowerZone Pro" tabindex="0">
  <!-- Page Header -->
  <div class="page-header glass-card" style="padding: 2rem; margin-bottom: 2rem; text-align: center;">
    <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; background: linear-gradient(135deg, var(--fluent-accent-primary), var(--fluent-accent-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
      PowerZone Pro
    </h1>
    <p style="color: var(--fluent-text-secondary); font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
      Advanced training programs powered by AI. Get personalized workouts, progress tracking, and expert guidance to achieve your fitness goals faster.
    </p>
  </div>

  <!-- AI Workout Generator -->
  <div class="ai-generator glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem;">
    <h2 style="margin-bottom: 2rem; display: flex; align-items: center; gap: 0.5rem;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 24px; height: 24px;">
        <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
      </svg>
      AI Workout Generator
    </h2>

    <div class="generator-form" style="display: grid; grid-template-columns: 1fr 300px; gap: 2rem;">
      <!-- Form -->
      <div class="form-section">
        <form id="workoutGeneratorForm" style="display: flex; flex-direction: column; gap: 1.5rem;">
          <!-- Fitness Level -->
          <div class="form-group">
            <label for="fitnessLevel" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Fitness Level</label>
            <select id="fitnessLevel" name="fitnessLevel" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
              <option value="">Select your level</option>
              <option value="beginner">Beginner - New to fitness</option>
              <option value="intermediate">Intermediate - Some experience</option>
              <option value="advanced">Advanced - Experienced athlete</option>
            </select>
          </div>

          <!-- Goals -->
          <div class="form-group">
            <label for="goals" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Primary Goal</label>
            <select id="goals" name="goals" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
              <option value="">Select your goal</option>
              <option value="weight-loss">Weight Loss</option>
              <option value="muscle-gain">Muscle Gain</option>
              <option value="strength">Build Strength</option>
              <option value="endurance">Improve Endurance</option>
              <option value="flexibility">Increase Flexibility</option>
              <option value="general">General Fitness</option>
            </select>
          </div>

          <!-- Duration -->
          <div class="form-group">
            <label for="duration" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Session Duration</label>
            <select id="duration" name="duration" required style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem;">
              <option value="30">30 minutes</option>
              <option value="45">45 minutes</option>
              <option value="60" selected>60 minutes</option>
              <option value="90">90 minutes</option>
            </select>
          </div>

          <!-- Equipment -->
          <div class="form-group">
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Available Equipment</label>
            <div class="equipment-options" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 0.5rem;">
              <label class="equipment-option" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem; background: rgba(255,255,255,0.05); border-radius: 8px; cursor: pointer;">
                <input type="checkbox" name="equipment[]" value="dumbbells" style="margin: 0;">
                <span>Dumbbells</span>
              </label>
              <label class="equipment-option" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem; background: rgba(255,255,255,0.05); border-radius: 8px; cursor: pointer;">
                <input type="checkbox" name="equipment[]" value="barbell" style="margin: 0;">
                <span>Barbell</span>
              </label>
              <label class="equipment-option" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem; background: rgba(255,255,255,0.05); border-radius: 8px; cursor: pointer;">
                <input type="checkbox" name="equipment[]" value="resistance-bands" style="margin: 0;">
                <span>Resistance Bands</span>
              </label>
              <label class="equipment-option" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem; background: rgba(255,255,255,0.05); border-radius: 8px; cursor: pointer;">
                <input type="checkbox" name="equipment[]" value="bodyweight" checked style="margin: 0;">
                <span>Bodyweight Only</span>
              </label>
            </div>
          </div>

          <!-- Special Considerations -->
          <div class="form-group">
            <label for="considerations" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Special Considerations</label>
            <textarea id="considerations" name="considerations" rows="3" placeholder="Any injuries, limitations, or preferences..." style="width: 100%; padding: 1rem; border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; background: rgba(255,255,255,0.05); color: var(--fluent-text-primary); font-size: 1rem; resize: vertical;"></textarea>
          </div>

          <button type="submit" class="primary large buttonGlow" style="align-self: flex-start;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; margin-right: 0.5rem;">
              <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
            </svg>
            Generate Workout
          </button>
        </form>
      </div>

      <!-- Preview -->
      <div class="preview-section">
        <div class="workout-preview glass-card" style="padding: 1.5rem; height: fit-content;">
          <h3 style="margin-bottom: 1rem; font-size: 1.2rem; font-weight: 600;">Workout Preview</h3>
          <div class="preview-content" id="workoutPreview" style="color: var(--fluent-text-secondary);">
            <div style="text-align: center; padding: 2rem;">
              <div style="font-size: 3rem; margin-bottom: 1rem;">🤖</div>
              <p>Fill out the form to generate your personalized AI workout plan!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Progress Dashboard -->
  <div class="progress-dashboard glass-card widgetMorph" style="padding: 2rem; margin-bottom: 2rem;">
    <h2 style="margin-bottom: 2rem; display: flex; align-items: center; gap: 0.5rem;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 24px; height: 24px;">
        <path d="M3 3v18h18"/>
        <path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/>
      </svg>
      Your Progress
    </h2>

    <div class="progress-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
      <!-- Weekly Progress -->
      <div class="progress-card" style="padding: 1.5rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1);">
        <h3 style="margin-bottom: 1rem; font-size: 1.1rem; font-weight: 600;">This Week</h3>
        <div class="progress-stats" style="display: flex; flex-direction: column; gap: 1rem;">
          <div class="stat-item" style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: var(--fluent-text-secondary);">Workouts Completed:</span>
            <span style="font-weight: 600; color: var(--fluent-accent-primary);">4/5</span>
          </div>
          <div class="stat-item" style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: var(--fluent-text-secondary);">Total Minutes:</span>
            <span style="font-weight: 600;">240</span>
          </div>
          <div class="stat-item" style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: var(--fluent-text-secondary);">Calories Burned:</span>
            <span style="font-weight: 600;">1,840</span>
          </div>
        </div>
        <div class="progress-bar" style="margin-top: 1rem; height: 8px; background: rgba(255,255,255,0.1); border-radius: 4px; overflow: hidden;">
          <div style="width: 80%; height: 100%; background: var(--fluent-accent-primary); border-radius: 4px;"></div>
        </div>
      </div>

      <!-- Monthly Goals -->
      <div class="progress-card" style="padding: 1.5rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1);">
        <h3 style="margin-bottom: 1rem; font-size: 1.1rem; font-weight: 600;">Monthly Goals</h3>
        <div class="goals-list" style="display: flex; flex-direction: column; gap: 1rem;">
          <div class="goal-item" style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: var(--fluent-text-secondary);">Workouts:</span>
            <span style="font-weight: 600;">16/20</span>
          </div>
          <div class="goal-item" style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: var(--fluent-text-secondary);">Weight Loss:</span>
            <span style="font-weight: 600; color: #10b981;">-2.5 lbs</span>
          </div>
          <div class="goal-item" style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: var(--fluent-text-secondary);">Bench Press:</span>
            <span style="font-weight: 600; color: var(--fluent-accent-primary);">+15 lbs</span>
          </div>
        </div>
      </div>

      <!-- Achievements -->
      <div class="progress-card" style="padding: 1.5rem; background: rgba(255,255,255,0.05); border-radius: 16px; border: 1px solid rgba(255,255,255,0.1);">
        <h3 style="margin-bottom: 1rem; font-size: 1.1rem; font-weight: 600;">Recent Achievements</h3>
        <div class="achievements-list" style="display: flex; flex-direction: column; gap: 1rem;">
          <div class="achievement-item" style="display: flex; align-items: center; gap: 1rem;">
            <div class="achievement-icon" style="width: 32px; height: 32px; background: var(--fluent-accent-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" style="width: 16px; height: 16px;">
                <polyline points="20,6 9,17 4,12"/>
              </svg>
            </div>
            <div>
              <div style="font-weight: 600; font-size: 0.9rem;">5-Day Streak</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.8rem;">Completed workouts for 5 consecutive days</div>
            </div>
          </div>
          <div class="achievement-item" style="display: flex; align-items: center; gap: 1rem;">
            <div class="achievement-icon" style="width: 32px; height: 32px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" style="width: 16px; height: 16px;">
                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
              </svg>
            </div>
            <div>
              <div style="font-weight: 600; font-size: 0.9rem;">Power Up</div>
              <div style="color: var(--fluent-text-secondary); font-size: 0.8rem;">Increased max bench press by 10%</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Featured Programs -->
  <div class="featured-programs glass-card widgetMorph" style="padding: 2rem;">
    <h2 style="margin-bottom: 2rem; display: flex; align-items: center; gap: 0.5rem;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 24px; height: 24px;">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
      </svg>
      Featured Programs
    </h2>

    <div class="programs-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
      <!-- Program 1: HIIT Master -->
      <div class="program-card" style="padding: 2rem; background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.04)); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.15); border-radius: 20px; position: relative; overflow: hidden;">
        <div class="program-header" style="margin-bottom: 1.5rem;">
          <div class="program-icon" style="font-size: 3rem; margin-bottom: 1rem;">🔥</div>
          <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">HIIT Master Program</h3>
          <p style="color: var(--fluent-text-secondary); margin: 0;">High-intensity interval training for maximum fat burn and cardiovascular fitness.</p>
        </div>

        <div class="program-features" style="margin-bottom: 2rem;">
          <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px; color: var(--fluent-accent-primary);">
              <polyline points="20,6 9,17 4,12"/>
            </svg>
            <span>12-week program</span>
          </div>
          <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px; color: var(--fluent-accent-primary);">
              <polyline points="20,6 9,17 4,12"/>
            </svg>
            <span>30-45 minute sessions</span>
          </div>
          <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px; color: var(--fluent-accent-primary);">
              <polyline points="20,6 9,17 4,12"/>
            </svg>
            <span>Progressive difficulty</span>
          </div>
        </div>

        <div class="program-action">
          <button class="primary buttonGlow" style="width: 100%;">Start Program</button>
        </div>
      </div>

      <!-- Program 2: Strength Builder -->
      <div class="program-card" style="padding: 2rem; background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.04)); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.15); border-radius: 20px; position: relative; overflow: hidden;">
        <div class="program-header" style="margin-bottom: 1.5rem;">
          <div class="program-icon" style="font-size: 3rem; margin-bottom: 1rem;">💪</div>
          <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">Strength Builder</h3>
          <p style="color: var(--fluent-text-secondary); margin: 0;">Build functional strength with compound movements and progressive overload.</p>
        </div>

        <div class="program-features" style="margin-bottom: 2rem;">
          <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px; color: var(--fluent-accent-primary);">
              <polyline points="20,6 9,17 4,12"/>
            </svg>
            <span>8-week program</span>
          </div>
          <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px; color: var(--fluent-accent-primary);">
              <polyline points="20,6 9,17 4,12"/>
            </svg>
            <span>Full body workouts</span>
          </div>
          <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px; color: var(--fluent-accent-primary);">
              <polyline points="20,6 9,17 4,12"/>
            </svg>
            <span>Beginner to advanced</span>
          </div>
        </div>

        <div class="program-action">
          <button class="primary buttonGlow" style="width: 100%;">Start Program</button>
        </div>
      </div>

      <!-- Program 3: Yoga Flow -->
      <div class="program-card" style="padding: 2rem; background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.04)); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.15); border-radius: 20px; position: relative; overflow: hidden;">
        <div class="program-header" style="margin-bottom: 1.5rem;">
          <div class="program-icon" style="font-size: 3rem; margin-bottom: 1rem;">🧘‍♀️</div>
          <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">Yoga Flow Series</h3>
          <p style="color: var(--fluent-text-secondary); margin: 0;">Improve flexibility, balance, and mental clarity with guided yoga sessions.</p>
        </div>

        <div class="program-features" style="margin-bottom: 2rem;">
          <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px; color: var(--fluent-accent-primary);">
              <polyline points="20,6 9,17 4,12"/>
            </svg>
            <span>4-week series</span>
          </div>
          <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px; color: var(--fluent-accent-primary);">
              <polyline points="20,6 9,17 4,12"/>
            </svg>
            <span>Various difficulty levels</span>
          </div>
          <div class="feature-item" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px; height: 16px; color: var(--fluent-accent-primary);">
              <polyline points="20,6 9,17 4,12"/>
            </svg>
            <span>Mindfulness focus</span>
          </div>
        </div>

        <div class="program-action">
          <button class="primary buttonGlow" style="width: 100%;">Start Program</button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
// Workout generator form handling
document.getElementById('workoutGeneratorForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const workoutData = Object.fromEntries(formData);

    // Generate sample workout based on inputs
    generateWorkout(workoutData);

    // Show success message
    showNotification('AI workout generated successfully!', 'success');
});

function generateWorkout(data) {
    const preview = document.getElementById('workoutPreview');

    // Sample workout generation logic
    const exercises = {
        beginner: ['Push-ups', 'Squats', 'Planks', 'Jumping Jacks', 'Mountain Climbers'],
        intermediate: ['Burpees', 'Lunges', 'Pull-ups', 'Deadlifts', 'Box Jumps'],
        advanced: ['Muscle-ups', 'Pistol Squats', 'Handstand Push-ups', 'Snatch', 'Clean and Jerk']
    };

    const level = data.fitnessLevel || 'beginner';
    const goal = data.goals || 'general';
    const duration = parseInt(data.duration) || 60;

    const selectedExercises = exercises[level].slice(0, Math.floor(duration / 10));

    let workoutHTML = `
        <div style="text-align: left;">
            <h4 style="margin-bottom: 1rem; color: var(--fluent-accent-primary);">Your Personalized Workout</h4>
            <div style="margin-bottom: 1rem;">
                <strong>Level:</strong> ${level.charAt(0).toUpperCase() + level.slice(1)}<br>
                <strong>Goal:</strong> ${goal.replace('-', ' ').replace(/\b\w/g, l => l.toUpperCase())}<br>
                <strong>Duration:</strong> ${duration} minutes
            </div>
            <div style="margin-bottom: 1rem;">
                <strong>Exercises:</strong>
                <ul style="margin-top: 0.5rem;">`;

    selectedExercises.forEach(exercise => {
        workoutHTML += `<li style="margin-bottom: 0.25rem;">${exercise}</li>`;
    });

    workoutHTML += `
                </ul>
            </div>
            <button class="primary small buttonGlow" style="margin-top: 1rem;">Save Workout</button>
        </div>`;

    preview.innerHTML = workoutHTML;
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? 'var(--fluent-accent-primary)' : 'var(--fluent-accent-secondary)'};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        z-index: 1000;
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