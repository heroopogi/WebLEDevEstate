@extends('layouts.app')

@section('title', 'DevEstate | Details')

@section('content')
<section class="hero">
    <span class="eyebrow">House Details</span>
    <h1>{{ session('logged_in') ? 'Edit listing details with confidence.' : 'Review complete house details.' }}</h1>
    <p>{{ session('logged_in') ? 'Agents can keep listing data complete and accurate for clients.' : 'Clients can inspect key property information before contacting an agent.' }}</p>
    <div class="hero-actions">
        <a href="{{ route('map') }}" class="btn btn-primary">{{ session('logged_in') ? 'Set map location' : 'Open map location' }}</a>
        <a href="{{ route('listings') }}" class="btn btn-outline">{{ session('logged_in') ? 'Back to manage listings' : 'Back to house listings' }}</a>
    </div>
</section>

<div class="page-card detail-card">
    <span class="eyebrow">Featured listing</span>
    <h3>Azure Bay Terrace</h3>
    <div class="detail-meta">
        <span>Beachfront</span>
        <span>Private Garage</span>
        <span>Solar Ready</span>
    </div>
    <p class="detail-description">
        Azure Bay Terrace balances coastal charm with executive luxury. Open-plan interiors, abundant natural light, and curated finishes create an elegant experience from entry to terrace.
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
            <span>Nearby</span>
            <strong>Marina District</strong>
        </div>
    </div>
    <div class="inline-actions">
        <a href="{{ route('map') }}" class="btn btn-primary">{{ session('logged_in') ? 'Update location pin' : 'View location' }}</a>
        <a href="{{ route('listings') }}" class="btn btn-outline">{{ session('logged_in') ? 'Back to listings' : 'Continue browsing' }}</a>
    </div>
</div>
@endsection
