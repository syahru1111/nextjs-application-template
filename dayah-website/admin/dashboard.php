<?php
require_once '../config/config.php';
require_once '../inc/functions.php';

// Check if user is logged in
requireLogin();

$page_title = 'Dashboard Admin';

// Get statistics for dashboard
try {
    $pdo = getDB();
    
    // Count statistics
    $stats = [
        'berita' => $pdo->query("SELECT COUNT(*) FROM berita")->fetchColumn(),
        'struktur' => $pdo->query("SELECT COUNT(*) FROM struktur WHERE status = 'aktif'")->fetchColumn(),
        'pengajar' => $pdo->query("SELECT COUNT(*) FROM pengajar WHERE status = 'aktif'")->fetchColumn(),
        'galeri' => $pdo->query("SELECT COUNT(*) FROM galeri")->fetchColumn(),
        'agenda' => $pdo->query("SELECT COUNT(*) FROM agenda WHERE tanggal >= CURDATE()")->fetchColumn(),
        'testimoni' => $pdo->query("SELECT COUNT(*) FROM testimoni WHERE status = 'aktif'")->fetchColumn()
    ];
    
    // Get recent activities
    $recentNews = $pdo->query("SELECT judul, created_at FROM berita ORDER BY created_at DESC LIMIT 5")->fetchAll();
    $upcomingAgenda = $pdo->query("SELECT judul, tanggal FROM agenda WHERE tanggal >= CURDATE() ORDER BY tanggal ASC LIMIT 5")->fetchAll();
    
} catch(PDOException $e) {
    $stats = array_fill_keys(['berita', 'struktur', 'pengajar', 'galeri', 'agenda', 'testimoni'], 0);
    $recentNews = [];
    $upcomingAgenda = [];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title . ' - ' . SITE_NAME; ?></title>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/responsive.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            background: var(--light-gray);
            padding-top: 0;
        }
        
        .admin-header {
            background: var(--white);
            box-shadow: var(--shadow);
            padding: 1rem 0;
            margin-bottom: 2rem;
        }
        
        .admin-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .admin-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .admin-user {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .admin-menu {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: var(--light-gray);
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-dark);
            transition: var(--transition);
        }
        
        .menu-item:hover {
            background: var(--primary-color);
            color: var(--white);
            transform: translateY(-2px);
        }
        
        .menu-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: var(--white);
        }
        
        .menu-item:hover .menu-icon {
            background: var(--white);
            color: var(--primary-color);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: var(--white);
            padding: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            text-align: center;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: var(--text-light);
            font-weight: 500;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }
        
        .dashboard-card {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .activity-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-title {
            font-weight: 500;
            color: var(--text-dark);
        }
        
        .activity-date {
            font-size: 0.875rem;
            color: var(--text-light);
        }
        
        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .menu-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
            
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }
    </style>
