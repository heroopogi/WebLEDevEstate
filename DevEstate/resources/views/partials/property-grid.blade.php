<div class="property-grid">
    @forelse($properties as $property)
        <article class="property-card">
            <div class="property-media">
                <img src="{{ asset($property->image_path) }}" alt="{{ $property->name }}">
                <span class="property-chip">{{ $property->badge }}</span>
            </div>
            <div class="property-body">
                <div class="property-meta">
                    <span>{{ $property->bedrooms }} Beds</span>
                    <span>{{ $property->bathrooms }} Baths</span>
                    <span>{{ $property->floor_area }} sqm</span>
                </div>
                <h3>{{ $property->name }}</h3>
                <p>{{ $property->description }}</p>
                <div class="price-row">
                    <span class="price">PHP {{ number_format($property->price) }}</span>
                    <a href="{{ route('details', $property->slug) }}" class="btn btn-primary">{{ $actionLabel ?? 'View Details' }}</a>
                </div>
            </div>
        </article>
    @empty
        <div class="empty-state">
            <h3>No properties available yet.</h3>
            <p>Add or seed properties to populate this section.</p>
        </div>
    @endforelse
</div>
