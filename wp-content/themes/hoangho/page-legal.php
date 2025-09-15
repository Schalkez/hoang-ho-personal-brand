<?php
/*
Template Name: Pháp lý dự án
*/

// Helper function to get attachment ID by slug
function get_attachment_id_by_slug($slug) {
    global $wpdb;
    $attachment = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE post_name = %s AND post_type = 'attachment'", $slug));
    return $attachment;
}

get_header();
?>

<style>
.legal-hero {
    background: linear-gradient(135deg, #062537 0%, #0a2f47 100%);
    padding: 120px 0 80px;
    color: white;
    position: relative;
    overflow: hidden;
}

.legal-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('<?php echo get_template_directory_uri(); ?>/assets/images/legal-pattern.png') center/cover;
    opacity: 0.1;
    z-index: 1;
}

.legal-hero .container {
    position: relative;
    z-index: 2;
}

.legal-hero h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.legal-hero p {
    font-size: 1.2rem;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
}

.legal-section {
    padding: 80px 0;
    background: #f8f9fa;
}

.legal-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-top: 50px;
    align-items: stretch;
}

.legal-document {
    background: #ffffff;
    border-radius: 8px;
    padding: 0;
    border: 1px solid #e8eaed;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    display: flex;
    flex-direction: column;
    height: 100%;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.legal-document:hover {
    box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
}

.legal-document-header {
    display: flex;
    align-items: center;
    padding: 24px 24px 16px 24px;
    margin-bottom: 0;
}

.legal-document-icon {
    width: 40px;
    height: 40px;
    background: #f8f9fa;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
    color: #5f6368;
    font-size: 18px;
    font-weight: 500;
    border: 1px solid #dadce0;
}

.legal-document-title {
    flex: 1;
}

.legal-document-title h3 {
    font-size: 1.375rem;
    font-weight: 400;
    color: #202124;
    margin: 0 0 4px 0;
    line-height: 1.5;
    font-family: 'Google Sans', Roboto, Arial, sans-serif;
}

.legal-document-title .document-number {
    color: #5f6368;
    font-size: 0.875rem;
    margin: 0;
    font-weight: 400;
    line-height: 1.4;
}

.legal-document-preview {
    margin: 0 16px 16px 16px;
    border-radius: 4px;
    overflow: hidden;
    background: #f8f9fa;
    flex: 1;
    border: 1px solid #e8eaed;
}

.legal-document-preview img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: opacity 0.2s ease;
}

.legal-document:hover .legal-document-preview img {
    opacity: 0.9;
}

.legal-document-actions {
    display: flex;
    gap: 8px;
    margin-top: auto;
    padding: 16px 16px 16px 16px;
    border-top: 1px solid #e8eaed;
}

.btn-view-document {
    flex: 1;
    background: #DDC19A;
    border: none;
    color: #ffffff;
    padding: 8px 24px;
    border-radius: 4px;
    font-weight: 500;
    text-decoration: none;
    text-align: center;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 0.875rem;
    font-family: 'Google Sans', Roboto, Arial, sans-serif;
    text-transform: none;
    letter-spacing: 0.25px;
}

.btn-view-document:hover {
    background: #C4A882;
    color: #ffffff;
    text-decoration: none;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.btn-view-document:focus {
    background: #C4A882;
    outline: 2px solid #DDC19A;
    outline-offset: 2px;
}

.btn-download {
    background: #ffffff;
    border: 1px solid #dadce0;
    color: #5f6368;
    padding: 8px 24px;
    border-radius: 4px;
    font-weight: 500;
    text-decoration: none;
    text-align: center;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    min-width: 120px;
    font-size: 0.875rem;
    font-family: 'Google Sans', Roboto, Arial, sans-serif;
    text-transform: none;
    letter-spacing: 0.25px;
}

.btn-download:hover {
    background: #f8f9fa;
    border-color: #dadce0;
    color: #202124;
    text-decoration: none;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.btn-download:focus {
    background: #f8f9fa;
    outline: 2px solid #1a73e8;
    outline-offset: 2px;
}

.legal-info-section {
    padding: 80px 0;
    background: white;
}

.legal-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
    margin-top: 50px;
}

.legal-info-card {
    text-align: center;
    padding: 40px 20px;
}

.legal-info-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #DDC19A, #C4A882);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    color: white;
    font-size: 32px;
}

.legal-info-card h4 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #2C3E50;
    margin-bottom: 15px;
}

.legal-info-card p {
    color: #7f8c8d;
    line-height: 1.6;
}

