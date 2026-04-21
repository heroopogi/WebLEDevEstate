@extends('layouts.app')

@section('title', 'DevEstate | Dashboard')

@section('content')
<section class="page-section">
    <div class="hero-card hero-card-large">
        <div class="hero-content">
            <span class="hero-eyebrow">Agent Workspace</span>
            <h1 class="hero-title hero-title-large">Manage House Listings for Your Clients</h1>
            <p class="hero-copy">Use this admin area as a real estate agent to add listings, update property details, and keep available homes ready for client viewing.</p>
            <div class="hero-links">
                <a href="{{ route('listings') }}" class="btn btn-primary">Add New Listing</a>
                <a href="{{ route('details') }}" class="btn btn-secondary">Edit Listing Details</a>
                <a href="{{ route('map') }}" class="btn btn-secondary">Update Property Map</a>
            </div>
        </div>
    </div>

    <div class="feature-grid">
        <div class="metric-card">
            <small>Active Listings</small>
            <strong>{{ $propertyCount }}</strong>
            <p>Published and visible to clients</p>
        </div>
        <div class="metric-card">
            <small>Client Inquiries</small>
            <strong>{{ max($propertyCount * 3, 6) }}</strong>
            <p>Estimated inquiries based on current listings</p>
        </div>
        <div class="metric-card">
            <small>Closed Deals</small>
            <strong>{{ max($propertyCount - 1, 1) }}</strong>
            <p>Placeholder pipeline count for the demo</p>
        </div>
        <div class="metric-card">
            <small>Portfolio Value</small>
            <strong>PHP {{ number_format($portfolioValue) }}</strong>
            <p>Total value across the properties table</p>
        </div>
    </div>

    <div class="page-card">
        <h2 class="section-title">Agent Quick Actions</h2>
        <div class="feature-grid">
            <div class="quick-card">
                <div class="icon-tile">ADD</div>
                <h3>Add House</h3>
                <p>Create a new listing for clients to browse.</p>
            </div>
            <div class="quick-card">
                <div class="icon-tile">EDIT</div>
                <h3>Update Listing</h3>
                <p>Revise price, photos, or house details.</p>
            </div>
            <div class="quick-card">
                <div class="icon-tile">LEAD</div>
                <h3>Track Leads</h3>
                <p>Review inquiries and client interest.</p>
            </div>
            <div class="quick-card">
                <div class="icon-tile">MAP</div>
                <h3>Set Location</h3>
                <p>Keep listing map pins accurate.</p>
            </div>
        </div>
    </div>

    <div class="page-card">
        <h2 class="section-title">Recently Updated Listings</h2>
        @include('partials.property-grid', ['properties' => $properties, 'actionLabel' => 'Manage'])
    </div>
</section>
@endsection
