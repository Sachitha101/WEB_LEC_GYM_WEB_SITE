<?php
// Modern Fluent Design Navbar
// assumes $csrf_token provided by includes/init.php
?>
<header class="fluent-navbar" role="banner">
  <div class="navbar-container">
    <!-- Hamburger Menu Button -->
    <button class="hamburger-btn" id="hamburgerToggle" aria-label="Toggle navigation menu" aria-expanded="false">
      <svg class="hamburger-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="3" y1="12" x2="21" y2="12"></line>
        <line x1="3" y1="6" x2="21" y2="6"></line>
        <line x1="3" y1="18" x2="21" y2="18"></line>
      </svg>
    </button>

    <!-- Brand Section -->
    <div class="brand-section">
      <div class="brand-logo">
        <svg viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M8 8l8-4 8 4v16l-8 4-8-4V8z"/>
          <path d="M16 12v8"/>
          <path d="M12 16h8"/>
        </svg>
      </div>
      <span class="brand-text">Fitness Club</span>
    </div>

    <!-- Desktop Navigation -->
    <nav class="desktop-nav" id="desktopNav" role="navigation" aria-label="Main navigation">
      <a href="?page=home" class="nav-item" data-section="home" aria-label="Home">
        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        <span class="nav-label">Home</span>
      </a>

      <a href="?page=membership" class="nav-item" data-section="membership" aria-label="Membership">
        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
          <circle cx="12" cy="7" r="4"/>
        </svg>
        <span class="nav-label">Membership</span>
      </a>

      <a href="?page=booking" class="nav-item" data-section="booking" aria-label="Booking">
        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
          <line x1="16" y1="2" x2="16" y2="6"/>
          <line x1="8" y1="2" x2="8" y2="6"/>
          <line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
        <span class="nav-label">Booking</span>
      </a>

      <a href="?page=shop" class="nav-item" data-section="shop" aria-label="Shop">
        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="9" cy="21" r="1"/>
          <circle cx="20" cy="21" r="1"/>
          <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
        </svg>
        <span class="nav-label">Shop</span>
      </a>

      <a href="?page=powerzone" class="nav-item" data-section="powerzone" aria-label="PowerZone">
        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
        </svg>
        <span class="nav-label">PowerZone</span>
      </a>

      <a href="?page=news" class="nav-item" data-section="news" aria-label="News">
        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
          <polyline points="14,2 14,8 20,8"/>
          <line x1="16" y1="13" x2="8" y2="13"/>
          <line x1="16" y1="17" x2="8" y2="17"/>
          <polyline points="10,9 9,9 8,9"/>
        </svg>
        <span class="nav-label">News</span>
      </a>

      <a href="?page=franchise" class="nav-item" data-section="franchise" aria-label="Franchise">
        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>
        <span class="nav-label">Franchise</span>
      </a>

      <a href="?page=feedback" class="nav-item" data-section="feedback" aria-label="Feedback">
        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
        </svg>
        <span class="nav-label">Feedback</span>
      </a>

      <a href="?page=account" class="nav-item" data-section="account" aria-label="Account">
        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
          <circle cx="12" cy="7" r="4"/>
        </svg>
        <span class="nav-label">Account</span>
      </a>
    </nav>

    <!-- Right Section -->
    <div class="navbar-right">
      <!-- Digital Clock -->
      <div class="digital-clock" id="digitalClock" aria-live="polite">
        <span class="clock-time">--:--:--</span>
        <span class="clock-date">Loading...</span>
      </div>

      <!-- Theme Toggle -->
      <button class="theme-toggle-btn" id="themeToggle" aria-label="Toggle theme">
        <svg class="theme-icon light-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="5"/>
          <line x1="12" y1="1" x2="12" y2="3"/>
          <line x1="12" y1="21" x2="12" y2="23"/>
          <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
          <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
          <line x1="1" y1="12" x2="3" y2="12"/>
          <line x1="21" y1="12" x2="23" y2="12"/>
          <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
          <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
        </svg>
        <svg class="theme-icon dark-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
        </svg>
      </button>

      <!-- Notifications -->
      <button class="notification-btn" id="notificationBtn" aria-label="Notifications" aria-haspopup="true" aria-expanded="false">
        <svg class="notification-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
          <path d="M13.73 21a2 2 0 01-3.46 0"/>
        </svg>
        <span class="notification-badge" id="notificationBadge" aria-hidden="true">0</span>
      </button>
      <!-- Notification dropdown (fixed, toggled with JS) -->
      <div class="notification-menu" id="notificationMenu" role="menu" aria-hidden="true">
        <div class="nm-header">Notifications</div>
        <ul class="nm-list" id="notificationList"></ul>
      </div>
    </div>

    <!-- Mobile Navigation Overlay -->
    <div class="mobile-nav-overlay" id="mobileNavOverlay" aria-hidden="true">
      <nav class="mobile-nav" role="navigation" aria-label="Mobile navigation">
        <a href="?page=home" class="mobile-nav-item" data-section="home">
          <svg class="mobile-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
          </svg>
          <span>Home</span>
        </a>

        <a href="?page=membership" class="mobile-nav-item" data-section="membership">
          <svg class="mobile-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
          <span>Membership</span>
        </a>

        <a href="?page=booking" class="mobile-nav-item" data-section="booking">
          <svg class="mobile-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
          </svg>
          <span>Booking</span>
        </a>

        <a href="?page=shop" class="mobile-nav-item" data-section="shop">
          <svg class="mobile-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="9" cy="21" r="1"/>
            <circle cx="20" cy="21" r="1"/>
            <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
          </svg>
          <span>Shop</span>
        </a>

        <a href="?page=powerzone" class="mobile-nav-item" data-section="powerzone">
          <svg class="mobile-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
          </svg>
          <span>PowerZone</span>
        </a>

        <a href="?page=news" class="mobile-nav-item" data-section="news">
          <svg class="mobile-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
            <polyline points="14,2 14,8 20,8"/>
            <line x1="16" y1="13" x2="8" y2="13"/>
            <line x1="16" y1="17" x2="8" y2="17"/>
            <polyline points="10,9 9,9 8,9"/>
          </svg>
          <span>News</span>
        </a>

        <a href="?page=franchise" class="mobile-nav-item" data-section="franchise">
          <svg class="mobile-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
          </svg>
          <span>Franchise</span>
        </a>

        <a href="?page=feedback" class="mobile-nav-item" data-section="feedback">
          <svg class="mobile-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
          </svg>
          <span>Feedback</span>
        </a>

        <a href="?page=account" class="mobile-nav-item" data-section="account">
          <svg class="mobile-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
          <span>Account</span>
        </a>
      </nav>
    </div>
  </div>
