# Cosens 网站部署验证清单

## 部署信息
- **服务器**: 1.14.163.66
- **域名**: cosens.cn / www.cosens.cn
- **部署日期**: 2026-05-09
- **项目路径**: /var/www/cosens

---

## ✅ 功能测试清单

### 1. 基础访问测试

| 测试项 | URL | 预期结果 | 状态 |
|--------|-----|----------|------|
| HTTP 访问 | http://cosens.cn | 自动跳转到 HTTPS | ⬜ |
| HTTPS 访问 | https://cosens.cn | 正常显示，SSL证书有效 | ⬜ |
| WWW 访问 | https://www.cosens.cn | 正常显示 | ⬜ |
| 后台访问 | https://cosens.cn/admin | 显示登录界面 | ⬜ |

### 2. 多语言测试

| 测试项 | URL | 预期结果 | 状态 |
|--------|-----|----------|------|
| 简体中文 | https://cosens.cn/zh_CN/ | 中文界面 | ⬜ |
| 英文 | https://cosens.cn/en/ | 英文界面 | ⬜ |
| 西班牙语 | https://cosens.cn/es/ | 西班牙语界面 | ⬜ |
| 法语 | https://cosens.cn/fr/ | 法语界面 | ⬜ |
| 德语 | https://cosens.cn/de/ | 德语界面 | ⬜ |
| 俄语 | https://cosens.cn/ru/ | 俄语界面 | ⬜ |
| 日语 | https://cosens.cn/ja/ | 日语界面 | ⬜ |
| 韩语 | https://cosens.cn/ko/ | 韩语界面 | ⬜ |
| 阿拉伯语 | https://cosens.cn/ar/ | 阿拉伯语界面（RTL） | ⬜ |
| 葡萄牙语 | https://cosens.cn/pt/ | 葡萄牙语界面 | ⬜ |

### 3. 数据库连接测试

```bash
# 登录 MySQL 检查
mysql -u cosens_user -p -e "SHOW DATABASES; USE cosens_db; SHOW TABLES;"
# 密码: CosensUser@2026
```

**预期结果**: 
- 数据库 `cosens_db` 存在
- 以下表已创建:
  - categories
  - products
  - posts
  - cases
  - inquiries
  - quotations
  - pages
  - settings
  - users
  - migrations
  - personal_access_tokens

**状态**: ⬜

### 4. 后台功能测试

访问 https://cosens.cn/admin

| 功能 | 测试步骤 | 预期结果 | 状态 |
|------|----------|----------|------|
| 登录 | 输入管理员账号密码 | 成功进入后台 | ⬜ |
| 仪表盘 | 查看首页统计 | 显示正常 | ⬜ |
| 产品管理 | 创建/编辑/删除产品 | 操作成功 | ⬜ |
| 分类管理 | 创建多级分类 | 操作成功 | ⬜ |
| 文章管理 | 创建/发布文章 | 操作成功 | ⬜ |
| 询盘管理 | 查看询盘列表 | 显示正常 | ⬜ |
| 设置管理 | 修改网站设置 | 保存成功 | ⬜ |

### 5. 服务器服务状态

```bash
# 检查各服务状态
systemctl status nginx
systemctl status php8.3-fpm
systemctl status mysql
systemctl status redis-server
```

**预期结果**: 所有服务状态为 `active (running)`

**状态**: ⬜

### 6. 文件权限检查

```bash
# 检查权限
ls -la /var/www/cosens/storage
ls -la /var/www/cosens/bootstrap/cache
```

**预期结果**: 
- storage 目录权限: 755 (www-data:www-data)
- cache 目录权限: 755 (www-data:www-data)

**状态**: ⬜

### 7. SSL 证书检查

```bash
# 检查证书
openssl x509 -in /etc/letsencrypt/live/cosens.cn/fullchain.pem -text -noout | grep "Not After"
```

**预期结果**: 
- 证书有效期正常
- 自动续期已配置

**状态**: ⬜

---

## 🐛 常见问题排查

### 问题 1: 502 Bad Gateway

**解决**:
```bash
systemctl restart php8.3-fpm
systemctl restart nginx
```

### 问题 2: 数据库连接错误

**检查**:
```bash
# 检查 .env 文件
cat /var/www/cosens/.env | grep DB_

# 测试数据库连接
mysql -u cosens_user -pCosensUser@2026 -e "SELECT 1;"
```

### 问题 3: 权限错误

**解决**:
```bash
chown -R www-data:www-data /var/www/cosens
chmod -R 755 /var/www/cosens/storage
chmod -R 755 /var/www/cosens/bootstrap/cache
```

### 问题 4: 静态文件 404

**解决**:
```bash
cd /var/www/cosens
php artisan storage:link
```

---

## 📝 部署后待办

- [ ] 修改默认管理员密码
- [ ] 配置企业邮箱 SMTP
- [ ] 申请 WhatsApp 商业账号
- [ ] 上传 Logo 和品牌资料
- [ ] 添加初始产品数据
- [ ] 配置网站 SEO 信息
- [ ] 设置定时备份任务

---

## 🔒 安全建议

部署完成后建议执行：

```bash
# 1. 配置防火墙
ufw allow 22/tcp
ufw allow 80/tcp
ufw allow 443/tcp
ufw enable

# 2. 设置自动备份
crontab -e
# 添加: 0 2 * * * mysqldump -u cosens_user -pCosensUser@2026 cosens_db > /backup/db_$(date +\%Y\%m\%d).sql

# 3. 监控日志
tail -f /var/www/cosens/storage/logs/laravel.log
```

---

**部署验证完成！** ✅
