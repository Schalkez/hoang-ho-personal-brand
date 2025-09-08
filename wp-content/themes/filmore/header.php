<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header id="header">
    <div class="nav-header">
        <div class="container">
            <div class="content">
                <a href="<?php echo home_url(); ?>" class="logo-container" data-auto-theme="white">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="<?php bloginfo('name'); ?>" class="logo" />
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-white.svg" alt="<?php bloginfo('name'); ?>" class="logo logo-white auto-fill" />
                </a>
                <div class="d-flex align-items-center">
                    <!-- Menu toggle button temporarily disabled -->
                    <!--
                    <div class="menu-toggle-btn toggle-menu mr-3" data-auto-theme="white">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    -->
                    <div data-auto-theme="white">
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
    
    <div class="overlay-menu">
        <div class="main-menu-container">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => 'main-menu',
                'container' => false,
                'fallback_cb' => 'filmore_default_menu',
            ));
            ?>
        </div>

        <div class="container">
            <div class="footer-menu">
                <ul class="socials">
                    <li>
                        <a href="https://www.facebook.com/filmore.com.vn">
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

<?php
// Default menu fallback
function filmore_default_menu() {
    echo '<ul class="main-menu">';
    echo '<li class="item has-dropdown"><a href="#about-us" class="item-link">CÂU CHUYỆN FILMORE</a>';
    echo '<ul class="sub-menu">';
    echo '<li class="item"><a href="' . home_url('/thong-diep-thuong-hieu') . '" class="item-link">THÔNG ĐIỆP THƯƠNG HIỆU</a></li>';
    echo '<li class="item"><a href="' . home_url('/gia-tri-nen-tang') . '" class="item-link">GIÁ TRỊ NỀN TẢNG</a></li>';
    echo '<li class="item"><a href="' . home_url('/doi-ngu-lanh-dao') . '" class="item-link">ĐỘI NGŨ LÃNH ĐẠO</a></li>';
    echo '<li class="item"><a href="' . home_url('/dau-an-thanh-tuu') . '" class="item-link">DẤU ẤN - THÀNH TỰU</a></li>';
    echo '<li class="item"><a href="' . home_url('/trach-nhiem-xa-hoi') . '" class="item-link">TRÁCH NHIỆM XÃ HỘI</a></li>';
    echo '<li class="item"><a href="' . home_url('/doi-tac-dong-hanh') . '" class="item-link">ĐỐI TÁC ĐỒNG HÀNH</a></li>';
    echo '</ul></li>';
    echo '<li class="item has-dropdown"><a href="#business" class="item-link">DỰ ÁN</a>';
    echo '<ul class="sub-menu">';
    echo '<li class="item"><a href="' . home_url('/thefilmoredanang') . '" class="item-link">THE FILMORE DA NANG</a></li>';
    echo '<li class="item"><a href="' . home_url('/soma') . '" class="item-link">SOMA</a></li>';
    echo '</ul></li>';
    echo '<li class="item has-dropdown"><a href="#social" class="item-link">TRUYỀN THÔNG - THƯ VIỆN</a>';
    echo '<ul class="sub-menu">';
    echo '<li class="item"><a href="' . home_url('/tin-tuc') . '" class="item-link">THEO DÒNG SỰ KIỆN</a></li>';
    echo '<li class="item"><a href="' . home_url('/thu-vien') . '" class="item-link">HÌNH ẢNH - VIDEO</a></li>';
    echo '</ul></li>';
    echo '<li class="item has-dropdown"><a href="#chance" class="item-link">PHÁT TRIỂN NGUỒN NHÂN LỰC</a>';
    echo '<ul class="sub-menu">';
    echo '<li class="item"><a href="' . home_url('/moi-truong-filmore') . '" class="item-link">MÔI TRƯỜNG FILMORE</a></li>';
    echo '<li class="item"><a href="' . home_url('/tuyen-dung') . '" class="item-link">CƠ HỘI NGHỀ NGHIỆP</a></li>';
    echo '</ul></li>';
    echo '<li class="item"><a href="' . home_url('/thong-tin-lien-he') . '" class="item-link">LIÊN HỆ</a></li>';
    echo '</ul>';
}
?>
