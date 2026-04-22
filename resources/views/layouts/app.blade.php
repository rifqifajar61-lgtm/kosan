<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kost Harmonia — Hunian Nyaman</title>

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
/* ===== VARIABLES ===== */
:root {
  --primary: #2563eb;
  --primary-light: #eff6ff;
  --primary-hover: #1d4ed8;
  --success: #16a34a;
  --success-light: #f0fdf4;
  --warning: #d97706;
  --warning-light: #fffbeb;
  --danger: #dc2626;
  --danger-light: #fef2f2;
  --gray-50: #f9fafb;
  --gray-100: #f3f4f6;
  --gray-200: #e5e7eb;
  --gray-300: #d1d5db;
  --gray-400: #9ca3af;
  --gray-500: #6b7280;
  --gray-600: #4b5563;
  --gray-700: #374151;
  --gray-800: #1f2937;
  --gray-900: #111827;
  --white: #ffffff;
  --wa: #25D366;
  --topnav-h: 56px;
  --radius: 8px;
  --radius-lg: 12px;
  --shadow-sm: 0 1px 3px rgba(0,0,0,.08);
  --shadow: 0 2px 8px rgba(0,0,0,.10);
  --shadow-md: 0 4px 16px rgba(0,0,0,.12);
}

/* ===== RESET ===== */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body {
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  color: var(--gray-800);
  background: var(--gray-50);
  -webkit-font-smoothing: antialiased;
}
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: var(--gray-100); }
::-webkit-scrollbar-thumb { background: var(--gray-300); border-radius: 3px; }

/* ===== TOPNAV ===== */
.topnav {
  position: sticky;
  top: 0;
  z-index: 100;
  background: var(--white);
  border-bottom: 1px solid var(--gray-200);
  box-shadow: var(--shadow-sm);
  height: var(--topnav-h);
}
.topnav-inner {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 20px;
  height: 100%;
  display: flex;
  align-items: center;
  gap: 8px;
}
.topnav-brand {
  display: flex;
  align-items: center;
  gap: 8px;
  text-decoration: none;
  color: var(--gray-900);
  font-weight: 700;
  font-size: 15px;
  flex-shrink: 0;
}
.topnav-brand-icon {
  width: 32px;
  height: 32px;
  background: var(--primary);
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
}
.topnav-menu {
  display: flex;
  align-items: center;
  gap: 2px;
  margin-left: 16px;
  flex: 1;
}
.topnav-item {
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 13px;
  font-weight: 500;
  color: var(--gray-600);
  text-decoration: none;
  cursor: pointer;
  border: none;
  background: none;
  transition: background .15s, color .15s;
  white-space: nowrap;
  display: flex;
  align-items: center;
  gap: 5px;
}
.topnav-item:hover { background: var(--gray-100); color: var(--gray-900); }
.topnav-item.active { background: var(--primary-light); color: var(--primary); font-weight: 600; }
.topnav-item-icon { font-size: 14px; }
.topnav-divider-v { width: 1px; height: 20px; background: var(--gray-200); margin: 0 6px; }
.topnav-right { margin-left: auto; display: flex; align-items: center; gap: 8px; }
.btn-wa-nav {
  display: flex;
  align-items: center;
  gap: 6px;
  background: var(--wa);
  color: var(--white);
  border: none;
  border-radius: 6px;
  padding: 6px 14px;
  font-size: 12px;
  font-weight: 600;
  text-decoration: none;
  cursor: pointer;
  transition: opacity .15s;
}
.btn-wa-nav:hover { opacity: .88; color: var(--white); }

/* Burger */
.burger {
  display: none;
  flex-direction: column;
  gap: 4px;
  cursor: pointer;
  background: none;
  border: none;
  padding: 5px;
  margin-left: auto;
}
.burger span { width: 20px; height: 2px; background: var(--gray-700); border-radius: 2px; transition: .3s; display: block; }
.burger.open span:nth-child(1) { transform: rotate(45deg) translate(4px,4px); }
.burger.open span:nth-child(2) { opacity: 0; }
.burger.open span:nth-child(3) { transform: rotate(-45deg) translate(4px,-4px); }

/* Mobile menu */
.topnav-mobile-menu {
  display: none;
  flex-direction: column;
  background: var(--white);
  border-top: 1px solid var(--gray-200);
  padding: 8px 12px 12px;
  box-shadow: var(--shadow-md);
}
.topnav-mobile-menu.open { display: flex; }
.topnav-mobile-item {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 12px;
  border-radius: 6px;
  font-size: 14px;
  font-weight: 500;
  color: var(--gray-600);
  text-decoration: none;
  border: none;
  background: none;
  cursor: pointer;
  transition: background .15s, color .15s;
  width: 100%;
  text-align: left;
}
.topnav-mobile-item:hover { background: var(--gray-100); color: var(--gray-900); }
.topnav-mobile-item.active { background: var(--primary-light); color: var(--primary); font-weight: 600; }
.topnav-mobile-divider { height: 1px; background: var(--gray-200); margin: 6px 0; }

/* ===== MAIN WRAP ===== */
.main-wrap {
  max-width: 1100px;
  margin: 0 auto;
  padding: 24px 20px 48px;
}

/* ===== PAGE / SECTION ===== */
.page { display: none; }
.page.active { display: block; animation: fadeUp .25s ease; }
@keyframes fadeUp { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }

/* ===== HERO (minimal) ===== */
.hero-section {
  background: var(--white);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg);
  padding: 32px 28px;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  flex-wrap: wrap;
}
.hero-text h1 {
  font-size: 22px;
  font-weight: 700;
  color: var(--gray-900);
  margin-bottom: 6px;
  line-height: 1.3;
}
.hero-text p {
  font-size: 13px;
  color: var(--gray-500);
  line-height: 1.6;
  max-width: 400px;
}
.hero-stats {
  display: flex;
  gap: 20px;
  flex-shrink: 0;
  flex-wrap: wrap;
}
.hero-stat { text-align: center; }
.hero-stat-val {
  font-size: 20px;
  font-weight: 700;
  color: var(--primary);
  font-family: 'JetBrains Mono', monospace;
  line-height: 1;
}
.hero-stat-lbl { font-size: 11px; color: var(--gray-500); margin-top: 2px; }
.hero-actions { display: flex; gap: 8px; margin-top: 16px; flex-wrap: wrap; }

/* ===== BUTTONS ===== */
.btn-primary-custom {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: var(--primary);
  color: var(--white);
  border: none;
  border-radius: 6px;
  padding: 8px 16px;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  text-decoration: none;
  transition: background .15s;
}
.btn-primary-custom:hover { background: var(--primary-hover); color: var(--white); }
.btn-wa-custom {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: var(--wa);
  color: var(--white);
  border: none;
  border-radius: 6px;
  padding: 8px 16px;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  text-decoration: none;
  transition: opacity .15s;
}
.btn-wa-custom:hover { opacity: .88; color: var(--white); }
.btn-outline-custom {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: var(--white);
  color: var(--gray-700);
  border: 1px solid var(--gray-300);
  border-radius: 6px;
  padding: 8px 16px;
  font-size: 13px;
  font-weight: 500;
  cursor: pointer;
  text-decoration: none;
  transition: border-color .15s, background .15s;
}
.btn-outline-custom:hover { border-color: var(--primary); color: var(--primary); background: var(--primary-light); }

/* ===== SECTION HEADER ===== */
.sec-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 16px;
  gap: 12px;
  flex-wrap: wrap;
}
.sec-title {
  font-size: 16px;
  font-weight: 700;
  color: var(--gray-900);
}
.sec-sub {
  font-size: 12px;
  color: var(--gray-500);
  margin-top: 2px;
}

/* ===== CARD ===== */
.card-plain {
  background: var(--white);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg);
  overflow: hidden;
}
.card-plain-body { padding: 20px; }

/* ===== FILTER TABS ===== */
.filter-tabs { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 16px; }
.ftab {
  padding: 5px 14px;
  border-radius: 20px;
  border: 1px solid var(--gray-200);
  background: var(--white);
  font-size: 12px;
  font-weight: 500;
  color: var(--gray-600);
  cursor: pointer;
  transition: .15s;
}
.ftab:hover { border-color: var(--primary); color: var(--primary); }
.ftab.active { background: var(--primary); color: var(--white); border-color: var(--primary); font-weight: 600; }

