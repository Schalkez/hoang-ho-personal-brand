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
    wp_enqueue_style('hoangho-custom-fonts', get_template_directory_uri() . '/assets/css/hoangho-fonts.css', array(), '1.0.0');
    
    // Enqueue main stylesheet
    wp_enqueue_style('hoangho-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue theme CSS files
    wp_enqueue_style('hoangho-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '1.0.0');
    wp_enqueue_style('hoangho-fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css', array(), '1.0.0');
    wp_enqueue_style('hoangho-materialdesign', get_template_directory_uri() . '/assets/css/materialdesignicons.min.css', array(), '1.0.0');
    wp_enqueue_style('hoangho-aos', get_template_directory_uri() . '/assets/css/aos.css', array(), '1.0.0');
    wp_enqueue_style('hoangho-swiper', get_template_directory_uri() . '/assets/css/swiper.min.css', array(), '1.0.0');
    wp_enqueue_style('hoangho-custom', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0.0');
    wp_enqueue_style('hoangho-main-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0');
    wp_enqueue_style('hoangho-fonts', get_template_directory_uri() . '/assets/css/fonts.css', array(), '1.0.0');
    wp_enqueue_style('hoangho-fontawesome', get_template_directory_uri() . '/assets/css/all.min.css', array(), '1.0.0');
    wp_enqueue_style('hoangho-wordpress-overrides', get_template_directory_uri() . '/assets/css/wordpress-overrides.css', array(), '1.0.0');
    
    // Enqueue theme JS files
    wp_enqueue_script('hoangho-jquery', get_template_directory_uri() . '/assets/js/jquery-3.5.1.min.js', array(), '1.0.0', true);
    wp_enqueue_script('hoangho-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('hoangho-fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('hoangho-aos', get_template_directory_uri() . '/assets/js/aos.js', array(), '1.0.0', true);
    wp_enqueue_script('hoangho-swiper', get_template_directory_uri() . '/assets/js/swiper.min.js', array(), '1.0.0', true);
    // Newsletter script removed - now using Brevo shortcode
    wp_enqueue_script('hoangho-main', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0.0', true);
    
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
 * Create newsletter subscribers table
 */
function hoangho_create_newsletter_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';
    
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        ip_address varchar(45) NOT NULL,
        user_agent text,
        status varchar(20) DEFAULT 'active',
        source varchar(50) DEFAULT 'website',
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY email (email),
        KEY ip_address (ip_address),
        KEY status (status),
        KEY created_at (created_at)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

/**
 * Handle newsletter signup AJAX with security and data collection
 */
function hoangho_newsletter_signup() {
    try {
        // Log the request for debugging
        if (function_exists('wp_debug_log')) {
            wp_debug_log('Newsletter signup request received');
        }
        
        // Verify nonce for security
        if (!wp_verify_nonce($_POST['nonce'], 'newsletter_signup_nonce')) {
            wp_send_json_error('Bảo mật không hợp lệ!');
            return;
        }
    
    // Rate limiting - prevent spam
    $ip_address = hoangho_get_client_ip();
    $rate_limit_key = 'newsletter_rate_limit_' . md5($ip_address);
    $rate_limit_count = get_transient($rate_limit_key);
    
    if ($rate_limit_count && $rate_limit_count >= 5) {
        wp_send_json_error('Bạn đã gửi quá nhiều yêu cầu. Vui lòng thử lại sau 1 giờ.');
        return;
    }
    
    if (isset($_POST['email']) && is_email($_POST['email'])) {
        $email = sanitize_email($_POST['email']);
        $user_agent = sanitize_text_field(isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
        $source = sanitize_text_field(isset($_POST['source']) ? $_POST['source'] : 'website');
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'newsletter_subscribers';
        
        // Check if email already exists
        $existing = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM $table_name WHERE email = %s", 
            $email
        ));
        
        if ($existing) {
            wp_send_json_error('Email này đã được đăng ký newsletter!');
            return;
        }
        
        // Insert new subscriber with prepared statement (SQL injection protection)
        $result = $wpdb->insert(
            $table_name,
            array(
                'email' => $email,
                'ip_address' => $ip_address,
                'user_agent' => $user_agent,
                'source' => $source,
                'status' => 'active'
            ),
            array('%s', '%s', '%s', '%s', '%s')
        );
        
        if ($result !== false) {
            // Set rate limit
            set_transient($rate_limit_key, ($rate_limit_count ? $rate_limit_count + 1 : 1), HOUR_IN_SECONDS);
            
            // Integrate with Brevo plugin if available
            if (class_exists('SIB_API_Manager')) {
                try {
                // Get default list ID from Brevo settings - use actual list ID
                $general_settings = get_option('sib_main_option', array());
                $default_list_id = 5; // Use the actual list ID from Brevo (cskh_80days)
                    
                    // Log Brevo integration attempt
                    if (function_exists('wp_debug_log')) {
                        wp_debug_log("Newsletter signup: Attempting Brevo integration for $email with list ID: $default_list_id");
                    }
                    
                    // Prepare contact info for Brevo
                    $contact_info = array(
                        'FIRSTNAME' => '',
                        'LASTNAME' => '',
                        'SMS' => '',
                        'WEBSITE' => home_url(),
                        'SOURCE' => 'Website Newsletter Form'
                    );
                    
                    // Add contact to Brevo - list_id must be an array
                    $brevo_result = SIB_API_Manager::create_subscriber($email, array($default_list_id), $contact_info, 'simple');
                    
                    // Log detailed result
                    if (function_exists('wp_debug_log')) {
                        wp_debug_log("Newsletter signup: Brevo result for $email: " . $brevo_result . " (type: " . gettype($brevo_result) . ")");
                    }
                    
                    if ($brevo_result === 'success') {
                        // Log successful Brevo integration
                        if (function_exists('wp_debug_log')) {
                            wp_debug_log("Newsletter signup: $email successfully added to Brevo list $default_list_id");
                        }
                    } else {
                        // Log Brevo integration failure but don't fail the whole process
                        if (function_exists('wp_debug_log')) {
                            wp_debug_log("Newsletter signup: $email added to local DB but failed to add to Brevo: $brevo_result");
                        }
                    }
                } catch (Exception $e) {
                    // Log error but don't fail the whole process
                    if (function_exists('wp_debug_log')) {
                        wp_debug_log("Newsletter signup: Brevo integration error for $email: " . $e->getMessage());
                    }
                }
            } else {
                // Log that Brevo plugin is not available
                if (function_exists('wp_debug_log')) {
                    wp_debug_log("Newsletter signup: Brevo plugin not available for $email");
                }
            }
            
            // Send confirmation email
            $subject = 'Đăng ký newsletter thành công - HoangHo';
            $message = "Xin chào,\n\nCảm ơn bạn đã đăng ký nhận newsletter từ HoangHo Real Estate Development.\n\nBạn sẽ nhận được những thông tin mới nhất về:\n- Dự án bất động sản mới\n- Tin tức thị trường\n- Ưu đãi đặc biệt\n\nTrân trọng,\nĐội ngũ HoangHo";
            
            wp_mail($email, $subject, $message);
            
            // Log for admin notification (using WordPress logging)
            if (function_exists('wp_debug_log')) {
                wp_debug_log("Newsletter signup: $email from IP: $ip_address");
            }
            
            wp_send_json_success('Đăng ký newsletter thành công! Bạn sẽ nhận được email xác nhận.');
        } else {
            wp_send_json_error('Có lỗi xảy ra. Vui lòng thử lại sau.');
        }
    } else {
        wp_send_json_error('Email không hợp lệ!');
    }
    } catch (Exception $e) {
        error_log('Newsletter signup error: ' . $e->getMessage());
        wp_send_json_error('Có lỗi xảy ra: ' . $e->getMessage());
    }
}
add_action('wp_ajax_newsletter_signup', 'hoangho_newsletter_signup');
add_action('wp_ajax_nopriv_newsletter_signup', 'hoangho_newsletter_signup');

// AJAX handler to clear rate limit for testing
function hoangho_clear_rate_limit_ajax() {
    // Clear all rate limit transients
    global $wpdb;
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_newsletter_rate_limit_%'");
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_newsletter_rate_limit_%'");
    
    wp_send_json_success('Rate limit đã được xóa. Bây giờ bạn có thể test form newsletter!');
}
add_action('wp_ajax_clear_rate_limit', 'hoangho_clear_rate_limit_ajax');
add_action('wp_ajax_nopriv_clear_rate_limit', 'hoangho_clear_rate_limit_ajax');


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
                echo '<div class="notice notice-success"><p><strong>Brevo Integration:</strong> Plugin đã được cấu hình và sẵn sàng nhận email từ form newsletter.</p></div>';
            } else {
                echo '<div class="notice notice-warning"><p><strong>Brevo Integration:</strong> Plugin đã được cài đặt nhưng chưa được cấu hình API key. <a href="' . admin_url('admin.php?page=sib_page_home') . '">Cấu hình ngay</a></p></div>';
            }
        } else {
            echo '<div class="notice notice-info"><p><strong>Brevo Integration:</strong> Form newsletter sẽ lưu email vào database local. Để tích hợp với Brevo, hãy cài đặt và cấu hình Brevo plugin.</p></div>';
        }
    }
}
add_action('admin_notices', 'hoangho_brevo_admin_notice');

