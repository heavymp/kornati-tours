# Kornati Tours 🏝️

A modern web application for exploring and booking tours in the beautiful Kornati Islands archipelago. Built with Laravel 11 and React, offering a seamless user experience for discovering the natural wonders of Croatia's coast.

## 🚀 Tech Stack

- **Backend:** Laravel 11
- **Frontend:** React + Vite
- **Styling:** Tailwind CSS
- **Database:** MySQL
- **Development:** Hot Module Replacement (HMR)

## ✨ Features

- Modern React components with TypeScript
- Laravel backend API
- Real-time development with HMR
- Responsive design with Tailwind CSS
- Database-driven content management
- Session handling and user authentication

## 🛠️ Local Development Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/heavymp/kornati-tours.git
   cd kornati-tours
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Setup**
   - Create a MySQL database named 'kornati_tours'
   - Update .env with your database credentials
   - Run migrations:
     ```bash
     php artisan migrate
     ```

5. **Start Development Servers**
   ```bash
   # Terminal 1: Laravel Server
   php artisan serve

   # Terminal 2: Vite Development Server
   npm run dev
   ```

6. **Access the Application**
   - Laravel: [http://localhost:8000](http://localhost:8000)
   - Vite Dev Server: [http://localhost:5173](http://localhost:5173)

## 🌐 Production Deployment

1. Build frontend assets:
   ```bash
   npm run build
   ```

2. Configure your web server to point to the `/public` directory

3. Set up appropriate environment variables for production

## 📝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Support

For support, please open an issue in the GitHub repository or contact the development team. 