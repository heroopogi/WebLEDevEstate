<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DevEstate | Modern Real Estate Interface</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800|playfair-display:600,700&display=swap" rel="stylesheet" />
        <style>
            :root {
                --navy: #1E3A5F;
                --navy-soft: #2C4E73;
                --navy-deep: #1E293B;
                --white: #FFFFFF;
                --gold: #D4A017;
                --gold-deep: #B8870F;
                --bg-light: #F5F7FA;
                --bg-soft: #F8FAFC;
                --text-dark: #1F2937;
                --text-muted: #374151;
                --text-slate: #334155;
                --border: #E5E7EB;
                --input-border: #CBD5E1;
                --success: #22C55E;
                --danger: #EF4444;
                --radius-sm: 8px;
                --radius-md: 12px;
                --radius-lg: 24px;
                --shadow-soft: 0 18px 40px rgba(15, 23, 42, 0.08);
                --shadow-card: 0 14px 30px rgba(30, 58, 95, 0.10);
                --shadow-strong: 0 24px 60px rgba(15, 23, 42, 0.16);
                --container: 1180px;
            }

            * { box-sizing: border-box; }
            html { scroll-behavior: smooth; }
            body {
                margin: 0;
                font-family: "Manrope", sans-serif;
                color: var(--text-dark);
                background:
                    radial-gradient(circle at top left, rgba(212, 160, 23, 0.12), transparent 28%),
                    linear-gradient(180deg, #f8fafc 0%, #f5f7fa 24%, #ffffff 100%);
            }

            a { color: inherit; text-decoration: none; }
            img { max-width: 100%; display: block; }
            button, input, select { font: inherit; }

            .container { width: min(var(--container), calc(100% - 2rem)); margin: 0 auto; }
            .eyebrow {
                display: inline-flex; align-items: center; gap: 0.55rem; padding: 0.45rem 0.85rem; border-radius: 999px;
                background: rgba(212, 160, 23, 0.12); color: var(--navy); font-size: 0.82rem; font-weight: 800;
                letter-spacing: 0.08em; text-transform: uppercase;
            }
            .section-title {
                margin: 0; color: var(--navy); font-family: "Playfair Display", serif;
                font-size: clamp(2rem, 3vw, 3.4rem); line-height: 1.08;
            }
            .section-copy { margin: 0; max-width: 680px; color: var(--text-muted); line-height: 1.7; }
            .page-shell { position: relative; overflow: hidden; padding-bottom: 6rem; }
            .page-shell::before {
                content: ""; position: absolute; top: -180px; right: -140px; width: 420px; height: 420px; border-radius: 50%;
                background: radial-gradient(circle, rgba(30, 58, 95, 0.12), transparent 70%); pointer-events: none;
            }

            .site-header {
                position: sticky; top: 0; z-index: 20; backdrop-filter: blur(18px);
                background: rgba(30, 58, 95, 0.94); border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            }
            .nav-bar {
                display: flex; align-items: center; justify-content: space-between; gap: 1rem; min-height: 78px;
            }
            .brand { display: flex; align-items: center; gap: 0.8rem; color: var(--white); font-weight: 800; letter-spacing: 0.02em; }
            .brand-mark {
                display: grid; place-items: center; width: 44px; height: 44px; border-radius: 14px;
                background: linear-gradient(135deg, var(--gold), #f0c96a); color: var(--navy);
                box-shadow: 0 12px 22px rgba(212, 160, 23, 0.28);
            }
            .brand-stack strong, .brand-stack span { display: block; }
            .brand-stack span { color: rgba(255, 255, 255, 0.7); font-size: 0.75rem; font-weight: 600; }
            .nav-links {
                display: flex; align-items: center; gap: 1.4rem; color: rgba(255, 255, 255, 0.84); font-size: 0.95rem; font-weight: 600;
            }
            .nav-links a:hover { color: var(--white); }
            .nav-actions { display: flex; align-items: center; gap: 0.8rem; }

            .btn {
                display: inline-flex; align-items: center; justify-content: center; gap: 0.55rem; min-height: 46px; padding: 10px 16px;
                border-radius: var(--radius-sm); border: none; font-weight: 700; cursor: pointer;
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease;
            }
            .btn:hover { transform: translateY(-1px); }
            .btn-primary { background: var(--navy); color: var(--white); box-shadow: 0 12px 24px rgba(30, 58, 95, 0.22); }
            .btn-primary:hover { background: var(--navy-soft); }
            .btn-accent { background: var(--gold); color: var(--white); box-shadow: 0 12px 24px rgba(212, 160, 23, 0.28); }
            .btn-accent:hover { background: var(--gold-deep); }
            .btn-success { background: var(--success); color: var(--white); }
            .btn-danger { background: var(--danger); color: var(--white); }
            .btn-outline { background: transparent; color: var(--navy); border: 2px solid var(--navy); }

            .hero { padding: 2rem 0 3rem; background: var(--bg-light); }
            .hero-grid { display: grid; grid-template-columns: 1.15fr 0.85fr; gap: 1.6rem; align-items: stretch; }
            .hero-panel {
                position: relative; min-height: 620px; padding: 2rem; border-radius: 28px; overflow: hidden;
                background:
                    linear-gradient(rgba(30, 58, 95, 0.75), rgba(30, 58, 95, 0.82)),
                    url('https://images.unsplash.com/photo-1600585154084-4e5fe7c39198?auto=format&fit=crop&w=1400&q=80') center/cover;
                box-shadow: var(--shadow-strong);
            }
            .hero-panel::after {
                content: ""; position: absolute; inset: auto -60px -80px auto; width: 240px; height: 240px; border-radius: 50%;
                background: radial-gradient(circle, rgba(212, 160, 23, 0.35), transparent 70%);
            }
            .hero-content {
                position: relative; z-index: 1; display: flex; flex-direction: column; justify-content: space-between; height: 100%; color: var(--white);
            }
            .hero-copy h1 {
                margin: 1.2rem 0 1rem; font-family: "Playfair Display", serif; font-size: clamp(3rem, 5vw, 5rem);
                line-height: 0.98; max-width: 9.5ch;
            }
            .hero-copy p {
                margin: 0 0 1.8rem; max-width: 600px; color: rgba(255, 255, 255, 0.82); line-height: 1.8; font-size: 1.04rem;
            }
            .hero-actions, .inline-actions { display: flex; flex-wrap: wrap; gap: 0.8rem; }
            .stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
            .stat-card {
                padding: 1rem 1.1rem; border-radius: 18px; background: rgba(255, 255, 255, 0.12);
                border: 1px solid rgba(255, 255, 255, 0.14); backdrop-filter: blur(8px);
            }
            .stat-card strong { display: block; font-size: 1.35rem; margin-bottom: 0.25rem; }
            .stat-card span { color: rgba(255, 255, 255, 0.74); font-size: 0.9rem; }
            .stack { display: grid; gap: 1.2rem; }

            .panel, .card {
                background: var(--white); border: 1px solid rgba(148, 163, 184, 0.16); border-radius: 24px; box-shadow: var(--shadow-soft);
            }
            .search-panel { padding: 1.4rem; background: #EEF2F7; }
            .panel-head {
                display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1.2rem;
            }
            .panel-head h2, .panel-head h3, .card h3, .card h4 { margin: 0; color: var(--navy); }
            .muted { color: var(--text-slate); }
            .search-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 0.9rem; }
            .field { display: grid; gap: 0.45rem; }
            .field label { color: var(--text-slate); font-size: 0.9rem; font-weight: 700; }
            .field input, .field select {
                width: 100%; min-height: 48px; padding: 0.8rem 0.95rem; border-radius: 12px; border: 1px solid var(--input-border);
                background: var(--white); color: var(--text-dark);
            }
            .tags { display: flex; flex-wrap: wrap; gap: 0.65rem; margin-top: 1rem; }
            .tag {
                display: inline-flex; align-items: center; padding: 0.5rem 0.8rem; border-radius: 999px; font-size: 0.84rem; font-weight: 700;
                background: rgba(212, 160, 23, 0.16); color: #8a670b;
            }
            .mini-card { padding: 1.4rem; }
            .mini-card p { margin: 0.55rem 0 0; color: var(--text-muted); line-height: 1.7; }
            .kpi {
                display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-top: 1.1rem; padding-top: 1rem; border-top: 1px solid var(--border);
            }
            .kpi strong { display: block; color: var(--navy); font-size: 1.1rem; }
            .section { padding: 5rem 0; }
            .section.alt { background: linear-gradient(180deg, rgba(245, 247, 250, 0.6), rgba(255, 255, 255, 0)); }
            .section-head {
                display: flex; align-items: end; justify-content: space-between; gap: 1.5rem; margin-bottom: 2rem;
            }
            .property-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.25rem; }
            .property-card {
                overflow: hidden; background: #F9FAFB; border: 1px solid var(--border); border-radius: 22px; box-shadow: var(--shadow-card);
            }
            .property-media { position: relative; aspect-ratio: 4 / 3; overflow: hidden; }
            .property-media img { width: 100%; height: 100%; object-fit: cover; }
            .property-chip {
                position: absolute; top: 1rem; left: 1rem; padding: 0.45rem 0.8rem; border-radius: 999px; background: rgba(255, 255, 255, 0.92);
                color: var(--navy); font-size: 0.8rem; font-weight: 800;
            }
            .property-body { padding: 1.35rem; }
            .property-meta, .detail-meta, .card-list, .split-list, .mobile-menu { display: flex; flex-wrap: wrap; gap: 0.65rem; }
            .property-meta span, .detail-meta span, .split-list span {
                padding: 0.48rem 0.72rem; border-radius: 999px; background: #E2E8F0; color: var(--text-slate); font-size: 0.82rem; font-weight: 700;
            }
            .property-card h3 { margin: 0.9rem 0 0.55rem; font-size: 1.2rem; color: var(--navy); }
            .property-card p { margin: 0; color: var(--text-muted); line-height: 1.7; }
            .price-row {
                display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-top: 1.2rem;
            }
            .price { color: var(--gold); font-size: 1.35rem; font-weight: 800; }
            .detail-layout { display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 1.4rem; align-items: start; }
            .detail-gallery { padding: 1.2rem; background: var(--bg-soft); }
            .detail-hero-image { overflow: hidden; border-radius: 18px; margin-bottom: 1rem; }
            .detail-hero-image img { aspect-ratio: 16 / 10; width: 100%; object-fit: cover; }
            .thumb-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 0.8rem; }
            .thumb-grid img { border-radius: 16px; aspect-ratio: 4 / 3; object-fit: cover; }
            .detail-card { padding: 1.6rem; }
            .detail-card h3 { font-size: 2rem; margin-bottom: 0.5rem; }
            .detail-description { margin: 1.2rem 0 1.6rem; color: var(--text-muted); line-height: 1.8; }
            .detail-list { display: grid; gap: 0.9rem; margin: 1.4rem 0 1.6rem; }
            .detail-item, .upload-status, .dashboard-stat {
                display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 0.95rem 1rem;
                border-radius: 14px; background: #F8FAFC; border: 1px solid #E2E8F0;
            }
            .detail-item strong, .dashboard-stat strong { color: var(--navy); }
            .map-layout, .admin-layout, .mobile-layout { display: grid; grid-template-columns: 1fr 0.95fr; gap: 1.4rem; }
            .map-card { padding: 1.25rem; background: var(--white); }
            .map-surface {
                position: relative; min-height: 420px; border-radius: 22px; overflow: hidden;
                background:
                    linear-gradient(120deg, rgba(30, 58, 95, 0.08), rgba(212, 160, 23, 0.08)),
                    radial-gradient(circle at 30% 20%, rgba(30, 58, 95, 0.08), transparent 30%),
                    #f8fafc;
                border: 1px solid #E2E8F0;
            }
            .map-grid {
                position: absolute; inset: 0;
                background-image:
                    linear-gradient(rgba(148, 163, 184, 0.14) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(148, 163, 184, 0.14) 1px, transparent 1px);
                background-size: 62px 62px;
            }
            .road { position: absolute; background: rgba(148, 163, 184, 0.35); border-radius: 999px; }
            .road.horizontal { height: 10px; width: 72%; top: 48%; left: 14%; }
            .road.vertical { width: 10px; height: 74%; left: 48%; top: 13%; }
            .map-label { position: absolute; color: var(--navy); font-weight: 800; font-size: 0.84rem; }
            .map-pin {
                position: absolute; width: 20px; height: 20px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg);
                background: var(--gold); box-shadow: 0 8px 18px rgba(212, 160, 23, 0.42);
            }
            .map-pin::after { content: ""; position: absolute; inset: 5px; border-radius: 50%; background: var(--white); }
            .nearby-panel, .upload-card, .dashboard-card, .login-card, .phone-shell { padding: 1.5rem; }
            .nearby-list, .dashboard-grid { display: grid; gap: 0.9rem; }
            .nearby-item {
                display: flex; align-items: center; justify-content: space-between; gap: 1rem;
                padding: 1rem; border-radius: 14px; background: #F8FAFC; border: 1px solid #E2E8F0;
            }
            .nearby-item span:last-child {
                padding: 0.38rem 0.7rem; border-radius: 999px; background: #E2E8F0; color: var(--text-slate); font-size: 0.8rem; font-weight: 700;
            }
            .upload-wrap { display: grid; gap: 1.2rem; }
            .upload-dropzone {
                display: grid; place-items: center; min-height: 260px; padding: 1.4rem; text-align: center;
                border-radius: 20px; background: var(--white); border: 2px dashed #94A3B8;
            }
            .upload-dropzone strong { color: var(--navy); font-size: 1.15rem; }
            .upload-dropzone p { margin: 0.6rem 0 0; max-width: 380px; color: var(--text-muted); line-height: 1.7; }
            .upload-status.success { color: #166534; background: rgba(34, 197, 94, 0.10); border-color: rgba(34, 197, 94, 0.24); }
            .upload-status.error { color: #991B1B; background: rgba(239, 68, 68, 0.10); border-color: rgba(239, 68, 68, 0.24); }
            .admin-shell { background: #F1F5F9; border-radius: 28px; padding: 1.2rem; box-shadow: var(--shadow-card); }
            .dashboard-shell { display: grid; grid-template-columns: 260px 1fr; gap: 1.2rem; }
            .sidebar { padding: 1.25rem; border-radius: 24px; background: var(--navy-deep); color: rgba(255, 255, 255, 0.86); }
            .sidebar h3 { margin: 0 0 1rem; color: var(--white); }
            .menu-list { display: grid; gap: 0.65rem; margin-top: 1.2rem; }
            .menu-item {
                display: flex; align-items: center; justify-content: space-between; gap: 0.8rem; padding: 0.95rem 1rem;
                border-radius: 14px; background: transparent; font-weight: 700;
            }
            .menu-item.active { background: #334155; color: var(--white); }
            .menu-item .dot { width: 10px; height: 10px; border-radius: 50%; background: var(--gold); }
            .dashboard-main { display: grid; gap: 1.2rem; }
            .dashboard-overview { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1rem; }
            .dashboard-card { background: var(--white); border-radius: 20px; box-shadow: var(--shadow-soft); }
            .highlight { color: var(--gold); font-weight: 800; }
            .dashboard-table { width: 100%; border-collapse: collapse; font-size: 0.95rem; }
            .dashboard-table th, .dashboard-table td {
                padding: 0.95rem 0; text-align: left; border-bottom: 1px solid #E2E8F0; color: #0F172A;
            }
            .dashboard-table th { color: #475569; font-size: 0.83rem; text-transform: uppercase; letter-spacing: 0.06em; }
            .login-section { padding: 5rem 0; background: linear-gradient(135deg, #1E3A5F 0%, #2C4E73 100%); }
            .login-shell { display: grid; grid-template-columns: 0.95fr 0.8fr; gap: 1.5rem; align-items: center; }
            .login-copy { color: var(--white); }
            .login-copy h2 { color: var(--white); }
            .login-card { background: var(--white); border-radius: 24px; box-shadow: var(--shadow-strong); }
            .login-form { display: grid; gap: 1rem; margin-top: 1.4rem; }
            .login-form input {
                min-height: 50px; border: 1px solid var(--input-border); border-radius: 12px; padding: 0.85rem 0.95rem;
            }
            .login-form .meta-row {
                display: flex; align-items: center; justify-content: space-between; gap: 1rem; font-size: 0.9rem; color: var(--text-muted);
            }
            .phone-shell {
                max-width: 390px; margin-left: auto; border-radius: 32px; background: var(--white);
                box-shadow: var(--shadow-strong); border: 10px solid #E2E8F0;
            }
            .phone-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; }
            .phone-screen { padding: 1rem; border-radius: 24px; background: #F9FAFB; }
            .phone-card { padding: 1rem; border-radius: 18px; background: var(--white); box-shadow: var(--shadow-soft); }
            .phone-card img { border-radius: 16px; aspect-ratio: 4 / 3; object-fit: cover; margin-bottom: 0.9rem; }
            .phone-bottom-nav {
                display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 0.75rem; margin-top: 1rem;
                padding: 0.9rem; border-radius: 18px; background: var(--navy); color: rgba(255, 255, 255, 0.68);
            }
            .nav-icon { display: grid; gap: 0.3rem; justify-items: center; font-size: 0.75rem; font-weight: 700; }
            .nav-icon strong {
                display: grid; place-items: center; width: 34px; height: 34px; border-radius: 12px; background: rgba(255, 255, 255, 0.12); color: inherit;
            }
            .nav-icon.active { color: var(--gold); }
            .footer { padding: 2rem 0 6rem; color: #64748B; text-align: center; font-size: 0.95rem; }

            @media (max-width: 1100px) {
                .hero-grid, .detail-layout, .map-layout, .admin-layout, .mobile-layout, .login-shell, .dashboard-shell { grid-template-columns: 1fr; }
                .property-grid, .dashboard-overview { grid-template-columns: repeat(2, minmax(0, 1fr)); }
                .nav-links { display: none; }
            }

            @media (max-width: 780px) {
                .hero { padding-top: 1rem; }
                .hero-panel { min-height: auto; }
                .search-grid, .property-grid, .dashboard-overview, .thumb-grid, .stats-row { grid-template-columns: 1fr; }
                .section-head, .panel-head, .nav-bar, .price-row, .phone-top { align-items: start; flex-direction: column; }
                .nav-actions { width: 100%; }
                .nav-actions .btn { flex: 1; }
                .container { width: min(var(--container), calc(100% - 1.2rem)); }
                .section, .login-section { padding: 3.75rem 0; }
            }
        </style>
    </head>
    <body>
        <div class="page-shell">
            <header class="site-header">
                <div class="container nav-bar">
                    <a href="#home" class="brand">
                        <span class="brand-mark">DE</span>
                        <span class="brand-stack">
                            <strong>DevEstate</strong>
                            <span>Luxury Property Platform</span>
                        </span>
                    </a>
                    <nav class="nav-links">
                        <a href="#listings">Properties</a>
                        <a href="#details">Details</a>
                        <a href="#map">Locations</a>
                        <a href="#admin">Admin</a>
                    </nav>
                    <form method="POST" action="/logout" class="nav-actions">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </header>

            <main>
                <section class="hero" id="home">
                    <div class="container hero-grid">
                        <article class="hero-panel">
                            <div class="hero-content">
                                <div class="hero-copy">
                                    <span class="eyebrow">Premier Real Estate Interface</span>
                                    <h1>Find refined spaces built for modern living.</h1>
                                    <p>
                                        A clean, professional property platform designed for trust, speed, and premium presentation.
                                        This interface showcases landing, listings, search, property details, admin, and mobile experiences using a unified navy and gold system.
                                    </p>
                                    <div class="hero-actions">
                                        <a href="#listings" class="btn btn-accent">Browse Properties</a>
                                        <a href="#details" class="btn btn-outline" style="color:#FFFFFF; border-color:rgba(255,255,255,0.35);">View Showcase</a>
                                    </div>
                                </div>
                                <div class="stats-row">
                                    <div class="stat-card">
                                        <strong>240+</strong>
                                        <span>Curated premium listings</span>
                                    </div>
                                    <div class="stat-card">
                                        <strong>18</strong>
                                        <span>High-demand city districts</span>
                                    </div>
                                    <div class="stat-card">
                                        <strong>96%</strong>
                                        <span>Client match satisfaction</span>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <div class="stack">
                            <section class="panel search-panel">
                                <div class="panel-head">
                                    <div>
                                        <h2>Search & Filter</h2>
                                        <p class="muted">Corporate search experience with clear hierarchy and gold active tags.</p>
                                    </div>
                                    <a href="#listings" class="btn btn-primary">Search Now</a>
                                </div>
                                <div class="search-grid">
                                    <div class="field">
                                        <label for="location">Location</label>
                                        <input id="location" type="text" value="Makati City" readonly>
                                    </div>
                                    <div class="field">
                                        <label for="type">Property Type</label>
                                        <select id="type"><option>Condominium</option></select>
                                    </div>
                                    <div class="field">
                                        <label for="budget">Budget</label>
                                        <input id="budget" type="text" value="$350,000 - $900,000" readonly>
                                    </div>
                                    <div class="field">
                                        <label for="bedrooms">Bedrooms</label>
                                        <select id="bedrooms"><option>3+ Bedrooms</option></select>
                                    </div>
                                </div>
                                <div class="tags">
                                    <span class="tag">Waterfront</span>
                                    <span class="tag">Pet Friendly</span>
                                    <span class="tag">Ready for Move-In</span>
                                </div>
                            </section>

                            <section class="card mini-card">
                                <span class="eyebrow">Consultation</span>
                                <h3>Trusted guidance from inquiry to closing.</h3>
                                <p>
                                    The layout keeps calls-to-action prominent while supporting premium property storytelling, agent credibility, and quick decision-making.
                                </p>
                                <div class="kpi">
                                    <div>
                                        <strong>24/7</strong>
                                        <span class="muted">Concierge response</span>
                                    </div>
                                    <a href="#login" class="btn btn-success">Contact Advisor</a>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>

                <section class="section" id="listings">
                    <div class="container">
                        <div class="section-head">
                            <div>
                                <span class="eyebrow">Property Listing Page</span>
                                <h2 class="section-title">Premium listings with calm spacing and strong visual trust.</h2>
                            </div>
                            <p class="section-copy">
                                Property cards use a bright white and soft-gray canvas, subtle borders, navy headings, gold pricing, and consistent action buttons for a polished marketplace experience.
                            </p>
                        </div>
                        <div class="property-grid">
                            <article class="property-card">
                                <div class="property-media">
                                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=900&q=80" alt="Luxury house exterior">
                                    <span class="property-chip">Featured</span>
                                </div>
                                <div class="property-body">
                                    <div class="property-meta">
                                        <span>4 Beds</span>
                                        <span>3 Baths</span>
                                        <span>420 sqm</span>
                                    </div>
                                    <h3>Skyline Ridge Residence</h3>
                                    <p>Modern architecture with panoramic city views, smart-home finishes, and private landscaped entry.</p>
                                    <div class="price-row">
                                        <span class="price">$780,000</span>
                                        <a href="#details" class="btn btn-primary">View Property</a>
                                    </div>
                                </div>
                            </article>
                            <article class="property-card">
                                <div class="property-media">
                                    <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=900&q=80" alt="Contemporary residence">
                                    <span class="property-chip">New</span>
                                </div>
                                <div class="property-body">
                                    <div class="property-meta">
                                        <span>3 Beds</span>
                                        <span>2 Baths</span>
                                        <span>280 sqm</span>
                                    </div>
                                    <h3>Parklane Executive Home</h3>
                                    <p>Bright open-plan living with sculpted interiors, premium kitchen detailing, and quiet private access.</p>
                                    <div class="price-row">
                                        <span class="price">$620,000</span>
                                        <a href="#details" class="btn btn-primary">View Property</a>
                                    </div>
                                </div>
                            </article>
                            <article class="property-card">
                                <div class="property-media">
                                    <img src="https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?auto=format&fit=crop&w=900&q=80" alt="Penthouse interior">
                                    <span class="property-chip">Top Rated</span>
                                </div>
                                <div class="property-body">
                                    <div class="property-meta">
                                        <span>5 Beds</span>
                                        <span>4 Baths</span>
                                        <span>510 sqm</span>
                                    </div>
                                    <h3>Harbor Crest Penthouse</h3>
                                    <p>Refined penthouse suite with double-height windows, private terrace, and concierge-ready service access.</p>
                                    <div class="price-row">
                                        <span class="price">$1,150,000</span>
                                        <a href="#details" class="btn btn-primary">View Property</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </section>

                <section class="section alt" id="details">
                    <div class="container">
                        <div class="section-head">
                            <div>
                                <span class="eyebrow">Property Details Page</span>
                                <h2 class="section-title">Focused property storytelling with a premium contact path.</h2>
                            </div>
                            <p class="section-copy">
                                The details layout uses a soft image stage, bold navy headings, gold pricing, readable body text, and a green contact action for immediate next steps.
                            </p>
                        </div>
                        <div class="detail-layout">
                            <section class="panel detail-gallery">
                                <div class="detail-hero-image">
                                    <img src="https://images.unsplash.com/photo-1605146769289-440113cc3d00?auto=format&fit=crop&w=1200&q=80" alt="Luxury property living room">
                                </div>
                                <div class="thumb-grid">
                                    <img src="https://images.unsplash.com/photo-1600607687644-c7f34b5a20f1?auto=format&fit=crop&w=700&q=80" alt="Interior detail">
                                    <img src="https://images.unsplash.com/photo-1600566753151-384129cf4e3e?auto=format&fit=crop&w=700&q=80" alt="Kitchen detail">
                                    <img src="https://images.unsplash.com/photo-1600573472550-8090b5e0745e?auto=format&fit=crop&w=700&q=80" alt="Pool view">
                                </div>
                            </section>
                            <aside class="card detail-card">
                                <span class="eyebrow">Signature Listing</span>
                                <h3>Azure Bay Terrace</h3>
                                <div class="detail-meta">
                                    <span>Beachfront</span>
                                    <span>Private Garage</span>
                                    <span>Solar Ready</span>
                                </div>
                                <p class="price" style="margin:1rem 0 0;">$920,000</p>
                                <p class="detail-description">
                                    Azure Bay Terrace balances coastal calm with executive luxury. Large-format glazing, tailored finishes, and open entertaining zones create a sophisticated experience from entry to rooftop.
                                </p>
                                <div class="detail-list">
                                    <div class="detail-item">
                                        <span>Floor Area</span>
                                        <strong>460 sqm</strong>
                                    </div>
                                    <div class="detail-item">
                                        <span>Bedrooms</span>
                                        <strong>4 Premium Suites</strong>
                                    </div>
                                    <div class="detail-item">
                                        <span>Community Access</span>
                                        <strong>5 min to Marina District</strong>
                                    </div>
                                </div>
                                <div class="inline-actions">
                                    <a href="#login" class="btn btn-success">Contact Agent</a>
                                    <a href="#map" class="btn btn-outline">View Location</a>
                                </div>
                            </aside>
                        </div>
                    </div>
                </section>

                <section class="section" id="map">
                    <div class="container">
                        <div class="section-head">
                            <div>
                                <span class="eyebrow">Map & Location Page</span>
                                <h2 class="section-title">Location intelligence framed inside a clean white map card.</h2>
                            </div>
                            <p class="section-copy">
                                The map module keeps the interface airy and readable, with navy labels, gold pins, and soft nearby tags that support context without visual clutter.
                            </p>
                        </div>
                        <div class="map-layout">
                            <section class="card map-card">
                                <div class="map-surface">
                                    <div class="map-grid"></div>
                                    <div class="road horizontal"></div>
                                    <div class="road vertical"></div>
                                    <span class="map-label" style="top:18%; left:12%;">Central Business District</span>
                                    <span class="map-label" style="top:63%; left:62%;">Riverside Park</span>
                                    <span class="map-label" style="top:30%; left:58%;">Metro Station</span>
                                    <span class="map-pin" style="top:34%; left:42%;"></span>
                                    <span class="map-pin" style="top:56%; left:63%;"></span>
                                    <span class="map-pin" style="top:25%; left:68%;"></span>
                                </div>
                            </section>
                            <aside class="card nearby-panel">
                                <span class="eyebrow">Nearby Highlights</span>
                                <h3>Walkable, connected, and investment-ready.</h3>
                                <div class="nearby-list" style="margin-top:1.25rem;">
                                    <div class="nearby-item">
                                        <div>
                                            <strong>Financial District</strong>
                                            <div class="muted">Corporate offices and business lounges</div>
                                        </div>
                                        <span>4 min</span>
                                    </div>
                                    <div class="nearby-item">
                                        <div>
                                            <strong>Harbor Retail Row</strong>
                                            <div class="muted">Dining, shopping, and lifestyle brands</div>
                                        </div>
                                        <span>7 min</span>
                                    </div>
                                    <div class="nearby-item">
                                        <div>
                                            <strong>St. Helena Academy</strong>
                                            <div class="muted">Top-rated academic district</div>
                                        </div>
                                        <span>10 min</span>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </section>

                <section class="section alt" id="admin">
                    <div class="container">
                        <div class="section-head">
                            <div>
                                <span class="eyebrow">Admin Upload Page</span>
                                <h2 class="section-title">A simplified media workflow for property image management.</h2>
                            </div>
                            <p class="section-copy">
                                This admin interface stays focused on presentation, using a bright upload surface, navy primary controls, and clear green or red status states for instant clarity.
                            </p>
                        </div>
                        <div class="admin-layout">
                            <section class="card upload-card" style="background:#F8FAFC;">
                                <div class="upload-wrap">
                                    <div class="upload-dropzone">
                                        <div>
                                            <strong>Drag property visuals here</strong>
                                            <p>Showcase a bright, structured upload area with a dashed slate border and direct administrative controls.</p>
                                            <div class="inline-actions" style="justify-content:center; margin-top:1.2rem;">
                                                <button class="btn btn-primary" type="button">Upload Images</button>
                                                <button class="btn btn-outline" type="button">Select Folder</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="upload-status success">
                                        <span>Success Message</span>
                                        <strong>12 images prepared for listing preview</strong>
                                    </div>
                                    <div class="upload-status error">
                                        <span>Error Message</span>
                                        <strong>2 files require higher resolution</strong>
                                    </div>
                                </div>
                            </section>
                            <aside class="card mini-card">
                                <span class="eyebrow">Upload Guide</span>
                                <h3>Professional visual standards for every listing.</h3>
                                <p>
                                    Present upload requirements in a calm, administrative layout so agents can curate image sets quickly without backend complexity.
                                </p>
                                <div class="detail-list">
                                    <div class="detail-item">
                                        <span>Recommended Format</span>
                                        <strong>JPG / PNG</strong>
                                    </div>
                                    <div class="detail-item">
                                        <span>Target Resolution</span>
                                        <strong>2400 x 1600</strong>
                                    </div>
                                    <div class="detail-item">
                                        <span>Listing Cover Priority</span>
                                        <strong>Exterior Hero Shot</strong>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="button">Save Draft</button>
                            </aside>
                        </div>
                    </div>
                </section>

                <section class="section" id="dashboard">
                    <div class="container">
                        <div class="section-head">
                            <div>
                                <span class="eyebrow">Admin Dashboard</span>
                                <h2 class="section-title">Operational clarity with a dark navy sidebar and bright content cards.</h2>
                            </div>
                            <p class="section-copy">
                                The dashboard uses a strong dark sidebar, white analytics cards, gold highlights, and a quiet slate active state to keep administrative navigation crisp and professional.
                            </p>
                        </div>
                        <div class="admin-shell">
                            <div class="dashboard-shell">
                                <aside class="sidebar">
                                    <h3>Operations</h3>
                                    <div class="menu-list">
                                        <div class="menu-item active">
                                            <span>Overview</span>
                                            <span class="dot"></span>
                                        </div>
                                        <div class="menu-item">
                                            <span>Listings</span>
                                            <span>32</span>
                                        </div>
                                        <div class="menu-item">
                                            <span>Uploads</span>
                                            <span>08</span>
                                        </div>
                                        <div class="menu-item">
                                            <span>Agents</span>
                                            <span>14</span>
                                        </div>
                                        <div class="menu-item">
                                            <span>Messages</span>
                                            <span>21</span>
                                        </div>
                                    </div>
                                </aside>
                                <div class="dashboard-main">
                                    <div class="dashboard-overview">
                                        <section class="dashboard-card">
                                            <span class="eyebrow">Performance</span>
                                            <div class="dashboard-stat" style="margin-top:1rem;">
                                                <span>Active Listings</span>
                                                <strong>148</strong>
                                            </div>
                                            <p class="muted">Gold-highlighted insights make key portfolio metrics easy to scan.</p>
                                        </section>
                                        <section class="dashboard-card">
                                            <span class="eyebrow">Inquiries</span>
                                            <div class="dashboard-stat" style="margin-top:1rem;">
                                                <span>New Leads</span>
                                                <strong class="highlight">36</strong>
                                            </div>
                                            <p class="muted">Designed for fast review of client activity and conversion momentum.</p>
                                        </section>
                                        <section class="dashboard-card">
                                            <span class="eyebrow">Closings</span>
                                            <div class="dashboard-stat" style="margin-top:1rem;">
                                                <span>Monthly Revenue</span>
                                                <strong>$2.4M</strong>
                                            </div>
                                            <p class="muted">Soft shadows and generous spacing keep enterprise data approachable.</p>
                                        </section>
                                    </div>
                                    <section class="dashboard-card">
                                        <div class="panel-head">
                                            <div>
                                                <h3>Recent Listings Pipeline</h3>
                                                <p class="muted">A clean overview card with readable spacing and strong contrast.</p>
                                            </div>
                                            <button class="btn btn-accent" type="button">Export</button>
                                        </div>
                                        <table class="dashboard-table">
                                            <thead>
                                                <tr>
                                                    <th>Property</th>
                                                    <th>Agent</th>
                                                    <th>Status</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Azure Bay Terrace</td>
                                                    <td>Isabel Cruz</td>
                                                    <td><span class="highlight">Featured</span></td>
                                                    <td>$920,000</td>
                                                </tr>
                                                <tr>
                                                    <td>Skyline Ridge Residence</td>
                                                    <td>Daniel Reyes</td>
                                                    <td>Scheduled</td>
                                                    <td>$780,000</td>
                                                </tr>
                                                <tr>
                                                    <td>Harbor Crest Penthouse</td>
                                                    <td>Monica Tan</td>
                                                    <td>Review</td>
                                                    <td>$1,150,000</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="login-section" id="login">
                    <div class="container login-shell">
                        <div class="login-copy">
                            <span class="eyebrow" style="background:rgba(255,255,255,0.16); color:#FFFFFF;">Admin Login Page</span>
                            <h2 class="section-title" style="margin-top:1rem;">Secure access with a premium corporate gradient.</h2>
                            <p class="section-copy" style="color:rgba(255,255,255,0.8); margin-top:1rem;">
                                The sign-in experience is centered, polished, and intentionally simple: crisp inputs, rounded white card, and a gold login button that stands out clearly against the navy gradient.
                            </p>
                        </div>
                        <section class="login-card">
                            <h3 style="margin:0; color:var(--navy);">Welcome Back</h3>
                            <p class="muted" style="margin-top:0.5rem;">Access listings, dashboards, uploads, and management tools.</p>
                            <form class="login-form">
                                <input type="email" value="agent@devestate.com" readonly>
                                <input type="password" value="password" readonly>
                                <div class="meta-row">
                                    <span>Remember this device</span>
                                    <span>Forgot password?</span>
                                </div>
                                <button class="btn btn-accent" type="button">Login</button>
                            </form>
                        </section>
                    </div>
                </section>

                <section class="section" id="mobile">
                    <div class="container mobile-layout">
                        <div>
                            <span class="eyebrow">Mobile Responsive Design</span>
                            <h2 class="section-title" style="margin-top:1rem;">A compact mobile experience with a navy bottom navigation.</h2>
                            <p class="section-copy" style="margin-top:1rem;">
                                The responsive pattern preserves the same premium palette across cards, actions, and navigation, while gold active states keep orientation obvious on smaller screens.
                            </p>
                        </div>
                        <aside class="phone-shell">
                            <div class="phone-top">
                                <strong style="color:var(--navy);">DevEstate Mobile</strong>
                                <span class="tag" style="margin:0;">Responsive Preview</span>
                            </div>
                            <div class="phone-screen">
                                <div class="phone-card">
                                    <img src="https://images.unsplash.com/photo-1600607687644-aac4c3eac7f4?auto=format&fit=crop&w=900&q=80" alt="Mobile property card">
                                    <div class="mobile-menu">
                                        <span class="tag">For Sale</span>
                                        <span class="tag">Smart Home</span>
                                    </div>
                                    <h4 style="margin:0.9rem 0 0.35rem; color:var(--navy);">City Crest Loft</h4>
                                    <p class="muted" style="margin:0 0 0.8rem;">Refined city living with concierge access and private lounge amenities.</p>
                                    <div class="price-row" style="margin-top:0;">
                                        <span class="price">$540,000</span>
                                        <button class="btn btn-primary" type="button">View</button>
                                    </div>
                                </div>
                                <div class="phone-bottom-nav">
                                    <div class="nav-icon active">
                                        <strong>H</strong>
                                        <span>Home</span>
                                    </div>
                                    <div class="nav-icon">
                                        <strong>S</strong>
                                        <span>Search</span>
                                    </div>
                                    <div class="nav-icon">
                                        <strong>M</strong>
                                        <span>Map</span>
                                    </div>
                                    <div class="nav-icon">
                                        <strong>P</strong>
                                        <span>Profile</span>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </section>
            </main>
            <footer class="footer">
                DevEstate interface concept focused on layout, styling, and visual components only.
            </footer>
        </div>
    </body>
</html>
