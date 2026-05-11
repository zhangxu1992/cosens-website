#!/bin/bash
# Cosens Website Deploy Script
# 在服务器上项目目录执行此脚本

set -e

echo "========================================"
echo "  Cosens Website Deploy Script"
echo "========================================"
echo ""

PROJECT_DIR="/var/www/cosens"
DOMAIN="cosens.cn"

# 颜色定义
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

# 检查是否在正确的目录
if [ ! -f "composer.json" ]; then
    echo -e "${RED}错误: 请在项目根目录运行此脚本${NC}"
    exit 1
fi

echo -e "${YELLOW}[1/10] 安装 PHP 依赖...${NC}"
composer install --no-dev --optimize-autoloader --no-interaction

echo -e "${YELLOW}[2/10] 安装前端依赖...${NC}"
npm ci

echo -e "${YELLOW}[3/10] 构建前端资源...${NC}"
npm run build

echo -e "${YELLOW}[4/10] 配置环境文件...${NC}"
if [ ! -f ".env" ]; then
    cp .env.example .env
    php artisan key:generate
    echo -e "${GREEN}✓ 环境文件已创建${NC}"
else
    echo -e "${GREEN}✓ 环境文件已存在${NC}"
fi

echo -e "${YELLOW}[5/10] 设置目录权限...${NC}"
chown -R www-data:www-data "$PROJECT_DIR"
chmod -R 755 "$PROJECT_DIR/storage"
chmod -R 755 "$PROJECT_DIR/bootstrap/cache"

echo -e "${YELLOW}[6/10] 运行数据库迁移...${NC}"
php artisan migrate --force

echo -e "${YELLOW}[7/10] 创建存储链接...${NC}"
php artisan storage:link

echo -e "${YELLOW}[8/10] 优化项目...${NC}"
php artisan optimize

echo -e "${YELLOW}[9/10] 配置 Nginx...${NC}"
if [ ! -f "/etc/nginx/sites-available/cosens" ]; then
    cp nginx.conf /etc/nginx/sites-available/cosens
    sed -i "s|/var/www/cosens|$PROJECT_DIR|g" /etc/nginx/sites-available/cosens
    ln -sf /etc/nginx/sites-available/cosens /etc/nginx/sites-enabled/
    
    # 测试配置
    nginx -t
    systemctl reload nginx
    echo -e "${GREEN}✓ Nginx 配置完成${NC}"
else
    echo -e "${GREEN}✓ Nginx 配置已存在${NC}"
fi

echo -e "${YELLOW}[10/10] 配置 SSL 证书...${NC}"
if [ ! -d "/etc/letsencrypt/live/$DOMAIN" ]; then
    echo "正在申请 SSL 证书..."
    certbot --nginx -d $DOMAIN -d www.$DOMAIN --non-interactive --agree-tos --email admin@$DOMAIN
    echo -e "${GREEN}✓ SSL 证书配置完成${NC}"
else
    echo -e "${GREEN}✓ SSL 证书已存在${NC}"
fi

echo ""
echo "========================================"
echo -e "${GREEN}✓ 部署完成！${NC}"
echo "========================================"
echo ""
echo "网站访问地址:"
echo "  - http://$DOMAIN"
echo "  - https://$DOMAIN"
echo "  - https://www.$DOMAIN"
echo ""
echo "后台管理地址:"
echo "  - https://$DOMAIN/admin"
echo ""
echo "如果需要创建管理员账号，请运行:"
echo "  php artisan make:filament-user"
echo ""
