async function signInWithProvider(provider, opts={}){
  const payload = {
    provider,
    provider_id: provider + '-' + Date.now(),
    email: (opts.email || `${provider}-user@example.com`).trim(),
    name: (opts.name || '').trim(),
    link_existing: !!opts.linkExisting,
    existing_email: opts.existingEmail || '',
    existing_password: opts.existingPassword || ''
  };

  const fetchPromise = fetch('api/auth.php?action=oauth', {
    method:'POST', headers:{'Content-Type':'application/json'},
    body: JSON.stringify(payload), credentials:'include'
  }).then(r=>r.json());

  const [res] = await Promise.all([fetchPromise, (window.__fitnessRunBoot?.() || Promise.resolve())]);
  if (res?.success) setTimeout(()=>{ window.location.href = 'index.php'; }, 200);
}
