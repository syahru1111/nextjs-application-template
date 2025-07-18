<?php
require_once '../config/config.php';
require_once '../inc/functions.php';

// Get page parameter
$page = $_GET['page'] ?? 'visi-misi';

// Page meta data based on page type
switch ($page) {
    case 'sejarah':
        $page_title = 'Sejarah';
        $page_description = 'Sejarah berdirinya Dayah Ulumul Qur\'an Yayasan Quba\' Bebesen';
        break;
    case 'visi-misi':
    default:
        $page_title = 'Visi & Misi';
        $page_description = 'Visi dan Misi Dayah Ulumul Qur\'an Yayasan Quba\' Bebesen';
        $page = 'visi-misi';
        break;
}

// Get content
$visi = getAboutContent('visi');
$misi = getAboutContent('misi');
$sejarah = getAboutContent('sejarah');

// Breadcrumb
$breadcrumb = generateBreadcrumb([
    ['title' => 'Beranda', 'url' => SITE_URL],
    ['title' => 'Tentang Kami', 'url' => SITE_URL . '/tentang/'],
    ['title' => $page_title]
]);

include '../inc/header.php';
?>

<!-- Breadcrumb -->
<?php echo $breadcrumb; ?>

<!-- About Section -->
<section class="section">
    <div class="container">
        <div class="about-navigation" style="margin-bottom: 3rem;">
            <div class="nav-tabs">
                <a href="<?php echo SITE_URL; ?>/tentang/?page=visi-misi" 
                   class="nav-tab <?php echo $page === 'visi-misi' ? 'active' : ''; ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="margin-right: 8px;">
                        <path d="M15 3H6C4.89543 3 4 3.89543 4 5V19C4 20.1046 4.89543 21 6 21H18C19.1046 21 20 20.1046 20 19V8L15 3Z" stroke="currentColor" stroke-width="2"/>
                        <polyline points="15,3 15,8 20,8" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Visi & Misi
                </a>
                <a href="<?php echo SITE_URL; ?>/tentang/?page=sejarah" 
                   class="nav-tab <?php echo $page === 'sejarah' ? 'active' : ''; ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="margin-right: 8px;">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                        <polyline points="12,6 12,12 16,14" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Sejarah
                </a>
            </div>
        </div>
        
        <?php if ($page === 'visi-misi'): ?>
            <!-- Visi Misi Content -->
            <div class="section-header">
                <h1 class="section-title">Visi & Misi</h1>
                <p class="section-subtitle">Landasan dan arah pengembangan Dayah Ulumul Qur'an</p>
            </div>
            
            <div class="about-content">
                <div class="grid grid-2" style="gap: 3rem; align-items: start;">
                    <!-- Visi -->
                    <div class="about-card glass">
                        <div class="card-header">
                            <div class="card-icon">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                                    <path d="M1 12S5 4 12 4S23 12 23 12S19 20 12 20S1 12 1 12Z" stroke="currentColor" stroke-width="2"/>
                                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>
                            <h2 class="card-title">Visi Kami</h2>
                        </div>
                        <div class="card-content">
                            <p class="visi-text"><?php echo nl2br(htmlspecialchars($visi)); ?></p>
                        </div>
                    </div>
                    
                    <!-- Misi -->
                    <div class="about-card glass">
                        <div class="card-header">
                            <div class="card-icon">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                                    <path d="M14.828 14.828C15.5 14.157 16 13.207 16 12.071C16 9.785 14.214 8 11.929 8C10.793 8 9.843 8.5 9.172 9.172M14.828 14.828L19.071 19.071M14.828 14.828C14.157 15.5 13.207 16 12.071 16C9.785 16 8 14.214 8 11.929C8 10.793 8.5 9.843 9.172 9.172M14.828 14.828L9.172 9.172M19.071 19.071L21 21M19.071 19.071C20.4142 17.7279 21 15.9353 21 14C21 9.029 16.971 5 12 5C10.0647 5 8.27208 5.58579 6.929 6.929M9.172 9.172L6.929 6.929M6.929 6.929L5 5M6.929 6.929C5.58579 8.27208 5 10.0647 5 12C5 16.971 9.029 21 14 21C15.9353 21 17.7279 20.4142 19.071 19.071" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>
                            <h2 class="card-title">Misi Kami</h2>
                        </div>
                        <div class="card-content">
                            <div class="misi-list">
                                <?php 
                                $misiItems = explode("\n", $misi);
                                foreach ($misiItems as $item): 
                                    $item = trim($item);
                                    if (!empty($item)):
                                ?>
                                    <div class="misi-item">
                                        <div class="misi-number">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                                <polyline points="9,11 12,14 22,4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M21,12V19C21,19.5304 20.7893,20.0391 20.4142,20.4142C20.0391,20.7893 19.5304,21 19,21H5C4.46957,21 3.96086,20.7893 3.58579,20.4142C3.21071,20.0391 3,19.5304 3,19V5C3,4.46957 3.21071,3.96086 3.58579,3.58579C3.96086,3.21071 4.46957,3 5,3H16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <span><?php echo htmlspecialchars($item); ?></span>
                                    </div>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php elseif ($page === 'sejarah'): ?>
            <!-- Sejarah Content -->
            <div class="section-header">
                <h1 class="section-title">Sejarah</h1>
                <p class="section-subtitle">Perjalanan berdirinya Dayah Ulumul Qur'an</p>
            </div>
            
            <div class="about-content">
                <div class="sejarah-card glass">
                    <div class="card-header">
                        <div class="card-icon">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h2 class="card-title">Sejarah Dayah Ulumul Qur'an</h2>
                    </div>
                    <div class="card-content">
                        <div class="sejarah-text">
                            <?php echo nl2br(htmlspecialchars($sejarah)); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Call to Action -->
        <div class="about-cta" style="margin-top: 4rem; text-align: center; padding: 3rem; background: linear-gradient(135deg, var(--primary-color), var(--primary-light)); border-radius: var(--border-radius); color: white;">
            <h3 style="color: white; margin-bottom: 1rem; font-size: 1.8rem;">Bergabunglah dengan Kami</h3>
            <p style="margin-bottom: 2rem; opacity: 0.9; font-size: 1.1rem;">
                Wujudkan impian menjadi bagian dari generasi Qur'ani yang berakhlak mulia
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo SITE_URL; ?>/akademik/" class="btn" style="background: white; color: var(--primary-color);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="margin-right: 8px;">
                        <path d="M22 10V6C22 4.89543 21.1046 4 20 4H4C2.89543 4 2 4.89543 2 6V10M22 10L18 14L16 12L12 16L8 12L6 14L2 10M22 10V18C22 19.1046 21.1046 20 20 20H4C2.89543 20 2 19.1046 2 18V10" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Lihat Program
                </a>
                <a href="tel:+6281234567890" class="btn btn-outline" style="border-color: white; color: white;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="margin-right: 8px;">
                        <path d="M22 16.92V19.92C22.0011 20.1985 21.9441 20.4742 21.8325 20.7293C21.7209 20.9845 21.5573 21.2136 21.3521 21.4019C21.1468 21.5901 20.9046 21.7335 20.6407 21.8227C20.3769 21.9119 20.0974 21.9451 19.82 21.92C16.7428 21.5856 13.787 20.5341 11.19 18.85C8.77382 17.3147 6.72533 15.2662 5.18999 12.85C3.49997 10.2412 2.44824 7.27099 2.11999 4.18C2.095 3.90347 2.12787 3.62476 2.21649 3.36162C2.30512 3.09849 2.44756 2.85669 2.63476 2.65162C2.82196 2.44655 3.0498 2.28271 3.30379 2.17052C3.55777 2.05833 3.83233 2.00026 4.10999 2H7.10999C7.59531 1.99522 8.06579 2.16708 8.43376 2.48353C8.80173 2.79999 9.04207 3.23945 9.10999 3.72C9.23662 4.68007 9.47144 5.62273 9.80999 6.53C9.94454 6.88792 9.97366 7.27691 9.8939 7.65088C9.81415 8.02485 9.62886 8.36811 9.35999 8.64L8.08999 9.91C9.51355 12.4135 11.5865 14.4864 14.09 15.91L15.36 14.64C15.6319 14.3711 15.9751 14.1858 16.3491 14.1061C16.7231 14.0263 17.1121 14.0555 17.47 14.19C18.3773 14.5286 19.3199 14.7634 20.28 14.89C20.7658 14.9585 21.2094 15.2032 21.5265 15.5775C21.8437 15.9518 22.0122 16.4296 22 16.92Z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.nav-tabs {
    display: flex;
    gap: 0.5rem;
    background: var(--white);
    padding: 0.5rem;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    flex-wrap: wrap;
}

