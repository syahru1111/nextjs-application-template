# Dayah Ulumul Qur'an Website

Website resmi Dayah Ulumul Qur'an Yayasan Quba' Bebesen - Lembaga Pendidikan Islam di Aceh Tengah.

## 🌟 Fitur Utama

### Frontend (Website Publik)
- **Homepage** dengan slider otomatis dan statistik santri
- **Berita** dengan sistem pagination dan detail artikel
- **Struktur Organisasi** dengan foto dan kontak pengurus
- **Program Akademik** (MTs, MA, Tahfidz) dengan detail lengkap
- **Tentang Kami** (Visi, Misi, Sejarah)
- **Galeri** dokumentasi kegiatan
- **Agenda** kegiatan mendatang
- **Data Pengajar** dengan profil lengkap

### Admin Panel
- **Dashboard** dengan statistik dan overview
- **Kelola Berita** (CRUD) dengan upload gambar
- **Kelola Struktur** organisasi dengan foto
- **Kelola Pengajar** dan data akademik
- **Kelola Galeri** foto kegiatan
- **Kelola Agenda** dan jadwal acara
- **Kelola Testimoni** alumni
- **Sistem Login** dengan session management

### Desain & Teknologi
- **Responsive Design** - Mobile-first approach
- **Modern UI** dengan efek glassmorphism
- **Google Fonts** (Poppins) untuk tipografi modern
- **SVG Icons** untuk performa optimal
- **PHP Native** dengan PDO untuk keamanan
- **MySQL Database** dengan struktur terorganisir

## 🚀 Instalasi

### Persyaratan Sistem
- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Apache/Nginx web server
- Extension PHP: PDO, PDO_MySQL, GD (untuk upload gambar)

### Langkah Instalasi

1. **Download/Clone Project**
   ```bash
   git clone [repository-url]
   # atau download dan extract file ZIP
   ```

2. **Setup Database**
   - Buat database baru di phpMyAdmin/MySQL
   - Import file `database.sql` ke database yang telah dibuat
   - Database akan otomatis terisi dengan data sample

3. **Konfigurasi Database**
   - Edit file `config/database.php`
   - Sesuaikan pengaturan koneksi database:
   ```php
   define('DB_HOST', 'localhost');     // Host database
   define('DB_USER', 'root');          // Username database
   define('DB_PASS', '');              // Password database
   define('DB_NAME', 'dayah_ulumul_quran'); // Nama database
   ```

4. **Konfigurasi Website**
   - Edit file `config/config.php`
   - Sesuaikan URL website:
   ```php
   define('SITE_URL', 'http://localhost/dayah-website');
   ```

5. **Setup Folder Permissions**
   ```bash
   chmod 755 img/
   chmod 755 img/berita/
   chmod 755 img/galeri/
   chmod 755 img/struktur/
   chmod 755 img/slider/
   ```

6. **Akses Website**
   - Frontend: `http://localhost/dayah-website/`
   - Admin Panel: `http://localhost/dayah-website/admin/`

## 🔐 Login Admin

**Default Admin Account:**
- Username: `admin`
- Password: `admin123`

⚠️ **PENTING:** Segera ganti password default setelah instalasi!

## 📁 Struktur Folder

```
dayah-website/
├── admin/                  # Admin panel
│   ├── index.php          # Login admin
│   ├── dashboard.php      # Dashboard utama
│   ├── logout.php         # Logout
│   ├── berita/            # Kelola berita
│   ├── struktur/          # Kelola struktur
│   ├── pengajar/          # Kelola pengajar
│   ├── galeri/            # Kelola galeri
│   ├── agenda/            # Kelola agenda
│   └── testimoni/         # Kelola testimoni
├── config/                # Konfigurasi
│   ├── config.php         # Konfigurasi utama
│   └── database.php       # Koneksi database
├── css/                   # Stylesheet
│   ├── style.css          # CSS utama
│   └── responsive.css     # CSS responsive
├── js/                    # JavaScript
│   └── main.js            # JavaScript utama
├── img/                   # Upload gambar
│   ├── berita/            # Gambar berita
│   ├── galeri/            # Gambar galeri
│   ├── struktur/          # Foto struktur
│   └── slider/            # Gambar slider
├── inc/                   # Include files
│   ├── header.php         # Header template
│   ├── footer.php         # Footer template
│   └── functions.php      # Fungsi-fungsi PHP
├── berita/                # Halaman berita
├── struktur/              # Halaman struktur
├── tentang/               # Halaman tentang
├── akademik/              # Halaman akademik
├── galeri/                # Halaman galeri
├── agenda/                # Halaman agenda
├── pengajar/              # Halaman pengajar
├── index.php              # Homepage
├── database.sql           # File database
├── .htaccess              # Apache configuration
└── README.md              # Dokumentasi ini
```

## 🎨 Kustomisasi

### Mengubah Warna Tema
Edit file `css/style.css` pada bagian CSS Variables:
```css
:root {
    --primary-color: #2d7d32;      /* Warna hijau utama */
    --primary-light: #4caf50;      /* Hijau terang */
    --primary-dark: #1b5e20;       /* Hijau gelap */
    /* ... */
}
```

### Menambah/Mengubah Konten
1. **Visi, Misi, Sejarah**: Edit melalui database tabel `tentang`
2. **Informasi Yayasan**: Edit tabel `yayasan`
3. **Statistik Santri**: Edit tabel `statistik`
4. **Slider Homepage**: Edit tabel `slider`

### Upload Gambar
- Maksimal ukuran file: 5MB
- Format yang didukung: JPG, JPEG, PNG, GIF
- Gambar otomatis diresize untuk optimasi

## 🔧 Troubleshooting

### Error Koneksi Database
- Pastikan MySQL service berjalan
- Cek konfigurasi di `config/database.php`
- Pastikan database sudah dibuat dan diimport

### Gambar Tidak Muncul
- Cek permission folder `img/` dan subfolder
- Pastikan path gambar benar di database
- Cek apakah file gambar ada di folder yang sesuai

### Error 500
- Cek error log Apache/PHP
- Pastikan semua file PHP syntax benar
- Cek permission file dan folder

### Admin Tidak Bisa Login
- Cek tabel `admin` di database
- Reset password admin jika perlu:
```sql
UPDATE admin SET password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' WHERE username = 'admin';
```

## 📱 Responsive Design

Website ini fully responsive dan telah dioptimasi untuk:
- **Desktop** (1200px+)
- **Tablet** (768px - 1199px)
- **Mobile** (320px - 767px)

## 🔒 Keamanan

- Password di-hash menggunakan bcrypt
- Prepared statements untuk mencegah SQL injection
- Session management yang aman
- Input validation dan sanitization
- File upload restrictions
- .htaccess security headers

## 🚀 Optimasi Performa

- CSS dan JS minification ready
- Image lazy loading
- Browser caching via .htaccess
- Gzip compression
- Optimized database queries

## 📞 Support

Untuk bantuan teknis atau pertanyaan:
- Email: info@dayahquba.com
- Telepon: +62 812-3456-7890

## 📄 Lisensi

Website ini dibuat khusus untuk Dayah Ulumul Qur'an Yayasan Quba' Bebesen.

---

**Dikembangkan dengan ❤️ untuk kemajuan pendidikan Islam**
