<?php
/*
Template Name: FFInc 2.0 — Category: Fruits & Veg
*/
get_header();
?>

<!-- ============================================================
     Fruits & Veg category page — page-specific styles only.
     Shared chrome (base reset, page background, nav, category
     sub-nav, badges, filter bar, listings grid card, list row,
     load-more, footer, quote modal) plus their light-mode and
     responsive rules live in assets/css/design-system.css.
     Only this category's accent overrides, hero, market-intel
     and supplier-CTA styling stay here — do not duplicate.
     ============================================================ -->
<style>
.csn-item.on{color:#2ECC9A;border-bottom-color:#2ECC9A}
.chero{position:relative;overflow:hidden;background:linear-gradient(135deg,#050D18 0%,#061A10 50%,#050D18 100%);padding:52px 48px 44px}
.chero-aura{position:absolute;border-radius:50%;filter:blur(70px);pointer-events:none;z-index:0}
.chero-inner{position:relative;z-index:2;max-width:1200px;margin:0 auto}
.ch-bc{display:flex;align-items:center;gap:6px;font-size:11px;color:#6B9DB7;margin-bottom:16px}
.ch-bc i{font-size:10px}
.ch-bc .cur{color:#2ECC9A;font-weight:500}
.ch1{font-family:'Plus Jakarta Sans',system-ui;font-size:48px;font-weight:800;letter-spacing:-1.2px;line-height:1.1;margin-bottom:16px}
.ch1 em{color:#2ECC9A;font-style:normal}
.ch-sub{font-size:17px;color:#9BBFD8;line-height:1.65;max-width:560px;margin-bottom:24px}
.ch-stats{display:inline-flex;background:rgba(18,34,52,.5);border:1px solid rgba(46,204,154,.18);border-radius:14px;overflow:hidden;width:fit-content;margin-bottom:24px;flex-wrap:wrap}
.chs{padding:12px 20px;border-right:1px solid rgba(46,204,154,.12);text-align:left}
.chs:last-child{border-right:none}
.chs-n{font-family:'Plus Jakarta Sans',system-ui;font-size:20px;font-weight:800;color:#2ECC9A;line-height:1.1;display:block}
.chs-l{font-size:10px;color:#9BBFD8;text-transform:uppercase;letter-spacing:.05em;margin-top:3px;display:block}
.ch-acts{display:flex;gap:10px;flex-wrap:wrap}
.ch-btn-p{display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,#2ECC9A,#1DB89A);color:#04342C;border:none;padding:12px 24px;border-radius:10px;font-family:'Inter',system-ui;font-size:13.5px;font-weight:700;cursor:pointer;box-shadow:0 6px 22px rgba(46,204,154,.38);transition:transform .15s,box-shadow .15s}
.ch-btn-p:hover{transform:translateY(-2px);box-shadow:0 9px 28px rgba(46,204,154,.55)}
.ch-btn-s{display:inline-flex;align-items:center;gap:7px;background:transparent;border:1px solid rgba(46,204,154,.3);color:#2ECC9A;padding:12px 22px;border-radius:10px;font-family:'Inter',system-ui;font-size:13.5px;font-weight:500;cursor:pointer;transition:background .2s,border-color .2s}
.ch-btn-s:hover{background:rgba(46,204,154,.08);border-color:rgba(46,204,154,.5)}
.fb-s:focus-within{border-color:rgba(46,204,154,.45)}
.fb-cnt b{color:#2ECC9A;font-weight:600}
.lc::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,rgba(46,204,154,.5),transparent)}
.lc:hover{transform:translateY(-5px);border-color:rgba(46,204,154,.28);box-shadow:0 18px 52px rgba(0,0,0,.45),0 0 36px -16px #2ECC9A}
.lc-logo{width:40px;height:40px;border-radius:10px;background:rgba(46,204,154,.12);border:1px solid rgba(46,204,154,.25);display:flex;align-items:center;justify-content:center;color:#2ECC9A;font-family:'Plus Jakarta Sans',system-ui;font-size:12px;font-weight:700;flex-shrink:0}
.rq-btn{background:linear-gradient(135deg,#2ECC9A,#1DB89A);color:#04342C;border:none;padding:6px 13px;border-radius:7px;font-family:'Inter',system-ui;font-size:10.5px;font-weight:700;cursor:pointer;transition:transform .15s,box-shadow .15s;flex-shrink:0}
.rq-btn:hover{transform:translateY(-1px);box-shadow:0 4px 14px rgba(46,204,154,.4)}
.lrow:hover{border-color:rgba(46,204,154,.28);transform:translateX(3px);box-shadow:0 12px 34px rgba(0,0,0,.4)}
.lm-cnt b{color:#2ECC9A;font-weight:600}
.mi{position:relative;overflow:hidden;background:linear-gradient(180deg,#060F1A,#0A1628);padding:56px 48px 64px}
.mi-aura{position:absolute;border-radius:50%;filter:blur(70px);pointer-events:none;z-index:0}
.mi-inner{position:relative;z-index:2;max-width:1200px;margin:0 auto}
.mi-pill{display:inline-flex;align-items:center;gap:6px;background:rgba(74,159,224,.08);border:1px solid rgba(74,159,224,.2);color:#4A9FE0;font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.08em;padding:5px 12px;border-radius:20px;margin-bottom:14px}
.mi-h{font-family:'Plus Jakarta Sans',system-ui;font-size:32px;font-weight:800;letter-spacing:-.6px;margin-bottom:10px}
.mi-h em{color:#4A9FE0;font-style:normal}
.mi-sub{font-size:14px;color:#9BBFD8;line-height:1.6;max-width:480px;margin-bottom:32px}
.mi-stats{display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:12px;margin-bottom:28px}
.mi-stat{position:relative;background:rgba(18,34,52,.42);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border:1px solid rgba(74,159,224,.1);border-radius:18px;padding:22px 18px;overflow:hidden;transition:border-color .25s,transform .25s}
.mi-stat::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,var(--ac,#4A9FE0),transparent);opacity:.5}
.mi-stat:hover{border-color:rgba(74,159,224,.28);transform:translateY(-4px)}
.mi-n{font-family:'Plus Jakarta Sans',system-ui;font-size:26px;font-weight:800;line-height:1.2;background:linear-gradient(135deg,#fff,#8DCAF2);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;display:block}
.mi-n.tl{background:linear-gradient(135deg,#85ECD0,#2ECC9A);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.mi-nl{font-size:12px;font-weight:500;color:#fff;margin:6px 0 3px;display:block}
.mi-nd{font-size:10.5px;color:#6B9DB7}
.mi-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.mi-box{background:rgba(18,34,52,.4);border:1px solid rgba(74,159,224,.1);border-radius:16px;padding:22px}
.mi-bt{display:flex;align-items:center;gap:8px;font-family:'Plus Jakarta Sans',system-ui;font-size:15px;font-weight:700;margin-bottom:16px}
.mi-bt i{font-size:17px;color:#4A9FE0}
.mi-row{display:flex;align-items:center;gap:12px;padding:11px 0;border-bottom:1px solid rgba(74,159,224,.08)}
.mi-row:last-child{border-bottom:none}
.mi-rank{width:22px;height:22px;border-radius:50%;background:rgba(46,204,154,.12);border:1px solid rgba(46,204,154,.28);color:#2ECC9A;font-family:'Plus Jakarta Sans',system-ui;font-size:11px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.mi-cty{font-size:13px;font-weight:600;color:#fff;flex:1;display:flex;align-items:center}
.mi-flag{margin-right:9px;font-size:16px;line-height:1;flex-shrink:0}
.mi-spec{font-size:11px;color:#6B9DB7;text-align:right}
.mi-dd{margin-top:18px;background:rgba(10,22,40,.5);border:1px solid rgba(74,159,224,.1);border-radius:12px;padding:16px}
.mi-dt{font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.08em;color:#2ECC9A;margin-bottom:12px}
.mi-b{display:flex;gap:9px;margin-bottom:11px;font-size:12px;color:#9BBFD8;line-height:1.55}
.mi-b:last-child{margin-bottom:0}
.mi-b::before{content:'';width:5px;height:5px;border-radius:50%;background:#2ECC9A;flex-shrink:0;margin-top:6px}
.mi-b b{color:#fff;font-weight:600}
.mi-seas{margin-bottom:16px}
.mi-seas:last-child{margin-bottom:0}
.mi-badge{display:inline-flex;align-items:center;font-size:10px;font-weight:700;padding:3px 10px;border-radius:8px;margin-bottom:6px}
.mi-badge.tl{background:rgba(46,204,154,.12);color:#52DEB5;border:1px solid rgba(46,204,154,.3)}
.mi-badge.bl{background:rgba(74,159,224,.12);color:#8DCAF2;border:1px solid rgba(74,159,224,.3)}
.mi-badge.am{background:rgba(245,158,11,.12);color:#F59E0B;border:1px solid rgba(245,158,11,.3)}
.mi-st{font-size:12px;color:#9BBFD8;line-height:1.55}
.scta{position:relative;overflow:hidden;background:linear-gradient(135deg,rgba(46,204,154,.1),rgba(74,159,224,.08));border-top:1px solid rgba(46,204,154,.2);border-bottom:1px solid rgba(46,204,154,.15);padding:40px 48px;display:flex;align-items:center;justify-content:space-between;gap:20px}
.scta-aura{position:absolute;border-radius:50%;filter:blur(70px);pointer-events:none;z-index:0;width:300px;height:300px;background:radial-gradient(circle,rgba(46,204,154,.14),transparent 70%);top:-100px;right:-40px}
.scta-l{position:relative;z-index:2}
.scta-h{font-family:'Plus Jakarta Sans',system-ui;font-size:22px;font-weight:800;margin-bottom:8px}
.scta-sub{font-size:13.5px;color:#9BBFD8;line-height:1.65;max-width:440px}
.scta-btn{position:relative;z-index:2;display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,#2ECC9A,#1DB89A);color:#04342C;border:none;padding:13px 26px;border-radius:12px;font-family:'Inter',system-ui;font-size:14px;font-weight:700;cursor:pointer;box-shadow:0 6px 22px rgba(46,204,154,.36);flex-shrink:0;transition:transform .15s,box-shadow .15s}
.scta-btn:hover{transform:translateY(-2px);box-shadow:0 9px 30px rgba(46,204,154,.55)}
body.light-mode .ls{background:#EEF6FF !important}
body.light-mode .lm{background:#EEF6FF !important}
body.light-mode .ls-lbl{color:#6B9DB7}
body.light-mode .lm-cnt{color:#3A5E75}
body.light-mode .csn-item{color:#3A5E75}
body.light-mode .csn-item:hover{color:#050D18}
body.light-mode .lc-loc,body.light-mode .lr-loc,body.light-mode .lc-sl{color:#6B9DB7}
body.light-mode .lc-sv{color:#050D18}
body.light-mode .mi-nl{color:#050D18 !important}
body.light-mode .mi-cty{color:#050D18}
body.light-mode .mi-bt{color:#050D18}
body.light-mode .mi-sub,body.light-mode .mi-st,body.light-mode .mi-b{color:#3A5E75}
body.light-mode .scta-h{color:#050D18}
body.light-mode .scta-sub{color:#3A5E75}
body.light-mode .chero{background:linear-gradient(135deg,#EEF6FF,#F0FFF8,#EEF6FF) !important}
body.light-mode .mi{background:linear-gradient(180deg,#EEF6FF,#E8F4FF) !important}
body.light-mode .scta{background:linear-gradient(135deg,rgba(46,204,154,.08),rgba(74,159,224,.05)) !important}
body.light-mode .mi-stat{background:rgba(255,255,255,.65) !important;border-color:rgba(74,159,224,.2) !important}
body.light-mode .mi-box{background:rgba(255,255,255,.6) !important;border-color:rgba(74,159,224,.18) !important}
body.light-mode .ch-sub{color:#3A5E75}
body.light-mode .ch1{color:#050D18}
body.light-mode .ch1{color:#050D18 !important}
body.light-mode .ch1 em{color:#0F9B72 !important}
body.light-mode .ch-sub{color:#3A5E75 !important}
body.light-mode .ch-bc{color:#6B9DB7 !important}
body.light-mode .ch-bc .cur{color:#0F9B72 !important}
body.light-mode .chs-l{color:#6B9DB7 !important}
body.light-mode .ch-stats{background:rgba(255,255,255,.72) !important;border-color:rgba(46,204,154,.3) !important}
body.light-mode .chs{border-right-color:rgba(74,159,224,.15) !important}
body.light-mode .chs-n{color:#0F9B72 !important}
body.light-mode .chs-l{color:#3A5E75 !important}
body.light-mode .ch-btn-s{border-color:rgba(15,155,114,.4) !important;color:#0F9B72 !important}
body.light-mode .fb-cnt b{color:#0F9B72 !important}
body.light-mode .fb-s input::placeholder{color:#9BBFD8 !important}
body.light-mode .ls-lbl::after{background:rgba(74,159,224,.2) !important}
body.light-mode .lc-n{color:#050D18 !important}
body.light-mode .lc-loc{color:#6B9DB7 !important}
body.light-mode .lc-stats{background:rgba(238,246,255,.8) !important;border-color:rgba(74,159,224,.18) !important}
body.light-mode .lc-stat + .lc-stat{border-left-color:rgba(74,159,224,.18) !important}
body.light-mode .lr-name{color:#050D18 !important}
body.light-mode .lr-loc{color:#6B9DB7 !important}
body.light-mode .lr-stats{background:rgba(238,246,255,.8) !important;border-color:rgba(74,159,224,.18) !important}
body.light-mode .lr-stat + .lr-stat{border-left-color:rgba(74,159,224,.18) !important}
body.light-mode .mi-stat{background:rgba(255,255,255,.85) !important;border-color:rgba(74,159,224,.2) !important;box-shadow:0 4px 20px rgba(74,159,224,.08) !important}
body.light-mode .mi-n{background:linear-gradient(135deg,#050D18,#1E6BAB) !important;-webkit-background-clip:text !important;background-clip:text !important;-webkit-text-fill-color:transparent !important}
body.light-mode .mi-n.tl{background:linear-gradient(135deg,#0F9B72,#2ECC9A) !important;-webkit-background-clip:text !important;background-clip:text !important;-webkit-text-fill-color:transparent !important}
body.light-mode .mi-nl{color:#050D18 !important}
body.light-mode .mi-nd{color:#6B9DB7 !important}
body.light-mode .mi-box{background:rgba(255,255,255,.78) !important;border-color:rgba(74,159,224,.18) !important}
body.light-mode .mi-bt{color:#050D18 !important}
body.light-mode .mi-cty{color:#050D18 !important}
body.light-mode .mi-spec{color:#6B9DB7 !important}
body.light-mode .mi-rank{background:rgba(74,159,224,.12) !important;border-color:rgba(74,159,224,.25) !important;color:#1E6BAB !important}
body.light-mode .mi-row{border-bottom-color:rgba(74,159,224,.12) !important}
body.light-mode .mi-st{color:#3A5E75 !important}
body.light-mode .mi-st b{color:#050D18 !important}
body.light-mode .mi-seas{border-bottom-color:rgba(74,159,224,.12) !important}
body.light-mode .mi-dd{background:rgba(238,246,255,.85) !important;border-color:rgba(74,159,224,.15) !important}
body.light-mode .mi-dt{color:#1E6BAB !important}
body.light-mode .mi-b{color:#3A5E75 !important}
body.light-mode .mi-b b{color:#050D18 !important}
body.light-mode .mi-sub{color:#3A5E75 !important}
body.light-mode .mi-h{color:#050D18 !important}
body.light-mode .mi-h em{color:#1E6BAB !important}
body.light-mode .scta-h{color:#050D18 !important}
body.light-mode .scta-sub{color:#3A5E75 !important}
body.light-mode .csn-item.on{color:#0F9B72 !important;border-bottom-color:#0F9B72 !important}
@media (max-width: 768px){
  .csn{overflow-x: auto; padding: 0 16px;}
  .csn-item{padding: 10px 12px; font-size: 11px;}
  .chero{padding: 36px 20px 30px;}
  .chero{padding-top: 52px !important;}
  .chero-inner{padding-top: 8px;}
  .ch1{font-size: 26px;}
  .ch-sub{font-size: 13px;}
  .ch-stats{flex-wrap: wrap;}
  .chs{flex: 1 1 45%;}
  .fb{padding: 10px 16px;}
  .fb-in{flex-wrap: wrap;}
  .fb-s{min-width: 100%; order: -1;}
  .fb-r{margin-left: 0; width: 100%; justify-content: space-between;}
  .ls{padding: 20px 16px;}
  #grid-view{grid-template-columns: 1fr 1fr;}
  .mi{padding: 40px 20px 48px;}
  .mi-stats{grid-template-columns: 1fr 1fr;}
  .mi-grid{grid-template-columns: 1fr;}
  .scta{flex-direction: column; padding: 28px 20px; text-align: center;}
  .scta-sub{max-width: 100%;}
}
@media (max-width: 480px){
  #grid-view{grid-template-columns: 1fr;}
  .mi-stats{grid-template-columns: 1fr 1fr;}
  .ch1{font-size: 22px;}
  .chero{padding-top: 44px !important;}
  .chero-inner{padding-top: 12px;}
}
@media (max-width: 768px){
  .lrow{flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    padding: 14px 16px;}
  .lr-top{display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;}
  .lr-main{flex: 1;
    min-width: 0;}
  .lr-name{font-size: 13px;
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;}
  .lr-loc{font-size: 11px;
    margin-top: 2px;}
  .lr-tags{display: flex;
    flex-wrap: wrap;
    gap: 4px;
    width: 100%;}
  .lr-stats{display: flex;
    width: 100%;
    gap: 0;
    background: rgba(10,22,40,.5);
    border: 1px solid rgba(74,159,224,.1);
    border-radius: 8px;
    overflow: hidden;}
  .lr-stat{flex: 1;
    padding: 7px 6px;
    text-align: center;
    border-right: 1px solid rgba(74,159,224,.1);}
  .lr-stat:last-child{border-right: none;}
  .lr-certs{display: flex;
    flex-wrap: wrap;
    gap: 4px;
    width: 100%;}
  .lr-right{display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding-top: 8px;
    border-top: 1px solid rgba(74,159,224,.08);
    gap: 8px;}
  .bdg-v{flex-shrink: 0;}
  .lc-rate{flex: 1;
    font-size: 11px;}
  .rq-btn{flex-shrink: 0;
    white-space: nowrap;
    font-size: 10.5px;
    padding: 7px 12px;}
}
@media (max-width: 480px){
  .lrow{padding: 12px 14px;}
  .lr-name{font-size: 12.5px;}
  .lr-right{flex-wrap: wrap;
    gap: 6px;}
  .rq-btn{width: 100%;
    text-align: center;
    justify-content: center;
    display: flex;
    padding: 9px 12px;}
}
@media (max-width: 768px){
  .lc-foot{flex-direction: column;
    align-items: flex-start;
    gap: 8px;
    padding-top: 10px;}
  .rq-btn{width: 100%;
    text-align: center;
    justify-content: center;
    display: flex;
    padding: 9px 12px;
    font-size: 11px;}
  .lc-rate{font-size: 11px;
    width: 100%;}
}
@media (max-width: 480px){
  .lc-foot{gap: 6px;}
  .rq-btn{padding: 10px 12px;
    font-size: 11.5px;}
}
</style>

<div class="pg-grid"></div>
<div class="pg-aura" id="pa1" style="width:700px;height:700px;background:radial-gradient(circle,rgba(74,159,224,.22),transparent 65%);top:-260px;left:-200px"></div>
<div class="pg-aura" id="pa2" style="width:600px;height:600px;background:radial-gradient(circle,rgba(46,204,154,.14),transparent 65%);top:-120px;right:-180px"></div>
<div class="pg-aura" id="pa3" style="width:500px;height:500px;background:radial-gradient(circle,rgba(74,159,224,.1),transparent 65%);bottom:-150px;left:35%"></div>
<canvas id="pg-canvas" aria-hidden="true"></canvas>



<!-- SECTION 1 — Category sub-nav -->
<div class="csn" aria-label="Category navigation">
<div class="csn-inner">
<a class="csn-item on" href="category-fruits-veg.html"><i class="ti ti-leaf" aria-hidden="true"></i>Fruits &amp; Veg</a>
<span class="csn-sep"></span>
<a class="csn-item" href="#"><i class="ti ti-feather" aria-hidden="true"></i>Poultry</a>
<span class="csn-sep"></span>
<a class="csn-item" href="#"><i class="ti ti-flame" aria-hidden="true"></i>Beef &amp; Meat</a>
<span class="csn-sep"></span>
<a class="csn-item" href="#"><i class="ti ti-fish" aria-hidden="true"></i>Seafood</a>
<span class="csn-sep"></span>
<a class="csn-item" href="#"><i class="ti ti-truck" aria-hidden="true"></i>Services</a>
</div>
</div>

<!-- SECTION 2 — Category hero -->
<section class="chero" aria-label="Category hero">
<div class="chero-aura" style="width:400px;height:400px;background:radial-gradient(circle,rgba(46,204,154,.18),transparent 70%);top:-120px;right:-80px"></div>
<div class="chero-aura" style="width:300px;height:300px;background:radial-gradient(circle,rgba(74,159,224,.1),transparent 70%);bottom:-60px;left:-60px"></div>
<div class="chero-inner">
<div class="ch-bc" id="ch-bc"><a href="index.html" style="color:#6B9DB7;text-decoration:none">Database</a><i class="ti ti-chevron-right" aria-hidden="true"></i><span class="cur">Frozen Fruits &amp; Vegetables</span></div>
<h1 class="ch1" id="ch-h1">Frozen <em>Fruits &amp; Vegetables</em> Suppliers</h1>
<p class="ch-sub" id="ch-sub">Source IQF berries, tropical fruits, mixed vegetables and organic produce from verified global producers. Direct contact, zero commission.</p>
<div class="ch-stats" id="ch-stats">
<div class="chs"><span class="chs-n">180+</span><span class="chs-l">Suppliers</span></div>
<div class="chs"><span class="chs-n">42</span><span class="chs-l">Countries</span></div>
<div class="chs"><span class="chs-n">1 Pallet</span><span class="chs-l">From MOQ</span></div>
<div class="chs"><span class="chs-n">6.2%</span><span class="chs-l">Mkt CAGR</span></div>
</div>
<div class="ch-acts" id="ch-acts">
<button class="ch-btn-p" data-quote data-name="GlobalFresh Produce Ltd" data-initials="GF" data-loc="Netherlands"><i class="ti ti-message-circle" aria-hidden="true"></i>Request a Quote</button>
<button class="ch-btn-s">Browse all suppliers</button>
</div>
</div>
</section>

<!-- SECTION 3 — Filter bar -->
<div class="fb" aria-label="Filters">
<div class="fb-in">
<label class="fb-s"><i class="ti ti-search" aria-hidden="true"></i><input type="text" placeholder="Search suppliers, products, origins..." aria-label="Search suppliers"></label>
<select class="fb-sel" aria-label="Product Type">
<option>All Products</option><option>IQF Berries</option><option>Tropical Fruits</option><option>Mixed Vegetables</option><option>Organic Produce</option><option>Leafy Greens</option><option>Exotic Fruits</option>
</select>
<select class="fb-sel" aria-label="Certification">
<option>All Certifications</option><option>Organic EU</option><option>GlobalGAP</option><option>USDA Organic</option><option>BRC Grade A</option><option>IFS Food</option><option>Rainforest Alliance</option><option>HACCP</option>
</select>
<select class="fb-sel" aria-label="MOQ Range">
<option>All MOQ</option><option>Less than 1T</option><option>1T – 5T</option><option>5T – 20T</option><option>20T+</option>
</select>
<div class="fb-r">
<span class="fb-cnt">Showing 9 of <b>180+</b> suppliers</span>
<div class="tog">
<button class="tog-b on" id="tog-grid" aria-label="Grid view"><i class="ti ti-layout-grid" aria-hidden="true"></i></button>
<button class="tog-b" id="tog-list" aria-label="List view"><i class="ti ti-list" aria-hidden="true"></i></button>
</div>
</div>
</div>
</div>

<!-- SECTION 4 — Supplier listings -->
<section class="ls" aria-label="Supplier listings">
<div class="ls-inner">
<div class="ls-lbl" id="ls-lbl">180+ verified suppliers · Grid view</div>
<div id="grid-view"></div>
<div id="list-view"></div>
</div>
</section>

<!-- SECTION 5 — Load more -->
<div class="lm">
<div class="lm-cnt">Showing 9 of <b>180+</b> verified Frozen Fruits &amp; Vegetables suppliers</div>
<button class="lm-btn"><i class="ti ti-refresh" aria-hidden="true"></i>Load More Suppliers</button>
</div>

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

<!-- SECTION 8 — Supplier CTA banner -->
<section class="scta" aria-label="Supplier call to action">
<div class="scta-aura"></div>
<div class="scta-l">
<div class="scta-h">Are you a Frozen Fruits &amp; Veg supplier?</div>
<div class="scta-sub">List your business for free and start receiving direct quote requests from wholesale buyers actively sourcing in this category. Zero commission on every deal closed through FFInc.</div>
</div>
<button class="scta-btn"><i class="ti ti-plus" aria-hidden="true"></i>Create Free Listing</button>
</section>

<!-- SECTION 9 — Footer -->


<!-- SECTION 7 — Quote request modal -->
<div class="qm-ov" id="qm-ov" aria-hidden="true">
<div class="qm" id="qm-card" role="dialog" aria-modal="true" aria-label="Request a quote">
<button class="qm-x" id="qm-x" aria-label="Close"><i class="ti ti-x" aria-hidden="true"></i></button>
<div class="qm-sup">
<div class="qm-logo" id="qm-logo">GF</div>
<div><div class="qm-sn" id="qm-sn">GlobalFresh Produce Ltd</div><div class="qm-sl"><i class="ti ti-map-pin" aria-hidden="true"></i><span id="qm-sl">Netherlands</span></div></div>
</div>
<div class="qm-h">Request a Quote</div>
<div class="qm-sub">Complete the form below — the supplier will respond directly to your email. FFInc charges zero commission.</div>
<form id="qm-form" onsubmit="return false">
<div class="qm-grid">
<div class="qm-f"><label class="qm-lb">Your Name</label><input class="qm-in" type="text" placeholder="Jane Doe"></div>
<div class="qm-f"><label class="qm-lb">Company Name</label><input class="qm-in" type="text" placeholder="Acme Foods Ltd"></div>
<div class="qm-f"><label class="qm-lb">Email Address</label><input class="qm-in" type="email" placeholder="you@company.com"></div>
<div class="qm-f"><label class="qm-lb">Country</label><input class="qm-in" type="text" placeholder="United Kingdom"></div>
<div class="qm-f"><label class="qm-lb">Product Required</label><select class="qm-se"><option>IQF Berries</option><option>Tropical Fruits</option><option>Mixed Vegetables</option><option>Organic Produce</option><option>Leafy Greens</option><option>Exotic Fruits</option><option>Other</option></select></div>
<div class="qm-f"><label class="qm-lb">Quantity / MOQ Required</label><input class="qm-in" type="text" placeholder="e.g. 5 Metric Tonnes"></div>
<div class="qm-f"><label class="qm-lb">Delivery Terms</label><select class="qm-se"><option>FOB</option><option>CIF</option><option>DDP</option><option>EXW</option></select></div>
<div class="qm-f"><label class="qm-lb">Target Price per MT</label><input class="qm-in" type="text" placeholder="e.g. $1,200/MT"></div>
<div class="qm-f full"><label class="qm-lb">Additional Requirements</label><textarea class="qm-ta" rows="4" placeholder="Certifications needed, packaging specs, delivery timeline, labelling requirements..."></textarea></div>
</div>
<button class="qm-sub-btn" type="submit"><i class="ti ti-send" aria-hidden="true"></i>Send Quote Request</button>
<div class="qm-priv">Your details are sent directly to the supplier. FrozenFoodInc does not store quote request data or charge any commission.</div>
</form>
</div>
</div>

<?php get_footer(); ?>

<!-- ============================================================
     Fruits & Veg category page — page-specific JavaScript.
     Shared behaviour (particle canvas, aurora drift, footer dot
     pulse, dark/light toggle) lives in assets/js/main.js.
     GSAP is already enqueued by the plugin before this runs.
     ============================================================ -->
<script>
(function(){
var SUPPLIERS=[
{i:'GF',n:'GlobalFresh Produce Ltd',c:'Netherlands',y:2008,feat:true,tags:['IQF Berries','Tropical Fruits','Organic'],moq:'1 Pallet',ctry:'38',resp:'<24h',certs:['GlobalGAP','Organic EU','IQF Certified'],rate:'4.9',rev:12,stars:5},
{i:'PC',n:'Pacific Produce Co',c:'Chile',y:2005,feat:false,tags:['Blueberries','Raspberries','Cranberries'],moq:'2T',ctry:'28',resp:'<8h',certs:['GlobalGAP','BRC Grade A'],rate:'4.9',rev:31,stars:5},
{i:'AO',n:'Andean Organic Farms',c:'Peru',y:2010,feat:false,tags:['Organic Berries','Mango','Superfoods'],moq:'1T',ctry:'22',resp:'<12h',certs:['USDA Organic','Organic EU'],rate:'4.7',rev:18,stars:4},
{i:'SH',n:'SunHarvest Export',c:'Spain',y:2003,feat:false,tags:['Mixed Veg','Leafy Greens','Artichokes'],moq:'5T',ctry:'35',resp:'<6h',certs:['GlobalGAP','IFS Food'],rate:'4.8',rev:24,stars:5},
{i:'PF',n:'PolFrost Trading',c:'Poland',y:1999,feat:false,tags:['IQF Mixed Veg','Broccoli','Cauliflower'],moq:'3T',ctry:'30',resp:'<12h',certs:['BRC','EU Organic'],rate:'4.8',rev:19,stars:5},
{i:'MF',n:'MoroccoFresh Export',c:'Morocco',y:2011,feat:false,tags:['Strawberries','Peas','Green Beans'],moq:'2T',ctry:'18',resp:'<24h',certs:['GlobalGAP','IFS'],rate:'4.6',rev:11,stars:4},
{i:'EA',n:'EastAfrica Agri Export',c:'Kenya',y:2008,feat:false,tags:['Mango','Passion Fruit','Pineapple'],moq:'1T',ctry:'20',resp:'<18h',certs:['Organic EU','Rainforest Alliance'],rate:'4.7',rev:15,stars:4},
{i:'EV',n:'EuroVeg Exports',c:'Belgium',y:2001,feat:false,tags:['Brussels Sprouts','Spinach','Kale'],moq:'5T',ctry:'42',resp:'<6h',certs:['BRC Grade A','GlobalGAP'],rate:'4.6',rev:22,stars:4},
{i:'TF',n:'TropicsFresh Ltd',c:'Costa Rica',y:2013,feat:false,tags:['Tropical Mix','Papaya','Pineapple'],moq:'2T',ctry:'25',resp:'<12h',certs:['Rainforest Alliance','GlobalGAP'],rate:'4.8',rev:16,stars:5}
];
function esc(s){return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');}
function stars(n){return '★★★★★☆☆☆☆☆'.slice(5-n,10-n);}
function badges(s){var h='';if(s.feat)h+='<span class="bdg bdg-f"><i class="ti ti-star" style="font-size:9px" aria-hidden="true"></i>Featured</span>';h+='<span class="bdg bdg-v"><i class="ti ti-circle-check" style="font-size:9px" aria-hidden="true"></i>Verified</span>';return h;}
function tagHtml(s,cls){return s.tags.map(function(t){return '<span class="'+cls+'">'+esc(t)+'</span>';}).join('');}
function certHtml(s,cls){return s.certs.map(function(c){return '<span class="'+cls+'">'+esc(c)+'</span>';}).join('');}
function qattr(s){return 'data-quote data-name="'+esc(s.n)+'" data-initials="'+s.i+'" data-loc="'+esc(s.c)+'"';}

function gridCard(s){
return '<div class="lc">'
+'<div class="lc-head"><div class="lc-logo">'+s.i+'</div>'
+'<div class="lc-ng"><div class="lc-n" title="'+esc(s.n)+'">'+esc(s.n)+'</div><div class="lc-loc"><i class="ti ti-map-pin" aria-hidden="true"></i>'+esc(s.c)+' · Est. '+s.y+'</div></div>'
+'<div class="lc-bdgs">'+badges(s)+'</div></div>'
+'<div class="lc-tags">'+tagHtml(s,'lc-tag')+'</div>'
+'<div class="lc-stats"><div class="lc-stat"><span class="lc-sv">'+esc(s.moq)+'</span><span class="lc-sl">Min. Order</span></div><div class="lc-stat"><span class="lc-sv">'+s.ctry+'</span><span class="lc-sl">Countries</span></div><div class="lc-stat"><span class="lc-sv">'+esc(s.resp)+'</span><span class="lc-sl">Response</span></div></div>'
+'<div class="lc-certs">'+certHtml(s,'lc-cert')+'</div>'
+'<div class="lc-foot"><div class="lc-rate">'+stars(s.stars)+' <span>'+s.rate+' · '+s.rev+' reviews</span></div><button class="rq-btn" '+qattr(s)+'>Request Quote</button></div>'
+'</div>';
}
function listRow(s){
return '<div class="lrow">'
+'<div class="lc-logo">'+s.i+'</div>'
+'<div class="lr-main"><div class="lr-top"><span class="lr-name">'+esc(s.n)+'</span><span class="lr-loc"><i class="ti ti-map-pin" aria-hidden="true"></i>'+esc(s.c)+' · Est. '+s.y+'</span></div><div class="lr-tags">'+tagHtml(s,'lc-tag')+'</div></div>'
+'<div class="lr-stats"><div class="lr-stat"><span class="lc-sv">'+esc(s.moq)+'</span><span class="lc-sl">MOQ</span></div><div class="lr-stat"><span class="lc-sv">'+s.ctry+'</span><span class="lc-sl">Countries</span></div><div class="lr-stat"><span class="lc-sv">'+esc(s.resp)+'</span><span class="lc-sl">Response</span></div></div>'
+'<div class="lr-certs">'+certHtml(s,'lc-cert')+'</div>'
+'<div class="lr-right"><span class="bdg bdg-v"><i class="ti ti-circle-check" style="font-size:9px" aria-hidden="true"></i>Verified</span><div class="lc-rate">'+stars(s.stars)+' <span>'+s.rate+'</span></div><button class="rq-btn" '+qattr(s)+'>Request Quote</button></div>'
+'</div>';
}
document.getElementById('grid-view').innerHTML=SUPPLIERS.map(gridCard).join('');
document.getElementById('list-view').innerHTML=SUPPLIERS.map(listRow).join('');

/* ── Grid/List toggle ── */
var gv=document.getElementById('grid-view'),lv=document.getElementById('list-view'),
    tg=document.getElementById('tog-grid'),tl=document.getElementById('tog-list'),lbl=document.getElementById('ls-lbl');
tg.addEventListener('click',function(){gv.style.display='grid';lv.style.display='none';tg.classList.add('on');tl.classList.remove('on');lbl.textContent='180+ verified suppliers · Grid view';});
tl.addEventListener('click',function(){gv.style.display='none';lv.style.display='flex';tl.classList.add('on');tg.classList.remove('on');lbl.textContent='180+ verified suppliers · List view';});

/* ── Quote modal ── */
var ov=document.getElementById('qm-ov'),card=document.getElementById('qm-card');
function openModal(name,initials,loc){
  document.getElementById('qm-sn').textContent=name||'GlobalFresh Produce Ltd';
  document.getElementById('qm-logo').textContent=initials||'GF';
  document.getElementById('qm-sl').textContent=loc||'Netherlands';
  ov.classList.add('open');ov.setAttribute('aria-hidden','false');
  gsap.fromTo(ov,{opacity:0},{opacity:1,duration:.25,ease:'power2.out'});
  gsap.fromTo(card,{scale:.94,opacity:0},{scale:1,opacity:1,duration:.35,ease:'back.out(1.4)'});
}
function closeModal(){
  gsap.to(card,{scale:.94,opacity:0,duration:.2,ease:'power2.in'});
  gsap.to(ov,{opacity:0,duration:.25,delay:.05,ease:'power2.in',onComplete:function(){ov.classList.remove('open');ov.setAttribute('aria-hidden','true');}});
}
document.addEventListener('click',function(e){
  var t=e.target.closest('[data-quote]');
  if(t){openModal(t.getAttribute('data-name'),t.getAttribute('data-initials'),t.getAttribute('data-loc'));return;}
});
document.getElementById('qm-x').addEventListener('click',closeModal);
ov.addEventListener('click',function(e){if(e.target===ov)closeModal();});
document.addEventListener('keydown',function(e){if(e.key==='Escape'&&ov.classList.contains('open'))closeModal();});

/* ── Hero entrance timeline ── */
var htl=gsap.timeline({defaults:{ease:'power3.out'}});
htl.fromTo('#ch-bc',{y:20,opacity:0},{y:0,opacity:1,duration:.6})
   .fromTo('#ch-h1',{y:30,opacity:0},{y:0,opacity:1,duration:.7},'-=.5')
   .fromTo('#ch-sub',{y:24,opacity:0},{y:0,opacity:1,duration:.65},'-=.5')
   .fromTo('#ch-stats',{y:20,opacity:0},{y:0,opacity:1,duration:.6},'-=.45')
   .fromTo('#ch-acts',{y:18,opacity:0},{y:0,opacity:1,duration:.55},'-=.4');

/* ── IntersectionObserver helper ── */
function io(sel,fn,thresh){
  var obs=new IntersectionObserver(function(entries){entries.forEach(function(e){if(e.isIntersecting){fn(e.target);obs.unobserve(e.target);}});},{threshold:thresh||.12});
  document.querySelectorAll(sel).forEach(function(el){obs.observe(el);});
}
/* Listings animate in */
io('.ls',function(){
  gsap.fromTo('#grid-view .lc, #list-view .lrow',{opacity:0,y:30,scale:.97},{opacity:1,y:0,scale:1,duration:.65,stagger:.06,ease:'power3.out'});
},.05);
/* Market intel animate in */
io('#mi-sec',function(){
  gsap.fromTo('.mi-stat',{opacity:0,y:28,scale:.97},{opacity:1,y:0,scale:1,duration:.6,stagger:.1,ease:'power3.out'});
  gsap.fromTo(['#mi-left','#mi-right'],{opacity:0,y:30},{opacity:1,y:0,duration:.7,stagger:.15,ease:'power3.out',delay:.25});
},.1);
})();
</script>
