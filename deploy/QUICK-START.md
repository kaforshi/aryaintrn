# Quick Start Deployment Guide

Panduan cepat untuk deploy aplikasi Laravel Aryaintrn ke Ubuntu Server dengan konfigurasi yang sudah diset.

## Konfigurasi

- **Database**: SQLite
- **Domain**: aryaintaran.dev
- **Port**: 8000
- **User**: website
- **PHP**: 8.2

## Langkah Cepat

### 1. Setup Server

```bash
# SSH ke server
ssh user@your-server-ip

# Clone aplikasi (atau upload via SCP/SFTP)
sudo mkdir -p /var/www/aryaintrn
cd /var/www/aryaintrn
# Clone atau upload aplikasi ke sini

# Jalankan setup
chmod +x deploy/setup-ubuntu.sh
sudo ./deploy/setup-ubuntu.sh
```

### 2. Deploy Aplikasi

```bash
cd /var/www/aryaintrn
chmod +x deploy/deploy.sh
sudo ./deploy/deploy.sh
```

Script ini akan:
- Install dependencies
- Build assets
- Setup .env dengan konfigurasi production
- Buat database SQLite
- Run migrations

### 3. Edit .env

```bash
sudo nano /var/www/aryaintrn/.env
```

**PENTING**: Ganti `ADMIN_EMAIL` dan `ADMIN_PASSWORD` dengan nilai yang aman!

### 4. Setup Laravel Service

```bash
sudo cp deploy/laravel.service /etc/systemd/system/laravel-aryaintrn.service
sudo systemctl daemon-reload
sudo systemctl enable laravel-aryaintrn
sudo systemctl start laravel-aryaintrn
sudo systemctl status laravel-aryaintrn
```

### 5. Setup Cloudflare Tunnel

```bash
# Setup konfigurasi
sudo mkdir -p /etc/cloudflared
sudo cp deploy/config.yml.example /etc/cloudflared/config.yml
sudo nano /etc/cloudflared/config.yml
```

Edit dan ganti `YOUR_TUNNEL_ID` dengan Tunnel ID Anda dari Cloudflare Dashboard.

```bash
# Setup credentials (jika menggunakan token)
sudo nano /etc/cloudflared/credentials.json
# Paste token Anda

# Install service
sudo cp deploy/cloudflared.service /etc/systemd/system/cloudflared.service
sudo systemctl daemon-reload
sudo systemctl enable cloudflared
sudo systemctl start cloudflared
sudo systemctl status cloudflared
```

### 6. Verifikasi

1. Cek Laravel service:
```bash
sudo systemctl status laravel-aryaintrn
curl http://127.0.0.1:8000
```

2. Cek Cloudflare Tunnel:
```bash
sudo systemctl status cloudflared
```

3. Akses aplikasi:
   - https://aryaintaran.dev
   - https://aryaintaran.dev/admin/login

## Update Aplikasi

```bash
cd /var/www/aryaintrn
sudo ./deploy/update.sh
```

## Troubleshooting

### Service tidak jalan

```bash
# Cek logs
sudo journalctl -u laravel-aryaintrn -n 50
sudo journalctl -u cloudflared -n 50

# Restart services
sudo systemctl restart laravel-aryaintrn
sudo systemctl restart cloudflared
```

### Permission errors

```bash
cd /var/www/aryaintrn
sudo chown -R website:website .
sudo chmod -R 755 .
sudo chmod -R 775 storage bootstrap/cache
sudo chmod 664 database/database.sqlite
```

### Database error

```bash
# Pastikan database file ada dan permission benar
cd /var/www/aryaintrn
ls -la database/database.sqlite
sudo chown website:website database/database.sqlite
sudo chmod 664 database/database.sqlite
```

## File Penting

- `.env` - Konfigurasi aplikasi (di `/var/www/aryaintrn/.env`)
- `config.yml` - Konfigurasi Cloudflare Tunnel (di `/etc/cloudflared/config.yml`)
- `credentials.json` - Cloudflare Tunnel credentials (di `/etc/cloudflared/credentials.json`)

## Support

Lihat dokumentasi lengkap di:
- [DEPLOYMENT.md](./DEPLOYMENT.md) - Panduan lengkap
- [cloudflare-tunnel-setup.md](./cloudflare-tunnel-setup.md) - Setup Cloudflare Tunnel
- [CHECKLIST.md](./CHECKLIST.md) - Deployment checklist