/* ===== ROOM GRID ===== */
.room-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 16px; }
.room-card {
  background: var(--white);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg);
  overflow: hidden;
  transition: box-shadow .2s, border-color .2s;
}
.room-card:hover { box-shadow: var(--shadow-md); border-color: var(--gray-300); }
.room-thumb {
  height: 140px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 52px;
  background: var(--gray-50);
  position: relative;
}
.room-badge {
  position: absolute;
  top: 10px;
  right: 10px;
  padding: 3px 8px;
  border-radius: 5px;
  font-size: 10px;
  font-weight: 700;
}
.badge-tersedia { background: var(--success-light); color: var(--success); }
.badge-penuh { background: var(--danger-light); color: var(--danger); }
.badge-reservasi { background: var(--warning-light); color: var(--warning); }
.room-body { padding: 16px; }
.room-type {
  font-size: 10px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: .8px;
  color: var(--primary);
  margin-bottom: 3px;
}
.room-name { font-size: 15px; font-weight: 700; color: var(--gray-900); margin-bottom: 4px; }
.room-desc { font-size: 12px; color: var(--gray-500); line-height: 1.5; margin-bottom: 10px; }
.room-price {
  font-size: 18px;
  font-weight: 700;
  color: var(--primary);
  font-family: 'JetBrains Mono', monospace;
  margin-bottom: 10px;
}
.room-price span { font-size: 11px; color: var(--gray-400); font-weight: 400; font-family: 'DM Sans', sans-serif; }
.room-tags { display: flex; gap: 5px; flex-wrap: wrap; margin-bottom: 12px; }
.room-tag {
  padding: 2px 7px;
  border-radius: 4px;
  background: var(--gray-100);
  color: var(--gray-600);
  font-size: 10px;
  font-weight: 500;
}

/* ===== FACILITY GRID ===== */
.fac-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 12px; }
.fac-item {
  background: var(--white);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius);
  padding: 16px 12px;
  text-align: center;
  transition: border-color .15s, box-shadow .15s;
}
.fac-item:hover { border-color: var(--primary); box-shadow: var(--shadow-sm); }
.fac-icon { font-size: 26px; margin-bottom: 6px; display: block; }
.fac-name { font-size: 12px; font-weight: 600; color: var(--gray-800); margin-bottom: 2px; }
.fac-desc { font-size: 11px; color: var(--gray-500); }
.fac-status {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  margin-top: 6px;
  font-size: 10px;
  font-weight: 600;
  color: var(--success);
}
.fac-status-dot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; }

/* ===== PRICE TABLE ===== */
.price-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); gap: 16px; }
.price-card {
  background: var(--white);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg);
  padding: 22px;
  transition: box-shadow .2s, border-color .2s;
  position: relative;
}
.price-card:hover { box-shadow: var(--shadow-md); }
.price-card.popular { border-color: var(--primary); border-width: 2px; }
.popular-badge {
  position: absolute;
  top: -1px;
  right: 16px;
  background: var(--primary);
  color: var(--white);
  font-size: 10px;
  font-weight: 700;
  padding: 3px 10px;
  border-radius: 0 0 6px 6px;
}
.price-icon { font-size: 30px; margin-bottom: 10px; display: block; }
.price-name { font-size: 17px; font-weight: 700; color: var(--gray-900); margin-bottom: 2px; }
.price-type { font-size: 11px; color: var(--gray-500); margin-bottom: 12px; }
.price-val {
  font-size: 24px;
  font-weight: 700;
  color: var(--primary);
  font-family: 'JetBrains Mono', monospace;
  margin-bottom: 2px;
}
.price-val span { font-size: 13px; font-weight: 400; color: var(--gray-500); font-family: 'DM Sans', sans-serif; }
.price-note { font-size: 11px; color: var(--gray-400); margin-bottom: 14px; }
.price-feats { display: flex; flex-direction: column; gap: 7px; margin-bottom: 16px; }
.price-feat { display: flex; align-items: center; gap: 7px; font-size: 12px; color: var(--gray-700); }
.price-feat.off { color: var(--gray-400); }
.feat-check { font-size: 13px; }

/* ===== RULES ===== */
.rules-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 14px; }
.rule-group { background: var(--white); border: 1px solid var(--gray-200); border-radius: var(--radius-lg); overflow: hidden; }
.rule-group-header {
  padding: 12px 16px;
  font-weight: 700;
  font-size: 13px;
  display: flex;
  align-items: center;
  gap: 8px;
  background: var(--gray-50);
  border-bottom: 1px solid var(--gray-200);
}
.rule-group-body { padding: 14px 16px; display: flex; flex-direction: column; gap: 8px; }
.rule-item { display: flex; align-items: flex-start; gap: 8px; font-size: 12px; line-height: 1.5; color: var(--gray-700); }
.rule-dot {
  width: 18px;
  height: 18px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 9px;
  font-weight: 700;
  flex-shrink: 0;
  margin-top: 1px;
}
.rule-ok { background: #d1fae5; color: #065f46; }
.rule-no { background: #fee2e2; color: #991b1b; }

/* ===== LOCATION ===== */
.map-box {
  background: var(--gray-100);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg);
  height: 220px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 48px;
  cursor: pointer;
  transition: border-color .15s;
  position: relative;
  overflow: hidden;
}
.map-box:hover { border-color: var(--primary); }
.map-box-label {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0,0,0,.5);
  color: var(--white);
  font-size: 11px;
  font-weight: 600;
  text-align: center;
  padding: 8px;
}
.nb-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 8px 0;
  border-bottom: 1px solid var(--gray-100);
  font-size: 12px;
}
.nb-item:last-child { border-bottom: none; }
.nb-dist {
  background: var(--primary-light);
  color: var(--primary);
  font-size: 11px;
  font-weight: 600;
  padding: 2px 8px;
  border-radius: 5px;
}

/* ===== FAQ ===== */
.faq-item {
  background: var(--white);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius);
  overflow: hidden;
  margin-bottom: 8px;
  transition: border-color .15s;
}
.faq-item:hover { border-color: var(--gray-300); }
.faq-item.open { border-color: var(--primary); }
.faq-question {
  padding: 14px 16px;
  font-weight: 600;
  font-size: 13px;
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 12px;
  user-select: none;
}
.faq-arrow { color: var(--gray-400); font-size: 12px; transition: transform .25s; flex-shrink: 0; }
.faq-item.open .faq-arrow { transform: rotate(180deg); color: var(--primary); }
.faq-answer { max-height: 0; overflow: hidden; transition: max-height .3s ease; }
.faq-answer-inner {
  padding: 0 16px 14px;
  font-size: 13px;
  color: var(--gray-600);
  line-height: 1.7;
}
.faq-item.open .faq-answer { max-height: 200px; }

/* ===== CONTACT ===== */
.contact-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 14px; }
.contact-card {
  background: var(--white);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg);
  padding: 20px;
  transition: border-color .15s, box-shadow .15s;
}
.contact-card:hover { border-color: var(--gray-300); box-shadow: var(--shadow-sm); }
.contact-icon { font-size: 28px; margin-bottom: 10px; display: block; }
.contact-title { font-size: 14px; font-weight: 700; color: var(--gray-900); margin-bottom: 4px; }
.contact-info { font-size: 13px; color: var(--gray-600); margin-bottom: 4px; }
.contact-note { font-size: 11px; color: var(--gray-400); margin-bottom: 12px; }

/* ===== TABLE COMPARISON ===== */
.comp-table { width: 100%; border-collapse: collapse; font-size: 13px; }
.comp-table thead tr { background: var(--gray-800); color: var(--white); }
.comp-table th { padding: 12px 14px; text-align: center; font-size: 12px; font-weight: 600; }
.comp-table th:first-child { text-align: left; }
.comp-table td { padding: 10px 14px; text-align: center; border-bottom: 1px solid var(--gray-100); }
.comp-table td:first-child { text-align: left; font-weight: 500; color: var(--gray-700); }
.comp-table tbody tr:hover { background: var(--gray-50); }
.comp-table tbody tr:last-child td { border-bottom: none; }
.ct-yes { color: var(--success); }
.ct-no { color: var(--gray-300); }
.ct-val { font-weight: 600; color: var(--primary); font-family: 'JetBrains Mono', monospace; font-size: 12px; }

