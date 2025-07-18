<?php
require_once '../config/config.php';
require_once '../inc/functions.php';

// Get unit parameter
$unit = $_GET['unit'] ?? '';

// Page meta data based on unit
switch ($unit) {
    case 'mts':
        $page_title = 'Madrasah Tsanawiyah (MTs)';
        $page_description = 'Program pendidikan Madrasah Tsanawiyah di Dayah Ulumul Qur\'an';
        break;
    case 'ma':
        $page_title = 'Madrasah Aliyah (MA)';
        $page_description = 'Program pendidikan Madrasah Aliyah di Dayah Ulumul Qur\'an';
        break;
    case 'tahfidz':
        $page_title = 'Program Tahfidz';
        $page_description = 'Program menghafal Al-Qur\'an di Dayah Ulumul Qur\'an';
        break;
    default:
        $page_title = 'Program Akademik';
        $page_description = 'Program pendidikan yang tersedia di Dayah Ulumul Qur\'an Yayasan Quba\' Bebesen';
        break;
}

// Breadcrumb
if ($unit) {
    $breadcrumb = generateBreadcrumb([
        ['title' => 'Beranda', 'url' => SITE_URL],
        ['title' => 'Akademik', 'url' => SITE_URL . '/akademik/'],
        ['title' => $page_title]
    ]);
} else {
    $breadcrumb = generateBreadcrumb([
        ['title' => 'Beranda', 'url' => SITE_URL],
        ['title' => 'Program Akademik']
    ]);
}

include '../inc/header.php';
?>

<!-- Breadcrumb -->
<?php echo $breadcrumb; ?>

