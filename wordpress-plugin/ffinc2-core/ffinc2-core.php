<?php
/**
 * Plugin Name: FFInc 2.0 Core
 * Description: Custom page templates and shared design system for FrozenFoodInc 2.0 database pages.
 * Version: 1.0.0
 * Author: FFInc
 */

if (!defined('ABSPATH')) exit;

define('FFINC2_PATH', plugin_dir_path(__FILE__));
define('FFINC2_URL', plugin_dir_url(__FILE__));

// Enqueue shared design system site-wide
add_action('wp_enqueue_scripts', 'ffinc2_enqueue_assets');
function ffinc2_enqueue_assets() {
    wp_enqueue_style(
        'ffinc2-fonts',
        'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600&display=swap',
        [], null
    );
    wp_enqueue_style(
        'ffinc2-tabler-icons',
        'https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.11.0/dist/tabler-icons.min.css',
        [], null
    );
    wp_enqueue_style(
        'ffinc2-design-system',
        FFINC2_URL . 'assets/css/design-system.css',
        [], '1.0.0'
    );
    wp_enqueue_script(
        'ffinc2-gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
        [], null, true
    );
    wp_enqueue_script(
        'ffinc2-main',
        FFINC2_URL . 'assets/js/main.js',
        ['ffinc2-gsap'], '1.0.0', true
    );
}

// Register our custom page templates so they appear
// in the Page Attributes > Template dropdown
add_filter('theme_page_templates', 'ffinc2_register_templates');
function ffinc2_register_templates($templates) {
    $templates['ffinc2-home.php'] = 'FFInc 2.0 — Homepage';
    return $templates;
}

// Load the correct template file when a page uses one
add_filter('template_include', 'ffinc2_load_template');
function ffinc2_load_template($template) {
    if (is_page()) {
        $slug = get_page_template_slug();
        if ($slug) {
            $plugin_template = FFINC2_PATH . 'templates/' . $slug;
            if (file_exists($plugin_template)) {
                return $plugin_template;
            }
        }
    }
    return $template;
}