/* ===== NOTICE BOX ===== */
.notice-box {
  background: var(--primary-light);
  border: 1px solid #bfdbfe;
  border-radius: var(--radius);
  padding: 14px 16px;
  display: flex;
  align-items: flex-start;
  gap: 10px;
  font-size: 13px;
  color: var(--gray-700);
}
.notice-box.warning { background: var(--warning-light); border-color: #fde68a; }
.notice-box.success { background: var(--success-light); border-color: #bbf7d0; }

/* ===== ANNOUNCEMENTS ===== */
.ann-list { display: flex; flex-direction: column; gap: 8px; }
.ann-item {
  background: var(--white);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius);
  padding: 12px 16px;
  display: flex;
  gap: 12px;
  align-items: flex-start;
  transition: border-color .15s;
}
.ann-item:hover { border-color: var(--gray-300); }
.ann-icon {
  width: 34px;
  height: 34px;
  border-radius: 8px;
  background: var(--gray-100);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  flex-shrink: 0;
}
.ann-title { font-weight: 600; font-size: 13px; margin-bottom: 2px; color: var(--gray-900); }
.ann-desc { font-size: 12px; color: var(--gray-500); line-height: 1.4; }
.ann-meta { display: flex; gap: 8px; align-items: center; margin-top: 5px; }
.ann-date { font-size: 10px; color: var(--gray-400); }
.ann-pill {
  font-size: 10px;
  padding: 1px 7px;
  border-radius: 5px;
  font-weight: 600;
}

/* ===== TESTIMONIALS ===== */
.testi-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 12px; }
.testi-card {
  background: var(--white);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius);
  padding: 16px;
}
.testi-stars { color: #f59e0b; font-size: 12px; margin-bottom: 6px; }
.testi-text { font-size: 12px; color: var(--gray-600); line-height: 1.6; margin-bottom: 8px; font-style: italic; }
.testi-name { font-weight: 700; font-size: 12px; color: var(--gray-800); }
.testi-room { font-size: 11px; color: var(--primary); }

/* ===== QUICK INFO CARDS ===== */
.quick-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 12px; }
.quick-card {
  background: var(--white);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius);
  padding: 16px;
  cursor: pointer;
  transition: border-color .15s, box-shadow .15s;
}
.quick-card:hover { border-color: var(--primary); box-shadow: var(--shadow-sm); }
.quick-icon {
  width: 36px;
  height: 36px;
  border-radius: 8px;
  background: var(--gray-100);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  margin-bottom: 8px;
}
.quick-title { font-weight: 700; font-size: 13px; margin-bottom: 2px; color: var(--gray-900); }
.quick-desc { font-size: 11px; color: var(--gray-500); }

/* ===== DIVIDER ===== */
.section-divider { height: 1px; background: var(--gray-200); margin: 28px 0; }

/* ===== FOOTER ===== */
.footer {
  background: var(--gray-800);
  color: rgba(255,255,255,.6);
  padding: 28px 20px;
  margin-top: 48px;
}
.footer-inner {
  max-width: 1100px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
}
.footer-brand-txt { color: rgba(255,255,255,.9); font-weight: 700; font-size: 14px; }
.footer-right { display: flex; align-items: center; gap: 16px; font-size: 12px; }
.footer-right a { color: rgba(255,255,255,.5); text-decoration: none; transition: color .15s; }
.footer-right a:hover { color: rgba(255,255,255,.9); }

/* ===== WA FLOAT ===== */
.wa-float {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 99;
  width: 48px;
  height: 48px;
  background: var(--wa);
  color: var(--white);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  text-decoration: none;
  box-shadow: 0 4px 14px rgba(37,211,102,.4);
  transition: transform .2s, box-shadow .2s;
}
.wa-float:hover { transform: scale(1.08); box-shadow: 0 6px 20px rgba(37,211,102,.5); }

/* ===== MODAL ===== */
.modal-overlay {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,.45);
  z-index: 200;
  align-items: center;
  justify-content: center;
}
.modal-overlay.open { display: flex; animation: fadeUp .2s; }
.modal-box {
  background: var(--white);
  border-radius: var(--radius-lg);
  padding: 24px;
  max-width: 400px;
  width: 92%;
  box-shadow: var(--shadow-md);
  max-height: 90vh;
  overflow-y: auto;
}
.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 14px;
}
.modal-title { font-size: 16px; font-weight: 700; color: var(--gray-900); }
.modal-close {
  width: 28px;
  height: 28px;
  border: 1px solid var(--gray-200);
  border-radius: 6px;
  background: none;
  cursor: pointer;
  font-size: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background .15s;
  color: var(--gray-500);
}
.modal-close:hover { background: var(--gray-100); }
.modal-room-info {
  background: var(--gray-50);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius);
  padding: 12px 14px;
  display: flex;
  gap: 12px;
  align-items: center;
  margin-bottom: 14px;
}
.modal-opts { display: flex; flex-direction: column; gap: 6px; margin-bottom: 14px; }
.modal-opt {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 14px;
  border: 1.5px solid var(--gray-200);
  border-radius: 8px;
  cursor: pointer;
  transition: .15s;
  font-size: 13px;
  color: var(--gray-700);
}
.modal-opt:hover, .modal-opt.selected { border-color: var(--primary); background: var(--primary-light); color: var(--primary); }

/* ===== RESPONSIVE ===== */
@media (max-width: 640px) {
  .topnav-menu { display: none; }
  .burger { display: flex; }
  .hero-section { flex-direction: column; align-items: flex-start; }
  .hero-stats { justify-content: flex-start; }
  .main-wrap { padding: 16px 14px 40px; }
  .footer-inner { flex-direction: column; text-align: center; }
  .comp-table { font-size: 11px; }
  .comp-table th, .comp-table td { padding: 8px 8px; }
}
@media (max-width: 900px) {
  .topnav-item-icon { display: none; }
}
</style>
</head>
<body>

<!-- WA Float -->
<a class="wa-float" href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20dengan%20Kost%20Harmonia!" target="_blank" title="Chat Admin">💬</a>

<!-- Modal Pesan -->
<div class="modal-overlay" id="roomModal">
  <div class="modal-box">
    <div class="modal-header">
      <div class="modal-title">Hubungi Admin</div>
      <button class="modal-close" onclick="closeRoomModal()">✕</button>
    </div>
    <div class="modal-room-info">
      <div id="modal-emoji" style="font-size:32px">🛏️</div>
      <div>
        <div id="modal-name" style="font-weight:700;font-size:14px;color:var(--gray-900)"></div>
        <div id="modal-price" style="font-family:'JetBrains Mono',monospace;color:var(--primary);font-weight:700;font-size:16px"></div>
      </div>
    </div>
    <div style="font-size:12px;color:var(--gray-500);margin-bottom:10px">Pilih topik pesan ke admin:</div>
    <div class="modal-opts">
      <div class="modal-opt selected" id="opt-tanya" onclick="selectOpt('tanya',this)">❓ Tanya ketersediaan kamar</div>
      <div class="modal-opt" id="opt-survey" onclick="selectOpt('survey',this)">🏠 Jadwalkan survei</div>
      <div class="modal-opt" id="opt-booking" onclick="selectOpt('booking',this)">📋 Booking kamar</div>
      <div class="modal-opt" id="opt-nego" onclick="selectOpt('nego',this)">💰 Negosiasi harga</div>
    </div>
    <a class="btn-wa-custom" id="modal-wa-link" href="#" target="_blank" style="width:100%;justify-content:center">💬 Buka WhatsApp</a>
  </div>
</div>

<!-- TOPNAV -->
<nav class="topnav" id="topnav">
  <div class="topnav-inner">
    <a href="#" class="topnav-brand" onclick="showPage('beranda')">
      <div class="topnav-brand-icon">🏠</div>
      <span>Kost Harmonia</span>
    </a>
    <div class="topnav-menu">
      <a class="topnav-item active" id="nav-beranda" onclick="showPage('beranda')"><span class="topnav-item-icon">🏡</span> Beranda</a>
      <a class="topnav-item" id="nav-kamar" onclick="showPage('kamar')"><span class="topnav-item-icon">🛏️</span> Kamar</a>
      <a class="topnav-item" id="nav-fasilitas" onclick="showPage('fasilitas')"><span class="topnav-item-icon">✨</span> Fasilitas</a>
      <a class="topnav-item" id="nav-harga" onclick="showPage('harga')"><span class="topnav-item-icon">💰</span> Harga</a>
      <a class="topnav-item" id="nav-tatatertib" onclick="showPage('tatatertib')"><span class="topnav-item-icon">📋</span> Tata Tertib</a>
      <a class="topnav-item" id="nav-lokasi" onclick="showPage('lokasi')"><span class="topnav-item-icon">📍</span> Lokasi</a>
      <a class="topnav-item" id="nav-kontak" onclick="showPage('kontak')"><span class="topnav-item-icon">💬</span> Kontak</a>
    </div>
    <div class="topnav-right">
      <a class="btn-wa-nav" href="https://wa.me/6281234567890" target="_blank">💬 WhatsApp</a>
      <button class="burger" id="burgerBtn" onclick="toggleMobile()">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
  <div class="topnav-mobile-menu" id="mobileMenu">
    <a class="topnav-mobile-item active" onclick="showPage('beranda')">🏡 Beranda</a>
    <a class="topnav-mobile-item" onclick="showPage('kamar')">🛏️ Kamar</a>
    <a class="topnav-mobile-item" onclick="showPage('fasilitas')">✨ Fasilitas</a>
    <a class="topnav-mobile-item" onclick="showPage('harga')">💰 Harga</a>
    <a class="topnav-mobile-item" onclick="showPage('tatatertib')">📋 Tata Tertib</a>
    <a class="topnav-mobile-item" onclick="showPage('lokasi')">📍 Lokasi</a>
    <a class="topnav-mobile-item" onclick="showPage('kontak')">💬 Kontak</a>
  </div>