<?php if (empty($unit)): ?>
    <!-- Academic Overview -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h1 class="section-title">Program Akademik</h1>
                <p class="section-subtitle">Unit pendidikan yang tersedia di Dayah Ulumul Qur'an</p>
            </div>
            
            <div class="academic-grid">
                <!-- MTs Program -->
                <div class="academic-card glass">
                    <div class="academic-icon">
                        <svg width="60" height="60" viewBox="0 0 24 24" fill="none">
                            <path d="M22 10V6C22 4.89543 21.1046 4 20 4H4C2.89543 4 2 4.89543 2 6V10M22 10L18 14L16 12L12 16L8 12L6 14L2 10M22 10V18C22 19.1046 21.1046 20 20 20H4C2.89543 20 2 19.1046 2 18V10" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <h3 class="academic-title">Madrasah Tsanawiyah</h3>
                    <p class="academic-subtitle">Setingkat SMP</p>
                    <p class="academic-description">
                        Program pendidikan menengah pertama yang memadukan kurikulum nasional dengan pendidikan agama Islam yang komprehensif.
                    </p>
                    <div class="academic-features">
                        <div class="feature-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <polyline points="9,11 12,14 22,4" stroke="currentColor" stroke-width="2"/>
                                <path d="M21,12V19C21,19.5304 20.7893,20.0391 20.4142,20.4142C20.0391,20.7893 19.5304,21 19,21H5C4.46957,21 3.96086,20.7893 3.58579,20.4142C3.21071,20.0391 3,19.5304 3,19V5C3,4.46957 3.21071,3.96086 3.58579,3.58579C3.96086,3.21071 4.46957,3 5,3H16" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>Kurikulum Terintegrasi</span>
                        </div>
                        <div class="feature-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <polyline points="9,11 12,14 22,4" stroke="currentColor" stroke-width="2"/>
                                <path d="M21,12V19C21,19.5304 20.7893,20.0391 20.4142,20.4142C20.0391,20.7893 19.5304,21 19,21H5C4.46957,21 3.96086,20.7893 3.58579,20.4142C3.21071,20.0391 3,19.5304 3,19V5C3,4.46957 3.21071,3.96086 3.58579,3.58579C3.96086,3.21071 4.46957,3 5,3H16" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>Pembentukan Karakter</span>
                        </div>
                        <div class="feature-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <polyline points="9,11 12,14 22,4" stroke="currentColor" stroke-width="2"/>
                                <path d="M21,12V19C21,19.5304 20.7893,20.0391 20.4142,20.4142C20.0391,20.7893 19.5304,21 19,21H5C4.46957,21 3.96086,20.7893 3.58579,20.4142C3.21071,20.0391 3,19.5304 3,19V5C3,4.46957 3.21071,3.96086 3.58579,3.58579C3.96086,3.21071 4.46957,3 5,3H16" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>Fasilitas Lengkap</span>
                        </div>
                    </div>
                    <a href="<?php echo SITE_URL; ?>/akademik/?unit=mts" class="btn btn-primary">Detail Program</a>
                </div>
                
                <!-- MA Program -->
                <div class="academic-card glass">
                    <div class="academic-icon">
                        <svg width="60" height="60" viewBox="0 0 24 24" fill="none">
                            <path d="M4 19.5C4 18.1193 5.11929 17 6.5 17H20" stroke="currentColor" stroke-width="2"/>
                            <path d="M6.5 2H20V22H6.5C5.11929 22 4 20.8807 4 19.5V4.5C4 3.11929 5.11929 2 6.5 2Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M8 7H16M8 11H16" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <h3 class="academic-title">Madrasah Aliyah</h3>
                    <p class="academic-subtitle">Setingkat SMA</p>
                    <p class="academic-description">
                        Program pendidikan menengah atas dengan fokus pendalaman ilmu agama dan persiapan melanjutkan ke perguruan tinggi.
                    </p>
                    <div class="academic-features">
                        <div class="feature-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <polyline points="9,11 12,14 22,4" stroke="currentColor" stroke-width="2"/>
                                <path d="M21,12V19C21,19.5304 20.7893,20.0391 20.4142,20.4142C20.0391,20.7893 19.5304,21 19,21H5C4.46957,21 3.96086,20.7893 3.58579,20.4142C3.21071,20.0391 3,19.5304 3,19V5C3,4.46957 3.21071,3.96086 3.58579,3.58579C3.96086,3.21071 4.46957,3 5,3H16" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>Persiapan Perguruan Tinggi</span>
                        </div>
                        <div class="feature-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <polyline points="9,11 12,14 22,4" stroke="currentColor" stroke-width="2"/>
                                <path d="M21,12V19C21,19.5304 20.7893,20.0391 20.4142,20.4142C20.0391,20.7893 19.5304,21 19,21H5C4.46957,21 3.96086,20.7893 3.58579,20.4142C3.21071,20.0391 3,19.5304 3,19V5C3,4.46957 3.21071,3.96086 3.58579,3.58579C3.96086,3.21071 4.46957,3 5,3H16" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>Pendalaman Ilmu Agama</span>
                        </div>
                        <div class="feature-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <polyline points="9,11 12,14 22,4" stroke="currentColor" stroke-width="2"/>
                                <path d="M21,12V19C21,19.5304 20.7893,20.0391 20.4142,20.4142C20.0391,20.7893 19.5304,21 19,21H5C4.46957,21 3.96086,20.7893 3.58579,20.4142C3.21071,20.0391 3,19.5304 3,19V5C3,4.46957 3.21071,3.96086 3.58579,3.58579C3.96086,3.21071 4.46957,3 5,3H16" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>Pengembangan Bakat</span>
                        </div>
                    </div>
                    <a href="<?php echo SITE_URL; ?>/akademik/?unit=ma" class="btn btn-primary">Detail Program</a>
                </div>
                
                <!-- Tahfidz Program -->
                <div class="academic-card glass">
                    <div class="academic-icon">
                        <svg width="60" height="60" viewBox="0 0 24 24" fill="none">
                            <path d="M12 6.253V16.747M7 3L17 21M17 3L7 21" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <h3 class="academic-title">Program Tahfidz</h3>
                    <p class="academic-subtitle">Menghafal Al-Qur'an</p>
                    <p class="academic-description">
                        Program khusus menghafal Al-Qur'an dengan metode pembelajaran yang efektif dan bimbingan ustadz berpengalaman.
                    </p>
                    <div class="academic-features">
                        <div class="feature-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <polyline points="9,11 12,14 22,4" stroke="currentColor" stroke-width="2"/>
                                <path d="M21,12V19C21,19.5304 20.7893,20.0391 20.4142,20.4142C20.0391,20.7893 19.5304,21 19,21H5C4.46957,21 3.96086,20.7893 3.58579,20.4142C3.21071,20.0391 3,19.5304 3,19V5C3,4.46957 3.21071,3.96086 3.58579,3.58579C3.96086,3.21071 4.46957,3 5,3H16" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>Metode Teruji</span>
                        </div>
                        <div class="feature-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <polyline points="9,11 12,14 22,4" stroke="currentColor" stroke-width="2"/>
                                <path d="M21,12V19C21,19.5304 20.7893,20.0391 20.4142,20.4142C20.0391,20.7893 19.5304,21 19,21H5C4.46957,21 3.96086,20.7893 3.58579,20.4142C3.21071,20.0391 3,19.5304 3,19V5C3,4.46957 3.21071,3.96086 3.58579,3.58579C3.96086,3.21071 4.46957,3 5,3H16" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>Bimbingan Intensif</span>
                        </div>
                        <div class="feature-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <polyline points="9,11 12,14 22,4" stroke="currentColor" stroke-width="2"/>
                                <path d="M21,12V19C21,19.5304 20.7893,20.0391 20.4142,20.4142C20.0391,20.7893 19.5304,21 19,21H5C4.46957,21 3.96086,20.7893 3.58579,20.4142C3.21071,20.0391 3,19.5304 3,19V5C3,4.46957 3.21071,3.96086 3.58579,3.58579C3.96086,3.21071 4.46957,3 5,3H16" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>Target Hafalan Jelas</span>
                        </div>
                    </div>
                    <a href="<?php echo SITE_URL; ?>/akademik/?unit=tahfidz" class="btn btn-primary">Detail Program</a>
                </div>
            </div>
        </div>
    </section>

