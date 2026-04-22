<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'DevEstate')</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <style>
            :root {
                --navy: #102A44;
                --navy-soft: #1F4A7A;
                --white: #FFFFFF;
                --gold: #D4A017;
                --gold-soft: #F2D689;
                --text-dark: #0F2339;
                --text-muted: #5B6B79;
                --bg: #F4F8FB;
                --bg-soft: #F8FAFD;
                --border: #D9E2EB;
                --radius: 32px;
                --shadow-soft: 0 18px 40px rgba(15, 23, 42, 0.08);
                --shadow-card: 0 16px 38px rgba(15, 23, 42, 0.1);
            }

            *, *::before, *::after { box-sizing: border-box; }
            html { scroll-behavior: smooth; }
            body {
                margin: 0;
                min-height: 100vh;
                font-family: Inter, system-ui, sans-serif;
                color: var(--text-dark);
                background: linear-gradient(180deg, #f8fbff 0%, #eef4f8 55%, #ffffff 100%);
            }
            a { color: inherit; text-decoration: none; }
            button, input, select { font: inherit; }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                min-height: 44px;
                padding: 0.72rem 1.25rem;
                border-radius: 999px;
                border: 1px solid transparent;
                font-size: 0.94rem;
                font-weight: 700;
                line-height: 1;
                white-space: nowrap;
                cursor: pointer;
                transition: transform 0.18s ease, background 0.2s ease, color 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
            }
            .btn:hover { transform: translateY(-1px); }
            .btn:focus-visible {
                outline: 2px solid rgba(212, 160, 23, 0.45);
                outline-offset: 2px;
            }
            .btn i {
                font-size: 1rem;
                line-height: 1;
            }

            .container {
                width: min(1600px, calc(100% - 2rem));
                margin: 0 auto;
                padding-inline: clamp(0.4rem, 1.4vw, 1.25rem);
            }
            .site-header {
                position: sticky;
                top: 0;
                z-index: 20;
                background: rgba(246, 250, 255, 0.96);
                border-bottom: 1px solid rgba(16, 42, 68, 0.12);
                backdrop-filter: blur(16px);
                color: var(--text-dark);
            }
            .nav-bar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
                min-height: 84px;
            }
            .brand {
                display: inline-flex;
                align-items: center;
                gap: 0.9rem;
                font-weight: 800;
                color: var(--text-dark);
            }
            .brand-mark {
                width: 62px;
                height: 62px;
                display: block;
            }
            .brand-logo {
                width: 100%;
                height: 100%;
                object-fit: contain;
                display: block;
                filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.18));
            }
            .brand-text {
                display: grid;
                gap: 0.15rem;
                line-height: 1.1;
            }
            .brand-title { font-size: 1rem; letter-spacing: 0.08em; }
            .brand-subtitle { font-size: 0.82rem; color: var(--text-muted); }

            .nav-links {
                display: flex;
                align-items: center;
                gap: 1.1rem;
                flex-wrap: wrap;
            }
            .nav-links a {
                color: rgba(16, 42, 68, 0.78);
                font-size: 0.95rem;
                font-weight: 600;
                transition: color 0.2s ease;
            }
            .nav-links a:hover,
            .nav-links a.active { color: var(--navy); }
            .nav-actions {
                display: flex;
                gap: 0.6rem;
                align-items: center;
                flex-wrap: wrap;
                justify-content: flex-end;
            }
            .nav-actions .btn {
                min-height: 42px;
                padding: 0 1rem;
                font-size: 0.92rem;
            }
            .btn-primary {
                background: var(--gold);
                color: var(--navy);
                border-color: var(--gold);
                box-shadow: 0 14px 26px rgba(212, 160, 23, 0.18);
            }
            .btn-primary:hover { background: #C19313; color: var(--navy); }
            .btn-secondary {
                color: #FFFFFF;
                border: 1px solid rgba(255, 255, 255, 0.18);
                background: transparent;
            }
            .site-header .btn-secondary {
                color: var(--navy);
                border-color: rgba(16, 42, 68, 0.25);
                background: rgba(255, 255, 255, 0.78);
            }
            .site-header .btn-secondary:hover {
                background: rgba(239, 245, 252, 0.95);
            }
            .btn-danger {
                background: #E53E3E;
                color: #FFFFFF;
                border: 1px solid #E53E3E;
                box-shadow: 0 14px 26px rgba(229, 62, 62, 0.18);
            }
            .btn-danger:hover { background: #C53030; }

            .page-shell { padding: 1.5rem 0 2.75rem; }
            .section-title {
                margin: 0 0 1.5rem;
                font-size: 1.5rem;
                font-weight: 700;
                color: var(--navy);
            }
            .section-description {
                color: var(--text-muted);
                margin: 0 0 2rem;
                line-height: 1.7;
                font-size: 1.05rem;
            }

            /* Hero sections for individual pages */
            .hero {
                text-align: center;
                margin-bottom: 2rem;
                padding: 2rem 0;
            }
            .hero .eyebrow {
                display: inline-block;
                padding: 0.5rem 1rem;
                border-radius: 999px;
                background: rgba(244, 194, 70, 0.15);
                color: var(--gold);
                font-size: 0.8rem;
                font-weight: 700;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                margin-bottom: 1rem;
            }
            .hero h1 {
                font-size: 2.5rem;
                font-weight: 800;
                color: var(--navy);
                margin: 0 0 1rem;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
            }
            .hero p {
                color: var(--text-muted);
                font-size: 1.1rem;
                line-height: 1.6;
                margin: 0 0 2rem;
                max-width: 500px;
                margin-left: auto;
                margin-right: auto;
            }
            .hero-actions {
                display: flex;
                justify-content: center;
                gap: 1rem;
                flex-wrap: wrap;
            }
            .btn-outline {
                color: var(--navy);
                border: 2px solid var(--gold);
                background: transparent;
                padding: 0.75rem 1.5rem;
                border-radius: 999px;
                font-size: 0.95rem;
                font-weight: 700;
                transition: all 0.2s ease;
            }
            .btn-outline:hover {
                background: var(--gold);
                color: var(--navy);
            }

            /* Property grid and cards */
            .property-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 1.5rem;
                margin-top: 1.5rem;
            }
            .property-card {
                background: white;
                border: 1px solid rgba(217, 226, 236, 0.6);
                border-radius: 24px;
                overflow: hidden;
                box-shadow: 0 8px 16px rgba(15, 23, 42, 0.04);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }
            .property-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 12px 24px rgba(15, 23, 42, 0.08);
            }
            .property-media {
                position: relative;
                height: 220px;
                overflow: hidden;
            }
            .property-media img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }
            .property-card:hover .property-media img {
                transform: scale(1.05);
            }
            .property-chip {
                position: absolute;
                top: 1rem;
                left: 1rem;
                padding: 0.5rem 1rem;
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.95);
                color: var(--navy);
                font-size: 0.8rem;
                font-weight: 700;
            }
            .property-body {
                padding: 1.5rem;
            }
            .property-meta {
                display: flex;
                gap: 0.75rem;
                margin-bottom: 1rem;
            }
            .property-meta span {
                padding: 0.4rem 0.8rem;
                border-radius: 999px;
                background: #F1F5F9;
                color: var(--text-muted);
                font-size: 0.8rem;
                font-weight: 600;
            }
            .property-body h3 {
                margin: 0 0 0.75rem;
                color: var(--navy);
                font-size: 1.2rem;
                font-weight: 700;
            }
            .property-body p {
                margin: 0 0 1.25rem;
                color: var(--text-muted);
                font-size: 0.95rem;
                line-height: 1.6;
            }
            .price-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .price {
                color: var(--gold);
                font-size: 1.4rem;
                font-weight: 800;
            }

            /* Detail page styles */
            .detail-card {
                max-width: 800px;
                margin: 0 auto;
            }
            .detail-visual {
                margin-bottom: 1.5rem;
                border-radius: 24px;
                overflow: hidden;
                height: 360px;
                box-shadow: 0 18px 32px rgba(15, 23, 42, 0.1);
            }
            .detail-visual img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }
            .detail-card .eyebrow {
                display: inline-block;
                padding: 0.5rem 1rem;
                border-radius: 999px;
                background: rgba(244, 194, 70, 0.15);
                color: var(--gold);
                font-size: 0.8rem;
                font-weight: 700;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                margin-bottom: 1rem;
            }
            .detail-card h3 {
                font-size: 2rem;
                font-weight: 800;
                color: var(--navy);
                margin: 0 0 1rem;
            }
            .detail-meta {
                display: flex;
                flex-wrap: wrap;
                gap: 0.75rem;
                margin-bottom: 1.5rem;
            }
            .detail-meta span {
                padding: 0.5rem 1rem;
                border-radius: 999px;
                background: #F1F5F9;
                color: var(--text-muted);
                font-size: 0.85rem;
                font-weight: 600;
            }
            .detail-description {
                color: var(--text-dark);
                font-size: 1.05rem;
                line-height: 1.7;
                margin: 0 0 2rem;
            }
            .detail-list {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1.5rem;
                margin-bottom: 2rem;
            }
            .detail-item {
                padding: 1.25rem;
                border-radius: 16px;
                background: #F8FAFC;
                border: 1px solid rgba(217, 226, 236, 0.5);
            }
            .detail-item span {
                display: block;
                color: var(--text-muted);
                font-size: 0.9rem;
                font-weight: 600;
                margin-bottom: 0.5rem;
            }
            .detail-item strong {
                display: block;
                color: var(--navy);
                font-size: 1.1rem;
                font-weight: 700;
            }
            .inline-actions {
                display: flex;
                justify-content: center;
                gap: 1rem;
                flex-wrap: wrap;
            }

            /* Alert styles */
            .alert {
                padding: 1rem 1.25rem;
                border-radius: 12px;
                background: #FEE2E2;
                border: 1px solid #FECACA;
                color: #991B1B;
                font-size: 0.95rem;
                font-weight: 600;
            }
            .page-card {
                background: white;
                border: 1px solid var(--border);
                border-radius: 24px;
                padding: 2rem;
                box-shadow: var(--shadow-card);
            }
            .page-section {
                display: grid;
                gap: 3rem;
            }
            .feature-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 1.5rem;
                margin-top: 1rem;
            }
            .feature-card {
                padding: 2rem;
                border-radius: 24px;
                border: 1px solid rgba(217, 226, 236, 0.6);
                background: white;
                box-shadow: 0 6px 12px rgba(15, 23, 42, 0.03);
                text-align: center;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }
            .feature-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(15, 23, 42, 0.08);
            }
            .feature-card-icon {
                font-size: 2.5rem;
                margin-bottom: 1rem;
            }
            .feature-card h3 {
                margin: 0 0 0.75rem;
                font-size: 1.15rem;
                color: var(--navy);
                font-weight: 700;
            }
            .feature-card p {
                margin: 0;
                color: var(--text-muted);
                font-size: 0.95rem;
                line-height: 1.6;
            }
            .logout-form { display: inline; }
            .hero-card {
                display: grid;
                grid-template-columns: minmax(320px, 1.3fr) minmax(280px, 1fr);
                gap: 1.5rem;
                padding: 2rem;
                border-radius: 36px;
                background: linear-gradient(180deg, rgba(17, 40, 69, 0.95) 0%, rgba(12, 31, 56, 0.92) 100%);
                color: #F8FAFC;
                box-shadow: var(--shadow-card);
                overflow: hidden;
                position: relative;
            }
            .hero-card::before {
                content: "";
                position: absolute;
                inset: 0;
                background: radial-gradient(circle at top left, rgba(255,255,255,0.18), transparent 28%),
                            radial-gradient(circle at bottom right, rgba(255,255,255,0.1), transparent 22%);
                pointer-events: none;
            }
            .hero-content,
            .hero-panel { position: relative; z-index: 1; }
            .hero-eyebrow { display: inline-flex; padding: 0.55rem 1rem; border-radius: 999px; background: rgba(244, 194, 70, 0.18); color: #F8F6E8; font-size: 0.78rem; letter-spacing: 0.14em; text-transform: uppercase; font-weight: 700; }
            .hero-title { margin: 1.1rem 0 1rem; font-size: clamp(3rem, 4.7vw, 4.6rem); line-height: 0.95; max-width: 680px; }
            .hero-copy { margin: 0 0 1.5rem; max-width: 680px; color: rgba(248, 250, 252, 0.9); line-height: 1.8; font-size: 1.03rem; }
            .hero-links { display: flex; flex-wrap: wrap; gap: 0.95rem; }
            .hero-links .btn { min-width: 160px; }
            .hero-card-large { padding: 3rem; }
            .hero-title-large { max-width: 720px; margin: 1.5rem 0 1rem; }
            .hero-card-login { margin-top: 1rem; padding: 2.5rem; background: linear-gradient(180deg, rgba(17, 40, 69, 0.98) 0%, rgba(12, 31, 56, 0.96) 100%); }
            .hero-title-login { max-width: 560px; }
            .hero-copy-login { max-width: 620px; color: rgba(248, 250, 252, 0.88); }
            .hero-panel-login { display: grid; gap: 1rem; }
            .hero-stats {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 1rem;
                margin-top: 1.8rem;
            }
            .stat-card {
                padding: 1.3rem 1.35rem;
                border-radius: 24px;
                background: rgba(255, 255, 255, 0.08);
                border: 1px solid rgba(255, 255, 255, 0.08);
                box-shadow: inset 0 0 0 1px rgba(255,255,255,0.02);
            }
            .stat-card small { display: block; color: rgba(248, 250, 252, 0.72); text-transform: uppercase; letter-spacing: 0.16em; font-weight: 700; margin-bottom: 0.65rem; }
            .stat-card strong { display: block; margin-top: 0.55rem; font-size: 1.4rem; color: #FFFFFF; }
            .stat-card p { margin: 0.6rem 0 0; color: rgba(248, 250, 252, 0.82); font-size: 0.92rem; }

            .search-panel {
                display: grid;
                gap: 1rem;
                padding: 1.75rem;
                border-radius: 28px;
                background: rgba(255, 255, 255, 0.95);
                color: var(--text-dark);
                box-shadow: 0 18px 30px rgba(15, 23, 42, 0.08);
            }
            .search-panel h2 { margin: 0 0 0.75rem; font-size: 1.35rem; color: var(--navy); }
            .search-panel p { margin: 0 0 1.25rem; color: var(--text-muted); line-height: 1.7; }
            .search-panel-login { padding: 2.2rem; }
            .login-title { margin: 0 0 0.5rem; font-size: 1.5rem; color: var(--navy); }
            .login-subtitle { color: var(--text-muted); margin: 0 0 1.8rem; line-height: 1.6; }
            .field-grid {
                display: grid;
                gap: 0.9rem;
            }
            .field-grid input,
            .field-grid select {
                width: 100%;
                min-height: 48px;
                border-radius: 18px;
                border: 1px solid var(--border);
                padding: 0.95rem 1rem;
                background: #FFFFFF;
                color: var(--text-dark);
            }
            .field-grid select { appearance: none; }
            .tag-row {
                display: flex;
                flex-wrap: wrap;
                gap: 0.65rem;
                margin-top: 0.25rem;
            }
            .tag-pill {
                display: inline-flex;
                align-items: center;
                padding: 0.65rem 0.95rem;
                border-radius: 999px;
                background: #F6E3A2;
                color: #846609;
                font-weight: 700;
                font-size: 0.85rem;
            }
            .search-panel .btn-primary {
                width: 100%;
                box-shadow: 0 16px 30px rgba(15, 23, 42, 0.12);
            }

            .info-panel {
                display: grid;
                gap: 1rem;
                padding: 1.75rem;
                border-radius: 28px;
                background: #FFFFFF;
                box-shadow: 0 18px 30px rgba(15, 23, 42, 0.08);
            }
            .info-eyebrow { margin: 0; display: inline-flex; padding: 0.55rem 1rem; border-radius: 999px; background: #F8F1D5; color: #8B6B1B; text-transform: uppercase; letter-spacing: 0.14em; font-size: 0.78rem; font-weight: 700; }
            .info-panel h3 { margin: 0.8rem 0 0.65rem; color: var(--navy); font-size: 1.25rem; }
            .info-panel p { margin: 0; color: var(--text-muted); line-height: 1.75; }
            .info-note { margin: 0; color: var(--text-muted); }
            .info-footer { display: flex; flex-wrap: wrap; gap: 1rem; align-items: center; justify-content: space-between; margin-top: 1rem; }
            .info-footer div { color: var(--text-muted); }

            .page-card {
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: 28px;
                box-shadow: var(--shadow-soft);
                padding: 2rem;
                margin-top: 1.5rem;
            }
            .section-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1rem; margin-top: 1rem; }
            .feature-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 1.25rem;
            }
            .quick-card {
                padding: 1.55rem;
                border-radius: 20px;
                border: 1px solid rgba(217, 226, 236, 0.78);
                background: #FFFFFF;
                box-shadow: 0 10px 18px rgba(15, 23, 42, 0.05);
                transition: transform 0.18s ease, box-shadow 0.22s ease;
            }
            .quick-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 16px 24px rgba(15, 23, 42, 0.09);
            }
            .icon-tile {
                width: 48px;
                height: 48px;
                border-radius: 14px;
                display: grid;
                place-items: center;
                background: #F8F1D5;
                color: #8B6B1B;
                font-size: 0.83rem;
                font-weight: 800;
                letter-spacing: 0.08em;
                margin-bottom: 1rem;
            }
            .quick-card h3 {
                margin: 0 0 0.55rem;
                color: var(--navy);
                font-size: 1.05rem;
            }
            .quick-card p {
                margin: 0;
                color: var(--text-muted);
                line-height: 1.6;
                font-size: 0.93rem;
            }
            .metric-card {
                padding: 1.35rem 1.4rem;
                border-radius: 20px;
                border: 1px solid rgba(217, 226, 236, 0.78);
                background: #FFFFFF;
                box-shadow: 0 10px 18px rgba(15, 23, 42, 0.05);
            }
            .metric-card small {
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: 0.12em;
                font-weight: 700;
                font-size: 0.72rem;
            }
            .metric-card strong {
                display: block;
                margin-top: 0.6rem;
                color: var(--navy);
                font-size: 1.45rem;
            }
            .metric-card p {
                margin: 0.45rem 0 0;
                color: var(--text-muted);
                font-size: 0.92rem;
            }
            .dashboard-hero-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1.5rem;
                align-items: stretch;
            }
            .dashboard-hero-grid .hero-content {
                display: flex;
                justify-content: center;
            }
            .dashboard-topbar {
                display: flex;
                justify-content: space-between;
                align-items: flex-end;
                gap: 1rem;
                margin-bottom: 1rem;
            }
            .dashboard-eyebrow {
                margin: 0;
                color: var(--navy-soft);
                text-transform: uppercase;
                letter-spacing: 0.14em;
                font-size: 0.75rem;
                font-weight: 700;
            }
            .dashboard-heading {
                margin: 0.55rem 0 0.5rem;
                color: var(--navy);
                font-size: clamp(1.7rem, 2.5vw, 2.1rem);
                line-height: 1.2;
            }
            .dashboard-subheading {
                margin: 0;
                color: var(--text-muted);
                line-height: 1.65;
                max-width: 58ch;
            }
            .dashboard-top-actions {
                display: flex;
                gap: 0.75rem;
                flex-wrap: wrap;
            }
            .dashboard-shell {
                display: grid;
                gap: 1rem;
            }
            .dashboard-shell-wide {
                width: 100%;
            }
            .dashboard-banner {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1.5rem;
                padding: 1.35rem 1.5rem;
                border-radius: 28px;
                background: linear-gradient(135deg, rgba(16, 42, 68, 0.99) 0%, rgba(31, 74, 122, 0.95) 68%, rgba(212, 160, 23, 0.18) 100%);
                color: #FFFFFF;
                box-shadow: var(--shadow-card);
            }
            .dashboard-banner-copy {
                max-width: 820px;
            }
            .dashboard-banner .dashboard-eyebrow {
                color: rgba(242, 214, 137, 0.92);
            }
            .dashboard-banner .dashboard-heading {
                color: #FFFFFF;
                margin: 0.3rem 0 0.4rem;
                font-size: clamp(1.9rem, 2.5vw, 2.5rem);
            }
            .dashboard-banner .dashboard-subheading {
                color: rgba(248, 250, 252, 0.84);
                max-width: 68ch;
            }
            .dashboard-banner-actions {
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                gap: 0.7rem;
            }
            .dashboard-banner-actions .btn {
                min-width: 228px;
            }
            .dashboard-banner-meta {
                display: flex;
                gap: 0.6rem;
                flex-wrap: wrap;
                margin-top: 0.9rem;
            }
            .dashboard-pill {
                display: inline-flex;
                align-items: center;
                gap: 0.45rem;
                min-height: 34px;
                padding: 0.45rem 0.8rem;
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.12);
                border: 1px solid rgba(255, 255, 255, 0.08);
                color: #F8FAFC;
                font-size: 0.82rem;
                font-weight: 700;
            }
            .dashboard-pill-soft {
                background: #F8F1D5;
                color: #8B6B1B;
                border-color: rgba(212, 160, 23, 0.2);
            }
            .dashboard-three-column {
                display: grid;
                grid-template-columns: minmax(0, 1.25fr) minmax(0, 1.25fr) minmax(300px, 0.95fr);
                gap: 1rem;
                align-items: start;
            }
            .dashboard-primary-column {
                grid-column: span 2;
                display: grid;
                gap: 1rem;
            }
            .dashboard-sidebar {
                display: grid;
            }
            .dashboard-sidebar-stack {
                display: grid;
                gap: 1rem;
            }
            .dashboard-sticky-panel {
                position: sticky;
                top: 100px;
            }
            .dashboard-panel {
                background: #FFFFFF;
                border: 1px solid rgba(217, 226, 236, 0.82);
                border-radius: 24px;
                padding: 1.25rem;
                box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
            }
            .dashboard-gradient-panel {
                background: linear-gradient(180deg, #FFFFFF 0%, #F8FBFD 100%);
            }
            .dashboard-panel-heading {
                display: flex;
                justify-content: space-between;
                align-items: flex-end;
                gap: 0.9rem;
                margin-bottom: 0.9rem;
            }
            .dashboard-panel-heading h2 {
                margin: 0;
                color: var(--navy);
                font-size: 1.18rem;
            }
            .dashboard-panel-heading p {
                margin: 0.28rem 0 0;
                color: var(--text-muted);
                line-height: 1.55;
                font-size: 0.92rem;
            }
            .dashboard-stats-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 0.95rem;
            }
            .dashboard-stat-link {
                display: block;
            }
            .dashboard-stat-card {
                height: 100%;
                padding: 1.1rem 1.15rem;
                border-radius: 20px;
                border: 1px solid rgba(217, 226, 236, 0.8);
                background: linear-gradient(180deg, #FFFFFF 0%, #F9FBFD 100%);
                box-shadow: 0 10px 18px rgba(15, 23, 42, 0.05);
                transition: transform 0.18s ease, box-shadow 0.22s ease, border-color 0.22s ease;
                position: relative;
                overflow: hidden;
            }
            .dashboard-stat-card::before {
                content: "";
                position: absolute;
                inset: 0 auto 0 0;
                width: 5px;
                border-radius: 20px 0 0 20px;
                background: var(--card-accent, var(--gold));
            }
            .dashboard-stat-link:hover .dashboard-stat-card,
            .dashboard-stat-link:focus-visible .dashboard-stat-card {
                transform: translateY(-4px);
                box-shadow: 0 18px 28px rgba(15, 23, 42, 0.1);
                border-color: rgba(16, 42, 68, 0.14);
            }
            .dashboard-stat-head {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 0.8rem;
                margin-bottom: 0.8rem;
            }
            .dashboard-stat-head > i {
                color: var(--card-accent, var(--gold));
                font-size: 1rem;
            }
            .stat-icon {
                width: 42px;
                height: 42px;
                border-radius: 14px;
                display: grid;
                place-items: center;
                background: rgba(16, 42, 68, 0.08);
                color: var(--card-accent, var(--gold));
                font-size: 1.1rem;
            }
            .dashboard-stat-card small {
                display: block;
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: 0.1em;
                font-size: 0.72rem;
                font-weight: 800;
            }
            .dashboard-stat-card strong {
                display: block;
                margin-top: 0.55rem;
                color: var(--navy);
                font-size: clamp(1.4rem, 1.9vw, 1.85rem);
                line-height: 1.12;
            }
            .dashboard-stat-card p {
                margin: 0.5rem 0 0;
                color: var(--text-muted);
                font-size: 0.9rem;
                line-height: 1.5;
            }
            .quick-actions-panel {
                display: grid;
                gap: 0.95rem;
            }
            .action-stack {
                display: grid;
                gap: 0.85rem;
            }
            .action-panel {
                padding: 1.05rem;
                border-radius: 20px;
                border: 1px solid rgba(217, 226, 236, 0.8);
                background: linear-gradient(180deg, #FFFFFF 0%, #F8FAFC 100%);
                box-shadow: 0 10px 18px rgba(15, 23, 42, 0.05);
                transition: transform 0.18s ease, box-shadow 0.22s ease, border-color 0.22s ease;
            }
            .action-panel:hover {
                transform: translateY(-4px);
                box-shadow: 0 18px 28px rgba(15, 23, 42, 0.1);
                border-color: rgba(16, 42, 68, 0.14);
            }
            .action-panel-primary {
                background: linear-gradient(135deg, rgba(212, 160, 23, 0.18) 0%, rgba(255, 255, 255, 1) 72%);
                border-color: rgba(212, 160, 23, 0.3);
            }
            .action-panel-header {
                display: flex;
                align-items: flex-start;
                gap: 0.85rem;
                margin-bottom: 0.9rem;
            }
            .action-panel-icon {
                width: 44px;
                height: 44px;
                border-radius: 14px;
                display: grid;
                place-items: center;
                background: #F8F1D5;
                color: #8B6B1B;
                font-size: 1.1rem;
                flex-shrink: 0;
            }
            .action-panel h3 {
                margin: 0 0 0.25rem;
                color: var(--navy);
                font-size: 1.03rem;
            }
            .action-panel p {
                margin: 0;
                color: var(--text-muted);
                font-size: 0.9rem;
                line-height: 1.55;
            }
            .action-panel .btn {
                width: 100%;
                justify-content: center;
            }
            .activity-list {
                display: grid;
                gap: 0.75rem;
            }
            .activity-item,
            .widget-item {
                display: flex;
                align-items: flex-start;
                gap: 0.85rem;
                padding: 0.95rem;
                border-radius: 18px;
                border: 1px solid rgba(217, 226, 236, 0.74);
                background: #FBFDFF;
                transition: transform 0.18s ease, box-shadow 0.22s ease, border-color 0.22s ease;
            }
            .activity-item:hover,
            .widget-item:hover {
                transform: translateY(-3px);
                box-shadow: 0 14px 22px rgba(15, 23, 42, 0.07);
                border-color: rgba(16, 42, 68, 0.14);
            }
            .activity-icon,
            .widget-icon,
            .task-check {
                width: 40px;
                height: 40px;
                border-radius: 12px;
                display: grid;
                place-items: center;
                background: rgba(16, 42, 68, 0.08);
                color: var(--navy-soft);
                font-size: 1rem;
                flex-shrink: 0;
            }
            .activity-copy strong,
            .widget-copy strong,
            .task-copy strong {
                display: block;
                color: var(--navy);
                font-size: 0.96rem;
                margin-bottom: 0.18rem;
            }
            .activity-copy p,
            .widget-copy p,
            .task-copy p {
                margin: 0;
                color: var(--text-muted);
                line-height: 1.5;
                font-size: 0.9rem;
            }
            .activity-time,
            .widget-copy span {
                display: inline-block;
                margin-top: 0.4rem;
                color: var(--navy-soft);
                font-size: 0.81rem;
                font-weight: 700;
            }
            .widget-list,
            .task-list {
                display: grid;
                gap: 0.75rem;
            }
            .task-item {
                display: flex;
                align-items: flex-start;
                gap: 0.85rem;
                padding: 0.9rem;
                border-radius: 18px;
                border: 1px solid rgba(217, 226, 236, 0.74);
                background: #FBFDFF;
            }
            .task-item.is-complete {
                background: linear-gradient(180deg, #F7FBF8 0%, #FFFFFF 100%);
            }
            .task-item.is-complete .task-check {
                background: rgba(34, 197, 94, 0.12);
                color: #15803D;
            }
            .analytics-summary {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
                margin-bottom: 0.9rem;
            }
            .analytics-summary strong {
                color: var(--navy);
                font-size: 1.65rem;
                line-height: 1;
            }
            .analytics-summary p {
                margin: 0.28rem 0 0;
                color: var(--text-muted);
                font-size: 0.9rem;
            }
            .chart-bars {
                height: 260px;
                display: grid;
                grid-template-columns: repeat(6, minmax(0, 1fr));
                gap: 0.75rem;
                align-items: end;
            }
            .chart-bars-wide {
                width: 100%;
            }
            .chart-bar-group {
                display: grid;
                justify-items: center;
                gap: 0.5rem;
            }
            .chart-value {
                color: var(--navy);
                font-size: 0.82rem;
                font-weight: 800;
            }
            .chart-bar {
                width: 100%;
                max-width: none;
                height: 185px;
                display: flex;
                align-items: flex-end;
                padding: 0.35rem;
                border-radius: 18px;
                background: linear-gradient(180deg, rgba(16, 42, 68, 0.08) 0%, rgba(212, 160, 23, 0.16) 100%);
                border: 1px solid rgba(217, 226, 236, 0.72);
            }
            .chart-fill {
                display: block;
                width: 100%;
                min-height: 12px;
                border-radius: 14px;
                background: linear-gradient(180deg, #F2D689 0%, #D4A017 100%);
                box-shadow: 0 10px 16px rgba(212, 160, 23, 0.2);
            }
            .chart-label {
                color: var(--text-muted);
                font-size: 0.82rem;
                font-weight: 700;
            }
            .empty-state {
                padding: 1rem;
                border-radius: 18px;
                border: 1px dashed rgba(16, 42, 68, 0.18);
                background: #FBFDFF;
                color: var(--text-muted);
                text-align: left;
            }
            .empty-state strong {
                display: block;
                color: var(--navy);
                margin-bottom: 0.35rem;
            }
            .top-listing-card {
                display: grid;
                gap: 1rem;
            }
            .top-listing-copy h3 {
                margin: 0.7rem 0 0.4rem;
                color: var(--navy);
                font-size: 1.18rem;
            }
            .top-listing-copy p {
                margin: 0;
                color: var(--text-muted);
                line-height: 1.55;
                font-size: 0.9rem;
            }
            .mini-stats-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 0.7rem;
            }
            .mini-stat {
                padding: 0.85rem 0.9rem;
                border-radius: 16px;
                border: 1px solid rgba(217, 226, 236, 0.78);
                background: rgba(255, 255, 255, 0.88);
            }
            .mini-stat small {
                color: var(--text-muted);
                font-size: 0.72rem;
                text-transform: uppercase;
                letter-spacing: 0.08em;
                font-weight: 800;
            }
            .mini-stat strong {
                display: block;
                margin-top: 0.45rem;
                color: var(--navy);
                font-size: 1.25rem;
            }
            .recent-listings-grid {
                margin-top: 0;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 1rem;
            }
            .dashboard-card-link {
                display: block;
            }
            .dashboard-card-link:hover .property-card {
                transform: translateY(-4px);
                box-shadow: 0 18px 28px rgba(15, 23, 42, 0.1);
            }
            .dashboard-metrics {
                display: grid;
                grid-template-columns: repeat(4, 240px);
                gap: 1.1rem;
                margin-top: 0;
                grid-auto-rows: 1fr;
                width: fit-content;
                max-width: 100%;
                margin-left: auto;
                margin-right: auto;
                justify-content: center;
            }
            .dashboard-metrics .metric-card {
                min-height: 168px;
                background: rgba(255, 255, 255, 0.96);
                display: flex;
                flex-direction: column;
                padding: 1.5rem 1.35rem;
            }
            .dashboard-metrics .metric-card small {
                letter-spacing: 0.08em;
                line-height: 1.4;
            }
            .dashboard-metrics .metric-card strong {
                font-size: 1.95rem;
                line-height: 1.15;
                white-space: nowrap;
            }
            .dashboard-metrics .metric-card p {
                margin-top: 0.65rem;
                line-height: 1.5;
                max-width: 28ch;
            }
            .quick-link-card {
                display: block;
            }
            .quick-link-card .quick-card {
                height: 100%;
            }
            .quick-card-copy {
                margin-bottom: 1.1rem;
            }
            .quick-card-action {
                display: inline-flex;
                align-items: center;
                gap: 0.45rem;
                color: var(--navy-soft);
                font-size: 0.9rem;
                font-weight: 700;
            }
            .property-summary {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            .cta-panel {
                background: linear-gradient(135deg, var(--navy) 0%, var(--navy-soft) 100%);
                border-radius: 32px;
                padding: 2.3rem;
                color: #FFFFFF;
                text-align: center;
            }
            .cta-panel h2 {
                margin: 0 0 1rem;
                font-size: clamp(1.5rem, 2.8vw, 2rem);
            }
            .cta-panel p {
                margin: 0 auto 1.6rem;
                max-width: 640px;
                color: rgba(248, 250, 252, 0.9);
                line-height: 1.7;
            }
            .cta-actions {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 0.9rem;
            }

            .hero-small-card {
                background: rgba(255,255,255,0.95);
                padding: 1.4rem 1.25rem;
                border-radius: 24px;
                border: 1px solid rgba(217, 226, 236, 0.8);
                color: var(--navy);
            }
            .hero-small-card small { display: block; color: var(--gold); text-transform: uppercase; letter-spacing: 0.16em; font-weight: 700; margin-bottom: 0.75rem; }
            .hero-small-card strong { font-size: 1.85rem; color: var(--text-dark); display: block; margin-top: 0.65rem; }
            .hero-small-card p { margin: 0.9rem 0 0; color: var(--text-muted); line-height: 1.7; }

            .login-panel {
                display: grid;
                gap: 1rem;
            }
            .login-form { display: grid; gap: 0.75rem; }
            .form-group { margin-bottom: 1rem; }
            .form-label { display: block; color: var(--navy); font-weight: 700; margin-bottom: 0.6rem; font-size: 0.95rem; }
            .form-input { width: 100%; min-height: 48px; padding: 0.95rem 1rem; border-radius: 12px; border: 1px solid rgba(217, 226, 236, 0.8); background: #FFFFFF; color: var(--text-dark); font-size: 0.95rem; }
            textarea.form-input { min-height: 140px; resize: vertical; }
            .form-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1rem; }
            .form-actions { display: flex; flex-wrap: wrap; gap: 0.9rem; margin-top: 0.5rem; }
            .btn-login { width: 100%; min-height: 52px; font-size: 1rem; margin-bottom: 1rem; }
            .form-note { margin: 0; color: var(--text-muted); font-size: 0.9rem; text-align: center; }
            .reservation-overlay {
                position: fixed;
                inset: 0;
                background: rgba(15, 23, 42, 0.48);
                display: none;
                align-items: center;
                justify-content: center;
                z-index: 80;
                padding: 1rem;
            }
            .reservation-overlay.is-open {
                display: flex;
            }
            .reservation-panel {
                width: min(520px, 100%);
                background: #FFFFFF;
                border-radius: 20px;
                border: 1px solid rgba(217, 226, 236, 0.9);
                box-shadow: 0 26px 60px rgba(15, 23, 42, 0.22);
                padding: 1.4rem;
            }
            .reservation-panel-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 0.75rem;
                margin-bottom: 0.65rem;
            }
            .reservation-panel-header h2 {
                margin: 0;
                font-size: 1.25rem;
                color: var(--navy);
            }
            .reservation-close {
                width: 34px;
                height: 34px;
                border-radius: 999px;
                border: 1px solid var(--border);
                background: #FFFFFF;
                color: var(--navy);
                font-size: 1.25rem;
                line-height: 1;
                cursor: pointer;
            }
            .reservation-panel-copy {
                margin: 0 0 1rem;
                color: var(--text-muted);
                line-height: 1.6;
            }
            .reservation-form {
                display: grid;
                gap: 0.5rem;
            }
            .reservation-form .form-actions {
                margin-top: 0.85rem;
            }
            .reservation-cancel {
                color: var(--navy);
                border-color: rgba(16, 42, 68, 0.24);
                background: #FFFFFF;
            }
            .reservation-error {
                margin: 0.1rem 0 0.5rem;
                color: #B91C1C;
                font-size: 0.85rem;
                font-weight: 600;
            }
            .reservation-status-pill {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-height: 40px;
                padding: 0.5rem 0.9rem;
                border-radius: 999px;
                font-size: 0.82rem;
                font-weight: 800;
                letter-spacing: 0.06em;
                margin-bottom: 0.9rem;
                width: fit-content;
            }
            .reservation-status-new {
                background: #F3E8BE;
                color: #8B6B1B;
            }
            .reservation-status-accepted {
                background: #DCFCE7;
                color: #166534;
            }

            @media (max-width: 980px) {
                .hero-card { grid-template-columns: 1fr; }
                .hero-stats { grid-template-columns: 1fr; }
                .section-grid { grid-template-columns: 1fr; }
                .form-grid { grid-template-columns: 1fr; }
                .container {
                    width: min(100%, calc(100% - 1rem));
                    padding-inline: 0.35rem;
                }
                .dashboard-three-column {
                    grid-template-columns: 1fr;
                }
                .dashboard-primary-column {
                    grid-column: auto;
                }
                .dashboard-banner {
                    flex-direction: column;
                    align-items: flex-start;
                }
                .dashboard-banner-actions {
                    width: 100%;
                    align-items: stretch;
                }
                .dashboard-stats-grid,
                .dashboard-hero-grid,
                .dashboard-metrics {
                    grid-template-columns: repeat(2, minmax(240px, 1fr));
                    width: 100%;
                }
                .dashboard-sticky-panel {
                    position: static;
                }
                .mini-stats-grid,
                .recent-listings-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
                .dashboard-topbar {
                    flex-direction: column;
                    align-items: flex-start;
                    margin-bottom: 0.75rem;
                }
                .nav-actions {
                    justify-content: flex-start;
                }
            }
            @media (max-width: 780px) {
                .page-shell { padding: 1.5rem 0 2.5rem; }
                .nav-bar { flex-direction: column; align-items: stretch; }
                .nav-actions { width: 100%; justify-content: space-between; }
                .nav-links { width: 100%; justify-content: flex-start; }
                .hero-title { font-size: clamp(2.4rem, 8vw, 3.4rem); }
                .cta-panel { padding: 1.7rem; }
                .detail-visual { height: 240px; }
                .dashboard-metrics { grid-template-columns: 1fr; }
                .hero-card-large { padding: 2rem 1.25rem; }
                .dashboard-panel,
                .dashboard-banner {
                    padding: 1rem;
                }
                .dashboard-stats-grid,
                .mini-stats-grid,
                .recent-listings-grid {
                    grid-template-columns: 1fr;
                }
                .chart-bars {
                    height: auto;
                    grid-template-columns: 1fr;
                }
                .chart-bar-group {
                    grid-template-columns: 48px 1fr 44px;
                    align-items: center;
                    gap: 0.75rem;
                }
                .chart-value {
                    order: 3;
                }
                .chart-bar {
                    max-width: none;
                    width: 100%;
                    height: 18px;
                    align-items: stretch;
                }
                .chart-fill {
                    height: 100% !important;
                    width: var(--bar-width, 0%);
                }
            }
        </style>
    </head>
    <body>
        <div class="page-shell">
            <header class="site-header">
                <div class="container nav-bar">
                    <a href="{{ session('logged_in') ? route('properties') : route('home') }}" class="brand">
                        <span class="brand-mark">
                            <img src="{{ asset('images/CompanyLOGO.png') }}" alt="JE Enterprises Logo" class="brand-logo">
                        </span>
                        <span class="brand-text">
                            <span class="brand-title">DevEstate</span>
                            <span class="brand-subtitle">Luxury Property Platform</span>
                        </span>
                    </a>
                    @if(session('logged_in'))
                        <div class="nav-actions">
                            @if(!request()->routeIs('properties'))
                                <a href="{{ route('properties') }}" class="btn btn-secondary">Dashboard</a>
                            @endif

                            @if(!request()->routeIs('reservations'))
                                <a href="{{ route('reservations') }}" class="btn btn-secondary">
                                    <i class="bi bi-calendar-check" aria-hidden="true"></i>
                                    <span>Reservations</span>
                                </a>
                            @endif

                            @if(!request()->routeIs('listings', 'listings.edit', 'listings.update', 'listings.destroy'))
                                <a href="{{ route('listings') }}" class="btn btn-secondary">
                                    <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                    <span>Edit Listing Details</span>
                                </a>
                            @endif

                            @if(!request()->routeIs('listings.create', 'listings.store'))
                                <a href="{{ route('listings.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle" aria-hidden="true"></i>
                                    <span>Add Listing</span>
                                </a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <nav class="nav-links">
                            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                            <a href="{{ route('listings') }}" class="{{ request()->routeIs('listings') ? 'active' : '' }}">Browse Houses</a>
                        </nav>
                        <div class="nav-actions">
                            <a href="{{ route('login') }}" class="btn btn-primary">Agent Login</a>
                        </div>
                    @endif
                </div>
            </header>
            <main class="container">
                @yield('content')
            </main>
        </div>
    </body>
</html>
