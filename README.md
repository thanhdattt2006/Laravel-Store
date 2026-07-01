# 🛒 Laravel-Store

[![Laravel Version](https://img.shields.io/badge/Laravel-9.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![Database](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com)
[![Docker](https://img.shields.io/badge/Docker-Enabled-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com)

Laravel-Store is a modern, fully-featured, and containerized E-Commerce Web Application built using **Laravel 9** and **PHP 8.2**. It provides customers with a seamless shopping experience and offers store owners an intuitive, powerful admin panel to manage inventory, categories, orders, accounts, and marketing materials.

---

## ✨ Key Features

### 👤 Customer Experience

- **Intuitive Product Browsing:** Filter products by category, price range, and search by keywords dynamically.
- **Robust Shopping Cart & Checkout:** Add products, update quantities, choose sizes/colors, apply promo vouchers, and complete orders with immediate billing confirmations.
- **Wishlist & Comparison:** Track favorite items and compare technical specifications before buying.
- **Reviews & Testimonials:** Share feedback and rate products or write comments on store blog posts.
- **User Dashboard:** View and update profile information, track personal orders, and manage authentication details.

### 🔑 Administrator Portal (Protected Area)

- **Dashboard Analytics:** Get an overview of products, categories, orders, and users.
- **Inventory & Category Control:** Full CRUD operation for products (with image uploads) and product categories.
- **Order & Invoice Management:** Track order statuses, edit order details, delete records, and generate clean HTML invoices/bills.
- **Content Management System (CMS):** Create, update, or remove homepage slides, blog posts, and customizable "About Us" sections.
- **User & Review Moderation:** Reset user passwords, delete unauthorized accounts, and moderate product reviews or blog comments.

---

## 🛠️ Tech Stack

- **Backend Framework:** [Laravel 9.x](https://laravel.com/)
- **Language:** [PHP 8.2](https://www.php.net/)
- **Database:** MySQL
- **Frontend Engine:** Blade Template Engine, Vanilla CSS, JS (AJAX integration)
- **Containerization & Deployment:** Docker, Render/Railway integration configs

---

## 🚀 Getting Started

Follow the instructions below to run this project locally.

### 📋 Prerequisites

Make sure you have installed:

- PHP >= 8.2
- Composer (latest version)
- Node.js & npm (for asset compilation)
- MySQL

### 💻 Local Installation Steps

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/thanhdattt2006/Laravel-Store.git
    cd Laravel-Store
    ```

2.  **Install dependencies:**

    ```bash
    composer install
    npm install && npm run build
    ```

3.  **Setup environment file:**
    Duplicate the `.env.example` file and name it `.env`:

    ```bash
    cp .env.example .env
    ```

4.  **Configure Database:**
    Open your `.env` file and configure your database settings:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel_store
    DB_USERNAME=root
    DB_PASSWORD=your_password
    ```

5.  **Generate application key:**

    ```bash
    php artisan key:generate
    ```

6.  **Run migrations & seeders:**

    ```bash
    php artisan migrate --seed
    ```

7.  **Run local server:**
    ```bash
    php artisan serve
    ```
    Your application will be live at `http://127.0.0.1:8000`.

---

## 🐳 Docker Deployment

This repository includes a multi-stage Docker environment ready for cloud deployments (e.g., Render, Railway, AWS).

To build the Docker image locally:

```bash
docker build -t laravel-store .
```

To run the container:

```bash
docker run -p 8080:8080 -e PORT=8080 laravel-store
```

The application will run on port `8080`.

---

## 📂 Project Structure

```text
Laravel-Store/
├── app/                  # Application core logic (Controllers, Models, Services)
│   ├── Http/             # Controllers, Middlewares & Requests
│   └── Models/           # Eloquent Database Models
├── bootstrap/            # Application bootstrapping scripts
├── config/               # Configuration files
├── database/             # Migrations, Seeders & Factories
├── public/               # Assets (CSS, JS, Images, Front Controller)
├── resources/            # Views (Blade), Sass, JS source files
├── routes/               # Web & API routes configuration
├── storage/              # Logs, compiled templates, sessions
├── Dockerfile            # Container definition for production hosting
└── README.md             # Project documentation (this file)
```

---

## 📄 License

This project is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).
