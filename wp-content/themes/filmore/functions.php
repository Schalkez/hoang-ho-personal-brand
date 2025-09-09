<?php
/**
 * Filmore Theme Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function filmore_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo');
    add_theme_support('menus');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'filmore'),
        'footer' => __('Footer Menu', 'filmore'),
    ));
    
    // Add image sizes
    add_image_size('filmore-featured', 800, 600, true);
    add_image_size('filmore-thumbnail', 300, 200, true);
}
add_action('after_setup_theme', 'filmore_setup');

/**
 * Enqueue scripts and styles
 */
function filmore_scripts() {
    // Enqueue Filmore Custom Fonts
    wp_enqueue_style('filmore-custom-fonts', get_template_directory_uri() . '/assets/css/filmore-fonts.css', array(), '1.0.0');
    
    // Enqueue main stylesheet
    wp_enqueue_style('filmore-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue theme CSS files
    wp_enqueue_style('filmore-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '1.0.0');
    wp_enqueue_style('filmore-fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css', array(), '1.0.0');
    wp_enqueue_style('filmore-materialdesign', get_template_directory_uri() . '/assets/css/materialdesignicons.min.css', array(), '1.0.0');
    wp_enqueue_style('filmore-aos', get_template_directory_uri() . '/assets/css/aos.css', array(), '1.0.0');
    wp_enqueue_style('filmore-swiper', get_template_directory_uri() . '/assets/css/swiper.min.css', array(), '1.0.0');
    wp_enqueue_style('filmore-custom', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0.0');
    wp_enqueue_style('filmore-main-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0');
    wp_enqueue_style('filmore-fonts', get_template_directory_uri() . '/assets/css/fonts.css', array(), '1.0.0');
    wp_enqueue_style('filmore-fontawesome', get_template_directory_uri() . '/assets/css/all.min.css', array(), '1.0.0');
    wp_enqueue_style('filmore-wordpress-overrides', get_template_directory_uri() . '/assets/css/wordpress-overrides.css', array(), '1.0.0');
    
    // Enqueue theme JS files
    wp_enqueue_script('filmore-jquery', get_template_directory_uri() . '/assets/js/jquery-3.5.1.min.js', array(), '1.0.0', true);
    wp_enqueue_script('filmore-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('filmore-fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('filmore-aos', get_template_directory_uri() . '/assets/js/aos.js', array(), '1.0.0', true);
    wp_enqueue_script('filmore-swiper', get_template_directory_uri() . '/assets/js/swiper.min.js', array(), '1.0.0', true);
    wp_enqueue_script('filmore-main', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX and theme variables
    wp_localize_script('filmore-main', 'filmore_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('filmore_nonce'),
        'assets' => get_template_directory_uri() . '/assets/',
        'posts_per_page' => 9,
        'paged' => 1,
    ));
}
add_action('wp_enqueue_scripts', 'filmore_scripts');

/**
 * Handle newsletter signup AJAX
 */
function filmore_newsletter_signup() {
    if (isset($_POST['email']) && is_email($_POST['email'])) {
        $email = sanitize_email($_POST['email']);
        
        // Here you can add email to database or send to email service
        // For now, just return success
        wp_send_json_success('Đăng ký newsletter thành công!');
    } else {
        wp_send_json_error('Email không hợp lệ!');
    }
}
add_action('wp_ajax_newsletter_signup', 'filmore_newsletter_signup');
add_action('wp_ajax_nopriv_newsletter_signup', 'filmore_newsletter_signup');

/**
 * Register widget areas
 */
function filmore_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'filmore'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here.', 'filmore'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer Widget Area', 'filmore'),
        'id' => 'footer-1',
        'description' => __('Add widgets here.', 'filmore'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'filmore_widgets_init');

/**
 * Custom post types
 */
function filmore_custom_post_types() {
    // Projects post type
    register_post_type('project', array(
        'labels' => array(
            'name' => __('Dự án', 'filmore'),
            'singular_name' => __('Dự án', 'filmore'),
            'add_new' => __('Thêm dự án mới', 'filmore'),
            'add_new_item' => __('Thêm dự án mới', 'filmore'),
            'edit_item' => __('Chỉnh sửa dự án', 'filmore'),
            'new_item' => __('Dự án mới', 'filmore'),
            'view_item' => __('Xem dự án', 'filmore'),
            'search_items' => __('Tìm dự án', 'filmore'),
            'not_found' => __('Không tìm thấy dự án', 'filmore'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-building',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'du-an'),
    ));
    
    // Team members post type
    register_post_type('team', array(
        'labels' => array(
            'name' => __('Đội ngũ', 'filmore'),
            'singular_name' => __('Thành viên', 'filmore'),
            'add_new' => __('Thêm thành viên', 'filmore'),
            'add_new_item' => __('Thêm thành viên mới', 'filmore'),
            'edit_item' => __('Chỉnh sửa thành viên', 'filmore'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array('slug' => 'doi-ngu'),
    ));
}
add_action('init', 'filmore_custom_post_types');

/**
 * Customize excerpt length
 */
function filmore_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'filmore_excerpt_length');

/**
 * Customize excerpt more
 */
function filmore_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'filmore_excerpt_more');

/**
 * Add custom body classes
 */
function filmore_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'home-page';
    }
    return $classes;
}
add_filter('body_class', 'filmore_body_classes');

/**
 * Customizer additions
 */
function filmore_customize_register($wp_customize) {
    // Add section for theme options
    $wp_customize->add_section('filmore_options', array(
        'title' => __('Filmore Options', 'filmore'),
        'priority' => 30,
    ));
    
    // Add setting for contact email
    $wp_customize->add_setting('filmore_contact_email', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('filmore_contact_email', array(
        'label' => __('Contact Email', 'filmore'),
        'section' => 'filmore_options',
        'type' => 'email',
    ));
}
add_action('customize_register', 'filmore_customize_register');

/**
 * Fix WordPress REST API issues
 */
function filmore_fix_rest_api() {
    // Enable REST API (removed deprecated rest_enabled hook)
    add_filter('rest_jsonp_enabled', '__return_true');
    
    // Fix REST API URL
    add_filter('rest_url_prefix', function() {
        return 'wp-json';
    });
}
add_action('init', 'filmore_fix_rest_api');

/**
 * Fix permalink structure
 */
function filmore_fix_permalinks() {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
    $wp_rewrite->flush_rules();
}
add_action('after_switch_theme', 'filmore_fix_permalinks');
?>
