# Cosens Industrial Website

Cosens 工业设备展示网站 - Laravel 12 + FilamentPHP 3 多语言企业官网

## 项目特点

- 🚀 **Laravel 12** - 最新 PHP 框架
- 🔧 **FilamentPHP 3** - 现代化后台管理
- 🌍 **10国语言** - 中文/英文/西语/法语/德语/俄语/日语/韩语/阿拉伯语/葡萄牙语
- 📱 **响应式设计** - 完美适配移动端
- 🔍 **SEO 优化** - 内置 SEO 检测中心
- 📧 **询盘系统** - 完整的询盘/报价流程
- 💬 **WhatsApp 集成** - 一键联系
- 🖼️ **媒体库** - 完整的图片管理
- ⚡ **高性能** - Redis 缓存 + 队列优化

## 技术栈

| 技术 | 版本 |
|------|------|
| PHP | 8.3+ |
| Laravel | 12.x |
| FilamentPHP | 3.x |
| Livewire | 3.x |
| MySQL | 8.0+ |
| Redis | 7.x |
| Nginx | 1.24+ |

## 快速开始

### 1. 环境要求

确保服务器已安装：
- PHP 8.3+
- MySQL 8.0+
- Redis
- Nginx
- Composer
- Node.js 20+

### 2. 安装步骤

```bash
# 1. 克隆项目
cd /var/www
git clone <repository> cosens
cd cosens

# 2. 安装依赖
composer install --no-dev --optimize-autoloader
npm install && npm run build

# 3. 配置环境
cp .env.example .env
php artisan key:generate

# 4. 配置数据库（修改 .env 文件）
# DB_DATABASE=cosens_db
# DB_USERNAME=cosens_user
# DB_PASSWORD=your_password

# 5. 运行迁移
php artisan migrate

# 6. 创建管理员
php artisan make:filament-user

# 7. 创建存储链接
php artisan storage:link

# 8. 优化
php artisan optimize
```

### 3. 配置 Nginx

复制 `nginx.conf` 到 `/etc/nginx/sites-available/cosens`，然后：

```bash
ln -s /etc/nginx/sites-available/cosens /etc/nginx/sites-enabled/
nginx -t
systemctl reload nginx
```

### 4. 配置 SSL

```bash
certbot --nginx -d cosens.cn -d www.cosens.cn
```

## 项目结构

```
cosens-website/
├── app/
│   ├── Models/          # 数据模型
│   │   ├── Category.php         # 分类模型（树形结构）
│   │   ├── Product.php          # 产品模型（多语言、SEO）
│   │   ├── Post.php             # 文章模型（新闻）
│   │   ├── CaseStudy.php        # 案例模型
│   │   ├── Inquiry.php          # 询盘模型
│   │   ├── Quotation.php        # 报价模型
│   │   ├── Page.php             # 页面模型
│   │   └── Setting.php          # 设置模型
│   ├── Filament/        # 后台资源（第二阶段开发）
│   ├── Http/            # 控制器
│   │   └── Controllers/
│   └── Services/        # 业务服务
├── config/
│   └── languages.php    # 10国语言配置
├── database/
│   └── migrations/      # 数据库迁移
│       ├── 2025_05_09_000001_create_categories_table.php
│       ├── 2025_05_09_000002_create_products_table.php
│       ├── 2025_05_09_000003_create_posts_table.php
│       ├── 2025_05_09_000004_create_cases_table.php
│       ├── 2025_05_09_000005_create_inquiries_table.php
│       ├── 2025_05_09_000006_create_quotations_table.php
│       ├── 2025_05_09_000007_create_pages_table.php
│       └── 2025_05_09_000008_create_settings_table.php
├── resources/
│   ├── views/           # 视图文件
│   └── lang/            # 语言文件
│       └── zh_CN/
│           └── messages.php
├── routes/
│   └── web.php          # 路由定义
├── storage/             # 存储目录
├── nginx.conf           # Nginx 配置
├── .env.example         # 环境配置模板
├── composer.json        # PHP 依赖配置
├── install.sh           # 服务器环境安装脚本
├── deploy.sh            # 项目部署脚本
├── DEPLOY.md            # 详细部署指南
├── OVERVIEW.md          # 项目概览
└── README.md            # 本文件
```

## 核心文件说明

### 配置文件