</head>
<body>
    <!-- Admin Header -->
    <header class="admin-header">
        <div class="container">
            <div class="admin-nav">
                <div class="admin-logo">Admin Panel - Dayah Quba'</div>
                <div class="admin-user">
                    <span>Selamat datang, <?php echo htmlspecialchars($_SESSION['admin_nama']); ?></span>
                    <a href="<?php echo SITE_URL; ?>/admin/logout.php" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </header>
    
    <div class="container">
        <!-- Quick Menu -->
        <div class="admin-menu">
            <h3 style="margin-bottom: 1rem;">Menu Utama</h3>
            <div class="menu-grid">
                <a href="<?php echo SITE_URL; ?>/admin/berita/" class="menu-item">
                    <div class="menu-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" stroke="currentColor" stroke-width="2"/>
                            <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2"/>
                            <line x1="16" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="2"/>
                            <line x1="16" y1="17" x2="8" y2="17" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600;">Kelola Berita</div>
                        <div style="font-size: 0.875rem; opacity: 0.7;">Tambah & edit berita</div>
                    </div>
                </a>
                
                <a href="<?php echo SITE_URL; ?>/admin/struktur/" class="menu-item">
                    <div class="menu-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="currentColor" stroke-width="2"/>
                            <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                            <path d="M23 21V19C23 18.1645 22.7155 17.3541 22.2094 16.7018C21.7033 16.0495 20.9999 15.5902 20.2 15.3779" stroke="currentColor" stroke-width="2"/>
                            <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89317 18.7122 8.75608 18.1676 9.45768C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600;">Struktur Organisasi</div>
                        <div style="font-size: 0.875rem; opacity: 0.7;">Kelola struktur</div>
                    </div>
                </a>
                
                <a href="<?php echo SITE_URL; ?>/admin/pengajar/" class="menu-item">
                    <div class="menu-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2"/>
                            <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600;">Data Pengajar</div>
                        <div style="font-size: 0.875rem; opacity: 0.7;">Kelola pengajar</div>
                    </div>
                </a>
                
                <a href="<?php echo SITE_URL; ?>/admin/galeri/" class="menu-item">
                    <div class="menu-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5" stroke="currentColor" stroke-width="2"/>
                            <polyline points="21,15 16,10 5,21" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600;">Galeri</div>
                        <div style="font-size: 0.875rem; opacity: 0.7;">Kelola galeri foto</div>
                    </div>
                </a>
                
                <a href="<?php echo SITE_URL; ?>/admin/agenda/" class="menu-item">
                    <div class="menu-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                            <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2"/>
                            <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2"/>
                            <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600;">Agenda</div>
                        <div style="font-size: 0.875rem; opacity: 0.7;">Kelola agenda kegiatan</div>
                    </div>
                </a>
                
                <a href="<?php echo SITE_URL; ?>/admin/testimoni/" class="menu-item">
                    <div class="menu-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600;">Testimoni</div>
                        <div style="font-size: 0.875rem; opacity: 0.7;">Kelola testimoni alumni</div>
                    </div>
                </a>
            </div>
        </div>
        
        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['berita']; ?></div>
                <div class="stat-label">Total Berita</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['struktur']; ?></div>
                <div class="stat-label">Struktur Aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['pengajar']; ?></div>
                <div class="stat-label">Pengajar Aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['galeri']; ?></div>
                <div class="stat-label">Foto Galeri</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['agenda']; ?></div>
                <div class="stat-label">Agenda Mendatang</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['testimoni']; ?></div>
                <div class="stat-label">Testimoni Aktif</div>
            </div>
        </div>
        
        <!-- Dashboard Content -->
        <div class="dashboard-grid">
            <!-- Recent News -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3 class="card-title">Berita Terbaru</h3>
                    <a href="<?php echo SITE_URL; ?>/admin/berita/" class="btn btn-primary">Kelola</a>
                </div>
                <div class="card-content">
                    <?php if (!empty($recentNews)): ?>
                        <?php foreach ($recentNews as $news): ?>
                            <div class="activity-item">
                                <div class="activity-title"><?php echo htmlspecialchars($news['judul']); ?></div>
                                <div class="activity-date"><?php echo formatDate($news['created_at']); ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="text-align: center; color: var(--text-light); padding: 2rem;">Belum ada berita</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Upcoming Agenda -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3 class="card-title">Agenda Mendatang</h3>
                    <a href="<?php echo SITE_URL; ?>/admin/agenda/" class="btn btn-primary">Kelola</a>
                </div>
                <div class="card-content">
                    <?php if (!empty($upcomingAgenda)): ?>
                        <?php foreach ($upcomingAgenda as $agenda): ?>
                            <div class="activity-item">
                                <div class="activity-title"><?php echo htmlspecialchars($agenda['judul']); ?></div>
                                <div class="activity-date"><?php echo formatDate($agenda['tanggal']); ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="text-align: center; color: var(--text-light); padding: 2rem;">Belum ada agenda</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div style="margin-top: 2rem; text-align: center;">
            <a href="<?php echo SITE_URL; ?>" class="btn btn-outline" target="_blank">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-right: 5px;">
                    <path d="M18 13V6C18 5.46957 17.7893 4.96086 17.4142 4.58579C17.0391 4.21071 16.5304 4 16 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V18C2 18.5304 2.21071 19.0391 2.58579 19.4142C2.96086 19.7893 3.46957 20 4 20H16C16.5304 20 17.0391 19.7893 17.4142 19.4142C17.7893 19.0391 18 18.5304 18 18V13Z" stroke="currentColor" stroke-width="2"/>
                    <polyline points="8,10 12,14 16,10" stroke="currentColor" stroke-width="2"/>
                </svg>
                Lihat Website
            </a>
        </div>
    </div>
</body>
</html>
