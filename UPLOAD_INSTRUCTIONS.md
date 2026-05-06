# 📤 Upload Instructions - Hostinger cPanel

## ✅ Deployment Package Created!

**ZIP File Location:**
```
C:\Users\THE_NE~1\AppData\Local\Temp\mpwa-deployment.zip
```

---

## 🎯 Method 1: Upload via cPanel File Manager (Easiest)

### Step 1: Login to Hostinger cPanel
1. Go to: https://hpanel.hostinger.com
2. Login with your Hostinger credentials
3. Find your domain: **enginerds.in**
4. Click **"File Manager"**

### Step 2: Navigate to Deployment Directory
1. In File Manager, navigate to:
   ```
   /home/u757590993/domains/enginerds.in/public_html/inv/
   ```
2. If `inv` folder doesn't exist, create it:
   - Click **"+ Folder"**
   - Name it: `inv`
   - Click **"Create"**

### Step 3: Upload ZIP File
1. Click **"Upload"** button (top right)
2. Click **"Select File"**
3. Browse to: `C:\Users\THE_NE~1\AppData\Local\Temp\mpwa-deployment.zip`
4. Select the file and click **"Open"**
5. Wait for upload to complete (may take 5-10 minutes)

### Step 4: Extract ZIP File
1. Find `mpwa-deployment.zip` in the file list
2. Right-click on it
3. Select **"Extract"**
4. Confirm extraction
5. Wait for extraction to complete
6. Delete the ZIP file (optional, to save space)

### Step 5: Set Permissions
1. Select the `storage` folder
2. Right-click → **"Permissions"**
3. Set to: **777** (or check all boxes)
4. Check **"Recurse into subdirectories"**
5. Click **"Change"**

6. Repeat for `credentials` folder
7. Repeat for `bootstrap/cache` folder

---

## 🎯 Method 2: Upload via FileZilla (Alternative)

### Step 1: Download FileZilla
- Download from: https://filezilla-project.org/
- Install FileZilla Client

### Step 2: Connect to Server
1. Open FileZilla
2. Click **"File"** → **"Site Manager"**
3. Click **"New Site"**
4. Enter details:
   - **Protocol:** SFTP - SSH File Transfer Protocol
   - **Host:** 145.79.209.199
   - **Port:** 65002
   - **Logon Type:** Normal
   - **User:** u757590993
   - **Password:** Diplo@6589#
5. Click **"Connect"**

### Step 3: Navigate and Upload
1. On the right side (Remote site), navigate to:
   ```
   /home/u757590993/domains/enginerds.in/public_html/inv/
   ```
2. On the left side (Local site), navigate to:
   ```
   C:\laragon\www\whatsapp\
   ```
3. Select all files and folders (except node_modules, vendor)
4. Right-click → **"Upload"**
5. Wait for upload to complete

---

## 🔌 Connect via SSH and Deploy

### Option 1: Use the Batch File
1. Double-click: `C:\Users\THE_NE~1\AppData\Local\Temp\connect-hostinger.bat`
2. Enter password when prompted: `Diplo@6589#`

### Option 2: Use PowerShell/CMD
```bash
ssh -p 65002 u757590993@145.79.209.199
# Password: Diplo@6589#
```

### Once Connected, Run:
```bash
# Navigate to project directory
cd /home/u757590993/domains/enginerds.in/public_html/inv

# If uploaded via cPanel, extract first
unzip mpwa-deployment.zip

# Make deploy script executable
chmod +x deploy.sh

# Run deployment
./deploy.sh
```

---

## 📋 What deploy.sh Will Do:

1. ✅ Check PHP version (needs 8.2+)
2. ✅ Check Node.js availability
3. ✅ Install PHP dependencies (composer)
4. ✅ Install Node.js dependencies (npm)
5. ✅ Configure environment (.env)
6. ✅ Generate application key
7. ✅ Set file permissions
8. ✅ Run database migrations
9. ✅ Create admin user
10. ✅ Optimize Laravel
11. ✅ Start Node.js server

---

## ⚠️ Important Notes

### Before Running deploy.sh:

1. **Create MySQL Database in cPanel:**
   - Go to cPanel → MySQL Databases
   - Create database: `u757590993_whatsapp`
   - Create user: `u757590993_whatsapp`
   - Set a strong password
   - Add user to database with ALL PRIVILEGES
   - **Remember the password!**

2. **Check Node.js Availability:**
   ```bash
   node -v
   npm -v
   ```
   If not found, contact Hostinger support or use hybrid deployment.

3. **Edit .env File (if needed):**
   ```bash
   nano .env
   ```
   Update database credentials:
   ```
   DB_DATABASE=u757590993_whatsapp
   DB_USERNAME=u757590993_whatsapp
   DB_PASSWORD=your_database_password
   ```

---

## 🐛 Troubleshooting

### Upload Failed
- Check internet connection
- Try smaller batches
- Use FileZilla instead of cPanel

### Permission Denied
```bash
chmod -R 755 .
chmod -R 777 storage
chmod -R 777 credentials
chmod -R 777 bootstrap/cache
```

### Node.js Not Found
- Contact Hostinger support
- Ask: "Does my plan support Node.js?"
- If not, upgrade to VPS or use hybrid deployment

### Database Connection Failed
- Verify database exists in cPanel
- Check credentials in .env
- Test connection:
  ```bash
  php artisan tinker
  >>> DB::connection()->getPdo();
  ```

---

## ✅ After Successful Deployment

1. Visit: **https://inv.enginerds.in**
2. Login with admin credentials
3. Change password immediately
4. Test WhatsApp connection
5. Configure SSL certificate
6. Set up cron jobs

---

## 📞 Need Help?

**Hostinger Support:**
- Live chat in cPanel
- Email: support@hostinger.com

**Check Deployment Logs:**
```bash
tail -f storage/logs/laravel.log
tail -f node.log
```

---

**Ready? Start uploading the ZIP file to cPanel!** 🚀
