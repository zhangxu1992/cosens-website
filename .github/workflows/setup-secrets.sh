#!/bin/bash
# GitHub Secrets Setup Helper Script
# This script helps you generate and configure GitHub Secrets

echo "========================================"
echo "  GitHub Secrets Setup Helper"
echo "========================================"
echo ""

# Colors
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

# Server configuration
echo -e "${YELLOW}Server Configuration${NC}"
echo "----------------------------------------"
read -p "Server IP/Host [1.14.163.66]: " SERVER_HOST
SERVER_HOST=${SERVER_HOST:-1.14.163.66}

read -p "Server User [root]: " SERVER_USER
SERVER_USER=${SERVER_USER:-root}

read -p "Server SSH Port [22]: " SERVER_PORT
SERVER_PORT=${SERVER_PORT:-22}

echo ""
echo -e "${YELLOW}SSH Key Configuration${NC}"
echo "----------------------------------------"

check_ssh_key() {
    if [ -f "$HOME/.ssh/id_rsa" ]; then
        echo -e "${GREEN}✓ Found SSH key at ~/.ssh/id_rsa${NC}"
        return 0
    elif [ -f "$HOME/.ssh/id_ed25519" ]; then
        echo -e "${GREEN}✓ Found SSH key at ~/.ssh/id_ed25519${NC}"
        return 0
    else
        return 1
    fi
}

if check_ssh_key; then
    read -p "Use existing SSH key? (y/n): " USE_EXISTING
    if [[ $USE_EXISTING =~ ^[Yy]$ ]]; then
        if [ -f "$HOME/.ssh/id_rsa" ]; then
            SSH_KEY_PATH="$HOME/.ssh/id_rsa"
        else
            SSH_KEY_PATH="$HOME/.ssh/id_ed25519"
        fi
    fi
else
    echo -e "${YELLOW}No SSH key found. Let's create one.${NC}"
fi

if [ -z "$SSH_KEY_PATH" ]; then
    echo ""
    echo "Creating new SSH key pair..."
    ssh-keygen -t ed25519 -C "github-actions@cosens.cn" -f "$HOME/.ssh/cosens_deploy" -N ""
    SSH_KEY_PATH="$HOME/.ssh/cosens_deploy"
    
    echo ""
    echo -e "${YELLOW}Add this public key to your server's ~/.ssh/authorized_keys:${NC}"
    echo "----------------------------------------"
    cat "${SSH_KEY_PATH}.pub"
    echo "----------------------------------------"
    echo ""
    read -p "Press Enter after you've added the key to your server..."
fi

echo ""
echo -e "${GREEN}Configuration Summary:${NC}"
echo "----------------------------------------"
echo "SERVER_HOST: $SERVER_HOST"
echo "SERVER_USER: $SERVER_USER"
echo "SERVER_PORT: $SERVER_PORT"
echo "SSH_KEY: $SSH_KEY_PATH"
echo ""

# Generate GitHub Secrets commands
echo -e "${YELLOW}GitHub Secrets Commands${NC}"
echo "----------------------------------------"
echo "Run these commands to set up GitHub Secrets:"
echo ""

echo "# 1. Set Server Host"
echo "gh secret set SERVER_HOST --body=\"$SERVER_HOST\""
echo ""

echo "# 2. Set Server User"
echo "gh secret set SERVER_USER --body=\"$SERVER_USER\""
echo ""

echo "# 3. Set Server Port"
echo "gh secret set SERVER_PORT --body=\"$SERVER_PORT\""
echo ""

echo "# 4. Set SSH Private Key (IMPORTANT!)"
echo "gh secret set SSH_PRIVATE_KEY < $SSH_KEY_PATH"
echo ""

echo "# 5. Optional: Set Slack Webhook for notifications"
echo "gh secret set SLACK_WEBHOOK --body=\"your-slack-webhook-url\""
echo ""

echo "----------------------------------------"
echo ""

# Alternative: Create secrets file for manual entry
echo -e "${YELLOW}Alternative: Manual GitHub Secrets Setup${NC}"
echo "----------------------------------------"
echo "Go to: https://github.com/YOUR_USERNAME/cosens-website/settings/secrets/actions"
echo ""
echo "Add these secrets:"
echo ""
echo "Name: SERVER_HOST"
echo "Value: $SERVER_HOST"
echo ""
echo "Name: SERVER_USER"
echo "Value: $SERVER_USER"
echo ""
echo "Name: SERVER_PORT"
echo "Value: $SERVER_PORT"
echo ""
echo "Name: SSH_PRIVATE_KEY"
echo "Value: [Copy the content below]"
echo "----------------------------------------"
cat "$SSH_KEY_PATH"
echo "----------------------------------------"
echo ""

echo -e "${GREEN}Setup complete!${NC}"
echo ""
echo "Next steps:"
echo "1. Add the secrets to your GitHub repository"
echo "2. Push code to main branch to trigger deployment"
echo "3. Check Actions tab for deployment status"
