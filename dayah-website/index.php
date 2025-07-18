<?php
require_once 'config/config.php';
require_once 'inc/functions.php';

// Page meta data
$page_title = 'Beranda';
$page_description = 'Dayah Ulumul Qur\'an Yayasan Quba\' Bebesen - Lembaga Pendidikan Islam Terdepan di Aceh Tengah';

// Get data for homepage
$sliderImages = getSliderImages();
$statistics = getStatistics();
$latestNews = getLatestNews(3);
$upcomingAgenda = getUpcomingAgenda(3);
$galleryImages = getGallery(6);

include 'inc/header.php';
?>

<!-- Hero Section with Slider -->
<section class="hero">
    <div class="hero-slider">
        <?php if (!empty($sliderImages)): ?>
            <?php foreach ($sliderImages as $index => $slide): ?>
                <div class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>" 
                     style="background-image: url('<?php echo getImageUrl('slider/' . $slide['gambar'], 'hero-bg.jpg'); ?>');">
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="hero-slide active" style="background-image: url('<?php echo SITE_URL; ?>/img/hero-bg.jpg');"></div>
        <?php endif; ?>
    </div>
    
    <div class="hero-overlay"></div>
    
    <div class="hero-content">
        <h1 class="hero-title">Selamat Datang di<br>Dayah Ulumul Qur'an</h1>
        <p class="hero-subtitle">Yayasan Quba' Bebesen - Membentuk Generasi Qur'ani yang Berakhlak Mulia</p>
        <a href="#about" class="hero-cta">Pelajari Lebih Lanjut</a>
    </div>
</section>

<!-- Statistics Section -->
<section class="stats">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card glass">
                <div class="stat-number"><?php echo number_format($statistics['santri_putra']); ?></div>
                <div class="stat-label">Santri Putra</div>
            </div>
            <div class="stat-card glass">
                <div class="stat-number"><?php echo number_format($statistics['santri_putri']); ?></div>
                <div class="stat-label">Santri Putri</div>
            </div>
            <div class="stat-card glass">
                <div class="stat-number"><?php echo number_format($statistics['total_santri']); ?></div>
                <div class="stat-label">Total Santri</div>
            </div>
            <div class="stat-card glass">
                <div class="stat-number"><?php echo number_format($statistics['total_pengajar']); ?></div>
                <div class="stat-label">Tenaga Pengajar</div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Tentang Dayah Kami</h2>
            <p class="section-subtitle">Lembaga pendidikan Islam yang berkomitmen mencetak generasi Qur'ani</p>
        </div>
        
        <div class="grid grid-2">
            <div class="card glass">
                <div class="card-body">
                    <h3 class="card-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" style="margin-right: 10px; color: var(--primary-color);">
                            <path d="M15 3H6C4.89543 3 4 3.89543 4 5V19C4 20.1046 4.89543 21 6 21H18C19.1046 21 20 20.1046 20 19V8L15 3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <polyline points="15,3 15,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Visi Kami
                    </h3>
                    <p class="card-text"><?php echo nl2br(getAboutContent('visi')); ?></p>
                </div>
            </div>
            
            <div class="card glass">
                <div class="card-body">
                    <h3 class="card-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" style="margin-right: 10px; color: var(--primary-color);">
                            <path d="M9 11H15M9 15H15M17 21L20 18V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V18C4 19.1046 4.89543 20 6 20H17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Misi Kami
                    </h3>
                    <p class="card-text"><?php echo nl2br(getAboutContent('misi')); ?></p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="<?php echo SITE_URL; ?>/tentang/" class="btn btn-primary">Selengkapnya</a>
        </div>
    </div>
</section>

