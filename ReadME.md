## ⚠️ Demo Notice
This is a **UI prototype** for account management.  
No real data is stored or transmitted. Backend services are **not connected**.

---

## 🔐 Account Access Overview

| Function         | Description                                                                 |
|------------------|-----------------------------------------------------------------------------|
| 🔑 Sign In        | Existing users log in via credentials or third-party providers              |
| 🆕 Create Account | New users register with personal details                                    |
| 🧭 Layout         | Split-panel design for quick navigation and clarity                         |

---

## 🧾 Sign In Panel

| Field                     | Type                     |
|---------------------------|--------------------------|
| Username / Email          | Text input               |
| Password                  | Secure input (masked)    |
| Third-Party Auth          | Google / Microsoft / Apple |
| ✅ Primary Action          | Sign In button           |

---

## 📝 Create Account Panel

| Field                     | Type / Validation                              |
|---------------------------|------------------------------------------------|
| Username                  | Unique identifier                              |
| Password                  | ≥ 8 characters                                 |
| Age                       | Must be > 15                                   |
| Gender                    | Radio: Male / Female / Other                   |
| Education                 | Checkboxes: O/L, A/L, Diploma, Degree, PG      |
| Country                   | Dropdown list                                  |
| ✅ Primary Action          | Create Account button                          |

---

## 🛠 Technical Notes

- ✅ **Validation**: Password length, age check, required fields
- ♿ **Accessibility**: Labels, keyboard nav, high-contrast mode
- 🔒 **Security**: Masked passwords, OAuth 2.0, HTTPS recommended

---

## 🚀 Usage Instructions

1. Clone/download repo  
2. Open `index.html` locally or via dev server  
3. Configure endpoints: `/login`, `/register`, OAuth callbacks  
4. Test form validation and flows  

---

## 🌟 Future Enhancements

| Feature                          | Status     |
|----------------------------------|------------|
| Password strength meter          | Planned    |
| Real-time username check         | Planned    |
| Multi-language support           | Planned    |
| reCAPTCHA integration            | Planned    |

---

## 🔍 UI Features Overview

| Section             | Highlights                                                                 |
|---------------------|----------------------------------------------------------------------------|
| 🏠 Home & Navigation | Responsive layout, About, Membership, Shop, Feedback, Contact              |
| 👤 Account System    | Simulated login/register, mock profiles, adaptive visuals                  |
| 💳 Membership        | Dynamic pricing cards, tier breakdown                                     |
| 🏋️ Trainer Booking   | Placeholder booking form, trainer/time slot logic                         |
| 🛒 Shop Interface     | Cart icon, product listing, e-commerce-ready UI                           |
| 💬 Feedback & Contact| Form-based feedback, mock support email, live chat trigger                |
| 🎨 Theme & Access     | Light/Dark toggle ☀️, scalable UI, adaptive icons                         |

---

## 🧠 Tech Stack

| Tech              | Purpose                                      |
|-------------------|----------------------------------------------|
| HTML5 / CSS3      | Semantic structure, responsive styling       |
| JavaScript (Vanilla) | UI interactions, simulated logic         |
| Modular Design    | Extendable components for backend integration|

---

## 🔄 Suggested Enhancements

- 🔐 Real authentication & session management  
- 🧑‍💼 Role-based dashboards (Admin, Trainer, Member)  
- 💳 Integrated booking & payment systems  
- ♿ Accessibility audit (WCAG compliance)  
- 🔗 Backend API integration (Node.js / Firebase / ASP.NET)