/**
 * Test Brevo integration with a sample email
 */
function hoangho_test_brevo_integration() {
    if (is_admin() && current_user_can('manage_options') && isset($_GET['test_brevo'])) {
        if (class_exists('SIB_API_Manager')) {
            $test_email = 'test@example.com';
            $general_settings = get_option('sib_main_option', array());
            $default_list_id = isset($general_settings['default_list_id']) ? $general_settings['default_list_id'] : 1;
            
            $contact_info = array(
                'FIRSTNAME' => 'Test',
                'LASTNAME' => 'User',
                'SMS' => '',
                'WEBSITE' => home_url(),
                'SOURCE' => 'Test Integration'
            );
            
            $result = SIB_API_Manager::create_subscriber($test_email, array($default_list_id), $contact_info, 'simple');
            
            if ($result === 'success') {
                echo '<div class="notice notice-success"><p>✅ Brevo integration test thành công!</p></div>';
            } else {
                echo '<div class="notice notice-error"><p>❌ Brevo integration test thất bại: ' . $result . '</p></div>';
            }
        } else {
            echo '<div class="notice notice-error"><p>❌ Brevo plugin chưa được cài đặt hoặc kích hoạt</p></div>';
        }
    }
}
add_action('admin_notices', 'hoangho_test_brevo_integration');

