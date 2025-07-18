-- Database: dayah_ulumul_quran
-- Created for Dayah Ulumul Qur'an Yayasan Quba' Bebesen

CREATE DATABASE IF NOT EXISTS dayah_ulumul_quran;
USE dayah_ulumul_quran;

-- Table: admin
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: berita
CREATE TABLE berita (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    isi TEXT NOT NULL,
    gambar VARCHAR(255),
    ringkasan TEXT,
    status ENUM('draft', 'published') DEFAULT 'published',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: struktur
CREATE TABLE struktur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jabatan VARCHAR(100) NOT NULL,
    foto VARCHAR(255),
    no_hp VARCHAR(20),
    urutan INT DEFAULT 0,
    status ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: galeri
CREATE TABLE galeri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255) NOT NULL,
    kategori VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: agenda
CREATE TABLE agenda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    isi TEXT NOT NULL,
    tanggal DATE NOT NULL,
    waktu TIME,
    tempat VARCHAR(255),
    status ENUM('upcoming', 'ongoing', 'completed') DEFAULT 'upcoming',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: pengajar
CREATE TABLE pengajar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    bidang VARCHAR(100) NOT NULL,
    foto VARCHAR(255),
    pendidikan TEXT,
    pengalaman TEXT,
    status ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: testimoni
CREATE TABLE testimoni (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    foto VARCHAR(255),
    isi TEXT NOT NULL,
    angkatan VARCHAR(10),
    pekerjaan VARCHAR(100),
    status ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: tentang
CREATE TABLE tentang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis ENUM('visi', 'misi', 'sejarah') NOT NULL,
    isi TEXT NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: yayasan
CREATE TABLE yayasan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    profil TEXT NOT NULL,
    alamat TEXT,
    telepon VARCHAR(20),
    email VARCHAR(100),
    website VARCHAR(100),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: slider
CREATE TABLE slider (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255) NOT NULL,
    link VARCHAR(255),
    urutan INT DEFAULT 0,
    status ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: statistik
CREATE TABLE statistik (
    id INT AUTO_INCREMENT PRIMARY KEY,
    santri_putra INT DEFAULT 0,
    santri_putri INT DEFAULT 0,
    total_santri INT DEFAULT 0,
    total_pengajar INT DEFAULT 0,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: downloads
CREATE TABLE downloads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    file_size VARCHAR(20),
    kategori VARCHAR(50),
    download_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin user (password: admin123)
INSERT INTO admin (username, password, nama, email) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin@dayahquba.com');

-- Insert default data
INSERT INTO tentang (jenis, isi) VALUES 
('visi', 'Menjadi lembaga pendidikan Islam terdepan dalam mencetak generasi Qur\'ani yang berakhlak mulia, berilmu, dan bermanfaat bagi umat.'),
('misi', '1. Menyelenggarakan pendidikan Islam yang berkualitas\n2. Membentuk karakter santri yang berakhlak mulia\n3. Mengembangkan potensi santri dalam bidang akademik dan non-akademik\n4. Menciptakan lingkungan belajar yang kondusif dan Islami'),
('sejarah', 'Dayah Ulumul Qur\'an Yayasan Quba\' Bebesen didirikan pada tahun 2010 dengan visi menjadi pusat pendidikan Islam yang unggul di Aceh Tengah.');

INSERT INTO yayasan (nama, profil, alamat, telepon, email) VALUES 
('Yayasan Quba\' Bebesen', 'Yayasan Quba\' Bebesen adalah lembaga pendidikan Islam yang berkomitmen untuk mencetak generasi Qur\'ani yang berakhlak mulia dan berilmu tinggi.', 'Jl. Takengon - Bireuen, Bebesen, Aceh Tengah', '0812-3456-7890', 'info@dayahquba.com');

INSERT INTO statistik (santri_putra, santri_putri, total_santri, total_pengajar) VALUES 
(150, 120, 270, 25);

-- Insert sample slider data
INSERT INTO slider (judul, deskripsi, gambar, urutan, status) VALUES 
('Selamat Datang di Dayah Ulumul Qur\'an', 'Lembaga pendidikan Islam terdepan di Aceh Tengah', 'slider1.jpg', 1, 'aktif'),
('Pendidikan Berkualitas', 'Membentuk generasi Qur\'ani yang berakhlak mulia', 'slider2.jpg', 2, 'aktif'),
('Fasilitas Lengkap', 'Lingkungan belajar yang kondusif dan modern', 'slider3.jpg', 3, 'aktif');