</nav>

<!-- MAIN WRAP -->
<div class="main-wrap">

  <!-- ======== BERANDA ======== -->
  <div class="page active" id="page-beranda">
    <!-- Hero -->
    <div class="hero-section">
      <div class="hero-text">
        <h1>🏠 Kost Harmonia</h1>
        <p>Hunian nyaman, bersih, dan terjangkau di Surabaya Selatan. Fasilitas lengkap, lokasi strategis, admin responsif.</p>
        <div class="hero-actions">
          <button class="btn-primary-custom" onclick="showPage('kamar')">🛏️ Lihat Kamar</button>
          <a class="btn-wa-custom" href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20Kost%20Harmonia" target="_blank">💬 Tanya via WA</a>
        </div>
      </div>
      <div class="hero-stats">
        <div class="hero-stat"><div class="hero-stat-val">24</div><div class="hero-stat-lbl">Total Kamar</div></div>
        <div class="hero-stat"><div class="hero-stat-val" style="color:var(--success)">6</div><div class="hero-stat-lbl">Tersedia</div></div>
        <div class="hero-stat"><div class="hero-stat-val">5★</div><div class="hero-stat-lbl">Rating</div></div>
        <div class="hero-stat"><div class="hero-stat-val">3Thn</div><div class="hero-stat-lbl">Berdiri</div></div>
      </div>
    </div>

    <!-- Quick Nav -->
    <div class="sec-header"><div class="sec-title">Menu Utama</div></div>
    <div class="quick-grid" style="margin-bottom:24px">
      <div class="quick-card" onclick="showPage('kamar')"><div class="quick-icon">🛏️</div><div class="quick-title">Kamar</div><div class="quick-desc">Lihat tipe & harga</div></div>
      <div class="quick-card" onclick="showPage('fasilitas')"><div class="quick-icon">✨</div><div class="quick-title">Fasilitas</div><div class="quick-desc">WiFi, gym, dapur, dll.</div></div>
      <div class="quick-card" onclick="showPage('harga')"><div class="quick-icon">💰</div><div class="quick-title">Harga & Paket</div><div class="quick-desc">Bandingkan tipe kamar</div></div>
      <div class="quick-card" onclick="showPage('tatatertib')"><div class="quick-icon">📋</div><div class="quick-title">Tata Tertib</div><div class="quick-desc">Aturan penghuni</div></div>
      <div class="quick-card" onclick="showPage('lokasi')"><div class="quick-icon">📍</div><div class="quick-title">Lokasi</div><div class="quick-desc">Dekat kampus & RS</div></div>
      <div class="quick-card" onclick="showPage('kontak')"><div class="quick-icon">💬</div><div class="quick-title">Kontak Admin</div><div class="quick-desc">Chat WA atau telepon</div></div>
    </div>

    <!-- Pengumuman -->
    <div class="sec-header"><div class="sec-title">Pengumuman</div></div>
    <div class="ann-list" style="margin-bottom:24px">
      <div class="ann-item"><div class="ann-icon">🎉</div><div><div class="ann-title">Promo Kamar Deluxe — Diskon 10%</div><div class="ann-desc">Penghuni baru yang masuk Maret 2026 mendapat diskon 10% untuk kamar Deluxe.</div><div class="ann-meta"><span class="ann-date">Hari ini</span><span class="ann-pill" style="background:var(--primary-light);color:var(--primary)">Promo</span></div></div></div>
      <div class="ann-item"><div class="ann-icon">🔧</div><div><div class="ann-title">Perbaikan Saluran Air Lantai 2</div><div class="ann-desc">Toilet bersama lantai 2 sedang diperbaiki. Gunakan lantai 1 sementara.</div><div class="ann-meta"><span class="ann-date">Hari ini, 09.00</span><span class="ann-pill" style="background:var(--warning-light);color:var(--warning)">Maintenance</span></div></div></div>
      <div class="ann-item"><div class="ann-icon">✅</div><div><div class="ann-title">2 Kamar Baru Lantai 3 Siap Ditempati</div><div class="ann-desc">Unit baru AC, KM dalam, view kota sudah siap. Hubungi admin WA!</div><div class="ann-meta"><span class="ann-date">2 hari lalu</span><span class="ann-pill" style="background:var(--success-light);color:var(--success)">Tersedia</span></div></div></div>
    </div>

    <!-- Testimoni -->
    <div class="sec-header"><div class="sec-title">Kata Penghuni</div></div>
    <div class="testi-grid">
      <div class="testi-card"><div class="testi-stars">★★★★★</div><div class="testi-text">"Kamarnya bersih, AC dingin, admin super responsif! Sudah 1,5 tahun di sini."</div><div class="testi-name">Dina R.</div><div class="testi-room">Kamar Deluxe · Mahasiswi Unair</div></div>
      <div class="testi-card"><div class="testi-stars">★★★★★</div><div class="testi-text">"Lokasi dekat kantor, parkir luas, laundry murah. Worth it banget!"</div><div class="testi-name">Bagas S.</div><div class="testi-room">Suite VIP · Karyawan Swasta</div></div>
      <div class="testi-card"><div class="testi-stars">★★★★☆</div><div class="testi-text">"Lingkungan tenang dan aman. Suka banget taman & gazebo-nya!"</div><div class="testi-name">Ayu M.</div><div class="testi-room">Standard · Freelancer</div></div>
      <div class="testi-card"><div class="testi-stars">★★★★★</div><div class="testi-text">"Harga terjangkau dengan fasilitas lengkap. Kamar baru di lantai 3 keren!"</div><div class="testi-name">Reza P.</div><div class="testi-room">Deluxe Corner · Mahasiswa ITS</div></div>
    </div>
  </div>

  <!-- ======== KAMAR ======== -->
  <div class="page" id="page-kamar">
    <div class="sec-header">
      <div><div class="sec-title">Pilihan Kamar</div><div class="sec-sub">6 kamar tersedia · Hubungi admin untuk reservasi</div></div>
    </div>
    <div class="filter-tabs">
      <button class="ftab active" onclick="filterRoom('semua',this)">Semua</button>
      <button class="ftab" onclick="filterRoom('tersedia',this)">✅ Tersedia</button>
      <button class="ftab" onclick="filterRoom('standard',this)">Standard</button>
      <button class="ftab" onclick="filterRoom('deluxe',this)">Deluxe</button>
      <button class="ftab" onclick="filterRoom('vip',this)">VIP</button>
    </div>
    <div class="room-grid" id="roomGrid">
      <div class="room-card" data-type="standard" data-status="tersedia">
        <div class="room-thumb"><span>🛏️</span><span class="room-badge badge-tersedia">✅ Tersedia</span></div>
        <div class="room-body">
          <div class="room-type">Standard</div>
          <div class="room-name">Kamar Standard A</div>
          <div class="room-desc">10 m², lantai 1, akses mudah. Cocok untuk mahasiswa & karyawan.</div>
          <div class="room-price">Rp 900.000 <span>/bulan</span></div>
          <div class="room-tags"><span class="room-tag">❄️ AC</span><span class="room-tag">📶 WiFi</span><span class="room-tag">🚿 KM Luar</span></div>
          <button class="btn-wa-custom" style="width:100%;justify-content:center" onclick="openRoomModal('🛏️','Kamar Standard A','Rp 900.000')">💬 Tanya / Pesan</button>
        </div>
      </div>
      <div class="room-card" data-type="standard" data-status="tersedia">
        <div class="room-thumb"><span>🏠</span><span class="room-badge badge-tersedia">✅ Tersedia</span></div>
        <div class="room-body">
          <div class="room-type">Standard</div>
          <div class="room-name">Kamar Standard B</div>
          <div class="room-desc">Lantai 2, view taman, lebih tenang. Ideal untuk belajar.</div>
          <div class="room-price">Rp 950.000 <span>/bulan</span></div>
          <div class="room-tags"><span class="room-tag">❄️ AC</span><span class="room-tag">📶 WiFi</span><span class="room-tag">🌿 View Taman</span></div>
          <button class="btn-wa-custom" style="width:100%;justify-content:center" onclick="openRoomModal('🏠','Kamar Standard B','Rp 950.000')">💬 Tanya / Pesan</button>
        </div>
      </div>
      <div class="room-card" data-type="deluxe" data-status="tersedia">
        <div class="room-thumb" style="background:#fffbeb"><span>⭐</span><span class="room-badge badge-tersedia">✅ Tersedia</span></div>
        <div class="room-body">
          <div class="room-type">Deluxe</div>
          <div class="room-name">Kamar Deluxe Plus</div>
          <div class="room-desc">14 m², KM dalam, kasur queen, Smart TV. Kamar favorit!</div>
          <div class="room-price">Rp 1.300.000 <span>/bulan</span></div>
          <div class="room-tags"><span class="room-tag">❄️ AC</span><span class="room-tag">📺 Smart TV</span><span class="room-tag">🚿 KM Dalam</span><span class="room-tag">🛁 Air Panas</span></div>
          <button class="btn-wa-custom" style="width:100%;justify-content:center" onclick="openRoomModal('⭐','Kamar Deluxe Plus','Rp 1.300.000')">💬 Tanya / Pesan</button>
        </div>
      </div>
      <div class="room-card" data-type="deluxe" data-status="tersedia">
        <div class="room-thumb" style="background:#f0fdf4"><span>🌟</span><span class="room-badge badge-tersedia">✅ Tersedia</span></div>
        <div class="room-body">
          <div class="room-type">Deluxe</div>
          <div class="room-name">Kamar Deluxe Corner</div>
          <div class="room-desc">Sudut lantai 3, dua jendela besar, cahaya alami, view kota.</div>
          <div class="room-price">Rp 1.400.000 <span>/bulan</span></div>
          <div class="room-tags"><span class="room-tag">❄️ AC</span><span class="room-tag">📺 Smart TV</span><span class="room-tag">🌄 View Kota</span><span class="room-tag">🚿 KM Dalam</span></div>
          <button class="btn-wa-custom" style="width:100%;justify-content:center" onclick="openRoomModal('🌟','Kamar Deluxe Corner','Rp 1.400.000')">💬 Tanya / Pesan</button>
        </div>
      </div>
      <div class="room-card" data-type="vip" data-status="tersedia">
        <div class="room-thumb" style="background:#f5f3ff"><span>👑</span><span class="room-badge badge-tersedia">✅ Tersedia</span></div>
        <div class="room-body">
          <div class="room-type">VIP</div>
          <div class="room-name">Suite Premium VIP</div>
          <div class="room-desc">20 m², ruang kerja terpisah, bathtub, kasur king. Eksklusif!</div>
          <div class="room-price">Rp 2.000.000 <span>/bulan</span></div>
          <div class="room-tags"><span class="room-tag">❄️ AC 1PK</span><span class="room-tag">📺 Smart TV</span><span class="room-tag">🛁 Bathtub</span><span class="room-tag">💼 Ruang Kerja</span></div>
          <button class="btn-wa-custom" style="width:100%;justify-content:center" onclick="openRoomModal('👑','Suite Premium VIP','Rp 2.000.000')">💬 Tanya / Pesan</button>
        </div>
      </div>
      <div class="room-card" data-type="standard" data-status="reserved">
        <div class="room-thumb" style="background:#fffbeb"><span>⏳</span><span class="room-badge badge-reservasi">⏳ Reservasi</span></div>
        <div class="room-body">
          <div class="room-type">Standard</div>
          <div class="room-name">Kamar Standard C</div>
          <div class="room-desc">Sedang dalam proses reservasi. Daftar waitlist via WA.</div>
          <div class="room-price" style="color:var(--gray-400)">Rp 900.000 <span>/bulan</span></div>
          <div class="room-tags"><span class="room-tag">❄️ AC</span><span class="room-tag">📶 WiFi</span></div>
          <a class="btn-outline-custom" style="width:100%;justify-content:center" href="https://wa.me/6281234567890?text=Halo%2C%20waitlist%20Kamar%20Standard%20C" target="_blank">📋 Daftar Waitlist</a>
        </div>
      </div>
      <div class="room-card" data-type="deluxe" data-status="penuh">
        <div class="room-thumb" style="background:var(--gray-100)"><span>🔒</span><span class="room-badge badge-penuh">🔒 Terisi</span></div>
        <div class="room-body">
          <div class="room-type">Deluxe</div>
          <div class="room-name">Kamar Deluxe D</div>
          <div class="room-desc">Sedang terisi. Daftar waitlist, kami kabari jika ada kamar kosong.</div>
          <div class="room-price" style="color:var(--gray-400)">Rp 1.200.000 <span>/bulan</span></div>
          <div class="room-tags"><span class="room-tag">❄️ AC</span><span class="room-tag">📺 TV</span></div>
          <a class="btn-outline-custom" style="width:100%;justify-content:center" href="https://wa.me/6281234567890?text=Halo%2C%20waitlist%20Kamar%20Deluxe%20D" target="_blank">📋 Daftar Waitlist</a>
        </div>
      </div>
    </div>
  </div>

  <!-- ======== FASILITAS ======== -->
  <div class="page" id="page-fasilitas">
    <div class="sec-header"><div><div class="sec-title">Fasilitas</div><div class="sec-sub">25+ fasilitas untuk kenyamanan penghuni</div></div></div>

    <div style="font-size:12px;font-weight:600;color:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Dalam Kamar</div>
    <div class="fac-grid" style="margin-bottom:20px">
      <div class="fac-item"><span class="fac-icon">🛏️</span><div class="fac-name">Kasur Spring Bed</div><div class="fac-desc">Queen/King size</div><div class="fac-status"><div class="fac-status-dot"></div>Semua kamar</div></div>
      <div class="fac-item"><span class="fac-icon">❄️</span><div class="fac-name">AC</div><div class="fac-desc">0.5–1 PK per kamar</div><div class="fac-status"><div class="fac-status-dot"></div>Semua kamar</div></div>
      <div class="fac-item"><span class="fac-icon">📶</span><div class="fac-name">WiFi 100 Mbps</div><div class="fac-desc">Fiber, unlimited</div><div class="fac-status"><div class="fac-status-dot"></div>Online</div></div>
      <div class="fac-item"><span class="fac-icon">📺</span><div class="fac-name">Smart TV 32"</div><div class="fac-desc">Android TV</div><div class="fac-status"><div class="fac-status-dot"></div>Deluxe & VIP</div></div>
      <div class="fac-item"><span class="fac-icon">🪑</span><div class="fac-name">Meja & Kursi</div><div class="fac-desc">Ergonomis</div><div class="fac-status"><div class="fac-status-dot"></div>Semua kamar</div></div>
      <div class="fac-item"><span class="fac-icon">🛁</span><div class="fac-name">Air Panas</div><div class="fac-desc">Water heater</div><div class="fac-status"><div class="fac-status-dot"></div>Deluxe & VIP</div></div>
      <div class="fac-item"><span class="fac-icon">🗄️</span><div class="fac-name">Lemari</div><div class="fac-desc">2 pintu sliding</div><div class="fac-status"><div class="fac-status-dot"></div>Semua kamar</div></div>
      <div class="fac-item"><span class="fac-icon">🔌</span><div class="fac-name">Stop Kontak</div><div class="fac-desc">4 titik per kamar</div><div class="fac-status"><div class="fac-status-dot"></div>Semua kamar</div></div>
    </div>

    <div style="font-size:12px;font-weight:600;color:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Area Bersama</div>
    <div class="fac-grid">
      <div class="fac-item"><span class="fac-icon">🏋️</span><div class="fac-name">Gym Mini</div><div class="fac-desc">Lantai 3, 24 jam</div><div class="fac-status"><div class="fac-status-dot"></div>Buka</div></div>
      <div class="fac-item"><span class="fac-icon">🍽️</span><div class="fac-name">Dapur Bersama</div><div class="fac-desc">Kompor, kulkas</div><div class="fac-status"><div class="fac-status-dot"></div>Buka</div></div>
      <div class="fac-item"><span class="fac-icon">👗</span><div class="fac-name">Laundry</div><div class="fac-desc">Rp 7.000/kg</div><div class="fac-status"><div class="fac-status-dot"></div>Buka</div></div>
      <div class="fac-item"><span class="fac-icon">🛵</span><div class="fac-name">Parkir Luas</div><div class="fac-desc">Motor & mobil</div><div class="fac-status"><div class="fac-status-dot"></div>Tersedia</div></div>
      <div class="fac-item"><span class="fac-icon">🌿</span><div class="fac-name">Taman & Gazebo</div><div class="fac-desc">Area outdoor</div><div class="fac-status"><div class="fac-status-dot"></div>Buka</div></div>
      <div class="fac-item"><span class="fac-icon">📚</span><div class="fac-name">Ruang Belajar</div><div class="fac-desc">AC, tenang</div><div class="fac-status"><div class="fac-status-dot"></div>Buka</div></div>
      <div class="fac-item"><span class="fac-icon">🔒</span><div class="fac-name">Keamanan 24 Jam</div><div class="fac-desc">Satpam + CCTV</div><div class="fac-status"><div class="fac-status-dot"></div>Aktif</div></div>
      <div class="fac-item"><span class="fac-icon">🧹</span><div class="fac-name">Cleaning</div><div class="fac-desc">Tiap pagi</div><div class="fac-status" style="color:var(--warning)"><div class="fac-status-dot"></div>Tiap Pagi</div></div>
      <div class="fac-item"><span class="fac-icon">💧</span><div class="fac-name">Dispenser</div><div class="fac-desc">Tiap lantai, gratis</div><div class="fac-status"><div class="fac-status-dot"></div>Tersedia</div></div>
      <div class="fac-item"><span class="fac-icon">☕</span><div class="fac-name">Mini Kantin</div><div class="fac-desc">07.00–22.00</div><div class="fac-status" style="color:var(--warning)"><div class="fac-status-dot"></div>07–22 WIB</div></div>
    </div>
    <div class="notice-box" style="margin-top:20px">
      <span>💡</span>
      <span>Ada pertanyaan tentang fasilitas? <a href="https://wa.me/6281234567890?text=Halo%2C%20mau%20tanya%20fasilitas%20Kost%20Harmonia" target="_blank" style="color:var(--primary);font-weight:600">Chat admin via WA →</a></span>
    </div>
  </div>

  <!-- ======== HARGA ======== -->
  <div class="page" id="page-harga">
    <div class="sec-header"><div><div class="sec-title">Harga & Paket</div><div class="sec-sub">Transparan, tanpa biaya tersembunyi</div></div></div>

    <div class="price-grid" style="margin-bottom:24px">
      <div class="price-card">
        <span class="price-icon">🛏️</span>
        <div class="price-name">Standard</div>
        <div class="price-type">Kamar 10 m²</div>
        <div class="price-val">Rp 900.000 <span>/bulan</span></div>
        <div class="price-note">Mulai dari · Belum termasuk listrik</div>
        <div class="price-feats">
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> Kasur spring bed</div>
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> AC 0.5 PK</div>
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> WiFi 100 Mbps</div>
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> Meja & kursi belajar</div>
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> Lemari 2 pintu</div>
          <div class="price-feat off"><span class="feat-check ct-no">✗</span> Kamar mandi dalam</div>
          <div class="price-feat off"><span class="feat-check ct-no">✗</span> Smart TV</div>
        </div>
        <a class="btn-wa-custom" style="width:100%;justify-content:center" href="https://wa.me/6281234567890?text=Halo%2C%20tertarik%20kamar%20Standard" target="_blank">💬 Tanya via WA</a>
      </div>
      <div class="price-card popular">
        <div class="popular-badge">⭐ TERPOPULER</div>
        <span class="price-icon">⭐</span>
        <div class="price-name">Deluxe</div>
        <div class="price-type">Kamar 14 m²</div>
        <div class="price-val">Rp 1.300.000 <span>/bulan</span></div>
        <div class="price-note">Mulai dari · Belum termasuk listrik</div>
        <div class="price-feats">
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> Kasur queen bed</div>
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> AC 0.5 PK</div>
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> WiFi 100 Mbps</div>
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> Kamar mandi dalam</div>
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> Smart TV 32"</div>
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> Air panas</div>
          <div class="price-feat off"><span class="feat-check ct-no">✗</span> Ruang kerja terpisah</div>
        </div>
        <a class="btn-wa-custom" style="width:100%;justify-content:center" href="https://wa.me/6281234567890?text=Halo%2C%20tertarik%20kamar%20Deluxe" target="_blank">💬 Tanya via WA</a>
      </div>
      <div class="price-card">
        <span class="price-icon">👑</span>
        <div class="price-name">VIP Suite</div>
        <div class="price-type">Kamar 20 m²</div>
        <div class="price-val">Rp 2.000.000 <span>/bulan</span></div>
        <div class="price-note">Mulai dari · Belum termasuk listrik</div>
        <div class="price-feats">
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> Kasur king bed</div>
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> AC 1 PK</div>
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> WiFi priority</div>
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> Ruang kerja terpisah</div>
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> Bathtub</div>
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> Smart TV 40"</div>
          <div class="price-feat"><span class="feat-check ct-yes">✓</span> Mini kulkas</div>
        </div>
        <a class="btn-wa-custom" style="width:100%;justify-content:center" href="https://wa.me/6281234567890?text=Halo%2C%20tertarik%20Suite%20VIP" target="_blank">💬 Tanya via WA</a>
      </div>
    </div>

    <!-- Biaya tambahan -->
    <div class="sec-header"><div><div class="sec-title">Biaya Tambahan</div><div class="sec-sub">Rincian lengkap semua biaya</div></div></div>
    <div class="card-plain" style="margin-bottom:24px">
      <div class="card-plain-body" style="padding:0">
        <table style="width:100%;border-collapse:collapse;font-size:13px">
          <tbody>
            <tr style="border-bottom:1px solid var(--gray-100)"><td style="padding:12px 16px;font-weight:600">⚡ Listrik</td><td style="padding:12px 16px;color:var(--gray-600)">Sesuai pemakaian kWh · Tarif PLN berlaku</td></tr>
            <tr style="border-bottom:1px solid var(--gray-100)"><td style="padding:12px 16px;font-weight:600">💧 Air PDAM</td><td style="padding:12px 16px;color:var(--gray-600)">Flat Rp 25.000/bulan</td></tr>
            <tr style="border-bottom:1px solid var(--gray-100)"><td style="padding:12px 16px;font-weight:600">👗 Laundry</td><td style="padding:12px 16px;color:var(--gray-600)">Rp 7.000/kg</td></tr>
            <tr style="border-bottom:1px solid var(--gray-100)"><td style="padding:12px 16px;font-weight:600">🅿️ Parkir Mobil</td><td style="padding:12px 16px;color:var(--gray-600)">Rp 150.000/bulan (motor gratis)</td></tr>
            <tr style="border-bottom:1px solid var(--gray-100)"><td style="padding:12px 16px;font-weight:600">🔑 Deposit</td><td style="padding:12px 16px;color:var(--gray-600)">1× sewa kamar · Dikembalikan saat keluar</td></tr>
            <tr><td style="padding:12px 16px;font-weight:600">⚠️ Denda Terlambat</td><td style="padding:12px 16px;color:var(--gray-600)">Rp 10.000/hari setelah tanggal 5</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Perbandingan -->
    <div class="sec-header"><div class="sec-title">Perbandingan Kamar</div></div>
    <div style="overflow-x:auto;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm)">
      <table class="comp-table">
        <thead><tr><th>Fitur</th><th>Standard</th><th>Deluxe</th><th>VIP Suite</th></tr></thead>
        <tbody>
          <tr><td>Luas Kamar</td><td>10 m²</td><td>14 m²</td><td class="ct-val">20 m²</td></tr>
          <tr><td>Kasur</td><td>Single/Queen</td><td>Queen</td><td class="ct-val">King</td></tr>
          <tr><td>AC</td><td>0.5 PK</td><td>0.5 PK</td><td class="ct-val">1 PK</td></tr>
          <tr><td>KM Dalam</td><td class="ct-no">✗</td><td class="ct-yes">✓</td><td class="ct-yes">✓</td></tr>
          <tr><td>Air Panas</td><td class="ct-no">✗</td><td class="ct-yes">✓</td><td class="ct-yes">✓</td></tr>
          <tr><td>Smart TV</td><td class="ct-no">✗</td><td>32"</td><td class="ct-val">40"</td></tr>
          <tr><td>Bathtub</td><td class="ct-no">✗</td><td class="ct-no">✗</td><td class="ct-yes">✓</td></tr>
          <tr><td>Ruang Kerja</td><td class="ct-no">✗</td><td class="ct-no">✗</td><td class="ct-yes">✓</td></tr>
          <tr><td>Harga/Bulan</td><td class="ct-val">Rp 900rb+</td><td class="ct-val">Rp 1,3jt+</td><td class="ct-val">Rp 2jt+</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ======== TATA TERTIB ======== -->
  <div class="page" id="page-tatatertib">
    <div class="sec-header"><div><div class="sec-title">Tata Tertib Penghuni</div><div class="sec-sub">Berlaku sejak 1 Januari 2025</div></div></div>
    <div class="rules-grid">
      <div class="rule-group">
        <div class="rule-group-header">🕐 Jam Operasional</div>
        <div class="rule-group-body">
          <div class="rule-item"><div class="rule-dot rule-ok">✓</div>Gerbang tutup pukul 23.00. Hubungi petugas jika terlambat pulang.</div>
          <div class="rule-item"><div class="rule-dot rule-ok">✓</div>Tamu hanya boleh berkunjung pukul 08.00–21.00 WIB.</div>
          <div class="rule-item"><div class="rule-dot rule-no">✗</div>Dilarang menginap tamu tanpa izin pengelola.</div>
          <div class="rule-item"><div class="rule-dot rule-no">✗</div>Dilarang meminjamkan kunci kamar kepada siapapun.</div>
        </div>
      </div>
      <div class="rule-group">
        <div class="rule-group-header">🧹 Kebersihan</div>
        <div class="rule-group-body">
          <div class="rule-item"><div class="rule-dot rule-ok">✓</div>Buang sampah di tempat yang tersedia di tiap lantai.</div>
          <div class="rule-item"><div class="rule-dot rule-ok">✓</div>Cuci peralatan masak segera setelah digunakan.</div>
          <div class="rule-item"><div class="rule-dot rule-no">✗</div>Dilarang membuang sampah di lorong atau tangga.</div>
          <div class="rule-item"><div class="rule-dot rule-no">✗</div>Dilarang membawa hewan peliharaan tanpa izin admin.</div>
        </div>
      </div>
      <div class="rule-group">
        <div class="rule-group-header">🔇 Kebisingan</div>
        <div class="rule-group-body">
          <div class="rule-item"><div class="rule-dot rule-ok">✓</div>Jaga volume suara, terutama setelah pukul 22.00 WIB.</div>
          <div class="rule-item"><div class="rule-dot rule-no">✗</div>Dilarang memutar musik keras yang mengganggu penghuni lain.</div>
          <div class="rule-item"><div class="rule-dot rule-no">✗</div>Dilarang membuat keributan di area bersama.</div>
        </div>
      </div>
      <div class="rule-group">
        <div class="rule-group-header">🔒 Keamanan</div>
        <div class="rule-group-body">
          <div class="rule-item"><div class="rule-dot rule-ok">✓</div>Selalu kunci kamar saat meninggalkan hunian.</div>
          <div class="rule-item"><div class="rule-dot rule-ok">✓</div>Laporkan hal mencurigakan ke admin segera.</div>
          <div class="rule-item"><div class="rule-dot rule-no">✗</div>Dilarang menyimpan barang berbahaya atau bahan terlarang.</div>
          <div class="rule-item"><div class="rule-dot rule-no">✗</div>Dilarang merokok di dalam kamar atau area tertutup.</div>
        </div>
      </div>
      <div class="rule-group">
        <div class="rule-group-header">💸 Pembayaran</div>
        <div class="rule-group-body">
          <div class="rule-item"><div class="rule-dot rule-ok">✓</div>Pembayaran paling lambat tanggal 5 setiap bulan.</div>
          <div class="rule-item"><div class="rule-dot rule-ok">✓</div>Pemberitahuan keluar minimal 1 bulan sebelumnya.</div>
          <div class="rule-item"><div class="rule-dot rule-no">✗</div>Keterlambatan bayar dikenakan denda Rp 10.000/hari.</div>
        </div>
      </div>
      <div class="rule-group">
        <div class="rule-group-header">🏠 Fasilitas</div>
        <div class="rule-group-body">
          <div class="rule-item"><div class="rule-dot rule-ok">✓</div>Gunakan fasilitas dengan bertanggung jawab.</div>
          <div class="rule-item"><div class="rule-dot rule-ok">✓</div>Laporkan kerusakan fasilitas umum ke admin.</div>
          <div class="rule-item"><div class="rule-dot rule-no">✗</div>Dilarang memindahkan atau merusak barang inventaris.</div>
          <div class="rule-item"><div class="rule-dot rule-no">✗</div>Dilarang memasak di dalam kamar — gunakan dapur bersama.</div>
        </div>
      </div>
    </div>
    <div class="notice-box warning" style="margin-top:16px">
      <span>📌</span>
      <span>Pelanggaran dapat mengakibatkan <strong>teguran, denda, hingga pembatalan kontrak</strong>. Ada pertanyaan? <a href="https://wa.me/6281234567890?text=Halo%2C%20mau%20tanya%20peraturan%20kost" target="_blank" style="color:var(--warning);font-weight:600">Hubungi admin →</a></span>
    </div>
  </div>

  <!-- ======== LOKASI ======== -->
  <div class="page" id="page-lokasi">
    <div class="sec-header"><div><div class="sec-title">Lokasi</div><div class="sec-sub">Jl. Cendana No. 12, Darmo, Surabaya Selatan</div></div></div>
    <div style="display:grid;grid-template-columns:1fr 300px;gap:16px;align-items:start" id="lokasi-grid">
      <div>
        <div class="map-box" onclick="window.open('https://wa.me/6281234567890?text=Halo%2C%20tolong%20kirim%20link%20Google%20Maps%20kost','_blank')" style="margin-bottom:14px">
          <span>🗺️</span>
          <div class="map-box-label">Klik untuk minta link Google Maps via WA</div>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
          <a class="btn-wa-custom" href="https://wa.me/6281234567890?text=Halo%2C%20tolong%20kirim%20link%20Google%20Maps" target="_blank" style="justify-content:center;font-size:12px">💬 Minta Link Maps</a>
          <a class="btn-primary-custom" href="https://wa.me/6281234567890?text=Halo%2C%20mau%20jadwalkan%20survei%20langsung" target="_blank" style="justify-content:center;font-size:12px">🏠 Jadwalkan Survei</a>
        </div>
        <div class="card-plain" style="margin-top:12px">
          <div class="card-plain-body">
            <div style="font-weight:600;font-size:13px;margin-bottom:8px">🚌 Transportasi Umum</div>
            <div class="nb-item"><span>🚌 Halte Bus Darmo</span><span class="nb-dist">200 m</span></div>
            <div class="nb-item"><span>🚇 Stasiun Wonokromo</span><span class="nb-dist">1.2 km</span></div>
            <div class="nb-item"><span>✈️ Bandara Juanda</span><span class="nb-dist">18 km</span></div>
            <div class="nb-item"><span>🛵 Ojek Online</span><span class="nb-dist">< 3 mnt</span></div>
          </div>
        </div>
      </div>
      <div style="display:flex;flex-direction:column;gap:10px">
        <div class="card-plain">
          <div class="card-plain-body">
            <div style="font-weight:600;font-size:13px;margin-bottom:8px">🎓 Kampus & Sekolah</div>
            <div class="nb-item"><span>Unair</span><span class="nb-dist">1.5 km</span></div>
            <div class="nb-item"><span>UBAYA</span><span class="nb-dist">2 km</span></div>
            <div class="nb-item"><span>SMAN 5 Sby</span><span class="nb-dist">600 m</span></div>
          </div>
        </div>
        <div class="card-plain">
          <div class="card-plain-body">
            <div style="font-weight:600;font-size:13px;margin-bottom:8px">🛒 Belanja & Kuliner</div>
            <div class="nb-item"><span>Alfamart</span><span class="nb-dist">100 m</span></div>
            <div class="nb-item"><span>Giant</span><span class="nb-dist">1 km</span></div>
            <div class="nb-item"><span>Warteg Bu Sri</span><span class="nb-dist">50 m</span></div>
          </div>
        </div>
        <div class="card-plain">
          <div class="card-plain-body">
            <div style="font-weight:600;font-size:13px;margin-bottom:8px">🏥 Kesehatan</div>
            <div class="nb-item"><span>RS Dr. Soetomo</span><span class="nb-dist">2.5 km</span></div>
            <div class="nb-item"><span>Puskesmas Darmo</span><span class="nb-dist">500 m</span></div>
            <div class="nb-item"><span>Apotek K-24</span><span class="nb-dist">300 m</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ======== KONTAK ======== -->
  <div class="page" id="page-kontak">
    <div class="sec-header"><div><div class="sec-title">Kontak Admin</div><div class="sec-sub">Admin siap membantu 7 hari seminggu</div></div></div>
    <div class="contact-grid" style="margin-bottom:20px">
      <div class="contact-card">
        <span class="contact-icon">💬</span>
        <div class="contact-title">WhatsApp</div>
        <div class="contact-info">+62 812-3456-7890</div>
        <div class="contact-note">Respons rata-rata &lt; 15 menit</div>
        <a class="btn-wa-custom" href="https://wa.me/6281234567890?text=Halo%20admin%20Kost%20Harmonia!" target="_blank" style="font-size:12px;justify-content:center">💬 Chat Sekarang</a>
      </div>
      <div class="contact-card">
        <span class="contact-icon">📞</span>
        <div class="contact-title">Telepon</div>
        <div class="contact-info">+62 812-3456-7890</div>
        <div class="contact-note">Untuk urusan mendesak</div>
        <a class="btn-primary-custom" href="tel:+6281234567890" style="font-size:12px;justify-content:center">📞 Telepon</a>
      </div>
      <div class="contact-card">
        <span class="contact-icon">📧</span>
        <div class="contact-title">Email</div>
        <div class="contact-info">admin@harmonia.id</div>
        <div class="contact-note">Untuk dokumen & surat resmi</div>
        <a class="btn-outline-custom" href="mailto:admin@harmonia.id" style="font-size:12px;justify-content:center">📧 Kirim Email</a>
      </div>
      <div class="contact-card">
        <span class="contact-icon">📍</span>
        <div class="contact-title">Kunjungi Langsung</div>
        <div class="contact-info">Jl. Cendana No. 12</div>
        <div class="contact-note">Survei gratis, tanpa janji</div>
        <a class="btn-outline-custom" href="https://wa.me/6281234567890?text=Halo%2C%20mau%20survei%20langsung" target="_blank" style="font-size:12px;justify-content:center">🗺️ Jadwalkan</a>
      </div>
    </div>

    <!-- Jam operasional -->
    <div class="card-plain">
      <div class="card-plain-body">
        <div style="font-weight:600;font-size:13px;margin-bottom:12px">🕐 Jam Operasional Admin</div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:10px">
          <div style="background:var(--gray-50);border:1px solid var(--gray-200);border-radius:var(--radius);padding:12px;text-align:center">
            <div style="font-size:11px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Senin – Jumat</div>
            <div style="font-weight:700;font-size:14px;color:var(--gray-900);font-family:'JetBrains Mono',monospace">08.00 – 21.00</div>
          </div>
          <div style="background:var(--gray-50);border:1px solid var(--gray-200);border-radius:var(--radius);padding:12px;text-align:center">
            <div style="font-size:11px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Sabtu</div>
            <div style="font-weight:700;font-size:14px;color:var(--gray-900);font-family:'JetBrains Mono',monospace">08.00 – 20.00</div>
          </div>
          <div style="background:var(--gray-50);border:1px solid var(--gray-200);border-radius:var(--radius);padding:12px;text-align:center">
            <div style="font-size:11px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Minggu</div>
            <div style="font-weight:700;font-size:14px;color:var(--gray-900);font-family:'JetBrains Mono',monospace">09.00 – 18.00</div>
          </div>
          <div style="background:var(--gray-50);border:1px solid var(--gray-200);border-radius:var(--radius);padding:12px;text-align:center">
            <div style="font-size:11px;font-weight:600;color:var(--gray-500);margin-bottom:4px">Darurat / 24 Jam</div>
            <div style="font-weight:700;font-size:14px;color:var(--danger);font-family:'JetBrains Mono',monospace">WA Saja</div>
          </div>
        </div>
      </div>
    </div>

    <!-- FAQ -->
    <div class="sec-header" style="margin-top:24px"><div class="sec-title">FAQ</div></div>
    <div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-question">Bagaimana cara memesan kamar?<span class="faq-arrow">▾</span></div><div class="faq-answer"><div class="faq-answer-inner">Hubungi admin via WhatsApp di +62 812-3456-7890. Ceritakan kebutuhan Anda, admin akan merekomendasikan kamar dan jadwalkan survei gratis. Setelah cocok, bayar deposit untuk konfirmasi booking.</div></div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-question">Apa syarat menjadi penghuni?<span class="faq-arrow">▾</span></div><div class="faq-answer"><div class="faq-answer-inner">Syaratnya mudah: fotokopi KTP/KTM, foto 3×4 dua lembar, nomor HP aktif, dan pembayaran deposit + sewa bulan pertama. Terbuka untuk mahasiswa, karyawan, maupun wirausahawan.</div></div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-question">Berapa lama kontrak minimal?<span class="faq-arrow">▾</span></div><div class="faq-answer"><div class="faq-answer-inner">Minimal 1 bulan. Disarankan minimal 3 bulan agar lebih hemat. Sewa 6 bulan dapat diskon 5%, sewa 12 bulan dapat diskon 10%.</div></div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-question">Apakah ada WiFi? Seberapa cepat?<span class="faq-arrow">▾</span></div><div class="faq-answer"><div class="faq-answer-inner">WiFi fiber optik 100 Mbps unlimited 24 jam. Kamar VIP mendapat akses priority. Sudah termasuk dalam harga sewa.</div></div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-question">Bagaimana sistem pembayaran listrik?<span class="faq-arrow">▾</span></div><div class="faq-answer"><div class="faq-answer-inner">Listrik dihitung berdasarkan pemakaian kWh di meteran masing-masing kamar, mengikuti tarif PLN. Tagihan disampaikan awal bulan, dibayar paling lambat tanggal 5.</div></div></div>
      <div class="faq-item" onclick="toggleFaq(this)"><div class="faq-question">Apakah ada diskon sewa jangka panjang?<span class="faq-arrow">▾</span></div><div class="faq-answer"><div class="faq-answer-inner">Ya! Sewa 6 bulan diskon 5%, sewa 12 bulan diskon 10%. Hubungi admin via WA untuk penawaran terbaik.</div></div></div>
    </div>
  </div>

