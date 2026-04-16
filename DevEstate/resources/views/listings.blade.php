@extends('layouts.app')

@section('title', 'DevEstate | Listings')

@section('content')
<section class="hero">
    <span class="eyebrow">House Listings</span>
    <h1>{{ session('logged_in') ? 'Manage and publish houses.' : 'Browse available houses.' }}</h1>
    <p>{{ session('logged_in') ? 'As an agent, add and maintain house listings for your clients.' : 'As a client, explore available homes and open each listing for full details.' }}</p>
    <div class="hero-actions">
        <a href="{{ route('details') }}" class="btn btn-primary">{{ session('logged_in') ? 'Add or edit details' : 'See a house detail page' }}</a>
        <a href="{{ route('map') }}" class="btn btn-outline">{{ session('logged_in') ? 'Update map location' : 'Open location map' }}</a>
    </div>
</section>

<div class="page-card">
    <h2 class="section-title">{{ session('logged_in') ? 'Managed house inventory' : 'Featured houses' }}</h2>
    <div class="property-grid">
        <article class="property-card">
            <div class="property-media">
                <img src="https://images.unsplash.com/photo-1523217582562-09d0def993a6?auto=format&fit=crop&w=900&q=80" alt="Modern home exterior">
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
                    <span class="price">$780,000</span>
                    <a href="{{ route('details') }}" class="btn btn-primary">{{ session('logged_in') ? 'Manage listing' : 'View details' }}</a>
                </div>
            </div>
        </article>
        <article class="property-card">
            <div class="property-media">
                <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80" alt="Elegant condo interior">
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
                    <span class="price">$620,000</span>
                    <a href="{{ route('details') }}" class="btn btn-primary">{{ session('logged_in') ? 'Manage listing' : 'View details' }}</a>
                </div>
            </div>
        </article>
        <article class="property-card">
            <div class="property-media">
                <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=900&q=80" alt="Luxury penthouse interior">
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
                    <span class="price">$1,150,000</span>
                    <a href="{{ route('details') }}" class="btn btn-primary">{{ session('logged_in') ? 'Manage listing' : 'View details' }}</a>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection
