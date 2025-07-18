<?php
require_once '../config/config.php';
require_once '../inc/functions.php';

// Page meta data
$page_title = 'Struktur Organisasi';
$page_description = 'Struktur organisasi dan kepengurusan Dayah Ulumul Qur\'an Yayasan Quba\' Bebesen';

// Get structure data
$structure = getStructure();

// Breadcrumb
$breadcrumb = generateBreadcrumb([
    ['title' => 'Beranda', 'url' => SITE_URL],
    ['title' => 'Struktur Organisasi']
]);

include '../inc/header.php';
?>

<!-- Breadcrumb -->
<?php echo $breadcrumb; ?>

<!-- Structure Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Struktur Organisasi</h1>
            <p class="section-subtitle">Kepengurusan Dayah Ulumul Qur'an Yayasan Quba' Bebesen</p>
        </div>
        
        <?php if (!empty($structure)): ?>
            <div class="structure-grid">
                <?php foreach ($structure as $person): ?>
                    <div class="structure-card glass">
                        <div class="structure-photo">
                            <?php if ($person['foto']): ?>
                                <img src="<?php echo getImageUrl('struktur/' . $person['foto']); ?>" 
                                     alt="<?php echo htmlspecialchars($person['nama']); ?>"
                                     class="photo-img">
                            <?php else: ?>
                                <div class="photo-placeholder">
                                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none">
                                        <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="structure-info">
                            <h3 class="structure-name"><?php echo htmlspecialchars($person['nama']); ?></h3>
                            <p class="structure-position"><?php echo htmlspecialchars($person['jabatan']); ?></p>
                            
                            <?php if ($person['no_hp']): ?>
                                <div class="structure-contact">
                                    <a href="tel:<?php echo $person['no_hp']; ?>" class="contact-btn">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <path d="M22 16.92V19.92C22.0011 20.1985 21.9441 20.4742 21.8325 20.7293C21.7209 20.9845 21.5573 21.2136 21.3521 21.4019C21.1468 21.5901 20.9046 21.7335 20.6407 21.8227C20.3769 21.9119 20.0974 21.9451 19.82 21.92C16.7428 21.5856 13.787 20.5341 11.19 18.85C8.77382 17.3147 6.72533 15.2662 5.18999 12.85C3.49997 10.2412 2.44824 7.27099 2.11999 4.18C2.095 3.90347 2.12787 3.62476 2.21649 3.36162C2.30512 3.09849 2.44756 2.85669 2.63476 2.65162C2.82196 2.44655 3.0498 2.28271 3.30379 2.17052C3.55777 2.05833 3.83233 2.00026 4.10999 2H7.10999C7.59531 1.99522 8.06579 2.16708 8.43376 2.48353C8.80173 2.79999 9.04207 3.23945 9.10999 3.72C9.23662 4.68007 9.47144 5.62273 9.80999 6.53C9.94454 6.88792 9.97366 7.27691 9.8939 7.65088C9.81415 8.02485 9.62886 8.36811 9.35999 8.64L8.08999 9.91C9.51355 12.4135 11.5865 14.4864 14.09 15.91L15.36 14.64C15.6319 14.3711 15.9751 14.1858 16.3491 14.1061C16.7231 14.0263 17.1121 14.0555 17.47 14.19C18.3773 14.5286 19.3199 14.7634 20.28 14.89C20.7658 14.9585 21.2094 15.2032 21.5265 15.5775C21.8437 15.9518 22.0122 16.4296 22 16.92Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <?php echo htmlspecialchars($person['no_hp']); ?>
                                    </a>
                                    
                                    <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $person['no_hp']); ?>" 
                                       target="_blank" 
                                       class="whatsapp-btn">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.465 3.488"/>
                                        </svg>
                                        WhatsApp
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center" style="padding: 4rem 0;">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" style="margin-bottom: 1rem; color: var(--gray);">
                    <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="currentColor" stroke-width="2"/>
                    <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                    <path d="M23 21V19C23 18.1645 22.7155 17.3541 22.2094 16.7018C21.7033 16.0495 20.9999 15.5902 20.2 15.3779" stroke="currentColor" stroke-width="2"/>
                    <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89317 18.7122 8.75608 18.1676 9.45768C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="currentColor" stroke-width="2"/>
                </svg>
                <h3 style="color: var(--text-light); margin-bottom: 0.5rem;">Struktur Organisasi</h3>
                <p style="color: var(--gray);">Data struktur organisasi akan segera diperbarui.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Additional Information -->