<?php else: ?>
    <!-- Specific Unit Detail -->
    <section class="section">
        <div class="container">
            <div class="unit-detail">
                <?php if ($unit === 'mts'): ?>
                    <!-- MTs Detail -->
                    <div class="unit-header">
                        <div class="unit-icon">
                            <svg width="80" height="80" viewBox="0 0 24 24" fill="none">
                                <path d="M22 10V6C22 4.89543 21.1046 4 20 4H4C2.89543 4 2 4.89543 2 6V10M22 10L18 14L16 12L12 16L8 12L6 14L2 10M22 10V18C22 19.1046 21.1046 20 20 20H4C2.89543 20 2 19.1046 2 18V10" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="unit-info">
                            <h1 class="unit-title">Madrasah Tsanawiyah</h1>
                            <p class="unit-subtitle">Program Pendidikan Menengah Pertama</p>
                        </div>
                    </div>
                    
                    <div class="unit-content">
                        <div class="content-section">
                            <h3>Deskripsi Program</h3>
                            <p>Madrasah Tsanawiyah (MTs) adalah jenjang pendidikan menengah pertama yang setara dengan SMP, namun dengan penekanan khusus pada pendidikan agama Islam. Program ini dirancang untuk membentuk siswa yang memiliki keseimbangan antara ilmu pengetahuan umum dan ilmu agama.</p>
                        </div>
                        
                        <div class="content-section">
                            <h3>Kurikulum</h3>
                            <div class="curriculum-grid">
                                <div class="curriculum-item">
                                    <h4>Mata Pelajaran Umum</h4>
                                    <ul>
                                        <li>Matematika</li>
                                        <li>Bahasa Indonesia</li>
                                        <li>Bahasa Inggris</li>
                                        <li>IPA (Fisika, Kimia, Biologi)</li>
                                        <li>IPS (Sejarah, Geografi, Ekonomi)</li>
                                        <li>Seni Budaya</li>
                                        <li>Pendidikan Jasmani</li>
                                    </ul>
                                </div>
                                <div class="curriculum-item">
                                    <h4>Mata Pelajaran Agama</h4>
                                    <ul>
                                        <li>Al-Qur'an Hadits</li>
                                        <li>Aqidah Akhlak</li>
                                        <li>Fiqh</li>
                                        <li>Sejarah Kebudayaan Islam</li>
                                        <li>Bahasa Arab</li>
                                        <li>Tahfidz Al-Qur'an</li>
                                        <li>Kajian Kitab Kuning</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <?php elseif ($unit === 'ma'): ?>
                    <!-- MA Detail -->
                    <div class="unit-header">
                        <div class="unit-icon">
                            <svg width="80" height="80" viewBox="0 0 24 24" fill="none">
                                <path d="M4 19.5C4 18.1193 5.11929 17 6.5 17H20" stroke="currentColor" stroke-width="2"/>
                                <path d="M6.5 2H20V22H6.5C5.11929 22 4 20.8807 4 19.5V4.5C4 3.11929 5.11929 2 6.5 2Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M8 7H16M8 11H16" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="unit-info">
                            <h1 class="unit-title">Madrasah Aliyah</h1>
                            <p class="unit-subtitle">Program Pendidikan Menengah Atas</p>
                        </div>
                    </div>
                    
                    <div class="unit-content">
                        <div class="content-section">
                            <h3>Deskripsi Program</h3>
                            <p>Madrasah Aliyah (MA) adalah jenjang pendidikan menengah atas yang setara dengan SMA, dengan fokus pada pendalaman ilmu agama Islam dan persiapan siswa untuk melanjutkan ke perguruan tinggi. Program ini mengintegrasikan kurikulum nasional dengan kurikulum khas pesantren.</p>
                        </div>
                        
                        <div class="content-section">
                            <h3>Program Peminatan</h3>
                            <div class="curriculum-grid">
                                <div class="curriculum-item">
                                    <h4>Peminatan IPA</h4>
                                    <ul>
                                        <li>Matematika Peminatan</li>
                                        <li>Fisika</li>
                                        <li>Kimia</li>
                                        <li>Biologi</li>
                                        <li>Bahasa Inggris</li>
                                    </ul>
                                </div>
                                <div class="curriculum-item">
                                    <h4>Peminatan Agama</h4>
                                    <ul>
                                        <li>Tafsir Al-Qur'an</li>
                                        <li>Hadits</li>
                                        <li>Fiqh Muqaran</li>
                                        <li>Ushul Fiqh</li>
                                        <li>Bahasa Arab Tingkat Lanjut</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <?php elseif ($unit === 'tahfidz'): ?>
                    <!-- Tahfidz Detail -->
                    <div class="unit-header">
                        <div class="unit-icon">
                            <svg width="80" height="80" viewBox="0 0 24 24" fill="none">
                                <path d="M12 6.253V16.747M7 3L17 21M17 3L7 21" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="unit-info">
                            <h1 class="unit-title">Program Tahfidz</h1>
                            <p class="unit-subtitle">Menghafal Al-Qur'an 30 Juz</p>
                        </div>
                    </div>
                    
                    <div class="unit-content">
                        <div class="content-section">
                            <h3>Deskripsi Program</h3>
                            <p>Program Tahfidz Al-Qur'an adalah program khusus untuk menghafal Al-Qur'an 30 juz dengan metode yang telah terbukti efektif. Program ini dibimbing oleh ustadz-ustadz berpengalaman dalam bidang tahfidz dengan sanad yang jelas.</p>
                        </div>
                        
                        <div class="content-section">
                            <h3>Metode Pembelajaran</h3>
                            <div class="curriculum-grid">
                                <div class="curriculum-item">
                                    <h4>Metode Talaqqi</h4>
                                    <ul>
                                        <li>Setoran hafalan langsung kepada ustadz</li>
                                        <li>Koreksi bacaan dan tajwid</li>
                                        <li>Bimbingan individual</li>
                                        <li>Evaluasi berkala</li>
                                    </ul>
                                </div>
                                <div class="curriculum-item">
                                    <h4>Target Hafalan</h4>
                                    <ul>
                                        <li>Tahun 1: 10 Juz</li>
                                        <li>Tahun 2: 20 Juz</li>
                                        <li>Tahun 3: 30 Juz (Khatam)</li>
                                        <li>Muraja'ah (Pengulangan)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Common sections for all units -->
                <div class="content-section">
                    <h3>Fasilitas</h3>
                    <div class="facilities-grid">
                        <div class="facility-item">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="currentColor" stroke-width="2"/>
                                <polyline points="9,22 9,12 15,12 15,22" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>Asrama Nyaman</span>
                        </div>
                        <div class="facility-item">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" stroke="currentColor" stroke-width="2"/>
                                <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>Perpustakaan</span>
                        </div>
                        <div class="facility-item">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                <line x1="8" y1="21" x2="16" y2="21" stroke="currentColor" stroke-width="2"/>
                                <line x1="12" y1="17" x2="12" y2="21" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>Lab Komputer</span>
                        </div>
                        <div class="facility-item">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M19 14C19.5523 14 20 13.5523 20 13V6C20 5.44772 19.5523 5 19 5H5C4.44772 5 4 5.44772 4 6V13C4 13.5523 4.44772 14 5 14H19ZM19 14V19C19 19.5523 18.5523 20 18 20H6C5.44772 20 5 19.5523 5 19V14" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>Ruang Kelas AC</span>
                        </div>
                        <div class="facility-item">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                <polygon points="10,8 16,12 10,16 10,8" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>Masjid</span>
                        </div>
                        <div class="facility-item">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="currentColor" stroke-width="2"/>
                                <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>Kantin</span>
                        </div>
                    </div>
                </div>
                
                <div class="content-section">
                    <h3>Informasi Pendaftaran</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <h4>Syarat Pendaftaran</h4>
                            <ul>
                                <li>Fotocopy Ijazah/SKHUN</li>
                                <li>Fotocopy Kartu Keluarga</li>
                                <li>Fotocopy Akta Kelahiran</li>
                                <li>Pas foto 3x4 (4 lembar)</li>
                                <li>Surat keterangan sehat</li>
                            </ul>
                        </div>
                        <div class="info-item">
                            <h4>Biaya Pendidikan</h4>
                            <ul>
                                <li>Uang Pangkal: Rp 2.500.000</li>
                                <li>SPP Bulanan: Rp 350.000</li>
                                <li>Makan 3x sehari: Rp 300.000</li>
                                <li>Asrama: Rp 200.000</li>
                                <li>Kegiatan: Rp 100.000</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Contact Section -->