/**
 * Debug Brevo integration status
 */
function hoangho_debug_brevo_status() {
    if (is_admin() && current_user_can('manage_options') && isset($_GET['debug_brevo'])) {
        echo '<div class="notice notice-info"><p><strong>Brevo Debug Info:</strong></p>';
        echo '<ul>';
        echo '<li>SIB_API_Manager class exists: ' . (class_exists('SIB_API_Manager') ? 'Yes' : 'No') . '</li>';
        echo '<li>SIB_Manager class exists: ' . (class_exists('SIB_Manager') ? 'Yes' : 'No') . '</li>';
        if (class_exists('SIB_Manager')) {
            echo '<li>SIB_Manager::is_api_key_set() method exists: ' . (method_exists('SIB_Manager', 'is_api_key_set') ? 'Yes' : 'No') . '</li>';
            echo '<li>API key is set: ' . (SIB_Manager::is_api_key_set() ? 'Yes' : 'No') . '</li>';
        }
        echo '<li>sib_api_key_v3 option: ' . (get_option('sib_api_key_v3') ? 'Set' : 'Not set') . '</li>';
        echo '<li>sib_default_list_id option: ' . get_option('sib_default_list_id', 'Not set') . '</li>';
        echo '</ul></div>';
    }
}
add_action('admin_notices', 'hoangho_debug_brevo_status');

/**
 * Test Brevo integration with simple email
 */
