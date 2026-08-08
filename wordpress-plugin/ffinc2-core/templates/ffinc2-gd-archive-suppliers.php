<?php
/*
Template Name: FFInc 2.0 — GD Archive: Suppliers
*/
if (!defined('ABSPATH')) exit;
get_header();

$MI_FV = <<<'MIEOT'
<!-- SECTION 6 — Market intelligence -->
<section class="mi" id="mi-sec" aria-label="Market intelligence">
<div class="mi-aura" style="width:340px;height:340px;background:radial-gradient(circle,rgba(74,159,224,.1),transparent 70%);top:-100px;right:-60px"></div>
<div class="mi-aura" style="width:260px;height:260px;background:radial-gradient(circle,rgba(46,204,154,.07),transparent 70%);bottom:-60px;left:-40px"></div>
<div class="mi-inner">
<div class="mi-pill"><i class="ti ti-chart-bar" aria-hidden="true"></i>Market Intelligence</div>
<h2 class="mi-h">Frozen Fruits &amp; Veg — <em>Market Data</em></h2>
<p class="mi-sub">Real market data to inform your sourcing strategy. Updated quarterly by the FFInc research team.</p>
<div class="mi-stats">
<div class="mi-stat" style="--ac:#4A9FE0"><span class="mi-n">$21.4B</span><span class="mi-nl">Global Market Size</span><span class="mi-nd">2024 valuation</span></div>
<div class="mi-stat" style="--ac:#2ECC9A"><span class="mi-n tl">6.2%</span><span class="mi-nl">Annual Growth Rate</span><span class="mi-nd">CAGR through 2030</span></div>
<div class="mi-stat" style="--ac:#4A9FE0"><span class="mi-n">$30.6B</span><span class="mi-nl">Projected by 2030</span><span class="mi-nd">At current CAGR</span></div>
<div class="mi-stat" style="--ac:#2ECC9A"><span class="mi-n tl">180+</span><span class="mi-nl">Database Suppliers</span><span class="mi-nd">In this category</span></div>
</div>
<div class="mi-grid">
<div class="mi-box" id="mi-left">
<div class="mi-bt"><i class="ti ti-world" aria-hidden="true"></i>Top Sourcing Origins</div>
<div class="mi-row"><div class="mi-rank">1</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇳🇱</span>Netherlands</span><span class="mi-spec">IQF Berries · Mixed Veg</span></div>
<div class="mi-row"><div class="mi-rank">2</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇨🇱</span>Chile</span><span class="mi-spec">Berries · Stone Fruit</span></div>
<div class="mi-row"><div class="mi-rank">3</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇪🇸</span>Spain</span><span class="mi-spec">Mixed Veg · Strawberries</span></div>
<div class="mi-row"><div class="mi-rank">4</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇵🇱</span>Poland</span><span class="mi-spec">IQF Veg · Mushrooms</span></div>
<div class="mi-row"><div class="mi-rank">5</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇵🇪</span>Peru</span><span class="mi-spec">Organic Berries · Mango</span></div>
<div class="mi-dd">
<div class="mi-dt">Key Demand Drivers</div>
<div class="mi-b"><span><b>Plant-based diet growth</b> — rising global demand for plant protein and clean-label frozen produce</span></div>
<div class="mi-b"><span><b>Food service recovery</b> — restaurants and catering returning to pre-pandemic frozen veg volumes</span></div>
<div class="mi-b"><span><b>Retail convenience</b> — premium frozen positioned as healthier than canned alternatives</span></div>
</div>
</div>
<div class="mi-box" id="mi-right">
<div class="mi-bt"><i class="ti ti-calendar" aria-hidden="true"></i>Peak Sourcing Windows</div>
<div class="mi-seas"><span class="mi-badge tl">Jan–Apr</span><div class="mi-st"><b style="color:#fff">South America peak</b> — Chile &amp; Peru berry season. Best pricing on blueberries, raspberries, and organic varieties. Book container slots early.</div></div>
<div class="mi-seas"><span class="mi-badge bl">May–Sep</span><div class="mi-st"><b style="color:#fff">European veg season</b> — Spain, Poland &amp; Belgium at peak output. IQF mixed vegetables and leafy greens at lowest annual FOB pricing.</div></div>
<div class="mi-seas"><span class="mi-badge am">Year-round</span><div class="mi-st"><b style="color:#fff">Tropical origins</b> — Kenya, Costa Rica &amp; Mexico supply mango, pineapple, and passion fruit consistently across all 12 months.</div></div>
<div class="mi-seas"><span class="mi-badge tl">Oct–Dec</span><div class="mi-st"><b style="color:#fff">Nordic wild berries</b> — Sweden &amp; Finland peak for lingonberry, cloudberry, and wild bilberry. Limited volumes — early commitment recommended.</div></div>
</div>
</div>
</div>
</section>
MIEOT;

