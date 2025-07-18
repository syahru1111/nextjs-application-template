<?php
require_once '../config/config.php';
require_once '../inc/functions.php';

// Get news slug from URL
$slug = $_GET['slug'] ?? '';

if (empty($slug)) {
    redirect(SITE_URL . '/berita/');
}

// Get news by slug
$news = getNewsBySlug($slug);

if (!$news) {
    // News not found, redirect to news list
    redirect(SITE_URL . '/berita/');
}

// Page meta data
$page_title = $news['judul'];
$page_description = $news['ringkasan'] ?: truncateText(strip_tags($news['isi']));
$meta = getMetaTags('news_detail', $news);

// Get related news
try {
    $pdo = getDB();
    $stmt = $pdo->prepare("SELECT * FROM berita WHERE slug != ? AND status = 'published' ORDER BY created_at DESC LIMIT 3");
    $stmt->execute([$slug]);
    $relatedNews = $stmt->fetchAll();
} catch(PDOException $e) {
    $relatedNews = [];
}

// Breadcrumb
$breadcrumb = generateBreadcrumb([
    ['title' => 'Beranda', 'url' => SITE_URL],
    ['title' => 'Berita', 'url' => SITE_URL . '/berita/'],
    ['title' => $news['judul']]
]);

include '../inc/header.php';
?>

<!-- Breadcrumb -->
<?php echo $breadcrumb; ?>

