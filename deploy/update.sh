#!/bin/bash

# Script untuk update aplikasi yang sudah terdeploy
# Jalankan script ini setiap kali ada update dari repository

set -e

# Konfigurasi
APP_NAME="aryaintrn"
APP_USER="website"
APP_DIR="/var/www/${APP_NAME}"

# Warna untuk output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${GREEN}=========================================${NC}"
echo -e "${GREEN}Update Laravel Aryaintrn${NC}"
echo -e "${GREEN}=========================================${NC}"

# Cek apakah direktori aplikasi ada
if [ ! -d "$APP_DIR" ]; then
    echo -e "${RED}Error: Direktori $APP_DIR tidak ditemukan!${NC}"
    exit 1
fi

cd $APP_DIR

# Backup .env
if [ -f .env ]; then
    echo -e "${YELLOW}Backup .env file...${NC}"
    cp .env .env.backup.$(date +%Y%m%d_%H%M%S)
fi

# Pull latest changes (jika menggunakan Git)
if [ -d .git ]; then
    echo -e "${YELLOW}[1/8] Pull latest changes dari Git...${NC}"
    git pull origin main || git pull origin master
else
    echo -e "${YELLOW}[1/8] Git repository tidak ditemukan, skip pull...${NC}"
fi

# Install/Update dependencies
echo -e "${YELLOW}[2/8] Update Composer dependencies...${NC}"
sudo -u $APP_USER composer install --no-dev --optimize-autoloader

echo -e "${YELLOW}[3/8] Update NPM dependencies...${NC}"
sudo -u $APP_USER npm ci --production

# Build assets
echo -e "${YELLOW}[4/8] Build assets...${NC}"
sudo -u $APP_USER npm run build

# Clear caches
echo -e "${YELLOW}[5/8] Clear Laravel caches...${NC}"
sudo -u $APP_USER php artisan config:clear
sudo -u $APP_USER php artisan route:clear
sudo -u $APP_USER php artisan view:clear
sudo -u $APP_USER php artisan cache:clear

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

# Restart service
echo -e "${YELLOW}Restart Laravel service...${NC}"
systemctl restart laravel-${APP_NAME}

echo -e "${GREEN}=========================================${NC}"
echo -e "${GREEN}Update selesai!${NC}"
echo -e "${GREEN}=========================================${NC}"
echo ""
echo "Cek status service:"
echo "  sudo systemctl status laravel-${APP_NAME}"
echo ""

