<?php
/*
Template Name: Bộ sưu tập căn hộ
*/

// Helper function to get attachment URL by slug
function get_attachment_url_by_slug($slug) {
    global $wpdb;
    $attachment_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE post_name = %s AND post_type = 'attachment'", $slug));
    if ($attachment_id) {
        return wp_get_attachment_url($attachment_id);
    }
    return '';
}

get_header();
?>

<style>
.products-hero {
    background: linear-gradient(135deg, #062537 0%, #0a2f47 100%);
    padding: 120px 0 80px;
    color: white;
    position: relative;
    overflow: hidden;
}

.products-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0.1;
    z-index: 1;
}

.products-hero .container {
    position: relative;
    z-index: 2;
}

.products-hero h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.products-hero p {
    font-size: 1.2rem;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
}

.products-section {
    padding: 80px 0;
    background: #f8f9fa;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.product-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.2);
}

.product-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(221, 193, 154, 0.1), rgba(196, 168, 130, 0.05));
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 1;
}

.product-card:hover::before {
    opacity: 1;
}

.product-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 999;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

.product-overlay-icon {
    width: 36px;
    height: 36px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    color: #DDC19A;
    margin-bottom: 6px;
}

.product-overlay-text {
    color: white;
    font-size: 11px;
    font-weight: 400;
    text-align: center;
    background: rgba(0,0,0,0.5);
    padding: 3px 8px;
    border-radius: 8px;
}

.product-info {
    padding: 20px;
    position: relative;
    z-index: 2;
}

.product-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #2C3E50;
    margin-bottom: 8px;
}