/* Modal Styles */
.modal-legal {
    z-index: 99999;
}

.modal-legal .modal-dialog {
    max-width: 90vw;
    max-height: 90vh;
}

.modal-legal .modal-content {
    border-radius: 20px;
    border: none;
    overflow: hidden;
}

.modal-legal .modal-header {
    background: linear-gradient(135deg, #062537, #0a2f47);
    color: white;
    border-bottom: none;
    padding: 20px 30px;
}

.modal-legal .modal-header .close {
    color: white;
    opacity: 0.8;
    font-size: 28px;
}

.modal-legal .modal-header .close:hover {
    opacity: 1;
}

.modal-legal .modal-body {
    padding: 30px;
}

.document-viewer {
    text-align: center;
}

.document-viewer img {
    max-width: 100%;
    height: auto;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.document-navigation {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 30px;
}

.btn-nav {
    background: #6c757d;
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-nav:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

.btn-nav:disabled {
    background: #dee2e6;
    color: #6c757d;
    cursor: not-allowed;
    transform: none;
}

.document-info {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 15px;
    margin-top: 20px;
}

.document-info h5 {
    color: #2C3E50;
    margin-bottom: 10px;
}

.document-info p {
    color: #7f8c8d;
    margin: 0;
}

/* Responsive */
@media (max-width: 1200px) {
    .legal-grid {
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 25px;
    }
}

@media (max-width: 992px) {
    .legal-grid {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }
    
    .legal-document {
        padding: 25px;
    }
    
    .legal-document-preview img {
        height: 180px;
    }
}

@media (max-width: 768px) {
    .legal-hero {
        padding: 100px 0 70px;
    }
    
    .legal-hero h1 {
        font-size: 2.5rem;
    }
    
    .legal-section {
        padding: 70px 0;
    }
    
    .legal-grid {
        grid-template-columns: 1fr;
        gap: 20px;
        margin-top: 40px;
    }
    
    .legal-document {
        padding: 20px;
    }
    
    .legal-document-header {
        flex-direction: column;
        text-align: center;
        margin-bottom: 15px;
    }
    
    .legal-document-icon {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .legal-document-actions {
        flex-direction: column;
        gap: 12px;
    }
    
    .btn-view-document,
    .btn-download {
        width: 100%;
        min-width: auto;
    }
    
    .modal-legal .modal-dialog {
        max-width: 95vw;
        margin: 10px;
    }
    
    .modal-legal .modal-body {
        padding: 20px;
    }
}

@media (max-width: 576px) {
    .legal-hero {
        padding: 80px 0 50px;
    }
    
    .legal-hero h1 {
        font-size: 2rem;
    }
    
    .legal-hero p {
        font-size: 1rem;
    }
    
    .legal-section {
        padding: 50px 0;
    }
    
    .legal-grid {
        margin-top: 30px;
    }
    
    .legal-document {
        padding: 15px;
    }
    
    .legal-document-title h3 {
        font-size: 1.4rem;
    }
    
    .legal-document-preview {
        margin: 15px 0;
    }
    
    .legal-document-preview img {
        height: 160px;
    }
    
    .legal-info-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}

@media (max-width: 480px) {
    .legal-hero h1 {
        font-size: 1.8rem;
    }
    
    .legal-document-title h3 {
        font-size: 1.3rem;
    }
    
    .legal-document-preview img {
        height: 140px;
    }
}
</style>

<!-- Hero Section -->
<section class="legal-hero">
    <div class="container">
        <div class="text-center">
            <h1>Pháp lý dự án</h1>
            <p>Đầy đủ giấy phép và chứng nhận pháp lý minh bạch, đảm bảo an toàn pháp lý tuyệt đối cho nhà đầu tư</p>
        </div>
    </div>
</section>

<!-- Legal Documents Section -->
<section class="legal-section">
    <div class="container">
        <div class="text-center">
            <h2 style="font-size: 2.5rem; font-weight: 700; color: #2C3E50; margin-bottom: 1rem;">Giấy phép & Chứng nhận</h2>
            <p style="font-size: 1.1rem; color: #7f8c8d; max-width: 600px; margin: 0 auto;">Tất cả các giấy tờ pháp lý đã được cấp phép bởi các cơ quan có thẩm quyền</p>
        </div>
        
        <div class="legal-grid">
            <!-- Document 1 -->
            <div class="legal-document">
                <div class="legal-document-header">
                    <div class="legal-document-icon">1</div>
                    <div class="legal-document-title">
                        <h3>Bảo lãnh ngân hàng</h3>
                        <p class="document-number">Bank Guarantee</p>
                    </div>
                </div>
                <div class="legal-document-preview">
                    <img src="<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Bao-lanh-ngan-hang-trang-dau')); ?>" alt="Bảo lãnh ngân hàng - Trang đầu">
                </div>
                <div class="legal-document-actions">
                    <a href="#" class="btn-view-document" onclick="openLegalModal(1)">
                        <i class="fas fa-eye"></i> Xem chi tiết
                    </a>
                    <a href="<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Bao-lanh-ngan-hang-trang-dau')); ?>" class="btn-download" download>
                        <i class="fas fa-download"></i> Tải về
                    </a>
                </div>
            </div>

            <!-- Document 2 -->
            <div class="legal-document">
                <div class="legal-document-header">
                    <div class="legal-document-icon">2</div>
                    <div class="legal-document-title">
                        <h3>Chủ trương đầu tư</h3>
                        <p class="document-number">Investment Policy</p>
                    </div>
                </div>
                <div class="legal-document-preview">
                    <img src="<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Chu-truong-dau-tu-trang-dau')); ?>" alt="Chủ trương đầu tư - Trang đầu">
                </div>
                <div class="legal-document-actions">
                    <a href="#" class="btn-view-document" onclick="openLegalModal(2)">
                        <i class="fas fa-eye"></i> Xem chi tiết
                    </a>
                    <a href="<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Chu-truong-dau-tu-trang-dau')); ?>" class="btn-download" download>
                        <i class="fas fa-download"></i> Tải về
                    </a>
                </div>
            </div>

            <!-- Document 3 -->
            <div class="legal-document">
                <div class="legal-document-header">
                    <div class="legal-document-icon">3</div>
                    <div class="legal-document-title">
                        <h3>Hợp đồng mua bán đã được duyệt</h3>
                        <p class="document-number">Approved Purchase Agreement</p>
                    </div>
                </div>
                <div class="legal-document-preview">
                    <img src="<?php echo wp_get_attachment_url(get_attachment_id_by_slug('hop-dong-mua-ban-da-duoc-duyet')); ?>" alt="Hợp đồng mua bán đã được duyệt">
                </div>
                <div class="legal-document-actions">
                    <a href="#" class="btn-view-document" onclick="openLegalModal(3)">
                        <i class="fas fa-eye"></i> Xem chi tiết
                    </a>
                    <a href="<?php echo wp_get_attachment_url(get_attachment_id_by_slug('hop-dong-mua-ban-da-duoc-duyet')); ?>" class="btn-download" download>
                        <i class="fas fa-download"></i> Tải về
                    </a>
                </div>
            </div>

            <!-- Document 4 -->
            <div class="legal-document">
                <div class="legal-document-header">
                    <div class="legal-document-icon">4</div>
                    <div class="legal-document-title">
                        <h3>Giấy chứng nhận quyền sử dụng đất</h3>
                        <p class="document-number">Land Use Right Certificate</p>
                    </div>
                </div>
                <div class="legal-document-preview">
                    <img src="<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Chung-nhan-quyen-su-dung-mat-ngoai')); ?>" alt="Giấy chứng nhận quyền sử dụng đất - Mặt ngoài">
                </div>
                <div class="legal-document-actions">
                    <a href="#" class="btn-view-document" onclick="openLegalModal(4)">
                        <i class="fas fa-eye"></i> Xem chi tiết
                    </a>
                    <a href="<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Chung-nhan-quyen-su-dung-mat-ngoai')); ?>" class="btn-download" download>
                        <i class="fas fa-download"></i> Tải về
                    </a>
                </div>
            </div>

            <!-- Document 5 -->
            <div class="legal-document">
                <div class="legal-document-header">
                    <div class="legal-document-icon">5</div>
                    <div class="legal-document-title">
                        <h3>Giấy phép xây dựng</h3>
                        <p class="document-number">Construction Permit</p>
                    </div>
                </div>
                <div class="legal-document-preview">
                    <img src="<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Giay-phep-xay-dung-trang-dau')); ?>" alt="Giấy phép xây dựng - Trang đầu">
                </div>
                <div class="legal-document-actions">
                    <a href="#" class="btn-view-document" onclick="openLegalModal(5)">
                        <i class="fas fa-eye"></i> Xem chi tiết
                    </a>
                    <a href="<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Giay-phep-xay-dung-trang-dau')); ?>" class="btn-download" download>
                        <i class="fas fa-download"></i> Tải về
                    </a>
                </div>
            </div>

            <!-- Document 6 -->
            <div class="legal-document">
                <div class="legal-document-header">
                    <div class="legal-document-icon">6</div>
                    <div class="legal-document-title">
                        <h3>Thông báo đủ điều kiện mở bán</h3>
                        <p class="document-number">Sales Approval Notice</p>
                    </div>
                </div>
                <div class="legal-document-preview">
                    <img src="<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Thong-bao-du-dieu-kien-mo-ban-trang-dau')); ?>" alt="Thông báo đủ điều kiện mở bán - Trang đầu">
                </div>
                <div class="legal-document-actions">
                    <a href="#" class="btn-view-document" onclick="openLegalModal(6)">
                        <i class="fas fa-eye"></i> Xem chi tiết
                    </a>
                    <a href="<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Thong-bao-du-dieu-kien-mo-ban-trang-dau')); ?>" class="btn-download" download>
                        <i class="fas fa-download"></i> Tải về
                    </a>
                </div>
            </div>

            <!-- Document 7 -->
            <div class="legal-document">
                <div class="legal-document-header">
                    <div class="legal-document-icon">7</div>
                    <div class="legal-document-title">
                        <h3>Quy hoạch 1.500</h3>
                        <p class="document-number">1.500 Planning</p>
                    </div>
                </div>
                <div class="legal-document-preview">
                    <img src="<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Quy-hoach-1500-trang-dau')); ?>" alt="Quy hoạch 1.500 - Trang đầu">
                </div>
                <div class="legal-document-actions">
                    <a href="#" class="btn-view-document" onclick="openLegalModal(7)">
                        <i class="fas fa-eye"></i> Xem chi tiết
                    </a>
                    <a href="<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Quy-hoach-1500-trang-dau')); ?>" class="btn-download" download>
                        <i class="fas fa-download"></i> Tải về
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Legal Info Section -->
<section class="legal-info-section">
    <div class="container">
        <div class="text-center">
            <h2 style="font-size: 2.5rem; font-weight: 700; color: #2C3E50; margin-bottom: 1rem;">Cam kết pháp lý</h2>
            <p style="font-size: 1.1rem; color: #7f8c8d; max-width: 600px; margin: 0 auto;">Đảm bảo minh bạch và tuân thủ đầy đủ các quy định pháp luật</p>
        </div>
        
        <div class="legal-info-grid">
            <div class="legal-info-card">
                <div class="legal-info-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h4>Minh bạch pháp lý</h4>
                <p>Tất cả giấy tờ pháp lý được công khai minh bạch, đảm bảo quyền lợi tối đa cho khách hàng</p>
            </div>
            
            <div class="legal-info-card">
                <div class="legal-info-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <h4>Chứng nhận chính thức</h4>
                <p>Được cấp bởi các cơ quan có thẩm quyền, đảm bảo tính pháp lý và độ tin cậy cao</p>
            </div>
            
            <div class="legal-info-card">
                <div class="legal-info-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <h4>Cam kết dài hạn</h4>
                <p>Đảm bảo quyền lợi bền vững cho nhà đầu tư với các cam kết pháp lý rõ ràng</p>
            </div>
        </div>
    </div>
</section>

<!-- Legal Document Modal -->
<div class="modal fade modal-legal" id="legalModal" tabindex="-1" role="dialog" aria-labelledby="legalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="legalModalLabel">Giấy phép dự án</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="document-viewer">
                    <img id="legalDocumentImage" src="" alt="Legal Document" style="max-width: 100%; height: auto;">
                </div>
                
                <div class="document-navigation">
                    <button type="button" class="btn btn-nav" id="prevPage" onclick="switchPage('prev')">
                        <i class="fas fa-chevron-left"></i> Trang trước
                    </button>
                    <span id="pageIndicator" style="padding: 10px 20px; background: #f8f9fa; border-radius: 8px; font-weight: 600; color: #2C3E50;">Trang 1</span>
                    <button type="button" class="btn btn-nav" id="nextPage" onclick="switchPage('next')">
                        Trang sau <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                
                <div class="document-info">
                    <h5 id="documentTitle">Tên giấy phép</h5>
                    <p id="documentDescription">Mô tả chi tiết về giấy phép này</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Legal documents data
const legalDocuments = {
    1: {
        title: "Bảo lãnh ngân hàng",
        page1: "<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Bao-lanh-ngan-hang-trang-dau')); ?>",
        page2: "<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Bao-lanh-ngan-hang-trang-cuoi')); ?>",
        description: "Bảo lãnh ngân hàng đảm bảo tài chính cho dự án căn hộ du thuyền, được cấp bởi ngân hàng uy tín."
    },
    2: {
        title: "Chủ trương đầu tư",
        page1: "<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Chu-truong-dau-tu-trang-dau')); ?>",
        page2: "<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Chu-truong-dau-tu-trang-cuoi')); ?>",
        description: "Chủ trương đầu tư được phê duyệt bởi cơ quan có thẩm quyền, xác nhận chính sách đầu tư cho dự án căn hộ du thuyền."
    },
    3: {
        title: "Hợp đồng mua bán đã được duyệt",
        page1: "<?php echo wp_get_attachment_url(get_attachment_id_by_slug('hop-dong-mua-ban-da-duoc-duyet')); ?>",
        page2: "<?php echo wp_get_attachment_url(get_attachment_id_by_slug('hop-dong-mua-ban-da-duoc-duyet')); ?>",
        description: "Hợp đồng mua bán bất động sản đã được cơ quan có thẩm quyền phê duyệt, đảm bảo tính pháp lý cho giao dịch."
    },
    4: {
        title: "Giấy chứng nhận quyền sử dụng đất",
        page1: "<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Chung-nhan-quyen-su-dung-mat-ngoai')); ?>",
        page2: "<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Chung-nhan-quyen-su-dung-dat-mat-trong')); ?>",
        description: "Sổ đỏ chính thức xác nhận quyền sử dụng đất lâu dài cho dự án căn hộ du thuyền, bao gồm mặt ngoài và mặt trong."
    },
    5: {
        title: "Giấy phép xây dựng",
        page1: "<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Giay-phep-xay-dung-trang-dau')); ?>",
        page2: "<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Giay-phep-xay-dung-trang-cuoi')); ?>",
        description: "Giấy phép xây dựng cho phép thi công các hạng mục công trình trong dự án căn hộ du thuyền."
    },
    6: {
        title: "Thông báo đủ điều kiện mở bán",
        page1: "<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Thong-bao-du-dieu-kien-mo-ban-trang-dau')); ?>",
        page2: "<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Thong-bao-du-dieu-kien-mo-ban-trang-cuoi')); ?>",
        description: "Thông báo chính thức từ cơ quan có thẩm quyền xác nhận dự án đủ điều kiện để mở bán căn hộ du thuyền."
    },
    7: {
        title: "Quy hoạch 1.500",
        page1: "<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Quy-hoach-1500-trang-dau')); ?>",
        page2: "<?php echo wp_get_attachment_url(get_attachment_id_by_slug('Quy-hoach-1500-trang-cuối')); ?>",
        description: "Bản quy hoạch 1.500 tỷ đồng được phê duyệt bởi cơ quan có thẩm quyền, định hướng phát triển dự án căn hộ du thuyền."
    }
};

let currentDocument = 1;
let currentPage = 'page1';

function openLegalModal(documentId) {
    currentDocument = documentId;
    currentPage = 'page1';
    updateModal();
    $('#legalModal').modal('show');
}

function switchPage(direction) {
    if (direction === 'next' && currentPage === 'page1') {
        currentPage = 'page2';
    } else if (direction === 'prev' && currentPage === 'page2') {
        currentPage = 'page1';
    }
    updateModal();
}

function updateModal() {
    const doc = legalDocuments[currentDocument];
    const imageSrc = currentPage === 'page1' ? doc.page1 : doc.page2;
    const pageText = currentPage === 'page1' ? 'Trang 1' : 'Trang 2';
    
    document.getElementById('legalDocumentImage').src = imageSrc;
    document.getElementById('legalModalLabel').textContent = doc.title;
    document.getElementById('documentTitle').textContent = doc.title;
    document.getElementById('documentDescription').textContent = doc.description;
    document.getElementById('pageIndicator').textContent = pageText;
    
    // Update navigation buttons
    document.getElementById('prevPage').disabled = currentPage === 'page1';
    document.getElementById('nextPage').disabled = currentPage === 'page2';
}

// Close modal when clicking outside
jQuery(document).ready(function($) {
    $('#legalModal').on('hidden.bs.modal', function () {
        // Reset to page 1 when modal is closed
        currentPage = 'page1';
    });
});
</script>

<?php get_footer(); ?>
