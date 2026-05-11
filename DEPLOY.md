# Cosens Website - 部署指南

## 项目信息
- **域名**: cosens.cn
- **服务器IP**: 1.14.163.66
- **服务器账号**: root
- **技术栈**: Laravel 12 + FilamentPHP 3 + PHP 8.3 + MySQL 8.0 + Redis

---

## 第一步：服务器环境配置

### 1.1 连接服务器并执行初始化

```bash
# 连接服务器
ssh root@1.14.163.66

# 更新系统
apt-get update && apt-get upgrade -y

# 安装基础工具
apt-get install -y curl wget git unzip software-properties-common \
    apt-transport-https ca-certificates gnupg2
```

### 1.2 安装 PHP 8.3

```bash
# 添加 PHP 8.3 仓库
add-apt-repository ppa:ondrej/php -y
apt-get update

# 安装 PHP 8.3 及扩展
apt-get install -y php8.3 php8.3-fpm php8.3-cli php8.3-common \
    php8.3-mysql php8.3-redis php8.3-mbstring php8.3-xml php8.3-curl \
    php8.3-zip php8.3-bcmath php8.3-intl php8.3-gd php8.3-opcache
```

### 1.3 安装 Composer

```bash
curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer
```

### 1.4 安装 MySQL 8.0

```bash
apt-get install -y mysql-server-8.0

# 配置 MySQL
mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'CosensDB@2026';"
mysql -e "CREATE DATABASE IF NOT EXISTS cosens_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -e "CREATE USER IF NOT EXISTS 'cosens_user'@'localhost' IDENTIFIED BY 'CosensUser@2026';"
mysql -e "GRANT ALL PRIVILEGES ON cosens_db.* TO 'cosens_user'@'localhost';"
mysql -e "FLUSH PRIVILEGES;"
```

### 1.5 安装 Redis

```bash
apt-get install -y redis-server
systemctl enable redis-server
systemctl start redis-server
```

### 1.6 安装 Nginx

```bash
apt-get install -y nginx
systemctl enable nginx
systemctl start nginx
```

### 1.7 安装 Node.js 20.x

```bash
curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
apt-get install -y nodejs
```

### 1.8 安装 Certbot (SSL证书)

```bash
apt-get install -y certbot python3-certbot-nginx
```

---

## 第二步：项目部署

### 2.1 创建项目目录

```bash
mkdir -p /var/www/cosens
chown -R www-data:www-data /var/www/cosens
```

### 2.2 上传项目文件

将本地项目文件上传到服务器：

```bash
# 在本地执行（Windows 使用 scp 或 SFTP 工具）
scp -r ./cosens-website/* root@1.14.163.66:/var/www/cosens/

# 或者使用 rsync
rsync -avz --exclude='node_modules' --exclude='vendor' \
    ./cosens-website/ root@1.14.163.66:/var/www/cosens/
```

### 2.3 安装依赖

```bash
cd /var/www/cosens

# 安装 PHP 依赖
composer install --no-dev --optimize-autoloader

# 安装前端依赖
npm install
npm run build
```

### 2.4 配置环境

```bash
# 复制环境文件
cp .env.example .env

# 生成应用密钥
php artisan key:generate

# 设置权限
chown -R www-data:www-data /var/www/cosens
chmod -R 755 /var/www/cosens/storage
chmod -R 755 /var/www/cosens/bootstrap/cache
```

### 2.5 运行迁移和种子

```bash
# 运行数据库迁移
php artisan migrate

# 运行数据种子（创建默认数据）
php artisan db:seed

# 创建 Filament 管理员
php artisan make:filament-user

# 创建存储链接
php artisan storage:link
```

---

## 第三步：Nginx 配置

### 3.1 创建 Nginx 配置文件

```bash
nano /etc/nginx/sites-available/cosens
```

添加以下内容：

```nginx
server {
    listen 80;
    server_name cosens.cn www.cosens.cn;
    root /var/www/cosens/public;
    index index.php index.html;

    # Gzip 压缩
    gzip on;
    gzip_vary on;
    gzip_types text/plain text/css application/json application/javascript text/xml application/xml;

    # 静态文件缓存
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2)$ {
        expires 1M;
        add_header Cache-Control "public, immutable";
    }

    # Laravel 入口
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # PHP 处理
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # 禁止访问隐藏文件
    location ~ /\. {
        deny all;
    }

    # 上传文件大小限制
    client_max_body_size 64M;
}
```

