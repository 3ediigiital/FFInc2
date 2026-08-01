<?php
/*
Template Name: FFInc 2.0 — Category: Seafood
*/
get_header();
?>

<!-- ============================================================
     Seafood category page — page-specific styles only.
     Shared chrome (base reset, page background, nav, category
     sub-nav, badges, filter bar, listings grid card, list row,
     load-more, footer, quote modal) plus their light-mode and
     responsive rules live in assets/css/design-system.css.
     Only this category's accent overrides, hero, market-intel
     and supplier-CTA styling stay here — do not duplicate.
     ============================================================ -->
<style>
.csn{position:sticky;top:66px;z-index:90;background:rgba(6,15,26,.96);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border-bottom:1px solid rgba(82,222,181,.1);display:flex;align-items:center;justify-content:center;padding:0 48px}
.csn-item:hover{color:#fff;border-bottom-color:rgba(82,222,181,.3)}
.csn-item.on{color:#52DEB5;border-bottom-color:#52DEB5}
.csn-sep{width:1px;height:18px;background:rgba(82,222,181,.12);flex-shrink:0}
.chero{position:relative;overflow:hidden;background:linear-gradient(135deg,#050D18,#061A14,#050D18);padding:52px 48px 44px}
.chero-aura{position:absolute;border-radius:50%;filter:blur(70px);pointer-events:none;z-index:0}
.chero-inner{position:relative;z-index:2;max-width:1200px;margin:0 auto}
.ch-bc{display:flex;align-items:center;gap:6px;font-size:11px;color:#6B9DB7;margin-bottom:16px}
.ch-bc i{font-size:10px}
.ch-bc .cur{color:#52DEB5;font-weight:500}
.ch1{font-family:'Plus Jakarta Sans',system-ui;font-size:48px;font-weight:800;letter-spacing:-1.2px;line-height:1.1;margin-bottom:16px}
.ch1 em{color:#52DEB5;font-style:normal}
.ch-sub{font-size:17px;color:#9BBFD8;line-height:1.65;max-width:560px;margin-bottom:24px}
.ch-stats{display:inline-flex;background:rgba(18,34,52,.5);border:1px solid rgba(82,222,181,.18);border-radius:14px;overflow:hidden;width:fit-content;margin-bottom:24px;flex-wrap:wrap}
.chs{padding:12px 20px;border-right:1px solid rgba(82,222,181,.12);text-align:left}
.chs:last-child{border-right:none}
.chs-n{font-family:'Plus Jakarta Sans',system-ui;font-size:20px;font-weight:800;color:#52DEB5;line-height:1.1;display:block}
.chs-l{font-size:10px;color:#9BBFD8;text-transform:uppercase;letter-spacing:.05em;margin-top:3px;display:block}
.ch-acts{display:flex;gap:10px;flex-wrap:wrap}
.ch-btn-p{display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,#52DEB5,#2ECC9A);color:#04342C;border:none;padding:12px 24px;border-radius:10px;font-family:'Inter',system-ui;font-size:13.5px;font-weight:700;cursor:pointer;box-shadow:0 6px 22px rgba(82,222,181,.38);transition:transform .15s,box-shadow .15s}
.ch-btn-p:hover{transform:translateY(-2px);box-shadow:0 9px 28px rgba(82,222,181,.55)}
.ch-btn-s{display:inline-flex;align-items:center;gap:7px;background:transparent;border:1px solid rgba(82,222,181,.3);color:#52DEB5;padding:12px 22px;border-radius:10px;font-family:'Inter',system-ui;font-size:13.5px;font-weight:500;cursor:pointer;transition:background .2s,border-color .2s}
.ch-btn-s:hover{background:rgba(82,222,181,.08);border-color:rgba(82,222,181,.5)}
.fb{position:sticky;top:110px;z-index:80;background:rgba(8,18,32,.96);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border-bottom:1px solid rgba(82,222,181,.12);padding:12px 48px}
.fb-s{flex:1;min-width:200px;display:flex;align-items:center;gap:8px;background:rgba(18,34,52,.8);border:1px solid rgba(82,222,181,.18);border-radius:10px;padding:9px 14px;transition:border-color .2s}
.fb-s:focus-within{border-color:rgba(82,222,181,.45)}
.fb-sel{background:rgba(18,34,52,.8);border:1px solid rgba(82,222,181,.18);color:#9BBFD8;padding:9px 12px;border-radius:10px;font-size:12px;font-family:'Inter',system-ui;min-width:140px;outline:none;cursor:pointer}
.fb-cnt b{color:#52DEB5;font-weight:600}
.tog{display:flex;background:rgba(18,34,52,.8);border:1px solid rgba(82,222,181,.18);border-radius:10px;overflow:hidden}
.tog-b.on{background:rgba(82,222,181,.2);color:#52DEB5}
.ls-lbl::after{content:'';flex:1;height:1px;background:linear-gradient(90deg,rgba(82,222,181,.15),transparent)}
.lc{position:relative;background:rgba(18,34,52,.48);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border:1px solid rgba(82,222,181,.1);border-radius:18px;padding:20px;overflow:hidden;cursor:pointer;transition:transform .28s cubic-bezier(.34,1.3,.64,1),border-color .25s,box-shadow .28s}
.lc::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,rgba(82,222,181,.5),transparent)}
.lc:hover{transform:translateY(-5px);border-color:rgba(82,222,181,.28);box-shadow:0 18px 52px rgba(0,0,0,.45),0 0 36px -16px #52DEB5}
.lc-logo{width:40px;height:40px;border-radius:10px;background:rgba(82,222,181,.12);border:1px solid rgba(82,222,181,.25);display:flex;align-items:center;justify-content:center;color:#52DEB5;font-family:'Plus Jakarta Sans',system-ui;font-size:12px;font-weight:700;flex-shrink:0}
.bdg-f{background:rgba(82,222,181,.12);color:#52DEB5;border:1px solid rgba(82,222,181,.28)}
.bdg-v{background:rgba(82,222,181,.1);color:#52DEB5;border:1px solid rgba(82,222,181,.25)}
.lc-tag{background:rgba(26,48,72,.8);border:1px solid rgba(82,222,181,.12);color:#9BBFD8;font-size:9.5px;padding:2px 7px;border-radius:5px}
.lc-stats{display:flex;background:rgba(10,22,40,.5);border:1px solid rgba(82,222,181,.1);border-radius:9px;overflow:hidden;margin-bottom:10px}
.lc-stat{flex:1;padding:8px 6px;text-align:center;border-left:1px solid rgba(82,222,181,.1)}
.lc-cert{background:rgba(82,222,181,.08);border:1px solid rgba(82,222,181,.14);color:#8DCAF2;font-size:9px;padding:2px 6px;border-radius:4px}
.lc-foot{display:flex;align-items:center;justify-content:space-between;border-top:1px solid rgba(82,222,181,.08);padding-top:10px}
.rq-btn{background:linear-gradient(135deg,#52DEB5,#2ECC9A);color:#04342C;border:none;padding:6px 13px;border-radius:7px;font-family:'Inter',system-ui;font-size:10.5px;font-weight:700;cursor:pointer;transition:transform .15s,box-shadow .15s;flex-shrink:0}
.rq-btn:hover{transform:translateY(-1px);box-shadow:0 4px 14px rgba(82,222,181,.4)}
.lrow{display:flex;align-items:center;gap:16px;background:rgba(18,34,52,.48);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border:1px solid rgba(82,222,181,.1);border-radius:14px;padding:16px 22px;cursor:pointer;transition:transform .25s cubic-bezier(.34,1.3,.64,1),border-color .25s,box-shadow .25s}
.lrow:hover{border-color:rgba(82,222,181,.28);transform:translateX(3px);box-shadow:0 12px 34px rgba(0,0,0,.4)}
.lr-stats{display:flex;gap:0;background:rgba(10,22,40,.5);border:1px solid rgba(82,222,181,.1);border-radius:9px;overflow:hidden;flex-shrink:0}
.lr-stat{padding:6px 14px;text-align:center;border-left:1px solid rgba(82,222,181,.1)}
.lm{background:#050D18;border-top:1px solid rgba(82,222,181,.08);padding:20px 48px 28px;text-align:center;position:relative;z-index:2}
.lm-cnt b{color:#52DEB5;font-weight:600}
.lm-btn{display:inline-flex;align-items:center;gap:8px;background:transparent;border:1px solid rgba(82,222,181,.28);color:#8DCAF2;padding:11px 32px;border-radius:10px;font-family:'Inter',system-ui;font-size:13px;font-weight:500;cursor:pointer;transition:all .2s}
.lm-btn:hover{background:rgba(82,222,181,.08);border-color:rgba(82,222,181,.5);color:#fff}
.mi{position:relative;overflow:hidden;background:linear-gradient(180deg,#060F1A,#0A1628);padding:56px 48px 64px}
.mi-aura{position:absolute;border-radius:50%;filter:blur(70px);pointer-events:none;z-index:0}
.mi-inner{position:relative;z-index:2;max-width:1200px;margin:0 auto}
.mi-pill{display:inline-flex;align-items:center;gap:6px;background:rgba(82,222,181,.08);border:1px solid rgba(82,222,181,.2);color:#52DEB5;font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.08em;padding:5px 12px;border-radius:20px;margin-bottom:14px}
.mi-h{font-family:'Plus Jakarta Sans',system-ui;font-size:32px;font-weight:800;letter-spacing:-.6px;margin-bottom:10px}
.mi-h em{color:#52DEB5;font-style:normal}
.mi-sub{font-size:14px;color:#9BBFD8;line-height:1.6;max-width:480px;margin-bottom:32px}
.mi-stats{display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:12px;margin-bottom:28px}
.mi-stat{position:relative;background:rgba(18,34,52,.42);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border:1px solid rgba(82,222,181,.1);border-radius:18px;padding:22px 18px;overflow:hidden;transition:border-color .25s,transform .25s}
.mi-stat::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,var(--ac,#52DEB5),transparent);opacity:.5}
.mi-stat:hover{border-color:rgba(82,222,181,.28);transform:translateY(-4px)}
.mi-n{font-family:'Plus Jakarta Sans',system-ui;font-size:26px;font-weight:800;line-height:1.2;background:linear-gradient(135deg,#fff,#8DCAF2);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;display:block}
.mi-n.tl{background:linear-gradient(135deg,#85ECD0,#52DEB5);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.mi-nl{font-size:12px;font-weight:500;color:#fff;margin:6px 0 3px;display:block}
.mi-nd{font-size:10.5px;color:#6B9DB7}
.mi-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.mi-box{background:rgba(18,34,52,.4);border:1px solid rgba(82,222,181,.1);border-radius:16px;padding:22px}
.mi-bt{display:flex;align-items:center;gap:8px;font-family:'Plus Jakarta Sans',system-ui;font-size:15px;font-weight:700;margin-bottom:16px}
.mi-bt i{font-size:17px;color:#52DEB5}
.mi-row{display:flex;align-items:center;gap:12px;padding:11px 0;border-bottom:1px solid rgba(82,222,181,.08)}
.mi-row:last-child{border-bottom:none}
.mi-rank{width:22px;height:22px;border-radius:50%;background:rgba(82,222,181,.12);border:1px solid rgba(82,222,181,.28);color:#52DEB5;font-family:'Plus Jakarta Sans',system-ui;font-size:11px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.mi-cty{font-size:13px;font-weight:600;color:#fff;flex:1;display:flex;align-items:center}
.mi-flag{margin-right:9px;font-size:16px;line-height:1;flex-shrink:0}
.mi-spec{font-size:11px;color:#6B9DB7;text-align:right}
.mi-dd{margin-top:18px;background:rgba(10,22,40,.5);border:1px solid rgba(82,222,181,.1);border-radius:12px;padding:16px}
.mi-dt{font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.08em;color:#52DEB5;margin-bottom:12px}
.mi-b{display:flex;gap:9px;margin-bottom:11px;font-size:12px;color:#9BBFD8;line-height:1.55}
.mi-b:last-child{margin-bottom:0}
.mi-b::before{content:'';width:5px;height:5px;border-radius:50%;background:#52DEB5;flex-shrink:0;margin-top:6px}
.mi-b b{color:#fff;font-weight:600}
.mi-seas{margin-bottom:16px}
.mi-seas:last-child{margin-bottom:0}
.mi-badge{display:inline-flex;align-items:center;font-size:10px;font-weight:700;padding:3px 10px;border-radius:8px;margin-bottom:6px}
.mi-badge.tl{background:rgba(74,159,224,.12);color:#52DEB5;border:1px solid rgba(74,159,224,.3)}
.mi-badge.bl{background:rgba(74,159,224,.12);color:#8DCAF2;border:1px solid rgba(74,159,224,.3)}
.mi-badge.am{background:rgba(82,222,181,.12);color:#52DEB5;border:1px solid rgba(82,222,181,.3)}
.mi-st{font-size:12px;color:#9BBFD8;line-height:1.55}
.scta{position:relative;overflow:hidden;background:linear-gradient(135deg,rgba(82,222,181,.1),rgba(46,204,154,.06));border-top:1px solid rgba(82,222,181,.2);border-bottom:1px solid rgba(82,222,181,.2);padding:40px 48px;display:flex;align-items:center;justify-content:space-between;gap:20px}
.scta-aura{position:absolute;border-radius:50%;filter:blur(70px);pointer-events:none;z-index:0;width:300px;height:300px;background:radial-gradient(circle,rgba(82,222,181,.14),transparent 70%);top:-100px;right:-40px}
.scta-l{position:relative;z-index:2}
.scta-h{font-family:'Plus Jakarta Sans',system-ui;font-size:22px;font-weight:800;margin-bottom:8px}
.scta-sub{font-size:13.5px;color:#9BBFD8;line-height:1.65;max-width:440px}
.scta-btn{position:relative;z-index:2;display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,#52DEB5,#2ECC9A);color:#04342C;border:none;padding:13px 26px;border-radius:12px;font-family:'Inter',system-ui;font-size:14px;font-weight:700;cursor:pointer;box-shadow:0 6px 22px rgba(82,222,181,.36);flex-shrink:0;transition:transform .15s,box-shadow .15s}
.scta-btn:hover{transform:translateY(-2px);box-shadow:0 9px 30px rgba(82,222,181,.55)}
.qm{position:relative;background:rgba(10,22,40,.96);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border:1px solid rgba(82,222,181,.28);border-radius:22px;padding:32px;width:100%;max-width:480px;box-shadow:0 28px 80px rgba(0,0,0,.65),0 0 60px -22px rgba(82,222,181,.22);max-height:92vh;overflow-y:auto}
.qm::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,#52DEB5,transparent)}
.qm-x{position:absolute;top:18px;right:18px;width:28px;height:28px;border-radius:50%;background:rgba(18,34,52,.8);border:1px solid rgba(82,222,181,.18);color:#9BBFD8;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s}
.qm-x:hover{border-color:rgba(82,222,181,.45);color:#fff}
.qm-sup{display:flex;align-items:center;gap:12px;padding-bottom:18px;border-bottom:1px solid rgba(82,222,181,.1);margin-bottom:18px}
.qm-logo{width:42px;height:42px;border-radius:11px;background:rgba(82,222,181,.12);border:1px solid rgba(82,222,181,.25);color:#52DEB5;font-family:'Plus Jakarta Sans',system-ui;font-size:13px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.qm-in,.qm-ta,.qm-se{background:rgba(18,34,52,.8);border:1px solid rgba(82,222,181,.18);border-radius:10px;padding:10px 14px;font-size:13px;color:#fff;font-family:'Inter',system-ui;outline:none;width:100%;transition:border-color .2s}
.qm-in:focus,.qm-ta:focus,.qm-se:focus{border-color:rgba(82,222,181,.5)}
.qm-sub-btn{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;background:linear-gradient(135deg,#52DEB5,#2ECC9A);color:#04342C;border:none;padding:15px;border-radius:12px;font-family:'Inter',system-ui;font-size:15px;font-weight:700;cursor:pointer;box-shadow:0 6px 24px rgba(82,222,181,.38);margin-top:8px;transition:transform .15s,box-shadow .15s}
.qm-sub-btn:hover{transform:translateY(-1px);box-shadow:0 10px 32px rgba(82,222,181,.55)}
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
body.light-mode .scta{background:linear-gradient(135deg,rgba(82,222,181,.08),rgba(82,222,181,.05)) !important}
body.light-mode .fb{background:rgba(238,246,255,.96) !important;border-bottom-color:rgba(82,222,181,.18)}
body.light-mode .fb-s,body.light-mode .fb-sel,body.light-mode .tog{background:rgba(255,255,255,.7) !important;border-color:rgba(82,222,181,.2) !important}
body.light-mode .lc,body.light-mode .lrow{background:rgba(255,255,255,.65) !important;border-color:rgba(82,222,181,.2) !important;box-shadow:0 4px 20px rgba(82,222,181,.1),inset 0 1px 0 rgba(255,255,255,.95) !important}
body.light-mode .mi-stat{background:rgba(255,255,255,.65) !important;border-color:rgba(82,222,181,.2) !important}
body.light-mode .mi-box{background:rgba(255,255,255,.6) !important;border-color:rgba(82,222,181,.18) !important}
body.light-mode .lc-stats,body.light-mode .lr-stats{background:rgba(238,246,255,.8) !important;border-color:rgba(82,222,181,.18) !important}
body.light-mode .lc-stat,body.light-mode .lr-stat{border-left-color:rgba(82,222,181,.18) !important}
body.light-mode .lc-tag{background:rgba(82,222,181,.1) !important;border-color:rgba(82,222,181,.22) !important;color:#1DB89A !important}
body.light-mode .lc-cert{background:rgba(82,222,181,.08) !important;border-color:rgba(82,222,181,.2) !important;color:#1DB89A !important}
body.light-mode .lc-foot{border-top-color:rgba(82,222,181,.15) !important}
body.light-mode .ch-sub{color:#3A5E75}
body.light-mode .ch1{color:#050D18}
body.light-mode .ch1{color:#050D18 !important}
body.light-mode .ch1 em{color:#1DB89A !important}
body.light-mode .ch-sub{color:#3A5E75 !important}
body.light-mode .ch-bc{color:#6B9DB7 !important}
body.light-mode .ch-bc .cur{color:#1DB89A !important}
body.light-mode .chs-l{color:#6B9DB7 !important}
body.light-mode .ch-stats{background:rgba(255,255,255,.72) !important;border-color:rgba(82,222,181,.3) !important}
body.light-mode .chs{border-right-color:rgba(82,222,181,.15) !important}
body.light-mode .chs-n{color:#1DB89A !important}
body.light-mode .chs-l{color:#3A5E75 !important}
body.light-mode .ch-btn-s{border-color:rgba(29,184,154,.4) !important;color:#1DB89A !important}
body.light-mode .fb-cnt b{color:#1DB89A !important}
body.light-mode .fb-s input::placeholder{color:#9BBFD8 !important}
body.light-mode .ls-lbl::after{background:rgba(82,222,181,.2) !important}
body.light-mode .lc-n{color:#050D18 !important}
body.light-mode .lc-loc{color:#6B9DB7 !important}
body.light-mode .lc-tag{background:rgba(82,222,181,.1) !important;border-color:rgba(82,222,181,.22) !important;color:#1DB89A !important}
body.light-mode .lc-cert{background:rgba(82,222,181,.08) !important;border-color:rgba(82,222,181,.2) !important;color:#1DB89A !important}
body.light-mode .lc-stats{background:rgba(238,246,255,.8) !important;border-color:rgba(82,222,181,.18) !important}
body.light-mode .lc-stat + .lc-stat{border-left-color:rgba(82,222,181,.18) !important}
body.light-mode .lc-foot{border-top-color:rgba(82,222,181,.15) !important}
body.light-mode .lr-name{color:#050D18 !important}
body.light-mode .lr-loc{color:#6B9DB7 !important}
body.light-mode .lr-stats{background:rgba(238,246,255,.8) !important;border-color:rgba(82,222,181,.18) !important}
body.light-mode .lr-stat + .lr-stat{border-left-color:rgba(82,222,181,.18) !important}
body.light-mode .lm-btn{border-color:rgba(29,184,154,.4) !important;color:#1DB89A !important}
body.light-mode .lm-btn:hover{background:rgba(82,222,181,.12) !important;border-color:rgba(29,184,154,.6) !important;color:#050D18 !important}
body.light-mode .mi-stat{background:rgba(255,255,255,.85) !important;border-color:rgba(82,222,181,.2) !important;box-shadow:0 4px 20px rgba(82,222,181,.08) !important}
body.light-mode .mi-n{background:linear-gradient(135deg,#050D18,#1DB89A) !important;-webkit-background-clip:text !important;background-clip:text !important;-webkit-text-fill-color:transparent !important}
body.light-mode .mi-n.tl{background:linear-gradient(135deg,#1DB89A,#52DEB5) !important;-webkit-background-clip:text !important;background-clip:text !important;-webkit-text-fill-color:transparent !important}
body.light-mode .mi-nl{color:#050D18 !important}
body.light-mode .mi-nd{color:#6B9DB7 !important}
body.light-mode .mi-box{background:rgba(255,255,255,.78) !important;border-color:rgba(82,222,181,.18) !important}
body.light-mode .mi-bt{color:#050D18 !important}
body.light-mode .mi-cty{color:#050D18 !important}
body.light-mode .mi-spec{color:#6B9DB7 !important}
body.light-mode .mi-rank{background:rgba(82,222,181,.12) !important;border-color:rgba(82,222,181,.25) !important;color:#1DB89A !important}
body.light-mode .mi-row{border-bottom-color:rgba(82,222,181,.12) !important}
body.light-mode .mi-st{color:#3A5E75 !important}
body.light-mode .mi-st b{color:#050D18 !important}
body.light-mode .mi-seas{border-bottom-color:rgba(82,222,181,.12) !important}
body.light-mode .mi-dd{background:rgba(238,246,255,.85) !important;border-color:rgba(82,222,181,.15) !important}
body.light-mode .mi-dt{color:#1DB89A !important}
body.light-mode .mi-b{color:#3A5E75 !important}
body.light-mode .mi-b b{color:#050D18 !important}
body.light-mode .mi-sub{color:#3A5E75 !important}
body.light-mode .mi-h{color:#050D18 !important}
body.light-mode .mi-h em{color:#1DB89A !important}
body.light-mode .scta-h{color:#050D18 !important}
body.light-mode .scta-sub{color:#3A5E75 !important}
body.light-mode .csn-item.on{color:#1DB89A !important;border-bottom-color:#1DB89A !important}
body.light-mode .csn-sep{background:rgba(82,222,181,.18) !important}
body.light-mode .ch1 em{color: #1DB89A !important;}
body.light-mode .csn-item.on{color: #1DB89A !important; border-bottom-color: #1DB89A !important;}
body.light-mode .rq-btn{background: linear-gradient(135deg,#2ECC9A,#1DB89A) !important; color: #04342C !important;}
body.light-mode .ch-btn-p{background: linear-gradient(135deg,#2ECC9A,#1DB89A) !important; color: #04342C !important;}
body.light-mode .mi-n{background: linear-gradient(135deg,#050D18,#1DB89A) !important; -webkit-background-clip: text !important; background-clip: text !important; -webkit-text-fill-color: transparent !important;}
body.light-mode .bdg-f{background: rgba(82,222,181,.15) !important; color: #1DB89A !important; border-color: rgba(82,222,181,.35) !important;}
body.light-mode .scta-h{color: #050D18 !important;}
body.light-mode .scta-sub{color: #3A5E75 !important;}
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
<div class="pg-aura" id="pa2" style="width:600px;height:600px;background:radial-gradient(circle,rgba(74,159,224,.14),transparent 65%);top:-120px;right:-180px"></div>
<div class="pg-aura" id="pa3" style="width:500px;height:500px;background:radial-gradient(circle,rgba(74,159,224,.1),transparent 65%);bottom:-150px;left:35%"></div>
<canvas id="pg-canvas" aria-hidden="true"></canvas>



<!-- SECTION 1 — Category sub-nav -->
<div class="csn" aria-label="Category navigation">
<div class="csn-inner">
<a class="csn-item" href="category-fruits-veg.html"><i class="ti ti-leaf" aria-hidden="true"></i>Fruits &amp; Veg</a>
<span class="csn-sep"></span>
<a class="csn-item" href="category-poultry.html"><i class="ti ti-feather" aria-hidden="true"></i>Poultry</a>
<span class="csn-sep"></span>
<a class="csn-item" href="category-beef-meat.html"><i class="ti ti-flame" aria-hidden="true"></i>Beef &amp; Meat</a>
<span class="csn-sep"></span>
<a class="csn-item on" href="category-seafood.html"><i class="ti ti-fish" aria-hidden="true"></i>Seafood</a>
<span class="csn-sep"></span>
<a class="csn-item" href="#"><i class="ti ti-truck" aria-hidden="true"></i>Services</a>
</div>
</div>

<!-- SECTION 2 — Category hero -->
<section class="chero" aria-label="Category hero">
<div class="chero-aura" style="width:400px;height:400px;background:radial-gradient(circle,rgba(82,222,181,.18),transparent 70%);top:-120px;right:-80px"></div>
<div class="chero-aura" style="width:300px;height:300px;background:radial-gradient(circle,rgba(82,222,181,.1),transparent 70%);bottom:-60px;left:-60px"></div>
<div class="chero-inner">
<div class="ch-bc" id="ch-bc"><a href="index.html" style="color:#6B9DB7;text-decoration:none">Database</a><i class="ti ti-chevron-right" aria-hidden="true"></i><span class="cur">Frozen Seafood</span></div>
<h1 class="ch1" id="ch-h1">Frozen <em>Seafood</em> Suppliers</h1>
<p class="ch-sub" id="ch-sub">Source fish fillets, shrimp, shellfish and processed seafood from MSC-certified and sustainably sourced global suppliers. Direct contact, zero commission.</p>
<div class="ch-stats" id="ch-stats">
<div class="chs"><span class="chs-n">165+</span><span class="chs-l">Suppliers</span></div>
<div class="chs"><span class="chs-n">38</span><span class="chs-l">Countries</span></div>
<div class="chs"><span class="chs-n">500kg</span><span class="chs-l">From MOQ</span></div>
<div class="chs"><span class="chs-n">5.1%</span><span class="chs-l">Mkt CAGR</span></div>
</div>
<div class="ch-acts" id="ch-acts">
<button class="ch-btn-p" data-quote data-name="Nordic Seafood Group" data-initials="NS" data-loc="Norway"><i class="ti ti-message-circle" aria-hidden="true"></i>Request a Quote</button>
<button class="ch-btn-s">Browse all suppliers</button>
</div>
</div>
</section>

<!-- SECTION 3 — Filter bar -->
<div class="fb" aria-label="Filters">
<div class="fb-in">
<label class="fb-s"><i class="ti ti-search" aria-hidden="true"></i><input type="text" placeholder="Search suppliers, products, origins..." aria-label="Search suppliers"></label>
<select class="fb-sel" aria-label="Product Type">
<option>All Products</option><option>Fish Fillets</option><option>Whole Fish</option><option>Shrimp &amp; Prawns</option><option>Squid &amp; Octopus</option><option>Shellfish &amp; Crab</option><option>Salmon &amp; Trout</option><option>Tuna &amp; Swordfish</option><option>Processed &amp; IQF</option>
</select>
<select class="fb-sel" aria-label="Certification">
<option>All Certifications</option><option>MSC Certified</option><option>ASC Certified</option><option>BRC Grade A</option><option>Friend of the Sea</option><option>HACCP</option><option>Organic</option><option>Halal</option><option>BAP Certified</option>
</select>
<select class="fb-sel" aria-label="MOQ Range">
<option>All MOQ</option><option>Less than 500kg</option><option>500kg–2T</option><option>2T–10T</option><option>10T+</option><option>1 Container</option>
</select>
<div class="fb-r">
<span class="fb-cnt">Showing 9 of <b>165+</b> suppliers</span>
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
<div class="ls-lbl" id="ls-lbl">165+ verified suppliers · Grid view</div>
<div id="grid-view"></div>
<div id="list-view"></div>
</div>
</section>

<!-- SECTION 5 — Load more -->
<div class="lm">
<div class="lm-cnt">Showing 9 of <b>165+</b> verified Frozen Seafood suppliers</div>
<button class="lm-btn"><i class="ti ti-refresh" aria-hidden="true"></i>Load More Suppliers</button>
</div>

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

<!-- SECTION 8 — Supplier CTA banner -->
<section class="scta" aria-label="Supplier call to action">
<div class="scta-aura"></div>
<div class="scta-l">
<div class="scta-h">Are you a Frozen Seafood supplier?</div>
<div class="scta-sub">List your MSC-certified, sustainably sourced or conventional seafood business for free and start receiving direct quote requests from wholesale buyers actively sourcing in this category. Zero commission on every deal closed through FFInc.</div>
</div>
<button class="scta-btn"><i class="ti ti-plus" aria-hidden="true"></i>Create Free Listing</button>
</section>

<!-- SECTION 9 — Footer -->


<!-- SECTION 7 — Quote request modal -->
<div class="qm-ov" id="qm-ov" aria-hidden="true">
<div class="qm" id="qm-card" role="dialog" aria-modal="true" aria-label="Request a quote">
<button class="qm-x" id="qm-x" aria-label="Close"><i class="ti ti-x" aria-hidden="true"></i></button>
<div class="qm-sup">
<div class="qm-logo" id="qm-logo">NS</div>
<div><div class="qm-sn" id="qm-sn">Nordic Seafood Group</div><div class="qm-sl"><i class="ti ti-map-pin" aria-hidden="true"></i><span id="qm-sl">Norway · Verified Supplier</span></div></div>
</div>
<div class="qm-h">Request a Quote</div>
<div class="qm-sub">Complete the form below — the supplier will respond directly to your email. FFInc charges zero commission.</div>
<form id="qm-form" onsubmit="return false">
<div class="qm-grid">
<div class="qm-f"><label class="qm-lb">Your Name</label><input class="qm-in" type="text" placeholder="Jane Doe"></div>
<div class="qm-f"><label class="qm-lb">Company Name</label><input class="qm-in" type="text" placeholder="Acme Foods Ltd"></div>
<div class="qm-f"><label class="qm-lb">Email Address</label><input class="qm-in" type="email" placeholder="you@company.com"></div>
<div class="qm-f"><label class="qm-lb">Country</label><input class="qm-in" type="text" placeholder="United Kingdom"></div>
<div class="qm-f"><label class="qm-lb">Product Required</label><select class="qm-se"><option>Salmon Fillets</option><option>Cod &amp; Haddock</option><option>Vannamei Shrimp</option><option>Black Tiger Shrimp</option><option>Squid &amp; Octopus</option><option>Shellfish &amp; Crab</option><option>Tuna &amp; Swordfish</option><option>Processed &amp; IQF</option><option>Other</option></select></div>
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
     Seafood category page — page-specific JavaScript.
     Shared behaviour (particle canvas, aurora drift, footer dot
     pulse, dark/light toggle) lives in assets/js/main.js.
     GSAP is already enqueued by the plugin before this runs.
     ============================================================ -->
<script>
(function(){
var SUPPLIERS=[
{i:'NS',n:'Nordic Seafood Group',c:'Norway',y:1998,feat:true,tags:['Salmon Fillets','Cod','Haddock','MSC'],moq:'500kg',ctry:'42',resp:'<8h',certs:['MSC Certified','BRC Grade A','IQF'],rate:'4.7',rev:19,stars:4},
{i:'TH',n:'Thai Shrimp Export Co',c:'Thailand',y:2000,feat:false,tags:['Vannamei Shrimp','Black Tiger','IQF'],moq:'2T',ctry:'45',resp:'<12h',certs:['BAP Certified','BRC','HACCP'],rate:'4.8',rev:33,stars:5},
{i:'EC',n:'Ecuador Seafood SA',c:'Ecuador',y:1995,feat:false,tags:['White Shrimp','Vannamei','Cooked'],moq:'3T',ctry:'38',resp:'<18h',certs:['ASC Certified','BRC Grade A'],rate:'4.9',rev:27,stars:5},
{i:'VI',n:'Vietnam Ocean Foods',c:'Vietnam',y:2003,feat:false,tags:['Pangasius','Tilapia','Shrimp','IQF'],moq:'5T',ctry:'35',resp:'<12h',certs:['BRC','HACCP','Friend of the Sea'],rate:'4.6',rev:22,stars:4},
{i:'IC',n:'Iceland Seafood Intl',c:'Iceland',y:1985,feat:false,tags:['Cod','Haddock','Capelin','Arctic Fish'],moq:'1T',ctry:'30',resp:'<6h',certs:['MSC Certified','BRC Grade A'],rate:'4.9',rev:38,stars:5},
{i:'CN',n:'China Ocean Export',c:'China',y:2001,feat:false,tags:['Squid','Octopus','Crab','Mixed IQF'],moq:'5T',ctry:'50',resp:'<24h',certs:['HACCP','BRC','GACC Registered'],rate:'4.5',rev:18,stars:4},
{i:'IN',n:'India Seafood Exports',c:'India',y:1997,feat:false,tags:['Vannamei Shrimp','Squid','Fish Meal'],moq:'3T',ctry:'40',resp:'<18h',certs:['BRC','HACCP','Halal','BAP'],rate:'4.6',rev:24,stars:4},
{i:'CL',n:'Chilean Sea Products',c:'Chile',y:1992,feat:false,tags:['Salmon','Mussel','Sea Bass','IQF'],moq:'1T',ctry:'28',resp:'<8h',certs:['MSC Certified','ASC','BRC'],rate:'4.8',rev:21,stars:5},
{i:'MO',n:'Morocco Fish Export',c:'Morocco',y:2006,feat:false,tags:['Sardines','Octopus','Squid','Anchovy'],moq:'2T',ctry:'25',resp:'<24h',certs:['BRC','HACCP','Friend of the Sea'],rate:'4.6',rev:12,stars:4}
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
tg.addEventListener('click',function(){gv.style.display='grid';lv.style.display='none';tg.classList.add('on');tl.classList.remove('on');lbl.textContent='165+ verified suppliers · Grid view';});
tl.addEventListener('click',function(){gv.style.display='none';lv.style.display='flex';tl.classList.add('on');tg.classList.remove('on');lbl.textContent='165+ verified suppliers · List view';});

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
