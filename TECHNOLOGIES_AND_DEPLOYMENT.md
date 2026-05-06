# 📊 MPWA WhatsApp Gateway - Technologies & Deployment

## 🔧 Technologies Used

### **Backend Stack**
| Technology | Version | Purpose |
|------------|---------|---------|
| **Laravel** | 12.32.1 | PHP web framework |
| **PHP** | 8.3.30 | Server-side language |
| **Node.js** | 22.18.0 | WhatsApp gateway server |
| **MySQL** | 8.4 | Database |
| **Composer** | Latest | PHP dependency manager |
| **NPM** | Latest | Node.js package manager |

### **Frontend Stack**
| Technology | Purpose |
|------------|---------|
| **Vuexy Theme** | Admin dashboard UI |
| **JavaScript/jQuery** | Frontend interactions |
| **Bootstrap** | CSS framework |
| **Socket.IO Client** | Real-time updates |

### **WhatsApp Integration**
| Package | Purpose |
|---------|---------|
| **@onexgen/baileys** | WhatsApp Web API |
| **qrcode** | QR code generation |
| **sharp** | Image processing |
| **jimp** | Image manipulation |

### **Real-time Communication**
| Technology | Purpose |
|------------|---------|
| **Socket.IO** | WebSocket server |
| **Express.js** | HTTP server for Node.js |

### **AI Integration (Optional)**
| Service | Purpose |
|---------|---------|
| **OpenAI API** | ChatGPT integration |
| **Google Gemini** | AI responses |
| **Anthropic Claude** | AI chatbot |
| **DALL-E** | Image generation |

### **Payment Gateways**
- Stripe
- PayPal
- Midtrans
- Xendit
- Duitku
- Tripay
- Phonepe
- Cashfree
- Flutterwave
- Paystack
- Paymob
- Fawaterk
- Mercadopago
- Custom Gateway

### **Other Libraries**
| Package | Purpose |
|---------|---------|
| **Laravel Sanctum** | API authentication |
| **Laravel Excel** | Excel import/export |
| **Laravel Localization** | Multi-language |
| **Laravel File Manager** | File management |
| **Laravel Ticket** | Support system |
| **Google2FA** | Two-factor auth |
| **Intervention Image** | Image processing |
| **Guzzle** | HTTP client |

---

## 🌐 Hosting Requirements

### **Minimum Requirements**
- **PHP:** 8.2 or higher
- **Node.js:** 16.x or higher
- **MySQL:** 5.7 or higher
- **RAM:** 2GB minimum
- **Storage:** 5GB minimum
- **Bandwidth:** Unlimited recommended

### **Server Requirements**
- **Web Server:** Apache/Nginx
- **PHP Extensions:**
  - BCMath
  - Ctype
  - Fileinfo
  - JSON
  - Mbstring
  - OpenSSL
  - PDO
  - Tokenizer
  - XML
  - GD or Imagick
  - Zip
  - Curl

- **Node.js Modules:**
  - Express
  - Socket.IO
  - MySQL2
  - Sharp
  - Baileys

### **Additional Requirements**
- **SSL Certificate** (for HTTPS)
- **Cron Jobs** (for scheduled tasks)
- **Process Manager** (PM2 recommended)
- **SSH Access** (for deployment)
- **Composer** (PHP dependency manager)
- **NPM** (Node.js package manager)

---

## 🚫 Why Free Platforms Won't Work

### **Vercel**
❌ No Node.js persistent processes
❌ No MySQL database
❌ No file system persistence
❌ Serverless only (functions timeout)
❌ No WebSocket support

### **Netlify**
❌ Static sites only
❌ No backend support
❌ No database
❌ No persistent processes

### **GitHub Pages**
❌ Static HTML only
❌ No backend
❌ No database

### **Heroku Free Tier (Discontinued)**
❌ Free tier no longer available
❌ Paid plans start at $7/month

---

## ✅ Recommended Hosting Options

### **1. Hostinger (Your Current Choice)**

**VPS Plans:**
| Plan | Price | Specs |
|------|-------|-------|
| **VPS 1** | $4.99/mo | 1 vCPU, 4GB RAM, 50GB SSD |
| **VPS 2** | $8.99/mo | 2 vCPU, 8GB RAM, 100GB SSD |
| **VPS 3** | $12.99/mo | 4 vCPU, 12GB RAM, 150GB SSD |

**✅ Pros:**
- Full root access
- Node.js support
- MySQL included
- SSL certificate
- cPanel included
- Good support

**❌ Cons:**
- Shared hosting doesn't support Node.js
- Need VPS or Business plan

**Deployment Status:**
- ✅ SSH Access: Available
- ✅ Domain: inv.enginerds.in
- ⚠️ Node.js: Need to verify availability

---

### **2. DigitalOcean**

**Droplet Plans:**
| Plan | Price | Specs |
|------|-------|-------|
| **Basic** | $4/mo | 1 vCPU, 512MB RAM, 10GB SSD |
| **Basic** | $6/mo | 1 vCPU, 1GB RAM, 25GB SSD |
| **Basic** | $12/mo | 1 vCPU, 2GB RAM, 50GB SSD |

