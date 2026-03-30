@extends('layouts.app', ['title' => 'DevEstate | Listings'])

@section('content')
<p class="eyebrow">Listings Page</p>
<h1>Featured Properties</h1>
<div class="grid grid-3">
    @foreach ($listings as $listing)
        <article class="card">
            <h3>{{ $listing->name }}</h3>
            <p>{{ $listing->location }}</p>
            <div class="meta">
                <span>{{ $listing->property_type }}</span>
                <span>{{ $listing->bedrooms }} Bedrooms</span>
                <span>{{ $listing->bathrooms }} Bathrooms</span>
            </div>
            <div class="actions">
                <span class="price">${{ number_format((float) $listing->price, 0) }}</span>
                <a class="btn btn-primary" href="{{ route('details.index') }}">View Property</a>
            </div>
        </article>
    @endforeach
</div>
@endsection
