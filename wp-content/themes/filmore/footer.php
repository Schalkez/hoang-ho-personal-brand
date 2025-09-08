<footer class="section section-footer" data-hash="footer" data-toggle-theme="white" style="margin-top: 20px;">
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col-lg-9 col-md-6 mb-sm-3">
                    <a href="<?php echo home_url(); ?>" class="logo-container">
                        <img src="<?php echo content_url(); ?>/uploads/2020/07/logo-white.svg" class="logo" alt="Filmore Real Estate Development" />
                    </a>
                    <div class="row">
                        <div class="col-lg-5 mb-sm-3">
                            <p>
                                <strong>CÔNG TY CP PHÁT TRIỂN BẤT ĐỘNG SẢN FILMORE</strong><br />
                                357-359 An Dương Vương, Phường Chợ Quán, Thành phố Hồ Chí Minh
                            </p>
                        </div>
                        <div class="col-lg-2 mb-sm-3">
                            <p>
                                <strong>Liên hệ</strong><br />
                                <a href="tel:+84 28 3829 9999">+84 28 3829 9999</a>
                            </p>
                        </div>
                        <div class="col-lg-2 mb-sm-3">
                            <p>
                                <strong>Email</strong><br />
                                <a href="mailto:info@filmore.com.vn">info@filmore.com.vn</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <p class="mb-0"><strong>Newsletter</strong></p>
                    <div class="submit-form">
                        <form class="newsletter-form" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>">
                            <input type="hidden" name="action" value="newsletter_signup">
                            <div class="group-input">
                                <p>
                                    <input type="email" name="email" class="input" placeholder="Sign up for keeping in touch to us" required />
                                    <button type="submit" class="btn-submit">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/next.svg" alt="Submit" />
                                    </button>
                                </p>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="flex-1 mb-3">Contact with Us</div>
                            <ul class="socials">
                                <li>
                                    <a href="https://www.facebook.com/filmore.com.vn" target="_blank">
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
                                    <li class="<?php echo (is_page('en') || get_query_var('pagename') == 'en') ? '' : 'active'; ?>">
                                        <a href="<?php echo home_url(); ?>">VI</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="<?php echo (is_page('en') || get_query_var('pagename') == 'en') ? 'active' : ''; ?>">
                                        <a href="<?php echo home_url('/en'); ?>">EN</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="d-block d-md-flex justify-content-between">
                <div class="list-term mb-md-0 mb-3">
                    <div class="item">
                        <a href="<?php echo home_url(); ?>/chinh-sach-bao-mat"><i class="fas fa-angle-double-right"></i> CHÍNH SÁCH BẢO MẬT</a>
                    </div>
                    <div class="item">
                        <a href="<?php echo home_url(); ?>/mien-tru-trach-nhiem"><i class="fas fa-angle-double-right"></i> MIỄN TRỪ TRÁCH NHIỆM</a>
                    </div>
                    <div class="item">
                        <a href="<?php echo home_url(); ?>/quy-dinh-ve-quyen-rieng-tu"><i class="fas fa-angle-double-right"></i> QUY ĐỊNH VỀ QUYỀN RIÊNG TƯ</a>
                    </div>
                </div>
                <div class="copyright text-right">
                    © Copyright 2020 Filmore Real Estate Development<br>
                    <a href="#">
                        <img style="width: 100px; margin-top: 10px;" src="<?php echo get_template_directory_uri(); ?>/assets/images/bo-cong-thuong.png" alt="Bộ Công Thương" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts are loaded via wp_enqueue_scripts in functions.php -->

<?php wp_footer(); ?>

</body>
</html>