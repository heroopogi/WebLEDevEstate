@extends('layouts.app')

@section('title', 'DevEstate | Listings')

@section('content')
<section class="hero">
    <span class="eyebrow">House Listings</span>
    <h1>{{ session('logged_in') ? 'Manage and publish houses.' : 'Browse available houses.' }}</h1>
</section>

<div class="page-card">
    <h2 class="section-title">{{ session('logged_in') ? 'Managed house inventory' : 'Featured houses' }}</h2>
    @if (session('status'))
        <div class="alert" style="margin-bottom: 1rem; background: #DCFCE7; border-color: #BBF7D0; color: #166534;">
            {{ session('status') }}
        </div>
    @endif
    <div class="property-grid">
        @foreach($properties as $property)
        <article class="property-card">
            <div class="property-media">
                <img src="{{ asset($property->image) }}" alt="{{ $property->name }}">
                <span class="property-chip">{{ $property->badge }}</span>
            </div>
            <div class="property-body">
                <div class="property-meta">
                    @foreach(($property->tags ?? []) as $tag)
                        <span>{{ $tag }}</span>
                    @endforeach
                </div>
                <h3>{{ $property->name }}</h3>
                <p>{{ $property->summary }}</p>
                <p style="margin-top: -0.65rem; margin-bottom: 1rem; color: var(--text-muted); font-size: 0.9rem;">
                    Listed by:
                    <strong style="color: var(--navy);">{{ optional($property->user)->full_name ?: optional($property->user)->name ?: 'Unknown Agent' }}</strong>
                </p>
                <div class="price-row">
                    <span class="price">{{ $property->price }}</span>
                    @if (session('logged_in'))
                        <div style="display: flex; gap: 0.75rem; flex-wrap: wrap; justify-content: flex-end;">
                            <a href="{{ route('details', ['slug' => $property->slug]) }}" class="btn btn-primary">Manage listing</a>
                            <form method="POST" action="{{ route('listings.destroy', ['slug' => $property->slug]) }}" onsubmit="return confirm('Delete this listing?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('details', ['slug' => $property->slug]) }}" class="btn btn-primary">View details</a>
                    @endif
                </div>
            </div>
        </article>
        @endforeach
    </div>
</div>
@endsection