<!-- Academic Units Section -->
<section class="section" style="background: var(--light-gray);">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Unit Pendidikan</h2>
            <p class="section-subtitle">Program pendidikan yang tersedia di Dayah Ulumul Qur'an</p>
        </div>
        
        <div class="grid grid-3">
            <div class="card">
                <div class="card-body">
                    <div style="text-align: center; margin-bottom: 1rem;">
                        <div style="width: 60px; height: 60px; background: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                                <path d="M22 10V6C22 4.89543 21.1046 4 20 4H4C2.89543 4 2 4.89543 2 6V10M22 10L18 14L16 12L12 16L8 12L6 14L2 10M22 10V18C22 19.1046 21.1046 20 20 20H4C2.89543 20 2 19.1046 2 18V10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="card-title text-center">Madrasah Tsanawiyah</h3>
                    <p class="card-text text-center">Program pendidikan setingkat SMP dengan kurikulum yang memadukan ilmu agama dan umum.</p>
                    <div class="text-center">
                        <a href="<?php echo SITE_URL; ?>/akademik/?unit=mts" class="btn btn-outline">Detail Program</a>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <div style="text-align: center; margin-bottom: 1rem;">
                        <div style="width: 60px; height: 60px; background: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                                <path d="M4 19.5C4 18.1193 5.11929 17 6.5 17H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.5 2H20V22H6.5C5.11929 22 4 20.8807 4 19.5V4.5C4 3.11929 5.11929 2 6.5 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8 7H16M8 11H16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="card-title text-center">Madrasah Aliyah</h3>
                    <p class="card-text text-center">Program pendidikan setingkat SMA dengan fokus pada pendalaman ilmu agama dan persiapan perguruan tinggi.</p>
                    <div class="text-center">
                        <a href="<?php echo SITE_URL; ?>/akademik/?unit=ma" class="btn btn-outline">Detail Program</a>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <div style="text-align: center; margin-bottom: 1rem;">
                        <div style="width: 60px; height: 60px; background: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                                <path d="M12 6.253V16.747M7 3L17 21M17 3L7 21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="card-title text-center">Program Tahfidz</h3>
                    <p class="card-text text-center">Program khusus menghafal Al-Qur'an dengan metode pembelajaran yang efektif dan teruji.</p>
                    <div class="text-center">
                        <a href="<?php echo SITE_URL; ?>/akademik/?unit=tahfidz" class="btn btn-outline">Detail Program</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest News Section -->
<?php if (!empty($latestNews)): ?>
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Berita Terbaru</h2>
            <p class="section-subtitle">Informasi dan kabar terkini dari Dayah Ulumul Qur'an</p>
        </div>
        
        <div class="grid grid-3">
            <?php foreach ($latestNews as $news): ?>
                <article class="card">
                    <?php if ($news['gambar']): ?>
                        <img src="<?php echo getImageUrl('berita/' . $news['gambar']); ?>" 
                             alt="<?php echo htmlspecialchars($news['judul']); ?>" 
                             class="card-img">
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="card-meta">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-right: 5px;">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2"/>
                                <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2"/>
                                <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <?php echo formatDate($news['created_at']); ?>
                        </div>
                        <h3 class="card-title">
                            <a href="<?php echo SITE_URL; ?>/berita/detail.php?slug=<?php echo $news['slug']; ?>" 
                               style="color: inherit; text-decoration: none;">
                                <?php echo htmlspecialchars($news['judul']); ?>
                            </a>
                        </h3>
                        <p class="card-text">
                            <?php echo truncateText($news['ringkasan'] ?: strip_tags($news['isi'])); ?>
                        </p>
                        <a href="<?php echo SITE_URL; ?>/berita/detail.php?slug=<?php echo $news['slug']; ?>" 
                           class="btn btn-primary">Baca Selengkapnya</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="<?php echo SITE_URL; ?>/berita/" class="btn btn-outline">Lihat Semua Berita</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Upcoming Agenda Section -->
