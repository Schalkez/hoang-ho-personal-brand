<?php
/*
Template Name: 404 Page Not Found
*/

get_header(); ?>

<main>
    <div class="page-404">
        <!-- Hero Section -->
        <section class="section section-404-hero" data-hash="404" data-toggle-theme="white" style="padding-top: 120px;">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-lg-8 col-12 text-center">
                        <div class="error-content" data-aos="fade-up" data-aos-delay="0">
                            <!-- 404 Number -->
                            <div class="error-number" data-aos="fade-up" data-aos-delay="100">
                                <span class="number-404">404</span>
                            </div>
                            
                            <!-- Error Message -->
                            <h1 class="error-title" data-aos="fade-up" data-aos-delay="200">
                                <span class="top-title">Trang không tồn tại</span>
                                <span class="bot-title">Page Not Found</span>
                            </h1>
                            
                            <!-- Error Description -->
                            <div class="error-description" data-aos="fade-up" data-aos-delay="300">
                                <p>Xin lỗi, trang bạn đang tìm kiếm không tồn tại hoặc đã được di chuyển.</p>
                                <p>Sorry, the page you are looking for does not exist or has been moved.</p>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="error-actions" data-aos="fade-up" data-aos-delay="400">
                                <a href="<?php echo home_url(); ?>" class="btn btn-primary btn-home">
                                    <span>Về trang chủ</span>
                                    <div class="btn-bg"></div>
                                </a>
                                <a href="<?php echo home_url('/phap-ly-du-an'); ?>" class="btn btn-secondary btn-legal">
                                    <span>Pháp lý dự án</span>
                                    <div class="btn-bg"></div>
                                </a>
                                <a href="<?php echo home_url('/bo-suu-tap-can-ho'); ?>" class="btn btn-secondary btn-products">
                                    <span>Bộ sưu tập căn hộ</span>
                                    <div class="btn-bg"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Links Section -->
        <section class="section section-404-links" data-hash="quick-links" data-toggle-theme="black">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="section-title text-center" data-aos="fade-up" data-aos-delay="0">
                            <span class="top">Có thể bạn quan tâm</span>
                            <span class="bot">You might be interested</span>
                        </h2>
                    </div>
                </div>
                
                <div class="row justify-content-center">
                    <!-- Project Info Card -->
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="quick-link-card">
                            <div class="card-image">
                                <img src="<?php echo home_url('/wp-content/uploads/2025/09/MEYPEARL_V07_OVERVIEW5_FINAL-768x549.webp'); ?>" 
                                     alt="Thông tin dự án" 
                                     loading="lazy" />
                                <div class="card-overlay">
                                    <div class="overlay-content">
                                        <h3>Thông tin dự án</h3>
                                        <p>Project Information</p>
                                        <a href="<?php echo home_url(); ?>#project-info" class="btn btn-outline">
                                            <span>Xem chi tiết</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Legal Documents Card -->
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="quick-link-card">
                            <div class="card-image">
                                <img src="<?php echo home_url('/wp-content/uploads/2025/09/MEYPEARL_V12_VIEW-BALCONY-1-1-800x600.webp'); ?>" 
                                     alt="Pháp lý dự án" 
                                     loading="lazy" />
                                <div class="card-overlay">
                                    <div class="overlay-content">
                                        <h3>Pháp lý dự án</h3>
                                        <p>Legal Documents</p>
                                        <a href="<?php echo home_url('/phap-ly-du-an'); ?>" class="btn btn-outline">
                                            <span>Xem chi tiết</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Products Card -->
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="quick-link-card">
                            <div class="card-image">
                                <img src="<?php echo home_url('/wp-content/uploads/2025/09/VIEWBALCONY_FINAL2@1x_1-1-2048x1024.webp'); ?>" 
                                     alt="Bộ sưu tập căn hộ" 
                                     loading="lazy" />
                                <div class="card-overlay">
                                    <div class="overlay-content">
                                        <h3>Bộ sưu tập căn hộ</h3>
                                        <p>Apartment Collection</p>
                                        <a href="<?php echo home_url('/bo-suu-tap-can-ho'); ?>" class="btn btn-outline">
                                            <span>Xem chi tiết</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="section section-404-contact" data-hash="contact" data-toggle-theme="black">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-12 text-center">
                        <div class="contact-info" data-aos="fade-up" data-aos-delay="0">
                            <h3 class="contact-title">Cần hỗ trợ?</h3>
                            <p class="contact-description">Nếu bạn vẫn gặp khó khăn trong việc tìm kiếm thông tin, hãy liên hệ với chúng tôi.</p>
                            
                            <div class="contact-methods">
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <span>+84 921 010 111</span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>info@hoangvubro.vn</span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>127 Kim Phượng, Phú Quốc, An Giang</span>
                                </div>
                            </div>
                            
                            <a href="#footer" class="btn btn-consultation" data-toggle="modal" data-target="#consultationModal">
                                <span>Đăng ký tư vấn</span>
                                <div class="btn-bg"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<style>
/* 404 Page Styles */
.page-404 {
    min-height: 100vh;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}

/* Hero Section */
.section-404-hero {
    min-height: 100vh;
    background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);
    position: relative;
    overflow: hidden;
}

