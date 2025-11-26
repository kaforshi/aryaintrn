#!/bin/bash

# Script untuk membuat user website khusus
# Script ini sudah termasuk di setup-ubuntu.sh, tapi bisa dijalankan terpisah jika perlu

set -e

APP_USER="website"

# Warna untuk output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${YELLOW}Membuat user $APP_USER...${NC}"

if ! id "$APP_USER" &>/dev/null; then
    # Buat user dengan home directory
    useradd -r -s /bin/bash -d /home/$APP_USER -m $APP_USER
    
    # Tambahkan user ke grup www-data untuk kompatibilitas (optional)
    usermod -aG www-data $APP_USER 2>/dev/null || true
    
    echo -e "${GREEN}User $APP_USER berhasil dibuat!${NC}"
    echo ""
    echo "User details:"
    id $APP_USER
    echo ""
    echo "Home directory: /home/$APP_USER"
else
    echo -e "${GREEN}User $APP_USER sudah ada${NC}"
fi

