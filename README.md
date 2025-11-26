# Portfolio Website dengan Laravel

Website portfolio dinamis dengan admin panel untuk mengelola konten. Dibangun menggunakan Laravel dan PHP.

## Fitur

- ✅ Portfolio website dengan UI modern dan responsif
- ✅ Admin panel untuk mengelola semua konten
- ✅ CRUD untuk Profile, Skills, Work Experiences, Projects, dan Social Links
- ✅ Autentikasi admin sederhana
- ✅ Database SQLite (default) atau MySQL/PostgreSQL

## Instalasi

1. Clone atau download project ini
2. Masuk ke direktori project:
   ```bash
   cd portfolio-app
   ```

3. Install dependencies:
   ```bash
   composer install
   ```

4. Copy file environment:
   ```bash
   cp .env.example .env
   ```

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Konfigurasi database di file `.env`:
   ```
   DB_CONNECTION=sqlite
   ```
   Atau untuk MySQL:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=portfolio_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Jika menggunakan SQLite, buat file database:
   ```bash
   touch database/database.sqlite
   ```

8. Jalankan migrations:
   ```bash
   php artisan migrate
   ```

9. Seed database dengan data awal:
   ```bash
   php artisan db:seed
   ```

10. Konfigurasi admin credentials di file `.env`:
    ```
    ADMIN_EMAIL=admin@portfolio.com
    ADMIN_PASSWORD=admin123
    ```

11. Jalankan server development:
    ```bash
    php artisan serve
    ```

12. Buka browser dan akses:
    - Portfolio: http://localhost:8000
    - Admin Panel: http://localhost:8000/admin/login

## Struktur Project

```
portfolio-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── PortfolioController.php
│   │   │   └── Admin/
│   │   │       ├── AdminController.php
│   │   │       ├── ProfileController.php
│   │   │       ├── SkillController.php
│   │   │       ├── WorkExperienceController.php
│   │   │       ├── ProjectController.php
│   │   │       └── SocialLinkController.php
│   │   └── Middleware/
│   │       └── AdminAuth.php
│   └── Models/
│       ├── Profile.php
│       ├── Skill.php
│       ├── WorkExperience.php
│       ├── Project.php
│       └── SocialLink.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── PortfolioSeeder.php
├── resources/
│   └── views/
│       ├── portfolio/
│       │   └── index.blade.php
│       └── admin/
│           ├── layout.blade.php
│           ├── login.blade.php
│           ├── dashboard.blade.php
│           ├── profile/
│           ├── skills/
│           ├── work-experiences/
│           ├── projects/
│           └── social-links/
└── routes/
    └── web.php
```

## Penggunaan Admin Panel

1. Login ke admin panel dengan credentials yang sudah dikonfigurasi di `.env`
2. Dashboard menampilkan statistik dan quick actions
3. Kelola konten melalui menu:
   - **Profile**: Edit informasi profil (nama, username, avatar, dll)
   - **Skills**: Tambah/edit/hapus skills
   - **Work Experiences**: Kelola pengalaman kerja
   - **Projects**: Kelola project portfolio
   - **Social Links**: Kelola link sosial media

## Catatan
- Ubah credentials di file `.env` untuk keamanan
- Untuk production, gunakan database yang lebih robust (MySQL/PostgreSQL)
- Pastikan file `.env` tidak di-commit ke repository

## Teknologi

- Laravel 12
- PHP 8.2+
- Tailwind CSS
- Font Awesome
- SQLite/MySQL/PostgreSQL

## License

MIT License
