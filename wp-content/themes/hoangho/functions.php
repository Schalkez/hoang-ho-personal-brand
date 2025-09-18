<?php
/**
 * HoangHo Theme Functions
 */

// Start output buffering to prevent headers already sent errors
if (!ob_get_level()) {
    ob_start();
}

// Suppress PHP warnings and errors
if (!defined('WP_DEBUG') || !WP_DEBUG) {
    error_reporting(0);
    ini_set('display_errors', 0);
}

/**
 * Clean output buffer on shutdown
 */
function hoangho_clean_output_buffer() {
    if (ob_get_level()) {
        ob_end_clean();
    }
}
add_action('shutdown', 'hoangho_clean_output_buffer');

/**
 * Increase upload file size limits
 */
function hoangho_increase_upload_limits() {
    ini_set('upload_max_filesize', '50M');
    ini_set('post_max_size', '50M');
    ini_set('max_execution_time', 300);
    ini_set('max_input_time', 300);
    ini_set('memory_limit', '512M');
}
add_action('muplugins_loaded', 'hoangho_increase_upload_limits', 1);

// Override WordPress upload size limit
function hoangho_upload_size_limit() {
    return 50 * 1024 * 1024; // 50MB in bytes
}
add_filter('upload_size_limit', 'hoangho_upload_size_limit');

// Force PHP settings on admin_init
function hoangho_force_php_settings() {
    if (is_admin()) {
        ini_set('upload_max_filesize', '50M');
        ini_set('post_max_size', '50M');
        ini_set('memory_limit', '512M');
    }
}
add_action('admin_init', 'hoangho_force_php_settings', 1);

// Increase image size limits
function hoangho_increase_image_limits() {
    // Increase big image size threshold
    add_filter('big_image_size_threshold', function() {
        return 4096; // Increase from 2560 to 4096 pixels
    });
    
    // Disable image compression
    add_filter('jpeg_quality', function() {
        return 100; // Maximum quality
    });
    
    // Allow larger images
    add_filter('wp_image_editors', function($editors) {
        return array('WP_Image_Editor_GD', 'WP_Image_Editor_Imagick');
    });
}
add_action('init', 'hoangho_increase_image_limits');

/**
 * Handle consultation form submission
 */
function hoangho_handle_consultation_signup() {
    // Start output buffering to catch any unwanted output
    ob_start();
    
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'consultation_signup_nonce')) {
        ob_end_clean();
        wp_die('Security check failed');
    }
    
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $brevo_consent = $_POST['brevo_consent'] === '1';
    $source = sanitize_text_field($_POST['source']);
    
    // Validate required fields
    if (empty($name) || empty($email)) {
        ob_end_clean();
        wp_send_json_error('Vui lòng nhập đầy đủ thông tin!');
    }
    
    if (!is_email($email)) {
        ob_end_clean();
        wp_send_json_error('Email không hợp lệ!');
    }
    
    // Save to database
    global $wpdb;
    $table_name = $wpdb->prefix . 'consultation_leads';
    
    // Create table if not exists
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        brevo_consent tinyint(1) DEFAULT 0,
        source varchar(100) DEFAULT '',
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    
    // Insert data
    $result = $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
            'email' => $email,
            'brevo_consent' => $brevo_consent ? 1 : 0,
            'source' => $source,
            'created_at' => current_time('mysql')
        ),
        array('%s', '%s', '%d', '%s', '%s')
    );
    
    if ($result === false) {
        ob_end_clean();
        wp_send_json_error('Có lỗi xảy ra khi lưu thông tin!');
    }
    
    // If user consented, add to Brevo
    if ($brevo_consent && class_exists('SIB_API_Manager')) {
        try {
            // Get Brevo list ID to subscribe new contacts
            // Prefer a constant (define('HOANGHO_BREVO_LIST_ID', 4)) if set,
            // otherwise fall back to Brevo plugin's default list ID, with 4 as last resort
            $default_list_id = defined('HOANGHO_BREVO_LIST_ID')
                ? (int) HOANGHO_BREVO_LIST_ID
                : (int) get_option('sib_default_list_id', 4);
            
            // Prepare contact info for Brevo - split name into first and last name
            $name_parts = explode(' ', trim($name), 2);
            $first_name = $name_parts[0];
            $last_name = isset($name_parts[1]) ? $name_parts[1] : '';
            
            $contact_info = array(
                'FIRSTNAME' => $first_name,
                'LASTNAME' => $last_name,
                'SMS' => '',
                'WEBSITE' => home_url(),
                'SOURCE' => 'Website Consultation Form'
            );
            
            // Add contact to Brevo - list_id must be an array
            $brevo_result = SIB_API_Manager::create_subscriber($email, array($default_list_id), $contact_info, 'simple');
            
            if ($brevo_result === 'success') {
                // Contact added to Brevo successfully
            } else {
                // Log error but don't fail the form submission
                error_log('Brevo integration failed for consultation: ' . $brevo_result);
            }
        } catch (Exception $e) {
            // Log error but don't fail the form submission
            error_log('Brevo integration error for consultation: ' . $e->getMessage());
        }
    }
    
    // Send email notification to admin (optional)
    $admin_email = get_option('admin_email');
    $subject = 'Đăng ký tư vấn mới từ website';
    $message = "Tên: $name\nEmail: $email\nNguồn: $source\nĐồng ý nhận email: " . ($brevo_consent ? 'Có' : 'Không');
    wp_mail($admin_email, $subject, $message);
    
    // Clean any output buffer and send success response
    ob_end_clean();
    wp_send_json_success('Đăng ký thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất.');
}
add_action('wp_ajax_consultation_signup', 'hoangho_handle_consultation_signup');
add_action('wp_ajax_nopriv_consultation_signup', 'hoangho_handle_consultation_signup');

