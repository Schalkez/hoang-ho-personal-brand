<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    
    <!-- Preload critical hero slider images -->
    <link rel="preload" as="image" href="<?php echo content_url(); ?>/uploads/2025/09/VIEWBALCONY_FINAL2@1x_1-1-1024x512.webp" fetchpriority="high">
    <link rel="preload" as="image" href="<?php echo content_url(); ?>/uploads/2025/09/MEYPEARL_V07_OVERVIEW5_FINAL-1024x731.webp" fetchpriority="high">
    <link rel="preload" as="image" href="<?php echo content_url(); ?>/uploads/2025/09/Tongthenhintubienvao-1024x576.webp" fetchpriority="high">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header id="header">
    <div class="nav-header">
        <div class="container">
            <div class="content">
                <a href="<?php echo home_url('/en'); ?>" class="logo-container" data-auto-theme="white">
                    <img src="<?php echo content_url(); ?>/uploads/2025/09/MEYPEARL-LOGO-GUIDELINE_MP-goc-Ngang-e1757601715852.png" alt="<?php bloginfo('name'); ?>" class="logo" />
                    <img src="<?php echo content_url(); ?>/uploads/2025/09/MEYPEARL-LOGO-GUIDELINE_MP-am-ban-ngang-1-e1757755489177.webp" alt="<?php bloginfo('name'); ?>" class="logo logo-white auto-fill" />
                </a>
                <div class="d-flex align-items-center">
                    <!-- Menu toggle button -->
                    <div class="menu-toggle-btn toggle-menu mr-3" data-auto-theme="white">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div data-auto-theme="white">
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
    
    <div class="overlay-menu">
        <div class="main-menu-container">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => 'main-menu',
                'container' => false,
                'fallback_cb' => 'hoangho_default_menu_en',
            ));
            ?>
        </div>

        <div class="container">
            <div class="footer-menu">
                <ul class="socials">
                    <li>
                        <a href="https://www.facebook.com/hoangho.com.vn">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/facebook.svg" class="icon" alt="Facebook" />
                        </a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/channel/UCw9-B1nbvn8u-131PPSki_g">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/youtube.svg" class="icon" alt="YouTube" />
                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/company/30943257">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/linkedin.svg" class="icon" alt="LinkedIn" />
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

