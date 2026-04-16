@extends('layouts.app')

@section('title', 'DevEstate | Map')

@section('content')
<section class="hero">
    <span class="eyebrow">House Map</span>
    <h1>{{ session('logged_in') ? 'Manage listing locations.' : 'Explore house locations.' }}</h1>
    <p>{{ session('logged_in') ? 'Agents can verify and update map context for each listing.' : 'Clients can review the house location and nearby landmarks.' }}</p>
    <div class="hero-actions">
        <a href="{{ route('listings') }}" class="btn btn-primary">{{ session('logged_in') ? 'Back to listings manager' : 'Back to house listings' }}</a>
        <a href="{{ route('details') }}" class="btn btn-outline">{{ session('logged_in') ? 'Open listing details' : 'View house details' }}</a>
    </div>
</section>

<div class="page-card map-card">
    <div class="map-surface">
        <div class="map-grid"></div>
        <div class="road horizontal"></div>
        <div class="road vertical"></div>
        <span class="map-label map-label-cbd">CBD</span>
        <span class="map-label map-label-park">Park</span>
        <span class="map-label map-label-station">Station</span>
        <span class="map-pin map-pin-1"></span>
        <span class="map-pin map-pin-2"></span>
        <span class="map-pin map-pin-3"></span>
    </div>
</div>
@endsection