| 文件 | 说明 |
|------|------|
| `composer.json` | PHP 依赖配置，包含 Laravel 12、FilamentPHP 3、多语言包等 |
| `.env.example` | 环境变量模板，包含数据库、Redis、邮件等配置 |
| `nginx.conf` | Nginx 服务器配置，含 Gzip、缓存、SSL 等 |
| `config/languages.php` | 10国语言配置（中/英/西/法/德/俄/日/韩/阿/葡） |

### 部署脚本

| 文件 | 用途 |
|------|------|
| `install.sh` | 一键安装服务器环境（PHP 8.3、MySQL、Redis、Nginx） |
| `deploy.sh` | 一键部署项目（安装依赖、运行迁移、配置 Nginx、申请 SSL） |
| `server-setup.sh` | 完整服务器配置脚本（环境 + 项目） |

### 数据模型

| 模型 | 功能说明 |
|------|----------|
| `Category` | 树形分类，支持产品/文章/案例三级分类 |
| `Product` | 产品管理，多语言、SEO 评分、规格参数、图库 |
| `Post` | 文章/新闻，支持公司新闻/行业新闻分类 |
| `CaseStudy` | 客户案例，项目详情、挑战/解决方案/成果 |
| `Inquiry` | 询盘系统，编号自动生成、状态跟踪、产品关联 |
| `Quotation` | 报价单，自动价格计算、有效期管理 |
| `Page` | 单页管理，关于我们/联系我们等页面 |
| `Setting` | 网站设置，缓存支持、多语言值 |

### 数据库迁移

| 迁移文件 | 说明 |
|----------|------|
| `*_create_categories_table` | 分类表（id, parent_id, type, name, slug...） |
| `*_create_products_table` | 产品表（多语言字段、SEO、价格、规格） |
| `*_create_posts_table` | 文章表（标题、摘要、内容、发布时间） |
| `*_create_cases_table` | 案例表（客户、地点、挑战、方案、成果） |
| `*_create_inquiries_table` | 询盘表（询盘号、联系信息、状态） |
| `*_create_quotations_table` | 报价表（报价号、单价、总价、有效期） |
| `*_create_pages_table` | 页面表（key, slug, 多语言内容） |
| `*_create_settings_table` | 设置表（group, key, value, 多语言标签） |

## 后台管理

访问 `/admin` 进入后台管理系统

### 管理模块

- 📊 **仪表盘** - 数据统计和概览
- 📝 **内容管理** - 文章/新闻管理
- 🏭 **产品管理** - 产品/分类管理
- 💼 **案例管理** - 客户案例管理
- 📧 **询盘管理** - 询盘处理和跟踪
- 💰 **报价管理** - 报价单管理
- 🔍 **SEO 中心** - SEO 检测和优化
- 🌍 **多语言** - 翻译管理
- ⚙️ **系统设置** - 网站配置

## 多语言支持

支持 10 种语言：

| 语言 | 代码 | 状态 |
|------|------|------|
| 简体中文 | zh_CN | ✅ 主语言 |
| English | en | ✅ 已支持 |
| Español | es | ✅ 已支持 |
| Français | fr | ✅ 已支持 |
| Deutsch | de | ✅ 已支持 |
| Русский | ru | ✅ 已支持 |
| 日本語 | ja | ✅ 已支持 |
| 한국어 | ko | ✅ 已支持 |
| العربية | ar | ✅ 已支持 (RTL) |
| Português | pt | ✅ 已支持 |

## SEO 检测功能

每个内容页面自动计算 SEO 分数，基于：

- 标题长度优化 (10-70字符)
- 描述完整性 (50-160字符)
- 内容质量 (300+ 字符)
- 图片优化 (ALT标签)
- Meta 标签完整性
- 结构化数据

后台提供批量 SEO 检测和优化建议。

## 询盘/报价流程

```
用户浏览产品
    ↓
点击"询盘"或"获取报价"
    ↓
填写联系信息和需求
    ↓
提交询盘 → 邮件通知管理员
    ↓
后台处理 → 生成报价单
    ↓
发送报价 → 邮件通知客户
```

## 常用命令

```bash
# 清除缓存
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 优化
php artisan optimize

# 队列处理
php artisan queue:work

# 创建管理员
php artisan make:filament-user

# 运行迁移
php artisan migrate

# 数据种子
php artisan db:seed
```

## 部署

详见 [DEPLOY.md](DEPLOY.md) 完整部署指南。

## 许可证

专为企业定制开发，保留所有权利。

---

**项目地址**: https://cosens.cn
