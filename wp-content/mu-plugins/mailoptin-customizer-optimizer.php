<?php
/**
 * Plugin Name: MailOptin Customizer Integration
 * Description: Improve customizer compatibility between MailOptin and other plugins.
 * Version: 0.2
 * Author: MailOptin
 */

// Prevent direct access
if ( ! defined('ABSPATH')) {
    exit;
}

class MailOptinCustomizerIntegration
{
    // Allowed themes in order of preference
    private $allowed_themes = [
        'twentytwentyfive',
        'twentytwentyfour',
        'twentytwentythree',
        'twentytwentytwo',
        'twentytwentyone',
        'twentytwenty',
        'twentynineteen',
        'twentyseventeen',
        'twentysixteen',
        'twentyfifteen',
        'twentyfourteen',
        'twentythirteen',
        'twentytwelve',
        'twentyeleven',
        'twentyten',
    ];

    // Plugins that should remain active
    private $required_plugins = [
        'mailoptin/mailoptin.php',
        'woocommerce/woocommerce.php',
        'woocommerce-memberships/woocommerce-memberships.php',
        'woocommerce-subscriptions/woocommerce-subscriptions.php',
        'woocommerce-payments/woocommerce-payments.php',
        'paid-memberships-pro/paid-memberships-pro.php',
        'lifterlms/lifterlms.php',
        'give/give.php',
        'ultimate-member/ultimate-member.php',
    ];

    // Plugins that should remain active
    private $required_plugins_substring = [
        'fluent',
        'groundhogg',
        'mailpoet',
        'wemail',
        'memberpress',
        'elementor',
        'easy-digital-downloads',
        'edd-',
        'sfwd-lms',
        'tutor',
        'restrict-content',
        'polylang',
        'sitepress-multilingual-cms',
        'weglot'
    ];

    public function __construct()
    {
        // Filter active plugins
        add_filter('option_active_plugins', [$this, 'filter_active_plugins']);

        // Filter current theme
        add_filter('stylesheet', [$this, 'filter_theme']);
        add_filter('template', [$this, 'filter_theme']);
    }

    private function should_modify_environment()
    {
        return (
            is_admin() &&
            (isset($_GET['mailoptin_optin_campaign_id']) || isset($_GET['mailoptin_email_campaign_id'])) &&
            isset($_SERVER['SCRIPT_FILENAME']) &&
            basename($_SERVER['SCRIPT_FILENAME']) === 'customize.php' &&
            (get_option('mailoptin_settings', [])['enable_safe_mode'] ?? '') === 'true'
        );
    }

    public function filter_active_plugins($plugins)
    {
        if ( ! $this->should_modify_environment()) {
            return $plugins;
        }

        // Filter to keep only the required plugins
        return array_values(array_filter($plugins, function ($plugin) {

            if (in_array($plugin, $this->required_plugins)) {
                return true;
            }

            // Then check for substrings
            foreach ($this->required_plugins_substring as $substring) {
                if (stripos($plugin, $substring) !== false) {
                    return true;
                }
            }

            return false;

        }));
    }

    public function filter_theme($stylesheet)
    {
        if ( ! $this->should_modify_environment()) {
            return $stylesheet;
        }

        // If current theme is already in allowed themes list, keep using it
        if (in_array($stylesheet, $this->allowed_themes)) {
            return $stylesheet;
        }

        // Otherwise, try to switch to first available allowed theme
        $installed_themes = wp_get_themes();

        foreach ($this->allowed_themes as $theme_slug) {
            if (isset($installed_themes[$theme_slug])) {
                return $theme_slug;
            }
        }

        // If no allowed theme is found, return the current theme
        return $stylesheet;
    }
}

// Initialize the plugin
new MailOptinCustomizerIntegration();