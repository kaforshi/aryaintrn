#!/bin/bash

# Script deployment untuk Laravel Aryaintrn
# Jalankan script ini setelah setup-ubuntu.sh

set -e

# Konfigurasi
APP_NAME="aryaintrn"
APP_USER="website"
APP_DIR="/var/www/${APP_NAME}"
APP_PORT="8000"
DOMAIN="aryaintaran.dev"

# Warna untuk output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${GREEN}=========================================${NC}"
echo -e "${GREEN}Deploy Laravel Aryaintrn${NC}"
echo -e "${GREEN}=========================================${NC}"

# Cek apakah direktori aplikasi ada
if [ ! -d "$APP_DIR" ]; then
    echo -e "${RED}Error: Direktori $APP_DIR tidak ditemukan!${NC}"
    echo "Jalankan setup-ubuntu.sh terlebih dahulu atau clone aplikasi ke $APP_DIR"
    exit 1
fi

cd $APP_DIR

# Backup .env jika ada
if [ -f .env ]; then
    echo -e "${YELLOW}Backup .env file...${NC}"
    cp .env .env.backup.$(date +%Y%m%d_%H%M%S)
fi

# Install/Update dependencies
echo -e "${YELLOW}[1/8] Install Composer dependencies...${NC}"
sudo -u $APP_USER composer install --no-dev --optimize-autoloader

# Install node modules (include dev deps for build)
echo -e "${YELLOW}[2/8] Install NPM dependencies...${NC}"
if [ -f package-lock.json ] || [ -f npm-shrinkwrap.json ]; then
    sudo -u $APP_USER npm ci
else
    echo -e "${YELLOW}package-lock.json tidak ditemukan, menggunakan npm install${NC}"
    sudo -u $APP_USER npm install
fi

# Build assets
echo -e "${YELLOW}[3/8] Build assets...${NC}"
sudo -u $APP_USER npm run build

# Remove dev dependencies for production runtime
echo -e "${YELLOW}[4/8] Remove dev dependencies (npm prune --production)...${NC}"
sudo -u $APP_USER npm prune --production

# Setup .env jika belum ada
if [ ! -f .env ]; then
    echo -e "${YELLOW}[5/8] Setup .env file...${NC}"
    if [ -f .env.example ]; then
        cp .env.example .env
        chown $APP_USER:$APP_USER .env
        chmod 640 .env
    else
        echo -e "${RED}Error: .env.example tidak ditemukan!${NC}"
        exit 1
    fi
    
    # Setup konfigurasi dasar untuk production
    sudo -u $APP_USER php artisan key:generate
    
    # Update .env dengan konfigurasi production
    sed -i "s|APP_ENV=local|APP_ENV=production|g" .env
    sed -i "s|APP_DEBUG=true|APP_DEBUG=false|g" .env
    sed -i "s|APP_URL=http://localhost|APP_URL=https://${DOMAIN}|g" .env
    sed -i "s|DB_CONNECTION=mysql|DB_CONNECTION=sqlite|g" .env
    sed -i "s|DB_DATABASE=.*|DB_DATABASE=${APP_DIR}/database/database.sqlite|g" .env
    
    # Buat database SQLite jika belum ada
    if [ ! -f database/database.sqlite ]; then
        touch database/database.sqlite
        chown $APP_USER:$APP_USER database/database.sqlite
        chmod 664 database/database.sqlite
        echo -e "${GREEN}Database SQLite dibuat${NC}"
    fi
    
    echo -e "${GREEN}File .env sudah dikonfigurasi untuk production${NC}"
    echo -e "${YELLOW}⚠️  PENTING: Edit file .env dan sesuaikan ADMIN_EMAIL dan ADMIN_PASSWORD!${NC}"
else
    echo -e "${GREEN}[5/8] .env file sudah ada, skip...${NC}"
fi

# Optimize Laravel
echo -e "${YELLOW}[6/8] Optimize Laravel...${NC}"
sudo -u $APP_USER php artisan config:cache
sudo -u $APP_USER php artisan route:cache
sudo -u $APP_USER php artisan view:cache

# Run migrations
echo -e "${YELLOW}[7/8] Run database migrations...${NC}"
read -p "Jalankan migrations? (y/n): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    sudo -u $APP_USER php artisan migrate --force
fi

# Setup permissions
echo -e "${YELLOW}[8/8] Setup permissions...${NC}"
chown -R $APP_USER:$APP_USER $APP_DIR
chmod -R 755 $APP_DIR
chmod -R 775 $APP_DIR/storage
chmod -R 775 $APP_DIR/bootstrap/cache

echo -e "${GREEN}=========================================${NC}"
echo -e "${GREEN}Deployment selesai!${NC}"
echo -e "${GREEN}=========================================${NC}"
echo ""
echo "Langkah selanjutnya:"
echo "1. Edit file .env di $APP_DIR dan sesuaikan konfigurasi"
echo "2. Setup systemd service untuk Laravel (lihat deploy/laravel.service)"
echo "3. Setup Cloudflare Tunnel (lihat deploy/cloudflare-tunnel-setup.md)"
echo "4. Start services:"
echo "   sudo systemctl enable laravel-aryaintrn"
echo "   sudo systemctl start laravel-aryaintrn"
echo "   sudo systemctl enable cloudflared"
echo "   sudo systemctl start cloudflared"
echo ""

