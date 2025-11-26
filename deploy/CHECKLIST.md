# Deployment Checklist

Gunakan checklist ini untuk memastikan semua langkah deployment sudah dilakukan dengan benar.

## Pre-Deployment

- [ ] Server Ubuntu sudah siap (20.04 atau lebih baru)
- [ ] Akses SSH ke server sudah tersedia
- [ ] Domain sudah terhubung ke Cloudflare
- [ ] Akun Cloudflare sudah dibuat
- [ ] Repository Git sudah siap (atau file aplikasi sudah siap di-upload)

## Konfigurasi Deployment

✅ **Database type**: SQLite  
✅ **Domain name**: aryaintaran.dev  
✅ **App port**: 8000  
✅ **Cloudflare Tunnel Token**: Sudah disiapkan  
✅ **PHP version**: 8.2  
✅ **Deployment user**: website

## Database Configuration (SQLite)

- [ ] Database SQLite sudah dibuat di `/var/www/portfolio/database/database.sqlite`
- [ ] File database memiliki permission yang benar (664)
- [ ] File database dimiliki oleh user `website`

## Server Setup

- [ ] Script `setup-ubuntu.sh` sudah dijalankan
- [ ] PHP 8.2+ sudah terinstall
- [ ] Composer sudah terinstall
- [ ] Node.js dan npm sudah terinstall
- [ ] Cloudflare Tunnel (cloudflared) sudah terinstall
- [ ] User `website` sudah dibuat
- [ ] Semua dependencies sudah terinstall

## Application Deployment

- [ ] Aplikasi sudah di-clone/upload ke `/var/www/portfolio`
- [ ] Script `deploy.sh` sudah dijalankan
- [ ] File `.env` sudah dibuat dan dikonfigurasi
- [ ] `APP_KEY` sudah di-generate
- [ ] Database credentials sudah dikonfigurasi di `.env`
- [ ] Admin credentials sudah dikonfigurasi di `.env`
- [ ] `APP_DEBUG=false` untuk production
- [ ] `APP_ENV=production`
- [ ] `APP_URL` sudah diset ke `https://aryaintaran.dev`
- [ ] Dependencies (Composer & NPM) sudah terinstall
- [ ] Assets sudah di-build (`npm run build`)
- [ ] Migrations sudah dijalankan
- [ ] Permissions sudah diset dengan benar

## Laravel Service

- [ ] File `laravel.service` sudah di-copy ke `/etc/systemd/system/`
- [ ] Service file sudah dikonfigurasi untuk user `website` dan port `8000`
- [ ] `systemctl daemon-reload` sudah dijalankan
- [ ] Service sudah di-enable: `systemctl enable laravel-portfolio`
- [ ] Service sudah di-start: `systemctl start laravel-portfolio`
- [ ] Service status sudah dicek: `systemctl status laravel-portfolio`
- [ ] Service berjalan dengan baik

## Cloudflare Tunnel

- [ ] Sudah login ke Cloudflare: `cloudflared tunnel login`
- [ ] Tunnel sudah dibuat di Cloudflare Dashboard
- [ ] Tunnel ID sudah dicatat
- [ ] File `config.yml` sudah dibuat di `/etc/cloudflared/`
- [ ] Konfigurasi tunnel sudah disesuaikan untuk `aryaintaran.dev` dan port `8000`
- [ ] Tunnel ID sudah diisi di config.yml
- [ ] Credentials file sudah dibuat (jika menggunakan token)
- [ ] File `cloudflared.service` sudah di-copy ke `/etc/systemd/system/`
- [ ] `systemctl daemon-reload` sudah dijalankan
- [ ] Service sudah di-enable: `systemctl enable cloudflared`
- [ ] Service sudah di-start: `systemctl start cloudflared`
- [ ] Tunnel status sudah dicek: `systemctl status cloudflared`
- [ ] Tunnel berjalan dengan baik (status: Healthy di Cloudflare Dashboard)

## Verification

- [ ] Aplikasi bisa diakses via domain: `https://aryaintaran.dev`
- [ ] Portfolio page bisa diakses
- [ ] Admin panel bisa diakses: `https://aryaintaran.dev/admin/login`
- [ ] Login admin berfungsi dengan baik
- [ ] Tidak ada error di browser console
- [ ] Logs tidak menunjukkan error: `tail -f storage/logs/laravel.log`
- [ ] Service logs tidak menunjukkan error

## Security

- [ ] `APP_DEBUG=false` di production
- [ ] `APP_ENV=production`
- [ ] Database password sudah kuat
- [ ] Admin password sudah kuat
- [ ] File `.env` tidak di-commit ke Git
- [ ] File permissions sudah benar (755 untuk direktori, 644 untuk file)
- [ ] Storage dan cache directories sudah writable (775) dan dimiliki user `website`
- [ ] Database SQLite file sudah writable (664) dan dimiliki user `website`
- [ ] Cloudflare Tunnel credentials file hanya readable root (600)
- [ ] Firewall sudah dikonfigurasi (hanya allow SSH)

## Backup

- [ ] Backup strategy sudah direncanakan
- [ ] Database backup script sudah dibuat (jika perlu)
- [ ] Backup location sudah ditentukan

## Monitoring

- [ ] Logs location sudah diketahui
- [ ] Cara monitor service sudah dipahami
- [ ] Update procedure sudah dipahami

## Post-Deployment

- [ ] Semua fitur sudah ditest
- [ ] Admin panel sudah ditest
- [ ] CRUD operations sudah ditest
- [ ] Performance sudah acceptable
- [ ] Documentation sudah dibaca dan dipahami

## Notes

Tambahkan catatan penting di sini:

_________________________________________________________
_________________________________________________________
_________________________________________________________

