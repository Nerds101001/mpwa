# 🚀 Quick Hostinger Deployment Guide

## 📋 Your Server Details

**Domain:** inv.enginerds.in
**SSH:** `ssh -p 65002 u757590993@145.79.209.199`
**Password:** `Diplo@6589#`
**Path:** `/home/u757590993/domains/enginerds.in/public_html/inv/public`
**User:** u757590993

---

## ⚠️ CRITICAL: Check Hostinger Plan First!

### Does Your Plan Support Node.js?

**To check:**
1. Login to Hostinger cPanel
2. Look for "Node.js" or "Node.js Selector" in cPanel
3. Or connect via SSH and run: `node -v`

**If Node.js is NOT available:**
- ❌ This app will NOT work on shared hosting
- ✅ You need VPS or Business hosting
- ✅ Or use alternative deployment (see below)

---

## 🎯 Deployment Method 1: Full Deployment (VPS/Business)

### Step 1: Prepare Files on Windows

Run the deployment script:
```powershell
cd C:\laragon\www\whatsapp
.\deploy-windows.ps1
```

This will create:
- `mpwa-deployment.zip` - Upload package
- `connect-hostinger.bat` - SSH connection script

### Step 2: Upload Files

**Option A: cPanel File Manager**
1. Login to Hostinger cPanel
2. Go to File Manager
3. Navigate to: `/home/u757590993/domains/enginerds.in/public_html/inv/`
4. Upload `mpwa-deployment.zip`
5. Extract the ZIP file

**Option B: FileZilla (SFTP)**
1. Download FileZilla: https://filezilla-project.org/
2. Connect with:
   - Host: `sftp://145.79.209.199`
   - Port: `65002`
   - Username: `u757590993`
   - Password: `Diplo@6589#`
3. Upload all files to: `/home/u757590993/domains/enginerds.in/public_html/inv/`

### Step 3: Connect via SSH

Double-click `connect-hostinger.bat` or run:
```bash
ssh -p 65002 u757590993@145.79.209.199
```
Password: `Diplo@6589#`

### Step 4: Run Deployment Script

```bash
cd /home/u757590993/domains/enginerds.in/public_html/inv
chmod +x deploy.sh
./deploy.sh
```

The script will:
- ✅ Check PHP/Node.js versions
- ✅ Install dependencies
- ✅ Configure environment
- ✅ Run migrations
- ✅ Create admin user
- ✅ Start Node.js server

### Step 5: Configure Database

Before running migrations, create database in cPanel:
1. Go to cPanel → MySQL Databases
2. Create database: `u757590993_whatsapp`
3. Create user: `u757590993_whatsapp`
4. Add user to database with ALL PRIVILEGES
5. Update `.env` file with credentials

### Step 6: Configure Domain

Edit `.htaccess` in `/home/u757590993/domains/enginerds.in/public_html/inv/`:
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### Step 7: Enable SSL

1. Go to cPanel → SSL/TLS
2. Enable SSL for `inv.enginerds.in`
3. Force HTTPS redirect

### Step 8: Access Application

Visit: https://inv.enginerds.in/login

---

## 🎯 Deployment Method 2: Hybrid (If No Node.js)

If Hostinger doesn't support Node.js, use this hybrid approach:

### Deploy Laravel on Hostinger
1. Upload only Laravel files (no Node.js server)
2. Follow steps 1-6 above

### Deploy Node.js on Free Platform

**Option A: Railway.app (Recommended)**
1. Go to https://railway.app
2. Sign up with GitHub
3. Create new project → Deploy from GitHub
4. Add environment variables from `.env`
5. Get deployment URL (e.g., `https://your-app.railway.app`)
6. Update Hostinger `.env`: `WA_URL_SERVER=https://your-app.railway.app`

**Option B: Render.com**
1. Go to https://render.com
2. Create new Web Service
3. Connect GitHub repository
4. Set build command: `npm install`
5. Set start command: `node server.js`
6. Add environment variables
7. Get deployment URL
8. Update Hostinger `.env`

**Option C: Fly.io**
1. Install flyctl: https://fly.io/docs/hands-on/install-flyctl/
2. Run: `fly launch`
3. Deploy: `fly deploy`
4. Get URL and update Hostinger `.env`

---

## 📝 Manual Deployment Steps

If automated script doesn't work:

### 1. Upload Files
```bash
# Via SCP from Windows
scp -P 65002 -r C:\laragon\www\whatsapp/* u757590993@145.79.209.199:/home/u757590993/domains/enginerds.in/public_html/inv/
```

