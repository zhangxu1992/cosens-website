# GitHub Actions 自动部署配置总结

## 📦 已创建的文件

| 文件 | 路径 | 说明 |
|------|------|------|
| **工作流配置** | `.github/workflows/deploy.yml` | 主部署工作流 |
| **密钥设置脚本** | `.github/workflows/setup-secrets.sh` | Linux/Mac 密钥配置助手 |
| **Windows配置** | `setup-github-actions.ps1` | Windows 配置脚本 |
| **完整指南** | `GITHUB-ACTIONS-SETUP.md` | 详细配置文档 |
| **快速卡片** | `GITHUB-ACTIONS-QUICKSTART.md` | 5分钟快速配置 |

---

## 🚀 快速开始（3个步骤）

### 步骤 1: 上传代码到 GitHub

```bash
# 在项目目录执行
cd /var/www/cosens

git init
git add .
git commit -m "Initial commit with GitHub Actions"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/cosens-website.git
git push -u origin main
```

### 步骤 2: 配置服务器 SSH 密钥

```bash
# SSH 到服务器
ssh root@1.14.163.66

# 生成 GitHub Actions 专用密钥
ssh-keygen -t ed25519 -C "github-actions@cosens.cn" -f ~/.ssh/github_actions -N ""

# 授权公钥
cat ~/.ssh/github_actions.pub >> ~/.ssh/authorized_keys

# 查看并复制私钥（全部内容）
cat ~/.ssh/github_actions
```

**复制私钥内容**（从 `-----BEGIN OPENSSH PRIVATE KEY-----` 到 `-----END OPENSSH PRIVATE KEY-----`）

### 步骤 3: 设置 GitHub Secrets

访问: `https://github.com/YOUR_USERNAME/cosens-website/settings/secrets/actions`

点击 **"New repository secret"**，添加以下 Secrets：

| Secret Name | Value | 说明 |
|-------------|-------|------|
| `SERVER_HOST` | `1.14.163.66` | 服务器IP |
| `SERVER_USER` | `root` | SSH用户名 |
| `SERVER_PORT` | `22` | SSH端口 |
| `SSH_PRIVATE_KEY` | [粘贴私钥] | SSH私钥完整内容 |

---

## ✅ 测试自动部署

```bash
# 本地修改文件
echo "# Auto deployment test" >> README.md
git add .
git commit -m "Test GitHub Actions auto deployment"
git push origin main
```

**查看部署状态：**
- 访问: https://github.com/YOUR_USERNAME/cosens-website/actions
- 或运行: `gh run list`（需安装 GitHub CLI）

---

## 🔄 自动部署流程

```
代码推送到 main 分支
        ↓
GitHub Actions 触发
        ↓
┌──────────────────┐
│ 1. 运行测试      │
│    - 单元测试    │
│    - 功能测试    │
└──────────────────┘
        ↓
┌──────────────────┐
│ 2. 构建资源      │
│    - Composer    │
│    - NPM install │
│    - 编译前端    │
└──────────────────┘
        ↓
┌──────────────────┐
│ 3. 部署到服务器  │
│    - 创建备份    │
│    - 上传文件    │
│    - 运行迁移    │
│    - 优化缓存    │
│    - 重启服务    │
└──────────────────┘
        ↓
网站自动更新！
```

---

## 📊 部署功能特性

### ✅ 自动备份
- 每次部署前自动创建备份
- 备份位置: `/var/www/backups/`
- 保留最近 5 个备份

### ✅ 零停机部署
- 原子性部署（先解压到新目录，再切换）
- 保留 storage 和 .env 文件
- 自动设置权限

### ✅ 错误处理
- 部署失败自动回滚
- 详细日志记录
- 支持 Slack 通知

### ✅ 缓存优化
- 自动运行 `php artisan optimize`
- 配置缓存、路由缓存、视图缓存
- OPcache 优化

---

## 🛠️ 高级配置

### 手动触发部署

修改 `.github/workflows/deploy.yml`，添加：
```yaml
on:
  push:
    branches: [ main, master ]
  workflow_dispatch:  # 手动触发
```

然后在 GitHub Actions 页面点击 "Run workflow"。

### 多环境部署

