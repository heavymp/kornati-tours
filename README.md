# Kornati Tours Management System

A modern tour management system built with Laravel and Filament, designed to streamline tour operations and bookings for Kornati Islands archipelago tours. This system provides a robust platform for managing tours, bookings, and customer interactions.

![Current Version](https://img.shields.io/badge/version-0.2.0-blue.svg)
![PHP Version](https://img.shields.io/badge/PHP-8.2+-green.svg)
![Laravel Version](https://img.shields.io/badge/Laravel-10.x-red.svg)

## About

Kornati Tours Management System is a specialized software solution for managing boat tours and excursions in the Kornati Islands archipelago. It provides tour operators with tools for managing bookings, schedules, and customer interactions through an intuitive admin interface.

### Current Version: 0.2.0
- Enhanced user management with role-based access
- Theme support with custom branding
- Improved UI/UX with loading indicators
- Full SPA functionality

## Features

### User Management
- Role-based access control (ADMIN and AGENT roles)
- Secure authentication and authorization
- User CRUD operations with proper validation

### Theme Support
- Light and dark theme switching
- Custom branding with theme-aware logos
- Responsive design for all screen sizes

### UI/UX
- Loading indicators for better feedback
- SPA-like navigation for smooth transitions
- Organized navigation with proper grouping

### Email System
- Configurable email settings
- Secure API key management
- Test email functionality

## Requirements

- PHP 8.2+
- Laravel 10.x
- Node.js & NPM
- MySQL 8.0+

## Installation

1. Clone the repository:
```bash
git clone https://github.com/heavymp/kornati-tours.git
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install NPM dependencies:
```bash
npm install
```

4. Copy environment file and configure:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Run migrations:
```bash
php artisan migrate
```

7. Create admin user:
```bash
php artisan make:filament-user
```

## Development

- Build assets: `npm run dev`
- Watch assets: `npm run watch`
- Production build: `npm run build`

## Version History

See [CHANGELOG.md](CHANGELOG.md) for a detailed list of changes in each version.

## License

This project is proprietary software. All rights reserved.

## Configuration

### Email Settings

The application uses Brevo for email delivery. To configure email settings:

1. Log in to the admin panel
2. Navigate to Settings > Email Settings
3. Enter your Brevo API key
4. Configure the "From" address and name
5. Test the configuration using the test email feature 