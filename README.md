# Fitness Club — Windows 11–inspired web app ✨

Glassmorphism UI, smooth motion, and rounded corners—built with PHP, MySQL, and vanilla JS. Clean, modular, and ready to run on XAMPP.

> A modern fitness club experience with memberships, booking, shop/cart, feedback, and account management—all with Windows 11 vibes.

---

## 🚀 Overview

- **Win11 aesthetics:** Mica/glass, soft shadows, rounded corners, subtle motion, and accessible contrast.
- **Modular PHP:** Reusable header/footer, includes, and session-based user state.
- **REST-like PHP endpoints:** Auth, account, feedback (simple and extendable).
- **Quick DB bootstrap:** MySQL schema and helper scripts for fast local setup.

> Tip: PHP 8.x on XAMPP is recommended for best performance and compatibility.

---

## 🧭 Features at a glance

| Area | Highlights | Status |
|---|---|---|
| 🏠 Home dashboard | Hero section, quick actions, progress metrics | Ready |
| 🏢 Franchise | Interactive investment calculator, timeline, testimonials | Ready |
| 📰 News | Category tabs, featured carousel, masonry cards | Ready |
| 💳 Membership | Tiered plans, feature lists, FAQs | Ready |
| 📅 Booking | Class and personal trainer reservations | Ready |
| 🛒 Shop | Product cards, category chips, cart widget, checkout modal | Ready |
| 🖼️ PowerZone gallery | Lazy-loaded grid + enhanced lightbox | Ready |
| 💬 Feedback | Inline form + modal with sentiment selection | Ready |
| 🔐 Auth & account | Login, create account, session-aware area | Ready |

> Sources: modular pages with clean URLs and simple JavaScript controllers.

---

## 🧰 Tech stack

| Layer | Tools | Notes |
|---|---|---|
| Frontend | HTML5, CSS3, Vanilla JS | Glassmorphism/Mica components, responsive layout, ARIA |
| Backend | PHP (XAMPP/Apache) | Sessions, includes, REST-like routes |
| Database | MySQL/MariaDB | Schema in `sql/database.sql` |
| Local dev | XAMPP on Windows | Apache + MySQL |

---

## 📦 Project structure

```text
/
├─ api/
│  ├─ auth.php
│  ├─ account.php
│  └─ feedback.php
├─ assets/
│  ├─ css/               # Glass/mica styles, tokens, utilities
│  ├─ js/
│  │  ├─ app.js          # Global UI, theming, nav, dialogs
│  │  ├─ cart.js         # Cart state & checkout modal
│  │  ├─ create_account.js
│  │  └─ login.js
│  └─ images/
├─ includes/
│  ├─ init.php           # Sessions, config, helpers
│  ├─ header.php         # App bar, nav, theme toggle
│  └─ footer.php         # Footer, modals, scripts
├─ sql/
│  └─ database.sql       # Tables, seed data
├─ index.php             # Home dashboard
├─ membership.php
├─ booking.php
├─ shop.php
├─ gallery.php
├─ feedback.php
├─ login.php
└─ create_account.php
```

> Keep UI pieces atomic: cards, chips, pills, command bars, and modal sheets for consistency.

---

## ⚙️ Setup and usage

1. **Clone**
   - git clone https://github.com/your-username/fitness-club.git
   - Place in XAMPP htdocs (e.g., C:/xampp/htdocs/fitness-club)

2. **Start services**
   - Start Apache and MySQL from XAMPP Control Panel

3. **Create database**
   - Open phpMyAdmin → Create DB (e.g., fitness_club)
   - Import sql/database.sql

4. **Configure**
   - Update DB creds in includes/init.php if needed
   - Ensure PHP 8.x is enabled in XAMPP

5. **Run**
   - Visit http://localhost/fitness-club

> Optional: Add a virtual host for cleaner URLs and cookie isolation.

---

## 🔌 API routes (REST-like, simple)

| Route | Method | Purpose |
|---|---|---|
| /api/auth.php | POST | Login/Logout |
| /api/account.php | GET/POST | Fetch/update account profile |
| /api/feedback.php | POST | Submit feedback with sentiment |
| /api/oauth.php | GET | Placeholder for OAuth flows |

> Responses use JSON; PHP sessions track auth state. Extend with JWT or real OAuth when you wire a production backend.

---

## 🗄️ Database highlights

- **users:** id, name, email, password_hash, role, created_at
- **memberships:** plan tiers, pricing, features
- **classes/trainers:** scheduling metadata for booking
- **products/orders/cart_items:** shop & checkout flow
- **feedback:** message, rating/sentiment, timestamps

> Import sql/database.sql to bootstrap tables and optional sample data.

---

## 🖌️ UI/UX notes (Windows 11 feel)

- **Glass/Mica:** Backdrop blur with layered opacities, subtle noise, and elevation tokens.
- **Motion:** Micro-animations on hover/press; smooth sheet and modal transitions.
- **Rounded geometry:** 8–12px radii, pill-shaped chips, soft shadows.
- **Accessibility:** ARIA landmarks, focus states, color contrast, reduced motion support.
- **Theming:** Light/Dark toggle with CSS custom properties; iconography adapts to theme.

---

## 🗺️ Roadmap

- **Auth:** Password strength meter, reCAPTCHA, email verification
- **Booking:** Trainer availability logic, calendar sync
- **Shop:** Payment gateway integration, order history
- **Accessibility:** WCAG audit, keyboard shortcuts, high-contrast pass
- **Localization:** Multi-language strings and RTL support
- **Admin views:** Role-based dashboards (Admin, Trainer, Member)

---

## 🤝 Contributing

- **Style:** Keep components atomic and accessible.
- **Commits:** Clear, scoped messages (feat:, fix:, ui:, docs:).
- **PRs:** Include screenshots for UI changes and short test notes.

---

## 📄 License

This project is open-source under the Unlicense. Free to use, modify, and distribute.

---
