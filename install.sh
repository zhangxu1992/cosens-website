#!/bin/bash
# Cosens Website Quick Install Script
# 在服务器上执行此脚本完成快速部署

set -e

echo "========================================"
echo "  Cosens Website Installation Script"
echo "  Server: 1.14.163.66"
echo "  Domain: cosens.cn"
echo "========================================"
echo ""

# 颜色定义
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# 检查是否以 root 运行
if [ "$EUID" -ne 0 ]; then 
    echo -e "${RED}请使用 root 用户运行此脚本${NC}"
    exit 1
fi

PROJECT_DIR="/var/www/cosens"
DOMAIN="cosens.cn"

echo -e "${YELLOW}[步骤 1/8] 更新系统...${NC}"
apt-get update -qq && apt-get upgrade -y -qq

echo -e "${YELLOW}[步骤 2/8] 安装基础工具...${NC}"
apt-get install -y -qq curl wget git unzip software-properties-common \
    apt-transport-https ca-certificates gnupg2 nginx redis-server

echo -e "${YELLOW}[步骤 3/8] 安装 PHP 8.3...${NC}"
add-apt-repository ppa:ondrej/php -y -qq
apt-get update -qq
apt-get install -y -qq php8.3 php8.3-fpm php8.3-cli php8.3-common \
    php8.3-mysql php8.3-redis php8.3-mbstring php8.3-xml php8.3-curl \
    php8.3-zip php8.3-bcmath php8.3-intl php8.3-gd php8.3-opcache

echo -e "${YELLOW}[步骤 4/8] 安装 Composer...${NC}"
if ! command -v composer &> /dev/null; then
    curl -sS https://getcomposer.org/installer | php -- \
        --install-dir=/usr/local/bin --filename=composer --quiet
fi

echo -e "${YELLOW}[步骤 5/8] 安装 MySQL 8.0...${NC}"
if ! command -v mysql &> /dev/null; then
    apt-get install -y -qq mysql-server-8.0
    
    # 配置 MySQL
    mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'CosensDB@2026';"
    mysql -e "CREATE DATABASE IF NOT EXISTS cosens_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
    mysql -e "CREATE USER IF NOT EXISTS 'cosens_user'@'localhost' IDENTIFIED BY 'CosensUser@2026';"
    mysql -e "GRANT ALL PRIVILEGES ON cosens_db.* TO 'cosens_user'@'localhost';"
    mysql -e "FLUSH PRIVILEGES;"
    echo -e "${GREEN}✓ MySQL 配置完成${NC}"
fi

echo -e "${YELLOW}[步骤 6/8] 安装 Node.js 20.x...${NC}"
if ! command -v node &> /dev/null; then
    curl -fsSL https://deb.nodesource.com/setup_20.x | bash - > /dev/null 2>&1
    apt-get install -y -qq nodejs
fi

echo -e "${YELLOW}[步骤 7/8] 安装 Certbot...${NC}"
apt-get install -y -qq certbot python3-certbot-nginx

echo -e "${GREEN}[步骤 8/8] 环境安装完成！${NC}"
echo ""
echo "========================================"
echo "  安装版本信息:"
echo "========================================"
echo "  PHP: $(php -v | head -n 1 | cut -d ' ' -f 2)"
echo "  Composer: $(composer --version 2>/dev/null | cut -d ' ' -f 3 || echo '未安装')"
echo "  MySQL: $(mysql --version 2>/dev/null | grep -oP '8\.[0-9]+\.[0-9]+' || echo '未安装')"
echo "  Nginx: $(nginx -v 2>&1 | grep -oP 'nginx/[0-9.]+' | cut -d '/' -f 2)"
echo "  Node.js: $(node --version 2>/dev/null || echo '未安装')"
echo "========================================"
echo ""
echo -e "${GREEN}✓ 服务器环境安装完成！${NC}"
echo ""
echo "下一步操作:"
echo "1. 上传项目文件到 $PROJECT_DIR"
echo "2. 复制 nginx.conf 到 /etc/nginx/sites-available/cosens"
echo "3. 运行 deploy.sh 完成部署"
echo ""
echo "数据库信息:"
echo "  数据库: cosens_db"
echo "  用户名: cosens_user"
echo "  密码: CosensUser@2026"
echo ""