<section class="section" style="background: var(--primary-color); color: white;">
    <div class="container">
        <div class="text-center">
            <h2 style="color: white; margin-bottom: 1rem;">Daftar Sekarang</h2>
            <p style="margin-bottom: 2rem; opacity: 0.9; font-size: 1.1rem;">
                Bergabunglah dengan ribuan santri yang telah merasakan pendidikan berkualitas di Dayah Ulumul Qur'an
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="tel:+6281234567890" class="btn" style="background: white; color: var(--primary-color);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="margin-right: 8px;">
                        <path d="M22 16.92V19.92C22.0011 20.1985 21.9441 20.4742 21.8325 20.7293C21.7209 20.9845 21.5573 21.2136 21.3521 21.4019C21.1468 21.5901 20.9046 21.7335 20.6407 21.8227C20.3769 21.9119 20.0974 21.9451 19.82 21.92C16.7428 21.5856 13.787 20.5341 11.19 18.85C8.77382 17.3147 6.72533 15.2662 5.18999 12.85C3.49997 10.2412 2.44824 7.27099 2.11999 4.18C2.095 3.90347 2.12787 3.62476 2.21649 3.36162C2.30512 3.09849 2.44756 2.85669 2.63476 2.65162C2.82196 2.44655 3.0498 2.28271 3.30379 2.17052C3.55777 2.05833 3.83233 2.00026 4.10999 2H7.10999C7.59531 1.99522 8.06579 2.16708 8.43376 2.48353C8.80173 2.79999 9.04207 3.23945 9.10999 3.72C9.23662 4.68007 9.47144 5.62273 9.80999 6.53C9.94454 6.88792 9.97366 7.27691 9.8939 7.65088C9.81415 8.02485 9.62886 8.36811 9.35999 8.64L8.08999 9.91C9.51355 12.4135 11.5865 14.4864 14.09 15.91L15.36 14.64C15.6319 14.3711 15.9751 14.1858 16.3491 14.1061C16.7231 14.0263 17.1121 14.0555 17.47 14.19C18.3773 14.5286 19.3199 14.7634 20.28 14.89C20.7658 14.9585 21.2094 15.2032 21.5265 15.5775C21.8437 15.9518 22.0122 16.4296 22 16.92Z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Hubungi Kami
                </a>
                <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-outline" style="border-color: white; color: white;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 8px;">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.465 3.488"/>
                    </svg>
                    WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.academic-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.academic-card {
    background: var(--white);
    border-radius: var(--border-radius);
    padding: 2rem;
    text-align: center;
    transition: var(--transition);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.academic-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}

