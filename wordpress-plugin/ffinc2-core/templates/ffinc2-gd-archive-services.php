<?php
/*
Template Name: FFInc 2.0 — GD Archive: Services
*/
if (!defined('ABSPATH')) exit;
get_header();

$MI_SV = <<<'MIEOT'
<!-- SECTION 6 — Market intelligence -->
<section class="mi" id="mi-sec" aria-label="Market intelligence">
<div class="mi-aura" style="width:340px;height:340px;background:radial-gradient(circle,rgba(167,139,250,.1),transparent 70%);top:-100px;right:-60px"></div>
<div class="mi-aura" style="width:260px;height:260px;background:radial-gradient(circle,rgba(167,139,250,.07),transparent 70%);bottom:-60px;left:-40px"></div>
<div class="mi-inner">
<div class="mi-pill"><i class="ti ti-chart-bar" aria-hidden="true"></i>Market Intelligence</div>
<h2 class="mi-h">Cold Chain Services — <em>Market Data</em></h2>
<p class="mi-sub">Global cold chain logistics data to inform your supply chain decisions. Updated quarterly by the FFInc research team.</p>
<div class="mi-stats">
<div class="mi-stat" style="--ac:#A78BFA"><span class="mi-n">$271B</span><span class="mi-nl">Global Market Size</span><span class="mi-nd">2024 valuation</span></div>
<div class="mi-stat" style="--ac:#A78BFA"><span class="mi-n tl">7.2%</span><span class="mi-nl">Annual Growth Rate</span><span class="mi-nd">CAGR through 2030</span></div>
<div class="mi-stat" style="--ac:#A78BFA"><span class="mi-n">$411B</span><span class="mi-nl">Projected by 2030</span><span class="mi-nd">At current CAGR</span></div>
<div class="mi-stat" style="--ac:#A78BFA"><span class="mi-n tl">320+</span><span class="mi-nl">Verified Providers</span><span class="mi-nd">In this database</span></div>
</div>
<div class="mi-grid">
<div class="mi-box" id="mi-left">
<div class="mi-bt"><i class="ti ti-world" aria-hidden="true"></i>Top Service Regions</div>
<div class="mi-row"><div class="mi-rank">1</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇪🇺</span>Europe</span><span class="mi-spec">Cold Storage · 3PL · Transport</span></div>
<div class="mi-row"><div class="mi-rank">2</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇺🇸</span>North America</span><span class="mi-spec">Reefer Fleet · Distribution</span></div>
<div class="mi-row"><div class="mi-rank">3</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇸🇬</span>Asia Pacific</span><span class="mi-spec">Port Handling · Storage</span></div>
<div class="mi-row"><div class="mi-rank">4</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇦🇪</span>Middle East</span><span class="mi-spec">Halal Cold Chain · Port</span></div>
<div class="mi-row"><div class="mi-rank">5</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇧🇷</span>South America</span><span class="mi-spec">Processing · Storage</span></div>
<div class="mi-dd">
<div class="mi-dt">Key Demand Drivers</div>
<div class="mi-b"><span><b>Frozen food trade growth</b> — rising global frozen food export volumes creating sustained demand for temperature-controlled logistics infrastructure worldwide</span></div>
<div class="mi-b"><span><b>Regulatory compliance pressure</b> — tightening food safety regulations across EU, USA and GCC markets driving demand for certified cold chain handlers with full traceability</span></div>
<div class="mi-b"><span><b>E-commerce &amp; last-mile</b> — rapid growth of frozen food e-commerce driving investment in last-mile refrigerated delivery infrastructure globally</span></div>
</div>
</div>
<div class="mi-box" id="mi-right">
<div class="mi-bt"><i class="ti ti-calendar" aria-hidden="true"></i>Peak Demand Windows</div>
<div class="mi-seas"><span class="mi-badge tl">Nov–Feb</span><div class="mi-st"><b style="color:#fff">Q4–Q1 peak season</b> — highest cold storage and transport demand globally. Christmas, Ramadan and Chinese New Year procurement drives maximum capacity utilization. Book storage and transport slots early.</div></div>
<div class="mi-seas"><span class="mi-badge tl">Mar–Jun</span><div class="mi-st"><b style="color:#fff">Spring sourcing season</b> — Southern Hemisphere harvests drive increased cold chain activity. Key window for securing blast freezing and IQF processing capacity.</div></div>
<div class="mi-seas"><span class="mi-badge bl">Year-round</span><div class="mi-st"><b style="color:#fff">Port cold storage</b> — Rotterdam, Dubai, Singapore and Shanghai operate at near-capacity year-round. Pre-booking port-side cold storage 8–12 weeks ahead strongly recommended.</div></div>
<div class="mi-seas"><span class="mi-badge tl">Jul–Oct</span><div class="mi-st"><b style="color:#fff">Northern Hemisphere processing peak</b> — European and North American processors at maximum throughput. Packaging, labelling and quality testing services in highest demand.</div></div>
</div>
</div>
</div>
</section>
MIEOT;

$FFINC2_CPT     = 'gd_services';
$FFINC2_TAX     = 'gd_servicescategory';
$FFINC2_KIND    = 'service';
$FFINC2_DEFAULT = 'cold-chain-services';
$FFINC2_CATS = array(
  'cold-chain-services' => array(
    'accent' => '#A78BFA',
    'icon'   => 'ti ti-truck',
    'pfield' => '',
    'crumb'  => 'Cold Chain Services',
    'h1'     => 'Cold Chain <em>Services</em> Providers',
    'sub'    => 'Find verified cold storage facilities, refrigerated transport operators, packaging specialists and customs &amp; compliance providers for your frozen food supply chain. Zero commission, direct contact.',
    'stats'  => array(array('60','Countries'),array('Global','Coverage'),array('7.2%','Mkt CAGR')),
    'mi'     => $MI_SV,
  ),
);

require FFINC2_PATH . 'templates/partials/gd-archive-render.php';