/**
 * Suppress WordPress version check warnings
 */
function hoangho_suppress_version_check_warnings() {
    // Disable automatic updates and version checks
    if (is_admin()) {
        // Disable WordPress version check
        remove_action('wp_version_check', 'wp_version_check');
        remove_action('admin_init', '_maybe_update_core');
        
        // Disable plugin and theme update checks
        remove_action('load-update-core.php', 'wp_update_plugins');
        remove_action('load-plugins.php', 'wp_update_plugins');
        remove_action('load-update.php', 'wp_update_plugins');
        remove_action('wp_update_plugins', 'wp_update_plugins');
        
        remove_action('load-update-core.php', 'wp_update_themes');
        remove_action('load-themes.php', 'wp_update_themes');
        remove_action('load-update.php', 'wp_update_themes');
        remove_action('wp_update_themes', 'wp_update_themes');
        
        // Suppress only version check errors, allow plugin/theme installation
        add_filter('pre_http_request', function($preempt, $parsed_args, $url) {
            // Only block version check, allow plugin/theme API
            if (strpos($url, 'api.wordpress.org/core/version-check') !== false) {
                return new WP_Error('version_check_disabled', 'Version check disabled');
            }
            return $preempt;
        }, 10, 3);
    }
}
add_action('init', 'hoangho_suppress_version_check_warnings');

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function hoangho_setup() {
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
        'primary' => __('Primary Menu', 'hoangho'),
        'footer' => __('Footer Menu', 'hoangho'),
    ));
    
    // Add image sizes
    add_image_size('hoangho-featured', 800, 600, true);
    add_image_size('hoangho-thumbnail', 300, 200, true);
}
add_action('after_setup_theme', 'hoangho_setup');

/**
 * Enqueue scripts and styles
 */