$MI_PO = <<<'MIEOT'
<!-- SECTION 6 — Market intelligence -->
<section class="mi" id="mi-sec" aria-label="Market intelligence">
<div class="mi-aura" style="width:340px;height:340px;background:radial-gradient(circle,rgba(74,159,224,.1),transparent 70%);top:-100px;right:-60px"></div>
<div class="mi-aura" style="width:260px;height:260px;background:radial-gradient(circle,rgba(74,159,224,.07),transparent 70%);bottom:-60px;left:-40px"></div>
<div class="mi-inner">
<div class="mi-pill"><i class="ti ti-chart-bar" aria-hidden="true"></i>Market Intelligence</div>
<h2 class="mi-h">Frozen Poultry — <em>Market Data</em></h2>
<p class="mi-sub">Real market data to inform your poultry sourcing strategy. Updated quarterly by the FFInc research team.</p>
<div class="mi-stats">
<div class="mi-stat" style="--ac:#4A9FE0"><span class="mi-n">$27.3B</span><span class="mi-nl">Global Market Size</span><span class="mi-nd">2024 valuation</span></div>
<div class="mi-stat" style="--ac:#4A9FE0"><span class="mi-n tl">4.8%</span><span class="mi-nl">Annual Growth Rate</span><span class="mi-nd">CAGR through 2030</span></div>
<div class="mi-stat" style="--ac:#4A9FE0"><span class="mi-n">$35.8B</span><span class="mi-nl">Projected by 2030</span><span class="mi-nd">At current CAGR</span></div>
<div class="mi-stat" style="--ac:#4A9FE0"><span class="mi-n tl">220+</span><span class="mi-nl">Database Suppliers</span><span class="mi-nd">In this category</span></div>
</div>
<div class="mi-grid">
<div class="mi-box" id="mi-left">
<div class="mi-bt"><i class="ti ti-world" aria-hidden="true"></i>Top Sourcing Origins</div>
<div class="mi-row"><div class="mi-rank">1</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇧🇷</span>Brazil</span><span class="mi-spec">Whole Chicken · Halal · Paws</span></div>
<div class="mi-row"><div class="mi-rank">2</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇺🇸</span>USA</span><span class="mi-spec">IQF Cuts · Paws · Whole Chicken</span></div>
<div class="mi-row"><div class="mi-rank">3</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇵🇱</span>Poland</span><span class="mi-spec">Chicken Fillets · Breast · IQF</span></div>
<div class="mi-row"><div class="mi-rank">4</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇹🇭</span>Thailand</span><span class="mi-spec">Processed · IQF · Nuggets</span></div>
<div class="mi-row"><div class="mi-rank">5</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇺🇦</span>Ukraine</span><span class="mi-spec">Drumsticks · Whole Chicken</span></div>
<div class="mi-dd">
<div class="mi-dt">Key Demand Drivers</div>
<div class="mi-b"><span><b>Halal market expansion</b> — growing Muslim consumer base globally driving certified halal poultry demand across MENA and Asia</span></div>
<div class="mi-b"><span><b>Protein affordability</b> — frozen chicken remains the most cost-effective animal protein source worldwide for food service and retail</span></div>
<div class="mi-b"><span><b>QSR &amp; food service growth</b> — quick service restaurant chains driving bulk demand for IQF cuts, paws and processed product formats</span></div>
</div>
</div>
<div class="mi-box" id="mi-right">
<div class="mi-bt"><i class="ti ti-calendar" aria-hidden="true"></i>Peak Sourcing Windows</div>
<div class="mi-seas"><span class="mi-badge bl">Jan–Jun</span><div class="mi-st"><b style="color:#fff">Brazil peak season</b> — highest export volume and most competitive FOB pricing on whole chicken, drumsticks and paws. Book container slots 8–12 weeks in advance.</div></div>
<div class="mi-seas"><span class="mi-badge bl">Year-round</span><div class="mi-st"><b style="color:#fff">EU suppliers</b> (Poland, Netherlands, France) — consistent IQF fillet and breast supply for retail and food service year-round at stable pricing.</div></div>
<div class="mi-seas"><span class="mi-badge am">Apr–Oct</span><div class="mi-st"><b style="color:#fff">Thailand processed peak</b> — IQF nuggets, cooked products and further-processed poultry at lowest annual production cost. Ideal for retail-ready formats.</div></div>
<div class="mi-seas"><span class="mi-badge am">Year-round</span><div class="mi-st"><b style="color:#fff">USA paws &amp; MDM</b> — consistent 40ft container availability for chicken paws and mechanically deboned meat. Key supply for Asian and African markets.</div></div>
</div>
</div>
</div>
</section>
MIEOT;

