#!/bin/bash

# Setup script untuk deployment Laravel Portfolio ke Ubuntu Server
# Pastikan script ini dijalankan dengan sudo atau sebagai root

set -e

echo "========================================="
echo "Setup Deployment Laravel Portfolio"
echo "========================================="

# Warna untuk output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Konfigurasi
APP_NAME="portfolio"
APP_USER="website"
APP_DIR="/var/www/${APP_NAME}"
PHP_VERSION="8.2"
APP_PORT="8000"
DOMAIN="aryaintaran.dev"

echo -e "${GREEN}Konfigurasi:${NC}"
echo "  App Name: $APP_NAME"
echo "  App User: $APP_USER"
echo "  App Directory: $APP_DIR"
echo "  PHP Version: $PHP_VERSION"
echo "  App Port: $APP_PORT"
echo "  Domain: $DOMAIN"
echo ""

# Update system
echo -e "${YELLOW}[1/8] Update system packages...${NC}"
apt-get update
apt-get upgrade -y

# Install dependencies
echo -e "${YELLOW}[2/8] Install dependencies...${NC}"
apt-get install -y \
    software-properties-common \
    curl \
    wget \
    git \
    unzip \
    nginx \
    supervisor \
    sqlite3 \
    libsqlite3-dev

# Install PHP dan extensions
echo -e "${YELLOW}[3/8] Install PHP dan extensions...${NC}"
add-apt-repository ppa:ondrej/php -y
apt-get update
apt-get install -y \
    php${PHP_VERSION} \
    php${PHP_VERSION}-fpm \
    php${PHP_VERSION}-cli \
    php${PHP_VERSION}-common \
    php${PHP_VERSION}-mysql \
    php${PHP_VERSION}-zip \
    php${PHP_VERSION}-gd \
    php${PHP_VERSION}-mbstring \
    php${PHP_VERSION}-curl \
    php${PHP_VERSION}-xml \
    php${PHP_VERSION}-bcmath \
    php${PHP_VERSION}-sqlite3

# Install Composer
echo -e "${YELLOW}[4/8] Install Composer...${NC}"
if [ ! -f /usr/local/bin/composer ]; then
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
    chmod +x /usr/local/bin/composer
fi

# Install Node.js dan npm
echo -e "${YELLOW}[5/8] Install Node.js dan npm...${NC}"
if [ ! -f /usr/bin/node ]; then
    curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
    apt-get install -y nodejs
fi

# Install Cloudflare Tunnel (cloudflared)
echo -e "${YELLOW}[6/8] Install Cloudflare Tunnel...${NC}"
if [ ! -f /usr/local/bin/cloudflared ]; then
    wget -q https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-linux-amd64.deb
    dpkg -i cloudflared-linux-amd64.deb || apt-get install -f -y
    rm -f cloudflared-linux-amd64.deb
fi

# Buat user website jika belum ada
echo -e "${YELLOW}[7/9] Setup user website...${NC}"
if ! id "$APP_USER" &>/dev/null; then
    useradd -r -s /bin/bash -d /home/$APP_USER -m $APP_USER
    echo -e "${GREEN}User $APP_USER berhasil dibuat${NC}"
else
    echo -e "${GREEN}User $APP_USER sudah ada${NC}"
fi

# Buat direktori aplikasi
echo -e "${YELLOW}[8/9] Setup direktori aplikasi...${NC}"
mkdir -p $APP_DIR
chown -R $APP_USER:$APP_USER $APP_DIR

# Setup permissions
echo -e "${YELLOW}[9/9] Setup permissions...${NC}"
chown -R $APP_USER:$APP_USER $APP_DIR
chmod -R 755 $APP_DIR

echo -e "${GREEN}=========================================${NC}"
echo -e "${GREEN}Setup selesai!${NC}"
echo -e "${GREEN}=========================================${NC}"
echo ""
echo "Langkah selanjutnya:"
echo "1. Clone atau upload aplikasi ke: $APP_DIR"
echo "2. Jalankan script deploy.sh untuk deployment"
echo "3. Konfigurasi Cloudflare Tunnel (lihat deploy/cloudflare-tunnel-setup.md)"
echo "4. Setup .env file dengan konfigurasi production"
echo ""

