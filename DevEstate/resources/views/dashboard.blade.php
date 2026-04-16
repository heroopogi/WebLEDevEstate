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
            <strong>156</strong>
            <p>Published and visible to clients</p>
        </div>
        <div class="metric-card">
            <small>Client Inquiries</small>
            <strong>42</strong>
            <p>Pending agent follow-ups</p>
        </div>
        <div class="metric-card">
            <small>Closed Deals</small>
            <strong>18</strong>
            <p>Completed this year</p>
        </div>
        <div class="metric-card">
            <small>Portfolio Value</small>
            <strong>$24.5M</strong>
            <p>Total listed inventory</p>
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
        <div class="property-grid">
            <article class="property-card">
                <div class="property-media">
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=900&q=80" alt="Skyline Ridge">
                    <span class="property-chip">Updated</span>
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
                        <a href="{{ route('details') }}" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </article>
            <article class="property-card">
                <div class="property-media">
                    <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80" alt="Parklane Condo">
                    <span class="property-chip">New Listing</span>
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
                        <a href="{{ route('details') }}" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </article>
            <article class="property-card">
                <div class="property-media">
                    <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=900&q=80" alt="Harbor Crest Penthouse">
                    <span class="property-chip">Premium</span>
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
                        <a href="{{ route('details') }}" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
@endsection
