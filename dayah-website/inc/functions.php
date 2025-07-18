<?php
// Common functions for Dayah Ulumul Qur'an Website

// Get database connection
function getDB() {
    return getConnection();
}

// Get latest news
function getLatestNews($limit = 3) {
    try {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM berita WHERE status = 'published' ORDER BY created_at DESC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Get all news with pagination
function getAllNews($page = 1, $limit = NEWS_PER_PAGE) {
    try {
        $pdo = getDB();
        $offset = ($page - 1) * $limit;
        
        $stmt = $pdo->prepare("SELECT * FROM berita WHERE status = 'published' ORDER BY created_at DESC LIMIT ? OFFSET ?");
        $stmt->execute([$limit, $offset]);
        $news = $stmt->fetchAll();
        
        // Get total count
        $countStmt = $pdo->prepare("SELECT COUNT(*) FROM berita WHERE status = 'published'");
        $countStmt->execute();
        $total = $countStmt->fetchColumn();
        
        return [
            'data' => $news,
            'total' => $total,
            'pages' => ceil($total / $limit),
            'current_page' => $page
        ];
    } catch(PDOException $e) {
        return [
            'data' => [],
            'total' => 0,
            'pages' => 0,
            'current_page' => 1
        ];
    }
}

// Get news by slug
function getNewsBySlug($slug) {
    try {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM berita WHERE slug = ? AND status = 'published'");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    } catch(PDOException $e) {
        return false;
    }
}

// Get organization structure
function getStructure() {
    try {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM struktur WHERE status = 'aktif' ORDER BY urutan ASC, nama ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Get teachers
function getTeachers() {
    try {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM pengajar WHERE status = 'aktif' ORDER BY nama ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Get gallery images
function getGallery($limit = null) {
    try {
        $pdo = getDB();
        $sql = "SELECT * FROM galeri ORDER BY created_at DESC";
        if ($limit) {
            $sql .= " LIMIT " . intval($limit);
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Get upcoming agenda
function getUpcomingAgenda($limit = 5) {
    try {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM agenda WHERE tanggal >= CURDATE() ORDER BY tanggal ASC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Get all agenda
function getAllAgenda() {
    try {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM agenda ORDER BY tanggal DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Get testimonials
function getTestimonials($limit = null) {
    try {
        $pdo = getDB();
        $sql = "SELECT * FROM testimoni WHERE status = 'aktif' ORDER BY created_at DESC";
        if ($limit) {
            $sql .= " LIMIT " . intval($limit);
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Get about content
function getAboutContent($type) {
    try {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT isi FROM tentang WHERE jenis = ?");
        $stmt->execute([$type]);
        $result = $stmt->fetch();
        return $result ? $result['isi'] : '';
    } catch(PDOException $e) {
        return '';
    }
}

// Get foundation profile
function getFoundationProfile() {
    try {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM yayasan LIMIT 1");
        $stmt->execute();
        return $stmt->fetch();
    } catch(PDOException $e) {
        return false;
    }
}

// Get statistics
function getStatistics() {
    try {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM statistik LIMIT 1");
        $stmt->execute();
        return $stmt->fetch();
    } catch(PDOException $e) {
        return [
            'santri_putra' => 0,
            'santri_putri' => 0,
            'total_santri' => 0,
            'total_pengajar' => 0
        ];
    }
}

// Get slider images
function getSliderImages() {
    try {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM slider WHERE status = 'aktif' ORDER BY urutan ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Get downloads
function getDownloads($kategori = null) {
    try {
        $pdo = getDB();
        if ($kategori) {
            $stmt = $pdo->prepare("SELECT * FROM downloads WHERE kategori = ? ORDER BY created_at DESC");
            $stmt->execute([$kategori]);
        } else {
            $stmt = $pdo->prepare("SELECT * FROM downloads ORDER BY created_at DESC");
            $stmt->execute();
        }
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Truncate text
function truncateText($text, $length = 150) {
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . '...';
}

// Format file size
function formatFileSize($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } else {
        return $bytes . ' bytes';
    }
}

// Get time ago
function timeAgo($datetime) {
    $time = time() - strtotime($datetime);
    
    if ($time < 60) {
        return 'baru saja';
    } elseif ($time < 3600) {
        return floor($time / 60) . ' menit yang lalu';
    } elseif ($time < 86400) {
        return floor($time / 3600) . ' jam yang lalu';
    } elseif ($time < 2592000) {
        return floor($time / 86400) . ' hari yang lalu';
    } elseif ($time < 31536000) {
        return floor($time / 2592000) . ' bulan yang lalu';
    } else {
        return floor($time / 31536000) . ' tahun yang lalu';
    }
}

// Check if image exists
function imageExists($imagePath) {
    $fullPath = BASE_PATH . '/img/' . $imagePath;
    return file_exists($fullPath) && is_file($fullPath);
}

// Get image URL with fallback
function getImageUrl($imagePath, $fallback = 'placeholder.jpg') {
    if ($imagePath && imageExists($imagePath)) {
        return SITE_URL . '/img/' . $imagePath;
    }
    return SITE_URL . '/img/' . $fallback;
}

// Generate breadcrumb
function generateBreadcrumb($items) {
    $breadcrumb = '<nav class="breadcrumb"><div class="container"><ol>';
    
    foreach ($items as $item) {
        if (isset($item['url'])) {
            $breadcrumb .= '<li><a href="' . $item['url'] . '">' . $item['title'] . '</a></li>';
        } else {
            $breadcrumb .= '<li class="active">' . $item['title'] . '</li>';
        }
    }
    
    $breadcrumb .= '</ol></div></nav>';
    return $breadcrumb;
}

// Generate pagination
function generatePagination($currentPage, $totalPages, $baseUrl) {
    if ($totalPages <= 1) return '';
    
    $pagination = '<div class="pagination">';
    
    // Previous button
    if ($currentPage > 1) {
        $pagination .= '<a href="' . $baseUrl . '?page=' . ($currentPage - 1) . '" class="pagination-btn">&laquo; Sebelumnya</a>';
    }
    
    // Page numbers
    $start = max(1, $currentPage - 2);
    $end = min($totalPages, $currentPage + 2);
    
    if ($start > 1) {
        $pagination .= '<a href="' . $baseUrl . '?page=1" class="pagination-number">1</a>';
        if ($start > 2) {
            $pagination .= '<span class="pagination-dots">...</span>';
        }
    }
    
    for ($i = $start; $i <= $end; $i++) {
        if ($i == $currentPage) {
            $pagination .= '<span class="pagination-number active">' . $i . '</span>';
        } else {
            $pagination .= '<a href="' . $baseUrl . '?page=' . $i . '" class="pagination-number">' . $i . '</a>';
        }
    }
    
    if ($end < $totalPages) {
        if ($end < $totalPages - 1) {
            $pagination .= '<span class="pagination-dots">...</span>';
        }
        $pagination .= '<a href="' . $baseUrl . '?page=' . $totalPages . '" class="pagination-number">' . $totalPages . '</a>';
    }
    
    // Next button
    if ($currentPage < $totalPages) {
        $pagination .= '<a href="' . $baseUrl . '?page=' . ($currentPage + 1) . '" class="pagination-btn">Selanjutnya &raquo;</a>';
    }
    
    $pagination .= '</div>';
    return $pagination;
}

// Search function
function searchContent($query, $type = 'all') {
    try {
        $pdo = getDB();
        $results = [];
        
        if ($type == 'all' || $type == 'berita') {
            $stmt = $pdo->prepare("SELECT 'berita' as type, id, judul as title, ringkasan as content, slug, created_at FROM berita WHERE (judul LIKE ? OR isi LIKE ?) AND status = 'published'");
            $stmt->execute(["%$query%", "%$query%"]);
            $results = array_merge($results, $stmt->fetchAll());
        }
        
        if ($type == 'all' || $type == 'agenda') {
            $stmt = $pdo->prepare("SELECT 'agenda' as type, id, judul as title, isi as content, '' as slug, created_at FROM agenda WHERE judul LIKE ? OR isi LIKE ?");
            $stmt->execute(["%$query%", "%$query%"]);
            $results = array_merge($results, $stmt->fetchAll());
        }
        
        return $results;
    } catch(PDOException $e) {
        return [];
    }
}

// Log activity (for admin)
function logActivity($action, $description, $admin_id = null) {
    try {
        $pdo = getDB();
        
        // Create logs table if not exists
        $pdo->exec("CREATE TABLE IF NOT EXISTS logs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            admin_id INT,
            action VARCHAR(100),
            description TEXT,
            ip_address VARCHAR(45),
            user_agent TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        
        $stmt = $pdo->prepare("INSERT INTO logs (admin_id, action, description, ip_address, user_agent) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $admin_id,
            $action,
            $description,
            $_SERVER['REMOTE_ADDR'] ?? '',
            $_SERVER['HTTP_USER_AGENT'] ?? ''
        ]);
        
        return true;
    } catch(PDOException $e) {
        return false;
    }
}

// Clean old logs
function cleanOldLogs($days = 30) {
    try {
        $pdo = getDB();
        $stmt = $pdo->prepare("DELETE FROM logs WHERE created_at < DATE_SUB(NOW(), INTERVAL ? DAY)");
        $stmt->execute([$days]);
        return true;
    } catch(PDOException $e) {
        return false;
    }
}

// Get meta tags for SEO
function getMetaTags($page, $data = []) {
    $meta = [
        'title' => SITE_NAME,
        'description' => SITE_DESCRIPTION,
        'keywords' => 'dayah, pesantren, pendidikan islam, aceh tengah, bebesen',
        'image' => SITE_URL . '/img/logo.png'
    ];
    
    switch ($page) {
        case 'news_detail':
            if (isset($data['judul'])) {
                $meta['title'] = $data['judul'];
                $meta['description'] = isset($data['ringkasan']) ? $data['ringkasan'] : truncateText(strip_tags($data['isi'] ?? ''));
                if (isset($data['gambar']) && $data['gambar']) {
                    $meta['image'] = getImageUrl('berita/' . $data['gambar']);
                }
            }
            break;
            
        case 'news_list':
            $meta['title'] = 'Berita Terbaru';
            $meta['description'] = 'Kumpulan berita terbaru dari ' . SITE_NAME;
            break;
            
        case 'about':
            $meta['title'] = 'Tentang Kami';
            $meta['description'] = 'Profil, visi, misi, dan sejarah ' . SITE_NAME;
            break;
            
        case 'structure':
            $meta['title'] = 'Struktur Organisasi';
            $meta['description'] = 'Struktur organisasi dan kepengurusan ' . SITE_NAME;
            break;
            
        case 'teachers':
            $meta['title'] = 'Tenaga Pengajar';
            $meta['description'] = 'Profil tenaga pengajar dan ustadz di ' . SITE_NAME;
            break;
            
        case 'gallery':
            $meta['title'] = 'Galeri Kegiatan';
            $meta['description'] = 'Dokumentasi kegiatan dan fasilitas ' . SITE_NAME;
            break;
            
        case 'agenda':
            $meta['title'] = 'Agenda Kegiatan';
            $meta['description'] = 'Jadwal dan agenda kegiatan ' . SITE_NAME;
            break;
    }
    
    return $meta;
}

// Validate and sanitize input
function validateInput($data, $rules) {
    $errors = [];
    $clean = [];
    
    foreach ($rules as $field => $rule) {
        $value = isset($data[$field]) ? trim($data[$field]) : '';
        
        // Required validation
        if (isset($rule['required']) && $rule['required'] && empty($value)) {
            $errors[$field] = $rule['label'] . ' wajib diisi';
            continue;
        }
        
        // Skip other validations if field is empty and not required
        if (empty($value)) {
            $clean[$field] = $value;
            continue;
        }
        
        // Email validation
        if (isset($rule['email']) && $rule['email'] && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $errors[$field] = $rule['label'] . ' harus berupa email yang valid';
            continue;
        }
        
        // Min length validation
        if (isset($rule['min_length']) && strlen($value) < $rule['min_length']) {
            $errors[$field] = $rule['label'] . ' minimal ' . $rule['min_length'] . ' karakter';
            continue;
        }
        
        // Max length validation
        if (isset($rule['max_length']) && strlen($value) > $rule['max_length']) {
            $errors[$field] = $rule['label'] . ' maksimal ' . $rule['max_length'] . ' karakter';
            continue;
        }
        
        // Numeric validation
        if (isset($rule['numeric']) && $rule['numeric'] && !is_numeric($value)) {
            $errors[$field] = $rule['label'] . ' harus berupa angka';
            continue;
        }
        
        $clean[$field] = sanitize($value);
    }
    
    return [
        'valid' => empty($errors),
        'errors' => $errors,
        'data' => $clean
    ];
}
?>
