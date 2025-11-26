# Konfigurasi Deployment

File ini berisi ringkasan konfigurasi deployment yang sudah diset.

## Konfigurasi Aplikasi

- **Nama Aplikasi**: aryaintrn
- **Direktori**: `/var/www/aryaintrn`
- **User**: `website` (user khusus yang akan dibuat otomatis)
- **Port**: `8000`
- **PHP Version**: `8.2`

## Database

- **Type**: SQLite
- **Lokasi**: `/var/www/aryaintrn/database/database.sqlite`
- **Permission**: `664` (rw-rw-r--)
- **Owner**: `website:website`

## Domain & Network

- **Domain**: `aryaintaran.dev`
- **WWW Subdomain**: `www.aryaintaran.dev` (optional)
- **App URL**: `https://aryaintaran.dev`
- **Local Service**: `http://127.0.0.1:8000`

## Cloudflare Tunnel

- **Status**: Sudah dikonfigurasi
- **Config File**: `/etc/cloudflared/config.yml`
- **Credentials**: `/etc/cloudflared/credentials.json`
- **Service**: `cloudflared.service`

## Systemd Services

### Laravel Service
- **File**: `/etc/systemd/system/laravel-aryaintrn.service`
- **User**: `website`
- **Group**: `website`
- **Working Directory**: `/var/www/aryaintrn`
- **Command**: `php8.2 artisan serve --host=127.0.0.1 --port=8000`

### Cloudflare Tunnel Service
- **File**: `/etc/systemd/system/cloudflared.service`
- **User**: `root`
- **Config**: `/etc/cloudflared/config.yml`

## Environment Variables (.env)

File `.env` akan dibuat otomatis oleh script `deploy.sh` dengan konfigurasi:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://aryaintaran.dev
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/aryaintrn/database/database.sqlite
```

**PENTING**: Setelah deployment, edit file `.env` dan set:
- `ADMIN_EMAIL` - Email admin
- `ADMIN_PASSWORD` - Password admin yang kuat

## File Permissions

```
/var/www/aryaintrn/
├── . (755, website:website)
├── storage/ (775, website:website)
├── bootstrap/cache/ (775, website:website)
└── database/database.sqlite (664, website:website)
```

## Quick Commands

### Cek Status Services
```bash
sudo systemctl status laravel-aryaintrn
sudo systemctl status cloudflared
```

### Restart Services
```bash
sudo systemctl restart laravel-aryaintrn
sudo systemctl restart cloudflared
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

### Update Aplikasi
```bash
cd /var/www/aryaintrn
sudo ./deploy/update.sh
```

## Troubleshooting

### Service tidak jalan
```bash
sudo systemctl status laravel-aryaintrn
sudo journalctl -u laravel-aryaintrn -n 50
```

### Permission error
```bash
cd /var/www/aryaintrn
sudo chown -R website:website .
sudo chmod -R 755 .
sudo chmod -R 775 storage bootstrap/cache
sudo chmod 664 database/database.sqlite
```

### Database error
```bash
ls -la /var/www/aryaintrn/database/database.sqlite
sudo chown website:website /var/www/aryaintrn/database/database.sqlite
sudo chmod 664 /var/www/aryaintrn/database/database.sqlite
```

