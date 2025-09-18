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
                                <strong>HOANG VU BRO TRADING & SERVICE CO., LTD</strong><br />
                                127 Kim Phượng, Hung Phat High-end Residential and Urban Area, Phu Quoc Special Economic Zone, An Giang Province
                            </p>
                        </div>
                        <div class="col-lg-2 mb-sm-3">
                            <p>
                                <strong>Contact</strong><br />
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
                                We don't just help you buy real estate, we also accompany you on the journey of creating profits and increasing asset value sustainably. From finding potential products, committing to effective profit-taking solutions by finding new buyers, to cooperating with reputable operating units to exploit stable cash flow for customers who want to do business. We ensure that your real estate is not only an investment, but also a valuable asset that meets future living or business needs.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center mb-3">
                        <button class="btn btn-primary btn-consultation w-100" data-toggle="modal" data-target="#consultationModal" style="background: linear-gradient(135deg, #DDC19A, #C4A882); border: none; padding: 10px 20px; border-radius: 6px; font-weight: 600; color: #2C3E50; font-size: 14px; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); position: relative; overflow: hidden; box-shadow: 0 4px 15px rgba(221, 193, 154, 0.3); transform: translateY(0);">
                            <span style="position: relative; z-index: 2; transition: all 0.3s ease;">REGISTER FOR CONSULTATION</span>
                            <div style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(135deg, #C4A882, #DDC19A); transition: left 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); z-index: 1;"></div>
                        </button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="flex-1 mb-3">Social Media</div>
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
                    
                    /* Input Focus Styles */
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
            </div>
            <div class="divider"></div>
            <div class="d-flex justify-content-center">
                <div class="copyright text-center">
                    © Copyright 2023 Hoangvubro Real Estate Development<br>
                    <a href="#">
                        <img style="width: 100px; margin-top: 10px;" src="<?php echo get_template_directory_uri(); ?>/assets/images/bo-cong-thuong.png" alt="Ministry of Industry and Trade" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle Consultation Form submission
        const consultationForm = document.getElementById('consultationForm');
        
        if (consultationForm) {
            // Store original form HTML for reset
            const originalFormHTML = consultationForm.innerHTML;
            
            // Reset form when modal is shown
            jQuery('#consultationModal').on('show.bs.modal', function () {
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
                    alert('Please fill in all information!');
                    return;
                }
                
                if (!isValidEmail(email)) {
                    alert('Please enter a valid email!');
                    return;
                }
                
                    // Disable form and show loading
                    newSubmitBtn.disabled = true;
                    newSubmitBtn.innerHTML = 'PROCESSING...';
                
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
                        source: 'footer_modal_en'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message in form
                        const formContent = consultationForm.innerHTML;
                        consultationForm.innerHTML = `
                            <div class="text-center py-4">
                                <div style="color: #28a745; font-size: 18px; font-weight: 600; margin-bottom: 10px;">
                                    <i class="fas fa-check-circle" style="font-size: 24px; margin-right: 8px;"></i>
                                    Registration Successful!
                                </div>
                                <p style="color: #666; font-size: 14px; margin: 0;">
                                    We will contact you soon.
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
                        alert('Error occurred: ' + data.data);
                    }
                })
                .catch(error => {
                    console.error('AJAX error:', error);
                    alert('An error occurred. Please try again later.');
                })
                    .finally(() => {
                        // Re-enable form
                        newSubmitBtn.disabled = false;
                        newSubmitBtn.innerHTML = 'REGISTER FOR CONSULTATION';
                    });
                }
            });
        }
        
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
        
        // Input focus effects
        const inputs = document.querySelectorAll('#consultationForm input[type="text"], #consultationForm input[type="email"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.borderColor = '#FFD700';
                this.style.outline = 'none';
                this.style.boxShadow = 'none';
            });
            
            input.addEventListener('blur', function() {
                this.style.borderColor = '#ddd';
            });
        });
    });
    </script>

    
</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
