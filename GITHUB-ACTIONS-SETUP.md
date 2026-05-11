# GitHub Actions 自动部署配置指南

本指南将帮助您配置 GitHub Actions 实现代码推送后自动部署到服务器。

---

## 📋 工作原理

```
推送代码到 main 分支
        ↓
GitHub Actions 自动触发
        ↓
运行测试 → 构建资源 → 部署到服务器
        ↓
网站自动更新
```

---

## 🚀 快速配置步骤

### 步骤 1: 创建 GitHub 仓库

1. 访问 https://github.com/new
2. 创建新仓库（建议名称: `cosens-website`）
3. **不要** 初始化 README（我们已有）

### 步骤 2: 上传代码到 GitHub

```bash
# 在项目目录执行
cd /var/www/cosens

# 初始化 git
git init

# 添加所有文件
git add .

# 提交
git commit -m "Initial commit: Laravel + FilamentPHP setup"

# 添加远程仓库（替换 YOUR_USERNAME）
git remote add origin https://github.com/YOUR_USERNAME/cosens-website.git

# 推送
git branch -M main
git push -u origin main
```

### 步骤 3: 配置服务器 SSH 密钥

在您的服务器上执行：

```bash
# 生成专门用于 GitHub Actions 的密钥
ssh-keygen -t ed25519 -C "github-actions@cosens.cn" -f ~/.ssh/github_actions -N ""

# 添加到 authorized_keys
cat ~/.ssh/github_actions.pub >> ~/.ssh/authorized_keys

# 查看私钥（复制到 GitHub Secrets）
cat ~/.ssh/github_actions
```

**复制输出的私钥内容**（包括 `-----BEGIN OPENSSH PRIVATE KEY-----` 和 `-----END OPENSSH PRIVATE KEY-----`）

### 步骤 4: 设置 GitHub Secrets

访问: `https://github.com/YOUR_USERNAME/cosens-website/settings/secrets/actions`

添加以下 Secrets：

| Secret Name | Value | 说明 |
|-------------|-------|------|
| `SERVER_HOST` | `1.14.163.66` | 服务器IP |
| `SERVER_USER` | `root` | SSH用户名 |
| `SERVER_PORT` | `22` | SSH端口 |
| `SSH_PRIVATE_KEY` | [复制的私钥] | SSH私钥完整内容 |
| `SLACK_WEBHOOK` | [可选] | Slack通知地址 |

