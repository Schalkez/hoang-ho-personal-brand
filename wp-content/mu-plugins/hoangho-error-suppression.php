<?php
/**
 * Plugin Name: HoangHo Error Suppression
 * Description: Suppress WordPress version check warnings and headers already sent errors
 * Version: 1.0.0
 * Author: HoangHo
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Suppress WordPress version check warnings
 */
function hoangho_suppress_warnings() {
    // Suppress PHP warnings and errors
    if (!defined('WP_DEBUG') || !WP_DEBUG) {
        error_reporting(0);
        ini_set('display_errors', 0);
    }
    
    // Disable WordPress version check
    remove_action('wp_version_check', 'wp_version_check');
    remove_action('admin_init', '_maybe_update_core');
    
    // Disable automatic updates
    add_filter('automatic_updater_disabled', '__return_true');
    add_filter('auto_update_core', '__return_false');
    add_filter('auto_update_plugin', '__return_false');
    add_filter('auto_update_theme', '__return_false');
    
    // Suppress only version check errors, allow plugin/theme installation
    add_filter('pre_http_request', function($preempt, $parsed_args, $url) {
        // Only block version check, allow plugin/theme API
        if (strpos($url, 'api.wordpress.org/core/version-check') !== false) {
            return new WP_Error('version_check_disabled', 'Version check disabled');
        }
        return $preempt;
    }, 10, 3);
}

// Run early to suppress warnings
add_action('init', 'hoangho_suppress_warnings', 1);

/**
 * Ensure plugin installation works properly
 */
function hoangho_enable_plugin_installation() {
    // Re-enable plugin installation capabilities
    add_filter('filesystem_method', function($method) {
        return 'direct';
    });
    
    // Allow plugin API requests
    add_filter('http_request_args', function($args, $url) {
        if (strpos($url, 'api.wordpress.org/plugins') !== false || 
            strpos($url, 'api.wordpress.org/themes') !== false) {
            $args['timeout'] = 30;
            $args['sslverify'] = false; // For local development
        }
        return $args;
    }, 10, 2);
}
add_action('admin_init', 'hoangho_enable_plugin_installation');