### 2. Install Dependencies
```bash
cd /home/u757590993/domains/enginerds.in/public_html/inv
composer install --no-dev --optimize-autoloader
npm install --production
```

### 3. Configure Environment
```bash
cp .env.production .env
nano .env
# Update database credentials
```

### 4. Setup Application
```bash
php artisan key:generate
chmod -R 777 storage credentials
php artisan migrate --force
php artisan db:seed --class=PlansSeeder --force
```

### 5. Create Admin
```bash
php artisan tinker
```
```php
use App\Models\User;
use Illuminate\Support\Str;
User::create([
    'username' => 'admin',
    'email' => 'admin@admin.com',
    'password' => bcrypt('YourSecurePassword123'),
    'level' => 'admin',
    'api_key' => Str::random(32),
    'chunk_blast' => 100,
    'delete_history' => 0,
]);
exit
```

### 6. Optimize
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 7. Start Node.js
```bash
# With PM2 (if available)
pm2 start server.js --name whatsapp-gateway
pm2 save
pm2 startup

# Without PM2
nohup node server.js > node.log 2>&1 &
```

---

## 🔧 Configuration Files

### .env (Production)
```env
APP_NAME=MPWA
APP_ENV=production
APP_DEBUG=false
APP_URL=https://inv.enginerds.in

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u757590993_whatsapp
DB_USERNAME=u757590993_whatsapp
DB_PASSWORD=YOUR_DB_PASSWORD

WA_URL_SERVER=https://inv.enginerds.in:3100
PORT_NODE=3100

APP_INSTALLED=true
LICENSE_KEY=MagdAlmuntaser
BUYER_EMAIL=your@email.com
```

### .htaccess (Root)
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### public/.htaccess
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

---

## 🐛 Troubleshooting

### Node.js Not Available
```bash
# Check if Node.js exists
which node
node -v

# If not found, contact Hostinger support
# Or use hybrid deployment method
```

### Permission Denied
```bash
chmod -R 755 .
chmod -R 777 storage
chmod -R 777 credentials
chmod -R 777 bootstrap/cache
```

### Database Connection Failed
```bash
# Test connection
php artisan tinker
>>> DB::connection()->getPdo();

# Check credentials in .env
# Verify database exists in cPanel
```

### 500 Internal Server Error
```bash
# Check logs
tail -f storage/logs/laravel.log

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Node.js Server Not Starting
```bash
# Check if port is available
netstat -tulpn | grep 3100

# Check logs
tail -f node.log

# Try different port
# Edit .env: PORT_NODE=8080
```

### WhatsApp Not Connecting
```bash
# Check Node.js server is running
ps aux | grep node

# Check logs
tail -f node.log

# Restart server
pm2 restart whatsapp-gateway
# or
pkill -f "node server.js"
nohup node server.js > node.log 2>&1 &
```

---

## 📊 Post-Deployment Checklist

- [ ] Application accessible at https://inv.enginerds.in
- [ ] Login page works
- [ ] Admin user created
- [ ] Database connected
- [ ] Node.js server running
- [ ] SSL certificate enabled
- [ ] WhatsApp connection tested
- [ ] Send test message
- [ ] API endpoint tested
- [ ] File uploads working
- [ ] Cron jobs configured

---

## 🔐 Security Checklist

- [ ] Change default admin password
- [ ] Set APP_DEBUG=false
- [ ] Enable SSL (HTTPS)
- [ ] Secure .env file (chmod 600 .env)
- [ ] Disable directory listing
- [ ] Configure firewall
- [ ] Regular backups
- [ ] Update dependencies regularly

---

## 📞 Support

**Hostinger Support:**
- Live Chat: Available in cPanel
- Email: support@hostinger.com
- Phone: Check your account

**Check Node.js Availability:**
Contact Hostinger support and ask:
"Does my hosting plan support Node.js applications?"

---

## 🎯 Quick Commands Reference

```bash
# Connect to server
ssh -p 65002 u757590993@145.79.209.199

# Navigate to project
cd /home/u757590993/domains/enginerds.in/public_html/inv

# Check status
pm2 status
ps aux | grep node

# View logs
tail -f storage/logs/laravel.log
tail -f node.log

# Restart services
pm2 restart whatsapp-gateway
php artisan optimize:clear

# Update application
git pull origin main
composer install --no-dev
npm install --production
php artisan migrate --force
php artisan optimize
pm2 restart whatsapp-gateway
```

---

**Ready to deploy? Run `deploy-windows.ps1` to get started!**