.academic-icon {
    width: 100px;
    height: 100px;
    background: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: var(--white);
}

.academic-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.academic-subtitle {
    color: var(--primary-color);
    font-weight: 500;
    margin-bottom: 1rem;
}

.academic-description {
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.academic-features {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 2rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-dark);
    font-size: 0.9rem;
}

.feature-item svg {
    color: var(--primary-color);
    flex-shrink: 0;
}

.unit-detail {
    max-width: 1000px;
    margin: 0 auto;
}

.unit-header {
    display: flex;
    align-items: center;
    gap: 2rem;
    margin-bottom: 3rem;
    padding: 2rem;
    background: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
}

.unit-icon {
    width: 120px;
    height: 120px;
    background: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    flex-shrink: 0;
}

.unit-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.unit-subtitle {
    font-size: 1.2rem;
    color: var(--primary-color);
    font-weight: 500;
}

.unit-content {
    display: flex;
    flex-direction: column;
    gap: 3rem;
}

.content-section {
    background: var(--white);
    padding: 2rem;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
}

.content-section h3 {
    color: var(--text-dark);
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary-color);
}

.curriculum-grid,
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 1rem;
}

.curriculum-item,
.info-item {
    background: var(--light-gray);
    padding: 1.5rem;
    border-radius: 8px;
    border-left: 4px solid var(--primary-color);
}

