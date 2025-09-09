⚠️ Demo Notice This interface is a demonstration prototype.
While it simulates account creation and login flows, no actual data is stored or transmitted. Authentication, logging, and backend services are not connected—form submissions are purely for UI testing purposes.A


Account Access
📌 Overview
This interface provides two core functions for user account management:
- Sign In – For existing users to log in using credentials or third‑party providers.
- Create Account – For new users to register with required personal details.
The design is split into two side‑by‑side panels for quick navigation and clarity.

🔑 Features
Sign In Panel
- Username or Email – Text input for registered account identifiers.
- Password – Secure password input.
- Third‑Party Authentication:
- Continue with Google
- Continue with Microsoft
- Continue with Apple
- Primary Action: Sign in button.
Create Account Panel
- Username – Unique identifier for the new account.
- Password – Minimum 8 characters (validation enforced).
- Age – Must be greater than 15.
- Gender – Radio button selection: Male, Female, Other.
- Educational Qualifications – Multiple selection via checkboxes:
- O/L
- A/L
- Diploma
- Degree
- Postgraduate
- Country – Dropdown list for country selection.
- Primary Action: Create account button.
🛠 Technical Notes
- Form Validation:
- Password length check (≥ 8 characters).
- Age check (> 15).
- Required fields: Username, Password, Age, Country.
- Accessibility:
- Labels associated with all inputs.
- Keyboard navigation supported.
- High‑contrast mode compatible.
- Security:
- Password fields masked.
- HTTPS recommended for all data submissions.
- Third‑party sign‑in uses OAuth 2.0.
🚀 Usage
- Clone or download the repository.
- Open index.html in a browser or serve via a local dev server.
- Configure backend endpoints for:
- /login
- /register
- OAuth callback URLs for Google, Microsoft, Apple.
- Test form validation and authentication flows.

📌 Future Enhancements
- Add password strength meter.
- Implement real‑time username availability check.
- Enable multi‑language support.
- Integrate reCAPTCHA for bot prevention.

🔍 Features Overview
1. Home & Navigation
Clean, responsive layout with intuitive navigation

Sectional highlights: About, Membership, Equipment, Tips, Shop, Feedback, and Contact

2. Account System (Demo Only)
Simulated login and registration flows

Multi-account access simulation: switch between mock user profiles

Account overview panel: displays user role, membership status, and quick links

Adaptive greetings and visuals based on user context

3. Membership & Pricing
Dynamic pricing cards with updated offers

Visual breakdown of membership tiers and benefits

4. Trainer Booking
Interactive booking form (non-functional)

Placeholder logic for trainer selection and time slot reservation

5. Shop Interface
Cart icon and simulated product listing

UI-ready for future e-commerce integration

6. Feedback & Contact
Form-based feedback submission (demo only)

Contact section with mock support email and live chat trigger

7. Theme & Accessibility
Light/Dark mode toggle (☀️ icon)

Scalable UI elements for accessibility testing

Justified text and adaptive iconography for visual balance

🧠 Tech Stack
HTML5 / CSS3: Semantic structure and responsive styling

JavaScript (Vanilla): UI interactions and simulated logic

Modular Design: Easily extendable components for real backend integration

🔄 Future Enhancements (Suggested)
Real authentication and session management

Role-based dashboards (Admin, Trainer, Member)

Integrated booking and payment systems

Accessibility audit and WCAG compliance

Backend API integration (Node.js / Firebase / ASP.NET)