</div><!-- /.main-wrap -->

<!-- FOOTER -->
<footer class="footer">
  <div class="footer-inner">
    <div>
      <div class="footer-brand-txt">🏠 Kost Harmonia</div>
      <div style="font-size:12px;margin-top:2px">Jl. Cendana No. 12, Surabaya Selatan</div>
    </div>
    <div class="footer-right">
      <a href="https://wa.me/6281234567890" target="_blank">WhatsApp</a>
      <a href="mailto:admin@harmonia.id">Email</a>
      <span style="color:rgba(255,255,255,.3)">© 2026 Kost Harmonia</span>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const WA_NUM = '6281234567890';
let curRoom = { emoji: '🛏️', name: '', price: '' };
let curOpt = 'tanya';

/* ===== NAVIGATION ===== */
const pages = ['beranda','kamar','fasilitas','harga','tatatertib','lokasi','kontak'];

function showPage(name) {
  pages.forEach(p => {
    const el = document.getElementById('page-' + p);
    const nav = document.getElementById('nav-' + p);
    if (el) el.classList.toggle('active', p === name);
    if (nav) nav.classList.toggle('active', p === name);
  });
  // mobile menu items
  document.querySelectorAll('.topnav-mobile-item').forEach(el => el.classList.remove('active'));
  window.scrollTo({ top: 0, behavior: 'smooth' });
  document.getElementById('mobileMenu').classList.remove('open');
  document.getElementById('burgerBtn').classList.remove('open');
}

