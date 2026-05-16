# 🛒 MV Shop — Laravel E-Commerce Application

A full-featured e-commerce web application built with **Laravel**, featuring product management, a shopping cart, user authentication, and order processing.

---

## 🚀 Live Demo

>

---

## ✨ Features

- 🔐 **User Authentication** — Register, login, and account management
- 🛍️ **Product Catalog** — Browse and search products with categories and filters
- 🛒 **Shopping Cart** — Add, update, and remove items in real time
- 📦 **Order Management** — Place orders and track order history
- 🔑 **Admin Panel** — Manage products, categories, orders, and users
- 📱 **Responsive Design** — Mobile-friendly UI with Bootstrap 5
- 🗃️ **Database Seeding** — Sample data for quick setup and testing

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8, Laravel 10/12 |
| Frontend | Blade, Bootstrap 5, JavaScript |
| Database | MySQL, Eloquent ORM |
| Auth | Laravel Breeze / Sanctum |
| Build Tools | Vite, NPM, Composer |
| Version Control | Git / GitHub |

---

## 📋 Requirements

- PHP >= 8.1
- Composer
- Node.js >= 18 & NPM
- MySQL >= 8.0
- Git

---

## ⚙️ Installation

### 1. Clone the Repository

```bash
git clone https://github.com/shamimgalaxy/mv-shop.git
cd mv-shop
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Update your `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mv_shop
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Run Migrations & Seed Database

```bash
php artisan migrate --seed
```

### 6. Build Frontend Assets

```bash
npm run dev
```

### 7. Start the Development Server

```bash
php artisan serve
```

Visit: [http://localhost:8000](http://localhost:8000)

---

## 🗂️ Project Structure

```
mv-shop/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/               # Eloquent models
│   └── ...
├── database/
│   ├── migrations/           # Database schema
│   └── seeders/              # Sample data
├── resources/
│   ├── views/                # Blade templates
│   └── ...
├── routes/
│   ├── web.php               # Web routes
│   └── api.php               # API routes
└── ...
```

---

## 🔑 Default Credentials (After Seeding)

| Role | Email | Password |
|---|---|---|
| Admin | admin@example.com | password |
| User | user@example.com | password |

> ⚠️ Change these credentials before deploying to production.

---

## 📸 Screenshots

> 

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a new branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m "Add your feature"`
4. Push to the branch: `git push origin feature/your-feature`
5. Open a Pull Request

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 👨‍💻 Author

**Shamim Ahmed**
- GitHub: [@shamimgalaxy](https://github.com/shamimgalaxy)
- LinkedIn: [linkedin.com/in/shamimgalaxy](https://linkedin.com/in/shamimgalaxy)
- Email: shamimgalaxy@gmail.com

---

> Built with ❤️ using Laravel
