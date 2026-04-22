@extends('layouts.app')

@section('title', 'DevEstate | Dashboard')

@section('content')
<section class="page-section">
    <div class="dashboard-topbar">
        <div>
            <p class="dashboard-eyebrow">Admin Dashboard</p>
            <h1 class="dashboard-heading">Welcome back, {{ session('username', 'Agent') }}.</h1>
            <p class="dashboard-subheading">Monitor your listings, pricing, and recent updates from one place.</p>
        </div>
    </div>

    @if (($unreadReservations ?? 0) > 0)
        <div class="alert" style="background: #FEF3C7; border-color: #FDE68A; color: #92400E;">
            You have {{ $unreadReservations }} new reservation {{ $unreadReservations > 1 ? 'requests' : 'request' }}.
            <a href="{{ route('reservations') }}" style="font-weight: 700; color: #78350F;">View reservations</a>
        </div>
    @endif

    <div class="hero-card hero-card-large">
        <div class="dashboard-hero-grid">
            <div class="hero-content">
                <div class="dashboard-metrics">
                    <div class="metric-card">
                        <small>Active Listings</small>
                        <strong>{{ $activeListings }}</strong>
                        <p>Published and visible to clients</p>
                    </div>
                    <div class="metric-card">
                        <small>New This Month</small>
                        <strong>{{ $newThisMonth }}</strong>
                        <p>Listings added this month</p>
                    </div>
                    <div class="metric-card">
                        <small>Average Price</small>
                        <strong>${{ number_format($averageListingPrice, 0) }}</strong>
                        <p>Average price per listing</p>
                    </div>
                    <div class="metric-card">
                        <small>Portfolio Value</small>
                        <strong>${{ number_format($totalPortfolioValue, 0) }}</strong>
                        <p>Total listed inventory</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-card">
        <h2 class="section-title">Agent Quick Actions</h2>
        <p class="section-description">Shortcuts for the actions you actually use while maintaining inventory.</p>
        <div class="feature-grid">
            <a href="{{ route('listings.create') }}" class="quick-link-card">
                <div class="quick-card">
                    <div class="icon-tile">ADD</div>
                    <h3>Add House</h3>
                    <p class="quick-card-copy">Create a fresh property entry with price, features, images, and searchable details.</p>
                    <span class="quick-card-action">Open listing form</span>
                </div>
            </a>
            <a href="{{ route('listings') }}" class="quick-link-card">
                <div class="quick-card">
                    <div class="icon-tile">EDIT</div>
                    <h3>Manage Listings</h3>
                    <p class="quick-card-copy">Review your saved properties, open details, update information, or remove outdated entries.</p>
                    <span class="quick-card-action">Go to listings</span>
                </div>
            </a>
            <a href="{{ $recentProperties->isNotEmpty() ? route('details', ['slug' => $recentProperties->first()->slug]) : route('listings') }}" class="quick-link-card">
                <div class="quick-card">
                    <div class="icon-tile">VIEW</div>
                    <h3>Review Latest Listing</h3>
                    <p class="quick-card-copy">Jump straight into the most recent property record to inspect details and continue editing.</p>
                    <span class="quick-card-action">Open latest property</span>
                </div>
            </a>
        </div>
    </div>

    <div class="page-card">
        <h2 class="section-title">Recently Updated Listings</h2>
        <p class="section-description">Your newest and most recently maintained properties appear here for quick access.</p>
        <div class="property-grid">
            @forelse ($recentProperties as $property)
                @php
                    $imageSource = \Illuminate\Support\Str::startsWith($property->image ?? '', ['http://', 'https://'])
                        ? $property->image
                        : asset($property->image ?? '');
                @endphp
                <article class="property-card">
                    <div class="property-media">
                        <img src="{{ $imageSource }}" alt="{{ $property->name }}">
                        <span class="property-chip">{{ $property->badge }}</span>
                    </div>
                    <div class="property-body">
                        <div class="property-meta">
                            @foreach (array_slice($property->tags ?? [], 0, 3) as $tag)
                                <span>{{ $tag }}</span>
                        @endforeach
                        </div>
                        <h3>{{ $property->name }}</h3>
                        <p class="property-summary">{{ $property->summary }}</p>
                        <div class="price-row">
                            <span class="price">{{ $property->price }}</span>
                            <a href="{{ route('details', ['slug' => $property->slug]) }}" class="btn btn-primary">Manage</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="metric-card">
                    <small>No Listings Yet</small>
                    <strong>0</strong>
                    <p>Add your first property listing to populate the dashboard.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
