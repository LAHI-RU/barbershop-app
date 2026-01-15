# BARBERSHOP.LK - Premium Grooming Management System

![Barbershop Banner](https://images.unsplash.com/photo-1503951914875-452162b0f3f1?q=80&w=2070&auto=format&fit=crop)

## Overview

**BARBERSHOP.LK** is a state-of-the-art management system designed for high-end barbershops. It combines a luxurious user experience with powerful administrative tools to manage appointments, barbers, and services seamlessly.

> [!IMPORTANT]
> This application is built with the latest modern web technologies to ensure performance, security, and a premium look.

## 🚀 Key Features

### Premium Frontend
- **Elegant Landing Page**: A high-impact, mobile-responsive design tailored for luxury branding.
- **Service Menu**: Dynamic display of grooming services with pricing and duration.
- **Barber Showcases**: Profiles of master artisans with their bios and images.

### Client Experience
- **Appointment Booking**: Simplified registration and booking flow for customers.
- **User Dashboard**: Customers can view and manage their upcoming appointments.

### Admin Suite
- **Management Dashboard**: A central hub for managing the entire shop's operations.
- **Resource Management**: Full CRUD operations for Barbers and Services.
- **Appointment Tracking**: Real-time status updates and management of client bookings.
- **Role-based Security**: Secure access control for administrators and clients.

## 🛠️ Tech Stack

- **Backend**: [Laravel 12](https://laravel.com) (PHP 8.2+)
- **Frontend**: [Livewire 3](https://livewire.laravel.com), [Tailwind CSS v4](https://tailwindcss.com)
- **Authentication**: [Laravel Jetstream](https://jetstream.laravel.com)
- **Bundling**: [Vite](https://vitejs.dev)
- **Database**: SQLite (Default) / MySQL

## ⚙️ Installation

To get this project running locally, follow these steps:

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd barbershop-app
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Setup**
   *(Ensure your .env is configured for SQLite or your preferred database)*
   ```bash
   touch database/database.sqlite
   php artisan migrate --seed
   ```

6. **Build Assets**
   ```bash
   npm run build
   ```

## 🖥️ Usage

Start the development server:

```bash
# Run Laravel server
php artisan serve

# Run Vite dev server (for hot reloads)
npm run dev
```

The application will be available at `http://localhost:8000`.

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This project is licensed under the [MIT License](LICENSE).
