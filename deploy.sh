#!/bin/bash

# MPWA Deployment Script for Hostinger
# Domain: inv.enginerds.in
# Path: /home/u757590993/domains/enginerds.in/public_html/inv

echo "╔════════════════════════════════════════════════════════════╗"
echo "║         MPWA WhatsApp Gateway - Deployment Script         ║"
echo "╚════════════════════════════════════════════════════════════╝"
echo ""

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Configuration
DEPLOY_PATH="/home/u757590993/domains/enginerds.in/public_html/inv"
DOMAIN="inv.enginerds.in"

echo -e "${YELLOW}📋 Deployment Configuration:${NC}"
echo "   Domain: $DOMAIN"
echo "   Path: $DEPLOY_PATH"
echo ""

# Step 1: Check PHP Version
echo -e "${YELLOW}🔍 Step 1: Checking PHP version...${NC}"
PHP_VERSION=$(php -v | head -n 1 | cut -d " " -f 2 | cut -d "." -f 1,2)
echo "   PHP Version: $PHP_VERSION"
if (( $(echo "$PHP_VERSION < 8.2" | bc -l) )); then
    echo -e "${RED}   ❌ PHP 8.2+ required! Current: $PHP_VERSION${NC}"
    exit 1
fi
echo -e "${GREEN}   ✅ PHP version OK${NC}"
echo ""

# Step 2: Check Node.js
echo -e "${YELLOW}🔍 Step 2: Checking Node.js...${NC}"
if command -v node &> /dev/null; then
    NODE_VERSION=$(node -v)
    echo -e "${GREEN}   ✅ Node.js installed: $NODE_VERSION${NC}"
else
    echo -e "${RED}   ❌ Node.js not found!${NC}"
    echo "   Please install Node.js or upgrade to VPS hosting"
    exit 1
fi
echo ""

# Step 3: Check Composer
echo -e "${YELLOW}🔍 Step 3: Checking Composer...${NC}"
if command -v composer &> /dev/null; then
    echo -e "${GREEN}   ✅ Composer installed${NC}"
else
    echo -e "${RED}   ❌ Composer not found!${NC}"
    exit 1
fi
echo ""

# Step 4: Install PHP Dependencies
echo -e "${YELLOW}📦 Step 4: Installing PHP dependencies...${NC}"
composer install --no-dev --optimize-autoloader --no-interaction
if [ $? -eq 0 ]; then
    echo -e "${GREEN}   ✅ PHP dependencies installed${NC}"
else
    echo -e "${RED}   ❌ Failed to install PHP dependencies${NC}"
    exit 1
fi
echo ""

# Step 5: Install Node.js Dependencies
echo -e "${YELLOW}📦 Step 5: Installing Node.js dependencies...${NC}"
npm install --production
if [ $? -eq 0 ]; then
    echo -e "${GREEN}   ✅ Node.js dependencies installed${NC}"
else
    echo -e "${RED}   ❌ Failed to install Node.js dependencies${NC}"
    exit 1
fi
echo ""

# Step 6: Environment Configuration
echo -e "${YELLOW}⚙️  Step 6: Configuring environment...${NC}"
if [ ! -f .env ]; then
    if [ -f .env.production ]; then
        cp .env.production .env
        echo -e "${GREEN}   ✅ .env file created from .env.production${NC}"
        echo -e "${YELLOW}   ⚠️  Please edit .env and update database credentials!${NC}"
    else
        cp .env.example .env
        echo -e "${GREEN}   ✅ .env file created from .env.example${NC}"
        echo -e "${YELLOW}   ⚠️  Please edit .env and configure all settings!${NC}"
    fi
else
    echo -e "${GREEN}   ✅ .env file already exists${NC}"
fi
echo ""

# Step 7: Generate Application Key
echo -e "${YELLOW}🔑 Step 7: Generating application key...${NC}"
php artisan key:generate --force
echo -e "${GREEN}   ✅ Application key generated${NC}"
echo ""

# Step 8: Set Permissions
echo -e "${YELLOW}🔒 Step 8: Setting permissions...${NC}"
chmod -R 755 storage bootstrap/cache
chmod -R 777 storage
mkdir -p credentials
chmod -R 777 credentials
echo -e "${GREEN}   ✅ Permissions set${NC}"
echo ""

