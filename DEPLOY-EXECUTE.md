# Cosens 网站 - 部署执行指南

**服务器**: 1.14.163.66  
**域名**: cosens.cn  
**日期**: 2026-05-09

---

## 📋 部署前准备

### 1. 上传项目文件

**方法A: 使用 SCP (Windows PowerShell)**

```powershell
# 在项目目录打开 PowerShell
$serverIP = "1.14.163.66"
$localPath = "C:\Users\Administrator\WorkBuddy\2026-05-09-task-1\cosens-website\*"

# 上传文件（需要输入密码: Sunan6668888.）
scp -r $localPath root@$serverIP:/var/www/cosens/
```

**方法B: 使用 WinSCP 或 FileZilla**

1. 打开 WinSCP / FileZilla
2. 连接信息:
   - 主机: 1.14.163.66
   - 用户名: root
   - 密码: Sunan6668888.
   - 端口: 22
3. 将本地 `cosens-website` 文件夹上传到 `/var/www/cosens/`

**方法C: 打包上传**

```powershell
# 本地打包
cd "C:\Users\Administrator\WorkBuddy\2026-05-09-task-1"
Compress-Archive -Path "cosens-website" -DestinationPath "cosens-website.zip"

# 然后使用任意方式上传 zip 文件到服务器
```

---

## 🚀 服务器部署步骤

### 步骤 1: 连接服务器

```bash
ssh root@1.14.163.66
# 密码: Sunan6668888.
```

### 步骤 2: 创建项目目录

```bash
mkdir -p /var/www/cosens
cd /var/www/cosens
```

### 步骤 3: 上传项目文件

如果使用 zip 上传，解压:
```bash
cd /var/www
unzip cosens-website.zip
mv cosens-website cosens
cd cosens
```

### 步骤 4: 运行安装脚本

```bash
cd /var/www/cosens
chmod +x install.sh
bash install.sh
```

**安装过程将自动完成:**
- ✅ 更新系统包
- ✅ 安装 PHP 8.3 + 扩展
- ✅ 安装 Composer
- ✅ 安装 MySQL 8.0 (数据库: cosens_db, 用户: cosens_user/CosensUser@2026)
- ✅ 安装 Redis
- ✅ 安装 Nginx
- ✅ 安装 Node.js 20.x
- ✅ 安装 Certbot (SSL证书)

**预计时间**: 5-10 分钟

---

### 步骤 5: 运行部署脚本

```bash
cd /var/www/cosens
chmod +x deploy.sh
bash deploy.sh
```

**部署过程将自动完成:**
- ✅ 安装 PHP 依赖 (composer install)
- ✅ 安装前端依赖 (npm ci)
- ✅ 构建前端资源 (npm run build)
- ✅ 创建环境文件 (.env)
- ✅ 设置目录权限
- ✅ 运行数据库迁移
- ✅ 创建存储链接
- ✅ 优化项目
- ✅ 配置 Nginx
- ✅ 申请 SSL 证书 (Let's Encrypt)

**预计时间**: 3-5 分钟

---

### 步骤 6: 创建管理员账户

```bash
cd /var/www/cosens
php artisan make:filament-user
```

按提示输入:
- Name: admin
- Email: admin@cosens.cn
- Password: [设置强密码]

---

## 🔍 部署后检查

### 1. 检查服务状态

```bash
# 检查 Nginx
systemctl status nginx

# 检查 PHP-FPM
systemctl status php8.3-fpm

# 检查 MySQL
systemctl status mysql

# 检查 Redis
systemctl status redis-server
```

### 2. 测试网站访问

浏览器访问:
- http://cosens.cn
- https://cosens.cn
- https://www.cosens.cn

### 3. 测试后台访问

- https://cosens.cn/admin

### 4. 检查日志

```bash
# 查看 Laravel 日志
tail -f /var/www/cosens/storage/logs/laravel.log

# 查看 Nginx 错误日志
tail -f /var/log/nginx/error.log

# 查看 PHP-FPM 日志
tail -f /var/log/php8.3-fpm.log
```

---

## 🛠️ 手动修复命令

如果部署过程中出现问题，可以手动执行以下命令:

### 数据库连接问题

```bash
# 登录 MySQL
mysql -u root -p
# 密码: CosensDB@2026

# 检查数据库
SHOW DATABASES;
USE cosens_db;
SHOW TABLES;

# 重新创建用户
CREATE USER IF NOT EXISTS 'cosens_user'@'localhost' IDENTIFIED BY 'CosensUser@2026';
GRANT ALL PRIVILEGES ON cosens_db.* TO 'cosens_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 权限问题

```bash
chown -R www-data:www-data /var/www/cosens
chmod -R 755 /var/www/cosens/storage
chmod -R 755 /var/www/cosens/bootstrap/cache
chmod -R 775 /var/www/cosens/storage/logs
```

### 重新运行迁移

```bash
cd /var/www/cosens
php artisan migrate:fresh
```

### 重新优化

```bash
cd /var/www/cosens
php artisan optimize:clear
php artisan optimize
```

### 重启所有服务

```bash
systemctl restart nginx php8.3-fpm mysql redis-server
```

---

## 📊 部署验证清单

- [ ] 网站 http://cosens.cn 可以访问
- [ ] 网站 https://cosens.cn 可以访问 (SSL)
- [ ] 后台 https://cosens.cn/admin 可以登录
- [ ] 数据库连接正常
- [ ] 文件上传功能正常
- [ ] 多语言切换正常
- [ ] 页面加载速度快 (< 3秒)

---

## 🔒 安全建议

部署完成后建议:

1. **修改默认密码**
   - MySQL root 密码
   - Filament 管理员密码

2. **配置防火墙**
   ```bash
   ufw allow 22/tcp    # SSH
   ufw allow 80/tcp    # HTTP
   ufw allow 443/tcp   # HTTPS
   ufw enable
   ```

3. **禁用 root SSH 登录** (可选)
   ```bash
   nano /etc/ssh/sshd_config
   # 修改: PermitRootLogin no
   systemctl restart sshd
   ```

4. **定期备份**
   ```bash
   # 数据库备份
   mysqldump -u cosens_user -p cosens_db > backup_$(date +%Y%m%d).sql
   ```

---

## 📞 问题排查

### 502 Bad Gateway
```bash
systemctl restart php8.3-fpm
```

### 403 Forbidden
```bash
chown -R www-data:www-data /var/www/cosens
```

### 数据库连接错误
检查 `.env` 文件中的数据库配置是否正确

### SSL 证书问题
```bash
certbot renew --dry-run
certbot renew
```

---

**部署完成后，网站将正式上线！** 🎉
