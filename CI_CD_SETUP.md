# CI/CD Setup Guide - Niagahoster Deployment

## 📋 Prerequisites

Sebelum setup CI/CD, siapkan informasi dari Niagahoster:

### 1. Dapatkan Credentials dari Niagahoster (cPanel)

**Informasi Paket Anda:**

| Detail             | Nilai                                        |
| ------------------ | -------------------------------------------- |
| **Domain**         | https://cstock.id                            |
| **Disk Space**     | 100 GB                                       |
| **RAM**            | 2048 MB                                      |
| **CPU Core**       | 1                                            |
| **Bandwidth**      | Unlimited                                    |
| **Server**         | server1092 (Asia - Indonesia)                |
| **FTP Host**       | ftp.cstock.id                                |
| **FTP Username**   | u6174422.deployercicd                        |
| **FTP Password**   | Deploy1!@#                                   |
| **Upload Folder**  | public_html                                  |
| **Direktori Full** | /home/u6174422/domains/cstock.id/public_html |

**SSH/SFTP Credentials:**

- Buka cPanel → SSH Access atau FTP Accounts
- Hostname: `ftp.cstock.id`
- Username: `u6174422.deployercicd`
- Password: `Deploy1!@#`

**Database Credentials:**

- Buka cPanel → Databases → MySQL Databases
- Catat:
    - Database name
    - Database user
    - Database password

---

## 🔐 Setup GitHub Secrets

1. Buka repo GitHub: https://github.com/Nizar-Rasyiid/Cstock
2. Pergi ke **Settings** → **Secrets and variables** → **Actions**
3. Tambahkan secrets berikut:

| Secret Name            | Value                   |
| ---------------------- | ----------------------- |
| `NIAGAHOSTER_HOST`     | `ftp.cstock.id`         |
| `NIAGAHOSTER_USERNAME` | `u6174422.deployercicd` |
| `NIAGAHOSTER_PASSWORD` | `Deploy1!@#`            |

**Contoh cara add secret:**

- Click "New repository secret"
- Name: `NIAGAHOSTER_HOST`
- Value: `ftp.cstock.id`
- Click "Add secret"
- Ulangi untuk `NIAGAHOSTER_USERNAME` dan `NIAGAHOSTER_PASSWORD`

---

## ⚙️ Update `.env.production`

Edit `.env.production` dengan config production Anda:

```env
APP_URL=https://yourdomain.com
DB_HOST=localhost
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
MAIL_USERNAME=your_email@gmail.com
```

---

## 🚀 Deployment Flow

Setiap kali push ke branch `main`:

```
GitHub Push
    ↓
GitHub Actions Started
    ↓
✓ Setup PHP 8.1
✓ Install Composer dependencies
✓ Setup Node 18
✓ Install NPM dependencies
✓ Build assets (npm run production)
✓ Upload via SFTP ke public_html
✓ Run Laravel migrations
✓ Clear cache
    ↓
✅ Deploy Complete
```

---

## 📌 Test Deployment

1. **Local test dulu:**

    ```bash
    composer install --no-dev
    npm install
    npm run production
    ```

2. **Push ke main:**

    ```bash
    git add .
    git commit -m "Setup CI/CD"
    git push origin main
    ```

3. **Monitor di GitHub:**
    - Buka repo → **Actions** tab
    - Lihat status workflow
    - Klik workflow untuk detail log

---

## ⚠️ Troubleshooting

### ❌ SFTP Connection Failed

- Pastikan credentials di GitHub Secrets benar
- Pastikan SFTP enabled di Niagahoster (cPanel → SSH Access atau FTP Accounts)
- Test credentials locally dulu dengan FTP client

### ❌ Migration Failed

- Pastikan database credentials di `.env.production` benar
- Pastikan database sudah dibuat di Niagahoster
- Check workflow log untuk error detail

### ❌ Assets not loading

- Pastikan npm build berhasil (`npm run production`)
- Check file permissions di public_html/build

---

## 🔄 Manual Deployment (if needed)

Jika CI/CD stuck, bisa deploy manual:

```bash
# 1. SSH ke Niagahoster
ssh niagahoster_xxx@cstock.niagahoster.com

# 2. Navigate ke public_html
cd public_html

# 3. Pull latest dari GitHub
git pull origin main

# 4. Install dependencies
composer install --no-dev
npm install
npm run production

# 5. Clear cache
php artisan cache:clear
php artisan config:cache
php artisan migrate --force
```

---

## 📞 Support

Jika ada error:

1. Check GitHub Actions log untuk detail error
2. Test SSH/SFTP credentials dengan FTP client
3. Verify database credentials

---

## Notes

- Workflow ini auto-deploy setiap push ke `main`
- Production build menggunakan `--no-dev` untuk Composer
- Database migrations auto-run setelah deploy
- Cache auto-clear setelah deploy
