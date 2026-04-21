@extends('layouts.app')

@section('title', 'DevEstate | Details')

@section('content')
<section class="hero">
    <span class="eyebrow">{{ $property->badge }} Property</span>
    <h1>{{ session('logged_in') ? 'Review and refine listing details.' : 'Review complete house details.' }}</h1>
    <p>{{ session('logged_in') ? 'This listing is now loaded from the database and ready for future editing tools.' : 'Clients can inspect the placeholder specs, image, and overview pulled from the properties table.' }}</p>
    <div class="hero-actions">
        <a href="{{ route('map') }}" class="btn btn-primary">{{ session('logged_in') ? 'Set map location' : 'Open map location' }}</a>
        <a href="{{ route('listings') }}" class="btn btn-outline">{{ session('logged_in') ? 'Back to manage listings' : 'Back to house listings' }}</a>
    </div>
</section>

<div class="page-card detail-card">
    <div class="detail-hero-media">
        <img src="{{ asset($property->image_path) }}" alt="{{ $property->name }}">
    </div>
    <span class="eyebrow">{{ $property->property_type }}</span>
    <h3>{{ $property->name }}</h3>
    <div class="detail-meta">
        <span>{{ $property->location }}</span>
        <span>{{ $property->parking_spaces }} Parking</span>
        <span>PHP {{ number_format($property->price) }}</span>
    </div>
    <p class="detail-description">{{ $property->description }}</p>
    <div class="detail-list">
        <div class="detail-item">
            <span>Floor Area</span>
            <strong>{{ $property->floor_area }} sqm</strong>
        </div>
        <div class="detail-item">
            <span>Lot Area</span>
            <strong>{{ $property->lot_area }} sqm</strong>
        </div>
        <div class="detail-item">
            <span>Bedrooms</span>
            <strong>{{ $property->bedrooms }} Bedrooms</strong>
        </div>
        <div class="detail-item">
            <span>Bathrooms</span>
            <strong>{{ $property->bathrooms }} Bathrooms</strong>
        </div>
        <div class="detail-item">
            <span>Property Type</span>
            <strong>{{ $property->property_type }}</strong>
        </div>
        <div class="detail-item">
            <span>Status</span>
            <strong>{{ $property->badge }}</strong>
        </div>
    </div>
    <div class="inline-actions">
        <a href="{{ route('map') }}" class="btn btn-primary">{{ session('logged_in') ? 'Update location pin' : 'View location' }}</a>
        <a href="{{ route('listings') }}" class="btn btn-outline">{{ session('logged_in') ? 'Back to listings' : 'Continue browsing' }}</a>
    </div>
</div>

<div class="page-card">
    <h2 class="section-title">More Properties</h2>
    @include('partials.property-grid', ['properties' => $relatedProperties, 'actionLabel' => session('logged_in') ? 'Manage listing' : 'View details'])
</div>
@endsection
