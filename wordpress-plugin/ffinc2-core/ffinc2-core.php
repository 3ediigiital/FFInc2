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
    $templates['ffinc2-category-fruits-veg.php'] = 'FFInc 2.0 — Category: Fruits & Veg';
    $templates['ffinc2-category-poultry.php']    = 'FFInc 2.0 — Category: Poultry';
    $templates['ffinc2-category-beef-meat.php']  = 'FFInc 2.0 — Category: Beef & Meat';
    $templates['ffinc2-category-seafood.php']    = 'FFInc 2.0 — Category: Seafood';
    $templates['ffinc2-category-services.php']   = 'FFInc 2.0 — Category: Services';
    $templates['ffinc2-gd-archive-suppliers.php'] = 'FFInc 2.0 — GD Archive: Suppliers';
    $templates['ffinc2-gd-archive-services.php']  = 'FFInc 2.0 — GD Archive: Services';
    $templates['ffinc2-gd-details.php']           = 'FFInc 2.0 — GD Details';
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

// Route GeoDirectory CPT/category archives to our custom archive templates.
// GeoDirectory uses one global "GD Archive" page for every CPT (there is no
// per-CPT archive page-template setting), so per-CPT routing is done here.
// Priority 99 runs after GeoDir_Template_Loader (10) so ours wins.
add_filter('template_include', 'ffinc2_load_gd_archive_template', 99);
function ffinc2_load_gd_archive_template($template) {
    if (is_post_type_archive('gd_supplier') || is_tax('gd_suppliercategory')) {
        $f = FFINC2_PATH . 'templates/ffinc2-gd-archive-suppliers.php';
        if (file_exists($f)) return $f;
    }
    if (is_post_type_archive('gd_services') || is_tax('gd_servicescategory')) {
        $f = FFINC2_PATH . 'templates/ffinc2-gd-archive-services.php';
        if (file_exists($f)) return $f;
    }
    return $template;
}

// Route GeoDirectory single listing (Details) views for both CPTs to our
// custom Details template. Same priority-99 pattern as the archive router:
// one template branches internally between Supplier and Service modes.
add_filter('template_include', 'ffinc2_load_gd_details_template', 99);
function ffinc2_load_gd_details_template($template) {
    if (is_singular('gd_supplier') || is_singular('gd_services')) {
        $f = FFINC2_PATH . 'templates/ffinc2-gd-details.php';
        if (file_exists($f)) return $f;
    }
    return $template;
}
