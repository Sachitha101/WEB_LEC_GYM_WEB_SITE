<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
// Simple protection: require is_admin session flag
if (empty($_SESSION['user_id']) || empty($_SESSION['is_admin'])) {
  http_response_code(403);
  echo '<div style="padding:2rem">Forbidden</div>';
  return;
}
?>
<section class="section glass-card" style="padding:2rem">
  <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:1rem">Admin • Feedback & Tickets</h1>
  <div class="content-card" style="margin-bottom:1rem">
    <div class="card-header" style="display:flex; gap:8px; align-items:center">
      <select id="filterCategory" class="form-input" style="max-width:220px">
        <option value="">All Categories</option>
        <option value="support">Support</option>
        <option value="issue">Issue</option>
        <option value="feature">Feature</option>
        <option value="general">General</option>
      </select>
      <button id="reloadBtn" class="btn btn-secondary">Reload</button>
    </div>
  </div>
  <div id="adminList"></div>
</section>
<script>
async function loadAll(){
  const cat = document.getElementById('filterCategory').value;
  // Admin list: reuse user list endpoint for demo; in production add a proper admin list endpoint
  let url = 'api/feedback.php?limit=100';
  if (cat) url += '&category=' + encodeURIComponent(cat);
  const res = await fetch(url, { credentials:'include' });
  const json = await res.json();
  const container = document.getElementById('adminList');
  if(!json.success){ container.innerHTML = '<div class="muted">Failed to load.</div>'; return; }
  if(!json.items?.length){ container.innerHTML = '<div class="muted">No items.</div>'; return; }
  container.innerHTML = json.items.map(renderItem).join('');
  bindRowActions();
}

function renderItem(it){
  return `
    <div class="content-card" style="margin-bottom:10px">
      <div style="display:flex; justify-content:space-between; gap:12px; align-items:center">
        <div>
          <div style="font-weight:700">${escapeHtml(it.subject||'Untitled')}</div>
          <div class="muted" style="font-size:0.9rem">${escapeHtml(it.category)} • ${escapeHtml(it.status.replace('_',' '))}</div>
        </div>
        <div style="display:flex; gap:6px; align-items:center">
          <select data-id="${it.id}" class="admin-status form-input" style="max-width:180px">
            ${['open','in_progress','resolved'].map(s=>`<option ${s===it.status?'selected':''} value="${s}">${s.replace('_',' ')}</option>`).join('')}
          </select>
          <input data-id="${it.id}" class="admin-assigned form-input" placeholder="Assigned to" value="${escapeHtml(it.assigned_to||'')}" style="max-width:200px" />
          <button class="btn btn-primary admin-save" data-id="${it.id}">Save</button>
        </div>
      </div>
      <div class="muted" style="margin-top:8px">${escapeHtml((it.description||'').slice(0,240))}</div>
    </div>
  `;
}

function bindRowActions(){
  document.querySelectorAll('.admin-save').forEach(btn => {
    btn.addEventListener('click', async () => {
      const id = btn.getAttribute('data-id');
      const status = document.querySelector(`.admin-status[data-id="${id}"]`).value;
      const assigned = document.querySelector(`.admin-assigned[data-id="${id}"]`).value;
      btn.disabled = true; btn.textContent = 'Saving...';
      try{
        const res = await fetch('api/admin_feedback.php', {
          method:'POST', credentials:'include', headers:{'Content-Type':'application/json'},
          body: JSON.stringify({ id: Number(id), status, assigned_to: assigned })
        });
        const json = await res.json();
        if(!json.success) throw new Error(json.message||'Failed');
        FitnessAPI?.notifications?.success('Updated');
      }catch(e){
        (FitnessAPI?.notifications||{error:alert}).error('Error: ' + e.message);
      }finally{
        btn.disabled = false; btn.textContent = 'Save';
      }
    });
  });
}

function escapeHtml(s){
  return (s||'').replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;','\'':'&#39;'}[c]));
}

document.getElementById('reloadBtn').addEventListener('click', loadAll);
document.getElementById('filterCategory').addEventListener('change', loadAll);
document.addEventListener('DOMContentLoaded', loadAll);
</script>