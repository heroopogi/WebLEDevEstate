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
                background: rgba(20, 40, 73, 0.9);
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
                backdrop-filter: blur(16px);
                color: var(--white);
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
                color: var(--white);
            }
            .brand-mark {
                width: 48px;
                height: 48px;
                display: grid;
                place-items: center;
                border-radius: 16px;
                background: linear-gradient(135deg, #F4C246, #D4A017);
                color: #102A44;
                font-weight: 800;
                box-shadow: 0 16px 36px rgba(212, 160, 23, 0.18);
            }
            .brand-text {
                display: grid;
                gap: 0.15rem;
                line-height: 1.1;
            }
            .brand-title { font-size: 1rem; letter-spacing: 0.08em; }
            .brand-subtitle { font-size: 0.82rem; color: rgba(255, 255, 255, 0.78); }

            .nav-links {
                display: flex;
                align-items: center;
                gap: 1.1rem;
                flex-wrap: wrap;
            }
            .nav-links a {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.95rem;
                font-weight: 600;
                transition: color 0.2s ease;
            }
            .nav-links a:hover,
            .nav-links a.active { color: #FFFFFF; }
            .nav-actions {
                display: flex;
                gap: 0.9rem;
                align-items: center;
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
                gap: 0.75rem;
            }
            .price {
                color: var(--gold);
                font-size: 1.2rem;
                font-weight: 800;
            }
            .empty-state {
                padding: 2rem;
                border-radius: 20px;
                border: 1px dashed rgba(217, 226, 236, 0.9);
                background: #F8FAFC;
                color: var(--text-muted);
            }
            .empty-state h3 {
                margin: 0 0 0.75rem;
                color: var(--navy);
            }

            /* Detail page styles */
            .detail-card {
                max-width: 800px;
                margin: 0 auto;
            }
            .detail-hero-media {
                margin-bottom: 1.5rem;
                border-radius: 24px;
                overflow: hidden;
                border: 1px solid rgba(217, 226, 236, 0.7);
                box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
            }
            .detail-hero-media img {
                display: block;
                width: 100%;
                height: min(440px, 60vw);
                object-fit: cover;
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

            /* Map page styles */
            .map-card {
                max-width: 900px;
                margin: 0 auto;
            }
            .map-surface {
                position: relative;
                height: 400px;
                border-radius: 24px;
                background: linear-gradient(135deg, #E8F4FD, #D1E9F7);
                border: 2px solid rgba(217, 226, 236, 0.5);
                overflow: hidden;
            }
            .map-grid {
                position: absolute;
                inset: 0;
                background-image:
                    linear-gradient(rgba(15, 23, 42, 0.1) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(15, 23, 42, 0.1) 1px, transparent 1px);
                background-size: 40px 40px;
            }
            .road {
                position: absolute;
                background: rgba(15, 23, 42, 0.2);
            }
            .road.horizontal {
                height: 8px;
                left: 0;
                right: 0;
                top: 50%;
                transform: translateY(-50%);
            }
            .road.vertical {
                width: 8px;
                top: 0;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
            }
            .map-label {
                position: absolute;
                padding: 0.5rem 1rem;
                border-radius: 8px;
                background: rgba(255, 255, 255, 0.9);
                color: var(--navy);
                font-size: 0.85rem;
                font-weight: 600;
                box-shadow: 0 4px 8px rgba(15, 23, 42, 0.1);
            }
            .map-pin {
                position: absolute;
                width: 22px;
                height: 22px;
                border-radius: 50% 50% 50% 0;
                background: var(--gold);
                transform: rotate(-45deg);
                box-shadow: 0 4px 8px rgba(212, 160, 23, 0.3);
            }
            .map-pin::after {
                content: '';
                position: absolute;
                top: 3px;
                left: 3px;
                width: 16px;
                height: 16px;
                border-radius: 50%;
                background: white;
            }
            .map-label-cbd { top: 18%; left: 12%; }
            .map-label-park { top: 63%; left: 62%; }
            .map-label-station { top: 30%; left: 58%; }
            .map-pin-1 { top: 34%; left: 42%; }
            .map-pin-2 { top: 56%; left: 63%; }
            .map-pin-3 { top: 25%; left: 68%; }

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
            .btn-login { width: 100%; min-height: 52px; font-size: 1rem; margin-bottom: 1rem; }
            .form-note { margin: 0; color: var(--text-muted); font-size: 0.9rem; text-align: center; }

            @media (max-width: 980px) {
                .hero-card { grid-template-columns: 1fr; }
                .hero-stats { grid-template-columns: 1fr; }
                .section-grid { grid-template-columns: 1fr; }
            }
            @media (max-width: 780px) {
                .page-shell { padding: 1.5rem 0 2.5rem; }
                .nav-bar { flex-direction: column; align-items: stretch; }
                .nav-actions { width: 100%; justify-content: space-between; }
                .nav-links { width: 100%; justify-content: flex-start; }
                .hero-title { font-size: clamp(2.4rem, 8vw, 3.4rem); }
                .cta-panel { padding: 1.7rem; }
                .price-row { flex-direction: column; align-items: flex-start; }
            }
        </style>
    </head>
    <body>
        <div class="page-shell">
            <header class="site-header">
                <div class="container nav-bar">
                    <a href="{{ session('logged_in') ? route('properties') : route('home') }}" class="brand">
                        <span class="brand-mark">DE</span>
                        <span class="brand-text">
                            <span class="brand-title">DevEstate</span>
                            <span class="brand-subtitle">Luxury Property Platform</span>
                        </span>
                    </a>
                    @if(session('logged_in'))
                        <nav class="nav-links">
                            <a href="{{ route('properties') }}" class="{{ request()->routeIs('properties') ? 'active' : '' }}">Agent Dashboard</a>
                            <a href="{{ route('listings') }}" class="{{ request()->routeIs('listings') ? 'active' : '' }}">Manage Listings</a>
                            <a href="{{ route('details') }}" class="{{ request()->routeIs('details') ? 'active' : '' }}">Listing Details</a>
                            <a href="{{ route('map') }}" class="{{ request()->routeIs('map') ? 'active' : '' }}">Property Map</a>
                        </nav>
                        <div class="nav-actions">
                            <a href="{{ route('properties') }}" class="btn btn-secondary">Dashboard</a>
                            <a href="{{ route('listings') }}" class="btn btn-primary">Add Listing</a>
                            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </div>
                    @else
                        <nav class="nav-links">
                            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                            <a href="{{ route('listings') }}" class="{{ request()->routeIs('listings') ? 'active' : '' }}">Browse Houses</a>
                            <a href="{{ route('map') }}" class="{{ request()->routeIs('map') ? 'active' : '' }}">Locations</a>
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
