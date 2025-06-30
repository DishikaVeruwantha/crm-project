<div align="center">

# 🚀 CRM System

### Customer Invoice & Proposal Management System

*Streamline your business billing and customer handling with modern, secure, and intuitive management system*

[![Laravel](https://img.shields.io/badge/Laravel-10-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Vue.js](https://img.shields.io/badge/Vue.js-3-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white)](https://vuejs.org)
[![Inertia.js](https://img.shields.io/badge/Inertia.js-Latest-9553E9?style=for-the-badge&logo=inertia&logoColor=white)](https://inertiajs.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Stripe](https://img.shields.io/badge/Stripe-626CD9?style=for-the-badge&logo=Stripe&logoColor=white)](https://stripe.com)
[![Mailtrap](https://img.shields.io/badge/Mailtrap-5A4FCF?style=for-the-badge&logo=mailtrap&logoColor=white)](https://mailtrap.io)


[🌐 **Live Demo**](https://your-domain.com) • [📖 **Documentation**](#-installation-guide) • [🐛 **Report Bug**](mailto:veruwanthadishika@gmail.com) • [💡 **Request Feature**](mailto:veruwanthadishika@gmail.com)

---

</div>

## 🎯 What is CRM?

**CRM** is a cutting-edge web-based invoicing and proposal management system designed for the modern business. Built with Laravel's robust backend and Vue.js's reactive frontend, it provides a seamless experience for managing customers, generating proposals, issuing invoices and send through Mailtrap, and collecting payments securely through Stripe.

> 💼 **Perfect for:** Freelancers, Small Businesses, Agencies, and Growing Teams

---

## ✨ Key Features

<table>
<tr>
<td width="50%">

### 👥 **Customer Management**
- ✅ Complete CRUD operations
- ✅ Status management (Active/Inactive)
- ✅ Relationship tracking with proposals & invoices
- ✅ Customer history and analytics

</td>
<td width="50%">

### 📋 **Proposal System**
- ✅ Professional proposal generation
- ✅ Status tracking (Pending/Approved/Rejected)
- ✅ Customer linking and management

</td>
</tr>
<tr>
<td width="50%">

### 🧾 **Invoice Management**
- ✅ Dynamic invoice creation
- ✅ Payment status tracking
- ✅ Automated notifications

</td>
<td width="50%">

### 💳 **Secure Payments**
- ✅ Stripe Checkout integration
- ✅ PCI-compliant payment processing
- ✅ Real-time payment validation
- ✅ Success/failure handling

</td>
</tr>
</table>

### 🎨 **User Experience**
- 🚀 **Lightning Fast** - Inertia.js SPA experience
- 🎭 **Beautiful UI** - Tailwind CSS design system
- 🔔 **Smart Alerts** - SweetAlert2 integration
- 📱 **Responsive** - Works on all devices

---

## 🛠 Tech Stack

<div align="center">

| Backend | Frontend | Styling | Payments | Alerts | Mails |
|---------|----------|---------|----------|---------|-------|
| ![Laravel](https://img.shields.io/badge/-Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white) | ![Vue.js](https://img.shields.io/badge/-Vue.js-4FC08D?style=flat-square&logo=vue.js&logoColor=white) | ![Tailwind](https://img.shields.io/badge/-Tailwind-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white) | ![Stripe](https://img.shields.io/badge/-Stripe-626CD9?style=flat-square&logo=stripe&logoColor=white) | ![SweetAlert2](https://img.shields.io/badge/-SweetAlert2-FF6B6B?style=flat-square) | ![Mailtrap](https://img.shields.io/badge/-Mailtrap-5A4FCF?style=flat-square&logo=mailtrap&logoColor=white) |
 
</div>

---

## 🚀 Quick Start

### Prerequisites

Before you begin, ensure you have:
- PHP 8.1+ installed
- Laravel 10+ installed
- Composer installed
- Node.js 16+ and npm
- A Stripe account (for payments)
- MySQL or another database server
- Mailtrap account (for email testing)

### 1️⃣ Clone & Install

```bash
# Clone the repository
git clone https://github.com/DishikaVeruwantha/crm-project.git
cd crm-project

# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 2️⃣ Environment Setup

```bash
# Create environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 3️⃣ Configure Environment

Update your `.env` file with the following:

```env
APP_NAME=CRM
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=invocrm
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Stripe Configuration
STRIPE_KEY=pk_test_your_publishable_key
STRIPE_SECRET=sk_test_your_secret_key

# Mailtrap Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
```

### 4️⃣ Database Setup

```bash
# Run migrations
php artisan migrate

# (Optional) Seed with sample data
php artisan db:seed
```

### 5️⃣ Build & Launch

```bash
# Build frontend assets
npm run dev

# Start the development server
php artisan serve
```

🎉 **That's it!** Visit [http://localhost:8000](http://localhost:8000) to see your CRM installation.

---

## 💳 Testing Payments

Use these Stripe test cards for development:

| Card Number | Brand | Result |
|-------------|-------|---------|
| `4242 4242 4242 4242` | Visa | ✅ Success |
| `4000 0000 0000 0002` | Visa | ❌ Declined |
| `4000 0000 0000 9995` | Visa | ⚠️ Insufficient Funds |

**Other Details:**
- **Expiry:** Any future date (e.g., 12/25)
- **CVC:** Any 3 digits (e.g., 123)
- **ZIP:** Any 5-digit number (e.g., 12345)

---

## 📁 Project Architecture

```
invocrm/
├── 🎛️ app/
│   ├── Http/Controllers/     # API & Web Controllers
│   ├── Models/              # Eloquent Models
│   └── Services/            # Business Logic
├── 🎨 resources/
│   ├── js/
│   │   ├── Pages/           # Vue.js Pages
│   │   │   ├── Customers/   # Customer Management
│   │   │   ├── Proposals/   # Proposal System
│   │   │   └── Invoices/    # Invoice Management
│   │   └── Components/      # Reusable Components
│   └── css/                 # Styling
├── 🛣️ routes/
│   └── web.php              # Application Routes
├── 🗄️ database/
│   └── migrations/          # Database Schema
└── ⚙️ config/               # Configuration Files
```

---

## 🚀 Deployment

### Production Checklist

- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Configure production database
- [ ] Set live Stripe keys
- [ ] Run `npm run build` for optimized assets
- [ ] Set up SSL certificate
- [ ] Configure caching and queues

### Recommended Platforms

| Platform | Best For | Difficulty |
|----------|----------|------------|
| [Laravel Forge](https://forge.laravel.com) | Full Laravel apps | 🟢 Easy |
| [DigitalOcean](https://digitalocean.com) | Custom setups | 🟡 Medium |
| [AWS](https://aws.amazon.com) | Enterprise scale | 🔴 Advanced |

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run with coverage
php artisan test --coverage
```

---

## 🤝 Contributing

We love contributions! Here's how you can help:

1. 🍴 **Fork** the repository
2. 🌿 **Create** a feature branch (`git checkout -b feature/amazing-feature`)
3. 💾 **Commit** your changes (`git commit -m 'Add amazing feature'`)
4. 📤 **Push** to the branch (`git push origin feature/amazing-feature`)
5. 🔄 **Open** a Pull Request

---

## 📞 Support & Contact

<div align="center">

**Need help? We're here for you!**

[![Email](https://img.shields.io/badge/Email-veruwanthadishika@gmail.com-D14836?style=for-the-badge&logo=gmail&logoColor=white)](mailto:veruwanthadishika@gmail.com)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-Dishika_Veruwantha-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)](https://linkedin.com/in/dishika-veruwantha)
[![GitHub](https://img.shields.io/badge/GitHub-Follow-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/DishikaVeruwantha)

</div>

---

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

<div align="center">

**Made by [Dishika Veruwantha](https://github.com/DishikaVeruwantha)**

⭐ **Star this repo if you found it helpful!**

</div>
```
