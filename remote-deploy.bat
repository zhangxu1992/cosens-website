@echo off
chcp 65001
cls
echo ========================================
echo  Cosens 网站远程部署脚本
echo  服务器: 1.14.163.66
echo ========================================
echo.

set SERVER_IP=1.14.163.66
set SERVER_USER=root
set LOCAL_PATH=C:\Users\Administrator\WorkBuddy\2026-05-09-task-1\cosens-website
set REMOTE_PATH=/var/www/cosens

echo [1/4] 正在上传项目文件...
echo.

REM 使用 scp 上传文件
echo 正在连接服务器并上传文件...
scp -r -o StrictHostKeyChecking=no -o ConnectTimeout=30 "%LOCAL_PATH%\*" %SERVER_USER%@%SERVER_IP%:%REMOTE_PATH%/

if %ERRORLEVEL% NEQ 0 (
    echo.
    echo [错误] 文件上传失败！
    echo 请检查:
    echo 1. 网络连接是否正常
    echo 2. 服务器IP是否正确
    echo 3. 密码是否正确
    pause
    exit /b 1
)

echo.
echo [2/4] 正在连接服务器执行安装...
echo.

REM 执行远程安装命令
ssh -o StrictHostKeyChecking=no %SERVER_USER%@%SERVER_IP% "cd /var/www/cosens && chmod +x install.sh && bash install.sh"

echo.
echo [3/4] 正在执行部署脚本...
echo.

ssh -o StrictHostKeyChecking=no %SERVER_USER%@%SERVER_IP% "cd /var/www/cosens && chmod +x deploy.sh && bash deploy.sh"

echo.
echo [4/4] 部署完成!
echo.
echo ========================================
echo  部署状态检查
echo ========================================
echo.

ssh -o StrictHostKeyChecking=no %SERVER_USER%@%SERVER_IP% "systemctl is-active nginx && systemctl is-active php8.3-fpm && systemctl is-active mysql"

echo.
echo 网站地址:
echo   - http://cosens.cn
echo   - https://cosens.cn
echo   - https://www.cosens.cn
echo.
echo 后台地址:
echo   - https://cosens.cn/admin
echo.

pause