<!-- News Detail Section -->
<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 3rem; align-items: start;">
            <!-- Main Content -->
            <article class="news-detail">
                <!-- News Header -->
                <header class="news-header" style="margin-bottom: 2rem;">
                    <h1 class="news-title" style="font-size: 2.5rem; font-weight: 700; color: var(--text-dark); margin-bottom: 1rem; line-height: 1.2;">
                        <?php echo htmlspecialchars($news['judul']); ?>
                    </h1>
                    
                    <div class="news-meta" style="display: flex; align-items: center; gap: 1.5rem; color: var(--text-light); margin-bottom: 2rem; flex-wrap: wrap;">
                        <div style="display: flex; align-items: center;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" style="margin-right: 8px;">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2"/>
                                <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2"/>
                                <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span><?php echo formatDate($news['created_at']); ?></span>
                        </div>
                        
                        <div style="display: flex; align-items: center;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" style="margin-right: 8px;">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                <polyline points="12,6 12,12 16,14" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span><?php echo timeAgo($news['created_at']); ?></span>
                        </div>
                    </div>
                    
                    <?php if ($news['gambar']): ?>
                        <div class="news-image" style="margin-bottom: 2rem;">
                            <img src="<?php echo getImageUrl('berita/' . $news['gambar']); ?>" 
                                 alt="<?php echo htmlspecialchars($news['judul']); ?>"
                                 style="width: 100%; height: 400px; object-fit: cover; border-radius: var(--border-radius); box-shadow: var(--shadow);">
                        </div>
                    <?php endif; ?>
                </header>
                
                <!-- News Content -->
                <div class="news-content" style="font-size: 1.1rem; line-height: 1.8; color: var(--text-dark);">
                    <?php echo nl2br(htmlspecialchars($news['isi'])); ?>
                </div>
                
                <!-- Share Buttons -->
                <div class="news-share" style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--light-gray);">
                    <h4 style="margin-bottom: 1rem; color: var(--text-dark);">Bagikan Berita Ini:</h4>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(SITE_URL . '/berita/detail.php?slug=' . $news['slug']); ?>" 
                           target="_blank" 
                           class="share-btn"
                           style="display: flex; align-items: center; padding: 0.5rem 1rem; background: #1877f2; color: white; text-decoration: none; border-radius: 6px; font-weight: 500; transition: var(--transition);">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 8px;">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            Facebook
                        </a>
                        
                        <a href="https://wa.me/?text=<?php echo urlencode($news['judul'] . ' - ' . SITE_URL . '/berita/detail.php?slug=' . $news['slug']); ?>" 
                           target="_blank" 
                           class="share-btn"
                           style="display: flex; align-items: center; padding: 0.5rem 1rem; background: #25d366; color: white; text-decoration: none; border-radius: 6px; font-weight: 500; transition: var(--transition);">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 8px;">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.465 3.488"/>
                            </svg>
                            WhatsApp
                        </a>
                        
                        <button onclick="copyToClipboard()" 
                                class="share-btn"
                                style="display: flex; align-items: center; padding: 0.5rem 1rem; background: var(--gray); color: white; border: none; border-radius: 6px; font-weight: 500; cursor: pointer; transition: var(--transition);">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-right: 8px;">
                                <path d="M10 13C10.4295 13.5741 10.9774 14.0491 11.6066 14.3929C12.2357 14.7367 12.9315 14.9411 13.6467 14.9923C14.3618 15.0435 15.0796 14.9403 15.7513 14.6897C16.4231 14.4392 17.0331 14.047 17.54 13.54L20.54 10.54C21.4508 9.59695 21.9548 8.33394 21.9434 7.02296C21.932 5.71198 21.4061 4.45791 20.4791 3.53087C19.5521 2.60383 18.298 2.07799 16.987 2.0666C15.676 2.0552 14.413 2.55918 13.47 3.47L11.75 5.18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 11C13.5705 10.4259 13.0226 9.95085 12.3934 9.60706C11.7643 9.26327 11.0685 9.05885 10.3533 9.00769C9.63819 8.95653 8.92037 9.05973 8.24864 9.31028C7.5769 9.56083 6.9669 9.95303 6.46 10.46L3.46 13.46C2.54918 14.403 2.04520 15.6661 2.05660 16.977C2.068 18.288 2.59384 19.5421 3.52088 20.4691C4.44792 21.3962 5.70199 21.922 7.01297 21.9334C8.32395 21.9448 9.58701 21.4408 10.53 20.53L12.24 18.82" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Salin Link
                        </button>
                    </div>
                </div>
            </article>
            
            <!-- Sidebar -->
            <aside class="news-sidebar">
                <!-- Related News -->
                <?php if (!empty($relatedNews)): ?>
                    <div class="sidebar-widget" style="background: var(--white); padding: 1.5rem; border-radius: var(--border-radius); box-shadow: var(--shadow); margin-bottom: 2rem;">
                        <h3 style="margin-bottom: 1.5rem; color: var(--text-dark); font-size: 1.25rem; font-weight: 600;">Berita Terkait</h3>
                        
                        <?php foreach ($relatedNews as $related): ?>
                            <article class="related-news" style="display: flex; gap: 1rem; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--light-gray);">
                                <?php if ($related['gambar']): ?>
                                    <img src="<?php echo getImageUrl('berita/' . $related['gambar']); ?>" 
                                         alt="<?php echo htmlspecialchars($related['judul']); ?>"
                                         style="width: 80px; height: 80px; object-fit: cover; border-radius: 6px; flex-shrink: 0;">
                                <?php endif; ?>
                                <div>
                                    <h4 style="margin-bottom: 0.5rem;">
                                        <a href="<?php echo SITE_URL; ?>/berita/detail.php?slug=<?php echo $related['slug']; ?>" 
                                           style="color: var(--text-dark); text-decoration: none; font-size: 0.95rem; font-weight: 500; line-height: 1.3;">
                                            <?php echo htmlspecialchars($related['judul']); ?>
                                        </a>
                                    </h4>
                                    <div style="font-size: 0.8rem; color: var(--text-light);">
                                        <?php echo formatDate($related['created_at']); ?>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                        
                        <a href="<?php echo SITE_URL; ?>/berita/" class="btn btn-outline" style="width: 100%;">
                            Lihat Semua Berita
                        </a>
                    </div>
                <?php endif; ?>
                
                <!-- Quick Links -->
                <div class="sidebar-widget" style="background: var(--primary-color); color: var(--white); padding: 1.5rem; border-radius: var(--border-radius); box-shadow: var(--shadow);">
                    <h3 style="margin-bottom: 1.5rem; color: var(--white); font-size: 1.25rem; font-weight: 600;">Menu Lainnya</h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <a href="<?php echo SITE_URL; ?>/tentang/" 
                           style="color: rgba(255,255,255,0.9); text-decoration: none; padding: 0.5rem 0; border-bottom: 1px solid rgba(255,255,255,0.2); transition: var(--transition);">
                            Tentang Kami
                        </a>
                        <a href="<?php echo SITE_URL; ?>/akademik/" 
                           style="color: rgba(255,255,255,0.9); text-decoration: none; padding: 0.5rem 0; border-bottom: 1px solid rgba(255,255,255,0.2); transition: var(--transition);">
                            Program Akademik
                        </a>
                        <a href="<?php echo SITE_URL; ?>/pengajar/" 
                           style="color: rgba(255,255,255,0.9); text-decoration: none; padding: 0.5rem 0; border-bottom: 1px solid rgba(255,255,255,0.2); transition: var(--transition);">
                            Tenaga Pengajar
                        </a>
                        <a href="<?php echo SITE_URL; ?>/galeri/" 
                           style="color: rgba(255,255,255,0.9); text-decoration: none; padding: 0.5rem 0; border-bottom: 1px solid rgba(255,255,255,0.2); transition: var(--transition);">
                            Galeri
                        </a>
                        <a href="<?php echo SITE_URL; ?>/agenda/" 
                           style="color: rgba(255,255,255,0.9); text-decoration: none; padding: 0.5rem 0; transition: var(--transition);">
                            Agenda Kegiatan
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<!-- Navigation -->
<section style="background: var(--light-gray); padding: 2rem 0;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <a href="<?php echo SITE_URL; ?>/berita/" class="btn btn-outline">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-right: 8px;">
                    <path d="M19 12H5M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Kembali ke Daftar Berita
            </a>
            
            <a href="<?php echo SITE_URL; ?>/" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-right: 8px;">
                    <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="currentColor" stroke-width="2"/>
                    <polyline points="9,22 9,12 15,12 15,22" stroke="currentColor" stroke-width="2"/>
                </svg>
                Beranda
            </a>
        </div>
    </div>
</section>

<style>
.share-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-hover);
}

@media (max-width: 768px) {
    .container > div {
        grid-template-columns: 1fr !important;
        gap: 2rem !important;
    }
    
    .news-title {
        font-size: 2rem !important;
    }
    
    .news-meta {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 0.5rem !important;
    }
    
    .news-image img {
        height: 250px !important;
    }
    
    .related-news {
        flex-direction: column !important;
    }
    
    .related-news img {
        width: 100% !important;
        height: 150px !important;
    }
}
</style>

<script>
function copyToClipboard() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(function() {
        // Show success message
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-right: 8px;"><path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.7088 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18457 2.99721 7.13633 4.39828 5.49707C5.79935 3.85782 7.69279 2.71537 9.79619 2.24013C11.8996 1.7649 14.1003 1.98232 16.07 2.86" stroke="currentColor" stroke-width="2"/><polyline points="22,4 12,14.01 9,11.01" stroke="currentColor" stroke-width="2"/></svg>Tersalin!';
        btn.style.background = '#4caf50';
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.style.background = 'var(--gray)';
        }, 2000);
    });
}
</script>

<?php include '../inc/footer.php'; ?>
