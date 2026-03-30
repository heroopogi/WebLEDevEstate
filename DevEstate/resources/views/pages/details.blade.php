@extends('layouts.app', ['title' => 'DevEstate | Details'])

@section('content')
<div class="card">
    <p class="eyebrow">Property Details Page</p>
    <h1>{{ $detail->property_name }}</h1>
    <p>{{ $detail->description }}</p>
    <div class="meta">
        <span>{{ $detail->location }}</span>
        <span>{{ $detail->bedrooms }} Bedrooms</span>
        <span>{{ $detail->bathrooms }} Bathrooms</span>
        <span>{{ number_format((int) $detail->area_sqft) }} sqft</span>
    </div>
    <div class="actions">
        <span class="price">${{ number_format((float) $detail->price, 0) }}</span>
        <a class="btn btn-accent" href="{{ route('maps.index') }}">View Location</a>
    </div>
</div>
@endsection