.product-type {
    color: #DDC19A;
    font-size: 0.9rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.product-area {
    color: #7f8c8d;
    font-size: 0.85rem;
    margin-top: 5px;
}

/* Fullscreen Modal */
.modal-fullscreen {
    z-index: 99999;
}

.modal-fullscreen .modal-dialog {
    max-width: 100vw;
    max-height: 100vh;
    margin: 0;
    padding: 0;
}

.modal-fullscreen .modal-content {
    border: none;
    border-radius: 0;
    height: 100vh;
    background: #000;
}

.modal-fullscreen .modal-header {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    background: linear-gradient(180deg, rgba(0,0,0,0.8) 0%, transparent 100%);
    border: none;
    padding: 20px 30px;
    z-index: 10;
}

.modal-fullscreen .modal-header .close {
    color: white;
    font-size: 32px;
    opacity: 0.8;
    text-shadow: none;
}

.modal-fullscreen .modal-header .close:hover {
    opacity: 1;
}

.modal-fullscreen .modal-body {
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.fullscreen-image {
    max-width: 90vw;
    max-height: 90vh;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
}

.modal-fullscreen .modal-footer {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, transparent 100%);
    border: none;
    padding: 20px 30px;
    z-index: 10;
}

.navigation-controls {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
}

.nav-btn {
    width: 50px;
    height: 50px;
    background: rgba(255,255,255,0.2);
    border: 2px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    color: white;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.nav-btn:hover {
    background: rgba(255,255,255,0.3);
    border-color: rgba(255,255,255,0.5);
    transform: scale(1.1);
}

.nav-btn:disabled {
    opacity: 0.3;
    cursor: not-allowed;
    transform: none;
}

.image-counter {
    color: white;
    font-size: 16px;
    font-weight: 500;
    background: rgba(0,0,0,0.5);
    padding: 8px 16px;
    border-radius: 20px;
    backdrop-filter: blur(10px);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .products-grid {
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
    }
}

@media (max-width: 992px) {
    .products-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .product-image {
        height: 220px;
    }
}

@media (max-width: 768px) {
    .products-hero {
        padding: 100px 0 70px;
    }
    
    .products-hero h1 {
        font-size: 2.5rem;
    }
    
    .products-section {
        padding: 70px 0;
    }
    
    .products-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 40px;
    }
    
    .product-image {
        height: 200px;
    }
    
    .product-info {
        padding: 15px;
    }
    
    .product-title {
        font-size: 1.1rem;
    }
    
    .modal-fullscreen .modal-header {
        padding: 15px 20px;
    }
    
    .modal-fullscreen .modal-footer {
        padding: 15px 20px;
    }
    
    .nav-btn {
        width: 45px;
        height: 45px;
        font-size: 16px;
    }
}

@media (max-width: 576px) {
    .products-hero {
        padding: 80px 0 50px;
    }
    
    .products-hero h1 {
        font-size: 2rem;
    }
    
    .products-hero p {
        font-size: 1rem;
    }
    
    .products-section {
        padding: 50px 0;
    }
    
    .products-grid {
        grid-template-columns: 1fr;
        gap: 20px;
        margin-top: 30px;
    }
    
    .product-image {
        height: 250px;
    }
    
    .fullscreen-image {
        max-width: 95vw;
        max-height: 85vh;
    }
    
    .navigation-controls {
        gap: 15px;
    }
    
    .nav-btn {
        width: 40px;
        height: 40px;
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .products-hero h1 {
        font-size: 1.8rem;
    }
    
    .product-info {
        padding: 12px;
    }
    
    .product-title {
        font-size: 1rem;
    }
    
    .modal-fullscreen .modal-header {
        padding: 10px 15px;
    }
    
    .modal-fullscreen .modal-footer {
        padding: 10px 15px;
    }
}
</style>

<!-- Hero Section -->
<section class="products-hero">
    <div class="container">
        <div class="text-center">
            <h1>Bộ sưu tập căn hộ</h1>
            <p>Khám phá các căn hộ du thuyền cao cấp với thiết kế hiện đại và tiện ích đẳng cấp</p>
        </div>
    </div>
</section>

<!-- Products Gallery Section -->
<section class="products-section">
    <div class="container">
        <div class="text-center">
            <h2 style="font-size: 2.5rem; font-weight: 700; color: #2C3E50; margin-bottom: 1rem;">Căn hộ du thuyền</h2>
            <p style="font-size: 1.1rem; color: #7f8c8d; max-width: 600px; margin: 0 auto;">Thiết kế tinh tế với không gian sống hiện đại và view biển tuyệt đẹp</p>
        </div>
        
        <div class="products-grid">
            <!-- Product 1 -->
            <div class="product-card" onclick="openFullscreenModal(1)">
                <img src="<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_1PN1'); ?>" alt="Căn hộ 1PN+1" class="product-image">
                <div class="product-overlay">
                    <div class="product-overlay-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="product-overlay-text">Xem chi tiết</div>
                </div>
                <div class="product-info">
                    <div class="product-type">Studio</div>
                    <h3 class="product-title">Căn hộ 1PN+1</h3>
                    <div class="product-area">Diện tích: 44.16m²</div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-card" onclick="openFullscreenModal(2)">
                <img src="<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_2PN1A'); ?>" alt="Căn hộ 2PN+1A" class="product-image">
                <div class="product-overlay">
                    <div class="product-overlay-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="product-overlay-text">Xem chi tiết</div>
                </div>
                <div class="product-info">
                    <div class="product-type">2 Bedroom</div>
                    <h3 class="product-title">Căn hộ 2PN+1A</h3>
                    <div class="product-area">Diện tích: 67.85m²</div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-card" onclick="openFullscreenModal(3)">
                <img src="<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_2PN2'); ?>" alt="Căn hộ 2PN+2" class="product-image">
                <div class="product-overlay">
                    <div class="product-overlay-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="product-overlay-text">Xem chi tiết</div>
                </div>
                <div class="product-info">
                    <div class="product-type">2 Bedroom</div>
                    <h3 class="product-title">Căn hộ 2PN+2</h3>
                    <div class="product-area">Diện tích: 72.45m²</div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-card" onclick="openFullscreenModal(4)">
                <img src="<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_2PN4'); ?>" alt="Căn hộ 2PN+4" class="product-image">
                <div class="product-overlay">
                    <div class="product-overlay-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="product-overlay-text">Xem chi tiết</div>
                </div>
                <div class="product-info">
                    <div class="product-type">2 Bedroom</div>
                    <h3 class="product-title">Căn hộ 2PN+4</h3>
                    <div class="product-area">Diện tích: 78.92m²</div>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="product-card" onclick="openFullscreenModal(5)">
                <img src="<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_2PN4A'); ?>" alt="Căn hộ 2PN+4A" class="product-image">
                <div class="product-overlay">
                    <div class="product-overlay-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="product-overlay-text">Xem chi tiết</div>
                </div>
                <div class="product-info">
                    <div class="product-type">2 Bedroom</div>
                    <h3 class="product-title">Căn hộ 2PN+4A</h3>
                    <div class="product-area">Diện tích: 82.18m²</div>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="product-card" onclick="openFullscreenModal(6)">
                <img src="<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_3PN1'); ?>" alt="Căn hộ 3PN+1" class="product-image">
                <div class="product-overlay">
                    <div class="product-overlay-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="product-overlay-text">Xem chi tiết</div>
                </div>
                <div class="product-info">
                    <div class="product-type">3 Bedroom</div>
                    <h3 class="product-title">Căn hộ 3PN+1</h3>
                    <div class="product-area">Diện tích: 112.52m²</div>
                </div>
            </div>

            <!-- Product 7 -->
            <div class="product-card" onclick="openFullscreenModal(7)">
                <img src="<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_3PN1A'); ?>" alt="Căn hộ 3PN+1A" class="product-image">
                <div class="product-overlay">
                    <div class="product-overlay-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="product-overlay-text">Xem chi tiết</div>
                </div>
                <div class="product-info">
                    <div class="product-type">3 Bedroom</div>
                    <h3 class="product-title">Căn hộ 3PN+1A</h3>
                    <div class="product-area">Diện tích: 118.76m²</div>
                </div>
            </div>

            <!-- Product 8 -->
            <div class="product-card" onclick="openFullscreenModal(8)">
                <img src="<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_3PN2'); ?>" alt="Căn hộ 3PN+2" class="product-image">
                <div class="product-overlay">
                    <div class="product-overlay-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="product-overlay-text">Xem chi tiết</div>
                </div>
                <div class="product-info">
                    <div class="product-type">3 Bedroom</div>
                    <h3 class="product-title">Căn hộ 3PN+2</h3>
                    <div class="product-area">Diện tích: 125.68m²</div>
                </div>
            </div>

            <!-- Product 9 -->
            <div class="product-card" onclick="openFullscreenModal(9)">
                <img src="<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_3PN3'); ?>" alt="Căn hộ 3PN+3" class="product-image">
                <div class="product-overlay">
                    <div class="product-overlay-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="product-overlay-text">Xem chi tiết</div>
                </div>
                <div class="product-info">
                    <div class="product-type">3 Bedroom</div>
                    <h3 class="product-title">Căn hộ 3PN+3</h3>
                    <div class="product-area">Diện tích: 135.76m²</div>
                </div>
            </div>

            <!-- Product 10 -->
            <div class="product-card" onclick="openFullscreenModal(10)">
                <img src="<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_3PN3A'); ?>" alt="Căn hộ 3PN+3A" class="product-image">
                <div class="product-overlay">
                    <div class="product-overlay-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="product-overlay-text">Xem chi tiết</div>
                </div>
                <div class="product-info">
                    <div class="product-type">3 Bedroom</div>
                    <h3 class="product-title">Căn hộ 3PN+3A</h3>
                    <div class="product-area">Diện tích: 142.84m²</div>
                </div>
            </div>

            <!-- Product 11 -->
            <div class="product-card" onclick="openFullscreenModal(11)">
                <img src="<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_STUDIO'); ?>" alt="Studio" class="product-image">
                <div class="product-overlay">
                    <div class="product-overlay-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="product-overlay-text">Xem chi tiết</div>
                </div>
                <div class="product-info">
                    <div class="product-type">Studio</div>
                    <h3 class="product-title">Studio</h3>
                    <div class="product-area">Diện tích: 38.24m²</div>
                </div>
            </div>

            <!-- Product 12 -->
            <div class="product-card" onclick="openFullscreenModal(12)">
                <img src="<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_S1'); ?>" alt="Studio S1" class="product-image">
                <div class="product-overlay">
                    <div class="product-overlay-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="product-overlay-text">Xem chi tiết</div>
                </div>
                <div class="product-info">
                    <div class="product-type">Studio</div>
                    <h3 class="product-title">Studio S1</h3>
                    <div class="product-area">Diện tích: 42.18m²</div>
                </div>
            </div>

            <!-- Product 13 -->
            <div class="product-card" onclick="openFullscreenModal(13)">
                <img src="<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_PENTHOUSE-01'); ?>" alt="Penthouse 01" class="product-image">
                <div class="product-overlay">
                    <div class="product-overlay-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="product-overlay-text">Xem chi tiết</div>
                </div>
                <div class="product-info">
                    <div class="product-type">Penthouse</div>
                    <h3 class="product-title">Penthouse 01</h3>
                    <div class="product-area">Diện tích: 285.75m²</div>
                </div>
            </div>

            <!-- Product 14 -->
            <div class="product-card" onclick="openFullscreenModal(14)">
                <img src="<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_PENTHOUSE-02'); ?>" alt="Penthouse 02" class="product-image">
                <div class="product-overlay">
                    <div class="product-overlay-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="product-overlay-text">Xem chi tiết</div>
                </div>
                <div class="product-info">
                    <div class="product-type">Penthouse</div>
                    <h3 class="product-title">Penthouse 02</h3>
                    <div class="product-area">Diện tích: 342.18m²</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fullscreen Modal -->
<div class="modal fade modal-fullscreen" id="fullscreenModal" tabindex="-1" role="dialog" aria-labelledby="fullscreenModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fullscreenModalLabel">Sản phẩm dự án</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="fullscreenImage" src="" alt="Product Image" class="fullscreen-image">
            </div>
            <div class="modal-footer">
                <div class="navigation-controls">
                    <button type="button" class="nav-btn" id="prevImage" onclick="navigateImage(-1)">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <span class="image-counter" id="imageCounter">1 / 14</span>
                    <button type="button" class="nav-btn" id="nextImage" onclick="navigateImage(1)">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Product images data
const productImages = [
    { src: "<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_1PN1'); ?>", alt: "Căn hộ 1PN+1" },
    { src: "<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_2PN1A'); ?>", alt: "Căn hộ 2PN+1A" },
    { src: "<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_2PN2'); ?>", alt: "Căn hộ 2PN+2" },
    { src: "<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_2PN4'); ?>", alt: "Căn hộ 2PN+4" },
    { src: "<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_2PN4A'); ?>", alt: "Căn hộ 2PN+4A" },
    { src: "<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_3PN1'); ?>", alt: "Căn hộ 3PN+1" },
    { src: "<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_3PN1A'); ?>", alt: "Căn hộ 3PN+1A" },
    { src: "<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_3PN2'); ?>", alt: "Căn hộ 3PN+2" },
    { src: "<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_3PN3'); ?>", alt: "Căn hộ 3PN+3" },
    { src: "<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_3PN3A'); ?>", alt: "Căn hộ 3PN+3A" },
    { src: "<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_STUDIO'); ?>", alt: "Studio" },
    { src: "<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_S1'); ?>", alt: "Studio S1" },
    { src: "<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_PENTHOUSE-01'); ?>", alt: "Penthouse 01" },
    { src: "<?php echo get_attachment_url_by_slug('SUNSET-LAYOUT-CAN_PENTHOUSE-02'); ?>", alt: "Penthouse 02" }
];

let currentImageIndex = 0;

// Gallery zoom and pan - Clean implementation
let isZoomed = false;
let panInterval = null;
let mouseX = 0, mouseY = 0;

// Initialize when DOM is ready
jQuery(document).ready(function($) {
    // Ensure jQuery is loaded
    if (typeof jQuery === 'undefined') {
        console.error('jQuery is not loaded!');
        return;
    }
    // Initialize when modal opens (Bootstrap v4 syntax)
    $('#fullscreenModal').on('shown.bs.modal', function() {
        console.log('Modal opened - setting up zoom/pan');
        resetZoomState();
        setupImageEvents();
    });

    // Reset when modal closes (Bootstrap v4 syntax)
    $('#fullscreenModal').on('hidden.bs.modal', function() {
        console.log('Modal closed - resetting zoom/pan');
        resetZoomState();
    });

    // ESC key to close modal
    $(document).on('keydown', function(e) {
        if (e.which === 27 && $('#fullscreenModal').hasClass('show')) {
            $('#fullscreenModal').modal('hide');
        }
    });
});

function resetZoomState() {
    isZoomed = false;
    if (panInterval) {
        clearInterval(panInterval);
        panInterval = null;
    }
    
    const image = document.querySelector('.fullscreen-image');
    if (image) {
        image.style.transform = 'scale(1) translate(0, 0)';
        image.style.cursor = 'zoom-in';
        image.style.transition = 'transform 0.3s ease';
    }
}

function setupImageEvents() {
    const image = document.querySelector('.fullscreen-image');
    if (!image) {
        console.log('No image found for setupImageEvents');
        return;
    }
    
    console.log('Setting up image events');
    
    // Remove old event listeners by cloning
    const newImage = image.cloneNode(true);
    image.parentNode.replaceChild(newImage, image);
    
    const freshImage = document.querySelector('.fullscreen-image');
    
    // Click to zoom in/out
    freshImage.addEventListener('click', function(e) {
        console.log('Image clicked');
        if (e.detail === 1) { // Single click only
            if (!isZoomed) {
                console.log('Zooming in');
                zoomIn(freshImage, e);
            } else {
                console.log('Zooming out');
                zoomOut(freshImage);
            }
        }
    });
    
    // Track mouse position globally
    document.addEventListener('mousemove', function(e) {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });
    
    // Stop panning when mouse leaves viewport
    document.addEventListener('mouseleave', function() {
        if (panInterval) {
            clearInterval(panInterval);
            panInterval = null;
        }
    });
    
    // Restart panning when window regains focus (fix for app switching)
    window.addEventListener('focus', function() {
        if (isZoomed) {
            startPanning();
        }
    });
    
    // Stop panning when window loses focus
    window.addEventListener('blur', function() {
        if (panInterval) {
            clearInterval(panInterval);
            panInterval = null;
        }
    });
}

function zoomIn(image, e) {
    const rect = image.getBoundingClientRect();
    const clickX = e.clientX - rect.left;
    const clickY = e.clientY - rect.top;
    
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;
    const offsetX = clickX - centerX;
    const offsetY = clickY - centerY;
    
    const zoomLevel = 2;
    const translateX = -offsetX * (zoomLevel - 1);
    const translateY = -offsetY * (zoomLevel - 1);
    
    image.style.transform = `scale(${zoomLevel}) translate(${translateX}px, ${translateY}px)`;
    image.style.cursor = 'move';
    image.style.transition = 'transform 0.3s ease';
    
    isZoomed = true;
    startPanning();
}

function zoomOut(image) {
    image.style.transform = 'scale(1) translate(0, 0)';
    image.style.cursor = 'zoom-in';
    image.style.transition = 'transform 0.3s ease';
    
    isZoomed = false;
    stopPanning();
}

function startPanning() {
    if (panInterval) return;
    
    panInterval = setInterval(function() {
        if (!isZoomed) return;
        
        const image = document.querySelector('.fullscreen-image');
        if (!image) return;
        
        let panX = 0, panY = 0;
        
        // Left edge (300px from left)
        if (mouseX < 300) {
            panX = 1.5;
        }
        // Right edge (300px from right)
        else if (mouseX > window.innerWidth - 300) {
            panX = -1.5;
        }
        
        // Top edge (200px from top)
        if (mouseY < 200) {
            panY = 1.5;
        }
        // Bottom edge (200px from bottom)
        else if (mouseY > window.innerHeight - 200) {
            panY = -1.5;
        }
        
        // Apply pan
        if (panX !== 0 || panY !== 0) {
            console.log('Panning:', { mouseX, mouseY, panX, panY });
            const currentTransform = image.style.transform;
            const translateMatch = currentTransform.match(/translate\(([^)]+)\)/);
            
            let currentTranslateX = 0, currentTranslateY = 0;
            if (translateMatch) {
                const coords = translateMatch[1].split(',');
                currentTranslateX = parseFloat(coords[0]) || 0;
                currentTranslateY = parseFloat(coords[1]) || 0;
            }
            
            const newTranslateX = currentTranslateX + panX;
            const newTranslateY = currentTranslateY + panY;
            
            image.style.transform = `scale(2) translate(${newTranslateX}px, ${newTranslateY}px)`;
            image.style.transition = 'none';
        }
    }, 16); // ~60fps
}

function stopPanning() {
    if (panInterval) {
        clearInterval(panInterval);
        panInterval = null;
    }
}

function openFullscreenModal(index) {
    currentImageIndex = index - 1;
    updateFullscreenImage();
    jQuery('#fullscreenModal').modal('show');
}

function navigateImage(direction) {
    currentImageIndex += direction;
    
    // Loop through images
    if (currentImageIndex >= productImages.length) {
        currentImageIndex = 0;
    } else if (currentImageIndex < 0) {
        currentImageIndex = productImages.length - 1;
    }
    
    updateFullscreenImage();
}

function updateFullscreenImage() {
    const image = productImages[currentImageIndex];
    document.getElementById('fullscreenImage').src = image.src;
    document.getElementById('fullscreenImage').alt = image.alt;
    document.getElementById('imageCounter').textContent = `${currentImageIndex + 1} / ${productImages.length}`;
    
    // Update navigation buttons
    document.getElementById('prevImage').disabled = false;
    document.getElementById('nextImage').disabled = false;
}

// Keyboard navigation
jQuery(document).ready(function($) {
    $(document).keydown(function(e) {
        if ($('#fullscreenModal').hasClass('show')) {
            switch(e.which) {
                case 37: // Left arrow
                    navigateImage(-1);
                    break;
                case 39: // Right arrow
                    navigateImage(1);
                    break;
                case 27: // Escape
                    $('#fullscreenModal').modal('hide');
                    break;
            }
        }
    });
    
    // Close modal when clicking outside image
    $('#fullscreenModal').on('click', function(e) {
        if (e.target === this) {
            $(this).modal('hide');
        }
    });
});
</script>

<?php get_footer(); ?>