<section class="section" style="background: var(--light-gray);">
    <div class="container">
        <div class="text-center">
            <h2 style="margin-bottom: 1rem;">Hubungi Pengurus</h2>
            <p style="margin-bottom: 2rem; color: var(--text-light);">
                Untuk informasi lebih lanjut, silakan hubungi pengurus melalui kontak yang tersedia
            </p>
            <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                <a href="tel:+6281234567890" class="btn btn-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="margin-right: 8px;">
                        <path d="M22 16.92V19.92C22.0011 20.1985 21.9441 20.4742 21.8325 20.7293C21.7209 20.9845 21.5573 21.2136 21.3521 21.4019C21.1468 21.5901 20.9046 21.7335 20.6407 21.8227C20.3769 21.9119 20.0974 21.9451 19.82 21.92C16.7428 21.5856 13.787 20.5341 11.19 18.85C8.77382 17.3147 6.72533 15.2662 5.18999 12.85C3.49997 10.2412 2.44824 7.27099 2.11999 4.18C2.095 3.90347 2.12787 3.62476 2.21649 3.36162C2.30512 3.09849 2.44756 2.85669 2.63476 2.65162C2.82196 2.44655 3.0498 2.28271 3.30379 2.17052C3.55777 2.05833 3.83233 2.00026 4.10999 2H7.10999C7.59531 1.99522 8.06579 2.16708 8.43376 2.48353C8.80173 2.79999 9.04207 3.23945 9.10999 3.72C9.23662 4.68007 9.47144 5.62273 9.80999 6.53C9.94454 6.88792 9.97366 7.27691 9.8939 7.65088C9.81415 8.02485 9.62886 8.36811 9.35999 8.64L8.08999 9.91C9.51355 12.4135 11.5865 14.4864 14.09 15.91L15.36 14.64C15.6319 14.3711 15.9751 14.1858 16.3491 14.1061C16.7231 14.0263 17.1121 14.0555 17.47 14.19C18.3773 14.5286 19.3199 14.7634 20.28 14.89C20.7658 14.9585 21.2094 15.2032 21.5265 15.5775C21.8437 15.9518 22.0122 16.4296 22 16.92Z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Telepon
                </a>
                <a href="mailto:info@dayahquba.com" class="btn btn-outline">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="margin-right: 8px;">
                        <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2"/>
                        <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Email
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.structure-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.structure-card {
    background: var(--white);
    border-radius: var(--border-radius);
    padding: 2rem;
    text-align: center;
    transition: var(--transition);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.structure-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}

.structure-photo {
    margin-bottom: 1.5rem;
}

.photo-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid var(--primary-color);
    box-shadow: var(--shadow);
}

.photo-placeholder {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: var(--light-gray);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: var(--gray);
    border: 4px solid var(--primary-color);
}

.structure-name {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.structure-position {
    font-size: 1rem;
    color: var(--primary-color);
    font-weight: 500;
    margin-bottom: 1rem;
}

.structure-contact {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    align-items: center;
}

.contact-btn,
.whatsapp-btn {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: var(--transition);
    gap: 0.5rem;
}

.contact-btn {
    background: var(--primary-color);
    color: var(--white);
}

.contact-btn:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
}

.whatsapp-btn {
    background: #25d366;
    color: var(--white);
}

.whatsapp-btn:hover {
    background: #128c7e;
    transform: translateY(-2px);
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
    .structure-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .structure-card {
        padding: 1.5rem;
    }
    
    .photo-img,
    .photo-placeholder {
        width: 100px;
        height: 100px;
    }
    
    .structure-name {
        font-size: 1.1rem;
    }
    
    .structure-position {
        font-size: 0.9rem;
    }
}

@media (max-width: 480px) {
    .structure-grid {
        grid-template-columns: 1fr;
    }
    
    .structure-contact {
        flex-direction: column;
    }
    
    .contact-btn,
    .whatsapp-btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<?php include '../inc/footer.php'; ?>
