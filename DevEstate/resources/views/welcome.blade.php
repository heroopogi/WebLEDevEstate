@extends('layouts.app')

@section('title', 'DevEstate | Welcome')

@section('content')
<section class="page-section">
    <div class="hero-card hero-card-large">
        <div class="hero-content">
            <span class="hero-eyebrow">Client House Search</span>
            <h1 class="hero-title hero-title-large">Find Houses That Fit Your Lifestyle</h1>
            <p class="hero-copy">Browse available homes, compare details, and explore property locations. You can start searching as a guest, then connect with an agent when you are ready.</p>
            <div class="hero-links">
                <a href="{{ route('listings') }}" class="btn btn-primary">Browse Houses</a>
                <a href="{{ route('login') }}" class="btn btn-secondary">Agent Login</a>
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
                <div class="icon-tile">SAFE</div>
                <h3>Trusted Listings</h3>
                <p>Homes are curated and regularly updated by agents.</p>
            </div>
            <div class="quick-card">
                <div class="icon-tile">CLEAR</div>
                <h3>Clear Details</h3>
                <p>Get the information you need before scheduling a visit.</p>
            </div>
            <div class="quick-card">
                <div class="icon-tile">FAST</div>
                <h3>Quick Browsing</h3>
                <p>Find matching houses quickly with minimal friction.</p>
            </div>
            <div class="quick-card">
                <div class="icon-tile">HELP</div>
                <h3>Agent Guidance</h3>
                <p>Reach out to an agent once you shortlist homes.</p>
            </div>
        </div>
    </div>

    <div class="cta-panel">
        <h2>Ready to Start Your House Search?</h2>
        <p>Browse listings now, review property details, and find the home that fits your needs.</p>
        <div class="cta-actions">
            <a href="{{ route('listings') }}" class="btn btn-primary">Browse Houses</a>
        </div>
    </div>
</section>
@endsection
