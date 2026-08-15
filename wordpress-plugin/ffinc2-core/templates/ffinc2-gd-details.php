<?php
/*
Template Name: FFInc 2.0 — GD Details
*/
/**
 * FFInc 2.0 — GeoDirectory single-listing (Details) template.
 *
 * ONE template that branches by CPT:
 *   - gd_supplier  → Supplier mode (category-color accent, Products tab, Export/Company facts)
 *   - gd_services  → Service mode  (purple accent, Services tab, Coverage regions)
 *
 * All data is pulled live from GeoDirectory custom fields (detail table) and
 * the native review system. Shared chrome (nav, footer, quote modal, badges,
 * background layers) + main.js are enqueued site-wide by the plugin; only this
 * page's own components + accent live here, scoped under .ffdt so one file
 * serves both modes. get_header()/get_footer() wrap the output.
 */
if (!defined('ABSPATH')) exit;
get_header();

/* ---- Helpers (guarded so this file and the archive partial can coexist) ---- */
if (!function_exists('ffinc2_gd_meta')) {
    function ffinc2_gd_meta($post_id, $key) {
        if (function_exists('geodir_get_post_meta')) {
            $v = geodir_get_post_meta($post_id, $key, true);
            if ($v !== '' && $v !== null && $v !== false) return $v;
        }
        return get_post_meta($post_id, $key, true);
    }
}
if (!function_exists('ffinc2_gd_multi')) {
    function ffinc2_gd_multi($val) {
        if (is_array($val)) $parts = $val;
        else $parts = preg_split('/[,\r\n]+/', (string) $val);
        $out = array();
        foreach ($parts as $p) {
            $p = trim($p);
            if ($p === '' || stripos($p, 'optgroup') === 0) continue;
            $out[] = $p;
        }
        return array_values(array_unique($out));
    }
}
if (!function_exists('ffinc2_gd_initials')) {
    function ffinc2_gd_initials($name) {
        $name = trim(wp_strip_all_tags($name));
        if ($name === '') return '—';
        $words = preg_split('/\s+/', $name);
        if (count($words) >= 2) return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        return strtoupper(substr($name, 0, 2));
    }
}
if (!function_exists('ffinc2_gd_add_url')) {
    function ffinc2_gd_add_url($cpt) {
        if (function_exists('geodir_add_listing_page_url')) {
            $u = geodir_add_listing_page_url($cpt);
            if ($u) return $u;
        }
        if (function_exists('geodir_get_add_listing_url')) {
            $u = geodir_get_add_listing_url($cpt);
            if ($u) return $u;
        }
        return home_url('/');
    }
}
if (!function_exists('ffinc2_dt_stars')) {
    // Render 5 star icons for a float average (full / half / empty).
    function ffinc2_dt_stars($avg) {
        $avg = (float) $avg; $out = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($avg >= $i)            $out .= '<i class="ti ti-star-filled" aria-hidden="true"></i>';
            elseif ($avg >= $i - 0.5)  $out .= '<i class="ti ti-star-half-filled" aria-hidden="true"></i>';
            else                       $out .= '<i class="ti ti-star" aria-hidden="true"></i>';
        }
        return $out;
    }
}

/* ---- Resolve the current listing + mode ---- */
$current_post = get_queried_object();
$post_type    = isset($current_post->post_type) ? $current_post->post_type : '';
$is_service   = ($post_type === 'gd_services');
$pid          = isset($current_post->ID) ? (int) $current_post->ID : 0;

$name    = get_the_title($pid);
$noun    = $is_service ? 'Provider' : 'Supplier';
$noun_lc = strtolower($noun);
$tax     = $is_service ? 'gd_servicescategory' : 'gd_suppliercategory';

/* Category term → accent + icon (same colour map as the archive templates). */
$CAT = array(
    'frozen-fruits-vegetables' => array('#2ECC9A', 'ti ti-leaf'),
    'frozen-poultry'           => array('#4A9FE0', 'ti ti-feather'),
    'frozen-beef-meat'         => array('#F59E0B', 'ti ti-flame'),
    'frozen-seafood'           => array('#52DEB5', 'ti ti-fish'),
    'cold-chain-services'      => array('#A78BFA', 'ti ti-truck'),
);
$cat_terms = get_the_terms($pid, $tax);
$cat_term  = (!is_wp_error($cat_terms) && !empty($cat_terms)) ? $cat_terms[0] : null;
$cat_slug  = $cat_term ? $cat_term->slug : '';
$cat_name  = $cat_term ? $cat_term->name : ($is_service ? 'Cold Chain Services' : 'Supplier');
$accent    = isset($CAT[$cat_slug]) ? $CAT[$cat_slug][0] : ($is_service ? '#A78BFA' : '#4A9FE0');
$cat_icon  = isset($CAT[$cat_slug]) ? $CAT[$cat_slug][1] : ($is_service ? 'ti ti-truck' : 'ti ti-building-warehouse');

/* Logo: GD listing image if present, else initials. */
$logo_url = '';
if (function_exists('geodir_get_images')) {
    $imgs = geodir_get_images($pid, 1);
    if (!empty($imgs)) {
        $im = is_array($imgs) ? reset($imgs) : $imgs;
        if (is_object($im)) {
            if (!empty($im->src))       $logo_url = $im->src;
            elseif (!empty($im->file))  $logo_url = $im->file;
        }
    }
}
if (!$logo_url) {
    $thumb = get_the_post_thumbnail_url($pid, 'medium');
    if ($thumb) $logo_url = $thumb;
}
$initials = ffinc2_gd_initials($name);

/* Location + basic meta. */
$city = ffinc2_gd_meta($pid, 'city');
$ctry = ffinc2_gd_meta($pid, 'country');
$loc  = trim($city . (($city && $ctry) ? ', ' : '') . $ctry);
if ($loc === '') $loc = $ctry ?: $city;
$est       = ffinc2_gd_meta($pid, 'established_year');
$employees = $is_service ? '' : ffinc2_gd_meta($pid, 'employee_count');
$website   = ffinc2_gd_meta($pid, 'website');

/* Trust flags. */
$featured = ffinc2_gd_meta($pid, 'featured_listing');
$verified = $is_service ? ffinc2_gd_meta($pid, 'verified_provider') : ffinc2_gd_meta($pid, 'verified_supplier');

