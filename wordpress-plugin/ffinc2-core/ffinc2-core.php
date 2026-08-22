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

/**
 * RFQ forms: resolve the listing fields server-side from listing_id.
 *
 * The RFQ modal deliberately sends only the listing_id. The recipient address
 * is never placed in the page markup and never accepted from the request:
 *
 *   - keeping contact_email out of the DOM stops address harvesting, and
 *   - deriving the recipient here stops the endpoint being used as an open
 *     relay by POSTing an arbitrary listing_email.
 *
 * Runs on fluentform/insert_response_data, which fires before the entry is
 * stored, so the stored submission and the notifications built from it both
 * see the resolved values.
 *
 * @param array $formData     Submitted data, about to be stored.
 * @param int   $formId       Fluent Forms form id.
 * @param array $inputConfigs Parsed field config (unused).
 * @return array
 */
add_filter('fluentform/insert_response_data', 'ffinc2_rfq_resolve_listing', 10, 3);
function ffinc2_rfq_resolve_listing($formData, $formId, $inputConfigs = array()) {
    $rfq_forms = apply_filters('ffinc2_rfq_form_ids', array(10, 11));
    if (!in_array((int) $formId, array_map('intval', $rfq_forms), true)) {
        return $formData;
    }

    $listing_id = isset($formData['listing_id']) ? absint($formData['listing_id']) : 0;
    // Never let a submitted address through, even if the id is unusable.
    $formData['listing_email'] = '';
    if (!$listing_id) {
        return $formData;
    }

    $post = get_post($listing_id);
    if (!$post || !in_array($post->post_type, array('gd_supplier', 'gd_services'), true)
        || $post->post_status !== 'publish') {
        return $formData;
    }

    $email = '';
    if (function_exists('geodir_get_post_meta')) {
        $email = (string) geodir_get_post_meta($listing_id, 'contact_email', true);
    }
    $email = sanitize_email($email);

    $formData['listing_email'] = is_email($email) ? $email : '';
    $formData['listing_name']  = get_the_title($listing_id);
    $formData['listing_url']   = get_permalink($listing_id);

    return $formData;
}

/**
 * Anti-spam inputs Fluent Forms expects on an RFQ submission.
 *
 * FF's own renderer emits these; the RFQ modal is hand-built, so it has to
 * supply them itself:
 *
 *   - honeypot: a field that must be present and empty
 *   - protection token: an encrypted timestamp|form|field triple
 *
 * Both are only enforced when the matching global setting is on, and both are
 * harmless when it is off, so they are always returned.
 *
 * @param int $form_id
 * @return array name => value pairs to submit alongside the form data.
 */
function ffinc2_rfq_spam_inputs($form_id) {
    $form_id = absint($form_id);
    $out = array();

    $honeypot = apply_filters('fluentform/honeypot_name', 'item_' . $form_id . '__fluent_sf', $form_id);
    $out[$honeypot] = '';

    $token_class = 'FluentForm\\App\\Modules\\Form\\TokenBasedSpamProtection';
    if (is_callable(array($token_class, 'getConversationalTokenInput'))) {
        $token = call_user_func(array($token_class, 'getConversationalTokenInput'), $form_id);
        if (is_array($token)) {
            $out = array_merge($out, $token);
        }
    }

    return $out;
}

/**
 * Mint a fresh set of those inputs on demand.
 *
 * The protection token expires an hour after it is generated, so a listing page
 * left open longer than that would otherwise fail with FF's opaque "Suspicious
 * activity detected" message. The modal calls this immediately before
 * submitting, which keeps the page valid for as long as it stays open.
 *
 * Only the RFQ forms are mintable here, and this grants no more than loading
 * the page already does.
 */
add_action('wp_ajax_ffinc2_rfq_token', 'ffinc2_rfq_token_endpoint');
add_action('wp_ajax_nopriv_ffinc2_rfq_token', 'ffinc2_rfq_token_endpoint');
function ffinc2_rfq_token_endpoint() {
    $form_id   = isset($_GET['form_id']) ? absint($_GET['form_id']) : 0;
    $rfq_forms = array_map('intval', apply_filters('ffinc2_rfq_form_ids', array(10, 11)));

    if (!in_array($form_id, $rfq_forms, true)) {
        wp_send_json_error(array('message' => 'Unrecognised form.'), 400);
    }

    wp_send_json_success(ffinc2_rfq_spam_inputs($form_id));
}
