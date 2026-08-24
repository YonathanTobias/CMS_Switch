# CMS Divisi & Program Studi STIKES Panti Waluya

Sistem pengelolaan konten (CMS) web modular dan mandiri dengan fitur **1-Click Preset Switcher** untuk berbagai divisi, lembaga, biro kemahasiswaan, dan program studi di lingkungan STIKES Panti Waluya Malang.

## 🚀 Fitur Utama
- **⚡ 1-Click Preset Switcher**: Mendukung 8 preset resmi (LPMI, LPPM, CDC, Belmawa, S1 Keperawatan & Ners, S1 Farmasi, D4 MIK, RPL).
- **👥 Role & Permission**: Admin IT (Super User) dan Admin Divisi (Operator).
- **🧭 Dynamic Navigation Menu**: Pengelolaan menu navbar dan dropdown submenu hierarkis.
- **🎛️ Layanan Switch On/Off**: Kemampuan mengaktifkan/menonaktifkan modul layanan publik.
- **🎓 Dedicated Prodi Blocks**: Visi & Misi Tri Dharma, gelar, akreditasi, dan profil lulusan.
- **📰 Modul Konten Lengkap**: Carousel Banner, Berita & Pengumuman, Agenda Kegiatan, Dokumen & Unduhan, Galeri, Struktur Organisasi, Kontak.

## 🛠️ Instalasi & Menjalankan

1. Clone repositori:
```bash
git clone https://github.com/YonathanTobias/CMS_Switch.git
cd CMS_Switch
```

2. Instal dependensi PHP:
```bash
composer install
```

3. Salin file environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Jalankan migrasi dan seeder:
```bash
php artisan migrate --seed
```

5. Jalankan server lokal:
```bash
php artisan serve
```
Buka browser di `http://127.0.0.1:8000`.

## 🔐 Akun Default
- **Super Admin (Admin IT)**: `it@pantiwaluya.ac.id` / `password123`
- **Division Admin**: `divisi@pantiwaluya.ac.id` / `password123`