# Step 9: Database Migration
echo -e "${YELLOW}💾 Step 9: Running database migrations...${NC}"
read -p "   Have you configured database in .env? (y/n): " -n 1 -r
echo ""
if [[ $REPLY =~ ^[Yy]$ ]]; then
    php artisan migrate --force
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}   ✅ Migrations completed${NC}"
        
        # Seed plans
        php artisan db:seed --class=PlansSeeder --force
        echo -e "${GREEN}   ✅ Plans seeded${NC}"
    else
        echo -e "${RED}   ❌ Migration failed! Check database credentials${NC}"
    fi
else
    echo -e "${YELLOW}   ⚠️  Skipping migrations. Run manually: php artisan migrate --force${NC}"
fi
echo ""

# Step 10: Optimize Laravel
echo -e "${YELLOW}⚡ Step 10: Optimizing Laravel...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
echo -e "${GREEN}   ✅ Laravel optimized${NC}"
echo ""

# Step 11: Create Admin User
echo -e "${YELLOW}👤 Step 11: Create admin user...${NC}"
read -p "   Create admin user now? (y/n): " -n 1 -r
echo ""
if [[ $REPLY =~ ^[Yy]$ ]]; then
    read -p "   Enter admin username [admin]: " ADMIN_USER
    ADMIN_USER=${ADMIN_USER:-admin}
    
    read -p "   Enter admin email [admin@admin.com]: " ADMIN_EMAIL
    ADMIN_EMAIL=${ADMIN_EMAIL:-admin@admin.com}
    
    read -sp "   Enter admin password: " ADMIN_PASS
    echo ""
    
    php artisan tinker --execute="
    use App\Models\User;
    use Illuminate\Support\Str;
    User::create([
        'username' => '$ADMIN_USER',
        'email' => '$ADMIN_EMAIL',
        'password' => bcrypt('$ADMIN_PASS'),
        'level' => 'admin',
        'api_key' => Str::random(32),
        'chunk_blast' => 100,
        'delete_history' => 0,
    ]);
    echo 'Admin user created!';
    "
    echo -e "${GREEN}   ✅ Admin user created${NC}"
else
    echo -e "${YELLOW}   ⚠️  Skipping admin creation${NC}"
fi
echo ""

# Step 12: Start Node.js Server
echo -e "${YELLOW}🚀 Step 12: Starting Node.js server...${NC}"
if command -v pm2 &> /dev/null; then
    pm2 stop whatsapp-gateway 2>/dev/null
    pm2 delete whatsapp-gateway 2>/dev/null
    pm2 start server.js --name whatsapp-gateway
    pm2 save
    echo -e "${GREEN}   ✅ Node.js server started with PM2${NC}"
else
    echo -e "${YELLOW}   ⚠️  PM2 not found. Starting with nohup...${NC}"
    pkill -f "node server.js" 2>/dev/null
    nohup node server.js > node.log 2>&1 &
    echo -e "${GREEN}   ✅ Node.js server started in background${NC}"
fi
echo ""

# Final Summary
echo "╔════════════════════════════════════════════════════════════╗"
echo "║              ✅ DEPLOYMENT COMPLETED! ✅                   ║"
echo "╚════════════════════════════════════════════════════════════╝"
echo ""
echo -e "${GREEN}🌐 Your application is now deployed!${NC}"
echo ""
echo "   URL: https://$DOMAIN"
echo "   Login: https://$DOMAIN/login"
echo ""
echo -e "${YELLOW}📋 Next Steps:${NC}"
echo "   1. Visit your domain and test login"
echo "   2. Change admin password"
echo "   3. Configure SSL certificate in cPanel"
echo "   4. Test WhatsApp connection"
echo "   5. Set up cron jobs for scheduled tasks"
echo ""
echo -e "${YELLOW}🔍 Check Status:${NC}"
echo "   Node.js: pm2 status (or: ps aux | grep node)"
echo "   Logs: tail -f storage/logs/laravel.log"
echo "   Node logs: tail -f node.log"
echo ""
echo -e "${GREEN}✨ Deployment successful!${NC}"
echo ""
