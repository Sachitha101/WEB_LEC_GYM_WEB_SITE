<?php
// Simple Charts page using Chart.js CDN
?>
<section class="content-card" aria-labelledby="chartsTitle">
  <header class="card-header">
    <h2 id="chartsTitle">Analytics Charts</h2>
    <p class="muted">Quick look at sample site metrics.</p>
  </header>

  <div class="card-body" style="display:grid; gap:24px;">
    <div class="panel">
      <h3 class="panel-title">Weekly Signups</h3>
      <canvas id="signupChart" height="120" aria-label="Weekly signups chart" role="img"></canvas>
    </div>

    <div class="panel">
      <h3 class="panel-title">Orders by Category</h3>
      <canvas id="ordersChart" height="120" aria-label="Orders by category chart" role="img"></canvas>
    </div>
  </div>
</section>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js" crossorigin="anonymous"></script>
<script>
  (function(){
    const primary = getComputedStyle(document.documentElement).getPropertyValue('--accent') || '#2563eb';
    const neutral = getComputedStyle(document.documentElement).getPropertyValue('--text-muted') || '#64748b';

    // Weekly Signups (line)
    const ctx1 = document.getElementById('signupChart');
    if (ctx1) new Chart(ctx1, {
      type: 'line',
      data: {
        labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
        datasets: [{
          label: 'Signups',
          data: [5, 7, 6, 10, 12, 9, 4],
          fill: false,
          borderColor: primary.trim(),
          tension: 0.25,
          pointRadius: 3
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: true } },
        scales: { y: { beginAtZero: true } }
      }
    });

    // Orders by Category (doughnut)
    const ctx2 = document.getElementById('ordersChart');
    if (ctx2) new Chart(ctx2, {
      type: 'doughnut',
      data: {
        labels: ['Supplements', 'Equipment', 'Apparel', 'Accessories'],
        datasets: [{
          label: 'Orders',
          data: [35, 25, 20, 20],
          backgroundColor: ['#22c55e', '#3b82f6', '#f59e0b', '#ef4444']
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } }
      }
    });
  })();
</script>
