@extends('layouts.app')

@section('title', 'DevEstate | Welcome')

@section('content')
<style>
    .guest-hero {
        grid-template-columns: minmax(0, 1.2fr) minmax(320px, 0.88fr);
        gap: 1.4rem;
        padding: 2.35rem;
        align-items: stretch;
    }
    .guest-hero-main {
        display: grid;
        gap: 1rem;
        align-content: start;
    }
    .guest-hero-eyebrow {
        gap: 0.5rem;
        width: fit-content;
    }
    .guest-hero-title {
        margin: 0;
        max-width: 11ch;
        font-size: clamp(2.9rem, 5vw, 4.8rem);
        line-height: 0.92;
    }
    .guest-hero-copy {
        margin: 0;
        max-width: 62ch;
        color: rgba(248, 250, 252, 0.88);
    }
    .guest-trust-row {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 0.75rem;
    }
    .guest-trust-card {
        display: grid;
        gap: 0.32rem;
        padding: 0.95rem 1rem;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04);
    }
    .guest-trust-card strong {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #FFFFFF;
        font-size: 0.95rem;
    }
    .guest-trust-card strong i {
        color: var(--gold-soft);
    }
    .guest-trust-card span {
        color: rgba(248, 250, 252, 0.74);
        font-size: 0.82rem;
        line-height: 1.55;
    }
    .guest-search-shell {
        display: grid;
        gap: 1rem;
        padding: 1.2rem;
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.96);
        color: var(--text-dark);
        box-shadow: 0 22px 38px rgba(15, 23, 42, 0.12);
    }
    .guest-search-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .guest-search-head strong {
        display: block;
        color: var(--navy);
        font-size: 1.18rem;
    }
    .guest-search-head span {
        color: var(--text-muted);
        font-size: 0.88rem;
        line-height: 1.55;
        max-width: 28ch;
    }
    .guest-search-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0.85rem;
    }
    .guest-field {
        display: grid;
        gap: 0.42rem;
    }
    .guest-field-wide {
        grid-column: 1 / -1;
    }
    .guest-field span {
        color: var(--navy);
        font-size: 0.76rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }
    .guest-field input,
    .guest-field select {
        width: 100%;
        min-height: 50px;
        border-radius: 18px;
        border: 1px solid rgba(217, 226, 236, 0.92);
        padding: 0.95rem 1rem;
        background: #FFFFFF;
        color: var(--text-dark);
    }
    .guest-field input::placeholder {
        color: #8A98A8;
    }
    .guest-field select {
        appearance: none;
    }
    .guest-search-btn {
        width: 100%;
        min-height: 52px;
        grid-column: 1 / -1;
        box-shadow: 0 16px 28px rgba(212, 160, 23, 0.2);
    }
    .guest-filter-row {
        display: flex;
        align-items: center;
        gap: 0.55rem;
        flex-wrap: wrap;
    }
    .guest-filter-label {
        color: var(--text-muted);
        font-size: 0.82rem;
        font-weight: 700;
        margin-right: 0.2rem;
    }
    .guest-filter-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.42rem;
        padding: 0.65rem 0.9rem;
        border-radius: 999px;
        background: #F8F2DF;
        color: #7A6120;
        font-size: 0.84rem;
        font-weight: 700;
        transition: transform 0.18s ease, background 0.2s ease;
    }
    .guest-filter-chip:hover {
        transform: translateY(-1px);
        background: #F3E2B1;
    }
    .guest-filter-chip i {
        color: var(--gold);
    }
    .guest-hero-side {
        display: grid;
        gap: 1rem;
    }
    .guest-showcase-card {
        overflow: hidden;
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.95);
        color: var(--text-dark);
        box-shadow: 0 20px 34px rgba(15, 23, 42, 0.14);
    }
    .guest-showcase-media {
        position: relative;
        height: 250px;
    }
    .guest-showcase-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .guest-showcase-badge,
    .guest-showcase-score {
        position: absolute;
        top: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.5rem 0.85rem;
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 800;
        backdrop-filter: blur(12px);
    }
    .guest-showcase-badge {
        left: 1rem;
        background: rgba(255, 255, 255, 0.92);
        color: var(--navy);
    }
    .guest-showcase-score {
        right: 1rem;
        background: rgba(16, 42, 68, 0.78);
        color: #FFFFFF;
    }
    .guest-showcase-copy {
        display: grid;
        gap: 0.85rem;
        padding: 1.2rem 1.25rem 1.3rem;
    }
    .guest-showcase-copy h3 {
        margin: 0;
        color: var(--navy);
        font-size: 1.35rem;
    }
    .guest-showcase-copy p {
        margin: 0;
        color: var(--text-muted);
        line-height: 1.65;
        font-size: 0.92rem;
    }
    .guest-showcase-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.55rem;
    }
    .guest-showcase-meta span {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.5rem 0.8rem;
        border-radius: 999px;
        background: #F3F6FA;
        color: var(--navy-soft);
        font-size: 0.82rem;
        font-weight: 700;
    }
    .guest-showcase-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .guest-showcase-price small {
        display: block;
        margin-bottom: 0.18rem;
        color: var(--text-muted);
        font-size: 0.76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }
    .guest-showcase-price strong {
        color: var(--gold);
        font-size: 1.65rem;
        line-height: 1;
    }
    .guest-side-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0.9rem;
    }
    .guest-side-panel {
        display: grid;
        gap: 0.35rem;
        padding: 1rem 1.05rem;
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .guest-side-panel small {
        color: rgba(248, 250, 252, 0.7);
        font-size: 0.76rem;
        font-weight: 800;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }
    .guest-side-panel strong {
        color: #FFFFFF;
        font-size: 1.55rem;
        line-height: 1.1;
    }
    .guest-side-panel p {
        margin: 0;
        color: rgba(248, 250, 252, 0.78);
        font-size: 0.87rem;
        line-height: 1.55;
    }
    @media (max-width: 1080px) {
        .guest-hero {
            grid-template-columns: 1fr;
        }
        .guest-trust-row {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
    @media (max-width: 780px) {
        .guest-hero {
            padding: 1.5rem 1.15rem;
        }
        .guest-hero-title {
            max-width: 13ch;
            font-size: clamp(2.4rem, 9vw, 3.4rem);
        }
        .guest-search-grid,
        .guest-side-grid,
        .guest-trust-row {
            grid-template-columns: 1fr;
        }
        .guest-showcase-media {
            height: 220px;
        }
    }
</style>
<section class="page-section">
    <div class="hero-card hero-card-large guest-hero">
        <div class="hero-content guest-hero-main">
            <span class="hero-eyebrow guest-hero-eyebrow">
                <i class="bi bi-stars" aria-hidden="true"></i>
                <span>Luxury Home Search</span>
            </span>
            <h1 class="hero-title guest-hero-title">Discover elegant homes with a smarter way to search.</h1>
            <p class="hero-copy guest-hero-copy">Explore premium residences, compare meaningful details quickly, and shortlist properties with confidence. DevEstate brings verified listings, polished presentation, and agent-backed support into one refined search experience.</p>

            <div class="guest-trust-row">
                <div class="guest-trust-card">
                    <strong><i class="bi bi-shield-check" aria-hidden="true"></i> Verified Listings</strong>
                    <span>Curated homes presented with trusted pricing, photos, and key details.</span>
                </div>
                <div class="guest-trust-card">
                    <strong><i class="bi bi-award" aria-hidden="true"></i> Premium Selection</strong>
                    <span>Luxury-ready homes across prime districts and sought-after communities.</span>
                </div>
                <div class="guest-trust-card">
                    <strong><i class="bi bi-clock-history" aria-hidden="true"></i> Fast Guidance</strong>
                    <span>Move from search to viewing with quick agent support when you are ready.</span>
                </div>
            </div>

            <form action="{{ route('listings') }}" method="GET" class="guest-search-shell">
                <div class="guest-search-head">
                    <div>
                        <strong>Search luxury properties</strong>
                        <span>Filter by keyword, property type, budget, and bedroom count.</span>
                    </div>
                    <span><i class="bi bi-sliders2" aria-hidden="true"></i> Flexible filters</span>
                </div>

                <div class="guest-search-grid">
                    <label class="guest-field guest-field-wide">
                        <span>Keyword</span>
                        <input type="text" name="search" placeholder="Penthouse, riverfront, contemporary, garage">
                    </label>
                    <label class="guest-field">
                        <span>Property Type</span>
                        <select name="property_type">
                            <option value="">Any Type</option>
                            <option value="condo">Condo</option>
                            <option value="villa">Villa</option>
                            <option value="penthouse">Penthouse</option>
                            <option value="contemporary">Contemporary</option>
                            <option value="urban minimalist">Urban Minimalist</option>
                        </select>
                    </label>
                    <label class="guest-field">
                        <span>Price Range</span>
                        <select name="price_range">
                            <option value="">Any Budget</option>
                            <option value="500k">Up to $500K</option>
                            <option value="800k">Up to $800K</option>
                            <option value="1200k">Up to $1.2M</option>
                            <option value="1200k-plus">$1.2M+</option>
                        </select>
                    </label>
                    <label class="guest-field">
                        <span>Bedrooms</span>
                        <select name="bedrooms">
                            <option value="">Any</option>
                            <option value="2">2+</option>
                            <option value="3">3+</option>
                            <option value="4">4+</option>
                            <option value="5">5+</option>
                        </select>
                    </label>
                    <button type="submit" class="btn btn-primary guest-search-btn">
                        <i class="bi bi-search" aria-hidden="true"></i>
                        <span>Search Properties</span>
                    </button>
                </div>

                <div class="guest-filter-row">
                    <span class="guest-filter-label">Quick filters</span>
                    <a href="{{ route('listings', ['search' => 'riverfront']) }}" class="guest-filter-chip"><i class="bi bi-water" aria-hidden="true"></i> Riverfront</a>
                    <a href="{{ route('listings', ['property_type' => 'penthouse']) }}" class="guest-filter-chip"><i class="bi bi-buildings" aria-hidden="true"></i> Penthouse</a>
                    <a href="{{ route('listings', ['bedrooms' => 4]) }}" class="guest-filter-chip"><i class="bi bi-house-heart" aria-hidden="true"></i> 4+ Beds</a>
                    <a href="{{ route('listings', ['price_range' => '800k']) }}" class="guest-filter-chip"><i class="bi bi-check2-circle" aria-hidden="true"></i> Under $800K</a>
                </div>
            </form>
        </div>

        <div class="hero-panel guest-hero-side">
            <article class="guest-showcase-card">
                <div class="guest-showcase-media">
                    <img src="{{ asset('images/house4.jpg') }}" alt="Riverbend Villa exterior view">
                    <span class="guest-showcase-badge">
                        <i class="bi bi-gem" aria-hidden="true"></i>
                        Featured Collection
                    </span>
                    <span class="guest-showcase-score">
                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                        4.9 Rated
                    </span>
                </div>
                <div class="guest-showcase-copy">
                    <div>
                        <h3>Riverbend Villa</h3>
                        <p>Private gardens, quiet riverfront views, and a bright hospitality-inspired layout made for elevated everyday living.</p>
                    </div>

                    <div class="guest-showcase-meta">
                        <span><i class="bi bi-door-open" aria-hidden="true"></i> 4 Beds</span>
                        <span><i class="bi bi-droplet" aria-hidden="true"></i> 3 Baths</span>
                        <span><i class="bi bi-aspect-ratio" aria-hidden="true"></i> 380 sqm</span>
                    </div>

                    <div class="guest-showcase-footer">
                        <div class="guest-showcase-price">
                            <small>Featured Price</small>
                            <strong>$950K</strong>
                        </div>
                        <a href="{{ route('details', ['slug' => 'riverbend-villa']) }}" class="btn btn-secondary" style="color: var(--navy); border-color: rgba(16, 42, 68, 0.16); background: #F8FAFD;">
                            <i class="bi bi-arrow-up-right" aria-hidden="true"></i>
                            <span>View Property</span>
                        </a>
                    </div>
                </div>
            </article>

            <div class="guest-side-grid">
                <div class="guest-side-panel">
                    <small>Verified Inventory</small>
                    <strong>200+</strong>
                    <p>Curated homes available across premium neighborhoods.</p>
                </div>
                <div class="guest-side-panel">
                    <small>Viewing Support</small>
                    <strong>24h</strong>
                    <p>Shortlist now and reach an agent quickly for next-step assistance.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="page-card">
        <h2 class="section-title">Featured Houses for Clients</h2>
        <p class="section-description">Explore homes in prime locations. Open each listing to view more details before contacting an agent.</p>
        <div class="property-grid">
            <article class="property-card">
                <div class="property-media">
                    <img src="{{ asset('images/house1.jpg') }}" alt="Skyline Ridge">
                    <span class="property-chip">Featured</span>
                </div>
                <div class="property-body">
                    <div class="property-meta">
                        <span>4 Beds</span>
                        <span>3 Baths</span>
                    </div>
                    <h3>Skyline Ridge Home</h3>
                    <p>Modern finishes and expansive glass bring light into every room.</p>
                    <div class="price-row">
                        <span class="price">$780K</span>
                        <a href="{{ route('details', ['slug' => 'skyline-ridge-home']) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </article>
            <article class="property-card">
                <div class="property-media">
                    <img src="{{ asset('images/house2.jpg') }}" alt="Parklane Condo">
                    <span class="property-chip">New</span>
                </div>
                <div class="property-body">
                    <div class="property-meta">
                        <span>3 Beds</span>
                        <span>2 Baths</span>
                    </div>
                    <h3>Parklane Condo</h3>
                    <p>Urban living with polished amenities and a bright open plan.</p>
                    <div class="price-row">
                        <span class="price">$620K</span>
                        <a href="{{ route('details', ['slug' => 'parklane-condo']) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </article>
            <article class="property-card">
                <div class="property-media">
                    <img src="{{ asset('images/house3.jpg') }}" alt="Harbor Crest Penthouse">
                    <span class="property-chip">Top Rated</span>
                </div>
                <div class="property-body">
                    <div class="property-meta">
                        <span>5 Beds</span>
                        <span>4 Baths</span>
                    </div>
                    <h3>Harbor Crest Penthouse</h3>
                    <p>Elevated city residence with panoramic vistas and private terrace.</p>
                    <div class="price-row">
                        <span class="price">$1.15M</span>
                        <a href="{{ route('details', ['slug' => 'harbor-crest-penthouse']) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </article>
        </div>
    </div>

    <div class="page-card">
        <h2 class="section-title">Why Clients Choose DevEstate</h2>
        <div class="feature-grid">
            <div class="quick-card">
                <div class="icon-tile" aria-hidden="true">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h3>Trusted Listings</h3>
                <p>Homes are curated, reviewed, and kept current by agents you can trust.</p>
            </div>
            <div class="quick-card">
                <div class="icon-tile" aria-hidden="true">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <h3>Clear Details</h3>
                <p>See the key specs, pricing, and images you need before scheduling a visit.</p>
            </div>
            <div class="quick-card">
                <div class="icon-tile" aria-hidden="true">
                    <i class="bi bi-lightning-charge"></i>
                </div>
                <h3>Quick Browsing</h3>
                <p>Browse matching houses faster with a clean layout and less friction.</p>
            </div>
            <div class="quick-card">
                <div class="icon-tile" aria-hidden="true">
                    <i class="bi bi-chat-dots"></i>
                </div>
                <h3>Agent Guidance</h3>
                <p>Reach out for one-to-one guidance once you shortlist the homes you like.</p>
            </div>
        </div>
    </div>

</section>
@endsection
