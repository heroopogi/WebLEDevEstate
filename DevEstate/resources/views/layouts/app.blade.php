<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'DevEstate')</title>
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

            .container {
                width: min(1180px, calc(100% - 2rem));
                margin: 0 auto;
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
                gap: 0.9rem;
                align-items: center;
                flex-wrap: wrap;
                justify-content: flex-end;
            }
            .nav-actions .btn {
                min-height: 46px;
                padding: 0 1.3rem;
                font-size: 0.95rem;
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

            .page-shell { padding: 2.5rem 0 3.5rem; }
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
                .dashboard-hero-grid,
                .dashboard-metrics {
                    grid-template-columns: repeat(2, minmax(240px, 1fr));
                    width: 100%;
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
                                <a href="{{ route('reservations') }}" class="btn btn-secondary">Reservations</a>
                            @endif

                            @if(!request()->routeIs('listings', 'listings.edit', 'listings.update', 'listings.destroy'))
                                <a href="{{ route('listings') }}" class="btn btn-secondary">Edit Listing Details</a>
                            @endif

                            @if(!request()->routeIs('listings.create', 'listings.store'))
                                <a href="{{ route('listings.create') }}" class="btn btn-primary">Add Listing</a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
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