<?php if (!empty($upcomingAgenda)): ?>
<section class="section" style="background: var(--light-gray);">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Agenda Mendatang</h2>
            <p class="section-subtitle">Kegiatan dan acara yang akan datang</p>
        </div>
        
        <div class="grid grid-3">
            <?php foreach ($upcomingAgenda as $agenda): ?>
                <div class="card glass">
                    <div class="card-body">
                        <div class="card-meta">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-right: 5px;">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2"/>
                                <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2"/>
                                <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <?php echo formatDate($agenda['tanggal']); ?>
                            <?php if ($agenda['waktu']): ?>
                                - <?php echo date('H:i', strtotime($agenda['waktu'])); ?>
                            <?php endif; ?>
                        </div>
                        <h3 class="card-title"><?php echo htmlspecialchars($agenda['judul']); ?></h3>
                        <p class="card-text"><?php echo truncateText($agenda['isi']); ?></p>
                        <?php if ($agenda['tempat']): ?>
                            <p class="card-text">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-right: 5px;">
                                    <path d="M21 10C21 17 12 23 12 23S3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.3639 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="currentColor" stroke-width="2"/>
                                    <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                <strong><?php echo htmlspecialchars($agenda['tempat']); ?></strong>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="<?php echo SITE_URL; ?>/agenda/" class="btn btn-primary">Lihat Semua Agenda</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Gallery Preview Section -->
<?php if (!empty($galleryImages)): ?>
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Galeri Kegiatan</h2>
            <p class="section-subtitle">Dokumentasi kegiatan dan fasilitas Dayah</p>
        </div>
        
        <div class="grid grid-3">
            <?php foreach ($galleryImages as $image): ?>
                <div class="card">
                    <img src="<?php echo getImageUrl('galeri/' . $image['gambar']); ?>" 
                         alt="<?php echo htmlspecialchars($image['judul']); ?>" 
                         class="card-img"
                         style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo htmlspecialchars($image['judul']); ?></h4>
                        <?php if ($image['deskripsi']): ?>
                            <p class="card-text"><?php echo truncateText($image['deskripsi']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="<?php echo SITE_URL; ?>/galeri/" class="btn btn-outline">Lihat Galeri Lengkap</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Contact CTA Section -->
<section class="section" style="background: linear-gradient(135deg, var(--primary-color), var(--primary-light)); color: white;">
    <div class="container">
        <div class="text-center">
            <h2 style="color: white; margin-bottom: 1rem;">Bergabunglah dengan Kami</h2>
            <p style="font-size: 1.2rem; margin-bottom: 2rem; opacity: 0.9;">
                Wujudkan impian menjadi generasi Qur'ani yang berakhlak mulia
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="tel:+6281234567890" class="btn" style="background: white; color: var(--primary-color);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="margin-right: 8px;">
                        <path d="M22 16.92V19.92C22.0011 20.1985 21.9441 20.4742 21.8325 20.7293C21.7209 20.9845 21.5573 21.2136 21.3521 21.4019C21.1468 21.5901 20.9046 21.7335 20.6407 21.8227C20.3769 21.9119 20.0974 21.9451 19.82 21.92C16.7428 21.5856 13.787 20.5341 11.19 18.85C8.77382 17.3147 6.72533 15.2662 5.18999 12.85C3.49997 10.2412 2.44824 7.27099 2.11999 4.18C2.095 3.90347 2.12787 3.62476 2.21649 3.36162C2.30512 3.09849 2.44756 2.85669 2.63476 2.65162C2.82196 2.44655 3.0498 2.28271 3.30379 2.17052C3.55777 2.05833 3.83233 2.00026 4.10999 2H7.10999C7.59531 1.99522 8.06579 2.16708 8.43376 2.48353C8.80173 2.79999 9.04207 3.23945 9.10999 3.72C9.23662 4.68007 9.47144 5.62273 9.80999 6.53C9.94454 6.88792 9.97366 7.27691 9.8939 7.65088C9.81415 8.02485 9.62886 8.36811 9.35999 8.64L8.08999 9.91C9.51355 12.4135 11.5865 14.4864 14.09 15.91L15.36 14.64C15.6319 14.3711 15.9751 14.1858 16.3491 14.1061C16.7231 14.0263 17.1121 14.0555 17.47 14.19C18.3773 14.5286 19.3199 14.7634 20.28 14.89C20.7658 14.9585 21.2094 15.2032 21.5265 15.5775C21.8437 15.9518 22.0122 16.4296 22 16.92Z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Hubungi Kami
                </a>
                <a href="mailto:info@dayahquba.com" class="btn btn-outline" style="border-color: white; color: white;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="margin-right: 8px;">
                        <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2"/>
                        <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Kirim Email
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'inc/footer.php'; ?>