创建 `.github/workflows/deploy-staging.yml`：
```yaml
name: Deploy to Staging
on:
  push:
    branches: [ develop ]
jobs:
  deploy:
    uses: ./.github/workflows/deploy.yml
    secrets:
      SERVER_HOST: ${{ secrets.STAGING_HOST }}
      SERVER_USER: ${{ secrets.STAGING_USER }}
      SSH_PRIVATE_KEY: ${{ secrets.STAGING_SSH_KEY }}
```

### 分支保护

建议开启分支保护：
1. 访问: `Settings` → `Branches`
2. 添加规则: `main`
3. 启用:
   - ✅ Require a pull request before merging
   - ✅ Require status checks to pass

---

## 📁 工作流文件说明

### `.github/workflows/deploy.yml`

| 配置项 | 说明 |
|--------|------|
| `on.push.branches` | 触发分支 |
| `jobs.test` | 测试任务 |
| `jobs.deploy.needs` | 依赖测试通过 |
| `jobs.deploy.if` | 只在 main 分支运行 |
| `appleboy/scp-action` | 文件上传 |
| `appleboy/ssh-action` | 远程命令执行 |

### 环境变量

| 变量 | 值 |
|------|-----|
| `PHP_VERSION` | `8.3` |
| `NODE_VERSION` | `20` |

---

## 🔐 安全说明

### SSH 密钥安全
- ✅ 私钥仅存储在 GitHub Secrets 中
- ✅ 不在代码仓库中存储任何密钥
- ✅ 建议使用专用部署密钥（非个人密钥）
- ✅ 定期轮换密钥

### 服务器安全
```bash
# 限制密钥权限
chmod 700 ~/.ssh
chmod 600 ~/.ssh/authorized_keys
chmod 600 ~/.ssh/github_actions

# 可选：创建专用部署用户
useradd -m deployer
usermod -aG www-data deployer
```

---

## 🐛 故障排查

### 问题 1: Permission denied (publickey)

**原因**: SSH 密钥未正确配置

**解决**:
```bash
# 服务器上执行
chmod 600 ~/.ssh/authorized_keys
# 确认公钥已添加到 authorized_keys
grep "github-actions" ~/.ssh/authorized_keys
```

### 问题 2: 部署成功但网站未更新

**原因**: 缓存未刷新或权限问题

**解决**:
```bash
# 服务器上执行
cd /var/www/cosens
php artisan optimize:clear
php artisan optimize
sudo systemctl reload nginx
```

### 问题 3: 迁移失败

**原因**: 数据库连接问题

**解决**:
```bash
# 检查数据库连接
mysql -u cosens_user -pCosensUser@2026 -e "SELECT 1;"

# 检查 .env 配置
cat /var/www/cosens/.env | grep DB_
```

### 问题 4: 文件权限错误

**解决**:
```bash
chown -R www-data:www-data /var/www/cosens
chmod -R 755 /var/www/cosens/storage
chmod -R 755 /var/www/cosens/bootstrap/cache
```

---

## 📝 常用命令

```bash
# 查看最近部署
gh run list

# 查看部署日志
gh run view --log

# 查看 Secrets
gh secret list

# 设置 Secret
gh secret set SERVER_HOST --body="1.14.163.66"
```

---

## ✅ 配置完成检查清单

- [ ] 代码已推送到 GitHub
- [ ] 服务器 SSH 密钥已生成
- [ ] GitHub Secrets 已配置 (SERVER_HOST, SERVER_USER, SSH_PRIVATE_KEY)
- [ ] 测试推送触发部署
- [ ] 部署成功，网站正常访问
- [ ] 可选：配置 Slack 通知
- [ ] 可选：开启分支保护

---

## 🎉 完成！

配置完成后，每次推送到 `main` 分支都会：
1. 自动运行测试
2. 构建生产资源
3. 部署到服务器
4. 创建备份
5. 重启服务

**代码推送 = 自动部署！** 🚀

---

## 📞 帮助

- **完整指南**: `GITHUB-ACTIONS-SETUP.md`
- **快速卡片**: `GITHUB-ACTIONS-QUICKSTART.md`
- **GitHub Actions 文档**: https://docs.github.com/actions