.section-404-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('<?php echo get_template_directory_uri(); ?>/assets/images/404/hero-pattern.svg') center/cover;
    opacity: 0.1;
}

.error-content {
    position: relative;
    z-index: 2;
    color: white;
}

.error-number {
    margin-bottom: 30px;
}

.number-404 {
    font-size: 120px;
    font-weight: 900;
    color: #DDC19A;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    font-family: 'Playfair Display', serif;
    line-height: 1;
}

.error-title {
    margin-bottom: 30px;
}

.error-title .top-title {
    display: block;
    font-size: 48px;
    font-weight: 700;
    color: white;
    margin-bottom: 10px;
    font-family: 'Playfair Display', serif;
}

.error-title .bot-title {
    display: block;
    font-size: 24px;
    font-weight: 400;
    color: #DDC19A;
    opacity: 0.8;
}

.error-description {
    margin-bottom: 40px;
    font-size: 18px;
    line-height: 1.6;
    opacity: 0.9;
}

.error-description p {
    margin-bottom: 10px;
}

.error-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.btn-home,
.btn-legal,
.btn-products {
    position: relative;
    padding: 15px 30px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 16px;
    text-transform: uppercase;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.btn-home {
    background: linear-gradient(135deg, #DDC19A, #C4A882);
    color: #2C3E50;
}

.btn-legal,
.btn-products {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
}

.btn-bg {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #C4A882, #DDC19A);
    transition: left 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    z-index: 1;
}

.btn-home span,
.btn-legal span,
.btn-products span {
    position: relative;
    z-index: 2;
    transition: all 0.3s ease;
}

.btn-home:hover,
.btn-legal:hover,
.btn-products:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

.btn-home:hover .btn-bg,
.btn-legal:hover .btn-bg,
.btn-products:hover .btn-bg {
    left: 0;
}

.btn-home:hover span,
.btn-legal:hover span,
.btn-products:hover span {
    color: #1A252F;
    text-shadow: 0 1px 2px rgba(255, 255, 255, 0.3);
}

/* Quick Links Section */
.section-404-links {
    padding: 80px 0;
    background: white;
}

.section-title {
    margin-bottom: 60px;
}

.section-title .top {
    display: block;
    font-size: 36px;
    font-weight: 700;
    color: #2C3E50;
    margin-bottom: 10px;
    font-family: 'Playfair Display', serif;
}

.section-title .bot {
    display: block;
    font-size: 20px;
    font-weight: 400;
    color: #DDC19A;
    opacity: 0.8;
}

.quick-link-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 300px;
}

.quick-link-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
}

.card-image {
    position: relative;
    height: 100%;
    overflow: hidden;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.quick-link-card:hover .card-image img {
    transform: scale(1.1);
}

.card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(44, 62, 80, 0.9), rgba(52, 73, 94, 0.8));
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.quick-link-card:hover .card-overlay {
    opacity: 1;
}

.overlay-content {
    text-align: center;
    color: white;
    padding: 20px;
}

.overlay-content h3 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 10px;
    font-family: 'Playfair Display', serif;
}

.overlay-content p {
    font-size: 16px;
    opacity: 0.8;
    margin-bottom: 20px;
}

.btn-outline {
    background: transparent;
    border: 2px solid #DDC19A;
    color: #DDC19A;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline:hover {
    background: #DDC19A;
    color: #2C3E50;
    transform: translateY(-2px);
}

/* Contact Section */
.section-404-contact {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}

.contact-info {
    color: #2C3E50;
}

.contact-title {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 20px;
    font-family: 'Playfair Display', serif;
}

.contact-description {
    font-size: 18px;
    margin-bottom: 40px;
    opacity: 0.8;
}

.contact-methods {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
    margin-bottom: 40px;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 16px;
    font-weight: 500;
}

.contact-item i {
    color: #DDC19A;
    font-size: 18px;
    width: 20px;
}

.btn-consultation {
    position: relative;
    background: linear-gradient(135deg, #DDC19A, #C4A882);
    color: #2C3E50;
    padding: 15px 30px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 16px;
    text-transform: uppercase;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(221, 193, 154, 0.3);
}

.btn-consultation .btn-bg {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #C4A882, #DDC19A);
    transition: left 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    z-index: 1;
}

.btn-consultation span {
    position: relative;
    z-index: 2;
    transition: all 0.3s ease;
}

.btn-consultation:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(221, 193, 154, 0.5);
}

.btn-consultation:hover .btn-bg {
    left: 0;
}

.btn-consultation:hover span {
    color: #1A252F;
    text-shadow: 0 1px 2px rgba(255, 255, 255, 0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .section-404-hero {
        padding-top: 100px !important;
    }
    
    .number-404 {
        font-size: 80px;
    }
    
    .error-title .top-title {
        font-size: 32px;
    }
    
    .error-title .bot-title {
        font-size: 18px;
    }
    
    .error-description {
        font-size: 16px;
    }
    
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-home,
    .btn-legal,
    .btn-products {
        width: 100%;
        max-width: 300px;
    }
    
    .contact-methods {
        flex-direction: column;
        align-items: center;
    }
    
    .section-title .top {
        font-size: 28px;
    }
    
    .contact-title {
        font-size: 28px;
    }
}
</style>

<?php get_footer(); ?>