$MI_BM = <<<'MIEOT'
<!-- SECTION 6 — Market intelligence -->
<section class="mi" id="mi-sec" aria-label="Market intelligence">
<div class="mi-aura" style="width:340px;height:340px;background:radial-gradient(circle,rgba(245,158,11,.1),transparent 70%);top:-100px;right:-60px"></div>
<div class="mi-aura" style="width:260px;height:260px;background:radial-gradient(circle,rgba(245,158,11,.07),transparent 70%);bottom:-60px;left:-40px"></div>
<div class="mi-inner">
<div class="mi-pill"><i class="ti ti-chart-bar" aria-hidden="true"></i>Market Intelligence</div>
<h2 class="mi-h">Frozen Beef &amp; Meat — <em>Market Data</em></h2>
<p class="mi-sub">Real market data to inform your beef and meat sourcing strategy. Updated quarterly by the FFInc research team.</p>
<div class="mi-stats">
<div class="mi-stat" style="--ac:#F59E0B"><span class="mi-n">$74.6B</span><span class="mi-nl">Global Market Size</span><span class="mi-nd">2024 valuation</span></div>
<div class="mi-stat" style="--ac:#F59E0B"><span class="mi-n tl">3.9%</span><span class="mi-nl">Annual Growth Rate</span><span class="mi-nd">CAGR through 2030</span></div>
<div class="mi-stat" style="--ac:#F59E0B"><span class="mi-n">$93.4B</span><span class="mi-nl">Projected by 2030</span><span class="mi-nd">At current CAGR</span></div>
<div class="mi-stat" style="--ac:#F59E0B"><span class="mi-n tl">210+</span><span class="mi-nl">Database Suppliers</span><span class="mi-nd">In this category</span></div>
</div>
<div class="mi-grid">
<div class="mi-box" id="mi-left">
<div class="mi-bt"><i class="ti ti-world" aria-hidden="true"></i>Top Sourcing Origins</div>
<div class="mi-row"><div class="mi-rank">1</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇧🇷</span>Brazil</span><span class="mi-spec">Whole Cuts · Offal · Halal</span></div>
<div class="mi-row"><div class="mi-rank">2</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇦🇺</span>Australia</span><span class="mi-spec">Grass-Fed · Lamb · Wagyu</span></div>
<div class="mi-row"><div class="mi-rank">3</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇺🇸</span>USA</span><span class="mi-spec">USDA Beef · Ground · Pork</span></div>
<div class="mi-row"><div class="mi-rank">4</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇦🇷</span>Argentina</span><span class="mi-spec">Ribeye · Grass-Fed · Halal</span></div>
<div class="mi-row"><div class="mi-rank">5</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇳🇿</span>New Zealand</span><span class="mi-spec">Lamb · Venison · Grass-Fed</span></div>
<div class="mi-dd">
<div class="mi-dt">Key Demand Drivers</div>
<div class="mi-b"><span><b>Halal certification demand</b> — expanding Muslim consumer markets in MENA and Southeast Asia driving halal-certified beef and offal import growth</span></div>
<div class="mi-b"><span><b>Premium grass-fed positioning</b> — rising health-conscious consumer demand for traceable, grass-fed and organic beef across Western markets</span></div>
<div class="mi-b"><span><b>Foodservice recovery</b> — hotel, restaurant and catering sectors restoring pre-pandemic beef procurement volumes globally</span></div>
</div>
</div>
<div class="mi-box" id="mi-right">
<div class="mi-bt"><i class="ti ti-calendar" aria-hidden="true"></i>Peak Sourcing Windows</div>
<div class="mi-seas"><span class="mi-badge am">Jan–Jun</span><div class="mi-st"><b style="color:#fff">Southern Hemisphere peak</b> — Argentina, Uruguay and Brazil at peak processing capacity. Best FOB pricing on ribeye, grass-fed cuts and offal. Container availability highest Jan–Mar.</div></div>
<div class="mi-seas"><span class="mi-badge am">Year-round</span><div class="mi-st"><b style="color:#fff">Australia &amp; New Zealand</b> — consistent year-round supply of grass-fed beef, lamb and venison. Premium product at stable pricing with strong halal certification coverage.</div></div>
<div class="mi-seas"><span class="mi-badge bl">Apr–Sep</span><div class="mi-st"><b style="color:#fff">Northern Hemisphere processing peak</b> — USA and EU beef processors at highest annual throughput. Ground beef and USDA cuts at most competitive annual pricing.</div></div>
<div class="mi-seas"><span class="mi-badge am">Year-round</span><div class="mi-st"><b style="color:#fff">Offal &amp; variety cuts</b> — Brazil and India year-round availability of liver, tripe, oxtail and specialty cuts. High demand from MENA, Asia and African import markets.</div></div>
</div>
</div>
</div>
</section>
MIEOT;

