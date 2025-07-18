<?php
if (!defined('SITE_NAME')) {
    require_once dirname(__DIR__) . '/config/config.php';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : SITE_DESCRIPTION; ?>">
    <meta name="keywords" content="dayah, pesantren, pendidikan islam, aceh tengah, bebesen, ulumul quran">
    <meta name="author" content="<?php echo SITE_NAME; ?>">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME; ?>">
    <meta property="og:description" content="<?php echo isset($page_description) ? $page_description : SITE_DESCRIPTION; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:image" content="<?php echo SITE_URL; ?>/img/logo.png">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME; ?>">
    <meta name="twitter:description" content="<?php echo isset($page_description) ? $page_description : SITE_DESCRIPTION; ?>">
    <meta name="twitter:image" content="<?php echo SITE_URL; ?>/img/logo.png">
    
    <title><?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME; ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL; ?>/img/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo SITE_URL; ?>/img/apple-touch-icon.png">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/responsive.css">
    <?php if (isset($additional_css)): ?>
        <?php foreach ($additional_css as $css): ?>
            <link rel="stylesheet" href="<?php echo $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- Preload important resources -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" as="style">
    <link rel="preload" href="<?php echo SITE_URL; ?>/js/main.js" as="script">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Additional head content -->
    <?php if (isset($additional_head)): ?>
        <?php echo $additional_head; ?>
    <?php endif; ?>
</head>
<body class="<?php echo isset($body_class) ? $body_class : ''; ?>">
    
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <!-- Logo -->
                <a href="<?php echo SITE_URL; ?>" class="logo">
                    <img src="<?php echo SITE_URL; ?>/img/logo.png" alt="<?php echo SITE_NAME; ?>" onerror="this.style.display='none'">
                    <span>Dayah Quba'</span>
                </a>
                
                <!-- Navigation -->
                <nav class="nav">
                    <div class="nav-item">
                        <a href="<?php echo SITE_URL; ?>" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php' && !isset($_GET['page'])) ? 'active' : ''; ?>">
                            Home
                        </a>
                    </div>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link">
                            Tentang
                            <svg width="12" height="8" viewBox="0 0 12 8" fill="none" style="margin-left: 5px;">
                                <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <div class="dropdown-menu">
                            <a href="<?php echo SITE_URL; ?>/tentang/?page=visi-misi" class="dropdown-item">Visi & Misi</a>
                            <a href="<?php echo SITE_URL; ?>/tentang/?page=sejarah" class="dropdown-item">Sejarah</a>
                            <a href="<?php echo SITE_URL; ?>/yayasan/" class="dropdown-item">Profil Yayasan</a>
                        </div>
                    </div>
                    
                    <div class="nav-item">
                        <a href="<?php echo SITE_URL; ?>/struktur/" class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], '/struktur/') !== false) ? 'active' : ''; ?>">
                            Struktur
                        </a>
                    </div>
                    
                    <div class="nav-item">
                        <a href="<?php echo SITE_URL; ?>/berita/" class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], '/berita/') !== false) ? 'active' : ''; ?>">
                            Berita
                        </a>
                    </div>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link">
                            Akademik
                            <svg width="12" height="8" viewBox="0 0 12 8" fill="none" style="margin-left: 5px;">
                                <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <div class="dropdown-menu">
                            <a href="<?php echo SITE_URL; ?>/akademik/?unit=mts" class="dropdown-item">MTs</a>
                            <a href="<?php echo SITE_URL; ?>/akademik/?unit=ma" class="dropdown-item">MA</a>
                            <a href="<?php echo SITE_URL; ?>/akademik/?unit=tahfidz" class="dropdown-item">Tahfidz</a>
                        </div>
                    </div>
                    
                    <div class="nav-item">
                        <a href="<?php echo SITE_URL; ?>/agenda/" class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], '/agenda/') !== false) ? 'active' : ''; ?>">
                            Agenda
                        </a>
                    </div>
                    
                    <div class="nav-item">
                        <a href="<?php echo SITE_URL; ?>/pengajar/" class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], '/pengajar/') !== false) ? 'active' : ''; ?>">
                            Pengajar
                        </a>
                    </div>
                    
                    <div class="nav-item">
                        <a href="<?php echo SITE_URL; ?>/galeri/" class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], '/galeri/') !== false) ? 'active' : ''; ?>">
                            Galeri
                        </a>
                    </div>
                </nav>
                
                <!-- Admin Login Button -->
                <a href="<?php echo SITE_URL; ?>/admin/" class="admin-login">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-right: 5px;">
                        <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Admin
                </a>
                
                <!-- Mobile Menu Toggle -->
                <div class="mobile-menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="main-content">
