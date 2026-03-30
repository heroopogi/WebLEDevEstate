@extends('layouts.app', ['title' => 'DevEstate | Home'])

@section('content')
<div class="card">
    <p class="eyebrow">Home Page</p>
    <h1>{{ $home->headline }}</h1>
    <p>{{ $home->subheadline }}</p>
    <div class="actions">
        <a class="btn btn-primary" href="{{ route('listings.index') }}">{{ $home->primary_cta }}</a>
        <a class="btn btn-accent" href="{{ route('details.index') }}">{{ $home->secondary_cta }}</a>
    </div>
</div>
@endsection