.curriculum-item h4,
.info-item h4 {
    color: var(--text-dark);
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.curriculum-item ul,
.info-item ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.curriculum-item li,
.info-item li {
    padding: 0.5rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.5);
    position: relative;
    padding-left: 1.5rem;
}

.curriculum-item li:before,
.info-item li:before {
    content: '•';
    color: var(--primary-color);
    font-weight: bold;
    position: absolute;
    left: 0;
}

.curriculum-item li:last-child,
.info-item li:last-child {
    border-bottom: none;
}

.facilities-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-top: 1rem;
}

.facility-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--light-gray);
    border-radius: 8px;
    transition: var(--transition);
}

.facility-item:hover {
    background: rgba(45, 125, 50, 0.1);
    transform: translateY(-2px);
}

.facility-item svg {
    color: var(--primary-color);
    flex-shrink: 0;
}

.breadcrumb {
    background: var(--light-gray);
    padding: 1rem 0;
    margin-top: 80px;
}

.breadcrumb ol {
    display: flex;
    align-items: center;
    list-style: none;
    margin: 0;
    padding: 0;
}

.breadcrumb li {
    display: flex;
    align-items: center;
}

.breadcrumb li:not(:last-child)::after {
    content: '/';
    margin: 0 0.5rem;
    color: var(--gray);
}

.breadcrumb a {
    color: var(--primary-color);
    text-decoration: none;
    transition: var(--transition);
}

.breadcrumb a:hover {
    color: var(--primary-dark);
}

.breadcrumb .active {
    color: var(--text-light);
}

@media (max-width: 768px) {
    .academic-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .academic-card {
        padding: 1.5rem;
    }
    
    .academic-icon {
        width: 80px;
        height: 80px;
    }
    
    .unit-header {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .unit-icon {
        width: 100px;
        height: 100px;
    }
    
    .unit-title {
        font-size: 2rem;
    }
    
    .curriculum-grid,
    .info-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .facilities-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }
    
    .content-section {
        padding: 1.5rem;
    }
}

@media (max-width: 480px) {
    .academic-card {
        padding: 1rem;
    }
    
    .academic-title {
        font-size: 1.3rem;
    }
    
    .unit-title {
        font-size: 1.8rem;
    }
    
    .facility-item {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
}
</style>

<?php include '../inc/footer.php'; ?>