function hoangho_simple_brevo_test() {
    if (is_admin() && current_user_can('manage_options') && isset($_GET['test_simple_brevo'])) {
        if (class_exists('SIB_API_Manager')) {
            $test_email = 'test@example.com';
            $general_settings = get_option('sib_main_option', array());
            $default_list_id = isset($general_settings['default_list_id']) ? $general_settings['default_list_id'] : 1;
            
            $contact_info = array(
                'FIRSTNAME' => 'Test',
                'LASTNAME' => 'User',
                'SMS' => '',
                'WEBSITE' => home_url(),
                'SOURCE' => 'Simple Test'
            );
            
            try {
                $result = SIB_API_Manager::create_subscriber($test_email, array($default_list_id), $contact_info, 'simple');
                
                if ($result === 'success') {
                    echo '<div class="notice notice-success"><p>✅ Simple Brevo test thành công!</p></div>';
                } else {
                    echo '<div class="notice notice-error"><p>❌ Simple Brevo test thất bại: ' . $result . '</p></div>';
                }
            } catch (Exception $e) {
                echo '<div class="notice notice-error"><p>❌ Simple Brevo test error: ' . $e->getMessage() . '</p></div>';
            }
        } else {
            echo '<div class="notice notice-error"><p>❌ SIB_API_Manager class không tồn tại</p></div>';
        }
    }
}
add_action('admin_notices', 'hoangho_simple_brevo_test');

/**
 * Clear rate limit cache for testing
 */
function hoangho_clear_rate_limit() {
    if (is_admin() && current_user_can('manage_options') && isset($_GET['clear_rate_limit'])) {
        // Clear all rate limit transients
        global $wpdb;
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_newsletter_rate_limit_%'");
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_newsletter_rate_limit_%'");
        
        echo '<div class="notice notice-success"><p>✅ Đã xóa tất cả rate limit cache. Bây giờ bạn có thể test form newsletter!</p></div>';
    }
}
add_action('admin_notices', 'hoangho_clear_rate_limit');

/**
 * Debug Brevo integration in detail
 */
function hoangho_debug_brevo_detailed() {
    if (is_admin() && current_user_can('manage_options') && isset($_GET['debug_brevo_detailed'])) {
        echo '<div class="notice notice-info"><p><strong>Brevo Detailed Debug:</strong></p>';
        
        // Check if classes exist
        echo '<h4>1. Class Check:</h4>';
        echo '<ul>';
        echo '<li>SIB_API_Manager: ' . (class_exists('SIB_API_Manager') ? '✅ Exists' : '❌ Not found') . '</li>';
        echo '<li>SIB_Manager: ' . (class_exists('SIB_Manager') ? '✅ Exists' : '❌ Not found') . '</li>';
        echo '</ul>';
        
        // Check API key
        echo '<h4>2. API Key Check:</h4>';
        if (class_exists('SIB_Manager')) {
            echo '<ul>';
            echo '<li>is_api_key_set(): ' . (SIB_Manager::is_api_key_set() ? '✅ Yes' : '❌ No') . '</li>';
            echo '<li>sib_api_key_v3: ' . (get_option('sib_api_key_v3') ? '✅ Set' : '❌ Not set') . '</li>';
            echo '</ul>';
        }
        
        // Check list ID
        echo '<h4>3. List ID Check:</h4>';
        $general_settings = get_option('sib_main_option', array());
        $default_list_id = isset($general_settings['default_list_id']) ? $general_settings['default_list_id'] : 1;
        echo '<ul>';
        echo '<li>Default List ID: ' . $default_list_id . '</li>';
        echo '<li>List ID Type: ' . gettype($default_list_id) . '</li>';
        echo '<li>General Settings: ' . print_r($general_settings, true) . '</li>';
        echo '</ul>';
        
        // Test API connection
        echo '<h4>4. API Connection Test:</h4>';
        if (class_exists('SIB_API_Manager') && class_exists('SIB_Manager') && SIB_Manager::is_api_key_set()) {
            try {
                $test_email = 'test-debug@example.com';
                $contact_info = array(
                    'FIRSTNAME' => 'Test',
                    'LASTNAME' => 'Debug',
                    'SMS' => '',
                    'WEBSITE' => home_url(),
                    'SOURCE' => 'Debug Test'
                );
                
                echo '<p>Testing with email: ' . $test_email . '</p>';
                echo '<p>List ID: ' . $default_list_id . ' (as array: [' . $default_list_id . '])</p>';
                
                $result = SIB_API_Manager::create_subscriber($test_email, array($default_list_id), $contact_info, 'simple');
                
                echo '<p>Result: ' . $result . '</p>';
                echo '<p>Result Type: ' . gettype($result) . '</p>';
                
                if ($result === 'success') {
                    echo '<p style="color: green;">✅ API Test Successful!</p>';
                } else {
                    echo '<p style="color: red;">❌ API Test Failed: ' . $result . '</p>';
                }
                
            } catch (Exception $e) {
                echo '<p style="color: red;">❌ API Test Exception: ' . $e->getMessage() . '</p>';
            }
        } else {
            echo '<p style="color: red;">❌ Cannot test API - missing requirements</p>';
        }
        
        echo '</div>';
    }
}
add_action('admin_notices', 'hoangho_debug_brevo_detailed');

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
 * Create table on theme activation
 */
