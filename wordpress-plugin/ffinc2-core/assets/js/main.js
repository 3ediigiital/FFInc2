/* ============================================================
   FFInc 2.0 — Shared Site JavaScript
   Loaded site-wide on every FFInc 2.0 page.

   Contains only the JS that is IDENTICAL across all 8 pages:
     • Rising particle canvas background (#pg-canvas)
     • Aurora blob GSAP drift (#pa1 / #pa2 / #pa3)
     • Footer status-dot pulse (#pf-sdot)
     • Dark / light mode toggle (#mode-toggle)

   Page-specific JS (hero timelines, stat counters, section
   scroll animations, tab switchers, etc.) stays inline in each
   page template.

   Every block is guarded so a page missing an element simply
   skips that feature instead of throwing.
   ============================================================ */
(function () {
  'use strict';

  function init() {

    /* ---- Rising particle canvas background ---- */
    var cv = document.getElementById('pg-canvas');
    if (cv && cv.getContext) {
      var cx = cv.getContext('2d'), pts = [];
      function rsz(){ cv.width = window.innerWidth; cv.height = window.innerHeight; }
      rsz();
      window.addEventListener('resize', rsz);
      function mkp(){ return { x:Math.random()*cv.width, y:cv.height+10, sz:Math.random()*2.5+.8, sp:Math.random()*.5+.25, op:Math.random()*.55+.25, col:Math.random()>.5?'#4A9FE0':'#2ECC9A', dr:(Math.random()-.5)*.4 }; }
      for (var i=0;i<30;i++){ var p=mkp(); p.y=Math.random()*cv.height; pts.push(p); }
      (function loop(){
        cx.clearRect(0,0,cv.width,cv.height);
        pts.forEach(function(p,i){
          p.y-=p.sp; p.x+=p.dr; p.op-=.0007;
          cx.beginPath(); cx.arc(p.x,p.y,p.sz,0,Math.PI*2);
          cx.fillStyle=p.col; cx.globalAlpha=Math.max(0,p.op); cx.fill(); cx.globalAlpha=1;
          if(p.y<-10||p.op<=0) pts[i]=mkp();
        });
        requestAnimationFrame(loop);
      })();
    }

    /* ---- Aurora blob drift (requires GSAP) ---- */
    if (window.gsap) {
      if (document.getElementById('pa1')) gsap.to('#pa1',{x:120,y:-80,scale:1.2,duration:10,repeat:-1,yoyo:true,ease:'sine.inOut'});
      if (document.getElementById('pa2')) gsap.to('#pa2',{x:-130,y:60,scale:1.15,duration:13,repeat:-1,yoyo:true,ease:'sine.inOut',delay:2});
      if (document.getElementById('pa3')) gsap.to('#pa3',{x:80,y:-50,scale:1.1,duration:11,repeat:-1,yoyo:true,ease:'sine.inOut',delay:4});

      /* ---- Footer status-dot pulse ---- */
      if (document.getElementById('pf-sdot')) gsap.to('#pf-sdot',{opacity:.28,scale:.6,duration:1.4,repeat:-1,yoyo:true,ease:'sine.inOut'});
    }

    /* ---- Dark / light mode toggle ---- */
    var modeToggle = document.getElementById('mode-toggle');
    var modeIcon   = document.getElementById('mode-icon');
    if (modeToggle) {
      var isLight = false;
      modeToggle.addEventListener('click', function () {
        isLight = !isLight;
        document.body.classList.toggle('light-mode', isLight);
        if (modeIcon) modeIcon.className = isLight ? 'ti ti-moon' : 'ti ti-sun';
        modeToggle.setAttribute('aria-label',
          isLight ? 'Switch to dark mode' : 'Switch to light mode');
      });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
