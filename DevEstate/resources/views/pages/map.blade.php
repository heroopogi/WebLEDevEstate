@extends('layouts.app', ['title' => 'DevEstate | Map'])

@section('content')
<p class="eyebrow">Map Page</p>
<h1>Nearby Highlights</h1>
<div class="grid grid-2">
    @foreach ($maps as $map)
        <article class="card">
            <h3>{{ $map->place_name }}</h3>
            <p>{{ $map->description }}</p>
            <div class="meta"><span>{{ $map->distance_minutes }} min away</span></div>
        </article>
    @endforeach
</div>
@endsection
