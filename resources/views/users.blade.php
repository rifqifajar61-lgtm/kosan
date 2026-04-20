<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kost Harmonia — Hunian Nyaman & Elegan</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root {
  --primary:#7c3aed; --pl:#a855f7; --pd:#5b21b6; --ps:#ede9fe;
  --accent:#f59e0b; --al:#fef3c7;
  --bg:#faf9ff; --sur:#fff; --sur2:#f5f3ff;
  --tx:#1e1b2e; --tm:#6b7280; --tl:#9ca3af;
  --bd:#e8e4f9; --sh:rgba(124,58,237,.12); --shl:rgba(124,58,237,.22);
  --green:#10b981; --red:#ef4444; --blue:#3b82f6; --wa:#25D366;
}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--tx);overflow-x:hidden}
::-webkit-scrollbar{width:5px}::-webkit-scrollbar-track{background:var(--ps)}::-webkit-scrollbar-thumb{background:var(--pl);border-radius:3px}

/* TOP BAR */
.topbar{background:linear-gradient(135deg,var(--pd),var(--primary) 55%,var(--pl));color:#fff;padding:9px 20px;display:flex;justify-content:space-between;align-items:center;font-size:12px;overflow:hidden;position:relative}
.topbar::after{content:'';position:absolute;top:-30px;right:-30px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05)}
.tb-left{display:flex;gap:18px}
.tb-item{display:flex;align-items:center;gap:5px;opacity:.9}
.tb-right{display:flex;gap:8px;align-items:center}
.btn-wa-sm{background:var(--wa);color:#fff;padding:5px 13px;border-radius:20px;font-size:11px;font-weight:700;text-decoration:none;display:flex;align-items:center;gap:4px;transition:.2s}
.btn-wa-sm:hover{opacity:.88;transform:scale(1.03)}

/* NAVBAR */
.navbar{background:var(--sur);border-bottom:1px solid var(--bd);padding:0 20px;display:flex;align-items:center;justify-content:space-between;height:62px;position:sticky;top:0;z-index:200;box-shadow:0 2px 20px var(--sh)}
.logo{display:flex;align-items:center;gap:9px;text-decoration:none;cursor:pointer}
.logo-ico{width:35px;height:35px;background:linear-gradient(135deg,var(--primary),var(--pl));border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:17px}
.logo-txt{font-family:'Playfair Display',serif;font-size:19px;font-weight:700;color:var(--pd)}
.logo-txt span{color:var(--pl)}
.nav-links{display:flex;gap:2px}
.nl{padding:7px 11px;border-radius:8px;font-size:13px;font-weight:500;color:var(--tm);cursor:pointer;border:none;background:none;transition:.2s;white-space:nowrap}
.nl:hover{color:var(--primary);background:var(--ps)}
.nl.on{color:var(--primary);background:var(--ps);font-weight:600}
.nav-r{display:flex;align-items:center;gap:8px}
.notif-btn{width:34px;height:34px;border-radius:50%;border:1px solid var(--bd);background:var(--sur);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:15px;position:relative;transition:.2s}
.notif-btn:hover{border-color:var(--primary);background:var(--ps)}
.nbadge{position:absolute;top:-2px;right:-2px;width:13px;height:13px;background:var(--red);border-radius:50%;font-size:8px;color:#fff;display:flex;align-items:center;justify-content:center;border:2px solid #fff}
.nav-wa{background:var(--wa);color:#fff;padding:7px 14px;border-radius:18px;font-size:12px;font-weight:700;text-decoration:none;display:flex;align-items:center;gap:4px;transition:.2s}
.nav-wa:hover{opacity:.85}

/* MOBILE MENU */
.hamburger{display:none;flex-direction:column;gap:4px;cursor:pointer;padding:5px}
.hamburger span{width:22px;height:2px;background:var(--primary);border-radius:2px;transition:.3s}
.mobile-menu{display:none;position:fixed;top:62px;left:0;right:0;background:var(--sur);border-bottom:1px solid var(--bd);padding:12px 16px;z-index:199;box-shadow:0 8px 24px var(--sh);flex-direction:column;gap:4px}
.mobile-menu.open{display:flex}
.mm-link{padding:10px 14px;border-radius:10px;font-size:14px;font-weight:500;color:var(--tm);cursor:pointer;border:none;background:none;text-align:left;transition:.2s;width:100%}
.mm-link:hover,.mm-link.on{color:var(--primary);background:var(--ps)}

/* PAGE */
.page{display:none}
.page.on{display:block;animation:fadeUp .4s ease}
@keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}

/* HERO */
.hero{background:linear-gradient(135deg,var(--pd) 0%,var(--primary) 50%,#9333ea 100%);padding:56px 20px 76px;position:relative;overflow:hidden;color:#fff;text-align:center}
.hero::before{content:'';position:absolute;top:-50px;right:-50px;width:280px;height:280px;border-radius:50%;background:rgba(255,255,255,.05);pointer-events:none}
.hero::after{content:'';position:absolute;bottom:-70px;left:-70px;width:260px;height:260px;border-radius:50%;background:rgba(255,255,255,.04);pointer-events:none}
.hero-tag{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.14);border:1px solid rgba(255,255,255,.24);border-radius:20px;padding:5px 14px;font-size:12px;font-weight:500;margin-bottom:18px;backdrop-filter:blur(10px)}
.hero-dot{width:6px;height:6px;background:var(--accent);border-radius:50%;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.6;transform:scale(1.3)}}
.hero h1{font-family:'Playfair Display',serif;font-size:clamp(26px,5vw,46px);font-weight:700;line-height:1.2;margin-bottom:14px}
.hero p{font-size:15px;opacity:.85;max-width:460px;margin:0 auto 28px;line-height:1.6}
.hero-btns{display:flex;gap:10px;justify-content:center;flex-wrap:wrap}
.btn-white{background:#fff;color:var(--pd);padding:11px 26px;border-radius:11px;border:none;font-weight:700;font-size:13px;cursor:pointer;transition:.2s;box-shadow:0 4px 18px rgba(0,0,0,.14)}
.btn-white:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(0,0,0,.2)}
.btn-wa-hero{background:var(--wa);color:#fff;padding:11px 26px;border-radius:11px;border:none;font-weight:700;font-size:13px;cursor:pointer;transition:.2s;box-shadow:0 4px 18px rgba(37,211,102,.28);display:flex;align-items:center;gap:7px;text-decoration:none}
.btn-wa-hero:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(37,211,102,.4)}

/* STATS */
.stats-bar{background:#fff;border-radius:16px;margin:-30px 20px 0;padding:22px;display:flex;justify-content:space-around;box-shadow:0 8px 40px var(--shl);position:relative;z-index:10;flex-wrap:wrap;gap:14px}
.stat-v{font-family:'Playfair Display',serif;font-size:24px;font-weight:700;color:var(--primary);line-height:1}
.stat-l{font-size:11px;color:var(--tm);margin-top:3px}
.stat-d{width:1px;background:var(--bd)}

/* SECTION */
.sec{padding:44px 20px;max-width:1100px;margin:0 auto}
.sec-ey{font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:2px;color:var(--primary);margin-bottom:6px;display:flex;align-items:center;gap:8px}
.sec-ey::after{content:'';flex:1;height:1px;background:var(--ps);max-width:50px}
.sec-t{font-family:'Playfair Display',serif;font-size:clamp(20px,3vw,30px);font-weight:700;line-height:1.3}
.sec-t em{color:var(--primary);font-style:normal}
.sec-sub{font-size:14px;color:var(--tm);margin-top:7px;line-height:1.6}
.sec-hdr{margin-bottom:28px}

/* CARDS */
.card-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:14px;margin-top:28px}
.qcard{background:#fff;border:1px solid var(--bd);border-radius:14px;padding:18px;transition:.3s;cursor:pointer;position:relative;overflow:hidden}
.qcard::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--primary),var(--pl));transform:scaleX(0);transform-origin:left;transition:.3s}
.qcard:hover::before{transform:scaleX(1)}
.qcard:hover{box-shadow:0 8px 28px var(--sh);transform:translateY(-3px)}
.qcard-ico{width:40px;height:40px;border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:10px}
.qcard-t{font-weight:700;font-size:14px;margin-bottom:3px}
.qcard-d{font-size:12px;color:var(--tm);line-height:1.4}

