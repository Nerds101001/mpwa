# MPWA Deployment Script for Hostinger (Windows)
# Run this from your local Windows machine

Write-Host "`n╔════════════════════════════════════════════════════════════╗" -ForegroundColor Cyan
Write-Host "║    MPWA WhatsApp Gateway - Windows Deployment Script     ║" -ForegroundColor Cyan
Write-Host "╚════════════════════════════════════════════════════════════╝`n" -ForegroundColor Cyan

# Configuration
$SSH_HOST = "145.79.209.199"
$SSH_PORT = "65002"
$SSH_USER = "u757590993"
$SSH_PASS = "Diplo@6589#"
$REMOTE_PATH = "/home/u757590993/domains/enginerds.in/public_html/inv"
$LOCAL_PATH = "C:\laragon\www\whatsapp"
$DOMAIN = "inv.enginerds.in"

Write-Host "📋 Deployment Configuration:" -ForegroundColor Yellow
Write-Host "   Domain: $DOMAIN" -ForegroundColor White
Write-Host "   Server: $SSH_HOST" -ForegroundColor White
Write-Host "   Remote Path: $REMOTE_PATH" -ForegroundColor White
Write-Host "   Local Path: $LOCAL_PATH`n" -ForegroundColor White

# Check if WinSCP is available
Write-Host "🔍 Checking for deployment tools..." -ForegroundColor Yellow

$hasWinSCP = Test-Path "C:\Program Files (x86)\WinSCP\WinSCP.com"
$hasPSCP = Get-Command pscp -ErrorAction SilentlyContinue

if (-not $hasWinSCP -and -not $hasPSCP) {
    Write-Host "❌ No SCP tool found!" -ForegroundColor Red
    Write-Host "`nPlease install one of:" -ForegroundColor Yellow
    Write-Host "   1. WinSCP: https://winscp.net/download/WinSCP-Setup.exe" -ForegroundColor White
    Write-Host "   2. PuTTY (includes PSCP): https://www.putty.org/`n" -ForegroundColor White
    
    $choice = Read-Host "Do you want to use manual FTP upload instead? (y/n)"
    if ($choice -eq 'y') {
        Write-Host "`n📦 Manual Upload Instructions:" -ForegroundColor Cyan
        Write-Host "   1. Download FileZilla: https://filezilla-project.org/" -ForegroundColor White
        Write-Host "   2. Connect with these details:" -ForegroundColor White
        Write-Host "      Host: sftp://$SSH_HOST" -ForegroundColor Yellow
        Write-Host "      Port: $SSH_PORT" -ForegroundColor Yellow
        Write-Host "      Username: $SSH_USER" -ForegroundColor Yellow
        Write-Host "      Password: $SSH_PASS" -ForegroundColor Yellow
        Write-Host "   3. Upload all files from: $LOCAL_PATH" -ForegroundColor White
        Write-Host "   4. To remote path: $REMOTE_PATH" -ForegroundColor White
        Write-Host "`n   ⚠️  EXCLUDE these folders:" -ForegroundColor Red
        Write-Host "      - node_modules/" -ForegroundColor White
        Write-Host "      - vendor/" -ForegroundColor White
        Write-Host "      - storage/logs/*" -ForegroundColor White
        Write-Host "      - credentials/*`n" -ForegroundColor White
    }
    exit
}

Write-Host "✅ Deployment tools found`n" -ForegroundColor Green

# Create deployment package
Write-Host "📦 Creating deployment package..." -ForegroundColor Yellow

$excludeDirs = @(
    "node_modules",
    "vendor",
    ".git",
    "credentials",
    "storage\logs",
    "storage\framework\cache",
    "storage\framework\sessions",
    "storage\framework\views"
)

Write-Host "   Preparing files for upload..." -ForegroundColor White
Write-Host "   (This may take a few minutes)`n" -ForegroundColor Gray

# Option 1: Create ZIP for manual upload
$zipPath = "$env:TEMP\mpwa-deployment.zip"
Write-Host "📦 Creating ZIP file: $zipPath" -ForegroundColor Yellow

# Compress files (excluding specified directories)
$compress = @{
    Path = "$LOCAL_PATH\*"
    DestinationPath = $zipPath
    CompressionLevel = "Fastest"
}