$MI_SF = <<<'MIEOT'
<!-- SECTION 6 — Market intelligence -->
<section class="mi" id="mi-sec" aria-label="Market intelligence">
<div class="mi-aura" style="width:340px;height:340px;background:radial-gradient(circle,rgba(82,222,181,.1),transparent 70%);top:-100px;right:-60px"></div>
<div class="mi-aura" style="width:260px;height:260px;background:radial-gradient(circle,rgba(82,222,181,.07),transparent 70%);bottom:-60px;left:-40px"></div>
<div class="mi-inner">
<div class="mi-pill"><i class="ti ti-chart-bar" aria-hidden="true"></i>Market Intelligence</div>
<h2 class="mi-h">Frozen Seafood — <em>Market Data</em></h2>
<p class="mi-sub">Real market data to inform your seafood sourcing strategy. Updated quarterly by the FFInc research team.</p>
<div class="mi-stats">
<div class="mi-stat" style="--ac:#52DEB5"><span class="mi-n">$38.2B</span><span class="mi-nl">Global Market Size</span><span class="mi-nd">2024 valuation</span></div>
<div class="mi-stat" style="--ac:#52DEB5"><span class="mi-n tl">5.1%</span><span class="mi-nl">Annual Growth Rate</span><span class="mi-nd">CAGR through 2030</span></div>
<div class="mi-stat" style="--ac:#52DEB5"><span class="mi-n">$51.6B</span><span class="mi-nl">Projected by 2030</span><span class="mi-nd">At current CAGR</span></div>
<div class="mi-stat" style="--ac:#52DEB5"><span class="mi-n tl">165+</span><span class="mi-nl">Database Suppliers</span><span class="mi-nd">In this category</span></div>
</div>
<div class="mi-grid">
<div class="mi-box" id="mi-left">
<div class="mi-bt"><i class="ti ti-world" aria-hidden="true"></i>Top Sourcing Origins</div>
<div class="mi-row"><div class="mi-rank">1</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇳🇴</span>Norway</span><span class="mi-spec">Salmon · Cod · Arctic Fish</span></div>
<div class="mi-row"><div class="mi-rank">2</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇹🇭</span>Thailand</span><span class="mi-spec">Shrimp · Vannamei · Processed</span></div>
<div class="mi-row"><div class="mi-rank">3</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇪🇨</span>Ecuador</span><span class="mi-spec">White Shrimp · Vannamei IQF</span></div>
<div class="mi-row"><div class="mi-rank">4</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇻🇳</span>Vietnam</span><span class="mi-spec">Pangasius · Tilapia · Shrimp</span></div>
<div class="mi-row"><div class="mi-rank">5</div><span class="mi-cty"><span class="mi-flag" aria-hidden="true">🇮🇸</span>Iceland</span><span class="mi-spec">Cod · Haddock · Capelin</span></div>
<div class="mi-dd">
<div class="mi-dt">Key Demand Drivers</div>
<div class="mi-b"><span><b>Sustainability credentials</b> — MSC and ASC certification increasingly mandatory for EU and North American retail buyers, driving premium pricing for certified stock</span></div>
<div class="mi-b"><span><b>Shrimp demand growth</b> — vannamei shrimp remains the world's most traded seafood product with consistent global demand across foodservice and retail</span></div>
<div class="mi-b"><span><b>Health &amp; omega positioning</b> — rising consumer demand for omega-3 rich frozen fish driving salmon and oily fish import growth across Asian and Middle Eastern markets</span></div>
</div>
</div>
<div class="mi-box" id="mi-right">
<div class="mi-bt"><i class="ti ti-calendar" aria-hidden="true"></i>Peak Sourcing Windows</div>
<div class="mi-seas"><span class="mi-badge tl">Jan–Apr</span><div class="mi-st"><b style="color:#fff">Norwegian salmon peak</b> — highest volume and most competitive FOB pricing on Atlantic salmon fillets and portions. Ideal window for securing annual retail supply contracts.</div></div>
<div class="mi-seas"><span class="mi-badge tl">Apr–Aug</span><div class="mi-st"><b style="color:#fff">South American shrimp season</b> — Ecuador and Peru at peak harvest. Best pricing on vannamei and white shrimp IQF. High container availability Apr–Jun.</div></div>
<div class="mi-seas"><span class="mi-badge bl">Year-round</span><div class="mi-st"><b style="color:#fff">Thailand processed</b> — consistent year-round IQF shrimp, cooked formats and value-added products. Ideal for retail-ready and foodservice pack sizes.</div></div>
<div class="mi-seas"><span class="mi-badge tl">Sep–Feb</span><div class="mi-st"><b style="color:#fff">North Atlantic whitefish peak</b> — Iceland, Norway and Faroe Islands at highest cod and haddock throughput. Lowest annual FOB pricing for bulk fillets and portions.</div></div>
</div>
</div>
</div>
</section>
MIEOT;