.nav-tab {
    display: flex;
    align-items: center;
    padding: 1rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    color: var(--text-light);
    font-weight: 500;
    transition: var(--transition);
    flex: 1;
    justify-content: center;
    min-width: 150px;
}

.nav-tab:hover {
    background: var(--light-gray);
    color: var(--text-dark);
}

.nav-tab.active {
    background: var(--primary-color);
    color: var(--white);
}

.about-card,
.sejarah-card {
    background: var(--white);
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: var(--shadow);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.card-header {
    display: flex;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--light-gray);
}

.card-icon {
    width: 60px;
    height: 60px;
    background: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    color: var(--white);
    flex-shrink: 0;
}

.card-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-dark);
    margin: 0;
}

.visi-text {
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--text-dark);
    font-style: italic;
    text-align: center;
    padding: 1rem;
    background: var(--light-gray);
    border-radius: 8px;
    border-left: 4px solid var(--primary-color);
}

.misi-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.misi-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: var(--light-gray);
    border-radius: 8px;
    transition: var(--transition);
}

.misi-item:hover {
    background: rgba(45, 125, 50, 0.1);
    transform: translateX(5px);
}

.misi-number {
    width: 30px;
    height: 30px;
    background: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    flex-shrink: 0;
}

.sejarah-text {
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--text-dark);
    text-align: justify;
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
    .nav-tabs {
        flex-direction: column;
    }
    
    .nav-tab {
        min-width: auto;
    }
    
    .grid-2 {
        grid-template-columns: 1fr !important;
        gap: 2rem !important;
    }
    
    .about-card,
    .sejarah-card {
        padding: 1.5rem;
    }
    
    .card-header {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .card-icon {
        margin-right: 0;
    }
    
    .card-title {
        font-size: 1.3rem;
    }
    
    .about-cta {
        padding: 2rem 1rem !important;
    }
    
    .about-cta h3 {
        font-size: 1.5rem !important;
    }
    
    .about-cta div {
        flex-direction: column !important;
        align-items: center;
    }
    
    .about-cta .btn {
        width: 100%;
        max-width: 250px;
    }
}

@media (max-width: 480px) {
    .misi-item {
        flex-direction: column;
        text-align: center;
    }
    
    .visi-text {
        font-size: 1rem;
        padding: 0.8rem;
    }
    
    .sejarah-text {
        font-size: 1rem;
    }
}
</style>

<?php include '../inc/footer.php'; ?>