</header>
<script>
// Lightweight notification menu toggler and positioning
(function(){
  const btn = document.getElementById('notificationBtn');
  const menu = document.getElementById('notificationMenu');
  if (!btn || !menu) return;

  function positionMenu(){
    const rect = btn.getBoundingClientRect();
    // Position menu so it's aligned with the button and stays fixed
    menu.style.top = Math.round(rect.bottom + 10) + 'px';
    // Prefer aligning right edge, but clamp inside viewport
    const desiredRight = Math.round(window.innerWidth - rect.right + 8);
    menu.style.right = desiredRight + 'px';
  }

  function openMenu(){
    positionMenu();
    menu.classList.add('show');
    menu.setAttribute('aria-hidden','false');
    btn.setAttribute('aria-expanded','true');
  }
  function closeMenu(){
    menu.classList.remove('show');
    menu.setAttribute('aria-hidden','true');
    btn.setAttribute('aria-expanded','false');
  }

  btn.addEventListener('click', (e)=>{
    e.stopPropagation();
    if (menu.classList.contains('show')) closeMenu(); else openMenu();
  });
  window.addEventListener('resize', ()=>{ if (menu.classList.contains('show')) positionMenu(); });
  window.addEventListener('scroll', ()=>{ if (menu.classList.contains('show')) positionMenu(); }, true);
  document.addEventListener('click', (e)=>{ if (!menu.contains(e.target) && e.target !== btn) closeMenu(); });
})();
</script>