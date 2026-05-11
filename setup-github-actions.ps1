# GitHub Actions Setup Script for Windows
# Cosens Website Auto Deployment Setup

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  GitHub Actions Setup for Cosens" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Configuration
$ServerHost = "1.14.163.66"
$ServerUser = "root"
$ServerPort = "22"

Write-Host "Configuration:" -ForegroundColor Yellow
Write-Host "  Server: $ServerHost" -ForegroundColor Gray
Write-Host "  User: $ServerUser" -ForegroundColor Gray
Write-Host "  Port: $ServerPort" -ForegroundColor Gray
Write-Host ""

# Step 1: Check if git is initialized
Write-Host "[1/5] Checking Git repository..." -ForegroundColor Yellow

if (-not (Test-Path ".git")) {
    Write-Host "  Initializing Git repository..." -ForegroundColor Gray
    git init
    git add .
    git commit -m "Initial commit"
    Write-Host "  ✓ Git repository initialized" -ForegroundColor Green
} else {
    Write-Host "  ✓ Git repository already initialized" -ForegroundColor Green
}

Write-Host ""

# Step 2: Check remote
Write-Host "[2/5] Checking Git remote..." -ForegroundColor Yellow

$remote = git remote get-url origin 2>$null
if (-not $remote) {
    Write-Host "  No remote configured." -ForegroundColor Yellow
    Write-Host "  Please create a GitHub repository first:" -ForegroundColor Cyan
    Write-Host "  https://github.com/new" -ForegroundColor Gray
    Write-Host ""
    $repoUrl = Read-Host "Enter your GitHub repository URL (e.g., https://github.com/username/cosens-website.git)"
    
    if ($repoUrl) {
        git remote add origin $repoUrl
        Write-Host "  ✓ Remote added" -ForegroundColor Green
    } else {
        Write-Host "  ✗ Skipping remote setup" -ForegroundColor Red
    }
} else {
    Write-Host "  ✓ Remote configured: $remote" -ForegroundColor Green
}

Write-Host ""

# Step 3: SSH Key generation instructions
Write-Host "[3/5] SSH Key Setup Instructions" -ForegroundColor Yellow
Write-Host "----------------------------------------" -ForegroundColor Gray
Write-Host ""
Write-Host "You need to set up SSH keys for GitHub Actions to access your server." -ForegroundColor Cyan
Write-Host ""
Write-Host "Step 1: Connect to your server and generate keys:" -ForegroundColor Yellow
Write-Host ""
Write-Host "  ssh root@$ServerHost" -ForegroundColor White
Write-Host "  ssh-keygen -t ed25519 -C 'github-actions@cosens.cn' -f ~/.ssh/github_actions -N ''" -ForegroundColor White
Write-Host "  cat ~/.ssh/github_actions.pub >> ~/.ssh/authorized_keys" -ForegroundColor White
Write-Host "  cat ~/.ssh/github_actions" -ForegroundColor White
Write-Host ""
Write-Host "Step 2: Copy the private key output (including BEGIN/END lines)" -ForegroundColor Yellow
Write-Host ""
Write-Host "Step 3: Add Secrets to GitHub:" -ForegroundColor Yellow
Write-Host "  1. Go to: https://github.com/YOUR_USERNAME/cosens-website/settings/secrets/actions" -ForegroundColor White
Write-Host "  2. Add these secrets:" -ForegroundColor White
Write-Host ""
Write-Host "     Name: SERVER_HOST" -ForegroundColor Cyan
Write-Host "     Value: $ServerHost" -ForegroundColor Gray
Write-Host ""
Write-Host "     Name: SERVER_USER" -ForegroundColor Cyan
Write-Host "     Value: $ServerUser" -ForegroundColor Gray
Write-Host ""
Write-Host "     Name: SERVER_PORT" -ForegroundColor Cyan
Write-Host "     Value: $ServerPort" -ForegroundColor Gray
Write-Host ""
Write-Host "     Name: SSH_PRIVATE_KEY" -ForegroundColor Cyan
Write-Host "     Value: [Paste the private key from Step 1]" -ForegroundColor Gray
Write-Host ""

# Step 4: Push to GitHub
Write-Host "[4/5] Push to GitHub" -ForegroundColor Yellow

$shouldPush = Read-Host "Do you want to push to GitHub now? (y/n)"
if ($shouldPush -eq 'y' -or $shouldPush -eq 'Y') {
    Write-Host "  Pushing to GitHub..." -ForegroundColor Gray
    
    # Ensure we're on main branch
    $currentBranch = git branch --show-current
    if ($currentBranch -ne "main" -and $currentBranch -ne "master") {
        git branch -M main
    }
    
    # Push
    git push -u origin main
    
    if ($LASTEXITCODE -eq 0) {
        Write-Host "  ✓ Code pushed to GitHub" -ForegroundColor Green
    } else {
        Write-Host "  ✗ Push failed. Check error message above." -ForegroundColor Red
    }
} else {
    Write-Host "  Skipped. Push manually with: git push -u origin main" -ForegroundColor Yellow
}

Write-Host ""

# Step 5: Next steps
Write-Host "[5/5] Next Steps" -ForegroundColor Yellow
Write-Host "----------------------------------------" -ForegroundColor Gray
Write-Host ""
Write-Host "1. Complete SSH key setup on your server" -ForegroundColor White
Write-Host "2. Add GitHub Secrets (see Step 3 above)" -ForegroundColor White
Write-Host "3. Push any change to main branch to test deployment" -ForegroundColor White
Write-Host "4. Check deployment status at: https://github.com/YOUR_USERNAME/cosens-website/actions" -ForegroundColor White
Write-Host ""

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "Setup instructions displayed!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "For detailed instructions, see: GITHUB-ACTIONS-SETUP.md" -ForegroundColor Yellow
