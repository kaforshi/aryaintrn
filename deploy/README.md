# Deployment Setup untuk Ubuntu Server dengan Cloudflare Tunnel

Folder ini berisi semua file yang diperlukan untuk deploy aplikasi Laravel Portfolio ke Ubuntu Server menggunakan Cloudflare Tunnel.

## File-file Deployment

- **setup-ubuntu.sh** - Script untuk setup awal server (install dependencies, buat user 'website')
- **deploy.sh** - Script untuk deploy aplikasi
- **update.sh** - Script untuk update aplikasi yang sudah terdeploy
- **create-user.sh** - Script untuk membuat user 'website' (sudah termasuk di setup-ubuntu.sh)
- **laravel.service** - Systemd service file untuk Laravel (user: website, port: 8000)
- **cloudflared.service** - Systemd service file untuk Cloudflare Tunnel
- **config.yml.example** - Contoh konfigurasi Cloudflare Tunnel (domain: aryaintaran.dev)
- **DEPLOYMENT.md** - Panduan lengkap deployment
- **QUICK-START.md** - Quick start guide
- **cloudflare-tunnel-setup.md** - Panduan setup Cloudflare Tunnel
- **CHECKLIST.md** - Deployment checklist

## Quick Start

1. **Setup server:**
```bash
sudo ./deploy/setup-ubuntu.sh
```

2. **Deploy aplikasi:**
```bash
sudo ./deploy/deploy.sh
```

3. **Setup services:**
```bash
# Laravel service
sudo cp deploy/laravel.service /etc/systemd/system/laravel-portfolio.service
sudo systemctl daemon-reload
sudo systemctl enable laravel-portfolio
sudo systemctl start laravel-portfolio

# Cloudflare Tunnel
sudo cp deploy/cloudflared.service /etc/systemd/system/cloudflared.service
sudo cp deploy/config.yml.example /etc/cloudflared/config.yml
# Edit /etc/cloudflared/config.yml sesuai kebutuhan
sudo systemctl daemon-reload
sudo systemctl enable cloudflared
sudo systemctl start cloudflared
```

## Konfigurasi Deployment

✅ **Database**: SQLite  
✅ **Domain**: aryaintaran.dev  
✅ **Port**: 8000  
✅ **User**: website  
✅ **PHP**: 8.2  
✅ **Cloudflare Tunnel**: Sudah dikonfigurasi

## Dokumentasi

- **[QUICK-START.md](./QUICK-START.md)** - Quick start guide (mulai dari sini!)
- **[DEPLOYMENT.md](./DEPLOYMENT.md)** - Panduan lengkap deployment
- **[cloudflare-tunnel-setup.md](./cloudflare-tunnel-setup.md)** - Setup Cloudflare Tunnel
- **[CHECKLIST.md](./CHECKLIST.md)** - Deployment checklist

