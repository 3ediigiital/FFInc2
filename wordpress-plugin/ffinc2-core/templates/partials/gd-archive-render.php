<?php
/**
 * Shared renderer for the FFInc 2.0 GeoDirectory archive templates.
 *
 * The including template must define, before requiring this file:
 *   $FFINC2_CPT     — CPT slug (e.g. 'gd_supplier')
 *   $FFINC2_TAX     — category taxonomy (e.g. 'gd_suppliercategory')
 *   $FFINC2_DEFAULT — fallback category slug when none is queried
 *   $FFINC2_KIND    — 'supplier' | 'service' (controls card field mapping)
 *   $FFINC2_CATS    — [ slug => [accent, icon, pfield, h1, sub, crumb, mi] ]
 *
 * Shared chrome (base, nav, sub-nav, badges, filter bar, grid card, list
 * row, load-more, footer, quote modal) + main.js behaviour are enqueued
 * site-wide by the plugin; only page-specific / accent / dynamic bits live
 * here. get_header() has already run in the parent template.
 */
if (!defined('ABSPATH')) exit;

/* ---- Helpers (guarded so both templates can require this file) ---- */
if (!function_exists('ffinc2_gd_meta')) {
    // Read a GeoDirectory custom field (detail table) with a postmeta fallback.
    function ffinc2_gd_meta($post_id, $key) {
        if (function_exists('geodir_get_post_meta')) {
            $v = geodir_get_post_meta($post_id, $key, true);
            if ($v !== '' && $v !== null && $v !== false) return $v;
        }
        return get_post_meta($post_id, $key, true);
    }
}
if (!function_exists('ffinc2_gd_multi')) {
    // Split a GD multiselect / comma value into a clean array.
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
if (!function_exists('ffinc2_gd_field_options')) {
    // Pull a custom field's option list straight from GeoDirectory's schema.
    function ffinc2_gd_field_options($cpt, $htmlvar) {
        if (!$htmlvar) return array();
        global $wpdb;
        $t = $wpdb->prefix . 'geodir_custom_fields';
        $raw = $wpdb->get_var($wpdb->prepare(
            "SELECT option_values FROM {$t} WHERE post_type=%s AND htmlvar_name=%s LIMIT 1",
            $cpt, $htmlvar
        ));
        return $raw ? ffinc2_gd_multi($raw) : array();
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
if (!function_exists('ffinc2_gd_initials')) {
    function ffinc2_gd_initials($name) {
        $name = trim(wp_strip_all_tags($name));
        if ($name === '') return '—';
        $words = preg_split('/\s+/', $name);
        if (count($words) >= 2) return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        return strtoupper(substr($name, 0, 2));
    }
}

/* ---- Resolve current category + dynamic data ---- */
$__term = get_queried_object();
$slug = ($__term && isset($__term->slug) && isset($FFINC2_CATS[$__term->slug]))
    ? $__term->slug : $FFINC2_DEFAULT;
$cfg      = $FFINC2_CATS[$slug];
$accent   = $cfg['accent'];
$term     = get_term_by('slug', $slug, $FFINC2_TAX);
$term_id  = $term ? (int) $term->term_id : 0;
$noun     = ($FFINC2_KIND === 'service') ? 'Service Providers' : 'Suppliers';
$noun_lc  = ($FFINC2_KIND === 'service') ? 'service providers' : 'suppliers';

/* Real count for this category (dynamic, not hardcoded). */
$__cq = new WP_Query(array(
    'post_type'      => $FFINC2_CPT,
    'post_status'    => 'publish',
    'posts_per_page' => 1,
    'fields'         => 'ids',
    'tax_query'      => array(array('taxonomy' => $FFINC2_TAX, 'field' => 'slug', 'terms' => $slug)),
));
$real_count    = (int) $__cq->found_posts;
$count_display = ($real_count < 10) ? 'Launching — be first listed' : ($real_count . '+');
wp_reset_postdata();

/* Live SEO descriptions from GD category term meta. */
$top_desc    = $term_id ? get_term_meta($term_id, 'ct_cat_top_desc', true) : '';
$bottom_desc = $term_id ? get_term_meta($term_id, 'ct_cat_bottom_desc', true) : '';

/* Filter "Product/Service Type" options from the correct conditional field. */
$type_field   = ($FFINC2_KIND === 'service') ? 'service_type' : (isset($cfg['pfield']) ? $cfg['pfield'] : '');
$type_options = ffinc2_gd_field_options($FFINC2_CPT, $type_field);
$type_label   = ($FFINC2_KIND === 'service') ? 'Service Type' : 'Product Type';

$add_url = ffinc2_gd_add_url($FFINC2_CPT);

/* Cross-category sub-nav tabs (always the full set; active = current). */
$__subnav = array(
    array('slug' => 'frozen-fruits-vegetables', 'tax' => 'gd_suppliercategory', 'icon' => 'ti ti-leaf',    'label' => 'Fruits &amp; Veg'),
    array('slug' => 'frozen-poultry',           'tax' => 'gd_suppliercategory', 'icon' => 'ti ti-feather', 'label' => 'Poultry'),
    array('slug' => 'frozen-beef-meat',         'tax' => 'gd_suppliercategory', 'icon' => 'ti ti-flame',   'label' => 'Beef &amp; Meat'),
    array('slug' => 'frozen-seafood',           'tax' => 'gd_suppliercategory', 'icon' => 'ti ti-fish',    'label' => 'Seafood'),
    array('slug' => 'cold-chain-services',      'tax' => 'gd_servicescategory', 'icon' => 'ti ti-truck',   'label' => 'Services'),
);
?>

<!-- ============================================================
     FFInc 2.0 GD Archive — page-specific styles only.
     Shared chrome + light-mode + responsive live in design-system.css.
     Accent is driven by --ac (set on .ffgd) so one file serves every
     category. Market-intel markup below is embedded per-category with
     its own baked accent.
     ============================================================ -->
<style>
.ffgd{--ac:<?php echo esc_html($accent); ?>;position:relative;z-index:2}
/* Accent overrides (design-system uses the universal blue base) */
.ffgd .csn-item.on{color:var(--ac);border-bottom-color:var(--ac)}
.ffgd .fb-s:focus-within{border-color:color-mix(in srgb,var(--ac) 45%,transparent)}
.ffgd .fb-cnt b{color:var(--ac)}
.ffgd .lc::before{background:linear-gradient(90deg,transparent,color-mix(in srgb,var(--ac) 50%,transparent),transparent)}
.ffgd .lc:hover{border-color:color-mix(in srgb,var(--ac) 28%,transparent);box-shadow:0 18px 52px rgba(0,0,0,.45),0 0 36px -16px var(--ac)}
.ffgd .lc-logo{background:color-mix(in srgb,var(--ac) 12%,transparent);border-color:color-mix(in srgb,var(--ac) 25%,transparent);color:var(--ac)}
.ffgd .lrow:hover{border-color:color-mix(in srgb,var(--ac) 28%,transparent);transform:translateX(3px);box-shadow:0 12px 34px rgba(0,0,0,.4)}
.ffgd .rq-btn{background:linear-gradient(135deg,var(--ac),color-mix(in srgb,var(--ac) 72%,#000));color:#04160f}
.ffgd .lm-cnt b{color:var(--ac)}
/* Category hero */
.ffgd .chero{position:relative;overflow:hidden;background:linear-gradient(135deg,#050D18 0%,#08131f 50%,#050D18 100%);padding:52px 48px 44px}
.ffgd .chero-aura{position:absolute;border-radius:50%;filter:blur(70px);pointer-events:none;z-index:0}
.ffgd .chero-inner{position:relative;z-index:2;max-width:1200px;margin:0 auto}
.ffgd .ch-bc{display:flex;align-items:center;gap:6px;font-size:11px;color:#6B9DB7;margin-bottom:16px}
.ffgd .ch-bc a{color:#6B9DB7;text-decoration:none}
.ffgd .ch-bc i{font-size:10px}
.ffgd .ch-bc .cur{color:var(--ac);font-weight:500}
.ffgd .ch1{font-family:'Plus Jakarta Sans',system-ui;font-size:48px;font-weight:800;letter-spacing:-1.2px;line-height:1.1;margin-bottom:16px}
.ffgd .ch1 em{color:var(--ac);font-style:normal}
.ffgd .ch-sub{font-size:17px;color:#9BBFD8;line-height:1.65;max-width:560px;margin-bottom:24px}
.ffgd .ch-stats{display:inline-flex;background:rgba(18,34,52,.5);border:1px solid color-mix(in srgb,var(--ac) 18%,transparent);border-radius:14px;overflow:hidden;width:fit-content;margin-bottom:24px;flex-wrap:wrap}
.ffgd .chs{padding:12px 20px;border-right:1px solid color-mix(in srgb,var(--ac) 12%,transparent);text-align:left}
.ffgd .chs:last-child{border-right:none}
.ffgd .chs-n{font-family:'Plus Jakarta Sans',system-ui;font-size:20px;font-weight:800;color:var(--ac);line-height:1.1;display:block}
.ffgd .chs-n.launching{font-size:14px}
.ffgd .chs-l{font-size:10px;color:#9BBFD8;text-transform:uppercase;letter-spacing:.05em;margin-top:3px;display:block}
.ffgd .ch-acts{display:flex;gap:10px;flex-wrap:wrap}
.ffgd .ch-btn-p{display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,var(--ac),color-mix(in srgb,var(--ac) 72%,#000));color:#04160f;border:none;padding:12px 24px;border-radius:10px;font-family:'Inter',system-ui;font-size:13.5px;font-weight:700;cursor:pointer;box-shadow:0 6px 22px color-mix(in srgb,var(--ac) 38%,transparent);transition:transform .15s,box-shadow .15s;text-decoration:none}
.ffgd .ch-btn-p:hover{transform:translateY(-2px)}
.ffgd .ch-btn-s{display:inline-flex;align-items:center;gap:7px;background:transparent;border:1px solid color-mix(in srgb,var(--ac) 30%,transparent);color:var(--ac);padding:12px 22px;border-radius:10px;font-family:'Inter',system-ui;font-size:13.5px;font-weight:500;cursor:pointer;transition:background .2s,border-color .2s;text-decoration:none}
.ffgd .ch-btn-s:hover{background:color-mix(in srgb,var(--ac) 8%,transparent)}
/* SEO description blocks (new) */
.ffgd .seo-block{position:relative;z-index:2;background:#050D18;padding:26px 48px}
.ffgd .seo-inner{max-width:820px;margin:0 auto;font-size:14px;line-height:1.75;color:#9BBFD8}
.ffgd .seo-inner p{margin:0 0 12px}
.ffgd .seo-inner p:last-child{margin-bottom:0}
.ffgd .seo-inner strong,.ffgd .seo-inner b{color:#cfe2f2;font-weight:600}
.ffgd .seo-inner a{color:var(--ac);text-decoration:none}
.ffgd .seo-inner h2,.ffgd .seo-inner h3{font-family:'Plus Jakarta Sans',system-ui;color:#fff;font-size:19px;font-weight:700;margin:6px 0 10px}
/* Empty state */
.ffgd .es{position:relative;z-index:2;background:#050D18;padding:20px 48px 40px}
.ffgd .es-inner{max-width:560px;margin:0 auto;text-align:center;background:rgba(18,34,52,.48);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border:1px solid color-mix(in srgb,var(--ac) 22%,transparent);border-radius:22px;padding:48px 32px}
.ffgd .es-ico{width:66px;height:66px;border-radius:18px;margin:0 auto 20px;display:flex;align-items:center;justify-content:center;background:color-mix(in srgb,var(--ac) 12%,transparent);border:1px solid color-mix(in srgb,var(--ac) 28%,transparent);color:var(--ac);font-size:30px}
.ffgd .es-h{font-family:'Plus Jakarta Sans',system-ui;font-size:22px;font-weight:800;letter-spacing:-.4px;margin-bottom:10px}
.ffgd .es-p{font-size:14px;color:#9BBFD8;line-height:1.65;max-width:420px;margin:0 auto 24px}
.ffgd .es-btn{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,var(--ac),color-mix(in srgb,var(--ac) 72%,#000));color:#04160f;border:none;padding:14px 28px;border-radius:12px;font-family:'Inter',system-ui;font-size:14px;font-weight:700;cursor:pointer;text-decoration:none;box-shadow:0 6px 22px color-mix(in srgb,var(--ac) 34%,transparent);transition:transform .15s}
.ffgd .es-btn:hover{transform:translateY(-2px)}
/* Market intelligence (layout; embedded markup carries its own accent) */
.ffgd .mi{position:relative;overflow:hidden;background:linear-gradient(180deg,#060F1A,#0A1628);padding:56px 48px 64px}
.ffgd .mi-aura{position:absolute;border-radius:50%;filter:blur(70px);pointer-events:none;z-index:0}
.ffgd .mi-inner{position:relative;z-index:2;max-width:1200px;margin:0 auto}
.ffgd .mi-pill{display:inline-flex;align-items:center;gap:6px;background:rgba(74,159,224,.08);border:1px solid rgba(74,159,224,.2);color:#4A9FE0;font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.08em;padding:5px 12px;border-radius:20px;margin-bottom:14px}
.ffgd .mi-h{font-family:'Plus Jakarta Sans',system-ui;font-size:32px;font-weight:800;letter-spacing:-.6px;margin-bottom:10px}
.ffgd .mi-h em{color:var(--ac);font-style:normal}
.ffgd .mi-sub{font-size:14px;color:#9BBFD8;line-height:1.6;max-width:480px;margin-bottom:32px}
.ffgd .mi-stats{display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:12px;margin-bottom:28px}
.ffgd .mi-stat{position:relative;background:rgba(18,34,52,.42);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border:1px solid rgba(74,159,224,.1);border-radius:18px;padding:22px 18px;overflow:hidden;transition:border-color .25s,transform .25s}
.ffgd .mi-stat::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,var(--ac,#4A9FE0),transparent);opacity:.5}
.ffgd .mi-stat:hover{border-color:rgba(74,159,224,.28);transform:translateY(-4px)}
.ffgd .mi-n{font-family:'Plus Jakarta Sans',system-ui;font-size:26px;font-weight:800;line-height:1.2;background:linear-gradient(135deg,#fff,#8DCAF2);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;display:block}
.ffgd .mi-n.tl{background:linear-gradient(135deg,#85ECD0,var(--ac));-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.ffgd .mi-nl{font-size:12px;font-weight:500;color:#fff;margin:6px 0 3px;display:block}
.ffgd .mi-nd{font-size:10.5px;color:#6B9DB7}
.ffgd .mi-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.ffgd .mi-box{background:rgba(18,34,52,.4);border:1px solid rgba(74,159,224,.1);border-radius:16px;padding:22px}
.ffgd .mi-bt{display:flex;align-items:center;gap:8px;font-family:'Plus Jakarta Sans',system-ui;font-size:15px;font-weight:700;margin-bottom:16px}
.ffgd .mi-bt i{font-size:17px;color:var(--ac)}
.ffgd .mi-row{display:flex;align-items:center;gap:12px;padding:11px 0;border-bottom:1px solid rgba(74,159,224,.08)}
.ffgd .mi-row:last-child{border-bottom:none}
.ffgd .mi-rank{width:22px;height:22px;border-radius:50%;background:color-mix(in srgb,var(--ac) 12%,transparent);border:1px solid color-mix(in srgb,var(--ac) 28%,transparent);color:var(--ac);font-family:'Plus Jakarta Sans',system-ui;font-size:11px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.ffgd .mi-cty{font-size:13px;font-weight:600;color:#fff;flex:1;display:flex;align-items:center}
.ffgd .mi-flag{margin-right:9px;font-size:16px;line-height:1;flex-shrink:0}
.ffgd .mi-spec{font-size:11px;color:#6B9DB7;text-align:right}
.ffgd .mi-dd{margin-top:18px;background:rgba(10,22,40,.5);border:1px solid rgba(74,159,224,.1);border-radius:12px;padding:16px}
.ffgd .mi-dt{font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.08em;color:var(--ac);margin-bottom:12px}
.ffgd .mi-b{display:flex;gap:9px;margin-bottom:11px;font-size:12px;color:#9BBFD8;line-height:1.55}
.ffgd .mi-b:last-child{margin-bottom:0}
.ffgd .mi-b::before{content:'';width:5px;height:5px;border-radius:50%;background:var(--ac);flex-shrink:0;margin-top:6px}
.ffgd .mi-b b{color:#fff;font-weight:600}
.ffgd .mi-seas{margin-bottom:16px}
.ffgd .mi-seas:last-child{margin-bottom:0}
.ffgd .mi-badge{display:inline-flex;align-items:center;font-size:10px;font-weight:700;padding:3px 10px;border-radius:8px;margin-bottom:6px}
.ffgd .mi-badge.tl{background:color-mix(in srgb,var(--ac) 12%,transparent);color:var(--ac);border:1px solid color-mix(in srgb,var(--ac) 30%,transparent)}
.ffgd .mi-badge.bl{background:rgba(74,159,224,.12);color:#8DCAF2;border:1px solid rgba(74,159,224,.3)}
.ffgd .mi-badge.am{background:rgba(245,158,11,.12);color:#F59E0B;border:1px solid rgba(245,158,11,.3)}
.ffgd .mi-st{font-size:12px;color:#9BBFD8;line-height:1.55}
/* Supplier CTA banner */
.ffgd .scta{position:relative;overflow:hidden;background:linear-gradient(135deg,color-mix(in srgb,var(--ac) 10%,transparent),rgba(74,159,224,.08));border-top:1px solid color-mix(in srgb,var(--ac) 20%,transparent);border-bottom:1px solid color-mix(in srgb,var(--ac) 15%,transparent);padding:40px 48px;display:flex;align-items:center;justify-content:space-between;gap:20px}
.ffgd .scta-aura{position:absolute;border-radius:50%;filter:blur(70px);pointer-events:none;z-index:0;width:300px;height:300px;background:radial-gradient(circle,color-mix(in srgb,var(--ac) 14%,transparent),transparent 70%);top:-100px;right:-40px}
.ffgd .scta-l{position:relative;z-index:2}
.ffgd .scta-h{font-family:'Plus Jakarta Sans',system-ui;font-size:22px;font-weight:800;margin-bottom:8px}
.ffgd .scta-sub{font-size:13.5px;color:#9BBFD8;line-height:1.65;max-width:440px}
.ffgd .scta-btn{position:relative;z-index:2;display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,var(--ac),color-mix(in srgb,var(--ac) 72%,#000));color:#04160f;border:none;padding:13px 26px;border-radius:12px;font-family:'Inter',system-ui;font-size:14px;font-weight:700;cursor:pointer;box-shadow:0 6px 22px color-mix(in srgb,var(--ac) 34%,transparent);flex-shrink:0;transition:transform .15s;text-decoration:none}
.ffgd .scta-btn:hover{transform:translateY(-2px)}
/* Light-mode legibility for page-specific bits */
body.light-mode .ffgd .chero{background:linear-gradient(135deg,#EEF6FF,#F3FAFF,#EEF6FF)}
body.light-mode .ffgd .ch1{color:#050D18}
body.light-mode .ffgd .ch-sub{color:#3A5E75}
body.light-mode .ffgd .ch-bc,body.light-mode .ffgd .ch-bc a{color:#6B9DB7}
body.light-mode .ffgd .ch-stats{background:rgba(255,255,255,.72)}
body.light-mode .ffgd .chs-l{color:#3A5E75}
body.light-mode .ffgd .seo-block,body.light-mode .ffgd .es{background:#EEF6FF}
body.light-mode .ffgd .seo-inner{color:#3A5E75}
body.light-mode .ffgd .seo-inner strong,body.light-mode .ffgd .seo-inner b,body.light-mode .ffgd .seo-inner h2,body.light-mode .ffgd .seo-inner h3{color:#050D18}
body.light-mode .ffgd .es-inner{background:rgba(255,255,255,.65)}
body.light-mode .ffgd .es-h{color:#050D18}
body.light-mode .ffgd .es-p{color:#3A5E75}
body.light-mode .ffgd .mi{background:linear-gradient(180deg,#EEF6FF,#E8F4FF)}
body.light-mode .ffgd .mi-h,body.light-mode .ffgd .mi-nl,body.light-mode .ffgd .mi-cty,body.light-mode .ffgd .mi-bt{color:#050D18}
body.light-mode .ffgd .mi-sub,body.light-mode .ffgd .mi-st,body.light-mode .ffgd .mi-b,body.light-mode .ffgd .mi-spec{color:#3A5E75}
body.light-mode .ffgd .mi-b b,body.light-mode .ffgd .mi-st b{color:#050D18}
body.light-mode .ffgd .mi-stat,body.light-mode .ffgd .mi-box{background:rgba(255,255,255,.78);border-color:rgba(74,159,224,.2)}
body.light-mode .ffgd .mi-n{background:linear-gradient(135deg,#050D18,#1E6BAB);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
body.light-mode .ffgd .scta-h{color:#050D18}
body.light-mode .ffgd .scta-sub{color:#3A5E75}
@media (max-width:768px){
.ffgd .chero{padding:36px 20px 30px}
.ffgd .ch1{font-size:26px}
.ffgd .ch-sub{font-size:13px}
.ffgd .ch-stats{flex-wrap:wrap}
.ffgd .chs{flex:1 1 45%}
.ffgd .seo-block,.ffgd .es,.ffgd .mi{padding-left:20px;padding-right:20px}
.ffgd .mi{padding-top:40px}
.ffgd .mi-stats{grid-template-columns:1fr 1fr}
.ffgd .mi-grid{grid-template-columns:1fr}
.ffgd .scta{flex-direction:column;padding:28px 20px;text-align:center}
.ffgd .scta-sub{max-width:100%}
}
</style>

<div class="ffgd">

<!-- Page background layers (animated by main.js) -->
<div class="pg-grid"></div>
<div class="pg-aura" id="pa1" style="width:640px;height:640px;background:radial-gradient(circle,color-mix(in srgb,var(--ac) 20%,transparent),transparent 65%);top:-240px;left:-200px"></div>
<div class="pg-aura" id="pa2" style="width:560px;height:560px;background:radial-gradient(circle,rgba(74,159,224,.12),transparent 65%);top:-120px;right:-180px"></div>
<div class="pg-aura" id="pa3" style="width:460px;height:460px;background:radial-gradient(circle,color-mix(in srgb,var(--ac) 10%,transparent),transparent 65%);bottom:-150px;left:35%"></div>
<canvas id="pg-canvas" aria-hidden="true"></canvas>

<!-- Category sub-nav -->
<div class="csn" aria-label="Category navigation">
<div class="csn-inner">
<?php
$__parts = array();
foreach ($__subnav as $tab) {
    $lk = get_term_link($tab['slug'], $tab['tax']);
    $href = (is_string($lk)) ? $lk : '#';
    $on = ($tab['slug'] === $slug) ? ' on' : '';
    $__parts[] = '<a class="csn-item' . $on . '" href="' . esc_url($href) . '"><i class="' . esc_attr($tab['icon']) . '" aria-hidden="true"></i>' . $tab['label'] . '</a>';
}
echo implode('<span class="csn-sep"></span>', $__parts);
?>
</div>
</div>

<!-- Category hero -->
<section class="chero" aria-label="Category hero">
<div class="chero-aura" style="width:400px;height:400px;background:radial-gradient(circle,color-mix(in srgb,var(--ac) 18%,transparent),transparent 70%);top:-120px;right:-80px"></div>
<div class="chero-aura" style="width:300px;height:300px;background:radial-gradient(circle,rgba(74,159,224,.1),transparent 70%);bottom:-60px;left:-60px"></div>
<div class="chero-inner">
<div class="ch-bc"><a href="<?php echo esc_url(get_post_type_archive_link($FFINC2_CPT)); ?>">Database</a><i class="ti ti-chevron-right" aria-hidden="true"></i><span class="cur"><?php echo $cfg['crumb']; ?></span></div>
<h1 class="ch1" id="ch-h1"><?php echo $cfg['h1']; ?></h1>
<p class="ch-sub" id="ch-sub"><?php echo $cfg['sub']; ?></p>
<div class="ch-stats" id="ch-stats">
<div class="chs"><span class="chs-n<?php echo ($real_count < 10) ? ' launching' : ''; ?>"><?php echo esc_html($count_display); ?></span><span class="chs-l"><?php echo esc_html($noun); ?></span></div>
<?php foreach ($cfg['stats'] as $st) { ?>
<div class="chs"><span class="chs-n"><?php echo $st[0]; ?></span><span class="chs-l"><?php echo $st[1]; ?></span></div>
<?php } ?>
</div>
<div class="ch-acts" id="ch-acts">
<a class="ch-btn-p" href="<?php echo esc_url($add_url); ?>"><i class="ti ti-plus" aria-hidden="true"></i>List Your Business</a>
<a class="ch-btn-s" href="#ffgd-listings">Browse all <?php echo esc_html($noun_lc); ?></a>
</div>
</div>
</section>

<?php if ($top_desc) { ?>
<!-- SEO top description (live from GD category term meta) -->
<div class="seo-block"><div class="seo-inner"><?php echo wp_kses_post($top_desc); ?></div></div>
<?php } ?>

<!-- Filter bar -->
<div class="fb" aria-label="Filters">
<div class="fb-in">
<label class="fb-s"><i class="ti ti-search" aria-hidden="true"></i><input type="text" placeholder="Search <?php echo esc_attr($noun_lc); ?>, products, origins..." aria-label="Search <?php echo esc_attr($noun_lc); ?>"></label>
<select class="fb-sel" aria-label="<?php echo esc_attr($type_label); ?>">
<option>All <?php echo esc_html($FFINC2_KIND === 'service' ? 'Services' : 'Products'); ?></option>
<?php foreach ($type_options as $opt) { echo '<option>' . esc_html($opt) . '</option>'; } ?>
</select>
<select class="fb-sel" aria-label="Certification">
<option>All Certifications</option>
<?php foreach (ffinc2_gd_field_options($FFINC2_CPT, 'certifications') as $opt) { echo '<option>' . esc_html($opt) . '</option>'; } ?>
</select>
<div class="fb-r">
<span class="fb-cnt">Showing <b><?php echo esc_html($real_count); ?></b> <?php echo esc_html($noun_lc); ?></span>
<div class="tog">
<button class="tog-b on" id="tog-grid" aria-label="Grid view"><i class="ti ti-layout-grid" aria-hidden="true"></i></button>
<button class="tog-b" id="tog-list" aria-label="List view"><i class="ti ti-list" aria-hidden="true"></i></button>
</div>
</div>
</div>
</div>

<!-- Listings -->
<section class="ls" id="ffgd-listings" aria-label="<?php echo esc_attr($noun); ?> listings">
<div class="ls-inner">
<?php
$listing_q = new WP_Query(array(
    'post_type'      => $FFINC2_CPT,
    'post_status'    => 'publish',
    'posts_per_page' => 12,
    'tax_query'      => array(array('taxonomy' => $FFINC2_TAX, 'field' => 'slug', 'terms' => $slug)),
));
if ($listing_q->have_posts()) :
?>
<div class="ls-lbl"><?php echo esc_html($real_count . ' verified ' . $noun_lc); ?> · Grid view</div>
<div id="grid-view">
<?php
while ($listing_q->have_posts()) : $listing_q->the_post();
    $pid   = get_the_ID();
    $name  = get_the_title();
    $ini   = ffinc2_gd_initials($name);
    $city  = ffinc2_gd_meta($pid, 'city');
    $ctry  = ffinc2_gd_meta($pid, 'country');
    $loc   = trim($city . (($city && $ctry) ? ', ' : '') . $ctry);
    if ($loc === '') $loc = $ctry ?: $city;
    $est   = ffinc2_gd_meta($pid, 'established_year');
    $certs = ffinc2_gd_multi(ffinc2_gd_meta($pid, 'certifications'));
    if ($FFINC2_KIND === 'service') {
        $tags = ffinc2_gd_multi(ffinc2_gd_meta($pid, 'service_type'));
        $s1v  = ffinc2_gd_meta($pid, 'capacity__fleet_size'); $s1l = 'Fleet / Capacity';
        $s2   = ffinc2_gd_multi(ffinc2_gd_meta($pid, 'coverage_region')); $s2v = $s2 ? (count($s2) > 1 ? count($s2) . ' regions' : $s2[0]) : '—'; $s2l = 'Coverage';
        $s3v  = ffinc2_gd_meta($pid, 'typical_turnaround'); $s3l = 'Turnaround';
        $verified = ffinc2_gd_meta($pid, 'verified_provider');
    } else {
        $tags = ffinc2_gd_multi(ffinc2_gd_meta($pid, $cfg['pfield']));
        $s1v  = ffinc2_gd_meta($pid, 'minimum_order_quantity'); $s1l = 'Min. Order';
        $s2v  = ffinc2_gd_meta($pid, 'export_countries'); $s2l = 'Export Countries';
        $s3v  = ffinc2_gd_meta($pid, 'annual_capacity'); $s3l = 'Annual Capacity';
        $verified = ffinc2_gd_meta($pid, 'verified_supplier');
    }
    $featured = ffinc2_gd_meta($pid, 'featured_listing');
    $qattr = 'data-supplier-id="' . esc_attr($pid) . '" data-supplier-name="' . esc_attr($name) . '" data-supplier-logo="' . esc_attr($ini) . '" data-supplier-location="' . esc_attr($loc) . '"';
    ?>
    <div class="lc">
        <div class="lc-head">
            <div class="lc-logo"><?php echo esc_html($ini); ?></div>
            <div class="lc-ng"><div class="lc-n" title="<?php echo esc_attr($name); ?>"><a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none"><?php echo esc_html($name); ?></a></div>
            <?php if ($loc || $est) { ?><div class="lc-loc"><i class="ti ti-map-pin" aria-hidden="true"></i><?php echo esc_html($loc); echo $est ? ' · Est. ' . esc_html($est) : ''; ?></div><?php } ?></div>
            <div class="lc-bdgs">
                <?php if ($featured) { ?><span class="bdg bdg-f"><i class="ti ti-star" style="font-size:9px" aria-hidden="true"></i>Featured</span><?php } ?>
                <?php if ($verified) { ?><span class="bdg bdg-v"><i class="ti ti-circle-check" style="font-size:9px" aria-hidden="true"></i>Verified</span><?php } ?>
            </div>
        </div>
        <?php if ($tags) { ?><div class="lc-tags"><?php foreach (array_slice($tags, 0, 4) as $t) echo '<span class="lc-tag">' . esc_html($t) . '</span>'; ?></div><?php } ?>
        <div class="lc-stats">
            <div class="lc-stat"><span class="lc-sv"><?php echo esc_html($s1v ?: '—'); ?></span><span class="lc-sl"><?php echo esc_html($s1l); ?></span></div>
            <div class="lc-stat"><span class="lc-sv"><?php echo esc_html($s2v ?: '—'); ?></span><span class="lc-sl"><?php echo esc_html($s2l); ?></span></div>
            <div class="lc-stat"><span class="lc-sv"><?php echo esc_html($s3v ?: '—'); ?></span><span class="lc-sl"><?php echo esc_html($s3l); ?></span></div>
        </div>
        <?php if ($certs) { ?><div class="lc-certs"><?php foreach (array_slice($certs, 0, 4) as $c) echo '<span class="lc-cert">' . esc_html($c) . '</span>'; ?></div><?php } ?>
        <div class="lc-foot">
            <a class="lc-rate" href="<?php the_permalink(); ?>" style="text-decoration:none">View profile <i class="ti ti-arrow-right" style="font-size:12px" aria-hidden="true"></i></a>
            <button class="rq-btn" <?php echo $qattr; ?>>Request Quote</button>
        </div>
    </div>
<?php endwhile; ?>
</div>
<div id="list-view"></div>
<?php wp_reset_postdata(); ?>
<?php else : ?>
<!-- Empty state (no listings yet) -->
<div class="es"><div class="es-inner">
<div class="es-ico"><i class="<?php echo esc_attr($cfg['icon']); ?>" aria-hidden="true"></i></div>
<div class="es-h">New category — be among the first listed</div>
<div class="es-p">No <?php echo esc_html($noun_lc); ?> are listed in this category yet. List your business free and be among the first verified <?php echo esc_html($noun_lc); ?> buyers find here — direct contact, zero commission.</div>
<a class="es-btn" href="<?php echo esc_url($add_url); ?>"><i class="ti ti-plus" aria-hidden="true"></i>List Your Business</a>
</div></div>
<?php endif; ?>
</div>
</section>

<?php if ($listing_q->have_posts() && $real_count > 12) { ?>
<!-- Load more -->
<div class="lm">
<div class="lm-cnt">Showing <b>12</b> of <b><?php echo esc_html($real_count); ?></b> verified <?php echo esc_html($noun_lc); ?></div>
<button class="lm-btn"><i class="ti ti-refresh" aria-hidden="true"></i>Load More</button>
</div>
<?php } ?>

<?php if ($bottom_desc) { ?>
<!-- SEO bottom description (live from GD category term meta) -->
<div class="seo-block"><div class="seo-inner"><?php echo wp_kses_post($bottom_desc); ?></div></div>
<?php } ?>

<!-- Market intelligence (per-category content) -->
<?php echo $cfg['mi']; ?>

<!-- Supplier CTA banner -->
<section class="scta" aria-label="Provider call to action">
<div class="scta-aura"></div>
<div class="scta-l">
<div class="scta-h"><?php echo esc_html('Are you a ' . strtolower($cfg['crumb']) . ($FFINC2_KIND === 'service' ? ' provider?' : ' supplier?')); ?></div>
<div class="scta-sub">List your business for free and start receiving direct quote requests from wholesale buyers actively sourcing in this category. Zero commission on every deal closed through FFInc.</div>
</div>
<a class="scta-btn" href="<?php echo esc_url($add_url); ?>"><i class="ti ti-plus" aria-hidden="true"></i>Create Free Listing</a>
</section>

<!-- Quote request modal (styled by design-system.css) -->
<div class="qm-ov" id="qm-ov" aria-hidden="true">
<div class="qm" id="qm-card" role="dialog" aria-modal="true" aria-label="Request a quote">
<button class="qm-x" id="qm-x" aria-label="Close"><i class="ti ti-x" aria-hidden="true"></i></button>
<div class="qm-sup">
<div class="qm-logo" id="qm-logo">—</div>
<div><div class="qm-sn" id="qm-sn">Select a listing</div><div class="qm-sl"><i class="ti ti-map-pin" aria-hidden="true"></i><span id="qm-sl"></span></div></div>
</div>
<div class="qm-h">Request a Quote</div>
<div class="qm-sub">Complete the form below — the <?php echo esc_html($FFINC2_KIND === 'service' ? 'provider' : 'supplier'); ?> will respond directly to your email. FFInc charges zero commission.</div>
<form id="qm-form" onsubmit="return false">
<div class="qm-grid">
<div class="qm-f"><label class="qm-lb">Your Name</label><input class="qm-in" type="text" placeholder="Jane Doe"></div>
<div class="qm-f"><label class="qm-lb">Company Name</label><input class="qm-in" type="text" placeholder="Acme Foods Ltd"></div>
<div class="qm-f"><label class="qm-lb">Email Address</label><input class="qm-in" type="email" placeholder="you@company.com"></div>
<div class="qm-f"><label class="qm-lb">Country</label><input class="qm-in" type="text" placeholder="United Kingdom"></div>
<div class="qm-f full"><label class="qm-lb">Requirements</label><textarea class="qm-ta" rows="4" placeholder="Product/service required, quantity, certifications, delivery terms, timeline..."></textarea></div>
</div>
<button class="qm-sub-btn" type="submit"><i class="ti ti-send" aria-hidden="true"></i>Send Quote Request</button>
<div class="qm-priv">Your details are sent directly to the <?php echo esc_html($FFINC2_KIND === 'service' ? 'provider' : 'supplier'); ?>. FrozenFoodInc does not store quote request data or charge any commission.</div>
</form>
</div>
</div>

</div><!-- /.ffgd -->

<?php get_footer(); ?>

<!-- ============================================================
     GD archive page-specific JS. Shared behaviour (canvas, aurora,
     footer dot, dark/light toggle) is in main.js. Cards are rendered
     server-side, so the quote modal reads data-supplier-* attributes
     from whichever card was clicked.
     ============================================================ -->
<script>
(function(){
  /* Grid / list view toggle */
  var gv=document.getElementById('grid-view'),lv=document.getElementById('list-view'),
      tg=document.getElementById('tog-grid'),tl=document.getElementById('tog-list');
  if(tg&&tl&&gv){
    tg.addEventListener('click',function(){gv.style.display='grid';if(lv)lv.style.display='none';tg.classList.add('on');tl.classList.remove('on');});
    tl.addEventListener('click',function(){gv.style.display='none';if(lv)lv.style.display='flex';tl.classList.add('on');tg.classList.remove('on');});
  }
  /* Quote modal — populated dynamically from the clicked card */
  var ov=document.getElementById('qm-ov'),card=document.getElementById('qm-card');
  function openModal(name,logo,loc){
    var sn=document.getElementById('qm-sn'),lg=document.getElementById('qm-logo'),sl=document.getElementById('qm-sl');
    if(sn)sn.textContent=name||'Selected listing';
    if(lg)lg.textContent=logo||'—';
    if(sl)sl.textContent=loc||'';
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
    if(t){openModal(t.getAttribute('data-supplier-name'),t.getAttribute('data-supplier-logo'),t.getAttribute('data-supplier-location'));return;}
  });
  var x=document.getElementById('qm-x'); if(x)x.addEventListener('click',closeModal);
  if(ov)ov.addEventListener('click',function(e){if(e.target===ov)closeModal();});
  document.addEventListener('keydown',function(e){if(e.key==='Escape'&&ov&&ov.classList.contains('open'))closeModal();});
  /* Hero + scroll-in animations */
  if(window.gsap){
    var htl=gsap.timeline({defaults:{ease:'power3.out'}});
    htl.fromTo('#ch-h1',{y:30,opacity:0},{y:0,opacity:1,duration:.7})
       .fromTo('#ch-sub',{y:24,opacity:0},{y:0,opacity:1,duration:.65},'-=.5')
       .fromTo('#ch-stats',{y:20,opacity:0},{y:0,opacity:1,duration:.6},'-=.45')
       .fromTo('#ch-acts',{y:18,opacity:0},{y:0,opacity:1,duration:.55},'-=.4');
    var mi=document.getElementById('mi-sec');
    if(mi){
      var obs=new IntersectionObserver(function(en){en.forEach(function(e){if(e.isIntersecting){gsap.fromTo(mi.querySelectorAll('.mi-stat'),{opacity:0,y:28},{opacity:1,y:0,duration:.6,stagger:.1,ease:'power3.out'});obs.unobserve(e.target);}});},{threshold:.1});
      obs.observe(mi);
    }
  }
})();
</script>
