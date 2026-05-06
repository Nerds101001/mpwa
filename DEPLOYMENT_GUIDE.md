# 🚀 MPWA Deployment Guide - Hostinger

## 📋 Deployment Information

**Domain:** inv.enginerds.in
**Server Path:** /home/u757590993/domains/enginerds.in/public_html/inv/public
**SSH:** ssh -p 65002 u757590993@145.79.209.199
**User:** u757590993

---

## ⚠️ IMPORTANT: Hostinger Limitations

### What You Need to Check:
1. **Node.js Support** - Hostinger shared hosting may NOT support Node.js
2. **Port Access** - Port 3100 may be blocked
3. **Long-running Processes** - Node.js server needs to run 24/7
4. **PHP Version** - Must be PHP 8.2 or higher

### Recommended Hostinger Plan:
- **VPS Hosting** (Required for Node.js)
- **Business Hosting** (May work with limitations)
- ❌ **Shared Hosting** (Will NOT work - no Node.js support)

---

## 🔍 Pre-Deployment Checklist

Before deploying, verify your Hostinger plan supports:
- [ ] Node.js installation
- [ ] Custom port access (3100)
- [ ] SSH access (✅ You have this)
- [ ] MySQL database
- [ ] PHP 8.2+
- [ ] Composer
- [ ] PM2 or similar process manager

---

## 📦 Deployment Steps

### Step 1: Prepare Files for Upload

Create a deployment package excluding unnecessary files:
```bash
# Files to EXCLUDE from upload:
- node_modules/
- vendor/
- storage/logs/*
- storage/framework/cache/*
- storage/framework/sessions/*
- storage/framework/views/*
- .env (will create new on server)
- credentials/* (WhatsApp sessions)
```

### Step 2: Connect to Server

```bash
ssh -p 65002 u757590993@145.79.209.199
# Password: Diplo@6589#
```

### Step 3: Check Server Capabilities

```bash
# Check PHP version
php -v

# Check if Node.js is available
node -v
npm -v

# Check if Composer is available
composer -v

# Check MySQL
mysql --version
```

### Step 4: Create Database

```bash
# Login to cPanel or use MySQL command line
# Create database: u757590993_whatsapp
# Create user with full privileges
```

### Step 5: Upload Files

**Option A: Using Git (Recommended)**
```bash
cd /home/u757590993/domains/enginerds.in/public_html/inv
git clone YOUR_REPOSITORY_URL .
```

**Option B: Using FTP/SFTP**
- Use FileZilla or similar
- Upload all files to: /home/u757590993/domains/enginerds.in/public_html/inv/

**Option C: Using SCP**
```bash
# From your local machine
scp -P 65002 -r C:\laragon\www\whatsapp/* u757590993@145.79.209.199:/home/u757590993/domains/enginerds.in/public_html/inv/
```

### Step 6: Configure Environment

```bash
cd /home/u757590993/domains/enginerds.in/public_html/inv

# Copy environment file
cp .env.example .env

# Edit .env file
nano .env
```

**Update these values in .env:**
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

# Important: Set these
APP_INSTALLED=false
LICENSE_KEY=MagdAlmuntaser
BUYER_EMAIL=your@email.com
```

### Step 7: Install Dependencies

```bash
# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install Node.js dependencies
npm install --production

# Generate app key
php artisan key:generate

# Set permissions
chmod -R 755 storage bootstrap/cache
chmod -R 777 storage
chmod -R 777 credentials
```

### Step 8: Run Migrations

```bash
php artisan migrate --force
php artisan db:seed --class=PlansSeeder --force
```

### Step 9: Create Admin User

```bash
php artisan tinker
```
Then run:
```php
use App\Models\User;
use Illuminate\Support\Str;

User::create([
    'username' => 'admin',
    'email' => 'admin@admin.com',
    'password' => bcrypt('YOUR_SECURE_PASSWORD'),
    'level' => 'admin',
    'api_key' => Str::random(32),
    'chunk_blast' => 100,
    'delete_history' => 0,
]);
exit
```

### Step 10: Optimize Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### Step 11: Configure .htaccess

Create/edit `.htaccess` in root directory:
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### Step 12: Start Node.js Server

**If PM2 is available:**
```bash
pm2 start server.js --name whatsapp-gateway
pm2 save
pm2 startup
```

**If PM2 is NOT available:**
```bash
# Run in background
nohup node server.js > node.log 2>&1 &
```

**Check if running:**
```bash
ps aux | grep node
netstat -tulpn | grep 3100
```

---

## 🔧 Domain Configuration

### Update DNS (if needed)
Point `inv.enginerds.in` to your Hostinger server IP: `145.79.209.199`

### SSL Certificate
```bash
# Hostinger usually provides free SSL
# Enable it in cPanel → SSL/TLS
```

---

## 🌐 Access Your Application

**URL:** https://inv.enginerds.in
**Login:** https://inv.enginerds.in/login

---

## ⚠️ CRITICAL: Hostinger Shared Hosting Issues

### If Node.js is NOT Available:

**Option 1: Upgrade to VPS**
- Hostinger VPS plans support Node.js
- Full control over server
- Can run Node.js 24/7

**Option 2: Use External Node.js Service**
- Deploy Node.js part to Railway.app (Free tier)
- Deploy Node.js part to Render.com (Free tier)
- Keep Laravel on Hostinger
- Update WA_URL_SERVER to point to external service

**Option 3: Use Different Hosting**
- DigitalOcean ($4/month)
- Vultr ($2.50/month)
- Contabo ($4/month)
- Railway.app (Free tier with limitations)

---

## 🐛 Troubleshooting

### Laravel Not Loading
```bash
# Check permissions
ls -la storage
ls -la bootstrap/cache

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Node.js Server Not Starting
```bash
# Check logs
tail -f node.log

# Check if port is available
netstat -tulpn | grep 3100

# Try different port
# Edit .env: PORT_NODE=8080
```

### Database Connection Error
```bash
# Test connection
php artisan tinker
>>> DB::connection()->getPdo();
```

### 500 Internal Server Error
```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Check Apache logs
tail -f /var/log/apache2/error.log
```

---

## 📞 Next Steps After Deployment

1. ✅ Test login page
2. ✅ Change admin password
3. ✅ Test WhatsApp connection
4. ✅ Test sending messages
5. ✅ Configure SSL certificate
6. ✅ Set up backups
7. ✅ Configure cron jobs

---

## 🔐 Security Checklist

- [ ] Change default admin password
- [ ] Enable SSL (HTTPS)
- [ ] Set APP_DEBUG=false
- [ ] Secure .env file (chmod 600)
- [ ] Enable firewall
- [ ] Regular backups
- [ ] Update regularly

---

## 📊 Monitoring

```bash
# Check Node.js process
pm2 status

# Check logs
pm2 logs whatsapp-gateway

# Monitor resources
htop
```

---

## 🔄 Updates

```bash
# Pull latest code
git pull origin main

# Update dependencies
composer install --no-dev
npm install --production

# Run migrations
php artisan migrate --force

# Clear cache
php artisan optimize:clear
php artisan optimize
```

---

**Need Help?** Check the troubleshooting section or contact Hostinger support to verify Node.js availability.
