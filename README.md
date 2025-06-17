<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# 🎼 Sonorus: Classical Music Streaming Platform

![Sonorus Logo](public/images/sonorus-logo.png)

**Sonorus** is an elegant and immersive classical music streaming platform built with **Laravel**. Tailored for classical music enthusiasts, it allows users to explore legendary composers, high-fidelity music playback, and beautiful UI/UX experiences.

---

## 📚 Table of Contents
- [✨ Features](#-features)
- [🧰 Technology Stack](#-technology-stack)
- [🚀 Installation](#-installation)
- [⚙️ Configuration](#️-configuration)
- [🎮 Usage](#-usage)
- [📂 Project Structure](#-project-structure)
- [📸 Screenshots](#-screenshots)
- [🤝 Contributing](#-contributing)
- [📄 License](#-license)
- [🙏 Acknowledgements](#-acknowledgements)

---

## ✨ Features

### 🧑‍💼 **User Roles**
- **Admin Dashboard**
  - 🎼 Composer management
  - 🎵 Music catalog administration
  - 👤 User management
  - 📊 Analytics & insights

- **User Interface**
  - 🧭 Browse classical compositions
  - 📁 Create & manage playlists
  - 🔎 Advanced search
  - 🎧 Elegant music player with seek controls

---

### 🎵 **Music Experience**
- **Composer Profiles**
  - 🧠 Biographical info & historical context
  - 🎶 Complete works catalog

- **High-Quality Audio Playback**
  - 🎚️ Intuitive controls & playlist support
  - ⌨️ Keyboard shortcuts for navigation

- **Personalized Experience**
  - 🗂️ Custom playlists
  - ❤️ Favorites
  - 📜 Listening history

---

## 🧰 Technology Stack

### 🖥️ Backend
- [Laravel 10.x](https://laravel.com/)
- [MySQL](https://www.mysql.com/)
- [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)
- [Laravel UI](https://laravel.com/docs/10.x/ui)

### 🎨 Frontend
- Blade Templating Engine
- [Bootstrap 5](https://getbootstrap.com/)
- JavaScript/jQuery
- HTML5 Audio API
- [SortableJS](https://sortablejs.github.io/Sortable/) (drag-and-drop)

### 🧪 Tools & Services
- Git, Composer, NPM
- [Font Awesome](https://fontawesome.com/)
- [Google Fonts](https://fonts.google.com/) — *Playfair Display, Poppins*

---

## 🚀 Installation

### 📦 Prerequisites
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL

### 🔧 Steps

```bash
# 1. Clone the repository
git clone https://github.com/yourusername/sonorus.git
cd sonorus

# 2. Install dependencies
composer install
npm install
npm run build

# 3. Set up environment
cp .env.example .env
php artisan key:generate

# 4. Configure .env (DB section)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sonorus_db
DB_USERNAME=root
DB_PASSWORD=your_password

# 5. Migrate & seed
php artisan migrate --seed

# 6. Create symbolic link for storage
php artisan storage:link

# 7. Start the server
php artisan serve
````

🟢 Visit your app at [http://localhost:8000](http://localhost:8000)

---

## ⚙️ Configuration

### 📁 File Upload Limits (php.ini)

```ini
upload_max_filesize = 20M
post_max_size = 20M
max_execution_time = 300
```

### 🔑 Default Admin Credentials

| Role  | Email               | Password   |
| ----- | ------------------- | ---------- |
| Admin | `admin@sonorus.com` | `admin123` |
| User  | `user@sonorus.com`  | `user123`  |

---

## 🎮 Usage

### 🛠 Admin Dashboard

* Access: `/admin/dashboard`
* Manage composers, songs, and users
* Upload & categorize new classical works

### 👤 User Interface

* Browse music and composers
* Create, edit, and delete playlists
* Mark favorites, view history
* Use search to find composers or works

### 🎧 Music Player Shortcuts

| Action        | Control        |
| ------------- | -------------- |
| Play/Pause    | `Space`        |
| Next/Previous | `→` / `←`      |
| Volume        | `↑` / `↓`      |
| Seek Track    | Click/drag bar |
| Mute          | `M`            |

---

## 📂 Project Structure

```bash
sonorus/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   ├── Player/
│   │   └── Middleware/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   └── images/
├── resources/
│   └── views/
├── routes/
│   └── web.php
```

---

## 📸 Screenshots

> *(replace with real image links for GitHub display)*

* 🎉 **Welcome Page**
* 🧑‍💼 **Admin Dashboard**
* 🎼 **Composer Management**
* 🎵 **Song Management**
* 👤 **User Home**
* 🎧 **Music Player**
* 📝 **Playlist Manager**
* 🧠 **Composer Detail**

---

## 🤝 Contributing

Pull requests are welcome! To contribute:

```bash
# Fork & clone
git checkout -b feature/your-feature-name

# Make changes
git commit -m "Add awesome feature"

# Push and open a PR
---

## 🙏 Acknowledgements

* [Laravel](https://laravel.com/)
* [Bootstrap](https://getbootstrap.com/)
* [Font Awesome](https://fontawesome.com/)
* [SortableJS](https://sortablejs.github.io/Sortable/)
* [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)

---

> Projek Matakuliah Web Programming II


