@extends('layouts.app')

@section('title', 'DevEstate | Find Your Dream Home')

@section('content')
<style>
    /* ── Landing page scoped styles ── */
    .lp-hero {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2.5rem;
        align-items: center;
        padding: 3rem 2.5rem;
        border-radius: 36px;
        background: linear-gradient(135deg, #0c1f38 0%, #1a3a62 60%, #2a5298 100%);
        color: #f8fafc;
        position: relative;
        overflow: hidden;
    }
    .lp-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 20% 50%, rgba(212,160,23,0.12) 0%, transparent 55%),
                    radial-gradient(circle at 80% 20%, rgba(255,255,255,0.07) 0%, transparent 40%);
        pointer-events: none;
    }
    .lp-hero-left { position: relative; z-index: 1; }
    .lp-eyebrow {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.5rem 1rem; border-radius: 999px;
        background: rgba(212,160,23,0.18); color: #f2d689;
        font-size: 0.78rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase;
        margin-bottom: 1.25rem;
    }
    .lp-hero h1 {
        font-size: clamp(2.2rem, 4vw, 3.4rem); font-weight: 800;
        line-height: 1.1; margin: 0 0 1rem; color: #fff;
    }
    .lp-hero h1 span { color: #D4A017; }
    .lp-hero-desc {
        color: rgba(248,250,252,0.85); font-size: 1.05rem; line-height: 1.75;
        margin: 0 0 1.75rem; max-width: 46ch;
    }
    .lp-hero-btns { display: flex; gap: 0.85rem; flex-wrap: wrap; }
    .lp-hero-right { position: relative; z-index: 1; }

    /* Search panel in hero */
    .lp-search-card {
        background: rgba(255,255,255,0.97);
        border-radius: 28px;
        padding: 2rem;
        box-shadow: 0 24px 48px rgba(0,0,0,0.18);
        color: var(--text-dark);
    }
    .lp-search-card h3 {
        margin: 0 0 0.35rem; font-size: 1.2rem; color: var(--navy); font-weight: 800;
    }
    .lp-search-card p { margin: 0 0 1.25rem; color: var(--text-muted); font-size: 0.9rem; }
    .lp-form-row { display: grid; gap: 0.75rem; }
    .lp-form-group { display: flex; flex-direction: column; gap: 0.35rem; }
    .lp-form-group label { font-size: 0.78rem; font-weight: 700; color: var(--navy); text-transform: uppercase; letter-spacing: 0.08em; }
    .lp-form-group input, .lp-form-group select {
        width: 100%; min-height: 46px;
        border: 1.5px solid var(--border); border-radius: 14px;
        padding: 0.75rem 1rem; background: #f8fafc; color: var(--text-dark);
        font-size: 0.93rem; transition: border-color 0.2s;
    }
    .lp-form-group input:focus, .lp-form-group select:focus {
        outline: none; border-color: var(--gold); background: #fff;
    }
    .lp-form-group select { appearance: none; cursor: pointer; }
    .lp-search-btn {
        width: 100%; margin-top: 0.5rem;
        background: var(--gold); color: var(--navy); border: none;
        border-radius: 14px; min-height: 50px;
        font-weight: 800; font-size: 1rem; cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        transition: background 0.2s, transform 0.18s, box-shadow 0.2s;
        box-shadow: 0 8px 20px rgba(212,160,23,0.3);
    }
    .lp-search-btn:hover { background: #c09212; transform: translateY(-2px); box-shadow: 0 12px 28px rgba(212,160,23,0.4); }

    /* Stats strip below search */
    .lp-stats-strip {
        display: flex; gap: 1.5rem; margin-top: 1.25rem; flex-wrap: wrap;
    }
    .lp-stat { text-align: center; }
    .lp-stat strong { display: block; font-size: 1.4rem; color: var(--navy); font-weight: 800; }
    .lp-stat span { font-size: 0.78rem; color: var(--text-muted); font-weight: 600; }

    /* Section wrapper */
    .lp-section { margin-top: 2rem; }
    .lp-section-header { display: flex; align-items: flex-end; justify-content: space-between; gap: 1rem; margin-bottom: 1.5rem; }
    .lp-section-header div p { margin: 0.35rem 0 0; color: var(--text-muted); font-size: 0.97rem; line-height: 1.6; }
    .lp-section-title { margin: 0; font-size: 1.65rem; font-weight: 800; color: var(--navy); }
    .lp-view-all {
        white-space: nowrap; color: var(--navy); border: 2px solid var(--gold);
        background: transparent; border-radius: 999px; padding: 0.55rem 1.25rem;
        font-weight: 700; font-size: 0.88rem; transition: all 0.2s;
    }
    .lp-view-all:hover { background: var(--gold); color: var(--navy); }

    /* Property cards enhanced */
    .lp-card-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }
    .lp-prop-card {
        background: #fff; border-radius: 24px; overflow: hidden;
        border: 1px solid rgba(217,226,236,0.7);
        box-shadow: 0 8px 20px rgba(15,23,42,0.06);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        display: flex; flex-direction: column;
    }
    .lp-prop-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(15,23,42,0.13); }
    .lp-prop-media { position: relative; height: 220px; overflow: hidden; }
    .lp-prop-media img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 0.4s ease;
    }
    .lp-prop-card:hover .lp-prop-media img { transform: scale(1.08); }
    .lp-prop-badge {
        position: absolute; top: 1rem; left: 1rem;
        padding: 0.4rem 0.9rem; border-radius: 999px;
        background: rgba(255,255,255,0.95); color: var(--navy);
        font-size: 0.78rem; font-weight: 700;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .lp-heart {
        position: absolute; top: 1rem; right: 1rem;
        width: 36px; height: 36px; border-radius: 50%;
        background: rgba(255,255,255,0.92); border: none; cursor: pointer;
        display: grid; place-items: center;
        font-size: 1rem; color: #b0b8c5;
        transition: color 0.2s, transform 0.2s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .lp-heart:hover { color: #e53e3e; transform: scale(1.15); }
    .lp-prop-body { padding: 1.4rem; flex: 1; display: flex; flex-direction: column; gap: 0.6rem; }
    .lp-prop-location { display: flex; align-items: center; gap: 0.35rem; color: var(--text-muted); font-size: 0.82rem; font-weight: 600; }
    .lp-prop-location i { color: var(--gold); }
    .lp-prop-specs { display: flex; gap: 0.75rem; flex-wrap: wrap; }
    .lp-prop-spec {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 0.35rem 0.75rem; border-radius: 999px;
        background: #f1f5f9; color: var(--text-muted); font-size: 0.8rem; font-weight: 600;
    }
    .lp-prop-spec i { font-size: 0.85rem; }
    .lp-prop-body h3 { margin: 0; color: var(--navy); font-size: 1.1rem; font-weight: 700; line-height: 1.3; }
    .lp-prop-body p { margin: 0; color: var(--text-muted); font-size: 0.9rem; line-height: 1.6; flex: 1; }
    .lp-prop-footer {
        display: flex; justify-content: space-between; align-items: center;
        margin-top: auto; padding-top: 1rem; border-top: 1px solid var(--border);
    }
    .lp-price { color: var(--gold); font-size: 1.3rem; font-weight: 800; }
    .lp-view-btn {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.55rem 1.1rem; border-radius: 999px;
        background: var(--navy); color: #fff; font-size: 0.85rem; font-weight: 700;
        transition: background 0.2s, transform 0.18s;
    }
    .lp-view-btn:hover { background: var(--gold); color: var(--navy); transform: translateY(-1px); }

    /* Why Choose Us */
    .lp-why-section {
        background: linear-gradient(180deg, #f4f8fb 0%, #eef4f9 100%);
        border-radius: 28px; padding: 2.5rem;
    }
    .lp-why-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.25rem;
        margin-top: 1.5rem;
    }
    .lp-why-card {
        background: #fff; border-radius: 20px; padding: 1.75rem 1.5rem;
        border: 1px solid rgba(217,226,236,0.6);
        box-shadow: 0 6px 16px rgba(15,23,42,0.05);
        transition: transform 0.22s ease, box-shadow 0.22s ease;
        text-align: left;
    }
    .lp-why-card:hover { transform: translateY(-4px); box-shadow: 0 14px 28px rgba(15,23,42,0.1); }
    .lp-why-icon {
        width: 52px; height: 52px; border-radius: 16px;
        background: #f8f1d5; color: #8b6b1b;
        display: grid; place-items: center; font-size: 1.4rem;
        margin-bottom: 1rem;
    }
    .lp-why-card h3 { margin: 0 0 0.5rem; color: var(--navy); font-size: 1.05rem; font-weight: 700; }
    .lp-why-card p { margin: 0; color: var(--text-muted); font-size: 0.9rem; line-height: 1.65; }

    /* CTA Section */
    .lp-cta {
        border-radius: 32px;
        background: linear-gradient(135deg, #0c1f38 0%, #1a3a62 55%, #2a5298 100%);
        padding: 3rem 2.5rem;
        text-align: center; color: #fff;
        position: relative; overflow: hidden;
    }
    .lp-cta::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(circle at 50% 120%, rgba(212,160,23,0.2) 0%, transparent 60%);
        pointer-events: none;
    }
    .lp-cta-inner { position: relative; z-index: 1; max-width: 640px; margin: 0 auto; }
    .lp-cta-eyebrow {
        display: inline-flex; padding: 0.45rem 1rem; border-radius: 999px;
        background: rgba(212,160,23,0.18); color: #f2d689;
        font-size: 0.78rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase;
        margin-bottom: 1.1rem;
    }
    .lp-cta h2 { margin: 0 0 0.85rem; font-size: clamp(1.8rem, 3vw, 2.6rem); font-weight: 800; color: #fff; }
    .lp-cta p { margin: 0 0 2rem; color: rgba(248,250,252,0.82); font-size: 1.05rem; line-height: 1.7; }
    .lp-cta-btns { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
    .lp-btn-ghost {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.75rem 1.6rem; border-radius: 999px;
        border: 2px solid rgba(255,255,255,0.35); color: #fff;
        font-weight: 700; font-size: 0.95rem;
        transition: all 0.2s;
    }
    .lp-btn-ghost:hover { border-color: rgba(255,255,255,0.8); background: rgba(255,255,255,0.08); transform: translateY(-1px); }

    @media (max-width: 900px) {
        .lp-hero { grid-template-columns: 1fr; }
        .lp-card-grid { grid-template-columns: 1fr 1fr; }
        .lp-why-grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 600px) {
        .lp-card-grid { grid-template-columns: 1fr; }
        .lp-why-grid { grid-template-columns: 1fr; }
        .lp-hero { padding: 2rem 1.25rem; }
        .lp-cta { padding: 2rem 1.25rem; }
    }
</style>

<div style="display:grid; gap:2rem; padding-bottom:2rem;">

    {{-- ── HERO ── --}}
    <section class="lp-hero">
        <div class="lp-hero-left">
            <span class="lp-eyebrow"><i class="bi bi-geo-alt-fill"></i> Client House Search</span>
            <h1>Find Houses That Fit <span>Your Lifestyle</span></h1>
            <p class="lp-hero-desc">Browse available homes, compare details, and explore property locations. Start searching as a guest — connect with an agent when you're ready.</p>
            <div class="lp-hero-btns">
                <a href="{{ route('listings') }}" class="btn btn-primary" style="min-width:160px;">
                    <i class="bi bi-search"></i> Browse Houses
                </a>
                <a href="{{ route('login') }}" class="lp-btn-ghost">
                    <i class="bi bi-person-circle"></i> Agent Login
                </a>
            </div>
        </div>
        <div class="lp-hero-right">
            <div class="lp-search-card">
                <h3>Find Your Property</h3>
                <p>Search from hundreds of verified listings</p>
                <div class="lp-form-row">
                    <div class="lp-form-group">
                        <label><i class="bi bi-geo-alt"></i> Location</label>
                        <input type="text" placeholder="City, district, or address…">
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.75rem;">
                        <div class="lp-form-group">
                            <label><i class="bi bi-cash"></i> Max Price</label>
                            <select>
                                <option>Any price</option>
                                <option>Up to $500K</option>
                                <option>Up to $800K</option>
                                <option>Up to $1.2M</option>
                                <option>$1.2M+</option>
                            </select>
                        </div>
                        <div class="lp-form-group">
                            <label><i class="bi bi-door-open"></i> Bedrooms</label>
                            <select>
                                <option>Any</option>
                                <option>1+</option>
                                <option>2+</option>
                                <option>3+</option>
                                <option>4+</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button class="lp-search-btn" onclick="window.location='{{ route('listings') }}'">
                    <i class="bi bi-search"></i> Search Properties
                </button>
                <div class="lp-stats-strip">
                    <div class="lp-stat"><strong>200+</strong><span>Active Listings</span></div>
                    <div class="lp-stat"><strong>98%</strong><span>Verified</span></div>
                    <div class="lp-stat"><strong>4.9★</strong><span>Client Rating</span></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── FEATURED HOUSES ── --}}
    <section class="lp-section">
        <div class="lp-section-header">
            <div>
                <h2 class="lp-section-title">Featured Houses</h2>
                <p>Explore homes in prime locations — open each listing to view full details before contacting an agent.</p>
            </div>
            <a href="{{ route('listings') }}" class="lp-view-all">View All <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="lp-card-grid">

            {{-- Card 1 --}}
            <article class="lp-prop-card">
                <div class="lp-prop-media">
                    <img src="{{ asset('images/house1.jpg') }}" alt="Skyline Ridge Home">
                    <span class="lp-prop-badge">⭐ Featured</span>
                    <button class="lp-heart" aria-label="Save to favourites"><i class="bi bi-heart-fill"></i></button>
                </div>
                <div class="lp-prop-body">
                    <div class="lp-prop-location"><i class="bi bi-geo-alt-fill"></i> Skyline District, Metro</div>
                    <div class="lp-prop-specs">
                        <span class="lp-prop-spec"><i class="bi bi-door-open"></i> 4 Beds</span>
                        <span class="lp-prop-spec"><i class="bi bi-droplet"></i> 3 Baths</span>
                    </div>
                    <h3>Skyline Ridge Home</h3>
                    <p>Modern finishes and expansive glass bring light into every room.</p>
                    <div class="lp-prop-footer">
                        <span class="lp-price">$780K</span>
                        <a href="{{ route('details', ['slug' => 'skyline-ridge-home']) }}" class="lp-view-btn">View Details <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </article>

            {{-- Card 2 --}}
            <article class="lp-prop-card">
                <div class="lp-prop-media">
                    <img src="{{ asset('images/house2.jpg') }}" alt="Parklane Condo">
                    <span class="lp-prop-badge">🆕 New</span>
                    <button class="lp-heart" aria-label="Save to favourites"><i class="bi bi-heart-fill"></i></button>
                </div>
                <div class="lp-prop-body">
                    <div class="lp-prop-location"><i class="bi bi-geo-alt-fill"></i> Parklane Avenue, Central</div>
                    <div class="lp-prop-specs">
                        <span class="lp-prop-spec"><i class="bi bi-door-open"></i> 3 Beds</span>
                        <span class="lp-prop-spec"><i class="bi bi-droplet"></i> 2 Baths</span>
                    </div>
                    <h3>Parklane Condo</h3>
                    <p>Urban living with polished amenities and a bright open plan.</p>
                    <div class="lp-prop-footer">
                        <span class="lp-price">$620K</span>
                        <a href="{{ route('details', ['slug' => 'parklane-condo']) }}" class="lp-view-btn">View Details <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </article>

            {{-- Card 3 --}}
            <article class="lp-prop-card">
                <div class="lp-prop-media">
                    <img src="{{ asset('images/house3.jpg') }}" alt="Harbor Crest Penthouse">
                    <span class="lp-prop-badge">🏆 Top Rated</span>
                    <button class="lp-heart" aria-label="Save to favourites"><i class="bi bi-heart-fill"></i></button>
                </div>
                <div class="lp-prop-body">
                    <div class="lp-prop-location"><i class="bi bi-geo-alt-fill"></i> Harbor Bay, Uptown</div>
                    <div class="lp-prop-specs">
                        <span class="lp-prop-spec"><i class="bi bi-door-open"></i> 5 Beds</span>
                        <span class="lp-prop-spec"><i class="bi bi-droplet"></i> 4 Baths</span>
                    </div>
                    <h3>Harbor Crest Penthouse</h3>
                    <p>Elevated city residence with panoramic vistas and private terrace.</p>
                    <div class="lp-prop-footer">
                        <span class="lp-price">$1.15M</span>
                        <a href="{{ route('details', ['slug' => 'harbor-crest-penthouse']) }}" class="lp-view-btn">View Details <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </article>

        </div>
    </section>

    {{-- ── WHY CHOOSE US ── --}}
    <section class="lp-why-section">
        <div style="display:flex; align-items:flex-end; justify-content:space-between; gap:1rem;">
            <div>
                <h2 class="lp-section-title">Why Clients Choose DevEstate</h2>
                <p style="margin:0.35rem 0 0; color:var(--text-muted); font-size:0.97rem;">Everything you need to find and secure your next home — in one place.</p>
            </div>
        </div>
        <div class="lp-why-grid">
            <div class="lp-why-card">
                <div class="lp-why-icon"><i class="bi bi-shield-check-fill"></i></div>
                <h3>Trusted Listings</h3>
                <p>Every property is curated and regularly verified by licensed agents — no fake listings.</p>
            </div>
            <div class="lp-why-card">
                <div class="lp-why-icon"><i class="bi bi-card-list"></i></div>
                <h3>Clear Details</h3>
                <p>Full specs, photos, and pricing up front so you know before you schedule a visit.</p>
            </div>
            <div class="lp-why-card">
                <div class="lp-why-icon"><i class="bi bi-lightning-charge-fill"></i></div>
                <h3>Quick Browsing</h3>
                <p>Find matching homes fast with intuitive filters and minimal friction — no account needed.</p>
            </div>
            <div class="lp-why-card">
                <div class="lp-why-icon"><i class="bi bi-person-lines-fill"></i></div>
                <h3>Agent Guidance</h3>
                <p>Once you shortlist properties, connect directly with a dedicated agent to move forward.</p>
            </div>
        </div>
    </section>

    {{-- ── CTA ── --}}
    <section class="lp-cta">
        <div class="lp-cta-inner">
            <span class="lp-cta-eyebrow"><i class="bi bi-house-heart-fill"></i> Your Next Chapter Starts Here</span>
            <h2>Find Your Dream Home Today</h2>
            <p>Hundreds of verified listings await. Browse properties, compare details, and connect with an agent when you're ready.</p>
            <div class="lp-cta-btns">
                <a href="{{ route('listings') }}" class="btn btn-primary" style="min-width:180px;">
                    <i class="bi bi-search"></i> Browse Listings
                </a>
                <a href="{{ route('login') }}" class="lp-btn-ghost">
                    <i class="bi bi-person-circle"></i> Contact Agent
                </a>
            </div>
        </div>
    </section>

</div>

<script>
    // Heart toggle
    document.querySelectorAll('.lp-heart').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            const icon = btn.querySelector('i');
            const active = btn.dataset.saved === '1';
            btn.dataset.saved = active ? '0' : '1';
            icon.style.color = active ? '' : '#e53e3e';
            btn.style.background = active ? 'rgba(255,255,255,0.92)' : 'rgba(255,255,255,0.97)';
        });
    });
</script>
@endsection
