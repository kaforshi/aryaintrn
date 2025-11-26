# Panduan Deployment Laravel Aryaintrn ke Ubuntu Server dengan Cloudflare Tunnel

Panduan lengkap untuk deploy aplikasi Laravel Aryaintrn ke Ubuntu Server menggunakan Cloudflare Tunnel.

## Prerequisites

Sebelum memulai, pastikan Anda memiliki:

1. ✅ Server Ubuntu (20.04 atau lebih baru)
2. ✅ Akses root/sudo ke server
3. ✅ Domain yang sudah terhubung ke Cloudflare
4. ✅ Akun Cloudflare (gratis)
5. ✅ Aplikasi Laravel sudah siap di repository (Git)

## Konfigurasi Deployment

Konfigurasi yang sudah diset untuk deployment ini:

- ✅ **Database**: SQLite
- ✅ **Domain**: aryaintaran.dev
- ✅ **Port aplikasi**: 8000
- ✅ **Cloudflare Tunnel**: Sudah dikonfigurasi
- ✅ **PHP Version**: 8.2
- ✅ **User deployment**: website (user khusus)

## Langkah-langkah Deployment

### 1. Persiapan Server

SSH ke server Ubuntu Anda:

```bash
ssh user@your-server-ip
```

### 2. Clone Repository

```bash
# Buat direktori aplikasi
sudo mkdir -p /var/www/aryaintrn

# Clone repository (atau upload file menggunakan SCP/SFTP)
cd /var/www/aryaintrn
git clone https://github.com/your-username/your-repo.git .

# Atau jika sudah ada file, pastikan ownership:
# sudo chown -R website:website /var/www/aryaintrn
```

### 3. Jalankan Setup Script

```bash
cd /var/www/aryaintrn
chmod +x deploy/setup-ubuntu.sh
sudo ./deploy/setup-ubuntu.sh
```

Script ini akan:
- Update system packages
- Install PHP 8.2 dan extensions (termasuk SQLite)
- Install Composer
- Install Node.js dan npm
- Install Cloudflare Tunnel (cloudflared)
- **Membuat user `website` khusus untuk aplikasi**
- Setup direktori dan permissions

### 4. Konfigurasi Environment

Script `deploy.sh` akan otomatis membuat file `.env` dengan konfigurasi dasar. Setelah deployment, edit file `.env`:

```bash
cd /var/www/aryaintrn
sudo nano .env
```

Pastikan konfigurasi berikut sudah benar:

```env
APP_NAME="Aryaintrn"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://aryaintaran.dev

# Database Configuration - SQLite
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/aryaintrn/database/database.sqlite

# Admin Credentials - PENTING: Ganti dengan password yang kuat!
ADMIN_EMAIL=admin@aryaintaran.dev
ADMIN_PASSWORD=your_secure_password_here

# Session & Cache
SESSION_DRIVER=file
CACHE_DRIVER=file
```

**Catatan**: Script `deploy.sh` sudah otomatis:
- Generate `APP_KEY`
- Setup `APP_ENV=production` dan `APP_DEBUG=false`
- Setup `APP_URL=https://aryaintaran.dev`
- Setup database SQLite
- Membuat file database SQLite jika belum ada

### 5. Setup Database (SQLite)

Script `deploy.sh` sudah otomatis membuat database SQLite. Jika perlu membuat manual:

```bash
cd /var/www/aryaintrn
touch database/database.sqlite
chmod 664 database/database.sqlite
chown website:website database/database.sqlite
```

### 6. Jalankan Deployment Script

```bash
cd /var/www/aryaintrn
chmod +x deploy/deploy.sh
sudo ./deploy/deploy.sh
```

Script ini akan:
- Install dependencies (Composer & NPM)
- Build assets
- Optimize Laravel
- Run migrations
- Setup permissions

### 7. Setup Laravel Service (Systemd)

```bash
# Copy service file (sudah dikonfigurasi untuk user 'website' dan port 8000)
sudo cp deploy/laravel.service /etc/systemd/system/laravel-aryaintrn.service

# Enable dan start service
sudo systemctl daemon-reload
sudo systemctl enable laravel-aryaintrn
sudo systemctl start laravel-aryaintrn

# Cek status
sudo systemctl status laravel-aryaintrn
```

**Catatan**: Service file sudah dikonfigurasi untuk:
- User: `website`
- Port: `8000`
- Working Directory: `/var/www/aryaintrn`

### 8. Setup Cloudflare Tunnel

