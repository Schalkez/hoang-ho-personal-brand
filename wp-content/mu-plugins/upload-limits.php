<?php
/**
 * Plugin Name: Upload Limits Override
 * Description: Override WordPress upload limits
 * Version: 1.0
 */

// Increase upload limits
function override_upload_limits() {
    ini_set('upload_max_filesize', '50M');
    ini_set('post_max_size', '50M');
    ini_set('max_execution_time', 300);
    ini_set('max_input_time', 300);
    ini_set('memory_limit', '512M');
}
add_action('init', 'override_upload_limits');

// Override WordPress upload size limit
function custom_upload_size_limit() {
    return 50 * 1024 * 1024; // 50MB in bytes
}
add_filter('upload_size_limit', 'custom_upload_size_limit');

// Increase image size limits
function increase_image_size_limits() {
    // Increase maximum image dimensions
    add_filter('big_image_size_threshold', function() {
        return 4096; // Increase from default 2560 to 4096 pixels
    });
    
    // Override image size limits
    add_filter('wp_image_editors', function($editors) {
        return array('WP_Image_Editor_GD', 'WP_Image_Editor_Imagick');
    });
}
add_action('init', 'increase_image_size_limits');

// Add custom admin notice
function upload_limits_admin_notice() {
    if (current_user_can('manage_options')) {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p><strong>Upload Limits:</strong> Maximum file size increased to 10MB</p>';
        echo '</div>';
    }
}
add_action('admin_notices', 'upload_limits_admin_notice');
?>
