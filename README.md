# 🎼 Sonorus: Classical Music Streaming Platform

<p align="center">
  <img src="public/images/sonorus-logo.png" alt="Sonorus Logo" width="250">
</p>

**Sonorus** is an elegant and immersive classical music streaming platform built with **Laravel**. Tailored for classical music enthusiasts, it provides access to legendary composers, high-fidelity audio playback, and a refined user experience.

---


## ✨ Features

### 🧑‍💼 User Roles

**Admin Dashboard**

* 🎼 Composer Management
* 🎵 Music Catalog Administration
* 👤 User Management
* 📊 Analytics & Insights

**User Interface**

* 🧽 Browse Classical Compositions
* 📁 Create & Manage Playlists
* 🔎 Advanced Search
* 🎷 Elegant Music Player with Seek Controls

### 🎵 Music Experience

* 🧠 Composer Profiles with Biographies & Historical Context
* 🎶 Complete Works Catalog
* 🌺 High-Quality Audio Playback with Intuitive Controls
* ⌨️ Keyboard Shortcuts for Navigation
* 📂 Custom Playlists & Listening History
* ❤️ Favorite Tracks

---

## 🧰 Technology Stack

### 🖥️ Backend

* [Laravel 10.x](https://laravel.com/)
* [MySQL](https://www.mysql.com/)
* [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)
* [Laravel UI](https://laravel.com/docs/10.x/ui)

### 🎨 Frontend

* Blade Templating Engine
* [Bootstrap 5](https://getbootstrap.com/)
* JavaScript / jQuery
* HTML5 Audio API
* [SortableJS](https://sortablejs.github.io/Sortable/)

### 🧪 Tools & Services

* Git, Composer, NPM
* [Font Awesome](https://fontawesome.com/)
* [Google Fonts](https://fonts.google.com/) – *Playfair Display*, *Poppins*

---

## 🚀 Installation

### 📦 Prerequisites

* PHP >= 8.1
* Composer
* Node.js & NPM
* MySQL

### 🔧 Setup

```bash
# 1. Clone the repository
git clone https://github.com/yourusername/sonorus.git
cd sonorus

# 2. Install dependencies
composer install
npm install
npm run build

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Edit .env for DB config
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sonorus_db
DB_USERNAME=root
DB_PASSWORD=your_password

# 5. Migrate & seed database
php artisan migrate --seed

# 6. Create storage symlink
php artisan storage:link

# 7. Start local development server
php artisan serve
```

📍 Access the app at: [http://localhost:8000](http://localhost:8000)

---

## ⚙️ Configuration

### 📁 File Upload Limits (`php.ini`)

```ini
upload_max_filesize = 20M
post_max_size = 20M
max_execution_time = 300
```

### 🔑 Default Credentials

| Role  | Email                                         | Password |
| ----- | --------------------------------------------- | -------- |
| Admin | [admin@sonorus.com](mailto:admin@sonorus.com) | admin123 |
| User  | [user@sonorus.com](mailto:user@sonorus.com)   | user123  |

---

## 🎮 Usage

### 🛠️ Admin Panel

* Access: `/admin/dashboard`
* Manage composers, songs, and users
* Upload and categorize new classical works

### 👤 User Interface

* Browse and search for music or composers
* Manage playlists, favorites, and history
* Use built-in player for seamless playback

### ⌨️ Music Player Shortcuts

| Action       | Shortcut       |
| ------------ | -------------- |
| Play / Pause | `Space`        |
| Next / Prev  | `→` / `←`      |
| Volume       | `↑` / `↓`      |
| Seek Track   | Click/drag bar |
| Mute         | `M`            |

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


**🎉 Welcome Page**
![Welcome Page](https://github.com/user-attachments/assets/916fe371-1c51-4c30-b2da-e7f6939b9cda)

**🧑‍💼 Admin Dashboard**
![Admin Dashboard](https://github.com/user-attachments/assets/49a0dc47-54ac-476e-9d13-1d8893432142)

**🎼 Composer Management**
![Composer Management](https://github.com/user-attachments/assets/29ee9ac3-13e5-49f8-a2c0-c3c7818c21ed)

**🎵 Song Management**
![Song Management](https://github.com/user-attachments/assets/855dc299-049b-4aaa-9464-ebf6e6ee8297)

**👤 User Home**
![User Home](https://github.com/user-attachments/assets/564080a1-5fde-48ce-8916-fbc79bbd245b)

**🎷 Music Player**
![Music Player](https://github.com/user-attachments/assets/e597c5bc-373b-4598-b9f9-f34a925bdd56)

**📝 Playlist Manager**
![Playlist Manager](https://github.com/user-attachments/assets/9673f4a7-b62c-4992-8eaf-019d8ff58b47)

**🧠 Composer Detail**
![Composer Detail](https://github.com/user-attachments/assets/1da79046-b099-4f6a-a0c6-31cba0fe3adb)

---

## 🤝 Contributing

We welcome contributions!
To contribute:

```bash
# Fork and create your feature branch
git checkout -b feature/your-feature-name

# Commit your changes
git commit -m "Add awesome feature"

# Push and open a pull request
```

---

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

---

## 🙏 Acknowledgements

* [Laravel](https://laravel.com/)
* [Bootstrap](https://getbootstrap.com/)
* [Font Awesome](https://fontawesome.com/)
* [SortableJS](https://sortablejs.github.io/Sortable/)
* [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)

---

> 🎓 *Developed as part of the Web Programming II course project.*