Ikuti panduan lengkap di [cloudflare-tunnel-setup.md](./cloudflare-tunnel-setup.md)

**Karena Anda sudah punya Cloudflare Tunnel token**, setup konfigurasi:

```bash
# 1. Setup konfigurasi (sudah dikonfigurasi untuk aryaintaran.dev)
sudo mkdir -p /etc/cloudflared
sudo cp deploy/config.yml.example /etc/cloudflared/config.yml
sudo nano /etc/cloudflared/config.yml
```

Edit file dan ganti `YOUR_TUNNEL_ID` dengan Tunnel ID Anda. File sudah dikonfigurasi untuk:
- Domain: `aryaintaran.dev`
- www subdomain: `www.aryaintaran.dev`
- Service: `http://127.0.0.1:8000`

```bash
# 2. Setup credentials (jika menggunakan token)
sudo nano /etc/cloudflared/credentials.json
# Paste token Anda di sini

# 3. Install service
sudo cp deploy/cloudflared.service /etc/systemd/system/cloudflared.service
sudo systemctl daemon-reload
sudo systemctl enable cloudflared
sudo systemctl start cloudflared

# 4. Cek status
sudo systemctl status cloudflared
```

### 9. Verifikasi Deployment

1. **Cek Laravel service:**
```bash
sudo systemctl status laravel-aryaintrn
curl http://127.0.0.1:8000
```

2. **Cek Cloudflare Tunnel:**
```bash
sudo systemctl status cloudflared
sudo journalctl -u cloudflared -f
```

3. **Akses aplikasi:**
   - Buka browser dan akses: `https://aryaintaran.dev`
   - Test portfolio: `https://aryaintaran.dev`
   - Test admin: `https://aryaintaran.dev/admin/login`

## Maintenance

### Update Aplikasi

Gunakan script `update.sh` yang sudah disediakan:

```bash
cd /var/www/aryaintrn
sudo ./deploy/update.sh
```

Atau manual:

```bash
cd /var/www/aryaintrn
git pull origin main
sudo -u website composer install --no-dev --optimize-autoloader
sudo -u website npm ci --production
sudo -u website npm run build
sudo -u website php artisan migrate --force
sudo -u website php artisan config:cache
sudo -u website php artisan route:cache
sudo -u website php artisan view:cache
sudo systemctl restart laravel-aryaintrn
```

### View Logs

```bash
# Laravel logs
tail -f /var/www/aryaintrn/storage/logs/laravel.log

# Laravel service logs
sudo journalctl -u laravel-aryaintrn -f

# Cloudflare Tunnel logs
sudo journalctl -u cloudflared -f
```

### Backup Database

**MySQL:**
```bash
mysqldump -u portfolio_user -p portfolio_db > backup_$(date +%Y%m%d).sql
```

**SQLite:**
```bash
cp /var/www/aryaintrn/database/database.sqlite backup_$(date +%Y%m%d).sqlite
```

## Troubleshooting

### Laravel tidak bisa diakses

1. Cek service status:
```bash
sudo systemctl status laravel-aryaintrn
```

2. Cek port:
```bash
sudo netstat -tlnp | grep 8000
```

3. Cek logs:
```bash
sudo journalctl -u laravel-aryaintrn -n 50
```

### Cloudflare Tunnel error

1. Cek credentials:
```bash
sudo cat /etc/cloudflared/credentials.json
```

2. Validate config:
```bash
sudo cloudflared tunnel --config /etc/cloudflared/config.yml ingress validate
```

3. Test manual:
```bash
sudo cloudflared tunnel --config /etc/cloudflared/config.yml run
```

### Permission errors

```bash
cd /var/www/aryaintrn
sudo chown -R website:website .
sudo chmod -R 755 .
sudo chmod -R 775 storage bootstrap/cache
sudo chmod 664 database/database.sqlite
```

## Security Checklist

- [ ] APP_DEBUG=false di production
- [ ] APP_ENV=production
- [ ] Strong database password
- [ ] Strong admin password
- [ ] File .env tidak di-commit ke Git
- [ ] Firewall hanya allow SSH (port 22)
- [ ] Cloudflare Tunnel credentials file hanya readable root
- [ ] Regular backups database
- [ ] Update system packages regularly

## Support

Jika ada masalah, cek:
1. Laravel logs: `storage/logs/laravel.log`
2. System logs: `journalctl -u laravel-aryaintrn`
3. Cloudflare Tunnel logs: `journalctl -u cloudflared`

