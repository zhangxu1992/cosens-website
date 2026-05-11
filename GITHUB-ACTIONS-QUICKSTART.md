# GitHub Actions 快速配置卡片

## 5分钟快速配置

### 1. 创建 GitHub 仓库（1分钟）
```bash
# 在项目目录
git init
git add .
git commit -m "Initial commit"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/cosens-website.git
git push -u origin main
```

### 2. 服务器配置 SSH 密钥（2分钟）
```bash
# SSH 连接到服务器
ssh root@1.14.163.66

# 生成密钥
ssh-keygen -t ed25519 -C "github-actions@cosens.cn" -f ~/.ssh/github_actions -N ""

# 授权密钥
cat ~/.ssh/github_actions.pub >> ~/.ssh/authorized_keys

# 显示私钥（复制全部内容）
cat ~/.ssh/github_actions
```

### 3. 设置 GitHub Secrets（2分钟）
访问: `https://github.com/YOUR_USERNAME/cosens-website/settings/secrets/actions`

添加:
- `SERVER_HOST` = `1.14.163.66`
- `SERVER_USER` = `root`
- `SERVER_PORT` = `22`
- `SSH_PRIVATE_KEY` = [粘贴私钥内容]

### 4. 测试部署（立即生效）
```bash
# 本地修改并推送
echo "# Test" >> README.md
git add .
git commit -m "Test auto deployment"
git push origin main
```

查看部署状态: https://github.com/YOUR_USERNAME/cosens-website/actions

---

## 自动部署流程

```
git push origin main
        ↓
GitHub Actions 触发
        ↓
✓ 运行测试
✓ 构建资源
✓ 部署到服务器
✓ 创建备份
✓ 重启服务
        ↓
网站自动更新！
```

---

## 常用命令

```bash
# 查看部署状态
gh run list

# 查看日志
gh run view --log

# 手动触发
gh workflow run deploy.yml

# 查看 Secrets
gh secret list
```

---

## 故障排除

| 问题 | 解决 |
|------|------|
| Permission denied | `chmod 600 ~/.ssh/authorized_keys` |
| 部署失败 | 检查 GitHub Actions 日志 |
| 迁移失败 | 检查数据库连接 |
| 网站 500 错误 | 检查 `storage/logs/laravel.log` |

---

## 文件说明

| 文件 | 用途 |
|------|------|
| `.github/workflows/deploy.yml` | 部署工作流配置 |
| `GITHUB-ACTIONS-SETUP.md` | 完整配置指南 |
| `setup-github-actions.ps1` | Windows 自动配置脚本 |

---

**完成配置后，代码推送即自动部署！** 🚀
