<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://github.com/Ryandra-TI01/Aplikasi-HealthTrack/blob/main/public/images/LOGO%20-%20HealthTrack%202.png?raw=true" alt="Logo HealthTrack">
  </a>
</p>


---

# HealthTrack

**HealthTrack** adalah aplikasi pemantauan kesehatan berbasis web yang membantu pengguna untuk mengelola jadwal medis, mencatat kondisi kesehatan, serta berinteraksi melalui forum komunitas. Dikembangkan menggunakan Laravel dan Filament Admin Panel.

---

## ✨ Fitur Utama

- 🔐 **Autentikasi Pengguna**
- 📅 **Pengelolaan & Pengingat Jadwal Medis**
- 📊 **Pencatatan & Pemantauan Kondisi Kesehatan**  
  (Suhu tubuh, tekanan darah, saturasi oksigen, berat badan)
- 📥 **Ekspor PDF Hasil Monitoring Kesehatan**
- 💬 **Grup Komunitas Diskusi & Sharing**
- 🗣️ **Manajemen Kritik, Saran, dan Pesan Pengguna**
- 🛠️ **Pelaporan Masalah & Bug Aplikasi**
- 📈 **Statistik Data Pengguna untuk Admin**
- 📋 **Log Aktivitas Pengguna**
- ⚙️ **Pemantauan Performa Aplikasi**

---

## 🛠️ Teknologi

- **Laravel 12**
- **Filament Admin Panel**
- **Spatie Activity Log**
- **z3d0x/filament-logger**
- **Firebase Cloud Messaging** 
- **Laravel DomPDF**
- **PostgreSQL / MySQL**

---

## 🚀 Instalasi

```bash
git clone https://github.com/username/healthtrack.git
cd healthtrack

composer install
cp .env.example .env
php artisan key:generate

# Sesuaikan koneksi database di file .env
php artisan migrate --seed

composer run dev
