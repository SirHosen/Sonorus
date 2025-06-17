# 🎼 Sonorus: Classical Music Streaming Platform

<p align="center">
  <img src="public/images/sonorus-logo.png" alt="Sonorus Logo" width="200"/>
</p>

**Sonorus** is an elegant and immersive classical music streaming platform built with **Laravel**. Tailored for classical music enthusiasts, it allows users to explore legendary composers, high-fidelity music playback, and beautiful UI/UX experiences.

---

## ✨ Features

### 🧑‍💼 **User Roles**

* **Admin Dashboard**

  * 🎼 Composer management
  * 🎵 Music catalog administration
  * 👤 User management
  * 📊 Analytics & insights

* **User Interface**

  * 🧭 Browse classical compositions
  * 📁 Create & manage playlists
  * 🔎 Advanced search
  * 🎧 Elegant music player with seek controls

### 🎵 **Music Experience**

* **Composer Profiles**

  * 🧠 Biographical info & historical context
  * 🎶 Complete works catalog

* **High-Quality Audio Playback**

  * 🎚️ Intuitive controls & playlist support
  * ⌨️ Keyboard shortcuts for navigation

* **Personalized Experience**

  * 🗂️ Custom playlists
  * ❤️ Favorites
  * 📜 Listening history

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
* JavaScript/jQuery
* HTML5 Audio API
* [SortableJS](https://sortablejs.github.io/Sortable/) (drag-and-drop)

### 🧪 Tools & Services

* Git, Composer, NPM
* [Font Awesome](https://fontawesome.com/)
* [Google Fonts](https://fonts.google.com/) — *Playfair Display, Poppins*

---

## 🚀 Installation

### 📦 Prerequisites

* PHP >= 8.1
* Composer
* Node.js & NPM
* MySQL

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
```

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

| Description                | Image                                                                                                    |
| -------------------------- | -------------------------------------------------------------------------------------------------------- |
| 🎉 **Welcome Page**        | <img src="https://github.com/user-attachments/assets/916fe371-1c51-4c30-b2da-e7f6939b9cda" width="600"/> |
| 🧑‍💼 **Admin Dashboard**  | <img src="https://github.com/user-attachments/assets/49a0dc47-54ac-476e-9d13-1d8893432142" width="600"/> |
| 🎼 **Composer Management** | <img src="https://github.com/user-attachments/assets/29ee9ac3-13e5-49f8-a2c0-c3c7818c21ed" width="600"/> |
| 🎵 **Song Management**     | <img src="https://github.com/user-attachments/assets/855dc299-049b-4aaa-9464-ebf6e6ee8297" width="600"/> |
| 👤 **User Home**           | <img src="https://github.com/user-attachments/assets/564080a1-5fde-48ce-8916-fbc79bbd245b" width="600"/> |
| 🎧 **Music Player**        | <img src="https://github.com/user-attachments/assets/e597c5bc-373b-4598-b9f9-f34a925bdd56" width="600"/> |
| 📝 **Playlist Manager**    | <img src="https://github.com/user-attachments/assets/9673f4a7-b62c-4992-8eaf-019d8ff58b47" width="600"/> |
| 🧠 **Composer Detail**     | <img src="https://github.com/user-attachments/assets/1da79046-b099-4f6a-a0c6-31cba0fe3adb" width="600"/> |

---

## 🤝 Contributing

Pull requests are welcome! To contribute:

```bash
# Fork & clone
git checkout -b feature/your-feature-name

# Make changes
git commit -m "Add new feature"

# Push and open a PR
```

---

## 🙏 Acknowledgements

* [Laravel](https://laravel.com/)
* [Bootstrap](https://getbootstrap.com/)
* [Font Awesome](https://fontawesome.com/)
* [SortableJS](https://sortablejs.github.io/Sortable/)
* [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)

---

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

> Developed as part of the Web Programming II course project.
