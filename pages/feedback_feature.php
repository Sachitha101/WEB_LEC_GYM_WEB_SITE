<?php
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? 'Guest';
?>
<section class="section glass-card active" style="padding:2rem">
  <h1 class="accent-text" style="font-size:2rem; font-weight:800; margin-bottom:1rem">Feature Request</h1>
  <p class="muted" style="margin-bottom:1rem">Suggest new features or improvements.</p>
  <form id="featureForm" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:1rem">
    <input type="hidden" name="category" value="feature" />
    <div>
      <label>Subject *</label>
      <input name="subject" required class="form-input" />
    </div>
    <div>
      <label>Priority</label>
      <select name="priority" class="form-input">
        <option value="low">Low</option>
        <option value="medium">Medium</option>
        <option value="high">High</option>
      </select>
    </div>
    <div>
      <label>Description *</label>
      <textarea name="description" required class="form-input" rows="6"></textarea>
    </div>
    <div>
      <label>Attachment (optional)</label>
      <input type="file" name="attachment" />
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
  </form>
</section>
<script>
  document.getElementById('featureForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const fd = new FormData(e.target);
    const btn = e.target.querySelector('button[type="submit"]');
    btn.disabled = true; btn.textContent = 'Submitting...';
    try{
      const res = await fetch('api/feedback.php', { method:'POST', body: fd, credentials: 'include' });
      const json = await res.json();
      if(!json.success) throw new Error(json.message||'Submit failed');
      if (window.FitnessAPI?.notifications) FitnessAPI.notifications.success('Feature request submitted!');
      e.target.reset();
    }catch(err){
      (window.FitnessAPI?.notifications||{error:alert}).error('Error: ' + err.message);
    }finally{
      btn.disabled = false; btn.textContent = 'Submit';
    }
  });
</script>
