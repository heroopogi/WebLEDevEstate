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
    <p class="section-description">These listings now come from the `properties` table and use your uploaded house photos.</p>
    @include('partials.property-grid', ['properties' => $properties, 'actionLabel' => session('logged_in') ? 'Manage listing' : 'View details'])
</div>
@endsection
