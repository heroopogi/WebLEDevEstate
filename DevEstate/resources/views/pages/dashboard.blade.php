@extends('layouts.app', ['title' => 'DevEstate | Dashboard'])

@section('content')
<p class="eyebrow">Dashboard Page</p>
<h1>Operations Overview</h1>
<div class="grid grid-3">
    @foreach ($dashboards as $dashboard)
        <article class="card">
            <h3>{{ $dashboard->metric }}</h3>
            <p class="price">{{ $dashboard->value }}</p>
            <p>{{ $dashboard->note }}</p>
        </article>
    @endforeach
</div>
@endsection