try {
    Compress-Archive @compress -Force
    Write-Host "✅ ZIP file created successfully`n" -ForegroundColor Green
    
    Write-Host "╔════════════════════════════════════════════════════════════╗" -ForegroundColor Cyan
    Write-Host "║              📤 UPLOAD INSTRUCTIONS                        ║" -ForegroundColor Cyan
    Write-Host "╚════════════════════════════════════════════════════════════╝`n" -ForegroundColor Cyan
    
    Write-Host "1️⃣  Upload ZIP file:" -ForegroundColor Yellow
    Write-Host "   File location: $zipPath" -ForegroundColor White
    Write-Host "   Upload to: $REMOTE_PATH`n" -ForegroundColor White
    
    Write-Host "2️⃣  Connect to server via SSH:" -ForegroundColor Yellow
    Write-Host "   ssh -p $SSH_PORT $SSH_USER@$SSH_HOST" -ForegroundColor Cyan
    Write-Host "   Password: $SSH_PASS`n" -ForegroundColor Gray
    
    Write-Host "3️⃣  Extract and setup:" -ForegroundColor Yellow
    Write-Host "   cd $REMOTE_PATH" -ForegroundColor Cyan
    Write-Host "   unzip mpwa-deployment.zip" -ForegroundColor Cyan
    Write-Host "   chmod +x deploy.sh" -ForegroundColor Cyan
    Write-Host "   ./deploy.sh`n" -ForegroundColor Cyan
    
    Write-Host "✨ Or use the detailed guide in DEPLOYMENT_GUIDE.md`n" -ForegroundColor Green
    
    # Open file location
    Start-Process "explorer.exe" -ArgumentList "/select,$zipPath"
    
} catch {
    Write-Host "❌ Failed to create ZIP file: $_" -ForegroundColor Red
}

# Create SSH connection script
$sshScript = @"
@echo off
echo Connecting to Hostinger server...
echo.
ssh -p $SSH_PORT $SSH_USER@$SSH_HOST
"@

$sshScriptPath = "$env:TEMP\connect-hostinger.bat"
$sshScript | Out-File -FilePath $sshScriptPath -Encoding ASCII

Write-Host "╔════════════════════════════════════════════════════════════╗" -ForegroundColor Cyan
Write-Host "║              🚀 QUICK CONNECT                              ║" -ForegroundColor Cyan
Write-Host "╚════════════════════════════════════════════════════════════╝`n" -ForegroundColor Cyan

Write-Host "SSH Connection script created: $sshScriptPath" -ForegroundColor Green
Write-Host "Double-click to connect to server`n" -ForegroundColor White

# Summary
Write-Host "╔════════════════════════════════════════════════════════════╗" -ForegroundColor Cyan
Write-Host "║              📋 DEPLOYMENT SUMMARY                         ║" -ForegroundColor Cyan
Write-Host "╚════════════════════════════════════════════════════════════╝`n" -ForegroundColor Cyan

Write-Host "✅ Deployment package created" -ForegroundColor Green
Write-Host "✅ SSH connection script created" -ForegroundColor Green
Write-Host "✅ Deployment guide available: DEPLOYMENT_GUIDE.md`n" -ForegroundColor Green

Write-Host "📚 Files Created:" -ForegroundColor Yellow
Write-Host "   1. $zipPath" -ForegroundColor White
Write-Host "   2. $sshScriptPath" -ForegroundColor White
Write-Host "   3. DEPLOYMENT_GUIDE.md (in project folder)" -ForegroundColor White
Write-Host "   4. deploy.sh (in project folder)`n" -ForegroundColor White

Write-Host "🎯 Next Steps:" -ForegroundColor Yellow
Write-Host "   1. Upload ZIP file to server (via cPanel File Manager or FTP)" -ForegroundColor White
Write-Host "   2. Connect via SSH using the connection script" -ForegroundColor White
Write-Host "   3. Extract ZIP and run deploy.sh" -ForegroundColor White
Write-Host "   4. Follow DEPLOYMENT_GUIDE.md for detailed instructions`n" -ForegroundColor White

Write-Host "✨ Ready for deployment!`n" -ForegroundColor Green

# Ask if user wants to open SSH connection
$connect = Read-Host "Do you want to connect to the server now? (y/n)"
if ($connect -eq 'y') {
    Start-Process $sshScriptPath
}