![Secrets设置位置](https://docs.github.com/assets/cb-60049/images/help/repository/actions-secrets-tab.png)

### 步骤 5: 测试部署

```bash
# 本地修改一个文件（比如修改 README.md）
echo "# Updated" >> README.md

# 提交并推送
git add .
git commit -m "Test auto deployment"
git push origin main
```

推送后，访问 GitHub 仓库的 **Actions** 标签页，查看部署进度。

---

## 🔧 高级配置

### 添加部署分支保护

1. 访问: `Settings` → `Branches`
2. 添加规则:
   - Branch name pattern: `main`
   - ✅ Require a pull request before merging
   - ✅ Require status checks to pass
   - Status checks: `Run Tests`

### 手动触发部署

修改 `.github/workflows/deploy.yml`，在 `on:` 部分添加：

```yaml
on:
  push:
    branches: [ main, master ]
  workflow_dispatch:  # 手动触发
```

然后可以在 Actions 页面点击 "Run workflow" 手动部署。

### 部署到多个环境

创建 `.github/workflows/deploy-staging.yml`：

```yaml
name: Deploy to Staging

on:
  push:
    branches: [ develop ]

jobs:
  deploy:
    uses: ./.github/workflows/deploy.yml
    with:
      environment: staging
    secrets:
      SERVER_HOST: ${{ secrets.STAGING_HOST }}
      SERVER_USER: ${{ secrets.STAGING_USER }}
      SSH_PRIVATE_KEY: ${{ secrets.STAGING_SSH_KEY }}
```

---

## 📊 部署流程详解

### 完整流程

```
1. 推送代码到 main 分支
        ↓
2. GitHub Actions 触发
   ├── 检出代码
   ├── 设置 PHP 8.3
   ├── 设置 Node.js 20
   └── 安装依赖
        ↓
3. 运行测试
   ├── 单元测试
   └── 功能测试
        ↓
4. 构建生产资源
   ├── 安装 Composer 依赖 (--no-dev)
   ├── 安装 NPM 依赖
   └── 编译前端资源
        ↓
5. 部署到服务器
   ├── 创建备份
   ├── 上传文件
   ├── 运行迁移
   ├── 优化缓存
   └── 重启服务
        ↓
6. 发送通知 (Slack/Email)
```

### 备份策略

每次部署会自动创建备份：
- 备份位置: `/var/www/backups/`
- 备份命名: `cosens-backup-YYYYMMDD-HHMMSS.tar.gz`
- 保留数量: 最近 5 个备份

---

## 🛠️ 故障排查

### 问题 1: 部署失败 - Permission denied

**原因**: SSH 密钥权限或 authorized_keys 配置问题

**解决**:
```bash
# 服务器上执行
chmod 700 ~/.ssh
chmod 600 ~/.ssh/authorized_keys
chmod 600 ~/.ssh/github_actions
```

### 问题 2: 部署失败 - Host key verification failed

**解决**: 工作流已配置 `StrictHostKeyChecking=no`，如需手动添加：
```bash
ssh-keyscan -H 1.14.163.66 >> ~/.ssh/known_hosts
```

### 问题 3: 迁移失败

**解决**: 检查数据库连接和权限
```bash
# 服务器上测试
mysql -u cosens_user -pCosensUser@2026 -e "SELECT 1;"
```

### 问题 4: 权限错误

**解决**:
```bash
# 确保权限正确
chown -R www-data:www-data /var/www/cosens
chmod -R 755 /var/www/cosens/storage
chmod -R 755 /var/www/cosens/bootstrap/cache
```

---

## 🔐 安全建议

### 1. 保护私钥
- ✅ 不要将私钥提交到代码仓库
- ✅ 使用 GitHub Secrets 存储敏感信息
- ✅ 定期轮换 SSH 密钥

### 2. 限制服务器权限
```bash
# 创建专门用于部署的用户
useradd -m deployer
usermod -aG www-data deployer

# 限制 sudo 权限（仅允许特定命令）
echo "deployer ALL=(ALL) NOPASSWD: /bin/systemctl reload nginx" >> /etc/sudoers
```

### 3. 启用分支保护
- 禁止直接推送 main 分支
- 要求 Pull Request 审查
- 要求状态检查通过

---

## 📈 监控与日志

### 查看部署日志

1. GitHub 仓库 → Actions 标签页
2. 点击最新的 workflow run
3. 查看每个步骤的日志

### 服务器日志

```bash
# GitHub Actions 部署日志（如果配置了）
tail -f /var/www/cosens/storage/logs/deploy.log

# Laravel 日志
tail -f /var/www/cosens/storage/logs/laravel.log

# Nginx 错误日志
tail -f /var/log/nginx/error.log
```

---

## 🎯 使用场景

### 场景 1: 日常开发

```bash
# 开发功能
git checkout -b feature/new-page
# ... 编写代码 ...
git add .
git commit -m "Add new page"
git push origin feature/new-page

# 创建 Pull Request → 代码审查 → 合并到 main
# 自动部署到生产环境！
```

### 场景 2: 紧急修复

```bash
# 直接在 main 分支修复
git checkout main
git pull origin main
# ... 修复代码 ...
git add .
git commit -m "Hotfix: fix critical bug"
git push origin main
# 自动部署！
```

### 场景 3: 回滚

如果部署失败，可以回滚到上一版本：

```bash
# 服务器上执行
cd /var/www/backups
# 找到上一个备份
tar -xzf cosens-backup-YYYYMMDD-HHMMSS.tar.gz -C /var/www/cosens
```

---

## 📝 配置文件说明

### deploy.yml

主要配置项：

| 配置 | 说明 |
|------|------|
| `on.push.branches` | 触发部署的分支 |
| `jobs.test` | 自动化测试任务 |
| `jobs.deploy` | 部署任务 |
| `jobs.deploy.steps` | 部署步骤 |

### 关键环境变量

| 变量 | 说明 |
|------|------|
| `PHP_VERSION` | PHP 版本 (8.3) |
| `NODE_VERSION` | Node.js 版本 (20) |

---

## ✅ 配置检查清单

- [ ] GitHub 仓库已创建
- [ ] 代码已推送到 GitHub
- [ ] 服务器 SSH 密钥已生成
- [ ] 公钥已添加到 authorized_keys
- [ ] GitHub Secrets 已配置 (SERVER_HOST, SERVER_USER, SSH_PRIVATE_KEY)
- [ ] 测试推送触发部署
- [ ] 部署成功，网站正常访问

---

## 🎉 完成！

配置完成后，每次推送到 `main` 分支都会：
1. 自动运行测试
2. 构建前端资源
3. 部署到服务器
4. 创建备份
5. 发送通知

**享受自动化部署吧！** 🚀

---

## 📞 需要帮助？

如果遇到问题：
1. 查看 Actions 标签页的详细日志
2. 检查服务器上的错误日志
3. 确认 Secrets 配置正确
