<?php
require_once 'includes/init.php';

// Get the current page from URL parameter
$page = $_GET['page'] ?? 'home';

// Validate page parameter to prevent directory traversal
$allowedPages = ['home', 'membership', 'booking', 'shop', 'powerzone', 'news', 'franchise', 'feedback', 'feedback_feature', 'feedback_general', 'feedback_support', 'feedback_issue', 'account', 'login', 'create_account', 'checkout'];
if (!in_array($page, $allowedPages)) {
    $page = 'home';
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? 'Guest';
$userEmail = $_SESSION['user_email'] ?? '';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Fitness Club — Premium Gym</title>
    <!-- Apply theme ASAP to avoid white flash -->
    <script>
        (function(){
            try{
                var saved = localStorage.getItem('theme');
                var isDark = saved ? saved === 'dark' : true; // default to dark
                document.documentElement.classList.toggle('dark', isDark);
            }catch(e){ document.documentElement.classList.add('dark'); }
        })();
    </script>
    <link rel="stylesheet" href="assets/styles.css">
  <meta name="description" content="Fitness Club — membership, trainer booking, shop, and feedback. Windows 11 inspired UI." />
    <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="assets/favicon.svg?v=1">
        <link rel="alternate icon" href="assets/favicon.svg?v=1">
    <meta name="theme-color" content="#0b1220" media="(prefers-color-scheme: dark)">
    <meta name="theme-color" content="#ffffff" media="(prefers-color-scheme: light)">

  <!-- Include SVG icons -->
  <object type="image/svg+xml" data="assets/icons.svg" style="display: none;" aria-hidden="true"></object>

  <!-- Load dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/idb@7/build/umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bcryptjs@2.4.3/dist/bcrypt.min.js"></script>

  <!-- Load our modules -->
  <script type="module" src="assets/js/db.js"></script>
  <script type="module" src="assets/js/api-shim.js"></script>
  <script type="module" src="assets/js/feedback.js"></script>
    <script type="module" src="assets/js/cart.js"></script>
    <script type="module" src="assets/js/reveal.js"></script>
</head>
<body class="<?php echo isset($_SESSION['membership_tier']) ? 'tier-' . htmlspecialchars($_SESSION['membership_tier']) : ''; ?>">
    <?php include 'includes/header.php'; ?>
          
    <main class="right-panel" style="flex:1;">
      <?php
      // Include the appropriate page content
      switch ($page) {
          case 'home':
              include 'pages/home.php';
              break;
          case 'membership':
              include 'pages/membership.php';
              break;
          case 'booking':
              include 'pages/booking.php';
              break;
          case 'shop':
              include 'pages/shop.php';
              break;
          case 'powerzone':
              include 'pages/powerzone.php';
              break;
          case 'news':
              include 'pages/news.php';
              break;
          case 'franchise':
              include 'pages/franchise.php';
              break;
          case 'feedback':
              include 'pages/feedback.php';
              break;
          case 'feedback_feature':
              include 'pages/feedback_feature.php';
              break;
          case 'feedback_general':
              include 'pages/feedback_general.php';
              break;
          case 'feedback_support':
              include 'pages/feedback_support.php';
              break;
          case 'feedback_issue':
              include 'pages/feedback_issue.php';
              break;
          case 'account':
              include 'pages/account.php';
              break;
          case 'login':
              include 'pages/login.php';
              break;
          case 'create_account':
              include 'pages/create_account.php';
              break;
          case 'checkout':
              include 'pages/checkout.php';
              break;
          default:
              include 'pages/home.php';
              break;
      }
      ?>
    </main>

    <?php include 'includes/footer.php'; ?>

  <script>
    // JavaScript for dynamic functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Update digital clock
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', {
                hour12: false,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            const dateString = now.toLocaleDateString('en-US', {
                weekday: 'short',
                month: 'short',
                day: 'numeric'
            });

            const clockElement = document.getElementById('digitalClock');
            if (clockElement) {
                clockElement.querySelector('.clock-time').textContent = timeString;
                clockElement.querySelector('.clock-date').textContent = dateString;
            }
        }

        updateClock();
        setInterval(updateClock, 1000);

        // Handle navigation (navigate instead of only pushState)
        const navItems = document.querySelectorAll('.nav-item, .mobile-nav-item');
        navItems.forEach(item => {
            item.addEventListener('click', function(e) {
                const section = this.getAttribute('data-section');
                const href = this.getAttribute('href') || `?page=${section}`;
                // Close mobile overlay if open
                if (this.classList.contains('mobile-nav-item')) {
                    const burger = document.getElementById('hamburgerToggle');
                    const overlay = document.getElementById('mobileNavOverlay');
                    if (burger) burger.setAttribute('aria-expanded', 'false');
                    if (overlay) overlay.setAttribute('aria-hidden', 'true');
                }
                // Force navigation so the server-side router includes the new page
                e.preventDefault();
                window.location.assign(href);
            });
        });

        // Theme toggle (uses html.dark to match CSS variables)
        const themeToggle = document.getElementById('themeToggle');
        const rootEl = document.documentElement; // <html>

        function applyTheme(mode) {
            const isDark = mode === 'dark';
            rootEl.classList.toggle('dark', isDark);
            if (themeToggle) themeToggle.setAttribute('aria-pressed', String(isDark));
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }

        // Initialize theme from saved preference or OS
        (function initTheme() {
            const saved = localStorage.getItem('theme');
            if (saved === 'dark' || saved === 'light') {
                applyTheme(saved);
                return;
            }
            // Fallback: respect OS preference
            const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            applyTheme(prefersDark ? 'dark' : 'light');
        })();

        if (themeToggle) {
            themeToggle.addEventListener('click', function() {
                const isDark = rootEl.classList.contains('dark');
                applyTheme(isDark ? 'light' : 'dark');
            });
        }

        // Handle hamburger menu
        const hamburgerToggle = document.getElementById('hamburgerToggle');
        const mobileNavOverlay = document.getElementById('mobileNavOverlay');

        if (hamburgerToggle && mobileNavOverlay) {
            hamburgerToggle.addEventListener('click', function() {
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !isExpanded);
                mobileNavOverlay.setAttribute('aria-hidden', isExpanded);
            });
        }
    });
  </script>
</body>
</html>