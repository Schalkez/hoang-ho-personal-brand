<footer class="section section-footer" data-hash="footer" data-toggle-theme="white">
    <div class="container">
        <div class="content">
            <div class="text-center mb-3">
                <a href="<?php echo home_url(); ?>" class="logo-container">
                    <img src="<?php echo content_url(); ?>/uploads/2025/09/LogoHoangvubro.webp" class="logo" alt="MEYPEARL" />
                </a>
            </div>
            <div class="row d-flex align-items-start g-2">
                <div class="col-lg-9 col-md-6 mb-sm-3">
                    <div class="row">
                        <div class="col-lg-5 mb-sm-3">
                            <p>
                                <strong>CÔNG TY TNHH TM&DV HOÀNG VŨ BRO</strong><br />
                                127 Kim Phượng, Khu dân cư và đô thị cao cấp Hưng Phát, Đặc khu Phú Quốc, Tỉnh An Giang
                            </p>
                        </div>
                        <div class="col-lg-2 mb-sm-3">
                            <p>
                                <strong>Liên hệ</strong><br />
                                <a href="tel:+84921010111">+84 921 010 111</a>
                            </p>
                        </div>
                        <div class="col-lg-2 mb-sm-3">
                            <p>
                                <strong>Email</strong><br />
                                <a href="mailto:info@hoangvubro.vn">info@hoangvubro.vn</a>
                            </p>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col-10">
                            <p style="font-size: 12px; line-height: 1.6; color: #ccc; margin-bottom: 0;">
                                Chúng tôi không chỉ giúp bạn mua một bất động sản, chúng tôi còn đồng hành cùng bạn trên hành trình tạo ra lợi nhuận và gia tăng giá trị tài sản một cách bền vững. Từ việc tìm kiếm những sản phẩm tiềm năng, cam kết giải pháp chốt lời hiệu quả bằng cách tìm kiếm người mua mới, cho đến việc hợp tác cùng đơn vị vận hành uy tín để khai thác dòng tiền ổn định cho những khách hàng muốn kinh doanh. Chúng tôi đảm bảo bất động sản của bạn không chỉ là một khoản đầu tư, mà còn là một tài sản có giá trị thực, đáp ứng nhu cầu ở hoặc kinh doanh trong tương lai.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center mb-3">
                        <button class="btn btn-primary btn-consultation w-100" data-toggle="modal" data-target="#consultationModal" style="background: linear-gradient(135deg, #DDC19A, #C4A882); border: none; padding: 10px 20px; border-radius: 6px; font-weight: 600; color: #2C3E50; font-size: 14px; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); position: relative; overflow: hidden; box-shadow: 0 4px 15px rgba(221, 193, 154, 0.3); transform: translateY(0);">
                            <span style="position: relative; z-index: 2; transition: all 0.3s ease;">ĐĂNG KÝ TƯ VẤN</span>
                            <div style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(135deg, #C4A882, #DDC19A); transition: left 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); z-index: 1;"></div>
                        </button>
                    </div>
                    <style>
                    /* INLINE CSS - ULTRA HIGH PRIORITY */
                    
                    /* Consultation Button Hover Effects */
                    .btn-consultation:hover {
                        transform: translateY(-3px) !important;
                        box-shadow: 0 8px 25px rgba(221, 193, 154, 0.5) !important;
                        background: linear-gradient(135deg, #E8D4B0, #D4B896) !important;
                    }
                    
                    .btn-consultation:hover > div {
                        left: 0 !important;
                    }
                    
                    .btn-consultation:hover span {
                        color: #1A252F !important;
                        text-shadow: 0 1px 2px rgba(255,255,255,0.3);
                    }
                    
                    .btn-consultation:active {
                        transform: translateY(-1px) !important;
                        box-shadow: 0 4px 15px rgba(221, 193, 154, 0.4) !important;
                    }
                    
                    /* Modal Button Hover Effects */
                    .btn-consultation-modal:hover {
                        transform: translateY(-3px) !important;
                        box-shadow: 0 8px 25px rgba(221, 193, 154, 0.5) !important;
                        background: linear-gradient(135deg, #E8D4B0, #D4B896) !important;
                    }
                    
                    .btn-consultation-modal:hover > div {
                        left: 0 !important;
                    }
                    
                    .btn-consultation-modal:hover span {
                        color: #1A252F !important;
                        text-shadow: 0 1px 2px rgba(255,255,255,0.3);
                    }
                    
                    .btn-consultation-modal:active {
                        transform: translateY(-1px) !important;
                        box-shadow: 0 4px 15px rgba(221, 193, 154, 0.4) !important;
                    }
                    
                    /* Investment Button Hover Effects */
                    .btn-consultation-investment:hover {
                        transform: translateY(-3px) !important;
                        box-shadow: 0 8px 25px rgba(221, 193, 154, 0.5) !important;
                        background: linear-gradient(135deg, #E8D4B0, #D4B896) !important;
                    }
                    
                    .btn-consultation-investment:hover > div {
                        left: 0 !important;
                    }
                    
                    .btn-consultation-investment:hover span {
                        color: #1A252F !important;
                        text-shadow: 0 1px 2px rgba(255,255,255,0.3);
                    }
                    
                    .btn-consultation-investment:active {
                        transform: translateY(-1px) !important;
                        box-shadow: 0 4px 15px rgba(221, 193, 154, 0.4) !important;
                    }
                    
                    /* Remove outline from modal inputs */
                    #consultationForm input:focus,
                    #consultationForm input:active {
                        outline: none !important;
                        box-shadow: none !important;
                    }
                    
                    /* Footer font size and family adjustments for each section */
                    .section-footer { 
                        font-size: 12px !important; 
                        font-family: 'HoangHoGotham', sans-serif !important; 
                    }
                    .section-footer p { 
                        font-size: 12px !important; 
                        font-family: 'HoangHoGotham', sans-serif !important; 
                    }
                    .section-footer strong { 
                        font-size: 13px !important; 
                        font-weight: 500 !important; 
                        font-family: 'HoangHoGotham', sans-serif !important; 
                    }
                    .section-footer .logo-container { 
                        font-size: 14px !important; 
                        font-family: 'HoangHoGotham', sans-serif !important; 
                    }
                    .section-footer .copyright { 
                        font-size: 11px !important; 
                        font-family: 'HoangHoGotham', sans-serif !important; 
                    }
                    .section-footer .list-term .item a { 
                        font-size: 11px !important; 
                        font-family: 'HoangHoGotham', sans-serif !important; 
                    }
                    .section-footer .languages li a { 
                        font-size: 12px !important; 
                        font-family: 'HoangHoGotham', sans-serif !important; 
                    }
                    .section-footer .flex-1 { 
                        font-size: 12px !important; 
                        font-family: 'HoangHoGotham', sans-serif !important; 
                    }
                    
                    
                    /* Banner Enhancement - Remove overlay completely for maximum brightness */
                    .banner-slider:hover .item::before {
                        opacity: 0 !important; /* Remove overlay completely */
                    }
                    
                    /* Unified liquid background for both title and description - no layout shift */
                    .banner-slider .item .container {
                        padding: 25px 30px !important; /* Fixed padding to prevent layout shift */
                        border-radius: 30px !important;
                        transition: all 0.2s ease !important;
                    }
                    
                    .banner-slider .item .container:hover,
                    .banner-slider .item .container.hover-active {
                        background: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.12) 0%, rgba(0, 0, 0, 0.08) 30%, rgba(0, 0, 0, 0.04) 60%, rgba(0, 0, 0, 0.02) 80%, transparent 100%) !important;
                        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
                        backdrop-filter: blur(4px) saturate(1.2) brightness(1.05) !important;
                    }
                    
                    /* Modern Box Style cho Value Items - Override style.css */
                    .section-we-are .value-item,
                    section.section-we-are .description .value-item,
                    .value-item {
                        background: transparent !important;
                        border: none !important;
                        border-radius: 0 !important;
                        padding: 0 !important;
                        position: relative !important;
                        transition: all 0.3s ease !important;
                        margin-bottom: 0 !important;
                        width: 450px !important;
                        flex-shrink: 0 !important;
                        display: flex !important;
                        align-items: flex-start !important;
                        box-shadow: none !important;
                        overflow: visible !important;
                        gap: 20px !important;
                    }
                    
                    /* Tắt hiệu ứng line di chuyển */
                    .section-we-are .value-item::before,
                    section.section-we-are .description .value-item::before {
                        content: none !important;
                        display: none !important;
                    }
                    
                    .value-item::before {
                        content: '' !important;
                        position: absolute !important;
                        left: -4px !important;
                        top: 0 !important;
                        bottom: 0 !important;
                        width: 4px !important;
                        background: linear-gradient(180deg, 
                            #DDC19A 0%, 
                            rgba(221, 193, 154, 0.3) 50%, 
                            transparent 100%) !important;
                        opacity: 0 !important;
                        transition: opacity 0.4s ease !important;
                    }
                    
                    .section-we-are .value-item:hover,
                    section.section-we-are .description .value-item:hover,
                    .value-item:hover {
                        transform: translateY(-3px) !important;
                        box-shadow: none !important;
                    }
                    
                    .section-we-are .value-item:hover .value-number,
                    section.section-we-are .description .value-item:hover .value-number,
                    .value-item:hover .value-number {
                        background: #DDC19A !important;
                        transform: scale(1.05) !important;
                    }
                    
                    
                    .section-we-are .value-item .value-number,
                    section.section-we-are .description .value-item .value-number,
                    .value-number {
                        background: #2C3E50 !important;
                        color: white !important;
                        font-size: 18px !important;
                        font-weight: 600 !important;
                        margin-bottom: 0 !important;
                        font-family: 'Inter', sans-serif !important;
                        letter-spacing: 0 !important;
                        text-transform: none !important;
                        position: relative !important;
                        transition: all 0.3s ease !important;
                        width: 50px !important;
                        height: 50px !important;
                        border-radius: 8px !important;
                        display: flex !important;
                        align-items: center !important;
                        justify-content: center !important;
                        flex-shrink: 0 !important;
                        box-shadow: 0 2px 8px rgba(44, 62, 80, 0.2) !important;
                    }
                    
                    .value-item:hover .value-number {
                        color: #2C3E50 !important;
                        font-weight: 400 !important;
                    }
                    
                    .section-we-are .value-item .value-text,
                    section.section-we-are .description .value-item .value-text,
                    .value-text {
                        font-size: 16px !important;
                        line-height: 1.6 !important;
                        color: #333 !important;
                        font-weight: 400 !important;
                        font-family: 'Inter', sans-serif !important;
                        transition: all 0.3s ease !important;
                        margin: 0 !important;
                        flex: 1 !important;
                    }
                    
                    .value-item:hover .value-text {
                        color: #1a252f !important;
                        font-weight: 400 !important;
                    }
                    
                    /* Minimalist cho Detail Items */
                    .detail-item {
                        background: transparent !important;
                        border: none !important;
                        border-radius: 0 !important;
                        padding: 30px 0 !important;
                        margin-bottom: 0 !important;
                        position: relative !important;
                        transition: all 0.3s ease !important;
                        border-bottom: 1px solid rgba(221, 193, 154, 0.1) !important;
                    }
                    
                    .detail-item:last-child {
                        border-bottom: none !important;
                    }
                    
                    .detail-item:hover {
                        transform: translateX(6px) !important;
                        border-bottom-color: #DDC19A !important;
                    }
                    
                    .detail-label {
                        font-size: 11px !important;
                        font-weight: 400 !important;
                        color: #999 !important;
                        text-transform: uppercase !important;
                        letter-spacing: 3px !important;
                        margin-bottom: 8px !important;
                        font-family: 'Inter', sans-serif !important;
                        transition: all 0.3s ease !important;
                    }
                    
                    .detail-item:hover .detail-label {
                        color: #DDC19A !important;
                        letter-spacing: 4px !important;
                    }
                    
                    .detail-value {
                        font-size: 18px !important;
                        font-weight: 300 !important;
                        color: #2C3E50 !important;
                        line-height: 1.5 !important;
                        font-family: 'Playfair Display', serif !important;
                        transition: all 0.3s ease !important;
                        margin: 0 !important;
                    }
                    
                    .detail-item:hover .detail-value {
                        color: #1a252f !important;
                        font-weight: 400 !important;
                    }
                    
                    /* Typography spacing adjustments */
                    .values-grid {
                        gap: 60px !important;
                    }
                    
                    .project-details-grid {
                        gap: 0 !important;
                    }
                    </style>
                   <script>
                    // Simple hover fix when slide changes
                    document.addEventListener('DOMContentLoaded', function() {
                        const bannerSlider = document.querySelector('.banner-slider');
                        if (bannerSlider) {
                            const swiper = bannerSlider.swiper;
                            if (swiper) {
                                swiper.on('slideChange', function() {
                                    setTimeout(() => {
                                        const activeContainer = bannerSlider.querySelector('.swiper-slide-active .container');
                                        if (activeContainer) {
                                            // Check if mouse is over the active container
                                            const rect = activeContainer.getBoundingClientRect();
                                            const mouseX = window.event?.clientX || 0;
                                            const mouseY = window.event?.clientY || 0;
                                            
                                            if (mouseX >= rect.left && mouseX <= rect.right && 
                                                mouseY >= rect.top && mouseY <= rect.bottom) {
                                                activeContainer.classList.add('hover-active');
                                            }
                                        }
                                    }, 100);
                                });
                            }
                        }
                    });
                    document.addEventListener('DOMContentLoaded', function() {
                        // Handle Consultation Form submission
                        const consultationForm = document.getElementById('consultationForm');
                        const nameInput = document.getElementById('consultationName');
                        const emailInput = document.getElementById('consultationEmail');
                        const brevoConsent = document.getElementById('brevoConsent');
                        const submitBtn = consultationForm.querySelector('button[type="submit"]');
                        
                        if (consultationForm) {
                            // Store original form HTML for reset
                            const originalFormHTML = consultationForm.innerHTML;
                            
                            // Reset form when modal is shown
                            $('#consultationModal').on('show.bs.modal', function () {
                                consultationForm.innerHTML = originalFormHTML;
                                // Re-get elements after reset
                                const newNameInput = document.getElementById('consultationName');
                                const newEmailInput = document.getElementById('consultationEmail');
                                const newBrevoConsent = document.getElementById('brevoConsent');
                                const newSubmitBtn = consultationForm.querySelector('button[type="submit"]');
                                
                                // Re-bind submit event
                                if (newSubmitBtn) {
                                    newSubmitBtn.addEventListener('click', handleFormSubmit);
                                }
                                
                                function handleFormSubmit(e) {
                                    e.preventDefault();
                                    
                                    const name = newNameInput.value.trim();
                                    const email = newEmailInput.value.trim();
                                    const consent = newBrevoConsent.checked;
                                    
                                    // Validation
                                    if (!name || !email) {
                                        alert('Vui lòng nhập đầy đủ thông tin!');
                                        return;
                                    }
                                    
                                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                    if (!emailRegex.test(email)) {
                                        alert('Vui lòng nhập email hợp lệ!');
                                        return;
                                    }
                                    
                                    // Disable form and show loading
                                    newSubmitBtn.disabled = true;
                                    newSubmitBtn.innerHTML = 'ĐANG XỬ LÝ...';
                                    
                                    // Send AJAX request
                            fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: new URLSearchParams({
                                    action: 'consultation_signup',
                                    name: name,
                                    email: email,
                                    brevo_consent: consent ? '1' : '0',
                                    nonce: '<?php echo wp_create_nonce("consultation_signup_nonce"); ?>',
                                    source: 'footer_modal'
                                })
                            })
                            .then(response => {
                                console.log('Response status:', response.status);
                                console.log('Response headers:', response.headers);
                                return response.text().then(text => {
                                    console.log('Raw response:', text);
                                    try {
                                        return JSON.parse(text);
                                    } catch (e) {
                                        console.error('JSON parse error:', e);
                                        throw new Error('Invalid JSON response');
                                    }
                                });
                            })
                                    .then(data => {
                                        if (data.success) {
                                            // Show success message in form
                                            consultationForm.innerHTML = `
                                                <div class="text-center py-4">
                                                    <div style="color: #28a745; font-size: 18px; font-weight: 600; margin-bottom: 10px;">
                                                        <i class="fas fa-check-circle" style="font-size: 24px; margin-right: 8px;"></i>
                                                        Đăng ký thành công!
                                                    </div>
                                                    <p style="color: #666; font-size: 14px; margin: 0;">
                                                        Chúng tôi sẽ liên hệ với bạn sớm nhất.
                                                    </p>
                                                </div>
                                            `;
                                            
                                            // Close modal after 2 seconds
                                            setTimeout(() => {
                                                $('#consultationModal').modal('hide');
                                                // Alternative method
                                                setTimeout(() => {
                                                    $('#consultationModal').modal('hide');
                                                }, 100);
                                                // Force close if jQuery modal doesn't work
                                                setTimeout(() => {
                                                    const modal = document.getElementById('consultationModal');
                                                    if (modal) {
                                                        modal.classList.remove('show');
                                                        modal.style.display = 'none';
                                                        document.body.classList.remove('modal-open');
                                                        const backdrop = document.querySelector('.modal-backdrop');
                                                        if (backdrop) backdrop.remove();
                                                    }
                                                }, 200);
                                            }, 2000);
                                        } else {
                                            alert('Có lỗi xảy ra: ' + data.data);
                                        }
                                    })
                                    .catch(error => {
                                        console.error('AJAX error:', error);
                                        alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                                    })
                                    .finally(() => {
                                        // Re-enable form
                                        newSubmitBtn.disabled = false;
                                        newSubmitBtn.innerHTML = 'ĐĂNG KÝ TƯ VẤN';
                                    });
                                }
                            });
                            
                        }
                    });
                    </script>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="flex-1 mb-3">Contact with Us</div>
                            <ul class="socials">
                                <li>
                                    <a href="https://www.facebook.com/hoangho.com.vn" target="_blank">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/facebook.svg" class="icon" alt="Facebook" />
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/channel/UCw9-B1nbvn8u-131PPSki_g" target="_blank">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/youtube.svg" class="icon" alt="YouTube" />
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/company/30943257" target="_blank">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/linkedin.svg" class="icon" alt="LinkedIn" />
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <div class="flex-1 mb-3">Language</div>
                            <div class="language text-right">
                                <ul class="languages">
                                    <li class="<?php echo hoangho_is_english_page() ? '' : 'active'; ?>">                                                                                    
                                        <a href="<?php echo hoangho_get_language_url('vi'); ?>">VI</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="<?php echo hoangho_is_english_page() ? 'active' : ''; ?>">                                                                                    
                                        <a href="<?php echo hoangho_get_language_url('en'); ?>">EN</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="d-flex justify-content-center">
                <div class="copyright text-center">
                    © Copyright 2023 Hoangvubro Real Estate Development<br>
                    <a href="#">
                        <img style="width: 100px; margin-top: 10px;" src="<?php echo get_template_directory_uri(); ?>/assets/images/bo-cong-thuong.png" alt="Bộ Công Thương" />
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Consultation Modal -->
    <div class="modal fade" id="consultationModal" tabindex="-1" role="dialog" aria-labelledby="consultationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                <div class="modal-header" style="border: none; padding: 30px 30px 0; position: relative;">
                    <h4 class="modal-title text-center w-100" id="consultationModalLabel" style="color: #DDC19A; font-weight: 700; font-size: 24px; line-height: 1.3;">
                        Đăng ký ngay để được tư vấn<br><span style="color: #DDC19A;">chuyên sâu</span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 20px; right: 20px; background: none; border: none; font-size: 24px; color: #999;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 20px 30px 30px;">
                    <form id="consultationForm">
                        <div class="mb-4">
                            <input type="text" class="form-control" id="consultationName" placeholder="Tên của bạn" required style="border: 2px solid #ddd; border-radius: 8px; padding: 12px 15px; font-size: 16px; text-align: center; transition: border-color 0.3s ease; height: 48px; line-height: 1.5;">
                        </div>
                        <div class="mb-4">
                            <input type="email" class="form-control" id="consultationEmail" placeholder="Email của bạn" required style="border: 2px solid #ddd; border-radius: 8px; padding: 12px 15px; font-size: 16px; text-align: center; transition: border-color 0.3s ease; height: 48px; line-height: 1.5;">
                        </div>
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="brevoConsent" style="transform: scale(1.2); cursor: pointer;">
                                <label class="form-check-label" for="brevoConsent" style="font-size: 14px; color: #666; cursor: pointer;">
                                    Tôi đồng ý nhận thông tin tư vấn dự án qua email.
                                </label>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-consultation-modal w-100" style="background: linear-gradient(135deg, #DDC19A, #C4A882); border: none; padding: 15px; border-radius: 8px; font-weight: 600; color: #2C3E50; font-size: 16px; text-transform: uppercase; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); position: relative; overflow: hidden; box-shadow: 0 4px 15px rgba(221, 193, 154, 0.3); transform: translateY(0);">
                                <span style="position: relative; z-index: 2; transition: all 0.3s ease;">ĐĂNG KÝ TƯ VẤN</span>
                                <div style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(135deg, #C4A882, #DDC19A); transition: left 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); z-index: 1;"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts are loaded via wp_enqueue_scripts in functions.php -->

<?php wp_footer(); ?>

</body>
</html>