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
        <p class="section-description">Explore the latest properties from the database, now using your actual house photos with ready-made placeholder specs.</p>
        @include('partials.property-grid', ['properties' => $properties, 'actionLabel' => 'View Details'])
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
        <p>Browse listings now, review property details, and explore house locations near your preferred area.</p>
        <div class="cta-actions">
            <a href="{{ route('listings') }}" class="btn btn-primary">Browse Houses</a>
            <a href="{{ route('map') }}" class="btn btn-secondary">View Locations</a>
        </div>
    </div>
</section>
@endsection