function hoangho_theme_activation() {
    hoangho_create_newsletter_table();
}
add_action('after_switch_theme', 'hoangho_theme_activation');

/**
 * Create table immediately if not exists
 */
function hoangho_check_newsletter_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';
    
    // Check if table exists
    $table_exists = $wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name;
    
    if (!$table_exists) {
        hoangho_create_newsletter_table();
    }
}
add_action('init', 'hoangho_check_newsletter_table');

/**
 * Add admin menu for newsletter subscribers
 */
function hoangho_newsletter_admin_menu() {
    add_menu_page(
        'Newsletter Subscribers',
        'Newsletter',
        'manage_options',
        'newsletter-subscribers',
        'hoangho_newsletter_admin_page',
        'dashicons-email-alt',
        30
    );
}
add_action('admin_menu', 'hoangho_newsletter_admin_menu');

/**
 * Admin page for newsletter subscribers
 */
function hoangho_newsletter_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';
    
    // Get subscribers
    $subscribers = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");
    $total_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
    $active_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE status = 'active'");
    
    // Check Brevo integration status
    $brevo_status = hoangho_check_brevo_integration();
    
    ?>
    <div class="wrap">
        <h1>Newsletter Subscribers</h1>
        
        <div class="notice notice-info">
            <p><strong>Tổng số subscribers:</strong> <?php echo $total_count; ?> | <strong>Active:</strong> <?php echo $active_count; ?></p>
        </div>
        
        <?php if ($brevo_status): ?>
        <div class="notice <?php echo $brevo_status['api_configured'] ? 'notice-success' : 'notice-warning'; ?>">
            <p><strong>Brevo Integration Status:</strong> 
                <?php if ($brevo_status['plugin_active']): ?>
                    <?php if ($brevo_status['api_configured']): ?>
                        ✅ Plugin đã được cấu hình và sẵn sàng nhận email từ form newsletter
                    <?php else: ?>
                        ⚠️ Plugin đã được cài đặt nhưng chưa được cấu hình API key. 
                        <a href="<?php echo admin_url('admin.php?page=sib_page_home'); ?>">Cấu hình ngay</a>
                    <?php endif; ?>
                <?php else: ?>
                    ❌ Brevo plugin chưa được cài đặt hoặc kích hoạt
                <?php endif; ?>
            </p>
        </div>
        <?php endif; ?>
        
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>IP Address</th>
                    <th>Source</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>User Agent</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($subscribers): ?>
                    <?php foreach ($subscribers as $subscriber): ?>
                        <tr>
                            <td><?php echo $subscriber->id; ?></td>
                            <td><?php echo esc_html($subscriber->email); ?></td>
                            <td><?php echo esc_html($subscriber->ip_address); ?></td>
                            <td><?php echo esc_html($subscriber->source); ?></td>
                            <td>
                                <span class="status-<?php echo $subscriber->status; ?>">
                                    <?php echo ucfirst($subscriber->status); ?>
                                </span>
                            </td>
                            <td><?php echo date('d/m/Y H:i', strtotime($subscriber->created_at)); ?></td>
                            <td title="<?php echo esc_attr($subscriber->user_agent); ?>">
                                <?php echo esc_html(substr($subscriber->user_agent, 0, 50)) . (strlen($subscriber->user_agent) > 50 ? '...' : ''); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Chưa có subscriber nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <style>
            .status-active { color: #46b450; font-weight: bold; }
            .status-inactive { color: #dc3232; font-weight: bold; }
        </style>
    </div>
    <?php
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
?>
