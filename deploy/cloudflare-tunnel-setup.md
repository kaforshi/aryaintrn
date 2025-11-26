# Setup Cloudflare Tunnel

Panduan lengkap untuk setup Cloudflare Tunnel untuk aplikasi Laravel Portfolio.

## Prerequisites

1. Akun Cloudflare (gratis)
2. Domain yang sudah terhubung ke Cloudflare
3. Akses ke Cloudflare Dashboard

## Langkah-langkah Setup

### 1. Install Cloudflare Tunnel (sudah termasuk di setup-ubuntu.sh)

```bash
# Jika belum terinstall, jalankan:
wget -q https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-linux-amd64.deb
sudo dpkg -i cloudflared-linux-amd64.deb
```

### 2. Login ke Cloudflare

```bash
sudo cloudflared tunnel login
```

Ini akan membuka browser untuk autentikasi. Pilih domain yang akan digunakan.

### 3. Buat Tunnel

**Opsi A: Menggunakan Cloudflare Dashboard (Recommended)**

1. Login ke [Cloudflare Dashboard](https://dash.cloudflare.com/)
2. Pilih domain Anda
3. Masuk ke **Zero Trust** > **Networks** > **Tunnels**
4. Klik **Create a tunnel**
5. Pilih **Cloudflared**
6. Beri nama tunnel (mis: `portfolio-tunnel`)
7. Copy **Tunnel ID** dan **Tunnel Token**

**Opsi B: Menggunakan CLI**

```bash
sudo cloudflared tunnel create portfolio-tunnel
```

### 4. Setup Konfigurasi

1. Copy file contoh konfigurasi:
```bash
sudo mkdir -p /etc/cloudflared
sudo cp deploy/config.yml.example /etc/cloudflared/config.yml
```

2. Edit konfigurasi:
```bash
sudo nano /etc/cloudflared/config.yml
```

3. Ganti konfigurasi berikut:
   - `YOUR_TUNNEL_ID`: Ganti dengan Tunnel ID dari Cloudflare Dashboard
   - `yourdomain.com`: Ganti dengan domain Anda
   - `127.0.0.1:8000`: Pastikan port sesuai dengan port aplikasi Laravel

4. Jika menggunakan Tunnel Token (recommended), buat file credentials:
```bash
sudo nano /etc/cloudflared/credentials.json
```

Masukkan token:
```json
{
  "AccountTag": "YOUR_ACCOUNT_TAG",
  "TunnelSecret": "YOUR_TUNNEL_SECRET",
  "TunnelID": "YOUR_TUNNEL_ID",
  "TunnelName": "portfolio-tunnel"
}
```

Atau jika menggunakan token langsung, edit config.yml:
```yaml
tunnel: YOUR_TUNNEL_ID
credentials-file: /etc/cloudflared/credentials.json
```

### 5. Setup Route di Cloudflare Dashboard

1. Di halaman tunnel, klik **Configure**
2. Tambahkan **Public Hostname**:
   - **Subdomain**: `@` atau `www` (atau kosongkan untuk root)
   - **Domain**: Pilih domain Anda
   - **Service**: `http://localhost:8000`
3. Klik **Save**

### 6. Install Systemd Service

```bash
sudo cp deploy/cloudflared.service /etc/systemd/system/cloudflared.service
sudo systemctl daemon-reload
sudo systemctl enable cloudflared
sudo systemctl start cloudflared
```

### 7. Cek Status

```bash
# Cek status tunnel
sudo systemctl status cloudflared

# Cek logs
sudo journalctl -u cloudflared -f
```

### 8. Verifikasi

1. Buka domain Anda di browser
2. Pastikan aplikasi Laravel dapat diakses
3. Cek di Cloudflare Dashboard bahwa tunnel status adalah **Healthy**

## Troubleshooting

### Tunnel tidak connect

1. Cek credentials file:
```bash
sudo cat /etc/cloudflared/credentials.json
```

2. Cek konfigurasi:
```bash
sudo cloudflared tunnel --config /etc/cloudflared/config.yml ingress validate
```

3. Test tunnel manual:
```bash
sudo cloudflared tunnel --config /etc/cloudflared/config.yml run
```

### Aplikasi tidak bisa diakses

1. Pastikan Laravel service berjalan:
```bash
sudo systemctl status laravel-portfolio
```

2. Cek port aplikasi:
```bash
sudo netstat -tlnp | grep 8000
```

3. Test koneksi lokal:
```bash
curl http://127.0.0.1:8000
```

### Update Tunnel

Jika perlu update konfigurasi:
```bash
sudo nano /etc/cloudflared/config.yml
sudo systemctl restart cloudflared
```

## Security Notes

- Jangan expose port 8000 ke public (hanya localhost)
- Gunakan HTTPS di Cloudflare (otomatis dengan tunnel)
- Pastikan credentials file hanya bisa dibaca root:
```bash
sudo chmod 600 /etc/cloudflared/credentials.json
sudo chmod 600 /etc/cloudflared/config.yml
```

