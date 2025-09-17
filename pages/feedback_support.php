<?php
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? 'Guest';
?>
<section class="section glass-card active" style="padding:2rem">
  <h1 class="accent-text" style="font-size:2rem; font-weight:800; margin-bottom:1rem">Support Ticket</h1>
  <p class="muted" style="margin-bottom:1rem">Get help with account or billing issues.</p>
  <form id="supportForm" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:1rem">
    <input type="hidden" name="category" value="support" />
    <div>
      <label>Subject / Title *</label>
      <input name="subject" required class="form-input" />
    </div>
    <div>
      <label>Priority *</label>
      <select name="priority" class="form-input" required>
        <option value="low">Low</option>
        <option value="medium">Medium</option>
        <option value="high">High</option>
      </select>
    </div>
    <div>
      <label>Detailed Description *</label>
      <textarea name="description" required class="form-input" rows="6"></textarea>
    </div>
    <div>
      <label>Attachment (optional)</label>
      <input type="file" name="attachment" />
    </div>
    <button class="btn btn-primary" type="submit">Submit Ticket</button>
  </form>
  <div class="content-card" style="margin-top:1.5rem">
    <div class="card-header" style="display:flex; justify-content:space-between; align-items:center">
      <h3 style="margin:0">Your Recent Tickets</h3>
      <button id="refreshTickets" class="btn btn-secondary">Refresh</button>
    </div>
    <div id="ticketList" style="margin-top:0.75rem"></div>
  </div>
</section>
<script>
async function submitForm(formId, successMsg){
  const form = document.getElementById(formId);
  const fd = new FormData(form);
  const btn = form.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Submitting...';
  try{
    const res = await fetch('api/feedback.php', { method:'POST', body: fd, credentials: 'include' });
    const json = await res.json();
    if(!json.success) throw new Error(json.message||'Submit failed');
    FitnessAPI?.notifications?.success(successMsg || 'Submitted!');
    form.reset();
    await loadTickets();
  }catch(err){
    (FitnessAPI?.notifications||{error:alert}).error('Error: ' + err.message);
  }finally{
    btn.disabled = false; btn.textContent = 'Submit Ticket';
  }
}

async function loadTickets(){
  try{
    const res = await fetch('api/feedback.php?category=support&limit=10', { credentials:'include' });
    const json = await res.json();
    const list = document.getElementById('ticketList');
    if(!json.success){ list.innerHTML = '<div class="muted">Unable to load tickets.</div>'; return; }
    if(!json.items?.length){ list.innerHTML = '<div class="muted">No tickets yet.</div>'; return; }
    list.innerHTML = json.items.map(it => `
      <div class="content-card" style="margin-bottom:8px">
        <div style="display:flex; justify-content:space-between; align-items:center">
          <div style="font-weight:600">${(it.subject||'Untitled')}</div>
          <span style="font-size:0.85rem; opacity:0.8">${new Date(it.created_at).toLocaleString()}</span>
        </div>
        <div class="muted" style="margin-top:6px">Status: ${it.status.replace('_',' ')}</div>
      </div>
    `).join('');
  }catch(e){
    document.getElementById('ticketList').innerHTML = '<div class="muted">Not signed in or error loading tickets.</div>';
  }
}

document.getElementById('supportForm').addEventListener('submit', (e)=>{ e.preventDefault(); submitForm('supportForm','Ticket submitted!'); });

document.getElementById('refreshTickets').addEventListener('click', loadTickets);

document.addEventListener('DOMContentLoaded', loadTickets);
</script>