$FFINC2_CPT     = 'gd_supplier';
$FFINC2_TAX     = 'gd_suppliercategory';
$FFINC2_KIND    = 'supplier';
$FFINC2_DEFAULT = 'frozen-fruits-vegetables';
$FFINC2_CATS = array(
  'frozen-fruits-vegetables' => array(
    'accent' => '#2ECC9A',
    'icon'   => 'ti ti-leaf',
    'pfield' => 'fruits__veg_products',
    'crumb'  => 'Frozen Fruits &amp; Vegetables',
    'h1'     => 'Frozen <em>Fruits &amp; Vegetables</em> Suppliers',
    'sub'    => 'Source IQF berries, tropical fruits, mixed vegetables and organic produce from verified global producers. Direct contact, zero commission.',
    'stats'  => array(array('42','Countries'),array('1 Pallet','From MOQ'),array('6.2%','Mkt CAGR')),
    'mi'     => $MI_FV,
  ),
  'frozen-poultry' => array(
    'accent' => '#4A9FE0',
    'icon'   => 'ti ti-feather',
    'pfield' => 'poultry_products',
    'crumb'  => 'Frozen Poultry',
    'h1'     => 'Frozen <em>Poultry</em> Suppliers',
    'sub'    => 'Source whole chicken, drumsticks, paws, wings and processed poultry from halal-certified global exporters. Direct contact, zero commission.',
    'stats'  => array(array('55','Countries'),array('1 Container','From MOQ'),array('4.8%','Mkt CAGR')),
    'mi'     => $MI_PO,
  ),
  'frozen-beef-meat' => array(
    'accent' => '#F59E0B',
    'icon'   => 'ti ti-flame',
    'pfield' => 'beef__meat_products',
    'crumb'  => 'Frozen Beef &amp; Meat',
    'h1'     => 'Frozen <em>Beef &amp; Meat</em> Suppliers',
    'sub'    => 'Source prime cuts, ribeye, ground beef, pork and specialty meats from USDA-inspected and halal-certified global exporters. Direct contact, zero commission.',
    'stats'  => array(array('48','Countries'),array('5MT','From MOQ'),array('3.9%','Mkt CAGR')),
    'mi'     => $MI_BM,
  ),
  'frozen-seafood' => array(
    'accent' => '#52DEB5',
    'icon'   => 'ti ti-fish',
    'pfield' => 'seafood_products',
    'crumb'  => 'Frozen Seafood',
    'h1'     => 'Frozen <em>Seafood</em> Suppliers',
    'sub'    => 'Source fish fillets, shrimp, shellfish and processed seafood from MSC-certified and sustainably sourced global suppliers. Direct contact, zero commission.',
    'stats'  => array(array('38','Countries'),array('500kg','From MOQ'),array('5.1%','Mkt CAGR')),
    'mi'     => $MI_SF,
  ),
);

require FFINC2_PATH . 'templates/partials/gd-archive-render.php';