/* ===== MOBILE MENU ===== */
function toggleMobile() {
  document.getElementById('mobileMenu').classList.toggle('open');
  document.getElementById('burgerBtn').classList.toggle('open');
}

/* ===== ROOM FILTER ===== */
function filterRoom(type, btn) {
  document.querySelectorAll('.ftab').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('.room-card').forEach(card => {
    let show = true;
    if (type === 'tersedia') show = card.dataset.status === 'tersedia';
    else if (type !== 'semua') show = card.dataset.type === type;
    card.style.display = show ? '' : 'none';
  });
}

/* ===== ROOM MODAL ===== */
function openRoomModal(emoji, name, price) {
  curRoom = { emoji, name, price };
  curOpt = 'tanya';
  document.getElementById('modal-emoji').textContent = emoji;
  document.getElementById('modal-name').textContent = name;
  document.getElementById('modal-price').textContent = price + '/bulan';
  document.querySelectorAll('.modal-opt').forEach(o => o.classList.remove('selected'));
  document.getElementById('opt-tanya').classList.add('selected');
  buildWaLink();
  document.getElementById('roomModal').classList.add('open');
}
function closeRoomModal() { document.getElementById('roomModal').classList.remove('open'); }

function selectOpt(opt, el) {
  curOpt = opt;
  document.querySelectorAll('.modal-opt').forEach(o => o.classList.remove('selected'));
  el.classList.add('selected');
  buildWaLink();
}
function buildWaLink() {
  const msgs = {
    tanya: `Halo admin, saya tertarik *${curRoom.name}* (${curRoom.price}/bln). Masih tersedia?`,
    survey: `Halo admin, saya ingin survei untuk *${curRoom.name}*. Kapan bisa?`,
    booking: `Halo admin, saya ingin booking *${curRoom.name}* (${curRoom.price}/bln). Apa syaratnya?`,
    nego: `Halo admin, apakah harga *${curRoom.name}* bisa dinegosiasi untuk sewa jangka panjang?`,
  };
  document.getElementById('modal-wa-link').href = `https://wa.me/${WA_NUM}?text=${encodeURIComponent(msgs[curOpt])}`;
}
document.getElementById('roomModal').addEventListener('click', e => { if (e.target === document.getElementById('roomModal')) closeRoomModal(); });

/* ===== FAQ ===== */
function toggleFaq(el) {
  const isOpen = el.classList.contains('open');
  document.querySelectorAll('.faq-item').forEach(f => f.classList.remove('open'));
  if (!isOpen) el.classList.add('open');
}

/* ===== CLOSE ON ESC ===== */
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') { closeRoomModal(); document.getElementById('mobileMenu').classList.remove('open'); }
});

/* ===== RESPONSIVE LOKASI ===== */
function checkLokasiLayout() {
  const grid = document.getElementById('lokasi-grid');
  if (grid) grid.style.gridTemplateColumns = window.innerWidth < 700 ? '1fr' : '1fr 300px';
}
window.addEventListener('resize', checkLokasiLayout);
checkLokasiLayout();
</script>
</body>
</html>