**✅ Pros:**
- Full control
- Easy deployment
- Good documentation
- Scalable
- Reliable

**❌ Cons:**
- Requires server management
- No cPanel (use alternatives)

---

### **3. Vultr**

**Cloud Compute:**
| Plan | Price | Specs |
|------|-------|-------|
| **Regular** | $2.50/mo | 1 vCPU, 512MB RAM, 10GB SSD |
| **Regular** | $5/mo | 1 vCPU, 1GB RAM, 25GB SSD |
| **Regular** | $10/mo | 1 vCPU, 2GB RAM, 55GB SSD |

**✅ Pros:**
- Cheapest option
- Good performance
- Multiple locations
- Easy setup

**❌ Cons:**
- Basic support
- Self-managed

---

### **4. Contabo**

**VPS Plans:**
| Plan | Price | Specs |
|------|-------|-------|
| **VPS S** | €4.50/mo | 4 vCPU, 8GB RAM, 200GB SSD |
| **VPS M** | €8.50/mo | 6 vCPU, 16GB RAM, 400GB SSD |

**✅ Pros:**
- Best value for money
- High specs
- Good performance

**❌ Cons:**
- Europe-based (may have latency)
- Setup takes 24-48 hours

---

### **5. Hybrid Approach (Recommended if Hostinger Shared)**

**Laravel on Hostinger + Node.js on Free Platform**

**Node.js Options:**

#### **Railway.app**
- **Free Tier:** $5 credit/month
- **Pros:** Easy deployment, GitHub integration
- **Cons:** Limited free tier

#### **Render.com**
- **Free Tier:** Available
- **Pros:** Auto-deploy, SSL included
- **Cons:** Sleeps after inactivity

#### **Fly.io**
- **Free Tier:** 3 VMs free
- **Pros:** Global deployment, good performance
- **Cons:** Complex setup

---

## 📊 Cost Comparison

| Hosting | Monthly Cost | Node.js | MySQL | SSL | cPanel |
|---------|--------------|---------|-------|-----|--------|
| **Hostinger VPS** | $4.99 | ✅ | ✅ | ✅ | ✅ |
| **DigitalOcean** | $6 | ✅ | ✅ | ✅ | ❌ |
| **Vultr** | $5 | ✅ | ✅ | ✅ | ❌ |
| **Contabo** | €4.50 | ✅ | ✅ | ✅ | ❌ |
| **Hybrid** | $0-5 | ✅ | ✅ | ✅ | ✅ |

---

## 🎯 Deployment Strategy for Hostinger

### **Option 1: Full Deployment (If VPS/Business)**
1. Upload all files
2. Install dependencies
3. Configure database
4. Start Node.js server
5. Configure domain

**Estimated Time:** 30-60 minutes

### **Option 2: Hybrid Deployment (If Shared)**
1. Deploy Laravel on Hostinger
2. Deploy Node.js on Railway/Render
3. Connect both services
4. Configure domain

**Estimated Time:** 45-90 minutes

---

## 🚀 Quick Start Deployment

### **For Hostinger VPS:**
```bash
# 1. Run on Windows
.\deploy-windows.ps1

# 2. Upload files to server

# 3. Connect via SSH
ssh -p 65002 u757590993@145.79.209.199

# 4. Run deployment
cd /home/u757590993/domains/enginerds.in/public_html/inv
chmod +x deploy.sh
./deploy.sh
```

### **For Hybrid Deployment:**
```bash
# 1. Deploy Laravel on Hostinger (same as above, skip Node.js)

# 2. Deploy Node.js on Railway:
# - Go to railway.app
# - Connect GitHub
# - Deploy server.js
# - Get URL

# 3. Update Hostinger .env:
WA_URL_SERVER=https://your-app.railway.app
```

---

## 📚 Documentation Files

| File | Purpose |
|------|---------|
| **HOSTINGER_DEPLOYMENT.md** | Quick deployment guide |
| **DEPLOYMENT_GUIDE.md** | Detailed instructions |
| **deploy-windows.ps1** | Windows deployment script |
| **deploy.sh** | Server deployment script |
| **.env.production** | Production environment template |
| **LOGIN_CREDENTIALS.txt** | Access credentials |
| **QUICK_START.md** | Quick reference |
| **README_SETUP.md** | Setup documentation |

---

## 🔍 Next Steps

1. **Check Hostinger Plan:**
   - Login to cPanel
   - Look for "Node.js" option
   - If not found, contact support

2. **Choose Deployment Method:**
   - Full deployment (if Node.js available)
   - Hybrid deployment (if shared hosting)

3. **Run Deployment:**
   - Follow HOSTINGER_DEPLOYMENT.md
   - Use automated scripts
   - Test thoroughly

4. **Configure Domain:**
   - Point domain to server
   - Enable SSL
   - Test access

5. **Go Live:**
   - Change admin password
   - Test WhatsApp connection
   - Start using!

---

## 📞 Support

**Hostinger Support:**
- Check if Node.js is available
- Ask about VPS upgrade options
- Request SSL certificate setup

**Technical Support:**
- Check deployment guides
- Review troubleshooting section
- Test each component separately

---

**Ready to deploy? Start with `HOSTINGER_DEPLOYMENT.md`!**
