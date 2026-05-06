# 🚀 MPWA WhatsApp Gateway - Quick Start

## ✅ System Status: READY

All services are running and configured!

---

## 🔐 Login Now

**URL:** http://localhost/whatsapp/public/login

**Credentials:**
- **Username:** `admin`
- **Email:** `admin@admin.com`  
- **Password:** `admin123`

---

## 📱 Connect WhatsApp (After Login)

1. Go to **Devices** menu
2. Click **"Add Device"**
3. Enter a device name/number
4. Click **"Generate QR Code"**
5. Open WhatsApp on your phone
6. Go to: **Settings → Linked Devices → Link a Device**
7. Scan the QR code
8. Wait for connection ✅

---

## 🎯 What You Can Do

### Send Messages
- Text messages
- Images, videos, audio, documents
- Stickers
- Location
- Contacts (vCard)
- Products
- Buttons & Lists
- Polls

### Automation
- Auto-reply messages
- AI Bot (ChatGPT, Gemini, Claude)
- Campaign management
- Blast messages
- Scheduled messages

### Management
- Contact management
- Message templates
- Message history
- Webhooks
- REST API

---

## 🔧 API Quick Test

```bash
# Send a text message via API
curl -X POST http://localhost/whatsapp/public/backend-send-text \
  -H "Content-Type: application/json" \
  -d '{
    "api_key": "YKBCSMNvjWHNvjWHNvNBStU9o8skn2yCWAECc",
    "device": "YOUR_DEVICE_NUMBER",
    "number": "628123456789",
    "message": "Hello from MPWA!"
  }'
```

**API Documentation:** http://localhost/whatsapp/public/api-docs

---

## ⚠️ Important Security Notes

1. **Change your password immediately** after first login!
2. Keep your API key secure
3. Enable Two-Factor Authentication (2FA)
4. Don't share your credentials

---

## 🛠️ If Something Stops Working

### Restart Services:
1. Open Laragon
2. Click "Start All"

### Restart Node.js Server:
```powershell
cd C:\laragon\www\whatsapp
node server.js
```

### Clear Cache:
```powershell
C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe artisan cache:clear
```

---

## 📊 Service Ports

- **Web Application:** Port 80 (Apache)
- **WhatsApp Gateway:** Port 3100 (Node.js)
- **Database:** Port 3306 (MySQL)

---

## 📞 Need Help?

- Check **Admin Panel → Tickets** for support
- View logs: `storage/logs/laravel.log`
- Check Node.js terminal for WhatsApp connection issues

---

## 🎉 You're All Set!

Your WhatsApp Gateway is ready to use. Login and start connecting your WhatsApp devices!

**Login URL:** http://localhost/whatsapp/public/login

---

*Generated: May 5, 2026*
*Version: 12.0.1*