/* Native GeoDirectory reviews. */
global $wpdb;
$prt        = $wpdb->prefix . 'geodir_post_review';
$breakdown  = array(5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0);
$reviews    = array();
if ($wpdb->get_var("SHOW TABLES LIKE '{$prt}'") === $prt && $pid) {
    $brows = $wpdb->get_results($wpdb->prepare(
        "SELECT rating, COUNT(*) AS c FROM {$prt} WHERE post_id=%d AND rating>0 GROUP BY rating", $pid));
    foreach ((array) $brows as $b) {
        $r = (int) round($b->rating);
        if ($r >= 1 && $r <= 5) $breakdown[$r] = (int) $b->c;
    }
    $reviews = $wpdb->get_results($wpdb->prepare(
        "SELECT r.rating, c.comment_author, c.comment_content, c.comment_date
           FROM {$prt} r
           INNER JOIN {$wpdb->comments} c ON c.comment_ID = r.comment_id
          WHERE r.post_id=%d AND c.comment_approved='1' AND r.rating>0
          ORDER BY c.comment_date DESC LIMIT 20", $pid));
}
$review_total = array_sum($breakdown);
$avg          = (float) ffinc2_gd_meta($pid, 'overall_rating');
$rcount       = (int) ffinc2_gd_meta($pid, 'rating_count');
if ($rcount <= 0)  $rcount = $review_total;
if ($avg <= 0 && $review_total > 0) {
    $sum = 0; foreach ($breakdown as $s => $n) { $sum += $s * $n; }
    $avg = $sum / max(1, $review_total);
}
$has_reviews = ($rcount > 0);

/* Hero stat bar — 4 stats, conditional by mode. */
if ($is_service) {
    $cov      = ffinc2_gd_multi(ffinc2_gd_meta($pid, 'coverage_region'));
    $cov_disp = $cov ? (count($cov) > 1 ? count($cov) . ' regions' : $cov[0]) : '';
    $hero_stats = array(
        array('Coverage', $cov_disp),
        array('Capacity / Fleet', ffinc2_gd_meta($pid, 'capacity__fleet_size')),
        array('Typical Turnaround', ffinc2_gd_meta($pid, 'typical_turnaround')),
        array('Est. Year', $est),
    );
} else {
    $hero_stats = array(
        array('Min. Order', ffinc2_gd_meta($pid, 'minimum_order_quantity')),
        array('Export Countries', ffinc2_gd_meta($pid, 'export_countries')),
        array('Annual Capacity', ffinc2_gd_meta($pid, 'annual_capacity')),
        array('Est. Year', $est),
    );
}

/* Overview: markets / coverage pills (service has a real list field; supplier's
   export data is a numeric count, surfaced in Company Facts instead). */
$markets = $is_service ? ffinc2_gd_multi(ffinc2_gd_meta($pid, 'coverage_region')) : array();
$markets_label = 'Coverage Regions';

/* Overview: company facts — only rendered when a value actually exists. */
if ($is_service) {
    $facts = array(
        array('ti ti-calendar', 'Founded',            $est),
        array('ti ti-world',    'Coverage Regions',   ($cov ? count($cov) : '')),
        array('ti ti-truck',    'Capacity / Fleet',   ffinc2_gd_meta($pid, 'capacity__fleet_size')),
        array('ti ti-clock',    'Typical Turnaround', ffinc2_gd_meta($pid, 'typical_turnaround')),
    );
} else {
    $facts = array(
        array('ti ti-calendar',          'Founded',          $est),
        array('ti ti-users',             'Employees',        $employees),
        array('ti ti-package',           'Annual Capacity',  ffinc2_gd_meta($pid, 'annual_capacity')),
        array('ti ti-building-factory',  'Facility Size',    ffinc2_gd_meta($pid, 'facility_size')),
        array('ti ti-world',             'Export Countries', ffinc2_gd_meta($pid, 'export_countries')),
        array('ti ti-list-details',      'Product Lines',    ffinc2_gd_meta($pid, 'product_lines_count')),
        array('ti ti-box',               'Min. Order',       ffinc2_gd_meta($pid, 'minimum_order_quantity')),
    );
}

/* Products / Services tab — real "range" from the type multiselects. There is
   no structured catalog field yet, so we surface the declared range + a direct
   contact state rather than fabricating product cards. */
if ($is_service) {
    $range       = ffinc2_gd_multi(ffinc2_gd_meta($pid, 'service_type'));
    $range_label = 'Services Offered';
    $tab_label   = 'Services';
} else {
    $pfmap = array(
        'frozen-fruits-vegetables' => 'fruits__veg_products',
        'frozen-poultry'           => 'poultry_products',
        'frozen-beef-meat'         => 'beef__meat_products',
        'frozen-seafood'           => 'seafood_products',
    );
    $pf          = isset($pfmap[$cat_slug]) ? $pfmap[$cat_slug] : '';
    $range       = $pf ? ffinc2_gd_multi(ffinc2_gd_meta($pid, $pf)) : array();
    $range_label = 'Product Range';
    $tab_label   = 'Products';
}

/* Certifications (declared, from the real multiselect). */
$certs = ffinc2_gd_multi(ffinc2_gd_meta($pid, 'certifications'));

/* About = the listing description. */
$about = $current_post ? apply_filters('the_content', $current_post->post_content) : '';

/* Similar listings — same CPT + category, excluding this one. */
$sim_args = array(
    'post_type'      => $post_type,
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'post__not_in'   => array($pid),
);
if ($cat_slug) {
    $sim_args['tax_query'] = array(array('taxonomy' => $tax, 'field' => 'slug', 'terms' => $cat_slug));
}
$sim_q = new WP_Query($sim_args);

$add_url    = ffinc2_gd_add_url($post_type);
$db_link    = get_post_type_archive_link($post_type);
$cat_link   = ($cat_term && !is_wp_error(get_term_link($cat_term))) ? get_term_link($cat_term) : $db_link;
$qattr_self = 'data-supplier-id="' . esc_attr($pid) . '" data-supplier-name="' . esc_attr($name) . '" data-supplier-logo="' . esc_attr($initials) . '" data-supplier-location="' . esc_attr($loc) . '"';
?>

<!-- ============================================================
     FFInc 2.0 GD Details — page-specific styles only, scoped to
     .ffdt. Accent is driven by --ac so one file serves both modes.
     Shared chrome + quote modal + badges live in design-system.css.
     ============================================================ -->
<style>
.ffdt{--ac:<?php echo esc_html($accent); ?>;position:relative;z-index:2}
.ffdt .dt-wrap{max-width:1160px;margin:0 auto;padding:0 32px}
/* Breadcrumb */
.ffdt .dt-bc{display:flex;align-items:center;gap:6px;font-size:11.5px;color:#6B9DB7;padding:20px 0 4px;flex-wrap:wrap}
.ffdt .dt-bc a{color:#6B9DB7;text-decoration:none}
.ffdt .dt-bc a:hover{color:var(--ac)}
.ffdt .dt-bc i{font-size:10px}
.ffdt .dt-bc .cur{color:var(--ac);font-weight:500}
/* Hero */
.ffdt .dt-hero{position:relative;overflow:hidden;background:linear-gradient(135deg,#050D18,#08131f 55%,#050D18);border-bottom:1px solid color-mix(in srgb,var(--ac) 14%,transparent);padding:8px 0 34px}
.ffdt .dt-hero-aura{position:absolute;border-radius:50%;filter:blur(72px);pointer-events:none;z-index:0}
.ffdt .dt-hgrid{position:relative;z-index:2;display:flex;gap:26px;align-items:flex-start;padding-top:18px}
.ffdt .dt-logo{width:104px;height:104px;border-radius:22px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-family:'Plus Jakarta Sans',system-ui;font-size:34px;font-weight:800;color:var(--ac);background:color-mix(in srgb,var(--ac) 12%,transparent);border:1px solid color-mix(in srgb,var(--ac) 26%,transparent);overflow:hidden}
.ffdt .dt-logo img{width:100%;height:100%;object-fit:cover}
.ffdt .dt-hmain{flex:1;min-width:0}
.ffdt .dt-hbadges{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:10px;align-items:center}
.ffdt .dt-catbdg{display:inline-flex;align-items:center;gap:6px;font-size:11px;font-weight:600;padding:4px 11px;border-radius:20px;color:var(--ac);background:color-mix(in srgb,var(--ac) 12%,transparent);border:1px solid color-mix(in srgb,var(--ac) 28%,transparent)}
.ffdt .dt-catbdg i{font-size:13px}
.ffdt .dt-h1{font-family:'Plus Jakarta Sans',system-ui;font-size:34px;font-weight:800;letter-spacing:-.8px;line-height:1.12;margin:2px 0 12px}
.ffdt .dt-meta{display:flex;gap:18px;flex-wrap:wrap;font-size:13px;color:#9BBFD8;margin-bottom:14px}
.ffdt .dt-meta span{display:inline-flex;align-items:center;gap:6px}
.ffdt .dt-meta i{font-size:14px;color:var(--ac)}
.ffdt .dt-meta a{color:#9BBFD8;text-decoration:none}
.ffdt .dt-meta a:hover{color:var(--ac)}
.ffdt .dt-rating{display:flex;align-items:center;gap:9px;margin-bottom:20px;flex-wrap:wrap}
.ffdt .dt-stars{display:inline-flex;gap:1px;color:#F5B301;font-size:16px}
.ffdt .dt-stars .ti-star{color:#33506a}
.ffdt .dt-rnum{font-family:'Plus Jakarta Sans',system-ui;font-weight:800;font-size:15px;color:#fff}
.ffdt .dt-rcount{font-size:12.5px;color:#6B9DB7}
.ffdt .dt-noreview{font-size:12.5px;color:#6B9DB7;display:inline-flex;align-items:center;gap:6px}
.ffdt .dt-noreview i{color:var(--ac);font-size:14px}
/* Hero stat bar */
.ffdt .dt-hstats{display:flex;flex-wrap:wrap;background:rgba(18,34,52,.5);border:1px solid color-mix(in srgb,var(--ac) 18%,transparent);border-radius:14px;overflow:hidden;width:fit-content;max-width:100%;margin-bottom:20px}
.ffdt .dt-hstat{padding:12px 22px;border-right:1px solid color-mix(in srgb,var(--ac) 12%,transparent);min-width:120px}
.ffdt .dt-hstat:last-child{border-right:none}
.ffdt .dt-hsv{font-family:'Plus Jakarta Sans',system-ui;font-size:18px;font-weight:800;color:var(--ac);line-height:1.15;display:block}
.ffdt .dt-hsl{font-size:10px;color:#9BBFD8;text-transform:uppercase;letter-spacing:.05em;margin-top:3px;display:block}
/* Hero actions */
.ffdt .dt-acts{display:flex;gap:10px;flex-wrap:wrap}
.ffdt .dt-btn-p{display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,var(--ac),color-mix(in srgb,var(--ac) 72%,#000));color:#04160f;border:none;padding:12px 24px;border-radius:10px;font-family:'Inter',system-ui;font-size:13.5px;font-weight:700;cursor:pointer;box-shadow:0 6px 22px color-mix(in srgb,var(--ac) 38%,transparent);transition:transform .15s;text-decoration:none}
.ffdt .dt-btn-p:hover{transform:translateY(-2px)}
.ffdt .dt-btn-s{display:inline-flex;align-items:center;gap:7px;background:transparent;border:1px solid color-mix(in srgb,var(--ac) 30%,transparent);color:var(--ac);padding:12px 20px;border-radius:10px;font-family:'Inter',system-ui;font-size:13.5px;font-weight:500;cursor:pointer;transition:background .2s;text-decoration:none}
.ffdt .dt-btn-s:hover{background:color-mix(in srgb,var(--ac) 8%,transparent)}
/* Tabs */
.ffdt .dt-tabs{position:sticky;top:66px;z-index:40;background:rgba(6,15,26,.96);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border-bottom:1px solid rgba(74,159,224,.1)}
.ffdt .dt-tabs-in{max-width:1160px;margin:0 auto;padding:0 32px;display:flex;gap:2px;overflow-x:auto}
.ffdt .dt-tab{display:inline-flex;align-items:center;gap:7px;padding:14px 18px;font-size:13px;font-weight:500;color:#9BBFD8;background:none;border:none;border-bottom:2px solid transparent;cursor:pointer;white-space:nowrap;transition:color .2s,border-color .2s;font-family:'Inter',system-ui}
.ffdt .dt-tab:hover{color:#fff}
.ffdt .dt-tab.on{color:var(--ac);border-bottom-color:var(--ac)}
.ffdt .dt-tab-badge{font-size:10px;font-weight:700;padding:1px 7px;border-radius:9px;background:color-mix(in srgb,var(--ac) 14%,transparent);color:var(--ac)}
/* Panels */
.ffdt .dt-body{background:#050D18;padding:34px 0 10px;position:relative;z-index:2}
.ffdt .dt-panel{display:none}
.ffdt .dt-panel.on{display:block}
.ffdt .dt-cols{display:grid;grid-template-columns:1fr 320px;gap:24px;align-items:start}
.ffdt .dt-box{background:rgba(18,34,52,.48);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border:1px solid rgba(74,159,224,.1);border-radius:18px;padding:24px;margin-bottom:20px}
.ffdt .dt-box-h{font-family:'Plus Jakarta Sans',system-ui;font-size:17px;font-weight:700;margin-bottom:14px;display:flex;align-items:center;gap:9px}
.ffdt .dt-box-h i{color:var(--ac);font-size:19px}
.ffdt .dt-prose{font-size:14px;line-height:1.75;color:#9BBFD8}
.ffdt .dt-prose p{margin:0 0 12px}
.ffdt .dt-prose p:last-child{margin-bottom:0}
/* Pills */
.ffdt .dt-pills{display:flex;flex-wrap:wrap;gap:8px}
.ffdt .dt-pill{font-size:12.5px;padding:7px 14px;border-radius:9px;background:color-mix(in srgb,var(--ac) 9%,transparent);border:1px solid color-mix(in srgb,var(--ac) 20%,transparent);color:#cfe6f6}
/* Facts grid */
.ffdt .dt-facts{display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:12px}
.ffdt .dt-fact{background:rgba(10,22,40,.5);border:1px solid rgba(74,159,224,.1);border-radius:12px;padding:14px}
.ffdt .dt-fact-l{display:flex;align-items:center;gap:6px;font-size:10.5px;text-transform:uppercase;letter-spacing:.05em;color:#6B9DB7;margin-bottom:6px}
.ffdt .dt-fact-l i{font-size:13px;color:var(--ac)}
.ffdt .dt-fact-v{font-family:'Plus Jakarta Sans',system-ui;font-size:16px;font-weight:700;color:#fff}
/* Sidebar */
.ffdt .dt-side .dt-box{margin-bottom:16px}
.ffdt .dt-side-cta{position:relative;overflow:hidden;background:linear-gradient(135deg,color-mix(in srgb,var(--ac) 14%,transparent),rgba(74,159,224,.06));border:1px solid color-mix(in srgb,var(--ac) 24%,transparent);border-radius:18px;padding:22px;text-align:center}
.ffdt .dt-side-cta h4{font-family:'Plus Jakarta Sans',system-ui;font-size:16px;font-weight:800;margin-bottom:6px}
.ffdt .dt-side-cta p{font-size:12.5px;color:#9BBFD8;line-height:1.6;margin-bottom:16px}
/* Contact-direct state (products tab) */
.ffdt .dt-contact{text-align:center;padding:34px 24px;border:1px dashed color-mix(in srgb,var(--ac) 26%,transparent);border-radius:16px;background:rgba(10,22,40,.4)}
.ffdt .dt-contact i{font-size:34px;color:var(--ac);margin-bottom:12px;display:block}
.ffdt .dt-contact h4{font-family:'Plus Jakarta Sans',system-ui;font-size:18px;font-weight:800;margin-bottom:8px}
.ffdt .dt-contact p{font-size:13px;color:#9BBFD8;line-height:1.6;max-width:420px;margin:0 auto 18px}
/* Certifications */
.ffdt .dt-cert-cards{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px}
.ffdt .dt-cert-card{display:flex;align-items:center;gap:11px;background:rgba(10,22,40,.5);border:1px solid color-mix(in srgb,var(--ac) 18%,transparent);border-radius:12px;padding:14px}
.ffdt .dt-cert-ic{width:36px;height:36px;border-radius:9px;flex-shrink:0;display:flex;align-items:center;justify-content:center;background:color-mix(in srgb,var(--ac) 14%,transparent);color:var(--ac);font-size:18px}
.ffdt .dt-cert-nm{font-size:13px;font-weight:600;color:#fff}
.ffdt .dt-cert-vf{font-size:10.5px;color:#52DEB5;display:flex;align-items:center;gap:4px;margin-top:2px}
.ffdt .dt-empty{text-align:center;padding:30px 20px;background:rgba(10,22,40,.4);border:1px dashed rgba(74,159,224,.2);border-radius:14px}
.ffdt .dt-empty i{font-size:30px;color:#6B9DB7;margin-bottom:10px;display:block}
.ffdt .dt-empty h4{font-family:'Plus Jakarta Sans',system-ui;font-size:15px;font-weight:700;margin-bottom:6px;color:#cfe2f2}
.ffdt .dt-empty p{font-size:12.5px;color:#6B9DB7;line-height:1.6;max-width:400px;margin:0 auto}
/* Reviews */
.ffdt .dt-rev-agg{display:flex;gap:30px;align-items:center;flex-wrap:wrap;margin-bottom:22px}
.ffdt .dt-rev-score{text-align:center;flex-shrink:0}
.ffdt .dt-rev-big{font-family:'Plus Jakarta Sans',system-ui;font-size:52px;font-weight:800;color:#fff;line-height:1}
.ffdt .dt-rev-of{font-size:12px;color:#6B9DB7;margin-top:4px}
.ffdt .dt-rev-bars{flex:1;min-width:220px}
.ffdt .dt-rev-bar{display:flex;align-items:center;gap:10px;margin-bottom:7px}
.ffdt .dt-rev-bl{font-size:11.5px;color:#9BBFD8;width:38px;display:flex;align-items:center;gap:3px}
.ffdt .dt-rev-track{flex:1;height:8px;border-radius:5px;background:rgba(74,159,224,.12);overflow:hidden}
.ffdt .dt-rev-fill{height:100%;border-radius:5px;background:var(--ac)}
.ffdt .dt-rev-bc{font-size:11.5px;color:#6B9DB7;width:28px;text-align:right}
.ffdt .dt-rev-list{display:flex;flex-direction:column;gap:14px;margin-top:8px}
.ffdt .dt-rev-item{border-top:1px solid rgba(74,159,224,.1);padding-top:14px}
.ffdt .dt-rev-top{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:6px}
.ffdt .dt-rev-au{font-size:13.5px;font-weight:600;color:#fff}
.ffdt .dt-rev-dt{font-size:11px;color:#6B9DB7}
.ffdt .dt-rev-st{color:#F5B301;font-size:13px;margin-bottom:6px;display:inline-flex;gap:1px}
.ffdt .dt-rev-st .ti-star{color:#33506a}
.ffdt .dt-rev-tx{font-size:13px;color:#9BBFD8;line-height:1.65}
/* Similar */
.ffdt .dt-similar{background:#050D18;padding:20px 0 56px;position:relative;z-index:2}
.ffdt .dt-sim-h{font-family:'Plus Jakarta Sans',system-ui;font-size:20px;font-weight:800;margin-bottom:16px}
.ffdt .dt-sim-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px}
.ffdt .dt-sim-card{background:rgba(18,34,52,.48);border:1px solid rgba(74,159,224,.1);border-radius:16px;padding:18px;transition:transform .25s,border-color .25s}
.ffdt .dt-sim-card:hover{transform:translateY(-4px);border-color:color-mix(in srgb,var(--ac) 26%,transparent)}
.ffdt .dt-sim-top{display:flex;gap:11px;align-items:center;margin-bottom:12px}
.ffdt .dt-sim-logo{width:42px;height:42px;border-radius:11px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-family:'Plus Jakarta Sans',system-ui;font-size:13px;font-weight:700;color:var(--ac);background:color-mix(in srgb,var(--ac) 12%,transparent);border:1px solid color-mix(in srgb,var(--ac) 25%,transparent);overflow:hidden}
.ffdt .dt-sim-logo img{width:100%;height:100%;object-fit:cover}
.ffdt .dt-sim-nm{font-size:13.5px;font-weight:600;color:#fff}
.ffdt .dt-sim-nm a{color:inherit;text-decoration:none}
.ffdt .dt-sim-lo{font-size:11px;color:#9BBFD8;display:flex;align-items:center;gap:4px;margin-top:2px}
.ffdt .dt-sim-lo i{font-size:10px}
.ffdt .dt-sim-foot{display:flex;align-items:center;justify-content:space-between;border-top:1px solid rgba(74,159,224,.08);padding-top:12px;margin-top:4px}
.ffdt .dt-sim-link{font-size:11.5px;color:var(--ac);text-decoration:none;display:inline-flex;align-items:center;gap:4px}
/* Light mode */
body.light-mode .ffdt .dt-hero{background:linear-gradient(135deg,#EEF6FF,#F3FAFF,#EEF6FF)}
body.light-mode .ffdt .dt-h1,body.light-mode .ffdt .dt-box-h,body.light-mode .ffdt .dt-fact-v,body.light-mode .ffdt .dt-rev-big,body.light-mode .ffdt .dt-rev-au,body.light-mode .ffdt .dt-sim-nm,body.light-mode .ffdt .dt-sim-h,body.light-mode .ffdt .dt-cert-nm,body.light-mode .ffdt .dt-rnum{color:#050D18}
body.light-mode .ffdt .dt-meta,body.light-mode .ffdt .dt-prose,body.light-mode .ffdt .dt-rev-tx{color:#3A5E75}
body.light-mode .ffdt .dt-body,body.light-mode .ffdt .dt-similar{background:#EEF6FF}
body.light-mode .ffdt .dt-box,body.light-mode .ffdt .dt-sim-card{background:rgba(255,255,255,.7);border-color:rgba(74,159,224,.2)}
body.light-mode .ffdt .dt-fact,body.light-mode .ffdt .dt-cert-card,body.light-mode .ffdt .dt-contact,body.light-mode .ffdt .dt-empty{background:rgba(255,255,255,.6)}
body.light-mode .ffdt .dt-tabs{background:rgba(238,246,255,.96)}
body.light-mode .ffdt .dt-tab{color:#3A5E75}
body.light-mode .ffdt .dt-pill{color:#1E6BAB}
body.light-mode .ffdt .dt-hstats{background:rgba(255,255,255,.72)}
/* ============================================================
   SUPPLIER-BRANCH LITERAL PARITY with supplier-profile.html.
   Scoped to .ffdt-sup so the Service branch (.ffdt only, out of
   scope for this pass) renders byte-for-byte unchanged. Accent-
   tinted values stay on --ac/color-mix so every supplier category
   (poultry blue, veg green, beef amber, seafood teal) keeps its
   own colour; only structural values + fixed, non-accent colours
   (hero base gradient, star-amber review bars) are pinned to the
   reference. Placed BEFORE the media queries so the mobile
   overrides below still win at ≤768px.
   ============================================================ */
/* Content width + gutter (ref .sp-inner/.sp-panel-inner max 1200, 48px pad) */
.ffdt-sup .dt-wrap,.ffdt-sup .dt-tabs-in{max-width:1200px;padding-left:48px;padding-right:48px}
/* Top clearance: the live global header (Breakdance "FFInc Header" #1603)
   is position:sticky + overlay (floats over content, z-index 100) and is
   ~109px tall (container 3+25 pad, inner pill 15+15 pad, 50px logo row,
   1px border). 109 + 11px comfortable buffer = 120px. */
.ffdt-sup .dt-hero{background:linear-gradient(180deg,#050D18,#061428);border-bottom:none;padding:120px 0 36px}
.ffdt-sup .dt-bc{padding-top:0}
/* Hero grid + logo (ref .sp-inner gap 28; .sp-logo 88/r20/2px/26px/shadow) */
.ffdt-sup .dt-hgrid{gap:28px}
.ffdt-sup .dt-logo{width:88px;height:88px;border-radius:20px;font-size:26px;border-width:2px;border-color:color-mix(in srgb,var(--ac) 30%,transparent);background:color-mix(in srgb,var(--ac) 12%,transparent);box-shadow:0 0 40px color-mix(in srgb,var(--ac) 15%,transparent)}
.ffdt-sup .dt-catbdg{background:color-mix(in srgb,var(--ac) 10%,transparent);border-color:color-mix(in srgb,var(--ac) 25%,transparent)}
.ffdt-sup .dt-h1{font-size:28px;letter-spacing:-.7px;line-height:1.1;margin:2px 0 8px}
/* Hero stat bar (ref .ch-stats border .18; .chs pad 12px 20px; .chs-n 20px) */
.ffdt-sup .dt-hstats{border-color:color-mix(in srgb,var(--ac) 18%,transparent)}
.ffdt-sup .dt-hstat{padding:12px 20px}
.ffdt-sup .dt-hsv{font-size:20px}
/* Hero actions (ref .ch-btn-p white text; .ch-btn-s pad 12px 22px, border .28) */
.ffdt-sup .dt-btn-p{color:#fff}
.ffdt-sup .dt-btn-s{padding:12px 22px;border-color:color-mix(in srgb,var(--ac) 28%,transparent)}
/* Tabs — full parity with reference .tab-nav / .sp-tab / .sp-tab-count.
   Sticks just below the live header (top:108px). Tabs are butted together
   (no gap), 14px 20px pad, 14px icon; non-active hover gets the accent
   underline; the review count badge mirrors .sp-tab-count exactly. */
.ffdt-sup .dt-tabs{top:108px}
.ffdt-sup .dt-tabs-in{gap:0}
.ffdt-sup .dt-tab{padding:14px 20px}
.ffdt-sup .dt-tab i{font-size:14px}
.ffdt-sup .dt-tab:hover:not(.on){color:#fff;border-bottom-color:color-mix(in srgb,var(--ac) 30%,transparent)}
.ffdt-sup .dt-tab.on{font-weight:600}
.ffdt-sup .dt-tab-badge{font-weight:500;padding:1px 6px;border-radius:8px;background:color-mix(in srgb,var(--ac) 12%,transparent);border:1px solid color-mix(in srgb,var(--ac) 25%,transparent);margin-left:4px}
/* Panels + cards (ref .sp-panel pad-top 32; .ov-box r16/22 + ::before accent line) */
.ffdt-sup .dt-body{padding-top:32px}
.ffdt-sup .dt-box{border-radius:16px;padding:22px;position:relative;overflow:hidden}
.ffdt-sup .dt-box::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,color-mix(in srgb,var(--ac) 40%,transparent),transparent)}
.ffdt-sup .dt-box-h{font-size:15px}
.ffdt-sup .dt-box-h i{font-size:17px}
/* Facts (ref .ov-facts 3-col gap 8; .ov-fact r9/10px 12px; .ov-fv 15px) */
.ffdt-sup .dt-facts{grid-template-columns:1fr 1fr 1fr;gap:8px}
.ffdt-sup .dt-fact{border-radius:9px;padding:10px 12px}
.ffdt-sup .dt-fact-v{font-size:15px}
/* Reviews (ref .rev-big 48px; star-amber bars + labels, track 5px/r3) */
.ffdt-sup .dt-rev-big{font-size:48px}
.ffdt-sup .dt-rev-bl{color:#F59E0B}
.ffdt-sup .dt-rev-track{height:5px;border-radius:3px}
.ffdt-sup .dt-rev-fill{border-radius:3px;background:linear-gradient(90deg,#F59E0B,#FCD34D)}
/* Similar (ref .sim gradient bg + border-top; .sim-h 18px) */
.ffdt-sup .dt-similar{background:linear-gradient(180deg,#050D18,#060F1A);border-top:1px solid rgba(74,159,224,.08);padding:28px 0 48px}
.ffdt-sup .dt-sim-h{font-size:18px}
/* Responsive */
@media (max-width:900px){
.ffdt .dt-cols{grid-template-columns:1fr}
.ffdt .dt-sim-grid{grid-template-columns:1fr}
}
@media (max-width:768px){
.ffdt .dt-wrap,.ffdt .dt-tabs-in{padding-left:20px;padding-right:20px}
.ffdt .dt-hgrid{flex-direction:column;gap:16px}
.ffdt .dt-logo{width:84px;height:84px;font-size:28px}
.ffdt .dt-h1{font-size:26px}
.ffdt .dt-hstat{flex:1 1 45%}
}
</style>

<div class="ffdt <?php echo $is_service ? 'ffdt-svc' : 'ffdt-sup'; ?>">

<!-- Page background layers (animated by main.js) -->
<div class="pg-grid"></div>
<div class="pg-aura" id="pa1" style="width:600px;height:600px;background:radial-gradient(circle,color-mix(in srgb,var(--ac) 18%,transparent),transparent 65%);top:-220px;left:-180px"></div>
<div class="pg-aura" id="pa2" style="width:520px;height:520px;background:radial-gradient(circle,rgba(74,159,224,.1),transparent 65%);top:-100px;right:-160px"></div>
<canvas id="pg-canvas" aria-hidden="true"></canvas>

<!-- Hero -->
<section class="dt-hero" aria-label="Listing header">
<div class="dt-hero-aura" style="width:380px;height:380px;background:radial-gradient(circle,color-mix(in srgb,var(--ac) 16%,transparent),transparent 70%);top:-120px;right:-60px"></div>
<div class="dt-wrap">
<nav class="dt-bc" aria-label="Breadcrumb">
<a href="<?php echo esc_url($db_link); ?>">Database</a><i class="ti ti-chevron-right" aria-hidden="true"></i>
<a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a><i class="ti ti-chevron-right" aria-hidden="true"></i>
<span class="cur"><?php echo esc_html($name); ?></span>
</nav>
<div class="dt-hgrid">
<div class="dt-logo">
<?php if ($logo_url) { echo '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr($name) . '">'; } else { echo esc_html($initials); } ?>
</div>
<div class="dt-hmain">
<div class="dt-hbadges">
<span class="dt-catbdg"><i class="<?php echo esc_attr($cat_icon); ?>" aria-hidden="true"></i><?php echo esc_html($cat_name); ?></span>
<?php if ($featured) { ?><span class="bdg bdg-f"><i class="ti ti-star" style="font-size:9px" aria-hidden="true"></i>Featured</span><?php } ?>
<?php if ($verified) { ?><span class="bdg bdg-v"><i class="ti ti-circle-check" style="font-size:9px" aria-hidden="true"></i>Verified</span><?php } ?>
</div>
<h1 class="dt-h1"><?php echo esc_html($name); ?></h1>
<div class="dt-meta">
<?php if ($loc) { ?><span><i class="ti ti-map-pin" aria-hidden="true"></i><?php echo esc_html($loc); ?></span><?php } ?>
<?php if ($est) { ?><span><i class="ti ti-calendar" aria-hidden="true"></i>Est. <?php echo esc_html($est); ?></span><?php } ?>
<?php if (!$is_service && $employees) { ?><span><i class="ti ti-users" aria-hidden="true"></i><?php echo esc_html($employees); ?> employees</span><?php } ?>
<?php if ($website) { ?><span><i class="ti ti-world" aria-hidden="true"></i><a href="<?php echo esc_url($website); ?>" target="_blank" rel="noopener">Website</a></span><?php } ?>
</div>
<div class="dt-rating">
<?php if ($has_reviews) { ?>
<span class="dt-stars"><?php echo ffinc2_dt_stars($avg); ?></span>
<span class="dt-rnum"><?php echo esc_html(number_format($avg, 1)); ?></span>
<span class="dt-rcount">(<?php echo esc_html($rcount); ?> review<?php echo ($rcount == 1 ? '' : 's'); ?>)</span>
<?php } else { ?>
<span class="dt-noreview"><i class="ti ti-star" aria-hidden="true"></i>No reviews yet</span>
<?php } ?>
</div>
<div class="dt-hstats">
<?php foreach ($hero_stats as $st) { ?>
<div class="dt-hstat"><span class="dt-hsv"><?php echo esc_html($st[1] !== '' && $st[1] !== null ? $st[1] : '—'); ?></span><span class="dt-hsl"><?php echo esc_html($st[0]); ?></span></div>
<?php } ?>
</div>
<div class="dt-acts">
<button class="dt-btn-p" <?php echo $qattr_self; ?>><i class="ti ti-mail" aria-hidden="true"></i>Request a Quote</button>
<a class="dt-btn-s" href="#"><i class="ti ti-bookmark" aria-hidden="true"></i>Save <?php echo esc_html($noun); ?></a>
<a class="dt-btn-s" href="#"><i class="ti ti-share" aria-hidden="true"></i>Share</a>
</div>
</div>
</div>
</div>
</section>

<!-- Tab navigation -->
<div class="dt-tabs">
<div class="dt-tabs-in" role="tablist">
<button class="dt-tab on" data-tab="overview" role="tab"><i class="ti ti-layout-list" aria-hidden="true"></i>Overview</button>
<button class="dt-tab" data-tab="range" role="tab"><i class="ti ti-package" aria-hidden="true"></i><?php echo esc_html($tab_label); ?></button>
<button class="dt-tab" data-tab="certs" role="tab"><i class="<?php echo $is_service ? 'ti ti-certificate' : 'ti ti-shield-check'; ?>" aria-hidden="true"></i>Certifications</button>
<button class="dt-tab" data-tab="reviews" role="tab"><i class="ti ti-star" aria-hidden="true"></i>Reviews<?php if ($rcount > 0) { ?><span class="dt-tab-badge"><?php echo esc_html($rcount); ?></span><?php } ?></button>
</div>
</div>

<div class="dt-body">
<div class="dt-wrap">

<!-- Overview -->
<div class="dt-panel on" id="tab-overview" role="tabpanel">
<div class="dt-cols">
<div class="dt-main">
<div class="dt-box">
<div class="dt-box-h"><i class="ti ti-info-circle" aria-hidden="true"></i>About <?php echo esc_html($name); ?></div>
<div class="dt-prose"><?php echo $about ? wp_kses_post($about) : '<p>No description provided yet.</p>'; ?></div>
</div>
<?php if ($markets) { ?>
<div class="dt-box">
<div class="dt-box-h"><i class="ti ti-world" aria-hidden="true"></i><?php echo esc_html($markets_label); ?></div>
<div class="dt-pills"><?php foreach ($markets as $m) { echo '<span class="dt-pill">' . esc_html($m) . '</span>'; } ?></div>
</div>
<?php } ?>
<?php
$facts_out = array();
foreach ($facts as $f) { if ($f[2] !== '' && $f[2] !== null && $f[2] !== '0') $facts_out[] = $f; }
if ($facts_out) { ?>
<div class="dt-box">
<div class="dt-box-h"><i class="ti ti-building-warehouse" aria-hidden="true"></i>Company Facts</div>
<div class="dt-facts">
<?php foreach ($facts_out as $f) { ?>
<div class="dt-fact"><div class="dt-fact-l"><i class="<?php echo esc_attr($f[0]); ?>" aria-hidden="true"></i><?php echo esc_html($f[1]); ?></div><div class="dt-fact-v"><?php echo esc_html($f[2]); ?></div></div>
<?php } ?>
</div>
</div>
<?php } ?>
</div>
<aside class="dt-side">
<div class="dt-side-cta">
<h4>Interested in <?php echo esc_html($name); ?>?</h4>
<p>Send a quote request directly — zero commission, the <?php echo esc_html($noun_lc); ?> replies to your email.</p>
<button class="dt-btn-p" style="width:100%;justify-content:center" <?php echo $qattr_self; ?>><i class="ti ti-mail" aria-hidden="true"></i>Request a Quote</button>
</div>
</aside>
</div>
</div>

<!-- Products / Services -->
<div class="dt-panel" id="tab-range" role="tabpanel">
<?php if ($range) { ?>
<div class="dt-box">
<div class="dt-box-h"><i class="ti ti-package" aria-hidden="true"></i><?php echo esc_html($range_label); ?></div>
<div class="dt-pills"><?php foreach ($range as $r) { echo '<span class="dt-pill">' . esc_html($r) . '</span>'; } ?></div>
</div>
<?php } ?>
<div class="dt-contact">
<i class="ti ti-message-2" aria-hidden="true"></i>
<h4>Full <?php echo esc_html($is_service ? 'service' : 'product'); ?> catalog on request</h4>
<p>Contact <?php echo esc_html($name); ?> directly for full <?php echo esc_html($is_service ? 'service' : 'product'); ?> specifications, pack sizes, pricing and availability.</p>
<button class="dt-btn-p" <?php echo $qattr_self; ?>><i class="ti ti-mail" aria-hidden="true"></i>Request a Quote</button>
</div>
</div>

<!-- Certifications -->
<div class="dt-panel" id="tab-certs" role="tabpanel">
<div class="dt-box">
<div class="dt-box-h"><i class="ti ti-list-check" aria-hidden="true"></i>Declared Certifications</div>
<?php if ($certs) { ?>
<div class="dt-pills"><?php foreach ($certs as $c) { echo '<span class="dt-pill">' . esc_html($c) . '</span>'; } ?></div>
<?php } else { ?>
<p class="dt-prose">No certifications declared yet.</p>
<?php } ?>
</div>
<div class="dt-box">
<div class="dt-box-h"><i class="ti ti-rosette-discount-check" aria-hidden="true"></i>Verified Documentation</div>
<?php if ($verified && $certs) { ?>
<div class="dt-cert-cards">
<?php foreach ($certs as $c) { ?>
<div class="dt-cert-card"><div class="dt-cert-ic"><i class="ti ti-certificate" aria-hidden="true"></i></div><div><div class="dt-cert-nm"><?php echo esc_html($c); ?></div><div class="dt-cert-vf"><i class="ti ti-circle-check" style="font-size:11px" aria-hidden="true"></i>Verified by FFInc</div></div></div>
<?php } ?>
</div>
<?php } else { ?>
<div class="dt-empty">
<i class="ti ti-file-upload" aria-hidden="true"></i>
<h4>Documentation Not Yet Uploaded</h4>
<p>This <?php echo esc_html($noun_lc); ?> has not yet uploaded verified certification documents. Declared certifications above are self-reported. Request documentation directly via a quote request.</p>
</div>
<?php } ?>
</div>
</div>

<!-- Reviews -->
<div class="dt-panel" id="tab-reviews" role="tabpanel">
<div class="dt-box">
<div class="dt-box-h"><i class="ti ti-star" aria-hidden="true"></i>Reviews</div>
<?php if ($has_reviews && $review_total > 0) { ?>
<div class="dt-rev-agg">
<div class="dt-rev-score">
<div class="dt-rev-big"><?php echo esc_html(number_format($avg, 1)); ?></div>
<span class="dt-stars"><?php echo ffinc2_dt_stars($avg); ?></span>
<div class="dt-rev-of"><?php echo esc_html($rcount); ?> review<?php echo ($rcount == 1 ? '' : 's'); ?></div>
</div>
<div class="dt-rev-bars">
<?php for ($s = 5; $s >= 1; $s--) { $n = $breakdown[$s]; $pct = $review_total ? round($n / $review_total * 100) : 0; ?>
<div class="dt-rev-bar">
<span class="dt-rev-bl"><?php echo $s; ?><i class="ti ti-star-filled" style="font-size:10px;color:#F5B301" aria-hidden="true"></i></span>
<span class="dt-rev-track"><span class="dt-rev-fill" style="width:<?php echo (int) $pct; ?>%"></span></span>
<span class="dt-rev-bc"><?php echo (int) $n; ?></span>
</div>
<?php } ?>
</div>
</div>
<?php if ($reviews) { ?>
<div class="dt-rev-list">
<?php foreach ($reviews as $rv) {
    $rdate = $rv->comment_date ? date_i18n(get_option('date_format'), strtotime($rv->comment_date)) : '';
    ?>
<div class="dt-rev-item">
<div class="dt-rev-top"><span class="dt-rev-au"><?php echo esc_html($rv->comment_author ?: 'Verified buyer'); ?></span><span class="dt-rev-dt"><?php echo esc_html($rdate); ?></span></div>
<span class="dt-rev-st"><?php echo ffinc2_dt_stars($rv->rating); ?></span>
<div class="dt-rev-tx"><?php echo wp_kses_post(wpautop($rv->comment_content)); ?></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php } else { ?>
<div class="dt-empty">
<i class="ti ti-message-star" aria-hidden="true"></i>
<h4>No reviews yet</h4>
<p>Be the first to work with this <?php echo esc_html($noun_lc); ?> and leave a review to help other buyers source with confidence.</p>
</div>
<?php } ?>
</div>
</div>

</div><!-- /.dt-wrap -->
</div><!-- /.dt-body -->

<?php if ($sim_q->have_posts()) { ?>
<!-- Similar listings -->
<section class="dt-similar" aria-label="Similar <?php echo esc_attr($noun); ?>s">
<div class="dt-wrap">
<h2 class="dt-sim-h">Similar <?php echo esc_html($noun); ?>s</h2>
<div class="dt-sim-grid">
<?php while ($sim_q->have_posts()) { $sim_q->the_post();
    $spid = get_the_ID(); $sname = get_the_title(); $sini = ffinc2_gd_initials($sname);
    $scity = ffinc2_gd_meta($spid, 'city'); $sctry = ffinc2_gd_meta($spid, 'country');
    $sloc = trim($scity . (($scity && $sctry) ? ', ' : '') . $sctry); if ($sloc === '') $sloc = $sctry ?: $scity;
    $slogo = '';
    if (function_exists('geodir_get_images')) { $simgs = geodir_get_images($spid, 1); if (!empty($simgs)) { $sim = is_array($simgs) ? reset($simgs) : $simgs; if (is_object($sim) && !empty($sim->src)) $slogo = $sim->src; } }
    $sqattr = 'data-supplier-id="' . esc_attr($spid) . '" data-supplier-name="' . esc_attr($sname) . '" data-supplier-logo="' . esc_attr($sini) . '" data-supplier-location="' . esc_attr($sloc) . '"';
    ?>
<div class="dt-sim-card">
<div class="dt-sim-top">
<div class="dt-sim-logo"><?php echo $slogo ? '<img src="' . esc_url($slogo) . '" alt="' . esc_attr($sname) . '">' : esc_html($sini); ?></div>
<div><div class="dt-sim-nm"><a href="<?php the_permalink(); ?>"><?php echo esc_html($sname); ?></a></div>
<?php if ($sloc) { ?><div class="dt-sim-lo"><i class="ti ti-map-pin" aria-hidden="true"></i><?php echo esc_html($sloc); ?></div><?php } ?></div>
</div>
<div class="dt-sim-foot">
<a class="dt-sim-link" href="<?php the_permalink(); ?>">View profile <i class="ti ti-arrow-right" style="font-size:12px" aria-hidden="true"></i></a>
<button class="rq-btn" <?php echo $sqattr; ?>>Request Quote</button>
</div>
</div>
<?php } wp_reset_postdata(); ?>
</div>
</div>
</section>
<?php } ?>

<!-- Quote request modal (styled by design-system.css) — pre-filled with this listing -->
<div class="qm-ov" id="qm-ov" aria-hidden="true">
<div class="qm" id="qm-card" role="dialog" aria-modal="true" aria-label="Request a quote">
<button class="qm-x" id="qm-x" aria-label="Close"><i class="ti ti-x" aria-hidden="true"></i></button>
<div class="qm-sup">
<div class="qm-logo" id="qm-logo"><?php echo esc_html($initials); ?></div>
<div><div class="qm-sn" id="qm-sn"><?php echo esc_html($name); ?></div><div class="qm-sl"><i class="ti ti-map-pin" aria-hidden="true"></i><span id="qm-sl"><?php echo esc_html($loc); ?></span></div></div>
</div>
<div class="qm-h">Request a Quote</div>
<div class="qm-sub">Complete the form below — the <?php echo esc_html($noun_lc); ?> will respond directly to your email. FFInc charges zero commission.</div>
<form id="qm-form" onsubmit="return false">
<div class="qm-grid">
<div class="qm-f"><label class="qm-lb">Your Name</label><input class="qm-in" type="text" placeholder="Jane Doe"></div>
<div class="qm-f"><label class="qm-lb">Company Name</label><input class="qm-in" type="text" placeholder="Acme Foods Ltd"></div>
<div class="qm-f"><label class="qm-lb">Email Address</label><input class="qm-in" type="email" placeholder="you@company.com"></div>
<div class="qm-f"><label class="qm-lb">Country</label><input class="qm-in" type="text" placeholder="United Kingdom"></div>
<div class="qm-f full"><label class="qm-lb">Requirements</label><textarea class="qm-ta" rows="4" placeholder="Product/service required, quantity, certifications, delivery terms, timeline..."></textarea></div>
</div>
<button class="qm-sub-btn" type="submit"><i class="ti ti-send" aria-hidden="true"></i>Send Quote Request</button>
<div class="qm-priv">Your details are sent directly to the <?php echo esc_html($noun_lc); ?>. FrozenFoodInc does not store quote request data or charge any commission.</div>
</form>
</div>
</div>

</div><!-- /.ffdt -->

<?php get_footer(); ?>

<!-- ============================================================
     GD Details page-specific JS. Shared behaviour (canvas, aurora,
     footer dot, dark/light toggle) is in main.js. Handles tab
     switching + the quote modal (reads data-supplier-* from the
     clicked trigger, same contract as the archive templates).
     ============================================================ -->
<script>
(function(){
  /* Tab switching */
  var tabs=document.querySelectorAll('.ffdt .dt-tab');
  var panels=document.querySelectorAll('.ffdt .dt-panel');
  tabs.forEach(function(t){
    t.addEventListener('click',function(){
      var id=t.getAttribute('data-tab');
      tabs.forEach(function(x){x.classList.remove('on');});
      panels.forEach(function(p){p.classList.remove('on');});
      t.classList.add('on');
      var panel=document.getElementById('tab-'+id);
      if(panel)panel.classList.add('on');
    });
  });
  /* Quote modal */
  var ov=document.getElementById('qm-ov'),card=document.getElementById('qm-card');
  function openModal(name,logo,loc){
    var sn=document.getElementById('qm-sn'),lg=document.getElementById('qm-logo'),sl=document.getElementById('qm-sl');
    if(name&&sn)sn.textContent=name;
    if(logo&&lg)lg.textContent=logo;
    if(loc!=null&&sl)sl.textContent=loc;
    if(!ov)return;
    ov.classList.add('open');ov.setAttribute('aria-hidden','false');
    if(window.gsap){gsap.fromTo(ov,{opacity:0},{opacity:1,duration:.25,ease:'power2.out'});gsap.fromTo(card,{scale:.94,opacity:0},{scale:1,opacity:1,duration:.35,ease:'back.out(1.4)'});}
  }
  function closeModal(){
    if(!ov)return;
    if(window.gsap){gsap.to(card,{scale:.94,opacity:0,duration:.2,ease:'power2.in'});gsap.to(ov,{opacity:0,duration:.25,delay:.05,ease:'power2.in',onComplete:function(){ov.classList.remove('open');ov.setAttribute('aria-hidden','true');}});}
    else{ov.classList.remove('open');ov.setAttribute('aria-hidden','true');}
  }
  document.addEventListener('click',function(e){
    var t=e.target.closest?e.target.closest('[data-supplier-name]'):null;
    if(t){openModal(t.getAttribute('data-supplier-name'),t.getAttribute('data-supplier-logo'),t.getAttribute('data-supplier-location'));}
  });
  var x=document.getElementById('qm-x'); if(x)x.addEventListener('click',closeModal);
  if(ov)ov.addEventListener('click',function(e){if(e.target===ov)closeModal();});
  document.addEventListener('keydown',function(e){if(e.key==='Escape'&&ov&&ov.classList.contains('open'))closeModal();});
  /* Hero entrance */
  if(window.gsap){
    gsap.timeline({defaults:{ease:'power3.out'}})
      .fromTo('.ffdt .dt-h1',{y:26,opacity:0},{y:0,opacity:1,duration:.6})
      .fromTo('.ffdt .dt-meta',{y:18,opacity:0},{y:0,opacity:1,duration:.5},'-=.35')
      .fromTo('.ffdt .dt-hstats',{y:18,opacity:0},{y:0,opacity:1,duration:.5},'-=.35')
      .fromTo('.ffdt .dt-acts',{y:16,opacity:0},{y:0,opacity:1,duration:.45},'-=.3');
  }
})();
</script>