### 3.2 启用站点

```bash
ln -s /etc/nginx/sites-available/cosens /etc/nginx/sites-enabled/
nginx -t
systemctl reload nginx
```

---

## 第四步：SSL 证书配置

### 4.1 申请 SSL 证书

```bash
certbot --nginx -d cosens.cn -d www.cosens.cn

# 按照提示完成验证
```

### 4.2 设置自动续期

```bash
# 测试自动续期
certbot renew --dry-run

# 添加定时任务 (自动续期)
echo "0 2 * * * /usr/bin/certbot renew --quiet" | crontab -
```

---

## 第五步：队列和定时任务

### 5.1 配置 Supervisor 管理队列

```bash
apt-get install -y supervisor

# 创建队列配置文件
nano /etc/supervisor/conf.d/cosens-worker.conf
```

添加：

```ini
[program:cosens-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/cosens/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/cosens/storage/logs/worker.log
stopwaitsecs=3600
```

```bash
supervisorctl reread
supervisorctl update
supervisorctl start cosens-worker:*
```

### 5.2 配置定时任务

```bash
crontab -e
```

添加：

```
# Laravel 定时任务
* * * * * cd /var/www/cosens && php artisan schedule:run >> /dev/null 2>&1
```

---

## 第六步：优化配置

### 6.1 PHP-FPM 优化

```bash
nano /etc/php/8.3/fpm/pool.d/www.conf
```

修改：

```ini
pm = dynamic
pm.max_children = 20
pm.start_servers = 5
pm.min_spare_servers = 2
pm.max_spare_servers = 8
pm.max_requests = 500
```

```bash
systemctl restart php8.3-fpm
```

### 6.2 OPcache 优化

```bash
nano /etc/php/8.3/fpm/conf.d/10-opcache.ini
```

添加：

```ini
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=10000
opcache.revalidate_freq=2
opcache.validate_timestamps=0
opcache.fast_shutdown=1
```

### 6.3 项目优化

```bash
cd /var/www/cosens

# 缓存配置
php artisan config:cache

# 缓存路由
php artisan route:cache

# 缓存视图
php artisan view:cache

# 优化自动加载
composer dump-autoload --optimize
```

---

## 第七步：部署后检查清单

### 7.1 基础检查

- [ ] 访问 https://cosens.cn 正常显示
- [ ] 访问 https://cosens.cn/admin 能进入后台
- [ ] HTTPS 证书有效
- [ ] 多语言切换正常

### 7.2 功能检查

- [ ] 产品列表和详情页正常
- [ ] 新闻列表和详情页正常
- [ ] 案例展示正常
- [ ] 询盘表单提交正常
- [ ] 后台管理功能正常

### 7.3 性能检查

- [ ] 页面加载速度 < 3秒
- [ ] 图片懒加载正常
- [ ] CDN 加速生效（如配置）

---

## 第八步：维护命令

```bash
# 重启所有服务
systemctl restart nginx php8.3-fpm redis-server supervisor

# 查看队列状态
supervisorctl status cosens-worker

# 清理缓存
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 重新优化
php artisan optimize

# 查看日志
tail -f /var/www/cosens/storage/logs/laravel.log
```

---

## 数据库信息

| 项目 | 值 |
|------|-----|
| 数据库名 | cosens_db |
| 用户名 | cosens_user |
| 密码 | CosensUser@2026 |

---

## 常用文件位置

| 文件 | 路径 |
|------|------|
| 项目根目录 | /var/www/cosens |
| Nginx 配置 | /etc/nginx/sites-available/cosens |
| PHP-FPM 配置 | /etc/php/8.3/fpm/pool.d/www.conf |
| MySQL 配置 | /etc/mysql/mysql.conf.d/mysqld.cnf |
| 日志文件 | /var/www/cosens/storage/logs/ |

---

## 故障排查

### 502 Bad Gateway
```bash
systemctl status php8.3-fpm
systemctl restart php8.3-fpm
```

### 数据库连接错误
```bash
# 检查 MySQL 状态
systemctl status mysql

# 检查数据库用户权限
mysql -u cosens_user -p cosens_db
```

### 权限错误
```bash
chown -R www-data:www-data /var/www/cosens
chmod -R 755 /var/www/cosens/storage
chmod -R 755 /var/www/cosens/bootstrap/cache
```

---

**部署完成！** 🎉