/* ANNOUNCEMENT */
.ann-list{display:flex;flex-direction:column;gap:10px}
.ann{background:#fff;border:1px solid var(--bd);border-radius:12px;padding:14px 18px;display:flex;gap:12px;align-items:flex-start;transition:.2s}
.ann:hover{border-color:var(--pl);box-shadow:0 4px 18px var(--sh)}
.ann-ic{width:38px;height:38px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:17px;flex-shrink:0}
.ann-t{font-weight:600;font-size:13px;margin-bottom:3px}
.ann-d{font-size:12px;color:var(--tm);line-height:1.4}
.ann-meta{display:flex;gap:8px;margin-top:5px;align-items:center}
.ann-date{font-size:10px;color:var(--tl)}
.pill{font-size:10px;padding:2px 7px;border-radius:8px;font-weight:600}

/* ROOM */
.rf{display:flex;gap:7px;flex-wrap:wrap;margin-bottom:24px}
.fb{padding:7px 15px;border-radius:18px;border:1px solid var(--bd);background:#fff;font-size:12px;font-weight:500;color:var(--tm);cursor:pointer;transition:.2s}
.fb:hover{border-color:var(--primary);color:var(--primary)}
.fb.on{background:var(--primary);color:#fff;border-color:var(--primary);font-weight:600}
.room-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:20px}
.rcard{background:#fff;border-radius:18px;overflow:hidden;border:1px solid var(--bd);transition:.35s;position:relative}
.rcard:hover{transform:translateY(-7px);box-shadow:0 20px 55px var(--shl);border-color:var(--pl)}
.rthumb{height:190px;position:relative;overflow:hidden;display:flex;align-items:center;justify-content:center}
.rthumb-emoji{font-size:68px;transition:.35s;filter:drop-shadow(0 4px 10px rgba(0,0,0,.14))}
.rcard:hover .rthumb-emoji{transform:scale(1.1)}
.rovl{position:absolute;inset:0;background:linear-gradient(180deg,transparent 50%,rgba(124,58,237,.12))}
.rbadge{position:absolute;top:10px;right:10px;padding:4px 10px;border-radius:18px;font-size:10px;font-weight:700;backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.3)}
.bavail{background:rgba(16,185,129,.9);color:#fff}
.bfull{background:rgba(239,68,68,.9);color:#fff}
.bres{background:rgba(245,158,11,.9);color:#fff}
.rfav{position:absolute;top:10px;left:10px;width:30px;height:30px;background:rgba(255,255,255,.85);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:14px;cursor:pointer;transition:.2s;backdrop-filter:blur(8px)}
.rfav:hover{transform:scale(1.15)}
.rinfo{padding:18px}
.rtype{font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:var(--primary);margin-bottom:3px}
.rname{font-family:'Playfair Display',serif;font-weight:700;font-size:17px;margin-bottom:5px}
.rdesc{font-size:12px;color:var(--tm);line-height:1.5;margin-bottom:10px}
.rprice{font-family:'Playfair Display',serif;font-size:20px;font-weight:700;color:var(--primary)}
.rprice span{font-size:12px;font-weight:400;color:var(--tm);font-family:'DM Sans',sans-serif}
.rtags{display:flex;gap:5px;margin:8px 0 14px;flex-wrap:wrap}
.rtag{display:flex;align-items:center;gap:3px;background:var(--ps);color:var(--pd);padding:3px 8px;border-radius:6px;font-size:10px;font-weight:500}
.btn-wa{display:flex;align-items:center;justify-content:center;gap:7px;width:100%;background:var(--wa);color:#fff;border:none;border-radius:10px;padding:12px;font-weight:700;font-size:13px;cursor:pointer;transition:.25s;text-decoration:none}
.btn-wa:hover{opacity:.9;transform:translateY(-1px);box-shadow:0 6px 18px rgba(37,211,102,.35)}

/* FACILITY */
.fac-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:14px}
.fac{background:#fff;border:1px solid var(--bd);border-radius:14px;padding:20px 14px;text-align:center;transition:.3s}
.fac:hover{background:linear-gradient(135deg,var(--ps),#fff);border-color:var(--pl);transform:translateY(-4px);box-shadow:0 10px 28px var(--sh)}
.fac-em{font-size:32px;margin-bottom:8px;display:block}
.fac-n{font-weight:600;font-size:13px;margin-bottom:3px}
.fac-d{font-size:11px;color:var(--tm)}
.fac-s{display:inline-flex;align-items:center;gap:3px;margin-top:6px;font-size:10px;font-weight:600;color:var(--green)}
.fac-s.maint{color:var(--accent)}
.fac-sd{width:5px;height:5px;border-radius:50%;background:currentColor}

/* RULES */
.rul-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:16px}
.rgrp{background:#fff;border:1px solid var(--bd);border-radius:14px;overflow:hidden}
.rgrp-h{padding:14px 18px;font-weight:700;font-size:13px;display:flex;align-items:center;gap:8px;border-bottom:1px solid var(--bd);background:linear-gradient(135deg,var(--ps),#fff)}
.rgrp-body{padding:14px 18px;display:flex;flex-direction:column;gap:8px}
.ri{display:flex;align-items:flex-start;gap:8px;font-size:12px;line-height:1.5}
.rd{width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:700;flex-shrink:0;margin-top:1px}
.do{background:#d1fae5;color:#065f46}.dont{background:#fee2e2;color:#991b1b}

/* LOCATION */
.loc-l{display:grid;grid-template-columns:1fr 320px;gap:20px;align-items:start}
.mapbox{background:linear-gradient(135deg,var(--ps),#ddd6fe);border-radius:18px;height:340px;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;border:1px solid var(--bd)}
.mbg{position:absolute;inset:0;background-image:linear-gradient(rgba(124,58,237,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(124,58,237,.05) 1px,transparent 1px);background-size:30px 30px}
.mpin{position:absolute;display:flex;flex-direction:column;align-items:center;animation:fl 3s ease-in-out infinite}
@keyframes fl{0%,100%{transform:translateY(0)}50%{transform:translateY(-7px)}}
.mpin-ico{width:48px;height:48px;background:linear-gradient(135deg,var(--primary),var(--pl));border-radius:50% 50% 50% 0;transform:rotate(-45deg);display:flex;align-items:center;justify-content:center;box-shadow:0 6px 20px var(--shl)}
.mpin-ico span{transform:rotate(45deg);font-size:20px}
.mpin-lb{margin-top:7px;background:#fff;border-radius:7px;padding:3px 10px;font-size:11px;font-weight:700;color:var(--pd);box-shadow:0 3px 10px var(--sh);white-space:nowrap}
.radar{position:absolute;border-radius:50%;border:2px dashed rgba(124,58,237,.18);animation:rad 3s linear infinite}
@keyframes rad{from{opacity:.5;transform:scale(.8)}to{opacity:0;transform:scale(1.4)}}
.loc-cards{display:flex;flex-direction:column;gap:10px}
.lcrd{background:#fff;border:1px solid var(--bd);border-radius:12px;padding:14px;transition:.2s}
.lcrd:hover{border-color:var(--pl);box-shadow:0 5px 18px var(--sh)}
.lch{display:flex;align-items:center;gap:8px;margin-bottom:8px}
.lci{width:32px;height:32px;border-radius:9px;background:var(--ps);display:flex;align-items:center;justify-content:center;font-size:16px}
.nb-row{display:flex;justify-content:space-between;align-items:center;font-size:12px;padding:5px 0;border-bottom:1px solid var(--bd)}
.nb-row:last-child{border-bottom:none}
.nb-d{font-size:11px;color:var(--primary);font-weight:600;background:var(--ps);padding:2px 7px;border-radius:7px}

/* GALLERY */
.gal-grid{display:grid;grid-template-columns:2fr 1fr 1fr;grid-template-rows:190px 190px;gap:10px;border-radius:18px;overflow:hidden;margin-bottom:36px}
.gc{display:flex;align-items:center;justify-content:center;font-size:48px;position:relative;overflow:hidden;transition:.3s;cursor:pointer}
.gc:hover{filter:brightness(1.08);transform:scale(1.02);z-index:2}
.gc:nth-child(1){grid-row:1/3;font-size:72px;background:linear-gradient(135deg,var(--ps),#ddd6fe)}
.gc:nth-child(2){background:linear-gradient(135deg,#ddd6fe,#c4b5fd)}
.gc:nth-child(3){background:linear-gradient(135deg,#e0f2fe,#bae6fd)}
.gc:nth-child(4){background:linear-gradient(135deg,#d1fae5,#a7f3d0)}
.gc:nth-child(5){background:linear-gradient(135deg,#fef3c7,#fde68a)}
.gc-lb{position:absolute;bottom:0;left:0;right:0;background:linear-gradient(0deg,rgba(92,33,182,.65),transparent);color:#fff;padding:10px;font-size:11px;font-weight:600}
.about-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.acard{background:#fff;border:1px solid var(--bd);border-radius:18px;padding:24px;transition:.3s}
.acard:hover{box-shadow:0 10px 36px var(--sh);transform:translateY(-3px)}
.acard.full{grid-column:1/-1}
.acard h3{font-family:'Playfair Display',serif;font-size:16px;font-weight:700;margin:12px 0 7px}
.acard p{font-size:13px;color:var(--tm);line-height:1.7}
.val-l{display:flex;flex-direction:column;gap:8px;margin-top:10px}
.val-i{display:flex;align-items:center;gap:9px;font-size:13px}
.val-d{width:7px;height:7px;border-radius:50%;background:var(--primary);flex-shrink:0}
.testi-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:14px;margin-top:8px}
.testi{background:var(--ps);border-radius:12px;padding:16px}
.testi-s{color:var(--accent);font-size:13px;margin-bottom:7px}
.testi-t{font-size:12px;line-height:1.6;color:var(--pd);margin-bottom:8px;font-style:italic}
.testi-n{font-weight:700;font-size:12px;color:var(--pd)}
.testi-r{font-size:10px;color:var(--primary)}

/* ═══ HARGA PAKET ═══ */
.pkg-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:18px;margin-top:8px}
.pkg{background:#fff;border:2px solid var(--bd);border-radius:18px;padding:24px;position:relative;transition:.3s;overflow:hidden}
.pkg.popular{border-color:var(--primary)}
.pkg.popular::before{content:'⭐ TERPOPULER';position:absolute;top:12px;right:-28px;background:var(--primary);color:#fff;font-size:9px;font-weight:700;padding:4px 36px;transform:rotate(45deg);letter-spacing:1px}
.pkg:hover{box-shadow:0 12px 36px var(--shl);transform:translateY(-4px)}
.pkg-icon{font-size:38px;margin-bottom:10px;display:block}
.pkg-name{font-family:'Playfair Display',serif;font-size:20px;font-weight:700;margin-bottom:4px}
.pkg-type{font-size:11px;color:var(--primary);font-weight:600;text-transform:uppercase;letter-spacing:1px;margin-bottom:14px}
.pkg-price{font-family:'Playfair Display',serif;font-size:28px;font-weight:700;color:var(--primary);margin-bottom:2px}
.pkg-price span{font-size:14px;font-weight:400;color:var(--tm);font-family:'DM Sans',sans-serif}
.pkg-period{font-size:12px;color:var(--tm);margin-bottom:16px}
.pkg-feats{display:flex;flex-direction:column;gap:7px;margin-bottom:18px}
.pf{display:flex;align-items:center;gap:7px;font-size:12px}
.pf-ok{color:var(--green);font-size:14px}
.pf-no{color:var(--tl);font-size:14px}
.pf.dim{color:var(--tl)}

/* ═══ FAQ ═══ */
.faq-list{display:flex;flex-direction:column;gap:10px}
.faq-item{background:#fff;border:1px solid var(--bd);border-radius:12px;overflow:hidden;transition:.2s}
.faq-item:hover{border-color:var(--pl)}
.faq-q{padding:16px 18px;font-weight:600;font-size:13px;cursor:pointer;display:flex;justify-content:space-between;align-items:center;gap:12px}
.faq-arr{font-size:18px;color:var(--primary);transition:.3s;flex-shrink:0}
.faq-item.open .faq-arr{transform:rotate(180deg)}
.faq-a{max-height:0;overflow:hidden;transition:.35s ease}
.faq-a-inner{padding:0 18px 16px;font-size:13px;color:var(--tm);line-height:1.7}
.faq-item.open .faq-a{max-height:200px}

/* ═══ KONTAK / ADMIN ═══ */
.kontak-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start}
.kcard{background:#fff;border:1px solid var(--bd);border-radius:16px;padding:22px;transition:.3s}
.kcard:hover{box-shadow:0 8px 28px var(--sh);transform:translateY(-3px)}
.kcard-ico{font-size:36px;margin-bottom:12px;display:block}
.kcard h3{font-family:'Playfair Display',serif;font-size:17px;font-weight:700;margin-bottom:8px}
.kcard p{font-size:13px;color:var(--tm);line-height:1.6;margin-bottom:14px}
.kcard-detail{display:flex;flex-direction:column;gap:10px;margin-bottom:16px}
.kd-row{display:flex;align-items:center;gap:10px;font-size:13px}
.kd-ico{width:34px;height:34px;border-radius:9px;background:var(--ps);display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0}
.kd-info strong{display:block;font-size:12px;color:var(--tm);font-weight:500}
.kd-info span{font-weight:600;font-size:14px}
.jam-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:12px}
.jam-item{background:var(--ps);border-radius:10px;padding:12px;text-align:center}
.jam-day{font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;color:var(--primary);margin-bottom:4px}
.jam-time{font-weight:700;font-size:14px;color:var(--pd)}
.kmap-mini{background:linear-gradient(135deg,var(--ps),#ddd6fe);border-radius:14px;height:160px;display:flex;align-items:center;justify-content:center;font-size:48px;position:relative;overflow:hidden;margin-bottom:14px;cursor:pointer;border:1px solid var(--bd);transition:.3s}
.kmap-mini:hover{box-shadow:0 8px 24px var(--sh)}
.social-links{display:flex;gap:10px;margin-top:14px;flex-wrap:wrap}
.slink{display:flex;align-items:center;gap:6px;padding:8px 14px;border-radius:10px;border:1px solid var(--bd);font-size:12px;font-weight:600;text-decoration:none;color:var(--tx);transition:.2s}
.slink:hover{border-color:var(--primary);background:var(--ps);color:var(--primary)}

/* ═══ BERITA/TIPS ═══ */
.blog-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:18px}
.blog-card{background:#fff;border:1px solid var(--bd);border-radius:16px;overflow:hidden;transition:.3s;cursor:pointer}
.blog-card:hover{transform:translateY(-5px);box-shadow:0 14px 40px var(--shl);border-color:var(--pl)}
.blog-thumb{height:150px;display:flex;align-items:center;justify-content:center;font-size:56px;position:relative}
.blog-body{padding:16px}
.blog-cat{font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:var(--primary);margin-bottom:5px}
.blog-title{font-family:'Playfair Display',serif;font-size:16px;font-weight:700;line-height:1.3;margin-bottom:6px}
.blog-excerpt{font-size:12px;color:var(--tm);line-height:1.5;margin-bottom:10px}
.blog-meta{display:flex;justify-content:space-between;align-items:center;font-size:11px;color:var(--tl)}
.blog-read{color:var(--primary);font-weight:600}

/* ═══ PERBANDINGAN ═══ */
.comp-table{width:100%;border-collapse:collapse;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px var(--sh)}
.comp-table thead tr{background:linear-gradient(135deg,var(--pd),var(--primary))}
.comp-table th{padding:14px 16px;text-align:center;color:#fff;font-size:13px;font-weight:600}
.comp-table th:first-child{text-align:left}
.comp-table td{padding:12px 16px;text-align:center;font-size:13px;border-bottom:1px solid var(--bd)}
.comp-table td:first-child{text-align:left;font-weight:600}
.comp-table tbody tr:hover{background:var(--ps)}
.comp-table tbody tr:last-child td{border-bottom:none}
.ct-yes{color:var(--green);font-size:16px}
.ct-no{color:var(--tl);font-size:16px}
.ct-partial{color:var(--accent);font-size:13px;font-weight:600}
.ct-highlight{color:var(--primary);font-weight:700}

/* ═══ VIRTUAL TOUR ═══ */
.tour-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:14px}
.tour-card{background:#fff;border:1px solid var(--bd);border-radius:14px;padding:18px;text-align:center;cursor:pointer;transition:.3s;position:relative;overflow:hidden}
.tour-card::after{content:'▶ Lihat 360°';position:absolute;inset:0;background:rgba(124,58,237,.88);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;opacity:0;transition:.3s}
.tour-card:hover::after{opacity:1}
.tour-card:hover{transform:translateY(-4px);box-shadow:0 10px 28px var(--shl)}
.tour-em{font-size:44px;margin-bottom:10px;display:block}
.tour-n{font-weight:700;font-size:14px;margin-bottom:3px}
.tour-d{font-size:12px;color:var(--tm)}

/* ═══ MODAL ═══ */
.modal-ov{display:none;position:fixed;inset:0;background:rgba(30,27,46,.55);z-index:9999;align-items:center;justify-content:center;backdrop-filter:blur(4px)}
.modal-ov.open{display:flex;animation:fadeUp .25s}
.modal{background:#fff;border-radius:22px;padding:28px;max-width:420px;width:92%;box-shadow:0 24px 80px rgba(0,0,0,.2);max-height:90vh;overflow-y:auto}
.modal-hd{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px}
.modal-ttl{font-family:'Playfair Display',serif;font-size:19px;font-weight:700}
.modal-cls{width:30px;height:30px;border-radius:50%;border:1px solid var(--bd);background:none;cursor:pointer;font-size:17px;display:flex;align-items:center;justify-content:center;transition:.2s}
.modal-cls:hover{background:var(--ps)}
.modal-room{background:var(--ps);border-radius:12px;padding:14px;margin-bottom:16px;display:flex;gap:12px;align-items:center}
.modal-opts{display:flex;flex-direction:column;gap:7px;margin-bottom:16px}
.mopt{display:flex;align-items:center;gap:9px;padding:10px 14px;border:1.5px solid var(--bd);border-radius:11px;cursor:pointer;transition:.2s;font-size:13px}
.mopt:hover,.mopt.sel{border-color:var(--pl);background:var(--ps)}
.btn-wa-modal{width:100%;background:var(--wa);color:#fff;border:none;border-radius:12px;padding:13px;font-size:14px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:.25s;text-decoration:none}
.btn-wa-modal:hover{opacity:.92;transform:translateY(-1px);box-shadow:0 7px 22px rgba(37,211,102,.35)}

/* ═══ WA FLOAT ═══ */
.wa-float{position:fixed;bottom:22px;right:22px;z-index:998;background:var(--wa);color:#fff;width:56px;height:56px;border-radius:50%;font-size:26px;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 6px 22px rgba(37,211,102,.45);text-decoration:none;transition:.25s;animation:waPop 2.5s ease-in-out infinite}
.wa-float:hover{transform:scale(1.12);box-shadow:0 10px 30px rgba(37,211,102,.6)}
@keyframes waPop{0%,100%{box-shadow:0 6px 22px rgba(37,211,102,.45),0 0 0 0 rgba(37,211,102,.28)}65%{box-shadow:0 6px 22px rgba(37,211,102,.45),0 0 0 16px rgba(37,211,102,0)}}
.wa-tooltip{position:absolute;right:64px;background:#fff;color:var(--tx);font-size:11px;font-weight:600;white-space:nowrap;padding:5px 11px;border-radius:7px;box-shadow:0 4px 14px rgba(0,0,0,.1);opacity:0;pointer-events:none;transition:.2s}
.wa-float:hover .wa-tooltip{opacity:1}

/* CTA BOX */
.cta-box{background:linear-gradient(135deg,var(--pd),var(--primary));border-radius:18px;padding:30px;text-align:center;color:#fff;margin-top:32px;position:relative;overflow:hidden}
.cta-box::before{content:'';position:absolute;top:-40px;right:-40px;width:140px;height:140px;border-radius:50%;background:rgba(255,255,255,.06)}
.cta-box h3{font-family:'Playfair Display',serif;font-size:clamp(18px,3vw,24px);margin-bottom:9px}
.cta-box p{opacity:.85;font-size:13px;max-width:380px;margin:0 auto 18px;line-height:1.6}
.cta-link{background:#fff;color:var(--pd);padding:12px 26px;border-radius:11px;font-weight:700;font-size:14px;text-decoration:none;display:inline-flex;align-items:center;gap:7px;transition:.2s}
.cta-link:hover{opacity:.92;transform:translateY(-1px)}

/* BREADCRUMB */
.breadcrumb{padding:14px 20px;max-width:1100px;margin:0 auto;display:flex;align-items:center;gap:8px;font-size:12px;color:var(--tm)}
.breadcrumb span.sep{color:var(--tl)}
.breadcrumb span.cur{color:var(--primary);font-weight:600}

/* FOOTER */
.footer{background:var(--pd);color:rgba(255,255,255,.7);padding:40px 20px 28px;margin-top:48px}
.footer-top{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:32px;max-width:1100px;margin:0 auto;padding-bottom:28px;border-bottom:1px solid rgba(255,255,255,.12)}
.footer-brand .fb-logo{font-family:'Playfair Display',serif;font-size:20px;color:#fff;font-weight:700;margin-bottom:10px;display:flex;align-items:center;gap:8px}
.footer-brand p{font-size:12px;line-height:1.7;margin-bottom:14px}
.footer-wa{display:inline-flex;align-items:center;gap:7px;background:var(--wa);color:#fff;padding:9px 18px;border-radius:18px;font-weight:700;font-size:13px;text-decoration:none;transition:.2s}
.footer-wa:hover{opacity:.9}
.footer-col h4{font-size:13px;font-weight:700;color:#fff;margin-bottom:12px}
.footer-col a{display:block;font-size:12px;color:rgba(255,255,255,.6);text-decoration:none;margin-bottom:8px;transition:.2s}
.footer-col a:hover{color:#fff}
.footer-bottom{max-width:1100px;margin:20px auto 0;display:flex;justify-content:space-between;align-items:center;font-size:11px;flex-wrap:wrap;gap:8px}
.footer-bottom a{color:rgba(255,255,255,.5);text-decoration:none}
.footer-bottom a:hover{color:#fff}

/* SCROLL TO TOP */
.scroll-top{position:fixed;bottom:88px;right:22px;z-index:997;width:38px;height:38px;background:var(--primary);color:#fff;border:none;border-radius:50%;font-size:16px;cursor:pointer;display:none;align-items:center;justify-content:center;box-shadow:0 4px 14px var(--shl);transition:.25s}
.scroll-top.show{display:flex}
.scroll-top:hover{transform:translateY(-2px);opacity:.9}

/* PROGRESS BAR */
.progress-bar{position:fixed;top:0;left:0;height:3px;background:linear-gradient(90deg,var(--primary),var(--pl));z-index:9999;transition:.1s;width:0}

/* BADGE */
.new-badge{display:inline-flex;align-items:center;gap:4px;background:var(--red);color:#fff;font-size:9px;font-weight:700;padding:2px 6px;border-radius:6px;margin-left:4px;vertical-align:middle}

/* RESPONSIVE */
@media(max-width:900px){
  .footer-top{grid-template-columns:1fr 1fr}
  .loc-l{grid-template-columns:1fr}
  .kontak-grid{grid-template-columns:1fr}
}
@media(max-width:640px){
  .tb-left{display:none}
  .nav-links{display:none}
  .hamburger{display:flex}
  .about-grid{grid-template-columns:1fr}
  .stats-bar .stat-d{display:none}
  .sec{padding:28px 14px}
  .gal-grid{grid-template-columns:1fr 1fr;grid-template-rows:auto}
  .gc:nth-child(1){grid-row:auto;grid-column:1/-1;height:150px}
  .footer-top{grid-template-columns:1fr}
  .comp-table{font-size:11px}
  .comp-table th,.comp-table td{padding:10px 10px}
  .footer-bottom{flex-direction:column;text-align:center}
}
</style>
</head>
<body>
<div class="progress-bar" id="progress"></div>

<!-- FLOATING WA -->
<a class="wa-float" href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20dengan%20Kost%20Harmonia!" target="_blank">
  💬<span class="wa-tooltip">Chat Admin</span>
</a>
<button class="scroll-top" id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">↑</button>

<!-- MODAL -->
<div class="modal-ov" id="modal">
  <div class="modal">
    <div class="modal-hd">
      <div class="modal-ttl">Hubungi Admin</div>
      <button class="modal-cls" onclick="closeModal()">✕</button>
    </div>
    <div class="modal-room">
      <div id="me" style="font-size:38px">🛏️</div>
      <div>
        <div id="mn" style="font-weight:700;font-size:14px;color:var(--pd)"></div>
        <div id="mp" style="font-family:'Playfair Display',serif;color:var(--primary);font-size:17px;font-weight:700"></div>
      </div>
    </div>
    <p style="font-size:12px;color:var(--tm);margin-bottom:12px;line-height:1.5">Pilih topik yang ingin Anda sampaikan ke admin:</p>
    <div class="modal-opts">
      <div class="mopt sel" id="o-tanya" onclick="selOpt('tanya',this)"><span style="font-size:17px">❓</span> Tanya ketersediaan kamar</div>
      <div class="mopt" id="o-survey" onclick="selOpt('survey',this)"><span style="font-size:17px">🏠</span> Jadwalkan survei langsung</div>
      <div class="mopt" id="o-booking" onclick="selOpt('booking',this)"><span style="font-size:17px">📋</span> Langsung booking kamar</div>
      <div class="mopt" id="o-nego" onclick="selOpt('nego',this)"><span style="font-size:17px">💰</span> Negosiasi harga</div>
    </div>
    <a class="btn-wa-modal" id="walink" href="#" target="_blank">💬 Buka WhatsApp Sekarang</a>
  </div>
</div>

<!-- TOP BAR -->
<div class="topbar">
  <div class="tb-left">
    <span class="tb-item">📍 Jl. Cendana No. 12, Surabaya</span>
    <span class="tb-item">📞 +62 812-3456-7890</span>
    <span class="tb-item">🕐 Buka 08.00–21.00 WIB</span>
  </div>
  <div class="tb-right">
    <a class="btn-wa-sm" href="https://wa.me/6281234567890?text=Halo%2C%20mau%20tanya%20info%20kost%20Harmonia" target="_blank">💬 WhatsApp Admin</a>
  </div>
</div>

<!-- NAVBAR -->
<nav class="navbar">
  <div class="logo" onclick="goPage('beranda')">
    <div class="logo-ico">🏠</div>
    <div class="logo-txt">Kost <span>Harmonia</span></div>
  </div>
  <div class="nav-links">
    <button class="nl on" onclick="goPage('beranda',this)">🏡 Beranda</button>
    <button class="nl" onclick="goPage('kamar',this)">🛏️ Kamar</button>
    <button class="nl" onclick="goPage('fasilitas',this)">✨ Fasilitas</button>
    <button class="nl" onclick="goPage('harga',this)">💰 Harga</button>
    <button class="nl" onclick="goPage('tatatertib',this)">📋 Tata Tertib</button>
    <button class="nl" onclick="goPage('lokasi',this)">📍 Lokasi</button>
    <button class="nl" onclick="goPage('info',this)">ℹ️ Info<span class="new-badge">NEW</span></button>
    <button class="nl" onclick="goPage('kontak',this)">💬 Kontak</button>
  </div>
  <div class="nav-r">
    <div class="notif-btn" onclick="goPage('beranda')">🔔<div class="nbadge">3</div></div>
    <a class="nav-wa" href="https://wa.me/6281234567890" target="_blank">💬 WA</a>
    <div class="hamburger" onclick="toggleMenu()" id="ham">
      <span></span><span></span><span></span>
    </div>
  </div>
</nav>
<div class="mobile-menu" id="mobileMenu">
  <button class="mm-link on" onclick="goPage('beranda',this)">🏡 Beranda</button>
  <button class="mm-link" onclick="goPage('kamar',this)">🛏️ Kamar</button>
  <button class="mm-link" onclick="goPage('fasilitas',this)">✨ Fasilitas</button>
  <button class="mm-link" onclick="goPage('harga',this)">💰 Harga & Paket</button>
  <button class="mm-link" onclick="goPage('tatatertib',this)">📋 Tata Tertib</button>
  <button class="mm-link" onclick="goPage('lokasi',this)">📍 Lokasi</button>
  <button class="mm-link" onclick="goPage('info',this)">ℹ️ Info & Tips</button>
  <button class="mm-link" onclick="goPage('kontak',this)">💬 Kontak</button>
</div>

<!-- ══════════════════════ BERANDA ══════════════════════ -->
<div id="page-beranda" class="page on">
  <div class="hero">
    <div class="hero-tag"><div class="hero-dot"></div>🏠 Kost Terbaik Surabaya Selatan</div>
    <h1>Hunian Nyaman,<br>Harga Terjangkau ✨</h1>
    <p>Kamar bersih, fasilitas lengkap, lokasi strategis. Lihat pilihan kamar dan hubungi admin via WhatsApp!</p>
    <div class="hero-btns">
      <button class="btn-white" onclick="goPage('kamar')">🛏️ Lihat Kamar</button>
      <a class="btn-wa-hero" href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20kost%20Harmonia%2C%20bisa%20info%3F" target="_blank">💬 Tanya via WhatsApp</a>
    </div>
  </div>
  <div class="stats-bar">
    <div style="text-align:center"><div class="stat-v">24</div><div class="stat-l">Total Kamar</div></div>
    <div class="stat-d"></div>
    <div style="text-align:center"><div class="stat-v" style="color:var(--green)">6</div><div class="stat-l">Tersedia</div></div>
    <div class="stat-d"></div>
    <div style="text-align:center"><div class="stat-v">5★</div><div class="stat-l">Rating</div></div>
    <div class="stat-d"></div>
    <div style="text-align:center"><div class="stat-v">3 Thn</div><div class="stat-l">Berdiri</div></div>
    <div class="stat-d"></div>
    <div style="text-align:center"><div class="stat-v">200+</div><div class="stat-l">Alumni</div></div>
  </div>
  <div class="sec">
    <div class="sec-hdr"><div class="sec-ey">Jelajahi</div><div class="sec-t">Semua yang Ada di <em>Harmonia</em></div></div>
    <div class="card-grid">
      <div class="qcard" onclick="goPage('kamar')"><div class="qcard-ico" style="background:#ede9fe">🛏️</div><div class="qcard-t">Pilihan Kamar</div><div class="qcard-d">Lihat tipe & harga, pesan via WA</div></div>
      <div class="qcard" onclick="goPage('fasilitas')"><div class="qcard-ico" style="background:#d1fae5">✨</div><div class="qcard-t">Fasilitas</div><div class="qcard-d">WiFi, gym, dapur, laundry, CCTV</div></div>
      <div class="qcard" onclick="goPage('harga')"><div class="qcard-ico" style="background:#fef3c7">💰</div><div class="qcard-t">Harga & Paket</div><div class="qcard-d">Bandingkan paket & harga terbaik</div></div>
      <div class="qcard" onclick="goPage('tatatertib')"><div class="qcard-ico" style="background:#fee2e2">📋</div><div class="qcard-t">Tata Tertib</div><div class="qcard-d">Aturan penghuni yang wajib diketahui</div></div>
      <div class="qcard" onclick="goPage('lokasi')"><div class="qcard-ico" style="background:#e0f2fe">📍</div><div class="qcard-t">Lokasi</div><div class="qcard-d">Dekat kampus, RS & minimarket</div></div>
      <div class="qcard" onclick="goPage('info')"><div class="qcard-ico" style="background:#f0fdf4">📰</div><div class="qcard-t">Info & Tips</div><div class="qcard-d">FAQ & tips nyaman ngekos</div></div>
      <div class="qcard" onclick="goPage('kontak')"><div class="qcard-ico" style="background:#fdf4ff">💬</div><div class="qcard-t">Kontak Admin</div><div class="qcard-d">Chat WA, telepon, atau kunjungi</div></div>
      <div class="qcard" onclick="window.open('https://wa.me/6281234567890?text=Halo%2C%20mau%20survei%20kost%20Harmonia','_blank')"><div class="qcard-ico" style="background:#fff7ed">🏠</div><div class="qcard-t">Survei Gratis</div><div class="qcard-d">Jadwalkan kunjungan langsung via WA</div></div>
    </div>

    <!-- PENGUMUMAN -->
    <div class="sec-hdr" style="margin-top:44px"><div class="sec-ey">Update</div><div class="sec-t">Pengumuman <em>Terkini</em></div></div>
    <div class="ann-list">
      <div class="ann"><div class="ann-ic" style="background:var(--ps)">🎉</div><div><div class="ann-t">Promo Kamar Deluxe — Diskon 10% Maret 2026</div><div class="ann-d">Penghuni baru yang masuk Maret 2026 mendapat diskon 10% untuk kamar Deluxe. Hubungi admin WA sekarang!</div><div class="ann-meta"><span class="ann-date">🕐 Hari ini</span><span class="pill" style="background:var(--ps);color:var(--pd)">Promo</span></div></div></div>
      <div class="ann"><div class="ann-ic" style="background:#fef3c7">🔧</div><div><div class="ann-t">Perbaikan Saluran Air Lantai 2</div><div class="ann-d">Toilet bersama lantai 2 sedang diperbaiki. Gunakan lantai 1 sementara waktu.</div><div class="ann-meta"><span class="ann-date">🕐 Hari ini, 09.00</span><span class="pill" style="background:#fef3c7;color:#92400e">Maintenance</span></div></div></div>
      <div class="ann"><div class="ann-ic" style="background:#d1fae5">✅</div><div><div class="ann-t">2 Kamar Baru Lantai 3 Siap Ditempati</div><div class="ann-d">Unit baru AC, KM dalam, view kota sudah siap. Survei via WA segera!</div><div class="ann-meta"><span class="ann-date">🕐 2 hari lalu</span><span class="pill" style="background:#d1fae5;color:#065f46">Tersedia</span></div></div></div>
      <div class="ann"><div class="ann-ic" style="background:#e0f2fe">📅</div><div><div class="ann-t">Arisan Penghuni — Sabtu 15 Maret 2026</div><div class="ann-d">Arisan bulanan penghuni di ruang bersama lantai 1, pukul 19.00 WIB. Semua penghuni diundang!</div><div class="ann-meta"><span class="ann-date">🕐 3 hari lalu</span><span class="pill" style="background:#e0f2fe;color:#1e40af">Acara</span></div></div></div>
    </div>

    <!-- TESTIMONI SINGKAT -->
    <div class="sec-hdr" style="margin-top:44px"><div class="sec-ey">Ulasan</div><div class="sec-t">Kata Penghuni Tentang <em>Harmonia</em></div></div>
    <div class="testi-grid">
      <div class="testi"><div class="testi-s">★★★★★</div><div class="testi-t">"Kamarnya bersih, AC dingin, admin super responsif! Sudah 1,5 tahun di sini."</div><div class="testi-n">Dina R.</div><div class="testi-r">Kamar Deluxe · Mahasiswi Unair</div></div>
      <div class="testi"><div class="testi-s">★★★★★</div><div class="testi-t">"Lokasi dekat kantor, parkir luas, laundry murah. Worth it banget!"</div><div class="testi-n">Bagas S.</div><div class="testi-r">Suite VIP · Karyawan Swasta</div></div>
      <div class="testi"><div class="testi-s">★★★★☆</div><div class="testi-t">"Lingkungan tenang dan aman. Suka banget taman & gazebo-nya!"</div><div class="testi-n">Ayu M.</div><div class="testi-r">Standard · Freelancer</div></div>
      <div class="testi"><div class="testi-s">★★★★★</div><div class="testi-t">"Harga terjangkau dengan fasilitas lengkap. Kamar baru di lantai 3 keren banget!"</div><div class="testi-n">Reza P.</div><div class="testi-r">Deluxe Corner · Mahasiswa ITS</div></div>
    </div>
    <div class="cta-box">
      <div style="font-size:34px;margin-bottom:10px">💬</div>
      <h3>Siap Pindah ke Harmonia?</h3>
      <p>Chat admin sekarang — survei gratis, info lengkap, proses cepat!</p>
      <a class="cta-link" href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20info%20dan%20survei%20Kost%20Harmonia" target="_blank">💬 Chat Admin via WhatsApp</a>
    </div>
  </div>
</div>

<!-- ══════════════════════ KAMAR ══════════════════════ -->
<div id="page-kamar" class="page">
  <div class="hero" style="padding:38px 20px 58px">
    <div class="hero-tag"><div class="hero-dot"></div>6 Kamar Tersedia</div>
    <h1>Pilih <em style="color:#fbbf24">Kamar</em> Anda</h1>
    <p>Lihat detail, harga, & fasilitas. Suka? Langsung tanya atau pesan via WhatsApp!</p>
  </div>
  <div class="breadcrumb"><span onclick="goPage('beranda')" style="cursor:pointer;color:var(--primary)">Beranda</span><span class="sep">›</span><span class="cur">Kamar</span></div>
  <div class="sec" style="padding-top:8px">
    <div class="rf">
      <button class="fb on" onclick="filterR('semua',this)">🏠 Semua</button>
      <button class="fb" onclick="filterR('tersedia',this)">✅ Tersedia</button>
      <button class="fb" onclick="filterR('standard',this)">🛏️ Standard</button>
      <button class="fb" onclick="filterR('deluxe',this)">⭐ Deluxe</button>
      <button class="fb" onclick="filterR('vip',this)">👑 VIP</button>
    </div>
    <div class="room-grid" id="rg">
      <div class="rcard" data-t="standard" data-s="tersedia"><div class="rthumb" style="background:linear-gradient(135deg,var(--ps),#ddd6fe)"><span class="rthumb-emoji">🛏️</span><div class="rovl"></div><div class="rbadge bavail">✅ Tersedia</div><div class="rfav">🤍</div></div><div class="rinfo"><div class="rtype">Standard</div><div class="rname">Kamar Standard A</div><div class="rdesc">Nyaman 10 m², lantai 1, akses mudah. Cocok untuk mahasiswa & karyawan.</div><div class="rprice">Rp 900.000 <span>/bulan</span></div><div class="rtags"><span class="rtag">❄️ AC</span><span class="rtag">📶 WiFi</span><span class="rtag">🚿 KM Luar</span><span class="rtag">🪑 Meja</span></div><button class="btn-wa" onclick="openModal('🛏️','Kamar Standard A','Rp 900.000')">💬 Tanya / Pesan via WA</button></div></div>
      <div class="rcard" data-t="standard" data-s="tersedia"><div class="rthumb" style="background:linear-gradient(135deg,#ddd6fe,#c4b5fd)"><span class="rthumb-emoji">🏠</span><div class="rovl"></div><div class="rbadge bavail">✅ Tersedia</div><div class="rfav">🤍</div></div><div class="rinfo"><div class="rtype">Standard</div><div class="rname">Kamar Standard B</div><div class="rdesc">Lantai 2, view taman, lebih tenang. Ideal untuk belajar & beristirahat.</div><div class="rprice">Rp 950.000 <span>/bulan</span></div><div class="rtags"><span class="rtag">❄️ AC</span><span class="rtag">📶 WiFi</span><span class="rtag">🌿 View Taman</span><span class="rtag">🚿 KM Luar</span></div><button class="btn-wa" onclick="openModal('🏠','Kamar Standard B','Rp 950.000')">💬 Tanya / Pesan via WA</button></div></div>
      <div class="rcard" data-t="deluxe" data-s="tersedia"><div class="rthumb" style="background:linear-gradient(135deg,#fef3c7,#fde68a)"><span class="rthumb-emoji">⭐</span><div class="rovl"></div><div class="rbadge bavail">✅ Tersedia</div><div class="rfav">🤍</div></div><div class="rinfo"><div class="rtype">Deluxe</div><div class="rname">Kamar Deluxe Plus</div><div class="rdesc">14 m², KM dalam, kasur queen, Smart TV. Kamar paling favorit!</div><div class="rprice">Rp 1.300.000 <span>/bulan</span></div><div class="rtags"><span class="rtag">❄️ AC</span><span class="rtag">📺 Smart TV</span><span class="rtag">🚿 KM Dalam</span><span class="rtag">🛁 Air Panas</span></div><button class="btn-wa" onclick="openModal('⭐','Kamar Deluxe Plus','Rp 1.300.000')">💬 Tanya / Pesan via WA</button></div></div>
      <div class="rcard" data-t="deluxe" data-s="tersedia"><div class="rthumb" style="background:linear-gradient(135deg,#d1fae5,#a7f3d0)"><span class="rthumb-emoji">🌟</span><div class="rovl"></div><div class="rbadge bavail">✅ Tersedia</div><div class="rfav">🤍</div></div><div class="rinfo"><div class="rtype">Deluxe</div><div class="rname">Kamar Deluxe Corner</div><div class="rdesc">Sudut lantai 3, dua jendela besar, cahaya alami melimpah, view kota.</div><div class="rprice">Rp 1.400.000 <span>/bulan</span></div><div class="rtags"><span class="rtag">❄️ AC</span><span class="rtag">📺 Smart TV</span><span class="rtag">🌄 View Kota</span><span class="rtag">🚿 KM Dalam</span></div><button class="btn-wa" onclick="openModal('🌟','Kamar Deluxe Corner','Rp 1.400.000')">💬 Tanya / Pesan via WA</button></div></div>
      <div class="rcard" data-t="vip" data-s="tersedia"><div class="rthumb" style="background:linear-gradient(135deg,#ede9fe,#c4b5fd)"><span class="rthumb-emoji">👑</span><div class="rovl"></div><div class="rbadge bavail">✅ Tersedia</div><div class="rfav">🤍</div></div><div class="rinfo"><div class="rtype">VIP</div><div class="rname">Suite Premium VIP</div><div class="rdesc">20 m², ruang kerja terpisah, bathtub, kasur king. Eksklusif!</div><div class="rprice">Rp 2.000.000 <span>/bulan</span></div><div class="rtags"><span class="rtag">❄️ AC 1PK</span><span class="rtag">📺 Smart TV</span><span class="rtag">🛁 Bathtub</span><span class="rtag">💼 Ruang Kerja</span></div><button class="btn-wa" onclick="openModal('👑','Suite Premium VIP','Rp 2.000.000')">💬 Tanya / Pesan via WA</button></div></div>
      <div class="rcard" data-t="standard" data-s="reserved"><div class="rthumb" style="background:linear-gradient(135deg,#fff7ed,#fed7aa)"><span class="rthumb-emoji">⏳</span><div class="rovl"></div><div class="rbadge bres">⏳ Direservasi</div></div><div class="rinfo"><div class="rtype">Standard</div><div class="rname">Kamar Standard C</div><div class="rdesc">Sedang dalam proses reservasi. Daftar waitlist via WhatsApp.</div><div class="rprice" style="color:var(--tm)">Rp 900.000 <span>/bulan</span></div><div class="rtags"><span class="rtag" style="background:#f3f4f6;color:#9ca3af">❄️ AC</span><span class="rtag" style="background:#f3f4f6;color:#9ca3af">📶 WiFi</span></div><a class="btn-wa" style="background:#f59e0b" href="https://wa.me/6281234567890?text=Halo%2C%20mau%20daftar%20waitlist%20Kamar%20Standard%20C" target="_blank">📋 Daftar Waitlist via WA</a></div></div>
      <div class="rcard" data-t="deluxe" data-s="penuh"><div class="rthumb" style="background:linear-gradient(135deg,#f3f4f6,#e5e7eb)"><span class="rthumb-emoji">🔒</span><div class="rovl"></div><div class="rbadge bfull">🔒 Terisi</div></div><div class="rinfo"><div class="rtype">Deluxe</div><div class="rname">Kamar Deluxe D</div><div class="rdesc">Sedang terisi. Daftar waitlist dan kami hubungi jika ada kamar kosong.</div><div class="rprice" style="color:var(--tm)">Rp 1.200.000 <span>/bulan</span></div><div class="rtags"><span class="rtag" style="background:#f3f4f6;color:#9ca3af">❄️ AC</span><span class="rtag" style="background:#f3f4f6;color:#9ca3af">📺 TV</span></div><a class="btn-wa" style="background:#6b7280" href="https://wa.me/6281234567890?text=Halo%2C%20mau%20daftar%20waitlist%20Kamar%20Deluxe%20D" target="_blank">📋 Daftar Waitlist via WA</a></div></div>
    </div>
    <div class="cta-box">
      <div style="font-size:32px;margin-bottom:8px">💬</div>
      <h3>Bingung Pilih Kamar?</h3>
      <p>Ceritakan kebutuhan Anda ke admin, kami rekomendasikan kamar yang paling cocok!</p>
      <a class="cta-link" href="https://wa.me/6281234567890?text=Halo%2C%20saya%20butuh%20rekomendasi%20kamar%20yang%20sesuai%20kebutuhan%20saya" target="_blank">💬 Minta Rekomendasi via WA</a>
    </div>
  </div>
</div>

<!-- ══════════════════════ FASILITAS ══════════════════════ -->
<div id="page-fasilitas" class="page">
  <div class="hero" style="padding:38px 20px 58px">
    <div class="hero-tag"><div class="hero-dot"></div>25+ Fasilitas</div>
    <h1>Fasilitas <em style="color:#fbbf24">Lengkap</em></h1>
    <p>Semua yang Anda butuhkan sudah tersedia di Kost Harmonia.</p>
  </div>
  <div class="breadcrumb"><span onclick="goPage('beranda')" style="cursor:pointer;color:var(--primary)">Beranda</span><span class="sep">›</span><span class="cur">Fasilitas</span></div>
  <div class="sec" style="padding-top:8px">
    <div class="sec-hdr"><div class="sec-ey">Dalam Kamar</div><div class="sec-t">Fasilitas <em>Per Kamar</em></div></div>
    <div class="fac-grid">
      <div class="fac"><span class="fac-em">🛏️</span><div class="fac-n">Kasur Spring Bed</div><div class="fac-d">Queen/King size</div><div class="fac-s"><div class="fac-sd"></div>Semua Kamar</div></div>
      <div class="fac"><span class="fac-em">❄️</span><div class="fac-n">AC Dingin</div><div class="fac-d">0.5–1 PK per kamar</div><div class="fac-s"><div class="fac-sd"></div>Semua Kamar</div></div>
      <div class="fac"><span class="fac-em">📶</span><div class="fac-n">WiFi 100 Mbps</div><div class="fac-d">Fiber, unlimited</div><div class="fac-s"><div class="fac-sd"></div>Online</div></div>
      <div class="fac"><span class="fac-em">📺</span><div class="fac-n">Smart TV 32"</div><div class="fac-d">Android TV</div><div class="fac-s"><div class="fac-sd"></div>Deluxe & VIP</div></div>
      <div class="fac"><span class="fac-em">🪑</span><div class="fac-n">Meja & Kursi</div><div class="fac-d">Ergonomis</div><div class="fac-s"><div class="fac-sd"></div>Semua Kamar</div></div>
      <div class="fac"><span class="fac-em">🛁</span><div class="fac-n">Air Panas</div><div class="fac-d">Water heater</div><div class="fac-s"><div class="fac-sd"></div>Deluxe & VIP</div></div>
      <div class="fac"><span class="fac-em">🗄️</span><div class="fac-n">Lemari Pakaian</div><div class="fac-d">2 pintu sliding</div><div class="fac-s"><div class="fac-sd"></div>Semua Kamar</div></div>
      <div class="fac"><span class="fac-em">🔌</span><div class="fac-n">Stop Kontak</div><div class="fac-d">4 titik per kamar</div><div class="fac-s"><div class="fac-sd"></div>Semua Kamar</div></div>
    </div>
    <div class="sec-hdr" style="margin-top:38px"><div class="sec-ey">Area Umum</div><div class="sec-t">Fasilitas <em>Bersama</em></div></div>
    <div class="fac-grid">
      <div class="fac"><span class="fac-em">🏋️</span><div class="fac-n">Gym Mini</div><div class="fac-d">Lantai 3, 24 jam</div><div class="fac-s"><div class="fac-sd"></div>Buka</div></div>
      <div class="fac"><span class="fac-em">🍽️</span><div class="fac-n">Dapur Bersama</div><div class="fac-d">Kompor, kulkas, microwave</div><div class="fac-s"><div class="fac-sd"></div>Buka</div></div>
      <div class="fac"><span class="fac-em">👗</span><div class="fac-n">Laundry Kiloan</div><div class="fac-d">Rp 7.000/kg</div><div class="fac-s"><div class="fac-sd"></div>Buka</div></div>
      <div class="fac"><span class="fac-em">🛵</span><div class="fac-n">Parkir Luas</div><div class="fac-d">Motor & mobil</div><div class="fac-s"><div class="fac-sd"></div>Tersedia</div></div>
      <div class="fac"><span class="fac-em">🌿</span><div class="fac-n">Taman & Gazebo</div><div class="fac-d">Santai outdoor</div><div class="fac-s"><div class="fac-sd"></div>Buka</div></div>
      <div class="fac"><span class="fac-em">📚</span><div class="fac-n">Ruang Belajar</div><div class="fac-d">AC, tenang, cozy</div><div class="fac-s"><div class="fac-sd"></div>Buka</div></div>
      <div class="fac"><span class="fac-em">🔒</span><div class="fac-n">Keamanan 24 Jam</div><div class="fac-d">Satpam + CCTV</div><div class="fac-s"><div class="fac-sd"></div>Aktif</div></div>
      <div class="fac"><span class="fac-em">🧹</span><div class="fac-n">Cleaning Service</div><div class="fac-d">Area umum tiap hari</div><div class="fac-s maint"><div class="fac-sd"></div>Tiap Pagi</div></div>
      <div class="fac"><span class="fac-em">💧</span><div class="fac-n">Dispenser Gratis</div><div class="fac-d">Tiap lantai</div><div class="fac-s"><div class="fac-sd"></div>Tersedia</div></div>
      <div class="fac"><span class="fac-em">🏥</span><div class="fac-n">P3K</div><div class="fac-d">Kotak obat tiap lantai</div><div class="fac-s"><div class="fac-sd"></div>Tersedia</div></div>
      <div class="fac"><span class="fac-em">📦</span><div class="fac-n">Loker Titipan</div><div class="fac-d">Keamanan barang</div><div class="fac-s"><div class="fac-sd"></div>Tersedia</div></div>
      <div class="fac"><span class="fac-em">☕</span><div class="fac-n">Mini Kantin</div><div class="fac-d">Lantai 1, snack & minum</div><div class="fac-s maint"><div class="fac-sd"></div>07.00–22.00</div></div>
    </div>
    <div style="background:linear-gradient(135deg,var(--ps),#f3e8ff);border:1px solid var(--pl);border-radius:16px;padding:22px;margin-top:28px;display:flex;gap:14px;align-items:flex-start">
      <div style="font-size:22px;flex-shrink:0">💡</div>
      <div>
        <div style="font-weight:700;font-size:14px;margin-bottom:5px">Ada pertanyaan tentang fasilitas?</div>
        <div style="font-size:13px;color:var(--tm);line-height:1.6;margin-bottom:12px">Tanya detail fasilitas langsung ke admin kami via WhatsApp, kami siap menjawab!</div>
        <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20tanya%20detail%20fasilitas%20Kost%20Harmonia" target="_blank" class="btn-wa" style="width:auto;display:inline-flex;padding:9px 18px;font-size:12px">💬 Tanya via WA</a>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════ HARGA & PAKET ══════════════════════ -->
<div id="page-harga" class="page">
  <div class="hero" style="padding:38px 20px 58px">
    <div class="hero-tag"><div class="hero-dot"></div>Transparan & Tanpa Biaya Tersembunyi</div>
    <h1>Harga &<br><em style="color:#fbbf24">Paket Sewa</em></h1>
    <p>Pilih paket yang sesuai kebutuhan. Harga terjangkau, fasilitas premium!</p>
  </div>
  <div class="breadcrumb"><span onclick="goPage('beranda')" style="cursor:pointer;color:var(--primary)">Beranda</span><span class="sep">›</span><span class="cur">Harga & Paket</span></div>
  <div class="sec" style="padding-top:8px">
    <div class="sec-hdr"><div class="sec-ey">Paket Kamar</div><div class="sec-t">Pilih <em>Sesuai Budget</em></div></div>
    <div class="pkg-grid">
      <div class="pkg"><span class="pkg-icon">🛏️</span><div class="pkg-name">Standard</div><div class="pkg-type">Kamar 10 m²</div><div class="pkg-price">Rp 900.000 <span>/bulan</span></div><div class="pkg-period">Mulai dari · Belum termasuk listrik</div><div class="pkg-feats"><div class="pf"><span class="pf-ok">✓</span>Kasur spring bed</div><div class="pf"><span class="pf-ok">✓</span>AC 0.5 PK</div><div class="pf"><span class="pf-ok">✓</span>WiFi 100 Mbps</div><div class="pf"><span class="pf-ok">✓</span>Meja & kursi belajar</div><div class="pf"><span class="pf-ok">✓</span>Lemari 2 pintu</div><div class="pf dim"><span class="pf-no">✗</span>Kamar mandi dalam</div><div class="pf dim"><span class="pf-no">✗</span>Smart TV</div><div class="pf dim"><span class="pf-no">✗</span>Air panas</div></div><a class="btn-wa" href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20kamar%20Standard.%20Masih%20tersedia%3F" target="_blank">💬 Tanya via WA</a></div>
      <div class="pkg popular"><span class="pkg-icon">⭐</span><div class="pkg-name">Deluxe</div><div class="pkg-type">Kamar 14 m²</div><div class="pkg-price">Rp 1.300.000 <span>/bulan</span></div><div class="pkg-period">Mulai dari · Belum termasuk listrik</div><div class="pkg-feats"><div class="pf"><span class="pf-ok">✓</span>Kasur queen bed</div><div class="pf"><span class="pf-ok">✓</span>AC 0.5 PK</div><div class="pf"><span class="pf-ok">✓</span>WiFi 100 Mbps</div><div class="pf"><span class="pf-ok">✓</span>Meja & kursi ergonomis</div><div class="pf"><span class="pf-ok">✓</span>Kamar mandi dalam</div><div class="pf"><span class="pf-ok">✓</span>Smart TV 32"</div><div class="pf"><span class="pf-ok">✓</span>Air panas</div><div class="pf dim"><span class="pf-no">✗</span>Ruang kerja terpisah</div></div><a class="btn-wa" href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20kamar%20Deluxe.%20Masih%20tersedia%3F" target="_blank">💬 Tanya via WA</a></div>
      <div class="pkg"><span class="pkg-icon">👑</span><div class="pkg-name">VIP Suite</div><div class="pkg-type">Kamar 20 m²</div><div class="pkg-price">Rp 2.000.000 <span>/bulan</span></div><div class="pkg-period">Mulai dari · Belum termasuk listrik</div><div class="pkg-feats"><div class="pf"><span class="pf-ok">✓</span>Kasur king bed</div><div class="pf"><span class="pf-ok">✓</span>AC 1 PK</div><div class="pf"><span class="pf-ok">✓</span>WiFi 100 Mbps priority</div><div class="pf"><span class="pf-ok">✓</span>Ruang kerja terpisah</div><div class="pf"><span class="pf-ok">✓</span>Kamar mandi + bathtub</div><div class="pf"><span class="pf-ok">✓</span>Smart TV 40"</div><div class="pf"><span class="pf-ok">✓</span>Air panas</div><div class="pf"><span class="pf-ok">✓</span>Mini kulkas</div></div><a class="btn-wa" href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20Suite%20VIP.%20Masih%20tersedia%3F" target="_blank">💬 Tanya via WA</a></div>
    </div>

    <!-- BIAYA TAMBAHAN -->
    <div class="sec-hdr" style="margin-top:42px"><div class="sec-ey">Biaya Lainnya</div><div class="sec-t">Rincian <em>Biaya Tambahan</em></div><div class="sec-sub">Transparan, tidak ada biaya tersembunyi.</div></div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:14px">
      <div style="background:#fff;border:1px solid var(--bd);border-radius:14px;padding:18px"><div style="font-size:28px;margin-bottom:8px">⚡</div><div style="font-weight:700;font-size:14px;margin-bottom:4px">Listrik</div><div style="font-size:13px;color:var(--tm)">Sesuai pemakaian kWh · Tarif PLN berlaku</div></div>
      <div style="background:#fff;border:1px solid var(--bd);border-radius:14px;padding:18px"><div style="font-size:28px;margin-bottom:8px">💧</div><div style="font-weight:700;font-size:14px;margin-bottom:4px">Air PDAM</div><div style="font-size:13px;color:var(--tm)">Flat Rp 25.000/bulan (termasuk paket)</div></div>
      <div style="background:#fff;border:1px solid var(--bd);border-radius:14px;padding:18px"><div style="font-size:28px;margin-bottom:8px">👗</div><div style="font-weight:700;font-size:14px;margin-bottom:4px">Laundry</div><div style="font-size:13px;color:var(--tm)">Rp 7.000/kg · Antar-jemput sendiri</div></div>
      <div style="background:#fff;border:1px solid var(--bd);border-radius:14px;padding:18px"><div style="font-size:28px;margin-bottom:8px">🅿️</div><div style="font-weight:700;font-size:14px;margin-bottom:4px">Parkir Mobil</div><div style="font-size:13px;color:var(--tm)">Rp 150.000/bulan (motor gratis)</div></div>
      <div style="background:#fff;border:1px solid var(--bd);border-radius:14px;padding:18px"><div style="font-size:28px;margin-bottom:8px">🔑</div><div style="font-weight:700;font-size:14px;margin-bottom:4px">Deposit</div><div style="font-size:13px;color:var(--tm)">1× sewa kamar · Dikembalikan saat keluar</div></div>
      <div style="background:#fff;border:1px solid var(--bd);border-radius:14px;padding:18px"><div style="font-size:28px;margin-bottom:8px">⚠️</div><div style="font-weight:700;font-size:14px;margin-bottom:4px">Denda Terlambat</div><div style="font-size:13px;color:var(--tm)">Rp 10.000/hari setelah tanggal 5</div></div>
    </div>

    <!-- PERBANDINGAN -->
    <div class="sec-hdr" style="margin-top:42px"><div class="sec-ey">Komparasi</div><div class="sec-t">Perbandingan <em>Tipe Kamar</em></div></div>
    <div style="overflow-x:auto;border-radius:16px;box-shadow:0 4px 20px var(--sh)">
      <table class="comp-table">
        <thead><tr><th>Fitur</th><th>Standard</th><th>Deluxe</th><th>VIP Suite</th></tr></thead>
        <tbody>
          <tr><td>Luas Kamar</td><td>10 m²</td><td>14 m²</td><td class="ct-highlight">20 m²</td></tr>
          <tr><td>Kasur</td><td>Single/Queen</td><td>Queen</td><td class="ct-highlight">King</td></tr>
          <tr><td>AC</td><td class="ct-yes">✓ 0.5 PK</td><td class="ct-yes">✓ 0.5 PK</td><td class="ct-highlight">✓ 1 PK</td></tr>
          <tr><td>WiFi</td><td class="ct-yes">✓</td><td class="ct-yes">✓</td><td class="ct-highlight">✓ Priority</td></tr>
          <tr><td>KM Dalam</td><td class="ct-no">✗</td><td class="ct-yes">✓</td><td class="ct-yes">✓</td></tr>
          <tr><td>Air Panas</td><td class="ct-no">✗</td><td class="ct-yes">✓</td><td class="ct-yes">✓</td></tr>
          <tr><td>Smart TV</td><td class="ct-no">✗</td><td class="ct-yes">✓ 32"</td><td class="ct-highlight">✓ 40"</td></tr>
          <tr><td>Bathtub</td><td class="ct-no">✗</td><td class="ct-no">✗</td><td class="ct-yes">✓</td></tr>
          <tr><td>Ruang Kerja</td><td class="ct-no">✗</td><td class="ct-no">✗</td><td class="ct-yes">✓</td></tr>
          <tr><td>Mini Kulkas</td><td class="ct-no">✗</td><td class="ct-no">✗</td><td class="ct-yes">✓</td></tr>
          <tr><td>Harga/Bulan</td><td class="ct-highlight">Rp 900rb+</td><td class="ct-highlight">Rp 1,3jt+</td><td class="ct-highlight">Rp 2jt+</td></tr>
        </tbody>
      </table>
    </div>
    <div class="cta-box">
      <div style="font-size:30px;margin-bottom:8px">💰</div>
      <h3>Ingin Negosiasi Harga?</h3>
      <p>Hubungi admin — kami terbuka untuk diskusi, terutama untuk sewa jangka panjang!</p>
      <a class="cta-link" href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20tanya%20kemungkinan%20negosiasi%20harga%20sewa%20kost" target="_blank">💬 Negosiasi via WA</a>
    </div>
  </div>
</div>

<!-- ══════════════════════ TATA TERTIB ══════════════════════ -->
<div id="page-tatatertib" class="page">
  <div class="hero" style="padding:38px 20px 58px">
    <div class="hero-tag"><div class="hero-dot"></div>Berlaku sejak 1 Jan 2025</div>
    <h1>Tata Tertib<br>Penghuni</h1>
    <p>Peraturan demi kenyamanan dan keharmonisan seluruh penghuni Kost Harmonia.</p>
  </div>
  <div class="breadcrumb"><span onclick="goPage('beranda')" style="cursor:pointer;color:var(--primary)">Beranda</span><span class="sep">›</span><span class="cur">Tata Tertib</span></div>
  <div class="sec" style="padding-top:8px">
    <div class="sec-hdr"><div class="sec-ey">Peraturan</div><div class="sec-t">Ketentuan <em>Wajib Ditaati</em></div></div>
    <div class="rul-grid">
      <div class="rgrp"><div class="rgrp-h"><span style="font-size:18px">🕐</span>Jam Operasional</div><div class="rgrp-body"><div class="ri"><div class="rd do">✓</div>Gerbang tutup pukul 23.00 WIB. Hubungi petugas jika terlambat pulang.</div><div class="ri"><div class="rd do">✓</div>Tamu hanya boleh berkunjung pukul 08.00 – 21.00 WIB.</div><div class="ri" style="color:var(--tm)"><div class="rd dont">✗</div>Dilarang menginap tamu tanpa izin pengelola.</div><div class="ri" style="color:var(--tm)"><div class="rd dont">✗</div>Dilarang meminjamkan kunci kamar kepada siapapun.</div></div></div>
      <div class="rgrp"><div class="rgrp-h"><span style="font-size:18px">🧹</span>Kebersihan</div><div class="rgrp-body"><div class="ri"><div class="rd do">✓</div>Buang sampah di tempat yang tersedia di tiap lantai.</div><div class="ri"><div class="rd do">✓</div>Cuci peralatan masak segera setelah digunakan di dapur bersama.</div><div class="ri" style="color:var(--tm)"><div class="rd dont">✗</div>Dilarang membuang sampah di lorong atau tangga.</div><div class="ri" style="color:var(--tm)"><div class="rd dont">✗</div>Dilarang membawa hewan peliharaan tanpa izin admin.</div></div></div>
      <div class="rgrp"><div class="rgrp-h"><span style="font-size:18px">🔇</span>Kebisingan</div><div class="rgrp-body"><div class="ri"><div class="rd do">✓</div>Jaga volume suara, terutama setelah pukul 22.00 WIB.</div><div class="ri" style="color:var(--tm)"><div class="rd dont">✗</div>Dilarang memutar musik keras yang mengganggu penghuni lain.</div><div class="ri" style="color:var(--tm)"><div class="rd dont">✗</div>Dilarang membuat keributan di area bersama manapun.</div></div></div>
      <div class="rgrp"><div class="rgrp-h"><span style="font-size:18px">🔒</span>Keamanan</div><div class="rgrp-body"><div class="ri"><div class="rd do">✓</div>Selalu kunci kamar saat meninggalkan hunian.</div><div class="ri"><div class="rd do">✓</div>Laporkan hal mencurigakan ke admin segera.</div><div class="ri" style="color:var(--tm)"><div class="rd dont">✗</div>Dilarang menyimpan barang berbahaya atau bahan terlarang.</div><div class="ri" style="color:var(--tm)"><div class="rd dont">✗</div>Dilarang merokok di dalam kamar atau area tertutup.</div></div></div>
      <div class="rgrp"><div class="rgrp-h"><span style="font-size:18px">💸</span>Pembayaran</div><div class="rgrp-body"><div class="ri"><div class="rd do">✓</div>Pembayaran paling lambat tanggal 5 setiap bulan.</div><div class="ri"><div class="rd do">✓</div>Pemberitahuan keluar minimal 1 bulan sebelumnya.</div><div class="ri" style="color:var(--tm)"><div class="rd dont">✗</div>Keterlambatan bayar dikenakan denda Rp 10.000/hari.</div></div></div>
      <div class="rgrp"><div class="rgrp-h"><span style="font-size:18px">🏠</span>Fasilitas</div><div class="rgrp-body"><div class="ri"><div class="rd do">✓</div>Gunakan fasilitas dengan bertanggung jawab.</div><div class="ri"><div class="rd do">✓</div>Laporkan kerusakan fasilitas umum ke admin segera.</div><div class="ri" style="color:var(--tm)"><div class="rd dont">✗</div>Dilarang memindahkan/merusak barang inventaris kost.</div><div class="ri" style="color:var(--tm)"><div class="rd dont">✗</div>Dilarang memasak di dalam kamar (gunakan dapur bersama).</div></div></div>
    </div>
    <div style="background:linear-gradient(135deg,var(--ps),#f3e8ff);border:1px solid var(--pl);border-radius:12px;padding:16px 18px;margin-top:18px;display:flex;gap:10px">
      <div style="font-size:18px;flex-shrink:0">📌</div>
      <p style="font-size:12px;line-height:1.7;color:var(--pd)">Pelanggaran dapat mengakibatkan <strong style="color:#7c3aed">teguran, denda, hingga pembatalan kontrak</strong>. Ada pertanyaan? Hubungi admin via <strong style="color:#7c3aed">WhatsApp</strong>.</p>
    </div>
    <div style="text-align:center;margin-top:18px">
      <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20tanya%20tentang%20peraturan%20kost%20Harmonia" target="_blank" class="btn-wa" style="display:inline-flex;width:auto;padding:10px 22px;font-size:13px">💬 Tanya Peraturan via WA</a>
    </div>
  </div>
</div>

<!-- ══════════════════════ LOKASI ══════════════════════ -->
<div id="page-lokasi" class="page">
  <div class="hero" style="padding:38px 20px 58px">
    <div class="hero-tag"><div class="hero-dot"></div>Surabaya Selatan</div>
    <h1>Lokasi &<br>Akses Mudah</h1>
    <p>Dekat kampus, RS, minimarket & transportasi umum.</p>
  </div>
  <div class="breadcrumb"><span onclick="goPage('beranda')" style="cursor:pointer;color:var(--primary)">Beranda</span><span class="sep">›</span><span class="cur">Lokasi</span></div>
  <div class="sec" style="padding-top:8px">
    <div class="loc-l">
      <div>
        <div class="sec-hdr"><div class="sec-ey">Peta</div><div class="sec-t">Kost <em>Harmonia</em></div><div class="sec-sub">Jl. Cendana No. 12, Darmo, Surabaya Selatan, 60265</div></div>
        <div class="mapbox">
          <div class="mbg"></div>
          <div class="radar" style="width:110px;height:110px"></div>
          <div class="radar" style="width:190px;height:190px;animation-delay:-1.5s"></div>
          <div class="mpin"><div class="mpin-ico"><span>🏠</span></div><div class="mpin-lb">Kost Harmonia</div></div>
        </div>
        <div style="display:flex;gap:10px;margin-top:14px;flex-wrap:wrap">
          <a href="https://wa.me/6281234567890?text=Halo%2C%20tolong%20kirim%20link%20Google%20Maps%20Kost%20Harmonia" target="_blank" class="btn-wa" style="flex:1;font-size:12px;padding:10px">💬 Minta Link Maps</a>
          <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20mau%20survei%20langsung%20ke%20Kost%20Harmonia.%20Kapan%20bisa%3F" target="_blank" class="btn-wa" style="flex:1;background:var(--primary);font-size:12px;padding:10px">🏠 Jadwalkan Survei</a>
        </div>
        <div style="background:#fff;border:1px solid var(--bd);border-radius:14px;padding:16px;margin-top:14px">
          <div style="font-weight:700;font-size:13px;margin-bottom:10px">🚌 Transportasi Umum</div>
          <div class="nb-row"><span>🚌 Halte Bus Darmo</span><span class="nb-d">200 m</span></div>
          <div class="nb-row"><span>🚇 Stasiun Wonokromo</span><span class="nb-d">1.2 km</span></div>
          <div class="nb-row"><span>✈️ Bandara Juanda</span><span class="nb-d">18 km</span></div>
          <div class="nb-row"><span>🛵 Ojek Online</span><span class="nb-d">< 3 mnt</span></div>
        </div>
      </div>
      <div class="loc-cards">
        <div class="lcrd"><div class="lch"><div class="lci">🎓</div><div><div style="font-weight:700;font-size:13px">Kampus & Sekolah</div><div style="font-size:11px;color:var(--tm)">Cocok untuk pelajar</div></div></div><div class="nb-row"><span>🎓 Unair</span><span class="nb-d">1.5 km</span></div><div class="nb-row"><span>🎓 UBAYA</span><span class="nb-d">2 km</span></div><div class="nb-row"><span>🏫 SMAN 5 Sby</span><span class="nb-d">600 m</span></div></div>
        <div class="lcrd"><div class="lch"><div class="lci">🏥</div><div><div style="font-weight:700;font-size:13px">Kesehatan</div><div style="font-size:11px;color:var(--tm)">Akses layanan mudah</div></div></div><div class="nb-row"><span>🏥 RS Dr. Soetomo</span><span class="nb-d">2.5 km</span></div><div class="nb-row"><span>🏥 Puskesmas Darmo</span><span class="nb-d">500 m</span></div><div class="nb-row"><span>💊 Apotek K-24</span><span class="nb-d">300 m</span></div></div>
        <div class="lcrd"><div class="lch"><div class="lci">🛒</div><div><div style="font-weight:700;font-size:13px">Belanja & Kuliner</div><div style="font-size:11px;color:var(--tm)">Kebutuhan harian</div></div></div><div class="nb-row"><span>🛒 Alfamart</span><span class="nb-d">100 m</span></div><div class="nb-row"><span>🏪 Giant Supermarket</span><span class="nb-d">1 km</span></div><div class="nb-row"><span>🍜 Warteg Bu Sri</span><span class="nb-d">50 m</span></div><div class="nb-row"><span>☕ Kopi Kenangan</span><span class="nb-d">200 m</span></div></div>
        <div class="lcrd"><div class="lch"><div class="lci">🏦</div><div><div style="font-weight:700;font-size:13px">ATM & Bank</div><div style="font-size:11px;color:var(--tm)">Semua bank tersedia</div></div></div><div class="nb-row"><span>🏦 ATM BCA</span><span class="nb-d">150 m</span></div><div class="nb-row"><span>🏦 ATM Mandiri</span><span class="nb-d">300 m</span></div><div class="nb-row"><span>🏦 ATM BRI</span><span class="nb-d">400 m</span></div></div>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════ INFO & TIPS ══════════════════════ -->
<div id="page-info" class="page">
  <div class="hero" style="padding:38px 20px 58px">
    <div class="hero-tag"><div class="hero-dot"></div>Info Terlengkap</div>
    <h1>Info, FAQ &<br><em style="color:#fbbf24">Tips Ngekos</em></h1>
    <p>Semua yang perlu Anda tahu sebelum dan selama ngekos di Harmonia.</p>
  </div>
  <div class="breadcrumb"><span onclick="goPage('beranda')" style="cursor:pointer;color:var(--primary)">Beranda</span><span class="sep">›</span><span class="cur">Info & Tips</span></div>
  <div class="sec" style="padding-top:8px">

    <!-- FAQ -->
    <div class="sec-hdr"><div class="sec-ey">FAQ</div><div class="sec-t">Pertanyaan yang <em>Sering Ditanyakan</em></div></div>
    <div class="faq-list">
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-q">Bagaimana cara memesan kamar?<span class="faq-arr">▾</span></div><div class="faq-a"><div class="faq-a-inner">Cara paling mudah adalah menghubungi admin via WhatsApp di nomor +62 812-3456-7890. Ceritakan kebutuhan Anda (tipe kamar, budget, tanggal mulai), admin akan bantu rekomendasi dan jadwalkan survei gratis. Setelah survei dan cocok, Anda tinggal melakukan pembayaran deposit untuk konfirmasi booking.</div></div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-q">Apa saja syarat untuk menjadi penghuni?<span class="faq-arr">▾</span></div><div class="faq-a"><div class="faq-a-inner">Syaratnya sangat mudah: (1) Fotokopi KTP/KTM, (2) Foto 3×4 dua lembar, (3) Nomor HP yang aktif, (4) Pembayaran deposit dan sewa bulan pertama. Tidak ada syarat pendapatan minimum — kami terbuka untuk mahasiswa, karyawan, maupun wirausahawan.</div></div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-q">Berapa lama kontrak minimal?<span class="faq-arr">▾</span></div><div class="faq-a"><div class="faq-a-inner">Kontrak minimal adalah 1 bulan. Namun kami menyarankan minimal 3 bulan agar lebih hemat. Untuk sewa 6 bulan ke atas, ada potongan harga khusus — tanya admin via WA untuk penawaran terbaik!</div></div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-q">Apakah ada WiFi? Seberapa cepat?<span class="faq-arr">▾</span></div><div class="faq-a"><div class="faq-a-inner">Ya! Kami menyediakan WiFi fiber optik 100 Mbps yang unlimited 24 jam. Kamar VIP mendapatkan akses priority bandwidth. WiFi sudah termasuk dalam harga sewa, tidak ada biaya tambahan.</div></div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-q">Bagaimana sistem pembayaran listrik?<span class="faq-arr">▾</span></div><div class="faq-a"><div class="faq-a-inner">Listrik dihitung berdasarkan pemakaian kWh di meteran masing-masing kamar. Tarif mengikuti tarif PLN yang berlaku. Tagihan disampaikan setiap awal bulan bersama tagihan sewa, dan dibayarkan paling lambat tanggal 5.</div></div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-q">Apakah boleh membawa kendaraan?<span class="faq-arr">▾</span></div><div class="faq-a"><div class="faq-a-inner">Boleh! Parkir motor gratis untuk penghuni. Parkir mobil dikenakan biaya tambahan Rp 150.000/bulan. Area parkir dijaga CCTV 24 jam dan ada satpam yang berjaga.</div></div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-q">Bagaimana jika ingin pindah kamar?<span class="faq-arr">▾</span></div><div class="faq-a"><div class="faq-a-inner">Penghuni bisa mengajukan pindah kamar ke admin via WhatsApp, minimal 2 minggu sebelumnya. Perpindahan disesuaikan dengan ketersediaan kamar dan akan ada penyesuaian harga jika tipe kamar berbeda.</div></div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-q">Apakah ada diskon untuk sewa jangka panjang?<span class="faq-arr">▾</span></div><div class="faq-a"><div class="faq-a-inner">Ya! Sewa 6 bulan mendapat diskon 5%, sewa 12 bulan mendapat diskon 10%. Untuk penawaran khusus dan negosiasi lebih lanjut, silakan hubungi admin via WhatsApp.</div></div></div>
    </div>

    <!-- VIRTUAL TOUR -->
    <div class="sec-hdr" style="margin-top:44px"><div class="sec-ey">Tur Virtual</div><div class="sec-t">Lihat Tiap <em>Sudut Kost</em></div><div class="sec-sub">Klik untuk minta foto/video area via WhatsApp</div></div>
    <div class="tour-grid">
      <div class="tour-card" onclick="window.open('https://wa.me/6281234567890?text=Halo%2C%20bisa%20kirim%20foto%20area%20Lobby%20dan%20tampak%20depan%20kost%3F','_blank')"><span class="tour-em">🏠</span><div class="tour-n">Tampak Depan</div><div class="tour-d">Lobby & area masuk</div></div>
      <div class="tour-card" onclick="window.open('https://wa.me/6281234567890?text=Halo%2C%20bisa%20kirim%20foto%20kamar%20Standard%20yang%20tersedia%3F','_blank')"><span class="tour-em">🛏️</span><div class="tour-n">Kamar Standard</div><div class="tour-d">Ruang tidur & meja</div></div>
      <div class="tour-card" onclick="window.open('https://wa.me/6281234567890?text=Halo%2C%20bisa%20kirim%20foto%20kamar%20Deluxe%20yang%20tersedia%3F','_blank')"><span class="tour-em">⭐</span><div class="tour-n">Kamar Deluxe</div><div class="tour-d">KM dalam & TV</div></div>
      <div class="tour-card" onclick="window.open('https://wa.me/6281234567890?text=Halo%2C%20bisa%20kirim%20foto%20dapur%20bersama%20dan%20area%20umum%3F','_blank')"><span class="tour-em">🍽️</span><div class="tour-n">Dapur Bersama</div><div class="tour-d">Kompor & kulkas</div></div>
      <div class="tour-card" onclick="window.open('https://wa.me/6281234567890?text=Halo%2C%20bisa%20kirim%20foto%20area%20gym%20dan%20ruang%20belajar%3F','_blank')"><span class="tour-em">🏋️</span><div class="tour-n">Gym & Ruang Belajar</div><div class="tour-d">Lantai 3</div></div>
      <div class="tour-card" onclick="window.open('https://wa.me/6281234567890?text=Halo%2C%20bisa%20kirim%20foto%20taman%20dan%20gazebo%20kost%3F','_blank')"><span class="tour-em">🌿</span><div class="tour-n">Taman & Gazebo</div><div class="tour-d">Area outdoor</div></div>
    </div>

    <!-- TIPS BLOG -->
    <div class="sec-hdr" style="margin-top:44px"><div class="sec-ey">Tips & Artikel</div><div class="sec-t">Panduan <em>Nyaman Ngekos</em></div></div>
    <div class="blog-grid">
      <div class="blog-card"><div class="blog-thumb" style="background:linear-gradient(135deg,var(--ps),#ddd6fe)">📦</div><div class="blog-body"><div class="blog-cat">Tips Pindahan</div><div class="blog-title">Checklist Lengkap Pindah Kos Baru</div><div class="blog-excerpt">Dari dokumen hingga barang bawaan — pastikan tidak ada yang tertinggal saat pindah!</div><div class="blog-meta"><span>5 menit baca</span><span class="blog-read" onclick="window.open('https://wa.me/6281234567890?text=Halo%2C%20mau%20tanya%20proses%20pindah%20ke%20kost%20Harmonia','_blank')">Tanya via WA →</span></div></div></div>
      <div class="blog-card"><div class="blog-thumb" style="background:linear-gradient(135deg,#d1fae5,#a7f3d0)">💡</div><div class="blog-body"><div class="blog-cat">Hemat Listrik</div><div class="blog-title">7 Cara Hemat Tagihan Listrik di Kos</div><div class="blog-excerpt">Tips efektif agar tagihan listrik tetap terjangkau tanpa mengurangi kenyamanan.</div><div class="blog-meta"><span>4 menit baca</span><span class="blog-read">Baca selengkapnya →</span></div></div></div>
      <div class="blog-card"><div class="blog-thumb" style="background:linear-gradient(135deg,#fef3c7,#fde68a)">🤝</div><div class="blog-body"><div class="blog-cat">Kehidupan Sosial</div><div class="blog-title">Tips Bertetangga Baik di Kost</div><div class="blog-excerpt">Membangun hubungan positif dengan sesama penghuni untuk lingkungan yang harmonis.</div><div class="blog-meta"><span>3 menit baca</span><span class="blog-read">Baca selengkapnya →</span></div></div></div>
    </div>

    <div class="cta-box">
      <div style="font-size:30px;margin-bottom:8px">❓</div>
      <h3>Masih Ada Pertanyaan?</h3>
      <p>Tanya langsung ke admin via WhatsApp — kami jawab dengan cepat dan ramah!</p>
      <a class="cta-link" href="https://wa.me/6281234567890?text=Halo%2C%20saya%20punya%20beberapa%20pertanyaan%20tentang%20Kost%20Harmonia" target="_blank">💬 Tanya Admin via WA</a>
    </div>
  </div>
</div>

<!-- ══════════════════════ KONTAK ══════════════════════ -->
<div id="page-kontak" class="page">
  <div class="hero" style="padding:38px 20px 58px">
    <div class="hero-tag"><div class="hero-dot"></div>Respon Cepat & Ramah</div>
    <h1>Kontak &<br><em style="color:#fbbf24">Hubungi Kami</em></h1>
    <p>Admin kami siap membantu 7 hari seminggu. Pilih cara yang paling nyaman!</p>
  </div>
  <div class="breadcrumb"><span onclick="goPage('beranda')" style="cursor:pointer;color:var(--primary)">Beranda</span><span class="sep">›</span><span class="cur">Kontak</span></div>
  <div class="sec" style="padding-top:8px">
    <div class="kontak-grid">
      <div>
        <div class="sec-hdr"><div class="sec-ey">Hubungi</div><div class="sec-t">Admin <em>Harmonia</em></div></div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:20px">
          <div class="kcard" style="cursor:pointer" onclick="window.open('https://wa.me/6281234567890','_blank')">
            <span class="kcard-ico" style="color:var(--wa)">💬</span>
            <h3>WhatsApp</h3>
            <p>Chat langsung, respons paling cepat.</p>
            <div class="kcard-detail">
              <div class="kd-row"><div class="kd-ico" style="background:#dcfce7">💬</div><div class="kd-info"><strong>Nomor WA</strong><span>+62 812-3456-7890</span></div></div>
            </div>
            <a href="https://wa.me/6281234567890?text=Halo%20admin%20Kost%20Harmonia!" target="_blank" class="btn-wa" style="font-size:12px;padding:9px">💬 Chat Sekarang</a>
          </div>
          <div class="kcard">
            <span class="kcard-ico">📞</span>
            <h3>Telepon</h3>
            <p>Untuk urusan mendesak atau komplain.</p>
            <div class="kcard-detail">
              <div class="kd-row"><div class="kd-ico">📞</div><div class="kd-info"><strong>Nomor Telepon</strong><span>+62 812-3456-7890</span></div></div>
            </div>
            <a href="tel:+6281234567890" class="btn-wa" style="background:var(--primary);font-size:12px;padding:9px">📞 Telepon</a>
          </div>
          <div class="kcard">
            <span class="kcard-ico">📧</span>
            <h3>Email</h3>
            <p>Untuk dokumen dan surat resmi.</p>
            <div class="kcard-detail">
              <div class="kd-row"><div class="kd-ico" style="background:#e0f2fe">📧</div><div class="kd-info"><strong>Alamat Email</strong><span>admin@harmonia.id</span></div></div>
            </div>
            <a href="mailto:admin@harmonia.id" class="btn-wa" style="background:var(--blue);font-size:12px;padding:9px">📧 Kirim Email</a>
          </div>
          <div class="kcard">
            <span class="kcard-ico">📍</span>
            <h3>Kunjungi Langsung</h3>
            <p>Survei gratis, tidak perlu janji!</p>
            <div class="kcard-detail">
              <div class="kd-row"><div class="kd-ico" style="background:var(--ps)">📍</div><div class="kd-info"><strong>Alamat</strong><span>Jl. Cendana No. 12</span></div></div>
            </div>
            <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20mau%20kunjungi%20langsung%20untuk%20survei" target="_blank" class="btn-wa" style="background:var(--green);font-size:12px;padding:9px">🗺️ Jadwalkan</a>
          </div>
        </div>

        <div class="kcard">
          <h3 style="margin-top:0">🕐 Jam Operasional Admin</h3>
          <p style="margin-bottom:14px">Di luar jam operasional, Anda tetap bisa kirim pesan WA dan akan kami balas segera setelah kami online.</p>
          <div class="jam-grid">
            <div class="jam-item"><div class="jam-day">Senin – Jumat</div><div class="jam-time">08.00 – 21.00</div></div>
            <div class="jam-item"><div class="jam-day">Sabtu</div><div class="jam-time">08.00 – 20.00</div></div>
            <div class="jam-item"><div class="jam-day">Minggu</div><div class="jam-time">09.00 – 18.00</div></div>
            <div class="jam-item"><div class="jam-day">Darurat / 24 Jam</div><div class="jam-time" style="color:var(--red)">WA Saja</div></div>
          </div>
        </div>

        <div class="kcard" style="margin-top:14px">
          <h3 style="margin-top:0">📱 Ikuti Kami</h3>
          <p>Dapatkan info promo, kamar tersedia, dan update terbaru!</p>
          <div class="social-links">
            <a class="slink" href="https://wa.me/6281234567890" target="_blank">💬 WhatsApp</a>
            <a class="slink" href="#" onclick="alert('Follow Instagram kami @kostharmoia untuk update terbaru!')">📸 Instagram</a>
            <a class="slink" href="#" onclick="alert('Like Facebook kami Kost Harmonia Surabaya!')">👍 Facebook</a>
            <a class="slink" href="#" onclick="alert('Subscribe TikTok kami @kostharmonia!')">🎵 TikTok</a>
          </div>
        </div>
      </div>

      <div>
        <div class="sec-hdr"><div class="sec-ey">Lokasi</div><div class="sec-t">Temukan <em>Kami</em></div></div>
        <div class="kmap-mini" onclick="window.open('https://wa.me/6281234567890?text=Halo%2C%20tolong%20kirim%20link%20Google%20Maps%20kost%20Harmonia','_blank')">
          <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(124,58,237,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(124,58,237,.05) 1px,transparent 1px);background-size:28px 28px"></div>
          <div style="font-size:48px;position:relative;z-index:1">🗺️</div>
          <div style="position:absolute;bottom:0;left:0;right:0;background:linear-gradient(0,rgba(92,33,182,.7),transparent);color:#fff;padding:10px;font-size:11px;font-weight:600;text-align:center">Klik untuk Minta Link Maps via WA</div>
        </div>
        <div class="kcard">
          <div class="kd-row" style="margin-bottom:10px"><div class="kd-ico">📍</div><div class="kd-info"><strong>Alamat Lengkap</strong><span style="font-size:13px">Jl. Cendana No. 12, Darmo, Surabaya Selatan, 60265</span></div></div>
          <div class="kd-row" style="margin-bottom:10px"><div class="kd-ico">🏢</div><div class="kd-info"><strong>Patokan</strong><span style="font-size:13px">100m dari Alfamart Darmo</span></div></div>
          <div class="kd-row"><div class="kd-ico">🚌</div><div class="kd-info"><strong>Akses</strong><span style="font-size:13px">200m dari Halte Bus Darmo</span></div></div>
        </div>
        <div class="kcard" style="margin-top:14px;background:linear-gradient(135deg,var(--ps),#f3e8ff);border-color:var(--pl)">
          <div style="font-size:28px;margin-bottom:8px">⚡</div>
          <h3 style="margin:0 0 6px;color:var(--pd)">Respons Cepat!</h3>
          <p style="color:var(--pd);opacity:.8">Rata-rata waktu respons admin kami adalah <strong style="color:var(--primary)">kurang dari 15 menit</strong> selama jam operasional.</p>
          <a href="https://wa.me/6281234567890?text=Halo%20admin%2C%20saya%20butuh%20informasi%20kost%20Harmonia" target="_blank" class="btn-wa" style="margin-top:12px;font-size:12px;padding:10px">💬 Chat Admin Sekarang</a>
        </div>
      </div>
    </div>

    <div class="cta-box">
      <div style="font-size:34px;margin-bottom:10px">🏠</div>
      <h3>Siap Jadi Penghuni Harmonia?</h3>
      <p>Hubungi admin sekarang — survei gratis, proses mudah, hunian nyaman menanti!</p>
      <a class="cta-link" href="https://wa.me/6281234567890?text=Halo%20admin%20Kost%20Harmonia%2C%20saya%20tertarik%20menghuni.%20Bisa%20info%20dan%20jadwalkan%20survei%3F" target="_blank">💬 Mulai Chat via WhatsApp</a>
    </div>
  </div>
</div>

<!-- FOOTER -->
<footer class="footer">
  <div class="footer-top">
    <div class="footer-brand">
      <div class="fb-logo">🏠 Kost Harmonia</div>
      <p>Hunian nyaman, bersih, dan terjangkau di Surabaya Selatan. Fasilitas lengkap, lokasi strategis, admin responsif 7 hari seminggu.</p>
      <a href="https://wa.me/6281234567890?text=Halo%2C%20info%20kost%20Harmonia" target="_blank" class="footer-wa">💬 Chat Admin WA</a>
    </div>
    <div class="footer-col">
      <h4>Menu</h4>
      <a href="#" onclick="goPage('beranda');return false">🏡 Beranda</a>
      <a href="#" onclick="goPage('kamar');return false">🛏️ Kamar</a>
      <a href="#" onclick="goPage('fasilitas');return false">✨ Fasilitas</a>
      <a href="#" onclick="goPage('harga');return false">💰 Harga</a>
    </div>
    <div class="footer-col">
      <h4>Informasi</h4>
      <a href="#" onclick="goPage('tatatertib');return false">📋 Tata Tertib</a>
      <a href="#" onclick="goPage('lokasi');return false">📍 Lokasi</a>
      <a href="#" onclick="goPage('info');return false">ℹ️ Info & Tips</a>
      <a href="#" onclick="goPage('kontak');return false">💬 Kontak</a>
    </div>
    <div class="footer-col">
      <h4>Kontak</h4>
      <a href="https://wa.me/6281234567890" target="_blank">💬 WhatsApp</a>
      <a href="tel:+6281234567890">📞 +62 812-3456-7890</a>
      <a href="mailto:admin@harmonia.id">📧 admin@harmonia.id</a>
      <a href="#">📸 Instagram</a>
    </div>
  </div>
  <div class="footer-bottom">
    <span>© 2026 Kost Harmonia · All rights reserved</span>
    <div style="display:flex;gap:16px"><a href="#">Privasi</a><a href="#">Syarat & Ketentuan</a><a href="#">Sitemap</a></div>
  </div>
</footer>

<script>
const WA='6281234567890';
let rData={name:'',price:''}, curOpt='tanya';

/* PAGE NAV */
function goPage(name,btn){
  document.querySelectorAll('.page').forEach(p=>p.classList.remove('on'));
  document.querySelectorAll('.nl,.mm-link').forEach(n=>n.classList.remove('on'));
  document.getElementById('page-'+name).classList.add('on');
  if(btn){btn.classList.add('on');}else{
    document.querySelectorAll(`.nl,.mm-link`).forEach(n=>{if(n.textContent.toLowerCase().includes(name.slice(0,4)))n.classList.add('on')});
  }
  window.scrollTo({top:0,behavior:'smooth'});
  document.getElementById('mobileMenu').classList.remove('open');
}

/* MOBILE MENU */
function toggleMenu(){
  document.getElementById('mobileMenu').classList.toggle('open');
}

/* ROOM FILTER */
function filterR(t,btn){
  document.querySelectorAll('.fb').forEach(b=>b.classList.remove('on'));
  btn.classList.add('on');
  document.querySelectorAll('.rcard').forEach(c=>{
    let show=true;
    if(t==='tersedia') show=c.dataset.s==='tersedia';
    else if(t==='standard') show=c.dataset.t==='standard';
    else if(t==='deluxe') show=c.dataset.t==='deluxe';
    else if(t==='vip') show=c.dataset.t==='vip';
    c.style.display=show?'':'none';
  });
}

/* MODAL */
function openModal(emoji,name,price){
  rData={name,price};
  document.getElementById('me').textContent=emoji;
  document.getElementById('mn').textContent=name;
  document.getElementById('mp').innerHTML=price+'<span style="font-size:12px;font-weight:400;color:var(--tm)">/bulan</span>';
  curOpt='tanya';
  document.querySelectorAll('.mopt').forEach(o=>o.classList.remove('sel'));
  document.getElementById('o-tanya').classList.add('sel');
  buildLink();
  document.getElementById('modal').classList.add('open');
}
function closeModal(){document.getElementById('modal').classList.remove('open')}
function selOpt(t,el){
  curOpt=t;
  document.querySelectorAll('.mopt').forEach(o=>o.classList.remove('sel'));
  el.classList.add('sel');
  buildLink();
}
function buildLink(){
  const m={
    tanya:`Halo admin, saya tertarik *${rData.name}* (${rData.price}/bln). Masih tersedia?`,
    survey:`Halo admin, saya ingin survei untuk *${rData.name}*. Kapan bisa?`,
    booking:`Halo admin, saya ingin booking *${rData.name}* (${rData.price}/bln). Apa syaratnya?`,
    nego:`Halo admin, apakah harga *${rData.name}* bisa dinegosiasi? Saya ingin sewa jangka panjang.`
  };
  document.getElementById('walink').href=`https://wa.me/${WA}?text=${encodeURIComponent(m[curOpt])}`;
}
document.getElementById('modal').addEventListener('click',e=>{if(e.target===document.getElementById('modal'))closeModal()});

/* FAQ */
function toggleFaq(el){
  const isOpen=el.classList.contains('open');
  document.querySelectorAll('.faq-item').forEach(f=>f.classList.remove('open'));
  if(!isOpen)el.classList.add('open');
}

/* FAV */
document.querySelectorAll('.rfav').forEach(b=>b.addEventListener('click',e=>{
  e.stopPropagation();b.textContent=b.textContent==='🤍'?'❤️':'🤍';
}));

/* SCROLL */
window.addEventListener('scroll',()=>{
  const st=document.getElementById('scrollTop');
  const pb=document.getElementById('progress');
  const h=document.documentElement;
  const pct=(h.scrollTop/(h.scrollHeight-h.clientHeight))*100;
  pb.style.width=pct+'%';
  st.classList.toggle('show',window.scrollY>300);
});
</script>
</body>
</html>