function hoangho_scripts() {
    // Enqueue HoangHo Custom Fonts
    wp_enqueue_style('hoangho-custom-fonts', get_template_directory_uri() . '/assets/css/hoangho-fonts.css', array(), '1.0.1');
    
    // Enqueue main stylesheet
    wp_enqueue_style('hoangho-style', get_stylesheet_uri(), array(), '1.0.1');
    
    // Enqueue theme CSS files
    wp_enqueue_style('hoangho-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '1.0.1');
    wp_enqueue_style('hoangho-fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css', array(), '1.0.1');
    wp_enqueue_style('hoangho-materialdesign', get_template_directory_uri() . '/assets/css/materialdesignicons.min.css', array(), '1.0.1');
    wp_enqueue_style('hoangho-aos', get_template_directory_uri() . '/assets/css/aos.css', array(), '1.0.1');
    wp_enqueue_style('hoangho-swiper', get_template_directory_uri() . '/assets/css/swiper.min.css', array(), '1.0.1');
    wp_enqueue_style('hoangho-custom', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0.1');
    wp_enqueue_style('hoangho-main-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.1');
    wp_enqueue_style('hoangho-fonts', get_template_directory_uri() . '/assets/css/fonts.css', array(), '1.0.1');
    wp_enqueue_style('hoangho-fontawesome', get_template_directory_uri() . '/assets/css/all.min.css', array(), '1.0.1');
    wp_enqueue_style('hoangho-wordpress-overrides', get_template_directory_uri() . '/assets/css/wordpress-overrides.css', array(), '1.0.1');
    
    // Enqueue theme JS files
    wp_enqueue_script('jquery'); // Use WordPress jQuery
    wp_enqueue_script('hoangho-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), '1.0.1', true);
    wp_enqueue_script('hoangho-fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.min.js', array('jquery'), '1.0.1', true);
    wp_enqueue_script('hoangho-aos', get_template_directory_uri() . '/assets/js/aos.js', array(), '1.0.1', true);
    wp_enqueue_script('hoangho-swiper', get_template_directory_uri() . '/assets/js/swiper.min.js', array(), '1.0.1', true);
    // Newsletter script removed - now using Brevo shortcode
    wp_enqueue_script('hoangho-main', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0.1', true);
    
    // Localize script for AJAX and theme variables
    wp_localize_script('hoangho-main', 'hoangho_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('hoangho_nonce'),
        'assets' => get_template_directory_uri() . '/assets/',
        'posts_per_page' => 9,
        'paged' => 1,
    ));
    
    // Newsletter localization removed - now using Brevo shortcode
}
add_action('wp_enqueue_scripts', 'hoangho_scripts');





/**
 * Check Brevo plugin status and configuration
 */
function hoangho_check_brevo_integration() {
    if (is_admin() && current_user_can('manage_options')) {
        $brevo_status = array(
            'plugin_active' => class_exists('SIB_API_Manager'),
            'api_configured' => false,
            'default_list_id' => get_option('sib_default_list_id', 1),
            'api_key' => 'Not configured'
        );
        
        if ($brevo_status['plugin_active']) {
            // Use Brevo plugin's own method to check API key
            if (class_exists('SIB_Manager') && method_exists('SIB_Manager', 'is_api_key_set')) {
                if (SIB_Manager::is_api_key_set()) {
                    $brevo_status['api_configured'] = true;
                    $brevo_status['api_key'] = 'Configured';
                }
            }
        }
        
        return $brevo_status;
    }
    return false;
}

/**
 * Add Brevo integration status to admin menu
 */
function hoangho_brevo_admin_notice() {
    if (is_admin() && current_user_can('manage_options')) {
        $brevo_status = hoangho_check_brevo_integration();
        
        if ($brevo_status && $brevo_status['plugin_active']) {
            if ($brevo_status['api_configured']) {
                echo '<div class="notice notice-success"><p><strong>Brevo Integration:</strong> Plugin đã được cấu hình và sẵn sàng nhận email từ form consultation.</p></div>';
            } else {
                echo '<div class="notice notice-warning"><p><strong>Brevo Integration:</strong> Plugin đã được cài đặt nhưng chưa được cấu hình API key. <a href="' . admin_url('admin.php?page=sib_page_home') . '">Cấu hình ngay</a></p></div>';
            }
        } else {
            echo '<div class="notice notice-info"><p><strong>Brevo Integration:</strong> Form consultation sẽ chỉ lưu vào database local. Để tích hợp với Brevo, hãy cài đặt và cấu hình Brevo plugin.</p></div>';
        }
    }
}
add_action('admin_notices', 'hoangho_brevo_admin_notice');

/**
 * Get client IP address securely
 */
function hoangho_get_client_ip() {
    $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR');
    foreach ($ip_keys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown';
}



/**
 * Register widget areas
 */
function hoangho_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'hoangho'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here.', 'hoangho'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer Widget Area', 'hoangho'),
        'id' => 'footer-1',
        'description' => __('Add widgets here.', 'hoangho'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'hoangho_widgets_init');

/**
 * Custom post types
 */
function hoangho_custom_post_types() {
    // Projects post type
    register_post_type('project', array(
        'labels' => array(
            'name' => __('Dự án', 'hoangho'),
            'singular_name' => __('Dự án', 'hoangho'),
            'add_new' => __('Thêm dự án mới', 'hoangho'),
            'add_new_item' => __('Thêm dự án mới', 'hoangho'),
            'edit_item' => __('Chỉnh sửa dự án', 'hoangho'),
            'new_item' => __('Dự án mới', 'hoangho'),
            'view_item' => __('Xem dự án', 'hoangho'),
            'search_items' => __('Tìm dự án', 'hoangho'),
            'not_found' => __('Không tìm thấy dự án', 'hoangho'),
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
            'name' => __('Đội ngũ', 'hoangho'),
            'singular_name' => __('Thành viên', 'hoangho'),
            'add_new' => __('Thêm thành viên', 'hoangho'),
            'add_new_item' => __('Thêm thành viên mới', 'hoangho'),
            'edit_item' => __('Chỉnh sửa thành viên', 'hoangho'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array('slug' => 'doi-ngu'),
    ));
}
add_action('init', 'hoangho_custom_post_types');

/**
 * Customize excerpt length
 */
function hoangho_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'hoangho_excerpt_length');

/**
 * Customize excerpt more
 */
function hoangho_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'hoangho_excerpt_more');

/**
 * Add custom body classes
 */
function hoangho_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'home-page';
    }
    return $classes;
}
add_filter('body_class', 'hoangho_body_classes');

/**
 * Customizer additions
 */
function hoangho_customize_register($wp_customize) {
    // Add section for theme options
    $wp_customize->add_section('hoangho_options', array(
        'title' => __('HoangHo Options', 'hoangho'),
        'priority' => 30,
    ));
    
    // Add setting for contact email
    $wp_customize->add_setting('hoangho_contact_email', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('hoangho_contact_email', array(
        'label' => __('Contact Email', 'hoangho'),
        'section' => 'hoangho_options',
        'type' => 'email',
    ));
}
add_action('customize_register', 'hoangho_customize_register');

/**
 * Fix WordPress REST API issues
 */
function hoangho_fix_rest_api() {
    // Enable REST API (removed deprecated rest_enabled hook)
    add_filter('rest_jsonp_enabled', '__return_true');
    
    // Fix REST API URL
    add_filter('rest_url_prefix', function() {
        return 'wp-json';
    });
}
add_action('init', 'hoangho_fix_rest_api');

/**
 * Fix permalink structure
 */
function hoangho_fix_permalinks() {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
    $wp_rewrite->flush_rules();
}
add_action('after_switch_theme', 'hoangho_fix_permalinks');

/**
 * Default menu fallback for English - chỉ hiển thị các trang hiện có
 */
function hoangho_default_menu_en() {
    echo '<ul class="main-menu">';
    echo '<li class="item"><a href="' . home_url('/en/') . '" class="item-link">HOME</a></li>';
    echo '<li class="item"><a href="' . home_url('/en/legal-documents/') . '" class="item-link">LEGAL DOCUMENTS</a></li>';
    echo '<li class="item"><a href="' . home_url('/en/residential-portfolio/') . '" class="item-link">APARTMENT COLLECTION</a></li>';
    // External 360 view link under the collection (English)
    echo '<li class="item"><a href="https://momento360.com/e/u/3a15cca810b8411f815e4afcbb9857a8?&heading=7.89&pitch=-33.32&field-of-view=100&size=medium" class="item-link" target="_blank" rel="noopener">360° PROJECT TOUR</a></li>';
    echo '<li class="item"><a href="#" class="item-link" data-toggle="modal" data-target="#consultationModal">REGISTER FOR CONSULTATION</a></li>';
    echo '</ul>';
}

/**
 * Get language switcher URL - chuyển sang trang tương ứng của ngôn ngữ khác
 */
function hoangho_get_language_url($target_lang) {
    $current_url = $_SERVER['REQUEST_URI'];
    $current_path = trim(parse_url($current_url, PHP_URL_PATH), '/');
    
    // Mapping giữa các trang
    $page_mapping = array(
        // Vietnamese to English
        'phap-ly-du-an' => 'en/legal-documents',
        'bo-suu-tap-can-ho' => 'en/residential-portfolio',
        'en' => '',
        
        // English to Vietnamese  
        'en/legal-documents' => 'phap-ly-du-an',
        'en/residential-portfolio' => 'bo-suu-tap-can-ho',
        'en' => '',
        '' => 'en'
    );
    
    if ($target_lang === 'vi') {
        // Chuyển sang tiếng Việt
        if (isset($page_mapping[$current_path])) {
            $vi_path = $page_mapping[$current_path];
            return $vi_path ? home_url('/' . $vi_path . '/') : home_url();
        }
        return home_url();
    } else {
        // Chuyển sang tiếng Anh
        if (isset($page_mapping[$current_path])) {
            $en_path = $page_mapping[$current_path];
            return $en_path ? home_url('/' . $en_path . '/') : home_url('/en/');
        }
        return home_url('/en/');
    }
}

/**
 * Check if current page is English page
 */
function hoangho_is_english_page() {
    $current_url = $_SERVER['REQUEST_URI'];
    $current_path = trim(parse_url($current_url, PHP_URL_PATH), '/');
    return strpos($current_path, 'en') === 0 || $current_path === 'en';
}

/**
 * Add custom rewrite rules for English pages with /en prefix
 */
function hoangho_add_english_rewrite_rules() {
    // Add specific rewrite rules for each English page
    add_rewrite_rule(
        '^en/legal-documents/?$',
        'index.php?pagename=legal-documents&hoangho_english=1',
        'top'
    );
    
    add_rewrite_rule(
        '^en/residential-portfolio/?$',
        'index.php?pagename=residential-portfolio&hoangho_english=1',
        'top'
    );
    
    add_rewrite_rule(
        '^en/?$',
        'index.php?pagename=en&hoangho_english=1',
        'top'
    );
}
add_action('init', 'hoangho_add_english_rewrite_rules');

/**
 * Add custom query vars for English routes
 */
function hoangho_add_query_vars($vars) {
    $vars[] = 'hoangho_english';
    return $vars;
}
add_filter('query_vars', 'hoangho_add_query_vars');

/**
 * Template redirect for English pages - force 404 for invalid routes
 */
function hoangho_template_redirect() {
    // Check if this is an English route
    if (get_query_var('hoangho_english')) {
        $pagename = get_query_var('pagename');
        
        // Valid English routes mapping
        $valid_routes = array(
            'en' => 'page-en.php',
            'legal-documents' => 'page-legal-en.php',
            'residential-portfolio' => 'page-products-en.php'
        );
        
        // Check if current page is valid
        if (isset($valid_routes[$pagename])) {
            $page = get_page_by_path($pagename);
            
            if ($page) {
                // Set up proper WordPress query
                global $wp_query;
                $wp_query->is_page = true;
                $wp_query->is_singular = true;
                $wp_query->is_404 = false;
                $wp_query->queried_object = $page;
                $wp_query->queried_object_id = $page->ID;
                $wp_query->post_count = 1;
                $wp_query->posts = array($page);
                $wp_query->current_post = 0;
                $wp_query->post = $page;
                
                // Include the template
                include(get_template_directory() . '/' . $valid_routes[$pagename]);
                exit;
            }
        }
        
        // If we reach here, it's an invalid /en/ route - force 404
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
        
        // Include our custom 404 template
        include(get_template_directory() . '/404.php');
        exit;
    }
}
add_action('template_redirect', 'hoangho_template_redirect');

/**
 * Template include filter for English pages
 */
function hoangho_template_include($template) {
    // Check if this is an English route
    if (get_query_var('hoangho_english')) {
        $pagename = get_query_var('pagename');
        
        // Valid English routes mapping
        $valid_routes = array(
            'en' => 'page-en.php',
            'legal-documents' => 'page-legal-en.php',
            'residential-portfolio' => 'page-products-en.php'
        );
        
        if (isset($valid_routes[$pagename])) {
            $new_template = get_template_directory() . '/' . $valid_routes[$pagename];
            if (file_exists($new_template)) {
                return $new_template;
            }
        }
    }
    
    return $template;
}
add_filter('template_include', 'hoangho_template_include');

/**
 * Flush rewrite rules when theme is activated
 */
function hoangho_flush_rewrite_rules() {
    hoangho_add_english_rewrite_rules();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'hoangho_flush_rewrite_rules');


/**
 * Fix permalinks for English pages to use /en/ prefix
 */
function hoangho_fix_english_permalinks($permalink, $post) {
    // Check if $post is an object or ID
    if (is_object($post)) {
        $post_obj = $post;
    } elseif (is_numeric($post)) {
        $post_obj = get_post($post);
        if (!$post_obj) return $permalink;
    } else {
        return $permalink;
    }
    
    if ($post_obj->post_type === 'page') {
        $slug = $post_obj->post_name;
        
        // Check if it's an English page
        if (strpos($slug, 'en-') === 0) {
            $english_slug = str_replace('en-', '', $slug);
            $permalink = home_url('/en/' . $english_slug . '/');
        } elseif ($slug === 'en') {
            $permalink = home_url('/en/');
        }
    }
    
    return $permalink;
}
add_filter('post_link', 'hoangho_fix_english_permalinks', 10, 2);
add_filter('page_link', 'hoangho_fix_english_permalinks', 10, 2);
?>
