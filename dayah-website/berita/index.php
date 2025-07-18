<?php
require_once '../config/config.php';
require_once '../inc/functions.php';

// Page meta data
$page_title = 'Berita Terbaru';
$page_description = 'Kumpulan berita dan informasi terbaru dari Dayah Ulumul Qur\'an Yayasan Quba\' Bebesen';

// Get current page
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Get news with pagination
$newsData = getAllNews($currentPage);
$news = $newsData['data'];
$totalPages = $newsData['pages'];

// Breadcrumb
$breadcrumb = generateBreadcrumb([
    ['title' => 'Beranda', 'url' => SITE_URL],
    ['title' => 'Berita']
]);

include '../inc/header.php';
?>

<!-- Breadcrumb -->
<?php echo $breadcrumb; ?>

<!-- News List Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Berita Terbaru</h1>
            <p class="section-subtitle">Informasi dan kabar terkini dari Dayah Ulumul Qur'an</p>
        </div>
        
        <?php if (!empty($news)): ?>
            <div class="grid grid-2" style="gap: 2rem;">
                <?php foreach ($news as $article): ?>
                    <article class="card">
                        <?php if ($article['gambar']): ?>
                            <img src="<?php echo getImageUrl('berita/' . $article['gambar']); ?>" 
                                 alt="<?php echo htmlspecialchars($article['judul']); ?>" 
                                 class="card-img"
                                 style="height: 250px; object-fit: cover;">
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="card-meta">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-right: 5px;">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2"/>
                                    <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2"/>
                                    <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                <?php echo formatDate($article['created_at']); ?>
                                
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-left: 15px; margin-right: 5px;">
                                    <path d="M1 12S5 4 12 4S23 12 23 12S19 20 12 20S1 12 1 12Z" stroke="currentColor" stroke-width="2"/>
                                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                <?php echo timeAgo($article['created_at']); ?>
                            </div>
                            
                            <h2 class="card-title">
                                <a href="<?php echo SITE_URL; ?>/berita/detail.php?slug=<?php echo $article['slug']; ?>" 
                                   style="color: inherit; text-decoration: none;">
                                    <?php echo htmlspecialchars($article['judul']); ?>
                                </a>
                            </h2>
                            
                            <p class="card-text">
                                <?php echo truncateText($article['ringkasan'] ?: strip_tags($article['isi']), 200); ?>
                            </p>
                            
                            <a href="<?php echo SITE_URL; ?>/berita/detail.php?slug=<?php echo $article['slug']; ?>" 
                               class="btn btn-primary">
                                Baca Selengkapnya
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-left: 5px;">
                                    <path d="M5 12H19M12 5L19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div style="margin-top: 3rem;">
                    <?php echo generatePagination($currentPage, $totalPages, SITE_URL . '/berita/'); ?>
                </div>
            <?php endif; ?>
            
        <?php else: ?>
            <div class="text-center" style="padding: 4rem 0;">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" style="margin-bottom: 1rem; color: var(--gray);">
                    <path d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" stroke="currentColor" stroke-width="2"/>
                    <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2"/>
                    <line x1="16" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="2"/>
                    <line x1="16" y1="17" x2="8" y2="17" stroke="currentColor" stroke-width="2"/>
                </svg>
                <h3 style="color: var(--text-light); margin-bottom: 0.5rem;">Belum Ada Berita</h3>
                <p style="color: var(--gray);">Berita akan segera hadir. Silakan kembali lagi nanti.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Additional CSS for pagination -->
<style>
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.pagination-btn,
.pagination-number {
    padding: 0.5rem 1rem;
    border: 1px solid var(--gray);
    border-radius: 6px;
    text-decoration: none;
    color: var(--text-dark);
    transition: var(--transition);
    font-weight: 500;
}

.pagination-btn:hover,
.pagination-number:hover {
    background: var(--primary-color);
    color: var(--white);
    border-color: var(--primary-color);
}

.pagination-number.active {
    background: var(--primary-color);
    color: var(--white);
    border-color: var(--primary-color);
}

.pagination-dots {
    padding: 0.5rem;
    color: var(--gray);
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
    .pagination {
        gap: 0.25rem;
    }
    
    .pagination-btn,
    .pagination-number {
        padding: 0.4rem 0.8rem;
        font-size: 0.9rem;
    }
}
</style>

<?php include '../inc/footer.php'; ?>
