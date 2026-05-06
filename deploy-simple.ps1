# MPWA Deployment Script - Simple Version
Write-Host "`n========================================" -ForegroundColor Cyan
Write-Host "  MPWA Deployment Package Creator" -ForegroundColor Green
Write-Host "========================================`n" -ForegroundColor Cyan

$LOCAL_PATH = "C:\laragon\www\whatsapp"
$TEMP_DIR = "$env:TEMP\mpwa-deploy"
$ZIP_FILE = "$env:TEMP\mpwa-deployment.zip"

Write-Host "Creating deployment package..." -ForegroundColor Yellow

# Remove old files
if (Test-Path $TEMP_DIR) {
    Remove-Item -Path $TEMP_DIR -Recurse -Force
}
if (Test-Path $ZIP_FILE) {
    Remove-Item -Path $ZIP_FILE -Force
}

# Create temp directory
New-Item -ItemType Directory -Path $TEMP_DIR -Force | Out-Null

Write-Host "Copying files (excluding node_modules, vendor)..." -ForegroundColor Yellow

# Copy files excluding large directories
$excludeDirs = @('node_modules', 'vendor', '.git', 'storage\logs')
Get-ChildItem -Path $LOCAL_PATH | Where-Object {
    $_.Name -notin $excludeDirs
} | Copy-Item -Destination $TEMP_DIR -Recurse -Force

Write-Host "Creating ZIP file..." -ForegroundColor Yellow
Compress-Archive -Path "$TEMP_DIR\*" -DestinationPath $ZIP_FILE -Force

Write-Host "`nSUCCESS! Deployment package created:" -ForegroundColor Green
Write-Host "Location: $ZIP_FILE`n" -ForegroundColor Cyan

# Create SSH connection batch file
$sshBatch = @"
@echo off
echo Connecting to Hostinger...
ssh -p 65002 u757590993@145.79.209.199
pause
"@

$sshFile = "$env:TEMP\connect-hostinger.bat"
$sshBatch | Out-File -FilePath $sshFile -Encoding ASCII -Force

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  NEXT STEPS" -ForegroundColor Yellow
Write-Host "========================================`n" -ForegroundColor Cyan

Write-Host "1. Upload ZIP file to Hostinger:" -ForegroundColor Yellow
Write-Host "   File: $ZIP_FILE" -ForegroundColor White
Write-Host "   Method: cPanel File Manager or FTP`n" -ForegroundColor White

Write-Host "2. Connect to server:" -ForegroundColor Yellow
Write-Host "   Run: $sshFile" -ForegroundColor Cyan
Write-Host "   Or: ssh -p 65002 u757590993@145.79.209.199" -ForegroundColor Cyan
Write-Host "   Password: Diplo@6589#`n" -ForegroundColor Gray

Write-Host "3. On server, run:" -ForegroundColor Yellow
Write-Host "   cd /home/u757590993/domains/enginerds.in/public_html/inv" -ForegroundColor Cyan
Write-Host "   unzip mpwa-deployment.zip" -ForegroundColor Cyan
Write-Host "   chmod +x deploy.sh" -ForegroundColor Cyan
Write-Host "   ./deploy.sh`n" -ForegroundColor Cyan

Write-Host "========================================`n" -ForegroundColor Cyan

# Open file location
Start-Process "explorer.exe" -ArgumentList "/select,$ZIP_FILE"

# Ask if user wants to connect now
$connect = Read-Host "Open SSH connection now? (y/n)"
if ($connect -eq 'y') {
    Start-Process $sshFile
}
